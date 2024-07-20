<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login Admin - MTS NUR IMAN MLANGI</title>
  <link href="assets/img/logo-mts.png" rel="icon">
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/template/login/assets/css/login.css">
  <style>
    .brand-wrapper img,
    .brand-wrapper span {
      display: inline-block;
      vertical-align: middle;
      font-size: x-large;
      font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
      padding-left: 5px;
    }
  </style>
</head>

<body>
  <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
      <div class="card login-card">
        <div class="row no-gutters">
          <div class="col-md-5">
            <img src="{{ asset('assets/img/login 1.jpg') }}" alt="login" class="login-card-img logo">
          </div>
          <div class="col-md-7">
            <div class="card-body">
              <div class="brand-wrapper">
                <a href="https://mtsnuriman.sch.id/"><img src="{{ asset('assets/img/logo-mts.png') }}" alt="logo" class="logo"></a>
                <span>MTS NUR IMAN MLANGI BERPRESTASI</span>
              </div>
              <!-- <p class="login-card-description">Selamat Datang</p> -->
              <h4>Selamat Datang</h4>
              <p class="login-card-footer-text">Silahkan masuk sesuai dengan akun Anda</p>
              <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                  <label for="email" class="sr-only">email</label>
                  <input type="email" name="email" id="email" class="form-control" placeholder="email" required>
                </div>
                <div class="form-group mb-4">
                  <label for="password" class="sr-only">Password</label>
                  <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                </div>
                <input name="login" id="login" class="btn btn-block login-btn mb-4" type="submit" value="Login">
              </form>
              <nav class="login-card-footer-nav">
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>