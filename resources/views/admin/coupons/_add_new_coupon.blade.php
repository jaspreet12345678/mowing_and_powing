
<form class="theme-form mega-form" action="{{ route('admin.coupon-code.store') }}" method="post">
    @csrf

    <div class="">
        <div class="mb-3">
            <label class="col-form-label">Coupon Name</label>
            <input class="form-control" required type="text" name="name"
                value="">
        </div>
        <br>
        <div class="row">
            <div class="col-md-3">
                <input type="radio" id="amount" required  checked name="type" value="1">
                <label for="age1">Amount</label>
            </div>
            <div class="col-md-6">
                <input type="radio" id="percentage" required name="type" value="2">
                 <label for="age1">Percentage</label>
            </div>
        </div>

       
        <div class="mb-3 percentage_discount">
            <label class="col-form-label">Discount</label>
            <input class="form-control" placeholder="$"  type="text" name="discount"
                value="">
        </div>
        <div class="mb-3 amount_discount">
            <label class="col-form-label">Discount</label>
            <input class="form-control" placeholder="%"  type="text" name="perc_discount"
                value="">
        </div>

        <div class="mb-3">
            <label class="col-form-label">Services</label>
            <select class="form-control" name="service">
                <option value="1">Lawn Mowing</option>
                <option value="2">Snow Plowing</option>
                <option value="3">Lawn Mowing and Snow Plowing</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="col-form-label">Description</label>
            <textarea type="text" required class="form-control" name="description" placeholder="Description"></textarea>
        </div>

        <div class="mb-3">
            <label class="col-form-label">Expiray Date</label>
            <input required  class="form-control" type="date" name="valid_till"
                value="">
        </div>


    </div>
    <div class="mt-5">
        <button class="btn btn-primary">Add</button>
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
