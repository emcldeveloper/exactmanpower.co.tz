@extends('admin')

@section('title', 'Dashboard')

@section('content')

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="main-container-middle">
    <div class="container-header" style="overflow:visible;">
        <div class="d-flex align-items-center justify-content-between p-3">
            <span class="h5 m-0">
                <i class="bi bi-graph-up-arrow text-primary me-2"></i>
                Salary Analytics Dashboard
            </span>
            <div class="text-muted small">
                <i class="bi bi-clock-history me-1"></i>
                Last updated: {{ now()->format('d M Y H:i') }}
            </div>
        </div>
    </div>

    <div class="container-detail">
        <div class="p-4" style="max-width: 1400px; margin: 0 auto;">

            {{-- ========================= --}}
            {{-- DATE FILTER + PRESETS --}}
            {{-- ========================= --}}
            <form method="GET" class="mb-3 p-4 bg-white rounded-4 shadow-sm border-0">
                <div class="row g-4 align-items-end">
                    <div class="col-md-5">
                        <label class="form-label fw-semibold text-muted small text-uppercase mb-2">
                            <i class="bi bi-calendar-start me-1"></i>From Date
                        </label>
                        <input type="date" name="start_date" value="{{ $start }}"
                            class="form-control form-control-lg rounded-3 border-0 bg-light">
                    </div>

                    <div class="col-md-5">
                        <label class="form-label fw-semibold text-muted small text-uppercase mb-2">
                            <i class="bi bi-calendar-end me-1"></i>To Date
                        </label>
                        <input type="date" name="end_date" value="{{ $end }}"
                            class="form-control form-control-lg rounded-3 border-0 bg-light">
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-primary btn-lg w-100 rounded-3 shadow-sm">
                            <i class="bi bi-funnel me-2"></i>Apply Filter
                        </button>
                    </div>
                </div>

                {{-- Quick presets --}}
                {{-- <div class="mt-3 d-flex flex-wrap gap-2">
                    <span class="text-muted small me-2">Quick ranges:</span>

                    <a href="{{ route('admin.calculator.index', ['preset' => 'last7']) }}"
                        class="btn btn-sm {{ ($preset ?? '') === 'last7' ? 'btn-primary' : 'btn-outline-secondary' }}">
                        Last 7 days
                    </a>

                    <a href="{{ route('admin.calculator.index', ['preset' => 'last30']) }}"
                        class="btn btn-sm {{ ($preset ?? '') === 'last30' ? 'btn-primary' : 'btn-outline-secondary' }}">
                        Last 30 days
                    </a>

                    <a href="{{ route('admin.calculator.index', ['preset' => 'last90']) }}"
                        class="btn btn-sm {{ ($preset ?? '') === 'last90' ? 'btn-primary' : 'btn-outline-secondary' }}">
                        Last 90 days
                    </a>

                    <a href="{{ route('admin.calculator.index', ['preset' => 'ytd']) }}"
                        class="btn btn-sm {{ ($preset ?? '') === 'ytd' ? 'btn-primary' : 'btn-outline-secondary' }}">
                        Year to date
                    </a>
                </div> --}}
            </form>

            {{-- ========================= --}}
            {{-- SUMMARY CARDS --}}
            {{-- ========================= --}}
            <div class="row g-4 mb-5">

                {{-- Total Uses --}}
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="bg-primary bg-gradient bg-opacity-10 p-3 rounded-3">
                                        <i class="bi bi-calculator-fill fs-1 text-primary"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <span class="text-muted small text-uppercase fw-semibold">
                                        <i class="bi bi-arrow-up-short me-1"></i>Total Calculator Uses
                                    </span>
                                    <h2 class="fw-bold mb-0 display-6">
                                        {{ number_format($total_uses) }}
                                    </h2>
                                    <small class="text-success">
                                        <i class="bi bi-graph-up me-1"></i>
                                        Analytics based on filtered period
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Most Used Salary Type --}}
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="bg-warning bg-gradient bg-opacity-10 p-3 rounded-3">
                                        <i class="bi bi-cash-stack fs-1 text-warning"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <span class="text-muted small text-uppercase fw-semibold">
                                        <i class="bi bi-star-fill me-1 text-warning"></i>Most Popular Type
                                    </span>
                                    @php
                                    $topType = $salary_type_usage->sortByDesc('total')->first();
                                    @endphp
                                    <h3 class="fw-bold mb-0">
                                        {{ $topType->salary_type ?? 'N/A' }}
                                    </h3>
                                    <small class="text-muted">
                                        <i class="bi bi-people me-1"></i>
                                        {{ number_format($topType->total ?? 0) }} uses
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Most Used Currency --}}
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="bg-success bg-gradient bg-opacity-10 p-3 rounded-3">
                                        <i class="bi bi-currency-exchange fs-1 text-success"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <span class="text-muted small text-uppercase fw-semibold">
                                        <i class="bi bi-globe2 me-1"></i>Top Currency
                                    </span>
                                    @php
                                    $topCurrency = $currency_usage->sortByDesc('total')->first();
                                    @endphp
                                    <h3 class="fw-bold mb-0">
                                        {{ $topCurrency->currency ?? 'N/A' }}
                                    </h3>
                                    <small class="text-muted">
                                        <i class="bi bi-bar-chart-line me-1"></i>
                                        {{ number_format($topCurrency->total ?? 0) }} calculations
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- ========================= --}}
            {{-- CHARTS --}}
            {{-- ========================= --}}
            <div class="row g-4">

                {{-- Usage Trend Chart --}}
                <div class="col-6 mb-4">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-header bg-transparent border-0 pt-4 px-4">
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                                <span class="fw-semibold fs-5">
                                    <i class="bi bi-calendar-check me-2 text-primary"></i>
                                    Usage Trend Analysis
                                </span>

                                <div class="btn-group bg-light rounded-3 p-1" role="group">
                                    <button type="button"
                                        class="btn btn-sm px-3 py-1 rounded-3 border-0 trend-btn active"
                                        data-period="daily">
                                        <i class="bi bi-sun me-1"></i>Daily
                                    </button>
                                    <button type="button" class="btn btn-sm px-3 py-1 rounded-3 border-0 trend-btn"
                                        data-period="weekly">
                                        <i class="bi bi-calendar-week me-1"></i>Weekly
                                    </button>
                                    <button type="button" class="btn btn-sm px-3 py-1 rounded-3 border-0 trend-btn"
                                        data-period="monthly">
                                        <i class="bi bi-calendar-month me-1"></i>Monthly
                                    </button>
                                    <button type="button" class="btn btn-sm px-3 py-1 rounded-3 border-0 trend-btn"
                                        data-period="yearly">
                                        <i class="bi bi-calendar-year me-1"></i>Yearly
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-4 pb-4" style="height: 280px;">
                            <canvas id="trendChart"></canvas>
                        </div>
                    </div>
                </div>

                {{-- Salary Type Pie --}}
                <div class="col-md-6 pe-md-3">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-header bg-transparent border-0 pt-4 px-4">
                            <span class="fw-semibold fs-5">
                                <i class="bi bi-pie-chart-fill me-2 text-warning"></i>
                                Salary Type Distribution
                            </span>
                        </div>
                        <div class="card-body px-4 pb-4" style="height: 260px;">
                            <canvas id="salaryTypeChart"></canvas>
                        </div>
                    </div>
                </div>

                {{-- Currency Bar --}}
                <div class="col-md-6 ps-md-3">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-header bg-transparent border-0 pt-4 px-4">
                            <span class="fw-semibold fs-5">
                                <i class="bi bi-bar-chart-fill me-2 text-success"></i>
                                Currency Usage Breakdown
                            </span>
                        </div>
                        <div class="card-body px-4 pb-4" style="height: 260px;">
                            <canvas id="currencyChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-4">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-header bg-transparent border-0 pt-4 px-4">
                            <span class="fw-semibold fs-5">
                                <i class="bi bi-phone-fill me-2 text-info"></i>
                                OS Usage Distribution
                            </span>
                        </div>
                        <div class="card-body px-4 pb-4" style="height: 260px;">
                            <canvas id="osChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-4">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-header bg-transparent border-0 pt-4 px-4">
                            <span class="fw-semibold fs-5">
                                <i class="bi bi-browser-chrome me-2 text-danger"></i>
                                Browser Usage Distribution
                            </span>
                        </div>
                        <div class="card-body px-4 pb-4" style="height: 260px;">
                            <canvas id="browserChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-4">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-header bg-transparent border-0 pt-4 px-4">
                            <span class="fw-semibold fs-5">
                                <i class="bi bi-tablet-landscape me-2 text-success"></i>
                                Device Usage Insights
                            </span>
                        </div>
                        <div class="card-body px-4 pb-4" style="height: 260px;">
                            <canvas id="deviceChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-4">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-header bg-transparent border-0 pt-4 px-4">
                            <span class="fw-semibold fs-5">
                                <i class="bi bi-globe-americas me-2 text-primary"></i>
                                Country Usage Distribution
                            </span>
                        </div>
                        <div class="card-body px-4 pb-4" style="height:260px;">
                            <canvas id="countryChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-4">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-header bg-transparent border-0 pt-4 px-4">
                            <span class="fw-semibold fs-5">
                                <i class="bi bi-geo-alt-fill me-2 text-danger"></i>
                                City Usage Distribution
                            </span>
                        </div>
                        <div class="card-body px-4 pb-4" style="height:260px;">
                            <canvas id="cityChart"></canvas>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Footer Info --}}
            <div class="row mt-5">
                <div class="col-12">
                    <div class="bg-light rounded-4 p-3 text-center text-muted small">
                        <i class="bi bi-info-circle me-2"></i>
                        Showing analytics from <strong>{{ $start }}</strong> to <strong>{{ $end }}</strong>
                        <span class="mx-2">|</span>
                        <i class="bi bi-bar-chart me-1"></i>
                        <span id="activePeriod">Daily</span> view active
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- ========================= --}}
{{-- CHART JS --}}
{{-- ========================= --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

const monthNamesShort = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
const monthNamesFull  = ['January','February','March','April','May','June','July','August','September','October','November','December'];


// ================= RAW DATA =================
const rawDailyLabels  = @json($usage_per_day->pluck('date'));
const rawDailyData    = @json($usage_per_day->pluck('total'));

const rawWeeklyLabels = @json($usage_per_week->pluck('label'));
const rawWeeklyData   = @json($usage_per_week->pluck('total'));

const rawMonthlyLabels = @json($usage_per_month->pluck('label'));
const rawMonthlyData   = @json($usage_per_month->pluck('total'));

const rawYearlyLabels = @json($usage_per_year->pluck('year'));
const rawYearlyData   = @json($usage_per_year->pluck('total'));


// ================= DAILY MULTI MONTH =================
let dailyLabels = [];
let dailyData = [];

let monthGroups = {};

rawDailyLabels.forEach((date,i)=>{

    const d = new Date(date);

    const year = d.getFullYear();
    const month = d.getMonth();

    const key = year+'-'+month;

    if(!monthGroups[key]){

        monthGroups[key] = {
            year:year,
            month:month,
            values:[]
        };

    }

    monthGroups[key].values.push({
        day:d.getDate(),
        value:rawDailyData[i]
    });

});


Object.values(monthGroups).forEach(group=>{

    const daysInMonth = new Date(group.year, group.month+1, 0).getDate();

    for(let d=1; d<=daysInMonth; d++){

        dailyLabels.push(monthNamesShort[group.month]+' '+d);

        const found = group.values.find(item=>item.day===d);

        dailyData.push(found ? found.value : 0);

    }

});


// ================= WEEKLY =================
let weeklyLabels = [];
let weeklyData = [];

rawWeeklyData.forEach((value,i)=>{

    weeklyLabels.push(i+1);
    weeklyData.push(value);

});


// ================= MONTHLY =================
let monthlyLabels = monthNamesShort;
let monthlyData = new Array(12).fill(0);

rawMonthlyLabels.forEach((m,i)=>{

    let monthIndex;

    if(/^\d{4}-\d{2}/.test(m)){

        monthIndex = parseInt(m.split('-')[1]) - 1;

    }else{

        monthIndex = parseInt(m) - 1;

    }

    if(monthIndex>=0 && monthIndex<12){

        monthlyData[monthIndex] = rawMonthlyData[i];

    }

});


// ================= YEARLY =================
const now = new Date();
const currentYear = now.getFullYear();

let yearlyLabels = [];
let yearlyData = [];

const allowedYears = [currentYear-2,currentYear-1,currentYear];

rawYearlyLabels.forEach((y,i)=>{

    if(allowedYears.includes(parseInt(y))){

        yearlyLabels.push(y);
        yearlyData.push(rawYearlyData[i]);

    }

});


// ================= TREND DATA =================
const trendData = {

    daily:{
        labels:dailyLabels,
        data:dailyData,
        xTitle:'Days'
    },

    weekly:{
        labels:weeklyLabels,
        data:weeklyData,
        xTitle:'Weeks'
    },

    monthly:{
        labels:monthlyLabels,
        data:monthlyData,
        xTitle:currentYear
    },

    yearly:{
        labels:yearlyLabels,
        data:yearlyData,
        xTitle:'Years'
    }

};


// ================= TREND CHART =================
const trendCtx = document.getElementById('trendChart').getContext('2d');

let trendChart = new Chart(trendCtx,{

type:'bar',

data:{
labels:trendData.daily.labels,
datasets:[{
label:'Usage Count',
data:trendData.daily.data,
backgroundColor:'rgba(211,99,20,0.7)',
borderColor:'#D36314',
borderWidth:1,
borderRadius:6,
barPercentage:0.4,
categoryPercentage:0.7,
maxBarThickness:18
}]
},

options:{
responsive:true,
maintainAspectRatio:false,

plugins:{
legend:{display:false},
tooltip:{
backgroundColor:'#1a1a1a',
callbacks:{
label:function(context){
return ' Usage: '+context.raw.toLocaleString();
}
}
}
},

scales:{
y:{
beginAtZero:true,
grid:{color:'rgba(0,0,0,0.03)'},
ticks:{stepSize:1}
},

x:{
grid:{display:false},
title:{
display:true,
text:trendData.daily.xTitle
}
}
}

}

});


// ================= PERIOD SWITCH =================
function applyTrendStyle(period){

trendChart.data.labels = trendData[period].labels;
trendChart.data.datasets[0].data = trendData[period].data;
trendChart.options.scales.x.title.text = trendData[period].xTitle;

if(period === 'daily' || period === 'weekly'){

trendChart.config.type = 'bar';

trendChart.data.datasets[0].backgroundColor='rgba(211,99,20,0.7)';
trendChart.data.datasets[0].borderWidth=1;

}else{

trendChart.config.type='line';

trendChart.data.datasets[0].backgroundColor='rgba(211,99,20,0.08)';
trendChart.data.datasets[0].borderColor='#D36314';
trendChart.data.datasets[0].borderWidth=3;
trendChart.data.datasets[0].fill=true;
trendChart.data.datasets[0].tension=0.4;
trendChart.data.datasets[0].pointRadius=4;

}

trendChart.update();

document.getElementById('activePeriod').textContent =
period.charAt(0).toUpperCase()+period.slice(1);

}


document.querySelectorAll('.trend-btn').forEach(btn=>{

btn.addEventListener('click',function(){

document.querySelectorAll('.trend-btn').forEach(b=>{
b.classList.remove('active','btn-primary');
});

this.classList.add('active','btn-primary');

const period=this.dataset.period;

applyTrendStyle(period);

});

});


// ================= SALARY TYPE PIE =================
new Chart(document.getElementById('salaryTypeChart'),{
type:'pie',
data:{
labels:@json($salary_type_usage->pluck('salary_type')),
datasets:[{
data:@json($salary_type_usage->pluck('total')),
backgroundColor:['#D36314','#0d6efd','#198754','#ffc107','#dc3545'],
borderWidth:0,
hoverOffset:8
}]
},
options:{responsive:true,maintainAspectRatio:false}
});


// ================= CURRENCY BAR =================
new Chart(document.getElementById('currencyChart'),{
type:'bar',
data:{
labels:@json($currency_usage->pluck('currency')),
datasets:[{
data:@json($currency_usage->pluck('total')),
backgroundColor:['#198754','#ffc107','#0d6efd','#D36314','#dc3545'],
borderRadius:8
}]
},
options:{responsive:true,maintainAspectRatio:false}
});


// ================= OS =================
new Chart(document.getElementById('osChart'),{
type:'pie',
data:{
labels:@json($os_usage->pluck('os')),
datasets:[{
data:@json($os_usage->pluck('total')),
backgroundColor:['#0d6efd','#198754','#dc3545','#ffc107','#6f42c1']
}]
},
options:{responsive:true,maintainAspectRatio:false}
});


// ================= COUNTRY =================
new Chart(document.getElementById('countryChart'),{
type:'doughnut',
data:{
labels:@json($country_usage->pluck('country')),
datasets:[{
data:@json($country_usage->pluck('total')),
backgroundColor:['#0d6efd','#198754','#ffc107','#dc3545','#6610f2','#fd7e14']
}]
},
options:{responsive:true,maintainAspectRatio:false}
});


// ================= CITY =================
new Chart(document.getElementById('cityChart'),{
type:'bar',
data:{
labels:@json($city_usage->pluck('city')),
datasets:[{
data:@json($city_usage->pluck('total')),
backgroundColor:'#D36314'
}]
},
options:{responsive:true,maintainAspectRatio:false}
});


// ================= BROWSER =================
new Chart(document.getElementById('browserChart'),{
type:'doughnut',
data:{
labels:@json($browser_usage->pluck('browser')),
datasets:[{
data:@json($browser_usage->pluck('total')),
backgroundColor:['#0dcaf0','#6610f2','#fd7e14','#20c997','#dc3545']
}]
},
options:{responsive:true,maintainAspectRatio:false}
});


// ================= DEVICE =================
new Chart(document.getElementById('deviceChart'),{
type:'bar',
data:{
labels:@json($device_usage->pluck('device')),
datasets:[{
data:@json($device_usage->pluck('total')),
backgroundColor:['#198754','#0d6efd','#D36314']
}]
},
options:{responsive:true,maintainAspectRatio:false}
});

});
</script>
<style>
    .card {
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 1rem 2rem rgba(0, 0, 0, .08) !important;
    }

    .trend-btn {
        background: transparent;
        color: #6c757d;
        transition: all 0.2s;
    }

    .trend-btn:hover {
        background: rgba(211, 99, 20, 0.1);
        color: #D36314;
    }

    .trend-btn.active {
        background: #D36314 !important;
        color: white !important;
    }

    .btn-group {
        background: #f8f9fa;
    }
</style>

@endsection