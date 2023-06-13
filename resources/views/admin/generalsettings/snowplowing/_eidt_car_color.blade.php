<form class="theme-form mega-form"
    action="{{ isset($color->color_code) ? route('admin.generalsettings.snow-plowing.update-car-color') : route('admin.generalsettings.snow-plowing.add-car-color') }}"
    method="post">
    @csrf

    <div class="">
        <div class="mb-3">

            <label class="col-form-label">Color</label>
            <input class="form-control" type="text" name="name" value="{{ isset($color->name) ? $color->name : '' }}">

            <label class="col-form-label">Color Code</label>
            <input class="form-control" type="text" name="color_code"
                value="{{ isset($color->color_code) ? $color->color_code : '' }}">
            <input class="form-control" type="hidden" name="hidden_id" value="{{ isset($color->id) ? $color->id : '' }}">


        </div>
    </div>
    <div class="mt-5">
        <button class="btn btn-primary">Update</button>
    </div>
</form>
