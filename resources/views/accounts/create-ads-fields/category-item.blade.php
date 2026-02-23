<style>
a {
    color: inherit;
}
</style>
<div class="element-continer">
    <div class="element border">
        @if($row->categories->count())
        <a  href="javascript:;" class="row">
            <div class="col text-center border-right pr-0" style="max-width:50px;">
                <div class="h-100 py-1 drop ">
                    <i class="fa fa-angle-down"></i>
                </div>
            </div>
            <div class="col py-1">
                <span>{{ $row->name }}</span>
            </div>
            @if(!is_null($row->price))
            <div class="col-3 py-1 text-right" >
                <span class="pr-3">{{ ($row->price > 0)? 'Tshs '.number_format($row->price): 'free' }}</span>
            </div>
            @endif
        </a>
        @else
        <a href="javascript:;" class="row">
            <div class="col text-center border-right pr-0" style="max-width:50px;">
                <button type="submit" name="category_id" value="{{ $row->category_id }}" class="h-100 p-1 drop btn btn-block">
                    <i class="fa fa-circle"></i>
                </button>
            </div>
            <div class="col py-1">
                <button type="submit" name="category_id" value="{{ $row->category_id }}" class="btn p-0">{{ $row->name }}</button>
            </div>
            @if(!is_null($row->price))
            <div class="col-3 py-1 text-right" >
                <span class="pr-3">{{ ($row->price > 0)? 'Tshs '.number_format($row->price): 'free' }}</span>
            </div>
            @endif
        </a>
        @endif
        
    </div>
    @if($row->categories->count())
    <div class="element-children">
        @foreach($row->categories as $child)
            @component('accounts.create-ads-fields.category-item', ['row'=>$child])@endcomponent
        @endforeach
    </div>
    @endif
</div>