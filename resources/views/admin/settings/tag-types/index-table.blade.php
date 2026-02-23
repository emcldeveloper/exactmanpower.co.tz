
<div class="clearfix">
    <div class="p-3">
        <!----- Include view from components/alert----->
        @component('components.alert')@endcomponent
        <!----- End include view from components/alert----->

        <div class="d-flex align-items-center justify-content-between">
            <div>
                {!! pagination_header_limit($tag_types_list) !!}
            </div>
            {!! pagination_header_search($tag_types_list) !!}
        </div>
    </div>

    <table class="table table-striped table-hover table-sm mb-0">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Post Type</th>
                <th>Name</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach ($tag_types_list as $index => $row)
            <tr>
                <td scope="row">{{ ($tag_types_list->firstItem() + $index) }}</td>
                <td>
                    @if($row->post_type)
                    <a class="d-block" href="{{ url('admin/manage-posts/post-types/show/'. $row->post_type->id) }}"><?= $row->post_type->name;?></a>
                    @endif
                </td>
                <td>
                    <a class="d-block" href="{{ url('admin/settings/tag-types/show/'. $row->id) }}"><?= $row->name;?></a>
                </td>
                <td class="text-right">
                    <div class="btn-group btn-group-sm">
                        <a href="{{ url('admin/settings/tag-types/show/'. $row->id) }}" class="btn px-1 py-0"> <i class="fas fa-file"></i> </a>
                        <a href="{{ url('admin/settings/tag-types/edit/'. $row->id) }}" class="btn px-1 py-0"> <i class="fas fa-pencil-alt"></i> </a>
                        <a href="{{ url('admin/settings/tag-types/delete/'. $row->id) }}?redirect={{ url()->full() }}" class="btn px-1 py-0 text-danger" data-confirmation='I you sure, you want to delete "{{ $row->name }}"?'> <i class="fas fa-trash"></i> </a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! pagination_footer($tag_types_list) !!}
</div>