<form class="theme-form mega-form" action="{{ route('admin.generalsettings.snow-plowing.update-snow-depth') }}"
    method="post">
    @csrf

    <div class="">
        <div class="mb-3">
            <label class="col-form-label">Type</label>
            <input class="form-control" readonly type="text" name="type"
                value="{{ isset($snow_depth->type) ? $snow_depth->type : '' }}">

            <label class="col-form-label">Name</label>
            <input class="form-control" readonly type="text" name="name"
                value="{{ isset($snow_depth->name) ? $snow_depth->name : '' }}">

            <label class="col-form-label">Price</label>
            <input class="form-control" type="text" name="price"
                value="{{ isset($snow_depth->price) ? $snow_depth->price : '' }}">

            <input class="form-control" type="hidden" name="id"
                value="{{ isset($snow_depth->id) ? $snow_depth->id : '' }}">
        </div>
    </div>
    <div class="mt-5">
        <button class="btn btn-primary">Update</button>
    </div>
</form>
