<form class="theme-form mega-form"
    action="{{ isset($question->id) ? route('admin.generalsettings.snow-plowing.update-question') : route('admin.generalsettings.snow-plowing.add-question') }}"
    method="post">
    @csrf
    <div class="">
        <div class="mb-3">
            <label class="col-form-label">Enter Question</label>
            <input class="form-control" type="text" name="question"
                value="{{ isset($question->question) ? $question->question : '' }}">
            <input class="form-control" type="hidden" name="question_id"
                value="{{ isset($question->id) ? $question->id : '' }}">
            <input class="form-control" type="hidden" name="category" value="2">
            <input class="form-control" type="hidden" name="type" value="2">
        </div>
    </div>
    <div class="mt-5">
        <button class="btn btn-primary">Update</button>
    </div>
</form>
