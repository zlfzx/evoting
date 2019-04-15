<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=$title;?> | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=base_url('./../assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css');?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url('./../assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css');?>">  
  <!-- Sweetalert -->
  <link rel="stylesheet" href="<?=base_url('./../assets/css/sweetalert2.min.js');?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url('./../assets/adminlte/dist/css/AdminLTE.min.css');?>">
  <style>
    .login-box{
      margin: 0;
    }
    .login-page{
      display: flex;
      align-items: center;
      justify-content: center;
    }
  </style>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href=""><?=$title;?></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="<?=base_url('Auth/actlogin');?>" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="username" class="form-control" placeholder="Username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-danger btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?=base_url('./../assets/adminlte/bower_components/jquery/dist/jquery.min.js');?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url('./../assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
<!-- Sweetalert -->
<script src="<?=base_url('./../assets/js/sweetalert2.all.min.js');?>"></script>
<?=($this->session->flashdata('gagal')) ? '<script>Swal.fire("Gagal!", "Username/Password salah", "error")</script>' : '' ?>
</body>
</html>
