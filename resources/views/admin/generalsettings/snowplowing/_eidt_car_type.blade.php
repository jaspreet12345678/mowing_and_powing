<form class="theme-form mega-form"
    action="{{ isset($cartype->name) ? route('admin.generalsettings.snow-plowing.update-car-type') : route('admin.generalsettings.snow-plowing.add-car-type') }}"
    method="post">
    @csrf

    <div class="">
        <div class="mb-3">

            <label class="col-form-label">Car Type</label>
            <input class="form-control" placeholder="enter car type" type="text" name="name"
                value="{{ isset($cartype->name) ? $cartype->name : '' }}">

            <label class="col-form-label">Price</label>
            <input class="form-control" placeholder="enter price" type="text" name="price"
                value="{{ isset($cartype->price) ? $cartype->price : '' }}">
            <input class="form-control" type="hidden" name="car_id"
                value="{{ isset($cartype->id) ? $cartype->id : '' }}">
            <input class="form-control" type="hidden" name="category_id" value="2">
            <input class="form-control" type="hidden" name="type" value="0">



        </div>
    </div>
    <div class="mt-5">
        <button class="btn btn-primary">{{ isset($cartype->name) ? 'Update' : 'Add' }}</button>
    </div>
</form>
