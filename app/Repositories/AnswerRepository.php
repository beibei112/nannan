<?php

namespace App\Repositories;
use App\Answer;

class AnswerRepository {
	public function create($attributes){
		return Answer::create($attributes);
	}

    public function votes_count($res,$question_id){
        //如果该用户关注了问题
        if(count($res['attached'])>0){
            //关注动作
            Answer::findOrFail($question_id)->increment('votes_count');
        }else{
            //取消关注动作
            Answer::findOrFail($question_id)->decrement('votes_count');
        }
    }
}
