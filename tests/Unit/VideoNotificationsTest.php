<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Video;
use App\Events\VideoCreated;
use App\Notifications\VideoCreatedNotification;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Helpers\UserHelper;

class VideoNotificationsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_video_created_event_is_dispatched()
    {
        Event::fake();

        $user = UserHelper::create_regular_user();

        $video = Video::create([
            'title' => 'Test vídeo',
            'description' => 'Descripció',
            'url' => 'https://youtube.com/watch?v=test123',
            'user_id' => $user->id,
        ]);

        event(new VideoCreated($video));

        Event::assertDispatched(VideoCreated::class, function ($event) use ($video) {
            return $event->video->id === $video->id;
        });
    }


    /** @test */
    public function test_push_notification_is_sent_when_video_is_created()
    {
        Notification::fake();

        $superAdmin = UserHelper::create_superadmin_user();

        $video = Video::create([
            'title' => 'Notificació vídeo',
            'description' => 'Descripció de prova',
            'url' => 'https://youtube.com/watch?v=notif123',
            'user_id' => $superAdmin->id,
        ]);

        event(new VideoCreated($video)); // <-- cridem explícitament l'event

        Notification::assertSentTo(
            [$superAdmin],
            VideoCreatedNotification::class,
            function ($notification, $channels) use ($video) {
                return $notification->getVideo()->id === $video->id;

            }
        );
    }

}
