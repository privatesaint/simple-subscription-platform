<?php

namespace App\Listeners;

use App\Events\NewPost;
use App\Jobs\ProcessMail;
use App\Models\Post;
use App\Models\Website;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendPostEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewPost $event): void
    {
        $post = $event->post;

        $website = Website::where("id", $post->website_id)->with("users")->first();

        foreach ($website->users as $user) {
            ProcessMail::dispatch($post, $user);
        }

        Post::where("id", $post->id)->update([
            "delivery_status" => "sent",
        ]);
    }
}
