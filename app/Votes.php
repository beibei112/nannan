<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Votes extends Model
{
    protected $table='user_votes';

    protected $fillable = ['user_id','question_id'];
}
