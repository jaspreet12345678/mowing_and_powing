<!-- Modal Header -->
<div class="modal-header flex-column px-4">
    <div class="col-md-12">
        <div class="text-center">
            <h4 class="text-dark fw-normal px-5 py-4">
                {{ $job->assigned_to ? 'Are you sure you want to Remove Provider?   .' : 'Are you sure you want to Remove Provider?' }}                                              
            </h4>
        </div>
    </div>
</div>

<!-- Modal footer -->
<div class="modal-footer justify-content-around py-4">
    <button data-bs-dismiss="modal" class="btn btn-danger w-25" type="button" data-original-title="btn"title="">NO</button>
    <a href="{{ route('admin.payproviders.payment-reject',['id'=>$job->id]) }}" class="btn btn-green w-25"    style="background-color:green" type="button" data-original-title="btn" title="">Yes</a>
</div>