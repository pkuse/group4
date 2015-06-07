<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Page extends CI_Controller {
	public function index()
	{
		$userid = $this->session->userdata('userid');
		$data['userid'] = $userid;
		if (!isset($userid)){
			$data['userid'] = -1;
			$data['username'] = 'null';
		}else{
			$user = $this->User_model->get($userid);
			$data['username'] = $user->Name;
		}
		$data['votes'] = array();
		$rawvotes = $this->Vote_model->get_all_votes();
		foreach ($rawvotes as $v) {
		//	echo $v->ID;
		//	echo "vote id<br>";
		//	echo $v->Title;
		//	echo "<br>";
			$voye = array();
			$vote['ownername'] = $this->User_model->get($v->OwnerID);
			$rawoptions = $this->Vote_model->get_options($v->ID);
			$vote['options'] = array();
			foreach ($rawoptions as $raw) {
				$option['title'] = $raw->Title;
				$option['desc'] = $raw->DescInfo;
				$option['path'] = $raw->Image;
				$option['support'] = $raw->Support;
				array_push($vote['options'], $option);
			}
			$vote['title'] = $v->Title;
			$vote['desc'] = $v->DescInfo;
			$vote['createtime'] = $v->CreateTime;
			array_push($data['votes'], $vote);
		}

		$this->load->view('header', $data);
		$this->load->view('home');
		$this->load->view('footer');
	}
	public function login(){
		$userid = $this->User_model->authen();

		if ($userid > 0){
			$data['userid'] = $userid;
			$sessiondata = array('userid' => $userid);
			$this->session->set_userdata($sessiondata);
			echo 'login success';
		}
		redirect('/');
	}
	public function signup(){
		$userid = $this->session->userdata('userid');
		$data['userid'] = $userid;
		if (!isset($status)){
			$data['userid'] = -1;
			$data['username'] = 'null';
		}else{
			$user = $this->User_model->get($userid);
			$data['username'] = $user->Name;
		}
		$this->load->view('header', $data);
		$this->load->view('signup');
		$this->load->view('footer');
	}
	public function sign(){
		$this->load->library('form_validation');
		$my_rules = array(
			array(
				'field' => 'Name',
				'label' => '用户名',
				'rules' => 'required|min_length[5]|max_length[12]|is_unique[USER_INFO.Name]'
			),
			array(
				'field' => 'Email',
				'label' => '邮箱',
				'rules' => 'required|valid_email|is_unique[USER_INFO.Email]'
			),
			array(
				'field' => 'Pwd',
				'label' => '密码',
				'rules' => 'required|min_length[6]|max_length[20]|matches[PwdConfirm]'
			),
			array(
				'field' => 'PwdConfirm',
				'label' => '确认密码',
				'rules' => 'required|min_length[6]|max_length[20]'
			)
		);
		$this->form_validation->set_message('required', '请输入{field}！');
		$this->form_validation->set_message('min_length', '{field}至少需要{param}个字符！');
		$this->form_validation->set_message('max_length', '{field}最多只能{param}个字符！');
		$this->form_validation->set_message('valid_email', '{field}地址不合法！');
		$this->form_validation->set_message('is_unique', '{field}已被使用！');
		$this->form_validation->set_message('matches', '两次密码不匹配！');
		$this->form_validation->set_rules($my_rules);
		
		if ($this->form_validation->run() == FALSE) {
			$data['userid'] = -1;
			$data['username'] = 'null';
			$this->load->view('header', $data);
			$this->load->view('signup');
			$this->load->view('footer');
		}
		else {
			$this->User_model->add();
			echo "Validation Successful";
		//	redirect('/');
		}
	}
	public function logout(){
		$this->session->sess_destroy();

		echo 'logout success';
		redirect('/');
	}
}
