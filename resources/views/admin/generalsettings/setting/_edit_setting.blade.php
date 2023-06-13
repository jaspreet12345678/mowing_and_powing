<form class="theme-form mega-form" action="{{ route('admin.generalsettings.setting.update-setting') }}" method="post">
    @csrf
    <div class="">
        <div class="mb-3">
            @if($status=='radius')
            <label class="col-form-label">Update Radius</label>
            @elseif($status=='admin_commission')
            <label class="col-form-label">Update Admin Commission</label>
            @elseif($status=='auto_refill_limit')
            <label class="col-form-label">Update Auto Refill Limit</label>
            @elseif($status=='cancel_job_charges')
            <label class="col-form-label">Update Cancel Job Charges</label>
            @elseif($status=='referral_bonus')
            <label class="col-form-label">Update Referral Bonus</label>
            @endif()
            <input class="form-control" type="text" name="value" value="{{$setting_value->field_value}}">
            <input type="hidden" name="status" value="{{ $status }}" >
        </div>

    </div>
    <div class="mt-5">
        <button class="btn btn-primary">Update</button>
    </div>
</form>
