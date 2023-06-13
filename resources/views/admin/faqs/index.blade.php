@extends('layouts.admin')

@section('title', 'Admins')

@push('vendor-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
@endpush

@push('page-styles')
@endpush

@section('body')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-sm-6">
                    @if ($faq_type == 'customer')
                        <h3>Customer Faqs</h3>
                    @else
                        <h3>Provider Faqs</h3>
                    @endif()
                </div>
                <div class="col-12 col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"> <a class="home-item" href="{{ route('admin.dashboard.index') }}"><i
                                    data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">FAQ</li>
                        <li class="breadcrumb-item active">Index</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" value="{{ $faq_type }}" id="faq_type">
    <div class="container-fluid user-card">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    {{-- <div class="form-group text-center" style="margin-left: 80%; margin-top: 1%;">
                        <a href="{{ route('admin.faqs.add-faq',['type'=>$faq_type]) }}"> <button type="submit"
                                class="btn btn-primary btn-lg">Add New</button></a>
                    </div> --}}
                    <span type="btn" data-title="Add Faq" style="margin-left: 85%; margin-top: 1%;" class="btn btn-primary btn-lg" data-bs-toggle='modal' data-bs-target='#modal-opener' data-url="{{ route('admin.faqs.add-faq',['type'=>$faq_type]) }}">Add New</i></span>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display datatables" id="orders-datatable">

                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Question</th>
                                        <th>Answer</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('vendor-scripts')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
@endpush

@push('page-scripts')
    <script>
        $(function() {
            var status = $("#faq_type").val();

            var i = 1;
            var url = "{{ route('admin.faqs.get_faq', ':id') }}";
            url = url.replace(':id', status);

            var table = $('#orders-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: url,
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'question',
                        name: 'question'
                    },
                    {
                        data: 'answer',
                        name: 'answer'
                    },
                    {
                        data: 'action',
                        name: 'action',
                    },
                ]
            });

        });
    </script>
@endpush
