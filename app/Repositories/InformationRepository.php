<?php

namespace App\Repositories;

use App\Information;

class InformationRepository {
	public function create(Array $attributes){
		return information::create($attributes);
	}

	public function update(Array $attributes){
		return 'aaa';
        dd($attributes);
	}
}