@extends('layouts.app')

@section('content')
    <section class="clearfix" style="width: 100%; min-height: 700px">
        <div class="container">
            <div class="row">
                <div class="sidem  col-md-9 col-lg-9 float-left" style="width: 75%;color: darkblue">


                    <div class="card shadow border-0">
                        <div class="card-body">
                            <div class="row">
                                @foreach ($comment_list as $block)
                                    <div class="ml-3">
                                        <h3>{{ $block['title'] }}</h3>
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>User</th>
                                                <th>Reported</th>
                                                <th>By</th>
                                                <th>On</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($block['entries'] as $entry)
                                                <tr>
                                                    <td>{{ App\User::where('id', $entry->reporter)->first()->name }}</td>
                                                    <td>{{ $entry->reporteable_type ::where('id', $entry->reporteable_id )->first()->body}}</td>
                                                    <td>{{ App\User::where('id', $entry->reported)->first()->name }}</td>
                                                    <td>{{ $entry->created_at }}</td>

                                                    <td>
                                                        <a type="button" class="btn btn-danger" href=' {{ action('commentsController@destroy', $entry->reporteable_type ::where('id', $entry->reporteable_id )->first()->id) }}'>Resolve</a>
                                                        <a type="button" class="btn btn-success" href=' {{ action('ReportsController@destroy', $entry->id) }}'>Resolved</a>
                                                    </td>
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
                                @foreach ($job_list as $block)
                                    <div class="ml-3">
                                        <h3>{{ $block['title'] }}</h3>
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>User</th>
                                                <th>Reported</th>
                                                <th>By</th>
                                                <th>On</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($block['entries'] as $entry)
                                                <tr>
                                                    <td>{{ App\User::where('id', $entry->reporter)->first()->name }}</td>
                                                    <td><a href="/jobs/{{$entry->reporteable_type ::where('id', $entry->reporteable_id )->first()->id}}">
                                                        <div style="text-transform: uppercase; color: darkblue; display: inline"> {{$entry->reporteable_type ::where('id', $entry->reporteable_id )->first()->name}}</div></a>
                                                    </td>
                                                    <td>{{ App\User::where('id', $entry->reported)->first()->name }}</td>
                                                    <td>{{ $entry->created_at }}</td>

                                                    <td>
                                                        <button type="button" class="btn btn-danger">Resolve</button>
                                                        <a type="button" class="btn btn-success" href=' {{ action('ReportsController@destroy', $entry->id) }}'>Resolved</a>
                                                    </td>
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
                                @foreach ($user_list as $block)
                                    <div class="ml-3">
                                        <h3>{{ $block['title'] }}</h3>
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>User</th>
                                                <th>Reported</th>
                                                <th>On</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($block['entries'] as $entry)
                                                <tr>
                                                    <td>{{ App\User::where('id', $entry->reporter)->first()->name }}</td>
                                                    <td>
                                                     <a href="/users/{{$entry->reporteable_type ::where('id', $entry->reporteable_id )->first()->id}}">
                                                        <div style="text-transform: uppercase; color: darkblue; display: inline">{{$entry->reporteable_type ::where('id', $entry->reporteable_id )->first()->name}}</div></a>
</td>
                                                    <td>{{ $entry->created_at }}</td>

                                                    <td>
                                                        <a type="button" class="btn btn-danger" href="{{ action('ReportsController@resolveUser', App\User::where('id', $entry->reporteable_id)->first()->id ) }}">Resolve</a>
                                                        <a type="button" class="btn btn-success" href=' {{ action('ReportsController@destroy', $entry->id) }}'>Resolved</a>
                                                    </td>
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
                            </div>
                        </div>
                    </div>

                </div>


                <div class="sideb col-md-3 col-lg-3 float-right" style="width: 25%; color: darkblue">
                    <div class="sidebar-module">

                        <div class="card shadow border-0">
                            <div class="card-body">
                                <h4>ACTIONS</h4>
                                <ol class="list-unstyled" style="color: darkblue">
                                    <li><a href="" style="color: darkblue"><i
                                                    class="fas fa-plus"></i> Manage Role</a></li>

                                    <li><a href="" style="color: darkblue"><i
                                                    class="far fa-edit"></i> User's Problem</a></li>

                                    <li class="dropdown">
                                        <a  style="color: darkblue; cursor: pointer" class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-file-download"></i> Download Report</a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a style="color: darkblue" class="dropdown-item" cursor="pointer" href="{{action('AdminController@downloadReport')}}"><i class="fas fa-file-download"></i> Today's Report</a>
                                            <a style="color: darkblue" cursor="pointer" data-toggle="modal" data-target="#exampleModal" class="dropdown-item" ><i class="fas fa-file-download"></i> Choose any day's report</a>
                                        </div>
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
