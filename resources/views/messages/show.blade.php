@extends('layouts.app')

@section('content')
    <section class="clearfix" style="width: 100%; min-height: 700px">
        <div class="container">
            <div class="row">
                <div class="sidem  col-md-9 col-lg-9 float-left" style="width: 75%;color: darkblue">

                    <div class="card shadow border-0">
                        <div class="card-body">
                            <div class="clearfix" style="border-bottom: 1px darkblue">
                                <b>From:</b> {{ \App\user::where('id', $message->user_from)->first()->name }}
                                < {{ \App\user::where('id', $message->user_from)->first()->email }} >
                                <br><b>To:</b> {{ \App\user::where('id', $message->user_to)->first()->name }}
                                < {{ \App\user::where('id', $message->user_to)->first()->email }} >
                                <div class="float-right">sent on {{$message->created_at}}
                                    ({{$message->created_at->diffForHumans()}})
                                </div>
                            </div>
                            <br>
                            <h4>Title: {{$message->title}}</h4>

                            <h4>Message:</h4>
                            {{$message->body}}
                        </div>

                    </div>

                </div>

                <div class="sideb col-md-3 col-lg-3 float-right" style="width: 25%; color: darkblue">
                    <div class="sidebar-module">
                        <div class="card shadow border-0">
                            <div class="card-body">
                                <h4>ACTIONS</h4>
                                <ol class="list-unstyled" style="color: darkblue">

                                </ol>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>


@endsection