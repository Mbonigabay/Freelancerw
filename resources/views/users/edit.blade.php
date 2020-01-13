@extends('layouts.app')

@section('content')
    <section class="clearfix" style="width: 100%">
        <div class="container">
            <div class="row">
                <div class="sidem  col-md-9 col-lg-9 float-left" style="width: 75%;min-height: 800px">
                    @if(Auth::id() == $user->id)
                        <div class="card shadow border-0">

                            <div class="card-body" style="color: darkblue">

                                <h4>UPDATE YOUR INFORMATION</h4>
                                <form action="{{ action('usersController@upload')}}" method="post"
                                      enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group-group">
                                        <label for="user-name">Profile Picture: <span class="required"></span></label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input name="avatar" type="file"
                                                       class="custom-file-input form-control-file form-control-md"
                                                       id="inputGroupFile04"
                                                       size="60" aria-describedby="inputGroupFileAddon04">
                                                <label class="custom-file-label" for="inputGroupFile04">Choose
                                                    Image</label>
                                            </div>
                                            <div class="input-group-append">
                                                <button name="submit" class="btn btn-outline-secondary" type="submit"
                                                        id="inputGroupFileAddon04">Upload
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <form method="post" action="{{ action('usersController@update', $user->id)}}">
                                    {{ csrf_field() }}

                                    <input type="hidden" name="_method" value="post">

                                    <br>
                                    <fieldset>
                                        <legend>Personalia:</legend>
                                        <div class="form-group">
                                            <label for="user-name">User Name: <span class="required"></span></label>
                                            <input class="form-control " name="name" id="user-name"
                                                   value="{{ $user->name }}"
                                                   size="60" placeholder="Enter user name">
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <label for="user-email">User Email: </label>
                                                <input class="form-control " name="email" id="user-email"
                                                       value="{{ $user->email }}" placeholder="Enter user email">
                                            </div>
                                            <div class="col">
                                                <label for="user-email">User Phone Number: </label>
                                                <input class="form-control " name="telephone" id="user-telephone"
                                                       value="{{ $user->telephone }}"
                                                       placeholder="Enter user phone number">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="user-address">User Address: </label>
                                            <input class="form-control" name="address" id="user-address"
                                                   value="{{ $user->address }}" placeholder="Enter user address">
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <label for="user-email">User sex: </label>
                                                <select class="custom-select" name="sex" value="{{ $user->sex }}">
                                                    <option selected>{{ $user->sex }}</option>
                                                    <option value="None">None</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <label for="user-email">User Marital Status: </label>
                                                <select class="custom-select" name="maritalStatus"
                                                        value="{{ $user->maritalStatus }}">
                                                    <option selected>{{ $user->maritalStatus }}</option>
                                                    <option value="None">None</option>
                                                    <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
                                                </select>
                                            </div>
                                            <div class="dates">
                                                <label for="user-email">User Date Of Birth: </label>
                                                <input class="form-control" autocomplete="off" type="text" name="dob"
                                                       id="search" value="{{ $user->dob }}">
                                            </div>
                                        </div>
                                    </fieldset>
                                    <br>
                                    <fieldset>
                                        <legend>Profile</legend>
                                        <div class="form-group">
                                            <label for="user-description">User Description: </label>
                                            <textarea class="form-control " name="description" id="user-description"
                                                      placeholder="add more of your personal information " rows="5"
                                                      style="resize: vertical">{{ $user->description }}</textarea>
                                        </div>
                                    </fieldset>
                                    <br>
                                    <fieldset>
                                        <legend>Career Details</legend>
                                        <div class="form-row">
                                            <div class="col">
                                                <label for="user-email">Professional Headline: </label>
                                                <input class="form-control " name="areaOfExpertise"
                                                       id="user-areaOfexpertise"
                                                       value="{{ $user->areaOfExpertise }}"
                                                       placeholder="Enter your professional headline">
                                            </div>
                                            <div class="col">
                                                <label for="user-email">Rate of Payment: </label>
                                                <input class="form-control " name="rateOfPayment"
                                                       id="user-rateOfPayment"
                                                       value="{{ $user->rateOfPayment }}"
                                                       placeholder="Enter your rate of payment">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="user-description">User Education Background: </label>
                                            <textarea class="form-control " name="educationBackground"
                                                      id="user-description"
                                                      placeholder="ex. 2011-2014   Lycee de kigali   A'level " rows="5"
                                                      style="resize: vertical">{{ $user->educationBackground }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="user-description">User Work Experience: </label>
                                            <textarea class="form-control " name="workExperience" id="user-description"
                                                      placeholder="ex. 2014-2019   MTN   IT officer " rows="5"
                                                      style="resize: vertical">{{ $user->workExperience }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="user-description">User Skills: </label>
                                            <textarea class="form-control " name="skills" id="user-description"
                                                      placeholder="ex. skill1, skill2, ... " rows="5"
                                                      style="resize: vertical">{{ $user->skills }}</textarea>
                                        </div>
                                    </fieldset>
                                    <br>
                                    <button type="submit" class="btn btn-dark"
                                            onMouseOver="this.style.backgroundColor='darkblue'; this.style.color='white'"
                                            onMouseOut="this.style.backgroundColor='white'; this.style.color='darkblue'"
                                            class="btn"
                                            style="background-color: white; color: darkblue;border-radius: 1px; border-color: darkblue;">
                                        Submit
                                    </button>
                                </form>
                            </div>
                        </div>
                    @elseif(Auth::user()->role_id == 1)
                        <div class="card shadow border-0 mt-3">

                            <div class="card-body" style="color: darkblue">
                                <form method="post" action="{{ action('usersController@updateStatus', $user->id)}}">
                                    {{ csrf_field() }}

                                    <input type="hidden" name="_method" value="post">

                                    <fieldset>
                                        <legend>Account Status</legend>
                                        <div class="form-group">
                                            <label for="user-description">Status: </label>
                                            <select class="custom-select" name="status"
                                                    value="{{ $user->status }}">
                                                <option selected>{{ $user->status }}</option>
                                                <option value="active">Activate</option>
                                                <option value="blocked">Block</option>
                                            </select>
                                            <label for="user-description">Verification: </label>
                                            <select class="custom-select" name="verify"
                                                    value="{{ $user->verify }}">
                                                <option selected>{{ $user->verify }}</option>
                                                <option value="verified">Verified</option>
                                                <option value="not verified">Not Verified</option>
                                            </select>
                                            <label for="user-description">Role: </label>
                                            <select class="custom-select" name="role" value="{{ $user->role_id }}"
                                            >
                                                <option selected
                                                        value="{{$user->role_id}}">{{ $user->role->name }}</option>
                                                <option value="1">Admin</option>
                                                <option value="2">Moderator</option>
                                                <option value="3">End User</option>

                                            </select>
                                        </div>
                                        <label></label>
                                    </fieldset>
                                    <br>
                                    <button type="submit" class="btn btn-dark"
                                            onMouseOver="this.style.backgroundColor='darkblue'; this.style.color='white'"
                                            onMouseOut="this.style.backgroundColor='white'; this.style.color='darkblue'"
                                            class="btn"
                                            style="background-color: white; color: darkblue;border-radius: 1px; border-color: darkblue;">
                                        Submit
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>


                <div class="sideb col-md-3 col-lg-3 float-right" style="width: 25%;">
                    <div class="sidebar-module">
                        <div class="card shadow border-0" style="color: darkblue">
                            <div class="card-body">
                                <h4>ACTIONS</h4>
                                <ol class="list-unstyled">
                                    <li><a href="/users/{{$user->id}}" style="color: darkblue"><i
                                                    class="fas fa-user"></i>
                                            <div style="text-transform: uppercase; display: inline">{{$user->name}}</div>
                                            's Profile</a></li>
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