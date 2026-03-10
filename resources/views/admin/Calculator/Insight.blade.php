@extends('admin')

@section('title', 'Insight')

@section('content')


 <div class="main-container-middle container-fluid px-3">
    <div class="container-header" style="overflow:visible;">
        <div class="d-flex align-items-center justify-content-between p-3">
            <span class="h5 m-0">Salary Insight Logs list</span>

        </div>
    </div>
    <div class="container-detail bg-white">
        <div class="clearfix">
            <div class="">

                <div class="clearfix">
                    <div class="p-3">
                        <!----- Include view from components/alert----->
                        @component('components.alert')@endcomponent
                        <!----- End include view from components/alert----->

                    </div>
                    {{--  <div class="row p-3">

                        <div class="col-md-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h4>{{ $stats['total'] }}</h4>
                                    <small>Total Logs</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h4>{{ $stats['countries'] }}</h4>
                                    <small>Countries</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h4>{{ $stats['devices'] }}</h4>
                                    <small>Devices</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h4>{{ $stats['browsers'] }}</h4>
                                    <small>Browsers</small>
                                </div>
                            </div>
                        </div>

                    </div>  --}}
                    <form method="GET" class="p-3 bg-light">

                        <div class="row">

                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control"
                                    placeholder="Search IP / Browser / OS" value="{{ request('search') }}">
                            </div>

                            <div class="col-md-3">
                                <select name="country" class="form-control">
                                    <option value="">All Countries</option>
                                    @foreach($countries as $country)
                                    <option value="{{ $country }}" {{ request('country')==$country ? 'selected' : '' }}>
                                        {{ $country }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <select name="device" class="form-control">
                                    <option value="">All Devices</option>
                                    <option value="WebKit" {{ request('device')=='WebKit' ?'selected':'' }}>WebKit
                                    </option>
                                    <option value="Mobile" {{ request('device')=='Mobile' ?'selected':'' }}>Mobile
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <button class="btn btn-primary w-100">Filter</button>
                            </div>

                        </div>

                    </form>
               <div class="table-responsive w-100">
                        <table class="table table-striped table-hover table-sm mb-0">
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Type</th>
                                    <th>Currency</th>
                                    <th>Period</th>
                                    <th>IP Address</th>
                                    <th>Device</th>
                                    <th>OS</th>
                                    <th>Browser</th>
                                    <th>Country</th>
                                    <th>City</th>
                                    <th>Date</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($insightLogs as $index => $row)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $row->salary_type }}</td>
                                    <td>{{ strtoupper($row->currency) }}</td>
                                    <td>{{ ucfirst($row->period) }}</td>
                                    <td>{{ $row->ip_address }}</td>
                                    <td>{{ $row->device }}</td>
                                    <td>{{ $row->os }}</td>
                                    <td>{{ $row->browser }}</td>
                                    <td>{{ $row->country }}</td>
                                    <td>{{ $row->city }}</td>
                                    <td>{{ \Carbon\Carbon::parse($row->created_at)->format('d M Y H:i') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $insightLogs->links() }}

                </div>
            </div>
        </div>
    </div>
</div>


@endsection