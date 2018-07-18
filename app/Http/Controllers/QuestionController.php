<?php

namespace App\Http\Controllers;

use Auth;
use App\Votes;
use App\User;
use App\Topic;
use App\Comment;
use App\Answer;
use App\Question;
use App\Collection;
use Illuminate\Http\Request;
use App\Http\Requests\QuestionRequest;
use App\Repositories\CommentRepository;
use App\Repositories\QuestionRepository;

class QuestionController extends Controller
{
    protected $questionRepository;
    // protected $commentRepository;
    //构造函数
    public function __construct(QuestionRepository $questionRepository){
        $this->middleware('auth')->except(['index','show']);
        $this->questionRepository = $questionRepository;

    }
    /**
     * Display a listing of the resource.
     * 主页.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = $this->questionRepository->getAllQuestions();
        $topics = Topic::get();
        return view('questions.index',compact('questions','topics','votes_count'));
        // return view('questions.index');
    }

    /**
     * Show the form for creating a new resource.
     * 跳转创建问题页面.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('questions.create');
    }

    /**
     * Store a newly created resource in storage.
     * 创建问题.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request)
    {

        $arr = $this->questionRepository->deal($request->get('topics'));

        $data = array_merge($request->all(),['user_id'=>Auth::id()]);

        $question = $this->questionRepository->create($data);

        // 关联关系表数据
        $question->topics()->attach($arr);

        // 插入user_question Follw表中的关联关系
        $this->questionRepository->follow($question->id);

        return redirect()->action('QuestionController@show',['id'=>$question->id]);
    }

    //根据form提交的topics数组,如果是number 不需要添加新的topics表数据,如果是string就需要插入topics表,并返回对应的id
    public function deal($topics){

        return collect($topics)->map(function($topic){
            if(is_numeric($topic)){

                //让标签的questions_count字段自增。
                Topic::findOrFail($topic)->increment('questions_count');
                return $topic;
            }else{

                //插入topics表数据
                $topic = Topic::create(['name'=>$topic,'questions_count'=>1]);
                return $topic->id;
            }
        })->toArray();
    }

    /**
     * Display the specified resource.
     * 问题页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = $this->questionRepository->byIdWithTopicsAndAnswers($id);
        $comment = Comment::where('commentable_id',$id)->get();
        $votes_count = Votes::where('question_id',$question->id)->count();
        $topic = $question->topics[0];
        $topics = Topic::get();

        return view('questions.show',compact('question','comment','topic','topics','votes_count'));
    }

    /**
     * Show the form for editing the specified resource.
     * 跳转到更改页面并给上已有参数
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = $this->questionRepository->byId($id);

        // $user = User::where('id','1')->first();
        if(Auth::user()->owns($question)){
            return view('questions.edit',compact('question'));
        }else{
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     * 更改问题
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $question = $this->questionRepository->byId($id);
        $question->update([
            'title'=>$request->get('title'),
            'body'=>$request->get('body')
        ]);

        $arr = $this->questionRepository->deal($request->get('topics'));

        //关联关系表数据
        $question->topics()->sync($arr);

        return redirect()->action('QuestionController@show',['id'=>$question->id]);
    }

    /**
     * Remove the specified resource from storage.
     * 删除问题
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $question = $this->questionRepository->byId($id);

        //判断是否为作者
        if(Auth::user()->owns($question)){
            $question->delete();
            $this->questionRepository->unfollow($question->id);
            return redirect('/question');
        }

        return back();
    }

    //搜索
    public function select(Request $request){

        // if(!$request->get('title')){
        //     return redirect()->action("QuestionController@index");
        // }
        // //按标题搜索查询
        // $questions = Question::where('title','like','%'.$request->get('title').'%')->get();
        // //按名字搜索查询
        // $topics = Topic::where('name','like','%'.$request->get('title').'%')->with('questions')->first();
        // //把数据传到模板
        // return view('questions.select',compact('questions','topics'));
        $topic = Topic::where('name','like','%'.$request->get('title').'%')->first();

        if($topic){
            return redirect()->action('QuestionController@topic',['id'=>$topic['id']]);
        }else{

            $name = User::where('name','like','%'.$request->get('title').'%')->first();
            $questions = Question::latest()->where('title','like','%'.$request->get('title').'%')->orWhere('user_id',$name['id'])->get();

            $user_id = Auth::id();
            return view('questions.select',compact('questions','user_id','topic'));
        }
    }

    /**
     * 话题.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function topic($id){
        $topics = Topic::with('questions')->where('id',$id)->get();
        $comment = Comment::where('commentable_id',$id)->get();
        return view('questions.topic',compact('topics','comment'));

    }
}
