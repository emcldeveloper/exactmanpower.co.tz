
<div class="clearfix">
    <div class="p-3">
        <!----- Include view from components/alert----->
        @component('components.alert')@endcomponent
        <!----- End include view from components/alert----->

        <div class="d-flex align-items-center justify-content-between">
            <div>
                {!! pagination_header_limit($locations_list) !!}
            </div>
            {!! pagination_header_search($locations_list) !!}
        </div>
    </div>

    <table class="table table-striped table-hover table-sm mb-0">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Parent Location</th>
                <th>Type</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach ($locations_list as $index => $row)
            <tr>
                <td scope="row">{{ ($locations_list->firstItem() + $index) }}</td>
                <td>
                    <a class="d-block" href="{{ url('admin/settings/locations/show/'. $row->id) }}"><?= $row->name;?></a>
                </td>
                <td>
                    @if($row->location)
                    <a class="d-block" href="{{ url('admin/settings/locations/show/'. $row->parent_location_id) }}"><?= $row->location->name;?></a>
                    @endif
                </td>
                <td class="">
                    @if($row->type == 0)
                    <div class="">Country</div>
                    @elseif($row->type == 1)
                    <div class="">Region</div>
                    @elseif($row->type == 2)
                    <div class="">District</div>
                    @elseif($row->type == 3)
                    <div class="">Ward</div>
                    @else
                    <div class="">Street</div>
                    @endif
                </td>
                <td>
                    <span class="d-block"><?= $row->latitude;?></span>
                </td>
                <td>
                    <span class="d-block"><?= $row->longitude;?></span>
                </td>
                <td class="text-right">
                    <div class="btn-group btn-group-sm">
                        <a href="{{ url('admin/settings/locations/show/'. $row->id) }}" class="btn px-1 py-0"> <i class="fas fa-file"></i> </a>
                        <a href="{{ url('admin/settings/locations/edit/'. $row->id) }}" class="btn px-1 py-0"> <i class="fas fa-pencil-alt"></i> </a>
                        <a href="{{ url('admin/settings/locations/delete/'. $row->id) }}?redirect={{ url()->full() }}" class="btn px-1 py-0 text-danger" data-confirmation='I you sure, you want to delete "{{ $row->name }}"?'> <i class="fas fa-trash"></i> </a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! pagination_footer($locations_list) !!}
</div>