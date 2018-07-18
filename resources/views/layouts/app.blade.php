<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{asset('css/select2.min.css')}}" rel="stylesheet" />



    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.bxslider.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a style="color:white;font-size:19px;" class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <!-- Left Side Of Navbar搜索话题 -->
                        {!!Form::open(['url'=>action('QuestionController@select'),'method'=>'post'])!!}
                        <div class="col-xs-2" style='position:absolute;top:10px;margin-left:300px;'>
                            {!! Form::text('title',null,['class'=>'form-control','placeholder'=>'搜索你感兴趣的内容....']) !!}
                        </div>
                        {!! Form::submit('搜索',['class'=>'btn btn-default','style'=>'position:absolute;left:983px;top:10px']) !!}
                        {!! Form::close() !!}

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest

                            <li><a style="color:white;" href="{{ route('login') }}">登录</a></li>
                            <li><a style="color:white;" href="{{ route('register') }}">注册</a></li>
                            <li><a style="color:white;" href="{{ route('password.request') }}">找回密码</a></li>
                        @else
                            <li><a class="fa fa-clock-o" style="color:white;" href="/notification"></a></li>
                            <li><a style="color:white;font-size:14px;" href="/topics/show">话题</a></li>
                            <li><a style="color:white;font-size:14px;" href="{{action('QuestionController@create')}}">问题</a></li>
                            <li class="dropdown">
                                <a style="color:white;font-size:14px;margin-left:35px;" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="fa fa-user-circle-o" style="font-size:13px;" href="/user/home/{{Auth::user()->id}}">个人信息</a>
                                        <a class="fa fa-mail-reply" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                            注销
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            @include('flash::message')

        </div>

        @yield('content')
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.bxslider.js') }}"></script>
    <script src="{{ asset('js/mooz.scripts.min.js') }}"></script>

    <script>
        $('#flash-overlay-modal').modal();
    </script>

    @section('js')

    @show
</body>
</html>
