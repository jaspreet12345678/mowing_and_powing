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
                        <li class="breadcrumb-item active">Lawn Mowing</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5>Questions</h5>
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

                    @foreach ($question_data as $key => $question)
                        <tr>
                            <th scope="row">{{ ++$key }}</th>
                            <td>{{ $question->question }}</td>
                            <td>
                                {{-- <span type="btn"  data-bs-toggle='modal' data-bs-target='#modal-opener' data-url="{{ route('admin.lawnmoving.edit-questions', ['id' => $question->id]) }}"><i class="fa fa-pencil"></i></span>  --}}
                                {{-- <span type="btn"  data-bs-toggle='modal' id="delete-data"  data-url="{{ route('admin.lawnmoving.delete-question',['id' => $question->id]) }}"><i class="fa fa-trash"></i></span> --}}
                                <button data-bs-toggle='modal' data-bs-target='#modal-opener'
                                    data-url="{{ route('admin.generalsettings.lawnmoving.edit-questions', ['id' => $question->id]) }}"
                                    class="btn btn-success">Edit</button>
                                <button data-url="{{ route('admin.generalsettings.lawnmoving.delete-question', ['id' => $question->id]) }}"
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
