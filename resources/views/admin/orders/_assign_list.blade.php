<form class="theme-form mega-form" action="{{ route('admin.order.update-assign-provider') }}" method="post">
    @csrf
    <div class="">
        <div class="mb-3">

            <label class="col-form-label">Assign Provider</label>

            {{-- <input class="form-control" type="text" name="value" value="{{$setting_value->field_value}}"> --}}
            <input  class="form-control" type="hidden" name="order_id" value="{{ $order_id }}" > 
            <select name="provider" id="cars" class="form-control">
            <option value="">Select Provider</option>
            @foreach($provider as $detail)
                <option value="{{$detail->id}}">{{$detail->first_name.$detail->last_name}}</option>
            @endforeach
            </select>
        </div>

    </div>
    <div class="mt-5">
        <button class="btn btn-primary">Assign</button>
    </div>
</form>
