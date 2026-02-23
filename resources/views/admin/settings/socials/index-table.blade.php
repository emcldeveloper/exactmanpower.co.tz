
<div class="clearfix">
    <div class="p-3">
        <!----- Include view from components/alert----->
        @component('components.alert')@endcomponent
        <!----- End include view from components/alert----->

        <div class="d-flex align-items-center justify-content-between">
            <div>
                {!! pagination_header_limit($socials_list) !!}
            </div>
            {!! pagination_header_search($socials_list) !!}
        </div>
    </div>

    <table class="table table-striped table-hover table-sm mb-0">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Icon</th>
                <th>Color</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach ($socials_list as $index => $row)
            <tr>
                <td scope="row">{{ ($socials_list->firstItem() + $index) }}</td>
                <td>
                    <a class="d-block" href="{{ url('admin/settings/socials/show/'. $row->id) }}"><?= $row->name;?></a>
                </td>
                <td>
                    @if($row->icon)
                    <img style="height:30px;" src="{{ asset('uploaded/'.$row->icon) }}"/>
                    @endif
                </td>
                <td>
                    {{ $row->color }}
                </td>
                <td class="text-right">
                    <div class="btn-group btn-group-sm">
                        <a href="{{ url('admin/settings/socials/show/'. $row->id) }}" class="btn px-1 py-0"> <i class="fas fa-file"></i> </a>
                        <a href="{{ url('admin/settings/socials/edit/'. $row->id) }}" class="btn px-1 py-0"> <i class="fas fa-pencil-alt"></i> </a>
                        <a href="{{ url('admin/settings/socials/delete/'. $row->id) }}?redirect={{ url()->full() }}" class="btn px-1 py-0 text-danger" data-confirmation='I you sure, you want to delete "{{ $row->name }}"?'> <i class="fas fa-trash"></i> </a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! pagination_footer($socials_list) !!}
</div>