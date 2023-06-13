@extends('layouts.admin')

@section('title', 'Dashboard')

@push('vendor-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/date-picker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/photoswipe.css') }}">
@endpush

@push('page-styles')
@endpush

@section('body')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h3>Dashboard</h3>
                </div>
                <div class="col-12 col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"> <a class="home-item" href="{{ route('admin.dashboard.index') }}"><i
                                    data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active"> Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid default-dash">
        <div class="row">
            
            <div class="col-xl-4 col-md-6 dash-31 dash-xl-50">
                <div class="card recent-activity">
                    <div class="card-header card-no-border">
                        <div class="media media-dashboard">
                            <div class="media-body">
                                <h5 class="mb-0">Recent orders</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="table-responsive custom-scrollbar">
                            <table class="table table-bordernone">
                                <tbody>
                                @if(count($orders)>0)
                                @foreach($orders as $recent_order)
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <div class="square-box me-2"><img class="img-fluid b-r-5"
                                                        src="{{ asset($recent_order->user->image) }}" alt="">
                                                </div>
                                                <div class="media-body"><a href="user-profile.html">
                                                        <h5>{{$recent_order->user->first_name}} added new Order</h5>
                                                    </a>
                                                  <p>Order id</p> <a href="{{ route('admin.order.view-detail', ['id' => $recent_order->id, 'status' => $recent_order->status]) }}"><p class="font-primary">{{$recent_order->order_id}}</p></a>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="badge font-theme-light"><h6>{{date("M jS, Y", strtotime($recent_order->date));}}</h6></span></td>
                                    </tr>
                                @endforeach()    
                                    @endif()
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
             <div class="col-xl-4 col-md-6 dash-35 dash-xl-50">
                <div class="card ongoing-project">
                    <div class="card-header card-no-border">
                        <div class="media media-dashboard">
                            <div class="media-body">
                                <h5 class="mb-0">New Users</h5>
                            </div>
                            {{-- <div class="icon-box onhover-dropdown"><i data-feather="more-horizontal"></i>
                                <div class="icon-box-show onhover-show-div">
                                    <ul>
                                        <li> <a>
                                                Done</a></li>
                                        <li> <a>
                                                Pending</a></li>
                                        <li> <a>
                                                Rejected</a></li>
                                        <li> <a>In Progress</a></li>
                                    </ul>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="table-responsive custom-scrollbar">
                            <table class="table table-bordernone">
                                <thead>
                                    <tr>
                                        <th> <span>Name </span></th>
                                        <th> <span>Date</span></th>
                                        <th> <span>Type </span></th>
                                        <th> <span>Status </span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <div class="square-box me-2"><img class="img-fluid b-r-5"
                                                        src="{{ asset($user->image) }}" alt="">
                                                </div>
                                                <div class="media-body ps-2">
                                                    <div class="avatar-details">
                                                            <h6>{{$user->first_name .' '. $user->last_name}}</h6>
                                                        </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="img-content-box">
                                            <h6>{{date("M jS, Y", strtotime($user->created_at));}}</h6>
                                        </td>
                                        <td>
                                            <h6>{{$user->type}}</h6>
                                        </td>
                                        @if($user->status=='1')
                                        <td>
                                            <div class="badge badge-light-primary">Active</div>
                                        </td>
                                        @elseif($user->status=='2')
                                         <td>
                                            <div class="badge badge-light-primary">Pending</div>
                                        </td>
                                        @else
                                        <td>
                                            <div class="badge badge-light-primary">Block</div>
                                        </td>
                                        @endif()

                                    </tr>
                                    @endforeach()
      
                                  
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> 


             <div class="col-xl-4 col-md-6 dash-31 dash-xl-50">
                <div class="card recent-activity">
                    <div class="card-header card-no-border">
                        <div class="media media-dashboard">
                            <div class="media-body">
                                <h5 class="mb-0">Past due jobs</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="table-responsive custom-scrollbar">
                            <table class="table table-bordernone">
                                <tbody>
                                @if(count($past_due_job)>0)
                                @foreach($past_due_job as $recent_order)
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <div class="square-box me-2"><img class="img-fluid b-r-5"
                                                        src="{{ asset($recent_order->user->image) }}" alt="">
                                                </div>
                                                <div class="media-body"><a href="user-profile.html">
                                                        <h5>{{$recent_order->user->first_name}} added new Order</h5>
                                                    </a>
                                                  <p>Order id</p> <a href="{{ route('admin.order.view-detail', ['id' => $recent_order->id, 'status' => $recent_order->status]) }}"><p class="font-primary">{{$recent_order->order_id}}</p></a>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="badge font-theme-light"><h6>{{date("M jS, Y", strtotime($recent_order->date));}}</h6></span></td>
                                    </tr>
                                @endforeach()    
                                    @endif()
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

             <div class="col-xl-4 col-md-6 dash-31 dash-xl-50">
                <div class="card recent-activity">
                    <div class="card-header card-no-border">
                        <div class="media media-dashboard">
                            <div class="media-body">
                                <h5 class="mb-0">Cancel Order</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="table-responsive custom-scrollbar">
                            <table class="table table-bordernone">
                                <tbody>
                                @if(count($cancel_jobs)>0)
                                @foreach($cancel_jobs as $recent_order)
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <div class="square-box me-2"><img class="img-fluid b-r-5"
                                                        src="{{ asset($recent_order->user->image) }}" alt="">
                                                </div>
                                                <div class="media-body"><a href="user-profile.html">
                                                        <h5>{{$recent_order->user->first_name}} added new Order</h5>
                                                    </a>
                                                  <p>Order id</p> <a href="{{ route('admin.order.view-detail', ['id' => $recent_order->id, 'status' => $recent_order->status]) }}"><p class="font-primary">{{$recent_order->order_id}}</p></a>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="badge font-theme-light"><h6>{{date("M jS, Y", strtotime($recent_order->date));}}</h6></span></td>
                                    </tr>
                                @endforeach()    
                                    @endif()
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-xl-6 col-lg-12 dash-xl-100">
                <div class="card total-transactions">
                    <div class="row m-0">
                        {{-- <div class="col-md-6 col-sm-6 p-0">
                            <div class="card-header card-no-border">
                                <h5>Profit and Loss</h5>
                            </div>
                            <div class="card-body pt-0">
                                <div>
                                    <div id="transaction-chart"></div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-md-6 col-sm-6 p-0 report-sec">
                            <div class="card-header card-no-border">
                                <div class="header-top">
                                    <h5 class="m-0">Earning</h5>
                                    <div class="icon-box onhover-dropdown"><i data-feather="more-horizontal"></i>
                                        <div class="icon-box-show onhover-show-div">
                                            <ul>
                                                <li> <a href="{{ route('admin.dashboard.get_by_date',['status'=>'today'])}}">
                                                        Today</a></li>
                                                <li> <a href="{{ route('admin.dashboard.get_by_date',['status'=>'week'])}}">
                                                        Weekly</a></li>
                                                <li> <a href="{{ route('admin.dashboard.get_by_date',['status'=>'month'])}}">
                                                        Monthly</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-6 report-main">
                                        <div class="report-content text-center">
                                            <p class="font-theme-light">Pay to Providers</p>
                                            <h5>${{isset($paid_to_provider) ? $paid_to_provider : '0'}}</h5>
                                            <div class="progress progress-round-primary">
                                                <div class="progress-bar" role="progressbar" style="width: 45%"
                                                    aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="report-content text-center">
                                            <p class="font-theme-light">Customers pay</p>
                                            <h5>${{isset($paid_by_customer)? $paid_by_customer : '0'}}</h5>
                                            <div class="progress progress-round-secondary">
                                                <div class="progress-bar" role="progressbar" style="width: 65%"
                                                    aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="media report-perfom">
                                            <div class="media-body">
                                                <p class="font-theme-light">Profit </p>
                                                <h5 class="m-0">${{isset($profit) ? $profit : '0'}}</h5>

                                            </div>
                                        </div>
                                    </div>
                                </div>
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
    @endpush

    @push('page-scripts')
    @endpush
