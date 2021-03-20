@extends('layouts.app')
@section('content')
<section id="contact" class="contact_bg">
    <div class="container form-container">
      	<div class="row">
      		<div class="col-md-12 content-section">
				<div class="section_heading section_heading_2">
					<h3>Events</h3>
				</div>
			</div>
			<div class="col-md-12 settings-container">
				<div class="row">
					<div class="col-md-12">
						<a href="{{ url('add-event') }}" class="btn btn-success float-right">Add Event</a>
						<br>
						<br>
					</div>
					<div class="col-md-12">
						<table class="table table-bordered table-hover events-data" style="width: 100%;">
							<thead>
			  					<th style="width: 10%;">#</th>
			  					<th>Event</th>
			  					<th>Date</th>
			  					<th>Time</th>
			  					<th style="width: 20%;">Action</th>
			  				</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@push('scripts')
<script type="text/javascript">
	$(document).ready(function($) {
		$eventData = $('.events-data').DataTable({
			processing: true,
	        serverSide: true,
	        ajax: {
	        	url: "{{ url()->current() }}",
	        	type: 'GET',
	        	data: function(d){
	        		d._token = $('meta[name="csrf-token"]').attr('content');
	        		return d;
	        	}
	        },
	        columns: [
	            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
	            {data: 'event_name', name: 'event_name'},
	            {data: 'start_date', name: 'start_date'},
	            {data: 'start_time', name: 'start_time'},
	            {data: 'action', name: 'action', orderable: false, searchable: false},
	        ]
		});
		$(document).on('click', '.delete-event', function(event) {
			event.preventDefault();
			var tag_id = $(this).data('value');
			if(confirm('Do you want to delete this item ?'))
			{
				$.ajax({
					url: "{{ url('delete-event') }}",
					type: 'DELETE',
					dataType: 'json',
					data: {
						_token: $('meta[name="csrf-token"]').attr('content'),
						id: tag_id
					},
					success: function(data) {
						$eventData.ajax.reload();
						alert('Success');
					},
					error: function(xhr, data) {

					}
				});
			}
		});
	});
</script>
@endpush
@endsection