@extends('layouts.client')

@section('title', 'Rate the job')

@push('vendor-styles')
    <link href=" https://cdn.jsdelivr.net/npm/jquery-star-rating-plugin@4.11.0/jquery.rating.min.css " rel="stylesheet" />
@endpush

@push('page-styles')
    <style>
        .bg-skyblue {
            background: #d3ebff !important;
            color: #2c323f !important;
        }

        .fs-12 {
            font-size: 12px;
            letter-spacing: 0px
        }

        .btn-lightgray {
            background: #A8A8A8;
            color: #ffffff;
            border: 1px solid #A8A8A8;
        }

        .btn-green {
            background: #24B550;
            color: #ffffff;
            border: 1px solid ##24B550;
        }

    </style>
@endpush

@section('body')

    <!--- heading & li start --->
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h3>Rate the job</h3>
                </div>
                <div class="col-12 col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">
                                <i class="icofont icofont-prescription fs-6"></i>
                            </a></li>
                        <li class="breadcrumb-item">Completed jobs</li>
                        <li class="breadcrumb-item">Rate the job</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Container-fluid chat-card starts-->
    <div class="container-fluid pb-5">
        <div class="card border shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-5 col-md-12 col-12 h-100">
                        <div class="card border">
                            <div class="card-body px-3">
                                <h4 class="text-center pb-3">Share your experience</h4>
                                <div class="bg-skyblue p-3 rounded-3">
                                    <div class="row">
                                        <div class="col-xxl-6 col-xl-12 col-lg-6 col-sm-6 col-12 py-2">
                                            <span class="pt-2">Rate the quality<span class="text-danger">*</span></span>
                                        </div>
                                        <div class="col-xxl-6 col-xl-12 col-lg-6 col-sm-6 col-12">
                                            <ul class="rate-area">
                                                <input type="radio" id="quality-5-star" name="quality" value="5" /><label for="quality-5-star" title="Amazing">5 stars</label>
                                                <input type="radio" id="quality-4-star" name="quality" value="4" /><label for="quality-4-star" title="Good">4 stars</label>
                                                <input type="radio" id="quality-3-star" name="quality" value="3" /><label for="quality-3-star" title="Average">3 stars</label>
                                                <input type="radio" id="quality-2-star" name="quality" value="2" /><label for="quality-2-star" title="Not Good">2 stars</label>
                                                <input type="radio" id="quality-1-star" name="quality" value="1" /><label for="quality-1-star" title="Bad">1 star</label>
                                            </ul>
                                        </div>
                                        <div class="col-xxl-6 col-xl-12 col-lg-6 col-sm-6 col-12 py-2">
                                            <span class="pt-2">Service was on time<span class="text-danger">*</span></span>
                                        </div>
                                        <div class="col-xxl-6 col-xl-12 col-lg-6 col-sm-6 col-12">
                                            <ul class="rate-area">
                                                <input type="radio" id="response_time-5-star" name="response_time" value="5" /><label for="response_time-5-star" title="Amazing">5 stars</label>
                                                <input type="radio" id="response_time-4-star" name="response_time" value="4" /><label for="response_time-4-star" title="Good">4 stars</label>
                                                <input type="radio" id="response_time-3-star" name="response_time" value="3" /><label for="response_time-3-star" title="Average">3 stars</label>
                                                <input type="radio" id="response_time-2-star" name="response_time" value="2" /><label for="response_time-2-star" title="Not Good">2 stars</label>
                                                <input type="radio" id="response_time-1-star" name="response_time" value="1" /><label for="response_time-1-star" title="Bad">1 star</label>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="my-3">
                                    <h5 class="pt-4">Comment</h5>
                                    <textarea rows="4" cols="50" class="w-100 rounded-3 p-2"
                                        placeholder="What did you like or did'nt like this service? Share as many details as you can." name="comment"
                                        id="comment"></textarea>
                                    <div class="row">
                                        <div class="col-md-12 fs-12 text-end text-muted pe-4">0/1000 Characters</div>
                                    </div>
                                </div>
                                <div class="text-center my-5">
                                    {{-- <a href="#"><button class="btn text-underline">Skip</button></a> --}}
                                    <button class="btn btn-lightgray" id="submit">Submit</button>
                                </div>
                                {{-- <div class="text-center mt-5">
                                <button class="btn btn-green">Rate our App</button>
                            </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7 col-md-12 col-12 h-100">
                        <div class="empty-box h-25"></div>
                        <div class="text-center">
                            <img src="{{ asset('assets/images/star-rating.png') }}" alt="star-rating-img"
                                width="60%">
                        </div>
                        <div class="empty-box h-25"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->




@endsection

@push('vendor-scripts')
@endpush

@push('page-scripts')

    <script>

        $('#submit').click(function() {
            console.log($('input[name="quality"]:checked').val());
            if ($('input[name="quality"]:checked').val() && $('input[name="response_time"]:checked').val()) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    type: 'post',
                    data: {
                        'comment': $('#comment').val(),
                        'quality_rating': $('input[name="quality"]:checked').val(),
                        'response_time_rating': $('input[name="response_time"]:checked').val(),
                    },
                    success: (res) => {
                        if (!res.success) {
                            errorMessage(res.message)
                        } else {
                            window.location = "{{ route('job-history.jobs', 'completed-jobs') }}"
                        }
                    },
                    error: (error) => {
                        errorMessage(error.responseText)
                    }
                })
            } else {
                errorMessage('Both ratings are required')
            }
        })
    </script>
@endpush
