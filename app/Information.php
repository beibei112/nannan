<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
	protected $fillable = ['user_id','sex','school','height','weight','phone','girlfriend'];

  	protected $table = 'Information';

	public function user(){
		return $this->belongsToMany('App\User');
	}
}