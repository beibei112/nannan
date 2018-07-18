<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Topic;

class TopicUserController extends Controller
{
    public function store(){
        //关注这个用户
        $res = Auth::user()->UserThis_Topic($_REQUEST['id']);

        if(count($res['attached'])>0){

            //关注动作
            Topic::findOrFail($_REQUEST['id'])->increment('followers_count');
            echo "1";
        }else{
            //取消关注
            Topic::findOrFail($_REQUEST['id'])->decrement('followers_count');
            echo "2";
        }
    }

    public function show(){

        $topic = Topic::get();

        return view('topics.show',compact('topic'));
    }

    public function add(Request $request){

        // 声明路径名
        $destinationPath = 'avatars/';
        // 取到图片
        $file = $request->file('avatar');
        // 获得图片的名称 为了保证不重复 我们加上userid和time
        if ($file == null) {
          flash('未选取图片','danger');
          return back();
        }else {
          $file_name = \Auth::user()->id . '_' . time() . $file->getClientOriginalName();
        }
        $topic = Topic::create([
            'name'=>$request->name,
            'topic_pic'=> $file_name,
            'desc'=>$request->desc
        ]);
        $topic->save();


        // 执行move方法
        $file->move($destinationPath, $file_name);
        // 保存到User

        $topic_pic = Topic::where('id',$topic->id)->first();
        $topic_pic->topic_pic = '/' . $destinationPath . $file_name;
        $topic_pic->save();

        if($topic){
            flash('添加话题成功','success');
        }else{
            flash('添加话题失败','error');
        }
        return back();
    }
}
