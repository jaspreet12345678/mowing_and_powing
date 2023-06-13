<form class="theme-form mega-form" action="{{ route('admin.generalsettings.lawnmoving.update-fence') }}" method="post">
    @csrf
    <div class="">
        <div class="mb-3">
         
            <label class="col-form-label">Name</label>
            <input class="form-control" value="{{$fence_data->name}}" type="text" name="name" value="1">
            <label class="col-form-label">Price</label>
            <input class="form-control" value="{{$fence_data->price}}" type="text" name="price" value="1">
             <label class="col-form-label">7 Days Price</label>
            <input class="form-control" value="{{$fence_data->seven_days_price}}" type="text" name="seven_days_price" value="1">
             <label class="col-form-label">10 Days Price</label>
            <input class="form-control" value="{{$fence_data->ten_days_price}}" type="text" name="ten_days_price" value="1">
             <label class="col-form-label">14 Days Price</label>
            <input class="form-control" value="{{$fence_data->fourteen_days_price}}" type="text" name="fourteen_days_price" value="1">
             <input class="form-control" value="{{$fence_data->id}}" type="hidden" name="id" value="1">
        </div>
    </div>
    <div class="mt-5">
        <button class="btn btn-primary">Update</button>
    </div>
</form>
