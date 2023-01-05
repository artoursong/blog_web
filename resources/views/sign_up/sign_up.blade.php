<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="{{ asset('bootstrap-5.2.3-dist/css/bootstrap.min.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('css/login/index.css') }}" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.css" rel="stylesheet"/>
    
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

    
    <form method="post" class="register">

        		<p class="woocommerce-FormRow woocommerce-FormRow--first form-row form-row-first">
			<label for="reg_sr_firstname">First Name <span class="required">*</span></label>
			<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="sr_firstname" id="reg_sr_firstname" value=""  required/>
		</p>

		<p class="woocommerce-FormRow woocommerce-FormRow--last form-row form-row-last">
			<label for="reg_sr_lastname">Last Name <span class="required">*</span></label>
			<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="sr_lastname" id="reg_sr_lastname" value=""  required />
		</p>
		
        
        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <label for="reg_email">Email address <span class="required">*</span></label>
            <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" value="" />
        </p>

        
            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <label for="reg_password">Password <span class="required">*</span></label>
                <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" />
            </p>

        
        <!-- Spam Trap -->
        <div style="left: -999em; position: absolute;"><label for="trap">Anti-spam</label><input type="text" name="email_2" id="trap" tabindex="-1" autocomplete="off" /></div>

        
<div class="show_if_seller" style="display:none">

    <div class="split-row form-row-wide">
        <p class="form-row form-group">
            <label for="first-name">First Name <span class="required">*</span></label>
            <input type="text" class="input-text form-control" name="fname" id="first-name" value="" required="required" />
        </p>

        <p class="form-row form-group">
            <label for="last-name">Last Name <span class="required">*</span></label>
            <input type="text" class="input-text form-control" name="lname" id="last-name" value="" required="required" />
        </p>
    </div>

    <p class="form-row form-group form-row-wide">
        <label for="company-name">Shop Name <span class="required">*</span></label>
        <input type="text" class="input-text form-control" name="shopname" id="company-name" value="" required="required" />
    </p>

    <p class="form-row form-group form-row-wide">
        <label for="seller-url" class="pull-left">Shop URL <span class="required">*</span></label>
        <strong id="url-alart-mgs" class="pull-right"></strong>
        <input type="text" class="input-text form-control" name="shopurl" id="seller-url" value="" required="required" />
        <small>https://themes.getbootstrap.com/store/<strong id="url-alart"></strong></small>
    </p>

    <p class="form-row form-group form-row-wide">
        <label for="shop-phone">Phone Number<span class="required">*</span></label>
        <input type="text" class="input-text form-control" name="phone" id="shop-phone" value="" required="required" />
    </p>

    </div>

<p class="form-row form-row-wide mailchimp-newsletter"><input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="mailchimp_woocommerce_newsletter" type="checkbox" name="mailchimp_woocommerce_newsletter" value="1" checked="checked"> <label for="mailchimp_woocommerce_newsletter" class="woocommerce-form__label woocommerce-form__label-for-checkbox inline"><span>Subscribe for Sales &amp; New Themes</span></label></p><div class="clear"></div><div class="woocommerce-privacy-policy-text"></div>
        <p class="woocomerce-FormRow form-row">
            <input type="hidden" id="woocommerce-register-nonce" name="woocommerce-register-nonce" value="46fd149442" /><input type="hidden" name="_wp_http_referer" value="/my-account/" />            <input type="submit" class="btn btn-brand btn-block btn-lg mb-4 mt-3" style="margin:0;" name="register" value="Sign Up" />
        </p>

        
    </form>

    <p class="text-gray-soft text-center small mb-2">By clicking "Sign up" you agree to our <a href="https://themes.getbootstrap.com/terms">Terms of Service</a>.</p>
    <p class="text-gray-soft text-center small mb-2">Already have an account? <a href="https://themes.getbootstrap.com/signin/">Sign in</a></p>
    <p class="text-gray-soft text-center small">Trying to sign up to sell themes? <a href="https://themes.getbootstrap.com/sell/">Apply to be a seller.</a></p>

</div>
</div>
    </div>
                </div>
        </div>
        </section>
</body>
</html>