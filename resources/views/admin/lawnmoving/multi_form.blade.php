@extends('layouts.admin')

@section('title', 'Admins')

@push('vendor-styles')
    <link rel="stylesheet" href="{{ asset('vendors/css/forms/wizard/bs-stepper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
@endpush

@push('page-styles')
    <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/form-wizard.css') }}">
@endpush


@section('body')


    <!-- Modern Vertical Wizard -->
    <section class="modern-vertical-wizard">
        <div class="bs-stepper vertical wizard-modern modern-vertical-wizard-example">
            <div class="bs-stepper-header">

                {{-- **************************** SideBar Tabs ******************************************* --}}

                {{-- ------------ Charges ---------------------- --}}
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

                {{-- -------------- SidreBar Lawn Size ------------------------ --}}
                <div class="step" data-target="#personal-info-vertical-modern" role="tab"
                    id="personal-info-vertical-modern-trigger">
                    <button type="button" class="step-trigger" id="lawn_size">
                        <span class="bs-stepper-box">
                            <i data-feather="user" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Lawn Size</span>
                            <span class="bs-stepper-subtitle">Lawn Size Detail</span>
                        </span>
                    </button>
                </div>
                {{-- ----------------- SideBar Lawn Height -------------------- --}}
                <div class="step" data-target="#address-step-vertical-modern" role="tab"
                    id="address-step-vertical-modern-trigger">
                    <button type="button" class="step-trigger" id="lawn_height">
                        <span class="bs-stepper-box">
                            <i data-feather="map-pin" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Lawn Hieght</span>
                            <span class="bs-stepper-subtitle">Lawn Hieght Detail</span>
                        </span>
                    </button>
                </div>

                {{-- ----------------------- SideBar Service Deleivery ------------ --}}
                <div class="step" data-target="#social-links-vertical-modern" role="tab"
                    id="social-links-vertical-modern-trigger">
                    <button type="button" class="step-trigger" id="Service_Delivery">
                        <span class="bs-stepper-box">
                            <i data-feather="link" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Service Delivery</span>
                            <span class="bs-stepper-subtitle">Service Delivery Detail</span>
                        </span>
                    </button>
                </div>
               {{-- --------------- SideBar Have A Fence ----------------------  --}}
                <div class="step" data-target="#havefence" role="tab" id="social-links-vertical-modern-trigger">
                    <button type="button" class="step-trigger" id="fencearea">
                        <span class="bs-stepper-box">
                            <i data-feather="link" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Have a fence</span>
                            <span class="bs-stepper-subtitle">Have a fence Detail</span>
                        </span>
                    </button>
                </div>

                 {{-- ------------------------ Side bar Questions Section --------------- --}}
                <div class="step" data-target="#questions" role="tab" id="social-links-vertical-modern-trigger">
                    <button type="button" class="step-trigger" id="lawnquestions">
                        <span class="bs-stepper-box">
                            <i data-feather="link" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Questions</span>
                            <span class="bs-stepper-subtitle">Questions Detail</span>
                        </span>
                    </button>
                </div>

               {{-- --------------------- SideBar Corner Lot ------------------ --}}
                <div class="step" data-target="#cornerlot" role="tab" id="social-links-vertical-modern-trigger">
                    <button type="button" class="step-trigger" id="lawncornerlot">
                        <span class="bs-stepper-box">
                            <i data-feather="link" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Corner Lot</span>
                            <span class="bs-stepper-subtitle">Corner Lot Detail</span>
                        </span>
                    </button>
                </div>

            {{-- ------------------------ Yard Clean Up On SideBar ------------------------- --}}
                <div class="step" data-target="#yardCleanUpData" role="tab"
                    id="social-links-vertical-modern-trigger">
                    <button type="button" class="step-trigger" id="yardcleanup">
                        <span class="bs-stepper-box">
                            <i data-feather="link" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Yard CleanUp</span>
                            <span class="bs-stepper-subtitle">Yard CleanUp Detail</span>
                        </span>
                    </button>
                </div>
            </div>



            {{-- *********************** Showing Recoreds on click sidebar Against Id ********************************* --}}
            <div class="bs-stepper-content">

                {{-- Setup Lawn Mowing charges --}}
                <div id="Charges" class="content" role="tabpanel"
                    aria-labelledby="account-details-vertical-modern-trigger">
                    <div class="content-header">
                        <h5 class="mb-0">Charges Details</h5>
                        <small class="text-muted">Lawn Mowing Charges Details</small>
                    </div>
                    <form method="post" action="{{ route('admin.generalsettings.lawnmoving.update-charges') }}">
                        @csrf
                        <div class="row">
                            <div class="mb-1 col-md-6">
                                <label class="form-label" for="vertical-modern-username">Admin Fee</label>
                                <input type="text" name="admin_feeLawn"
                                    value="{{ isset($lawnfee[1]->field_value) ? $lawnfee[1]->field_value : '' }}"
                                    id="vertical-modern-username" class="form-control" />
                            </div>
                            <div class="mb-1 col-md-6">
                                <label class="form-label" for="vertical-modern-email">On Demand Fee</label>
                                <input type="text" name="on_demand_fee"
                                    value="{{ isset($lawnfee[0]->field_value) ? $lawnfee[0]->field_value : '' }}"
                                    id="vertical-modern-email" class="form-control" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-1 form-password-toggle col-md-6">
                                <label class="form-label" for="vertical-modern-password">Tax</label>
                                <input type="text" name="tax_rate_lawn"
                                    value="{{ isset($lawnfee[2]->field_value) ? $lawnfee[2]->field_value : '' }}"
                                    id="vertical-modern-password" class="form-control" />
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">


                            <span class="align-middle d-sm-inline-block d-none"></span>
                            </button>
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                </div>
                </form>


                <div id="account-details-vertical-modern" class="content" role="tabpanel"
                    aria-labelledby="account-details-vertical-modern-trigger">
                    <div class="content-header">
                        <h5 class="mb-0">Account Details</h5>
                        <small class="text-muted">Enter Your Account Details.</small>
                    </div>

                </div>
                <div id="personal-info-vertical-modern" class="content" role="tabpanel"
                    aria-labelledby="personal-info-vertical-modern-trigger">

                    <div class="container">
                        <h2>Lawn Size</h2>
                        <div id="tableview"></div>
                    </div>

                </div>


               {{-- ***********Showing Recored of Service Delivery ***************** --}}
                <div id="social-links-vertical-modern" class="content" role="tabpanel"
                    aria-labelledby="social-links-vertical-modern-trigger">
                    <div class="content-header">
                        <h5 class="mb-0">Service Delivery</h5>
                        <div id="ServiceDeliverylawnmoving"></div>
                    </div>
                </div>

               {{-- ***********Showing Recored of LawnHeight ***************** --}}
                <div id="address-step-vertical-modern" class="content" role="tabpanel"
                    aria-labelledby="address-step-vertical-modern-trigger">
                    <div class="content-header">
                        <h5 class="mb-0">Lawn Height</h5>
                        <div id="lawnhighttable"></div>
                    </div>
                </div>



                 {{---------- Fence Area -----------}}
                <div id="havefence" class="content" role="tabpanel"
                    aria-labelledby="social-links-vertical-modern-trigger">
                    <div class="content-header">
                        <h5 class="mb-0">Have Fence</h5>
                        <div id="HaveFence"></div>
                    </div>
                </div>

               {{-- ------------- Yard CleanUp ----------------------- --}}
                <div id="havefence" class="content" role="tabpanel"
                    aria-labelledby="social-links-vertical-modern-trigger">
                    <div class="content-header">
                        <h5 class="mb-0">Yard CleanUp</h5>
                        <div id="yardcleanup"></div>
                    </div>
                </div>

                {{--------- Lawn Mowing Question --------------}}
                <div id="questions" class="content" role="tabpanel"
                    aria-labelledby="social-links-vertical-modern-trigger">
                    <div class="content-header">
                        <h5 class="mb-0">Question</h5>
                        <div id="lawnmovingquestion"></div>

                    </div>
                </div>
                {{------------- Lawn Mowing Corner Lot -----------------}}
                <div id="cornerlot" styles="display: none;" class="content" role="tabpanel"
                    aria-labelledby="social-links-vertical-modern-trigger">
                    <div class="content-header">
                        <h5 class="mb-0">Corner Lot</h5>
                        <div id="lawnmovingcornerlot">
                            <div class="table-responsive">
                                <table class="table" id="mytable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Days</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Edit</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <form class="theme-form mega-form"
                                            action="{{ route('admin.generalsettings.lawnmoving.update-cornerlot') }}"
                                            method="post">
                                            @csrf
                                            @method('put')
                                            <tr>
                                                <input type="hidden" class="hidden_id" name="hidden_id">
                                                <th scope="row">1</td>
                                                <td>1 Time price</td>
                                                <td id="price"></td>
                                                <td><input type="text" class="price" name="price"></td>
                                                <td> <button type="submit" class="btn btn-success">update</button></td>

                                            </tr>
                                            <tr>
                                                <th>2</th>
                                                <td>7 Days price</td>
                                                <td id="seven_day_price"></td>
                                                <td><input type="text" name="seven_days_price"
                                                        class="seven_day_price"></td>
                                                <td> <button type="submit" class="btn btn-success">update</button></td>

                                            </tr>
                                            <tr>
                                                <th>3</th>
                                                <td>10 Days price</td>
                                                <td id="ten_day_price"></td>
                                                <td><input type="text" name="ten_days_price" class="ten_day_price">
                                                </td>
                                                <td> <button type="submit" class="btn btn-success">update</button></td>

                                            </tr>

                                            <tr>
                                                <th>4</th>
                                                <td>14 Days price</td>
                                                <td id="fourteen_day_price"></td>
                                                <td><input type="text" name="fourteen_days_price"
                                                        class="fourteen_day_price"></td>
                                                <td> <button type="submit" class="btn btn-success">update</button></td>

                                            </tr>
                                        </form>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                {{---------- Lawn Mowing Yard CleanuP --------- --}}
                <div id="yardCleanUpData" class="content" role="tabpanel"
                    aria-labelledby="social-links-vertical-modern-trigger">
                    <div class="content-header">
                        <h5 class="mb-0">Yard CleanUp</h5>
                        <div id="CleanUpData"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('vendor-scripts')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <!-- vendor files -->
    <script src="{{ asset('vendors/js/forms/wizard/bs-stepper.min.js') }}"></script>
    <script src="{{ asset('vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
@endpush



@push('page-scripts')
    <script src="{{ asset('js/scripts/forms/form-wizard.js') }}"></script>

    {{-- Shwing Lawn MowingTables --}}
    <script>
        $("#lawn_size").click(function(e) {
            e.preventDefault();
            var op = "";
            let status = 'lawnsize';
            $.ajax({
                type: "get",
                url: 'lawn-size/' + status,
                success: function(data2) {

                    op += '<table class="table" id="lawnSizeTable">';
                    op += '<thead>';
                    op +=
                        '<tr><th>SN</th><th>Name</th><th>1 Time Price</th><th>7 days price</th><th>10 days price</th><th>14 days price</th><th>Action</th></tr>';
                    op += '</thead>';
                    op += '<tbody>';
                    for (var i = 0; i < data2.length; i++) {
                        let url =
                            "{{ route('admin.generalsettings.lawnmoving.edit-lawn-size', ':id') }}";
                        url = url.replace(':id', data2[i].id);
                        let data_id = data2[i].id;
                        let btn =
                            "<button  data-bs-toggle='modal' data-title='Lawn Size' data-bs-target='#modal-opener' data-url='{{ route('admin.generalsettings.lawnmoving.edit-lawn-size', ':id') }}'  class='btn btn-success'>Edit</button>";
                        let btn1 =
                            "<button  data-url='{{ route('admin.generalsettings.lawnmoving.delete-lawn-size', ':id') }}'  id='delete-data' class='btn btn-danger'>Delete</button>";
                        btn1 = btn1.replace(':id', data2[i].id);
                        btn = btn.replace(':id', data2[i].id);
                        btn += btn1;


                        op += '<tr>';
                        op += '<td>' + (i + 1) + '</td><td>' + data2[i].name + '</td><td>' + data2[
                                i].price + '</td><td>' + data2[i].seven_days_price + '</td><td>' +
                            data2[
                                i].ten_days_price + '</td><td>' + data2[i].fourteen_days_price +
                            '</td><td>' +
                            btn + '</td></tr>';
                    }
                    op += '</tbody>';
                    op += '</table>';
                    $('#tableview').empty().html(op);
                    $('#lawnSizeTable').DataTable();
                },

                error: function(data) {
                    alert("Error")
                }
            });
        });
    </script>

    {{-- **************** For Lawn Heigt ********************************** --}}
    <script>
        $("#lawn_height").click(function(e) {
            var height = "";
            e.preventDefault();
            let status = 'lawnheight';
            $.ajax({
                type: "get",
                url: 'lawn-size/' + status,
                success: function(data2) {
                    height += '<table class="table" id="tableHeight">';
                    height += '<thead>'

                    height +=
                        '<tr><th>SN</th><th>Name</th><th>1 Time Price</th><th>7 days price</th><th>10 days price</th><th>14 days price</th><th>Action</th></tr>';
                    height += '</thead>';
                    height += '<tbody>';
                    for (var i = 0; i < data2.length; i++) {
                        let url =
                            "{{ route('admin.generalsettings.lawnmoving.edit-lawn-height', ':id') }}";
                        url = url.replace(':id', data2[i].id);
                        let data_id = data2[i].id;
                        let btn =
                            "<button  data-bs-toggle='modal' data-title='Lawn Height' data-bs-target='#modal-opener' data-url='{{ route('admin.generalsettings.lawnmoving.edit-lawn-height', ':id') }}'  class='btn btn-success'>Edit</button>";
                        let btn1 =
                            "<button  data-url='{{ route('admin.generalsettings.lawnmoving.delete-lawn-height', ':id') }}'  id='delete-data' class='btn btn-danger'>Delete</button>";
                        btn1 = btn1.replace(':id', data2[i].id);
                        btn = btn.replace(':id', data2[i].id);
                        btn += btn1;



                        height += '<tr>';
                        height += '<td>' + (i + 1) + '</td><td>' + data2[i].name + '</td><td>' + data2[
                                i].price + '</td><td>' + data2[i].seven_days_price + '</td><td>' +
                            data2[
                                i].ten_days_price + '</td><td>' + data2[i].fourteen_days_price +
                            '</td><td>' +
                            btn + '</td></tr>';
                    }
                    height += '</tbody>';
                    height += '</table>';

                    $('#lawnhighttable').empty().append(height);
                    $('#tableHeight').DataTable();

                },
                error: function(data) {
                    alert("Error")
                }
            });
        });
    </script>

    {{-- ****************** For Service Delivery **************************** --}}
    <script>
        $("#Service_Delivery").click(function(e) {
            var service = "";
            e.preventDefault();
            let status = 'ServiceDelivery';
            $.ajax({
                type: "get",
                url: 'lawn-size/' + status,
                success: function(data2) {
                  $('#ServiceDeliverylawnmoving').empty().html(data2);
                    $('.table').DataTable();
                },
                error: function(data) {
                    alert("Error")
                }
            });
        });
    </script>

    {{-- Update Radio Buttons for Service Delivry --}}
    <script>
        function changevalue(value) {
            var id = value;
            var url = '{{ route('admin.generalsettings.lawnmoving.change-service-status', ':id') }}';
            url = url.replace(':id', id);
            //Call ajax
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                },
                type: "POST",
                url: url,
                success: function(response) {
                    console.log(response);
                }
            });
        }
    </script>

    {{-- Get And Append data of Fence --}}
    <script>
        $("#fencearea").click(function(e) {
            var fence = "";
            $('#HaveFence').empty();
            e.preventDefault();
            let status = 'fence';
            $.ajax({
                type: "get",
                url: 'lawn-size/' + status,
                success: function(data2) {
                    fence += '<table class="table" id="fanceData">';
                    fence += '<thead>'
                    fence +=
                        '<tr><th>SN</th><th>Name</th><th>1 Time Price</th><th>7 days price</th><th>10 days price</th><th>14 days price</th><th>Action</th></tr>';
                    fence += '</thead>';
                    fence += '<tbody>';
                    for (var i = 0; i < data2.length; i++) {
                        let url =
                            "{{ route('admin.generalsettings.lawnmoving.edit-fence-data', ':id') }}";
                        url = url.replace(':id', data2[i].id);
                        let data_id = data2[i].id;
                        let btn =
                            "<button  data-bs-toggle='modal'data-title='Have Fence' data-bs-target='#modal-opener' data-url='{{ route('admin.generalsettings.lawnmoving.edit-fence-data', ':id') }}'  class='btn btn-success'>Edit</button>";
                        let btn1 =
                            "<button  data-url='{{ route('admin.generalsettings.lawnmoving.delete-fence-data', ':id') }}'  id='delete-data' class='btn btn-danger'>Delete</button>";
                        btn1 = btn1.replace(':id', data2[i].id);
                        btn = btn.replace(':id', data2[i].id);
                        btn += btn1;


                        fence += '<tr>';
                        fence += '<td>' + (i + 1) + '</td><td>' + data2[i].name + '</td><td>' + data2[
                                i].price + '</td><td>' + data2[i].seven_days_price + '</td><td>' +
                            data2[
                                i].ten_days_price + '</td><td>' + data2[i].fourteen_days_price +
                            '</td><td>' +
                            btn + '</td></tr>';
                    }
                    fence += '</tbody>';
                    fence += '</table>';
                    $('#HaveFence').append(fence);
                    $('#fanceData').DataTable();
                },
                error: function(data) {
                    alert("Error")
                }
            });
        });
    </script>

    {{-- Get data and append of questions --}}
    <script>
        $("#lawnquestions").click(function(e) {
            var question = "";
            $('#lawnmovingquestion').empty();
            e.preventDefault();
            let status = 'questions';
            $.ajax({
                type: "get",
                url: 'lawn-size/' + status,
                success: function(data2) {
                    question += '<table class="table" id="questiondata">';
                    question += '<thead>';
                    question +=
                        '<tr><th>SN</th><th>Questions</th><th>Action</th></tr>';
                    question += '</thead>';
                    question += '<tbody>';
                    for (var i = 0; i < data2.length; i++) {
                        let url =
                            "{{ route('admin.generalsettings.lawnmoving.edit-questions', ':id') }}";
                        url = url.replace(':id', data2[i].id);
                        let data_id = data2[i].id;
                        let btn =
                            "<button  data-bs-toggle='modal' data-title='LawnMowing Questions' data-bs-target='#modal-opener' data-url='{{ route('admin.generalsettings.lawnmoving.edit-questions', ':id') }}'  class='btn btn-success'>Edit</button>";
                        let btn1 =
                            "<button  data-url='{{ route('admin.generalsettings.lawnmoving.delete-question', ':id') }}'  id='delete-data' class='btn btn-danger'>Delete</button>";
                        btn1 = btn1.replace(':id', data2[i].id);
                        btn = btn.replace(':id', data2[i].id);
                        btn += btn1;

                        question += '<tr>';
                        question += '<td>' + (i + 1) + '</td><td>' + data2[i].question + '</td><td>' +
                            btn + '</td></tr>';
                    }
                    question += '</tbody>';
                    question += '</table>';
                    $('#lawnmovingquestion').empty().append(question);
                    $('#questiondata').DataTable();
                },
                error: function(data) {
                    alert("Error")
                }
            });
        });
    </script>

    {{-- Get And Append data OF Corner Lot --}}
    <script>
        $("#lawncornerlot").click(function(e) {
            var cornerlot = "";

            e.preventDefault();
            let status = 'cornerlot';
            $.ajax({
                type: "get",
                url: 'lawn-size/' + status,
                success: function(data2) {
                    $(".hidden_id").empty().val(data2.id);

                    $(".price").empty().val(data2.price);
                    $("#price").empty().append(data2.price);

                    $(".ten_day_price").empty().val(data2.ten_days_price);
                    $("#ten_day_price").empty().append(data2.ten_days_price);

                    $(".seven_day_price").empty().val(data2.seven_days_price);
                    $("#seven_day_price").empty().append(data2.seven_days_price);

                    $(".fourteen_day_price").empty().val(data2.fourteen_days_price);
                    $("#fourteen_day_price").empty().append(data2.fourteen_days_price);
                },
                error: function(data) {
                    alert("Error")
                }
            });
        });
    </script>

    {{-- Get And Append Data Yad CleanUp --}}
    <script>
        $("#yardcleanup").click(function(e) {
            var yardcleanup = "";
            e.preventDefault();
            let status = 'lawn-cleanup';
            $.ajax({
                type: "get",
                url: 'lawn-size/' + status,
                success: function(data) {
                    $('#CleanUpData').empty().html(data);
                    $('.table').DataTable();
                },
                error: function(data) {
                    alert("Error")
                }
            });
        });
    </script>

@endpush
