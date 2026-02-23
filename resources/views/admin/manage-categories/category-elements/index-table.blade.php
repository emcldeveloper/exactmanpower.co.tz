
<div class="clearfix">
    <div class="p-3">
        <!----- Include view from components/alert----->
        @component('components.alert')@endcomponent
        <!----- End include view from components/alert----->

        <div class="d-flex align-items-center justify-content-between">
            <div>
                {!! pagination_header_limit($category_elements_list) !!}
            </div>
            {!! pagination_header_search($category_elements_list) !!}
        </div>
    </div>

    <table class="table table-striped table-hover table-sm mb-0">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Category</th>
                <th>Name</th>
                <th>Title</th>
                <th>Sub Title</th>
                <th>Info Message</th>
                <th>Error Message</th>
                <th>Success Message</th>
                <th>Warning Message</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach ($category_elements_list as $index => $row)
            <tr>
                <td scope="row">{{ ($category_elements_list->firstItem() + $index) }}</td>
                <td>
                    @if($row->category)
                    <a class="d-block" href="{{ url('admin/manage-categories/categories/show/'. $row->category->id) }}"><?= $row->category->name;?></a>
                    @endif
                </td>
                <td>
                    <a class="d-block" href="{{ url('admin/manage-categories/category-elements/show/'. $row->id) }}"><?= $row->name;?></a>
                </td>
                <td>
                    <a class="d-block" href="{{ url('admin/manage-categories/category-elements/show/'. $row->id) }}"><?= $row->title;?></a>
                </td>
                <td>
                    <span class="d-block"><?= $row->sub_title;?></span>
                </td>
                <td>
                    <span class="d-block"><?= $row->info_message;?></span>
                </td>
                <td>
                    <span class="d-block"><?= $row->error_message;?></span>
                </td>
                <td>
                    <span class="d-block"><?= $row->success_message;?></span>
                </td>
                <td>
                    <span class="d-block"><?= $row->warning_message;?></span>
                </td>
                <td class="text-right">
                    <div class="btn-group btn-group-sm">
                        <a href="{{ url('admin/manage-categories/category-elements/show/'. $row->id) }}" class="btn px-1 py-0"> <i class="fas fa-file"></i> </a>
                        <a href="{{ url('admin/manage-categories/category-elements/edit/'. $row->id) }}" class="btn px-1 py-0"> <i class="fas fa-pencil-alt"></i> </a>
                        <a href="{{ url('admin/manage-categories/category-elements/delete/'. $row->id) }}?redirect={{ url()->full() }}" class="btn px-1 py-0 text-danger" data-confirmation='I you sure, you want to delete "{{ $row->name }}"?'> <i class="fas fa-trash"></i> </a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! pagination_footer($category_elements_list) !!}
</div>