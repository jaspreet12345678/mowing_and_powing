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
                {{-- <div class="step" data-target="#Charges" role="tab" id="account-details-vertical-modern-trigger">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-box">
                            <i data-feather="file-text" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Dashboard</span>
                           
                        </span>
                    </button>
                </div> --}}

                {{-- -------------- Users ------------------------ --}}
                <div class="step" data-target="#personal-info-vertical-modern" role="tab"
                    id="personal-info-vertical-modern-trigger">
                    <button type="button" class="step-trigger">
                      <span class="bs-stepper-box">
                            <i data-feather="file-text" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Users</span>
                        </span>
                    </button>
                </div>
                {{-- ----------------- Roles And Permissions -------------------- --}}
                <div class="step" data-target="#address-step-vertical-modern" role="tab"
                    >
                    <button type="button" class="step-trigger" id="lawn_height">
                        <span class="bs-stepper-box">
                            <i data-feather="file-text" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Roles And Permissions</span>
                            
                        </span>
                    </button>
                </div>

                {{-- ------------------- Team Mambers ------------ --}}
                <div class="step" data-target="#social-links-vertical-modern" role="tab"
                    >
                    <button type="button" class="step-trigger">
                       <span class="bs-stepper-box">
                            <i data-feather="file-text" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Teams Members</span>
                        </span>
                    </button>
                </div>
               {{-- --------------- PayProviders ----------------------  --}}
                <div class="step" data-target="#providerpayments" role="tab">
                    <button type="button" class="step-trigger" id="fencearea">
                       <span class="bs-stepper-box">
                            <i data-feather="file-text" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Providers Payment</span>
                        </span>
                    </button>
                </div>

                 {{-- ------------------------ Orders--------------- --}}
                <div class="step" data-target="#orders" role="tab">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-box">
                            <i data-feather="file-text" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Order</span>
                        </span>
                    </button>
                </div>

               {{-- --------------------- Plugins ------------------ --}}
                <div class="step" data-target="#plugins" role="tab">
                    <button type="button" class="step-trigger" >
                       <span class="bs-stepper-box">
                            <i data-feather="file-text" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Plugins</span>
                            
                        </span>
                    </button>
                </div>

            {{-- ------------------------ Cities ------------------------- --}}
                <div class="step" data-target="#cities" role="tab"
                    id="social-links-vertical-modern-trigger">
                    <button type="button" class="step-trigger" id="yardcleanup">
                        <span class="bs-stepper-box">
                            <i data-feather="file-text" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Cities</span>
                        </span>
                    </button>
                </div>

                <div class="step" data-target="#templates" role="tab"
                    id="social-links-vertical-modern-trigger">
                    <button type="button" class="step-trigger" id="yardcleanup">
                        <span class="bs-stepper-box">
                            <i data-feather="file-text" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Templates</span>
                        </span>
                    </button>
                </div>

                <div class="step" data-target="#generalsetting" role="tab"
                    id="social-links-vertical-modern-trigger">
                    <button type="button" class="step-trigger" id="yardcleanup">
                        <span class="bs-stepper-box">
                            <i data-feather="file-text" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">General Settings</span>
                        </span>
                    </button>
                </div>


                  <div class="step" data-target="#promotions" role="tab"
                    id="social-links-vertical-modern-trigger">
                    <button type="button" class="step-trigger" id="yardcleanup">
                        <span class="bs-stepper-box">
                            <i data-feather="file-text" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Promotions</span>
                        </span>
                    </button>
                </div>


                  <div class="step" data-target="#helpcenter" role="tab"
                    id="social-links-vertical-modern-trigger">
                    <button type="button" class="step-trigger" id="yardcleanup">
                        <span class="bs-stepper-box">
                            <i data-feather="file-text" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Help Center</span>
                        </span>
                    </button>
                </div>


                <div class="step" data-target="#companysetting" role="tab"
                   >
                    <button type="button" class="step-trigger" id="yardcleanup">
                       <span class="bs-stepper-box">
                            <i data-feather="file-text" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Company Settings</span>
                        </span>
                    </button>
                </div>

                <div class="step" data-target="#cmssetting" role="tab"
                    id="social-links-vertical-modern-trigger">
                    <button type="button" class="step-trigger" id="yardcleanup">
                        <span class="bs-stepper-box">
                            <i data-feather="file-text" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Cms Settings</span>
                        </span>
                    </button>
                </div>


                 <div class="step" data-target="#chat" role="tab"
                    >
                    <button type="button" class="step-trigger" id="yardcleanup">
                       <span class="bs-stepper-box">
                            <i data-feather="file-text" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Chat</span>
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
                        <h3 class="mb-0">Dashboard</h3>
                        <h6 class="text-muted">Dashboard Detail</h6>
                    </div>
               
                        <div class="row">
                            <div class="mb-1 col-md-6">
                               <p>This is the dashboard setting</p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="align-middle d-sm-inline-block d-none"></span>
                        
                        </div>
                </div>
    

                <div id="personal-info-vertical-modern" class="content" role="tabpanel"
                    aria-labelledby="personal-info-vertical-modern-trigger">

                    <div class="container">
                        <h2>Users</h2>
                        <h4>1. Admins</h4>
                       <p><i>Admin are those user which handle admin panel and manage other user customers and providers.New admin can crete from <b>Team Member</b> module by inviting new team members</i>
                        <h4>2. Customers</h4>
                       <p><i>Customer are those users which are creating orders on our website.There are two type of customers</i>
                       <h4>2.1 Active Customers</h4>
                       <p><i>Active Customer are those user whch rae active on website and can perform actions as well login</i>
                       <h4>2.2 Block Customers</h4>
                       <p><i>Block Customers are those users which are Inactive and can not login and perform actions untill admin will make active</i>
                       <h4>3. Providers</h4>
                       <p><i>Providers are those users who will perform task against orders which are created by customers and providers have app login and will use app only.Providers will register on app but connected with our database through app</i>
                        <h4>3.1 Pending</h4>
                       <p><i>These are new providers whose register thier account through app but still in pending list can not login untill admin make it active</i>
                       <h4>3.2 Active</h4>
                       <p><i>Activer providers are those users which are in active list. admin has make in active list and thsese providers can login and perform actions</i>
                       <h4>3.3 Block</h4>
                       <p><i>Block providers are those users which are in block list. admin has make in block list and thsese providers can not  login and perform actions</i>
                    </div>

                </div>


               {{-- ***********Showing Recored of Service Delivery ***************** --}}
                <div id="social-links-vertical-modern" class="content" role="tabpanel">
                    <div class="content-header">
                        <h5 class="mb-0">Teams Members</h5>
                        <p><i>we can invite new team member through email as wellwe can choose permission for this team member.only these specfic actions can perform </i>
                        
                    </div>
                </div>

               {{-- ***********Showing Recored of LawnHeight ***************** --}}
                <div id="address-step-vertical-modern" class="content" role="tabpanel"
                    >
                    <div class="content-header">
                        <h5 class="mb-0">Roles And Permissions</h5>
                         <p><i>we can add new roles and set permission against any role. So every user which belong to specfic role can perform specfic actions which permissions set by admin</i>
                    </div>
                </div>



                 {{----------  -----------}}
                <div id="providerpayments" class="content" role="tabpanel"
                    >
                    <div class="content-header">
                        <h5 class="mb-0">Providers Payment</h5>
                        <h4>1. Withdraw Request</h4>
                       <p><i>In view order list we can see all orders list like <b>(i) total orders</b>,<b>(ii) pending orders:</b> are those orders which are not accept are assign to any provider and not started yet,<b>(iii) completed orders:</b>those orders which has been complete ,<b>(iv) accepted orders:</b> those orders which has benn accept by provider but not complete yet as well past due orders. <b>(v) past due orders:</b> are those orders which date has been passed but orders are not completed</i>
                        <div class="fw-bold">1.Pending </div>
                       <p><i>List of all Cancel orders</i>
                       <div class="fw-bold">2.Approved </div>
                        <p><i>Those orders which has been refunded to customer</i>
                         <div class="fw-bold">3.Rejected</div>
                        <p><i>Those order which are underreview still not refund to customer</i>
                       
                        <h4>2.Transaction</h4>
                       <p><i>Transaction showing approved payment to providers</i>
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

                {{--------- Orders --------------}}
                <div id="orders" class="content" role="tabpanel"
                    aria-labelledby="social-links-vertical-modern-trigger">
                    <div class="content-header">
                        <h5 class="mb-0"></h5>
                          <h3 class="mb-0">Orders</h3>
                        <h6 class="text-muted">Orders Detail</h6>
                       <h4>1.View Orders</h4>
                       <p><i>In view order list we can see all orders list like <b>(i) total orders</b>,<b>(ii) pending orders:</b> are those orders which are not accept are assign to any provider and not started yet,<b>(iii) completed orders:</b>those orders which has been complete ,<b>(iv) accepted orders:</b> those orders which has benn accept by provider but not complete yet as well past due orders. <b>(v) past due orders:</b> are those orders which date has been passed but orders are not completed</i>
                       
                        <h4>2.Recurring Orders</h4>
                       <p><i>Recurring Orders are those orders which will automatically assign to provider after the specfic days which are set by customer while creating orders. Admin can cencel the recurring order by click on view detail and there is option to cancel order on view order detail page</i>

                        <h4>3.Cancel Orders</h4>
                       <p><i>These orders which are cancel by admin or customer</i>
                           <div class="fw-bold">1.View</div>
                       <p><i>List of all Cancel orders</i>
                       <div class="fw-bold">2.Refunded</div>
                        <p><i>Those orders which has been refunded to customer</i>
                         <div class="fw-bold">3.Under Review</div>
                        <p><i>Those order which are underreview still not refund to customer</i>
                    </div>
                </div>
                {{------------- Plugins -----------------}}
              <div id="plugins" class="content" role="tabpanel">
                    <div class="content-header">
                        <h3 class="mb-0">Plugins</h3>
                        <h6 class="text-muted">Plugins Detail</h6>
                        <p><i>Admin can update Stripe Credentials,Email Credentials,Google Signin Credentials and MessageBird Credentials</i>

                    </div>
                </div>

            {{-- ---------------- Cities -------------------- --}}
                <div id="cities" class="content" role="tabpanel">
                    <div class="content-header">
                         <h3 class="mb-0">Cities</h3>
                        <h6 class="text-muted">Cities Detail</h6>
                       <p><i>Admin can add list of cities and these cities will showing on home page of website.User can see our services available in these cities</i>

                    </div>
                </div>

                  <div id="generalsetting" class="content" role="tabpanel">
                    <div class="content-header">
                     <h3 class="mb-0">General Settings</h3>
                        <h6 class="text-muted">General Settings Detail</h6>
                        <h4>1.Lawn Mowing</h4>
                       <p><i>Admin will set and can change all value and prices about lawn mowing orders</i>
                       
                        <h4>2. Snow Plowing</h4>
                       <p><i>Admin will set and can change all value and prices about snow plowing orders</i>

                       <h4>2. Profile</h4>
                       <p><i>Admin can update his/her profile information</i>

                       <h4>2. Settings</h4>
                       <p><i>In which admin can set prices, radius as well minutes and these value apply on all jobs</i>


                    </div>
                </div>
                

                {{-- ------------------- Templest----------------------- --}}
                <div id="templates" class="content" role="tabpanel">
                    <div class="content-header">
                        <h5 class="mb-0">Templates</h5>
                       <h4>1.Email</h4>
                       <p><i>Admin will set and also can changes text of all email templates and when any email send to user against related queries so this template will send on email</i>
                       
                        <h4>2.SMS</h4>
                       <p><i>Admin will set and also can changes text of all email templates and when any email send to user against related queries so this template will send on SMS</i>

                    </div>
                </div>

                {{-- --------------- Promotions -------------------- --}}
                <div id="promotions" class="content" role="tabpanel">
                    <div class="content-header">
                          <h3 class="mb-0">Promotions</h3>
                        <h6 class="text-muted">Promotions Detail</h6>
                        <h4>1.Coupons Code</h4>
                       <p><i>In coupons code system admin create new coupons as well can also update coupons and users can use these coupons</i>
                       
                        <h4>2. Refferal System</h4>
                       <p><i>Refferal system in which admin give amount of refer and any user which register his/her account by any reffeance so amount will transfer to user whome by current user refer.</i>

                    </div>
                </div>


                {{-- --------------------- Help Center ---------------------------- --}}
                  <div id="helpcenter" class="content" role="tabpanel">
                    <div class="content-header">
                     <h3 class="mb-0">Help Center</h3>
                        <h6 class="text-muted">Help Center Detail</h6>
                      <h4>1.Supports</h4>
                       <p><i>In supports all questions of user will showing in admin panel and admin can response to any user against this question through email</i>

                    </div>
                </div>


                {{-- ---------------------- CompanySetting ----------------------- --}}
                <div id="companysetting" class="content" role="tabpanel">
                    <div class="content-header">
                        <h3 class="mb-0">Company Settings</h3>
                        <h6 class="text-muted">Company Settings Detail</h6>
                       <p><i>From company setting we can add and update name and logo of our website and this name and logo will apply ever where on website</i>

                    </div>
                </div>



                 {{-- ---------------------- Cms Setting ----------------------- --}}
                <div id="cmssetting" class="content" role="tabpanel">
                    <div class="content-header">
                         <h3 class="mb-0">Cms Settings</h3>
                        <h6 class="text-muted">Cms Settings Detail</h6>
                       <br>
                       <h4>1. Privacy Policy</h4>
                       <p><i>In privacy policy we will describe our policies about app</i>
                       
                        <h4>2. About App</h4>
                       <p><i>In which admin set description about app and these information will showing to providers and customers</i>
                       <h4>3. Faqs</h4>
                       <p><i>In Faqs thsese are queries of customer and providers.Admin answer to users against questions and these showing to thier dashboard</i>
                       
                       <div class="fw-bold">1. Customer</div>
                       <p><i>These faqs will showing to customer dashboard</i>
                       <div class="fw-bold">2. Provider</div>
                        <p><i>These faqs will showing to provider dashboard</i>
                       
                       <h4>4. Footer script code</h4>
                       <p><i>In this footer script code we have paste code which are in script and this script will apply on footer of website</i>
                       <h4>5. Terms & Conditions</h4>
                       <p><i>These client terms of service ("the client terms") describe your rights and responsibilities when using our online client portal or other platforms (the "services"). If you area client or an authorized user (defined below), these client terms govern your access and use of the services. ese client terms form a building "contract" between client and us. If you personally use our services, you acknowledge your understanding of the contract and agree to the contract on behalf of client.</i>
                    </div>
                </div>

                <div id="chat" class="content" role="tabpanel">
                    <div class="content-header">
                        <h3 class="mb-0">Chat</h3>
                        <h6 class="text-muted">Chat Detail</h6>
                        <p><i>In Chat system all orders id showing to admin and admin can see chat of both <b>Customer</b> and <b>Provider</b> against any order </i>
                        </p>

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

   
@endpush
