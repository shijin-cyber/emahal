<ul class="notification-list">
	@foreach($notification as $notify)
	<li><a href="{{@$notify->link ? url($notify->link) : '#'}}">{{$notify->data['body']}}</a></li>
	@endforeach
</ul>