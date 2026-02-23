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
    @foreach(\App\Models\Post::where('post_type_id','our-approach')->get() as $approach)
        <a href="{{ url('approach/'.$approach->id) }}" class="btn btn-light-custome btn-block mb-2 {{ Request::is('approach/'.$approach->id)? 'active':null }}">{{$approach->post_title}}</a>
    @endforeach
</div>
 