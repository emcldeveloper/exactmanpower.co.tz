@extends('admin')

@section('title', 'Tax Rate')

@section('content')

<div class="main-container-middle container-fluid px-4 py-3">

    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">Tax Rate Settings</h5>
        </div>

        <div class="card-body">

            <form method="POST" action="{{ url('admin/calculator/taxRate/update/'.$taxrate->id) }}">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    <div class="col-md-4">
                        <label>Pay One Reduction</label>
                        <input type="number" name="payone_reduction" class="form-control"
                            value="{{ $taxrate->payone_reduction }}">
                    </div>

                    <div class="col-md-4">
                        <label>Pay Two Reduction</label>
                        <input type="number" name="paytwo_reduction" class="form-control"
                            value="{{ $taxrate->paytwo_reduction }}">
                    </div>

                    <div class="col-md-4">
                        <label>Pay Three Reduction</label>
                        <input type="number" name="paythree_reduction" class="form-control"
                            value="{{ $taxrate->paythree_reduction }}">
                    </div>

                    <div class="col-md-4">
                        <label>Pay Four Reduction</label>
                        <input type="number" name="payfour_reduction" class="form-control"
                            value="{{ $taxrate->payfour_reduction }}">
                    </div>

                    <div class="col-md-4">
                        <label>Pay Two Addition</label>
                        <input type="number" name="paytwo_addition" class="form-control"
                            value="{{ $taxrate->paytwo_addition }}">
                    </div>

                    <div class="col-md-4">
                        <label>Pay Three Addition</label>
                        <input type="number" name="paythree_addition" class="form-control"
                            value="{{ $taxrate->paythree_addition }}">
                    </div>

                    <div class="col-md-4">
                        <label>Pay Four Addition</label>
                        <input type="number" name="payfour_addition" class="form-control"
                            value="{{ $taxrate->payfour_addition }}">
                    </div>

                    <div class="col-md-4">
                        <label>Pay One %</label>
                        <input type="number" step="0.01" name="payone_percentage" class="form-control"
                            value="{{ $taxrate->payone_percentage }}">
                    </div>

                    <div class="col-md-4">
                        <label>Pay Two %</label>
                        <input type="number" step="0.01" name="paytwo_percentage" class="form-control"
                            value="{{ $taxrate->paytwo_percentage }}">
                    </div>

                    <div class="col-md-4">
                        <label>Pay Three %</label>
                        <input type="number" step="0.01" name="paythree_percentage" class="form-control"
                            value="{{ $taxrate->paythree_percentage }}">
                    </div>

                    <div class="col-md-4">
                        <label>Pay Four %</label>
                        <input type="number" step="0.01" name="payfour_percentage" class="form-control"
                            value="{{ $taxrate->payfour_percentage }}">
                    </div>

                    <div class="col-md-4">
                        <label>Insurance</label>
                        <input type="number" step="0.01" name="insurance" class="form-control"
                            value="{{ $taxrate->insurance }}">
                    </div>

                </div>

                <div class="mt-4">
                    <button class="btn btn-primary">
                        Update Tax Rate
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection