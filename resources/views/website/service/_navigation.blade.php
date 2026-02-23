<style>
.btn-light-custome {
    color: #ffffff;
    background: #33a3dc;
    border-color: #33a3dc;
    font-weight: bold;
    font-size: 20px;
    text-align: left;
}

.btn-light-custome.active,
.btn-light-custome:hover {
    color: white;
    background: #ee7822;
    border-color: #ee7822;
} 
</style>

<div class="clearfix mt-4">
    @foreach(\App\Models\Post::where('post_type_id','service')->orderBy('custom_view_number','ASC')->get() as $services) 


        <a href="{{ url('services/'.$services->post_slug) }}" class="btn btn-light-custome btn-block mb-2 {{ Request::is('services/'.$services->post_slug)? 'active':null }}">{{$services->post_title}}</a>
    @endforeach
</div>
 