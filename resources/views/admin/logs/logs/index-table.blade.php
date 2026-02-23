
<div class="clearfix">
    <div class="p-3">
        <!----- Include view from components/alert----->
        @component('components.alert')@endcomponent
        <!----- End include view from components/alert----->

        <div class="d-flex align-items-center justify-content-between">
            <div>
                {!! pagination_header_limit($logs_list) !!}
            </div>
            {!! pagination_header_search($logs_list) !!}
        </div>
    </div>

    <table class="table table-striped table-hover table-sm mb-0">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Url</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach ($logs_list as $index => $row)
            <tr>
                <td scope="row">{{ ($logs_list->firstItem() + $index) }}</td>
                <td>
                    <a class="d-block" href="{{ url('admin/logs/logs/show/'. $row->id) }}"><?= $row->name;?></a>
                </td>
                <td>
                    <span class="d-block"><?= $row->url;?></span>
                </td>
                <td class="text-right">
                    <div class="btn-group btn-group-sm">
                        <a href="{{ url('admin/logs/logs/show/'. $row->id) }}" class="btn px-1 py-0"> <i class="fas fa-file"></i> </a>
                        <a href="{{ url('admin/logs/logs/edit/'. $row->id) }}" class="btn px-1 py-0"> <i class="fas fa-pencil-alt"></i> </a>
                        <a href="{{ url('admin/logs/logs/delete/'. $row->id) }}?redirect={{ url()->full() }}" class="btn px-1 py-0 text-danger" data-confirmation='I you sure, you want to delete "{{ $row->name }}"?'> <i class="fas fa-trash"></i> </a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! pagination_footer($logs_list) !!}
</div>