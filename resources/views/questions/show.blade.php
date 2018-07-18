@extends('layouts.app')

@section('content')

@include('vendor.ueditor.assets')
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<!-- Bootstrap core CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<!-- Custom styles for this template -->
		<link href="{{ asset('css/jquery.bxslider.css') }}" rel="stylesheet">
		<link href="{{ asset('css/style.css') }}" rel="stylesheet">\
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/jquery.js') }}"></script>
	</head>
	<body>
		<div class="container">
    		<header>
    			<a href="/"><img src="{{ asset('images/logo.png')}}" title="首页"><a>
    		</header>
			<div class="row">
				<div class="col-md-8">
					<article class="blog-post">
						<div class="blog-post-image">
                            @foreach($question->topics as $topic)
    							<a href="{{action('QuestionController@topic',['id'=>$topic->id])}}">
                                    <img style="width:750px;height:400px;" title="{{$topic->name}}" src="{{$topic->topic_pic}}">
                                </a>
                            @endforeach
						</div>
						<div class="blog-post-body">
							<h2><a href="/question/{{$question->id}}">{{$question->title}}</a></h2>
							<div class="post-meta">
								<span>
                                    by <a href="/user/home/{{$question->user->id}}" title="名称">{{$question->user->name}}</a>
                                </span>/
								<span>
                                    <i class="fa fa-clock-o" title="时间"></i>March {{$question->created_at}}
                                </span>/
                                <!-- 评论 -->
								<span>
                                    <a data-toggle="modal" data-target="#comment"><i class="fa fa-pied-piper-alt" title="评论"></i></a>
                                    <a data-toggle="modal" data-target="#comment">{{count($question->comments)}}</a>
                                </span>/
                                <!-- End -->

                                <!-- 点赞 -->
                                <span>
                                    <a href='javascript:votes()'><i class="fa fa-hand-peace-o" title="点赞"></i></a>
                                    <a href="javascript:" id="votes_count">{{$votes_count}}</a>
                                </span>/
                                <!-- End -->

                                <!-- 答案 -->
                                <span>
                                    <a data-toggle="modal" data-target=".bs-example-modal-lg2"><i class="fa fa-book" title="答案"></i></a>
                                    <a data-toggle="modal" data-target=".bs-example-modal-lg2">{{$question->answers_count}}</a>
                                </span>/
                                <!-- End -->

                                <!-- 话题 -->
                                <span>
                                    <i class="fa fa-tags" title="话题"></i>
                                    @foreach($question->topics as $topic)
                                        <a href="{{action('QuestionController@topic',['id'=>$topic->id])}}" title="话题">{{$topic->name}}</a>
                                    @endforeach
                                </span>
                                <!-- End -->

                                <!-- 收藏 -->
                                <span>
                                    <a id="sc" href="javascript:collection()" title="收藏">收藏</a>
                                </span>

                                <!-- End -->

							</div>

							<div class="blog-post-text">
								{!!$question->body!!}
							</div>
						</div>
					</article>
				</div>
				<div class="col-md-4 sidebar-gutter">
					<aside>
                        @if(Auth::check() && Auth::user()->owns($question))
                            <div class="sidebar-title">
                                <button class="btn btn-warning" style="position:absolute;top:15px;left:220px;" type="submit"><a style="color:white;" href="/question/{{$question->id}}/edit">更改</a></button>
                                {!! Form::open(['url'=>action('QuestionController@destroy',['id'=>$question->id]),'method'=>'DELETE']) !!}
                                    {!! Form::submit('删除',['class'=>'btn btn-danger','style="margin-right:40px;"']) !!}
                                {!! Form::close() !!}
                            </div>
                        @endif

    					<!-- sidebar-widget -->
    					<div class="sidebar-widget">
    						<h3 class="sidebar-title">About Me</h3>
    						<div class="widget-container widget-about">
    							<a href="/user/home/{{$question->user->id}}" title="点击查看"><img style="width:350px;height:300px;" src="{{$question->user->avatar}}" alt=""></a>
    							<a href="/user/home/{{$question->user->id}}"><h4>{{$question->user->name}}</h4></a>

                            @if(Auth::check()&&(Auth::id()!=$question->user->id))
                                <a style="margin-left:110px;" href="/question/{{$question->id}}/answer" class='btn btn-default
                                    {{Auth::check() && Auth::user()->followed($question->id) ? "btn btn-success":""}}
                                '>
                                {{Auth::check() && Auth::user()->followed($question->id) ? '已关注':'点击关注'}}
                                </a>
                            @endif

                            @if(Auth::check())
                                @if(Auth::check()&&(Auth::id()!=$question->user->id))
                                    <a href="/follow/{{$question->user->id}}/user" class='btn btn-default
                                    {{Auth::check() &&Auth::user()->followed_user($question->user->id) ? "btn-success": "" }}
                                    '>{{Auth::check()&&Auth::user()->followed_user($question->user->id) ? '已关注' : '关注他'}}</a>
                                    <div class="author-title" style="margin-left:30px;">问题↑ &nbsp;&nbsp;&nbsp;&nbsp; 用户↑</div>
                                   <p>大家好，我叫{{$question->user->name}},请大家多多关照。</p>
                                @else
                                    <div class="author-title">Designer</div>
                                    <p>While everyone’s eyes are glued to the runway, it’s hard to ignore that there are major fashion moments on the front row too.</p>

                                @endif

                            @else
                                <a href="/login" style="margin-left:130px;" class='btn btn-default
                                    {{Auth::check() &&Auth::user()->followed_user($question->user->id) ? "info": "" }}
                                '>{{Auth::check()&&Auth::user()->followed_user($question->user->id) ? '已关注' : '关注他'}}</a>
                                <div class="author-title">Designer</div>
                                <p>While everyone’s eyes are glued to the runway, it’s hard to ignore that there are major fashion moments on the front row too.</p>
                            @endif

                            </div>
    					</div>
    					<!-- sidebar-widget -->

    					<div class="sidebar-widget">
    						<h3 class="sidebar-title">相关问题</h3>
                            <div class="widget-container">
                                @foreach($topic->questions as $q)
                                    @if($q->id!=$question->id)
        							<article class="widget-post">
                                        <div class="post-image">
                                            <a href="/question/{{$q->id}}">
                                                <img src="{{$topic->topic_pic}}" alt="">
                                            </a>
                                        </div>
                                        <div class="post-body">
                                            <h2><a href="/question/{{$q->id}}">{!! $q->title !!}</a></h2>
                                            <div class="post-meta">
                                                <span><i class="fa fa-clock-o"></i> {{$q->created_at}}</span> <span><a href="/question/{{$q->id}}"><i class="fa fa-comment-o"></i> {{count($q->answers)}}</a></span>
                                            </div>
                                        </div>
                                    </article>
                                    @endif
                                @endforeach
                            </div>
    					</div>
    					<!-- sidebar-widget -->
    					<div class="sidebar-widget">
    						<h3 class="sidebar-title">其他话题</h3>
    						<div class="widget-container">
    							<ul>
                                    @foreach($topics as $v)
                                        @if($v->id!=$topic->id)
        								    <li><a style="color:#8a6d3b;" href="{{action('QuestionController@topic',['id'=>$v->id])}}">{{$v->name}}</a></li>
                                        @endif
                                    @endforeach
    							</ul>
    						</div>
    					</div>
                    </aside>
				</div>
			</div>
		</div>
		</div><!-- /.container -->
        <!-- 小图标 -->
		<footer class="footer">

			<div class="footer-socials">
				<a href="#"><i class="fa fa-facebook"></i></a>
				<a href="#"><i class="fa fa-twitter"></i></a>
				<a href="#"><i class="fa fa-instagram"></i></a>
				<a href="#"><i class="fa fa-google-plus"></i></a>
				<a href="#"><i class="fa fa-dribbble"></i></a>
				<a href="#"><i class="fa fa-reddit"></i></a>
			</div>

			<div class="footer-bottom">
				<i class="fa fa-copyright"></i> Copyright 2015. All rights reserved.<br>
				Theme made by MOOZ Themes.More Templates <a href="http://www.cssmoban.com/" target="_blank">Facebook</a> - Collect from <a href="http://www.cssmoban.com/" title="Facebook" target="_blank">论坛</a>
			</div>
		</footer>
        <!-- end -->


        <!-- 模态框 -->
        <div class="modal fade bs-example-modal-lg2"  id="mymodel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">答案</h4>
                    </div>
                    <div class="modal-body">
                    @foreach($question->answers as $answer)
                        <div class="media">
                            <div class="media-left">
                                <div class="panel panel-default" style='width:850px;'>
                                    <div class="panel-heading">

                                        <a href="/user/home/{{$question->user->id}}">
                                            <img style='margin:left;' src="{{$answer->user->avatar}}" width='45px' height='45px;' class="img-circle">
                                        </a>
                                        <a href="/user/home/{{$question->user->id}}" style='text-decoration:none;'>
                                            {{$answer->user->name}}
                                        </a>
                                    </div>

                                    <div class="panel-body">
                                        <span style='width:30%;'>{!! $answer->body !!}</span>
                                        <button type="button" class="btn-info pull-right" data-toggle="modal" data-target="#acomment" onclick="fun({{$answer->id}})">评论</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- 回复答案编辑 -->
                    @if(Auth::check())
                        {!!Form::open(['url'=>'/question/answer/'.$question->id,'method'=>'post'])!!}

                            <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">

                                <!--百度编辑器开始-->
                                <script id="container" name="body" style='height:200px' type="text/plain">
                                       {!! old('body') !!}
                                </script>
                                <!--百度编辑器结束-->

                                @if ($errors->has('body'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif

                            </div>

                    <!-- End -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        {!!Form::submit('提交答案',['class'=>'btn btn-primary'])!!}
                    </div>
                    {!!Form::close()!!}
                    @else

                    <a style="margin-left:800px;" href="/login" class='btn btn-danger'>请登录</a>

                @endif
                </div>
            </div>
        </div>
        <!-- End -->

        <!-- 评论问题 modal -->
        <div id='comment' class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    {!! Form::open(['url'=>'/comment','method'=>'post']) !!}
                    {!! Form::hidden('commentable_id',$question->id) !!}

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">评论</h4>
                    </div>

                    <div class="modal-body">

                        <!-- 评论列表 -->
                        @foreach($comment as $comments)
                        <div class="media">
                            <div class="media-left">
                                <div class="panel panel-default" style='width:750px;'>
                                    <div class="panel-heading">
                                        <a href="/user/home/{{$question->user->id}}">
                                            <img class="img-thumbnail" style="width:50px;height:50px;" src="{{$comments->user->avatar}}" alt="">
                                        </a>
                                        <a href='/user/home/{{$question->user->id}}' style='text-decoration:none;'>
                                            {{$comments->user->name}}
                                        </a>
                                    </div>

                                    <div class="panel-body">
                                        <span style='font-size:13px;'>{{ $comments->body}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <!-- End -->

                        <!-- 评论内容 -->
                        @if(Auth::check())
                        <div class="form-group">
                            <label for="message-text" class="control-label">评论内容:</label>
                            <textarea name="body" class="form-control" id="message-text"></textarea>
                        </div>
                        @endif

                    </div>

                    <div class="modal-footer">
                        @if(Auth::check())
                        <button type="submit" class="btn btn-primary">提交</button>
                        @else
                            <a href="/login" class='btn btn-info'>请登录</a>
                        @endif
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <!-- End -->

        <!-- 答案评论 -->
        <div id='acomment' class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <input type="hidden" name='commentable_id' value='' id='answer'>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">答案评论</h4>
                    </div>
                    <div class="modal-body">

                        <!--评论列表-->
                        <div class="modal-body" id='com'>

                        </div>

                        <div class="form-group">
                            <label for="message-text" class="control-label">内容:</label>
                            <textarea name='body' class="form-control" id="anscom"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        @if(Auth::check())
                            <button type="submit" class="btn btn-primary" id='acomm'>发表</button>
                        @else
                             <a href="/login" class='btn btn-success btn-block'>请登录</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- 结束 -->

	</body>
</html>
@endsection

@section('js')
<!-- 百度编辑器js -->
<script type="text/javascript">
    var ue = UE.getEditor('container', {
        toolbars: [
            ['bold', 'italic', 'underline', 'strikethrough', 'blockquote', 'insertunorderedlist', 'insertorderedlist', 'justifyleft','justifycenter', 'justifyright',  'link', 'insertimage', 'fullscreen']
            ],
            elementPathEnabled: false,
            enableContextMenu: false,
            autoClearEmptyNode:true,
            wordCount:false,
            imagePopup:false,
            autotypeset:{ indent: true,imageBlockLine: 'center' }
    });
        ue.ready(function() {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
             $("#edui42_state").click(function(){
              //手动关闭模态框
               $("#mymodel").modal('hide');
            })

             $(document).on('click',"#edui40_body",function(){
                $("#mymodel").modal('show');
             })
        });
</script>
<!-- End -->
<script>
    var answer_id;

    function fun(aid){

        answer_id=aid;

        $('#answer').attr('value',aid);

    }

    // 回复回答的js
    $('#acomm').click(function(){

        var body = $('#anscom').val();

        $.ajax({

            url:'/api/comment/answer',
            data:{'answer_id':answer_id,'body':body,'user_id':{{Auth::id()}}},
            type:'get',
            datatype:'json',
            success:function(mes){

                var dd = `<div class="row">
                            <div class="col-md-10  col-md-offset-1">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                    <a href='/user/home/{{$question->user->id}}'><img src="${mes.avatar}" alt="" width="40px"></a>
                                        <b>来自：<a href='/user/home/{{$question->user->id}}'>${mes.name}</a></b>
                                        <span class="pull-right">just now</span>
                                    </div>

                                    <div class="panel-body">
                                       ${body}
                                    </div>
                                </div>
                            </div>
                        </div>`;

                $(dd).prependTo('#com');
            }
        });
            return false;
    });
    //End
</script>
<!-- 点赞 -->
<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    function votes(){
        $.ajax({
            url:"{{url('/question_votes')}}",
            type:'post',
            data:{
                question_id:{{$question->id}}
            },
            success:function(r){
                $('#votes_count').html(r);
            },
            error:function(){
                alert('点赞失败');
            }
        })
    }
</script>
<!-- 结束 -->
<!-- 收藏 -->
<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    function collection(){
        $.ajax({
            url:"{{url('/question_collection/')}}",
            type:'post',
            data:{
                question_id:{{$question->id}}
            },
            success:function(r){
                if(r =='2'){

                $('#sc').html('已收藏');
                }else{

                $('#sc').html('收藏');
                }
            },
            error:function(){
                alert('收藏失败');
            }
        })
    }
</script>
<!-- 结束 -->
@endsection