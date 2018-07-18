<?php

namespace App\Repositories;

use App\Comment;
  
class CommentRepository {
	public function create(Array $attributes){
		return Comment::create($attributes);
	}

	public function byIdWithUserAndComment($id){
        return Comment::where('id',$id)->with(['user','comments'])->first();
    }
}