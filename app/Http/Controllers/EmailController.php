<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function verify($id,$token){
        //根据confirmation_token查询用户
        $user = User::where('confirmation_token','=',$token)->first();

        if(is_null($user)){
            //消息提示
            flash('邮件激活成功')->danger();

            redirect('/');
        }

        //激活is_active
        $user->is_active = 1;

        //更新 confirmation_token 字段 防止用户第二次恶意点击
        $user->confirmation_token = str_random(20);

        $user->save();

        //舔砖到Home的时候一定用户已经登录
        Auth::login($user);

        //提示消息
        flash('欢迎回来')->success();
        return redirect('/home');
    }
}
