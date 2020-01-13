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
                            <h4>POST A JOB</h4></br>
                            <form method="post" action="{{ action('jobsController@store') }}">
                                {{ csrf_field() }}


                                <div class="form-group">
                                    <label for="job-name">Job Name: <span class="required"></span></label>
                                    <input class="form-control" name="name" id="job-name" size="50"
                                           placeholder="Enter job name">
                                </div>
                                <div class="form-group">
                                    <label for="jobBudget">Job Project Budget: </label>
                                    <input class="form-control"  name="jobBudget" id="jobBudget"
                                           placeholder="Enter job budget">
                                </div>
                                <div class="form-group">
                                    <label for="job-description">Job Location: </label>
                                    <input class="form-control  " name="location"
                                           id="job-location"
                                           placeholder="Enter job location" autocomplete="off" type="text"></input>
                                </div>
                                <div class="dates">
                                    <label for="user-email">Job Deadline: </label>
                                    <input class="form-control" autocomplete="off" type="text" name="deadline"
                                           id="date">
                                </div>
                                <div class="dates">
                                    <label for="bidDeadline">Placing Bid Deadline: </label>
                                    <input class="form-control" autocomplete="off" type="text" name="bidDeadline"
                                           id="date">
                                </div>
                                <div class="form-group">
                                    <label for="job-description">Job Description: </label>
                                    <textarea class="form-control" name="description" id="job-description"
                                              placeholder="Enter job desription" rows="5"
                                              style="resize: vertical"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="job-skills">Skills Needed: </label>
                                    <input class="form-control" name="skills" id="job-skills"
                                           placeholder="Enter job skills">
                                </div>
                                <button type="submit" class="btn btn-dark"
                                        onMouseOver="this.style.backgroundColor='darkblue'; this.style.color='white'"
                                        onMouseOut="this.style.backgroundColor='white'; this.style.color='darkblue'"
                                        class="btn"
                                        style="background-color: white; color: darkblue;border-radius: 1px; border-color: darkblue;">
                                    Submit
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
                                {{--<ol class="list-unstyled">--}}
                                    {{--@foreach($jobs as $job)--}}
                                        {{--<li><a href="{{action('jobsController@search',['search' => $job->skills])}}"--}}
                                               {{--style="color: darkblue"> <i--}}
                                                        {{--class="fas fa-angle-double-right"></i> {{ $job->skills }}</a>--}}
                                        {{--</li>--}}
                                    {{--@endforeach--}}
                                {{--</ol>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection