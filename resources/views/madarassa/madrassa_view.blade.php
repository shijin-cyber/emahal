 @extends('layouts.app')
 @section('content')
  <section id="contact" class="contact_bg" >
  	<div class="container form-container">
  		<div class="row">
  			<div class="col-md-12 content-section">
  				<div class="section_heading section_heading_2">
  					<h3>Madrassa</h3>
  				</div>
  				
  				<div class="row">
  					
  					<div class="col-md-12 settings-container">
  						<div class="row">
  							<div class="col-md-12">
  								<a href="{{ url('add-madarassa') }}" class="btn btn-success float-right">Add Madrassa</a>
  								<br>
  								<br>
  							</div>
  							<div class="col-md-12">
  								<table class="table table-bordered table-hover madrassa-data" style="width: 100%;">
  									<thead>
  										<th style="width: 10%;">#</th>
  										<th>Madrassa Name</th>
  										<th>Registration</th> 
  										<th>Established</th>
  										<!-- <th>Description</th> -->
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
  		$madrassaTable = $('.madrassa-data').DataTable({
  			processing: true,
  			serverSide: true,
  			ajax: {
  				url: "{{ url('get-madrassa-Data') }}",
  				type: 'POST',
  				data: function(d){
  					d._token = $('meta[name="csrf-token"]').attr('content');
  					return d;
  				}
  			},
  			columns: [
  			{data: 'DT_RowIndex', name: 'DT_RowIndex'},
  			{data: 'madrassa_name', name: 'madrassa_name'},
  			{data: 'reg_id', name: 'reg_id'},
  			{data: 'estd', name: 'estd'},
  			// {data: 'phone', name: 'description'},
  			{data: 'action', name: 'action', orderable: false, searchable: false},
  			]
  		});

  	});
  	$(document).on('click', '.delete-madrassa', function(event) {
  		event.preventDefault();
  		var tag_id = $(this).data('value');
  		if(confirm('Do you want to delete this item ?'))
  		{
  			$.ajax({
  				url: "{{ url('delete-madrassa') }}",
  				type: 'DELETE',
  				dataType: 'json',
  				data: {
  					_token: $('meta[name="csrf-token"]').attr('content'),
  					id: tag_id
  				},
  				success: function(data) {
  					$madrassaTable.ajax.reload();
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