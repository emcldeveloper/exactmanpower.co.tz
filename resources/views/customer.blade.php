@include('components.header')

@if(!Request::is('/') )
<div class="page-search-section  clearfix bg-dark">
    <div class="container page-search text-center">
        @yield('main-search')
    </div>
</div>

@endif

<!-- Start Main Container -->
<div class="container-main clearfix">
    @yield('content')
</div>
<!-- End Main Container -->

@include('components.footer')