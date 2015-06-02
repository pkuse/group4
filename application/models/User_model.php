<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	public function authen() {
		$this->db->where('Email', $this->input->post('Email'));
		$this->db->where('Pwd', md5($this->input->post('Pwd')));
		$q = $this->db->get('USER_INFO');
		if ($q->num_rows() > 0){
			if ($q->num_rows() > 1){
				return -1;
			}
			$user = $q->row(0);
			return $user->ID;
		} else {
			echo '登陆失败';
			return -1;
		}
	}
	public function add(){
		$data['Email'] = $this->input->post('Email');
		$data['Name'] = $this->input->post('Name');
		$data['Pwd'] = $this->input->post('Pwd');
		$PwdConfirm = $this->input->post('PwdConfirm');
		if ($data['Pwd'] != $PwdConfirm){
			echo '两次密码不一致';
		} else {
			$data['Pwd'] = md5($PwdConfirm);
			$this->db->insert('USER_INFO', $data);
			echo '创建成功';
		}
	}
	function get($userid){
		$this->db->where('ID', $userid);
		$q = $this->db->get('USER_INFO');
		if ($q->num_rows() == 1){
			return $q->row(0);
		} else return NULL;
	}
}
