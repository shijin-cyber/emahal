@extends('layouts.app')
@section('content')
<section id="contact" class="contact_bg">
    <div class="container form-container">
      	<div class="row">
      		<div class="col-md-12 content-section">
				<div class="section_heading section_heading_2">
					<h3>Settings</h3>
				</div>
				<div class="col-md-12 settings-container">
					<ul class="nav nav-tabs settings-tabs">
					  <li class="nav-item">
					    <a class="nav-link active" data-toggle="tab" href="#staff-designation">Staff Designation</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link" data-toggle="tab" href="#payment-types">Payment Types</a>
					  </li>
					</ul>
					<!-- Tab panes -->
					<div class="tab-content">
					  <div class="tab-pane container active" id="staff-designation">
					  	<div class="row">
					  		<div class="col-md-6">
							  	<div class="contact_form common">
							  		<div class="text-success success-message">
							  			<h4></h4>
							  		</div>
							  		<form action="{{url('save-staff-designation')}}" method="post" class="settings-save-form" id="payment-type-form">
							  			@csrf
							  			@method('POST')
							  			<div class="form-group">
											<label>Designation Name <span> *</span></label>
											<input type="text" class="form-control form-inputs" placeholder="Designation name" name="designation">
											<input type="hidden" class="staff-designation-input-id" name="edit_id" value="0">
							            </div>
							            <div class="section_sub_btn">
							            	<button class="btn btn-default" type="submit">Save</button> 
							            </div>
							  		</form>
							  	</div>
					  		</div>
					  	</div>
					  	<div class="row">
					  		<div class="col-md-12">
					  			<table class="table table-bordered table-hover staff-designation-data" style="width: 100%;">
					  				<thead>
					  					<th style="width: 10%;">#</th>
					  					<th>Staff Designation</th>
					  					<th style="width: 20%;">Action</th>
					  				</thead>
					  			</table>
					  		</div>
					  	</div>
					  </div>
					  <div class="tab-pane container fade" id="payment-types">
					  	<div class="row">
					  		<div class="col-md-6">
							  	<div class="contact_form common">
							  		<div class="text-success success-message">
							  			<h4></h4>
							  		</div>
							  		<form action="{{url('save-payment-type')}}" method="post" class="settings-save-form">
							  			@csrf
							  			@method('POST')
							  			<div class="form-group">
											<label>Payment Type Name<span> *</span></label>
											<input type="text" class="form-control form-inputs" placeholder="Payment type name" name="payment_type_name">
											<input type="hidden" class="payment-type-id" name="edit_id" value="0">
							            </div>
							            <div class="section_sub_btn">
							            	<button class="btn btn-default" type="submit">Save</button> 
							            </div>
							  		</form>
							  	</div>
					  		</div>
					  	</div>
					  	<div class="row">
					  		<div class="col-md-12">
					  			<table class="table table-bordered table-hover payment-type-data" style="width: 100%;">
					  				<thead>
					  					<th style="width: 10%;">#</th>
					  					<th>Payment Type</th>
					  					<th style="width: 20%;">Action</th>
					  				</thead>
					  			</table>
					  		</div>
					  	</div>
					  </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@push('scripts')
<script type="text/javascript">
	$(document).ready(function($) {
		$designationTable = $('.staff-designation-data').DataTable({
			processing: true,
	        serverSide: true,
	        ajax: {
	        	url: "{{ url('get-staff-designation') }}",
	        	type: 'POST',
	        	data: function(d) {
	        		d._token = $('meta[name="csrf-token"]').attr('content');
	        		return d;
	        	}
	        },
	        columns: [
	            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
	            {data: 'type_name', name: 'type_name'},
	            {data: 'action', name: 'action', orderable: false, searchable: false},
	        ]
		});
		$paymentTable = $('.payment-type-data').DataTable({
			processing: true,
	        serverSide: true,
	        ajax: {
	        	url: "{{ url('get-payment-type') }}",
	        	type: 'POST',
	        	data: function(d){
	        		d._token = $('meta[name="csrf-token"]').attr('content');
	        		return d;
	        	}
	        },
	        columns: [
	            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
	            {data: 'type_name', name: 'type_name'},
	            {data: 'action', name: 'action', orderable: false, searchable: false},
	        ]
		});
		$('.settings-tabs').find('li').find('a').click(function(event) {
			$('.success-message').find('h4').text('');
		});

		$(document).on('click', '.delete-payment', function(event) {
			event.preventDefault();
			var tag_id = $(this).data('value');
			if(confirm('Do you want to delete this item ?'))
			{
				$.ajax({
					url: "{{ url('delete-payment-type') }}",
					type: 'DELETE',
					dataType: 'json',
					data: {
						_token: $('meta[name="csrf-token"]').attr('content'),
						id: tag_id
					},
					success: function(data) {
						$paymentTable.ajax.reload();
						alert('Success');
					},
					error: function(xhr, data) {

					}
				});
			}
		});

		$(document).on('click', '.delete-staff-designation', function(event) {
			event.preventDefault();
			var tag_id = $(this).data('value');
			if(confirm('Do you want to delete this item ?'))
			{
				$.ajax({
					url: "{{ url('delete-staff-designation') }}",
					type: 'DELETE',
					dataType: 'json',
					data: {
						_token: $('meta[name="csrf-token"]').attr('content'),
						id: tag_id
					},
					success: function(data) {
						$designationTable.ajax.reload();
						alert('Success');
					},
					error: function(xhr, data) {

					}
				});
			}
		});

		$(document).on('click', '.edit-staff-designation', function(event) {
			event.preventDefault();
			var tag_id = $(this).data('value');
			$.ajax({
				url: "{{ url('get-single-staff-designation') }}",
				type: 'POST',
				dataType: 'json',
				data: {
					_token: $('meta[name="csrf-token"]').attr('content'),
					id: tag_id
				},
				success: function(data) {
					// alert('Success');
					$('input[name="designation"]').val(data.data.type_name);
					$('.staff-designation-input-id').val(data.data.id);
					$('html, body').animate({
				        scrollTop: $($('input[name="designation"]')).offset().top
				    }, 500);
					$designationTable.ajax.reload();
				},
				error: function(xhr, data) {

				}
			});
		});

		$(document).on('click', '.edit-payment-type', function(event) {
			event.preventDefault();
			var tag_id = $(this).data('value');
			$.ajax({
				url: "{{ url('get-single-payment-type') }}",
				type: 'POST',
				dataType: 'json',
				data: {
					_token: $('meta[name="csrf-token"]').attr('content'),
					id: tag_id
				},
				success: function(data) {
					// alert('Success');
					$('input[name="payment_type_name"]').val(data.data.type_name);
					$('.payment-type-id').val(data.data.id);
					$('html, body').animate({
				        scrollTop: $($('input[name="payment_type_name"]')).offset().top
				    }, 500);
					$designationTable.ajax.reload();
				},
				error: function(xhr, data) {

				}
			});
		});

		$('.settings-save-form').submit(function(event){
			event.preventDefault();
			var action 		= $(this).attr('action'),
				pass_data 	= $(this).serialize(),
				form 		= $(this);

			$.ajax({
				url: action,
				type: 'POST',
				dataType: 'JSON',
				data: pass_data,
				success: function(data) {
					form.find('.form-inputs').val('');
					$('.success-message').find('h4').text('Successfully saved your details !!');
					setTimeout(function() {
						$('.success-message').find('h4').text('');
					}, 2500);
					$designationTable.ajax.reload();
					$paymentTable.ajax.reload();
					$('input[name="edit_id"]').val('0');
				},
				error: function(xhr, data) {
					console.log(xhr)
					alert(JSON.stringify(xhr.responseJSON.message));

				}
			});
			return false;
		});
	});
</script>
@endpush
@endsection