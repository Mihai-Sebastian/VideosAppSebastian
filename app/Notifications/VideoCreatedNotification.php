<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use App\Models\Video;

class VideoCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $video;

    public function __construct(Video $video)
    {
        $this->video = $video;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'video_id' => $this->video->id,
            'title' => $this->video->title,
            'url' => $this->video->url,
        ];
    }

    public function getVideo()
    {
        return $this->video;
    }
}
