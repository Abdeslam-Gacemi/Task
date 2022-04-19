<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Jobs\SendNewPostMail;
use Illuminate\Console\Command;
use App\Models\UserWebsiteSubscriptions;

class SendPostNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscribers:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify subscribers about newly published posts';

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
        $posts = Post::where('notified', false)->get();
        foreach ($posts as $post) {
            $subscriptions = UserWebsiteSubscriptions::with('user')
                ->where('website_id', $post->website_id)
                ->get();
            foreach ($subscriptions as $subscription) {
                SendNewPostMail::dispatch($subscription->user->email, $post);
            }
            $post->update(['notified' => true]);
        }
    }
}
