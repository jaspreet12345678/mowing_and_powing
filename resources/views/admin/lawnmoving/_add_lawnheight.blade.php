<form class="theme-form mega-form" action="{{ route('admin.generalsettings.lawnmoving.add-lawn-moving-height') }}" method="post">
    @csrf
    <div class="">
        <div class="mb-3">
         
            <label class="col-form-label">Name</label>
            <input class="form-control"  type="text" name="name" required>
            <label class="col-form-label">Price</label>
            <input class="form-control"  type="text" name="price" required>
             <label class="col-form-label">7 Days Price</label>
            <input class="form-control"  type="text" name="seven_days_price" required>
             <label class="col-form-label">10 Days Price</label>
            <input class="form-control"  type="text" name="ten_days_price" required>
             <label class="col-form-label">14 Days Price</label>
            <input class="form-control"  type="text" name="fourteen_days_price" required>
        </div>
    </div>
    <div class="mt-5">
        <button class="btn btn-primary">Add</button>
    </div>
</form>
