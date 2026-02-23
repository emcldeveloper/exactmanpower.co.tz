@extends('admin')

@section('title', 'Post Types')

@section('content')


<div class="main-container-middle">
    <div class="container-sidebar bg-white border-left border-right">
        <div class="main-container-middle">
            <div class="container-summary-sidebar border-bottom d-flex p-3">
                <div class="d-block">
                    <div class="h5 mb-1">
                    <!-- <a href="{{ url('admin/posts/post-types/list') }}" class="btn btn-outline-primary mr-3" title="Back to post types list"><i class="fas fa-arrow-left"></i></a> -->
                    <span>Post Types</span>
                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group input-group-search">
                            <input class="form-control input-filter" type="search" placeholder="Search..." onkeyup="filterFunction()"/>
                            <span class="input-group-append">
                                <button  class="btn">
                                    <i class="fa fa-search text-light"></i>
                                </button >
                            </span>
                        </div>
                    </div>

                    <div class="btn-block dropdown">
                        <button class="btn btn-primary btn-block"><i class="fas fa-filter"></i> Filter</button>
                    </div>
                </div>
            </div>
            <div class="container-detail text-dark">
                <div class="main-container-middle">
                    <div class="container-detail" scroll-container>
                        <div class="clearfix custom-list-group">
                            @foreach (\App\Models\PostType::all() as $index => $row)
                            @if($row->post_type_id != "slider" && $row->post_type_id != "page")
                            <div class="border-bottom custom-list-item p-2">
                                <a href="{{ url('admin/posts/post-types/show/'.$row->post_type_id.( request('sub_page')? '/'.request('sub_page'): '' )) }}">@if($row->post_type_id == "$slider->post_type_id")<b class="text-primary">{{ $row->name }}</b>@else {{ $row->name }}@endif</a>
                                <div class="font-italic text-light small">
                                    Description of 
                                    {{ $row->name }}
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-header bg-white" style="overflow:visible;">
        <div class="d-flex align-items-center justify-content-between p-3">
            <div class="col-md-12">
                <div class="row">
                <div class="col-md-9">

                    <div class="h5 m-0">
                        <a href="{{ route('slider') }}" class="btn btn-outline-primary mr-3" title="Back to posts list"><i class="fas fa-arrow-left"></i></a>
                        <span class="h5 m-0  text-dark">{{$slider->post_title}}</span>
                    </div>

                </div>

                <div class=" col-md-2 d-flex justify-content-end">
                    <form action="{{url('admin/posts/home/slider/publish/'.$slider->id)}}" method="POST">
                        @csrf
                        @if($slider->post_status=="0")
                        <input type="hidden" name="post_status" value="1">
                        <button class="btn btn-primary">Publish</button>
                        @else
                        <input type="hidden" name="post_status" value="0">
                        <button class="btn btn-primary">Un-publish</button>
                        @endif
                    </form>
                </div>
            </div>

            </div>
            
            <div>
                @if(false)
                <!-- <a href="{{ url('admin/posts/post-types/edit/'.$slider->post_type_id) }}" class="btn btn-primary"><i class="fas fa-pencil-alt mr-1"></i> Edit</a> -->
                <a href="{{ url('admin/posts/post-types/create') }}" class="btn btn-dark"><i class="fas fa-plus-circle mr-1"></i> Add Post Type</a>
                <!-- <a href="{{ url('admin/posts/post-types/delete/'. $slider->post_type_id) }}?redirect={{ url('admin/posts/post-types/list') }}" class="btn btn-danger" data-confirmation='I you sure, you want to delete "{{ $slider->name }}"?'><i class="fas fa-trash mr-1"></i> Delete</a> -->
                <div class="d-inline-block dropdown">
                    <div class="btn-group dropdown" data-toggle="dropdown">
                        <div class="btn btn-primary " >
                            <i class="fas fa-plus-circle mr-1"></i> Add another
                        </div>
                        <div class="btn btn-primary">
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </div>
                    <div class="dropdown-menu dropdown-menu-right" id="dropdown-add-another">
                        <div class="dropdown-item" data-toggle="modal" data-target="#model_new_posts" >Add post</div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
  
    <div class="container-navbar bg-white border-bottom" style="overflow:visible;">
        <nav class="nav">
            
            <a class="nav-link {{-- Request::is('admin/posts/post-types/show/'.$slider->post_type_id)? 'active': null }}" href="{{ url('admin/posts/post-types/show/' . $slider->post_type_id) --}}">Information</a>
        </nav>
    </div>
    <div class="container-detail">
        <div class="clearfix">

            @include('admin.posts.home.show-form')
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="model_new_posts" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" style="background:rgba(0,0,0,.2);">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border:4px solid #1193d7;">
            <div class="modal-header bg-white text-primary py-2">
                <h5 class="modal-title">New post</h5>
                <button type="button" class="close py-1 my-0" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="clearfix">
                {{-- !! \App\Handlers\Admin\Post\Post\CreateFormHandler::handler(request(), false, url()->full(), ['post_type_id'=>$slider->post_type_id]) !! --}}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function filterFunction() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.querySelector('.container-sidebar .input-filter');
    filter = input.value.toUpperCase();
    ul = document.querySelector(".container-sidebar .custom-list-group");
    li = ul.querySelectorAll(".custom-list-item");

    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
</script>

<script>
var active_modal = location.hash.substr(1);
if(typeof window.form_children_input_template == 'undefined') window.form_children_input_template = {};

function formChildInput() {
    if(! (this instanceof formChildInput)){
        return new formChildInput();
    }
    
}

formChildInput.prototype.init = function(){
    var $this = this;
    var containers_list = jQuery('[data-children]');

    for (const container of containers_list) {
        jQuery(container).on('click', '.add-item', function(){
            var c = jQuery(this).parent('[data-children]');
            var k = jQuery(c).attr('data-children');
            var i = "insert_item_" + k;

            $this.insert_item(c, 0, {}, i);
        });

        var list_key = jQuery(container).attr('data-children');
        var insert_key = "insert_item_" + list_key;
        var list = $this[list_key];

        if(Array.isArray(list)){
            for (var i = 1; i < list.length; i++) {
                var elem = list[i];
                $this.insert_item(container, i, elem, insert_key);
            }
        }
    }
}

formChildInput.prototype.insert_item = function(container, i, data, insert_key){
    // console.log(container);
    var template = '';
    var container_list = jQuery(container).find('.item-list').get(0);
    if(i == 0 && container_list){
        i = container_list.childElementCount;
    }

    if(typeof form_children_input_template[insert_key] == 'function') {
        template = form_children_input_template[insert_key](i, data)
    }

    var item_obj = null;
    item_obj = document.createElement('TR'); 
    item_obj.innerHTML = template;

    console.log(item_obj)
    if(container_list) {
        container_list.appendChild(item_obj);

        jQuery(item_obj).on('click', '.btn-delete', function(){
            if(container_list && item_obj){
                container_list.removeChild(item_obj);
            }
        });
    } else {
        console.log(container_list)
    }    
}

formChildInput().init();
</script>


@endsection
