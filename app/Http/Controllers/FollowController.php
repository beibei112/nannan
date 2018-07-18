<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Repositories\FollowRepository;

class FollowController extends Controller
{
    protected $followRepository;

    public function __construct(FollowRepository $followRepository){
        $this->middleware('auth');

        $this->followRepository = $followRepository;
    }

    public function store($question_id){
        $res = Auth::user()->followThis($question_id);

        $this->followRepository->follow_count($res,$question_id);

        return back();
    }
}
