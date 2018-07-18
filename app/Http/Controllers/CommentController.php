<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Repositories\CommentRepository;

class CommentController extends Controller
{
    protected $comment;

    public function __construct(CommentRepository $commentRepository){

        $this->comment = $commentRepository;
    }

    //发送评论
    public function store(Request $request){
        $comment = $this->comment->create([
            'user_id'=>Auth::id(),
            'commentable_id'=>$request->get('commentable_id'),
            'commentable_type'=>'App\Question',
            'body'=>$request->get('body'),
        ]);

        if($comment){
            flash('评论成功','success');

        }else{

            flash('评论失败','error');
        }

        return back();
    }

    //话题评论
    public function storee(Request $request){
        $comment = $this->comment->create([
            'user_id'=>Auth::id(),
            'commentable_id'=>$request->get('commentable_id'),
            'commentable_type'=>'App\Topic',
            'body'=>$request->get('body'),
        ]);

        if($comment){
            flash('话题评论成功','success');

        }else{

            flash('话题评论失败','error');
        }

        return back();
    }
}
