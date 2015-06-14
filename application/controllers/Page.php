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
			$data['avatar'] = $user->Avatar;
		}
		$data['votes'] = array();
		$rawvotes = $this->Vote_model->get_all_votes();
		foreach ($rawvotes as $v) {
			$vote = array();
			$owner = $this->User_model->get($v->OwnerID);
			$vote['ownername'] = $owner->Name;
			$vote['owneravatar'] = $owner->Avatar;
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
		$this->form_validation->set_message('required', '您还未输入{field}!');
		$this->form_validation->set_message('min_length', '{field}至少需要{param}个字符!');
		$this->form_validation->set_message('max_length', '{field}最多只能{param}个字符!');
		$this->form_validation->set_message('valid_email', '{field}不是合法的邮箱地址!');
		$this->form_validation->set_message('is_unique', '{field}已经被使用，请尝试登陆!');
		$this->form_validation->set_message('matches', '两次密码不匹配');
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
			redirect('/');
		}
	}
	public function logout(){
		$this->session->sess_destroy();

		echo 'logout success';
		redirect('/');
	}

	public function phonecenter() {
		$userid = $this->session->userdata('userid');
		$data['userid'] = $userid;
		if (!isset($userid)){
			$data['userid'] = -1;
			$data['username'] = 'null';
			echo "您还未登陆";
		}else{
			$user = $this->User_model->get($userid);
			$data['username'] = $user->Name;
			$data['userdesc'] = $user->Info;
			$data['avatar'] = $user->Avatar;
			$this->load->view('header', $data);
			$this->load->view('usercenter/phonecenter');
			$this->load->view('footer');
		}
	}

	public function userinfo() {
		$userid = $this->session->userdata('userid');
		$data['userid'] = $userid;
		if (!isset($userid)){
			$data['userid'] = -1;
			$data['username'] = 'null';
			echo "您还未登陆";
		}else{
			$user = $this->User_model->get($userid);
			$data['username'] = $user->Name;
			$data['userdesc'] = $user->Info;
			$data['useremail'] = $user->Email;
			$data['avatar'] = $user->Avatar;
			$this->load->view('header', $data);
			$this->load->view('usercenter/center');
			$this->load->view('usercenter/userinfo');
			$this->load->view('footer');
		}
	}

	public function editprofile() {
		$userid = $this->session->userdata('userid');
		$data['userid'] = $userid;
		if (!isset($userid)){
			$data['userid'] = -1;
			$data['username'] = 'null';
			echo "您还未登陆";
		}else{
			$user = $this->User_model->get($userid);
			$data['username'] = $user->Name;
			$data['userdesc'] = $user->Info;
			$data['useremail'] = $user->Email;
			$data['avatar'] = $user->Avatar;
			$this->load->view('header', $data);
			$this->load->view('usercenter/center');
			$this->load->view('usercenter/editprofile');
			$this->load->view('footer');
		}
	}

	public function submit_edit() {
		$userid = $this->session->userdata('userid');
		$data['userid'] = $userid;
		if (!isset($userid)){
			$data['userid'] = -1;
			$data['username'] = 'null';
			echo "您还未登陆";
		}else{
			$this->User_model->update_profile($userid);
			$user = $this->User_model->get($userid);
			$data['username'] = $user->Name;
			$data['userdesc'] = $user->Info;
			$data['avatar'] = $user->Avatar;

		}
	}
	public function followhistory() {
		$userid = $this->session->userdata('userid');
		$data['userid'] = $userid;
		if (!isset($userid)){
			$data['userid'] = -1;
			$data['username'] = 'null';
			echo "您还未登陆";
		}else{
			$user = $this->User_model->get($userid);
			$data['username'] = $user->Name;
			$data['userdesc'] = $user->Info;
			$data['avatar'] = $user->Avatar;
			$data['votes'] = array();
			$raw_votes = $this->Vote_model->get_followed($userid);
			foreach ($raw_votes as $raw_v) {
				$vote = array();
				$owner = $this->User_model->get($raw_v->OwnerID);
				$vote['ownername'] = $owner->Name;
				$vote['owneravatar'] = $owner->Avatar;
				$raw_options = $this->Vote_model->get_options($raw_v->ID);
				$vote['options'] = array();
				foreach ($raw_options as $raw_p) {
					$option['title'] = $raw_p->Title;
					$option['desc'] = $raw_p->DescInfo;
					$option['path'] = $raw_p->Image;
					$option['support'] = $raw_p->Support;
					array_push($vote['options'], $option);
				}
				$vote['title'] = $raw_v->Title;
				$vote['desc'] = $raw_v->DescInfo;
				$vote['status'] = $raw_v->Status;
				$vote['createtime'] = $raw_v->CreateTime;
				array_push($data['votes'], $vote);
			}
			$this->load->view('header', $data);
			$this->load->view('usercenter/center');
			$this->load->view('usercenter/followh');
			$this->load->view('footer');
		}
	}

	public function votehistory() {
		$userid = $this->session->userdata('userid');
		$data['userid'] = $userid;
		if (!isset($userid)){
			$data['userid'] = -1;
			$data['username'] = 'null';
			echo "您还未登陆";
		}else{
			$user = $this->User_model->get($userid);
			$data['username'] = $user->Name;
			$data['userdesc'] = $user->Info;
			$data['avatar'] = $user->Avatar;
			$data['votes'] = array();
			$raw_votes = $this->Vote_model->get_voted($userid);
			foreach ($raw_votes as $raw_v) {
				$vote = array();
				$owner = $this->User_model->get($raw_v->OwnerID);
				$vote['ownername'] = $owner->Name;
				$vote['owneravatar'] = $owner->Avatar;
				$record = $this->Vote_model->get_voted_record($userid, $raw_v->ID);
				$vote['record']['option'] = $record->OptionID;
				$vote['record']['comment'] = $record->Comment;
				$vote['record']['createtime'] = $record->CreateTime;
				$raw_options = $this->Vote_model->get_options($raw_v->ID);
				$vote['options'] = array();
				foreach ($raw_options as $raw_p) {
					$option['title'] = $raw_p->Title;
					$option['desc'] = $raw_p->DescInfo;
					$option['path'] = $raw_p->Image;
					$option['support'] = $raw_p->Support;
					array_push($vote['options'], $option);
				}
				$vote['title'] = $raw_v->Title;
				$vote['desc'] = $raw_v->DescInfo;
				$vote['status'] = $raw_v->Status;
				$vote['createtime'] = $raw_v->CreateTime;
				array_push($data['votes'], $vote);
			}
			$this->load->view('header', $data);
			$this->load->view('usercenter/center');
			$this->load->view('usercenter/voteh');
			$this->load->view('footer');
		}
	}

	public function publishhistory() {
		$userid = $this->session->userdata('userid');
		$data['userid'] = $userid;
		if (!isset($userid)){
			$data['userid'] = -1;
			$data['username'] = 'null';
			echo "您还未登陆";
		}else{
			$user = $this->User_model->get($userid);
			$data['username'] = $user->Name;
			$data['userdesc'] = $user->Info;
			$data['avatar'] = $user->Avatar;
			$data['votes'] = array();
			$raw_votes = $this->Vote_model->get_published($userid);
			foreach ($raw_votes as $raw_v) {
				$vote = array();
				$owner = $this->User_model->get($raw_v->OwnerID);
				$vote['ownername'] = $owner->Name;
				$vote['owneravatar'] = $owner->Avatar;
				$raw_options = $this->Vote_model->get_options($raw_v->ID);
				$vote['options'] = array();
				foreach ($raw_options as $raw_p) {
					$option['title'] = $raw_p->Title;
					$option['desc'] = $raw_p->DescInfo;
					$option['path'] = $raw_p->Image;
					$option['support'] = $raw_p->Support;
					array_push($vote['options'], $option);
				}
				$vote['title'] = $raw_v->Title;
				$vote['desc'] = $raw_v->DescInfo;
				$vote['status'] = $raw_v->Status;
				$vote['createtime'] = $raw_v->CreateTime;
				array_push($data['votes'], $vote);
			}
			$this->load->view('header', $data);
			$this->load->view('usercenter/center');
			$this->load->view('usercenter/publishh');
			$this->load->view('footer');
		}
	}
}
