
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
                <th>Logo</th>
                <th>Type</th>
                <th>Address</th>
                <th>Email</th>
                <th>Phone</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach ($sub_page_list as $index => $row)
            <tr>
                <td scope="row">{{ ($sub_page_list->firstItem() + $index) }}</td>
                <td>
                    <a class="d-block" href="{{ url('admin/accounts/show/'. $row->id) }}"><?= $row->name;?></a>
                </td>
                <td>
                    <span class="d-block"><?= $row->logo;?></span>
                </td>
                <td class="">
                    @if($row->type == 1)
                    <div class="badge badge-custom badge-success">Active</div>
                    @elseif($row->type == 2)
                    <div class="badge badge-custom badge-danger">Banned</div>
                    @else
                    <div class="badge badge-custom badge-dark">Inactive</div>
                    @endif
                </td>
                <td>
                    <span class="d-block"><?= $row->address;?></span>
                </td>
                <td>
                    <span class="d-block"><?= $row->email;?></span>
                </td>
                <td>
                    <span class="d-block"><?= $row->phone;?></span>
                </td>
                <td class="text-right">
                    <div class="btn-group btn-group-sm">
                        <a href="{{ url('admin/accounts/show/'. $row->id) }}" class="btn px-1 py-0"> <i class="fas fa-file"></i> </a>
                        <a href="{{ url('admin/accounts/edit/'. $row->id) }}" class="btn px-1 py-0"> <i class="fas fa-pencil-alt"></i> </a>
                        <a href="{{ url('admin/accounts/delete/'. $row->id) }}?redirect={{ url()->full() }}" class="btn px-1 py-0 text-danger" data-confirmation='I you sure, you want to delete "{{ $row->name }}"?'> <i class="fas fa-trash"></i> </a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! pagination_footer($sub_page_list) !!}
</div>