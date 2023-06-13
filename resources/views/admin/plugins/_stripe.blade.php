<form class="theme-form mega-form" action="{{ route('admin.plugins.update') }}" method="post">
    @csrf
    @method('put')
    <div class="">
        <div class="mb-3">
            <div class="">Live Mode</div>
            <div class="form-check form-switch form-switch-md">
                <input class="form-check-input shadow-none" name="STRIPE_LIVE_MODE" type="checkbox" {{$env->get('STRIPE_LIVE_MODE') ? 'checked' : ''}}>
            </div>
        </div>
        <div class="mb-3">
            <label class="col-form-label">Test Public Key</label>
            <input class="form-control" type="text" name="STRIPE_TEST_PUBLIC_KEY" value="{{$env->get('STRIPE_TEST_PUBLIC_KEY')}}">
        </div>
        <div class="mb-3">
            <label class="col-form-label">Test Secret Key</label>
            <input class="form-control" type="text" name="STRIPE_TEST_SECRET_KEY" value="{{$env->get('STRIPE_TEST_SECRET_KEY')}}">
        </div>
        <div class="mb-3">
            <label class="col-form-label">Live Public Key</label>
            <input class="form-control" type="text" name="STRIPE_LIVE_PUBLIC_KEY" value="{{$env->get('STRIPE_LIVE_PUBLIC_KEY')}}">
        </div>
        <div class="mb-3">
            <label class="col-form-label">Live Secret Key</label>
            <input class="form-control" type="text" name="STRIPE_LIVE_SECRET_KEY" value="{{$env->get('STRIPE_LIVE_SECRET_KEY')}}">
        </div>
    </div>
    <div class="mt-5">
        <button class="btn btn-primary">Update</button>
    </div>
</form>
