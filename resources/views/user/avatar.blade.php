<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/profile/avatar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/reset.css') }}" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <section class="avatar-page">
        <div class="avatar-page-header">
            <span>AVATAR</span>
        </div>
        <div class="avatar-page-content">
            <div class="content-right">
                <div class="avatar-container avatar-border">
                    <img src="{{asset('images/'.$user_avatar)}}" alt="">
                </div>
                <div class="avatar-container-medium avatar-border">
                    <img src="{{asset('images/'.$user_avatar)}}" alt="">
                </div>
                <div class="avatar-container-small avatar-border">
                    <img src="{{asset('images/'.$user_avatar)}}" alt="">
                </div>
            </div>
            <div class="content-left">
                <div class="avatar-change">
                    <label for="photo">Attach a photograph</label>
                    <input type="file" name="photo" id="photo" accept="image/*" class="form-control-file">
                </div>
            </div>
        </div>
    </section>
</body>
</html>