<form class="theme-form mega-form" action="{{ route('admin.roles-and-permissions.update',$role->id) }}" method="post">
    @csrf
    @method('put')
    <div class="">
        <div class="mb-3">
            <label class="col-form-label">Role</label>
            <input class="form-control" type="text" name="role" value="{{ $role->name }}">
        </div>
    </div>
    <div class="mt-5">
        <button class="btn btn-primary">Update</button>
    </div>
</form>
