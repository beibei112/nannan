<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserFollowNotificationController extends Controller
{
    public function index(){
    	return view('notifications.index');
    }
}
