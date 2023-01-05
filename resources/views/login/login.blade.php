<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('bootstrap-5.2.3-dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login/index.css') }}" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    @include('layout.header')
    <main id="main" class="site-main main">
        <section class="section">
            <div class="container">
                <div class="row">
                    <div class="container container--mini"><img class="img-fluid mx-auto d-block mb-5" src="https://themes.getbootstrap.com/wp-content/themes/bootstrap-marketplace/assets/images/elements/bootstrap-logo.svg" alt="">
                        <form action="{{route('log_in')}}" method="post">
                            @csrf
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @elseif (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="user_login">Email</label>
                                <input type="text" name="email" id="user_login" class="form-control" value="" size="20">
                            </div>

                            <div class="form-group">
                                <label for="user_pass">Password</label>

                                <a class="form-sublink" href="https://themes.getbootstrap.com/my-account/lost-password/">Forgot password?</a>
                                <input type="password" name="password" id="user_pass" class="form-control" value="" size="20">
                            </div>

                            <div class="form-group mt-5">
                                <input type="submit" name="wp-submit" id="wp-submit" class="btn btn-brand btn-block mb-4 bg-primary text-white" value="Sign In">
                            </div>
                        </form>
                        <p class="small text-center text-gray-soft">Don't have an account yet? <a href="https://themes.getbootstrap.com/my-account/">Sign up</a></p>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>