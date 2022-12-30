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
    <div class="profile-header">
      <div class="avatar-container">
        <img src="" alt="">
      </div>
      <span class="profile_header_name">
        <a>Dendaman</a>
      </span>
    </div>
    <div class="profile-content">
      <div class="profile-field">
        <a index="1" href="">Information</a>
        <a index="2" href="">Avatar</a>
        <a index="3" href="">Blogs</a>
        <a index="4" href="">Change Password</a>
      </div>
      <div class="field-information">
      </div>
    </div>
  </section>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script>
      window.userID = {{ auth()->id() }};
    </script>
    <script type="text/javascript" src="{{asset('js/user-page.js')}}"></script>
</body>
</html>