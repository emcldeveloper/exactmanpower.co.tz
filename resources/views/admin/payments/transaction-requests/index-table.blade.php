
<div class="clearfix">
    <div class="p-3">
        <!----- Include view from components/alert----->
        @component('components.alert')@endcomponent
        <!----- End include view from components/alert----->

        <div class="d-flex align-items-center justify-content-between">
            <div>
                {!! pagination_header_limit($transaction_requests_list) !!}
            </div>
            {!! pagination_header_search($transaction_requests_list) !!}
        </div>
    </div>

    <table class="table table-striped table-hover table-sm mb-0">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Source Table</th>
                <th>Source</th>
                <th>Referent</th>
                <th>Amount</th>
                <th>Type</th>
                <th>Updated Time</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach ($transaction_requests_list as $index => $row)
            <tr>
                <td scope="row">{{ ($transaction_requests_list->firstItem() + $index) }}</td>
                <td>
                    <span class="d-block"><?= $row->source_table;?></span>
                </td>
                <td>
                    <span class="d-block"><?= $row->source_id;?></span>
                </td>
                <td>
                    <span class="d-block"><?= $row->referent_id;?></span>
                </td>
                <td>
                    <span class="d-block"><?= $row->amount;?></span>
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
                    <span class="d-block"><?= $row->updated_at;?></span>
                </td>
                <td class="text-right">
                    <div class="btn-group btn-group-sm">
                        <a href="{{ url('admin/payments/transaction-requests/show/'. $row->id) }}" class="btn px-1 py-0"> <i class="fas fa-file"></i> </a>
                        <a href="{{ url('admin/payments/transaction-requests/edit/'. $row->id) }}" class="btn px-1 py-0"> <i class="fas fa-pencil-alt"></i> </a>
                        <a href="{{ url('admin/payments/transaction-requests/delete/'. $row->id) }}?redirect={{ url()->full() }}" class="btn px-1 py-0 text-danger" data-confirmation='I you sure, you want to delete "{{ $row->id }}"?'> <i class="fas fa-trash"></i> </a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! pagination_footer($transaction_requests_list) !!}
</div>