@extends('website')

@section('title', 'Salary Calculator')
@section('page-title', 'Salary Calculator')

@section('content')

@php
use App\Models\PayCalculator;
use App\Models\SalaryInsightLog;

$data = PayCalculator::first();
$usageTotal = SalaryInsightLog::count();
@endphp

<style>
    .salary-section {
        padding: 80px 0;
    }

    .salary-title {
        font-size: 38px;
        font-weight: 700;
    }

    .salary-description {
        font-size: 18px;
        color: #666;
    }

    .app-button-link img {
        height: 160px;
        margin-right: 10px;
    }

    .carousel-item img {
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    /* Ensure equal alignment */

    .salary-section .row {
        align-items: flex-start !important;
    }

    /* Reduce space between slider & button */
    .salaryCarousel {
        margin-bottom: 5px !important;
        /* adjust: 0px–10px */
    }

    /* Remove extra space around images */
    .salaryCarousel .carousel-item img {
        margin-bottom: 0 !important;
        padding-bottom: 0 !important;
        display: block;
    }

    /* Remove default spacing for app-button-link */
    .app-button-link {
        margin-top: 5px !important;
        /* SMALL GAP */
    }


    /* Responsive spacing */
    @media (max-width: 991px) {
        .salary-section {
            padding: 50px 0;
        }

        .salary-title {
            font-size: 20px;
        }

        .app-button-link img {
            height: 130px;
            // margin-bottom: 10px;
        }
    }

    /* Inner calculator styles */
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
      //  border-bottom: 1px dotted #000;
        padding: 6px 0;
    }

    .salary-calculator-wrapper .double-line {
       // border-top: 2px solid #000;
       border-bottom: 1px double #000;
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

<div class="salary-section bg-lighty">
    <div class="container">
        <div class="row">

            {{-- LEFT CONTENT --}}
            <div class="col-lg-6 mb-5 mb-lg-0">

                <div class="salary-calculator-wrapper py-3">
                    <div class="containersal">

                        <!-- HEADER -->
                        <div class="mb-4 d-flex align-items-center gap-3">
                            <img height="70" src="{{ url('/img/calculator/ExactEHRMLOGO.png') }}">
                            <h3 class="m-0" style="font-size: 28px;">
                                <span style="color:#D36314; font-weight:700;"> - Salary</span>
                                <span style="color:black; font-weight:900;">Calculator</span>
                            </h3>
                        </div>

                        <form onsubmit="return false;">

                            {{-- Currency --}}
                            <div class="form-row">
                                <label>Select Currency</label>
                                <select id="currencyType" name="currencyType">
                                    <option value="">Select</option>
                                    <option value="tz" selected>TZS</option>
                                    <option value="usd">USD</option>
                                </select>
                            </div>

                            <div class="form-row" id="exchangeRateRow" style="display:none;">
                                <label>Exchange Rate</label>
                                <input type="number" step="any" id="exchangeRate" name="exchangeRate"
                                    placeholder="e.g. 2600" onkeyup="runAjaxCalculation()">
                            </div>

                            {{-- Salary Type --}}
                            <div class="form-row">
                                <label>Salary Type</label>
                                <select id="salaryType" name="salaryType" onchange="onSalaryTypeChange()">
                                    <option value="">Select</option>
                                    <option value="net">Gross Salary (From Net)</option>
                                    <option value="gross">Net Salary (From Gross)</option>
                                </select>
                            </div>

                            {{-- Period --}}
                            <div class="form-row">
                                <label>Period</label>
                                <select id="period" name="period" onchange="runAjaxCalculation()">
                                    <option value="monthly" selected>Monthly</option>
                                    <option value="annual">Annual</option>
                                </select>
                            </div>

                            {{-- NET INPUT (shown if salaryType = net) --}}
                            <div class="form-row" id="net_row" style="display:none;">
                                <label>Net Salary</label>
                                <input type="text" id="net_pay" name="net_pay" placeholder="Enter net salary"
                                    onkeyup="validateNumberInput(this); runAjaxCalculation()">
                            </div>

                            {{-- GROSS INPUT (shown if salaryType = gross) --}}
                            <div class="form-row" id="basic_row" style="display:none;">
                                <label>Basic Salary</label>
                                <input type="text" id="basic_pay" name="basic_pay" placeholder="Enter basic salary"
                                    onkeyup="validateNumberInput(this);runAjaxCalculation()">
                            </div>

                            {{-- Allowances --}}
                            <div class="form-row">
                                <label></label>
                                <button type="button" id="addAllowance" class="btn-main w-60">
                                    + Add Allowance
                                </button>
                            </div>

                            <div id="allowances-wrapper"></div>

                        </form>

                        <hr>

                        @php
                        // Initial symbol & multiplier (JS will override)
                        $symbol = 'TZS';
                        @endphp
                        <!-- ERROR BOX -->
                        <div id="error_box" style="display:none; background:#ffe5e5; color:#b30000;
                                    border:1px solid #ffb3b3; padding:12px;
                                    margin-bottom:15px; border-radius:6px;
                                    font-weight:600;">
                        </div>
                        <!-- RESULTS -->
                        <div id="result">
                            <div id="download-section">
                                <div class="result-detail"> <strong id="summary_label"> Select salary type </strong>
                                    <span id="summary_value"> {{ $symbol }} 0.00 </span>
                                </div>
                                <div class="full-line"></div>
                                <!-- 1️⃣ EARNINGS -->
                                <h4 style="margin-top:10px; border-bottom:2px solid #ccc; padding-bottom:5px;">
                                    Earnings
                                </h4>

                                <div class="result-detail">
                                    <span>Basic Salary</span>
                                    <span id="basic_display">{{ $symbol }} 0.00</span>
                                </div>

                                <div class="result-detail">
                                    <span>Total Allowances</span>
                                    <span id="allowances_display">{{ $symbol }} 0.00</span>
                                </div>

                                <div class="full-line"></div>

                                <!-- 2️⃣ DEDUCTIONS -->
                                <h4 style="margin-top:20px; border-bottom:2px solid #ccc; padding-bottom:5px;">
                                    Deductions
                                </h4>

                                <div class="result-detail">
                                    <span>SSC (Employee)</span>
                                    <span id="ssc_display">{{ $symbol }} 0.00</span>
                                </div>

                                <div class="result-detail">
                                    <span>PAYE</span>
                                    <span id="paye_display">{{ $symbol }} 0.00</span>
                                </div>

                                <div class="full-line"></div>

                                <!-- 3️⃣ TOTAL DEDUCTIONS -->
                                <h4 style="margin-top:20px; border-bottom:2px solid #ccc; padding-bottom:5px;">
                                    Total Deductions
                                </h4>

                                <div class="result-detail">
                                    <strong>Total Deductions</strong>
                                    <strong id="total_deductions_display">{{ $symbol }} 0.00</strong>
                                </div>

                                <div class="full-line"></div>

                                <!-- 4️⃣ NET SALARY -->
                                <h4 style="margin-top:20px; border-bottom:3px solid #000; padding-bottom:5px;">
                                    Net Salary
                                </h4>

                                <div class="result-detail double-line">
                                    <strong>Net Salary</strong>
                                    <strong id="net_display">{{ $symbol }} 0.00</strong>
                                </div>

                            </div>

                            <!-- Toggle Company Cost -->
                            <button type="button" class="btn-main w-100 mt-3" id="toggleCompanyCostBtn">
                                Show Employer Cost ▼
                            </button>

                            <div class="mt-4" id="companyCostSection" style="display:none;">

                                <div class="result-detail full-line">
                                    <strong>TOTAL COST TO COMPANY</strong>
                                    <span>AMOUNT</span>
                                </div>

                                <div class="result-detail">
                                    <span>Gross Salary</span>
                                    <span id="gross_display">{{ $symbol }} 0.00</span>
                                </div>

                                <div class="result-detail">
                                    <span>Employer SSC (10%)</span>
                                    <span id="employer_ssc_display">{{ $symbol }} 0.00</span>
                                </div>

                                <div class="result-detail">
                                    <span>SDL (3.5%)</span>
                                    <span id="sdl_display">{{ $symbol }} 0.00</span>
                                </div>

                                <div class="result-detail">
                                    <span>WCF (0.5%)</span>
                                    <span id="wcf_display">{{ $symbol }} 0.00</span>
                                </div>

                                <div class="result-detail double-line">
                                    <strong>GRAND TOTAL</strong>
                                    <span id="grand_display">{{ $symbol }} 0.00</span>
                                </div>

                            </div>

                        </div>

                        <!-- View Counter -->
                        <div class="view-count">
                            <span>
                                <i class="fa fa-calculator" style="color: #D36314; font-size: 14px;"></i>
                            </span>
                            <span id="usage_display">
                                @if($usageTotal >= 1000000)
                                {{ number_format($usageTotal/1000000,1).'M' }}
                                @elseif($usageTotal >= 1000)
                                {{ number_format($usageTotal/1000,1).'K' }}
                                @else
                                {{ $usageTotal }}
                                @endif
                            </span>
                        </div>

                        <!-- Action Buttons -->

                        <div class="action-row">
                            <button type="button" onclick="openDownloadPopup()" class="btn-main">
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
                        @if($data)
                        <div class="modal fade" id="taxModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            Tanzania Tax Rates & Deductions
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

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
                                                    <td>{{ number_format($data->payone_reduction + 1) }} -
                                                        {{ number_format($data->paytwo_reduction) }}</td>
                                                    <td>{{ number_format(($data->payone_reduction + 1) * 12) }} -
                                                        {{ number_format($data->paytwo_reduction * 12) }}</td>
                                                    <td>{{ $data->payone_percentage * 100 }}%</td>
                                                    <td>0</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ number_format($data->paytwo_reduction + 1) }} -
                                                        {{ number_format($data->paythree_reduction) }}</td>
                                                    <td>{{ number_format(($data->paytwo_reduction + 1) * 12) }} -
                                                        {{ number_format($data->paythree_reduction * 12) }}</td>
                                                    <td>{{ $data->paytwo_percentage * 100 }}%</td>
                                                    <td>{{ number_format($data->paytwo_addition) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ number_format($data->paythree_reduction + 1) }} -
                                                        {{ number_format($data->payfour_reduction) }}</td>
                                                    <td>{{ number_format(($data->paythree_reduction + 1) * 12) }} -
                                                        {{ number_format($data->payfour_reduction * 12) }}</td>
                                                    <td>{{ $data->paythree_percentage * 100 }}%</td>
                                                    <td>{{ number_format($data->paythree_addition) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ number_format($data->payfour_reduction + 1) }} and above</td>
                                                    <td>{{ number_format(($data->payfour_reduction + 1) * 12) }} and
                                                        above</td>
                                                    <td>{{ $data->payfour_percentage * 100 }}%</td>
                                                    <td>{{ number_format($data->payfour_addition) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <hr>

                                        <h6 class="fw-bold">Additional Deductions</h6>
                                        <p><strong>SSC:</strong> 20% of gross salary (10% employee, 10% employer).</p>
                                        <p><strong>SDL:</strong> 3.5% of total emoluments paid by employer.</p>
                                        <p><strong>WCF:</strong> 0.5% contribution by employer.</p>

                                    </div>

                                </div>
                            </div>
                        </div>
                        @endif

                    </div>
                    <div id="salarySlip" style="display:none; background:white; padding:18px; font-family:Arial; font-size:13px;">

                    <!-- COMPANY LOGO + TITLE -->
                    <div style="text-align:center; margin-bottom:10px;">
                        <img id="slip_logo" src="{{ url('/img/calculator/ExactEHRMLOGO.png') }}" height="60">
                        <div style="font-size:18px; font-weight:800; color:#D36314; margin-top:6px;">Salary Slip</div>

                        <!-- HEADER SECTION -->
                <div style="margin-bottom:15px; width:100%; display:flex;">

                    <!-- LEFT: EMPLOYEE INFORMATION -->
                    <div style="width:60%; text-align:left; line-height:1.4;">
                        <div id="slip_name" 
                            style="font-size:14px; font-weight:700; margin-bottom:3px;">
                        </div>

                        <div id="slip_department" style="font-size:12px; color:#444;"></div>
                        <div id="slip_emp_number" style="font-size:12px; color:#444;"></div>
                        <div id="slip_phone" style="font-size:12px; color:#444;"></div>
                        <div id="slip_email" style="font-size:12px; color:#444;"></div>

                        <!-- NEW: PAY DATE -->
                        <div id="slip_pay_date" 
                            style="font-size:12px; color:#444; margin-top:4px;">
                        </div>
                    </div>

                    <!-- RIGHT: LOGO & TITLE -->
                    {{--  <div style="width:40%; text-align:center;">
                        <img id="slip_logo" 
                            src="{{ url('/img/calculator/ExactEHRMLOGO.png') }}" 
                            height="60">

                        <div style="font-size:17px; font-weight:800; color:#D36314; margin-top:5px;">
                            Salary Slip
                        </div>
                    </div>  --}}

                </div>

    </div>

    <!-- MAIN 4-COLUMN TABLE -->
    <table style="width:100%; border-collapse:collapse; margin-top:10px; font-size:13px;">
        <thead>
            <tr style="background:#f3f3f3; border-bottom:2px solid #ccc;">
                <th style="padding:6px; text-align:left;">Earning</th>
                <th style="padding:6px; text-align:right;">Amount</th>
                <th style="padding:6px; text-align:left;">Deduction</th>
                <th style="padding:6px; text-align:right;">Amount</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td style="padding:6px;">Basic Salary</td>
                <td style="padding:6px; text-align:right;" id="slip_basic">0.00</td>

                <td style="padding:6px;">SSC (Employee)</td>
                <td style="padding:6px; text-align:right;" id="slip_ssc">0.00</td>
            </tr>

            <tr>
                <td style="padding:6px;">Allowances</td>
                <td style="padding:6px; text-align:right;" id="slip_allowances">0.00</td>

                <td style="padding:6px;">PAYE</td>
                <td style="padding:6px; text-align:right;" id="slip_paye">0.00</td>
            </tr>

            <!-- Spacer row -->
            <tr><td colspan="4" style="padding:4px;"></td></tr>

            <!-- Totals -->
            <tr style="border-top:2px solid #000;">
                <td style="padding:6px; font-weight:bold;">Total Earnings</td>
                <td style="padding:6px; text-align:right; font-weight:bold;" id="slip_total_earnings">0.00</td>

                <td style="padding:6px; font-weight:bold;">Total Deductions</td>
                <td style="padding:6px; text-align:right; font-weight:bold;" id="slip_total_deductions">0.00</td>
            </tr>

            <!-- Net Salary -->
            <tr style="border-top:2px solid #000; border-bottom:3px double #000;">
                <td style="padding:6px; font-weight:bold; font-size:14px;">Net Salary</td>
                <td style="padding:6px; text-align:right; font-weight:bold; font-size:14px;" id="slip_net">0.00</td>

                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>

    <!-- SIGNATURE SECTION -->
    <table style="width:100%; margin-top:25px; font-size:12px;">
        <tr>
            <td style="padding:10px;">
                <strong>Employee Signature:</strong>
                <div style="border-bottom:1px solid #000; height:22px; width:90%;"></div>
            </td>
            <td style="padding:10px;">
                <strong>Employer Signature:</strong>
                <div style="border-bottom:1px solid #000; height:22px; width:90%;"></div>
            </td>
        </tr>
    </table>

    <!-- COMPANY ADDRESS -->
    {{--  <div id="slip_address"
         style="text-align:center; margin-top:12px; font-size:11px; color:#666;">
    </div>  --}}

    <!-- FOOTER -->
    <div style="margin-top:10px; text-align:center; font-size:11px; color:#777;">
        Powered by ExactEHRM — {{ date('Y') }}
    </div>

</div>
                </div>
                <!-- DOWNLOAD INFO MODAL -->
                <div class="modal fade" id="downloadInfoModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title">Enter Details for Salary Slip</h5>
                                <button class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">

                                <div class="mb-3">
                                    <label>First Name</label>
                                    <input type="text" id="pop_first_name" class="form-control"
                                        placeholder="Enter first name">
                                </div>

                                <div class="mb-3">
                                    <label>Last Name</label>
                                    <input type="text" id="pop_last_name" class="form-control"
                                        placeholder="Enter last name">
                                </div>
                                   <div class="mb-3">
                                    <label>Department Name</label>
                                    <input type="text" id="pop_department" class="form-control"
                                        placeholder="e.g. Finance, ICT, HR">
                                </div>

                                <div class="mb-3">
                                    <label>Employee Number</label>
                                    <input type="text" id="pop_emp_number" class="form-control"
                                        placeholder="e.g. EMP-2451">
                                </div>
                                <div class="mb-3">
                                <label>Pay Date</label>
                                <input type="date" id="pop_pay_date" class="form-control">
                            </div>

                                <div class="mb-3">
                                    <label>Company Logo (Optional)</label>
                                    <input type="file" id="pop_logo" accept="image/*" class="form-control">
                                    <small class="text-muted">If no logo is selected, ExactEHRM logo will be
                                        used.</small>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-primary" onclick="startPDFDownload()">
                                    Generate & Download PDF
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-1"></div>

            {{-- RIGHT IMAGE SLIDER --}}
            <div class="col-lg-5">

                <div id="salaryCarousel" class="carousel slide salaryCarousel" data-ride="carousel">

                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="{{ asset('img/calculator/fist_last.jpeg') }}"
                                alt="Salary App">
                        </div>

                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('img/calculator/FIST.jpeg') }}" alt="Salary App">
                        </div>

                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('img/calculator/calculator.jpeg') }}"
                                alt="Salary App">
                        </div>

                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('img/calculator/payroll.jpeg') }}"
                                alt="Salary App">
                        </div>

                        {{-- <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('img/calculator/fist_last.jpeg') }}"
                                alt="Salary App">
                        </div> --}}
                    </div>

                    <a class="carousel-control-prev" href="#salaryCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </a>

                    <a class="carousel-control-next" href="#salaryCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </a>

                </div>

                <div class="app-button-link  text-center">
                    <a href="https://play.google.com/store/apps/details?id=com.exactmanpower.emsalarycalculator"
                        target="_blank">
                        <img src="{{ asset('img/calculator/playstore.png') }}" alt="Play Store">
                    </a>

                    <a href="https://apps.apple.com/tz/app/exactehrm/id6755229808" target="_blank">
                        <img src="{{ asset('img/calculator/appstore.png') }}" alt="App Store">
                    </a>
                </div>


            </div>

        </div>
    </div>
</div>

@include('components.bridging-process')
@include('components.clients')

{{-- JS --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
 <script>
    // ==========================
    // Helpers
    // ==========================
    function formatMoney(num) {
        num = Number(num) || 0;
        return num.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    function getSymbol() {
        return $('#currencyType').val() === 'usd' ? '$' : 'TZS';
    }

    // ==========================
    // UI Handlers
    // ==========================
    function onSalaryTypeChange() {
        var type = $('#salaryType').val();

        // Clear inputs
        $('#basic_pay').val('');
        $('#net_pay').val('');
        $('#allowances-wrapper').html('');

        // Reset results
        clearResults();
        $('#error_box').hide();

        if (type === 'gross') {
            $('#basic_row').show();
            $('#net_row').hide();
        } else if (type === 'net') {
            $('#net_row').show();
            $('#basic_row').hide();
        } else {
            $('#basic_row').hide();
            $('#net_row').hide();
        }
    }

    function toggleExchangeRateRow() {
        var cur = $('#currencyType').val();
        if (cur === 'usd') {
            $('#exchangeRateRow').show();
        } else {
            $('#exchangeRateRow').hide();
            $('#exchangeRate').val('');
        }
    }

    function clearResults() {
        var symbol = getSymbol();
        $('#summary_label').text('Select salary type');
        $('#summary_value').text(symbol + ' 0.00');

        $('#basic_display').text(symbol + ' 0.00');
        $('#allowances_display').text(symbol + ' 0.00');
        $('#ssc_display').text(symbol + ' 0.00');
        $('#paye_display').text(symbol + ' 0.00');
        $('#total_deductions_display').text(symbol + ' 0.00');
        $('#net_display').text(symbol + ' 0.00');

        $('#gross_display').text(symbol + ' 0.00');
        $('#employer_ssc_display').text(symbol + ' 0.00');
        $('#sdl_display').text(symbol + ' 0.00');
        $('#wcf_display').text(symbol + ' 0.00');
        $('#grand_display').text(symbol + ' 0.00');
    }

    // ==========================
    // AJAX Calculation
    // ==========================
    let currentAjax = null; // to avoid multiple overlapping calls

    function runAjaxCalculation() {
        var salaryType = $('#salaryType').val();
        var period     = $('#period').val();
        var currency   = $('#currencyType').val();
        var exchange   = $('#exchangeRate').val();

        if (!salaryType) {
            clearResults();
            return;
        }

        var basic = $('#basic_pay').val();
        var net   = $('#net_pay').val();

        if (salaryType === 'gross' && (!basic || basic === '')) {
            clearResults();
            return;
        }
        if (salaryType === 'net' && (!net || net === '')) {
            clearResults();
            return;
        }

        var allowances = [];
        $('.allowance-input').each(function () {
            var v = $(this).val();
            if (v !== '') {
                allowances.push(v);
            }
        });

        // Abort previous request if still in flight
        if (currentAjax) {
            currentAjax.abort();
        }

        currentAjax = $.ajax({
            url: "{{ route('salary.calc') }}",
            type: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                salaryType: salaryType,
                basic_pay: basic,
                net_pay: net,
                allowances: allowances,
                period: period,
                currencyType: currency,
                exchangeRate: exchange
            },
            success: function (res) {
                currentAjax = null;

                if (res.error) {
                    $('#error_box')
                        .text(res.message)
                        .fadeIn();

                    clearResults();
                    $('#basic_pay').val('');
                    // $('#net_pay').val('');
                    return;
                }

                $('#error_box').hide();

                var symbol     = getSymbol();
                var multiplier = (period === 'annual') ? 12 : 1;

                var displayGross   = (res.total_gross    || 0) * multiplier;
                var displayNet     = (res.net_pay        || 0) * multiplier;
                var displayBasic   = (res.basic_pay      || 0) * multiplier;
                var displayAllow   = (res.total_allowance || 0) * multiplier;
                var displaySSC     = (res.ssc_employee   || 0) * multiplier;
                var displayPAYE    = (res.paye           || 0) * multiplier;
                var displayEmpSSC  = (res.employer_ssc   || 0) * multiplier;
                var displaySDL     = (res.sdl            || 0) * multiplier;
                var displayWCF     = (res.wcf            || 0) * multiplier;
                var displayGrand   = (res.grand_total    || 0) * multiplier;
                var totalDeductions = displaySSC + displayPAYE;

                // Summary label/value
                if (salaryType === 'net') {
                    $('#summary_label').text('Gross Salary');
                    $('#summary_value').text(symbol + ' ' + formatMoney(displayGross));
                } else {
                    $('#summary_label').text('Net Salary');
                    $('#summary_value').text(symbol + ' ' + formatMoney(displayNet));
                }

                // Earnings
                $('#basic_display').text(symbol + ' ' + formatMoney(displayBasic));
                $('#allowances_display').text(symbol + ' ' + formatMoney(displayAllow));

                // Deductions
                $('#ssc_display').text(symbol + ' ' + formatMoney(displaySSC));
                $('#paye_display').text(symbol + ' ' + formatMoney(displayPAYE));
                $('#total_deductions_display').text(symbol + ' ' + formatMoney(totalDeductions));

                // Net
                $('#net_display').text(symbol + ' ' + formatMoney(displayNet));

                // Company cost
                $('#gross_display').text(symbol + ' ' + formatMoney(displayGross));
                $('#employer_ssc_display').text(symbol + ' ' + formatMoney(displayEmpSSC));
                $('#sdl_display').text(symbol + ' ' + formatMoney(displaySDL));
                $('#wcf_display').text(symbol + ' ' + formatMoney(displayWCF));
                $('#grand_display').text(symbol + ' ' + formatMoney(displayGrand));

                // Usage counter (optional)
                if (typeof res.usage_count !== 'undefined') {
                    var c = res.usage_count;
                    var nice;
                    if (c >= 1000000) {
                        nice = (c / 1000000).toFixed(1) + 'M';
                    } else if (c >= 1000) {
                        nice = (c / 1000).toFixed(1) + 'K';
                    } else {
                        nice = c;
                    }
                    $('#usage_display').text(nice);
                }
            },
            error: function (xhr, status) {
                // Ignore abort errors (we aborted on purpose)
                if (status === 'abort') return;
                currentAjax = null;
                clearResults();
            }
        });
    }

    // ==========================
    // Allowances Rows
    // ==========================
    function addAllowanceRow() {
        var idx = $('.allowance-input').length;
        var row = `
            <div class="form-row allowance-row" data-index="${idx}">
                <label>Allowance ${idx + 1}</label>
                <div style="width:60%;display:flex;gap:6px;">
                    <input type="text"
                           class="allowance-input"
                           placeholder="Enter allowance"
                           onkeyup="validateNumberInput(this); runAjaxCalculation()">
                    <button type="button"
                            class="btn-main"
                            onclick="removeAllowanceRow(this)">
                        X
                    </button>
                </div>
            </div>
        `;
        $('#allowances-wrapper').append(row);
    }

    function removeAllowanceRow(btn) {
        $(btn).closest('.allowance-row').remove();
        runAjaxCalculation();
    }

    // ==========================
    // Salary Slip Download (Popup + PDF)
    // ==========================
    function openDownloadPopup() {
        const modalEl = document.getElementById('downloadInfoModal');
        if (!modalEl) return;
        const modal = new bootstrap.Modal(modalEl);
        modal.show();
    }

    function loadPopupLogo(callback) {
        let imgTag   = document.getElementById("slip_logo");
        let fileInput = document.getElementById("pop_logo");

        if (fileInput && fileInput.files && fileInput.files[0]) {
            let reader = new FileReader();
            reader.onload = function (e) {
                imgTag.src = e.target.result;
                callback();
            };
            reader.readAsDataURL(fileInput.files[0]);
        } else {
            // Default logo
            imgTag.src = "{{ url('/img/calculator/ExactEHRMLOGO.png') }}";
            callback();
        }
    }

            function startPDFDownload() {

            // Name
            let fn = $('#pop_first_name').val() || "";
            let ln = $('#pop_last_name').val() || "";
            $('#slip_name').text((fn || ln) ? (fn + ' ' + ln).trim() : "");

            // Department
            let dept = $('#pop_department').val() || "";
            $('#slip_department').text(dept ? "Department: " + dept : "");

            // Employee Number
            let emp = $('#pop_emp_number').val() || "";
            $('#slip_emp_number').text(emp ? "Employee No: " + emp : "");

            // Salary values
            $('#slip_basic').text($('#basic_display').text());
            $('#slip_allowances').text($('#allowances_display').text());
            $('#slip_ssc').text($('#ssc_display').text());
            $('#slip_paye').text($('#paye_display').text());
            $('#slip_net').text($('#net_display').text());
            $('#slip_total_deductions').text($('#total_deductions_display').text());
            let basic = parseFloat($('#basic_display').text().replace(/[^0-9.-]/g,'')) || 0;
            let allow = parseFloat($('#allowances_display').text().replace(/[^0-9.-]/g,'')) || 0;

            let totalEarnings = basic + allow;

            $('#slip_total_earnings').text(totalEarnings.toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }));

            $('#slip_pay_date').text("Pay Date: " + ($('#pop_pay_date').val() || ""));

            let period = $('#period').val();
            $('#slip_period').text(period === 'annual' ? "Annual Salary Slip" : "Monthly Salary Slip");

            loadPopupLogo(function () {
                $('#salarySlip').show();

                html2pdf(document.getElementById("salarySlip"), {
                    margin: 10,
                    filename: `SalarySlip_${new Date().getTime()}.pdf`,
                    image: { type: "jpeg", quality: 1 },
                    html2canvas: { scale: 2 },
                    jsPDF: { unit: "mm", format: "a4", orientation: "portrait" }
                }).then(() => {
                    $('#salarySlip').hide();
                    const modal = bootstrap.Modal.getInstance(document.getElementById('downloadInfoModal'));
                    modal.hide();
                });
            });
        }

    // (Legacy direct download function kept only if you still call downloadPDF() somewhere)
    function downloadPDF() {
        const element = document.getElementById("salarySlip");
        const fileName = `ExactHRM_SalarySlip_${new Date().getTime()}.pdf`;

        $('#salarySlip').show();

        html2pdf(element, {
            margin: 10,
            filename: fileName,
            image: { type: "jpeg", quality: 1 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: "mm", format: "a4", orientation: "portrait" }
        }).then(() => {
            $('#salarySlip').hide();
        });
    }

    // ==========================
    // Other Actions
    // ==========================
    function shareWhatsApp() {
        const text = document.getElementById("result").innerText;
        const url = "https://api.whatsapp.com/send?text=" + encodeURIComponent(text);
        window.open(url, "_blank");
    }

    function openTaxModal() {
        var modalEl = document.getElementById('taxModal');
        if (!modalEl) return;
        new bootstrap.Modal(modalEl).show();
    }

    // ==========================
    // Validation
    // ==========================
    function validateNumberInput(el) {
        let value = el.value;

        // Allow only digits & decimal point
        if (!/^[0-9]*\.?[0-9]*$/.test(value)) {
            $('#error_box')
                .text("Please enter numbers only. Text is not allowed.")
                .fadeIn();

            // Strip non-numeric characters
            el.value = value.replace(/[^0-9.]/g, '');

            clearResults();
            return false;
        }

        $('#error_box').hide();
        return true;
    }

    // ==========================
    // Document Ready
    // ==========================
    $(document).ready(function () {
        $('#currencyType').on('change', function () {
            toggleExchangeRateRow();
            runAjaxCalculation();
        });

        $('#addAllowance').on('click', function () {
            addAllowanceRow();
        });

        $('#toggleCompanyCostBtn').on('click', function () {
            var section = $('#companyCostSection');
            if (section.is(':visible')) {
                section.hide();
                $(this).text('Show Employer Cost ▼');
            } else {
                section.show();
                $(this).text('Hide Employer Cost ▲');
            }
        });

        toggleExchangeRateRow();
        clearResults();
    });
</script>
@endsection