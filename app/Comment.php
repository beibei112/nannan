<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id','body','commentable_id','commentable_type'];

    protected $table = 'comments';

    //执行多态关联
    public function commentable(){//函数名必须要和多态关联字段的前缀 
    	//定义多态关联
    	return $this->morphTo();
    }

    public function user(){
    	return $this->belongsTo('App\User','user_id');
    }
}
