@extends(config('permissions.layout'))

@section('title', 'Permissions')

@section('content')


<div class="main-container-middle">
    <div class="container-navbar bg-white border-bottom" style="overflow:visible;">
        <nav class="nav">
            <a class="nav-link {{ (Request::is('permissions') || Request::is('permissions/rules') || Request::is('permissions/rules/*'))? 'active': null }}" href="{{ url('permissions/rules') }}">Rules</a>
            <a class="nav-link {{ (Request::is('permissions/groups') || Request::is('permissions/groups/*'))? 'active': null }}" href="{{ url('permissions/groups') }}">Groups</a>
            <a class="nav-link {{ (Request::is('permissions/user-assign') || Request::is('permissions/user-assign/*'))? 'active': null }}" href="{{ url('permissions/user-assign/users') }}">Assign users</a>
        </nav>
    </div>
    <div class="container-detail bg-white">
        <div class="clearfix">
            @yield('permissions-content')
        </div>
    </div>
</div>
<script>
jQuery(function(){

});
</script>


@endsection
