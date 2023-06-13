@extends('layouts.client')

@section('title','Refer a Friend')

@push('vendor-styles')

@endpush

@push('page-styles')

<style>
    .bg-blue {
        background: #0275D8;
    }
    .text-blue {
        color: #0275D8;
    }
    .border-blue{
        border: 1px solid #0275D8;
    }
    .btn-blue{
        background: #0275D8;
        color: #ffffff;
        border: 1px solid #0275D8;
    }
    .fs-12{
        font-size: 12px;
    }
    .vl {
        border-left: 2px solid #0275D8;
        height: 150%;
        position: relative;
    }
    .dots{
        position: absolute;
        top: 0rem;
        left: 14px;
        height: 150%;

    }
    .dot {
        height: 46px;
        width: 46px;
        background-color: #E6F3FF;
        border:2px solid #0275D8;
        border-radius: 50%;
        display: inline-block;
        padding-left: 6px;
        padding-top: 4px;
    }
    .h-150{
        height: 150%;
    }
    @media (min-width: 1200px) and (max-width: 1331px){
        .copy-btn{
            width: 100%;
        }
        .share-btn{
            width: 100%;
            margin-top: 16px;
        }
        .border-blue{
            width: 100%;
        }
        .btn-blue{
            width: 100%;
        }
    }
    @media (min-width: 577px) and (max-width: 767px){
        .copy-btn{
            width: 50%;
        }
        .share-btn{
            width: 50%;
        }
    }
    @media (min-width: 426px) and (max-width: 576px){
        .copy-btn{
            width: 100%;
        }
        .share-btn{
            width: 100%;
            margin-top: 16px;
        }
        .border-blue{
            width: 100%;
        }
        .btn-blue{
            width: 100%;
        }
    }
    @media (min-width: 376px) and (max-width: 425px){
        .copy-btn{
            width: 100%;
        }
        .share-btn{
            width: 100%;
            margin-top: 16px;
        }
        .border-blue{
            width: 100%;
        }
        .btn-blue{
            width: 100%;
        }
    }
    @media (min-width: 320px) and (max-width: 375px){
        .copy-btn{
            width: 100%;
        }
        .share-btn{
            width: 100%;
            margin-top: 16px;
        }
        .border-blue{
            width: 100%;
        }
        .btn-blue{
            width: 100%;
        }
        .fs-18{
            font-size: 18px;
        }
    }
</style>

@endpush

@section('body')

<!--- heading & li start --->
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Refer a Friend</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href=""></a>
                    <i class="icofont icofont-users-alt-2 fs-6"></i>
                </a></li>
                <li class="breadcrumb-item">Refer a Friend</li>
                <li class="breadcrumb-item">Share</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card border">
        <div class="card-body p-0">
            <div class="bg-blue rounded-3 py-3">
                <h3 class="text-center fw-normal text-white mb-0">Refer a Friend</h3>
            </div>
            <div class="row my-5 mx-4">
                <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card border-blue">
                        <div class="card-header">
                            <h6 class="fw-normal">Refer a new friend and get bonus of up <br> to ${{ floor(settings('referral_bonus')) }} inyour Mowing and Plowing Cash Wallet.</h6>
                            <span class="text-muted">*Terms and Conditions are aplied*</span>
                        </div>
                        <div class="card-body">
                            <p class="fs-6">Share your referral link:</p>
                            <div class="border-blue p-3 text-blue rounded-3 mb-2">
                                <p class="referral-link" >{{ request()->getHost().$activeUser->referral_link }}</p>
                            </div>
                            <span class="fs-12">The receiver will add this code while sign up.</span>
                        </div>
                        <div class="card-footer">
                            <div class="row justify-content-center">
                                {{-- <div class="col-md-2"></div> --}}
                                <div class="col-md-6 col-12 copy-btn">
                                    <button class="btn border-blue border-2 text-blue float-end" id="copy-link" data-clipboard-target=".referral-link"><i class="icofont icofont-copy me-1"></i>Copy link</button>
                                </div>
                                <div class="col-md-6 col-12 share-btn">
                                    <button class="btn btn-blue float-start">Share link <i class="icofont icofont-share-alt ms-1"></i></button>
                                </div>
                                {{-- <div class="col-md-2"></div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12 col-12 px-sm-5 pb-5">
                    <h2 class="pt-xl-5 mt-xl-5 pt-lg-2 mb-4 text-center ps-4 ms-sm-3 ms-4 fs-18">Refer A New Friend</h2>
                    <div class="row pb-5">
                        <div class="col-md-2"></div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-4">
                            <div class="vl ms-md-4 ms-sm-4 ms-4 col-4"></div>
                            <div class="dots d-flex flex-column justify-content-between">
                                <div class="dot">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30.444" height="30.645" viewBox="0 0 30.444 30.645">
                                        <g id="Group_7835" data-name="Group 7835" transform="translate(-278.474 -248.767)">
                                        <path id="Path_18350" data-name="Path 18350" d="M278.474,279.412V260.75l4.77-3.784V252.3h5.981l4.476-3.532,4.444,3.509h5.975v4.659l4.8,3.807v18.671Zm19.272-9.645,5.052-4.6V253.64H284.587v11.454l5.071,4.605,4.045-3.1Zm8.411,8.32.03-.1L293.7,268.247l-12.612,9.84ZM288.6,270.5l-8.765-7.905V277.42Zm10.208,0,8.761,6.916v-14.82Zm-15.6-11.835-3.084,2.427,3.084,2.753Zm20.937,5.179,3.078-2.758-3.078-2.41Zm-8.16-11.6-2.281-1.758-2.192,1.758Z" fill="#313131"/>
                                        <path id="Path_18351" data-name="Path 18351" d="M358.036,307.15c-2.132-1.561-4.2-3.142-5.508-5.481a3.814,3.814,0,0,1-.519-2.621,3.667,3.667,0,0,1,5.586-2.429l.443.287c.166-.1.338-.212.512-.316a3.791,3.791,0,0,1,4.147.188,3.671,3.671,0,0,1,1.2,4.174,5.859,5.859,0,0,1-.562,1.169A18.141,18.141,0,0,1,358.036,307.15Zm.011-1.607a16.73,16.73,0,0,0,3.9-3.689,5.8,5.8,0,0,0,.642-1.127,2.358,2.358,0,0,0-3.99-2.438c-.182.213-.36.429-.557.665-.291-.339-.513-.64-.777-.9a2.3,2.3,0,0,0-3.844,1.073,2.828,2.828,0,0,0,.476,2.295A15.7,15.7,0,0,0,358.046,305.544Z" transform="translate(-64.347 -41.407)" fill="#313131"/>
                                        </g>
                                    </svg>
                                </div>
                                <div class="dot">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28.597" height="30.781" viewBox="0 0 28.597 30.781">
                                        <g id="Group_7836" data-name="Group 7836" transform="translate(-202.134 -94.115)">
                                        <path id="Path_18352" data-name="Path 18352" d="M204.29,184.827c.005-.133.014-.267.014-.4q0-8.356,0-16.711v-.461h-2.171v-6.585h7.128c-1.017-2.409-.63-4.423,1.532-5.934a4.029,4.029,0,0,1,2.967-.637,4.481,4.481,0,0,1,2.668,1.429,4.436,4.436,0,0,1,3.25-1.477,4.419,4.419,0,0,1,4.355,3.462,4.427,4.427,0,0,1-.474,3.126h7.171v6.591h-2.148c-.012.133-.03.236-.03.339q0,8.52,0,17.039c0,.073.009.145.014.218Zm8.809-2.2V167.266h-6.555v15.357Zm13.215,0V167.266h-6.556v15.357Zm-10.965-.009H217.5V167.262H215.35Zm-11.022-17.6H213.1v-2.134h-8.777Zm24.2-2.128h-8.778v2.135h8.778Zm-13.216-2.248c0-.836.055-1.64-.013-2.435a2.191,2.191,0,1,0-2.362,2.423C213.713,160.687,214.494,160.637,215.315,160.637Zm2.235-.016c.841,0,1.66.065,2.465-.015a2.12,2.12,0,0,0,1.906-2.31,2.182,2.182,0,0,0-2.1-2.041,2.15,2.15,0,0,0-2.257,1.9C217.485,158.962,217.55,159.782,217.55,160.621Zm-.048,4.415v-2.155h-2.139v2.155Z" transform="translate(0 -59.931)" fill="#313131"/>
                                        </g>
                                    </svg>
                                </div>
                                <div class="dot">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30.329" height="30.392" viewBox="0 0 30.329 30.392">
                                      <g id="Group_7837" data-name="Group 7837" transform="translate(-243.545 -107.75)">
                                        <path id="Path_18353" data-name="Path 18353" d="M259.359,107.75c.5.059,1,.11,1.5.179.322.045.643.1.96.175a.887.887,0,0,1-.345,1.739,12.9,12.9,0,0,0-2.969-.3,13.18,13.18,0,0,0-11.805,7.581,12.347,12.347,0,0,0-1.307,6.987,13.4,13.4,0,0,0,2.769,7.046c.04.052.088.1.171.192-.036-.252-.064-.445-.092-.638a.9.9,0,1,1,1.766-.257c.152,1.066.309,2.132.454,3.2a1.4,1.4,0,0,1-.016.527.871.871,0,0,1-1.063.62q-1.787-.341-3.571-.694a.892.892,0,1,1,.354-1.743c.241.045.482.087.76.138-.072-.1-.12-.177-.173-.246a15.023,15.023,0,0,1-3.065-7.352,15.261,15.261,0,0,1,11.372-16.694c.819-.2,1.67-.277,2.506-.411l.317-.052Z" transform="translate(0)" fill="#313131"/>
                                        <path id="Path_18354" data-name="Path 18354" d="M390.185,176.941c-.488-.059-.977-.111-1.464-.18-.312-.044-.624-.1-.931-.171a.885.885,0,0,1,.323-1.74c.695.084,1.386.215,2.083.26a12.609,12.609,0,0,0,6.751-1.417,13.441,13.441,0,0,0,4.607-20.046.791.791,0,0,0-.233-.22c.007.1.012.2.022.3.016.157.048.314.05.471a.877.877,0,0,1-.756.887.859.859,0,0,1-.969-.642c-.107-.5-.164-1.014-.237-1.522-.092-.636-.173-1.273-.27-1.908a.9.9,0,0,1,1.141-1.1c1.161.228,2.324.447,3.486.672a.9.9,0,1,1-.329,1.753c-.239-.046-.478-.089-.743-.138.317.456.63.875.912,1.314a15.1,15.1,0,0,1,2.384,7.057,2.9,2.9,0,0,0,.051.286v1.84c-.018.1-.038.192-.054.288-.135.817-.217,1.647-.413,2.45a14.73,14.73,0,0,1-3.687,6.759,14.906,14.906,0,0,1-8.808,4.576c-.476.072-.956.116-1.434.174Z" transform="translate(-132.189 -38.8)" fill="#313131"/>
                                        <path id="Path_18355" data-name="Path 18355" d="M336.921,192.573a9.241,9.241,0,1,1-9.222-9.284A9.259,9.259,0,0,1,336.921,192.573Zm-9.239-7.5a7.484,7.484,0,1,0,7.458,7.5A7.482,7.482,0,0,0,327.682,185.076Z" transform="translate(-68.967 -69.561)" fill="#313131"/>
                                        <path id="Path_18356" data-name="Path 18356" d="M393.495,235.9a3.212,3.212,0,0,1-1.715-.488.906.906,0,0,1-.353-1.274.891.891,0,0,1,1.269-.254,1.569,1.569,0,0,0,.844.227c.572-.006,1.145,0,1.717,0a.8.8,0,0,0,.84-.645.78.78,0,0,0-.769-.943c-.651-.013-1.3.008-1.954-.01a2.58,2.58,0,0,1-.121-5.151c.068-.006.135-.009.241-.016,0-.231,0-.455,0-.679a.914.914,0,0,1,.887-.955.9.9,0,0,1,.893.943c0,.225,0,.45,0,.609a12.483,12.483,0,0,1,1.323.444,2.984,2.984,0,0,1,.78.575.885.885,0,1,1-1.224,1.279,1.48,1.48,0,0,0-1.153-.426c-.522.018-1.046,0-1.569.009a.778.778,0,0,0-.749.606.762.762,0,0,0,.347.845,1.233,1.233,0,0,0,.534.133c.6.017,1.2,0,1.806.011a2.574,2.574,0,0,1,.359,5.114l-.454.066c0,.208,0,.421,0,.634a.894.894,0,1,1-1.78.007C393.493,236.343,393.495,236.137,393.495,235.9Z" transform="translate(-135.672 -108.616)" fill="#313131"/>
                                      </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-8 col-8 ps-0">
                            <div class="h-150 d-flex flex-column justify-content-between">
                            <div class="">
                                <p>invite your friends to Mowing and Plowing</p>

                            </div>
                            <div class="mt-4">
                                <p>Get a bonues of up to ${{ floor(settings('referral_bonus')) }}</p>

                            </div>
                            <div class="mt-4">
                                <p>Bonus add in your Mowing and Plowing Cash Wallet.</p>

                            </div>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection

@push('vendor-scripts')
<script src="https://cdn.jsdelivr.net/clipboard.js/1.5.12/clipboard.min.js"></script>
@endpush

@push('page-scripts')
<script>
    new Clipboard('#copy-link');
</script>
@endpush
