@extends('layouts.client')

@section('title',"Provider's Chat")

@push('vendor-styles')
@endpush

@push('page-styles')

<style>
    .text-blue{
        color: #0275D8;
    }
    .bg-skyblue {
        background: #d3ebff !important;
        color: #2c323f !important;
    }
    .fs-11{
        font-size: 11px;
    }
    .btn-blue{
        background: #0275D8;
        color: #ffffff;
        border: 1px solid #0275D8;
    }
    .modal-dialog {
        margin: 18rem auto;
    }
    .text-red{
        background-color: #FB4B4B
    }

    .messages .sent{
        background: grey;
        color: white;
        padding: 15px;
        border-radius: 20px
    }

    .messages .received{
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

<!--- heading & li start --->
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Provider's Chat</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">
                        <i class="icofont icofont-prescription fs-6"></i>
                    </a></li>
                    <li class="breadcrumb-item">Job History</li>
                    <li class="breadcrumb-item">Provider's Chat</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Container-fluid chat-card starts-->
<div class="container-fluid">
    <div class="row">
        <div class="col call-chat-body">
            <div class="card">
                <div class="card-body p-0">
                    <div class="row chat-box">
                        <!-- Chat right side start-->
                        <div class="col chat-right-aside">
                            <!-- chat start-->
                            <div class="chat">
                                <!-- chat-header start-->
                                <div class="media py-3 px-4 shadow"><img class="rounded-circle user-image" src="{{ asset($order->provider->image) }}" alt="chat-client">
                                    <div class="status-circle online"></div>
                                    <div class="media-body">
                                        <div class="about">
                                          <div class="name">{{ $order->provider->first_name." ".$order->provider->last_name }}</div>
                                          <div class="status digits">{{ $order->order_id }}</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="chat-history chat-msg-box custom-scrollbar">
                                    <ul>
                                        @foreach ($messages as $message)
                                            @if ($message->user_id == auth()->id())
                                                <li class="clearfix">
                                                    <div class="message other-message pull-right">
                                                        <img class="rounded-circle float-end chat-user-img img-30" height="30" src="{{ asset($message->user->image) }}" alt="">
                                                        <div class="message-data"><span class="message-data-time">{{ Carbon\Carbon::parse($message->created_at)->format('m/d/Y h:i a') }}</span></div>
                                                        {{ $message->message }}
                                                    </div>
                                                </li>
                                            @else
                                                <li>
                                                    <div class="message my-message">
                                                        <img class="rounded-circle float-start chat-user-img img-30" height="30" src="{{ asset($message->user->image) }}" alt="">
                                                        <div class="message-data text-end"><span class="message-data-time">{{ Carbon\Carbon::parse($message->created_at)->format('m/d/Y h:i a') }}</span></div>
                                                        {{ $message->message }}
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
                                            <div class="input-group text-box me-2">
                                            <input class="form-control input-txt-bx bg-skyblue" id="message-to-send" type="text" name="message-to-send" placeholder="Type a message......">
                                            </div>
                                            <button class="btn btn-primary input-group-text px-3" id="send-btn" type="button">
                                                <span class="fw-normal">SEND</span>
                                                <i data-feather="send" class="pt-2 ps-2"></i>
                                            </button>

                                            <!-- The Modal start-->
                                            <div class="modal" id="myModal">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header flex-column px-4">
                                                            <div class="col-md-12">
                                                                <div class="text-center py-3">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40">
                                                                        <g id="_7fe1f8abaad094e0b5cb1b01d712f708" data-name="7fe1f8abaad094e0b5cb1b01d712f708" transform="translate(-10 -10)">
                                                                        <g id="Group_5952" data-name="Group 5952" transform="translate(10 10)">
                                                                            <path id="Path_13688" data-name="Path 13688" d="M32.188,32.188V18.853H27.812V32.188ZM30,41.771a3.031,3.031,0,0,0,2.918-2.918,2.618,2.618,0,0,0-.886-1.98,2.9,2.9,0,0,0-4.065,0,2.624,2.624,0,0,0-.886,1.98A3.031,3.031,0,0,0,30,41.771ZM38.335,10,50,21.665V38.331L38.335,50H21.665L10,38.335V21.665L21.665,10Z" transform="translate(-10 -10)" fill="#fb4b4b"/>
                                                                        </g>
                                                                        </g>
                                                                    </svg>
                                                                    <h4 class="text-dark fw-normal px-5 pt-3 mb-0">Do not share any personal info with provider. It may result in restricted account.</h4>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer justify-content-center">
                                                            <button class="btn btn-blue w-25" type="button" data-original-title="btn"title="">Ok</button>
                                                            {{-- <button class="btn btn-green w-25" type="button" data-original-title="btn" title="">Yes</button> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- The Modal end-->
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
<!-- Container-fluid Ends-->




@endsection

@push('vendor-scripts')

@endpush

@push('page-scripts')
    <script>
        // Loading from resources/js/bootstrap.js => public/js/app.js
        Echo.private(`order-live-chat.{{ $order->id }}`)
            .listen('.MessageSent', (data) => {
                $('.chat-history ul').append(`
                    <li>
                        <div class="message my-message"><img class="rounded-circle float-start chat-user-img img-30" height="30" src="{{ $order->provider->image }}" alt="">
                        <div class="message-data text-end"><span class="message-data-time">${ new Date().toLocaleString('en-US', {timeZone: "America/New_York",month: '2-digit',day: '2-digit',year: 'numeric', hour: '2-digit', minute: '2-digit', hour12: true }) }</span></div>${data.message.message}
                        </div>
                    </li>
                `)
                scrollToBottom()
            });

        // To show typing to other user
        // Echo.private(`order-live-chat.{{ $order->id }}`)
        //     .whisper('typing', {
        //         name: 'typing'
        //     });
        // Echo.private(`order-live-chat.{{ $order->id }}`)
        //     .listenForWhisper('typing', (data) => {
        //         console.log(data)
        //     });

        $('#message-to-send').keypress((e) => {
            if (e.which === 13) {
                $('#send-btn').click()
            }
        })

        $('#send-btn').click(()=>{

            if($('#message-to-send').val()){
                $('.chat-history ul').append(`
                    <li class="clearfix">
                        <div class="message other-message pull-right"><img class="rounded-circle float-end chat-user-img img-30" height="30" src="{{ asset(auth()->user()->image) }}" alt="">
                        <div class="message-data"><span class="message-data-time">${ new Date().toLocaleString('en-US', {timeZone: "America/New_York",month: '2-digit',day: '2-digit',year: 'numeric', hour: '2-digit', minute: '2-digit', hour12: true }) }</span></div>${$('#message-to-send').val()}
                        </div>
                    </li>
                `)

                scrollToBottom()

                $.ajax({
                    headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
                    url: "{{ route('job-history.providers-chat.send-message') }}",
                    type: 'post',
                    data: {
                        'message' : $('#message-to-send').val(),
                        'order_id': "{{ $order->id }}",
                        'provider_id': "{{ $order->assigned_to }}",
                        'order_no': "{{ $order->order_id }}"
                    },
                    success: (res) => {
                        $('#message-to-send').val('');

                        if(!res.success){
                            errorMessage(res.message)
                        }
                    },
                    error: (error)=>{
                        errorMessage(error.responseText)
                    }
                })
            } else {
                errorMessage('Kindly enter a message')
            }


        })

        function scrollToBottom(){
            $('.chat-history').scrollTop($('.chat-history')[0].scrollHeight);
        }

        $(document).ready(function() {
            scrollToBottom()
        });

    </script>
@endpush
