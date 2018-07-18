@extends('layouts.app')

@section('content')
@if($user->is_active==1)
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <link rel="icon" type="image/icon" href="{{asset('assets/images/tabicon.ico')}}">

        <link href="{{asset('assets/css/font-awesome.min.css')}}" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css?family=Crimson+Text:400,700,700i|Josefin+Sans:700" rel="stylesheet">
        <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    </head>

    <body>
        <!-- 主页 starts here -->
        <div id="index">
            <div class="container main">
                <div class="row home">
                    <div id = "index_left" onclick="func()" class="col-md-6 left">
                        <img class="img-responsive img-rabbit" style="width:611px;height:565px;" src="{{$user->avatar}}">
                    </div>
                    <div id = "index_right" class="col-md-6 text-center right">
                        <div class="logo" style="background-image:url('{{$information->user_img}}');background-size:100% 100%;">
                            <a style="margin-left:480px;position:relative;bottom:90px;right:10px;" onclick="fun()">编辑背景图片</a>
                            <img class="img-circle" onclick="func()" style="width:61px;height:61px;" src="{{$user->avatar}}">
                            <h4 style="color:yellow;">I am {{$user->name}}</h4>
                            <span>
                                @if($information->sex==0)
                                    <div style="color:blue;">boy♂</div>
                                @else
                                    <div style="color:red;">girl♀</div>
                                @endif
                            </span>
                        </div>

                        <p class="home-description">
                            Hi，我是{{$user->name}}，来自{{$information->school}}的Web开发人员，我对设计，开发和互动充满热情。我真的很喜欢我做的事。

                        </p>

                        <div class="btn-group-vertical custom_btn animated slideinright slideinright">
                            <div id="about" class="btn btn-rabbit">关于我</div>
                            <div id="work" class="btn btn-rabbit">我的动态</div>
                            @if(Auth::user()->id==$user->id)
                            <div id="contact" class="btn btn-rabbit">个人信息</div>
                            @endif
                        </div>

                        <div class="social">
                            <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                            <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 主页 ends here -->

        <!-- 关于我  -->
        <div id="about_scroll" class="pages ">
            <div class="container main">
                <div class="row">
                    <div class="col-md-6 left" id="about_left">
                        <img class="img-responsive img-rabbit" style="width:611px;height:565px;" src="{{$user->avatar}}">
                    </div>

                    <div class="col-md-6 right" id="about_right">
                        <a href="#" class="btn btn-rabbit back"> <i class="fa fa-angle-left" aria-hidden="true"></i> 返回主页 </a>
                        <div id="watermark">
                            <h2 class="page-title" text-center>关于我</h2>
                            <div class="marker">About</div>
                        </div>
                        @if(Auth::user()->id==$user->id)
                        <button class="btn btn-rabbit genggai" style="position:absolute;bottom:440px;right:40px;">更改密码</button><br>
                        @endif
                        <div id="mima1" style='display:none;position:absolute;bottom:420px;right:40px;'>
                            旧密码：<input id="jiumima" type="" name=""><span style="position:absolute;" id="tishi1"></span><br>
                            <span style="position:absolute;" id='xinmima'>

                            </span>
                        </div>

                        <p class='subtitle'>Hi,我是{{$user->name}}。在中国设立的自由网页设计师，前端开发人员和数字策划师.
                        </p>

                        @if($information->school=='')
                            <p class="info">
                                所在学校：未填写
                            </p>
                        @else
                            <p class="info">
                                所在学校：{{$information->school}}
                            </p>
                        @endif

                        @if($information->height=='')
                            <p class="info">
                                身高：未填写
                            </p>
                        @else
                            <p class="info">
                                身高：{{$information->height}}cm
                            </p>
                        @endif

                        @if($information->weight=='')
                            <p class="info">
                                体重：未填写
                            </p>
                        @else
                            <p class="info">
                                体重：{{$information->weight}}kg
                            </p>
                        @endif

                        @if($information->phone=='')
                            <p class="info">
                                电话：未填写
                            </p>
                        @else
                            <p class="info">
                                电话：{{$information->phone}}
                            </p>
                        @endif

                        @if($information->girlfriend=='')
                            <p class="info">
                                有没有女朋友：未填写
                            </p>
                        @else
                            <p class="info">
                                有没有女朋友：{{$information->girlfriend}}
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- 关于我结束 -->

        <!-- 我的活动 starts here -->
        <div id="work_scroll" class="pages">
            <div class="container main">
                <div class="row">
                    <div class="col-md-6" id="work_left">
                        <div id="owl-demo" class="owl-carousel owl-theme">
                            <div class="item"><img class="img-responsive img-rabbit" style="width:611px;height:565px;" src="{{$user->avatar}}"></div>
                        </div>
                    </div>

                    <div class="col-md-6" id="work_right">
                        <a href="#" class="btn btn-rabbit back"> <i class="fa fa-angle-left" aria-hidden="true"></i> 返回主页 </a>
                        <div id="watermark">
                            <h2 class="page-title" text-center>我的动态</h2>
                            <div class="marker">Activity</div>
                        </div>
                        <p class='subtitle'>近期参与过的问题。
                        </p>
                        <p class="info">
                            <h4>我的提问({{count($user->questions)}})</h4><h4><a data-toggle="modal" data-target=".bs-example-modal-lg" >查看</a></h4>
                        </p>

                        <p class="info">
                            <h4>我的({{count($user->answers)}})</h4> <h4><a data-toggle="modal" data-target=".bs-example-modal-lg1">查看</a></h4>
                        </p>

                        <p class="info">
                            <h4>关注问题({{count($user->follows)}})</h4> <h4><a data-toggle="modal" data-target=".bs-example-modal-lg2">查看</a></h4>
                        </p>

                        <p class="info">
                            <h4>关注话题({{count($user->UserTopic)}})</h4> <h4><a data-toggle="modal" data-target=".bs-example-modal-lg3">查看</a></h4>
                        </p>

                        <p class="info">
                            <h4>我的收藏</h4> <h4><a data-toggle="modal" data-target=".bs-example-modal-lg5">查看</a></h4>
                        </p>

                        <p class="info">
                            <h3>粉丝</h3> <h4><a data-toggle="modal" data-target=".bs-example-modal-lg4">查看</a></h4>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- 我的活动 ends here  -->

        <!-- 个人信息 starts here -->
        <div id="contact_scroll" class="pages">
            <div class="container main">
                <div class="row">
                    <div class="col-md-6 left" id="contact_left">
                        <img style="height:565px;" onclick="func()" class="img-responsive img-rabbit" src="{{$user->avatar}}">
                    </div>

                    <div class="col-md-6 right" id="contact_right">
                        <a href="#" class="btn btn-rabbit back">
                            <i class="fa fa-angle-left" aria-hidden="true">

                            </i>
                            返回主页
                        </a>
                        <div id="watermark">
                            <h2 class="page-title" text-center>个人信息</h2>
                            <div class="marker">Data</div>
                        </div>
                        <p class='subtitle'>更改我,让我更加了解你。
                        </p>
                        <!-- form -->
                        {!!Form::open(['url'=>action('UserController@update'),'method'=>'post'])!!}

                        {!! Form::hidden('user_id',$user->id) !!}

                        <div class="form-group">
                            <span>性别：</span>
                            <label class="control-label">
                            @if($information->sex==0)
                                <input type="radio" name="sex" value='0' checked/>男
                                <input type="radio" name="sex" value='1' />女
                            @else
                                <input type="radio" name="sex" value='0' />男
                                <input type="radio" name="sex" value='1' checked/>女
                            @endif
                            </label>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="exampleInputEmail1" disabled value='{!! $user->name !!}'>
                        </div>

                        <div class="form-group">
                            <input type="text" name='school' class="form-control" id="exampleInputEmail1" value='{!! $information->school !!}' placeholder="School">
                        </div>

                        <div class="form-group">
                            <select name="height" class="form-control" placeholder="身高" required="required">
                                @if($information->height=='')
                                    <option selected="selected" value="">--请选择身高-- </option>
                                @else
                                    <option value="{!! $information->height !!}">{!! $information->height !!}cm</option>
                                @endif
                                <option value="155">155cm</option>
                                <option value="160">160cm</option>
                                <option value="165">165cm</option>
                                <option value="170">170cm</option>
                                <option value="175">175cm</option>
                                <option value="180">180cm</option>
                                <option value="185">185cm</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <select name="weight" class="form-control" placeholder="体重" required="required">
                                @if($information->weight=='')
                                    <option selected="selected" value="">--请选择体重-- </option>
                                @else
                                    <option value="{!! $information->weight !!}">{!! $information->weight !!}公斤</option>
                                @endif

                                <option value="45">45公斤</option>
                                <option value="50">50公斤</option>
                                <option value="55">55公斤</option>
                                <option value="60">60公斤</option>
                                <option value="65">65公斤</option>
                                <option value="70">70公斤</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="text" name='phone' class="form-control" id="exampleInputEmail1" value='{!! $information->phone !!}' placeholder="Phone" maxlength="12" required="required">
                        </div>

                        <div class="form-group">
                            <select name="girlfriend" class="form-control" placeholder="Girlfriend" required="required">
                                @if($information->girlfriend=='')
                                    <option selected="selected" value="">--请选择是否单身-- </option>
                                @else
                                    <option value="{!! $information->girlfriend !!}">{!! $information->girlfriend !!}</option>
                                @endif
                                <option value="yes">yes</option>
                                <option value="no">no</option>
                            </select>
                        </div>
                        {!! Form::submit('更改',['class'=>'btn btn-rabbit submit']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            <footer class="text-center">
                <div class="container bottom">
                    <div class="row">
                        <div class="col-sm-12">
                            <p>Made with <i class="fa fa-heartbeat" aria-hidden="true"></i> by <a href="#">Themewagon</a> More Templates <a href="http://www.cssmoban.com/" target="_blank" title="Facebook">Facebook</a> - Collect from <a href="http://www.cssmoban.com/" title="论坛" target="_blank">论坛</a></p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- 个人信息 ends here -->

        <!-- 表单开始 -->
        <div style="display:none">
            {{--上传头像表单--}}
            {!! Form::open(['method'=>'post','url'=>'/user/avatar', 'files'=>true]) !!}
            {{--Avatar 上传--}}
            {!! Form::file('avatars',['id'=>'file','onchange'=>'funcc()']) !!}
            {!! Form::hidden('type','',['id'=>'hidden'])!!}
            <!-- 提交 -->
            {!! Form::submit('更换头像',['class' => 'btn btn-primary pull-left','id'=>'sub']) !!}
            {!! Form::close() !!}
        </div>
        <!-- End -->

        <!-- 第一个模态框————提问 -->
        <div class="modal fade bs-example-modal-lg"  id="mymodel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">我的提问</h4>
                    </div>
                    <div class="modal-body">
                        <div class="media">
                            <div class="media-left">
                                @foreach($user->questions as $question)
                                <div class="panel panel-default" style='width:850px;'>
                                    <div class="panel-heading">

                                            <a href="\question\{{$question->id}}"><b style="font-size:18px;">{{$question->title}}</b></a>

                                    </div>

                                    <div class="panel-body">
                                        <span style='width:30%;'><div>2017-12-31 ·  {{$question->answers_count}}个回答 · {{$question->followers_count}}个关注</div></span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 结束 -->


        <!-- 第二个————评论 -->
        <div class="modal fade bs-example-modal-lg1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">我的评论</h4>
                    </div>
                    <div class="modal-body">

                        <div class="media">
                            <div class="media-left">

                                @foreach($user->answers as $answer)
                                <div class="panel panel-default" style='width:850px;'>
                                    <div class="panel-heading">
                                        <a href="\question\{{$answer->question_id}}">
                                            <b style="font-size:18px;">{{$answer->question->title}}</b>
                                        </a>
                                    </div>

                                    <div class="panel-body">
                                        {!! $answer->body!!}
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- 结束 -->


        <!-- 第三个————关注问题 -->
        <div class="modal fade bs-example-modal-lg2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">我关注的问题</h4>
                    </div>
                    <div class="modal-body">
                        <article class="blog-post">
                            <div class="media">
                                <div class="media-left">
                                    @foreach($user->follows as $follows)
                                    <div class="post-meta" style='width:850px;'>
                                        <h2>
                                            <a href="/question/{{$follows->id}}">{{ $follows->title }}</a>
                                        </h2>
                                        <div class="panel-body" style="height:450px;overflow:hidden;">
                                            <span>{!! $follows->body !!}</span>
                                        </div>
                                        <div style="margin-left:300px;" class="read-more">
                                            <a class="jxyd" href="javascript:(0)">Continue Reading</a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
        <!-- 结束 -->


        <!-- 第四个__关注话题 -->
        <div class="modal fade bs-example-modal-lg3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">我关注的话题</h4>
                    </div>
                    <div class="modal-body">
                        <div class="media">
                            @foreach($user->UserTopic as $topics)
                            <div class="panel-body2" style="float:left;width:100%;">
                                <article class="widget-post">
                                    <div class="post-image">
                                        <a href="{{action('QuestionController@topic',['id'=>$topics->id])}}"><img style="width:90px;height:50.63px" src="{{$topics->topic_pic}}" /></a>
                                    </div>
                                    <div class="post-body">
                                        <h2><a href="{{action('QuestionController@topic',['id'=>$topics->id])}}">{{$topics->name}}</a></h2>
                                        <div class="post-meta">
                                            <span>
                                                <i class="fa fa-clock-o"></i> {{$topics->created_at}}
                                            </span>
                                            <span>
                                                <a href="{{action('QuestionController@topic',['id'=>$topics->id])}}"><i class="fa fa-comment-o"></i> {{$topics->questions_count}}</a>
                                            </span>

                                            <button class="btn btn-warning bzgzght" id="{{$topics->id}}" style="float:right;margin-top:20px;position:relative;bottom:40px;">取消关注</button>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 结束 -->

        <!-- 第五个————粉丝 -->
        <div class="modal fade bs-example-modal-lg4"  id="mymodel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">我的粉丝</h4>
                    </div>
                    <div class="modal-body">
                        <div class="media">
                            <div class="media-left">
                                @foreach($user->notifications as $notification)
                                <div class="panel panel-default" style='width:850px;'>
                                    <div class="panel-body">

                                            <a href="\question\{{$question->id}}"><b style="font-size:18px;">{{$notification->data['name']}}</b></a>
                                            关注了你
                                            <span>在{{$notification->created_at->diffForHumans()}}</span>
                                    </div>


                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 结束 -->

        <!-- 第六个————收藏 -->
        <div class="modal fade bs-example-modal-lg5"  id="mymodel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">我的收藏</h4>
                    </div>
                    <div class="modal-body">
                        <article class="blog-post">
                        <div class="media">
                            <div class="media-left">
                                @foreach($users['collection'] as $collection)

                                <div class="panel panel-default" style='width:850px;'>
                                    <div class="panel-heading">

                                        <a href="\question\{{$collection->id}}"><b style="font-size:18px;">{{$collection['title']}}</b></a>

                                    </div>

                                    <div class="panel-body" style="height:450px;overflow:hidden;">
                                        <span style='height:450px;'><div>{!! $collection['body'] !!}</div></span>
                                    </div>
                                    <div style="margin-left:300px;" class="read-more">
                                        <a class="jxyd" href="javascript:(0)">Continue Reading</a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
        <!-- 结束 -->

    </body>
</html>
@else
    <center>您还没有激活,<a href="/">点击返回首页</a></center>
@endif

@endsection

@section('js')
    <script src="{{asset('assets/js/script.js')}}"></script>
    <script src="{{asset('assets/js/jquery-3.1.0.min.js')}}"></script>
    <script>
        //点击编辑背景图片时触发fun
        function fun(){
            document.getElementById('file').click();
            document.getElementById('hidden').value="0";
        }

        //点击头像时触发func
        function func(){
            document.getElementById('file').click();
            document.getElementById('hidden').value="1";
        }

        //选择完图片后触发funcc
        function funcc(){
            document.getElementById('sub').click();
        }
    </script>
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
    <!-- 不在关注话题 -->
    <script type="text/javascript">
      $(".bzgzght").click(function(){
        var id=$(this).attr("id");
        var bt=this;
        $.ajax({
          url:"{{action('TopicUserController@store')}}",
          data:{id:id},
          type:"post",
          success:function(){
            $(bt).parents('article').remove();
          }
        });
      });
    </script>
    <script type="text/javascript">
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    </script>

    <!-- 更改密码ajax -->
    <script type="text/javascript">
        $(".genggai").click(function(){
            $('#mima1').css('display','');

            $("#jiumima").blur(function(){
                var val=$(this).val();
                $.post("{{url('home/index/mimaajax')}}",{oldpassword:val,biao:'jiu'},function(data){
                   if(data == 2){
                        //与旧密码不符
                        $('#tishi1').html("与旧密码不符！");
                        $('#tishi1').css('color','red',);
                   }else if(data == 1){

                        $('#tishi1').html("√");
                        $('#tishi1').css('color','green');
                        $("#xinmima").html("新密码：<input value='' style='color:red;' id='xinmima2'/><button id='tijiaom'>提交</button>");

                        $('#tijiaom').click(function(){
                            var password=$('#xinmima2').val();
                            $.post("{{url('home/index/mimaajax')}}",{password:password,biao:"xin"},function(data){

                                if(data == 1){
                                    alert('成功');
                                    $('#logout-form').submit();
                                }else{
                                    alert('失败');
                                }
                            })
                        })
                   }
                })
            })
        })
    </script>
    <!-- 结束 -->
@endsection