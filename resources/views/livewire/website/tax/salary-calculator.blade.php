<div class="salary-calculator-wrapper py-3">

    <style>
        .salary-calculator-wrapper .containersal {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .salary-calculator-wrapper .form-row {
            display: flex;
            align-items: center;
            margin-bottom: 14px;
        }

        .salary-calculator-wrapper .form-row label {
            width: 40%;
            font-weight: 600;
        }

        .salary-calculator-wrapper .form-row input,
        .salary-calculator-wrapper .form-row select {
            width: 60%;
            padding: 8px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        .salary-calculator-wrapper .btn-main {
            background: #D36314;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.2s;
        }

        .salary-calculator-wrapper .btn-main:hover {
            background: #b55410;
        }

        .salary-calculator-wrapper .action-row {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .salary-calculator-wrapper .action-row button {
            flex: 1;
        }

        .salary-calculator-wrapper .result-detail {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .salary-calculator-wrapper .full-line {
            border-top: 1px solid #000;
            border-bottom: 1px dotted #000;
            padding: 6px 0;
        }

        .salary-calculator-wrapper .double-line {
            border-top: 2px solid #000;
            border-bottom: 3px double #000;
            padding: 6px 0;
        }

        .salary-calculator-wrapper .view-count {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
            font-weight: 600;
            color: #007bff;
        }
    </style>

    <div class="containersal">

        <!-- HEADER -->
        <div class="mb-4 d-flex align-items-center gap-3">
            <img height="70" src="{{ url('/img/calculator/ExactEHRMLOGO.png') }}">
            <h3 class="m-0" style="font-size: 28px;">
                <span style="color:#D36314; font-weight:700;"> - Salary</span>
                <span style="color:black; font-weight:900;">Calculator</span>
            </h3>
        </div>

        <form wire:submit.prevent>

            <!-- Currency -->
            <div class="form-row">
                <label>Select Currency</label>
                <select wire:model.live="currencyType">
                    <option value="">Select</option>
                    <option value="tz">TZS</option>
                    <option value="usd">USD</option>
                </select>
            </div>

            @if($currencyType === 'usd')
            <div class="form-row">
                <label>Exchange Rate</label>
                <input type="number" step="any" wire:model.live.debounce.400ms="exchangeRate">
            </div>
            @endif

            <!-- Salary Type -->
            <div class="form-row">
                <label>Salary Type</label>
                <select wire:model.live="salaryType">
                    <option value="">Select</option>
                    <option value="net">Gross Salary (From Net)</option>
                    <option value="gross">Net Salary (From Gross)</option>
                </select>
            </div>

            <!-- Period -->
            <div class="form-row">
                <label>Period</label>
                <select wire:model.live="period">
                    <option value="monthly">Monthly</option>
                    <option value="annual">Annual</option>
                </select>
            </div>

            <!-- NET INPUT -->
            @if($salaryType === 'net')
            <div class="form-row">
                <label>Net Salary</label>
                <input type="number" step="any" wire:model.live.debounce.400ms="net_pay">
            </div>
            @endif

            <!-- GROSS INPUT -->
            @if($salaryType === 'gross')
            <div class="form-row">
                <label>Basic Salary</label>
                <input type="number" step="any" wire:model.live.debounce.400ms="basic_pay">
            </div>
            @endif

            <!-- Allowances -->
            <div class="form-row">
                <label></label>
                <button type="button" wire:click="addAllowance" class="btn-main w-100">
                    + Add Allowance
                </button>
            </div>

            @foreach($allowances as $index => $allowance)
            <div class="form-row" wire:key="allowance-{{ $index }}">
                <label>Allowance {{ $index + 1 }}</label>
                <div style="width:60%;display:flex;gap:6px;">
                    <input type="number" step="any" wire:model.live.debounce.400ms="allowances.{{ $index }}">

                    <button type="button" wire:click="removeAllowance({{ $index }})" class="btn-main">
                        X
                    </button>
                </div>
            </div>
            @endforeach

        </form>

        <hr>

        @php
        $symbol = $currencyType === 'usd' ? '$' : 'TZS';
        $multiplier = $period === 'annual' ? 12 : 1;
        @endphp

        <!-- RESULTS -->
        <div id="result">

            <div class="result-detail">
                <strong>
                    {{ $salaryType === 'net' ? 'Gross Salary' : 'Net Salary' }}
                </strong>
                <span>
                    {{ $symbol }}
                    {{ number_format(($salaryType === 'net' ? $total_gross : $net_pay) * $multiplier, 2) }}
                </span>
            </div>

            <div class="full-line"></div>

            <div class="result-detail">
                <span>Basic</span>
                <span>{{ $symbol }} {{ number_format($basic_pay * $multiplier, 2) }}</span>
            </div>

            <div class="result-detail">
                <span>Allowances</span>
                <span>{{ $symbol }} {{ number_format($total_allowance * $multiplier, 2) }}</span>
            </div>

            <div class="result-detail">
                <span>SSC (Employee)</span>
                <span>{{ $symbol }} {{ number_format($ssc_employee * $multiplier, 2) }}</span>
            </div>

            <div class="result-detail">
                <span>PAYE</span>
                <span>{{ $symbol }} {{ number_format($pay * $multiplier, 2) }}</span>
            </div>

            <div class="result-detail double-line">
                <strong>Net Salary</strong>
                <span>{{ $symbol }} {{ number_format($net_pay * $multiplier, 2) }}</span>
            </div>

        </div>

        <!-- Toggle Company Cost -->
        <button type="button" wire:click="$toggle('showCompanyCost')" class="btn-main w-100 mt-3">
            {{ $showCompanyCost ? 'Hide Employer Cost ▲' : 'Show Employer Cost ▼' }}
        </button>
        @if($showCompanyCost)
        <div class="mt-4">

            <div class="result-detail full-line">
                <strong>TOTAL COST TO COMPANY</strong>
                <span>AMOUNT</span>
            </div>

            <div class="result-detail">
                <span>Gross Salary</span>
                <span>{{ $symbol }} {{ number_format($total_gross * $multiplier, 2) }}</span>
            </div>

            <div class="result-detail">
                <span>Employer SSC (10%)</span>
                <span>{{ $symbol }} {{ number_format($employer_ssc * $multiplier, 2) }}</span>
            </div>

            <div class="result-detail">
                <span>SDL (3.5%)</span>
                <span>{{ $symbol }} {{ number_format($sdl * $multiplier, 2) }}</span>
            </div>

            <div class="result-detail">
                <span>WCF (0.5%)</span>
                <span>{{ $symbol }} {{ number_format($wcf * $multiplier, 2) }}</span>
            </div>

            <div class="result-detail double-line">
                <strong>GRAND TOTAL</strong>
                <span>{{ $symbol }} {{ number_format($grand_total * $multiplier, 2) }}</span>
            </div>

        </div>
        @endif


        <!-- View Counter -->
        <div class="view-count">
            <span>Calculator Uses</span>
            <span>
                @if($new >= 1000000)
                {{ number_format($new/1000000,1).'M' }}
                @elseif($new >= 1000)
                {{ number_format($new/1000,1).'K' }}
                @else
                {{ $new }}
                
                @endif
            </span>
        </div>

        <!-- Action Buttons -->
        <div class="action-row">
            <button type="button" onclick="downloadPDF()" class="btn-main">
                Download
            </button>
            <button type="button" onclick="shareWhatsApp()" class="btn-main">
                WhatsApp
            </button>
            <button type="button" onclick="openTaxModal()" class="btn-main">
                Tax Rates
            </button>
        </div>
        <!-- TAX RATE MODAL -->
        <div wire:ignore>
            <div class="modal fade" id="taxModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <!-- HEADER -->
                        <div class="modal-header">
                            <h5 class="modal-title">
                                Tanzania Tax Rates & Deductions
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- BODY -->
                        <div class="modal-body">

                            <h6 class="fw-bold">
                                Tanzania PAYE (Personal Income Tax) Table
                            </h6>

                            <table class="table table-bordered text-center">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Monthly Income (TZS)</th>
                                        <th>Annual Income (TZS)</th>
                                        <th>Tax Rate</th>
                                        <th>Addition Amount (TZS)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>0 - {{ number_format($data->payone_reduction) }}</td>
                                        <td>0 - {{ number_format($data->payone_reduction * 12) }}</td>
                                        <td>0%</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>
                                            {{ number_format($data->payone_reduction + 1) }}
                                            -
                                            {{ number_format($data->paytwo_reduction) }}
                                        </td>
                                        <td>
                                            {{ number_format(($data->payone_reduction + 1) * 12) }}
                                            -
                                            {{ number_format($data->paytwo_reduction * 12) }}
                                        </td>
                                        <td>{{ $data->payone_percentage * 100 }}%</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td>
                                            {{ number_format($data->paytwo_reduction + 1) }}
                                            -
                                            {{ number_format($data->paythree_reduction) }}
                                        </td>
                                        <td>
                                            {{ number_format(($data->paytwo_reduction + 1) * 12) }}
                                            -
                                            {{ number_format($data->paythree_reduction * 12) }}
                                        </td>
                                        <td>{{ $data->paytwo_percentage * 100 }}%</td>
                                        <td>{{ number_format($data->paytwo_addition) }}</td>
                                    </tr>

                                    <tr>
                                        <td>
                                            {{ number_format($data->paythree_reduction + 1) }}
                                            -
                                            {{ number_format($data->payfour_reduction) }}
                                        </td>
                                        <td>
                                            {{ number_format(($data->paythree_reduction + 1) * 12) }}
                                            -
                                            {{ number_format($data->payfour_reduction * 12) }}
                                        </td>
                                        <td>{{ $data->paythree_percentage * 100 }}%</td>
                                        <td>{{ number_format($data->paythree_addition) }}</td>
                                    </tr>

                                    <tr>
                                        <td>
                                            {{ number_format($data->payfour_reduction + 1) }}
                                            and above
                                        </td>
                                        <td>
                                            {{ number_format(($data->payfour_reduction + 1) * 12) }}
                                            and above
                                        </td>
                                        <td>{{ $data->payfour_percentage * 100 }}%</td>
                                        <td>{{ number_format($data->payfour_addition) }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <hr>

                            <h6 class="fw-bold">Additional Deductions</h6>

                            <p>
                                <strong>SSF:</strong>
                                20% of gross salary (10% employee, 10% employer).
                            </p>

                            <p>
                                <strong>SDL:</strong>
                                3.5% of total emoluments paid by employer.
                            </p>

                            <p>
                                <strong>WCF:</strong>
                                0.5% contribution by employer.
                            </p>

                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>

</div>

<!-- JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>



<script>
    function downloadPDF(){
    html2pdf().from(document.getElementById("result"))
              .save("salary_"+Date.now()+".pdf");
}

function shareWhatsApp(){
    const text = document.getElementById("result").innerText;
    const url = "https://api.whatsapp.com/send?text=" + encodeURIComponent(text);
    window.open(url, "_blank");
}

function openTaxModal(){
    new bootstrap.Modal(document.getElementById('taxModal')).show();
}
</script>