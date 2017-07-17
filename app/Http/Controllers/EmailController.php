<?php

namespace App\Http\Controllers;
use App\User;
use Auth;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    /**
     * 验证token是否正确
     * @param $token
     */
    public function verify($token)
    {
        $user = User::where('confirmation_token',$token)->first();

        if(is_null($user))
        {
            flash('邮箱验证失败!','danger')->important();
            return redirect('/');
        }

        $user->is_active = 1;
        $user->confirmation_token = str_random(40);
        $user->save();
        Auth::login($user);
        flash('邮箱验证成功!')->success()->important();
        return redirect('/home');
    }
}
