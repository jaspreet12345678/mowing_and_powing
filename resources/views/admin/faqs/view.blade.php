<form method="post" action="{{ route('admin.faqs.update-faq') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label><strong>Question</strong></label>
        <input type="text" value="{{ isset($faq_detail->question) ? $faq_detail->question : '' }}" name="question"
            class="form-control" />
        <input type="hidden" value="{{ isset($faq_detail->id) ? $faq_detail->id : '' }}" name="id"
            class="form-control" />
        <input type="hidden" value="{{ $faq_type }}" name="type">
    </div>
    <br><br>
    <div class="form-group">
     <label for="exampleFormControlTextarea2"><strong>Answer</strong></label>
  <textarea name="editor1" class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3">{{ isset($faq_detail->answer) ? $faq_detail->answer : '' }} </textarea>
    </div>
    <div class="form-group text-center">
        <button style="margin-left: 87%;  margin-top: 2%;" type="submit" class="btn btn-success btn-lg">Save</button>
    </div>
</form>