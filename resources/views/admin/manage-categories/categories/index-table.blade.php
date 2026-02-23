
<div class="clearfix">
    <div class="p-3">
        <!----- Include view from components/alert----->
        @component('components.alert')@endcomponent
        <!----- End include view from components/alert----->

        <div class="d-flex align-items-center justify-content-between">
            <div>
                {!! pagination_header_limit($categories_list) !!}
            </div>
            {!! pagination_header_search($categories_list) !!}
        </div>
    </div>

    <table class="table table-striped table-hover table-sm mb-0">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Image</th>
                <th>Group</th>
                <th>Show on menu</th>
                <th>Parent Category</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach ($categories_list as $index => $row)
            <tr>
                <td scope="row">{{ ($categories_list->firstItem() + $index) }}</td>
                <td>
                    <a class="d-block" href="{{ url($route.'/show/'. $row->id) }}">
                        @if($row->get_icon_url())
                        <img style="width:30px;" class="img-thumbnail mr-2" src="{{ $row->get_icon_url() }}"> 
                        @endif
                        <?= $row->name;?>
                    </a>
                </td>
                <td>
                    <img style="width:60px;" class="border mr-2" src="{{ $row->get_image_url() }}">
                    <!-- <span class="d-block"><?= $row->image_url;?></span> -->
                </td>
                <td>
                    @if($row->is_group == 1)
                    <i class="fa fa-check text-success" aria-hidden="true"></i>
                    @endif
                </td>
                <td>
                    @if($row->is_stared == 1)
                    <i class="fa fa-check text-success" aria-hidden="true"></i>
                    @endif
                </td>
                <td>
                    
                    @if($row->category)
                    <a class="d-block" href="{{ url('admin/category/show/'. $row->category->category_id) }}"><?= $row->category->name;?></a>
                    @endif
                </td>
                <td class="text-right">
                    <div class="btn-group btn-group-sm">
                        <a href="{{ url($route.'/show/'. $row->id) }}" class="btn px-1 py-0"> <i class="fas fa-file"></i> </a>
                        <a href="{{ url($route.'/edit/'. $row->id) }}" class="btn px-1 py-0"> <i class="fas fa-pencil-alt"></i> </a>
                        <a href="{{ url($route.'/delete/'. $row->id) }}?redirect={{ url()->full() }}" class="btn px-1 py-0 text-danger" data-confirmation='I you sure, you want to delete "{{ $row->name }}"?'> <i class="fas fa-trash"></i> </a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! pagination_footer($categories_list) !!}
</div>