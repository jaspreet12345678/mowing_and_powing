<!-- Modal Header -->
<div class="modal-header flex-column px-4">
    <div class="col-md-12">
        <div class="text-center">
            <h4 class="text-dark fw-normal px-5 py-4">
                {{ $job->assigned_to ? 'Are you sure you want to cancel?  You will be charged $'.settings('cancel_job_charges').' service fee to cancel this job.' : 'Are you sure you want to cancel this job?' }}                                              
            </h4>
        </div>
    </div>
</div>

<!-- Modal footer -->
<div class="modal-footer justify-content-around py-4">
    <button data-bs-dismiss="modal" class="btn btn-danger w-25" type="button" data-original-title="btn"title="">NO</button>
    <a href="{{ route('job-history.jobs.cancel',['id'=>$job->id]) }}" class="btn btn-green w-25" type="button" data-original-title="btn" title="">Yes</a>
</div>