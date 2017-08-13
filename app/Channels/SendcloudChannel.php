<?php
namespace App\Channels;
use Illuminate\Notifications\Notification;

/**
 * Created by PhpStorm.
 * User: 科诺设计
 * Date: 2017/8/13
 * Time: 12:32
 */


/**
 * Class SendcloudChannel
 * @package App\Channels
 */
class SendcloudChannel
{

    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toSendcloud($notifiable);
    }
}