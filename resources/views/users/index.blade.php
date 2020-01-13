@extends('layouts.app')

@section('content')
    <section class="clearfix" style="width: 100%">
        <div class="container">
            <div class="row">
                <div class="sidem  col-md-9 col-lg-9 float-left" style="width: 75%;min-height: 1000px">

                    <div class="card shadow border-0">


                        <!--end of col-->
                        <div class="card-body" style="color: darkblue">
                            <form class="" action="/searchUser" method="get">
                                <div class="card-body row no-gutters align-items-center">
                                    <div class="col-auto">
                                    </div>
                                    <!--end of col-->
                                    <div class="col">
                                        <input class="form-control form-control-md "
                                               name="search" type="search" id="search"
                                               style="border-radius: 1px; color: darkblue"
                                               placeholder="Search topics or keywords">
                                    </div>
                                    <!--end of col-->
                                    <div class="col-auto">
                                        <button class="btn btn-md btn-dark" type="submit"
                                                style="background-color: white; color: darkblue;border-radius: 1px;">
                                            Search
                                        </button>
                                    </div>
                                    <!--end of col-->
                                </div>
                            </form>

                            <div class="row">
                                @foreach($users as $user)
                                    <div class="col-md-4">
                                        <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                                            <div class="mainflip">
                                                <div class="frontside">
                                                    <div class="card mb-4">
                                                        <img class="card-img-top"
                                                             src="/uploads/avatars/{{ $user->avatar }}"
                                                             alt="Card image cap">
                                                        <div class="card-body">
                                                            <h5 class="card-title">{{ $user->name }}</h5>
                                                            <br><b>{{ $user->areaOfExpertise }}</b>
                                                            <br><b>Skills:</b> {{$user->skills}}
                                                            <br> <b>Rating:</b>
                                                            @if($user->averageRating() == 0)
                                                                <span class="badge badge-warning"
                                                                      style="font-size: 15px"> Not yet rated</span>
                                                            @else
                                                                <span class="badge badge-success"
                                                                      style="font-size: 15px"> {{ number_format($user->averageRating(), 1)}}</span>
                                                            @endif
                                                            @if(Auth::user()->role_id == 1)
                                                                <br><b>User role:</b> {{$user->role->name}}
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="backside"
                                                     onclick="window.location.href='/users/{{ $user->id}}'">
                                                    <div class="card ">
                                                        <div class="card-body">
                                                            <h5 class="card-title">{{ $user->name }}</h5>
                                                            <p class="card-text" style="color: black">
                                                                {{ $user->description }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    {{--<div class="" style="margin-top: 2px; margin-left: 350px;color: darkblue">--}}
                    {{--{!! $users->links(); !!}--}}
                    {{--</div>--}}

                </div>

                <div class="sideb col-md-3 col-lg-3 float-right" style="width: 25%;">
                    <div class="sidebar-module">
                        <div class="card shadow border-0">
                            {{--<div class="card-header" style="background-color: darkblue; color: white"><h4>ACTIONS</h4>--}}
                            {{--</div>--}}
                            <div class="card-body" style="color: darkblue">

                                {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="card mt-3">--}}
                                {{--<div class="card-header" style="background-color: darkblue; color: white"><h4>--}}
                                {{--CATEGORIES</h4>--}}
                                {{--</div>--}}
                                {{--<div class="card-body">--}}
                                <h4>CATEGORIES</h4><br>
                                {{--<ol class="list-unstyled">--}}
                                {{--@foreach($jobs as $job)--}}
                                {{--<li><a href="{{action('jobsController@search',['search' => $user->skills])}}" style="color: darkblue"> <i class="fas fa-angle-double-right"></i> {{ $user->skills }}</a></li>--}}
                                {{--@endforeach--}}
                                {{--</ol>--}}
                                {{--<div class="" style="margin-top: 2px; margin-left: 350px;">--}}
                                {{--{!! $users->links(); !!}--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>


    <script type="text/javascript">
        var path = "{{ route('autoComplete') }}";
        $('input.typeahead').typeahead({
            source: function (query, process) {
                return $.get(path, {query: skills}, function (data) {
                    return process(data);
                });
            }
        });
    </script>

@endsection