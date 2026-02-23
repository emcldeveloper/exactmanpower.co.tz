<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title id="page_title">@yield('title') - {{ config('app.name') }}</title>
    <base href="{{ url('/') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if(Request::is('blog/*') || Request::is('newsroom/*'))
    <meta property="fb:app_id" content="{{ config('services.facebook.client_id') }}"/>
    <meta property="og:site_name" content="{{ config('app.name') }}"/>
    <meta property="og:title" content="{{ (isset($post)? $post->post_title: null) }}" />
    {{-- <meta property="og:description" content="{{ ((isset($post))? $post->share_message(): null) }}" /> --}}
    <meta property="og:type" content="photo">
    <meta property="og:url" content="{{ url()->full() }}"/>
    <meta property="og:image" content="{{ ((isset($post))? $post->get_featured_image(): null) }}"/>

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@{{ config('app.name') }}">
    <meta name="twitter:creator" content="@exactonlinetz">
    <meta name="twitter:title" content="{{ (isset($post)? $post->post_title: null) }}">
    {{-- <meta name="twitter:description" content="{{ ((isset($post))? $post->share_message(): null) }}"> --}}
    <meta name="twitter:image" content="{{ ((isset($post))? $post->get_featured_image(): null) }}">
    @endif

    <script>window.ExactManpower ltd = { csrftoken: '{{ csrf_token() }}' }</script>

    <link rel="icon" type="image/icon" href="{{ asset('favicon.png') }}" id="page_favicon">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('fonts/NexaFont.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome-all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script type="text/javascript" src="{{ asset('js/jquery-1.11.0.js') }}"></script>

    @if(config('app.env') == 'production')
    <!-- Global Site Tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('app.google_analytics') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments)};
        gtag('js', new Date());

        gtag('config', '{{ config('app.google_analytics') }}');
    </script>
    @endif
    <script> 
    window.base_url = '<?= url('/');?>';
    window.page_title = '@yield('title')';
    window.page_name = '{{ config('app.name') }}';
    window.page_notification = {{ Helper::notifications() }};
    window.page_favicon = "{{ asset('img/favicon.png') }}";
    window.page_favicon_dot = "{{ asset('img/favicon_dot.png') }}";
    </script>

    <style>
    .default-font {
        /* font-family: 'Roboto', sans-serif; */
    }

    ul li{

    }

    .blowing {
        animation: blowing 2s infinite;
    }

    @keyframes blowing {
        0% {
            box-shadow: 0 0 5px red;
        }
        80% {
            box-shadow: 0 0 10px red;
        }
        100% {
            box-shadow: 0 0 5px red;
        }
    }
    </style>

<script async src="https://www.googletagmanager.com/gtag/js?id=AW-612909216"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-612909216');
</script>

</head>

<body class="bg-white default-font">
<div id="fb-root"></div>
<script>
(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.3&appId=1022825181105124&autoLogAppEvents=1";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<div class="header-menu clearfix bg-white" style="z-index:20;">
    <div class="container-fluid px-0">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light d-block d-md-flex px-0">
                
                <a class="navbar-brand" href="{{ url('/') }}">
                    @if(false)
                    <img class="e-dark" src="{{ asset('img/logo.svg') }}" height="70" alt="">
                    <img class="e-light" src="{{ asset('img/logo.svg') }}" height="70" alt="">
                    @endif
                    <img src="{{ asset('img/logo.svg') }}" height="70" alt="">
                </a>

                <button class="navbar-toggler float-right my-2" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="fa fa-bars text-muted"></span>
                </button>

                <div class="ml-auto">
                    {{--
                    <div class="collapse navbar-collapse text-white pt-3">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item mb-3">
                                <a class="btn btn-secondary text-uppercase" href="https://ekazi.co.tz/register">Register</a>
                            </li>
                            <li class="nav-item mb-3 ml-3">
                                <a class="btn btn-primary text-uppercase ml-lg-0" href="https://ekazi.co.tz/login">Login</a>
                            </li>
                            @if(false)
                            <li class="nav-item dropdown ml-0 ml-lg-3">
                                <a class="nav-link rounded px-2" href="javascript:;" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="dropdown-toggle mx-1">
                                        {{ Helper::trans('header.language', 'Language') }}
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right px-2" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item px-1" href="{{ url('switch-languege/sw') }}">Swahili (SW)</a>
                                    <a class="dropdown-item px-1" href="{{ url('switch-languege/en') }}">English (EN)</a>
                                </div>
                            </li>
                            @endif
                        </ul>
                    </div> 
                    --}}
                    <div class="collapse navbar-collapse text-muted" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto text-secondary">
                            <li class="nav-item ml-0 ml-lg-3 mb-3 mb-lg-0">
                                <a class="nav-link text-nowrap text-uppercase {{ Request::is('/')? 'active':'' }}" href="{{ url('/') }}">Home</a>
                            </li>
                            <li class="nav-item ml-0 ml-lg-3 mb-3 mb-lg-0">
                                <a class="nav-link text-nowrap text-uppercase {{ Request::is('about')? 'active':'' }}" href="{{ url('about') }}" >About Us</a>
                            </li>
                            {{-- <li class="nav-item ml-0 ml-lg-3 mb-3 mb-lg-0">
                                <a class="nav-link text-uppercase {{ (Request::is('services') || Request::is('services/*'))? 'active':'' }}" href="{{ url('services') }}" >Service</a>
                            </li> --}}
                            <li class="nav-item  text-nowrap text-uppercase {{ Request::is('services/*')? 'active':'' }} ml-0 ml-lg-3 mb-3 mb-lg-0 dropdown">
                                <span class="nav-link dropdown-toggle text-nowrap text-uppercase" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Services
                                </span>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    @foreach(\App\Models\Post::where('post_type_id','service')->get() as $service)
                                        <a  class="dropdown-item  mb-2 {{ Request::is('services/'.$service->post_slug)? 'active':null }}"  href="{{ url('services/'.$service->post_slug) }}">{{ $service->post_title }}</a>
                                    @endforeach
                                </div>
                            </li>
                            <li class="nav-item text-uppercase {{ Request::is('approach/*')? 'active':'' }} ml-0 ml-lg-3 mb-3 mb-lg-0 dropdown">
                                <span class="nav-link dropdown-toggle text-nowrap  text-uppercase" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Our Approach
                                </span>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    @foreach(\App\Models\Post::where('post_type_id','our-approach')->get() as $approach)
                                        <a class="dropdown-item" href="{{ url('approach/'.$approach->id) }}">{{ $approach->post_title }}</a>
                                    @endforeach
                                </div>
                            </li>
                            {{--  <li class="nav-item ml-0 ml-lg-3 mb-3 mb-lg-0">
                                <a class="nav-link text-nowrap text-uppercase" href="https://ekazi.co.tz/" target="__blank" >Salary Calculator</a>
                            </li>  --}}
                             <li class="nav-item ml-0 ml-lg-3 mb-3 mb-lg-0">
                                <a class="nav-link text-nowrap text-uppercase {{ Request::is('exactehrm/payrollite/salary-calculator')? 'active':'' }}" href="{{ url('exactehrm/payrollite/salary-calculator') }}" > Salary Calculator</a>
                            </li>
                              <li class="nav-item ml-0 ml-lg-3 mb-3 mb-lg-0">
                                <a class="nav-link text-nowrap text-uppercase" href="https://ekazi.co.tz/" target="__blank" >Jobs</a>
                            </li>
                            <li class="nav-item ml-0 ml-lg-3 mb-3 mb-lg-0">
                                <a class="nav-link text-nowrap text-uppercase" href="#"  >Employer Zone</a>
                            </li>
                           

                            @foreach(App\Models\PostType::all() as $menu)
                                @if($menu->post_type_id == 'newsroom')
                                <li class="nav-item ml-0 ml-lg-3 mb-3 mb-lg-0">
                                    <a class="nav-link text-nowrap text-uppercase {{ (Request::is('get_updated_with') || Request::is('get_updated_with/newsroom'))? 'active':'' }}" href="{{ url('get_updated_with',$menu->post_type_id) }}">{{$menu->name}}
                                    </a>
                                </li>
                                @endif
                            @endforeach

                              {{--<li class="nav-item ml-0 ml-lg-3 mb-3 mb-lg-0">
                               <a class="nav-link text-uppercase {{ Request::is('contact')? 'active':'' }}" href="{{ url('contact') }}" >{{ Helper::trans('header.contact', 'Contact Us') }}</a>
                            </li>--}}
                               

                            @foreach(App\Models\PostType::all() as $menu)
                                @if($menu->post_type_id == 'gallery')
                                <li class="nav-item ml-0 ml-lg-3 mb-3 mb-lg-0">
                                    <a class="nav-link  text-nowrap text-uppercase " href="{{ url('get_updated_with',$menu->post_type_id) }}">{{$menu->name}}
                                    </a>
                                </li>
                                @endif
                            @endforeach

                            {{-- <li class="nav-item text-uppercase {{ Request::is('approach/*')? 'active':'' }} ml-0 ml-lg-3 mb-3 mb-lg-0 dropdown">
                                <span class="nav-link dropdown-toggle text-uppercase" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Blogs
                                </span>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        @foreach(App\Models\PostType::all() as $menu)
                                            <a class="dropdown-item" href="{{ url('blog',$menu->post_type_id) }}">{{$menu->name}}</a>
                                        @endforeach
                                </div>
                            </li> --}}
                        </ul>
                        <ul class="navbar-nav ml-auto">
                            @if(Auth::check() && false)
                            <li class="nav-item dropdown ml-0 ml-lg-3">

                                <a class="d-flex align-items-center justify-content-between bg-white text-muted rounded mr-0" href="javascript:;" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="dropdown-toggle mx-3">
                                        {{ Auth::user()? substr(Auth::user()->fullname(), 0, 8).'...': null }}
                                    </span>
                                    <div class="image-profile rounded-circle border" style="background:url('{{ Auth::user()? Auth::user()->profile_image: null }}');width:32px;height:32px;"></div>
                                    @if((Helper::notifications()) || true)
                                    <span  class="badge badge-danger badge-top blowing badge-notification" style="right:-6px;top:-4px;height:16px;font-weight:400;font-size:10px;">{{ (Helper::messages() + Helper::notifications())? (Helper::messages() + Helper::notifications()):'' }}</span>
                                    @endif
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    
                                    <a class="dropdown-item px-2" href="{{ url('admin/profile') }}">Profile</a>
                                    
                                    <a class="dropdown-item col px-2" href="{{ url('admin/notifications') }}" style="">
                                        {{ Helper::trans('header.notifications', 'Notifications') }}
                                        @if((Helper::notifications()) || true)
                                        <span class="badge badge-danger badge-top blowing badge-notification" style="height:16px;font-weight:400;font-size:10px;right:10px;top:7px;">{{ (Helper::notifications())? Helper::notifications():'' }}</span>
                                        @endif
                                    </a>
                                    <a class="dropdown-item px-2" href="{{ url('logout') }}">Log out</a>
                                </div>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light p-0 py-lg-2">
            
        </nav>

    </div>
</div>
