<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/profile/index.css') }}" rel="stylesheet">
    <link href="{{ asset('css/reset.css') }}" rel="stylesheet">
    <title>Document</title>
</head>
<body>
  @include('layout.header')
  <section class="container">
    <div class="row py-4">
      <div class="col-12">
        <div class="d-flex justify-content-center">
          <div>
            @if(is_null(Auth::user()->image_url) || !file_exists( public_path().'/images/'.Auth::user()->image_url ))
            <a class="px-3 me-2" href="{{ URL::route('get_info_user') }}">
              <img class="user-image" src="{{asset('images/user.svg')}}" alt="">
            </a>
            @else
            <a class="px-3 me-2" href="{{ URL::route('get_info_user') }}">
              <img class="user-image" src="{{asset('images/'. Auth::user()->image_url)}}" alt="">
            </a>
            @endif
          </div>
        </div>
        <div class="text-center mt-4">
          <h1 class="greeting-title">Welcome</h1>
          <p class="greeting-sub-title">Manage your profile information and security with Blog Account</p>
        </div>
      </div>
    </div>
    <div class="row py-4">
      <div class="mb-2 col-sm-6 col-md-4">
        <a class="menu-item" href="{{ URL::route('profile_user', Auth::user()->id) }}">
          <div class="el-card card-item text-center is-hover-shadow">
            <div class="el-card__body">
              <img src="{{asset('images/user.svg')}}" alt="">
              <h2 class="card-title mt-4">My Profile</h2>
            </div>
          </div>
        </a>
      </div>
      <div class="mb-2 col-sm-6 col-md-4">
        <a class="menu-item" href="{{ URL::route('get_update_pass', Auth::user()->id) }}">
          <div class="el-card card-item text-center is-hover-shadow">
            <div class="el-card__body">
              <img src="{{asset('images/password.svg')}}" alt="">
              <h2 class="card-title mt-4">Change Password</h2>
            </div>
          </div>
        </a>
      </div>
      <div class="mb-2 col-sm-6 col-md-4">
        <a class="menu-item" href="{{ URL::route('blogsOfUser', Auth::user()->id)}}">
          <div class="el-card card-item text-center is-hover-shadow">
            <div class="el-card__body">
              <img src="{{asset('images/my_blog.png')}}" alt="">
              <h2 class="card-title mt-4">My Blogs</h2>
            </div>
          </div>
        </a>
      </div>
    </div>
  </section>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script>
    </script>
</body>
</html>