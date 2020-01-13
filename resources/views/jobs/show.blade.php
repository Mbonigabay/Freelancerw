@extends('layouts.app')

@section('content')
    <section class="clearfix" style="width: 100%; min-height: 700px">
        <div class="container">
            <div class="row">
                <div class="sidem  col-md-9 col-lg-9 float-left" style="width: 75%;color: darkblue">

                    <div class="card shadow border-0">
                        <div class="card-body">
                            <div class="clearfix">
                                <h3 class="float-left" style="text-transform: uppercase">{{$job->name}}</h3>
                                <h3 class="float-right">{{$job->jobBudget}} Frw</h3>
                            </div>
                            <br>
                            <div style="white-space: pre-wrap;">{{ $job->description }}</div>
                            <br>
                            <br><b>Status: </b>
                            @if($job->status=='Open')
                                @if($job->deadline < today())
                                    <span class="badge badge-warning" style="font-size: 15px">Expired</span>
                                @else
                                    <span class="badge badge-success" style="font-size: 15px">{{$job->status}}</span>
                                @endif
                            @else
                                <span class="badge badge-danger" style="font-size: 15px">{{$job->status}}</span>
                            @endif
                            - Posted {{ $job->created_at->diffForHumans()}} - {{$job->users->count()}} bids
                            <br><b>Skills: </b><a href="#" style="color: darkblue">{{$job->skills}}</a><br>
                            <b>Location:</b> {{ $job->location }}<br>
                            <b>Bidding will end :</b> {{ \Carbon\Carbon::parse($job->bidDeadline)->diffForHumans() }}
                            <br>
                            <b>Should be done :</b> {{ \Carbon\Carbon::parse($job->deadline)->diffForHumans() }}<br>
                            <br><b>Posted by: </b> <a
                                    href="/users/{{\App\User::where('id', $job->user_id)->first()->id}}">
                                <div style="text-transform: uppercase; color: darkblue; display: inline">{{\App\User::where('id', $job->user_id)->first()->name}}</div>
                            </a>

                            <form id="add-user" action="{{ action('jobsController@adduser') }}" method="post">
                                {{ csrf_field() }}

                                <input type="hidden" name="_method" value="post">

                                <div class="form-group">
                                    <input type="hidden" class="form-control form-control-lg" type="" name="job_id"
                                           id="job-id"
                                           value="{{ $job->id }}" size="50" placeholder="Enter job id">
                                    <input type="hidden" class="form-control form-control-lg" type="" name="user_id"
                                           id="user-id"
                                           value="{{ Auth::user()->id }}" size="50" placeholder="Enter user id">
                                </div>
                                @if($job->user_id != Auth::user()->id)
                                    @if($job->status == 'Open'  and $job->deadline > today())
                                        <button type="submit"
                                                onMouseOver="this.style.backgroundColor='darkblue'; this.style.color='white'"
                                                onMouseOut="this.style.backgroundColor='white'; this.style.color='darkblue'"
                                                class="btn"
                                                style="background-color: white; color: darkblue;border-radius: 1px; border-color: darkblue;">
                                            Bid
                                        </button>
                                    @endif
                                @endif
                            </form>


                        </div>

                    </div>

                    <div class="card mt-3 shadow border-0">
                        <div class="card-body">
                            <h3>Reviews</h3>
                            @foreach($job->comments as $comment)
                                <div class="col-sm-1 pb-1" style="resize: both">
                                    <div class="thumbnail">
                                        <img class="img-responsive user-photo img-fluid img-thumbnail"
                                             src="/uploads/avatars/{{ $comment->user->avatar }}">
                                    </div><!-- /thumbnail -->
                                </div><!-- /col-sm-1 -->
                                <div class="col-sm-11 pb-1">
                                    <div class="card card-default">
                                        <div class="card-heading pl-1">
                                            <strong>{{ $comment->user->name}}</strong> <span
                                                    class="text-muted">commented on {{ $comment->created_at}}</span>
                                            <div class=" float-right mr-1 dropdown">
                                                <a style="color: darkblue; cursor: pointer" class="dropdown-toggle"
                                                   id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                   aria-expanded="false"></a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    @if (Auth::id() == $comment->user->id)
                                                        <a style="color: darkblue" class="dropdown-item" value="delete"
                                                           href="{{route('comments.destroy', [$comment->id])}}"> Delete
                                                            Comment</a>
                                                    @else
                                                        <a style="color: darkblue" class="dropdown-item"> Report
                                                            Comment</a>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                        <div class="card-body">
                                            {{ $comment->body }}
                                        </div><!-- /card-body -->
                                    </div><!-- /card card-default -->
                                </div><!-- /col-sm-5 -->

                            @endforeach

                            <form class="pl-3" method="post" action="{{ route('comments.store') }}">
                                {{ csrf_field() }}


                                <input type="hidden" name="commentable_type" value="App\Job">
                                <input type="hidden" name="commentable_id" value="{{$job->id}}">


                                <div class="form-group">


                                    <label for="comment-content">Comment</label>
                                    <textarea placeholder="Enter comment"
                                              style="resize: vertical; width: 690px;"
                                              id="comment-content"
                                              name="body"
                                              size="120" spellcheck="false"
                                              class="form-control">


                                          </textarea>
                                </div>


                                <div class="form-group">
                                    <input type="submit" class="btn btn-dark"
                                           onMouseOver="this.style.backgroundColor='darkblue'; this.style.color='white'"
                                           onMouseOut="this.style.backgroundColor='white'; this.style.color='darkblue'"
                                           class="btn"
                                           style="background-color: white; color: darkblue;border-radius: 1px; border-color: darkblue;"
                                           value="Submit"/>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if( Auth::user()->id == $job->user_id)
                        <div class="card mt-3 shadow border-0">
                            <div class="card-body">
                                <h3>User who bidded</h3>

                                <div class="clearfix">
                                    <input type="hidden" class="form-control form-control-lg" type="" name="jobId"
                                           id="jobId"
                                           value="{{ $job->id }}" size="50" placeholder="Enter job id">


                                    <table class="table table-bordered table-striped ">
                                        <thead>
                                        <tr>
                                            <th>Freelance name</th>
                                            <th>Freelance email</th>
                                            <th>Freelance rating</th>
                                            <th>Freelance address</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        </thead>
                                        @foreach($job->users as $user)
                                            @if($user->pivot->status != 'accepted')
                                                <tr onclick="window.location.href='/users/{{ $user->id}}'">

                                                    <td>{{$user->name}}</td>
                                                    <td>{{$user->email}}</td>
                                                    <td>
                                                        @if($user->averageRating() == 0)
                                                            Not yet rated
                                                        @else
                                                            {{ number_format($user->averageRating(), 1)}}
                                                        @endif
                                                     </td>
                                                    <td>{{$user->address}}</td>
                                                    <td class="text-center">

                                                        <a href="{{ action('jobsController@accept',[$job->id,$user->id]) }}"
                                                           data-toggle="tooltip"
                                                           data-placement="bottom" title="Accept bid"
                                                           class='btn btn-info btn-xs'><i
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

                            </div>

                        </div>
                    @else
                        <div class="card mt-3 shadow border-0">
                            <div class="card-body">
                                <h3>User who won the bid</h3>

                                <div class="clearfix">
                                    <input type="hidden" class="form-control form-control-lg" type="" name="jobId"
                                           id="jobId"
                                           value="{{ $job->id }}" size="50" placeholder="Enter job id">


                                    <table class="table table-striped ">
                                        <thead>
                                        <tr>
                                            <th>Freelance name</th>
                                            <th>Freelance email</th>
                                            <th>Freelance rating</th>
                                            <th>Freelance address</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        </thead>
                                        @foreach($job->users as $user)
                                            @if($user->pivot->status == 'accepted')
                                                <tr onclick="window.location.href='/users/{{ $user->id}}'">

                                                    <td>{{$user->name}}</td>
                                                    <td>{{$user->email}}</td>
                                                    <td>{{ number_format($user->averageRating(), 1)}}</td>
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

                            </div>

                        </div>
                    @endif

                </div>

                <div class="sideb col-md-3 col-lg-3 float-right" style="width: 25%; color: darkblue">
                    <div class="sidebar-module">
                        <div class="card shadow border-0">
                            <div class="card-body">
                                <h4>ACTIONS</h4>
                                <ol class="list-unstyled" style="color: darkblue">
                                    <li><a href="{{ action('jobsController@create') }}" style="color: darkblue"><i
                                                    class="fas fa-plus"></i> Post
                                            a Job</a></li>
                                    <li><a href="{{action('jobsController@downloadJob', $job->id)}}"
                                           style="color: darkblue"><i class="fas fa-file-download"></i> Job Report
                                        </a></li>
                                    @if (Auth::user()->id == $job->user_id)
                                        <li><a href="{{ action('jobsController@edit', $job) }}" style="color: darkblue"><i
                                                        class="far fa-edit"></i> Edit</a></li>
                                        <li><a href="{{ action('jobsController@delete', $job->id) }}"
                                               style="color: darkblue"><i class="fas fa-trash-alt"></i> Delete</a>
                                        </li>
                                    @else
                                        <li><a href="" data-toggle="modal" data-target="#reportModal"
                                               style="color: darkblue"><i class="far fa-flag"></i>
                                                Report Job
                                            </a></li>
                                    @endif
                                </ol>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Report Modal -->
                <div class="modal fade" id="reportModal" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
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
                                        <h4>Report job</h4></br>
                                        <form method="post" action="{{ action('ReportsController@store') }}">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="reporteable_type" value="App\Job">
                                            <input type="hidden" name="reporteable_id" value="{{$job->id}}">
                                            <input type="hidden" value="{{$job->user_id}}" name="reported">

                                            <div class="form-group">
                                                <label for="user_from">Me: <span class="required"></span></label>
                                                <label> {{Auth::user()->email}}</label>
                                            </div>
                                            <div class="form-group">
                                                <label for="user_from">Reporting: <span class="required"></span></label>
                                                <label> {{App\User::where('id', $job->user_id)->first()->email}} 's
                                                    Job</label>

                                            </div>
                                            <div class="form-group">
                                                <label for="subject">Why: </label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="title"
                                                           id="exampleRadios1" value="It’s suspicious or spam">
                                                    <label class="form-check-label" for="exampleRadios1">
                                                        It’s suspicious or spam
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="title"
                                                           id="exampleRadios2" value="It's abusive or harmful">
                                                    <label class="form-check-label" for="exampleRadios2">
                                                        It's abusive or harmful
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="title"
                                                           id="exampleRadios3" value="It's misleading">
                                                    <label class="form-check-label" for="exampleRadios3">
                                                        It's misleading
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="message">More Description: </label>
                                                <textarea class="form-control" name="body" id="body"
                                                          placeholder="Enter your reason" rows="5"
                                                          style="resize: vertical"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-dark"
                                                    onMouseOver="this.style.backgroundColor='darkblue'; this.style.color='white'"
                                                    onMouseOut="this.style.backgroundColor='white'; this.style.color='darkblue'"
                                                    class="btn"
                                                    style="background-color: white; color: darkblue;border-radius: 1px; border-color: darkblue;">
                                                Report
                                            </button>
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