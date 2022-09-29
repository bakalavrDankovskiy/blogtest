<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ArticleUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct
    (
        private int    $articleId,
        private array  $updatedFields,
        private string $articleUrl
    )
    {
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('admin-channel');
    }

    public function broadcastWith()
    {
        return [
            'article_id' => $this->articleId,
            'updated_fields' => $this->updatedFields,
            'article_url' => $this->articleUrl,
        ];
    }

    public function broadcastAs()
    {
        return 'article_updated';
    }
}
