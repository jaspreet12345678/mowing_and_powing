<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(function() {
        $("#country").select2();
    });
</script>

<form method="post" action="{{ route('admin.cities.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label><strong>Name</strong></label>
        <select name="name" id="city" class="form-control">
            <option value="">Select City</option>
            @foreach ($city_list as $city)
                <option value={{ $city->ID }}>{{ $city->CITY }},({{$city->state->STATE_NAME}})</option>
            @endforeach()
        </select>
    </div>
    <br>

    <div class="form-group">
        <label><strong>Status</strong></label>
        <select name="status" id="cars" class="form-control">
            <option value="1">Active</option>
            <option value="0">InActive</option>

        </select>

    </div>
    <br><br>

    <div class="form-group text-center">
        <button style="margin-left: 87%;  margin-top: 2%;" type="submit" class="btn btn-success btn-lg">Save</button>
    </div>
</form>
