<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model("Admin_model");
	}
	public function index() {
		$admin_id = $this->session->userdata('admin_id');
		if (!isset($admin_id)) { 
			$this->load->view("admin/login");
		}
		else
			redirect("/admin/users");
	}

	public function login() {
		$name = $this->input->post("Name");
		$pwd = md5($this->input->post("Password"));
		$admin_id = $this->Admin_model->authen($name, $pwd);
		if ($admin_id == -1) {
			echo "登录失败";
		}
		else {
			$sessiondata = array('admin_id' => $admin_id);
			$this->session->set_userdata($sessiondata);
			echo "登录成功";
			redirect("/admin/users");
		}
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect("/admin/");
	}
	// public function test1() {
	// 	$data['users'] = $this->User_model->get_all_users();
	// 	$this->load->view("admin/users", $data);
	// }
	// public function test2() {
	// 	$data['votes'] = $this->Vote_model->get_all_votes();
	// 	$this->load->view("admin/votes", $data);
	// }
	// public function test3() {
	// 	$data['comments'] = $this->Vote_model->get_all_comments();

	// 	$this->load->view("admin/comments", $data);
	// }

	public function users() {
		$admin_id = $this->session->userdata('admin_id');
		if (!isset($admin_id)){
			echo "你没有权限！";
		}else {
			$admin = $this->Admin_model->get($admin_id);
			$data['name'] = $admin->Name;
			$data['users'] = $this->User_model->get_all_users();
			$this->load->view("admin/users", $data);
		}
	}

	public function votes() {
		$admin_id = $this->session->userdata('admin_id');
		if (!isset($admin_id)){
			echo "你没有权限！";
		}else {
			$admin = $this->Admin_model->get($admin_id);
			$data['name'] = $admin->Name;
			$data['votes'] = $this->Vote_model->get_all_votes();
			$this->load->view("admin/votes", $data);
		}

	}


	public function comments() {
		$admin_id = $this->session->userdata('admin_id');
		if (!isset($admin_id)){
			echo "你没有权限！";
		}else {
			$admin = $this->Admin_model->get($admin_id);
			$data['name'] = $admin->Name;
			$data['comments'] = $this->Vote_model->get_all_comments();
			$this->load->view("admin/comments", $data);
		}
	
	}


	public function delete_user() {
		$admin_id = $this->session->userdata('admin_id');
		if (!isset($admin_id)){
			echo "你没有权限！";
		}else {
			$admin = $this->Admin_model->get($admin_id);
			$data['name'] = $admin->Name;
			$user_id = $this->input->get("user_id");
			$this->User_model->delete_user($user_id);
			redirect("/admin/users");
		}

	}

	public function delete_vote() {
		$admin_id = $this->session->userdata('admin_id');
		if (!isset($admin_id)){
			echo "你没有权限！";
		}else {
			$admin = $this->Admin_model->get($admin_id);
			$data['name'] = $admin->Name;
			$vote_id = $this->input->get("vote_id");
			$this->Vote_model->delete_vote($vote_id);
			redirect("/admin/votes");
		}
		
	}

	public function delete_comment() {
		$admin_id = $this->session->userdata('admin_id');
		if (!isset($admin_id)){
			echo "你没有权限！";
		}else {
			$admin = $this->Admin_model->get($admin_id);
			$data['name'] = $admin->Name;
			$user_id = $this->input->get("user_id");
			$vote_id = $this->input->get("vote_id");
			$this->Vote_model->delete_comment($user_id, $vote_id);
			redirect("/admin/comments");
		}
	
	 }
}