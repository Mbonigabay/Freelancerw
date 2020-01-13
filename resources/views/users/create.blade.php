@extends('layouts.app')

@section('content')
    <div class="clearfix">
        <div class="sidem row col-md-9 col-lg-9 float-left mt-2 " style="width: 1200px" >
            <div class="row col-md-12 col-lg-12 col-sm-12" style="background: white; margin: 10px;">
                <form method="post" action="{{ route('jobs.store') }}">
                    {{ csrf_field() }}


                    <div class="form-group">
                        <label for="job-name">Job Name: <span class="required"></span></label>
                        <input class="form-control form-control-lg" name="name" id="job-name" size="50" placeholder="Enter job name">
                    </div>
                    <div class="form-group">
                        <label for="job-avgBid">Job Average Bid: </label>
                        <input class="form-control form-control-lg" name="avgBid" id="job-avgBid" placeholder="Enter job average bid">
                    </div>
                    <div class="form-group">
                        <label for="job-projectBudget">Job Project Budget: </label>
                        <input class="form-control form-control-lg" name="projectBudget" id="job-projectBudget" placeholder="Enter job project budget">
                    </div>
                    <div class="form-group">
                        <label for="job-description">Job Description: </label>
                        <textarea class="form-control form-control-lg" name="description" id="job-description"  placeholder="Enter job desription" rows="5" style="resize: vertical"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="job-skills">Skills Needed: </label>
                        <input class="form-control form-control-lg" name="skills" id="job-skills"  placeholder="Enter job skills">
                    </div>
                    <button type="submit" class="btn btn-dark">Submit</button>
                </form>
            </div>
        </div>

        <div class="sideb col-sm-3 col-md-3 col-lg-3 col-sm-offset-1 mt-2 float-right">
            <div class="sidebar-module">
                <h4>Actions</h4>
                <ol class="list-unstyled">
                    <li><a href="/jobs/create">View job</a></li>
                    <li><a href="#">Delete</a></li>
                </ol>
            </div>

            <div class="sidebar-module">
                <h4>Bids</h4>
                <ol class="list-unstyled">
                </ol>
            </div>

        </div>
    </div>
    </div>
@endsection