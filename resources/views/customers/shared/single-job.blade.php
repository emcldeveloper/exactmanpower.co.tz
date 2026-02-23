<div class="card p-4">
    <div class="d-flex justify-content-between  align-items-center">
        <div class="small">
            <a href="{{ url('job/search') }}" class="btn btn-sm btn-outline-dark px-3 mr-4">
                <i class="fa fa-arrow-left mr-2"></i> Back
            </a>
            
        </div>
        <ol class="breadcrumb bg-transparent small p-0 m-0">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('jon/search') }}">Job</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">{{ (isset($post->post_profile) && isset($post->post_profile['industry']))? $post->post_profile['industry']: null }}</a></li>
        </ol>
    </div>
</div>

<div class="card p-4 mt-4">
    <h3 class="font-weight-bold text-primary">{{ $post->post_title }}</h3>
    <hr>
    <div class="row">
        <div class="col-12 col-md-6 col-lg-3 ">
            <div class="title font-weight-bold">Job Type</div>
            <div class="value">{{ (isset($post->post_profile) && isset($post->post_profile['job_type']))? $post->post_profile['job_type']: null }}</div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="title font-weight-bold">Nature</div>
            <div class="value">{{ (isset($post->post_profile) && isset($post->post_profile['nature']))? $post->post_profile['nature']: null }}</div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="title font-weight-bold">Company</div>
            <div class="value">{{ (isset($post->post_profile) && isset($post->post_profile['company']))? $post->post_profile['company']: null }}</div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="title font-weight-bold">Location</div>
            <div class="value">{{ (isset($post->location))? $post->location: null }}</div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12 col-md-6 col-lg-3">
            <div class="title font-weight-bold">Deadline</div>
            <div class="value">{{ (isset($post->post_profile) && isset($post->post_profile['application_deadline']))? $post->post_profile['application_deadline']: null }}</div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="title font-weight-bold">Industry</div>
            <div class="value">{{ (isset($post->post_profile) && isset($post->post_profile['industry']))? $post->post_profile['industry']: null }}</div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="title font-weight-bold">Position Level</div>
            <div class="value">{{ (isset($post->post_profile) && isset($post->post_profile['position_level']))? $post->post_profile['position_level']: null }}</div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="title font-weight-bold">Salary</div>
            <div class="value">{{ (isset($post->post_profile) && isset($post->post_profile['salary']))? $post->post_profile['salary']: null }}</div>
        </div>
    </div>
</div>

<div class="card p-4 mt-4">
    <h3 class="font-weight-bold">Reporting Structure</h3>
    <hr>
    <div class="clearfix">
        @if(isset($post->post_reporting_structure))
        @foreach($post->post_reporting_structure as $row)
        <div class="row mb-3">
            <div class="col-12 col-lg-3 font-weight-bold">{{ $row['key'] }}</div>
            <div class="col-12 col-lg-9">{{ $row['value'] }}</div>
        </div>
        @endforeach
        @endif
    </div>
</div>

<div class="card p-4 mt-4">
    <h3 class="font-weight-bold">Main Duties</h3>
    <hr>
    <div class="clearfix">
        {!! $post->post_duties !!}
        
    </div>
    <div class="clearfix text-right">
        @if($post->post_document_url && $post->post_document_url != '')
        <a href="{{ $post->post_document_url }}" class="btn btn-primary" target="_blank1"><i class="fa fa-download mr-2"></i> Download Attachment</a>
        @endif
    </div>
</div>

<div class="card p-4 mt-4">
    <h3 class="font-weight-bold">Candidate Specifications</h3>
    <hr>
    <div class="clearfix">
        @if(isset($post->post_specifications))
        @foreach($post->post_specifications as $row)
        <div class="row mb-3">
            <div class="col-12 col-lg-3 font-weight-bold">{{ $row['key'] }}</div>
            <div class="col-12 col-lg-9">{{ $row['value'] }}</div>
        </div>
        @endforeach
        @endif
    </div>
</div>


<div class="card p-4 mt-4">
    <h3 class="font-weight-bold">Minimum Qualifications</h3>
    <hr>
    <div class="clearfix">
        {!! $post->post_qualifications !!}
    </div>
</div>