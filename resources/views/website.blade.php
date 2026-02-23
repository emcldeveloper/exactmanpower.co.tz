@include('components.header')

@if(!Request::is('/'))

<style>
.page-search-section {
    position:relative;
}

.page-search-section:after {
    position: absolute;
    top:0;
    left: 0;
    right:0;
    bottom:0;
    background: rgba(0,0,0,0.3);
    background: url(./img/dotted.png);
    background-repeat: no-repeat;
    background-size: cover;
}
</style>

<div class="bg-dotted bg-primary clearfix">
    <div class="container align-items-center d-flex" style="padding-top:50px;padding-bottom:50px;position:relative;z-index:9;">
        <h1 class="text-center text-white d-flex  align-items-center">
            @if(View::hasSection('page-icon'))
            <img class="mr-5" src="@yield('page-icon')" alt="Title Icon" style="width:118px;">
            @endif
            <div class="d-inline-block">@if(View::hasSection('page-title')) @yield('page-title') @else &nbsp; @endif</div>
        </h1>

        @if(View::hasSection('page-description'))
        <div class="d-inline-block text-white" style="font-size:18px;margin-left:150px;">@yield('page-description')</div>
        @endif
    </div>
</div>
@endif

<!-- Start Main Container -->
<div class="container-main clearfix bg-white">
    @yield('content')
</div>
<!-- End Main Container -->


@include('components.footer')