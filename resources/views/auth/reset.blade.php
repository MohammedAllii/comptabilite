<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Meeting App
  </title>
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <link id="pagestyle" href="{{ asset('css/material-dashboard.css?v=3.1.0') }}" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
</head>
<body id="page-top" class="landing-page no-skin-config">

<body class="">
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-80">
        <div class="container">
          <div class="row">
            <div class="col-9 col-lg-6 d-flex h-100 my-auto position-absolute top-80 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-5 px-7 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url('{{ asset('Description.png') }}'); background-size: cover;">
              </div>
            </div>     
            
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
              <div class="card card-plain">
                <div class="card-header">
                  <h4 class="font-weight-bolder">Reset your password</h4>
                  <p class="mb-0">Reset your password</p>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('users.sendPasswordResetMail') }}">
                        @csrf
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Email</label>
                      <input id="email"  type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    </div>
                    @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                 </div>
                        
                    <div class="text-center">
                      <button type="submit" class="btn btn-lg btn-lg w-100 mt-4 mb-0" style="background-color: #5784BA;color:white">Send password</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

</body>
</body>
<script src="{{ asset('js/core/popper.min.js') }}"></script>
<script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"script>
<script src="{{ asset('js/plugins/chartjs.min.js') }}"></script>
<script src="{{ asset('js/material-dashboard.min.js?v=3.1.0') }}" ></script>
</html>