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
 						<form method="post" action="{{ url('save-madarassa') }}" enctype="multipart/form-data">
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
 								<input type="textarea" value="{{ old('description', @$madrassa->description) }}"   class="form-control" id="description" name="description" >
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
  @endsection