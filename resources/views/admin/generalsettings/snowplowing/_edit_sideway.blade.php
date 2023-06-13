<form class="theme-form mega-form" action="{{ route('admin.generalsettings.snow-plowing.update-side-walk') }}"
    method="post">
    @csrf

    <div class="">
        <div class="mb-3">


              <label class="col-form-label">Type</label>
            <input class="form-control" readonly type="text" name="type"
                value="{{ isset($side_walk_data->type) ? $side_walk_data->type : '' }}">

            <label class="col-form-label">Name</label>
            <input class="form-control" readonly type="text" name="name"
                value="{{ isset($side_walk_data->name) ? $side_walk_data->name : '' }}">

            <label class="col-form-label">Price</label>
            <input class="form-control" type="text" name="price"
                value="{{ isset($side_walk_data->price) ? $side_walk_data->price : '' }}">

            <input class="form-control" type="hidden" name="id"
                value="{{ isset($side_walk_data->id) ? $side_walk_data->id : '' }}">


        </div>
    </div>
    <div class="mt-5">
        <button class="btn btn-primary">Update</button>
    </div>
</form>
