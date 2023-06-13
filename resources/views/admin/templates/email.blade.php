@extends('layouts.admin')

@section('title','Email Templates')

@push('vendor-styles')
@endpush

@push('page-styles')
<style>
    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        background-color: #24695c;
        padding: 30px 0;
        text-align: center;
    }
    .nav-pills .nav-link {
        padding: 30px 0;
        text-align: center;
        border-bottom: 1px solid #cbc7c7;
        border-radius: 0;
        background-color: #fff;
    }
    .tabScrol {
        height: 550px;
        overflow: auto;
    }
</style>
@endpush

@section('body')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Email Templates</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a class="home-item" href="{{ route('admin.dashboard.index') }}"><i
                                data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Templates</li>
                    <li class="breadcrumb-item active">Email Templates</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 xl-100 ">
            <div class="row">
                <div class="col-sm-3 col-xs-12 tabScrol">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link {{ $template == 'test-email' ? 'active' : '' }}" id="v-pills-home-tab"
                            href="{{ route('admin.templates.email','test-email') }}" role="tab" aria-controls="v-pills-home"
                            aria-selected="true">Test Email</a>
                        <a class="nav-link {{ $template == 'notification-email' ? 'active' : '' }}"
                            id="v-pills-profile-tab" href="{{ route('admin.templates.email','notification-email') }}" role="tab"
                            aria-controls="v-pills-profile" aria-selected="false">Notification Email</a>
                        <a class="nav-link {{ $template == 'team-invitation-email' ? 'active' : '' }}"
                            id="v-pills-messages-tab" href="{{ route('admin.templates.email','team-invitation-email') }}" role="tab"
                            aria-controls="v-pills-messages" aria-selected="false">Team Invitation</a>
                        <a class="nav-link {{ $template == 'forgot-password-email' ? 'active' : '' }}"
                            id="v-pills-settings-tab" href="{{ route('admin.templates.email','forgot-password-email') }}" role="tab"
                            aria-controls="v-pills-settings" aria-selected="false">Forgot Password</a>

                        <a class="nav-link {{ $template == 'account-update-email' ? 'active' : '' }}"
                            id="v-pills-account-tab" href="{{ route('admin.templates.email','account-update-email') }}" role="tab"
                            aria-controls="v-pills-account" aria-selected="false">Account update</a>

                        <a class="nav-link {{ $template == 'invitation-email' ? 'active' : '' }}"
                            id="v-pills-invitation-tab" href="{{ route('admin.templates.email','invitation-email') }}" role="tab"
                            aria-controls="v-pills-invitation" aria-selected="false">Invitation</a>

                        <a class="nav-link {{ $template == 'verify-email' ? 'active' : '' }}"
                            id="v-pills-verify-email-tab" href="{{ route('admin.templates.email','verify-email') }}" role="tab"
                            aria-controls="v-pills-verify-email" aria-selected="false">Verify Email</a>

                        <a class="nav-link {{ $template == 'order-placed-email' ? 'active' : '' }}"
                            id="v-pills-order-placed-tab" href="{{ route('admin.templates.email','order-placed-email') }}" role="tab"
                            aria-controls="v-pills-order-placed" aria-selected="false">Order Placed</a>

                        <a class="nav-link {{ $template == 'invoice-send-email' ? 'active' : '' }}"
                            id="v-pills-invoice-send-tab" href="{{ route('admin.templates.email','invoice-send-email') }}" role="tab"
                            aria-controls="v-pills-invoice-send" aria-selected="false">invoice send</a>

                        <a class="nav-link {{ $template == 'invoice-paid-email' ? 'active' : '' }}"
                            id="v-pills-invoice-paid-tab" href="{{ route('admin.templates.email','invoice-paid-email') }}" role="tab"
                            aria-controls="v-pills-invoice-paid" aria-selected="false">invoice paid</a>

                        {{-- <a class="nav-link {{ $template == 'restock-notification-email' ? 'active' : '' }}"
                            id="v-pills-restock-tab" href="{{ route('admin.templates.email','restock-notification-email') }}" role="tab"
                            aria-controls="v-pills-restock" aria-selected="false">Restock Notification Email</a>

                        <a class="nav-link {{ $template == 'cron-report-email' ? 'active' : '' }}  border-0"
                            id="v-pills-report-mail-tab" href="{{ route('admin.templates.email','cron-report-email') }}" role="tab"
                            aria-controls="v-pills-report-mail" aria-selected="false">Cron Report Mail</a> --}}

                    </div>
                </div>


                <div class="col-sm-9 col-xs-12 card py-4 px-3">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade {{ $template == 'test-email' ? 'show active' : '' }}"
                            id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            <form action="{{ route('admin.templates.save-email-template','test-email') }}" method="post">
                                @csrf
                                <textarea id="{{ $template == 'test-email' ? 'editor1' : '' }}"
                                    name="template">{{ $templates->where('email_type','test-email')->first()->content ?? '' }}</textarea>
                                <div class="text-end mt-4">
                                    <input type="submit" class="btn btn-success" value="Update">
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade {{ $template == 'notification-email' ? 'show active' : '' }}"
                            id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <form action="{{ route('admin.templates.save-email-template','notification-email') }}" method="post">
                                @csrf
                                <textarea id="{{ $template == 'notification-email' ? 'editor1' : '' }}"
                                    name="template">{{ $templates->where('email_type','notification-email')->first()->content ?? '' }}</textarea>
                                <div class="text-end mt-4">
                                    <input type="submit" class="btn btn-success" value="Update">
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade {{ $template == 'team-invitation-email' ? 'show active' : '' }}"
                            id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <form action="{{ route('admin.templates.save-email-template','team-invitation-email') }}" method="post">
                                @csrf
                                <textarea id="{{ $template == 'team-invitation-email' ? 'editor1' : '' }}"
                                    name="template">{{ $templates->where('email_type','team-invitation-email')->first()->content ?? '' }}</textarea>
                                <div class="text-end mt-4">
                                    <input type="submit" class="btn btn-success" value="Update">
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade {{ $template == 'forgot-password-email' ? 'show active' : '' }}"
                            id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <form action="{{ route('admin.templates.save-email-template','forgot-password-email') }}" method="post">
                                @csrf
                                <textarea id="{{ $template == 'forgot-password-email' ? 'editor1' : '' }}"
                                    name="template">{{ $templates->where('email_type','forgot-password-email')->first()->content ?? '' }}</textarea>
                                <div class="text-end mt-4">
                                    <input type="submit" class="btn btn-success" value="Update">
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade {{ $template == 'account-update-email' ? 'show active' : '' }}"
                            id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <form action="{{ route('admin.templates.save-email-template','account-update-email') }}" method="post">
                                @csrf
                                <textarea id="{{ $template == 'account-update-email' ? 'editor1' : '' }}"
                                    name="template">{{ $templates->where('email_type','account-update-email')->first()->content ?? '' }}</textarea>
                                <div class="text-end mt-4">
                                    <input type="submit" class="btn btn-success" value="Update">
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade {{ $template == 'invitation-email' ? 'show active' : '' }}"
                            id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <form action="{{ route('admin.templates.save-email-template','invitation-email') }}" method="post">
                                @csrf
                                <textarea id="{{ $template == 'invitation-email' ? 'editor1' : '' }}"
                                    name="template">{{ $templates->where('email_type','invitation-email')->first()->content ?? '' }}</textarea>
                                <div class="text-end mt-4">
                                    <input type="submit" class="btn btn-success" value="Update">
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade {{ $template == 'verify-email' ? 'show active' : '' }}"
                            id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <form action="{{ route('admin.templates.save-email-template','verify-email') }}" method="post">
                                @csrf
                                <textarea id="{{ $template == 'verify-email' ? 'editor1' : '' }}"
                                    name="template">{{ $templates->where('email_type','verify-email')->first()->content ?? '' }}</textarea>
                                <div class="text-end mt-4">
                                    <input type="submit" class="btn btn-success" value="Update">
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade {{ $template == 'order-placed-email' ? 'show active' : '' }}"
                            id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <form action="{{ route('admin.templates.save-email-template','order-placed-email') }}" method="post">
                                @csrf
                                <textarea id="{{ $template == 'order-placed-email' ? 'editor1' : '' }}"
                                    name="template">{{ $templates->where('email_type','order-placed-email')->first()->content ?? '' }}</textarea>
                                <div class="text-end mt-4">
                                    <input type="submit" class="btn btn-success" value="Update">
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade {{ $template == 'invoice-send-email' ? 'show active' : '' }}"
                            id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <form action="{{ route('admin.templates.save-email-template','invoice-send-email') }}" method="post">
                                @csrf
                                <textarea id="{{ $template == 'invoice-send-email' ? 'editor1' : '' }}"
                                    name="template">{{ $templates->where('email_type','invoice-send-email')->first()->content ?? '' }}</textarea>
                                <div class="text-end mt-4">
                                    <input type="submit" class="btn btn-success" value="Update">
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade {{ $template == 'invoice-paid-email' ? 'show active' : '' }}"
                            id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <form action="{{ route('admin.templates.save-email-template','invoice-paid-email') }}" method="post">
                                @csrf
                                <textarea id="{{ $template == 'invoice-paid-email' ? 'editor1' : '' }}"
                                    name="template">{{ $templates->where('email_type','invoice-paid-email')->first()->content ?? '' }}</textarea>
                                <div class="text-end mt-4">
                                    <input type="submit" class="btn btn-success" value="Update">
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade {{ $template == 'restock-notification-email' ? 'show active' : '' }}"
                            id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <form action="{{ route('admin.templates.save-email-template','restock-notification-email') }}" method="post">
                                @csrf
                                <textarea id="{{ $template == 'restock-notification-email' ? 'editor1' : '' }}"
                                    name="template">{{ $templates->where('email_type','restock-notification-email')->first()->content ?? '' }}</textarea>
                                <div class="text-end mt-4">
                                    <input type="submit" class="btn btn-success" value="Update">
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade {{ $template == 'cron-report-email' ? 'show active' : '' }}"
                            id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <form action="{{ route('admin.templates.save-email-template','cron-report-email') }}" method="post">
                                @csrf
                                <textarea id="{{ $template == 'cron-report-email' ? 'editor1' : '' }}"
                                    name="template">{{ $templates->where('email_type','cron-report-email')->first()->content ?? '' }}</textarea>
                                <div class="text-end mt-4">
                                    <input type="submit" class="btn btn-success" value="Update">
                                </div>
                            </form>
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('vendor-scripts')
@endpush

@push('page-scripts')
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor1');
</script>
@endpush
