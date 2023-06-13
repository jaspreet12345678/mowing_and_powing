@extends('layouts.admin')

@section('title', 'Admins')

@push('vendor-styles')
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('vendors/css/forms/wizard/bs-stepper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
@endpush

@push('page-styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" />

    <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/form-wizard.css') }}">
@endpush


@section('body')


    <!-- Modern Vertical Wizard -->
    <section class="modern-vertical-wizard">
        <div class="bs-stepper vertical wizard-modern modern-vertical-wizard-example">


            {{-- **************************** SideBar Tabs ******************************************* --}}
            <div class="bs-stepper-header">
                {{-- ******************* Charges ************************** --}}
                <div class="step" data-target="#Charges" role="tab" id="account-details-vertical-modern-trigger">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-box">
                            <i data-feather="file-text" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Charges</span>
                            <span class="bs-stepper-subtitle">Setup Lawn Mowing Charges</span>
                        </span>
                    </button>
                </div>

                {{-- ****************** Car Types ****************************** --}}
                <div class="step" data-target="#personal-info-vertical-modern" role="tab"
                    id="personal-info-vertical-modern-trigger">
                    <button type="button" class="step-trigger" id="car_type">
                        <span class="bs-stepper-box">
                            <i data-feather="user" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Car Type</span>
                            <span class="bs-stepper-subtitle">Car Type Detail</span>
                        </span>
                    </button>
                </div>

                {{-- ************************** Car Colors ******************************* --}}
                <div class="step" data-target="#address-step-vertical-modern" role="tab"
                    id="address-step-vertical-modern-trigger">
                    <button type="button" class="step-trigger" id="car_color">
                        <span class="bs-stepper-box">
                            <i data-feather="map-pin" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Car Color</span>
                            <span class="bs-stepper-subtitle">Car Color Detail</span>
                        </span>
                    </button>
                </div>

                {{-- ********************** Questions ********************************* --}}
                <div class="step" data-target="#questions" role="tab" id="social-links-vertical-modern-trigger">
                    <button type="button" class="step-trigger" id="snowplowing_questions">
                        <span class="bs-stepper-box">
                            <i data-feather="link" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Questions</span>
                            <span class="bs-stepper-subtitle">Questions Detail</span>
                        </span>
                    </button>
                </div>

                {{-- *************************** Dreive Way ******************************** --}}
                <div class="step" data-target="#drivewayvalue" role="tab" id="social-links-vertical-modern-trigger">
                    <button type="button" class="step-trigger" id="Driveway">
                        <span class="bs-stepper-box">
                            <i data-feather="link" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Drive Way</span>
                            <span class="bs-stepper-subtitle">Drive Way Detail</span>
                        </span>
                    </button>
                </div>

                {{-- ************************** Side Walk *************************** --}}
                <div class="step" data-target="#sidewalkvalue" role="tab" id="social-links-vertical-modern-trigger">
                    <button type="button" class="step-trigger" id="sidewalk">
                        <span class="bs-stepper-box">
                            <i data-feather="link" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">SideWalk</span>
                            <span class="bs-stepper-subtitle">SideWalk Detail</span>
                        </span>
                    </button>
                </div>

                {{-- *************************** Walk Way ************************************* --}}
                <div class="step" data-target="#walkwayvalue" role="tab" id="social-links-vertical-modern-trigger">
                    <button type="button" class="step-trigger" id="walkway">
                        <span class="bs-stepper-box">
                            <i data-feather="link" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">WalkWay</span>
                            <span class="bs-stepper-subtitle">WalkWay Detail</span>
                        </span>
                    </button>
                </div>

                <div class="step" data-target="#snowdepthvalue" role="tab" id="social-links-vertical-modern-trigger">
                    <button type="button" class="step-trigger" id="snowdepth">
                        <span class="bs-stepper-box">
                            <i data-feather="link" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">SnowDepth</span>
                            <span class="bs-stepper-subtitle">SnowDepth Detail</span>
                        </span>
                    </button>
                </div>
            </div>



            {{-- *********************** Showing Recoreds on click sidebar Against Id ********************************* --}}
            <div class="bs-stepper-content">

                {{-- Setup Snow Plowing charges --}}
                <div id="Charges" class="content" role="tabpanel"
                    aria-labelledby="account-details-vertical-modern-trigger">
                    <div class="content-header">
                        <h5 class="mb-0">Charges Details</h5>
                        <small class="text-muted">Snow Plowing Charges Details</small>
                    </div>
                    <form method="post" action="{{ route('admin.generalsettings.snow-plowing.update-charges') }}">
                        @csrf
                        <div class="row">
                            <div class="mb-1 col-md-6">
                                <label class="form-label" for="vertical-modern-username">Admin Fee</label>
                                <input type="text" name="admin_snowfee"
                                    value="{{ isset($snowfee[0]->field_value) ? $snowfee[0]->field_value : '' }} "
                                    id="vertical-modern-username" class="form-control" />
                            </div>
                            <div class="mb-1 col-md-6">
                                <label class="form-label" for="vertical-modern-email">Tax rate</label>
                                <input type="text" name="texrate_snow"
                                    value="{{ isset($snowfee[1]->field_value) ? $snowfee[1]->field_value : '' }}"
                                    id="vertical-modern-email" class="form-control" />
                            </div>
                        </div>

                        <div class="d-flex justify-content-between" style="margin-top:1%">
                            <span class="align-middle d-sm-inline-block d-none"></span>
                            </button>
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                </div>
                </form>


                {{-- *********** Append Car Types Detail Here From Jquery ***************** --}}
                <div id="personal-info-vertical-modern" class="content" role="tabpanel"
                    aria-labelledby="personal-info-vertical-modern-trigger">
                    <div class="container">
                        <h2>Car Types</h2>
                        <button data-bs-toggle='modal' data-bs-target='#modal-opener'
                            data-url="{{ route('admin.generalsettings.snow-plowing.view-car-type') }}"
                            style="font-size:12px; float: right">Add <i class="fa fa-plus"></i></button>
                        <div id="snowplowing_cartype"></div>
                    </div>
                </div>


                {{-- ************* Append Car Color Detail Here **************** --}}
                <div id="address-step-vertical-modern" class="content" role="tabpanel"
                    aria-labelledby="address-step-vertical-modern-trigger">
                    <div class="content-header">
                        <h5 class="mb-0">Car Colors</h5>
                        <button data-bs-toggle='modal' data-bs-target='#modal-opener'
                            data-url="{{ route('admin.generalsettings.snow-plowing.view-car-color') }}"
                            style="font-size:12px; float: right">Add <i class="fa fa-plus"></i></button>
                        <div id="snowplowing_carcolor"></div>
                    </div>
                </div>

                {{-- *********** Snow Plowing Question **************** --}}
                <div id="questions" class="content" role="tabpanel"
                    aria-labelledby="social-links-vertical-modern-trigger">
                    <div class="content-header">
                        <h5 class="mb-0">Question</h5>
                        <button data-bs-toggle='modal' data-title='Enter New Question' data-bs-target='#modal-opener'
                            data-url="{{ route('admin.generalsettings.snow-plowing.add-question') }}"
                            style="font-size:12px; float: right">Add <i class="fa fa-plus"></i></button>
                        <div id="snowplowingquestion"></div>
                    </div>
                </div>

                {{-- *********** Drive Way ********************** --}}
                <div id="drivewayvalue" class="content" role="tabpanel"
                    aria-labelledby="social-links-vertical-modern-trigger">
                    <div class="content-header">
                        <h5 class="mb-0">DriveWay</h5>
                        <div id="snowplowingdriveway"></div>
                    </div>
                </div>

                {{-- *************** SideWalk ************************** --}}
                <div id="sidewalkvalue" class="content" role="tabpanel"
                    aria-labelledby="social-links-vertical-modern-trigger">
                    <div class="content-header">
                        <h5 class="mb-0">Sidewalk</h5>
                        <div id="snowplowingsidewalk"></div>
                    </div>
                </div>

                {{-- *************** Walk Way ************************ --}}
                <div id="walkwayvalue" class="content" role="tabpanel"
                    aria-labelledby="social-links-vertical-modern-trigger">
                    <div class="content-header">
                        <h5 class="mb-0">WalkWay</h5>
                        <div id="snowplowingwalkway"></div>
                    </div>
                </div>

                {{-- **************** Snow Depth********************* --}}
                 <div id="snowdepthvalue" class="content" role="tabpanel"
                    aria-labelledby="social-links-vertical-modern-trigger">
                    <div class="content-header">
                        <h5 class="mb-0">Snow Depth</h5>
                        <div id="snowPlowingSnowDepth"></div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
@push('vendor-scripts')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendors/js/forms/wizard/bs-stepper.min.js') }}"></script>
    <script src="{{ asset('vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
@endpush
@push('page-scripts')
    <script src="{{ asset('js/scripts/forms/form-wizard.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>


    {{-- ************* Snow Plowing Car Types ***************** --}}
    <script>
        $("#car_type").click(function(e) {
            e.preventDefault();
            var op = "";
            let type = 'cartype';
            $.ajax({
                type: "get",
                url: 'cards-value/' + type,
                success: function(data2) {

                    op += '<table class="table" id="carstype">';
                    op += '<thead>';
                    op +=
                        '<tr><th>#</th><th>Name</th><th>Price</th><th>Action</th></tr>';
                        op += '</thead>';
                        op += '<tbody>';
                    for (var i = 0; i < data2.length; i++) {
                        let url =
                            "{{ route('admin.generalsettings.lawnmoving.edit-lawn-size', ':id') }}";
                        url = url.replace(':id', data2[i].id);
                        let data_id = data2[i].id;
                        let btn =
                            "<button  data-bs-toggle='modal' data-title='Car Type' data-bs-target='#modal-opener' data-url='{{ route('admin.generalsettings.snow-plowing.edit-car-type', ':id') }}'  class='btn btn-success'>Edit</button>";
                        let btn1 =
                            "<button  data-url='{{ route('admin.generalsettings.snow-plowing.delete-car-type', ':id') }}'  id='delete-data' class='btn btn-danger'>Delete</button>";
                        btn1 = btn1.replace(':id', data2[i].id);
                        btn = btn.replace(':id', data2[i].id);
                        btn += btn1;
                        op += '<tr>';
                        op += '<td>' + (i + 1) + '</td><td>' + data2[i].name + '</td><td>' + data2[
                                i].price + '</td><td>' +
                            btn + '</td></tr>';
                    }
                     op += '</tbody>';
                    op += '</table>';

                    $('#snowplowing_cartype').empty().html(op);
                    $('#carstype').DataTable();
                },
                error: function(data) {
                    alert("Error")
                }
            });
        });
    </script>

    {{-- ***********Snow Plowing Car Colors *********************** --}}
    <script>
        $("#car_color").click(function(e) {
            e.preventDefault();
            var color = "";
            let type = 'colors';
            $.ajax({
                type: "get",
                url: 'cards-value/' + type,
                success: function(data2) {

                    color += '<table class="table" id="carColors">';
                    color += '<thead>';
                    color +=
                        '<tr><th>#</th><th>Name</th><th>Action</th></tr>';
                    color += '</thead>';
                    color += '<tbody>';

                    for (var i = 0; i < data2.length; i++) {
                        let url =
                            "{{ route('admin.generalsettings.lawnmoving.edit-lawn-size', ':id') }}";
                        url = url.replace(':id', data2[i].id);
                        let data_id = data2[i].id;
                        let btn =
                            "<button  data-bs-toggle='modal' data-title='Car Color' data-bs-target='#modal-opener' data-url='{{ route('admin.generalsettings.snow-plowing.edit-car-color', ':id') }}'  class='btn btn-success'>Edit</button>";
                        let btn1 =
                            "<button  data-url='{{ route('admin.generalsettings.snow-plowing.delete-car-color', ':id') }}'  id='delete-data' class='btn btn-danger'>Delete</button>";
                        btn1 = btn1.replace(':id', data2[i].id);
                        btn = btn.replace(':id', data2[i].id);
                        btn += btn1;


                        color += '<tr>';

                        color += '<td>' + (i + 1) + '</td><td>' + data2[i].name + '</td><td>' +
                            btn + '</td>';
                    }

                    color += '</tbody>';
                    color += '</table>';


                    $('#snowplowing_carcolor').html(color);
                    $('#carColors').DataTable();


                },
                error: function(data) {
                    alert("Error")
                }
            });
        });
    </script>

    {{-- ************ Get data and append of questions ************** --}}
    <script>
        $("#snowplowing_questions").click(function(e) {
            var question = "";
            e.preventDefault();
            let type = 'question';
            $.ajax({
                type: "get",
                url: 'cards-value/' + type,
                success: function(data2) {
                    question += '<table class="table" id="snowQuestions">';
                    question += '<thead>';
                    question +=
                        '<tr><th>SN</th><th>Questions</th><th>Action</th></tr>';
                        question += '</thead>';
                        question += '<tbody>';
                    for (var i = 0; i < data2.length; i++) {
                        let url =
                            "{{ route('admin.generalsettings.lawnmoving.edit-lawn-size', ':id') }}";
                        url = url.replace(':id', data2[i].id);
                        let data_id = data2[i].id;
                        let btn =
                            "<button  data-bs-toggle='modal' data-title='SnowPlowing Questions' data-bs-target='#modal-opener' data-url='{{ route('admin.generalsettings.snow-plowing.edit-questions', ':id') }}'  class='btn btn-success'>Edit</button>";
                        let btn1 =
                            "<button  data-url='{{ route('admin.generalsettings.snow-plowing.delete-question', ':id') }}'  id='delete-data' class='btn btn-danger'>Delete</button>";
                        btn1 = btn1.replace(':id', data2[i].id);
                        btn = btn.replace(':id', data2[i].id);
                        btn += btn1;


                        question += '<tr>';
                        question += '<td>' + (i + 1) + '</td><td>' + data2[i].question + '</td><td>' +
                            btn + '</td></tr>';
                    }
                    question += '</tbody>';
                    question += '</table>';
                    $('#snowplowingquestion').empty().append(question);
                    $('#snowQuestions').DataTable();
                },
                error: function(data) {
                    alert("Error")
                }
            });
        });
    </script>

  {{-- **************** Get Data And Append For DriveWay ******************** --}}
       <script>
        $("#Driveway").click(function(e) {
            var driveway = "";
            e.preventDefault();
            let type = 'driveway';
            $.ajax({
                type: "get",
                url: 'cards-value/' + type,
                success: function(data2) {
                    driveway += '<table class="table" id="DriveWayData">';
                    driveway += '<thead>';

                    driveway +=
                        '<tr><th>SN</th><th>Type</th><th>On_first_6_car</th><th>on_more_than_6_cars</th><th>Action</th></tr>';
                    driveway += '</thead>';
                    driveway += '<tbody>';
                    for (var i = 0; i < data2.length; i++) {
                        let url =
                            "{{ route('admin.generalsettings.lawnmoving.edit-lawn-size', ':id') }}";
                        url = url.replace(':id', data2[i].id);
                        let data_id = data2[i].id;
                        let btn =
                            "<button  data-bs-toggle='modal' data-title='DriveWay' data-bs-target='#modal-opener' data-url='{{ route('admin.generalsettings.snow-plowing.drive-way', ':id') }}'  class='btn btn-success'>Edit</button>";
                        btn = btn.replace(':id', data2[i].id);


                        driveway += '<tr>';
                        driveway += '<td>' + (i + 1) + '</td><td>' + data2[i].type + '</td><td>' +
                            data2[i].on_first_6_cars + '</td><td>' + data2[
                                i].on_more_than_6_cars + '</td><td>' +
                            btn + '</td></tr>';
                    }
                    driveway += '</tbody>';
                    driveway += '</table>';
                    $('#snowplowingdriveway').empty().html(driveway);
                    $('#DriveWayData').DataTable();
                },
                error: function(data) {
                    alert("Error")
                }
            });
        });
    </script>


    {{-- ********* Get data and append of SideWalk ************* --}}
    <script>
        $("#sidewalk").click(function(e) {
            var sidewalk = "";
            e.preventDefault();
            let type = 'sidewalk';
            $.ajax({
                type: "get",
                url: 'cards-value/' + type,
                success: function(data2) {
                    sidewalk += '<table class="table" id="sidewalkdata">';

                    sidewalk += '<thead>';
                   
                    sidewalk +=
                        '<tr><th>SN</th><th>Type</th><th>Name</th><th>Price</th><th>Action</th></tr>';
                         sidewalk += '</thead>';
                          sidewalk += '<tbody>';
                    for (var i = 0; i < data2.length; i++) {
                        let url =
                            "{{ route('admin.generalsettings.snow-plowing.side-walk', ':id') }}";
                        url = url.replace(':id', data2[i].id);
                        let data_id = data2[i].id;
                        let btn =
                            "<button  data-bs-toggle='modal' data-title='SideWalk' data-bs-target='#modal-opener' data-url='{{ route('admin.generalsettings.snow-plowing.side-walk', ':id') }}'  class='btn btn-success'>Edit</button>";
                        btn = btn.replace(':id', data2[i].id);


                        sidewalk += '<tr>';
                        sidewalk += '<td>' + (i + 1) + '</td><td>' + data2[i].type + '</td><td>' +
                            data2[i].name + '</td><td>' + data2[
                                i].price + '</td><td>' +
                            btn + '</td></tr>';
                    }
                    sidewalk += '</tbody>';
                    sidewalk += '</table>';
                    $('#snowplowingsidewalk').empty().append(sidewalk);
                    $('#sidewalkdata').DataTable();
                },
                error: function(data) {
                    alert("Error")
                }
            });
        });
    </script>

    {{-- ******** Get Data And Append of WalkWay ************ --}}
    <script>
        $("#walkway").click(function(e) {
            var walkway = "";
            e.preventDefault();
            let type = 'walkway';
            $.ajax({
                type: "get",
                url: 'cards-value/' + type,
                success: function(data2) {
                    walkway += '<table class="table" id="walkway_datatable">';
                    walkway += '<thead>';
                    walkway +=
                        '<tr><th>SN</th><th>Type</th><th>Name</th><th>Price</th><th>Action</th></tr>';

                        walkway += '</thead>';
                        walkway += '<tbody>';
                    for (var i = 0; i < data2.length; i++) {
                        let url =
                            "{{ route('admin.generalsettings.snow-plowing.side-walk', ':id') }}";
                        url = url.replace(':id', data2[i].id);
                        let data_id = data2[i].id;
                        let btn =
                            "<button  data-bs-toggle='modal' data-title='WalkWay' data-bs-target='#modal-opener' data-url='{{ route('admin.generalsettings.snow-plowing.walk-way', ':id') }}'  class='btn btn-success'>Edit</button>";
                        btn = btn.replace(':id', data2[i].id);

                        walkway += '<tr>';
                        walkway += '<td>' + (i + 1) + '</td><td>' + data2[i].type + '</td><td>' +
                            data2[i].name + '</td><td>' + data2[
                                i].price + '</td><td>' +
                            btn + '</td></tr>';
                    }
                    walkway += '</tbody>';
                    walkway += '</table>';
                    $('#snowplowingwalkway').empty().append(walkway);
                     $('#walkway_datatable').DataTable();
                },
                error: function(data) {
                    alert("Error")
                }
            });
        });
    </script>

    {{-- *************** Get Data And Append for Snow Depth ******************** --}}
    <script>
    
      $("#snowdepth").click(function(e) {
           var walkway = "";
            e.preventDefault();
            let type = 'snowdepth';
            $.ajax({
                type: "get",
                url: 'cards-value/' + type,
                success: function(data2) {
                    walkway += '<table class="table" id="snowdepth_datatable">';
                    walkway += '<thead>';
                    walkway +=
                        '<tr><th>SN</th><th>Type</th><th>Name</th><th>Price</th><th>Action</th></tr>';

                        walkway += '</thead>';
                        walkway += '<tbody>';
                    for (var i = 0; i < data2.length; i++) {
                        let url =
                            "{{ route('admin.generalsettings.snow-plowing.side-walk', ':id') }}";
                        url = url.replace(':id', data2[i].id);
                        let data_id = data2[i].id;
                        let btn =
                            "<button  data-bs-toggle='modal' data-title='SnowDepth' data-bs-target='#modal-opener' data-url='{{ route('admin.generalsettings.snow-plowing.snow-depth', ':id') }}'  class='btn btn-success'>Edit</button>";
                        btn = btn.replace(':id', data2[i].id);

                        walkway += '<tr>';
                        walkway += '<td>' + (i + 1) + '</td><td>' + data2[i].type + '</td><td>' +
                            data2[i].name + '</td><td>' + data2[
                                i].price + '</td><td>' +
                            btn + '</td></tr>';
                    }
                    walkway += '</tbody>';
                    walkway += '</table>';
                    $('#snowPlowingSnowDepth').empty().append(walkway);
                     $('#snowdepth_datatable').DataTable();
                },
                error: function(data) {
                    alert("Error")
                }
            });
        });
    </script>
@endpush
