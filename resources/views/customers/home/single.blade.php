@extends($parent_layout)

@section('title', $post->post_title)

@section('main-search')
    @include('components.search', ['search_layout'=>'search'])
@endsection

@section('content')

<style>
.lSSlideWrapper {
    border: 1px solid #cccccc;
}

.lSSlideWrapper > ul {
    display: flex;
    align-items: center;
    height: 100%;
}

.lSSlideOuter .lSPager.lSGallery {
    max-height: 90px;
}

.lSSlideOuter .lSPager.lSGallery li {
    border: 1px solid #cccccc;
    max-height: 90px;
    
}

.lSSlideOuter .lSPager.lSGallery li.active, 
.lSSlideOuter .lSPager.lSGallery li:hover {
    border-radius: 0;
    background-color: #ff8000;
}
.lSSlideOuter .lSPager.lSGallery li.active img, 
.lSSlideOuter .lSPager.lSGallery li:hover img {
    opacity: 0.5;
}
</style>
<div class="clearfix py-4">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8">
                @if(Request::is('admin/manage-ads/*') || user('user_id') == $post->post_author)
                @if($post->post_status == Post::STATUS_APPROVED)
                <div class="card mb-4 alert-success">
                @elseif($post->post_status == Post::STATUS_REJECTED)
                <div class="card mb-4 alert-danger">
                @else
                <div class="card mb-4 alert-warning">
                @endif
                    <div class="card-body text-center">
                        <h3>{{ $post->status() }}</h3>
                        @if(Request::is('admin/manage-ads/*') && $post->expired_date)
                        <div>
                            Expire on {{ date('d M, Y', strtotime($post->expired_date)) }}
                            <a data-toggle="modal" href="#model_change_expire_date" class="btn btn-outline-dark btn-sm">Change</a>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="card card-body mb-4">
                    <h5>Reported issues</h5>
                    @foreach($post->reported_posts as $row)
                    @php 
                    $alert = 'alert-warning';
                    if($row->status == 1){
                        $alert = 'alert-success';
                    } elseif($row->status == 2) {
                        $alert = 'alert-danger';
                    }
                    @endphp
                    <div class="card card-body alert {{ $alert }} font-italic py-2 p">
                        <div class="d-flex justify-content-between">
                            <div>
                                <div>{{ date('M d, Y', strtotime($row->reported_time)) }}</div>
                                <div>{{ $row->notes }}</div>
                            </div>
                            @if(Request::is('admin/manage-ads/*'))
                            <div>
                                <a href="{{ url('admin/action/reported-post/'.$row->reported_post_id.'/clear') }}" class="btn btn-sm btn-success">Clear</a>
                                <a href="{{ url('admin/action/reported-post/'.$row->reported_post_id.'/ban') }}" class="btn btn-sm btn-danger">Block</a>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                    @if(!$post->reported_posts->count())
                    <div class="card card-body">
                        No issues
                    </div>
                    @endif
                </div>

                @endif

                @if($post->is_business())
                    @include('customers.shared.single-business')
                @elseif($post->is_ads())
                    @include('customers.shared.single-ads')
                @elseif($post->is_movie())
                    @include('customers.shared.single-movie')
                @else
                    @include('customers.shared.single-default')
                @endif

                @if($post->category && $post->category->disclaimer)
                <div class="card mt-4">
                    <div class="card-body ">
                        <h5><i class="fa fa-exclamation-triangle mr-1" aria-hidden="true"></i> Disclaimer</h5>
                        <div class="accordion" id="accordionDetails">
                            <div class="collapse" id="collapse-full-details" data-parent="#accordionDetails">
                                <div class="small text-justify">{!! $post->category->disclaimer->details !!}</div>
                            </div>
                            <div class="collapse show" id="collapse-short-details" data-parent="#accordionDetails">
                                <div class="small text-justify">
                                    {!! Helper::short($post->category->disclaimer->details, 200) !!}... <a class="font-weight-bold text-light" data-toggle="collapse" href="#collapse-full-details">More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="col-12 col-lg-4">
                @if(Request::is('admin/manage-ads/*'))
                <div class="card">
                    <div class="card-body text-center">
                        <h3>Admin action</h3>
                        <hr>
                        <div class="clearfix">
                            <a href="{{ url('admin/action/post/'.$post->post_id.'/approve') }}?reported_post_id={{ request('reported_post_id') }}" class="btn btn-success">Approve</a>
                            <a href="{{ url('admin/action/post/'.$post->post_id.'/reject') }}?reported_post_id={{ request('reported_post_id') }}" class="btn btn-danger">Reject</a>
                        </div>
                    </div>
                </div>
                <div class="pt-4"></div>
                @endif
                <div class="card" style="margin-top:75px;">
                    <div class="card-body text-center p-4">
                        <div class="clearfix mb-4" >
                            @if($account->is(User::ROLE_ADMIN))
                            <div class="image-profile rounded-circle border mx-auto bg-white" style="background:url('{{ $post->get_featured_image() }}');background-size: 60% 60% !important;background-position:center !important;width:150px;height:150px;margin-top:-100px;"></div>
                            @else
                            <div class="image-profile rounded-circle border mx-auto bg-white" style="background:url('{{ $account->get_profile_url() }}');width:150px;height:150px;margin-top:-100px;"></div>
                            @endif
                        </div>
                        @if(Request::is('admin/manage-ads/*'))
                        <div class="clearfix mb-3">
                            <a data-toggle="modal" href="#model_reassign_ads" class="btn btn-danger">Reassign</a>
                        </div>
                        @endif
                        @if($account->is(User::ROLE_ADMIN))
                        <h6 class="font-weight-bold text-uppercase mb-3">{{ $post->post_title }}</h6>
                        @else
                        <h6 class="font-weight-bold text-uppercase mb-3">{{ $account->first_name }} {{ $account->last_name }}</h6>
                        @endif
                        <div>Member since {{ date('d M, Y', strtotime($account->created_at)) }}</div>
                        <div>{{ $account->posts->count() }} Total Ads / {{ $account->posts->where('status', Post::STATUS_APPROVED)->count() }} Active Ads</div>
                        <div class="mt-3">
                            <span class="mr-3">Verify Via</span>
                            <a href="{{ Helper::query_link('my_ads', 'yes') }}" class="custom-checkbox text-secondary text-decoration-none mb-3">
                                @if($post->call_link())
                                <i class="far fa-check-circle text-primary fa-sm"></i>
                                @else 
                                <i class="far fa-circle"></i>
                                @endif
                                <span class="mr-2 ml-1">Email</span>
                            </a>
                            <a href="{{ Helper::query_link('my_ads', 'yes') }}" class="custom-checkbox text-secondary text-decoration-none mb-3">
                                @if($post->whatsapp_link())
                                <i class="far fa-check-circle text-primary"></i>
                                @else 
                                <i class="far fa-circle"></i>
                                @endif
                                <span class="ml-1">Mobile Number</span>
                            </a>
                        </div>
                        <hr>
                        <h5 class="font-weight-bold">
                            @if($post->is_business())
                                Contact Advertiser
                            @else
                                Contact Seller
                            @endif
                        </h5>
                        
                        @if($post->whatsapp_link())
                        <div class="mb-4 mt-3">Contact Via Whatsapp</div>
                        <a class="btn btn-success btn-block" href="{{ $post->whatsapp_link() }}">Whatsapp</a>
                        @endif
                        @if($post->call_link())
                        <div class="mb-4 mt-3">Contact Via Phone</div>
                        <div class="d-none d-md-block">
                            <a class="btn btn-primary btn-block mt-2 collapsed py-1 px-2 mr-2" href="javascript:;" data-toggle="collapse" data-target="#multi-collapse-phone-{{ $post->id }}" aria-expanded="false">Show Number</a>
                            <a class="btn btn-link btn-block mt-2 collapse py-1 px-2 mr-2 text-dark" href="javascript:;" id="multi-collapse-phone-{{ $post->id }}">{{ $account->phone }}</a>
                        </div>

                        <a class="btn btn-primary btn-block mt-2 d-block d-md-none" href="{{ $post->call_link() }}" target="_blank">Show Number</a>
                        @endif
                        
                        <div class="my-4">Contact Via Email</div>
                        <form action="{{ url('post/contact/'.$post->id.'/email') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name" class="sr-only">Name</label>
                                <input name="fullname" type="text" class="form-control" placeholder="Your name" value="{{ user('first_name')? (user('first_name').' '.user('last_name')):null }}">
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">E-mail</label>
                                <input name="email" type="email" class="form-control" placeholder="E-mail" value="{{ user('email') }}">
                            </div>
                            <div class="form-group">
                                <label for="phone" class="sr-only">Phone</label>
                                <input name="phone" type="text" class="form-control" placeholder="Phone" value="{{ user('phone') }}">
                            </div>
                            <div class="form-group">
                                <label for="message" class="sr-only">Message</label>
                                <textarea name="message" class="form-control " placeholder="Your message" rows="4"></textarea>
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">
                                @if($post->is_business())
                                    Submit
                                @else
                                    Submit
                                @endif
                                </button>
                            </div>
                        </form>

                        <div class="clearfix mt-2 mb-3 ">
                            <span class="font-weight-bold mr-3">Share ad</span>
                            <div class="btn-group btn-group-sm">
                                <a class="btn btn-circle btn-outline-facebook p-1 mr-2" href="{{ $post->share_facebook() }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-circle btn-outline-twitter p-1 mr-2" href="{{ $post->share_twitter() }}" target="_blank"><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-circle btn-outline-linkedin p-1 mr-2" href="{{ $post->share_linkedin() }}" target="_blank"><i class="fab fa-linkedin"></i></a>
                                <a class="btn btn-circle btn-outline-success p-1" href="{{ $post->share_whatsapp() }}" target="_blank"><i class="fab fa-whatsapp"></i></a>
                            </div>
                        </div>

                        <a class="font-weight-bold text-danger btn btn-link btn-block" data-toggle="modal" href="#model_report_ads">REPORT THIS AD</a>
                    </div>
                </div>
            </div>
        </div>

        @if(!Request::is('admin/*'))

        <div class="clearfix section-padding">
            
            <h2 class="text-center">
                @if($post->is_business())
                Related Businesses
                @else
                Related Ads
                @endif
            </h2>
            <div class="section-padding-top">
                <div class="row">
                    @if(isset($related_ads))
                        @foreach($related_ads as $ad)
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="card card-body h-100">
                                {!! $ad->featured() !!}
                                <a href="{{ $ad->share_link() }}" 
                                    style="{{ ($ad->type == Post::TYPE_BUSINESS)? 'background-size:contain;': null }}background-image:url('{{ $ad->get_featured_image() }}');min-height:200px;"
                                    class="d-block media-image align-self-center border mb-3 w-100" >
                                </a>

                                <div class="media">
                                    <div class="media-body text-left">
                                        <h5 class="title m-0">{{ $ad->post_title }}</h5>
                                        <div class="d-flex justify-content-between">
                                            @if($ad->is_business())
                                            <div class="summary">{!! $ad->summary() !!}</div>
                                            @else
                                            <h5 class="title text-primary p m-0">Tsh {{ number_format($ad->price) }}/=</h5>
                                            @endif
                                            
                                            <div class="btn-group btn-group-sm">
                                                @if(Auth::check())
                                                <a class="btn {{ ($post->isExtra(PostExtra::TYPE_LIKE)? 'text-primary':'text-light' ) }} px-1" href="{{ url('post/like/'.$ad->id) }}"><i class="icon-Like"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        @endif
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="model_report_ads" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" style="background:rgba(0,0,0,.2);">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="d-flex align-items-center justify-content-between text-primary">
                    <h5 class="modal-title">Report Ads</h5>
                    <button type="button" class="close py-1 my-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="clearfix" style="font-size:16px;" action="{{ url('post/report/'.$post->id) }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <textarea class="form-control" name="message" rows="3"></textarea>
                    </div>
                    <div class="clearfix text-right mt-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->

@if(Request::is('admin/manage-ads/*'))
<!-- Modal -->
<div class="modal fade" id="model_reassign_ads" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" style="background:rgba(0,0,0,.2);">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="d-flex align-items-center justify-content-between text-primary">
                    <h5 class="modal-title">Reassign this ad</h5>
                    <button type="button" class="close py-1 my-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="clearfix mt-3"  action="{{ url('admin/action/post/'.$post->post_id.'/reassign') }}" method="POST">
                    {{ csrf_field() }}
                    
                    <!----- Include view from components/alert----->
                    @component('components.alert')@endcomponent
                    <!----- End include view from components/alert----->

                    <div class="form-group">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="assign_type_1" name="assign_type" class="custom-control-input" value="new">
                            <label class="custom-control-label" for="assign_type_1">New user</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="assign_type_2" name="assign_type" class="custom-control-input" value="exists">
                            <label class="custom-control-label" for="assign_type_2">Exists user</label>
                        </div>
                    </div>
                    <div class="switch-container d-none" data-assign-type="new">
                        <div class="form-group">
                            <div class="input-group border">
                                <span class="input-group-prepend text-light">
                                    <div class="btn border-right"><i class="fa fa-user"></i></div>
                                </span>
                                <input name="firstname" type="text" class="form-control border-0" value="<?= old('firstname');?>" placeholder="First name">
                                <span class="input-group-prepend">
                                    <div class="btn border-left px-0"></div>
                                </span>
                                <input name="lastname" type="text" class="form-control border-0" value="<?= old('lastname');?>" placeholder="Last name">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group border">
                                <span class="input-group-prepend text-light">
                                    <div class="btn"><i class="fa fa-envelope"></i></div>
                                </span>
                                <input name="email" type="email" class="form-control border-0" value="<?= old('email');?>" placeholder="E-mail Address">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group border">
                                <span class="input-group-prepend text-light">
                                    <div class="btn"><i class="fa fa-key"></i></div> 
                                </span>
                                <input name="password" type="password" class="form-control border-0" placeholder="Password"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group border">
                                <span class="input-group-prepend text-light">
                                    <div class="btn"><i class="fa fa-key"></i></div> 
                                </span>
                                <input name="password_confirmation" type="password" class="form-control border-0" placeholder="Confirm Password"/>
                            </div>
                        </div>
                    </div>
                    <div class="switch-container d-none" data-assign-type="exists">
                        <div class="form-group m-lg-0">
                            <label for="exists_email" class="sr-only">User</label>
                            <input list="users_list" name="exists_email" type="text" class="form-control" placeholder="User"/>
                            <datalist id="users_list">
                                @if(isset($users_list))
                                @foreach($users_list as $user)
                                <option value="{{ $user->email }}" {{ (request('exists_email') == $user->email)? 'selected':null }}>{{ $user->first_name }} {{ $user->last_name }}</option>
                                @endforeach
                                @endif
                            </datalist>
                        </div>
                    </div>
                    <div class="clearfix text-right mt-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->

<!-- Modal -->
<div class="modal fade" id="model_change_expire_date" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" style="background:rgba(0,0,0,.2);">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="d-flex align-items-center justify-content-between text-primary">
                    <h5 class="modal-title">Change expire date</h5>
                    <button type="button" class="close py-1 my-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="clearfix mt-3"  action="{{ url('admin/action/change-expire/'.$post->post_id) }}" method="POST">
                    {{ csrf_field() }}
                    
                    <!----- Include view from components/alert----->
                    @component('components.alert')@endcomponent
                    <!----- End include view from components/alert----->

                    <div class="switch-container">
                        <div class="form-group">
                            <div class="input-group">
                                
                                <input name="expired_date" type="text" class="form-control datepicker" value="{{ $post->expired_date }}" placeholder="Expire date">
                            </div>
                        </div>
                    </div>
                    <div class="clearfix text-right mt-3">
                        <button type="submit" class="btn btn-primary">Change</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
@endif

<script>
jQuery(function() {
    if(jQuery.fn.lightSliderBox){
        jQuery('#image-gallery').lightSliderBox({
            gallery:true,
            item:1,
            thumbItem:4,
            slideMargin: 0,
            galleryMargin: 20,
            thumbMargin: 20,
            speed:500,
            auto:true,
            loop:true,
            onSliderLoad: function(el) {
                jQuery('#image-gallery').removeClass('cS-hidden');
                // el.lightSliderBox({
                //     selector: '#image-gallery .lslide'
                // });
            }  
        });
    }


    jQuery('[name="assign_type"]').on('change', this, function(){
        var value = jQuery(this).val();
        
        jQuery('[data-assign-type='+ value +']').removeClass('d-none')
            .siblings('[data-assign-type]').addClass('d-none');
    })
});
</script>

@endsection
