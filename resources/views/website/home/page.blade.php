@extends('website')

@section('title', $page_title)

@section('content')

<div class="clearfix">
    <div class="container py-5">
        <h1 class="text-center">{{ $page_title }}</h1>

        <div class="clearfix mt-4">
            @if($post)
            {!! $post->post_content !!}
            @else
            {{ Helper::trans('general.coming_soon', 'Coming soon') }}
            @endif
        </div>
    </div>
</div>



@endsection
