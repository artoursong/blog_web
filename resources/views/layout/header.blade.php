<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="{{asset('css/layout/header.css')}}" rel="stylesheet">

    <link href="{{ asset('bootstrap-5.2.3-dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.css" rel="stylesheet"/>
    <title>Document</title>
</head>
<body>
  <header class="p-3 bg-dark text-white">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="#" class="nav-link px-2 text-secondary">Home</a></li>
          <li><a href="#" class="nav-link px-2 text-white">Features</a></li>
          <li><a href="#" class="nav-link px-2 text-white">Pricing</a></li>
          <li><a href="#" class="nav-link px-2 text-white">FAQs</a></li>
          <li><a href="#" class="nav-link px-2 text-white">About</a></li>
        </ul>

        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
          <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
        </form>

        <div class="text-end">
          @if(Auth::check())
          <a class="px-3 me-2" href="{{ URL::route('get_info_user') }}">
            <img style="width: 30px; height: 30px; border-radius: 9999px" src="{{asset('images/'. Auth::user()->image_url)}}" alt="">
          </a>
          <a type="button" href="<?php echo route('log_out')?>" class="btn btn-outline-light me-2 btn-header">Log out</a>
          @else
          <a type="button" href="<?php echo route('get.login')?>"class="btn btn-outline-light me-2 btn-header">Login</a>
          <a type="button" href="<?php echo route('get.sign_up')?>" class="btn btn-warning btn-header">Sign up</a>
          @endif
        </div>
      </div>
    </div>
  </header>
</body>
</html>