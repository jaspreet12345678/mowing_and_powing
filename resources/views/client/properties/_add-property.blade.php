<form class="theme-form needs-validation" novalidate="" action="{{ route('properties.add',$type) }}" method="post">
    @csrf
    <div class="">
        <div class="mb-3">
            <label class="col-form-label">Address<span class="text-danger">*</span></label>
            <input class="form-control" type="text" required name="address" placeholder="Enter Address here..." id="location">
            <input type="hidden" name="lat" id="lat">
            <input type="hidden" name="lng" id="lng">
        </div>
    </div>
    <div class="mt-5">
        <button class="btn btn-primary">Add</button>
    </div>
</form>

