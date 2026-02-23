@extends('account')

@section('title', 'Account Orders')

@section('content')

<h4 class="pb-2 pt-3">Payment Logs</h4>


<div class="clearfix bg-white p-4">
    <form action="" method="GET">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Quick search">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>
    <div class="clearfix mt-4">
        
        <table class="table table-hover table-sm table-striped table-borderless">
            <thead class="bg-light small">
                <tr>
                    <th>ID</th>
                    <th>Product</th>
                    <th><div>Listing Type</div></th>
                    <th>Payment Type</th>
                    <th>Expire Date</th>
                    <th>Package Type</th>
                    <th>Price (Tshs)</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($account_orders_list as $index => $row)
                <tr>
                    <td scope="row">{{ ($row->id) }}</td>
                    <td>
                        @if($row->post)
                        <a class="d-block"><?= $row->post->post_title;?></a>
                        @endif
                    </td>
                    <td>
                        @if($row->post)
                        <span class="d-block">Ads</span>
                        @elseif($row->post)
                        <span class="d-block">Banner</span>
                        @endif
                    </td>
                    <td>
                        <span class="d-block">Tigo Pesa</span>
                    </td>
                    <td>
                        @if($row->post && $row->post->expired_date)
                        {{ date('d M Y', strtotime($row->post->expired_date)) }}
                        @endif
                    </td>
                    <td class="">
                        @if($row->post && $row->post->package)
                        <div class="">{{ $row->post->package->name }}</div>
                        @endif
                    </td>
                    <td>
                        @if($row->price == 0)
                        Free
                        @else
                        {{ number_format($row->price) }}
                        @endif
                    </td>
                    <td class="text-right">
                        @if($row->status == 1) 
                        Active
                        @else
                        Inactive
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {!! pagination_footer($account_orders_list) !!}
    </div>
</div>


@endsection
