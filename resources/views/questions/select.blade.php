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
		<title>Renda - clean blog theme based on Bootstrap</title>
		<!-- Bootstrap core CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<!-- Custom styles for this template -->
		<link href="{{ asset('css/style.css') }}" rel="stylesheet">
	</head>
	<body>


		<div class="container">
		<header>
			<a href="/"><img src="{{asset('images/logo.png')}}"></a>
		</header>
		<section>
			<div class="row">
				<div class="col-md-8">
					@foreach($questions as $question)
						<article class="blog-post">
							@foreach($question->topics as $topic)
								<div class="blog-post-image">
									<a href="{{action('QuestionController@topic',['id'=>$topic->id])}}"><img style="width:750px;height:400px;" title="{{$topic->name}}" src="{{$topic->topic_pic}}" alt=""></a>
								</div>
							@endforeach
							<div class="blog-post-body" style="width:100%;height:100%;">
									<h2>
										<a href="/question/{{$question->id}}">{!! $question->title !!}</a>
									</h2>
									<div class="post-meta">
										<span title="名称">by <a href="/user/home/{{$question->user->id}}">{{$question->user->name}}</a></span>/
										<span title="时间">
											<i class="fa fa-clock-o"></i>March {{$question->created_at}}
										</span>/

										<span title="评论问题">
											<i class="fa fa-pied-piper-alt"></i>
											<a href="/question/{{$question->id}}">{{count($question->comments)}}</a>
										</span>/

										<span title="回答问题">
		                                    <a href="/question/{{$question->id}}"><i class="fa fa-book"></i></a>
		                                    <a href="/question/{{$question->id}}">{{$question->answers_count}}</a>
		                                </span>/

										<span title="话题">
											<i class="fa fa-tags"></i>
											@foreach($question->topics as $topic)
												<a href="{{action('QuestionController@topic',['id'=>$topic->id])}}">{{$topic->name}}</a>
											@endforeach
										</span>/
										<!-- 收藏 -->
		                                <span>
		                                    <a id="sc" href="javascript:collection()" title="收藏">收藏</a>
		                                </span>
		                                <!-- 结束 -->
									</div>
									<div style="height:400px;overflow:hidden;">
										<h1>{!! $question->body !!}</h1>
									</div>
									<div class="read-more">
										<a class="jxyd" href="javascript:(0)">Continue Reading</a>
									</div>
								</div>
						</article>
					@endforeach
				</div>

				<!-- 关于我 -->
					<div class="col-md-4 sidebar-gutter">
						<aside>
							@if(Auth::check())

								<div class="sidebar-widget">
									<h3 class="sidebar-title">About Me</h3>
									<div class="widget-container widget-about">
										<a href="/user/home/{{$question->user->id}}" title="点击进入">
											<img style="width:359px;height:325px;" src="{{Auth::user()->avatar}}" alt="">
										</a>

										<a href="/user/home/{{$question->user->id}}">
											<h4>{{Auth::user()->name}}</h4>
										</a>
										<div class="author-title">Designer</div>
										<h4>大家好，我叫{{Auth::user()->name}},请大家多多关照.</h4>
									</div>
								</div>

							@else

								<div class="sidebar-widget">
									<h3 class="sidebar-title">About Me</h3>
									<div class="widget-container widget-about">
										<a href="/"><img src="{{ asset('images/author.jpg')}}" alt=""></a>
										<a href="/login"><h4>请登录</h4></a>
										<div class="author-title">Designer</div>
										<p>当每个人的眼睛都贴在跑道上时，很难忽视前排也有一些时尚的时刻。</p>
									</div>
								</div>

							@endif
						</aside>
					</div>
			</div>
		</section>
		</div><!-- /.container -->

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
				Theme made by MOOZ Themes.More Templates <a href="http://www.cssmoban.com/" target="_blank">Facebook</a> - Collect from <a href="/" target="_blank">论坛</a>
			</div>
		</footer>

		<!-- Bootstrap core JavaScript
			================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
	</body>
</html>
@endsection

@section('js')
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