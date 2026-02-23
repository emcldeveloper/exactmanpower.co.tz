@extends('website')

@section('title', 'Salary Calculator')
@section('page-title', 'Salary Calculator')

@section('content')

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

    .app-buttons img {
        height: 160px;
        margin-right: 10px;
    }

    .carousel-item img {
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    /* Ensure equal alignment */
    .salary-section .row {
        align-items: flex-start;
        /* Important Fix */
    }

    .custom-carousel-icon {
        background-color: rgba(0, 0, 0, 0.6);
        border-radius: 50%;
        padding: 20px;
        background-size: 60% 60%;
    }


    /* Responsive spacing */
    @media (max-width: 991px) {
        .salary-section {
            padding: 50px 0;
        }

        .salary-title {
            font-size: 20px;
        }

        .app-buttons img {
            height: 130px;
            margin-bottom: 10px;
        }
    }
</style>

<div class="salary-section bg-lighty">
    <div class="container">
        <div class="row">

            {{-- LEFT CONTENT --}}
            <div class="col-lg-6 mb-5 mb-lg-0">
                {{-- <h5 class="salary-title mb-4">
                    ExactEHRM
                </h5> --}}
                {{-- Livewire Component --}}
                @livewire('Website.tax.salary-calculator', ['user' => ""])

            </div>
            <div class="col-lg-1"> </div>

            {{-- RIGHT IMAGE SLIDER --}}
            <div class="col-lg-5">

                <div id="salaryCarousel" class="carousel slide" data-ride="carousel">

                    <div class="carousel-inner">

                        <div class="carousel-item active">
                            <img class="d-block w-100" src="{{ asset('img/calculator/home.jpeg') }}"
                                alt="Salary App">
                        </div>

                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('img/calculator/ehrm.jpeg') }}"
                                alt="Salary App">
                        </div>
                         <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('img/calculator/calculator.jpeg') }}"
                                alt="Salary App">
                        </div>

                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('img/calculator/payroll.jpeg') }}"
                                alt="Salary App">
                        </div>
                            <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('img/calculator/end.jpeg') }}"
                                alt="Salary App">
                        </div>
                    </div>

                    {{-- Controls --}}
                    <a class="carousel-control-prev" href="#salaryCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon custom-carousel-icon"></span>
                    </a>

                    <a class="carousel-control-next" href="#salaryCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon custom-carousel-icon"></span>
                    </a>
                    <div class="app-buttons ">
                        <p class="salary-description ">
                            ExactEHRM: Simple Payroll Today. Full HR Tomorrow.
                            Available on the App Store & Google Play.
                        </p>

                        <a href="https://play.google.com/store/apps/details?id=com.exactmanpower.emsalarycalculator"
                            target="_blank">
                            <img src="{{ asset('img/calculator/playstore.png') }}" alt="Play Store">
                        </a>

                        <a href="https://apps.apple.com/tz/app/exactehrm/id6755229808" target="_blank">
                            <img src="{{ asset('img/calculator/appstore.png') }}" alt="App Store">
                        </a>
                    </div>
                </div>
                {{-- <div class="app-buttons mt-1">
                    <p class="salary-description ">
                        Experience seamless salary calculations — available on the App Store and Google Play.
                    </p>

                    <a href="https://play.google.com/store/apps/details?id=com.exactmanpower.emsalarycalculator"
                        target="_blank">
                        <img src="{{ asset('img/calculator/playstore.png') }}" alt="Play Store">
                    </a>

                    <a href="https://apps.apple.com/tz/app/exactehrm/id6755229808" target="_blank">
                        <img src="{{ asset('img/calculator/appstore.png') }}" alt="App Store">
                    </a>
                </div> --}}

            </div>

        </div>
    </div>
</div>

@include('components.bridging-process')
@include('components.clients')

@endsection