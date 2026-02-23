@extends('website')

@section('title', 'About Us')
@section('page-title', 'Organization Profile')

@section('content')
<style>
.numberCircle {
    border-radius: 50%;
    width: 70px;
    height: 70px;
    line-height: 1;
    padding: 8px;
    margin: auto;
    text-align: center;
    font: 32px Arial, sans-serif;
    border: 3px solid;
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>

<div class=" clearfix">
    <div class="container text-center">
            @foreach(\App\Models\Post::where('post_type_id','about-us')->latest()->get() as $about)
            <!-- Algorithm for UI/UX -->
            <?php $rem= (float)($about->id / 2); $val = ($rem - (int)$rem)*2; ?>
            @if($val == '1')
            <div class="clearfix section-padding row text-left">
                <div class="col-12 col-md-4 bg-image img-thumbnail" style="background:url('{{ $about->image }}')">
                </div>
                <div class="col-12 col-md-8 pl-3 pl-md-5">
                    <h2 class="text-primary">{!!$about->post_title!!}</h2>
                    <p>{!! $about->post_content !!}</p>
                </div>
            </div>
            <div class="clearfix">
                <div class="container text-center p-0">
                    <hr class="border-primary"/>
                </div>
            </div>

            @else
            <div class="section-padding clearfix">
                <div class="container text-center">
                    <div class="clearfix row text-left">
                        <div class="col-12 col-md-8 pr-3 pr-md-5">
                            <h2 class="text-primary">{{$about->post_title}}</h2>

                            <p>{!! $about->post_content !!}</p>
                        </div>
                        <div class="col-12 col-md-4 bg-image img-thumbnail" style="background:url('{{ $about->image }}')"></div>
                    </div>
                </div>  
            </div>
            <div class="clearfix">
                <div class="container text-center p-0">
                    <hr class="border-secondary"/>
                </div>
            </div>
            @endif
            @endforeach
        </div>
@include('components.bridging-process')
@include('components.clients')
@endsection
