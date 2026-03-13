@extends('admin')

@section('title', 'Tax Rate')

@section('content')

<div class="main-container-middle container-fluid px-4 py-3">

    <div class="card shadow-sm">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h5 class="mb-0">Personal Income Tax (PAYE) Table</h5>

            <button type="button" id="unlockBtn" class="btn btn-warning btn-sm" data-toggle="modal"
                data-target="#confirmPasswordModal">
                🔒 Unlock Editing
            </button>

        </div>

        <div class="card-body">

            <form method="POST" action="{{ url('admin/calculator/taxRate/update/'.$taxrate->id) }}">
                @csrf
                @method('PUT')

                <div class="table-responsive">

                    <table class="table table-bordered table-striped">

                        <thead class="table-primary">
                            <tr>
                                <th>Monthly Income</th>
                                <th>Tax Rate (%)</th>
                                <th>Addition Amount</th>
                            </tr>
                        </thead>

                        <tbody>

                            <tr>
                                <td>
                                    0.0  <span class="mx-4">–</span>
                                    <input type="number" class="form-control editable-field d-inline w-auto"
                                        name="payone_reduction" value="{{ $taxrate->payone_reduction }}" disabled>
                                </td>

                                <td>0%</td>
                                <td>0</td>
                            </tr>


                            <tr>
                                <td>
                                    {{ number_format($taxrate->payone_reduction + 1) }}
                                    <span class="mx-3">–</span>
                                    <input type="number" class="form-control editable-field d-inline w-auto"
                                        name="paytwo_reduction" value="{{ $taxrate->paytwo_reduction }}" disabled>
                                </td>

                                <td>
                                    <input type="number" step="0.01" class="form-control editable-field"
                                        name="payone_percentage" value="{{ $taxrate->payone_percentage * 100 }}"
                                        disabled>
                                </td>

                                <td>0</td>
                            </tr>


                            <tr>
                                <td>
                                    {{ number_format($taxrate->paytwo_reduction + 1) }}
                                    <span class="mx-3">–</span>
                                    <input type="number" class="form-control editable-field d-inline w-auto"
                                        name="paythree_reduction" value="{{ $taxrate->paythree_reduction }}" disabled>
                                </td>

                                <td>
                                    <input type="number" step="0.01" class="form-control editable-field"
                                        name="paytwo_percentage" value="{{ $taxrate->paytwo_percentage * 100 }}"
                                        disabled>
                                </td>

                                <td>
                                    <input type="number" class="form-control editable-field" name="paytwo_addition"
                                        value="{{ $taxrate->paytwo_addition }}" disabled>
                                </td>
                            </tr>


                            <tr>
                                <td>
                                    {{ number_format($taxrate->paythree_reduction + 1) }}
                                    <span class="mx-3">–</span>
                                    <input type="number" class="form-control editable-field d-inline w-auto"
                                        name="payfour_reduction" value="{{ $taxrate->payfour_reduction }}" disabled>
                                </td>

                                <td>
                                    <input type="number" step="0.01" class="form-control editable-field"
                                        name="paythree_percentage" value="{{ $taxrate->paythree_percentage * 100 }}"
                                        disabled>
                                </td>

                                <td>
                                    <input type="number" class="form-control editable-field" name="paythree_addition"
                                        value="{{ $taxrate->paythree_addition }}" disabled>
                                </td>
                            </tr>


                            <tr>
                                <td>
                                    {{ number_format($taxrate->payfour_reduction + 1) }} <span class="mx-3">–</span> And Above
                                </td>

                                <td>
                                    <input type="number" step="0.01" class="form-control editable-field"
                                        name="payfour_percentage" value="{{ $taxrate->payfour_percentage * 100 }}"
                                        disabled>
                                </td>

                                <td>
                                    <input type="number" class="form-control editable-field" name="payfour_addition"
                                        value="{{ $taxrate->payfour_addition }}" disabled>
                                </td>
                            </tr>

                        </tbody>

                    </table>

                </div>

                <div class="mt-4">

                    <button class="btn btn-primary" id="saveBtn" disabled>
                        💾 Update PAYE Settings
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- PASSWORD CONFIRMATION MODAL --}}

<div class="modal fade" id="confirmPasswordModal" tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Confirm Admin Password</h5>
                <button type="button" class="btn-close" data-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <label>Enter your password to unlock editing</label>

                <input type="password" id="adminPassword" class="form-control">

                <div id="passwordError" class="text-danger small mt-2"></div>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Cancel
                </button>

                <button type="button" class="btn btn-primary" onclick="verifyPassword()">
                    Confirm
                </button>

            </div>

        </div>

    </div>

</div>



<script>
function verifyPassword(){
    let password = document.getElementById('adminPassword').value;

    fetch("{{ url('admin/calculator/tax-rate/confirm-password') }}", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({password: password})
    })
    .then(res => res.json())
    .then(data => {
        if(data.success) {
            document.querySelectorAll('.editable-field').forEach(function(field) {
                field.removeAttribute('disabled');
            });

            document.getElementById('saveBtn').removeAttribute('disabled');

            // Bootstrap 4 way to hide modal (using jQuery)
            $('#confirmPasswordModal').modal('hide');
            
            // OR if you prefer vanilla JavaScript with Bootstrap 4:
            // $(document.getElementById('confirmPasswordModal')).modal('hide');
            
        } else {
            document.getElementById('passwordError').innerText = "Incorrect password";
        }
    });
}
</script>

@endsection