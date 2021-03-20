@extends('layouts.app')
@section('content')
<section id="contact" class="contact_bg">
    <div class="container form-container">
      	<div class="row">
      		<div class="col-md-12 content-section">
				<div class="section_heading section_heading_2">
					<h3>Add Notice</h3>
				</div>
			</div>
			<div class="col-md-12 no-padding">
				<div class="contact_form">
					<a href="{{ url('notices') }}" class="btn btn-primary float-right"><i class="fa fa-backward"></i> Back</a>
					<br>
					<br>
					<form method="POST" action="{{ url('save-notice') }}" class="save-notice-form" enctype="multipart/form-data">
						<input type="hidden" name="edit_id" value="{{@$notice->id ?? 0}}">
						@method('POST')
						@csrf
						<div class="form-group">
			                <label>Title : <span> *</span></label>
			                <input type="text" class="form-control" name="title" placeholder="Event name" value="{{old('title', @$notice->title)}}">
			                @if($errors->has('title'))
				                <div class="text-danger">{{ $errors->first('title') }}</div>
			                @endif
		              	</div>
		              	<div class="form-group">
			                <label>Date : </label>
			                <input type="date" class="form-control" name="date" placeholder="date" value="{{old('date', @$notice->date)}}">
			                @if($errors->has('date'))
				                <div class="text-danger">{{ $errors->first('date') }}</div>
			                @endif
		              	</div>
		              	<div class="form-group">
			                <label>Place : </label>
			                <input type="text" class="form-control" name="place" placeholder="Place" value="{{ old('place', @$notice->place) }}">
			                @if($errors->has('place'))
				                <div class="text-danger">{{ $errors->first('place') }}</div>
			                @endif
		              	</div>
		              	<div class="form-group">
			                <label>Description <span>*</span></label>
			                <textarea class="form-control" name="description" placeholder="type description here..." rows="5">{{old('description', @$notice->description)}}</textarea>
			                @if($errors->has('description'))
				                <div class="text-danger">{{ $errors->first('description') }}</div>
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
		$('.save-notice-form').submit(function(event) {
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
					window.location.href = '{{ url("notices") }}';
				},
				error: function(xhr, data) {
					alert(JSON.stringify(xhr.responseJSON.message));
					$('.form-group').find('.text-danger').remove()
					if(xhr.responseJSON.errors.title)
						$('input[name="title"]').closest('.form-group').append('<span class="text-danger">'+xhr.responseJSON.errors.title+'</span>');
					if(xhr.responseJSON.errors.date)
						$('input[name="date"]').closest('.form-group').append('<span class="text-danger">'+xhr.responseJSON.errors.date+'</span>');
					if(xhr.responseJSON.errors.place)
						$('input[name="place"]').closest('.form-group').append('<span class="text-danger">'+xhr.responseJSON.errors.place+'</span>');
					if(xhr.responseJSON.errors.description)
						$('textarea[name="description"]').closest('.form-group').append('<span class="text-danger">'+xhr.responseJSON.errors.description+'</span>');
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