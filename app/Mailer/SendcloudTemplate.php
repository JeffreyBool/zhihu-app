<?php
/**
 * Created by PhpStorm.
 * User: 科诺设计
 * Date: 2017/8/13
 * Time: 22:30
 */

namespace App\Mailer;


/**
 * Class SendcloudTemplate
 * @package App\Mailer
 */
class SendcloudTemplate
{

    const REGISTER = 'zhihu_app_register';   //注册通知模板

    const RESET = 'zhihu_app_reset';         //找回密码通知模板

    const FOLLOW = 'zhihu_app_new_user_follow';     //用户关注通知模板
}