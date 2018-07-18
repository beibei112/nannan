<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $table='collections';

    protected $fillable = ['user_id','question_id'];


    public function questions(){
        return $this->belongsToMany('App\Question');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function Collectiona(){
        return $this->belongsToMany("App\Collection","questions")->withTimestamps();
    }

}
