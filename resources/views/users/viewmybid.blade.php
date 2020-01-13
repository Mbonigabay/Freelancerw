@extends('layouts.app')

@section('content')
    <section class="clearfix" style="width: 100%; min-height: 700px">
        <div class="container">
            <div class="row">
                <div class="sidem  col-md-9 col-lg-9 float-left" style="width: 75%;color: darkblue">

                        <div class="card mt-3 shadow border-0">
                            <div class="card-body">
                                <h3>My Bid</h3>

                                <div class="clearfix">
                                    <input type="hidden" class="form-control form-control-lg" type="" name="jobId"
                                           id="jobId"
                                           value="{{ $user->id }}" size="50" placeholder="Enter job id">


                                    <table class="table table-striped ">
                                        <thead>
                                        <tr>
                                            <th>Job name</th>
                                            <th>Posted By</th>
                                            <th>Deadline </th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        @foreach($user->jobs as $job)
                                            @foreach($job->users as $user)
                                                <tr onclick="window.location.href='/jobs/{{ $job->id}}'">

                                                    <td>{{$job->name}}</td>
                                                    <td>{{App\User::where('id', $job->user_id)->first()->name}}</td>
                                                    <td>{{$job->bidDeadline}}</td>
                                                    <td>{{$user->pivot->status}}</td>
                                                </tr>
                                                @endforeach
                                        @endforeach

                                    </table>
                                </div>

                            </div>

                        </div>

                </div>

                {{--<div class="sideb col-md-3 col-lg-3 float-right" style="width: 25%; color: darkblue">--}}
                    {{--<div class="sidebar-module">--}}
                        {{--<div class="card shadow border-0">--}}
                            {{--<div class="card-body">--}}
                                {{--<h4>ACTIONS</h4>--}}
                                {{----}}
                            {{--</div>--}}
                        {{--</div>--}}

                    {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>

    </section>


@endsection