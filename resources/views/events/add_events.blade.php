@extends('layouts.app')
@section('content')
<section id="contact" class="contact_bg">
    <div class="container form-container">
      	<div class="row">
      		<div class="col-md-12 content-section">
				<div class="section_heading section_heading_2">
					<h3>Add Events</h3>
				</div>
			</div>
			<div class="col-md-12 no-padding">
				<div class="contact_form">
					<a href="{{ url('events') }}" class="btn btn-primary float-right"><i class="fa fa-backward"></i> Back</a>
					<br>
					<br>
					<form method="POST" action="{{ url('save-event') }}" class="save-event-form" enctype="multipart/form-data">
						<input type="hidden" name="edit_id" value="{{@$event->id ?? 0}}">
						@method('POST')
						@csrf
						<div class="form-group">
			                <label>Name : <span> *</span></label>
			                <input type="text" class="form-control" name="event_name" placeholder="Event name" value="{{old('event_name', @$event->event_name)}}">
			                @if($errors->has('event_name'))
				                <div class="text-danger">{{ $errors->first('event_name') }}</div>
			                @endif
		              	</div>
		              	<div class="form-group">
			                <label>Start Date : <span>*</span></label>
			                <input type="date" class="form-control" name="start_date" placeholder="Event start date" value="{{old('start_date', @$event->start_date)}}">
			                @if($errors->has('start_date'))
				                <div class="text-danger">{{ $errors->first('start_date') }}</div>
			                @endif
		              	</div>
		              	<div class="form-group">
			                <label>Start Time : </label>
			                <input type="time" name="start_time" class="form-control" placeholder="Event start time" value="{{old('start_time', @$event->start_time)}}">
			                @if($errors->has('start_time'))
				                <div class="text-danger">{{ $errors->first('start_time') }}</div>
			                @endif
		              	</div>
		              	<div class="form-group">
			                <label>End Date : </label>
			                <input type="date" class="form-control" name="end_date" placeholder="Event end date" value="{{old('end_date', @$event->end_date)}}">
			                @if($errors->has('end_date'))
				                <div class="text-danger">{{ $errors->first('end_date') }}</div>
			                @endif
		              	</div>
		              	<div class="form-group">
			                <label>End Time : </label>
			                <input type="time" name="end_time" class="form-control" placeholder="Event time" value="{{old('end_time', @$event->end_time)}}">
			                @if($errors->has('end_time'))
				                <div class="text-danger">{{ $errors->first('end_time') }}</div>
			                @endif
		              	</div>
		              	<div class="form-group">
			                <label>Description</label>
			                <textarea class="form-control" name="event_description" placeholder="type description here..." rows="5">{{old('event_description', @$event->event_description)}}</textarea>
			                @if($errors->has('event_description'))
				                <div class="text-danger">{{ $errors->first('event_description') }}</div>
			                @endif
		              	</div>
		              	<div class="form-group">
			                <label>Image : </label>
			                <input type="file" class="form-control" name="event_image" placeholder="Event image">
			                @if($errors->has('event_image'))
				                <div class="text-danger">{{ $errors->first('event_image') }}</div>
			                @endif
			                @if(@$event->image)
				                <img src="{{ asset('images/events/'.@$event->image) }}">
			                @endif
		              	</div>
		              	<div class="section_sub_btn">
		              		<button type="submit" class="btn btn-default">Submit</button>
		              	</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
@push('scripts')
<script type="text/javascript">
	$(document).ready(function($) {
		$('.save-event-form').submit(function(event) {
			event.preventDefault();
			var action 	= $(this).attr('action'),
				form 	= $(this);
			var pass_data = new FormData(this);

			$.ajax({
				url: action,
				type: 'POST',
				dataType: 'JSON',
				data: pass_data,
				success: function(data) {
					alert('Success');
					window.location.href = '{{ url("events") }}';
				},
				error: function(xhr, data) {
					alert(JSON.stringify(xhr.responseJSON.message));
					$('.form-group').find('.text-danger').remove()
					if(xhr.responseJSON.errors.event_name)
						$('input[name="event_name"]').closest('.form-group').append('<span class="text-danger">'+xhr.responseJSON.errors.event_name+'</span>');
					if(xhr.responseJSON.errors.start_date)
						$('input[name="start_date"]').closest('.form-group').append('<span class="text-danger">'+xhr.responseJSON.errors.start_date+'</span>');
					if(xhr.responseJSON.errors.start_time)
						$('input[name="start_time"]').closest('.form-group').append('<span class="text-danger">'+xhr.responseJSON.errors.start_time+'</span>');
					if(xhr.responseJSON.errors.end_date)
						$('textarea[name="end_date"]').closest('.form-group').append('<span class="text-danger">'+xhr.responseJSON.errors.end_date+'</span>');
					if(xhr.responseJSON.errors.end_time)
						$('textarea[name="end_time"]').closest('.form-group').append('<span class="text-danger">'+xhr.responseJSON.errors.end_time+'</span>');
					if(xhr.responseJSON.errors.event_description)
						$('textarea[name="event_description"]').closest('.form-group').append('<span class="text-danger">'+xhr.responseJSON.errors.event_description+'</span>');
					if(xhr.responseJSON.errors.event_image)
						$('textarea[name="event_image"]').closest('.form-group').append('<span class="text-danger">'+xhr.responseJSON.errors.event_image+'</span>');
				},
		        cache: false,
		        contentType: false,
		        processData: false
			});
			return false;
		});
	});
</script>
@endpush
@endsection