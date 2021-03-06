@extends('layouts.app')

@section('content')
    <section class="clearfix" style="width: 100%; min-height: 700px">
        <div class="container">
            <div class="row">
                <div class="sidem col-md-9 col-lg-9 col-sm-12 float-left" style="width: 75%; min-height: 1000px">

                    <div class="card shadow border-0">


                        <!--end of col-->
                        <div class="card-body" style="color: darkblue">

                            <ul id="dtBasicExample" class="list-group list-group-flush">

                                <form class="" action="/search" method="get">
                                    <div class="card-body row no-gutters align-items-center">
                                        <div class="col-auto">
                                        </div>
                                        <!--end of col-->
                                        <div class="col">
                                            <input class="form-control form-control-md "
                                                   name="search" type="search" id="search"
                                                   style="border-radius: 1px; color: darkblue"
                                                   placeholder="Search topics or keywords">
                                        </div>
                                        <!--end of col-->
                                        <div class="col-auto">
                                            <button class="btn btn-md btn-dark" type="submit"
                                                    style="background-color: white; color: darkblue;border-radius: 1px;">
                                                Search
                                            </button>
                                        </div>
                                        <!--end of col-->
                                    </div>
                                </form>

                                @foreach($jobs as $job)
                                    @if ($job->status != 'deleted')
                                        <li class="list-group-item" onclick="window.location.href='/jobs/{{ $job->id}}'">
                                            <div class="" >
                                                <b><i class="fas fa-angle-double-right"></i> {{ $job->name }}</b> <br><br>
                                                <div style="white-space: pre-wrap">{{ $job->description }}</div><br><br>
                                                Posted By: <a href="/users/{{\App\User::where('id', $job->user_id)->first()->id}}"><div style="text-transform: uppercase; display: inline;color: darkblue">{{\App\User::where('id', $job->user_id)->first()->name}}</div></a></br>
                                                Job Budget: <b>{{ $job->jobBudget}} Frw</b><br>
                                                Skills Needed: <a style="color: darkblue" href="{{action('jobsController@search',['search' => $job->skills])}}">{{ $job->skills }}</a><br>
                                                Job Status:
                                                @if($job->status=='Open')
                                                    @if($job->deadline < today())
                                                        <span class="badge badge-warning" style="font-size: 15px">Expired</span>
                                                    @else
                                                        <span class="badge badge-success" style="font-size: 15px">{{$job->status}}</span>
                                                    @endif
                                                @else
                                                    <span class="badge badge-danger" style="font-size: 15px">{{$job->status}}</span>
                                                @endif
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    {{--<div class="" style="margin-top: 2px; margin-left: 350px;color: darkblue">--}}
                    {{--{!! $jobs->links(); !!}--}}
                    {{--</div>--}}

                </div>

                <div class="sideb col-md-3 col-lg-3 float-right" style="width: 25%;">
                    <div class="sidebar-module">
                        <div class="card shadow border-0">
                            {{--<div class="card-header" style="background-color: darkblue; color: white"><h4>ACTIONS</h4>--}}
                            {{--</div>--}}
                            <div class="card-body" style="color: darkblue">

                                {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="card mt-3">--}}
                                {{--<div class="card-header" style="background-color: darkblue; color: white"><h4>--}}
                                {{--CATEGORIES</h4>--}}
                                {{--</div>--}}
                                {{--<div class="card-body">--}}
                                <h4>CATEGORIES</h4><br>
                                <ol class="list-unstyled">
                                    @foreach($jobs as $job)
                                        <li><a href="{{action('jobsController@search',['search' => $job->skills])}}" style="color: darkblue"> <i class="fas fa-angle-double-right"></i> {{ $job->skills }}</a></li>
                                    @endforeach
                                </ol>
                                {{--<div class="" style="margin-top: 2px; margin-left: 350px;">--}}
                                {{--{!! $jobs->links(); !!}--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection