<?php

namespace App\Notifications;

use App\Channels\SendcloudChannel;
use App\Mailer\UserEmailer;
use Auth;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewUserFollowNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database',SendcloudChannel::class];
    }

    public function toDatabase($notifiable)
    {
        return [
            'id'=> Auth::guard('api')->user()->id,
            'name'=> Auth::guard('api')->user()->name,
        ];
    }

    /**
     * @param $notifiable
     */
    public function toSendcloud($notifiable)
    {
        (new UserEmailer())->followNotifyEmail($notifiable->email);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
