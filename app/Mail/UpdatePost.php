<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Post;

class UpdatePost extends Mailable
{
    use Queueable, SerializesModels;

    protected $post;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Post updated: ' . $this->post->title)
                    ->markdown('mail.update')
                    ->with([
                        'title' => $this->post->title,
                        'body' => $this->post->body
                    ]);
    }
}
