@extends('layouts.app')

@section('content')
    <section class="clearfix" style="width: 100%">
        <div class="container">
            <div class="row">
                <div class="sidem  col-md-9 col-lg-9 col-sm-12 float-left" style="width: 75%; min-height: 1000px">

                    <div class="card shadow border-0">


                        <!--end of col-->
                        <div class="card-body" style="color: darkblue">

                            <ul id="dtBasicExample" class="list-group list-group-flush">

                                <h3>Unread Messages
                                    ({{ \App\Message::where('user_to', Auth::user()->id)->where('status' , 'unread')->count() }}
                                    )</h3>

                                @foreach($messages as $message)
                                    @if($message->status == 'unread')
                                        <div class="clearfix">
                                            <div class="mr-3" style="display: inline">
                                                <table class="table table-inbox table-hover">
                                                    <tbody>
                                                    <tr class="unread">

                                                        <td class="view-message  dont-show"
                                                            onclick="window.location.href='/messages/{{ $message->id}}'">{{\App\User::where('id', $message->user_from)->first()->name}}</td>
                                                        <td class="view-message "
                                                            onclick="window.location.href='/messages/{{ $message->id}}'">{{ $message->title }}</td>
                                                        <td class="view-message  "
                                                            onclick="window.location.href='/messages/{{ $message->id}}'">{{ $message->created_at->format('j M Y , g:ia') }}</td>

                                                        <td><i class="fas fa-arrow-circle-left" data-toggle="modal" data-target="#exampleModal" href="{{ action('MessageController@create', $message->user_from) }}"></i></td>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="card shadow border-0">
                                                                            {{--<div class="card-header" style="background-color: darkblue; color: white">--}}
                                                                            {{--<h4>POST JOB</h4>--}}
                                                                            {{--</div>--}}
                                                                            <div class="card-body" style="color: darkblue">
                                                                                <h4>Compose a message</h4></br>
                                                                                <form method="post" action="{{ action('MessageController@compose') }}">
                                                                                    {{ csrf_field() }}


                                                                                    <div class="form-group">
                                                                                        <label for="user_from">From: <span class="required"></span></label>
                                                                                        <label> {{Auth::user()->email}}</label>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="user_to">To: </label>
                                                                                        <input class="form-control" value="{{\App\User::where('id', $message->user_from)->first()->email}}" name="user_to" id="user_to"
                                                                                               placeholder="Enter User's Email">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="subject">Subject: </label>
                                                                                        <input class="form-control" name="subject" id="subject"
                                                                                               placeholder="Enter Message's Subject">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="message">Message: </label>
                                                                                        <textarea class="form-control" name="message" id="message"
                                                                                                  placeholder="Enter your message" rows="5"
                                                                                                  style="resize: vertical"></textarea>
                                                                                    </div>
                                                                                    <button type="submit" class="btn btn-dark"
                                                                                            onMouseOver="this.style.backgroundColor='darkblue'; this.style.color='white'"
                                                                                            onMouseOut="this.style.backgroundColor='white'; this.style.color='darkblue'"
                                                                                            class="btn"
                                                                                            style="background-color: white; color: darkblue;border-radius: 1px; border-color: darkblue;">
                                                                                        Send
                                                                                    </button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <td><i class="fas fa-archive" data-toggle="tooltip"
                                                               data-placement="bottom" title="Archive"
                                                               onclick="window.location.href='/archive/messages/{{ $message->id}}'"></i>
                                                        </td>
                                                        <td><i class="fas fa-inbox" data-toggle="tooltip"
                                                               data-placement="bottom" title="Mark as read"
                                                               onclick="window.location.href='/read/messages/{{ $message->id}}'"></i>
                                                        </td>
                                                        <td><i class="far fa-trash-alt" data-toggle="tooltip"
                                                               data-placement="bottom" title="Delete"
                                                               onclick="window.location.href='/delete/messages/{{ $message->id}}'"></i>
                                                        </td>

                                                    </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach


                            </ul>
                        </div>


                    </div>

                    <div class="card shadow border-0 mt-3">


                        <!--end of col-->
                        <div class="card-body" style="color: darkblue">

                            <ul id="dtBasicExample" class="list-group list-group-flush">

                                <h3>Read Messages
                                    ({{ \App\Message::where('user_to', Auth::user()->id)->where('status' , 'read')->count() }}
                                    )</h3>

                                @foreach($messages as $messagi)
                                    @if($messagi->status == 'read')

                                        <div class="clearfix">
                                            <div class="mr-3" style="display: inline">
                                                <table class="table table-inbox table-hover">
                                                    <tbody>
                                                    <tr class="unread">

                                                        <td class="view-message  dont-show"
                                                            onclick="window.location.href='/messages/{{ $messagi->id}}'">{{\App\User::where('id', $messagi->user_from)->first()->name}}</td>
                                                        <td class="view-message "
                                                            onclick="window.location.href='/messages/{{ $messagi->id}}'">{{ $messagi->title }}</td>
                                                        <td class="view-message  "
                                                            onclick="window.location.href='/messages/{{ $messagi->id}}'">{{ $messagi->created_at->format('j M Y , g:ia') }}</td>


                                                        <td><i class="fas fa-reply" data-toggle="modal" data-target="#exampleModal" href="{{ action('MessageController@create', $messagi->user_from) }}"></i></td>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="card shadow border-0">
                                                                            {{--<div class="card-header" style="background-color: darkblue; color: white">--}}
                                                                            {{--<h4>POST JOB</h4>--}}
                                                                            {{--</div>--}}
                                                                            <div class="card-body" style="color: darkblue">
                                                                                <h4>Compose a message</h4></br>
                                                                                <form method="post" action="{{ action('MessageController@compose') }}">
                                                                                    {{ csrf_field() }}


                                                                                    <div class="form-group">
                                                                                        <label for="user_from">From: <span class="required"></span></label>
                                                                                        <label> {{Auth::user()->email}}</label>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="user_to">To: </label>
                                                                                        <input class="form-control" value="{{\App\User::where('id', $messagi->user_from)->first()->email}}" name="user_to" id="user_to"
                                                                                               placeholder="Enter User's Email">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="subject">Subject: </label>
                                                                                        <input class="form-control" name="subject" id="subject"
                                                                                               placeholder="Enter Message's Subject">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="message">Message: </label>
                                                                                        <textarea class="form-control" name="message" id="message"
                                                                                                  placeholder="Enter your message" rows="5"
                                                                                                  style="resize: vertical"></textarea>
                                                                                    </div>
                                                                                    <button type="submit" class="btn btn-dark"
                                                                                            onMouseOver="this.style.backgroundColor='darkblue'; this.style.color='white'"
                                                                                            onMouseOut="this.style.backgroundColor='white'; this.style.color='darkblue'"
                                                                                            class="btn"
                                                                                            style="background-color: white; color: darkblue;border-radius: 1px; border-color: darkblue;">
                                                                                        Send
                                                                                    </button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>




                                                        <td><i class="fas fa-archive" data-toggle="tooltip"
                                                               data-placement="bottom" title="Archive"
                                                               onclick="window.location.href='/archive/messages/{{ $messagi->id}}'"></i>
                                                        </td>
                                                        <td><i class="fas fa-inbox" data-toggle="tooltip"
                                                               data-placement="bottom" title="Mark as not read"
                                                               onclick="window.location.href='/unread/messages/{{ $messagi->id}}'"></i>
                                                        </td>
                                                        <td><i class="far fa-trash-alt" data-toggle="tooltip"
                                                               data-placement="bottom" title="Delete"
                                                               onclick="window.location.href='/delete/messages/{{ $messagi->id}}'"></i>
                                                        </td>

                                                    </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    @endif
                                @endforeach


                            </ul>
                        </div>


                    </div>
                    {{--<div class="" style="margin-top: 2px; margin-left: 350px;color: darkblue">--}}
                    {{--{!! $jobs->links(); !!}--}}
                    {{--</div>--}}

                </div>

                <div class="sideb col-md-3 col-lg-3  float-right" style="width: 25%;">
                    <div class="sidebar-module">
                        <div class="card shadow border-0">
                            {{--<div class="card-header" style="background-color: darkblue; color: white"><h4>--}}
                            {{--CATEGORIES</h4>--}}
                            {{--</div>--}}
                            <div class="card-body" style="color: darkblue">
                                <h4>ACTIONS</h4>
                                <ol class="list-unstyled" >
                                    <li ><a href="{{action('MessageController@create')}}" style="color: darkblue"><i class="fa fa-btn fa-plus-circle"></i> Compose a message</a></li>
                                    <li><a href="{{action('MessageController@sent')}}" style="color: darkblue"><i class="fas fa-arrow-right"></i> Sent Messages</a></li>
                                    <li><a href="{{action('MessageController@archived')}}" style="color: darkblue"><i class="fas fa-archive"></i> Archived Messages</a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>

@endsection