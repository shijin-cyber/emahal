  @extends('layouts.app')
  @section('content')
  <section id="contact" class="contact_bg" >
  	<div class="container form-container">
  		<div class="row">
  			<div class="col-md-12 content-section">
  				<div class="section_heading section_heading_2">
  					<h3>Customers</h3>
  				</div>
  				
  				<div class="row">
  					
  					<div class="col-md-12 settings-container">
  						<div class="row">
  							<div class="col-md-12">
  								<a href="{{ url('add-customer') }}" class="btn btn-success float-right">Add Customer</a>
  								<br>
  								<br>
  							</div>
  							<div class="col-md-12">
  								<table class="table table-bordered table-hover customer-data" style="width: 100%;">
  									<thead>
  										<th style="width: 10%;">#</th>
  										<th>Name</th>
  										<th>Email</th> 
  										<th>Phone No</th>
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
  </section>
  @push('scripts')
  <script type="text/javascript">
  	// $('.customer-data').DataTable();
  	$(document).ready(function($) {
  		$customerTable = $('.customer-data').DataTable({
  			processing: true,
  			serverSide: true,
  			ajax: {
  				url: "{{ url('get-Customer-Data') }}",
  				type: 'POST',
  				data: function(d){
  					d._token = $('meta[name="csrf-token"]').attr('content');
  					return d;
  				}
  			},
  			columns: [
  			{data: 'DT_RowIndex', name: 'DT_RowIndex'},
  			{data: 'full_name', name: 'full_name'},
  			{data: 'email', name: 'email'},
  			{data: 'phone', name: 'phone'},
  			{data: 'action', name: 'action', orderable: false, searchable: false},
  			]
  		});

  	});
  	$(document).on('click', '.delete-customer', function(event) {
  		event.preventDefault();
  		var tag_id = $(this).data('value');
  		if(confirm('Do you want to delete this item ?'))
  		{
  			$.ajax({
  				url: "{{ url('delete-customer') }}",
  				type: 'DELETE',
  				dataType: 'json',
  				data: {
  					_token: $('meta[name="csrf-token"]').attr('content'),
  					id: tag_id
  				},
  				success: function(data) {
  					$customerTable.ajax.reload();
  					alert('Success');
  				},
  				error: function(xhr, data) {

  				}
  			});
  		}
  	});
  </script>
  @endpush
  @endsection