<?php

namespace App\Console\Commands;

use App\Notifications\SendNewsletterNotification;
use App\Post;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Notification;

class SendNewsletter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send_newsletter {--from=} {--to=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send newsletter with latest articles to subscribers. Option --from and --to must be in format "Y-m-d"';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $dateFrom = new Carbon();
        $dateTo = new Carbon();
        $dateTo->subWeek(-1);
        if ($this->option('from')) {
            $dateFrom =  Carbon::create($this->option('from'));
        }
        if ($this->option('to')) {
            $dateTo = Carbon::create($this->option('to'));
        }
        $users = User::all();
        $posts = Post::whereBetween('created_at', [$dateFrom, $dateTo])->get();

        Notification::send($users, new SendNewsletterNotification($posts));

    }
}

