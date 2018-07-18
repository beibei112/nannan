<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('api')->get('/topics', function (Request $request) {
    return App\Topic::select(['name','id'])->where('name','like','%'.$request->get('query').'%')->get();
});

Route::middleware('api')->get('/follow', function (Request $request) {

    $user = App\User::findOrFail($request->get('user'));

    foreach($user->unreadNotifications as $notification){
        if($request->get('id')== $notification->id){
            $notification->markAsRead();
        }
    }
});

//获取问题的评论数据
Route::middleware('api')->get('/question/comment', function (Request $request) {
    // echo $request->get('question_id');
    // $question = App\Question::findOrFail($request->get('question_id'));
    // dump($question->comments()->get());
    return  App\Question::with('comments','comments.user')->where('id',$request->get('question_id'))->first()->toJson();
});

//获取答案的评论
Route::middleware('api')->get('/comment/answer', function (Request $request) {

    // return App\Answer::with('comments','comments.user')->where('id',$request->get('answer_id'))->first();

    $answer = App\Answer::findOrFail($request->get('answer_id'));

    $comment = $answer->comments()->create(['user_id'=>$request->get('user_id'),'body'=>$request->get('body')]);

    return $comment->user()->first();
});
