<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['title','body','user_id'];

    public function topics(){
        return $this->belongsToMany('App\Topic');
    }

    public function scopeHidden($query){
        return $query->where('is_hidden','H');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function answers(){
        return $this->hasMany('App\Answer');
    }

    public function follows(){
        return $this->belongsToMany('App\User','user_question')->withTimestamps();
    }

    //定义一个问题有多个评论
    public function comments(){
        return $this->morphMany('App\Comment','commentable');
    }

    //定义一个问题有多个评论
    public function collectione(){
        return $this->hasMany('App\Collection');
    }
}