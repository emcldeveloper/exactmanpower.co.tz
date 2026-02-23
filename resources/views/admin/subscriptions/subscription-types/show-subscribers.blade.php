
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
                <th>Email</th>
                <th>Is Valid</th>
                <th>Status</th>
                <th>Notes</th>
                <th>Timestamp</th>
                <th>Deactivated Time</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach ($sub_page_list as $index => $row)
            <tr>
                <td scope="row">{{ ($sub_page_list->firstItem() + $index) }}</td>
                <td>
                    <span class="d-block"><?= $row->email;?></span>
                </td>
                <td>
                    @if($row->is_valid == 1)
                    <i class="fa fa-check text-success" aria-hidden="true"></i>
                    @endif
                </td>
                <td class="">
                    @if($row->status == 1)
                    <div class="badge badge-custom badge-success">Active</div>
                    @elseif($row->status == 2)
                    <div class="badge badge-custom badge-danger">Banned</div>
                    @else
                    <div class="badge badge-custom badge-dark">Inactive</div>
                    @endif
                </td>
                <td>
                    <span class="d-block"><?= $row->notes;?></span>
                </td>
                <td>
                    <span class="d-block"><?= $row->timestamp;?></span>
                </td>
                <td>
                    <span class="d-block"><?= $row->deactivated_at;?></span>
                </td>
                <td class="text-right">
                    <div class="btn-group btn-group-sm">
                        <a href="{{ url('admin/subscribers/show/'. $row->id) }}" class="btn px-1 py-0"> <i class="fas fa-file"></i> </a>
                        <a href="{{ url('admin/subscribers/edit/'. $row->id) }}" class="btn px-1 py-0"> <i class="fas fa-pencil-alt"></i> </a>
                        <a href="{{ url('admin/subscribers/delete/'. $row->id) }}?redirect={{ url()->full() }}" class="btn px-1 py-0 text-danger" data-confirmation='I you sure, you want to delete "{{ $row->id }}"?'> <i class="fas fa-trash"></i> </a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! pagination_footer($sub_page_list) !!}
</div>