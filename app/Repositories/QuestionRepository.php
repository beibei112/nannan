<?php

namespace App\Repositories;

use Auth;
use App\Topic;
use App\Follow;
use App\Question;

class QuestionRepository {
    
    public function byIdWithTopicsAndAnswers($id){
        return Question::where('id',$id)->with(['topics','answers'])->first();
    }

    public function byId($id){
        return Question::findOrFail($id);
    }

    public function create(array $attributes){
        return Question::create($attributes);
    }

    public function getAllQuestions(){
        //只有is_hidden=H的才能显示
        return Question::hidden()->with('user','topics')->get();
    }
    //根据form提交的topics数组,如果是number 不需要添加新的topics表数据,如果是string就需要插入topics表,并返回对应的id
    public function deal($topics){

        return collect($topics)->map(function($topic){
            if(is_numeric($topic)){

                //让标签的questions_count字段自增。
                Topic::findOrFail($topic)->increment('questions_count');
                return $topic;
            }else{

                //插入topics表数据
                $topic = Topic::create(['name'=>$topic,'questions_count'=>1]);
                return $topic->id;
            }
        })->toArray();
    }
    public function follow($question_id){
        Follow::create([
            'user_id'=>Auth::id(),
            'question_id'=>$question_id
        ]);
    }

    public function unfollow($question_id){
        $follow = Follow::where('question_id',$question_id)->where('user_id',Auth::id())->first();
        $follow->delete();
    }
}

?>
