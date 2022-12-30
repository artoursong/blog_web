<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.css" rel="stylesheet"/>
    <title>Document</title>
</head>
<body>
    <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light header">
  <!-- Container wrapper -->
  <div style="max-width: 1140px" class="container">
    <!-- Navbar brand -->

    <!-- Toggle button -->
    <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarButtonsExample" aria-controls="navbarButtonsExample" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarButtonsExample">
      <!-- Left links -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="#">Blog</a>
        </li>
      </ul>
      <!-- Left links -->

      <div class="d-flex align-items-center">
        @if(Auth::check())
          @if(!is_null(Auth::user()->image_url))
            <a class="px-3 me-2" href="{{ URL::route('get_info_user', Auth::user()->id) }}">
              <img style="width: 30px; height: 30px; border-radius: 9999px" src="{{asset('images/'. Auth::user()->image_url)}}" alt="">
            </a>
          @else
            <a class="px-3 me-2" href="{{ URL::route('get_info_user', Auth::user()->id) }}">
              <span>{{Auth::user()->username}}</span>
            </a>
          @endif
          <a type="button" href="<?php echo route('log_out')?>" class="btn btn-primary me-3">
            Log out
          </a>
        @else
          <a type="button" href="<?php echo route('get.login')?>" class="btn btn-link px-3 me-2 login-button">
            Login
          </a>
          <a type="button" href="<?php echo route('get.sign_up')?>" class="btn btn-primary me-3">
            Sign up for free
          </a>
        @endif
      </div>
    </div>
    <!-- Collapsible wrapper -->
  </div>
  <!-- Container wrapper -->
</nav>  
<!-- Navbar -->
</body>
</html>