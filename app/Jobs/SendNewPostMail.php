<?php

namespace App\Jobs;

use App\Mail\NewPostMail;
use App\Models\Post;
use App\Notifications\NewPostNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNewPostMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var Post
     */
    protected $post;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $email, Post $post)
    {
        $this->email = $email;
        $this->post = $post;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)->send(new NewPostMail($this->post));
    }
}
