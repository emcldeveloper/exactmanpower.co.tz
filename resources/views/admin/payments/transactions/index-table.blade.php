
<div class="clearfix">
    <div class="p-3">
        <!----- Include view from components/alert----->
        @component('components.alert')@endcomponent
        <!----- End include view from components/alert----->

        <div class="d-flex align-items-center justify-content-between">
            <div>
                {!! pagination_header_limit($transactions_list) !!}
            </div>
            {!! pagination_header_search($transactions_list) !!}
        </div>
    </div>

    <table class="table table-striped table-hover table-sm mb-0">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Source</th>
                <th>Source Table</th>
                <th>Telecom</th>
                <th>Amount</th>
                <th>Charge</th>
                <th>Reference</th>
                <th>Txn</th>
                <th>Txn Time</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach ($transactions_list as $index => $row)
            <tr>
                <td scope="row">{{ ($transactions_list->firstItem() + $index) }}</td>
                <td>
                    <span class="d-block"><?= $row->source_id;?></span>
                </td>
                <td>
                    <span class="d-block"><?= $row->source_table;?></span>
                </td>
                <td>
                    <span class="d-block"><?= $row->telecom;?></span>
                </td>
                <td>
                    <span class="d-block"><?= $row->amount;?></span>
                </td>
                <td>
                    <span class="d-block"><?= $row->charge;?></span>
                </td>
                <td>
                    <span class="d-block"><?= $row->reference_id;?></span>
                </td>
                <td>
                    <span class="d-block"><?= $row->txn_id;?></span>
                </td>
                <td>
                    <span class="d-block"><?= $row->txn_time;?></span>
                </td>
                <td class="text-right">
                    <div class="btn-group btn-group-sm">
                        <a href="{{ url('admin/payments/transactions/show/'. $row->id) }}" class="btn px-1 py-0"> <i class="fas fa-file"></i> </a>
                        <a href="{{ url('admin/payments/transactions/edit/'. $row->id) }}" class="btn px-1 py-0"> <i class="fas fa-pencil-alt"></i> </a>
                        <a href="{{ url('admin/payments/transactions/delete/'. $row->id) }}?redirect={{ url()->full() }}" class="btn px-1 py-0 text-danger" data-confirmation='I you sure, you want to delete "{{ $row->id }}"?'> <i class="fas fa-trash"></i> </a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! pagination_footer($transactions_list) !!}
</div>