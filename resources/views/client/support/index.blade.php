@extends('layouts.client')

@section('title',"Support")

@push('vendor-styles')

@endpush

@push('page-styles')

<style>
    .btn-green{
        background: #24B550;
        color: #ffffff;
        border: 1px solid ##24B550;
    }
</style>

@endpush

@section('body')

<!--- heading & li start --->
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Support</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">
                        <i class="icofont icofont-live-support fs-6"></i>
                    </a></li>
                    <li class="breadcrumb-item">Support</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Container-fluid chat-card starts-->
<div class="container-fluid">
    <div class="card border shadow">
        <div class="card-body">
            <div class="row">
                <div class="col-md-5 ">
                    <div class="card border h-100">
                        <div class="card-body px-4">
                            <form method="post">
                                @csrf
                                <h4 class="pb-2">Customer Support</h4>
                                <p>Facing an issue or want to clear things, write us down and will get back to you as soon as possible</p>
                                <div>
                                    <textarea name="detail" rows="5" cols="50" class="w-100 rounded-3 p-2 border-primary" placeholder="Tell us about your problem..." required></textarea>
                                </div>
                                <div class="text-center mt-4 ">
                                    <button class="btn btn-green w-50 mt-4 fw-normal">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="empty-box h-25"></div>
                    <div class="text-center">
                        <img src="{{ asset ('assets/images/customer-support.png') }}" alt="customer-support-img" width="60%">
                    </div>
                    <div class="empty-box h-25"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->




@endsection

@push('vendor-scripts')

@endpush

@push('page-scripts')

@endpush
