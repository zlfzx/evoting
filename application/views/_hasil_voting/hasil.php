<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=$title;?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=base_url('assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css');?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url('assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css');?>">
  <!-- Pace style -->
  <link rel="stylesheet" href="<?=base_url('assets/adminlte/plugins/pace/pace.min.css');?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url('assets/adminlte/dist/css/AdminLTE.min.css');?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?=base_url('assets/adminlte/dist/css/skins/_all-skins.min.css');?>">
  <link rel="stylesheet" href="<?=base_url('assets/css/admin.css');?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-purple layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="" class="navbar-brand">E-<b>Voting</b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li><a><?=strftime('%A, %d %B %Y')?> - <span class="live-clock"><?=date('H:i:s');?></span></a></li>
            <!-- <li class="dropdown"> 
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="hidden-xs">Alexander Pierce</span>
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li><a href="#">Logout</a></li>
              </ul>
            </li> -->
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Hasil Voting
        </h1>
        <ol class="breadcrumb">
          <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Hasil Voting</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <?php if (empty($voting)): ?>
        <div class="col-sm-12">
          <div class="box box-danger box-solid">
            <div class="box-header"></div>
            <div class="box-body">
              <h2 class="text-center"><i class="fa fa-warning"></i></h2>
              <h2 class="text-center">Tidak Ada Data !</h2>
            </div>
          </div>
        </div>
        <?php else: ?>
        <div class="col-sm-12">
          <h2 class="text-center"><?=$voting->nama_voting?></h2>
          <hr>
          <div class="tengah justify-content-arround">
          <?php foreach ($kandidat as $k): ?>
          <div class="col-sm-4">
            <div class="box box-danger box-solid">
              <div class="box-header"></div>
              <div class="box-body box-profile">
                <img src="<?=base_url('assets/img/kandidat/'.$k->foto);?>" class="profile-user-img img-responsive img-kandidat img-circle">
                <h3 class="profile-username text-center"><?=$k->nama_kandidat?></h3>
                <p class="text-muted text-center"><?=$k->keterangan?></p>
                <h3 class="text-center"><span class="label label-danger">Poin : <?=$k->poin?></span></h3>
              </div>
            </div>
          </div>
          <?php endforeach ?>
          </div>
        </div>
        <?php endif ?>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> 1.0
      </div>
      <strong>Copyright &copy; <?=Date('Y')?> <a href="https://www.facebook.com/zulfi.izzulhaq" target="_blank">Muhammad Zulfi Izzulhaq</a>.</strong> All rights
      reserved.
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?=base_url('assets/adminlte/bower_components/jquery/dist/jquery.min.js');?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url('assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
<!-- FastClick -->
<script src="<?=base_url('assets/adminlte/bower_components/fastclick/lib/fastclick.js');?>"></script>
<!-- PACE -->
<script src="<?=base_url('assets/adminlte/bower_components/PACE/pace.min.js');?>"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('assets/adminlte/dist/js/adminlte.min.js');?>"></script>
<script>
  $(document).ready(function(){
    setInterval(function(){
      var date = new Date();
      var h = date.getHours(), m = date.getMinutes(), s= date.getSeconds();
      h = ('0' + h).slice(-2);
      m = ('0' + m).slice(-2);
      s = ('0' + s).slice(-2);

      var time = h+':'+m+':'+s;
      $('.live-clock').html(time);
    }, 1000);
    setInterval(function(){
      window.location.reload();
    }, 180000)
  })
</script>
</body>
</html>
