<form class="theme-form mega-form" action="{{ route('admin.generalsettings.lawnmoving.update-lawnmpving-question') }}" method="post">
    @csrf
    @method('put')
    <div class="">
        <div class="mb-3">
         
            <label class="col-form-label">question</label>
           

            <input class="form-control" type="text" name="question" value="{{$question->question}}">
            <input class="form-control" type="hidden" name="question_id" value="{{$question->id}}"> 

        </div>
    </div>
    <div class="mt-5">
        <button class="btn btn-primary">Update</button>
    </div>
</form>
