<?php

namespace App\Repositories;


use App\Question;

class FollowRepository {
	public function follow_count($res,$question_id){
		//如果该用户关注了问题
    	if(count($res['attached'])>0){
    		//关注动作
    		Question::findOrFail($question_id)->increment('followers_count');
    	}else{
    		//取消关注动作
    		Question::findOrFail($question_id)->decrement('followers_count');
    	}
	}
}
