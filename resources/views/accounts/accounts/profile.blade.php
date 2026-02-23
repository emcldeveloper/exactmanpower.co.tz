@extends('account')

@section('title', 'Profile')

@section('content')

@include('accounts.accounts.navigation')

<style>
.custom-file-label {
    padding-left: 90px;
}

.custom-file-label::after {
    border: 1px solid #fff;
    left: 0; 
    right: auto;
}
</style>

<!----- Include view from components/alert----->
@component('components.alert')@endcomponent
<!----- End include view from components/alert----->

<div class="card border-0 p-4 ">
    <div class="row align-items-center ">
        <div class="col-12 col-md-3 text-center">
            <!-- <img width="100" src="{{ user()->get_profile_url() }}" alt=""  class="rounded-circle border m-auto"> -->
            <div class="image-profile rounded-circle border m-auto" style="background:url('{{ user()->get_profile_url() }}');width:80px;height:80px;"></div>
        </div>
        <div class="col-12 col-md-8">
            <form action="{{ url('account/setting/profile-image') }}" method="post" class="row"  enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="col custom-file">
                    <label class="custom-file-label" for="customFileLangHTML">Select picture</label>
                    <input name="profile" type="file" class="custom-file-input" id="customFileLangHTML">
                </div>
                <button type="submit" class="btn btn-primary">Upload</button>
            </form>
        </div>
    </div>
</div>

<div class="card border-0 p-4 mt-4">
    <form action="{{ url('account/setting/profile') }}" method="post" class="w-75">
        {{ csrf_field() }}
        <!----- Start form field name ----->
        <div class="form-group">
            <label class="mb-1" for="name">Conctact Name</label>
            <input type="text" class="form-control {{ $errors->has('name')? 'is-invalid': null }}" name="name" value="{{ $account_model->name }}" placeholder="Enter contact name" id="_input_name">
            <div class="invalid-feedback" id="_input_help_name">{{ $errors->has('name')? $errors->first('name'): null }}</div>
        </div>
        <!----- End form field name ----->
         
        
        <!----- Start form field location_id ----->
        <div class="form-group">
            <label class="mb-1" for="location_id">City</label>
            <select class="form-control {{ $errors->has('location_id')? 'is-invalid': null }}" name="location_id" id="_input_location_id">
                <option value="">Please select location</option>
                @foreach($locations_list as $row)
                <option value="{{ $row->location_id }}" {{ ( ($account_model->location_id == $row->location_id)? 'selected':null ) }}>{{ $row->name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback" id="_input_help_location_id">{{ $errors->has('location_id')? $errors->first('location_id'): null }}</div>
        </div>
        <!----- End form field location_id ----->
        
        
        <!----- Start form field language ----->
        <div class="form-group">
            <label class="mb-1" for="language">Preferred Language</label>
            <select class="form-control {{ $errors->has('language')? 'is-invalid': null }}" name="language" id="_input_language">
                <option value="English" {{ ($account_model->language == 'en')? 'selected': null }}>English</option>
                <option value="Swahili" {{ ($account_model->language == 'sw')? 'selected': null }}>Swahili</option>
            </select>
            <div class="invalid-feedback" id="_input_help_language">{{ $errors->has('language')? $errors->first('language'): null }}</div>
        </div>
        <!----- End form field language ----->

        <!----- Start form field type ----->
        <div class="form-group">
            <label class="mb-1" for="type">Seller Type</label>
            <select class="form-control {{ $errors->has('type')? 'is-invalid': null }}" name="type" id="_input_type">
                <option value="">Please select</option>
                <option value="0" {{ ($account_model->type == 0)? 'selected': null }}>Private</option>
                <option value="1" {{ ($account_model->type == 1)? 'selected': null }}>Business</option>
            </select>
            <div class="invalid-feedback" id="_input_help_type">{{ $errors->has('type')? $errors->first('type'): null }}</div>
        </div>
        <!----- End form field type ----->

        <!----- Start form field is_delivery_offered ----->
        <div class="form-group">
            <label class="mb-1" for="is_delivery_offered">Delivery Offered</label>
            <select class="form-control {{ $errors->has('is_delivery_offered')? 'is-invalid': null }}" name="is_delivery_offered" id="_input_is_delivery_offered">
                <option value="1" {{ ($account_model->is_delivery_offered == 1)? 'selected': null }}>Yes</option>
                <option value="0" {{ ($account_model->is_delivery_offered == 0)? 'selected': null }}>No</option>
            </select>
            <div class="invalid-feedback" id="_input_help_is_delivery_offered">{{ $errors->has('is_delivery_offered')? $errors->first('is_delivery_offered'): null }}</div>
        </div>
        <!----- End form field is_delivery_offered ----->

        <!----- Start form field delivery_details ----->
        <div class="form-group">
            <label class="mb-1" for="delivery_details">Delivery Details</label>
            <textarea type="text" rows="5" class="form-control ckeditor {{ $errors->has('delivery_details')? 'is-invalid': null }}" name="delivery_details" placeholder="Enter your delivery details" id="_input_delivery_details">{{ $account_model->delivery_details }}</textarea>
            <div class="invalid-feedback" id="_input_help_delivery_details">{{ $errors->has('delivery_details')? $errors->first('delivery_details'): null }}</div>
        </div>
        <!----- End form field delivery_details ----->


        <button type="submit" class="btn btn-primary btn-block my-1 ">Save</button>
    </form>  
</div>

@endsection
