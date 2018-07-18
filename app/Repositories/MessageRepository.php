<?php

namespace App\Repositories;

use App\Message;
  
class MessageRepository {
	public function create(Array $attributes){
		return Message::create($attributes);
	}
}