<form class="theme-form mega-form" action="{{ route('admin.teams.invite') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-sm-6 mb-3">
            <label class="col-form-label">Email<span class="text-danger">*</span></label>
            <input class="form-control" name="email" type="text" placeholder="Enter email..." required>
        </div>
        <div class="col-sm-6 mb-3">
            <label class="col-form-label">Username<span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="name" placeholder="Enter name..." required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="col-form-label">Status<span class="text-danger">*</span></label>
            <select class="form-select digits" name="status">
                <option value="1">Active</option>
                <option value="2">Pending</option>
                <option value="3">Inactive</option>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label class="col-form-label">Role<span class="text-danger">*</span></label>
            <select class="form-select digits" id="select-role" name="role">
                @foreach ($roles as $role)
                    <option value="{{$role->name}}">{{$role->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <hr>
    <h4 class="fw-bold my-4">Permissions</h4>
    <div id="permissions">
        @include('admin.teams._permissions')
    </div>
    <div class="mt-5 text-end">
        <button class="btn btn-primary">Send invite</button>
    </div>
</form>
<script>
    $(function(){
        $('#select-role').on('change',function(e){
            $.ajax({
                url: "{{ route('admin.teams.permissions',["role" =>"__role__"]) }}".replace('__role__',e.target.value),
                success: function (data) {
                    $('#permissions').html(data)
                },
                error: function (data) {
                    data = data.responseJSON;
                    $.notify('<i class="fa fa-warning"></i>' + data.message, {
                        type: 'danger',
                        allow_dismiss: true,
                        delay: 2000,
                        showProgressbar: true,
                        timer: 300,
                        animate: {
                            enter: 'animated fadeInDown',
                            exit: 'animated fadeOutUp'
                        }
                    });
                }
            });
        })
    });
</script>
