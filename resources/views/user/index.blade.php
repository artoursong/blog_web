<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.css" rel="stylesheet" />
</head>
<body>
<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
      <div class="row d-flex align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card text-black">
            <div class="card-body">
              <div class="mb-md-5 mt-md-4 pb-5">
                <h2 class="fw-bold mb-2 text-uppercase">Info</h2>
                <form method="post" action="{{ route('update_info_user', $user->id) }}">
                    @csrf
                    <div class="form-outline form-black mb-4">
                        <input type="email" id="typeEmailX" name="email" class="form-control form-control-lg" value="{{$user->email}}" />
                        <label class="form-label" for="typeEmailX">Email</label>
                    </div>
                
                    <div class="form-outline form-black mb-4">
                        <input type="text" id="typeEmailX" name="username" class="form-control form-control-lg" value="{{$user->username}}"/>
                        <label class="form-label" for="typeEmailX">Username</label>
                    </div>

                    <div style="display: flex; justify-content: center">
                        <button class="btn btn-outline-dark btn-lg px-5" type="submit">Change Info</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"></script>
</body>
</html>