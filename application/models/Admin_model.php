<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model{
	function authen($name, $pwd) {
		$this->db->where("Name", $name);
		$this->db->where("Password", $pwd);
		$query = $this->db->get("ADMIN_INFO");

		if ($query->num_rows() == 1){
			return $query->row()->ID;
		}
		else
			return -1;
	}
	function get($id) {
		$query = $this->db->query("SELECT * FROM ADMIN_INFO WHERE ID = $id");
		if ($query->num_rows() == 1){
			return $query->row();
		} else return NULL;
	}
}