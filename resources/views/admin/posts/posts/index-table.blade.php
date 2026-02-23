<div class="clearfix">
    <?php 
        $var = \App\Models\PostViewType::where('user_id', Auth::user()->id)->latest()->first();
     ?>
    @if($var->status == 1)
        @include('admin.posts.posts.index_table.list')
    @else
        @include('admin.posts.posts.index_table.grid')
    @endif
</div>