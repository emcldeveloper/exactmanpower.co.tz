
<div class="clearfix">
    <div class="px-3 pb-3">
        <!----- Include view from components/alert----->
        @component('components.alert')@endcomponent
        <!----- End include view from components/alert----->

        <div class="row align-items-center justify-content-between m-0">
            <div class="col-12 col-md-6 p-0 mb-3 mb-md-0">
                {!! pagination_header_limit($locations_list) !!}
            </div>
            <div class="col-12 col-md-6 p-0 mb-3 mb-md-0">
                {!! pagination_header_search($locations_list) !!}
            </div>
        </div>
    </div>
    
    <div class="px-3">
        @if(true)
        @foreach ($locations_list as $index => $row)
        <div class="card zoom hover-container box-shadow rounded-0 py-2 px-4 mb-2">
            <div class="row align-items-center">
                <div class="col pr-0" style="max-width:50px;">{{ ($locations_list->firstItem() + $index) }}</div>
                
                <div class="col pr-0">
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-4">
                            <a href="{{ url('admin/setting/locations/show/'.$row->location_id) }}" class="media align-items-center">
                                <div class="madia-body">
                                    <div>{{ $row->name }}</div>
                                </div>
                            </a>
                        </div>
                        
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    @if($row->undefined)
                                    <a class="d-block" href="{{ url('admin/undefined/show/'. $row->undefined->undefined) }}">
                                        {{ $row->undefined->undefined }}
                                    </a>
                                    @endif
                                </div>
                                <div class="col">
                                    @if($row->type == 1)
                                    <div class="badge badge-success badge-custom">Active</div>
                                    @elseif($row->type == 2)
                                    <div class="badge badge-danger badge-custom">Banned</div>
                                    @else
                                    <div class="badge badge-dark badge-custom">Inactive</div>
                                    @endif
                                </div>
                                <div class="col">
                                    <span class="d-block">{{ $row->latitude }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col text-right" style="max-width:150px;">
                    <div class="btn-group btn-group-sm">
                        <a href="{{ url('admin/setting/locations/show/'.$row->location_id) }}" class="btn btn-outline-dark btn-circle px-1 mr-2"> <i class="fas fa-file"></i> </a>
                        <a href="{{ url('admin/setting/locations/edit/'. $row->location_id) }}" class="btn btn-outline-dark btn-circle px-1 mr-2 "> <i class="fas fa-pencil-alt"></i> </a>
                        <a href="{{ url('admin/setting/locations/delete/'. $row->location_id) }}?redirect={{ url()->full() }}" class="btn btn-outline-danger btn-circle px-1 mr-2" data-confirmation='I you sure, you want to delete "{{ $row->name }}"?'> <i class="fas fa-trash"></i> </a>
                        <a data-toggle="collapse" href="#collapse-more-{{ $row->location_id }}" class="btn btn-link text-dark mr-1" title="More"> <i class="fas fa-ellipsis-v fa-sm"></i> </a>
                    </div>
                </div>
            </div>
            <div class="collapse" id="collapse-more-{{ $row->location_id }}">
                <div class="card bg-default p-3 my-3">
                    <div class="text-muted h6 m-0">Details</div>
                    <hr class="my-3"/>
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Name</dd>
                                <dd class="col-sm-7 text-truncate">
                                    {{ ($row->name)? $row->name: '-' }}
                                </dd>
                            </dl>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Parent Location</dd>
                                <dd class="col-sm-7 text-truncate">
                                    @if($row->location)
                                    {{ $row->location->undefined }}
                                    @endif
                                </dd>
                            </dl>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Type</dd>
                                <dd class="col-sm-7 text-truncate">
                                    @if($row->type == 0)
                                        Type Zero
                                    @elseif($row->type == 1)
                                        Type One
                                    @elseif($row->type == 2)
                                        Type Two
                                    @endif
                                </dd>
                            </dl>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Latitude</dd>
                                <dd class="col-sm-7 text-truncate">
                                    {{ ($row->latitude)? $row->latitude: '-' }}
                                </dd>
                            </dl>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Longitude</dd>
                                <dd class="col-sm-7 text-truncate">
                                    {{ ($row->longitude)? $row->longitude: '-' }}
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <div class="border bg-white">
            <table class="table table-hover table-sm mb-0">
                <thead class="table-primary">
                    <tr>
                        <td>#</td>
                        <td>Name</td>
                        <td>Parent Location</td>
                        <td>Type</td>
                        <td>Latitude</td>
                        <td>Longitude</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                @foreach ($locations_list as $index => $row)
                    <tr>
                        <td scope="row">{{ ($locations_list->firstItem() + $index) }}</td>
                        <td>
                            <a class="d-block" href="{{ url('admin/setting/locations/show/'.$row->location_id) }}"><?= $row->name;?></a>
                        </td>
                        <td>
                            @if($row->undefined)
                            <a class="d-block" href="{{ url('admin/undefined/show/'. $row->undefined->undefined) }}">
                                <?= $row->undefined->undefined;?>
                            </a>
                            @endif
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
                            <span class="d-block"><?= $row->latitude;?></span>
                        </td>
                        <td>
                            <span class="d-block"><?= $row->longitude;?></span>
                        </td>
                        <td class="text-right">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ url('admin/setting/locations/show/'. $row->location_id) }}" class="btn px-1 py-0"> <i class="fas fa-file"></i> </a>
                                <a href="{{ url('admin/setting/locations/edit/'. $row->location_id) }}" class="btn px-1 py-0"> <i class="fas fa-pencil-alt"></i> </a>
                                <a href="{{ url('admin/setting/locations/delete/'. $row->location_id) }}?redirect={{ url()->full() }}" class="btn px-1 py-0 text-danger" data-confirmation='I you sure, you want to delete "{{ $row->name }}"?'> <i class="fas fa-trash"></i> </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                @if($locations_list->count() > 0)
                <tfoot class="table-active">
                    <tr>
                        <td>#</td>
                        <td>Name</td>
                        <td>Parent Location</td>
                        <td>Type</td>
                        <td>Latitude</td>
                        <td>Longitude</td>
                        <td></td>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>
        @endif

        {!! pagination_footer($locations_list) !!}
    </div>
</div>