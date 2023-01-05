<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('bootstrap-5.2.3-dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sign_up/index.css') }}" rel="stylesheet">

    <title>Document</title>
</head>

<body>
    @include('layout.header')
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="container container--xs">
                    <div class="woocommerce">
                        <div id="signup_div_wrapper">
                            <img class="img-fluid mx-auto d-block mb-3" src="https://themes.getbootstrap.com/wp-content/themes/bootstrap-marketplace/assets/images/elements/bootstrap-logo.svg" alt="">
                            <h1 class="mb-1 text-center">Sign up</h1>
                            <p class="fs-14 text-gray text-center mb-5">Redownload themes, get support, and review themes.</p>

                            <form action="{{route('sign_up')}}" method="post" class="register">
								@csrf
								@if (session('status'))
									<div class="alert alert-danger" role="alert">
										{{ session('status') }}
									</div>
                                @endif
                                <p class="woocommerce-FormRow woocommerce-FormRow--first form-row form-row-first">
                                    <label for="reg_sr_firstname">Username<span class="required text-danger">*</span></label>
                                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" required />
                                </p>

                                <p class="woocommerce-FormRow woocommerce-FormRow--last form-row form-row-last">
                                    <label for="reg_sr_lastname">Name<span class="required text-danger">*</span></label>
                                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="name" required />
                                </p>

                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                    <label for="reg_email">Email address <span class="required text-danger">*</span></label>
                                    <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email"/>
                                </p>

                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                    <label for="reg_password">Password <span class="required text-danger">*</span></label>
                                    <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password"/>
                                </p>
								<div class="form-group mt-5">
                                	<input type="submit" name="wp-submit" id="wp-submit" class="btn btn-brand btn-block mb-4 bg-primary text-white p-3" value="Sign In">
                            	</div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>