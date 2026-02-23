@extends($parent_layout)

@section('title', 'Create an ad')

@section('content')

<div class="{{ Request::is('admin/*')? 'p-4': null }}">
@include('accounts.business-profile.navigation')

<style>
.element-children .border {
    border-top: 0 !important;
}

.element.active .drop {
    background: #ff8000;
    color: #ffffff;
}

</style>

<div class="bg-white p-4 ">
    <div class="text-center py-4">
        <h4>SELECT CATEGORY</h4>
        <h5 class="text-light font-weight-normal">Pick a category that matches the group your item belong to.</h5>
    </div>

    <!----- Include view from components/alert----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert----->

    <form action="{{ url($route.'/category') }}" method="POST">
        {{ csrf_field() }}
        <div class="element-continer">
            <div class="element border">
                <div class="row">
                    <div class="col text-center border-right pr-0" style="max-width:50px;">
                        <div class="h-100 py-1 drop ">
                            <i class="fa fa-angle-down"></i>
                        </div>
                    </div>
                    <div class="col py-1">
                        <span>All categories</span>
                    </div>
                </div>
            </div>
            <div class="element-children">
                @foreach($categories_list as $child)
                    @component('accounts.create-ads-fields.category-item', ['row'=>$child])@endcomponent
                @endforeach
            </div>
        </div>
        
        <!-- <button type="submit" class="btn btn-primary my-1 ">Continue Payment</button> -->
    </form>
</div>
@if(request('post_id'))
<div class="mt-4">
    <a class="btn btn-light border px-5" href="{{ url($route.'/details/'.request('post_id')) }}">Continue</a>
</div>
@endif

</div>
<script>
jQuery(function(){
    jQuery('.element-continer .element-continer').addClass('d-none');

    jQuery('.element').on('click', this, function(){
        if(jQuery(this).hasClass('active')) {
            jQuery(this).siblings('.element-children')
                .children('.element-continer')
                .removeClass('d-none')
                .find('.element-continer')
                .addClass('d-none')
                .prevObject.find('.element')
                .removeClass('active');
        } else {
            jQuery(this).addClass('active')
                .siblings('.element-children')
                .children('.element-continer')
                .removeClass('d-none');
        }
        
        jQuery(this).parent('.element-continer')
            .siblings('.element-continer')
            .addClass('d-none');
    })
});

</script>

@endsection