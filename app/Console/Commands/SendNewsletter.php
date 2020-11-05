<?php

namespace App\Console\Commands;

use App\Notifications\SendNewsletterNotification;
use App\Post;
use App\User;
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
        $dateFrom = date('Y-m-d', strtotime("-1 week"));
        $dateTo = date('Y-m-d');
        if ($this->option('from')) {
            $dateFrom = date($this->option('from'));
        }
        if ($this->option('to')) {
            $dateTo = date($this->option('to'));
        }
        $users = User::all();
        $posts = Post::whereBetween('created_at', [$dateFrom, $dateTo])->get();

        Notification::send($users, new SendNewsletterNotification($posts));

    }
}

