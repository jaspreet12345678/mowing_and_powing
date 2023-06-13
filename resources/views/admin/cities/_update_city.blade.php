<form method="post" action="{{ route('admin.cities.update') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label><strong>Name</strong></label>
        <input type="text" placeholder="Enter City Name" name="name" value="{{isset($city_detail)? $city_detail->name : ''}}" class="form-control" />
    </div>
    <br>
<input type="hidden" name="city_id" value="{{isset($city_detail)? $city_detail->id : ''}}">
    <div class="form-group">
        <label><strong>Status</strong></label>
        <select name="status"  class="form-control">
            <option value="1" {{$city_detail->status == '1' ? 'selected' : ''}}>Active</option>
            <option value="0" {{$city_detail->status == '0' ? 'selected' : ''}}>InActive</option>
        </select>

    </div>
    <br><br>

    <div class="form-group text-center">
        <button style="margin-left: 87%;  margin-top: 2%;" type="submit" class="btn btn-success btn-lg">Update</button>
    </div>
</form>
