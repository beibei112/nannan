<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//直接调用退出登录 return redirect('/logout');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/home', 'HomeController@index')->name('home');

//激活用户邮箱
Route::get('/verify/{id}/{token}','EmailController@verify');

//主页
Route::get('/','QuestionController@index');

//问题资源控制器
Route::resource('question','QuestionController');

//提交问题的路由
Route::post('/question/answer/{question_id}','AnswerController@store');

//关注问题
Route::get('/question/{question_id}/answer','FollowController@store');

//点赞
Route::post('/question_votes/','VotesController@question_votes');

//关注用户
Route::get('/follow/{user_id}/user','FollowUserController@store');

//收藏问题
Route::post('/question_collection/','CollectionController@question_collection');

//读取消息通知
Route::get('/notification','UserFollowNotificationController@index');

//用户中心
Route::get('/user/home/{user_id}','UserController@index');

//编辑信息
Route::post('/user/data','UserController@update');

//保存私信
Route::post('/message','MessageController@store');

//私信聊天
Route::get('/message/show/{id}','MessageController@show');

//保存评论
Route::post('/comment','CommentController@store');

//话题评论
Route::post('/commentpic','CommentController@storee');

//上传头像
Route::get('/user/avatar', 'UserController@avatar');

//保存图片路由
Route::post('/user/avatar', 'UserController@changeAvatar');

//redis
Route::get('/test',function(){
    $data = App\Question::with('comments','comments.user')->where('id',1)->first();
    return $data;
});

//搜索路由
Route::post('question/select','QuestionController@select');

//显示话题
Route::get('/question/topics/{id}','QuestionController@topic');

//话题广场
Route::get('/topics/show','TopicUserController@show');

//添加话题
Route::post('/topics/show','TopicUserController@add');

//资源路由
Route::resource('/topic','TopicUserController');

//更改密码ajax。
Route::post('/home/index/mimaajax','UserController@mimaajax');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
