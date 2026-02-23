
<div class="clearfix">
    <div class="p-3">
        <!----- Include view from components/alert----->
        @component('components.alert')@endcomponent
        <!----- End include view from components/alert----->

        <div class="d-flex align-items-center justify-content-between">
            <div>
                {!! pagination_header_limit($sub_page_list) !!}
            </div>
            {!! pagination_header_search($sub_page_list) !!}
        </div>
    </div>

    <table class="table table-striped table-hover table-sm">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Title</th>
                <th>Sub Title</th>
                <th>Info Message</th>
                <th>Error Message</th>
                <th>Success Message</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach ($sub_page_list as $index => $row)
            <tr>
                <td scope="row">{{ ($sub_page_list->firstItem() + $index) }}</td>
                <td>
                    <a class="d-block" href="{{ url('admin/category-elements/show/'. $row->id) }}"><?= $row->name;?></a>
                </td>
                <td>
                    <a class="d-block" href="{{ url('admin/category-elements/show/'. $row->id) }}"><?= $row->title;?></a>
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
                <td class="text-right">
                    @if(false)
                    <div class="btn-group btn-group-sm">
                        <a href="{{ url('admin/category-elements/show/'. $row->id) }}" class="btn px-1 py-0"> <i class="fas fa-file"></i> </a>
                        <a href="{{ url('admin/category-elements/edit/'. $row->id) }}" class="btn px-1 py-0"> <i class="fas fa-pencil-alt"></i> </a>
                        <a href="{{ url('admin/category-elements/delete/'. $row->id) }}?redirect={{ url()->full() }}" class="btn px-1 py-0 text-danger" data-confirmation='I you sure, you want to delete "{{ $row->name }}"?'> <i class="fas fa-trash"></i> </a>
                    </div>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! pagination_footer($sub_page_list) !!}
</div>