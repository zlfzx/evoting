<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=$title;?> | Administrator</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=base_url('./../assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css');?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url('./../assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css');?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?=base_url('./../assets/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');?>">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?=base_url('./../assets/adminlte/bower_components/select2/dist/css/select2.min.css')?>">
  <!-- bootstrap datetime picker -->
  <link rel="stylesheet" href="<?=base_url('./../assets/css/bootstrap-datetimepicker.min.css')?>">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?=base_url('./../assets/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css');?>">
  <!-- Pace style -->
  <link rel="stylesheet" href="<?=base_url('./../assets/adminlte/plugins/pace/pace.min.css');?>">
  <!-- Sweetalert -->
  <link rel="stylesheet" href="<?=base_url('./../assets/css/sweetalert2.min.js');?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url('./../assets/adminlte/dist/css/AdminLTE.min.css');?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?=base_url('./../assets/adminlte/dist/css/skins/_all-skins.min.css');?>">
  <link rel="stylesheet" href="<?=base_url('./../assets/css/admin.css');?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- jQuery 3 -->
  <script src="<?=base_url('./../assets/adminlte/bower_components/jquery/dist/jquery.min.js');?>"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?=base_url('./../assets/adminlte/bower_components/jquery-ui/jquery-ui.min.js');?>"></script>
  <!-- PACE -->
  <script src="<?=base_url('./../assets/adminlte/bower_components/PACE/pace.min.js');?>"></script>
  <!-- Sweetalert -->
  <script src="<?=base_url('./../assets/js/sweetalert2.all.min.js');?>"></script>
  <!-- Select2 -->
  <script src="<?=base_url('./../assets/adminlte/bower_components/select2/dist/js/select2.full.min.js')?>"></script>
  <!-- bootstrap datetime picker -->
  <script src="<?=base_url('./../assets/adminlte/bower_components/moment/min/moment.min.js');?>"></script>
  <script src="<?=base_url('./../assets/js/bootstrap-datetimepicker.min.js')?>"></script>
  <script>
    var base_url = '<?=base_url()?>';
  </script>
</head>
<body class="hold-transition fixed skin-purple sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <?php require_once('_topmenu.php');?>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <?php require_once('_sidebar.php');?>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$title;?>
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url();?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?=$title;?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">