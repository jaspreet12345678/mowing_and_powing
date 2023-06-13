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
            <h5>Corner Lot
            </h5>
        </div>

        <div class="table-responsive">
            <table class="table">
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

                    <form class="theme-form mega-form" action="{{ route('admin.generalsettings.lawnmoving.update-cornerlot') }}"
                        method="post">
                        @csrf
                        @method('put')
                        <tr>
                        <input type="hidden" value="{{$corner_data->id}}" name="hidden_id">
                            <th scope="row">1</td>
                            <td>One time price</td>
                            <td>{{ $corner_data->price }}</td>
                            <td><input type="text" name="price" value={{ $corner_data->price }}></td>
                            <td> <button type="submit" class="btn btn-success">update</button></td>

                        </tr>
                        <tr>
                            <th>2</th>
                            <td>7 Days price</td>
                            <td>{{ $corner_data->seven_days_price }}</td>
                            <td><input type="text" name="seven_days_price" value={{ $corner_data->seven_days_price }}></td>
                            <td> <button type="submit" class="btn btn-success">update</button></td>

                        </tr>
                        <tr>
                            <th>3</th>
                            <td>10 Days price</td>
                            <td>{{ $corner_data->ten_days_price }}</td>
                            <td><input type="text" name="ten_days_price" value={{ $corner_data->ten_days_price }}></td>
                            <td> <button type="submit" class="btn btn-success">update</button></td>

                        </tr>

                        <tr>
                            <th>4</th>
                            <td>14 Days price</td>
                            <td>{{ $corner_data->fourteen_days_price }}</td>
                            <td><input type="text" name="fourteen_days_price" value={{$corner_data->fourteen_days_price }}></td>
                            <td> <button type="submit" class="btn btn-success">update</button></td>

                        </tr>
                    </form>
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
