<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>

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

<h1 style="font-family: 'Trajan Pro'">Cirruculum Vitae</h1>
<fieldset>
    <legend>Personalia</legend>
    <b>Names:</b> {{$user->name}}<br>
    <b>Sex:</b> {{$user->sex}} <br>
    <b>Marital Status:</b> {{$user->maritalStatus}} <br>
    <b>Date of Birth:</b> {{$user->dob}} <br>
    <b>Address:</b> {{$user->address}} <br>
    <b>Email:</b> {{$user->email}} <br>
    <b>Telephone no:</b> {{$user->telephone}}
</fieldset>
<fieldset>
    <legend>Profile</legend>
    <p >{{$user->description}}</p>
</fieldset>
<fieldset>
    <legend>Career Details</legend>
    <b>Professional Title:</b>{{ $user->areaOfExpertise }}<br>
    <b>Skills :</b>{{ $user->skills }}<br><br>
    <b>Educational Background</b><br>
    {{$user->educationBackground}} <br>
    <b>Work Experience</b><br>
    <p>{{$user->workExperience}}</p>
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