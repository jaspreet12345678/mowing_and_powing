@extends('layouts.admin')

@section('title', 'Admins')
@push('vendor-styles')
@endpush
@push('vendor-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
@endpush

@push('page-styles')
    <style>
        .text-blue {
            color: #0275D8;
        }

        .bg-skyblue {
            background: #d3ebff !important;
            color: #2c323f !important;
        }

        .fs-11 {
            font-size: 11px;
        }

        .btn-blue {
            background: #0275D8;
            color: #ffffff;
            border: 1px solid #0275D8;
        }

        .modal-dialog {
            margin: 18rem auto;
        }

        .text-red {
            background-color: #FB4B4B
        }

        .messages .sent {
            background: grey;
            color: white;
            padding: 15px;
            border-radius: 20px
        }

        .messages .received {
            background: blue;
            color: white;
            padding: 15px;
            border-radius: 20px
        }

        .chat {
            height: 650px
        }

        .chat-box .chat-right-aside .chat .chat-msg-box {
            margin-bottom: 0;
            height: 500px;
        }

        @media (min-width: 1200px) and (max-width: 1366px) {
            .chat-box .chat-right-aside .chat .chat-message {
                bottom: 50px;
            }

        }

        @media (min-width: 1366px) and (max-width: 1660px) {
            .chat-box .chat-right-aside .chat .chat-message {
                bottom: 30px;
            }
        }
    </style>
@endpush

@section('body')
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->

        <!-- Page Header Ends-->
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <div class="page-body" style="margin-left: 15px !important;">
                <div class="container-fluid">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <h3>Chat</h3>
                            </div>
                            <div class="col-12 col-sm-6">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html"> <i data-feather="home"></i></a></li>
                                    <li class="breadcrumb-item">Chat</li>
                                    <li class="breadcrumb-item active"> Chat App</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col call-chat-sidebar">
                            <div class="card">
                                <div class="card-body chat-body">
                                    <div class="chat-box">
                                        <!-- Chat left side Start-->
                                        <div class="chat-left-aside">
                                            <div class="people-list" id="people-list">
                                                <div class="search">
                                                    <form class="theme-form">
                                                        <div class="form-group">
                                                            <input class="form-control" type="text"
                                                                placeholder="search"><i class="fa fa-search"></i>
                                                        </div>
                                                    </form>
                                                </div>
                                                <ul class="list custom-scrollbar">
                                                    @foreach ($order as $orders)
                                                        <li class="clearfix">
                                                            {{-- <div class="media"><img class="rounded-circle user-image" src="{{ asset($orders->user->image) }}"  alt=""> --}}
                                                            {{-- <div class="status-circle away"></div> --}}
                                                            <div class="media-body">
                                                                <div class="about">
                                                                    {{-- <div class="name">{{$orders->user->first_name.' '.$orders->user->last_name}}</div> --}}
                                                                    <a
                                                                        href="{{ route('admin.chat_message', ['id' => $orders->id]) }}">
                                                                        <div class="status">
                                                                            <strong>{{ $orders->order_id }}</strong></div>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            {{-- </div> --}}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- Chat left side Ends-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col call-chat-body">
                            <div class="card">
                                <div class="card-body p-0">
                                    <div class="row chat-box">
                                        <!-- Chat right side start-->
                                        <div class="col chat-right-aside">
                                            <!-- chat start-->
                                            <div class="chat">
                                                <!-- chat-header start-->
                                                <div class="media chat-header clearfix">
                                                    <div class="media-body">
                                                        {{-- <div class="about">
                                <div class="name">Kori Thomas  <span class="font-primary f-12">Typing...</span></div>
                                <div class="status digits">Last Seen 3:55 PM</div>
                              </div> --}}
                                                    </div>

                                                </div>
                                                <!-- chat-header end-->
                                                <div class="chat-history chat-msg-box custom-scrollbar">
                                                    <ul>
                                                        @foreach ($messages as $message)
                                                            @if ($message->user->type == 'customer')
                                                                <li class="clearfix">
                                                                    <div class="message other-message pull-left">
                                                                        <img class="rounded-circle float-start chat-user-img img-30"
                                                                            height="30"
                                                                            src="{{ asset($message->user->image) }}"
                                                                            alt="">
                                                                        <div class="message-data"><span
                                                                                class="message-data-time">{{ Carbon\Carbon::parse($message->created_at)->format('m/d/Y h:i a') }}</span>
                                                                        </div>
                                                                        {{ $message->message }}
                                                                    </div>
                                                                </li>
                                                            @else
                                                                <li>
                                                                    <div class="message my-message message-data text-end">
                                                                        <img class="rounded-circle float-end  chat-user-img img-30 "
                                                                            height="30"
                                                                            src="{{ asset($message->user->image) }}"
                                                                            alt="">
                                                                        <div class="message-data text-end"><span
                                                                                class="message-data-time">{{ Carbon\Carbon::parse($message->created_at)->format('m/d/Y h:i a') }}</span>
                                                                        </div>
                                                                        <div class="message-data text-end">{{ $message->message }}</div>
                                                                        
                                                                    </div>
                                                                </li>
                                                            @endif
                                                        @endforeach

                                                    </ul>
                                                </div>
                                                <!-- end chat-history-->
                                                <div class="chat-message clearfix">
                                                    <div class="row">
                                                        <div class="col-xl-12 d-flex">
                                                            {{-- <div class="smiley-box bg-primary">
                                  <div class="picker"><img src="../assets/images/smiley.png" alt=""></div>
                                </div> --}}
                                                            <div class="input-group text-box">
                                                                {{-- <input class="form-control input-txt-bx" id="message-to-send" type="text" name="message-to-send" placeholder="Type a message......">
                                  <button class="btn btn-primary input-group-text" type="button">SEND</button> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end chat-message-->
                                                <!-- chat end-->
                                                <!-- Chat right side ends-->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Container-fluid Ends-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
        @push('page-scripts')
        @endpush
