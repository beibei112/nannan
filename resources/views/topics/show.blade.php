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
		<link rel="icon" href="favicon.ico">
		<!-- Custom styles for this template -->
		<link href="{{ asset('css/jquery.bxslider.css')}}" rel="stylesheet">
		<link href="{{ asset('css/style.css')}}" rel="stylesheet">
	</head>
	<body>
		<div class="container">
		<header>
			<a href="/"><img src="{{ asset('images/logo.png')}}"></a>

		</header>

		<section>
			<div class="row">
				<div class="col-md-12">
					<a title="发布话题" style="margin-left:550px;position:relative;bottom:20px;" class="fa fa-asl-interpreting" data-toggle="modal" data-target="#topic"></a>


					@foreach($topic as $topics)
					<div class="panel-body2" style="float:left;width:100%;">
	                    <article class="widget-post">
	                        <div class="post-image">
	                            <a title="点击查看" href="{{action('QuestionController@topic',['id'=>$topics->id])}}"><img style="width:90px;height:50.63px;margin-left:260px;" src="{{$topics->topic_pic}}" /></a>
	                        </div>
	                        <div class="post-body">
	                            <h2 style="margin-left: 260px;"><a href="{{action('QuestionController@topic',['id'=>$topics->id])}}">{{$topics->name}}</a></h2>
	                            <div class="post-meta">
	                                <span title="时间" style="margin-left: 260px;">
	                                    <i class="fa fa-clock-o"></i> {{$topics->created_at}}
	                                </span>
	                                <span>
	                                    <a title="话题下的文章" href="{{action('QuestionController@topic',['id'=>$topics->id])}}"><i class="fa fa-clone"></i> {{$topics->questions_count}}</a>
	                                </span>
	                                @if(Auth::user()->TopicUsered($topics->id))
		                                <button class="btn btn-warning gzht" style="float:right;margin-top:20px;position:relative;bottom:40px;right:50px;" topicid="{{$topics->id}}">不再关注该话题
		                                </button>
		                            @else
		                            	<button class="btn btn-success gzht" style="float:right;margin-top:20px;position:relative;bottom:40px;right:50px;" topicid="{{$topics->id}}">点击关注该话题
		                                </button>
		                            @endif
	                            </div>
	                        </div>
	                    </article>
	                </div>
	                @endforeach

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
				Theme made by MOOZ Themes.More Templates <a href="http://www.cssmoban.com/" target="_blank">Facebook</a> - Collect from <a href="http://www.cssmoban.com/" target="_blank">论坛</a>
			</div>
		</footer>

		<!-- 模态框 -->
		<div id='topic' class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">发布话题</h4>
					</div>
					<div class="modal-body">
						<div class="media">
							<div class="media-body">
								<div class="media-heading">
									{!!Form::open(['url'=>action('TopicUserController@add'),'method'=>'post','files'=>true])!!}

									<div class="form-group">
									{!! Form::label('name','话题名称')!!}
									{!! Form::text('name',null,['class'=>'form-control','placeholer'=>'请输入话题名称','required'=>'required']) !!}
									</div>
									<div class="form-group">
									{!! Form::label('desc','话题描述')!!}
									{!! Form::text('desc',null,['class'=>'form-control','placeholer'=>'请输入话题话题描述','required'=>'required']) !!}
									</div>
									<div class="form-group">
									{!! Form::label('title','话题图片')!!}
									{!! Form::file('avatar') !!}
									</div>
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
	    $(".gzht").click(function(){
	        var id=$(this).attr('topicid');
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

