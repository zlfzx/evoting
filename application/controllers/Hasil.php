<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class Hasil extends CI_Controller{
	
	public function index(){
		$data['title'] = 'Hasil Voting';
		$v = $this->db->query('SELECT * FROM voting');
		if ($v->num_rows() < 1) {
			$data['voting'] = '';
		}
		else{
			$data['voting'] = $v->row();
			$data['kandidat'] = $this->db->query('SELECT * FROM kandidat JOIN ikut_kandidat ON ikut_kandidat.id_kandidat=kandidat.id_kandidat WHERE id_voting='.$data["voting"]->id_voting)->result();
		}

		$this->load->view('_hasil_voting/hasil', $data);
	}

}