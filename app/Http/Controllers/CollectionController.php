<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Collection;
use Auth;

class CollectionController extends Controller
{
    public function question_collection(Request $request){
        if(Collection::where('question_id', $request -> question_id) ->where('user_id',Auth::user()->id) -> count()){
            Collection::where('question_id', $request -> question_id) ->where('user_id',Auth::user()->id)->delete();
            return '1';
        }else{
        Collection::create([
            'question_id'=>$request -> question_id,
            'user_id'=>Auth::user() -> id
            ]);
        return '2';
        }
    }
}
