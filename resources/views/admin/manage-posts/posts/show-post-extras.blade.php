
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
                <th>Post Extra Author</th>
                <th>Post Extra Date</th>
                <th>Post Extra Content</th>
                <th>Post Extra Type</th>
                <th>Parent Post Extra</th>
                <th>Updated Time</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach ($sub_page_list as $index => $row)
            <tr>
                <td scope="row">{{ ($sub_page_list->firstItem() + $index) }}</td>
                <td>
                    <span class="d-block"><?= $row->post_extra_author;?></span>
                </td>
                <td>
                    <span class="d-block"><?= $row->post_extra_date;?></span>
                </td>
                <td>
                    <span class="d-block"><?= $row->post_extra_content;?></span>
                </td>
                <td>
                    <span class="d-block"><?= $row->post_extra_type;?></span>
                </td>
                <td>
                    @if($row->undefined)
                    <a class="d-block" href="{{ url('admin/undefined/show/'. $row->undefined->undefined) }}"><?= $row->undefined->undefined;?></a>
                    @endif
                </td>
                <td>
                    <span class="d-block"><?= $row->updated_at;?></span>
                </td>
                <td class="text-right">
                    <div class="btn-group btn-group-sm">
                        <a href="{{ url('admin/post-extras/show/'. $row->id) }}" class="btn px-1 py-0"> <i class="fas fa-file"></i> </a>
                        <a href="{{ url('admin/post-extras/edit/'. $row->id) }}" class="btn px-1 py-0"> <i class="fas fa-pencil-alt"></i> </a>
                        <a href="{{ url('admin/post-extras/delete/'. $row->id) }}?redirect={{ url()->full() }}" class="btn px-1 py-0 text-danger" data-confirmation='I you sure, you want to delete "{{ $row->id }}"?'> <i class="fas fa-trash"></i> </a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! pagination_footer($sub_page_list) !!}
</div>