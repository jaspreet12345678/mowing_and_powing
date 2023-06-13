{{-- <form class="theme-form e-commerce-form row needs-validation" id="add-card-form" novalidate action="{{route('payments.add-card')}}" method="post">
    @csrf
    <div class="mb-3 col-sm-12 p-r-0">
        <input class="form-control" type="number" required name="card_number" placeholder="Enter card number" >
    </div>
    <div class="mb-3 col-sm-6">
        <input class="form-control" type="number" required name="exp_month" placeholder="MM" >
    </div>
    <div class="mb-3 col-sm-6 p-r-0">
        <input class="form-control" type="number" required name="exp_year" placeholder="YYYY" >
    </div>
    <div class="mb-3 col-sm-12 p-r-0">
        <input class="form-control" type="number" required name="cvv" placeholder="CVV" >
    </div>
    <input type="hidden" required name="order_id" value="{{ $order_id ?? '' }}" >
    <input type="hidden" required name="service_type" value="{{ $type ?? '' }}" >
    <input type="hidden" required name="service" value="{{ $service ?? '' }}" >

    <div class="col-12 text-center mt-5">
        <button class="btn btn-primary btn-block w-50" id="card-save-btn">Save</button>
    </div>
</form> --}}

<form class="needs-validation mt-3" novalidate id="add-card-form" novalidate action="{{route('payments.add-card')}}" method="post">
    @csrf
    <div class="card">
    <div class="card-header px-4 py-2 border">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12 pe-lg-0">
                <div class="pt-3 heading">
                    <span class="fs-6">CREDIT/DEBIT CARD</span>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12 stripe-img px-xl-2 px-lg-0">
                <img src="{{ asset('assets/images/logo-stripe.png') }}" alt="stripe-logo-img" width="150px" class="pe-1">
            </div>
        </div>
        {{-- <h6 class="mb-0">CREDIT/DEBIT CARD</h6> --}}
    </div>

    <div class="card-body px-4 border">
        <div class="row g-3">
            <div class="col-xl-6 col-12">
                <label for="validationCustom01" class="div-label fw-bold">First name (Optional)</label>
                <input type="text" class="form-control" id="validationCustom01" name="first_name" value="{{ $activeUser->first_name }}" >
                {{-- <div class="valid-feedback">
                    Looks good!
                </div> --}}
            </div>
            <div class="col-xl-6 col-12">
                <label for="validationCustom01" class="div-label fw-bold">Last name (Optional)</label>
                <label for="validationCustom02" class="form-label fw-bold"></label>
                <input type="text" class="form-control" id="validationCustom02" name="last_name" value="{{ $activeUser->last_name }}" >
                {{-- <div class="valid-feedback">
                    Looks good!
                </div> --}}
            </div>
            <div class="col-xl-7 col-12">
                <label for="validationCustom03" class="form-label fw-bold">Card
                    number <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="validationCustom03" name="card_number" placeholder=".... .... .... ...."
                    required>
                <div class="invalid-feedback">
                    Please provide a card number.
                </div>
            </div>
            <div class="col-xl-5 col-12">
                <label for="validationCustom04" class="form-label fw-bold">CVV <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="validationCustom04" name="cvv" placeholder="..." required>
                <div class="invalid-feedback">
                    Please provide a cvv.
                </div>
            </div>
            <div class="col-xl-7 col-12 mt-xl-4">
                <div class="row">
                    <div class="col-xl-4 pe-0">
                        <h6 class="mb-0 fs-14 fw-bold mt-1 pt-xl-2">Valid until <span class="text-danger">*</span></h6>
                    </div>
                    <div class="col-xl-8">
                        <input type="text" class="form-control mt-xl-0 mt-3" id="validationCustom04" name="exp_month" placeholder="Month" required>
                        <div class="invalid-feedback">
                            Please provide a month.
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-12 mt-xl-4">
                <input type="text" class="form-control" id="validationCustom04" name="exp_year" placeholder="Year" required>
                <div class="invalid-feedback">
                    Please provide a year.
                </div>
            </div>
        </div>
    </div>

    <div class="card-footer px-0 border-0 text-center">
        <input type="hidden" required name="order_id" value="{{ $order_id ?? '' }}" >
        <input type="hidden" required name="service_type" value="{{ $type ?? '' }}" >
        <input type="hidden" required name="service" value="{{ $service ?? '' }}" >
        <button class="btn btn-green w-50" type="submit">Submit</button>
    </div>
    </div>
</form>


<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>

<script>
    $('#add-card-form').on('submit',function(e){
        e.preventDefault();
        $('#card-save-btn').prop('disabled', true);
        $.ajax({
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            url: "{{ route('payments.add-card') }}",
            type: 'post',
            data : $(this).serialize(),
            success: function(res){
                if(typeof res != 'string' && !res.success){
                    errorMessage(res.message)
                }else {
                    $('#summary').html(res)
                }
                $('#modal-opener').modal('hide');
            },
            error: function(err){
                errorMessage(err.responseJSON)
                $('#card-save-btn').prop('disabled', false);
            }
        })
    })
</script>
