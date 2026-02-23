

@extends('admin')

@section('title', 'Slider ')

@section('content')


<div class="main-container-middle">
    <div class="container-header" style="overflow:visible;">
        <div class="d-flex align-items-center justify-content-between p-3">

            <div class="h5 m-0">
                <a href="{{ route('slider') }}" class="btn btn-outline-primary mr-3" title="Back to posts list"><i class="fas fa-arrow-left"></i></a>
                <span class="h5 m-0  text-dark">Navigation Slider </span>
            </div>


            <div>
                <a href="{{ route('slider-create') }}" class="btn btn-primary"><i class="fas fa-plus-circle mr-1"></i> Add new</a>
            </div>
        </div>
    </div>
    <div class="container-detail">
        <div class="clearfix">
    <div class="px-3 pb-3">
        

        <div class="row align-items-center justify-content-between m-0">
            <div class="col-12 col-md-6 p-0 mb-3 mb-md-0">
                {{-- !! pagination_header_limit($posts_list) !! --}}
            </div>
            <div class="col-12 col-md-6 p-0 mb-3 mb-md-0">
                {{-- !! pagination_header_search($posts_list) !! --}}
            </div>
        </div>
    </div>
    
    <div class="px-3">
    

        <div class="border bg-white">
            @include('status')
            <table class="table table-hover table-sm mb-0">
                <thead class="table-primary">
                    <tr>
                        <td></td>
                        <td>Title</td>
                        <td>Sub-title</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                @foreach (\App\Models\Post::where('post_type_id','slider')->latest()->get() as $index => $row)
                    <tr>
                        <td scope="row">{{$loop->iteration}}</td>
                        <td>
                            <a class="d-block" href="{{ url('admin/posts/home/slider/show/'.$row->id) }}"><?= $row->post_title;?></a>
                        </td>
                        <td>{{$row->post_content}}</td>
                        <td class="text-right">
                            <div class="btn-group btn-group-sm">

                                <a href="{{ url('admin/posts/home/slider/show/'.$row->id) }}" class="btn px-1 py-0"> <i class="fas fa-file"></i> </a>
                                <a href="{{ url('admin/posts/home/slider/edit/'.$row->id) }}" class="btn px-1 py-0"> <i class="fas fa-pencil-alt"></i> </a>

                                <a href="{{ url('/admin/slider-delete/'.$row->id) }}" class="btn px-1 py-0 text-danger" data-confirmation='I you sure, you want to delete "{{ $row->post_title }}"?'>
                                    <i class="fas fa-trash"></i>
                                </a>
                                &nbsp;<i class="{{$row->post_status=="1" ? "fas text-success fa-check" : 'fas fa-ban text-danger'}}"></i>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                
            </table>
        </div>
        
    </div>
</div>
    </div>
</div>


@endsection


