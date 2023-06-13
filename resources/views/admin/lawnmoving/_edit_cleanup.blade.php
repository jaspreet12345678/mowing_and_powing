<form class="theme-form mega-form" action="{{ route('admin.generalsettings.lawnmoving.update-cleanup') }}" method="post">
    @csrf
    @method('put')
    <div class="">
        <div class="mb-3">

        <label class="col-form-label">Name</label>
            <input class="form-control" disable type="text" name="name"
                value="{{ $clean_up_data->name }}" disabled>
            <input type="hidden" name="light_id" value="{{ $clean_up_data->cleanUps[0]->id }}">

            <label class="col-form-label">Light CleanUp</label>
            <input class="form-control" type="text" name="light_cleanup"
                value="{{ $clean_up_data->cleanUps[0]->price }}">
            <input type="hidden" name="light_id" value="{{ $clean_up_data->cleanUps[0]->id }}">

            <label class="col-form-label">Heavy CleanUp</label>
            <input class="form-control" type="text" name="heavy_cleanup"
                value="{{ $clean_up_data->cleanUps[1]->price }}">
            <input type="hidden" name="heavy_id" value="{{ $clean_up_data->cleanUps[1]->id }}">
        </div>
    </div>
    <div class="mt-5">
        <button class="btn btn-primary">Update</button>
    </div>
</form>
