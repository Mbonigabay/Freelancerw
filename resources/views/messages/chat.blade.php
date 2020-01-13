@extends('layouts.app')

@section('content')
    <section class="clearfix " style="width: 100%">
        <div class="container">

            <div class="row">

                <div class="sidem  col-md-9 col-lg-9 float-left" style="width: 75%;">
                    <div class="card shadow border-0">

                        <div class="container" style="max-width:1170px; margin:auto;">
                            <h3 class=" text-center">Messaging</h3>
                            <div class="messaging">
                                <div class="inbox_msg">
                                    <div class="inbox_people">
                                        <div class="headind_srch">
                                            <div class="recent_heading">
                                                <h4>Recent</h4>
                                            </div>
                                            <div class="srch_bar">
                                                <div class="stylish-input-group">
                                                    <input type="text" class="search-bar" placeholder="Search">
                                                    <span class="input-group-addon">
                <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                </span></div>
                                            </div>
                                        </div>
                                        <div class="inbox_chat">
                                            @foreach($messages as $message)
                                                <div class="chat_list ">
                                                    <div class="chat_people">
                                                        <div class="chat_img"><img
                                                                    src="/uploads/avatars/{{ \App\User::where('id', $message->user_from)->first()->avatar }}"
                                                                    alt="sunil"></div>
                                                        <div class="chat_ib">
                                                            <h5>{{ \App\User::where('id', $message->user_from)->first()->name }}
                                                                <span class="chat_date">{{$message->created_at->format('d M')}}</span>
                                                            </h5>
                                                            <p>{{$message->body}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="mesgs">
                                        <div class="msg_history">
                                            @foreach($messages as $message)
                                                @foreach($messagis as $messagi)
                                                <div class="incoming_msg">
                                                    <div class="incoming_msg_img"><img src="/uploads/avatars/{{ \App\User::where('id', $message->user_from)->first()->avatar }}"
                                                                alt="sunil"></div>
                                                    <div class="received_msg">
                                                        <div class="received_withd_msg">
                                                            <p>{{$message->body}}</p>
                                                            <span class="time_date">  {{$message->created_at->format('h : i')}}    |    {{$message->created_at->format('d M')}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="outgoing_msg">
                                                    <div class="sent_msg">
                                                        <p>{{$messagi->body}}</p>
                                                        <span class="time_date"> {{$messagi->created_at->format('h : i')}}    |    {{$messagi->created_at->format('d M')}}</span></div>
                                                </div>
                                                    @endforeach
                                            @endforeach

                                        </div>
                                        <div class="type_msg">
                                            <div class="input_msg_write">
                                                <input type="text" class="write_msg" placeholder="Type a message"/>
                                                <button class="msg_send_btn" type="button"><i
                                                            class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>

                    </div>
                </div>

                <div class="sideb col-md-3 col-lg-3 float-right" style="width: 25%; color: darkblue">
                    <div class="sidebar-module">
                        <div class="card shadow border-0">

                            <div class="card-body">
                                <h4>ACTIONS</h4>
                                {{--<ol class="list-unstyled">--}}
                                {{--<li><a class=" " data-toggle="modal" data-target="#exampleModal" href="{{ action('MessageController@create', $user->id) }}"--}}
                                {{--style="color: darkblue"><i class="far fa-envelope"></i> Send a message</a></li>--}}

                                {{--<!-- Button trigger modal -->--}}
                                {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">--}}
                                {{--Launch demo modal--}}
                                {{--</button>--}}


                                {{--<li><a href="{{ action('usersController@edit', $user->id) }}"--}}
                                {{--style="color: darkblue"><i--}}
                                {{--class="far fa-edit"></i> Edit</a></li>--}}
                                {{--<li><a href="{{ action('jobsController@viewByUser', $user->id) }}"--}}
                                {{--style="color: darkblue"><i class="fas fa-briefcase"></i>--}}
                                {{--<div style="text-transform: uppercase; display: inline;color: darkblue">{{$user->name}}</div>--}}
                                {{--'s jobs</a></li>--}}


                                {{--<li>--}}


                                {{--<a--}}
                                {{--href="#"--}}
                                {{--onclick="--}}
                                {{--var result = confirm('Are you sure you wish to delete this Job?');--}}
                                {{--if( result ){--}}
                                {{--event.preventDefault();--}}
                                {{--document.getElementById('delete-form').submit();--}}
                                {{--}--}}
                                {{--" style="color: darkblue"--}}
                                {{-->--}}
                                {{--<i class="fas fa-trash-alt"></i> Delete--}}
                                {{--</a>--}}

                                {{--<form id="delete-form" action=""--}}
                                {{--method="POST" style="display: none;">--}}
                                {{--<input type="hidden" name="_method" value="delete">--}}
                                {{--{{ csrf_field() }}--}}
                                {{--</form>--}}


                                {{--</li>--}}

                                {{--</ol>--}}
                                <h4>CATEGORIES</h4>
                                <ol class="list-unstyled">
                                {{--@foreach($jobs as $job)--}}
                                {{--<li><a href="{{action('jobsController@search',['search' => $job->skills])}}" style="color: darkblue"> <i class="fas fa-angle-double-right"></i> {{ $job->skills }}</a></li>--}}
                                {{--@endforeach--}}
                                {{--</ol>--}}
                            </div>
                        </div>
                    </div>
                </div>
                {{--<!-- Modal -->--}}
                {{--<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
                {{--<div class="modal-dialog" role="document">--}}
                {{--<div class="modal-content">--}}
                {{--<div class="modal-header">--}}
                {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                {{--<span aria-hidden="true">&times;</span>--}}
                {{--</button>--}}
                {{--</div>--}}
                {{--<div class="modal-body">--}}
                {{--<div class="card shadow border-0">--}}
                {{--<div class="card-header" style="background-color: darkblue; color: white">--}}
                {{--<h4>POST JOB</h4>--}}
                {{--</div>--}}
                {{--<div class="card-body" style="color: darkblue">--}}
                {{--<h4>Compose a message</h4></br>--}}
                {{--<form method="post" action="{{ action('MessageController@compose') }}">--}}
                {{--{{ csrf_field() }}--}}


                {{--<div class="form-group">--}}
                {{--<label for="user_from">From: <span class="required"></span></label>--}}
                {{--<label> {{Auth::user()->email}}</label>--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                {{--<label for="user_to">To: </label>--}}
                {{--<input class="form-control" value="{{$user->email}}" name="user_to" id="user_to"--}}
                {{--placeholder="Enter User's Email">--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                {{--<label for="subject">Subject: </label>--}}
                {{--<input class="form-control" name="subject" id="subject"--}}
                {{--placeholder="Enter Message's Subject">--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                {{--<label for="message">Message: </label>--}}
                {{--<textarea class="form-control" name="message" id="message"--}}
                {{--placeholder="Enter your message" rows="5"--}}
                {{--style="resize: vertical"></textarea>--}}
                {{--</div>--}}
                {{--<button type="submit" class="btn btn-dark"--}}
                {{--onMouseOver="this.style.backgroundColor='darkblue'; this.style.color='white'"--}}
                {{--onMouseOut="this.style.backgroundColor='white'; this.style.color='darkblue'"--}}
                {{--class="btn"--}}
                {{--style="background-color: white; color: darkblue;border-radius: 1px; border-color: darkblue;">--}}
                {{--Send--}}
                {{--</button>--}}
                {{--</form>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}

            </div>
        </div>
    </section>
    <script>

    </script>
@endsection