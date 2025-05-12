<?php
// app/Events/VideoCreated.php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Video;

class VideoCreated implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public $video;

    public function __construct(Video $video)
    {
        $this->video = $video;
    }

    public function broadcastOn()
    {
        return new Channel('videos');
    }

    public function broadcastAs()
    {
        return 'video.created';
    }
}
