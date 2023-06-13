@extends('layouts.snow-plowing')

@section('title', $type)

@push('page-styles')
    <style>
        .sidewalk.selected {
            border: 3px solid green;
        }
        .walkway.selected {
            border: 3px solid green;
        }
        .sidewalk-bg-img{
            height: 245px;
            background: url('/assets/images/road-img1.png') center no-repeat;
            background-size: 105% 110%;
        }
        .walkway-bg-img{
            height: 245px;
            background: url('/assets/images/road-img-2.webp') center no-repeat;
            background-size: 100% 120%;
        }
        .priceTxt {
            border: 1px solid #7CC0FB;
            background: #E6F3FF;
            width: 70px;
            border-radius: 5px;
            text-align: center;
        }

        .priceTxtWhite {
            border: 1px solid #7CC0FB;
            background: #ffffff;
            width: 25%;
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
            /* box-shadow: 0 0 0  2px #f08a5d, 0 0 0 3px #ff976; */
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
            /* color: #ff9a76; */
        }

        #multistepsform #progressbar li.active:before,
        #multistepsform #progressbar li.active:after {
            /* background: #ff9a76; */
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
            /* background: #EB6A5A; */
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
            /* background: radial-gradient(ellipse at center, #EB6A5A 0, #c9402f 100%); */
        }

        .zone.in i {
            color: #fff;
        }

        /* .zone.in label {
            background: #fff;
            color: #EB6A5A;
        } */

        .zone.hover {
            color: gray;
            border-color: white;
            background: #fff;
            border: 5px dashed gray;
        }
        /*
        .zone.hover i {
            color: #EB6A5A;
        } */

        /* .zone.hover label {
            background: #fff;
            color: #EB6A5A;
        } */

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
            top: 166px;
        }


        .qtySelector{
            border: 0px solid #ddd;
            width: 107px;
            height: 35px;
            /* margin: 10px auto 0; */
        }
        .qtySelector .fa{
            padding: 10px 5px;
            width: 35px;
            height: 100%;
            float: left;
            cursor: pointer;
        }
        .qtySelector .fa.clicked{
            font-size: 12px;
            padding: 12px 5px;
        }
        .qtySelector .fa-minus{
            border-right: 0px solid #ddd;
            background-color: #7CC0FB;
            color: #fff;
        }
        .qtySelector .fa-plus{
            border-left: 1px solid #ddd;
            background-color: #24B550;
            color: #fff;
        }
        .qtySelector .counter, .qtySelector .optionalCounter{
            border: none;
            padding: 5px;
            width: 35px;
            height: 100%;
            float: left;
            text-align: center
        }

    </style>
@endpush

@section('body')
    <br>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-12 ">
            <h2 class="my-4">{{$type}} Snow Plowing  </h2>
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
                                transform="translate(0 0)" fill="#0275d8" stroke="#0275d8" stroke-width="0.5" />
                            <path id="Path_16132" data-name="Path 16132"
                                d="M325.136,199.725c0,.259.006.5,0,.742-.016.5-.257.8-.643.822-.4.019-.681-.3-.711-.829-.07-1.209.253-1.714,1.448-2.261a1.913,1.913,0,0,0,1.151-2.094,1.982,1.982,0,0,0-1.812-1.647,1.936,1.936,0,0,0-1.94,1.319,4.075,4.075,0,0,0-.1.6c-.077.45-.352.722-.714.7a.7.7,0,0,1-.634-.824,3.146,3.146,0,0,1,1.818-2.793,3.3,3.3,0,0,1,4.732,3.37,3.2,3.2,0,0,1-1.986,2.614Z"
                                transform="translate(-46.684 -33.261)" fill="#0275d8" stroke="#0275d8" stroke-width="0.5" />
                            <path id="Path_16133" data-name="Path 16133"
                                d="M335.748,250.283a1.331,1.331,0,0,1-1.325,1.324,1.335,1.335,0,0,1,.023-2.67A1.332,1.332,0,0,1,335.748,250.283Z"
                                transform="translate(-56.654 -79.895)" fill="#0275d8" stroke="#0275d8" stroke-width="0.5" />
                        </g>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class=" rounded mb-0 pb-5">

        <!-- multistep form -->
        <form id="multistepsform" method="post">
            @csrf
            {{-- Service start --}}
            <fieldset class="service-tab active-tab">

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">

                        <div class="row">
                            <div class="d-flex">
                                <p class="f-16">Driveway (Select number of cars)</p>
                                <div class="cursor ms-3" data-bs-toggle="modal" data-bs-target="#driveway-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="p-1" width="25.518" height="25.52"
                                        viewBox="0 0 25.518 25.52">
                                        <g id="Group_6442" data-name="Group 6442" transform="translate(-265.015 -153.008)">
                                            <path id="Path_16131" data-name="Path 16131"
                                                d="M277.814,178.278a12.51,12.51,0,1,1,12.469-12.519A12.524,12.524,0,0,1,277.814,178.278Zm11.109-12.5a11.151,11.151,0,1,0-11.16,11.142A11.138,11.138,0,0,0,288.923,165.776Z"
                                                transform="translate(0 0)" fill="#0275d8" stroke="#0275d8" stroke-width="0.5" />
                                            <path id="Path_16132" data-name="Path 16132"
                                                d="M325.136,199.725c0,.259.006.5,0,.742-.016.5-.257.8-.643.822-.4.019-.681-.3-.711-.829-.07-1.209.253-1.714,1.448-2.261a1.913,1.913,0,0,0,1.151-2.094,1.982,1.982,0,0,0-1.812-1.647,1.936,1.936,0,0,0-1.94,1.319,4.075,4.075,0,0,0-.1.6c-.077.45-.352.722-.714.7a.7.7,0,0,1-.634-.824,3.146,3.146,0,0,1,1.818-2.793,3.3,3.3,0,0,1,4.732,3.37,3.2,3.2,0,0,1-1.986,2.614Z"
                                                transform="translate(-46.684 -33.261)" fill="#0275d8" stroke="#0275d8" stroke-width="0.5" />
                                            <path id="Path_16133" data-name="Path 16133"
                                                d="M335.748,250.283a1.331,1.331,0,0,1-1.325,1.324,1.335,1.335,0,0,1,.023-2.67A1.332,1.332,0,0,1,335.748,250.283Z"
                                                transform="translate(-56.654 -79.895)" fill="#0275d8" stroke="#0275d8" stroke-width="0.5" />
                                        </g>
                                    </svg>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                <div id="" class="">
                                    <p class="mb-0">Width</p>
                                    <div class="card boxShadow rounded py-2 px-1 mb-3">
                                        <div class="d-flex justify-content-between">

                                            <p class="mb-0 ps-2 mt-2" style="margin-top: 2px;">Car(s)</p>

                                            <div class="qtySelector text-center ">
                                                <i class="fa fa-minus decreaseQty"></i>
                                                <input type="text" class="counter" name="driveway-width" value="1" />
                                                <i class="fa fa-plus increaseQty"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                <div id="" class="">
                                    <p class="mb-0">Length</p>
                                    <div class="card boxShadow rounded py-2 px-1 mb-3">
                                        <div class="d-flex justify-content-between">

                                            <p class="mb-0 ps-2 mt-2" style="margin-top: 2px;">Car(s)</p>

                                            <div class="qtySelector text-center ">
                                                <i class="fa fa-minus decreaseQty"></i>
                                                <input type="text" class="counter" name="driveway-length" value="1" />
                                                <i class="fa fa-plus increaseQty"></i>
                                              </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <p class="mb-1">Snow Depth</p>
                                <select class="form-select boxShadow shadow-none selectBox" id="snow-depth" name="snow-depth">
                                    @foreach ($snowDepths as $snowDepth)
                                        <option value="{{ $snowDepth->id }}">{{ $snowDepth->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row mt-2">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="sidewalk ">
                                        <div class="sidewalk-bg-img">
                                            <input type="checkbox" name="sidewalk" id="sidewalk-option" class="d-none">
                                            <button type="button" class="btn btn-primary w-100 rounded-0">Sidewalk</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="walkway ">
                                        <div class="walkway-bg-img">
                                        <input type="checkbox" name="walkway" id="walkway-option" class="d-none">
                                        <button type="button" class="btn btn-primary w-100 rounded-0">Walkway</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1"> </div>

                    <div class="col-lg-5 col-md-4 col-sm-12 col-12">
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
                            <div class="gmap_canvas">
                                <iframe class="gmap_iframe" frameborder="0" scrolling="no"
                                    marginheight="0" marginwidth="0"
                                    src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q={{ $property->lat }},{{ $property->lng }}&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-12">
                        <div class="row mt-3 d-none" id="sidewalk">
                            <div class="d-flex">
                                <p class="f-14">Sidewalk (Optional)</p>
                                <div class="cursor ms-3" data-bs-toggle="modal" data-bs-target="#sidewalk-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="p-1" width="25.518" height="25.52"
                                        viewBox="0 0 25.518 25.52">
                                        <g id="Group_6442" data-name="Group 6442" transform="translate(-265.015 -153.008)">
                                            <path id="Path_16131" data-name="Path 16131"
                                                d="M277.814,178.278a12.51,12.51,0,1,1,12.469-12.519A12.524,12.524,0,0,1,277.814,178.278Zm11.109-12.5a11.151,11.151,0,1,0-11.16,11.142A11.138,11.138,0,0,0,288.923,165.776Z"
                                                transform="translate(0 0)" fill="#0275d8" stroke="#0275d8" stroke-width="0.5" />
                                            <path id="Path_16132" data-name="Path 16132"
                                                d="M325.136,199.725c0,.259.006.5,0,.742-.016.5-.257.8-.643.822-.4.019-.681-.3-.711-.829-.07-1.209.253-1.714,1.448-2.261a1.913,1.913,0,0,0,1.151-2.094,1.982,1.982,0,0,0-1.812-1.647,1.936,1.936,0,0,0-1.94,1.319,4.075,4.075,0,0,0-.1.6c-.077.45-.352.722-.714.7a.7.7,0,0,1-.634-.824,3.146,3.146,0,0,1,1.818-2.793,3.3,3.3,0,0,1,4.732,3.37,3.2,3.2,0,0,1-1.986,2.614Z"
                                                transform="translate(-46.684 -33.261)" fill="#0275d8" stroke="#0275d8" stroke-width="0.5" />
                                            <path id="Path_16133" data-name="Path 16133"
                                                d="M335.748,250.283a1.331,1.331,0,0,1-1.325,1.324,1.335,1.335,0,0,1,.023-2.67A1.332,1.332,0,0,1,335.748,250.283Z"
                                                transform="translate(-56.654 -79.895)" fill="#0275d8" stroke="#0275d8" stroke-width="0.5" />
                                        </g>
                                    </svg>
                                </div>
                            </div>


                            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                <div id="" class="">
                                    <p class="mb-0">Small</p>
                                    <div class="card boxShadow rounded py-2 px-1 mb-3 radio-selector-box">
                                        <div class="d-flex justify-content-between">
                                            <p class="mb-0 ps-2" style="margin-top: 2px;">0-100 sq ft</p>
                                            <div class="d-flex align-items-center pe-3">
                                                <input type="radio" class="optionalCounter sidewalks" name="sidewalks" value="small" checked />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                <div id="" class="">
                                    <p class="mb-0">Medium</p>
                                    <div class="card boxShadow rounded py-2 px-1 mb-3 radio-selector-box">
                                        <div class="d-flex justify-content-between">
                                            <p class="mb-0 ps-2" style="margin-top: 2px;">100-200 sq ft</p>
                                            <div class="d-flex align-items-center pe-3">
                                                <input type="radio" class="optionalCounter sidewalks" name="sidewalks" value="medium" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                <div id="" class="">
                                    <p class="mb-0">Large</p>
                                    <div class="card boxShadow rounded py-2 px-1 mb-3 radio-selector-box">
                                        <div class="d-flex justify-content-between">
                                            <p class="mb-0 ps-2" style="margin-top: 2px;">200-300 sq ft</p>
                                            <div class="d-flex align-items-center pe-3">
                                                <input type="radio" class="optionalCounter sidewalks" name="sidewalks" value="large" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row mt-3 d-none" id="walkway">
                            <div class="d-flex">
                                <p class="f-14">Walkway (Optional)</p>
                                <div class="cursor ms-3" data-bs-toggle="modal" data-bs-target="#walkway-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="p-1" width="25.518" height="25.52"
                                        viewBox="0 0 25.518 25.52">
                                        <g id="Group_6442" data-name="Group 6442" transform="translate(-265.015 -153.008)">
                                            <path id="Path_16131" data-name="Path 16131"
                                                d="M277.814,178.278a12.51,12.51,0,1,1,12.469-12.519A12.524,12.524,0,0,1,277.814,178.278Zm11.109-12.5a11.151,11.151,0,1,0-11.16,11.142A11.138,11.138,0,0,0,288.923,165.776Z"
                                                transform="translate(0 0)" fill="#0275d8" stroke="#0275d8" stroke-width="0.5" />
                                            <path id="Path_16132" data-name="Path 16132"
                                                d="M325.136,199.725c0,.259.006.5,0,.742-.016.5-.257.8-.643.822-.4.019-.681-.3-.711-.829-.07-1.209.253-1.714,1.448-2.261a1.913,1.913,0,0,0,1.151-2.094,1.982,1.982,0,0,0-1.812-1.647,1.936,1.936,0,0,0-1.94,1.319,4.075,4.075,0,0,0-.1.6c-.077.45-.352.722-.714.7a.7.7,0,0,1-.634-.824,3.146,3.146,0,0,1,1.818-2.793,3.3,3.3,0,0,1,4.732,3.37,3.2,3.2,0,0,1-1.986,2.614Z"
                                                transform="translate(-46.684 -33.261)" fill="#0275d8" stroke="#0275d8" stroke-width="0.5" />
                                            <path id="Path_16133" data-name="Path 16133"
                                                d="M335.748,250.283a1.331,1.331,0,0,1-1.325,1.324,1.335,1.335,0,0,1,.023-2.67A1.332,1.332,0,0,1,335.748,250.283Z"
                                                transform="translate(-56.654 -79.895)" fill="#0275d8" stroke="#0275d8" stroke-width="0.5" />
                                        </g>
                                    </svg>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                <div id="" class="">
                                    <p class="mb-0">Small</p>
                                    <div class="card boxShadow rounded py-2 px-1 mb-3 radio-selector-box">
                                        <div class="d-flex justify-content-between">
                                            <p class="mb-0 ps-2" style="margin-top: 2px;">0-100 sq ft</p>
                                            <div class="d-flex align-items-center pe-3">
                                                <input type="radio" class="optionalCounter" name="walkways" value="small" checked />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                <div id="" class="">
                                    <p class="mb-0">Medium</p>
                                    <div class="card boxShadow rounded py-2 px-1 mb-3 radio-selector-box">
                                        <div class="d-flex justify-content-between">
                                            <p class="mb-0 ps-2" style="margin-top: 2px;">100-200 sq ft</p>
                                            <div class="d-flex align-items-center pe-3">
                                                <input type="radio" class="optionalCounter" name="walkways" value="medium" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                <div id="" class="">
                                    <p class="mb-0">Large</p>
                                    <div class="card boxShadow rounded py-2 px-1 mb-3 radio-selector-box">
                                        <div class="d-flex justify-content-between">
                                            <p class="mb-0 ps-2" style="margin-top: 2px;">200-300 sq ft</p>
                                            <div class="d-flex align-items-center pe-3">
                                                <input type="radio" class="optionalCounter" name="walkways" value="large" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <button type="button" class="next action-button mt-4">Next</button>
            </fieldset>
            {{-- Service End --}}



            <fieldset>
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
                                            <div class="my-3">Drag and drop your file here</div>
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
                                    @foreach ($snowPlowingSchedules as $schedule)
                                        <div class="card boxShadow rounded py-2 px-1 mb-1 bgGray mt-3">
                                            <div class="d-flex">
                                                <div class="p-2 mt-1"></div>
                                                <div class="form-check form-check-inline m-t-10">
                                                    <input class="form-check-input" type="radio" name="schedule" value="{{ $schedule->id }}" {{ $loop->index == 0 ? 'checked' : ''}}>
                                                </div>
                                                <p class="p-2 mb-0" style="margin-top: 2px;">{{ $schedule->name }}</p>
                                                <div class="priceTxtWhite ms-auto">
                                                    <p class="my-2">{{ $schedule->time }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <input type="button" name="next" class="next action-button" value="Next" id="get-summary"/>
            </fieldset>

            {{-- Quote End --}}

            <fieldset>
                <div class="row">
                    <div class="col-lg-11 col-md-12 col-sm-12 col-12" id="summary">

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

                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <h3>Service Details</h3>
                    </div>
                    <p class="f-16 mt-3 text-dark">Driveway</p>
                    <p class="f-14 txtGray">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                        industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type
                        and scrambled it to make a type specimen book. It has survived not only five centuries, but also the
                        leap into electronic typesetting, remaining essentially unchanged.
                        </p>

                    <p class="f-16 mt-3 text-dark">Sidewalk</p>
                    <p class="f-14 txtGray">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type
                        and scrambled it to make a type specimen book. It has survived not only five centuries, but also the
                        leap into electronic typesetting, remaining essentially unchanged.
                        </p>

                    <p class="f-16 mt-3 text-dark">Walkway</p>
                    <p class="f-14 txtGray">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                        industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type
                        and scrambled it to make a type specimen book. It has survived not only five centuries, but also the
                        leap into electronic typesetting, remaining essentially unchanged.
                        </p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="driveway-info" tabindex="-1" aria-labelledby="driveway-info" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content px-3">
                <div class="modal-header border-bottom-0">
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <h3>Driveway Info</h3>
                    </div>
                    <div class="text-center">
                        <img src="{{ asset('assets/images/driveway.png') }}" class="mt-3" width="350" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="sidewalk-info" tabindex="-1" aria-labelledby="sidewalk-info" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content px-3">
                <div class="modal-header border-bottom-0">
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <h3>Sidewalk Info</h3>
                    </div>
                    <p class="mt-2 text-center">Select whether your sidewalk is small, medium, or large</p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="walkway-info" tabindex="-1" aria-labelledby="walkway-info" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content px-3">
                <div class="modal-header border-bottom-0">
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <h3>Walkway Info</h3>
                    </div>
                    <p class="mt-2 text-center">Select weather your walkway is small, medium, or large</p>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('page-scripts')
    <script>
        // switch on off hide and show div services
        $(function() {

            let allImages = null;

            // stepts next and perivous
            var current_fs, next_fs, previous_fs;
            var left, opacity, scale;
            var animating;

            $(".next").click(function() {

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

                current_fs.animate({
                    opacity: 0
                }, {
                    step: function(now, mx) {
                        scale = 1 - (1 - now) * 0.2;
                        left = now * 50 + "%";
                        opacity = 1 - now;
                        current_fs.css({
                            transform: "scale(" + scale + ")",
                            position: "absolute"
                        });
                        next_fs.css({
                            left: left,
                            opacity: opacity
                        });
                    },
                    duration: 800,
                    complete: function() {
                        current_fs.hide();
                        animating = false;
                    },
                    easing: "easeInOutBack"
                });
            });

            $(".previous").click(function() {

                if($('.active-tab.service-tab').length || $('.active-tab.congratulations-tab').length){
                    window.location.replace('{{route("snow-plowing.start")}}')
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

                current_fs.animate({
                    opacity: 0
                }, {
                    step: function(now, mx) {
                        scale = 0.8 + (1 - now) * 0.2;
                        left = (1 - now) * 50 + "%";
                        opacity = 1 - now;
                        current_fs.css({
                            left: left
                        });
                        previous_fs.css({
                            transform: "scale(" + scale + ")",
                            opacity: opacity
                        });
                    },
                    duration: 800,
                    complete: function() {
                        current_fs.hide();
                        animating = false;
                    },
                    easing: "easeInOutBack"
                });
            });

            $(".submit").click(function() {
                return false;
            });
            //end stepts

            $(document).on("click",".radio-selector-box", function (event) {
                $(this).find('input').prop("checked", true);
            });

            // $('.radio-selector-box').click(function() {
            //     $('.hli').removeClass('hli');
            //     $(this).addClass('.radio-selector-box').find('input').prop('checked', true)
            // });

            $(document).bind('dragover', function(e) {
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
                window.dropZoneTimeout = setTimeout(function() {
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


            var minVal = 1 // Set Max and Min values

            // Increase product quantity on cart page
            $(".increaseQty").on('click', function(){
                var $parentElm = $(this).parents(".qtySelector");
                $(this).addClass("clicked");
                setTimeout(function(){
                    $(".clicked").removeClass("clicked");
                },100);
                var value = $parentElm.find(".counter").length ? $parentElm.find(".counter").val() : $parentElm.find(".optionalCounter").val();
                value++;
                $parentElm.find(".counter").length ? $parentElm.find(".counter").val(value) : $parentElm.find(".optionalCounter").val(value);
            });

            // Decrease product quantity on cart page
            $(".decreaseQty").on('click', function(){
                var $parentElm = $(this).parents(".qtySelector");
                $(this).addClass("clicked");
                setTimeout(function(){
                    $(".clicked").removeClass("clicked");
                },100);
                var value = $parentElm.find(".counter").length ? $parentElm.find(".counter").val() : $parentElm.find(".optionalCounter").val();
                if (value > 1 && $parentElm.find(".counter").length) {
                    value--;
                }else if(value > 0 && $parentElm.find(".optionalCounter").length){
                    value--;
                }
                $parentElm.find(".counter").length ? $parentElm.find(".counter").val(value) : $parentElm.find(".optionalCounter").val(value);
            });

            $('.sidewalk').on('click',function(){
                $(this).find('input').attr("checked", !$(this).find('input').attr("checked"));
                $(this).toggleClass('selected');
                $('#sidewalk').toggleClass('d-none');
            })

            $('.walkway').on('click',function(){
                $(this).find('input').attr("checked", !$(this).find('input').attr("checked"));
                $(this).toggleClass('selected');
                $('#walkway').toggleClass('d-none');
            })

            $('#get-summary').on('click',function(){

                let formData = new FormData();
                let totalImages = allImages ? allImages.length : $('#images')[0].files.length;
                let images = allImages ? allImages :$('#images')[0].files;
                formData.append('totalImages', totalImages);
                for (let i = 0; i < totalImages; i++) {
                    formData.append('images'+i, images[i]);
                }

                // let sidewalks = {};
                // $.each( $('input[name^=sidewalks]'), function ( index, val ) {
                //     sidewalks[ val.getAttribute('data-id') ] = val.value;
                // });

                // let walkways = {};
                // $.each( $('input[name^=walkways]'), function ( index, val ) {
                //     walkways[ val.getAttribute('data-id') ] = val.value;
                // });

                formData.append('service_for', "{{ $type }}");
                formData.append('property_id', "{{ $property->id }}");
                formData.append('driveway_width', $('input[name="driveway-width"]').val());
                formData.append('driveway_length', $('input[name="driveway-length"]').val());
                formData.append('snow_depth', $('#snow-depth').val());
                formData.append('sidewalk', $('#sidewalk-option').is(':checked'));
                formData.append('sidewalks', $('input[name=sidewalks]:checked').val());
                formData.append('walkway', $('#walkway-option').is(':checked'));
                formData.append('walkways', $('input[name=walkways]:checked').val());
                formData.append('schedule_id', $('input[name="schedule"]:checked').val());
                formData.append('instructions', $('textarea[name="instructions"]').val());

                $.ajax({
                    headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
                    url: "{{route('snow-plowing.get-order-summary')}}",
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
