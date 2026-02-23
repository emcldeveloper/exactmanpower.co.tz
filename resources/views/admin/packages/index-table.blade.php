
<div class="clearfix">
    <div class="p-3">
        <!----- Include view from components/alert----->
        @component('components.alert')@endcomponent
        <!----- End include view from components/alert----->

        <div class="d-flex align-items-center justify-content-between">
            <div>
                {!! pagination_header_limit($packages_list) !!}
            </div>
            {!! pagination_header_search($packages_list) !!}
        </div>
    </div>

    <table class="table table-striped table-hover table-sm mb-0">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Price</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach ($packages_list as $index => $row)
            <tr>
                <td scope="row">{{ ($packages_list->firstItem() + $index) }}</td>
                <td>
                    <a class="d-block" href="{{ url('admin/manage-ads/packages/show/'. $row->id) }}"><?= $row->name;?></a>
                </td>
                <td>
                    <span class="d-block"><?= $row->price;?></span>
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
                <td class="text-right">
                    <div class="btn-group btn-group-sm">
                        <a href="{{ url('admin/manage-ads/packages/show/'. $row->id) }}" class="btn px-1 py-0"> <i class="fas fa-file"></i> </a>
                        <a href="{{ url('admin/manage-ads/packages/edit/'. $row->id) }}" class="btn px-1 py-0"> <i class="fas fa-pencil-alt"></i> </a>
                        <a href="{{ url('admin/manage-ads/packages/delete/'. $row->id) }}?redirect={{ url()->full() }}" class="btn px-1 py-0 text-danger" data-confirmation='I you sure, you want to delete "{{ $row->name }}"?'> <i class="fas fa-trash"></i> </a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! pagination_footer($packages_list) !!}
</div>