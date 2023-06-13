@extends('layouts.lawn-mowing')

@section('title', 'Service')

@push('page-styles')


<style>
    .priceTxt {
        border: 1px solid #7CC0FB;
        background: #E6F3FF;
        width: 70px;
        border-radius: 5px;
        text-align: center;
    }

    .priceTxtWhite {
        border: 2px solid #7CC0FB;
        background: #ffffff;
        padding-left: 5px;
        padding-right: 5px;
        border-radius: 5px;
        text-align: center;
        color: #0275D8;
    }

    .inputCard {
        padding: 13px 0 !important;
        background: white;
        border: 0px solid !important;
        font-size: 14px !important;
    }

    .mapouter {
        position: relative;
        text-align: right;
        width: 100%;
        height: 400px;
    }

    .gmap_canvas {
        overflow: hidden;
        background: none !important;
        width: 100%;
        height: 400px;
    }

    .gmap_iframe {
        width: 100% !important;
        height: 400px !important;
    }

    .selectBox {
        padding: 11px 8px !important;
        font-size: 14px !important;
    }

    .page-wrapper.compact-wrapper .page-body-wrapper .page-body {
        margin-top: 0px !important;
    }

    .txtCus {
        position: absolute;
        z-index: 2;
        left: 24px;
        bottom: 30px;
        color: #24B550;
    }

    .txtGray {
        color: #707070;
    }

    #multistepsform fieldset {
        background: white;
        border: 0 none;
        border-radius: 3px;
        box-shadow: 0 0 5px 0px rgb(0 0 0 / 30%);
        padding: 20px 30px;
        box-sizing: border-box;
        width: 100%;
        /* margin: 0 10%; */
        position: relative;
    }

    #multistepsform fieldset:not(:first-of-type) {
        display: none;
    }

    #multistepsform input:focus,
    #multistepsform textarea:focus {
        border-color: #679b9b;
        outline: none;
        color: #637373;
    }

    #multistepsform .action-button {
        width: 100px;
        background: #0275D8;
        font-weight: bold;
        color: #fff;
        transition: 150ms;
        border: 0 none;
        border-radius: 5px;
        cursor: pointer;
        padding: 10px 5px;
        margin: 10px 5px;
    }

    #multistepsform .action-button:hover,
    #multistepsform .action-button:focus {
        box-shadow: 0 0 0 2px #f08a5d, 0 0 0 3px #ff976;
        color: #fff;
    }

    #multistepsform .fs-title {
        font-size: 15px;
        text-transform: uppercase;
        color: #2c3e50;
        margin-bottom: 10px;
    }

    #multistepsform .fs-subtitle {
        font-weight: normal;
        font-size: 13px;
        color: #666;
        margin-bottom: 20px;
    }

    #multistepsform #progressbar {
        margin-bottom: 30px;
        overflow: hidden;
        counter-reset: step;
    }

    #multistepsform #progressbar li {
        list-style-type: none;
        color: #679b9b;
        text-transform: uppercase;
        font-size: 9px;
        width: 33.33%;
        float: left;
        position: relative;
    }

    #multistepsform #progressbar li:before {
        content: counter(step);
        counter-increment: step;
        width: 20px;
        line-height: 20px;
        display: block;
        font-size: 10px;
        color: #fff;
        background: #679b9b;
        border-radius: 3px;
        margin: 0 auto 5px auto;
    }

    #multistepsform #progressbar li:after {
        content: "";
        width: 100%;
        height: 2px;
        background: #679b9b;
        position: absolute;
        left: -50%;
        top: 9px;
        z-index: -1;
    }

    #multistepsform #progressbar li:first-child:after {
        content: none;
    }

    #multistepsform #progressbar li.active {
        color: #ff9a76;
    }

    #multistepsform #progressbar li.active:before,
    #multistepsform #progressbar li.active:after {
        background: #ff9a76;
        color: white;
    }

    .zone {
        background: white;
        border: 2px dashed #0275D8;
        text-align: center;
        color: #0275D8;
        transition: all 0.3s ease-out;
        box-shadow: 0 0 0 1px rgba(255, 255, 255, 0.05), inset 0 0 0.25em 0 rgba(0, 0, 0, 0.25);
        padding: 60px 0;
    }

    .zone .btnCompression .active {
        background: #EB6A5A;
        color: white;
    }

    .zone i {
        text-align: center;
        font-size: 10em;
        color: #fff;
        margin-top: 50px;
    }

    .zone .selectFile {
        height: 50px;
        margin: 20px auto;
        position: relative;
        width: 160px;
    }

    .zone label,
    .zone input {
        cursor: pointer;
        display: block;
        height: 50px;
        left: 0;
        position: absolute;
        top: 0;
        width: 100%;
        border-radius: 5px;
    }

    .zone label {
        background: #0275D8;
        color: #fff;
        display: inline-block;
        font-size: 1.2em;
        line-height: 50px;
        padding: 0;
        text-align: center;
        white-space: nowrap;
        text-transform: uppercase;
        font-weight: 400;
        box-shadow: 0 1px 1px gray;
    }

    .zone input[type=file] {
        opacity: 0;
    }

    .zone.in {
        color: white;
        border-color: white;
        background: radial-gradient(ellipse at center, #EB6A5A 0, #c9402f 100%);
    }

    .zone.in i {
        color: #fff;
    }

    .zone.in label {
        background: #fff;
        color: #EB6A5A;
    }

    .zone.hover {
        color: gray;
        border-color: white;
        background: #fff;
        border: 5px dashed gray;
    }

    .zone.hover i {
        color: #EB6A5A;
    }

    .zone.hover label {
        background: #fff;
        color: #EB6A5A;
    }

    .zone.fade {
        transition: all 0.3s ease-out;
        opacity: 1;
    }

    .bgGreen {
        background-color: #24B550 !important;
    }

    .svgDropIcon {
        position: absolute;
        right: 30px;
        top: 205px;
    }
    /* ---- cards style ----- */
    /* .bgGray {
        padding: 2rem 2.8rem;
    } */

    /* .service-card input[type="radio"] {
        display: none;
    } */

    /* .service-card input[type="radio"] + .bgGray {
        cursor: pointer;
    } */

    /* .service-card input[type="radio"] + .bgGray:before {
        content: "";
        color: transparent;
        font-weight: bold;
    } */

    /* .service-card input[type="radio"]:checked + .bgGray {
        background-color: #B2FFCA;
    } */

    /* .service-card input[type="radio"]:checked + .bgGray:before {
        color: inherit;
    } */

    .asd {
        bottom: 60px;
    }
    .form-check-input {
        width: 28.5em;
        height: 4.5em;
    }
    .form-check-input:checked {
        background-color: transparent;
        border-color: #0d6efd;
    }
    .form-check-input[type="radio"] {
        border-radius: 5px;
    }
    input[type="radio"]:checked + .bgGray {
        background-color: #B2FFCA;
    }

    /* .card input[type="radio"]:checked + .bgGray {
        background-color: #B2FFCA;
    } */
    
</style>
@endpush

@section('body')
    <br>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-12 ">
            <h2 class="my-4">Lawn Mowing</h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-12 ">
            <div class="d-flex justify-content-end mt-4">
                <p class="mb-0 me-3">What's included? </p>
                <div class="cursor" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <svg xmlns="http://www.w3.org/2000/svg" class="p-1" width="25.518" height="25.52"
                        viewBox="0 0 25.518 25.52">
                        <g id="Group_6442" data-name="Group 6442" transform="translate(-265.015 -153.008)">
                            <path id="Path_16131" data-name="Path 16131"
                                d="M277.814,178.278a12.51,12.51,0,1,1,12.469-12.519A12.524,12.524,0,0,1,277.814,178.278Zm11.109-12.5a11.151,11.151,0,1,0-11.16,11.142A11.138,11.138,0,0,0,288.923,165.776Z"
                                transform="translate(0 0)" fill="#0275d8" stroke="#0275d8"
                                stroke-width="0.5" />
                            <path id="Path_16132" data-name="Path 16132"
                                d="M325.136,199.725c0,.259.006.5,0,.742-.016.5-.257.8-.643.822-.4.019-.681-.3-.711-.829-.07-1.209.253-1.714,1.448-2.261a1.913,1.913,0,0,0,1.151-2.094,1.982,1.982,0,0,0-1.812-1.647,1.936,1.936,0,0,0-1.94,1.319,4.075,4.075,0,0,0-.1.6c-.077.45-.352.722-.714.7a.7.7,0,0,1-.634-.824,3.146,3.146,0,0,1,1.818-2.793,3.3,3.3,0,0,1,4.732,3.37,3.2,3.2,0,0,1-1.986,2.614Z"
                                transform="translate(-46.684 -33.261)" fill="#0275d8" stroke="#0275d8"
                                stroke-width="0.5" />
                            <path id="Path_16133" data-name="Path 16133"
                                d="M335.748,250.283a1.331,1.331,0,0,1-1.325,1.324,1.335,1.335,0,0,1,.023-2.67A1.332,1.332,0,0,1,335.748,250.283Z"
                                transform="translate(-56.654 -79.895)" fill="#0275d8" stroke="#0275d8"
                                stroke-width="0.5" />
                        </g>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class=" rounded mb-0 pb-5">
        @php
            $sizes = App\Models\LawnSize::get();
            $heights = App\Models\LawnHeight::get();
            $fences = App\Models\Fence::get();
            $cleanUps = App\Models\Cleanup::get();
        @endphp
        <!-- multistep form -->
        <form id="multistepsform" method="post" enctype="multipart/form-data">
            @csrf
            {{-- Service start --}}
            <fieldset class="active-tab service-tab">

                <div class="row">
                    <div class="col-lg-5 col-md-6 col-sm-12 col-12">
                        <div class="mb-3">
                            <label>Lawn size (in acres)</label>
                            <select class="form-select boxShadow shadow-none selectBox" id="lawn-sizes">
                                @foreach ($sizes as $size)
                                    <option value="{{ $size->id }}">{{ $size->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Lawn height (in inches)</label>
                            <select class="form-select boxShadow shadow-none selectBox" id="lawn-heights">
                                @foreach ($heights as $height)
                                    <option value="{{ $height->id }}">{{ $height->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="card p-3 rounded shadow">
                            <div class="d-flex justify-content-between">
                                <p class="mb-0 mt-2">Do you have a corner lot?</p>
                                <div class="form-check form-switch form-switch-md">
                                    <input class="form-check-input shadow-none" name="corner_lot" type="checkbox"
                                        id="corner_lot">
                                </div>
                            </div>

                            <hr class="mt-0">
                            <div class="d-flex justify-content-between">
                                <p class="mb-0 mt-2">Do you have a fence?</p>
                                <div class="form-check form-switch form-switch-md">
                                    <input class="form-check-input shadow-none" type="checkbox" name="fence" id="fenceSwitch">
                                </div>
                            </div>

                            <div id="fence-contect" class="" style="display: none;">
                                @foreach ($fences as $fence)
                                    <div class="card boxShadow rounded py-2 px-1 mb-3">
                                        <div class="d-flex">
                                            <div class="p-2 mt-1">
                                                <svg id="Group_4017" data-name="Group 4017" xmlns="http://www.w3.org/2000/svg"
                                                    width="15.031" height="15.001" viewBox="0 0 15.031 15.001">
                                                    <path id="Path_252" data-name="Path 252"
                                                        d="M12.031-499.535l-.857,1.485v2.313H10v1.145h1.174v5.108H10v1.145h1.174v2.319h3.464v-2.319h1.145v2.319h3.464v-2.319h1.145v2.319h3.464v-2.319h1.174v-1.145H23.856v-5.108h1.174v-1.145H23.856v-2.313L23-499.535c-.473-.816-.866-1.485-.875-1.485s-.4.669-.875,1.485l-.857,1.486v2.313H19.248v-2.313l-.857-1.486c-.473-.816-.866-1.485-.875-1.485s-.4.669-.875,1.485l-.857,1.486v2.313H14.639v-2.313l-.857-1.486c-.473-.816-.866-1.485-.875-1.485S12.5-500.351,12.031-499.535Zm3.752,7.5v2.554H14.639v-5.108h1.145Zm4.609,0v2.554H19.248v-5.108h1.145Z"
                                                        transform="translate(-10 501.02)" fill="#1c75bc" />
                                                </svg>
                                            </div>

                                            <div class="form-check form-check-inline m-t-10">
                                                <input class="form-check-input" type="radio" name="fence_id"
                                                    id="inlineRadio1" value="{{ $fence->id }}" {{ $loop->index == 0 ? 'checked' : ''}}>
                                            </div>


                                            <p class="p-2 mb-0" style="margin-top: 2px;">{{ $fence->name }}</p>

                                            <div class="priceTxt ms-auto">
                                                <p class="my-2 ">${{$fence->price}}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach


                                <div class="">
                                    <div class="input-group mb-3 boxShadow rouned">
                                        <span class="input-group-text bg-white  border-0 " id="basic-addon1">
                                            <svg id="Group_3887" data-name="Group 3887" xmlns="http://www.w3.org/2000/svg"
                                                width="13.658" height="15.035" viewBox="0 0 13.658 15.035">
                                                <path id="Path_13391" data-name="Path 13391"
                                                    d="M55.471,22.473l2.065,2.067a1.951,1.951,0,0,0,2.756,0l1.379-1.378a1.948,1.948,0,0,0,0-2.756l-.689-.689,7.576-7.576-.689-.689-1.378-1.378-.615.615.689.689L65.949,12l-.689-.689-.617.617L66.021,13.3l-5.729,5.729-.689-.689a1.948,1.948,0,0,0-2.756,0l-1.378,1.378A1.948,1.948,0,0,0,55.471,22.473Zm2.065-3.443a.977.977,0,0,1,1.379,0L60.982,21.1a.977.977,0,0,1,0,1.378L59.6,23.851a.974.974,0,0,1-1.378,0L56.16,21.785a.977.977,0,0,1,0-1.378Z"
                                                    transform="translate(-54.9 -10.075)" fill="#1c75bc" />
                                            </svg>
                                        </span>
                                        <input type="text" class="form-control border-start-0 inputCard  "
                                            placeholder="Enter gate code (if any)" aria-label="Username"
                                            aria-describedby="basic-addon1" name="gate_code">
                                    </div>
                                </div>
                            </div>

                            <hr class="mt-0">
                            <div class="d-flex justify-content-between">
                                <p class="mb-0 mt-2">Do you need a yard cleanup before your mow?</p>
                                <div class="form-check form-switch form-switch-md">
                                    <input class="form-check-input shadow-none" type="checkbox" id="mowSwitch" name="cleanup">
                                </div>
                            </div>

                            <div id="mowContent" style="display: none;">
                                <div class="card boxShadow rounded py-2 px-1 mb-3">
                                    <div class="d-flex">
                                        <div class="p-2 mt-1">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="15.035" height="15.035"
                                                viewBox="0 0 15.035 15.035">
                                                <g id="_7564f05b5f8ad77c87137c1e8eeef719"
                                                    data-name="7564f05b5f8ad77c87137c1e8eeef719"
                                                    transform="translate(-10 -10)">
                                                    <path id="Path_13392" data-name="Path 13392"
                                                        d="M17.518,10a7.518,7.518,0,1,0,7.518,7.518A7.518,7.518,0,0,0,17.518,10Zm4.006,4.564L18.15,18.073a3.009,3.009,0,0,1,.525,1.649c0,.049,0,.1,0,.147L16.3,17.557a.276.276,0,0,0-.387-.034.238.238,0,0,0,0,.342L18.524,20.4a2.875,2.875,0,0,1-.7,1.482l-.818.871a.236.236,0,0,1-.15.087h0a.241.241,0,0,1-.149-.081l-.577-.566a.235.235,0,0,1-.058-.1.217.217,0,0,1-.015-.14l.222-1.026-1.1.156a.5.5,0,0,1-.273-.094l-2.286-2.14a.215.215,0,0,1-.006-.3l.836-.87a3.044,3.044,0,0,1,3.809-.465l3.372-3.507a.62.62,0,0,1,1.066.417A.606.606,0,0,1,21.523,14.564Z"
                                                        transform="translate(0 0)" fill="#1c75bc" />
                                                </g>
                                            </svg>

                                        </div>


                                        <div class="form-check form-check-inline m-t-10">
                                            <input class="form-check-input" type="radio" name="cleanup_id"
                                             value="{{ $sizes[0]->cleanUps[0]->id }}" checked id="light-cleanup-input">
                                        </div>

                                        <p class="p-2 mb-0" style="margin-top: 2px;">Light Cleanup</p>
                                        <div class="priceTxt ms-auto">
                                            <p class="my-2" id="light-cleanup">${{ $sizes[0]->cleanUps[0]->price }}</p>
                                        </div>
                                    </div>
                                </div>


                                <div class="card boxShadow rounded py-2 px-1 mb-3">
                                    <div class="d-flex">
                                        <div class="p-2 mt-1">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="14.238" height="15.302"
                                                viewBox="0 0 14.238 15.302">
                                                <g id="d882a6abb904f089034f7be382f5f743"
                                                    transform="translate(-43.949 -9.9)">
                                                    <path id="Path_13393" data-name="Path 13393"
                                                        d="M57.7,24.582a.187.187,0,0,1-.186.158H55.081a.188.188,0,0,1-.186-.156l-.5-2.912a.191.191,0,0,1,.186-.222h.545l-.817-.6a.342.342,0,0,1-.075-.479.346.346,0,0,1,.481-.075l1.582,1.152H58a.186.186,0,0,1,.184.22Zm-1.249-2.54a.268.268,0,1,0,.052.123A.255.255,0,0,0,56.449,22.042ZM54.6,18.69a.538.538,0,0,1-.331.108.564.564,0,0,1-.451-.225L52.407,16.68v.639l1.341,3.731a.19.19,0,0,1-.18.258H52.407V24.2a.754.754,0,0,1-1.508,0V21.31h-.361V24.2a.754.754,0,0,1-1.508,0v-2.89H47.869a.193.193,0,0,1-.18-.259l1.341-3.731V15.934l-1.268.94a.566.566,0,0,1-.607.039L46.039,16.3V15.018l1.344.742,2.225-1.652a1.765,1.765,0,0,1,2.423.2l2.685,3.6A.564.564,0,0,1,54.6,18.69Zm-2.423-5.2a2.155,2.155,0,0,1-.82-.217.856.856,0,0,0,.356-.589,1.145,1.145,0,0,1-1.992,0,.865.865,0,0,0,.356.589,2.155,2.155,0,0,1-.82.217.552.552,0,0,1-.585-.393.1.1,0,0,1,.047-.116.831.831,0,0,0,.451-.743c0-.582-.145-2.342,1.547-2.342s1.547,1.761,1.547,2.342a.828.828,0,0,0,.451.743.1.1,0,0,1,.047.116A.551.551,0,0,1,52.178,13.494Zm-6.229,8.3c-.055-.011-.111-.02-.167-.03s-.134-.017-.2-.022-.164-.009-.248-.009c-.036,0-.072,0-.106,0-.069,0-.136.006-.2.012s-.114.012-.169.02c-.091.014-.178.034-.262.055a.878.878,0,0,1,.19-.273.448.448,0,0,1,.106-.073c.014-.006.03-.012.044-.02a.9.9,0,0,1,.155-.053,1.022,1.022,0,0,1,.248-.033,1.009,1.009,0,0,1,.4.084c.014.006.031.012.045.02a.438.438,0,0,1,.1.07.847.847,0,0,1,.12.142,1,1,0,0,1,.075.134C46.032,21.817,45.99,21.808,45.948,21.8Zm-.865-.738V10.841a.325.325,0,0,1,.649,0V21.1a1.327,1.327,0,0,0-.4-.061A1.19,1.19,0,0,0,45.083,21.06Zm.247,1.015c.076,0,.153,0,.225.009a2.464,2.464,0,0,1,.671.15,1.188,1.188,0,0,1,.571,1.09,1.658,1.658,0,0,0,.971,1.482.135.135,0,0,1-.034.254,6.832,6.832,0,0,1-1.324.142c-1.158,0-2.461-.384-2.461-2.111a.959.959,0,0,1,.348-.8,2.354,2.354,0,0,1,.932-.217C45.264,22.075,45.3,22.075,45.33,22.075Z"
                                                        fill="#1c75bc" />
                                                </g>
                                            </svg>

                                        </div>


                                        <div class="form-check form-check-inline m-t-10">
                                            <input class="form-check-input" type="radio" name="cleanup_id"
                                                id="heavy-cleanup-input" value="{{ $sizes[0]->cleanUps[1]->id }}">
                                        </div>

                                        <p class="p-2 mb-0" style="margin-top: 2px;">Heavy Cleanup</p>
                                        <div class="priceTxt ms-auto">
                                            <p class="my-2" id="heavy-cleanup">${{ $sizes[0]->cleanUps[1]->price }}</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <hr class="mt-1">

                        </div>

                    </div>
                    <div class="col-lg-2">

                    </div>

                    <div class="col-lg-5 col-md-6 col-sm-12 col-12">
                        <div class="d-flex justify-content-between">
                            <p>{{ $property->address ?? '' }}</p>

                            <svg xmlns="http://www.w3.org/2000/svg" width="13.516" height="20.822"
                                viewBox="0 0 13.516 20.822">
                                <g id="location" transform="translate(-181.915 -10)">
                                    <g id="Group_7680" data-name="Group 7680" transform="translate(181.915 10)">
                                        <path id="Path_18149" data-name="Path 18149"
                                            d="M187.872-500.991a6.835,6.835,0,0,0-5.408,4.035,6.344,6.344,0,0,0-.3,4.363c.675,2.483,2.725,6.723,5.509,11.4.466.78.616.954.89,1.013a.841.841,0,0,0,.611-.233c.091-.11.8-1.292,1.4-2.346,2.606-4.569,4.3-8.3,4.733-10.429a6.676,6.676,0,0,0-4.5-7.48,5.28,5.28,0,0,0-1.981-.324C188.379-501,187.95-501,187.872-500.991Zm1.734,3.733a3.089,3.089,0,0,1,1.305.8,2.518,2.518,0,0,1,.561.776,2.872,2.872,0,0,1,.333,1.575,3.165,3.165,0,0,1-2.177,2.852,3.737,3.737,0,0,1-1.652.073,3.069,3.069,0,0,1-1.5-.849,2.9,2.9,0,0,1-.94-2.077,2.912,2.912,0,0,1,.333-1.575,3.223,3.223,0,0,1,2.273-1.689A3.653,3.653,0,0,1,189.607-497.258Z"
                                            transform="translate(-181.915 501)" fill="#0275d8" />
                                        <path id="Path_18150" data-name="Path 18150"
                                            d="M446.09-237.481a1.168,1.168,0,0,0-.543,1.6,1.147,1.147,0,0,0,2.04.009,1.2,1.2,0,0,0,.059-.99,1.379,1.379,0,0,0-.6-.621A1.384,1.384,0,0,0,446.09-237.481Z"
                                            transform="translate(-439.813 243.163)" fill="#0275d8" />
                                    </g>
                                </g>
                            </svg>
                        </div>

                        <div class="mapouter">
                            <div class="gmap_canvas"><iframe class="gmap_iframe" frameborder="0" scrolling="no"
                                marginheight="0" marginwidth="0"
                                src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q={{ $property->lat }},{{ $property->lng }}&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a
                                href="https://formatjson.org/">format json</a>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="button" class="next action-button">Next</button>
            </fieldset>
            {{-- Service End --}}

            @php
                $todayCharges = App\Models\Setting::where('field_key','on_demand_fee')->first('field_value')->field_value;
            @endphp

            <fieldset class="property-tab">
                <p class="mb-1">Upload photos (Optional)</p>
                <div class="row">
                    <div class="col-lg-9 col-md-12 col-sm-12 col-12">
                        <div class="card rounded boxShadow py-4 px-3">
                            <div class="row">
                                <div class="col-lg-5 col-md-6 col-sm-12 col-12">
                                    <p class="f-16">Property</p>
                                    <div class="zone" id="drop-area">
                                        <div id="dropZ">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="101.622" height="101.529"
                                                viewBox="0 0 101.622 101.529">
                                                <g id="efcc79cfc5561550c0753c3b7cffa208" transform="translate(-9.5 -10)">
                                                    <path id="Path_16134" data-name="Path 16134"
                                                        d="M389.1,387.3l2.372-2.741L375.33,365.9,359.2,384.556l2.372,2.741,12.1-13.984v56.625h3.358v-56.6Z"
                                                        transform="translate(-313.346 -318.909)" fill="#0275d8"
                                                        stroke="#0275d8" stroke-width="1" />
                                                    <path id="Path_16135" data-name="Path 16135"
                                                        d="M92.222,41.467c.01-.308.041-.606.041-.924,0-16.592-11.643-30.043-26-30.043-10.35,0-19.252,7-23.441,17.106a11.942,11.942,0,0,0-6.007-1.653c-6.643,0-12.136,5.586-13.214,12.906C15.7,41.99,10,50.636,10,60.842,10,73.676,19,84.087,30.114,84.1H50.249V80.216H30.114c-9.241-.01-16.757-8.707-16.757-19.375,0-8.276,4.559-15.637,11.335-18.328l1.889-.75.329-2.269c.821-5.606,4.99-9.672,9.908-9.672a8.868,8.868,0,0,1,4.5,1.242l3.06,1.776,1.479-3.563C49.6,20.223,57.621,14.371,66.266,14.371c12.485,0,22.64,11.736,22.64,26.172,0,.082-.01.164-.01.246-.01.2-.021.39-.021.585l-.082,3.953,3.429.01c8.3.031,15.052,7.855,15.052,17.445,0,9.559-6.735,17.393-15.021,17.434H73.741V84.1H92.274c10.134-.062,18.348-9.58,18.348-21.315C110.622,51.026,102.4,41.5,92.222,41.467Z"
                                                        fill="#0275d8" stroke="#0275d8" stroke-width="1" />
                                                </g>
                                            </svg>
                                            <div class="my-3">Drag and drop your images here</div>
                                            <span class="my-3">OR</span>
                                            <div class="selectFile mt-3">
                                                <label for="file">Browse</label>
                                                <input type="file" name="images[]" id="images" multiple>
                                            </div>
                                            <p class="imageCount text-center"></p>
                                        </div>

                                    </div>
                                    <p>You can upload more than 1 image</p>
                                    <div class="mb-3 mt-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Special Instructions
                                            (Optional)</label>
                                        <textarea class="form-control boxShadow f-12" id="exampleFormControlTextarea1"
                                            placeholder="Tell us anything that will help service provider complete this job" rows="4" name="instructions"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-1"></div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <p class="f-16">Schedule</p>
                                    <div class="card boxShadow rounded py-2 px-1 mb-1 bgGray">
                                        <div class="d-flex">
                                            <div class="p-2 mt-1">
                                            </div>
                                            <div class="form-check form-check-inline m-t-10">
                                                <input class="form-check-input" type="radio" name="service_day" value="today" checked id="today">
                                            </div>
                                            <p class="p-2 mb-0" style="margin-top: 2px;">Same day service (Today)</p>
                                            <div class="priceTxtWhite ms-auto">
                                                <p class="my-2 ">+ ${{$todayCharges}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <p>You will be charged extra ${{$todayCharges}} for same day service.</p>
                                    <p>Or</p>
                                    <div class="">
                                        <div class="">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="svgDropIcon" width="13.095"
                                                height="7.311" viewBox="0 0 13.095 7.311">
                                                <g id="Group_6302" data-name="Group 6302"
                                                    transform="translate(-403.632 -257.034)">
                                                    <path id="Path_15739" data-name="Path 15739"
                                                        d="M410.27,262.561a3.129,3.129,0,0,1,.233-.3q2.437-2.443,4.876-4.882a.773.773,0,0,1,.822-.275.726.726,0,0,1,.384,1.13,1.914,1.914,0,0,1-.207.226q-2.741,2.742-5.483,5.483c-.53.53-.858.53-1.387,0l-5.459-5.459a2.972,2.972,0,0,1-.258-.273.724.724,0,0,1,.053-.965.74.74,0,0,1,.966-.072,2.6,2.6,0,0,1,.275.255q2.415,2.416,4.827,4.835a2.479,2.479,0,0,1,.223.3Z"
                                                        transform="translate(0)" fill="#0275d8" />
                                                </g>
                                            </svg>
                                        </div>

                                        <input class="form-control digits bgGray boxShadow py-3 f-14" id="minMaxExample"
                                            type="text" placeholder="Select a date" name="schedule">
                                    </div>
                                    <p>You can schedule this job for up to 2 weeks.</p>


                                    <div class="mb-3 mt-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Note:</label>
                                        <p>Same day service may not be available in some areas.</p>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <input type="button" name="next" class="next action-button" value="Next" />
            </fieldset>

            {{-- Quote start --}}

            
            <fieldset>
                <div class=" rounded  mb-0 pb-5">
                    <div class="row">
                        <div class="col-lg-9 col-md-12 col-sm-12 col-12">
                            <p class="mb-1">Choose a service</p>

                            <div class="card rounded boxShadow py-4 px-3">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 px-4 service-card">
                                        <p class="f-16">Recurring services</p>
                                        <p>Please select recurring service period</p>

                                        <input class="form-check-input" type="radio" id="inlineRadio1" data-service_period_id="1" name="service_delivery" value="seven_days_price">

                                        <label class="card boxShadow rounded py-2 px-1 mb-3 bgGray position-relative bgGray">
                                            <p class=" txtCus">used by 40% customers</p>

                                            <div class="d-flex">
                                                <div class="p-2 mt-1">

                                                </div>
                                                <p class="p-2 mb-0" style="margin-top: 2px;">Every 7 days</p>
                                                <div class="priceTxtWhite ms-auto">
                                                    <p class="my-2" id="7-days">...</p>
                                                </div>
                                            </div>
                                        </label>

                                        <input class="form-check-input" type="radio" id="inlineRadio1" data-service_period_id="2" name="service_delivery" value="ten_days_price">
                                        <label class="card boxShadow rounded py-2 px-1 mb-3 bgGray position-relative bgGray">
                                            <p class=" txtCus">used by 40% customers</p>

                                            <div class="d-flex">
                                                <div class="p-2 mt-1">

                                                </div>
                                                <p class="p-2 mb-0" style="margin-top: 2px;">Every 10 days</p>
                                                <div class="priceTxtWhite ms-auto">
                                                    <p class="my-2" id="10-days">...</p>
                                                </div>
                                            </div>
                                        </label>


                                        <input class="form-check-input" type="radio" id="inlineRadio1" data-service_period_id="47" name="service_delivery" value="fourteen_days_price">

                                        <label class="card boxShadow rounded py-2 px-1 mb-3 bgGray position-relative bgGray">
                                            <p class=" txtCus">used by 40% customers</p>

                                            <div class="d-flex">
                                                <div class="p-2 mt-1">

                                                </div>

                                                {{-- <div class="form-check form-check-inline m-t-10">
                                                    <input class="form-check-input" type="radio" id="inlineRadio1" data-service_period_id="47" name="service_delivery" value="fourteen_days_price">
                                                </div> --}}

                                                <p class="p-2 mb-0" style="margin-top: 2px;">Every 14 days</p>
                                                <div class="priceTxtWhite ms-auto">
                                                    <p class="my-2" id="14-days">...</p>
                                                </div>
                                            </div>
                                        </label>
                                    </div>


                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 px-4 service-card">
                                        <p class="f-16">One time service</p>

                                        <input class="form-check-input" type="radio" id="inlineRadio1" name="service_delivery" value="price" checked>

                                        <label class="card boxShadow rounded py-2 px-1 mb-3 bgGray position-relative m-t-42 bgGray">
                                            <p class=" txtCus">used by 40% customers</p>

                                            <div class="d-flex">
                                                <div class="p-2 mt-1">

                                                </div>

                                                {{-- <div class="form-check form-check-inline m-t-10">
                                                    <input class="form-check-input" type="radio" id="inlineRadio1" name="service_delivery" value="price" checked>
                                                </div> --}}

                                                <p class="p-2 mb-0" style="margin-top: 2px;">One Time</p>
                                                <div class="priceTxtWhite ms-auto">
                                                    <p class="my-2" id="one-time">...</p>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <input type="button" name="next" class="next action-button" value="Next" id="get-summary" />
            </fieldset>

            {{-- Quote End --}}


            <fieldset>
                <div class="row">
                    <div class="col-lg-9 col-md-12 col-sm-12 col-12" id="summary">

                    </div>
                </div>
                <input type="button" name="next" class="next action-button d-none" value="Next" id="pay-btn" />
            </fieldset>

            <fieldset class="p-0 congratulations-tab">

                {{-- <h3>Successfull</h3> --}}

                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                        <img class="img-fluid for-light"src="{{ asset('assets/images/left-img.png') }}" alt="">
                    </div>


                    <div class="col-lg-4 col-md-4 col-sm-12 col-12 text-center mt-4">
                        <img class="img-fluid w-50 ms-5" src="{{ asset('assets/images/cap-img.png') }}" alt="">
                        <h1>Congratulations!</h1>
                        <p class="f-16">Your order has been placed successfully.</p>
                        <a href="{{ route('job-history.jobs','upcoming-jobs') }}" class="btn btn-primary mt-4 mb-5">Ok</a>
                    </div>


                    <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                        <img class="img-fluid for-light"src="{{ asset('assets/images/right-img.png') }}" alt="">
                    </div>
                </div>

                {{-- <input type="button" name="next" class="next action-button" value="Next" /> --}}
            </fieldset>


        </form>

    </div>
    </div>

    {{-- modal --}}



    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content px-3">
                <div class="modal-header border-bottom-0">
                    <p class="modal-title f-20 text-dark" id="exampleModalLabel">Lawn Mowing Service </p>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="f-16 mb-0 text-dark">Standard lawn mowing service includes:</p>
                    <p class="mb-0 f-14 txtGray">+ Lawn mow</p>
                    <p class="mb-0 f-14 txtGray">+ Trimming of perimeters of the lawn by weed-eater or string trimmer</p>
                    <p class="mb-0 f-14 txtGray">+ Clearing of grass clippings from all hard surfaces</p>
                    <p class="mb-0 f-14 txtGray">Your quote is based off of your grass length at the time of service. With
                        recurring service you receive
                        a discount based on frequency, however the quote may increase if the grass length is longer than 5"
                        at the time of service.</p>


                    <p class="f-14 mt-3 txtGray">One pass on a lawn mower will cut up to 1/3 of the current grass length.
                        (If grass is currently 4" tall, the
                        mower will cut the grass to a new length of 2.5"-3") This is healthy for your lawn and helps reduce
                        the
                        length of grass clippings.</p>

                    <p class="f-14 mt-3 txtGray">Please note: If your property is not as described at time of service,
                        there may be a one-time surcharge.
                        Your landscaper will assess when they arrive to the property. You will be advised of any charges
                        before
                        any work is done.</p>

                    <p class="f-16 mt-3 text-dark">Add on services include:</p>
                    <p class="mb-0 f-14 mb-0 txtGray">Bed Maintenance:</p>
                    <p class="f-14 txtGray">Landscaper will remove lawn and leaf debris from flower or garden beds. If a
                        landscaper determines
                        that there is excessive debris or additional service is needed, PLOWZ & MOWZ will contact you with
                        an
                        updated quote.</p>

                    <p class="f-16 mb-0 text-dark mt-3">Edging:</p>
                    <p class="f-14 txtGray">Landscaper will create a natural edge between your grass and hard surfaces
                        (driveway, sidewalks,
                        patios) using an edger or shovel. If the length of edging needed is deemed extensive by the
                        landscaper,
                        PLOWZ & MOWZ will contact you with an updated quote.</p>

                    <p class="f-14 mt-3 txtGray mb-4">Please note:</span> If your property is not as described at time of
                        service, there may be a one-time surcharge.
                        Your landscaper will assess when they arrive to the property. You will be advised of any charges
                        before
                        any work is done. </p>



                </div>

            </div>
        </div>
    </div>
@endsection

@push('page-scripts')

<script>

    $("#map").show();

    // $(".form-check-input").on("click", function() {
    //    $(this).css("background", "#7CC0FB");
    // })

    // $(".bgGray").click(function() {
    //     $(".bgGray").removeClass('');
    //     $(this).addClass(.css("background", "#7CC0FB"));
    // });


    // switch on off hide and show div services
    $(function() {

        let allImages = null;

        $("#fenceSwitch").click(function() {
            var target = $("#fence-contect");
            if($(this).prop('checked')) {
            target.css("display","block")
            // alert("on")
            } else {
            // alert("off")
            target.css("display","none")
            }
        })

        $("#mowSwitch").click(function() {
            var target = $("#mowContent");
            if($(this).prop('checked')) {
            target.css("display","block")
            // alert("on")
            } else {
            // alert("off")
            target.css("display","none")
            }
        })

        // stepts next and perivous
        var current_fs, next_fs, previous_fs;
        var left, opacity, scale;
        var animating;
        $(".next").click(function () {

            if($('.active-tab.property-tab').length){
                if(!$('#today').is(':checked') && $('#minMaxExample').val() == ''){
                    return errorMessage('Kindly select any schedule')
                }else{
                    getEstimations()
                }
            }

            $currentLink = $('.sidebar-list.active-link')
            $currentLink.removeClass('active-link')
            $nextLink = $currentLink.next()
            $nextLink.addClass('active-link')

            if (animating) return false;
            animating = true;

            current_fs = $(this).parent();
            current_fs.removeClass('active-tab');
            next_fs = $(this).parent().next();
            next_fs.addClass('active-tab');
            next_fs.show();

            current_fs.animate(
                { opacity: 0 },
                {
                step: function (now, mx) {
                    scale = 1 - (1 - now) * 0.2;
                    left = now * 50 + "%";
                    opacity = 1 - now;
                    current_fs.css({
                    transform: "scale(" + scale + ")",
                    position: "absolute"
                    });
                    next_fs.css({ left: left, opacity: opacity });
                },
                duration: 800,
                complete: function () {
                    current_fs.hide();
                    animating = false;
                },
                easing: "easeInOutBack"
                }
            );
        });

        $(".previous").click(function () {

            if($('.active-tab.service-tab').length || $('.active-tab.congratulations-tab').length){
                window.location.replace('{{route("lawn-mowing.start")}}')
                return
            }

            $currentLink = $('.sidebar-list.active-link')
            $currentLink.removeClass('active-link')
            $nextLink = $currentLink.prev()
            $nextLink.addClass('active-link')

            if (animating) return false;
            animating = true;

            current_fs = $('.active-tab');
            current_fs.removeClass('active-tab');
            previous_fs = current_fs.prev();
            previous_fs.addClass('active-tab');
            previous_fs.show();

            current_fs.animate(
                { opacity: 0 },
                {
                step: function (now, mx) {
                    scale = 0.8 + (1 - now) * 0.2;
                    left = (1 - now) * 50 + "%";
                    opacity = 1 - now;
                    current_fs.css({ left: left });
                    previous_fs.css({
                    transform: "scale(" + scale + ")",
                    opacity: opacity
                    });
                },
                duration: 800,
                complete: function () {
                    current_fs.hide();
                    animating = false;
                },
                easing: "easeInOutBack"
                }
            );
        });

        $(".submit").click(function () {
            return false;
        });
        //end stepts

        $(document).bind('dragover', function (e) {
            var dropZone = $('.zone'),
                timeout = window.dropZoneTimeout;
            if (!timeout) {
                dropZone.addClass('in');
            } else {
                clearTimeout(timeout);
            }
            var found = false,
                node = e.target;
            do {
                if (node === dropZone[0]) {
                    found = true;
                    break;
                }
                node = node.parentNode;
            } while (node != null);
            if (found) {
                dropZone.addClass('hover');
            } else {
                dropZone.removeClass('hover');
            }
            window.dropZoneTimeout = setTimeout(function () {
                window.dropZoneTimeout = null;
                dropZone.removeClass('in hover');
            }, 100);
        });

        $("#drop-area").on('dragover', function (e){
            e.preventDefault();
        });

        $("#drop-area").on('drop', function (e){
            e.preventDefault();
            allImages = e.originalEvent.dataTransfer.files
            $('.imageCount').html('You have selected '+allImages.length+' images')
        });

        $('#images').on('change',function(){
            allImages = $('#images')[0].files
            $('.imageCount').html('You have selected '+ allImages.length +' images')
        })

        $('#lawn-sizes').on('change',function(){
            $.ajax({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
                url: "{{route('lawn-mowing.get-cleanups')}}",
                type: 'post',
                data: {'id':$(this).val()},
                success: function(res){
                    if(res.success){
                        $('#light-cleanup').text('$'+res.data[0].price)
                        $('#light-cleanup-input').val(res.data[0].id)
                        $('#heavy-cleanup').text('$'+res.data[1].price)
                        $('#heavy-cleanup-input').val(res.data[1].id)
                    }
                },
                error: function(err){
                    errorMessage(err.responseText)
                }
            })
        })

        function getEstimations(){
            $.ajax({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
                url: "{{route('lawn-mowing.get-estimations')}}",
                type: 'post',
                data: {
                    'lawnSize' : $('#lawn-sizes').val(),
                    'lawnHeight' : $('#lawn-heights').val(),
                    'service_day' : $('#today').is(':checked') ? 'Today' : 'Schedule',
                    'corner_lot' : $('#corner_lot').is(':checked'),
                    'fence' : $('input[name="fence"]').is(':checked'),
                    'fence_id' : $('input[name="fence_id"]:checked').val(),
                    'cleanup' : $('input[name="cleanup"]').is(':checked'),
                    'cleanup_id' : $('input[name="cleanup_id"]:checked').val(),
                },
                success: function(res){
                    if(res.success){
                        $('#one-time').text('$'+res.data.oneTime.toFixed(2))
                        $('#7-days').text('$'+res.data.sevenDays.toFixed(2))
                        $('#10-days').text('$'+res.data.tenDays.toFixed(2))
                        $('#14-days').text('$'+res.data.fourteenDays.toFixed(2))
                    }
                },
                error: function(err){
                    errorMessage(err.responseText)
                }
            })
        }

        $('#today').on('click',function(){
            $('#minMaxExample').val("")
        })

        $('#minMaxExample').on('click',function(){
            $('#today').prop("checked",false)
        })

        $('#get-summary').on('click',function(){

            let formData = new FormData();
            let totalImages = allImages ? allImages.length : $('#images')[0].files.length;
            let images = allImages ? allImages :$('#images')[0].files;
            formData.append('totalImages', totalImages);
            for (let i = 0; i < totalImages; i++) {
                formData.append('images'+i, images[i]);
            }
            formData.append('property_id', "{{ $property->id }}");
            formData.append('category_id', 1);
            formData.append('service_delivery', $('input[name="service_delivery"]:checked').val());
            formData.append('service_period_id', $('input[name="service_delivery"]:checked').data('service_period_id'));
            formData.append('lawnSize', $('#lawn-sizes').val());
            formData.append('lawnHeight', $('#lawn-heights').val());
            formData.append('service_day', $('#today').is(':checked') ? 'Today' : 'Schedule');
            formData.append('date', $('input[name="schedule"]').val());
            formData.append('corner_lot', $('#corner_lot').is(':checked'));
            formData.append('fence', $('input[name="fence"]').is(':checked'));
            formData.append('fence_id', $('input[name="fence_id"]:checked').val());
            formData.append('cleanup', $('input[name="cleanup"]').is(':checked'));
            formData.append('cleanup_id', $('input[name="cleanup_id"]:checked').val());
            formData.append('gate_code', $('input[name="gate_code"]').val());
            formData.append('instructions', $('textarea[name="instructions"]').val());

            $.ajax({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
                url: "{{route('lawn-mowing.get-order-summary')}}",
                type: 'post',
                data : formData,
                processData: false,
                cache:false,
                contentType: false,
                success: function(res){
                    $('#summary').html(res)
                },
                error: function(err){
                    errorMessage(err.responseText)
                }
            })
        })

    });

</script>
@endpush
