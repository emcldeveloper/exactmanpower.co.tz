@include('components.header')
<style>
    .custom-badge-top {
        position: absolute;
        top: 9px;
        display: block !important;
        right: 19px;
        min-width: 6px;
        height: 10px;
        line-height: 16px;
        padding: 0;
        font-weight: lighter;
        padding: 0.3rem 1rem;
        border-radius: 2rem;
        font-family: sans-serif;
        -webkit-animation: blink 1.0s linear infinite;
        -moz-animation: blink 1.0s linear infinite;
        -ms-animation: blink 1.0s linear infinite;
        -o-animation: blink 1.0s linear infinite;
        animation: blink 1.0s linear infinite;    
    }

</style>


<div class="page-search-section  clearfix bg-dark">
    <div class="container page-search text-center"></div>
</div>

<!-- Start Main Container -->
<div class="container-main clearfix" >
    <div class="container">
        <div class="clearfix">
            <nav class="navbar navbar-expand-lg navbar-light bg-white py-1">
                <a class="navbar-brand font-weight-bold px-4" href="{{ url('account') }}">DASHBOARD</a>
                <div class="collapse navbar-collapse" >
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item d-flex align-items-center">
                            <a class="nav-link px-4" href="{{ url('account/favorities') }}">My Favorities.</a>
                        </li>
                        <li class="nav-item d-flex align-items-center">
                            <a class="nav-link px-4" href="javascript:;" id="dropdown-notification" data-toggle="dropdown">
                                <i class="fa fa-bell"></i> 
                                @if(Helper::notifications()->count())
                                <span class="badge custom-badge-top badge-primary border border-white py-0 px-1" style="min-width:12px;height:12px;"></span>
                                @endif
                            </a>
                            <div class="dropdown-menu small border-0 px-3 pt-3 pb-0" aria-labelledby="dropdown-notification" style="min-width:262px;margin-top:4px;background:#afb1ba;">
                                
                                @foreach(Helper::notifications() as $row)
                                <a class="bg-white d-flex align-items-center justify-content-between small p-2 mb-3" href="javascript:;" style="line-height:1.3">
                                    <span class="mr-3">{!! $row->title !!}</span>
                                    <span class="font-italic">{{ Helper::time_ago($row->timestamp) }}</span>
                                </a>
                                @endforeach

                                @if(!Helper::notifications()->count())
                                <a class="bg-white d-flex align-items-center justify-content-between small p-2 mb-3" href="javascript:;" style="line-height:1.3">
                                    <span class="mr-3 font-italic">No notification!</span>
                                </a>
                                @endif
                            </div>
                        </li>
                        <li class="nav-item dropdown border-left d-flex align-items-center">
                            <a class="nav-link dropdown-toggle pl-4" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ user('first_name') }}
                                {{ user('last_name') }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="border-bottom:3px solid #ff8000;">
                                <a class="dropdown-item" href="{{ url('account/setting/account') }}"> <i class="icon-Account-Profile ml-1 mr-3"></i> My account</a>
                                <form class="dropdown-item" action="<?= url('logout');?>" method="POST">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn p-0"><i class="icon-Logout mr-3"></i> Logout</button>
                                </form>
                            </div>
                        </li>
                        <li class="nav-item d-flex align-items-center">
                            <a class="nav-link py-1" href="#">
                                <div class="image-profile rounded-circle" style="background:url('{{ user()? user()->get_profile_url(): null }}')"></div>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="row">
            <div class="col-12 col-lg-3 sidebar">
                <div class="list-group list-group-flush">
                    <a href="{{ url('account/setting/profile') }}" class="list-group-item {{ (Request::is('account') || Request::is('account/setting/*'))? 'active': null }}"><i class="icon-Account-Profile mr-3"></i> Account & Profile</a>
                    <a href="{{ url('account/manage-ads/online') }}" class="list-group-item {{ (Request::is('account/manage-ads/*') || Request::is('account/manage-banners/*'))? 'active': null }}"><i class="icon-Manage-Ads mr-3"></i> Manage</a>
                    <a href="{{ url('account/business-profile') }}" class="list-group-item {{ (Request::is('account/business-profile') || Request::is('account/business-profile/*'))? 'active': null }}"><i class="icon-Busines-Profile mr-3"></i> Business Directory</a>
                    <a href="{{ url('account/create-ads') }}" class="list-group-item {{ Request::is('account/create-ads*')? 'active': null }}"><i class="icon-Create-Ads mr-3"></i> Create Ads</a>
                    <a href="{{ url('account/create-banner') }}" class="list-group-item {{ (Request::is('account/create-banner') || Request::is('account/create-banner/*'))? 'active': null }}"><i class="icon-create-Banner mr-3"></i> Create Banner</a>
                    <a href="{{ url('account/messages') }}" class="list-group-item {{ Request::is('account/messages*')? 'active': null }}"><i class="icon-My-Messages mr-3"></i> My Messages</a>
                    <a href="{{ url('account/payament-logs') }}" class="list-group-item {{ Request::is('account/payament-logs*')? 'active': null }}"><i class="icon-Order-Overview mr-3"></i> Payment logs</a>
                    <!-- <a href="{{ url('account/credit/topup') }}" class="list-group-item {{ Request::is('account/credit/*')? 'active': null }}"><i class="icon-Buy-Credits mr-3"></i> Buy credits</a> -->
                    <a href="{{ url('account/favorities') }}" class="list-group-item {{ Request::is('account/favorities')? 'active': null }}"><i class="icon-My-Favorite mr-3"></i> My Favorities</a>
                </div>
            </div>
            <div class="col-12 col-lg-9">
                @yield('content')
            </div>
        </div>
    </div>
</div>

@include('components.footer')