@extends('layouts.app')

@section('content')
    <section class="clearfix" style="width: 100%">
        <div class="container">
            <div class="row">
                <div class="sidem  col-md-9 col-lg-9 float-left" style="width: 75%;">
                    @if ($errors->any())
                        <div class="alert alert-dismissable alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </strong>
                        </div>
                    @endif
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
                                    <input class="form-control" name="user_to" id="user_to"
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

                <div class="sideb col-md-3 col-lg-3 float-right" style="width: 25%;">
                    <div class="sidebar-module">
                        {{--<div class="card">--}}
                        {{--<div class="card-header" style="background-color: darkblue; color: white"><h4>ACTIONS</h4>--}}
                        {{--</div>--}}
                        {{--<div class="card-body">--}}
                        {{--<ol class="list-unstyled">--}}
                        {{--<li><a href="#">Edit</a></li>--}}
                        {{--<li><a href="/jobs/create">Post a Job</a></li>--}}
                        {{--<li><a href="#">Delete</a></li>--}}
                        {{--</ol>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        <div class="card shadow border-0">
                            {{--<div class="card-header" style="background-color: darkblue; color: white"><h4>--}}
                            {{--CATEGORIES</h4>--}}
                            {{--</div>--}}
                            <div class="card-body" style="color: darkblue">
                                <h4>ACTIONS</h4><br>
                                <ol class="list-unstyled" >
                                        <li ><a href="{{action('MessageController@inbox')}}" style="color: darkblue"><i class="fas fa-inbox"></i> Inbox</a></li>
                                        <li><a href="{{action('MessageController@sent')}}" style="color: darkblue"><i class="fas fa-arrow-right"></i> Sent Messages</a></li>
                                        <li><a href="{{action('MessageController@archived')}}" style="color: darkblue"><i class="fas fa-archive"></i> Archived Messages</a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection