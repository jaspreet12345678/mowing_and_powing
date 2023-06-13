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
                data-url="{{ route('admin.generalsettings.snow-plowing.view-car-color') }}"
                style="font-size:12px; float: right">Add <i class="fa fa-plus"></i></button>
        </div>

        <div class="table-responsive">
            <table class="table">

                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Color</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($car_colors as $key => $colors)
                        <tr>
                            <th scope="row">{{ ++$key }}</th>
                            <td>{{ $colors->name }}</td>
                            <td>
                                {{-- <span type="btn"  data-bs-toggle='modal' data-bs-target='#modal-opener' data-url="{{ route('admin.lawnmoving.edit-questions', ['id' => $question->id]) }}"><i class="fa fa-pencil"></i></span>  --}}
                                {{-- <span type="btn"  data-bs-toggle='modal' id="delete-data"  data-url="{{ route('admin.lawnmoving.delete-question',['id' => $question->id]) }}"><i class="fa fa-trash"></i></span> --}}
                                <button data-bs-toggle='modal' data-bs-target='#modal-opener'
                                    data-url="{{ route('admin.generalsettings.snow-plowing.edit-car-color', ['id' => $colors->id]) }}"
                                    class="btn btn-success">Edit</button>
                                <button
                                    data-url="{{ route('admin.generalsettings.snow-plowing.delete-car-color', ['id' => $colors->id]) }}"
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
