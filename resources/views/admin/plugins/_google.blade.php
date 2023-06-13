<form class="theme-form mega-form" action="{{ route('admin.plugins.update') }}" method="post">
    @csrf
    @method('put')
    <div class="">
        <div class="mb-3">
            <label class="col-form-label">Client ID</label>
            <input class="form-control" type="text" name="GOOGLE_CLIENT_ID" value="{{$env->get('GOOGLE_CLIENT_ID')}}">
        </div>
        <div class="mb-3">
            <label class="col-form-label">Client SECRET</label>
            <input class="form-control" type="text" name="GOOGLE_CLIENT_SECRET" value="{{$env->get('GOOGLE_CLIENT_SECRET')}}">
        </div>
    </div>
    <div class="mt-5">
        <button class="btn btn-primary">Update</button>
    </div>
</form>
