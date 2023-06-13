<form class="theme-form mega-form" action="{{ route('admin.plugins.update') }}" method="post">
    @csrf
    @method('put')
    <div class="">
        <div class="mb-3">
            Choose sms service provider
            <div class="">
                <input class="form-check-input shadow-none" id="messagebird" name="SMS_SERVICE" type="radio" {{$env->get('SMS_SERVICE') == 'messagebird' ? 'checked' : ''}} value="messagebird">
                <label class="" for="messagebird">MessageBird</label>
            </div>
            <div class="">
                <input class="form-check-input shadow-none" id="twilio" name="SMS_SERVICE" type="radio" {{$env->get('SMS_SERVICE') == 'twilio' ? 'checked' : ''}} value="twilio">
                <label class="" for="twilio">Twilio</label>
            </div>
        </div>
        <div class="mb-3">
            <label class="col-form-label">MessageBird Key</label>
            <input class="form-control" type="text" name="MESSAGE_BIRD_KEY" value="{{$env->get('MESSAGE_BIRD_KEY')}}">
        </div>
        <div class="mb-3">
            or
        </div>
        <div class="mb-3">
            <label class="col-form-label">Twilio Account SID</label>
            <input class="form-control" type="text" name="TWILIO_ACCOUNT_SID" value="{{$env->get('TWILIO_ACCOUNT_SID')}}">
        </div>
        <div class="mb-3">
            <label class="col-form-label">Twilio Auth Token</label>
            <input class="form-control" type="text" name="TWILIO_AUTH_TOKEN" value="{{$env->get('TWILIO_AUTH_TOKEN')}}">
        </div>
        <div class="mb-3">
            <label class="col-form-label">Twilio From</label>
            <input class="form-control" type="text" name="TWILIO_FROM" value="{{$env->get('TWILIO_FROM')}}">
        </div>
    </div>
    <div class="mt-5">
        <button class="btn btn-primary">Update</button>
    </div>
</form>
