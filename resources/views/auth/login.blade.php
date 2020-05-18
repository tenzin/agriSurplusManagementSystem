<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>V-MIS</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset("/bower_components/admin-lte/plugins/fontawesome-free/css/all.min.css")}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset("/bower_components/admin-lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css")}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset("/bower_components/admin-lte/dist/css/adminlte.min.css")}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
  <img class="img-responsive" src="{{URL::asset('/images/rgoblogo.png')}}"style="height:80px;width:80px; "></img><br>
    <a href="../../index2.html"><b>Ministry of Agriculture and Forests</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to V-MIS</p>
      {{-- @include('flash-message') --}}
    <form method="POST" action="{{url('login')}}">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="input-group mb-3">
          <input type="text" class="form-control" value="{{ old('email') }}" required autofocus name="email" placeholder="Email ID"/>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" class="form-control login" name="password" required/>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" >Log In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>


      <!-- /.social-auth-links -->
      {{-- <p class="mb-1">
        <a href="{{ url('/password/reset') }}">Reset password</a>
      </p> --}}
     
    </div>
    <!-- /.login-card-body -->
  </div>
  <div class="col-4">
  <a href="{{ url('/') }}">BACK TO Home</a>         
   </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset("/bower_components/admin-lte/plugins/jquery/jquery.min.js")}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset("/bower_components/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<!-- AdminLTE App -->
<script src="{{asset("/bower_components/admin-lte/dist/js/adminlte.min.js")}}"></script>

</body>
</html>
