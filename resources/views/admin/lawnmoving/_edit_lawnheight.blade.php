<form class="theme-form mega-form" action="{{ route('admin.generalsettings.lawnmoving.update-lawn-moving-height') }}" method="post">
    @csrf
    <div class="">
        <div class="mb-3">
         
            <label class="col-form-label">Name</label>
            <input class="form-control" value="{{$lawn_height->name}}" type="text" name="name" value="1">
            <label class="col-form-label">Price</label>
            <input class="form-control" value="{{$lawn_height->price}}" type="text" name="price" value="1">
             <label class="col-form-label">7 Days Price</label>
            <input class="form-control" value="{{$lawn_height->seven_days_price}}" type="text" name="seven_days_price" value="1">
             <label class="col-form-label">10 Days Price</label>
            <input class="form-control" value="{{$lawn_height->ten_days_price}}" type="text" name="ten_days_price" value="1">
             <label class="col-form-label">14 Days Price</label>
            <input class="form-control" value="{{$lawn_height->fourteen_days_price}}" type="text" name="fourteen_days_price" value="1">
             <input class="form-control" value="{{$lawn_height->id}}" type="hidden" name="id" value="1">
        </div>
    </div>
    <div class="mt-5">
        <button class="btn btn-primary">Update</button>
    </div>
</form>
