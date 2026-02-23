@extends($parent_layout)

@section('title', 'Create an ad')

@section('content')

<div class="{{ Request::is('admin/*')? 'p-4': null }}">

@include('accounts.create-ads.navigation')

<style type="text/css">
.mapControls {
    /* margin-top: 10px;
    border: 1px solid transparent;
    border-radius: 2px 0 0 2px;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    height: 32px;
    outline: none;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3); */
}
#_input_address {
    /* background-color: #fff;
    font-family: Roboto;
    font-size: 15px;
    font-weight: 300;
    margin-left: 12px;
    padding: 0 11px 0 13px;
    text-overflow: ellipsis;
    width: 50%; */
}
#_input_address:focus {
    border-color: #4d90fe;
}
</style>

<form action="{{ url($route.'/details/'.request('post_id')) }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" name="category_id" value="{{ $category_id }}">
    <input type="hidden" name="package_id" value="{{ $package_id }}">
    @if($post)
    <input type="hidden" name="post_id" value="{{ $post->post_id }}">
    @endif
    <div class="bg-white p-4 ">
        <div class="text-center py-3">
            <h4>AD DETAILS</h4>
            <h5 class="text-light font-weight-light">Fill in all the necessary info that will make your ad interesting</h5>
        </div>
        
        <!----- Include view from components/alert----->
        @component('components.alert')@endcomponent
        <!----- End include view from components/alert----->

        <div class="py-4">
            <ol class="breadcrumb bg-transparent small p-0 m-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                {!! $categories_tree !!}
            </ol>
        </div>

        <div class="clearfix">
            <!----- Start form field post_title ----->
            <div class="form-group">
                <label class="font-weight-bold mb-1" for="post_title">Title <span class="text-primary">*</span></label>
                <input type="text" class="form-control {{ $errors->has('post_title')? 'is-invalid': null }}" name="post_title" value="{{ old('post_title')? old('post_title'): (($post)? $post->post_title: null) }}" placeholder="Enter your title" id="_input_post_title">
                <div class="invalid-feedback" id="_input_help_post_title">{{ $errors->has('post_title')? $errors->first('post_title'): null }}</div>
            </div>
            <!----- End form field post_title ----->

            <!----- Start form field post_content ----->
            <div class="form-group">
                <label class="font-weight-bold mb-1" for="post_content">Description / Features<span class="text-primary">*</span></label>
                <textarea type="text" rows="3" class="form-control ckeditor {{ $errors->has('post_content')? 'is-invalid': null }}" name="post_content" placeholder="Enter your description" id="_input_post_content">{{ old('post_content')? old('post_content'): (($post)? $post->post_content: null) }}</textarea>
                <div class="invalid-feedback" id="_input_help_post_content">{{ $errors->has('post_content')? $errors->first('post_content'): null }}</div>
            </div>
            <!----- End form field post_content ----->

            <div class="row">
                <div class="col-12 col-lg-4">
                    <!----- Start form field price ----->
                    <div class="form-group">
                        <label class="font-weight-bold mb-1" for="price">Price <span class="text-primary">*</span></label>
                        <input type="text" class="form-control {{ $errors->has('price')? 'is-invalid': null }}" name="price" value="{{ old('price')? old('price'): (($post)? $post->price: null) }}" placeholder="Enter your price" id="_input_price">
                        <div class="invalid-feedback" id="_input_help_price">{{ $errors->has('price')? $errors->first('price'): null }}</div>
                    </div>
                    <!----- End form field price ----->
                </div>
                <div class="col-12 col-lg-4">
                    <!----- Start form field is_price_negotiable ----->
                    <div class="form-group">
                        <label class="font-weight-bold mb-1" for="is_price_negotiable">Price negotiable <span class="text-primary">*</span></label>
                        <select class="form-control {{ $errors->has('is_price_negotiable')? 'is-invalid': null }}" name="is_price_negotiable" id="_input_is_price_negotiable">
                            <option value="1" {{ (old('is_price_negotiable') == 1)? 'selected': (($post && $post->is_price_negotiable == 1)? 'selected': null) }}>Yes</option>
                            <option value="0" {{ (old('is_price_negotiable') == 0)? 'selected': (($post && $post->is_price_negotiable == 0)? 'selected': null) }}>No</option>
                        </select>
                        <div class="invalid-feedback" id="_input_help_is_price_negotiable">{{ $errors->has('is_price_negotiable')? $errors->first('is_price_negotiable'): null }}</div>
                    </div>
                    <!----- End form field is_price_negotiable ----->
                </div>
                <div class="col-12 col-lg-4">
                    <!----- Start form field condition ----->
                    <div class="form-group">
                        <label class="font-weight-bold mb-1" for="condition">Condition <span class="text-primary">*</span></label>
                        <select class="form-control {{ $errors->has('condition')? 'is-invalid': null }}" name="condition" id="_input_condition">
                            <option value="">Please select</option>
                            @foreach($category->conditions as $row)
                            <option value="{{ $row->category_element_option_id }}" {{ (old('condition') == $row->category_element_option_id)? 'selected': (($post && $post->condition_id == $row->category_element_option_id)? 'selected': null) }}>{{ $row->label }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback" id="_input_help_condition">{{ $errors->has('condition')? $errors->first('condition'): null }}</div>
                    </div>
                    <!----- End form field condition ----->
                </div>
            </div>

            <div class="row">
                @foreach($category->category_elements as $row)
                <div class="col-12 col-lg-6">
                    @if($row->input_type == CategoryElement::TYPE_TEXT)
                        @component('accounts.create-ads-fields.text', ['row'=>$row])@endcomponent
                    @elseif($row->input_type == CategoryElement::TYPE_TEXTAREA)
                        @component('accounts.create-ads-fields.textarea', ['row'=>$row])@endcomponent
                    @elseif($row->input_type == CategoryElement::TYPE_TAGS)
                        @component('accounts.create-ads-fields.tags', ['row'=>$row])@endcomponent
                    @elseif($row->input_type == CategoryElement::TYPE_SLIDER)
                        @component('accounts.create-ads-fields.slider', ['row'=>$row])@endcomponent
                    @elseif($row->input_type == CategoryElement::TYPE_SELECT)
                        @component('accounts.create-ads-fields.select', ['row'=>$row])@endcomponent
                    @elseif($row->input_type == CategoryElement::TYPE_CHECKBOX)
                        @component('accounts.create-ads-fields.checkbox', ['row'=>$row])@endcomponent
                    @elseif($row->input_type == CategoryElement::TYPE_RADIO)
                        @component('accounts.create-ads-fields.radio', ['row'=>$row])@endcomponent
                    @elseif($row->input_type == CategoryElement::TYPE_SWITCH)
                        @component('accounts.create-ads-fields.switch', ['row'=>$row])@endcomponent
                    @else
                        @component('accounts.create-ads-fields.text', ['row'=>$row])@endcomponent
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- <div class="bg-white p-4 mt-4">
        <div class="clearfix">
            <div class="form-group">
                <label class="font-weight-bold mb-1" for="suggestions">Other Features Suggestions</label>
                <textarea type="text" rows="3" class="form-control ckeditor {{ $errors->has('suggestions')? 'is-invalid': null }}" name="suggestions" placeholder="Enter your description" id="_input_suggestions">{{ old('suggestions')? old('suggestions'): (($post)? $post->suggestions: null) }}</textarea>
                <div class="invalid-feedback" id="_input_help_suggestions">{{ $errors->has('suggestions')? $errors->first('suggestions'): null }}</div>
            </div>
        </div>
    </div> -->


    <div class="bg-white p-4 mt-4">
        <div class="text-center py-3">
            <h5>My Address Details</h5>
        </div>
        <div class="clearfix">

            <!----- Start form field location_id ----->
            <div class="form-group">
                <label class="font-weight-bold mb-1" for="location_id">City <span class="text-primary">*</span></label>
                <select class="form-control {{ $errors->has('location_id')? 'is-invalid': null }}" name="location_id" id="_input_location_id">
                    <option value="">Please select location</option>
                    @foreach($locations_list as $row)
                    <option value="{{ $row->location_id }}" {{ ( (old('location_id') == $row->location_id)? 'selected':(($post && $post->location_id == $row->location_id)? 'selected': null) ) }}>{{ $row->name }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback" id="_input_help_location_id">{{ $errors->has('location_id')? $errors->first('location_id'): null }}</div>
            </div>
            <!----- End form field location_id ----->

            <!----- Start form field address ----->
            <!-- <div class="form-group">
                <label class="font-weight-bold mb-1" for="address">Address</label>
                <input type="text" class="form-control mapControls {{ $errors->has('address')? 'is-invalid': null }}" name="address" value="{{ old('address')? old('address'): (($post)? $post->address: null) }}" placeholder="Enter your address" id="_input_address">
                
                <div class="invalid-feedback" id="_input_help_address">{{ $errors->has('address')? $errors->first('address'): null }}</div>
                <ul id="geoData">
                    <li>Full Address: <span id="location-snap"></span></li>
                    <li>Latitude: <span id="lat-span"></span></li>
                    <li>Longitude: <span id="lon-span"></span></li>
                </ul>
            </div> -->

            <!----- Start form field is_delivery_offered ----->
            <div class="form-group">
                <label class="font-weight-bold mb-1" for="is_delivery_offered">Delivery offered <span class="text-primary">*</span></label>
                <select class="form-control {{ $errors->has('is_delivery_offered')? 'is-invalid': null }}" name="is_delivery_offered" id="_input_is_delivery_offered">
                    <option value="1" {{ (old('is_delivery_offered') == 1)? 'selected': (($post && $post->is_delivery_offered == 1)? 'selected': null) }}>Yes</option>
                    <option value="0" {{ (old('is_delivery_offered') == 0)? 'selected': (($post && $post->is_delivery_offered == 0)? 'selected': null) }}>No</option>
                </select>
                <div class="invalid-feedback" id="_input_help_is_delivery_offered">{{ $errors->has('is_delivery_offered')? $errors->first('is_delivery_offered'): null }}</div>
            </div>
            <!----- End form field is_delivery_offered ----->

            
        </div>
    </div>

    <div class="bg-white p-4 mt-4">
        <div class="text-center py-3">
            <h5>My Contact Details</h5>
        </div>
        <div class="clearfix">

            <!----- Start form field contact_name ----->
            <div class="form-group">
                <label class="font-weight-bold mb-1" for="contact_name">Contact Name</label>
                <!-- <input type="text" class="form-control {{ $errors->has('contact_name')? 'is-invalid': null }}" name="contact_name" value="{{ old('contact_name')? old('contact_name'): $account->first_name.' '.$account->last_name }}" placeholder="Enter your contact name" id="_input_contact_name"> -->
                <div class="form-control">{{ old('contact_name')? old('contact_name'): $user->first_name.' '.$user->last_name }}</div>
                <div class="invalid-feedback" id="_input_help_contact_name">{{ $errors->has('contact_name')? $errors->first('contact_name'): null }}</div>
            </div>
            <!----- End form field contact_name ----->

            <!----- Start form field email_address ----->
            <div class="form-group">
                <label class="font-weight-bold mb-1" for="email_address">Email Address</label>
                <!-- <input type="text" class="form-control {{ $errors->has('email_address')? 'is-invalid': null }}" name="email_address" value="{{ old('email_address')? old('email_address'): $account->email }}" placeholder="Enter your email address" id="_input_email_address"> -->
                <div class="form-control">{{ old('email_address')? old('email_address'): $user->email }}</div>
                <div class="invalid-feedback" id="_input_help_email_address">{{ $errors->has('email_address')? $errors->first('email_address'): null }}</div>
            </div>
            <!----- End form field email_address ----->

            <!----- Start form field mobile_number ----->
            <div class="form-group">
                <label class="font-weight-bold mb-1" for="mobile_number">Mobile Number</label>
                @if(!$user->phone || $user->phone == "")
                <input type="text" class="form-control {{ $errors->has('mobile_number')? 'is-invalid': null }}" name="mobile_number" value="{{ old('mobile_number')? old('mobile_number'): $user->phone }}" placeholder="Enter your mobile number" id="_input_mobile_number">
                @else
                <div class="form-control">{{ old('mobile_number')? old('mobile_number'): $user->phone }}</div>
                @endif
                <div class="invalid-feedback" id="_input_help_mobile_number">{{ $errors->has('mobile_number')? $errors->first('mobile_number'): null }}</div>
            </div>
            <!----- End form field mobile_number ----->

            @if( !($account->identity_type && $account->identity_url) )
            <div class="row">
                <div class="col-12 col-lg-6">
                    <!----- Start form field identity_type ----->
                    <div class="form-group">
                        <label class="font-weight-bold mb-1" for="identity_type">Identity Type <span class="text-primary">*</span></label>
                        <select class="form-control {{ $errors->has('identity_type')? 'is-invalid': null }}" name="identity_type" id="_input_identity_type">
                            <option value="{{ Account::DOC_PASSPORT }}" {{ (old('identity_type') == Account::DOC_PASSPORT)? 'selected': (($account && $account->identity_type == Account::DOC_PASSPORT)? 'selected': null) }}>PASSPORT</option>
                            <option value="{{ Account::DOC_NATIONAL_ID }}" {{ (old('identity_type') == Account::DOC_NATIONAL_ID || old('identity_type') == null )? 'selected': (($account && $account->identity_type == Account::DOC_NATIONAL_ID || old('identity_type') == null)? 'selected': null) }}>NATIONAL ID</option>
                            <option value="{{ Account::DOC_VOTER_ID }}" {{ (old('identity_type') == Account::DOC_VOTER_ID)? 'selected': (($account && $account->identity_type == Account::DOC_VOTER_ID)? 'selected': null) }}>VOTER ID</option>
                        </select>
                        <div class="invalid-feedback" id="_input_help_identity_type">{{ $errors->has('identity_type')? $errors->first('identity_type'): null }}</div>
                    </div>
                    <!----- End form field identity_type ----->
                </div>
                <div class="col-12 col-lg-6">
                    <!----- Start form field identity_url ----->
                    <div class="form-group">
                        <label class="font-weight-bold mb-1" for="identity_url">Identity ID</label>
                        <div class="custom-file {{ $errors->has('identity_url')? 'is-invalid': null }}">
                            <label class="custom-file-label" for="file-identity-url" data-browse="Select ">{{ ($account->identity_url)? $account->identity_url: 'Browse'}}</label>
                            <input name="identity_url" type="file" class="custom-file-input" id="file-identity-url">
                        </div>
                        <div class="invalid-feedback" id="_input_help_identity_url">{{ $errors->has('identity_url')? $errors->first('identity_url'): null }}</div>
                    </div>
                    <!----- End form field identity_url ----->
                </div>
            </div>
            @else
            <input type="hidden" name="is_identity_set" value="true">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <!----- Start form field identity_type ----->
                    <div class="form-group">
                        <label class="font-weight-bold mb-1" for="identity_type">Identity Type <span class="text-primary">*</span></label>
                        <div class="form-control {{ $errors->has('identity_type')? 'is-invalid': null }}">
                            @if($account && $account->identity_type == Account::DOC_PASSPORT)
                                PASSPORT
                            @elseif($account && $account->identity_type == Account::DOC_NATIONAL_ID)
                                NATIONAL ID
                            @else
                                NATIONAL ID
                            @endif
                        </div>
                        <div class="invalid-feedback" id="_input_help_identity_type">{{ $errors->has('identity_type')? $errors->first('identity_type'): null }}</div>
                    </div>

                    <!----- End form field identity_type ----->

                    <img src="{{ asset('uploaded/'.$account->identity_url) }}" class="img-fluid" alt="ID">
                </div>
                <div class="col-12 col-lg-4">
                    <!----- Start form field identity_url ----->
                    <!-- <div class="form-group">
                        <label class="font-weight-bold mb-1" for="identity_url">Identity ID</label>
                        <div class="custom-file {{ $errors->has('identity_url')? 'is-invalid': null }}">
                            <label class="custom-file-label" for="file-identity_url" data-browse="Select ">{{ ($account->identity_url)? $account->identity_url: 'Browse'}}</label>
                            <div class="custom-file-input" id="file-identity_url"></div>
                        </div>
                        <div class="invalid-feedback" id="_input_help_identity_url">{{ $errors->has('identity_url')? $errors->first('identity_url'): null }}</div>
                    </div> -->
                    <!----- End form field identity_url ----->
                </div>
            </div>
            @endif

            
        </div>
    </div>

    <div class="mt-4 text-center">
        <a class="btn btn-light border px-5" href="{{ url($route.'/category/'.request('post_id')) }}">Back</a>
        <button type="submit" class="btn btn-primary px-5">Next</button>
    </div>
</form>
</div>

<script>
function initMap() {
    var input = document.getElementById('_input_address');
  
    var autocomplete = new google.maps.places.Autocomplete(input);
   
    autocomplete.addListener('place_changed', function() {
        var place = autocomplete.getPlace();
        document.getElementById('location-snap').innerHTML = place.formatted_address;
        document.getElementById('lat-span').innerHTML = place.geometry.location.lat();
        document.getElementById('lon-span').innerHTML = place.geometry.location.lng();
    });
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_key') }}&libraries=places&callback=initMap" async defer></script>

@endsection