<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use App\Jobs\ProcessMail;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $posts = Post::where("is_published", true)->where("delivery_status", "pending")->with("website.users")->get();

        foreach ($posts as $post) {
            foreach ($post->website->users as $user) {
                ProcessMail::dispatch($post, $user);
            }

            Post::where("id", $post->id)->update([
                "delivery_status" => "sent",
            ]);
        }

        $this->info("Job Completed");
    }
}
