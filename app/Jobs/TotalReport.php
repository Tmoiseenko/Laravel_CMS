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
//use Maatwebsite\Excel\Excel;
use Illuminate\Support\Facades\Log;
use PDF;
use Excel;

class TotalReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $request = \request();
        $data = [];
        if($request->input('postsCount')) {
            $data['postsCount']['count'] = Post::count();
            $data['postsCount']['title'] = 'Обшее количество Статей';
        }
        if($request->input('newsCount')) {
            $data['newsCount']['count'] = News::count();
            $data['newsCount']['title'] = 'Обшее количество Новостей';
        }
        if($request->input('commentsCount')) {
            $data['commentsCount']['count'] = Comment::count();
            $data['commentsCount']['title'] = 'Обшее количество Коментариев';
        }
        if($request->input('usersCount')) {
            $data['usersCount']['count'] = User::count();
            $data['usersCount']['title'] = 'Обшее количество Пользователей';
        }
        if($request->input('mostPopularPost')) {
            $data['mostPopularPost']['object'] =  Post::withCount('comments')
                ->orderBy('comments_count', 'desc')
                ->first();
            $data['mostPopularPost']['title'] = 'Самая обсуждаемая статья';
        }
        if($request->input('userWithMaxPost')) {
            $data['userWithMaxPost']['object'] =  User::withCount('posts')
                ->orderBy('posts_count', 'desc')
                ->first();
            $data['userWithMaxPost']['title'] = 'Пользоветель с максимальным кол-ом постов';
        }
        if($request->input('postMaxBody')) {
            $data['postMaxBody']['object'] =  Post::select(DB::raw('*, LENGTH(content) as cnt'))
                ->orderBy('cnt', 'desc')
                ->first();
            $data['postMaxBody']['title'] = 'Самая длинная статья';
        }
        if($request->input('postMinBody')) {
            $data['postMinBody']['object'] =  Post::select(DB::raw('*, LENGTH(content) as cnt'))
                ->orderBy('cnt', 'asc')
                ->first();
            $data['postMinBody']['title'] = 'Самая короткая статья';
        }
        if($request->input('avgUSerPosts')) {
            $data['avgUSerPosts']['count'] =  User::withCount('posts')
                ->orderBy('posts_count', 'desc')
                ->get()
                ->where('posts_count', '>', 1)
                ->avg('posts_count');
            $data['avgUSerPosts']['title'] = 'Среднее количество статей у активного пользователя';
        }

        $mail = new TotalReportSendMail($data);
        Log::info( $request->input('export') );

        if($request->input('export') != 'not_export') {

            $time = Carbon::now()->format('Ymd_Hi');
            $filename = $time . '_TotalReport' . '.' . $request->input('export');

            $path = storage_path('app/public/reports/') . $filename;
            $mime = '';

            if($request->input('export') == 'pdf') {
                $pdf = PDF::loadView('emails.reports.total', compact('data'));
                $pdf->save($path);
                $mime = 'application/pdf';
            }

            if($request->input('export')  == 'xlsx') {
                Excel::store(new ExcelExport($data), '/reports/' . $filename, 'public');
            }
            $mail->attach($path,  [ 'as' => $filename, 'mime' => $mime]);
        }

        \Mail::to(config('mail.admin_email'))->queue($mail);

    }
}
