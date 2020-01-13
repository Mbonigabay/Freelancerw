@extends('layouts.app')

@section('content')
    <section class="clearfix" style="width: 100%; min-height: 700px">
        <div class="container">
            <div class="row">
                <div class="sidem  col-md-9 col-lg-9 float-left" style="width: 75%;color: darkblue">

                    <div class="card shadow border-0">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">

                                    <div class="col-md-3">
                                        <div class="card-counter info">
                                            <i class="fa fa-users"></i>
                                            <span class="count-numbers">{{ \App\User::count() }}</span>
                                            <span class="count-name">Users</span>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="card-counter primary">
                                            <i class="far fa-calendar-check"></i>
                                            <span class="count-numbers">{{ \App\User::whereDate('last_login_at', today())->count() }}</span>
                                            <span class="count-name">Today
                                                Login</span>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="card-counter danger">
                                            <i class="fas fa-suitcase"></i>
                                            <span class="count-numbers">{{ \App\Job::count() }}</span>
                                            <span class="count-name">Jobs</span>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="card-counter success">
                                            <i class="fas fa-list-ul"></i>
                                            <span class="count-numbers">{{ DB::table('job_user')->count() }}</span>
                                            <span class="count-name">Bids</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="card mt-3 shadow border-0">
                        <div class="card-body">
                            <div class="row">
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
                                                    <td> <a href="/users/{{$entry->id}}">
                                                            <div style="text-transform: uppercase; color: darkblue; display: inline">{{$entry->name}}</div></a>
                                                    </td>
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
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3 shadow border-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="ml-2 {{ $chart->options['column_class'] }}">
                                    <h3>{!! $chart->options['chart_title'] !!}</h3>
                                    {!! $chart->renderHtml() !!}
                                </div>
                                <div class="ml-2 {{ $chartReg->options['column_class'] }}">
                                    <h3>{!! $chartReg->options['chart_title'] !!}</h3>
                                    {!! $chartReg->renderHtml() !!}
                                </div>
                                <div class="ml-2 {{ $chartJob->options['column_class'] }}">
                                    <h3>{!! $chartJob->options['chart_title'] !!}</h3>
                                    {!! $chartJob->renderHtml() !!}
                                </div>
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

                                    <li class="dropdown">
                                        <a style="color: darkblue; cursor: pointer" class="dropdown-toggle"
                                           id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                           aria-expanded="false"><i class="fas fa-file-download"></i> Download
                                            Report</a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a style="color: darkblue" cursor="pointer" data-toggle="modal"
                                               data-target="#exampleModal" class="dropdown-item"><i
                                                        class="fas fa-file-download"></i> Report By Day</a>
                                            <a style="color: darkblue" cursor="pointer" data-toggle="modal"
                                               data-target="#exampleModal1" class="dropdown-item"><i
                                                        class="fas fa-file-download"></i> Report By Date Interval</a>
                                        </div>
                                    </li>

                                    <li><a href="{{ action('ReportsController@index') }}" style="color: darkblue"><i
                                                    class="fas fa-plus"></i> Manage User's reports</a></li>

                                </ol>
                            </div>
                        </div>
                        <div class="card mt-3 shadow border-0">
                            <div class="card-body">
                                <h4>LAST ADDED JOBS</h4>
                                <ol class="list-unstyled" style="color: darkblue">
                                    @foreach( $jobs as $job)
                                        <li><i class="far fa-circle"></i> <b>


                                                <a href="/jobs/{{\App\Job::where('id', $job->id)->first()->id}}">
                                                    <div style="text-transform: uppercase; color: darkblue; display: inline"> {{$job->name}}</div></a>
                                            </b>
                                            by <a href="/users/{{\App\User::where('id', $job->user_id)->first()->id}}">
                                                <div style="color: darkblue; display: inline">{{\App\User::where('id', $job->user_id)->first()->name}}</div></a>

                                        </li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>

                        <div class="card mt-3 shadow border-0">
                            <div class="card-body">
                                <h4>LAST REGISTERD USERS</h4>
                                <ol class="list-unstyled" style="color: darkblue">
                                    @foreach( $users as $user)
                                        <li><i class="far fa-circle"></i>
                                            <a href="/users/{{$user->id}}">
                                                <div style="text-transform: uppercase; color: darkblue; display: inline">{{$user->name}}</div></a>
                                        </li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>


                    </div>
                </div>


                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                Report By Day
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card shadow border-0">
                                    {{--<div class="card-header" style="background-color: darkblue; color: white">--}}
                                    {{--<h4>POST JOB</h4>--}}
                                    {{--</div>--}}
                                    <div class="card-body" style="color: darkblue">
                                        <form class="" action="/downloadreportbydate" method="get">
                                            <div class="card-body row no-gutters align-items-center">
                                                <div class="col-auto">
                                                </div>
                                                <!--end of col-->
                                                <div class="col dates">
                                                    <input class="form-control form-control-md "
                                                           name="searchbydate" type="search" id="search"
                                                           autocomplete="off" type="text" placeholder="Choose date"
                                                           id="date">
                                                </div>
                                                <!--end of col-->
                                                <div class="col-auto">
                                                    <button class="btn btn-md btn-dark" type="submit"
                                                            style="background-color: white; color: darkblue;border-radius: 1px;">
                                                        Download
                                                    </button>
                                                </div>
                                                <!--end of col-->
                                            </div>
                                        </form>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ModalByPeriod -->
                <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                Report By Date Interval
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card shadow border-0">
                                    {{--<div class="card-header" style="background-color: darkblue; color: white">--}}
                                    {{--<h4>POST JOB</h4>--}}
                                    {{--</div>--}}
                                    <div class="card-body" style="color: darkblue">
                                        <form class="" action="/downloadreport" method="get">
                                            <div class="card-body row no-gutters align-items-center">
                                                <div class="col-auto">
                                                </div>
                                                <!--end of col-->
                                                <div class="col dates">
                                                    <input class="form-control form-control-md "
                                                           name="startDate" type="search" id="search"
                                                           autocomplete="off" type="text"
                                                           placeholder="Choose start date"
                                                           id="date">

                                                    <input class="form-control form-control-md mt-3"
                                                           name="endDate" type="search" id="search"
                                                           autocomplete="off" type="text" placeholder="Choose end date"
                                                           id="date">
                                                </div>
                                                <!--end of col-->
                                                <div class="col-auto">
                                                    <button class="btn btn-md btn-dark" type="submit"
                                                            style="background-color: white; color: darkblue;border-radius: 1px;">
                                                        Download
                                                    </button>
                                                </div>
                                                <!--end of col-->
                                            </div>
                                        </form>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </section>


@endsection
@section('scripts')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    {!! $chart->renderJs() !!}
    {!! $chartReg->renderJs() !!}
    {!! $chartJob->renderJs() !!}
@endsection