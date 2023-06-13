@extends('layouts.admin')

@section('title', 'Admins')

@push('vendor-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
@endpush

@push('page-styles')
@endpush

@section('body')
 <style>
    .cke_contents{
        height: 600px !important;
    }
</style>
<script src="https://cdn.ckeditor.com/4.20.1/full/ckeditor.js"></script>
<div class="row">
    <div class="col-md-12 mt-5">
        <div class="card" style="height: 1000px;">
            <div class="card-body">
                <form method="post" action="{{ route('admin.store-footer-script')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label><strong>Footer Script Code:</strong></label>
                        <input type="hidden" name="id" value="{{isset( $descriprtion->id) ?  $descriprtion->id : '  '}}">
                        <textarea name="editor1">
                        {{ isset( $descriprtion->description) ?  $descriprtion->description : '  ' }} 
                        </textarea>
                    </div>
                    <div class="form-group text-center" style="margin-left: 93%; margin-top: 2%;">
                        <button type="submit" class="btn btn-success btn-lg">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    CKEDITOR.replace('editor1');
</script>
@endsection

@push('vendor-scripts')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
@endpush

@push('page-scripts')
  
@endpush
