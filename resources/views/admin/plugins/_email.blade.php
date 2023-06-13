<form class="theme-form mega-form" action="{{ route('admin.plugins.update') }}" method="post">
    @csrf
    @method('put')
    <div class="">
         <div class="mb-3">
            <label class="col-form-label">DRIVER</label>
            <input class="form-control" type="text" name="MAIL_DRIVER" value="{{$env->get('MAIL_DRIVER')}}">
        </div>
        <div class="mb-3">
            <label class="col-form-label">HOST</label>
            <input class="form-control" type="text" name="MAIL_HOST" value="{{$env->get('MAIL_HOST')}}">
        </div>
        <div class="mb-3">
            <label class="col-form-label">PORT</label>
            <input class="form-control" type="text" name="MAIL_PORT" value="{{$env->get('MAIL_PORT')}}">
        </div>
        <div class="mb-3">
            <label class="col-form-label">USERNAME</label>
            <input class="form-control" type="text" name="MAIL_USERNAME" value="{{$env->get('MAIL_USERNAME')}}">
        </div>
        <div class="mb-3">
            <label class="col-form-label">PASSWORD</label>
            <input class="form-control" type="text" name="MAIL_PASSWORD" value="{{$env->get('MAIL_PASSWORD')}}">
        </div>
        <div class="mb-3">
            <label class="col-form-label">ENCRYPTION</label>
            <input class="form-control" type="text" name="MAIL_ENCRYPTION" value="{{$env->get('MAIL_ENCRYPTION')}}">
        </div>
        <div class="mb-3">
            <label class="col-form-label">FROM ADDRESS</label>
            <input class="form-control" type="text" name="MAIL_FROM_ADDRESS" value="{{$env->get('MAIL_FROM_ADDRESS')}}">
        </div>
        <div class="mb-3">
            <label class="col-form-label">FROM NAME</label>
            <input class="form-control" type="text" name="MAIL_FROM_NAME" value="{{$env->get('MAIL_FROM_NAME')}}">
        </div>
    </div>
    <div class="mt-5">
        <button class="btn btn-primary">Update</button>
    </div>
</form>
