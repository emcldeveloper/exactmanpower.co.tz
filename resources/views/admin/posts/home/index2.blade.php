@extends('admin')

@section('title', Str::title(request('post_type_id')))

@section('content')


<div class="main-container-middle">
    <div class="container-header" style="overflow:visible;">
        <div class="d-flex align-items-center justify-content-between p-3">
            <span class="h5 m-0">Home list</span>
            <div>
                <a href="{{ url('admin/posts/'.request('post_type_id').'/create') }}" class="btn btn-primary"><i class="fas fa-plus-circle mr-1"></i> Add Section</a>
            </div>
        </div>
    </div>
    <div class="container-detail">
        <div class="clearfix">

            <div class="border bg-white">
            <table class="table table-hover table-sm mb-0">
                <thead class="table-primary">
                    <tr>
                        <td></td>
                        <td> Title</td>

                        <td>Section Summary</td>
                        
                        <td></td>
                    </tr>
                </thead>
                <tbody>
               
                    <tr>
                        <td scope="row">1.</td>
                        <td>
                            <a class="d-block" href="{{ route('slider-list') }}">Navigation Slider</a>
                        </td>
                        <td>
                            <span class="d-block">This is navigation header</span>
                        </td>
                 
                        <td class="text-right">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('slider-list') }}" class="btn px-1 py-0"> <i class="fas fa-file"></i> </a>
                                
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td scope="row">2.</td>
                        <td>
                            <a class="d-block" href="#">Welcome to Exact</a>
                        </td>
                        <td>
                            <span class="d-block">This section resides below slider</span>
                        </td>
                   
                        <td class="text-right">
                            <div class="btn-group btn-group-sm">
                                <a href="#" class="btn px-1 py-0"> <i class="fas fa-file"></i> </a>
                                
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td scope="row">3.</td>
                        <td>

                            <a href="{{ url('admin/posts/client/list') }}">
                                <i class="icon-arrow-right"></i><span>Client</span>
                            </a>
                        </td>
                        <td>
                            <span class="d-block">Manage clients</span>
                        </td>
                
                        <td class="text-right">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ url('admin/posts/client/list') }}" class="btn px-1 py-0"> <i class="fas fa-file"></i> </a>
                                
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td scope="row">4.</td>
                        <td>

                            <a href="{{ url('admin/posts/service/list') }}">
                                <i class="icon-arrow-right"></i><span>Service</span>
                            </a>
                        </td>
                        <td>
                            <span class="d-block">Manage Services</span>
                        </td>
                        
                        <td class="text-right">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ url('admin/posts/service/list') }}" class="btn px-1 py-0"> <i class="fas fa-file"></i> </a>
                                
                            </div>
                        </td>
                    </tr>

                </tbody>                            
            </table>
        </div>
        </div>
    </div>
</div>


@endsection
