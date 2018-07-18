<?php

namespace App\Http\Controllers;

use Auth;
use App\Answer;
use Illuminate\Http\Request;
use App\Repositories\AnswerRepository;
use App\Http\Requests\AnswerRequest;

class AnswerController extends Controller
{
	protected $answerRepository;

	public function __construct(AnswerRepository $answerRepository){
		$this->answerRepository=$answerRepository;
	}

    public function store(AnswerRequest $request ,$question_id){

    	$answer = $this->answerRepository->create([
    		'user_id'=>Auth::id(),
    		'question_id'=>$question_id,
    		'body'=>$request->get('body')
    	]);

    	//更新question表的answer_count字段
    	$answer->question->increment('answers_count');

    	//更新user表的answer_count字段
    	$answer->user->increment('answers_count');
    	return back();
    }

        public function dianzan($Answer_id){
        $res = Auth::user()->followThis($Answer_id);

        $this->followRepository->follow_count($res,$Answer_id);

        return back();
    }
}
