<form class="theme-form mega-form">
    @csrf
    <div class="form-outline">
  <textarea class="form-control" id="textAreaExample1" rows="4">{{isset($supports_description->detail)? $supports_description->detail: ''}}</textarea>
 
</div>
    <div class="mt-5">
        <button data-bs-dismiss="modal" class="btn btn-success">Close</button>
    </div>
</form>
