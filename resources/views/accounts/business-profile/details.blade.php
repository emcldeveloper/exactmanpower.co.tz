@extends($parent_layout)

@section('title', 'Create an ad')

@section('content')

<div class="{{ Request::is('admin/*')? 'p-4': null }}">

@include('accounts.business-profile.navigation')

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
                <label class="font-weight-bold mb-1" for="post_title">Company Name <span class="text-primary">*</span></label>
                <input type="text" class="form-control {{ $errors->has('post_title')? 'is-invalid': null }}" name="post_title" value="{{ old('post_title')? old('post_title'): (($post)? $post->post_title: null) }}" placeholder="Writte the name here..." id="_input_post_title">
                <div class="invalid-feedback" id="_input_help_post_title">{{ $errors->has('post_title')? $errors->first('post_title'): null }}</div>
            </div>
            <!----- End form field post_title ----->

            <!----- Start form field post_content ----->
            <div class="form-group">
                <label class="font-weight-bold mb-1" for="post_content">Company Description <span class="text-primary">*</span></label>
                <textarea type="text" rows="3" class="form-control ckeditor {{ $errors->has('post_content')? 'is-invalid': null }}" name="post_content" placeholder="Enter your description" id="_input_post_content">{{ old('post_content')? old('post_content'): (($post)? $post->post_content: null) }}</textarea>
                <div class="invalid-feedback" id="_input_help_post_content">{{ $errors->has('post_content')? $errors->first('post_content'): null }}</div>
            </div>
            <!----- End form field post_content ----->

            <!----- Start form field website_url ----->
            <div class="form-group">
                <label class="font-weight-bold mb-1" for="website_url">Website</label>
                <input type="text" class="form-control {{ $errors->has('website_url')? 'is-invalid': null }}" name="website_url" value="{{ old('website_url')? old('website_url'): (($post)? $post->website_url: null) }}" placeholder="Enter your website url" id="_input_website_url">
                <div class="invalid-feedback" id="_input_help_website_url">{{ $errors->has('website_url')? $errors->first('website_url'): null }}</div>
            </div>
            <!----- End form field website_url ----->

            <div class="row">
                <div class="col-12 col-lg-6">
                    <!----- Start form field document_type ----->
                    <div class="form-group">
                        <label class="font-weight-bold mb-1" for="document_type">Document Type</label>
                        <select class="form-control {{ $errors->has('document_type')? 'is-invalid': null }}" name="document_type" id="_input_document_type">
                            <option value>Please select type</option>
                            <option value="{{ Post::DOC_BROCHURE }}" {{ (old('document_type') == Post::DOC_BROCHURE)? 'selected': (($post && $post->document_type == Post::DOC_BROCHURE)? 'selected': null) }}>Brochure</option>
                            <option value="{{ Post::DOC_MENU }}" {{ (old('document_type') == Post::DOC_MENU)? 'selected': (($post && $post->document_type == Post::DOC_MENU)? 'selected': null) }}>Menu</option>
                            <option value="{{ Post::DOC_FLYER }}" {{ (old('document_type') == Post::DOC_FLYER)? 'selected': (($post && $post->document_type == Post::DOC_FLYER)? 'selected': null) }}>Flyer</option>
                            <option value="{{ Post::DOC_COMPANY_PROFILE }}" {{ (old('document_type') == Post::DOC_COMPANY_PROFILE)? 'selected': (($post && $post->document_type == Post::DOC_COMPANY_PROFILE)? 'selected': null) }}>Company Profile</option>
                            <option value="{{ Post::DOC_ADVERT }}" {{ (old('document_type') == Post::DOC_ADVERT)? 'selected': (($post && $post->document_type == Post::DOC_ADVERT)? 'selected': null) }}>Advert</option>
                            
                            <!-- <option value="{{ Post::DOC_BUSINESS_NAME }}" {{ (old('document_type') == Post::DOC_BUSINESS_NAME)? 'selected': (($post && $post->document_type == Post::DOC_BUSINESS_NAME)? 'selected': null) }}>Business Name certificate</option> -->
                            <!-- <option value="{{ Post::DOC_TIN }}" {{ (old('document_type') == Post::DOC_TIN)? 'selected': (($post && $post->document_type == Post::DOC_TIN)? 'selected': null) }}>TIN certificate</option> -->
                            <!-- <option value="{{ Post::DOC_LICENSE }}" {{ (old('document_type') == Post::DOC_LICENSE)? 'selected': (($post && $post->document_type == Post::DOC_LICENSE)? 'selected': null) }}>License certificate</option> -->
                        </select>
                        <div class="invalid-feedback" id="_input_help_document_type">{{ $errors->has('document_type')? $errors->first('document_type'): null }}</div>
                    </div>
                    <!----- End form field document_type ----->
                </div>
                <div class="col-12 col-lg-6">
                    <!----- Start form field document ----->
                    <div class="form-group">
                        <label class="font-weight-bold mb-1" for="document">Document {{ ($post && $post->document_url)? '('.$post->document_url.')': ''}}</label>
                        <div class="custom-file {{ $errors->has('document')? 'is-invalid': null }}">
                            <label class="custom-file-label" for="file-document" data-browse="Bestand kiezen">{{ ($post && $post->document_url)? $post->document_url: 'Browse'}}</label>
                            <input name="document" type="file" class="custom-file-input" id="file-document">
                        </div>
                        <div class="invalid-feedback" id="_input_help_document">{{ $errors->has('document')? $errors->first('document'): null }}</div>
                    </div>
                    <!----- End form field document ----->
                </div>
            </div>

            <div class="row">
            @foreach($socials_list as $row)
                <div class="col-12 col-lg-6">
                    <!----- Start form field {{ Str::slug($row->name, '_') }}_url ----->
                    <div class="form-group">
                        <label class="font-weight-bold mb-1" for="{{ Str::slug($row->name, '_') }}_url">{{ $row->name }}</label>
                    <?php // dd(old('socials')); ?>
                    @if(($post && $post->socials && $post->socials->count()) || old('socials') )
                        @php 
                        $isset = false;
                        if(old('socials')):
                        foreach(old('socials') as $key => $value): 
                        @endphp
                            @if($key == $row->social_id)
                            @php $isset = true; @endphp
                            <input type="text" class="form-control {{ $errors->has('socials.'.$row->social_id)? 'is-invalid': null }}" name="socials[{{$row->social_id}}]" value="{{ $value }}" placeholder="Enter your {{ $row->name }} url" id="_input_{{ Str::slug($row->name, '_') }}_url">
                            @endif
                        @php 
                        endforeach; 
                        else:
                            foreach($post->socials as $social): 
                        @endphp
                                @if($social->social_id == $row->social_id)
                                @php $isset = true; @endphp
                                <input type="text" class="form-control {{ $errors->has('socils.'.$row->social_id)? 'is-invalid': null }}" name="socials[{{$row->social_id}}]" value="{{ old('socils.'.$row->social_id)? old('socils.'.$row->social_id): $social->url }}" placeholder="Enter your {{ $row->name }} url" id="_input_{{ Str::slug($row->name, '_') }}_url">
                                @endif
                        @php 
                            endforeach; 
                        endif;
                        @endphp
                        @if(!$isset)
                        <input type="text" class="form-control {{ $errors->has('socils.'.$row->social_id)? 'is-invalid': null }}" name="socials[{{$row->social_id}}]" value="{{ old('socils.'.$row->social_id)? old('socils.'.$row->social_id): null }}" placeholder="Enter your {{ $row->name }} url" id="_input_{{ Str::slug($row->name, '_') }}_url">
                        @endif
                    @else
                        <input type="text" class="form-control {{ $errors->has('socils.'.$row->social_id)? 'is-invalid': null }}" name="socials[{{$row->social_id}}]" value="{{ old('socils.'.$row->social_id)? old('socils.'.$row->social_id): null }}" placeholder="Enter your {{ $row->name }} url" id="_input_{{ Str::slug($row->name, '_') }}_url">
                    @endif
                        <div class="invalid-feedback" id="_input_help_{{ Str::slug($row->name, '_') }}_url">{{ $errors->has('socils.'.$row->social_id)? $errors->first('socils.'.$row->social_id): null }}</div>
                    </div>
                    <!----- End form field {{ Str::slug($row->name, '_') }}_url ----->
                </div>
            @endforeach
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
            
            <h6 class="mb-2">Working hours</h6>

            @include('accounts.business-profile.__working_time')
        </div>
    </div>

    @if(false)
    <!-- <div class="bg-white p-4 mt-4">
        <div class="clearfix">
            <div class="form-group">
                <label class="font-weight-bold mb-1" for="suggestions">Other Features Suggestions</label>
                <textarea type="text" rows="3" class="form-control ckeditor {{ $errors->has('suggestions')? 'is-invalid': null }}" name="suggestions" placeholder="Enter your suggestions" id="_input_suggestions">{{ old('suggestions')? old('suggestions'): (($post)? $post->suggestions: null) }}</textarea>
                <div class="invalid-feedback" id="_input_help_suggestions">{{ $errors->has('suggestions')? $errors->first('suggestions'): null }}</div>
            </div>
        </div>
    </div> -->
    @endif

    <div class="bg-white p-4 mt-4">
        <div class="text-center py-3">
            <h5>My Address Details</h5>
        </div>
        <div class="clearfix">
            <!----- Start form field directions ----->
            <div class="form-group">
                <label class="font-weight-bold mb-1" for="directions">Directions <span class="text-primary">*</span></label>
                <textarea rows="3" class="form-control ckeditor {{ $errors->has('directions')? 'is-invalid': null }}" name="directions" placeholder="Enter your directions" id="_input_directions">{{ old('directions')? old('directions'): (($post)? $post->directions: null) }}</textarea>
                <div class="invalid-feedback" id="_input_help_directions">{{ $errors->has('directions')? $errors->first('directions'): null }}</div>
            </div>
            <!----- End form field directions ----->

            <!----- Start form field street_address ----->
            <div class="form-group">
                <label class="font-weight-bold mb-1" for="street_address">Street address <span class="text-primary">*</span></label>
                <input type="text" class="form-control {{ $errors->has('street_address')? 'is-invalid': null }}" name="street_address" value="{{ old('street_address')? old('street_address'): (($post)? $post->street_address: null) }}" placeholder="Enter your street address" id="_input_street_address">
                <div class="invalid-feedback" id="_input_help_street_address">{{ $errors->has('street_address')? $errors->first('street_address'): null }}</div>
            </div>
            <!----- End form field street_address ----->

            <!----- Start form field post_code ----->
            <div class="form-group">
                <label class="font-weight-bold mb-1" for="post_code">Post Code</label>
                <input type="text" class="form-control {{ $errors->has('post_code')? 'is-invalid': null }}" name="post_code" value="{{ old('post_code')? old('post_code'): (($post)? $post->post_code: null) }}" placeholder="Enter your post code" id="_input_post_code">
                <div class="invalid-feedback" id="_input_help_post_code">{{ $errors->has('post_code')? $errors->first('post_code'): null }}</div>
            </div>
            <!----- End form field post_code ----->

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
                <label class="font-weight-bold mb-1" for="geolocation">Use google map to show you location <span class="text-primary">*</span></label>
                <div class="bg-light" style="min-height:300px;">

                </div>
                <div class="invalid-feedback" id="_input_help_geolocation">{{ $errors->has('geolocation')? $errors->first('geolocation'): null }}</div>
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
                <div class="form-control">{{ old('contact_name')? old('contact_name'): $account->first_name.' '.$account->last_name }}</div>
                <div class="invalid-feedback" id="_input_help_contact_name">{{ $errors->has('contact_name')? $errors->first('contact_name'): null }}</div>
            </div>
            <!----- End form field contact_name ----->

            <!----- Start form field email_address ----->
            <div class="form-group">
                <label class="font-weight-bold mb-1" for="email_address">Email Address</label>
                <!-- <input type="text" class="form-control {{ $errors->has('email_address')? 'is-invalid': null }}" name="email_address" value="{{ old('email_address')? old('email_address'): $account->email }}" placeholder="Enter your email address" id="_input_email_address"> -->
                <div class="form-control">{{ old('email_address')? old('email_address'): $account->email }}</div>
                <div class="invalid-feedback" id="_input_help_email_address">{{ $errors->has('email_address')? $errors->first('email_address'): null }}</div>
            </div>
            <!----- End form field email_address ----->

            <!----- Start form field mobile_number ----->
            <div class="form-group">
                <label class="font-weight-bold mb-1" for="mobile_number">Mobile Number</label>
                <!-- <input type="text" class="form-control {{ $errors->has('mobile_number')? 'is-invalid': null }}" name="mobile_number" value="{{ old('mobile_number')? old('mobile_number'): $account->phone }}" placeholder="Enter your mobile number" id="_input_mobile_number"> -->
                <div class="form-control">{{ old('mobile_number')? old('mobile_number'): $account->phone }}</div>
                <div class="invalid-feedback" id="_input_help_mobile_number">{{ $errors->has('mobile_number')? $errors->first('mobile_number'): null }}</div>
            </div>
            <!----- End form field mobile_number ----->
        </div>
    </div>

    <div class="mt-4 text-center">
        <a class="btn btn-light border px-5" href="{{ url($route.'/category') }}">Back</a>
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