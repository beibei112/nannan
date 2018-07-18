<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Votes;
use Auth;
class VotesController extends Controller
{
    public function question_votes(Request $request){
        if(Votes::where('question_id', $request -> question_id) ->where('user_id',Auth::user()->id) -> count()){
            Votes::where('question_id', $request -> question_id) ->where('user_id',Auth::user()->id)->delete();
        }else{
            Votes::create([
                'question_id'=>$request -> question_id,
                'user_id'=>Auth::user() -> id
                ]);
        }
        return Votes::where('question_id', $request -> question_id) -> count();

    }
}
