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
<section class="vh-100 gradient-custom">
  <div class="container py-3 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">
            <div class="mb-md-5 mt-md-4 pb-5">
              <h2 class="fw-bold mb-2 text-uppercase">Sign up</h2>
              <p class="text-white-50 mb-5">Please enter your information!</p>
              <form  method="post" action="{{route('sign_up')}}" enctype="multipart/form-data">
              @csrf
              <div class="form-outline form-white mb-4">
                <input type="text" id="typeEmailX" name="name" class="form-control form-control-lg"/>
                <label class="form-label" for="typeEmailX" name="name">Name</label>
              </div>

              <div class="form-outline form-white mb-4">
                <input type="email" id="typeEmailX" name="email" class="form-control form-control-lg" />
                <label class="form-label" for="typeEmailX" name="email">Email</label>
              </div>
            
              <div class="form-outline form-white mb-4">
                <input type="text" id="typeEmailX" name="username" class="form-control form-control-lg"/>
                <label class="form-label" for="typeEmailX" name="username">User Name</label>
              </div>

              <div class="form-outline form-white mb-4">
                <input type="password" id="typePasswordX" name="password" class="form-control form-control-lg"/>
                <label class="form-label" for="typePasswordX" name="password">Password</label>
              </div>

              <div class="form-outline form-white mb-4">
                <input type="password" id="typePasswordX" name="comfirm_password" class="form-control form-control-lg"/>
                <label class="form-label" for="typePasswordX" name="comfirm_password">Comfirm Password</label>
              </div>

              <div class="form-outline form-white mb-4">
                <label for="photo">Attach a photograph</label>
                <input type="file" name="photo" id="photo" accept="image/*" class="form-control-file">
              </div>
              <button class="btn btn-outline-light btn-lg px-5" type="submit">SIGN UP</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</section>
<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"></script>
</body>
</html>