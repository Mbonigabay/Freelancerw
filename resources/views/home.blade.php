@extends('layouts.app')

@section('content')
    <div>


            <div id="carouselExampleControls" class="carousel slide"  data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" style="background-image: url('../img/image1.jpg');height: 500px;">
                        <img src="{{ asset('img/image1.jpg') }}" class="img-fluid d-block h-15 w-100"  alt="...">
                        <div class="carousel-caption ">
                            <h1>Hire expert freelancers for any job, online</h1>
                            <h3 class="hech3">Millions of small businesses use Freelancer to turn their ideas into reality.</h3>
                        </div>
                    </div>
                    <div class="carousel-item" style="background-image: url('../img/image2.jpg');height: 500px;">
                        <img src="{{ asset('img/image2.jpg') }}" class="d-block w-100" alt="...">
                        <div class="carousel-caption ">
                            <h1>Hire expert freelancers for any job, online</h1>
                            <h3 class="hech3">Millions of small businesses use Freelancer to turn their ideas into reality.</h3>
                        </div>
                    </div>
                    <div class="carousel-item" style="background-image: url('../img/image3.jpg');height: 500px;">
                        <img src="{{ asset('img/image3.jpg') }}" class="d-block w-100" alt="...">
                        <div class="carousel-caption ">
                            <h1>Hire expert freelancers for any job, online</h1>
                            <h3 class="hech3">Millions of small businesses use Freelancer to turn their ideas into reality.</h3>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

        {{--<section id="home-icons" class="py-5" style="color: darkblue">--}}
            {{--<div class="container">--}}
                {{--<div class="row">--}}
                    {{--<div class="col-md-4 mb-4 text-center">--}}
                        {{--<i class="fa fa-cog mb-2 fa-3x" ></i>--}}
                        {{--<h3>Turning Gears</h3>--}}
                        {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat, maxime.</p>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-4 mb-4 text-center">--}}
                        {{--<i class="fa fa-cloud mb-2 fa-3x"></i>--}}
                        {{--<h3>Sending Data</h3>--}}
                        {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat, maxime.</p>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-4 mb-4 text-center">--}}
                        {{--<i class="fa fa-cart-plus mb-2 fa-3x"></i>--}}
                        {{--<h3>Making Money</h3>--}}
                        {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat, maxime.</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</section>--}}
        <section id="boxes" class="py-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card text-center" style="border-color: darkblue"; >
                            <div class="card-body">
                                <h3 style="color: darkblue">1 <i class="fas fa-users"></i></h3>
                                <p style="color: darkblue">Community</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center text-white" style="background-color: darkblue">
                            <div class="card-body">
                                <h3>{{ \App\User::count() }} <i class="fas fa-user-alt"></i></h3>
                                <p>Users</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center" style="border-color: darkblue">
                            <div class="card-body">
                                <h3 style="color: darkblue">{{ \App\Job::count() }} <i class="fas fa-briefcase"></i></h3>
                                <p style="color: darkblue">Jobs</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center text-white" style="background-color: darkblue">
                            <div class="card-body">
                                <h3>{{ DB::table('jobs')->distinct('skills')->count('skills') }} <i class="fas fa-list-ul"></i></h3>
                                <p>Jobs Categories</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="about" class="py-4 text-center bg-light" style="color: darkblue">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="info-header mb-2">
                            <h1 class="pb-3" style="color: darkblue">
                                How does it works?
                            </h1>
                        </div>

                        <!-- ACCORDION -->
                        <div id="accordion" role="tablist">
                            <div class="card">
                                <div class="card-header" id="heading1">
                                    <h5 class="mb-0">
                                        <div href="#collapse1" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" class="collapsed">
                                            <i class="fa fa-arrow-circle-down"></i> Register
                                        </div>
                                    </h5>
                                </div>

                                <div id="collapse1" class="collapse" style="">
                                    <div class="card-body">
                                        If you are new , you will start by clicking on <strong>Register</strong> and provide the information need to login and use the website.
                                        You can add other necessary information later.
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="heading2">
                                    <h5 class="mb-0">
                                        <div href="#collapse2" data-toggle="collapse" data-parent="#accordion" class="collapsed" aria-expanded="false">
                                            <i class="fa fa-arrow-circle-down"></i> Post a Job
                                        </div>
                                    </h5>
                                </div>

                                <div id="collapse2" class="collapse">
                                    <div class="card-body">
                                    To post a job, you click on <strong>Post a Job</strong> on the navigation bar and then fill all needed description of your job
                                        Then post it.
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="heading3">
                                    <h5 class="mb-0">
                                        <div href="#collapse3" data-toggle="collapse" data-parent="#accordion" class="collapsed" aria-expanded="false">
                                            <i class="fa fa-arrow-circle-down"></i> Hire a Freelance
                                        </div>
                                    </h5>
                                </div>

                                <div id="collapse3" class="collapse">
                                    <div class="card-body">
                                    After post a job, User will be able to place their bids and you will be allowed to see them and accept or decline their bid.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        </div>
@endsection
