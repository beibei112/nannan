@extends('layouts.app')

@section('content')

@include('vendor.ueditor.assets')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">修改发布问题</div>
                    {!!Form::open(['url'=>action('QuestionController@update',['id'=>$question->id]),'method'=>'PATCH'])!!}

                    {!! Form::hidden('id',$question['id']) !!}
                    <div class="panel-body">
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            {!!Form::label('title','标题')!!}
                            {!! Form::text('title',$question['title'],['class'=>'form-control','placeholder'=>$question['title'],'readonly'])!!}

                            @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif

                        </div>

                        <div class="form-group">
                            <label >修改发布话题</label>
                            <select class="form-control js-example-basic-multiple js-data-example-ajax" name="topics[]" multiple="multiple">
                            @foreach($question['topics'] as $arrs)
                                <option value="{{$arrs['id']}}" selected>{{$arrs['name']}}</option>
                            @endforeach

                            </select>
                        </div>
                        <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">

                            {!!Form::label('body','内容')!!}
                            <!--百度编辑器开始-->
                            <script id="container" name="body" style='height:200px' type="text/plain">
                                   {!! $question['body'] !!}
                            </script>
                            <!--百度编辑器结束-->

                            @if ($errors->has('body'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('body') }}</strong>
                                </span>
                            @endif

                        </div>

                        {!!Form::submit('确认发布',['class'=>'btn btn-success btn-block'])!!}
                    </div>

                    {!!Form::close()!!}
            </div>
        </div>
    </div>
</div>

<!-- 实例化编辑器 -->
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
    });
</script>


<!--
    old('body') 将闪存的数据输出
 -->

@endsection

@section('js')
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script type="text/javascript">
        function formatTopic (topic) {

            return "<div class='select2-result-repository clearfix'>" +

                "<div class='select2-result-repository__meta'>" +

                "<div class='select2-result-repository__title'>" +

                topic.name ? topic.name : "Laravel"   +

                "</div></div></div>";
        }


        function formatTopicSelection (topic) {

            return topic.name || topic.text;
        }

        $(".js-example-basic-multiple").select2({

            tags: true,

            placeholder: '选择相关话题',

            minimumInputLength: 2,

            ajax: {

                url: '/api/topics',

                dataType: 'json',

                delay: 250,

                data: function (params) {

                    return {

                        q: params.term

                    };

                },

                processResults: function (data, params) {

                    return {

                        results: data

                    };

                },

                cache: true

            },

            templateResult: formatTopic,

            templateSelection: formatTopicSelection,

            escapeMarkup: function (markup) { return markup; }

        });
    </script>
@endsection