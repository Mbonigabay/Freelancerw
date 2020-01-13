<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>
<body>
<div id="logo">
    <img src="C:\Users\USER\Pictures\Final Year\Logo.PNG">
    <br><p>
        <b>Address</b> <br>
        KK 503st Kigali <br>
        admin@freelance.rw <br>
        (+250) 781607680
    </p>
</div>

<p style="text-align: center; text-decoration: underline; font-size: 30px">Report for {{ $job->name }}</p>
<fieldset>
    <legend>Job Info</legend>
    <div class="clearfix">
        <b>Job Name: </b>{{$job->name}}<br>
        <b>Job Budget: </b>{{$job->jobBudget}}<br>
        Job was Posted {{ $job->created_at->diffForHumans()}} - {{$job->users->count()}} bids
        <br><b>Skills: </b><a href="#" style="color: darkblue">{{$job->skills}}</a><br>
        <b>Location:</b> {{ $job->location }}<br>
        <b>Bidding will end :</b> {{ \Carbon\Carbon::parse($job->bidDeadline)->diffForHumans() }}
        <br>
        <b>Should be done :</b> {{ \Carbon\Carbon::parse($job->deadline)->diffForHumans() }}<br>
        <br><b>Posted by: </b> <a
                href="/users/{{\App\User::where('id', $job->user_id)->first()->id}}">
            <div style="text-transform: uppercase; color: darkblue; display: inline">{{\App\User::where('id', $job->user_id)->first()->name}}</div>
        </a>
    </div>
</fieldset>
<fieldset>
    <legend>Profile</legend>
    <p style="white-space: pre-wrap;">{{$job->description}}</p>
</fieldset>
<fieldset>
    <legend>User Who won the bid</legend>
    <div class="clearfix">
        <input type="hidden" class="form-control form-control-lg" type="" name="jobId"
               id="jobId"
               value="{{ $job->id }}" size="50" placeholder="Enter job id">


        <table class="table table-striped ">
            <thead>
            <tr>
                <th>Freelance name</th>
                <th>Freelance email</th>
                <th>Freelance address</th>
                <th class="text-center">Action</th>
            </tr>
            </thead>
            @foreach($job->users as $user)
                @if($user->pivot->status == 'accepted')
                    <tr onclick="window.location.href='/users/{{ $user->id}}'">

                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->address}}</td>
                        <td class="text-center">

                            <a href="{{ action('jobsController@decline',[$job->id,$user->id]) }}"
                               data-toggle="tooltip"
                               data-placement="bottom" title="Deny bid"
                               class="btn btn-danger btn-xs"><i
                                        class="far fa-times-circle"></i></a>

                        </td>
                    </tr>
                @endif
            @endforeach

        </table>
    </div>
</fieldset>
<fieldset>
    <legend>User Who Bidded</legend>
    <div class="clearfix">
        <input type="hidden" class="form-control form-control-lg" type="" name="jobId"
               id="jobId"
               value="{{ $job->id }}" size="50" placeholder="Enter job id">


        <table class="table table-bordered table-striped " style="border: solid black 1px;">
            <thead>
            <tr>
                <th>Freelance name</th>
                <th>Freelance email</th>
                <th>Freelance address</th>
                <th class="text-center">Action</th>
            </tr>
            </thead>
            @foreach($job->users as $user)
                @if($user->pivot->status != 'accepted')
                    <tr onclick="window.location.href='/users/{{ $user->id}}'">

                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->address}}</td>
                        <td class="text-center">

                            <a href="{{ action('jobsController@accept',[$job->id,$user->id]) }}"
                               data-toggle="tooltip"
                               data-placement="bottom" title="Accept bid"
                               class='btn btn-info btn-xs' href=""><i
                                        class="fas fa-check"></i></a>
                            <a href="{{ action('jobsController@decline',[$job->id,$user->id]) }}"
                               data-toggle="tooltip"
                               data-placement="bottom" title="Deny bid"
                               class="btn btn-danger btn-xs"><i
                                        class="far fa-times-circle"></i></a>

                        </td>
                    </tr>
                @endif
            @endforeach

        </table>
    </div>
</fieldset>
<!-- Footer -->
<footer id="main-footer" style="">
    <p style="float: right">
        Printed By {{ Auth::user()->name }} <br>
        Printed On {{ date('F j, Y', strtotime(Carbon\Carbon::now())) }}
    </p>
</footer>
<!-- ./Footer -->
</body>
</html>