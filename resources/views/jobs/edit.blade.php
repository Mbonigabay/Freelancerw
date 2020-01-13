@extends('layouts.app')

@section('content')
    <section class="clearfix" style="width: 100%">
        <div class="container">
            <div class="row">
                <div class="sidem  col-md-9 col-lg-9 float-left" style="width: 75%;color: darkblue">
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
                        <div class="card-body">
                            <form action="{{ action('jobsController@update', $job->id)}}" method="post">
                                {{ csrf_field() }}

                                <input type="hidden" name="_method" value="post">

                                <div class="form-group">
                                    <label for="job-name">Job Name: <span class="required"></span></label>
                                    <input class="form-control  " name="name" id="job-name"
                                           value="{{ $job->name }}"
                                           size="50" placeholder="Enter job name">
                                </div>

                                <div class="form-group">
                                    <label for="job-projectBudget">Job Project Budget: </label>
                                    <input class="form-control  " name="jobBudget"
                                           id="job-projectBudget"
                                           value="{{ $job->jobBudget }}" placeholder="Enter job project budget">
                                </div>
                                <div class="form-group">
                                    <label for="job-description">Job Description: </label>
                                    <textarea class="form-control  " name="description"
                                              id="job-description"
                                              placeholder="Enter job desription" rows="5"
                                              style="resize: vertical">{{ $job->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="job-description">Job Location: </label>
                                    <input class="form-control  " name="location"
                                              id="job-location"
                                              placeholder="Enter job location" value="{{ $job->location }}"
                                              style="resize: vertical">
                                </div>
                                <div class="dates">
                                    <label for="user-email">Job Deadline: </label>
                                    <input class="form-control" autocomplete="off" type="text" name="deadline" id="date" value="{{ $job->deadline }}" >
                                </div>
                                <div class="dates">
                                    <label for="user-email">Placing Bid Deadline: </label>
                                    <input class="form-control" autocomplete="off" type="text" name="bidDeadline" id="date" value="{{ $job->bidDeadline }}" >
                                </div>
                                <div class="form-group">
                                    <label for="job-skills">Skills Needed: </label>
                                    <input class="form-control  " name="skills" id="job-skills"
                                           value="{{ $job->skills }}"
                                           placeholder="Enter job skills">
                                </div>

                                <div class="form-group">
                                    <label for="job-skills">Job Status: </label>
                                    <select class="form-control" name="status" id="job-status"
                                            value="{{ $job->status }}">
                                        <option>Open</option>
                                        <option>Close</option>
                                    </select>
                                </div>


                                <button type="submit"
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

                <div class="sideb col-md-3 col-lg-3 float-right" style="width: 25%; color: darkblue">
                    <div class="sidebar-module">
                        <div class="card shadow border-0">
                            <div class="card-body">
                                <h4>Actions</h4>
                                <ol class="list-unstyled">
                                    <li><a href="/jobs/{{$job->id}}" style="color: darkblue"><i class="far fa-eye"></i>
                                            View job</a></li>
                                    <li><a href="#" style="color: darkblue"><i class="fas fa-trash-alt"></i> Delete</a>
                                    </li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection