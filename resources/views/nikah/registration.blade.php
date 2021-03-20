@extends('layouts.app')
@section('content')
 <input type="hidden" value="{{@$customer->id}}" name="customer_id">
  <section id="contact" class="contact_bg">
    <div class="container form-container">
      <div class="row">
        <div class="col-md-12 content-section">
          <div class="section_heading section_heading_2">
            <h3>Nikah Registration</h3>
          </div>

          <div class="col-md-12 no-padding">
            <div class="contact_form">
              <form method="post" action="{{ url('save-customer') }}" enctype="multipart/form-data" class="customer-save-form">
                @csrf
                <div class="form-group">
                 <label >Groom Name : </label>

                 <select class="custom-select mr-sm-2" name="relation_name" id="inlineFormCustomSelect">
                  <option selected value="">Choose... </option>
                  @foreach($customers as $customer_list)
                  <option value="{{$customer_list->id}}">{{$customer_list->full_name}} [{{$customer_list->phone}}]</option>
                  @endforeach
                </select>
              </div>
                <div class="form-group">
                 <label >Bride Name : </label>

                 <select class="custom-select mr-sm-2" name="relation_name" id="inlineFormCustomSelect">
                  <option selected value="">Choose... </option>
                  @foreach($customers as $customer_list)
                  <option value="{{$customer_list->id}}">{{$customer_list->full_name}} [{{$customer_list->phone}}]</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                  <label >Nikah Date : <span> *</span></label>
                  <input type="date" value="{{ old('dob', @$customer->dob) }}" class="form-control" id="dob" name="dob" >
                </div>
                <div class="form-group">
                	<label>Description<span> *</span></label>
                	<textarea class="form-textarea" rows="3" name="description"></textarea>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

@endsection