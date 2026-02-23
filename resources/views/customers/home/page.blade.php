@extends('customer')

@section('title', $page_title)

@section('content')

<div class="clearfix">
    <div class="container py-5">
        <div class="clearfix mt-4">
            <div class="bg-white p-5">
                <h1 class="text-center mb-4">{{ $page_title }}</h1>
                @if($post)
                {!! $post->post_content !!}
                @else
                {{ $page_title  }}
                @endif
            </div>
        </div>
    </div>
</div>



@endsection
