 @extends('layouts.app')
 @section('content')
 <section id="contact" class="contact_bg">
 	<div class="container form-container">
 		<div class="row">
 			<div class="col-md-12 content-section">
 				<div class="section_heading section_heading_2">
 					<h3>Madrassa Registration</h3>
 				</div>

 				<div class="col-md-12 no-padding">
 					<div class="contact_form">
 						<form method="post" class="madrassa-save-form" action="{{ url('save-madarassa') }}" enctype="multipart/form-data">
 							@csrf
 							 <input type="hidden" value="{{ @$madrassa->id ?? '0' }}" name="edit_id">
 							
 							<div class="form-group">
 								<label >Madrassa Name : <span> *</span></label>
 								<input type="text" value="{{ old('madrassa_name', @$madrassa->madrassa_name) }}" class="form-control" id="madrassa_name" name="madrassa_name" >
 							</div>
 							<div class="form-group">
 								<label >Registration Id : <span> *</span></label>
 								<input type="number" value="{{ old('reg_id', @$madrassa->reg_id) }}"  class="form-control" id="reg_id" name="reg_id" >
 							</div>
 							<div class="form-group">
 								<label >Established : <span> *</span></label>
 								<input type="date" value="{{ old('estd', @$madrassa->estd) }}"  class="form-control" id="estd" name="estd" >
 							</div>
 							<div class="form-group">
 								<label >Description: <span> *</span></label>
 								
 								<textarea value="{{ old('description', @$madrassa->description) }}"  class="form-textarea" id="description" name="description"></textarea>
 							</div>

 							<div class="section_sub_btn">
 								<button class="btn btn-default" type="submit">Send</button> 
 							</div>
 						</form>
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>
 </section>
 @push('scripts')
 <script type="text/javascript">
 	$(document).ready(function($) {
 	$('.madrassa-save-form').submit(function(event){
      event.preventDefault();
      var action    = $(this).attr('action'),
          pass_data   = new FormData(this),
          form      = $(this);
        // alert(JSON.stringify(pass_data))
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
          // $('input[name="edit_id"]').val('0');
          window.location.href = '{{ url("madrassa") }}';
          $('.form-group').find('span.text-danger').remove();
        },
        error: function(xhr, data) {
          console.log(xhr)
          alert(JSON.stringify(xhr.responseJSON.message));
          $('.form-group').find('.text-danger').remove()
          // alert(JSON.stringify(xhr.responseJSON.errors['street.0']));
          
        if(xhr.responseJSON.errors.madrassa_name)
        $('input[name="madrassa_name"]').closest('.form-group').append('<span class="text-danger">'+xhr.responseJSON.errors.madrassa_name+'</span>');

        if(xhr.responseJSON.errors.reg_id)
        $('input[name="reg_id"]').closest('.form-group').append('<span class="text-danger">'+xhr.responseJSON.errors.reg_id+'</span>');

        if(xhr.responseJSON.errors.estd)
        $('input[name="estd"]').closest('.form-group').append('<span class="text-danger">'+xhr.responseJSON.errors.estd+'</span>');
    if(xhr.responseJSON.errors.description)
        $('input[name="description"]').closest('.form-group').append('<span class="text-danger">'+xhr.responseJSON.errors.description+'</span>');
        
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