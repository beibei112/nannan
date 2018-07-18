@if(!$notification->read_at)
<li class='list-group-item userfollow'>

	<a href="/user/home/{{$notification->data['id']}}">{{$notification->data['name']}}</a>

	关注了你

	<span class="pull-right">在{{$notification->created_at->diffForHumans()}}</span>
</li>
@endif

@section('js')
<script type="text/javascript">

	$('.userfollow').dblclick(function(){
		var li = $(this);
		$.ajax({
			url:'/api/follow',
			data:{user:{{Auth::user()->id}},id:'{{$notification->id}}'},
			type:'get',
			success:function(mes){
				li.fadeOut(500);
			}
		});
	});
</script>
@endsection