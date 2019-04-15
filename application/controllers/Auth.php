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
		$data['title'] = 'Login';

		$this->load->view('_template/_header', $data);
		$this->load->view('login');
		$this->load->view('_template/_footer');
	}
	function actlogin(){
		$username = $this->input->post('username');
		$passwd = md5($this->input->post('password'));
		$d = $this->db->query('SELECT * FROM pemilih WHERE username="'.$username.'" AND password="'.$passwd.'"')->row();
		if ($username == $d->username && $passwd == $d->password) {
			$v = $this->db->query('SELECT * FROM voting')->num_rows();
			if ($v < 1) {
				$this->session->set_flashdata('novoting', 'Tidak ada voting !');
				redirect('login');
			}
			else{
				$user = ['id' => $d->id_pemilih, 'nama' => $d->nama, 'username' => $d->username, 'login' => TRUE];
				$this->session->set_userdata($user);
				redirect('');
			}
		}
		else{
			$this->session->set_flashdata('login_gagal', 'Username/Password salah !');
			redirect('login');
		}
	}
}