@extends('layouts.app')
@section('content')
<section id="contact" class="contact_bg">
    <div class="container form-container">
      	<div class="row">
      		<div class="col-md-12 content-section">
				<div class="section_heading section_heading_2">
					<h3>Notices</h3>
				</div>
			</div>
			<div class="col-md-12 settings-container">
				<div class="row">
					<div class="col-md-12">
						<a href="{{ url('add-notice') }}" class="btn btn-success float-right">Add Notice</a>
						<br>
						<br>
					</div>
					<div class="col-md-12">
						<table class="table table-bordered table-hover notice-data" style="width: 100%;">
							<thead>
			  					<th style="width: 10%;">#</th>
			  					<th>Title</th>
			  					<th>Date</th>
			  					<th>Place</th>
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
		$noticeData = $('.notice-data').DataTable({
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
	            {data: 'title', name: 'title'},
	            {data: 'date', name: 'date'},
	            {data: 'place', name: 'place'},
	            {data: 'action', name: 'action', orderable: false, searchable: false},
	        ]
		});
		$(document).on('click', '.delete-notice', function(event) {
			event.preventDefault();
			var tag_id = $(this).data('value');
			if(confirm('Do you want to delete this item ?'))
			{
				$.ajax({
					url: "{{ url('delete-notice') }}",
					type: 'DELETE',
					dataType: 'json',
					data: {
						_token: $('meta[name="csrf-token"]').attr('content'),
						id: tag_id
					},
					success: function(data) {
						$noticeData.ajax.reload();
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