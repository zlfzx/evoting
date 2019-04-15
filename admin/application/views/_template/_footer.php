    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; <?=Date('Y')?> <a href="https://www.facebook.com/zulfi.izzulhaq" target="_blank">Muhammad Zulfi Izzulhaq</a>.</strong> All rights
    reserved.
  </footer>

</div>
<!-- ./wrapper -->

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url('./../assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?=base_url('./../assets/adminlte/bower_components/jquery-knob/dist/jquery.knob.min.js');?>"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?=base_url('./../assets/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js');?>"></script>
<!-- DataTables -->
<script src="<?=base_url('./../assets/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js');?>"></script>
<script src="<?=base_url('./../assets/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');?>"></script>
<!-- FastClick -->
<script src="<?=base_url('./../assets/adminlte/bower_components/fastclick/lib/fastclick.js');?>"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('./../assets/adminlte/dist/js/adminlte.min.js');?>"></script>
<script>
  $(function(){
    $('.dt').DataTable()
  })
</script>
</body>
</html>
