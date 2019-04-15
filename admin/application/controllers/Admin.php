<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct(){
		parent::__construct();
		if (!$this->session->login) {
			redirect('login');
		}
		$this->load->model('m_admin');
	}

	private function header($data){
		$data['jmlkandidat'] = $this->m_admin->lihat('kandidat')->num_rows();
		$data['jmlpemilih'] = $this->m_admin->lihat('pemilih')->num_rows();
		$cpass = $this->db->query('SELECT password FROM admin WHERE id_admin='.$this->session->id)->row();
		if ($cpass->password == md5($this->session->username)) {
			$data['passdefault'] = TRUE;
		}
		else{
			$data['passdefault'] = FALSE;
		}
		$this->load->view('_template/_header', $data);
	}

	public function index(){
		$data['title'] = 'E-Voting';

		$this->header($data);
		$this->load->view('main');
		$this->load->view('_template/_footer');
	}

	public function voting(){
		$data['title'] = 'Voting';
		$data['listkandidat'] = $this->db->query('SELECT id_kandidat, nama_kandidat FROM kandidat')->result();
		$data['cekvoting'] = $this->m_admin->lihat('voting')->num_rows();
		if ($data['cekvoting'] > 0) {
			$data['voting'] = $this->m_admin->lihat('voting')->row();
			$data['kandidat'] = $this->db->query('SELECT kandidat.*, ikut_kandidat.id_voting, ikut_kandidat.poin FROM ikut_kandidat INNER JOIN kandidat ON ikut_kandidat.id_voting='.$data['voting']->id_voting.' WHERE kandidat.id_kandidat=ikut_kandidat.id_kandidat')->result();
			$data['sudah_memilih'] = $this->db->query('SELECT pemilih.id_pemilih, pemilih.nama, ikut_voting.waktu FROM pemilih JOIN ikut_voting ON pemilih.id_pemilih=ikut_voting.id_pemilih JOIN voting ON ikut_voting.id_voting=voting.id_voting WHERE pemilih.id_pemilih IN (SELECT ikut_voting.id_pemilih FROM ikut_voting)')->result();
			$data['belum_memilih'] = $this->db->query('SELECT id_pemilih, nama FROM pemilih WHERE id_pemilih NOT IN (SELECT id_pemilih FROM ikut_voting)')->result();
		}

		$this->header($data);
		$this->load->view('voting');
		$this->load->view('_template/_footer');
	}
	function tambah_voting(){
		$voting = $this->input->post('voting');
		$kandidat = $this->input->post('kandidat[]');
		$data = ['nama_voting' => $voting];
		$this->m_admin->tambah('voting', $data);
		$id_voting = $this->db->insert_id();

		foreach ($kandidat as $k) {
			$ikut_kandidat = ['id_voting' => $id_voting, 'id_kandidat' => $k];
			$this->m_admin->tambah('ikut_kandidat', $ikut_kandidat);
		}

		$this->session->set_flashdata('tambah', 'Voting baru telah ditambahkan');
		redirect($this->agent->referrer());
	}
	function edit_voting($id){
		$voting = $this->input->post('voting');
		$data = ['nama_voting' => $voting];
		$this->m_admin->ubah(['id_voting' => $id], 'voting', $data);
		$this->session->set_flashdata('ubah', 'Perubahan berhasil disimpan');
		redirect($this->agent->referrer());
	}
	function hapus_voting($id){
		$this->db->where(['id_voting' => $id]);
		$this->db->delete('voting');
		redirect('voting');
	}

	public function kandidat(){
		$data['title'] = 'Kandidat';
		//$data['kandidat'] = $this->m_admin->lihat('kandidat')->result();
		$data['kandidat'] = $this->db->query('SELECT *, kandidat.id_kandidat as id FROM kandidat LEFT JOIN ikut_kandidat ON ikut_kandidat.id_kandidat=kandidat.id_kandidat')->result();

		$this->header($data);
		$this->load->view('kandidat');
		$this->load->view('_template/_footer');
	}
	function data_kandidat(){
		$data = $this->m_admin->lihat('kandidat')->result();
		echo json_encode($data);
	}
	function get_kandidat($id){
		$d = $this->db->query('SELECT * FROM kandidat WHERE id_kandidat='.$id)->row();
		echo json_encode($d);
	}
	function tambah_kandidat(){
		$nama = $this->input->post('nama');
		$ket = $this->input->post('ket');
		$foto = $_FILES['foto'];

		$config['upload_path'] = './../assets/img/kandidat';
		$config['allowed_types'] = 'jpg|png|gif';
		$config['remove_spaces'] = TRUE;
		$this->load->library('upload', $config);
		if (!empty($foto['name'])) {
			if (!$this->upload->do_upload('foto')) {
				$data['error'] = $this->upload->display_errors();
				$this->session->set_flashdata('error', $data['error']);
				redirect('kandidat');
			}
			else{
				$data = [
					'nama_kandidat' => $nama,
					'keterangan' => $ket,
					'foto' => $this->upload->data('file_name')
				];
				$this->m_admin->tambah('kandidat', $data);
				$this->session->set_flashdata('tambah', 'kandidat berhasil ditambahkan');
				redirect('kandidat');
			}
		}
		else{
			$this->session->set_flashdata('error', 'Foto belum dipilih');
			redirect('kandidat');
		}

	}
	function edit_kandidat(){
		$id = $this->input->post('id_kandidat');
		$nama = $this->input->post('nama');
		$ket = $this->input->post('ket');
		$foto = $_FILES['foto'];

		if (empty($foto['name'])) {
			$data = ['nama_kandidat' => $nama, 'keterangan' => $ket];
			$this->m_admin->ubah(['id_kandidat' => $id], 'kandidat', $data);
			$this->session->set_flashdata('edit', 'Data berhasil diubah');
			redirect($this->agent->referrer());
		}
		else{
			$config['upload_path'] = './../assets/img/kandidat';
			$config['allowed_types'] = 'jpg|png|gif';
			$config['remove_spaces'] = TRUE;
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('foto')) {
				$data['error'] = $this->upload->display_errors();
				$this->session->set_flashdata('error', 'Periksa file foto!');
				redirect($this->agent->referrer());
			}
			else{
				$f = $this->db->query('SELECT foto FROM kandidat WHERE id_kandidat='.$id)->row();
				unlink('./../assets/img/kandidat/'.$f->foto);
				$data = [
					'nama_kandidat' => $nama,
					'keterangan' => $ket,
					'foto' => $this->upload->data('file_name')
				];
				$this->m_admin->ubah(['id_kandidat' => $id], 'kandidat', $data);
				$this->session->set_flashdata('edit', 'Data berhasil diubah');
				redirect($this->agent->referrer());
			}
		}
	}
	function hapus_kandidat($id){
		$d = $this->db->query('SELECT foto FROM kandidat WHERE id_kandidat='.$id)->row();
		unlink('./../assets/img/kandidat/'.$d->foto);
		$this->m_admin->hapus(['id_kandidat' => $id], 'kandidat');
		$this->session->set_flashdata('hapus', 'Kandidat berhasil dihapus');
		redirect($this->agent->referrer());
	}

	public function pemilih(){
		$data['title'] = 'Daftar Pemilih';

		$this->header($data);
		$this->load->view('pemilih');
		$this->load->view('_template/_footer');
	}
	function data_pemilih(){
		$data = $this->m_admin->lihat('pemilih')->result();
		echo json_encode($data);
	}
	function get_pemilih($id){
		$d = $this->db->query('SELECT id_pemilih, nama, username FROM pemilih WHERE id_pemilih='.$id)->row();
		echo json_encode($d);
	}
	function tambah_pemilih(){
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');
		$password = md5($this->input->post('username'));
		$data = ['nama' => $nama, 'username' => $username, 'password' => $password];
		$this->m_admin->tambah('pemilih', $data);
	}
	function edit_pemilih($id){
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');
		$where = ['id_pemilih' => $id];
		$data = ['nama' => $nama, 'username' => $username];
		$this->m_admin->ubah($where, 'pemilih', $data);
	}
	function reset_pass_pemilih($id){
		$p = $this->db->query('SELECT username FROM pemilih WHERE id_pemilih='.$id)->row();
		$pass = md5($p->username);
		$this->db->query('UPDATE pemilih SET password="'.$pass.'" WHERE id_pemilih='.$id);
	}
	function hapus_pemilih($id){
		$this->db->query('DELETE FROM pemilih WHERE id_pemilih='.$id);
	}

	public function pengaturan(){
		$data['title'] = 'Pengaturan';

		$this->header($data);
		$this->load->view('pengaturan');
		$this->load->view('_template/_footer');
	}
	function data_admin(){
		$d = $this->m_admin->lihat('admin')->result();
		echo json_encode($d);
	}
	function get_admin($id){
		$d = $this->db->query('SELECT id_admin, nama, username FROM admin WHERE id_admin='.$id)->row();
		echo json_encode($d);
	}
	function tambah_admin(){
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');
		$password = md5($this->input->post('username'));
		$last = Date('Y-m-d H:i:s');
		$data = [
			'nama' => $nama,
			'username' => $username,
			'password' => $password,
			'last_login' => $last
		];
		$this->m_admin->tambah('admin', $data);
	}
	function reset_pass_admin($id){
		$d = $this->db->query('SELECT username FROM admin WHERE id_admin='.$id)->row();
		$pass = md5($d->username);
		//$this->db->query('UPDATE admin SET username="'.$pass.'" WHERE id_admin='.$id);
		$this->m_admin->ubah(['id_admin' => $id], 'admin', ['password' => $pass]);
	}
	function edit_admin($id){
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');
		$where = ['id_admin' => $id];
		$data = ['nama' => $nama, 'username' => $username];
		$this->m_admin->ubah($where, 'admin', $data);
	}
	function hapus_admin($id){
		$this->db->query('DELETE FROM admin WHERE id_admin='.$id);
	}

	function ganti_user_admin($id){
		$nama = $this->input->post('nama');
		$user = $this->input->post('username'); 
		$data = ['nama' => $nama, 'username' => $user];
		$this->m_admin->ubah(['id_admin' => $id], 'admin', $data);
		$this->session->unset_userdata(['nama', 'username']);
		$this->session->set_userdata($data);
		$this->session->set_flashdata('ganti_user', 'Nama/Username berhasil diubah');
		redirect($this->agent->referrer());
	}
	function ganti_pass_admin($id){
		$d = $this->db->query('SELECT password FROM admin WHERE id_admin='.$id)->row();
		$pass = md5($this->input->post('passwdlama'));
		$newpass = md5($this->input->post('passwdbaru'));

		if ($d->password == $pass) {
			$data = ['password' => $newpass];
			$this->m_admin->ubah(['id_admin' => $id], 'admin', $data);
			$this->session->set_flashdata('ganti_pass', 'Password berhasil diubah');
			redirect('pengaturan');
		}
		else{
			$this->session->set_flashdata('error_pass', 'Password lama tidak sama');
			redirect('pengaturan');
		}
	}

	//Reset aplikasi
	function reset(){
		$this->db->query('SET FOREIGN_KEY_CHECKS = 0');
		$this->db->truncate('ikut_kandidat');
		$this->db->truncate('ikut_voting');
		$this->db->truncate('kandidat');
		$this->db->truncate('pemilih');
		$this->db->truncate('voting');
		$this->db->query('SET FOREIGN_KEY_CHECKS = 1');
		delete_files('./../assets/img/kandidat/');
		redirect('');
	}
	//Logout
	function logout(){
		$last = Date('Y-m-d H:i:s');
		$this->m_admin->ubah(['id_admin' => $this->session->id], 'admin', ['last_login' => $last]);
		$this->session->sess_destroy();
		redirect('login');
	}
}
