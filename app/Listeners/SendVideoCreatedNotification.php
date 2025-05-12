<?php

namespace App\Listeners;

use App\Events\VideoCreated;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\VideoCreatedMail;
use Illuminate\Support\Facades\Notification;
use App\Notifications\VideoCreatedNotification;

class SendVideoCreatedNotification
{
    public function handle(VideoCreated $event)
    {
        // Enviar correu als admins
        Mail::to('admin@example.com')->send(new VideoCreatedMail($event->video));

        // Enviar notificació
        $admins = User::where('super_admin', 1)->get();

        foreach ($admins as $admin) {
            $admin->notify(new VideoCreatedNotification($event->video));
        }
    }
}
