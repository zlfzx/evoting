<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class Auth extends CI_Controller{
	function __construct(){
		parent::__construct();
		if ($this->session->login) {
			redirect('');
		}
	}
	
	public function index(){
		$data['title'] = 'E-Voting';
		$this->load->view('_template_login/login', $data);
	}
	function actlogin(){
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		$d = $this->db->query('SELECT * FROM admin WHERE username="'.$username.'" AND password="'.$password.'"');
		if ($d->num_rows() > 0) {
			$admin = $d->row();
			$data = [
				'id' => $admin->id_admin,
				'nama' => $admin->nama,
				'username' => $admin->username,
				'last_login' => $admin->last_login,
				'login' => TRUE
			];
			$this->session->set_userdata($data);
			$last = Date('Y-m-d H:i:s');
			$this->db->query('UPDATE admin SET last_login="'.$last.'" WHERE id_admin='.$this->session->id);
			redirect('');
		}
		else{
			$this->session->set_flashdata('gagal', 'Username/password salah');
			redirect('login');
		}
	}
}