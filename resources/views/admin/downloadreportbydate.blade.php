<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <style>
        body {
            font-family: 'Merriweather', serif;
            font-size: 16px;
        }

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

<p style="font-family: 'Trajan Pro'; text-align: center; text-decoration: underline; font-size: 30px">Report of {{ date('F j, Y', strtotime($searchDate)) }}</p>
<fieldset>
    <legend>Daily Info</legend>
    <b>Number of User Logged on {{ $searchDate }} : </b>{{ \App\User::whereDate('last_login_at', $searchDate)->count() }}<br>
    <b>Number of User Created on {{ $searchDate }} : </b>{{ \App\User::whereDate('created_at', $searchDate)->count() }}<br>
    <b>Number of User Banned on {{ $searchDate }} : </b>{{ \App\User::whereDate('banned_at', $searchDate)->count() }}<br>
    <b>Number of Jobs Created on {{ $searchDate }} : </b>{{ \App\Job::whereDate('created_at', $searchDate)->count() }}<br>
    <b>Number of Bids on {{ $searchDate }} : </b>{{ DB::table('job_user')->whereDate('created_at', $searchDate)->count() }}<br>
</fieldset>
<br>
<fieldset>
    <legend>User</legend>
    @foreach ($list_blocks as $block)
        <div class="ml-3">
            <h3>{{ $block['title'] }}</h3>
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Last login at</th>
                </tr>
                </thead>
                <tbody>
                @forelse($block['entries'] as $entry)
                    <tr>
                        <td>{{ $entry->name }}</td>
                        <td>{{ $entry->email }}</td>
                        <td>{{ $entry->last_login_at }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">{{ __('No entries found') }}</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    @endforeach
</fieldset>
<br>
<fieldset>
    <legend>Job</legend>
    @foreach ($jobs_blocks as $block)
        <div class="ml-3">
            <h3>{{ $block['title'] }}</h3>
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>By</th>
                    <th>Create  at</th>
                </tr>
                </thead>
                <tbody>
                @forelse($block['entries'] as $entry)
                    <tr>
                        <td>{{ $entry->name }}</td>
                        <td>{{ App\User::where('id', $entry->user_id)->first()->name }}</td>
                        <td>{{ $entry->created_at }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">{{ __('No entries found') }}</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    @endforeach
</fieldset>

<fieldset>
    <legend>Bid</legend>
    @foreach ($bids_blocks as $block)
        <div class="ml-3">
            <h3>{{ $block['title'] }}</h3>
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>User</th>
                    <th>Bidded on</th>
                    <th>Create  By</th>
                </tr>
                </thead>
                <tbody>
                @forelse($block['entries'] as $entry)
                    <tr>
                        <td>{{ App\User::where('id', $entry->user_id)->first()->name }}</td>
                        <td>{{ App\Job::where('id', $entry->job_id)->first()->name }}</td>
                        <td>{{ App\User::where('id', App\Job::where('id', $entry->job_id)->first()->user_id)->first()->name }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">{{ __('No entries found') }}</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    @endforeach
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