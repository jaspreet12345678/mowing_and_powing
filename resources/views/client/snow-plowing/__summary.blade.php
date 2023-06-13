<style>
    .remove-discount {
        cursor: pointer;
    }
</style>

<div class="card rounded boxShadow py-4 px-3">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-12">

            <p>Service Details </p>

            <div class="card">
                <ul class="list-group">
                    <li
                        class="list-group-item text-center bg-primary py-4 px-4 mb-3">
                        Service for {{ $type }}<span class=""></span></li>
                    @if($order->subcategory_id)
                        <li
                            class="list-group-item d-flex justify-content-between align-items-center py-2 px-4 border-bottom-0">
                            Car Type<span class="text-primary">{{ ucfirst($order->car->name) }}</span></li>
                    @endif
                    @if($order->color_id)
                        <li
                            class="list-group-item d-flex justify-content-between align-items-center py-2 px-4 border-bottom-0">
                            Color<span class="text-primary">{{ ucfirst($order->color->name) }}</span></li>
                    @endif
                    @if($order->car_number)
                        <li
                            class="list-group-item d-flex justify-content-between align-items-center py-2 px-4 border-bottom-0">
                            Plate number<span class="text-primary">{{ $order->car_number }}</span></li>
                    @endif
                    <li class="list-group-item d-flex justify-content-between align-items-center py-2 px-4 border-bottom-0">
                        Date<span class="text-primary">{{ $order->date }}</span></li>
                    <li
                        class="list-group-item d-flex justify-content-between align-items-center py-2 px-4">
                        Schedule time<span class="text-primary">{{ $order->schedule->name }} ({{ $order->schedule->time }})</span></li>
                </ul>
            </div>


            <div class="card">
                <ul class="list-group">
                    <li
                        class="list-group-item d-flex justify-content-between align-items-center bg-primary py-4 px-4">
                        Service<span class="">Amount</span></li>
                    @if ($order->subcategory_amount)
                        <li
                            class="list-group-item d-flex justify-content-between align-items-center py-4 px-4">
                            Car Snow Removal<span class="">${{ $order->subcategory_amount }}</span></li>
                    @endif
                    @if ($order->driveway_amount)
                        <li
                            class="list-group-item d-flex justify-content-between align-items-center py-4 px-4">
                            Driveway ({{ $order->driveway }} cars)<span class="">${{ $order->driveway_amount }}</span></li>
                    @endif
                    @if ($order->snow_depth_amount)
                        <li
                            class="list-group-item d-flex justify-content-between align-items-center py-4 px-4">
                            Snow Depth ({{ $order->snowDepth->name }})<span class="">${{ $order->snow_depth_amount }}</span></li>
                    @endif
                    @if ($order->sidewalk_amount)
                        <li class="list-group-item d-flex justify-content-between align-items-center py-4 px-4">
                        Sidewalk<span class="">${{ $order->sidewalk_amount }}</span></li>
                    @endif
                    @if ($order->walkway_amount)
                        <li class="list-group-item d-flex justify-content-between align-items-center py-4 px-4">
                            Walkway<span class="">${{ $order->walkway_amount }}</span></li>
                    @endif
                    <li
                        class="list-group-item d-flex justify-content-between align-items-center py-4 px-4">
                        Admin fees<span class="">${{ $order->admin_fee }}</span></li>

                    <li
                        class="list-group-item d-flex justify-content-between align-items-center py-4 px-4">
                        Tax fees<span class="">${{ $order->tax }}</span></li>
                    @if ($order->discount_amount)
                        <li class="list-group-item d-flex justify-content-between align-items-center py-4 px-4 text-success">
                            Discount <span class=""> <span class="text-danger me-3 f-12 remove-discount">Remove discount</span> -${{ $order->discount_amount ?? 0 }}</span></li>
                    @endif
                    @if ($order->tip)
                        <li class="list-group-item d-flex justify-content-between align-items-center py-4 px-4">
                            Tip <span class="">${{ $order->tip }}</span></li>
                    @endif
                    <div class="card rounded-0 px-4 py-3 mb-0 border border-top-0">
                        <li
                            class="list-group-item bglightBlue d-flex justify-content-between align-items-center boxShadow py-2 px-4 rounded-0">
                            Total<span class="">${{ number_format((float)$order->grand_total, 2, '.', ''); }}</span>
                        </li>
                    </div>
                </ul>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12 col-12 d-flex flex-column justify-content-between">
            <div>
                <div class="px-4">
                    <p>Tip your service provider</p>
                    <select class="form-select boxShadow shadow-none selectBox bgGray" id="tip">
                        @php
                            $tip1 = round($order->total_amount/100 * 10,2);
                            $tip2 = round($order->total_amount/100 * 15,2);
                            $tip3 = round($order->total_amount/100 * 20,2);
                            $tip4 = round($order->total_amount/100 * 25,2);
                        @endphp
                        <option value="0">Enter tip amount</option>
                        <option value="{{ $tip1 }}" data-percentage="10" {{ $order->tip == $tip1 ? 'selected' : '' }}>10% (${{ $tip1 }})</option>
                        <option value="{{ $tip2 }}" data-percentage="15" {{ $order->tip == $tip2 ? 'selected' : '' }}>15% (${{ $tip2 }})</option>
                        <option value="{{ $tip3 }}" data-percentage="20" {{ $order->tip == $tip3 ? 'selected' : '' }}>20% (${{ $tip3 }})</option>
                        <option value="{{ $tip4 }}" data-percentage="25" {{ $order->tip == $tip4 ? 'selected' : '' }}>25% (${{ $tip4 }})</option>
                    </select>

                    @if (!$order->discount_amount)
                        <div class="card boxShadow rounded py-1 px-1 mb-1 bgGray mt-3">
                            <div class="d-flex">
                                <div class="p-2 mt-1">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="19.668"
                                        height="18.879" viewBox="0 0 19.668 18.879">
                                        <g id="Group_4069" data-name="Group 4069"
                                            transform="translate(-578.434 -324.771)">
                                            <path id="Path_13644" data-name="Path 13644"
                                                d="M838.93,570.372a1.009,1.009,0,1,0,1.018,1.012A1.018,1.018,0,0,0,838.93,570.372Z"
                                                transform="translate(-248.109 -234.829)" fill="#d72323" />
                                            <path id="Path_13645" data-name="Path 13645"
                                                d="M722.319,465.7a1.007,1.007,0,0,0,1-1.006,1.009,1.009,0,1,0-2.019,0A1.021,1.021,0,0,0,722.319,465.7Z"
                                                transform="translate(-136.598 -132.822)" fill="#d72323" />
                                            <path id="Path_13646" data-name="Path 13646"
                                                d="M598.1,334.211a1.11,1.11,0,0,0-.362-.818c-.418-.437-.838-.874-1.267-1.3a1.144,1.144,0,0,1-.365-.783,1.521,1.521,0,0,1,.021-.219c.1-.59.15-1.187.253-1.776a1.335,1.335,0,0,0,.02-.291.974.974,0,0,0-.267-.737,1.148,1.148,0,0,0-.682-.315l-1.832-.321a1.092,1.092,0,0,1-.826-.613c-.28-.545-.571-1.084-.857-1.626a1.153,1.153,0,0,0-.436-.506.966.966,0,0,0-.943-.02c-.551.268-1.107.527-1.649.811a1.3,1.3,0,0,1-1.293,0c-.517-.271-1.045-.519-1.57-.773a.983.983,0,0,0-1.444.483c-.264.5-.546,1-.789,1.513a1.3,1.3,0,0,1-1.08.774c-.556.078-1.108.185-1.66.285a.973.973,0,0,0-.923.854,1.1,1.1,0,0,0-.006.365c.089.636.163,1.274.265,1.907a1.5,1.5,0,0,1,.019.2,1.155,1.155,0,0,1-.372.8c-.425.421-.838.853-1.252,1.285a1.111,1.111,0,0,0,0,1.651c.414.432.827.864,1.252,1.285a1.156,1.156,0,0,1,.372.8,1.5,1.5,0,0,1-.019.2c-.1.633-.176,1.272-.265,1.907a1.1,1.1,0,0,0,.006.365.973.973,0,0,0,.923.854c.553.1,1.1.207,1.66.285a1.3,1.3,0,0,1,1.08.774c.243.514.525,1.009.789,1.513a.983.983,0,0,0,1.444.483c.525-.254,1.054-.5,1.57-.773a1.3,1.3,0,0,1,1.293,0c.543.284,1.1.542,1.649.811a.966.966,0,0,0,.943-.02,1.152,1.152,0,0,0,.436-.506c.286-.542.577-1.081.857-1.626a1.092,1.092,0,0,1,.826-.613l1.832-.321a1.147,1.147,0,0,0,.682-.315.974.974,0,0,0,.267-.737,1.335,1.335,0,0,0-.02-.291c-.1-.589-.155-1.186-.253-1.776a1.523,1.523,0,0,1-.021-.219,1.143,1.143,0,0,1,.365-.783c.429-.427.849-.863,1.267-1.3A1.11,1.11,0,0,0,598.1,334.211Zm-14.308-2.347a1.916,1.916,0,1,1,1.925,1.917A1.925,1.925,0,0,1,583.793,331.864Zm1.332,6.328a1.426,1.426,0,0,1-.189.181.455.455,0,0,1-.566-.023.43.43,0,0,1-.064-.575c.139-.186.3-.355.458-.527q3.211-3.507,6.424-7.013a1.457,1.457,0,0,1,.2-.2.434.434,0,0,1,.476-.023.407.407,0,0,1,.224.327.616.616,0,0,1-.22.481l-1.624,1.773Zm5.672.273a1.913,1.913,0,1,1,1.946-1.9A1.921,1.921,0,0,1,590.8,338.465Z"
                                                transform="translate(0 0)" fill="#d72323" />
                                        </g>
                                    </svg>

                                </div>
                                <input class="form-control bg-transparent border-0 f-14" id="coupon-code" type="text" name="text" placeholder="Add promo code" required>
                                <div class="priceTxtWhite w-25">
                                    <button type="button" class="btn px-0 pt-2" id="apply-coupon">Apply</button>
                                </div>
                            </div>
                        </div>
                    @else
                        <p class="text-success mt-4 h5">Coupon already applied</p>
                    @endif
                </div>
                <li
                    class="list-group-item bglightBlue mt-4 d-flex justify-content-between align-items-center boxShadow py-2 px-4 rounded-0">
                    Grand Total<span class="">${{ number_format((float)$order->grand_total, 2, '.', ''); }}</span>
                </li>
            </div>
            @if((auth()->id()))
                <div class="text-end">
                    @php
                    $wallet = App\Models\Wallet::whereUserId(auth()->id())->first();
                    $defaultCard = App\Models\Card::whereUserId(auth()->id())->whereIsDefault("1")->first();
                    @endphp
                    <div class="list-group-item my-4 d-flex justify-content-between align-items-center boxShadow py-3 px-4 rounded border-0">
                        M&P wallet balance:
                        <span class="">
                            <span>${{ $wallet->amount }}</span>
                        </span>
                    </div>
                    @if ($defaultCard)
                    <div class="list-group-item my-4 d-flex justify-content-between align-items-center boxShadow py-3 px-4 rounded border-0">
                        Default Card number:
                        <span class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="36.084" height="11.553" viewBox="0 0 36.084 11.553">
                                <g id="Layer_2" transform="translate(-6.7 -23.8)">
                                    <path id="Path_13621" data-name="Path 13621" d="M26.354,24.1,24.5,35.367h2.924L29.278,24.1Z" transform="translate(-5.106 -0.086)" fill="#0275d8" />
                                    <path id="Path_13622" data-name="Path 13622" d="M48.448,24.1h0a1.4,1.4,0,0,0-1.5.927L42.6,35.439h3.066s.5-1.426.642-1.711h3.708c.071.428.357,1.711.357,1.711h2.71L50.73,24.1Zm-1.355,7.274c.214-.642,1.141-3.138,1.141-3.138l.357-1.07h0l.214,1s.57,2.71.713,3.28H47.093Z" transform="translate(-10.299 -0.086)" fill="#0275d8" />
                                    <path id="Path_13623" data-name="Path 13623" d="M37.019,28.578c-1-.5-1.64-.856-1.64-1.426,0-.5.5-1,1.64-1a6.072,6.072,0,0,1,2.211.428l.285.143.428-2.425a7.5,7.5,0,0,0-2.639-.5h0c-2.852,0-4.921,1.569-4.921,3.708,0,1.64,1.426,2.567,2.567,3.066,1.141.57,1.5.927,1.5,1.426,0,.784-.927,1.07-1.783,1.07a6.083,6.083,0,0,1-2.781-.57l-.357-.214-.428,2.5a9.364,9.364,0,0,0,3.28.57c3.066,0,5.063-1.5,5.063-3.851C39.515,30.361,38.73,29.362,37.019,28.578Z" transform="translate(-7 0)" fill="#0275d8" />
                                    <path id="Path_13624" data-name="Path 13624" d="M16.969,24.1h0l-2.852,7.7-.285-1.569h0l-1-5.206c-.143-.713-.713-.927-1.355-.927H6.843c-.071,0-.071.071-.143.071,0,.071,0,.143.071.143a12.074,12.074,0,0,1,1.925.713,2.433,2.433,0,0,1,1.284,1.5l2.353,8.843H15.4L19.964,24.1h-3Z" transform="translate(0 -0.086)" fill="#0275d8" />
                                </g>
                            </svg>
                            <span>**** **** **** {{ $defaultCard->last4 }}</span>
                        </span>
                    </div>
                    @else
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-opener" data-title="Add Card" data-url="{{ route('payments.add-card-form',['order_id'=>$order->id,'type'=>$type ?? '','service' => 'snow-plowing']) }}">Add Card</button>
                    @endif
                    <button type="button" class="btn btn-success px-5" id="pay">Pay</button>
                </div>
            @else
                @include('client.snow-plowing.login')
            @endif
        </div>
    </div>
</div>

<script>

    $('#tip').on('change',function(){
        $.ajax({
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            url: "{{route('snow-plowing.update-tip')}}",
            type: 'post',
            data : {
                'order_id' : "{{ $order->id }}",
                'tip' : $('#tip').val(),
                'tip_perc' : $('#tip').find(":selected").data('percentage'),
                'type' : $('input[name="tip_type"]:checked').val(),
            },
            success: function(res){
                $('#summary').html(res)
            },
            error: function(err){
                errorMessage(err.responseJSON)
            }
        })
    })

    $('#pay').on('click',function(){
        $(this).prop('disabled', true);
        $.ajax({
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            url: "{{route('snow-plowing.pay')}}",
            type: 'post',
            data : {
                'order_id' : "{{ $order->id }}",
                'grandTotal' : "{{ $order->grand_total }}"
            },
            success: function(res){
                if(res.success){
                    successMessage(res.message)
                    $('#pay-btn').click()
                }
            },
            error: function(err){
                errorMessage(err.responseJSON)
                $('#pay').prop('disabled', false);
            }
        })
    })

    $('#apply-coupon').on('click',function(){
        let code = $('#coupon-code').val()
        if(!code) return errorMessage('Please add promo code')
        $.ajax({
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            url: "{{route('snow-plowing.apply-coupon')}}",
            type: 'post',
            data : {
                code,
                'order_id' : "{{ $order->id }}",
            },
            success: function(res){
                $('#summary').html(res)
            },
            error: function(err){
                errorMessage(err.responseJSON)
            }
        })
    })

    $('.remove-discount').on('click',function(){
        $.ajax({
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            url: "{{route('snow-plowing.remove-coupon')}}",
            type: 'post',
            data : {
                'order_id' : "{{ $order->id }}",
            },
            success: function(res){
                $('#summary').html(res)
            },
            error: function(err){
                errorMessage(err.responseJSON)
            }
        })
    })
</script>