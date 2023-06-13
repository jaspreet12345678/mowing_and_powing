<form class="theme-form mega-form" action="{{ route('admin.plugins.update') }}" method="post">
    @csrf
    @method('put')
    <div class="">
        <div class="mb-3">
            <label class="col-form-label">API KEY</label>
            <input class="form-control" type="text" name="GOOGLE_MAPS_APIKEY" value="{{$env->get('GOOGLE_MAPS_APIKEY')}}">
        </div>
    </div>
    <div class="mt-5">
        <button class="btn btn-primary">Update</button>
    </div>
</form>
