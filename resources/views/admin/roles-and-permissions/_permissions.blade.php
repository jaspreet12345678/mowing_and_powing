<form class="theme-form mega-form" action="{{ route('admin.roles-and-permissions.permissions.update',$role_id) }}" method="post">
    @csrf
    @method('put')
    <div class="">
        <div class="form-check checkbox checkbox-solid-info my-3">
            <input class="form-check-input" id="dashboard" name="dashboard" type="checkbox" checked disabled>
            <label class="form-check-label" for="dashboard">Dashboard</label><br>
            <i class="ms-3">This permission allows the admin to give access to "Dashboard" menu.</i>
        </div>
        @foreach ($allPermissions as $permission)
            <div class="form-check checkbox checkbox-solid-info my-3">
                <input class="form-check-input" id="{{$permission->name}}" name="{{$permission->name}}" type="checkbox" {{ in_array($permission->name,$selectedPermissions) ? 'checked' : '' }}>
                <label class="form-check-label" for="{{$permission->name}}">{{ucfirst($permission->name)}}</label><br>
                <i class="ms-3">This permission allows the admin to give access to "{{ucfirst($permission->name)}}" menu.</i>
            </div>
        @endforeach
    </div>
    <div class="mt-5">
        <button class="btn btn-primary">Update</button>
    </div>
</form>
