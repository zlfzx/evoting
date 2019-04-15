<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class User extends CI_Controller {

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
	}
	private function header($data){
		$p = $this->db->query('SELECT password FROM pemilih WHERE id_pemilih='.$this->session->id)->row();
		if ($p->password == md5($this->session->username)) {
			$data['passdefault'] = TRUE;
		}
		else{
			$data['passdefault'] = FALSE;
		}

		$this->load->view('_template/_header', $data);
	}

	public function index(){
		$data['title'] = 'E-Voting';
		$data['voting'] = $this->db->get('voting')->row();

		$cekvoting = $this->db->get('voting')->num_rows();
		if ($cekvoting > 0) {
			$data['voting'] = $this->db->get('voting')->row();
			$data['kandidat'] = $this->db->query('SELECT ikut_kandidat.id_voting, kandidat.* FROM ikut_kandidat INNER JOIN kandidat ON ikut_kandidat.id_voting='.$data['voting']->id_voting.' WHERE kandidat.id_kandidat=ikut_kandidat.id_kandidat')->result();
		}
		$cekpilih = $this->db->query('SELECT * FROM ikut_voting WHERE id_pemilih='.$this->session->id)->num_rows();
		// if ($cekpilih > 0) {
		// 	$data['pilih'] = TRUE;
		// }
		// else{
		// 	$data['pilih'] = FALSE;
		// }
		($cekpilih > 0) ? $data['pilih'] = TRUE : $data['pilih'] = FALSE;

		$this->header($data);
		$this->load->view('main');
		$this->load->view('_template/_footer');
	}
	function pilih($voting, $id){
		$c = $this->db->get_where('voting', ['id_voting' => $voting]);
		if ($c->num_rows() > 0) {
			$this->db->query('UPDATE ikut_kandidat SET poin = poin+1 WHERE id_kandidat='.$id);
			$pilih = ['id_voting' => $voting, 'id_pemilih' => $this->session->id, 'waktu' => Date('y-m-d H:i:s')];
			$this->db->insert('ikut_voting', $pilih);
			echo 1;
		}
	}


	function set_pass_id($id){
		$passLama = md5($this->input->post('passwdLama'));
		$passBaru = md5($this->input->post('passwdBaru'));
		$p = $this->db->query('SELECT password FROM pemilih WHERE id_pemilih='.$id)->row();
		if ($passLama == $p->password) {
			$this->db->query('UPDATE pemilih SET password="'.$passBaru.'" WHERE id_pemilih='.$id);
			echo 1;
		}
		else{
			echo 0;
		}
	}
	function logout(){
		$this->session->sess_destroy();
		redirect('login');
	}
}
