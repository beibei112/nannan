@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<link href="{{ asset('css/style.css') }}" rel="stylesheet">
	</head>
	<body>
		<div class="container">
			<header>
				<a href="/"><img src="{{asset('images/logo.png')}}"></a>
			</header>
			<!-- 轮播图 -->
			<section class="main-slider">
				<ul class="bxslider">
					@foreach($topics as $topic)
						<a href="{{action('QuestionController@topic',['id'=>$topic->id])}}" title="进入话题"><li><div class="slider-item"><img style="width:1140px;height:500px;" src="{{$topic->topic_pic}}" title="进入话题" /><h2>{{$topic->name}}</h2></div></li></a>
					@endforeach
				</ul>
			</section>
			<!-- 结束 -->
			<section>
				<div class="row">
					<div class="col-md-8">
						@foreach($questions as $question)
							<!-- article 第一块 -->
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
										</span>

									</div>
									<div style="height:400px;overflow:hidden;">
										<h1>{!! $question->body !!}</h1>
									</div>
									<div class="read-more">
										<a class="jxyd" href="javascript:(0)">Continue Reading</a>
									</div>
								</div>
							</article>
							<!-- End -->
						@endforeach
					</div>


					<!-- 关于我 -->
					<div class="col-md-4 sidebar-gutter">
						<aside>
							@if(Auth::check())

								<div class="sidebar-widget">
									<h3 class="sidebar-title">About Me</h3>
									<div class="widget-container widget-about">
										<a href="/user/home/{{Auth::user()->id}}" title="点击进入">
											<img style="width:359px;height:325px;" src="{{Auth::user()->avatar}}" alt="">
										</a>

										<a href="/user/home/{{Auth::user()->id}}">
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

							<!-- 全部话题 -->
							<div class="sidebar-widget">
								<h3 class="sidebar-title">全部话题</h3>
								<div class="widget-container">
									<ul>
										@foreach($topics as $topic)
											<li><a href="{{action('QuestionController@topic',['id'=>$topic->id])}}">{{$topic->name}}</a></li>
										@endforeach
									</ul>
								</div>
							</div>
						</aside>
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
				Theme made by MOOZ Themes.More Templates <a href="http://www.cssmoban.com/" target="_blank" title="Facebook">Facebook官方论坛</a> - Collect from <a href="http://www.cssmoban.com/" title="Facebook" target="_blank">论坛</a>
			</div>
		</footer>
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
@endsection