
<div class="clearfix">
    <div class="p-3">
        <!----- Include view from components/alert----->
        @component('components.alert')@endcomponent
        <!----- End include view from components/alert----->

        <div class="d-flex align-items-center justify-content-between">
            <div>
                {!! pagination_header_limit($languages_list) !!}
            </div>
            {!! pagination_header_search($languages_list) !!}
        </div>
    </div>

    <table class="table table-striped table-hover table-sm mb-0">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Code</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach ($languages_list as $index => $row)
            <tr>
                <td scope="row">{{ ($languages_list->firstItem() + $index) }}</td>
                <td>
                    <a class="d-block" href="{{ url('admin/setting/languages/show/'. $row->id) }}"><?= $row->name;?></a>
                </td>
                <td>
                    <a class="d-block" href="{{ url('admin/setting/languages/show/'. $row->id) }}"><?= $row->locale;?></a>
                </td>
                <td class="text-right">
                    <div class="btn-group btn-group-sm">
                        <a href="{{ url('admin/setting/languages/show/'. $row->id) }}" class="btn px-1 py-0"> <i class="fas fa-file"></i> </a>
                        <a href="{{ url('admin/setting/languages/edit/'. $row->id) }}" class="btn px-1 py-0"> <i class="fas fa-pencil-alt"></i> </a>
                        <a href="{{ url('admin/setting/languages/delete/'. $row->id) }}?redirect={{ url()->full() }}" class="btn px-1 py-0 text-danger" data-confirmation='I you sure, you want to delete "{{ $row->name }}"?'> <i class="fas fa-trash"></i> </a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! pagination_footer($languages_list) !!}
</div>