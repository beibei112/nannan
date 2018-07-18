@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="{{asset('favicon.ico')}}">
		<title>Renda - clean blog theme based on Bootstrap</title>
		<!-- Custom styles for this template -->
		<link href="{{ asset('css/jquery.bxslider.css')}}" rel="stylesheet">
		<link href="{{ asset('css/style.css')}}" rel="stylesheet">
	</head>
	<body>
		<div class="container">
		<header>
			<a href="/"><img src="{{asset('images/logo.png')}}"></a>
		</header>
		<section>
			<div class="row">
				<div class="col-md-12">
					<article class="blog-post">
						<div class="blog-post-body">
							<h2><a href="{{action('QuestionController@topic',['id'=>$topics[0]->id])}}" style='text-decoration:none;font-size:30px;'>{{$topics[0]->name}}</a></h2>

								<a href="{{action('QuestionController@topic',['id'=>$topics[0]->id])}}">
									<img class="img-thumbnail" title="{{$topics[0]->name}}" style="width:800px;height:450px;" src=" {{$topics[0]->topic_pic}}">
								</a>
							@foreach($topics as $topic)
	        					@foreach($topic->questions as $question)
		        				<div class="blog-post-image">
								</div>
								<div class="blog-post-body">

									<h2 style="width:100%;height:100%;">
										<a href="/question/{{$question->id}}">{!! $question->title !!}</a>
									</h2>

									<div class="post-meta">
										<span>by <a href="/user/home/{{$question->user->id}}">{{$question->user->name}}</a></span>/
										<span>
											<i class="fa fa-clock-o"></i>March {{$question->created_at}}
										</span>/
										<span>
											<i class="fa fa-comment-o"></i>
											<a href="#">343</a>
										</span>/
										<span>
		                                    <a data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-book"></i></a>
		                                    <a href="/question/{{$question->id}}">{{$question->answers_count}}</a>
		                                </span>/
										<span>
											<i class="fa fa-coffee"></i>
											@foreach($question->topics as $topic)
												<a href="{{action('QuestionController@topic',['id'=>$topic->id])}}">{{$topic->name}}</a>
											@endforeach
										</span>/

										 <!-- 话题评论 -->
		                                <span>
		                                    <a title="话题评论" data-toggle="modal" data-target="#comment">
		                                    <i class="fa fa-comment-o"></i>{{count($comment)}}</a>
		                                </span>
	                                <!-- 结束 -->
									</div>
									<div style="height:400px;overflow:hidden;margin-left:180px;">
										<h1>{!! $question->body !!}</h1>
									</div>
									<div class="read-more">
										<a class="jxyd" href="javascript:(0)">Continue Reading</a>
									</div>
								</div>
							@endforeach
						@endforeach
						@if(Auth::user()->TopicUsered($topics[0]->id))
					        <button class="btn btn-warning gzht" style="width:65%;height:100%;margin-left:100px;">不再关注该话题</button>
					    @else
					        <button class="btn btn-success gzht" style="width:65%;height:100%;margin-left:100px;">点击关注该话题</button>
					    @endif
						</div>
					</article>
				</div>
			</div>
		</section>
		</div>
		<!-- /.container -->

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
				Theme made by MOOZ Themes.More Templates <a href="http://www.cssmoban.com/" target="_blank" title="Facebook">模板之家</a> - Collect from <a href="http://www.cssmoban.com/" title="论坛" target="_blank">论坛</a>
			</div>
		</footer>

		<!-- 模态框 -->
		<div class="modal fade bs-example-modal-lg"  id="mymodel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
		    <div class="modal-dialog modal-lg" role="document">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                <h4 class="modal-title" id="exampleModalLabel">答案</h4>
		            </div>
		            <div class="modal-body">
		            @foreach($topics as $topic)
		        @foreach($topic->questions as $question)
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
		                            <button type="button" class="btn-info pull-right" data-toggle="modal" data-target="#acomment" onclick='fun({{$answer->id}})'>评论</button>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        @endforeach
		        @endforeach
		        @endforeach
		            </div>
		            @if(Auth::check())

		            @else
		            <a style="margin-left:800px;" href="/login" class='btn btn-danger'>请登录</a>

		        @endif
		        </div>
		    </div>
		</div>
		<!-- End -->

		<!-- 模态框 -->
		<div id='comment' class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">话题评论</h4>
					</div>
					<div class="modal-body">
						<div class="media">
							<div class="media-body">
								<div class="media-heading">
									{!! Form::open(['url'=>'/commentpic','method'=>'post']) !!}
                    				{!! Form::hidden('commentable_id',$topic->id) !!}
	                    				<!-- 评论列表 -->
				                        @foreach($comment as $comments)
				                        <div class="media">
				                            <div class="media-left">
				                                <div class="panel panel-default" style='width:800px;'>
				                                    <div class="panel-heading">
				                                        <a href="/user/home/{{$question->user->id}}">
				                                            <img class="img-thumbnail" style="width:60px;height:60px;" src="{{$comments->user->avatar}}" alt="">
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
				                        <!-- 结束 -->
									{!!Form::submit('提交话题',['class'=>'btn btn-info btn-block'])!!}
									{!!Form::close()!!}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End -->

	</body>
</html>

@endsection

@section('js')
	<script type="text/javascript">
	    $('.jxyd').click(function(){
	        if($(this).html() == 'Continue Reading'){
	            $(this).parent().prev().css('height','auto');
	            $(this).html('Take up');
	        }else{
	            $(this).parent().prev().css('height','400px');
	            $(this).html('Continue Reading');
	        }
	    });
	</script>
	<script type="text/javascript">
	    $(".gzht").click(function(){
	        var id={{$topics[0]->id}};
	        var bt=this;
	        $.ajax({
	            url:"{{action('TopicUserController@store')}}",
	            data:{id:id},
	            type:"post",
	            success:function(str){
	                if(str==1){
	                    $(bt).html("不再关注该话题").removeClass("btn btn-success").addClass("btn btn-warning");
	                }else{
	                    $(bt).html("点击关注该话题").removeClass("btn btn-warning").addClass("btn btn-success");
	                }
	            }
	        });
	    });
	</script>
	<script type="text/javascript">
    	$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
	</script>
@endsection