<form class="theme-form mega-form" action="{{ route('admin.generalsettings.snow-plowing.update-drive-way') }}"
    method="post">
    @csrf

    <div class="">
        <div class="mb-3">
            <label class="col-form-label">Type</label>
            <input class="form-control" type="text" name="type"
                value="{{ isset($drive_way_data->type) ? $drive_way_data->type : '' }}">

            <label class="col-form-label">First 6 Car Price</label>
            <input class="form-control" type="text" name="on_first_6_cars"
                value="{{ isset($drive_way_data->on_first_6_cars) ? $drive_way_data->on_first_6_cars : '' }}">

            <label class="col-form-label">More Than 6 Car Price</label>
            <input class="form-control" type="text" name="on_more_than_6_cars"
                value="{{ isset($drive_way_data->on_more_than_6_cars) ? $drive_way_data->on_more_than_6_cars : '' }}">
            <input class="form-control" type="hidden" name="id"
                value="{{ isset($drive_way_data->id) ? $drive_way_data->id : '' }}">
        </div>
    </div>
    <div class="mt-5">
        <button class="btn btn-primary">Update</button>
    </div>
</form>
