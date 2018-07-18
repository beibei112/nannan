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
                            <h2 >消息通知</h2>

                            @if(Auth::user()->notifications)
                                <ul class='list-group'>
                                    @foreach(Auth::user()->notifications as $notification)

                                       @include('notifications.'.snake_case(class_basename($notification->type)))
                                    @endforeach
                                </ul>
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
    </body>
</html>

@endsection
