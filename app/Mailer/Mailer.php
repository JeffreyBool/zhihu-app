<?php
/**
 * Created by PhpStorm.
 * User: 科诺设计
 * Date: 2017/8/13
 * Time: 22:25
 */

namespace App\Mailer;

use Mail;
use Naux\Mail\SendCloudTemplate;

class Mailer
{
    /**
     * @param       $template
     * @param       $email
     * @param array $data
     */
    protected function sendTo($template,$email, array $data)
    {
        $content = new SendcloudTemplate($template, $data);

        Mail::raw($content, function ($message) use($email)
        {
            $message->from('1402992668@qq.com', 'yicms');
            $message->to($email);
        });
    }
}