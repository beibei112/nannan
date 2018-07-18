<?php

namespace App;

use Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','confirmation_token','avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function owns($question){
        return $this->id == $question->user_id;
    }

    public function questions(){
        return $this->hasMany('App\Question');
    }

    public function answers(){
        return $this->hasMany('App\Answer');
    }

    public function follows(){
        return $this->belongsToMany('App\Question','user_question')->withTimestamps();
    }

    public function followThis($question_id){
        return $this->follows()->toggle($question_id);
    }

    public function followed($question_id){
        return Follow::where('question_id',$question_id)->where('user_id',$this->id)->count();
    }

    //关联关系指定
    public function follows_user(){
        return $this->belongsToMany(self::class,'follows','follower_id','followed_id')->withTimestamps();
    }

    public function followThis_user($user_id){
        return $this->follows_user()->toggle($user_id);
    }

    public function followed_user($user_id){
        $arr = Auth::user()->follows_user()->pluck('followed_id')->toArray();

        if(in_array($user_id,$arr)){
            return true;
        }else{
            return false;
        }
    }

    public function UserThis_Topic($topic_id){
        return $this->UserTopic()->toggle($topic_id);
   }

    public function UserTopic(){
        return $this->belongsToMany("App\Topic","topic_users")->withTimestamps();
    }

    public function TopicUsered($topic_id){
        return TopicUser::where('topic_id',$topic_id)->where('user_id',$this->id)->count();
    }

    public function collection(){
        return $this->belongsToMany('App\Question','collections')->withTimestamps();
    }


}
