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

<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url('assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
<!-- FastClick -->
<script src="<?=base_url('assets/adminlte/bower_components/fastclick/lib/fastclick.js');?>"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('assets/adminlte/dist/js/adminlte.min.js');?>"></script>
<?=($this->session->flashdata('login_gagal')) ? '<script>Swal.fire("Gagal", "Username/Password salah !", "error")</script>' : '' ?>
<?=($this->session->flashdata('novoting')) ? '<script>Swal.fire("Gagal", "Tidak ada voting !", "error")</script>' : '' ?>
</body>
</html>
