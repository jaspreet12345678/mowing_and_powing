<form  method="post" action="{{ route('admin.recurring-jobs.cancel') }}">
@csrf
<div class="modal-header flex-column px-4">
    <div class="col-md-12">
        <div class="text-center">
            <h4 class="text-dark fw-normal px-5 py-4">
                {{ $job->assigned_to ? 'Are you sure you want to cancel?   .' : 'Are you sure you want to cancel this order?' }}
            </h4>
            <div class="form-outline">
                <textarea class="form-control" name="cancel_reason" id="textAreaExample1" rows="4" col="3" placeholder="Enter cancel reason"></textarea>
            </div>
            <input type="hidden" name="job_id" value="{{$job->id}}">
        </div>
    </div>
</div>


<!-- Modal footer -->
<div class="modal-footer justify-content-around py-4">
    <button data-bs-dismiss="modal" class="btn btn-danger w-25" type="button"
        data-original-title="btn"title="">NO</button>

        <button type="submit" class="btn btn-green w-25" style="background-color:green">Yes</button>
    {{-- <a href="{{ route('admin.recurring-jobs.cancel', ['id' => $job->id]) }}" class="btn btn-green w-25"
        style="background-color:green" type="button" data-original-title="btn" title="">Yes</a> --}}
</div>
</form>
