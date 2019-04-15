	<div class="row">
		<div class="col-sm-6">
			<div class="box box-danger box-solid">
				<div class="box-header">
					<h4 class="box-title">Edit Profil</h4>
				</div>
				<div class="box-body">
					<form action="<?=base_url('admin/ganti_user_admin/'.$this->session->id)?>" method="POST">
						<div class="form-group">
							<label for="Nama">Nama :</label>
							<input type="text" name="nama" value="<?=$this->session->nama;?>" class="form-control" placeholder="Masukkan Nama Administrator" required>
						</div>
						<div class="form-group">
							<label for="Username">Username :</label>
							<input type="text" name="username" value="<?=$this->session->username;?>" class="form-control" placeholder="Masukkan Username Administrator" required>
						</div>
						<button class="btn btn-flat btn-danger btn-sm">Simpan</button>
					</form>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="box box-danger box-solid">
				<div class="box-header">
					<h4 class="box-title">Ganti Password</h4>
				</div>
				<div class="box-body">
					<?php if($passdefault): ?>
					<p class="text-danger text-center">Password belum diganti !</p>
					<?php endif?>
					<form action="<?=base_url('admin/ganti_pass_admin/'.$this->session->id)?>" method="POST">
						<div class="form-group">
							<label for="PasswordLama">Password Lama :</label>
							<input type="password" name="passwdlama" class="form-control" placeholder="Masukkan Password Lama" required>
						</div>
						<div class="form-group">
							<label for="PasswordBaru">Password Baru :</label>
							<input type="password" name="passwdbaru" class="form-control" placeholder="Masukkan Password Baru" required>
						</div>
						<button class="btn btn-flat btn-danger btn-sm">Simpan</button>
					</form>
				</div>
			</div>
		</div>
		<div class="col-sm-12">
			<div class="box box-danger box-solid">
				<div class="box-header with-border">
					<h4 class="box-title"><i class="fa fa-lock"></i> Administrator</h4>
				</div>
				<div class="box-body">
					<button class="btn btn-success btn-sm btn-flat tambah"><i class="fa fa-plus"></i> Tambah Admin</button>
					<hr>
					<table class="table table-striped table-hover table-bordered">
						<thead>
							<tr>
								<th>No.</th>
								<th>Nama</th>
								<th>Username</th>
								<th>Reset</th>
								<th>Last Login</th>
								<th>#</th>
							</tr>
						</thead>
						<tbody id="data-admin">
							<!-- Data Admin -->
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-sm-12">
			<div class="box box-danger box-solid">
				<div class="box-header">
					<h4 class="box-title"><i class="fa fa-warning"></i> Reset Aplikasi</h4>
				</div>
				<div class="box-body">
					<p>*Mereset aplikasi akan menghapus semua data kecuali data Administrator</p>
					<button class="btn btn-danger btn-flat btn-reset">RESET</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal tambah admin -->
	<div class="modal fade" id="tambah">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"><i class="fa fa-lock"></i> Tambah Administrator</h4>
				</div>
				<div class="modal-body">
					<form id="formTambah">
						<div class="form-group">
							<label for="Nama">Nama :</label>
							<input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Administrator">
						</div>
						<div class="form-group">
							<label for="Username">Username :</label>
							<input type="text" name="username" class="form-control" placeholder="Masukkan Username Administrator">
						</div>
						<button class="btn btn-flat btn-success">Tambah</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal edit admin -->
	<div class="modal fade" id="edit">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><i class="fa fa-edit"></i> Edit Admin</h4>
				</div>
				<div class="modal-body">
					<form id="formEdit">
						<input type="hidden" name="id_admin">
						<div class="form-group">
							<label for="Nama">Nama :</label>
							<input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Administrator">
						</div>
						<div class="form-group">
							<label for="Username">Username :</label>
							<input type="text" name="username" class="form-control" placeholder="Masukkan Username Administrator">
						</div>
						<button class="btn btn-flat btn-success">Simpan</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script>
		$(document).ajaxStart(function(){
			Pace.restart();
		})
		function dataAdmin(){
			$.ajax({
				url: base_url+'admin/data_admin',
				dataType: 'json',
				success: function(data){
					var html = '';
					var i;
					for (var i = 0; i < data.length; i++) {
						html += '<tr>'+
									'<td>'+(i+1)+'.</td>'+
									'<td>'+data[i].nama+'</td>'+
									'<td>'+data[i].username+'</td>'+
									'<td><button class="btn reset-pass btn-xs btn-flat btn-warning" data="'+data[i].id_admin+'"><i class="fa fa-refresh"></i> Reset Password</button></td>'+
									'<td>'+data[i].last_login+'</td>'+
									'<td><button class="btn btn-xs btn-flat btn-success edit" data="'+data[i].id_admin+'"><i class="fa fa-edit"></i> Edit</button>&nbsp;&nbsp;<button class="btn btn-xs btn-flat btn-danger hapus" data="'+data[i].id_admin+'"><i class="fa fa-trash"></i> Hapus</button></td>'+
								'</tr>';
					}
					$('#data-admin').html(html);
				}
			})
		}
		dataAdmin();
		$('.tambah').on('click', function(){
			$('#tambah').modal('show');
		});
		$('#formTambah').on('submit', function(e){
			e.preventDefault();
			var form = $(this);
			var nama = $('[name="nama"]').val(), username = $('[name="username"]').val();
			if (nama == '' || username == '') {
				return false;
			}
			else{
				$.ajax({
					type: 'POST',
					url: base_url+'admin/tambah_admin',
					data: form.serialize(),
					success: function(data){
						form.trigger('reset');
						$('#tambah').modal('hide');
						dataAdmin();
					}
				})
				return false;
			}
		})
		//Reset Password
		$('#data-admin').on('click', '.reset-pass', function(e){
			e.preventDefault();
			var id = $(this).attr('data');
			var k = confirm('Password akan direset ?');
			if (k) {
				$.ajax({
					url: base_url+'admin/reset_pass_admin/'+id,
					success: function(data){
						Swal.fire('Berhasil', 'Password berhasil direset', 'success');
					}
				})
				return false;
			}
		})
		//Edit Admin
		$('#data-admin').on('click', '.edit', function(){
			var id = $(this).attr('data');
			$.ajax({
				type: 'GET', 
				url: base_url+'admin/get_admin/'+id,
				dataType: 'json',
				success: function(data){
					$('#edit').modal('show');
					$('[name="id_admin"]').val(data.id_admin);
					$('[name="nama"]').val(data.nama);
					$('[name="username"]').val(data.username);
				}
			})
			return false;
		})
		//Aksi edit
		$('#formEdit').on('submit', function(e){
			e.preventDefault()
			var id = $('[name="id_admin"]').val();
			$.ajax({
				type: 'POST',
				url: base_url+'admin/edit_admin/'+id,
				data: $('#formEdit').serialize(),
				success: function(data){
					$('#formEdit').trigger('reset');
					$('#edit').modal('hide');
					dataAdmin();
				}
			})
			return false;
		})
		//Hapus Admin
		$('#data-admin').on('click', '.hapus', function(){
			var id = $(this).attr('data');
			var k = confirm('Administrator akan dihapus ?');
			if (k) {
				$.ajax({
					url: base_url+'admin/hapus_admin/'+id,
					success: function(){
						Swal.fire('Berhasil', 'Administrator berhasil dihapus', 'success');
						dataAdmin();
					}
				})
			}
		})
		//Reset aplikasi
		$('.btn-reset').on('click', function(e){
			e.preventDefault();
			Swal.fire({
				type: 'question',
				title: 'Reset Aplikasi?',
				text: 'Anda yakin akan mereset aplikasi? Semua data akan terhapus kecuali login Administrator',
				showCancelButton: true,
				confirmButtonText: 'RESET'
			}).then((result) => {
				if (result.value) {
					window.location.assign('<?=base_url("admin/reset")?>');
				}
			})
		})
	</script>

	<?=($this->session->flashdata('ganti_user')) ? '<script>Swal.fire("Berhasil", "Nama/Username berhasil diubah", "success")</script>' : ''?>
	<?=($this->session->flashdata('ganti_pass')) ? '<script>Swal.fire("Berhasil", "Password berhasil diubah", "success")</script>' : ''?>
	<?=($this->session->flashdata('error_pass')) ? '<script>Swal.fire("Gagal", "Password lama salah !", "error")</script>' : ''?>