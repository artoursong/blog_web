<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/profile/edit_profile.css') }}" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    @include('layout.header')
    <section>
        <div class="container py-5">
            <div class="col-lg-8 content-container">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
                @endif
                <form action="{{route('update_info_user', Auth::user()->id)}}" method="post" enctype="multipart/form-data" class="update-form">
                    @csrf
                    <div class="info-content">
                        <div class="input-label-group">
                            <label for="">Username</label>
                            <input name="username" type="text" value="{{$user->username}}">
                        </div>
                        <div class="input-label-group">
                            <label for="">Name</label>
                            <input name="name" type="text" value="{{$user->name}}">
                        </div>
                        <div class="input-label-group">
                            <label for="">Email</label>
                            <input name="email" type="text" value="{{$user->email}}">
                        </div>
                        <div class="form-outline form-white mb-4">
                            <label for="photo">Avatar</label>
                            <input type="file" name="image" id="image" accept="image/*" class="form-control-file">
                        </div>
                    </div>
                    <div class="info-footer">
                        <button type="submit">Change Profile</button>
                    </div>
                </form>
                
            </div>
        </div>
    </section>
    <script>
    </script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
</body>
</html>