<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/profile/information.css') }}" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    @include('layout.header')
    <section>
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            @if(is_null(Auth::user()->image_url) || !file_exists( public_path().'/images/'.Auth::user()->image_url ))
                            <a class="px-3 me-2" href="{{ URL::route('get_info_user') }}">
                                <img style="width: 150px; height: 150px; border-radius:9999px" src="{{asset('images/user.svg')}}" alt="">
                            </a>
                            @else
                            <a class="px-3 me-2" href="{{ URL::route('get_info_user') }}">
                                <img style="width: 150px; height: 150px; border-radius:9999px" src="{{asset('images/'. Auth::user()->image_url)}}" alt="">
                            </a>
                            @endif
                            <h5 class="my-3">{{$user->username}}</h5>
                            <p class="text-muted mb-1">Full Stack Developer</p>
                            <p class="text-muted mb-4">Bay Area, San Francisco, CA</p>
                            <div class="d-flex justify-content-center mb-2">
                                <a type="button" class="btn btn-primary" href="{{ URL::route('get_edit_profile', Auth::user()->id) }}">Edit Profile</a>
                                <button type="button" class="btn btn-outline-primary ms-1">Change Pass</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                    <div class="card-body card-profile">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Username</p>
                            </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{$user->username}}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Email</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{$user->email}}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Name</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{$user->name}}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Mobile</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">(098) 765-4321</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Address</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">Bay Area, San Francisco, CA</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>