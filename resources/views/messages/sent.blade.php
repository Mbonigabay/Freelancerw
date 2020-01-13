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

                                <h3>Sent Messages ({{ \App\Message::where('user_from', Auth::user()->id)->where('status', 'read')->orWhere('status', 'unread')->count() }}
                                    )</h3>

                                @foreach($messages as $message)
                                    @if($message->status != 'archived' AND $message->status != 'deleted')
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

                                                        <td><i class="fas fa-archive" data-toggle="tooltip"
                                                               data-placement="bottom" title="Archive"
                                                               onclick="window.location.href='/archive/messages/{{ $message->id}}'"></i>
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
                                <h4>ACTIONS</h4><br>
                                <ol class="list-unstyled" >
                                    <li ><a href="{{action('MessageController@create')}}" style="color: darkblue"><i class="fa fa-btn fa-plus-circle"></i> Compose a message</a></li>
                                    <li ><a href="{{action('MessageController@inbox')}}" style="color: darkblue"><i class="fas fa-inbox"></i> Inbox</a></li>
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