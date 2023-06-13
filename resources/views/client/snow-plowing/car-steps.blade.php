@extends('layouts.snow-plowing')

@section('title', $type)

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

        .service-cards{
            gap: 25px
        }

        .service-card{
            width: 250px;
            margin-bottom: 0;
            flex-grow: 1;
        }
    </style>
@endpush

@section('body')
    <br>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-12 ">
            <h2 class="my-4">Car Snow Removal</h2>
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
        <form id="multistepsform" action="" method="post">
            @csrf
            {{-- Service start --}}
            <fieldset class="service-tab active-tab">

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">

                        <div class="row">

                            <p class="f-16">Where do you need service?</p>

                            <div class="d-flex flex-wrap service-cards">
                                @foreach ($carTypes as $carType)
                                    <div class="card boxShadow rounded py-2 px-1 service-card" >
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex">
                                                <div class="p-2 mt-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21.671" height="15.249"
                                                        viewBox="0 0 21.671 15.249">
                                                        <g id="Group_7108" data-name="Group 7108"
                                                            transform="translate(-1344.377 -454.173)">
                                                            <path id="Path_13634" data-name="Path 13634"
                                                                d="M1365.923,466.279a1.171,1.171,0,0,1-.71.806c0,.353,0,.7,0,1.049a1.079,1.079,0,0,1-1.163,1.159q-1.171,0-2.343,0a1.073,1.073,0,0,1-1.14-1.138c0-.326,0-.651,0-.988h-10.7c0,.314,0,.625,0,.936a1.767,1.767,0,0,1-.044.413,1.038,1.038,0,0,1-.979.774c-.865.009-1.729.011-2.594,0a1.056,1.056,0,0,1-1.024-1.039c-.01-.383,0-.766,0-1.153l-.115-.061a1.055,1.055,0,0,1-.6-.981c0-1.548,0-3.1,0-4.643a1.1,1.1,0,0,1,.33-.808l1.124-1.124c.048-.048.093-.1.171-.182-.2,0-.366,0-.529,0a1.071,1.071,0,1,1-.008-2.142c.125,0,.251,0,.376,0a1.382,1.382,0,0,1,1.138.337c.081-.24.161-.476.24-.712.139-.416.274-.833.418-1.247a1.765,1.765,0,0,1,1.667-1.232c.063,0,.126,0,.189,0q5.594,0,11.188,0a2.447,2.447,0,0,1,.68.079,1.7,1.7,0,0,1,1.17,1.13c.2.585.394,1.175.59,1.762.024.071.051.142.085.235.512-.511,1.141-.363,1.731-.323a.936.936,0,0,1,.784.646c.023.056.05.111.075.167v.46a1.075,1.075,0,0,1-.622.733,6.539,6.539,0,0,1-.968.151c.362.362.72.729,1.09,1.085a1.665,1.665,0,0,1,.5.75Zm-18.775-6.979c-.586.587-1.164,1.171-1.749,1.75a.577.577,0,0,0-.182.446c.005.962,0,1.924,0,2.886,0,.544,0,1.088,0,1.632a.37.37,0,0,0,.406.422c.056,0,.112,0,.167,0h18.867c.454,0,.548-.095.548-.554,0-1.45,0-2.9,0-4.351a.662.662,0,0,0-.216-.517c-.494-.482-.98-.972-1.465-1.463a2.545,2.545,0,0,1-.2-.251Zm15.754-.731a.341.341,0,0,0,0-.071c-.308-.924-.61-1.85-.927-2.77a1.025,1.025,0,0,0-1.028-.707q-5.728,0-11.456,0a1.037,1.037,0,0,0-1.05.764c-.157.461-.309.924-.462,1.386l-.467,1.4Zm-16.97,8.595c0,.086,0,.154,0,.222,0,.286-.008.572.006.857a.344.344,0,0,0,.363.332c.216.008.432,0,.648,0,.592,0,1.184,0,1.776,0,.234,0,.4-.108.407-.3.018-.366.005-.733.005-1.107Zm15.351,0c0,.317,0,.615,0,.913a1.411,1.411,0,0,0,0,.167.361.361,0,0,0,.387.331c.23.005.46,0,.69,0,.571,0,1.143,0,1.714,0,.234,0,.4-.107.406-.306.019-.365.005-.732.005-1.106Zm-14.644-8.585c0-.138.005-.249,0-.359a.339.339,0,0,0-.346-.344c-.244-.008-.488-.009-.732,0a.35.35,0,0,0-.01.7C1345.9,458.586,1346.259,458.578,1346.64,458.578Zm17.163,0c.36,0,.707.006,1.053,0a.352.352,0,0,0,.35-.346.358.358,0,0,0-.36-.357c-.146-.007-.293.006-.438,0C1363.8,457.831,1363.748,458.059,1363.8,458.579Z"
                                                                transform="translate(0 0)" fill="#0275d8" stroke="#0275d8"
                                                                stroke-width="0.25" />
                                                            <path id="Path_13635" data-name="Path 13635"
                                                                d="M1457.723,581.937q1.893,0,3.786,0a.784.784,0,0,1,.813.53.715.715,0,0,1-.207.8c-.4.351-.8.692-1.223,1.014a.818.818,0,0,1-.463.154c-1.806.01-3.611.007-5.417.006a.814.814,0,0,1-.533-.208c-.364-.3-.73-.6-1.091-.911a.764.764,0,0,1-.26-.88.781.781,0,0,1,.769-.506c1.129,0,2.259,0,3.389,0Zm-2.739,1.785h5.48l1.209-1.012c-.259-.086-7.738-.067-7.881.018Z"
                                                                transform="translate(-102.508 -120.506)" fill="#0275d8"
                                                                stroke="#0275d8" stroke-width="0.25" />
                                                            <path id="Path_13636" data-name="Path 13636"
                                                                d="M1627.745,584.43c-.453,0-.906,0-1.359,0a.772.772,0,0,1-.5-1.395c.347-.291.7-.576,1.044-.87a.973.973,0,0,1,.67-.244c.488.005.976,0,1.463,0a.731.731,0,0,1,.793.8c0,.314,0,.627,0,.941a.72.72,0,0,1-.773.77C1628.637,584.432,1628.19,584.43,1627.745,584.43Zm1.382-1.773h-1.643a5.481,5.481,0,0,0-1.169,1.042h2.812Z"
                                                                transform="translate(-265.356 -120.491)" fill="#0275d8"
                                                                stroke="#0275d8" stroke-width="0.25" />
                                                            <path id="Path_13637" data-name="Path 13637"
                                                                d="M1372.1,584.422c-.446,0-.892,0-1.338,0a.72.72,0,0,1-.773-.769c0-.328,0-.655,0-.983a.719.719,0,0,1,.749-.754c.522-.007,1.045,0,1.568,0a.826.826,0,0,1,.541.189c.381.316.765.628,1.142.948a.769.769,0,0,1-.508,1.368C1373.021,584.425,1372.561,584.422,1372.1,584.422Zm.29-1.768h-1.67v1.033h2.815l.031-.052Z"
                                                                transform="translate(-24.061 -120.484)" fill="#0275d8"
                                                                stroke="#0275d8" stroke-width="0.25" />
                                                            <path id="Path_13638" data-name="Path 13638"
                                                                d="M1475.938,645.925h3.031a1.76,1.76,0,0,1,.23.008.353.353,0,0,1,.042.691.836.836,0,0,1-.207.021h-6.186c-.313,0-.479-.132-.474-.372a.335.335,0,0,1,.284-.337,1.553,1.553,0,0,1,.25-.012Z"
                                                                transform="translate(-120.725 -180.919)" fill="#0275d8"
                                                                stroke="#0275d8" stroke-width="0.25" />
                                                            <path id="Path_13639" data-name="Path 13639"
                                                                d="M1378.144,646.649c-.391,0-.781,0-1.171,0-.263,0-.416-.147-.412-.37a.339.339,0,0,1,.283-.338.8.8,0,0,1,.146-.011h2.343a.807.807,0,0,1,.146.01.353.353,0,0,1,.063.676.822.822,0,0,1-.247.033C1378.911,646.651,1378.527,646.649,1378.144,646.649Z"
                                                                transform="translate(-30.267 -180.921)" fill="#0275d8"
                                                                stroke="#0275d8" stroke-width="0.25" />
                                                            <path id="Path_13640" data-name="Path 13640"
                                                                d="M1640.023,646.641c-.375,0-.751,0-1.126,0a.749.749,0,0,1-.245-.038.353.353,0,0,1,.066-.669.744.744,0,0,1,.145-.012q1.178,0,2.357,0c.257,0,.4.11.423.309.028.24-.132.406-.41.41C1640.83,646.645,1640.426,646.641,1640.023,646.641Z"
                                                                transform="translate(-277.511 -180.913)" fill="#0275d8"
                                                                stroke="#0275d8" stroke-width="0.25" />
                                                        </g>
                                                    </svg>

                                                </div>

                                                <div class="form-check form-check-inline m-t-10">
                                                    <input class="form-check-input" type="radio" name="car"
                                                        id="inlineRadio1" value="{{ $carType->id }}" {{ $loop->index == 0 ? 'checked' : '' }}>
                                                </div>

                                                <p class="p-2 mb-0" style="margin-top: 2px;">{{ $carType->name }}</p>
                                            </div>
                                            <div class="priceTxt">
                                                <p class="my-2 ">{{ $carType->price }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="my-4">
                                <p class="mb-1">Choose Color</p>
                                <select class="form-select boxShadow shadow-none selectBox" id="colors">
                                    @foreach ($colors as $color)
                                        <option value="{{ $color->id }}" {{ $loop->index == 0 ? 'selected' : '' }}>{{ $color->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="">
                                <div class="input-group mb-3 boxShadow rouned">
                                    <span class="input-group-text bg-white  border-0 " id="basic-addon1">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="27.271" height="12.552"
                                            viewBox="0 0 27.271 12.552">
                                            <g id="Group_7122" data-name="Group 7122"
                                                transform="translate(-1509.552 -430.029)">
                                                <path id="Path_13641" data-name="Path 13641"
                                                    d="M1536.823,442.268a1.263,1.263,0,0,1-.919.312q-12.691-.01-25.383-.006c-.823,0-.968-.144-.968-.949q0-5.321,0-10.643c0-.806.143-.948.969-.948q12.692,0,25.383-.006a1.263,1.263,0,0,1,.919.312Zm-21.586-6.377c.428.451.772.832,1.138,1.192.308.3.6.321.844.094s.248-.557-.072-.882c-.36-.365-.745-.705-1.191-1.123.442-.417.84-.768,1.209-1.146.312-.32.313-.653.033-.879a.536.536,0,0,0-.8.088c-.361.385-.71.782-1.16,1.279-.442-.493-.779-.9-1.153-1.277a.544.544,0,0,0-.932.074.554.554,0,0,0,.164.714c.384.362.776.716,1.24,1.142-.459.422-.832.748-1.185,1.094-.334.328-.372.628-.146.878.248.274.571.252.92-.094S1514.827,436.327,1515.238,435.891Zm6.119-.711c-.486.452-.911.8-1.276,1.21a.712.712,0,0,0-.1.614.646.646,0,0,0,.495.3.831.831,0,0,0,.49-.267c.372-.342.723-.708,1.126-1.107.346.367.644.7.954,1.01.43.436.716.5,1,.232s.233-.581-.23-1.033c-.316-.308-.651-.6-1.05-.961.444-.415.828-.755,1.188-1.118.327-.329.348-.635.1-.884s-.559-.223-.878.1c-.355.364-.684.755-1.1,1.221-.4-.444-.7-.793-1.019-1.122-.416-.428-.72-.477-.993-.19-.255.268-.2.566.192.955C1520.575,434.465,1520.918,434.771,1521.357,435.18Zm-6.1,5.076c.71,0,1.42.007,2.129,0,.424-.005.661-.2.676-.519.015-.339-.238-.562-.683-.564q-2.129-.01-4.259,0c-.475,0-.691.185-.689.545s.217.534.7.539C1513.839,440.262,1514.548,440.256,1515.258,440.256Zm6.808-1.088c-.727,0-1.456-.008-2.183,0-.432.007-.638.2-.635.544s.205.534.644.537q2.155.013,4.312,0c.422,0,.662-.2.676-.518.015-.336-.242-.559-.683-.565C1523.486,439.162,1522.776,439.168,1522.067,439.168Zm6.763,1.089h1.916c.089,0,.178,0,.266,0,.442-.017.7-.23.683-.567-.015-.318-.252-.516-.677-.518q-2.129-.011-4.258,0c-.479,0-.7.18-.7.538s.217.541.69.547C1527.446,440.263,1528.138,440.257,1528.83,440.257Z"
                                                    transform="translate(0)" fill="#0275d8" />
                                            </g>
                                        </svg>

                                    </span>
                                    <input type="text" class="form-control border-start-0 inputCard  "
                                        placeholder="Enter car plate number" aria-label="Username"
                                        aria-describedby="basic-addon1" name="car_number">
                                </div>
                            </div>


                        </div>



                    </div>
                    <div class="col-lg-1">

                    </div>

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
                        <div class="card rounded boxShadow py-4 px-3">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="d-flex justify-content-between">
                                        <p>Service Details </p>
                                        <p>Due date: 11-15-2022</p>
                                    </div>

                                    <div class="card">
                                        <ul class="list-group">
                                            <li
                                                class="list-group-item text-center bg-primary py-4 px-4">
                                                Service for car<span class=""></span></li>
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center py-2 px-4 border-bottom-0 mt-3">
                                                Color<span class="text-primary">Black</span></li>
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center py-2 px-4 border-bottom-0">
                                                Plate number<span class="text-primary">SUV-1234</span></li>

                                            <li class="list-group-item d-flex justify-content-between align-items-center py-2 px-4 border-bottom-0">
                                                Date<span class="text-primary">11-15-2022</span></li>

                                                <li class="list-group-item d-flex justify-content-between align-items-center py-2 px-4 mb-3 ">
                                                Schedule time<span class="text-primary">Tomorrow (2-10 am)</span></li>

                                        </ul>
                                    </div>



                                    <div class="card">
                                        <ul class="list-group">
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center bg-primary py-4 px-4">
                                                Service<span class="">Amount</span></li>
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center py-4 px-4">
                                                Car snow removal<span class="">$19.99</span></li>
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center py-4 px-4">
                                                Admin fees<span class="">$50.0</span></li>
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center py-4 px-4">
                                                Tax fees<span class="">$0.0</span></li>

                                            <div class="card rounded-0 px-4 py-3 mb-0 border border-top-0">
                                                <li
                                                    class="list-group-item bglightBlue d-flex justify-content-between align-items-center boxShadow py-2 px-4 rounded-0">
                                                    Total<span class="">$276.57</span>
                                                </li>
                                            </div>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="px-4">
                                        <p>Tip your service provider</p>
                                        <select class="form-select boxShadow shadow-none selectBox bgGray">
                                            <option>Enter tip amount</option>
                                            <option>10% ($26.15)</option>
                                            <option>15% ($39.23)</option>
                                            <option>20% ($52.31)</option>
                                            <option>25% ($65.38)</option>
                                        </select>

                                        <div class="card boxShadow rounded py-2 px-1 mb-1 bgGray mt-3">
                                            <div class="d-flex">
                                                <div class="p-2 mt-1">

                                                    <svg xmlns="http://www.w3.org/2000/svg" width="19.668"
                                                        height="18.879" viewBox="0 0 19.668 18.879">
                                                        <g id="Group_4069" data-name="Group 4069"
                                                            transform="translate(-578.434 -324.771)">
                                                            <path id="Path_13644" data-name="Path 13644"
                                                                d="M838.93,570.372a1.009,1.009,0,1,0,1.018,1.012A1.018,1.018,0,0,0,838.93,570.372Z"
                                                                transform="translate(-248.109 -234.829)" fill="#d72323" />
                                                            <path id="Path_13645" data-name="Path 13645"
                                                                d="M722.319,465.7a1.007,1.007,0,0,0,1-1.006,1.009,1.009,0,1,0-2.019,0A1.021,1.021,0,0,0,722.319,465.7Z"
                                                                transform="translate(-136.598 -132.822)" fill="#d72323" />
                                                            <path id="Path_13646" data-name="Path 13646"
                                                                d="M598.1,334.211a1.11,1.11,0,0,0-.362-.818c-.418-.437-.838-.874-1.267-1.3a1.144,1.144,0,0,1-.365-.783,1.521,1.521,0,0,1,.021-.219c.1-.59.15-1.187.253-1.776a1.335,1.335,0,0,0,.02-.291.974.974,0,0,0-.267-.737,1.148,1.148,0,0,0-.682-.315l-1.832-.321a1.092,1.092,0,0,1-.826-.613c-.28-.545-.571-1.084-.857-1.626a1.153,1.153,0,0,0-.436-.506.966.966,0,0,0-.943-.02c-.551.268-1.107.527-1.649.811a1.3,1.3,0,0,1-1.293,0c-.517-.271-1.045-.519-1.57-.773a.983.983,0,0,0-1.444.483c-.264.5-.546,1-.789,1.513a1.3,1.3,0,0,1-1.08.774c-.556.078-1.108.185-1.66.285a.973.973,0,0,0-.923.854,1.1,1.1,0,0,0-.006.365c.089.636.163,1.274.265,1.907a1.5,1.5,0,0,1,.019.2,1.155,1.155,0,0,1-.372.8c-.425.421-.838.853-1.252,1.285a1.111,1.111,0,0,0,0,1.651c.414.432.827.864,1.252,1.285a1.156,1.156,0,0,1,.372.8,1.5,1.5,0,0,1-.019.2c-.1.633-.176,1.272-.265,1.907a1.1,1.1,0,0,0,.006.365.973.973,0,0,0,.923.854c.553.1,1.1.207,1.66.285a1.3,1.3,0,0,1,1.08.774c.243.514.525,1.009.789,1.513a.983.983,0,0,0,1.444.483c.525-.254,1.054-.5,1.57-.773a1.3,1.3,0,0,1,1.293,0c.543.284,1.1.542,1.649.811a.966.966,0,0,0,.943-.02,1.152,1.152,0,0,0,.436-.506c.286-.542.577-1.081.857-1.626a1.092,1.092,0,0,1,.826-.613l1.832-.321a1.147,1.147,0,0,0,.682-.315.974.974,0,0,0,.267-.737,1.335,1.335,0,0,0-.02-.291c-.1-.589-.155-1.186-.253-1.776a1.523,1.523,0,0,1-.021-.219,1.143,1.143,0,0,1,.365-.783c.429-.427.849-.863,1.267-1.3A1.11,1.11,0,0,0,598.1,334.211Zm-14.308-2.347a1.916,1.916,0,1,1,1.925,1.917A1.925,1.925,0,0,1,583.793,331.864Zm1.332,6.328a1.426,1.426,0,0,1-.189.181.455.455,0,0,1-.566-.023.43.43,0,0,1-.064-.575c.139-.186.3-.355.458-.527q3.211-3.507,6.424-7.013a1.457,1.457,0,0,1,.2-.2.434.434,0,0,1,.476-.023.407.407,0,0,1,.224.327.616.616,0,0,1-.22.481l-1.624,1.773Zm5.672.273a1.913,1.913,0,1,1,1.946-1.9A1.921,1.921,0,0,1,590.8,338.465Z"
                                                                transform="translate(0 0)" fill="#d72323" />
                                                        </g>
                                                    </svg>

                                                </div>
                                                <p class="p-2 mb-0" style="margin-top: 2px;">Add promo code</p>
                                                <div class="priceTxtWhite ms-auto">
                                                    <p class="my-2 ">Apply</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <li
                                        class="list-group-item bglightBlue mt-4 d-flex justify-content-between align-items-center boxShadow py-2 px-4 rounded-0">
                                        Grand Total<span class="">$276.57</span>
                                    </li>

                                    <div class="text-end paymentSec">
                                        <button class="btn btn-primary px-5">Pay</button>
                                    </div>

                                </div>
                            </div>
                        </div>
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
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content px-3">
                <div class="modal-header border-bottom-0">

                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <p class="f-14 mt-3 text-dark">Our providers try hard to complete all their jobs within
                        the time window listed. During big storms some times
                        may vary due to traffic, longer times on each job, and
                        conditions.</p>

                    <p class="f-14 mt-3 text-dark">Once you order you will have eyes on your provider to
                        see how far he is from your location. You will also be
                        able to text your provider once your job is ordered.</p>

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

            $('#get-summary').on('click',function(){

                let formData = new FormData();
                let totalImages = allImages ? allImages.length : $('#images')[0].files.length;
                let images = allImages ? allImages :$('#images')[0].files;
                formData.append('totalImages', totalImages);
                for (let i = 0; i < totalImages; i++) {
                    formData.append('images'+i, images[i]);
                }

                formData.append('service_for', "{{ $type }}");
                formData.append('property_id', "{{ $property->id }}");
                formData.append('car_id', $('input[name="car"]:checked').val());
                formData.append('color_id', $('#colors').val());
                formData.append('car_number', $('input[name="car_number"]').val());
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
