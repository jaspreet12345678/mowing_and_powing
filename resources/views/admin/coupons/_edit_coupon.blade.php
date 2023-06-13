<form class="theme-form mega-form" action="{{ route('admin.coupon-code.update-coupon') }}" method="post">
    @csrf

    <div class="">
        <div class="mb-3">
            <label class="col-form-label">Coupon Name</label>
            <input class="form-control" type="text" name="name" required
                value="{{ isset($update_coupon->name) ? $update_coupon->name : '' }}">
        </div>
        <input type="hidden" name="hidden_id" value="{{$update_coupon->id}}">
        <br>
        <div class="row">
            <div class="col-md-3">
                <input type="radio" id="amount" {{$update_coupon->type == 1  ? 'checked' : ''}} name="type" value="1">
                <label for="age1">Amount</label>
            </div>
            <div class="col-md-6">
                <input type="radio" id="percentage"  name="type" {{$update_coupon->type == 2  ? 'checked' : ''}} value="2">
                <label for="age1">Percentage</label>
            </div>
        </div>

        <div class="mb-3 percentage_discount">
            <label class="col-form-label">Discount</label>
            <input class="form-control" type="text" name="discount" required
                value="{{ isset($update_coupon->discount) ? $update_coupon->discount : '' }}">
        </div>

        <div class="mb-3 amount_discount">
            <label class="col-form-label">Discount</label>
            <input class="form-control" placeholder="%"  type="text" name="perc_discount"
                value="">
        </div>

        <div class="mb-3">
            <label class="col-form-label">Services</label>
            <select class="form-control" name="service">
                <option value="1" {{$update_coupon->service == 1  ? 'selected' : ''}}>Lawn Mowing</option>
                <option value="2" {{$update_coupon->service == 2  ? 'selected' : ''}}>Snow Plowing</option>
                <option value="3" {{$update_coupon->service == 3      ? 'selected' : ''}}>Lawn Mowing and Snow Plowing</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="col-form-label">Description</label>
            <textarea type="text" required class="form-control" name="description" placeholder="Description">{{$update_coupon->description}}</textarea>
        </div>

        <div class="mb-3">
            <label class="col-form-label">Expiray Date</label>
            <input required class="form-control" type="date" name="valid_till"
                value="{{ isset($update_coupon->valid_till) ? $update_coupon->valid_till : '' }}">
        </div>


    </div>
    <div class="mt-5">
        <button class="btn btn-primary">Update</button>
    </div>
</form>
<script>
$(".amount_discount").attr("style", "display:none");

$("#percentage").click(function(){
$(".amount_discount").attr("style", "display:block");
$(".percentage_discount").attr("style", "display:none");
});

$("#amount").click(function(){
$(".amount_discount").attr("style", "display:none");
$(".percentage_discount").attr("style", "display:block");
});
</script>
