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
                    <a href="{{ url()->previous() }}">
                        < Back</a>
                </div>
                <div class="col-12 col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"> <a class="home-item" href="{{ route('admin.dashboard.index') }}"><i
                                    data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">General Setting</li>
                        <li class="breadcrumb-item active">Snow Plowing</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5>Questions</h5>
            <button data-bs-toggle='modal' data-bs-target='#modal-opener'
                data-url="{{ route('admin.generalsettings.snow-plowing.add-question') }}"
                style="font-size:12px; float: right">Add <i class="fa fa-plus"></i></button>
        </div>

        <div class="table-responsive">
            <table class="table">

                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Questions</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($snow_question as $key => $question)
                        <tr>
                            <th scope="row">{{ ++$key }}</th>
                            <td>{{ $question->question }}</td>
                            <td>
                                <button data-bs-toggle='modal' data-bs-target='#modal-opener'
                                    data-url="{{ route('admin.generalsettings.snow-plowing.edit-questions', ['id' => $question->id]) }}"
                                    class="btn btn-success">Edit</button>
                                <button
                                    data-url="{{ route('admin.generalsettings.snow-plowing.delete-question', ['id' => $question->id]) }}"
                                    id="delete-data" class="btn btn-danger">Delete</button>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('vendor-scripts')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
@endpush

@push('page-scripts')
@endpush
