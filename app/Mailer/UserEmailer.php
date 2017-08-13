<?php
namespace App\Mailer;
/**
 * Created by PhpStorm.
 * User: 科诺设计
 * Date: 2017/8/13
 * Time: 22:37
 */

use Auth;

/**
 * Class UserEmailer
 * @package App\Mailer
 */
class UserEmailer extends Mailer
{
    /**
     * @param $email
     */
    public function followNotifyEmail($email)
    {
        $data = ['url' => 'www.zhihu.dev','name'=>Auth::guard('api')->user()->name];
        $this->sendTo(SendcloudTemplate::FOLLOW,$email,$data);
    }

    /**
     * @param $email
     * @param $token
     */
    public function passwordRest($email,$token)
    {
        $data = ['url' => url('password/reset',$token)];
        $this->sendTo(SendcloudTemplate::RESET,$email,$data);
    }

    /**
     * @param User $user
     */
    public function welcome(User $user)
    {
        // 模板变量
        $data = [
            'url' => route('email.verify',['token'=>$user->confirmation_token]),
            'name'=>$user->name,
        ];

        $this->sendTo(SendcloudTemplate::REGISTER,$user->email,$data);
    }
}