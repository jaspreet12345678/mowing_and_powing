<form class="theme-form needs-validation" novalidate="" action="{{ route('admin.generalsettings.snow-plowing.add_property') }}" method="post">
    @csrf
    <div class="">
        <div class="mb-3">
            <label class="col-form-label">Address<span class="text-danger">*</span></label>
            <input class="form-control" type="text" required name="address" placeholder="Enter Address here..." id="location">
            <input type="hidden" name="user_id" value="{{ $customer->id}}" >
            <input type="hidden" name="lat" id="lat">
            <input type="hidden" name="lng" id="lng">
        </div>

        <div class="mb-3">
            <label class="col-form-label">Select Category<span class="text-danger">*</span></label>
            <select name="category" class="form-control" name="category_id">
             <option value="lawn-mowing">LawnMowing</option>
             <option value="snow-plowing">SnowPlowing</option>
         </select>
            {{-- <input class="form-control" type="text" required name="address" placeholder="Enter Address here..." id="location"> --}}
        </div>
    </div>
    <div class="mt-5">
        <button class="btn btn-primary">Add</button>
    </div>
</form>

