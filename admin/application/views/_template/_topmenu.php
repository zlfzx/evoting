<!-- Logo -->
    <a href="<?=base_url();?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>E</b>VT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">E-<b>Voting</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?=base_url('./../assets/adminlte/dist/img/user.png');?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?=$this->session->nama;?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?=base_url('./../assets/adminlte/dist/img/user.png');?>" class="img-circle" alt="User Image">

                <p>
                  <?=$this->session->nama;?>
                  <small>Terakhir Login : <?=$this->session->last_login;?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <!-- <div class="pull-left">
                  <a href="#" class="btn btn-warning btn-flat"><i class="fa fa-gear"></i> Profile</a>
                </div> -->
                <div class="pull-right">
                  <a href="<?=base_url('logout');?>" class="btn btn-danger btn-flat"><i class="fa fa-sign-out"></i> Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>