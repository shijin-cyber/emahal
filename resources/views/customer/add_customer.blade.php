  @extends('layouts.app')
  @section('content')
  <input type="hidden" value="{{@$customer->id}}" name="customer_id">
  <section id="contact" class="contact_bg">
    <div class="container form-container">
      <div class="row">
        <div class="col-md-12 content-section">
          <div class="section_heading section_heading_2">
            <h3>Customer Registration</h3>
          </div>

          <div class="col-md-12 no-padding">
            <div class="contact_form">
              <form method="post" action="{{ url('save-customer') }}" enctype="multipart/form-data" class="customer-save-form">
                @csrf
                <input type="hidden" value="{{ @$customer->id ?? '0' }}" name="edit_id">
                <div class="form-group">
                  <label >Name : <span> *</span></label>
                  <input type="text" value="{{ old('full_name', @$customer->full_name) }}" class="form-control" id="full_name" name="full_name" >
                </div>


                <div class="form-group">
                  <label >Date Of Birth : <span> *</span></label>
                  <input type="date" value="{{ old('dob', @$customer->dob) }}" class="form-control" id="dob" name="dob" >
                </div>
                <div class="form-group">
                  <label >Email : <span> *</span></label>
                  <input type="Email" value="{{ old('email', @$customer->email) }}" class="form-control" id="email" name="email" >
                </div>
                <div class="form-group">
                  <label >Phone No : <span> *</span></label>
                  <input type="number" value="{{ old('phone', @$customer->phone) }}" class="form-control" id="phone" name="phone" >
                </div>

                <div class="form-group">
                  <div class="form-check">
                    <input class="form-check-input" value="1" type="checkbox" name="is_head" value="1" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                      House holder
                    </label>
                  </div>
                </div>
                <div class="form-group">
                 <label >Relation : </label>

                 <select class="custom-select mr-sm-2" name="relation_name" id="inlineFormCustomSelect">
                  <option selected value="">Choose... </option>
                  @foreach($customers as $customer_list)
                  <option value="{{$customer_list->id}}" @if(old('relation_name', @$customer->parent_id) == $customer_list->id) selected @endif>{{$customer_list->full_name}} [{{$customer_list->phone}}]</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
               <label >Gender : <span> *</span></label> 
               <div class="form-check">

                <input class="form-check-input" type="radio" name="gender" id="exampleRadios1" value="option1" checked>
                <label class="form-check-label" for="exampleRadios1">
                 Male
               </label>

               <input class="form-check-input2" type="radio" name="gender" id="exampleRadios2" value="option2">
               <label class="form-check-label" for="exampleRadios2">
                Female
              </label>
            </div>
          </div>
          <h4>Address</h4>
          <div class="row contact-address">
            <div class="col-4">
             <div class="form-group">
              <label class="text-center">Street<span> *</span></label>
              <input type="text" value="{{old('street')[0] ?? @$address['contact']->street}}" class="form-control" id="street" name="street[]" >
              <input type="hidden" class="form-control" value="contact" id="address_type" name="address_type[]" >
            </div>
          </div>
          <div class="col-4">
           <div class="form-group">
            <label class="text-center">Post<span> *</span></label>
            <input type="text" value="{{old('post_name')[0] ?? @$address['contact']->post_name}}" class="form-control" id="post" name="post_name[]" >
          </div>
        </div>
        <div class="col-4">
         <div class="form-group">
          <label class="text-center">Pin code<span> *</span></label>
          <input type="number"  value="{{old('pin_code')[0] ?? @$address['contact']->pin_code}}" class="form-control" id="pincode" name="pin_code[]" >
        </div>
      </div>
      <div class="col-4">
       <div class="form-group">
        <label class="text-center">State<span> *</span></label>
        <input type="text" value="{{old('state')[0] ?? @$address['contact']->pin_code}}" class="form-control" id="state" name="state[]" >
      </div>
    </div>
    <div class="col-4">
     <div class="form-group">
      <label class="text-center">District<span> *</span></label>
      <input type="text"  value="{{old('district')[0] ?? @$address['contact']->district}}" class="form-control" id="district" class="form-control" id="district" name="district[]" >
    </div>
  </div>


</div>

<div class="form-check ">
  <input class="form-check-input" type="checkbox" name="permanent_check" value="1" id="permanent-check">
  <label class="form-check-label" for="permanent-check">
   Mark As Permenent Address
 </label>
</div><br>

<h5>Permenent Address</h4><br>
  <div class="row permanent-address">
    <div class="col-4">
     <div class="form-group">
      <label class="text-center">Street<span> *</span></label>
      <input type="text" class="form-control" value="{{old('street')[1] ?? @$address['contact']->street}}" id="street" name="street[]">
      <input type="hidden" class="form-control" id="address_type" name="address_type[]" value="permanent">
    </div>
  </div>
  <div class="col-4">
   <div class="form-group">
    <label class="text-center">Post<span> *</span></label>
    <input type="text"  value="{{old('post_name')[1] ?? @$address['permanent']->post_name}}" class="form-control" id="post" name="post_name[]" >
  </div>
</div>
<div class="col-4">
  <div class="form-group">
    <label class="text-center">Pin code<span> *</span></label>
    <input type="number" value="{{old('pin_code')[1] ?? @$address['permanent']->pin_code}}" class="form-control" id="pincode" name="pin_code[]" >
  </div>
</div>
<div class="col-4">
  <div class="form-group">
    <label class="text-center">State<span> *</span></label>
    <input type="text" value="{{old('state')[1] ?? @$address['permanent']->state}}" class="form-control" id="state" name="state[]" >
  </div>
</div>
<div class="col-4">
  <div class="form-group">
    <label class="text-center">District<span> *</span></label>
    <input type="text" value="{{old('district')[1] ?? @$address['permanent']->district}}" class="form-control" id="district" name="district[]" >
  </div>
</div>


</div>

<h4>Proof</h4>
<div class="row proofs">
  @if(old('proof_name'))
  @foreach(old('proof_name') as $key => $proofs)
  <div class="row proof-list">
    <div class="col-3">
      <div class="form-group ">
        <label >Proof Name : <span> *</span></label>
        <input type="text" name="proof_name[]" value="{{old('proof_name')[$key]}}" class="form-control">
        <input type="hidden" name="proof_edit[]" value="0">
      </div>
    </div>
    <div class="col-3">
      <div class="form-group">
        <label >Proof Id/Number : <span> *</span></label>
        <input type="text" name="proof_number[]" value="{{old('proof_number')[$key]}}" class="form-control" id="proof_number" >
      </div>
    </div>
    <div class="col-3">
      <div class="form-group" id="content">
        <label >Proof : <span> *</span></label>
        <input type="file" name="proof_image_{{$key+1}}" class="form-control proof-file">
        <!-- <img src="{{asset('proof/')}}"> -->
      </div>
    </div>
    <div class="col-3">
      <button type="button" class="pull-right btn btn-danger delete-proof">Delete Row</button>
    </div>
  </div>
  @endforeach
  @else
  @if(isset($proof))
  @foreach($proof as $key => $pro)
  <div class="row proof-list">
    <div class="col-3">
      <div class="form-group ">
        <label >Proof Name : <span> *</span></label>
        <input type="text" name="proof_name[]" value="{{$pro->proof_name}}" class="form-control">
        <input type="hidden" name="proof_edit[]" value="{{$pro->id}}">
      </div>
    </div>
    <div class="col-3">
      <div class="form-group">
        <label >Proof Id/Number : <span> *</span></label>
        <input type="text" name="proof_number[]" value="{{$pro->proof_number}}" class="form-control" id="proof_number" >
      </div>
    </div>
    <div class="col-3">
    <div class="form-group" id="content">
      <label >Proof : <span> *</span></label>
      <input type="file" name="proof_image_{{$key+1}}" class="form-control proof-file">
      <img src="{{ asset('proof/'.$pro->image_name) }}" style="width: 100%;height: 25%;" class="img-fluid">
    </div>
    </div>
    <div class="col-3">
      <button type="button" class="pull-right btn btn-danger delete-proof">Delete Row</button>
    </div>
  </div>
  @endforeach
  @else
  <div class="row proof-list">
    <div class="col-3">
      <div class="form-group ">
        <label >Proof Name : <span> *</span></label>
        <input type="text" name="proof_name[]" class="form-control">
        <input type="hidden" name="proof_edit[]" value="0">
      </div>
    </div>
    <div class="col-3">
      <div class="form-group">
        <label >Proof Id/Number : <span> *</span></label>
        <input type="text" name="proof_number[]" class="form-control" id="proof_number" >
      </div>
    </div>
    <div class="col-3">
    <div class="form-group" id="content">
      <label >Proof : <span> *</span></label>
      <input type="file" name="proof_image_1" class="form-control proof-file">
    </div>
    </div>
    <div class="col-3">
      <button type="button" class="pull-right btn btn-danger delete-proof">Delete Row</button>
    </div>
  </div>
  @endif
  @endif
</div>


<div class="row clearfix">
  <div class="col-md-4">
    <button type="button" name="addrow" id="more_fields" value="Add More" class="btn btn-success pull-left">Add Row</button>
  </div>
</div>
<div class="form-group">
  <label>Description<span> *</span></label>
  <textarea class="form-textarea" rows="3" name="description"></textarea>
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
    $('#permanent-check').click(function(event) {
      if(this.checked) {
        $('.permanent-address').find('input').attr('disabled', true);
        $('.permanent-address').find('#street').val($('.contact-address').find('#street').val())
        $('.permanent-address').find('#post').val($('.contact-address').find('#post').val())
        $('.permanent-address').find('#pincode').val($('.contact-address').find('#pincode').val())
        $('.permanent-address').find('#state').val($('.contact-address').find('#state').val())
        $('.permanent-address').find('#district').val($('.contact-address').find('#district').val())
      } else {
        $('.permanent-address').find('input').attr('disabled', false);
        $('.permanent-address').find('input').val('');
      }
    });
    $(document).on('click', '#more_fields', function(event) {
      var data = $('.proofs').find('.proof-list').first().html();
      $('.proofs').append('<div class="row proof-list">'+data+'</div>')
      $('.proof-file').last().attr('name', 'proof_image_'+($('.proof-file').length));
    });
    $(document).on('click', '.delete-proof', function(event) {
      if($('.proof-list').length > 1)
        $(this).closest('.proof-list').remove();
    });

    $('.customer-save-form').submit(function(event){
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
          window.location.href = '{{ url("customer") }}';
          $('.form-group').find('span.text-danger').remove();
        },
        error: function(xhr, data) {
          console.log(xhr)
          alert(JSON.stringify(xhr.responseJSON.message));
          $('.form-group').find('.text-danger').remove()
          // alert(JSON.stringify(xhr.responseJSON.errors['street.0']));
          
        if(xhr.responseJSON.errors.full_name)
        $('input[name="full_name"]').closest('.form-group').append('<span class="text-danger">'+xhr.responseJSON.errors.full_name+'</span>');
         if(xhr.responseJSON.errors.email)
        $('input[name="email"]').closest('.form-group').append('<span class="text-danger">'+xhr.responseJSON.errors.email+'</span>');
         if(xhr.responseJSON.errors.phone)
        $('input[name="phone"]').closest('.form-group').append('<span class="text-danger">'+xhr.responseJSON.errors.phone+'</span>');
        if(xhr.responseJSON.errors.description)
        $('textarea[name="relation_name"]').closest('.form-group').append('<span class="text-danger">'+xhr.responseJSON.errors.relation_name+'</span>');
        if(xhr.responseJSON.errors['street.0'])
          $('input[name="street[]"]').first().closest('.form-group').append('<span class="text-danger">'+xhr.responseJSON.errors['street.0'][0]+'</span>');
        if(xhr.responseJSON.errors['street.1'])
          $('input[name="street[]"]').last().closest('.form-group').append('<span class="text-danger">'+xhr.responseJSON.errors['street.1'][0]+'</span>');
        $('input[name="post_name"]').closest('.form-group').append('<span class="text-danger">'+xhr.responseJSON.errors.post_name+'</span>');
        $('input[name="pin_code"]').closest('.form-group').append('<span class="text-danger">'+xhr.responseJSON.errors.pin_code+'</span>');
        $('input[name="district"]').closest('.form-group').append('<span class="text-danger">'+xhr.responseJSON.errors.district+'</span>');
        $('input[name="state"]').closest('.form-group').append('<span class="text-danger">'+xhr.responseJSON.errors.state+'</span>');
        $('input[name="proof_name"]').closest('.form-group').append('<span class="text-danger">'+xhr.responseJSON.errors.proof_name+'</span>');
        $('input[name="proof_number"]').closest('.form-group').append('<span class="text-danger">'+xhr.responseJSON.errors.proof_number+'</span>');
        $('input[name="image_name"]').closest('.form-group').append('<span class="text-danger">'+xhr.responseJSON.errors.image_name+'</span>');
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