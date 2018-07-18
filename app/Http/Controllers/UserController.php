<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use App\User;
use App\Information;
use App\Collection;
use App\Question;
use Illuminate\Http\Request;
use App\Http\Requests\UploadAvatarRequest;

class UserController extends Controller
{
    public function index($user_id){
        $user = User::where('id',$user_id)->with('follows')->first();
        $information = information::where('user_id',$user_id)->first();
        $users = User::where('id',$user_id)->with('collection')->first();
        // dd($users->toArray());
        // dump(session());
		return view('home.index',compact('user','information','users'));
    }

    public function avatar()
    {
        return view('user.avatar');
    }

    public function update(Request $request){
        $Information=Information::where("user_id",Auth::id())->first();
        $Information->sex=$request->get("sex");
        $Information->school=$request->get("school");
        $Information->height=$request->get("height");
        $Information->weight=$request->get("weight");
        $Information->phone=$request->get("phone");
        $Information->girlfriend=$request->get("girlfriend");
        $Information->save();

        return back();
    }

    public function changeAvatar(Request $request)
    {
        // 声明路径名
        $destinationPath = 'avatars/';
        // 取到图片
        $file = $request->file('avatars');

        // 获得图片的名称 为了保证不重复 我们加上userid和time
        if ($file == null) {
          flash('未选取图片','danger');
          return back();
        }else {
          $file_name = \Auth::user()->id . '_' . time() . $file->getClientOriginalName();
        }

        // 执行move方法
        $file->move($destinationPath, $file_name);

        // 保存到User
        if ($request->get('type')=='1') {
            $user = User::findOrFail(\Auth::user()->id);
            $user->avatar = '/' . $destinationPath . $file_name;
            $user->save();
        }else{
            $user = Information::where('user_id',Auth::user()->id)->first();
            $user->user_img = '/' . $destinationPath . $file_name;
            $user->save();
        }

        // 重定向
        return redirect('/user/home/'.Auth::user()->id);

    }

    //修改密码ajax
    public function mimaajax(Request $request)
    {
        //目前登录ID
        $id = Auth::user()->id;

        if($_POST['biao'] == "jiu"){

            //传过来的旧密码，用户输入的
            $oldpassword = $request->input('oldpassword');

            //根据目前登录ID查询目前用户password
            $res = User::where('id',$id)->select('password')->first();

            //判断数据中密码和用户输入的旧密码是否相同
            if(!Hash::check($oldpassword, $res->password)){
                //不同返回2
                echo 2;
                exit;
            }else{
                // 相同返回1
                echo 1;die;
            }

        }else{

            //变成一个数组然后提交
            $update = array(
              'password'  =>bcrypt($_POST['password']),
            );

            $result = User::where('id',$id)->update($update);

            //判断是否成功
            if($result){
                echo 1;exit;//成功
            }else{
                echo 0;exit;//失败
            }
        }
    }
}
