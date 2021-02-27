<?php

namespace App\Jobs;

use App\Comment;
use App\Exports\ExcelExport;
use App\Mail\TotalReportSendMail;
use App\News;
use App\Post;
use App\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use PDF;
use Excel;

class TotalReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $request;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = [];
        if(isset($this->request['postsCount'])) {
            $data['postsCount']['count'] = Post::count();
            $data['postsCount']['title'] = 'Обшее количество Статей';
        }
        if(isset($this->request['newsCount'])) {
            $data['newsCount']['count'] = News::count();
            $data['newsCount']['title'] = 'Обшее количество Новостей';
        }
        if(isset($this->request['commentsCount'])) {
            $data['commentsCount']['count'] = Comment::count();
            $data['commentsCount']['title'] = 'Обшее количество Коментариев';
        }
        if(isset($this->request['usersCount'])) {
            $data['usersCount']['count'] = User::count();
            $data['usersCount']['title'] = 'Обшее количество Пользователей';
        }
        if(isset($this->request['mostPopularPost'])) {
            $data['mostPopularPost']['object'] =  Post::withCount('comments')
                ->orderBy('comments_count', 'desc')
                ->first();
            $data['mostPopularPost']['title'] = 'Самая обсуждаемая статья';
        }
        if(isset($this->request['userWithMaxPost'])) {
            $data['userWithMaxPost']['object'] =  User::withCount('posts')
                ->orderBy('posts_count', 'desc')
                ->first();
            $data['userWithMaxPost']['title'] = 'Пользоветель с максимальным кол-ом постов';
        }
        if(isset($this->request['postMaxBody'])) {
            $data['postMaxBody']['object'] =  Post::select(DB::raw('*, LENGTH(content) as cnt'))
                ->orderBy('cnt', 'desc')
                ->first();
            $data['postMaxBody']['title'] = 'Самая длинная статья';
        }
        if(isset($this->request['postMinBody'])) {
            $data['postMinBody']['object'] =  Post::select(DB::raw('*, LENGTH(content) as cnt'))
                ->orderBy('cnt', 'asc')
                ->first();
            $data['postMinBody']['title'] = 'Самая короткая статья';
        }
        if(isset($this->request['avgUSerPosts'])) {
            $data['avgUSerPosts']['count'] =  User::withCount('posts')
                ->orderBy('posts_count', 'desc')
                ->get()
                ->where('posts_count', '>', 1)
                ->avg('posts_count');
            $data['avgUSerPosts']['title'] = 'Среднее количество статей у активного пользователя';
        }

        $mail = new TotalReportSendMail($data);

        if($this->request['export'] != 'not_export') {

            $time = Carbon::now()->format('Ymd_Hi');
            $filename = $time . '_TotalReport' . '.' . $this->request['export'];

            $path = storage_path('app/public/reports/') . $filename;
            $mime = '';

            if($this->request['export'] == 'pdf') {
                $pdf = PDF::loadView('emails.reports.total', compact('data'));
                $pdf->save($path);
                $mime = 'application/pdf';
            }

            if($this->request['export']  == 'xlsx') {
                Excel::store(new ExcelExport($data), '/reports/' . $filename, 'public');
            }
            $mail->attach($path,  [ 'as' => $filename, 'mime' => $mime]);
        }

        \Mail::to(config('mail.admin_email'))->queue($mail);
    }
}
