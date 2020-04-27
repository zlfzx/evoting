<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_admin extends CI_Model{
	// CRUD
	function lihat($table){
		return $this->db->get($table);
	}
	function tambah($table, $data){
		$this->db->insert($table, $data);
	}
	function ubah($where, $table, $data){
		$this->db->where($where);
		$this->db->update($table, $data);
	}
	function hapus($where, $table){
		$this->db->where($where);
		$this->db->delete($table);
	}

}