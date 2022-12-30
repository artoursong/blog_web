<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/profile/information.css') }}" rel="stylesheet">
    <link href="{{ asset('css/reset.css') }}" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <section class="information-page">
        <div class="info-header">
            <span>INFORMATION</span>
        </div>
        <form>
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
            </div>
        </form>
        <div class="info-footer">
            <button type="submit">Change Info</button>
        </div>
    </section>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script type="text/javascript" src="{{asset('js/user-info-page.js')}}"></script>
</body>
</html>