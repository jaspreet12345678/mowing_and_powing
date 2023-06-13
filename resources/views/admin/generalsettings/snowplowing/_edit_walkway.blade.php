<form class="theme-form mega-form" action="{{ route('admin.generalsettings.snow-plowing.update-walk-way') }}"
    method="post">
    @csrf

    <div class="">
        <div class="mb-3">
            <label class="col-form-label">Type</label>
            <input class="form-control" readonly type="text" name="type"
                value="{{ isset($walk_way_data->type) ? $walk_way_data->type : '' }}">

            <label class="col-form-label">Name</label>
            <input class="form-control" readonly type="text" name="name"
                value="{{ isset($walk_way_data->name) ? $walk_way_data->name : '' }}">

            <label class="col-form-label">Price</label>
            <input class="form-control" type="text" name="price"
                value="{{ isset($walk_way_data->price) ? $walk_way_data->price : '' }}">

            <input class="form-control" type="hidden" name="id"
                value="{{ isset($walk_way_data->id) ? $walk_way_data->id : '' }}">
        </div>
    </div>
    <div class="mt-5">
        <button class="btn btn-primary">Update</button>
    </div>
</form>
