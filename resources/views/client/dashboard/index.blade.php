@extends('layouts.client')

@section('title','Dashboard')

@push('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/date-picker.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/photoswipe.css') }}">
@endpush

@push('page-styles')
<style>
    .fs-12{
        font-size: 12px !important
    }

    #copy-link:hover {
        cursor: pointer;
    }
    .ongoing-project table tbody tr td:first-child {
        padding-top: 0;
        padding-bottom: 0;
    }
    .table-content td {
        font-weight: 500;
        font-size: 12px;
        color:rgba(30, 47, 101, 0.8) !important
    }
    .text-gray {
        color: #545454;
    }
    .bg-light-skyblue {
        background-color: #DEEFFF;
    }
    .tab-pane .price {
        color: #24B550;
        border: 1px solid #24B550;
    }
    .text-green {
        color: #24B550;
    }
    .small-circle {
        border: 1px solid #DEEFFF;
        background-color: #DEEFFF;
        border-radius: 50%;
        width: 26px;
        height: 26px;
        padding: 4px 4px;
        font-size: 16px;
    }
    .social-icon .fa-twitter {
        color: #00BCEC;
    }
    .social-icon .fa-instagram {
        color: #EC00C5;
    }
    .social-icon .fa-facebook-f {
        color: #0037EC;
    }
    .social-icon .fa-pinterest {
        color: #AA2C18;
    }
    .red-circle {
        border: 1px solid #FF0000;
        background:  #FF0000;
        border-radius: 50%;
        width: 29px;
        height: 28px;
        color: #ffffff;
        margin-top: 6px !important;
    }
    .social-icon i {
        padding: 6px 6px;
    }
    .social-icon .red-circle {
        padding: 6px 6px;
    }

    .progress {
        height: .3rem;
        background-color: #cfd0d0;
    }
    .email {
        background-color: #b6facb;
    }
    .vl-1 {
        border-left: 6px solid #476D96;
        height: 9.64px;
        /* position: absolute; */
        /* left: 0px; */
        /* bottom: 0px; */
    }
    .vl-2 {
        border-left: 6px solid #476D96;
        height: 17.53px;
        /* position: absolute; */
        /* left: 20px; */
        /* bottom: 0px; */

    }
    .vl-3 {
        border-left: 6px solid #476D96;
        height: 33.97px;
        /* position: absolute; */
        /* left: 40px; */
        /* bottom: 0px; */
    }
    .vl-4 {
        border-left: 6px solid #476D96;
        height: 29.24px;
        /* position: absolute; */
        /* left: 60px; */
        /* bottom: 0px; */
    }
    .vl-5 {
        border-left: 6px solid #476D96;
        height: 17.53px;
        /* position: absolute; */
        /* left: 80px; */
        /* bottom: 0px; */
    }
    .vl-6 {
        border-left: 6px solid #476D96;
        height: 33.97px;
        /* position: absolute; */
        /* left: 100px; */
        /* bottom: 0px; */
    }
    .vl-7 {
        border-left: 6px solid #476D96;
        height: 29.24px;
        /* position: absolute; */
        /* left: 120px; */
        /* bottom: 0px; */
    }
    .vl-8 {
        border-left: 6px solid #476D96;
        height: 17.53px;
        /* position: absolute; */
        /* left: 140px; */
        /* bottom: 0px; */
    }
    .vl-9 {
        border-left: 6px solid #476D96;
        height: 23.38px;
        /* position: absolute; */
        left: 160px;
        bottom: 0px;
    }
    .vl-10 {
        border-left: 6px solid #476D96;
        height: 34.51px;
        /* position: absolute; */
        /* left: 180px; */
        /* bottom: 0px; */
    }
    .vl-11 {
        border-left: 6px solid #476D96;
        height: 44.23px;
        /* position: absolute; */
        /* left: 200px; */
        /* bottom: 0px; */
    }
    .vl-12 {
        border-left: 6px solid #476D96;
        height: 46.99px;
        /* position: absolute; */
        /* left: 220px; */
        /* bottom: 0px; */
    }
    .text-blue {
        color: #0275D8;
    }
    .border-blue {
        border:1px solid #0275D8 !important;
    }
</style>
@endpush

@section('body')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Services</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a class="home-item" href="{{ route('admin.dashboard.index') }}"><i
                                data-feather="home"></i></a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid default-dash pb-5">

    <div class="row mb-md-5 mb-4">

        <!-- ----- Support card------ -->
        <div class="col-xxl-4 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card py-0 h-100 shadow">
                <div class="card-header border-bottom pb-3">
                    <p class="fs-6 text-dark">Support</p>
                    <p class="mb-0 text-muted">Let us know</p>
                </div>
                <div class="card-body d-flex flex-column justify-content-around pt-3 px-4">
                    <span class="text-dark">Questions or Comments?</span>
                    <div class="d-flex justify-content-between mt-3">
                        @php
                            $admin = App\Models\Admin::first();
                        @endphp
                        <span class="text-dark">Call:</span>
                        <span class="bg-light-skyblue py-1 px-3 rounded-pill text-blue">{{ $admin->phone_number }}</span>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <span class="text-dark">Email:</span>
                        <span class="email py-1 px-3 rounded-pill text-green">{{ $admin->email }}</span>
                    </div>
                    <div class="d-flex justify-content-evenly mt-3">
                        <a href="{{ route('support.index') }}" class="btn btn-primary px-5">Support</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- ----- properties card------ -->
        <div class="col-xxl-4 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mt-md-0 mt-4">
            <div class="card pt-3 shadow h-100">
                <div class="card-body p-0">
                    <p class="px-3 mb-2 fs-6 text-dark">Properties</p>
                    @php
                        $totalProperties = \App\Models\Property::whereUserId($activeUser->id)->count();
                        $recentProperties = \App\Models\Property::whereUserId($activeUser->id)->latest()->take(2)->get();
                    @endphp
                    <p class="px-3 mb-0 text-muted">Total: {{$totalProperties}}</p>
                    <hr class="my-2">
                    <p class="px-3 mb-1 text-gray">Recently Added</p>
                    @forelse ($recentProperties as $property)
                        <div class="d-flex">
                            <p class="px-3 mb-2 w-75 text-dark">{{ $property->address }}</p>
                            <i class="icofont icofont-rounded-right mt-1 text-center f-22 text-primary ms-4 ps-2"></i>
                        </div>
                    @empty
                        <div class="text-center">
                            <p class="px-3 my-3 fs-6 text-dark">No properties yet</p>
                        </div>
                    @endforelse

                    <div class="text-center mt-2">
                        <a href="{{ route("properties.index",'lawn-mowing') }}" class="btn btn-primary my-2">Lawn Mowing</a>
                        <a href="{{ route("properties.index",'snow-plowing') }}" class="btn btn-primary my-2">Snow Plowing</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- ----- Recurrring card------ -->
        <div class="col-xxl-4 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mt-xxl-0 mt-4 mx-auto">
            <div class="card py-3 shadow h-100">
                <div class="card-body p-0">
                    @php
                        $totalRecurringJobs = \App\Models\RecurringHistory::whereUserId($activeUser->id)->whereStatus('Active')->count();
                        $recurringJobs = \App\Models\RecurringHistory::whereUserId($activeUser->id)->whereStatus('Active')->latest()->take(2)->get();
                    @endphp
                    <p class="px-3 fs-6 text-dark mb-2">Recurring jobs</p>
                    <p class="px-3 mb-0 text-muted">Total: {{ $totalRecurringJobs }}</p>
                    <p class="px-3 text-gray">Looks like you have jobs set up on a recurring schedule.</p>
                    <hr>
                    @forelse ($recurringJobs as $recurringJob)
                        <div class="d-flex">
                            <p class="px-3 mb-2 w-75 text-dark">Repeats every <span class="text-success">{{ $recurringJob->on_every }} days</span>, next order on <span class="text-success">{{ $recurringJob->date }}</span> for <span class="text-success">${{ $recurringJob->grand_total }}</span></p>
                            <i class="icofont icofont-rounded-right mt-1 text-center f-22 text-primary ms-4 ps-2"></i>
                        </div>
                    @empty
                        <p class="text-center mb-2 pt-3 fs-6 text-dark">No recurring jobs yet</p>
                    @endforelse
                    <div class="text-center mt-2">
                        <a href="{{ route("recurring-jobs.index") }}" class="btn btn-primary">View all</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-md-5 mb-4">

        <!-- ----- Upcoming-jobs card------ -->
        <div class="col-xxl-4 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card ongoing-project shadow h-100">
                <div class="card-header card-no-border pb-0">
                    <div class="media media-dashboard">
                        @php
                            $totalUpcomingJobs = \App\Models\Order::wherePaymentStatus(2)->whereStatus(1)->whereUserId($activeUser->id)->count();
                            $upcomingJobs = \App\Models\Order::wherePaymentStatus(2)->whereStatus(1)->whereUserId($activeUser->id)->latest()->take(5)->get();
                        @endphp
                        <div class="media-body">
                            <p class="mb-1 fs-6 text-dark">Upcoming Jobs</p>
                            <p class="mb-2 text-muted">Total: {{ $totalUpcomingJobs }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0 px-3 pb-3">
                    <div class="table-responsive custom-scrollbar">
                        <table class="table table-bordernone">
                            <thead class="border-0">
                                <tr>
                                    <th> <span>Service</span></th>
                                    <th> <span>Price</span></th>
                                    <th> <span>Date</span></th>
                                    <th> <span>Recurring status</span></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($upcomingJobs as $upcomingJob)
                                    <tr class="table-content">
                                        <td>{{ $upcomingJob->category->name }}</td>
                                        <td>${{ $upcomingJob->grand_total }}</td>
                                        <td>{{ $upcomingJob->date }}</td>
                                        <td>{{ $upcomingJob->service_type == 1 ? 'One time' : 'Every '.$upcomingJob->period->duration.' Days' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-center mt-4">
                            <a href="{{ route("job-history.jobs",'upcoming-jobs') }}" class="btn btn-primary">View all</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ----- Ongoing-jobs card------ -->
        <div class="col-xxl-4 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mt-md-0 mt-4">
            <div class="card ongoing-project shadow h-100">
                <div class="card-header card-no-border pb-0">
                    <div class="media media-dashboard">
                        @php
                            $totalOngoingJobs = \App\Models\Order::wherePaymentStatus(2)->whereStatus(2)->whereUserId($activeUser->id)->count();
                            $ongoingJobs = \App\Models\Order::wherePaymentStatus(2)->whereStatus(2)->whereUserId($activeUser->id)->latest()->take(5)->get();
                        @endphp
                        <div class="media-body">
                            <p class="mb-1 fs-6 text-dark">Ongoing Projects </p>
                            <p class="mb-2 text-muted">Total: {{ $totalOngoingJobs }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0 px-3 pb-3">
                    <div class="table-responsive custom-scrollbar">
                        <table class="table table-bordernone">
                            <thead class="border-0">
                                <tr>
                                    <th> <span>Service</span></th>
                                    <th> <span>Price</span></th>
                                    <th> <span>Date</span></th>
                                    <th> <span>Provider</span></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($ongoingJobs as $ongoingJob)
                                    <tr class="table-content">
                                        <td>{{ $ongoingJob->category->name }}</td>
                                        <td>${{ $ongoingJob->grand_total }}</td>
                                        <td>{{ $ongoingJob->date }}</td>
                                        @if($ongoingJob->provider)
                                     <td>{{ $ongoingJob->provider->first_name." ".$ongoingJob->provider->last_name }}</td>
                                     @endif()
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-center mt-4">
                            <a href="{{ route("job-history.jobs",'ongoing-jobs') }}" class="btn btn-primary">View all</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ----- Credits card------ -->
        <div class="col-xxl-4 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mt-xxl-0 mt-4 mx-auto">
            <div class="card shadow h-100">
                <div class="card-header border-bottom d-flex flex-column justify-content-around pb-0">
                        <p class="mb-1 fs-6 text-dark">M&P Wallet Credits</p>
                        <p class="mb-2">Current Balance: ${{ $activeUser->wallet->amount }}</p>
                </div>
                <div class="card-body py-2 px-0">
                    <div class="px-4">
                        <p class="text-green mb-2 pt-2">Have credits to redeem?</p>
                        <h4 class="fw-normal">Give ${{ floor(settings('referral_bonus')) }}, Get ${{ floor(settings('referral_bonus')) }}</h4>
                        <p>Refer a new friend and get bonus of upto ${{ floor(settings('referral_bonus')) }} inyour Mowing and Plowing Cash Wallet.</p>
                        <div>
                            <span>Your referral link: <span class="text-green fs-6 referral-link">{{ request()->getHost().$activeUser->referral_link }}</span> </span>
                            <a class="float-end"> <i class="far fa-copy" id="copy-link" data-clipboard-target=".referral-link"></i> </a>
                        </div>
                    </div>
                    <div class="d-flex my-3">
                        <hr width="40%">
                        <div class="text-blue ms-2">
                            <i class="fa fa-share-alt small-circle" aria-hidden="true"></i>
                        </div>
                        <span class="pt-1 mx-2">Share</span>
                        <hr width="40%">
                    </div>
                    <div class="social-icon px-5">
                        <div class="d-flex justify-content-center" style="">
                            <i class="fab fa-twitter fa-2x"></i>
                            <i class="fab fa-instagram fa-2x"></i>
                            <i class="fab fa-facebook-f fa-2x"></i>
                            <i class="fab fa-pinterest fa-2x"></i>
                            <i class="fab fa-youtube red-circle ms-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <!-- ----- Billing card------ -->
        <div class="col-xxl-4 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card shadow ongoing-project h-100">
                <div class="card-body px-0">
                    @php
                        $upcomingInvoices = App\Models\RecurringHistory::whereUserId($activeUser->id)->whereStatus('Active')->latest()->take(2)->get();
                    @endphp
                    <span class="ps-4 fs-6 mb-2 text-dark">Billings </span><span class="fs-12">(Upcoming Invoices)</span>
                    <p class="ps-4 mt-2">Upcoming invoices due to recurring job. Invoice will be generated 1 day before the scheduled job date.</p>
                    <div class="card-body pt-0 px-3 pb-3">
                        <div class="table-responsive custom-scrollbar">
                            <table class="table table-bordernone">
                                <thead class="border-0">
                                    <tr>
                                        <th> <span>Service</span></th>
                                        <th> <span>Price</span></th>
                                        <th> <span>Invoice Date</span></th>
                                        <th> <span>Occurs every</span></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($upcomingInvoices as $upcomingInvoice)
                                        <tr class="table-content">
                                            <td>{{ $upcomingInvoice->category->name }}</td>
                                            <td>${{ $upcomingInvoice->grand_total }}</td>
                                            <td>{{ Carbon\Carbon::parse($upcomingInvoice->date)->subDays(1)->format('m/d/Y') }}</td>
                                            <td>{{ $upcomingInvoice->on_every}} days</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="text-center mt-4">
                                <a href="{{ route("recurring-jobs.index") }}" class="btn btn-primary">View All</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ----- Total transaction card------ -->
        <div class="col-xxl-4 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mt-md-0 mt-4">
            <div class="card total-transactions shadow h-100">
                <div class="row m-0">
                    <div class="col-md-12 col-sm-12 p-0">
                        <div class="card-header border-bottom pb-4">
                            <div class="d-flex justify-content-between">
                                <div>
                                <p class="fs-6 mb-3 mt-1 text-dark">Total Transactions</p>
                                <p class="mb-0">History</p>
                                </div>
                                {{-- <div class="dropdown">
                                    <button class="btn dropdown-toggle border border-blue text-blue bg-white rounded-pill " type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                        This Month
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                                        <li><a class="dropdown-item active" href="#">Action</a></li>
                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="#">Separated link</a></li>
                                    </ul>
                                </div> --}}
                            </div>
                        </div>

                        <div class="card-body pt-0 d-fle flex-colum justify-content-aroun h-10">
                            <!-- ------- weekly-chart ------- -->
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                    <div class="my-5 d-flex justify-content-around" style="position: relativ;">
                                        <div class="vl-1"></div>
                                        <div class="vl-2"></div>
                                        <div class="vl-3"></div>
                                        <div class="vl-4"></div>
                                        <div class="vl-5"></div>
                                        <div class="vl-6"></div>
                                        <div class="vl-7"></div>
                                        <div class="vl-8"></div>
                                        <div class="vl-9"></div>
                                        <div class="vl-10"></div>
                                        <div class="vl-11"></div>
                                        <div class="vl-12"></div>
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                            </div>

                            @php
                                $totalTransactions = App\Models\Transaction::whereType(1)->whereUserId($activeUser->id)->whereStatus(2)->count();
                                $totalExpenses = App\Models\Transaction::whereType(1)->whereUserId($activeUser->id)->whereStatus(2)->sum('amount');
                            @endphp
                            <div class="row">
                                <div class="col-6 report-main">
                                    <div class="report-content">
                                        <h5 class="fw-normal">${{ $totalExpenses }}</h5>
                                        <p class="font-theme-ligh">Expenses</p>
                                        <div class="progress progress-round-primary">
                                            <div class="progress-bar" role="progressbar" style="width: 100%; height:100%;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="report-content">
                                        <h5 class="fw-normal">{{ $totalTransactions }}</h5>
                                        <p class="font-theme-ligh">Transactions</p>
                                        <div class="progress progress-round-secondary">
                                            <div class="progress-bar" role="progressbar" style="width: 100%; height:100%;"
                                                aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ----- Support card------ -->
        <div class="col-xxl-4 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mt-xxl-0 mt-4 mx-auto">
            <div class="card py-0 h-100 shadow">
                <div class="card-header border-bottom pb-3">
                    <p class="fs-6 text-dark">Support</p>
                    <p class="mb-0 text-muted">Let us know</p>
                </div>
                <div class="card-body d-flex flex-column justify-content-around pt-3 px-4">
                    <span class="text-dark">Questions or Comments?</span>
                    <div class="d-flex justify-content-between mt-3">
                        @php
                            $admin = App\Models\Admin::first();
                        @endphp
                        <span class="text-dark">Call:</span>
                        <span class="bg-light-skyblue py-1 px-3 rounded-pill text-blue">{{ $admin->phone_number }}</span>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <span class="text-dark">Email:</span>
                        <span class="email py-1 px-3 rounded-pill text-green">{{ $admin->email }}</span>
                    </div>
                    <div class="d-flex justify-content-evenly mt-3">
                        <a href="{{ route('support.index') }}" class="btn btn-primary px-5">Support</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('vendor-scripts')
<script src="{{ asset('assets/js/chart/knob/knob.min.js') }}"></script>
<script src="{{ asset('assets/js/chart/knob/knob-chart.js') }}"></script>
<script src="{{ asset('assets/js/chart/apex-chart/apex-chart.js') }}"></script>
<script src="{{ asset('assets/js/chart/apex-chart/stock-prices.js') }}"></script>
<script src="{{ asset('assets/js/dashboard/default.js') }}"></script>
<script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js') }}"></script>
<script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>
<script src="{{ asset('assets/js/datepicker/date-picker/datepicker.custom.js') }}"></script>
<script src="{{ asset('assets/js/photoswipe/photoswipe.min.js') }}"></script>
<script src="{{ asset('assets/js/photoswipe/photoswipe-ui-default.min.js') }}"></script>
<script src="{{ asset('assets/js/photoswipe/photoswipe.js') }}"></script>
<script src="{{ asset('assets/js/typeahead/handlebars.js') }}"></script>
<script src="{{ asset('assets/js/typeahead/typeahead.bundle.js') }}"></script>
<script src="{{ asset('assets/js/typeahead/typeahead.custom.js') }}"></script>
<script src="{{ asset('assets/js/typeahead-search/handlebars.js') }}"></script>
<script src="{{ asset('assets/js/typeahead-search/typeahead-custom.js') }}"></script>
<script src="{{ asset('assets/js/height-equal.js') }}"></script>
<script src="https://cdn.jsdelivr.net/clipboard.js/1.5.12/clipboard.min.js"></script>
@endpush

@push('page-scripts')
    <script>
        new Clipboard('#copy-link');

        // const closeWindow = (category,type = null) => {
        //     if(window.opener){
        //         window.opener.postMessage({ category,type }, '*');
        //         window.close();
        //     }
        // };

        let redirectCategory = localStorage.getItem('redirectCategory')
        let redirectType = localStorage.getItem('redirectType')
        let address = localStorage.getItem('address')
        let lat = localStorage.getItem('lat')
        let lng = localStorage.getItem('lng')

        // Close window if there is any redirect category
        if(redirectCategory){
            document.body.innerHTML = "Redirecting.....";
            localStorage.removeItem('redirectCategory');
            localStorage.removeItem('redirectType');
            localStorage.removeItem('address');
            localStorage.removeItem('lat');
            localStorage.removeItem('lng');
            autoRedirect()
            // closeWindow(redirectCategory,redirectType)
        }

        function autoRedirect() {
            var form = document.createElement("form");
            var addressInput = document.createElement("input");
            var latInput = document.createElement("input");
            var lngInput = document.createElement("input");
            var csrfInput = document.createElement("input");

            form.method = "POST";
            form.action = redirectCategory == 'lawn-mowing' ? "{{ route('lawn-mowing.start-order') }}" : "{{ route('snow-plowing.address.post',['type'=>'_type_']) }}".replace('_type_',redirectType);

            addressInput.value=address;
            addressInput.name="address";
            form.appendChild(addressInput);

            latInput.value=lat;
            latInput.name="lat";
            form.appendChild(latInput);

            lngInput.value = lng;
            lngInput.name = "lng";
            form.appendChild(lngInput);

            csrfInput.value = "{{ csrf_token() }}";
            csrfInput.name = "_token";
            form.appendChild(csrfInput);

            form.style.display = "none";
            document.body.appendChild(form);

            form.submit();
        }
    </script>
@endpush
