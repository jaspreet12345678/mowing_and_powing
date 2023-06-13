<form class="theme-form mega-form" action="{{ route('admin.generalsettings.lawnmoving.update') }}" method="post">
    @csrf
    @method('put')
    <div class="">
        <div class="mb-3">
            @if($fee->field_key=='on_demand_fee')
            <label class="col-form-label">On Demand fee</label>
            @elseif($fee->field_key=='admin_feeLawn')
            <label class="col-form-label">Admin fee</label>
            @elseif($fee->field_key=='tax_rate_lawn')
            <label class="col-form-label">Tax Rate</label>
               @elseif($fee->field_key=='admin_feeSnow')
            <label class="col-form-label">Admin fee</label>
               @elseif($fee->field_key=='tax_rate_snow')
            <label class="col-form-label">Tax Rate</label>
            @endif()

            <input class="form-control" type="text" name="fee" value="{{$fee->field_value}}">
            <input class="form-control" type="hidden" name="key" value="{{$fee->field_key}}">

        </div>
    </div>
    <div class="mt-5">
        <button class="btn btn-primary">Update</button>
    </div>
</form>
