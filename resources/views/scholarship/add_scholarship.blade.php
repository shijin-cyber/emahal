@extends('layouts.app')
@section('content')
<section id="contact" class="contact_bg">
    <div class="container form-container">
      	<div class="row">
      		<div class="col-md-12 content-section">
				<div class="section_heading section_heading_2">
					<h3>Add Scholarship</h3>
				</div>
			</div>
			<div class="col-md-12 no-padding">
				<div class="contact_form">
					<a href="{{ url('scholarships') }}" class="btn btn-primary float-right"><i class="fa fa-backward"></i> Back</a>
					<br>
					<br>
					<form method="POST" action="{{ url('save-scholarship') }}" class="save-event-form" enctype="multipart/form-data">
						<input type="hidden" name="edit_id" value="{{@$scholarship->id ?? 0}}">
						@method('POST')
						@csrf
						<div class="form-group">
			                <label>Scholarship Name : <span> *</span></label>
			                <input type="text" class="form-control" name="scholarship_name" placeholder="Scholarship name" value="{{old('scholarship_name', @$scholarship->scholarship_name)}}">
			                @if($errors->has('scholarship_name'))
				                <div class="text-danger">{{ $errors->first('scholarship_name') }}</div>
			                @endif
		              	</div>
		              	<div class="form-group">
			                <label>Link <span>*</span></label>
			                <input type="text" class="form-control" name="link" placeholder="Type or paste your link here..." value="{{old('link', @$scholarship->link)}}">
			                @if($errors->has('link'))
				                <div class="text-danger">{{ $errors->first('link') }}</div>
			                @endif
		              	</div>
		              	<div class="form-group">
			                <label>Last Date : </label>
			                <input type="date" class="form-control" name="last_date" placeholder="Event end date" value="{{old('last_date', @$scholarship->last_date)}}">
			                @if($errors->has('last_date'))
				                <div class="text-danger">{{ $errors->first('last_date') }}</div>
			                @endif
		              	</div>
		              	<div class="form-group">
			                <label>Description</label>
			                <textarea class="form-control" name="description" placeholder="type description here..." rows="5">{{old('description', @$scholarship->description)}}</textarea>
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
					window.location.href = '{{ url("scholarships") }}';
				},
				error: function(xhr, data) {
					alert(JSON.stringify(xhr.responseJSON.message));
					$('.form-group').find('.text-danger').remove()
					if(xhr.responseJSON.errors.scholarship_name)
						$('input[name="scholarship_name"]').closest('.form-group').append('<span class="text-danger">'+xhr.responseJSON.errors.scholarship_name+'</span>');
					if(xhr.responseJSON.errors.link)
						$('input[name="link"]').closest('.form-group').append('<span class="text-danger">'+xhr.responseJSON.errors.link+'</span>');
					if(xhr.responseJSON.errors.last_date)
						$('textarea[name="last_date"]').closest('.form-group').append('<span class="text-danger">'+xhr.responseJSON.errors.last_date+'</span>');
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