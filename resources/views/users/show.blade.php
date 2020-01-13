@extends('layouts.app')

@section('content')
    <section class="clearfix " style="width: 100%">
        <div class="container">

            <div class="row">

                <div class="sidem  col-md-9 col-lg-9 float-left" style="width: 75%;">

                    <div class="card shadow border-0">
                        <div class="card-body">
                            <div class="clearfix" style="color: darkblue">
                                <h3 class="float-left" style="text-transform: uppercase">{{$user->name}}</h3>
                                <h3 class="float-right">{{$user->areaOfExpertise}}</h3>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-lg-4 float-left" style="width: 25%; color: darkblue">

                                    <div class="card">
                                        <div class="card-body">
                                            <img src="/uploads/avatars/{{ $user->avatar }}"
                                                 style="width: 180px; height:180px;border: 1px solid #ddd; border-radius: 4px; padding: 5px;"> </br></br>
                                            @if($user->verify=='verified')
                                                <span class="badge badge-success" style="font-size: 15px">{{$user->verify}}
                                                    account</span>
                                            @endif
                                            <br>
                                            <b>From:</b> {{$user->address}}</br>
                                            <b>Work for:</b> {{$user->rateOfPayment}} Frw/hour <br>
                                            <b>Member since:</b> {{$user->created_at->todatestring()}}<br>

                                            @if (Auth::user()->role_id == 1)
                                                <b>Role:</b> {{\App\Role::where('id', $user->role_id)->first()->name}}
                                                <br>
                                            @endif
                                            <b>Skills:</b> {{$user->skills}}
                                            <br>
                                            <form action="{{route('userStar', $user->id )}}" id="addStar" method="POST">
                                                <b>Rating:</b>
                                                @if($user->averageRating() == 0)
                                                    <span class="badge badge-warning"
                                                          style="font-size: 15px"> Not yet rated</span>
                                                @else
                                                    <span class="badge badge-success"
                                                          style="font-size: 15px"> {{ number_format($user->averageRating(), 1)}}</span>
                                                @endif
                                                @if( Auth::id() != $user->id)
                                                    <code>{{ csrf_field() }}
                                                        {{--<input name="star" type="radio" value="5" />--}}
                                                        {{--<input name="star" type="radio" value="4" />--}}
                                                        {{--<input name="star" type="radio" value="3" />--}}
                                                        {{--<input name="star" type="radio" value="2" />--}}
                                                        <div class="clearfix">
                                                            <div class="rating">
                                                                <input type="radio" id="star5" name="rating"
                                                                       value="5"/><label for="star5" title="Great">5
                                                                    stars</label>
                                                                <input type="radio" id="star4" name="rating"
                                                                       value="4"/><label for="star4" title="Good">4
                                                                    stars</label>
                                                                <input type="radio" id="star3" name="rating"
                                                                       value="3"/><label for="star3" title="Kinda bad">3
                                                                    stars</label>
                                                                <input type="radio" id="star2" name="rating"
                                                                       value="2"/><label for="star2"
                                                                                         title="Sucks big tim">2
                                                                    stars</label>
                                                                <input type="radio" id="star1" name="rating"
                                                                       value="1"/><label for="star1" title="Horrible">1
                                                                    star</label>
                                                            </div>

                                                            <div class=""
                                                                 style="">
                                                                <button name="submit"
                                                                        type="submit"
                                                                        onMouseOver="this.style.backgroundColor='darkblue'; this.style.color='white'"
                                                                        onMouseOut="this.style.backgroundColor='white'; this.style.color='darkblue'"
                                                                        class="btn ml-2 "
                                                                        style="font-size: 10px; background-color: white; color: darkblue; border-color: darkblue;">
                                                                    Rate
                                                                </button>
                                                            </div>
                                                        </div>

                                                    </code>

                                                @endif
                                                {{--<input name="star" type="radio" value="1" />--}}

                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-md-8 col-lg-8 float-right" style="width: 75%; color: darkblue">

                                    <div class="card">
                                        <div class="card-body">

                                            <div style="white-space: pre-wrap;">{{ $user->description }}</div>
                                            {{--                                     <video width="320" height="240" controls>
                                                                                      <source src="/img/try.MP4" type="video/mp4">
                                                                                    Your browser does not support the video tag.
                                                                                </video>
                                             --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-5 shadow border-0" style="color: darkblue">

                        <div class="card-body ">
                            <h4>Portfolio</h4>
                            <div class="container">
                                <div class="row">
                                    <div class="row">
                                        @foreach($photos as $photo)
                                            {{--<img src="/pictures/{{ $photo->picture }}"--}}
                                            {{--style="width: 150px; height:150px;"> </br></br>--}}
                                            {{--{{$photo->body}}--}}
                                            <div class="col-lg-3 col-md-4 col-xs-6 thumb">

                                                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal"
                                                   data-title=""
                                                   data-image="/pictures/{{ $photo->picture }}"
                                                   data-target="#image-gallery">
                                                    <img class="img-thumbnail"
                                                         src="/pictures/{{ $photo->picture }}"
                                                         alt="Another alt text">
                                                </a>
                                                <div class="">
                                                    <a style="text-decoration: none; color: darkblue;"
                                                       href='  {{$photo->body}}'>  {{$photo->body}}</a>

                                                </div>
                                            </div>

                                            <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog"
                                                 aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="image-gallery-title"></h4>

                                                            <button class="btn"
                                                                    onclick="window.location.href=' {{ action('PhotosController@destroy', $photo->id) }}'">
                                                                Delete
                                                            </button>

                                                            <button type="button" class="close"
                                                                    data-dismiss="modal"><span
                                                                        aria-hidden="true">×</span><span
                                                                        class="sr-only">Close</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <img id="image-gallery-image"
                                                                 class="img-responsive col-md-12"
                                                                 src="">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary float-left"
                                                                    id="show-previous-image"><i
                                                                        class="fa fa-arrow-left"></i>
                                                            </button>


                                                            <button type="button" id="show-next-image"
                                                                    class="btn btn-secondary float-right"><i
                                                                        class="fa fa-arrow-right"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ action('PhotosController@upload')}}" method="post" id="js-upload-form"
                                  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="user-description">Picture Description: </label>
                                    <textarea class="form-control " name="body" id="user-description"
                                              placeholder="Enter picture desription" rows="5"
                                              style="resize: vertical"></textarea>
                                </div>
                                <div class="form-group-group">
                                    <label for="user-name">Profile Picture: <span class="required"></span></label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input name="picture" type="file"
                                                   id="js-upload-files"
                                                   class="custom-file-input form-control-file form-control-md"
                                                   id="inputGroupFile04"
                                                   size="60" aria-describedby="inputGroupFileAddon04">
                                            <label class="custom-file-label" for="inputGroupFile04">Choose Image</label>
                                        </div>
                                        <div class="input-group-append">
                                            <button name="submit" class="btn btn-outline-secondary" type="submit"
                                                    id="inputGroupFileAddon04">Upload
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card mt-5 shadow border-0" style="color: darkblue">

                        <div class="card-body ">
                            <h4>REVIEWS</h4>
                            @foreach($user->comments as $comment)
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
                                                    @if(Auth::id() == $comment->user->id)
                                                        <a style="color: darkblue" class="dropdown-item"
                                                           href=' {{ action('commentsController@destroy', $comment->id) }}'>
                                                            Delete Comment</a>
                                                    @else
                                                        <a style="color: darkblue" data-toggle="modal"
                                                           data-target="#reportModal" class="dropdown-item"> Report
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

                                <!-- Report Modal -->
                                <div class="modal fade" id="reportModal" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card shadow border-0">
                                                    {{--<div class="card-header" style="background-color: darkblue; color: white">--}}
                                                    {{--<h4>POST JOB</h4>--}}
                                                    {{--</div>--}}
                                                    <div class="card-body" style="color: darkblue">
                                                        <h4>Report a comment</h4></br>
                                                        <form method="post"
                                                              action="{{ action('ReportsController@store') }}">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="reporteable_type"
                                                                   value="App\Comment">
                                                            <input type="hidden" name="reporteable_id"
                                                                   value="{{$comment->id}}">
                                                            <input type="hidden" value="{{$comment->user->id}}"
                                                                   name="reported">

                                                            <div class="form-group">
                                                                <label for="user_from">Me: <span
                                                                            class="required"></span></label>
                                                                <label> {{Auth::user()->email}}</label>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="user_from">Reporting: <span
                                                                            class="required"></span></label>
                                                                <label> {{$comment->user->email}} 's Comment</label>

                                                            </div>
                                                            <div class="form-group">
                                                                <label for="subject">Why: </label>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                           name="title"
                                                                           id="exampleRadios1"
                                                                           value="It’s suspicious or spam">
                                                                    <label class="form-check-label"
                                                                           for="exampleRadios1">
                                                                        It’s suspicious or spam
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                           name="title"
                                                                           id="exampleRadios2"
                                                                           value="It's abusive or harmful">
                                                                    <label class="form-check-label"
                                                                           for="exampleRadios2">
                                                                        It's abusive or harmful
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                           name="title"
                                                                           id="exampleRadios3" value="It's misleading">
                                                                    <label class="form-check-label"
                                                                           for="exampleRadios3">
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


                            @endforeach

                            <form class="pl-3" method="post" action="{{ route('comments.store') }}">
                                {{ csrf_field() }}


                                <input type="hidden" name="commentable_type" value="App\User">
                                <input type="hidden" name="commentable_id" value="{{$user->id}}">


                                <div class="form-group">


                                    <label for="comment-content">Comment:</label>
                                    <textarea class="form-control " name="body" id="user-description"
                                              placeholder="Enter comment" rows="5"
                                              style="resize: vertical;">


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

                </div>

                <div class="sideb col-md-3 col-lg-3 float-right" style="width: 25%; color: darkblue">
                    <div class="sidebar-module">
                        <div class="card shadow border-0">

                            <div class="card-body">
                                <h4>ACTIONS</h4>
                                <ol class="list-unstyled">
                                    @if (Auth::user()->id != $user->id)
                                        <li><a class=" " data-toggle="modal" data-target="#exampleModal"
                                               href="{{ action('MessageController@create', $user->id) }}"
                                               style="color: darkblue"><i class="far fa-envelope"></i> Send a
                                                message</a>
                                        </li>
                                    @endif
                                <!-- Button trigger modal -->
                                    {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">--}}
                                    {{--Launch demo modal--}}
                                    {{--</button>--}}


                                    <li><a href="{{action('usersController@downloadCv', $user->id)}}"
                                           style="color: darkblue"><i class="fas fa-download"></i> <div style="text-transform: uppercase; display: inline;color: darkblue">{{$user->name}}</div>
                                            's
                                            C.V.</a>
                                    <li><a href="{{ action('usersController@edit', $user->id) }}"
                                           style="color: darkblue"><i
                                                    class="far fa-edit"></i> Edit</a></li>
                                    <li><a href="{{ action('jobsController@viewByUser', $user->id) }}"
                                           style="color: darkblue"><i class="fas fa-briefcase"></i>
                                            <div style="text-transform: uppercase; display: inline;color: darkblue">{{$user->name}}</div>
                                            's jobs</a></li>
                                    <li><a href="{{ action('usersController@viewMyBid', $user->id) }}"
                                           style="color: darkblue"><i class="far fa-flag"></i>
                                            <div style="text-transform: uppercase; display: inline;color: darkblue">{{$user->name}}</div>
                                            's bid</a></li>
                                    @if(Auth::id() != $user->id)
                                        <li><a href="" data-toggle="modal" data-target="#reportModalUser"
                                               style="color: darkblue"><i class="far fa-flag"></i>
                                                Report
                                                <div style="text-transform: uppercase; display: inline;color: darkblue">{{$user->name}}</div>
                                            </a></li>
                                    @endif


                                </ol>

                            </div>
                        </div>
                        {{--<div class="card shadow mt-3 border-0">--}}

                        {{--<div class="card-body">--}}
                        {{--<h4>CAREER DETAILS</h4>--}}
                        {{--<ol class="list-unstyled">--}}


                        {{--<li><a href="" style="color: darkblue"><i class="fas fa-user-graduate"></i>Education--}}
                        {{--Background</a>--}}
                        {{--<p>{{$user->educationBackground}}</p></li>--}}
                        {{--<li><a href="" style="color: darkblue"><i class="fas fa-briefcase"></i>Work--}}
                        {{--Experience</a>--}}
                        {{--<p>{{$user->workExperience}}</p></li>--}}

                        {{--</ol>--}}

                        {{--</div>--}}
                        {{--</div>--}}
                    </div>
                </div>
                <!-- Message Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
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
                                        <h4>Compose a message</h4></br>
                                        <form method="post" action="{{ action('MessageController@compose') }}">
                                            {{ csrf_field() }}


                                            <div class="form-group">
                                                <label for="user_from">From: <span class="required"></span></label>
                                                <label> {{Auth::user()->email}}</label>
                                            </div>
                                            <div class="form-group">
                                                <label for="user_to">To: </label>
                                                <input class="form-control" value="{{$user->email}}" name="user_to"
                                                       id="user_to"
                                                       placeholder="Enter User's Email">
                                            </div>
                                            <div class="form-group">
                                                <label for="subject">Subject: </label>
                                                <input class="form-control" name="subject" id="subject"
                                                       placeholder="Enter Message's Subject">
                                            </div>
                                            <div class="form-group">
                                                <label for="message">Message: </label>
                                                <textarea class="form-control" name="message" id="message"
                                                          placeholder="Enter your message" rows="5"
                                                          style="resize: vertical"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-dark"
                                                    onMouseOver="this.style.backgroundColor='darkblue'; this.style.color='white'"
                                                    onMouseOut="this.style.backgroundColor='white'; this.style.color='darkblue'"
                                                    class="btn"
                                                    style="background-color: white; color: darkblue;border-radius: 1px; border-color: darkblue;">
                                                Send
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Report User -->
                <div class="modal fade" id="reportModalUser" tabindex="-1" role="dialog"
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
                                        <h4>Report user</h4></br>
                                        <form method="post" action="{{ action('ReportsController@store') }}">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="reporteable_type" value="App\User">
                                            <input type="hidden" name="reporteable_id" value="{{$user->id}}">
                                            <input type="hidden" value="{{$user->id}}" name="reported">

                                            <div class="form-group">
                                                <label for="user_from">Me: <span class="required"></span></label>
                                                <label> {{Auth::user()->email}}</label>
                                            </div>
                                            <div class="form-group">
                                                <label for="user_from">Reporting: <span class="required"></span></label>
                                                <label> {{$user->email}} 's Account</label>

                                            </div>
                                            <div class="form-group">
                                                <label for="subject">Why: </label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="title"
                                                           id="exampleRadios1" value="It’s suspicious or spam">
                                                    <label class="form-check-label" for="exampleRadios1">
                                                        They are suspicious or spam
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="title"
                                                           id="exampleRadios2" value="It's abusive or harmful">
                                                    <label class="form-check-label" for="exampleRadios2">
                                                        They are abusive or hateful
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="title"
                                                           id="exampleRadios3" value="It's misleading">
                                                    <label class="form-check-label" for="exampleRadios3">
                                                        They’re pretending to be me or someone else
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
    <script>

    </script>
@endsection