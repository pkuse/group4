<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Page extends CI_Controller {
	public function index()
	{
		$userid = $this->session->userdata('userid');
		$data['userid'] = $userid;
		$flag = true;  // true表示是登录用户
		if (!isset($userid)){
			$data['userid'] = -1;
			$data['username'] = 'null';
			$flag = false;
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
			$vote['id'] = $v->ID;
			$vote['status'] = $v->Status;
			$vote['part_num'] = $this->Vote_model->get_participate_num($vote['id']);
			$vote['comment_num'] = $this->Vote_model->get_comment_num($vote['id']);
			$vote['follow_num'] = $this->Vote_model->get_follow_num($vote['id']);
			// 为登录，默认为-1
			if ($flag == false) {
				$vote['participate'] = -1;
				$vote['follow'] = -1;
			}
			// 登录状态，1表示参与/关注过，0表示未参与/未关注
			else {
				$vote['participate'] = $this->User_model->is_participated($userid, $v->ID);
				$vote['follow'] = $this->User_model->is_followed($userid, $v->ID);
			}
			
			$rawoptions = $this->Vote_model->get_options($v->ID);
			$vote['options'] = array();
			foreach ($rawoptions as $raw) {
				$option['title'] = $raw->Title;
				$option['desc'] = $raw->DescInfo;
				$option['path'] = $raw->Image;
				$option['support'] = $raw->Support;
				$option['id'] = $raw->ID;
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
		// //echo "DENGNNG";
		if ($userid > 0){
			$data['userid'] = $userid;
			$sessiondata = array('userid' => $userid);
			$this->session->set_userdata($sessiondata);
			echo 'login success';

		}
		redirect('/');
		// if ($userid == 1) {
		// 	redirect("/admin/user");
		// }
		// else
		// 	redirect('/');
	}
	public function signup(){
		$userid = $this->session->userdata('userid');
		$data['userid'] = $userid;
		if (!isset($userid)){
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

	public function usercenter() {
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
			$this->load->view('usercenter/usercenter');
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
		if (!isset($userid)){
			echo "您还未登陆";
		}else{
			$this->User_model->update_profile($userid);
			redirect('/page/userinfo');

		}
	}

	public function submit_avatar() {
		$userid = $this->session->userdata('userid');
		if (!isset($userid)){
			echo "您还未登陆";
		}else{
			$upload_config = array(
				'upload_path' => './img/avatars/',
				'allowed_types' => 'gif|jpg|jpeg|png',
				'file_name' => 'avator'.$userid,
				'max_size' => '1024'
			);
			$this->load->library('upload', $upload_config);
			if (!$this->upload->do_upload("new_avatar")) {
				echo "上传失败";
				echo "<br/>";
				echo $this->upload->display_errors();	
			}
			$file_name = $this->upload->data('file_name');
			$path = substr($upload_config['upload_path'].$file_name, 1);
			$this->User_model->update_avatar($userid, $path);
			redirect('/page/editprofile');
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
				$vote['id'] = $raw_v->ID;
				$vote['part_num'] = $this->Vote_model->get_participate_num($vote['id']);
				$vote['comment_num'] = $this->Vote_model->get_comment_num($vote['id']);
				$vote['follow_num'] = $this->Vote_model->get_follow_num($vote['id']);
				$raw_options = $this->Vote_model->get_options($raw_v->ID);
				$vote['options'] = array();
				foreach ($raw_options as $raw_p) {
					$option['title'] = $raw_p->Title;
					$option['desc'] = $raw_p->DescInfo;
					$option['path'] = $raw_p->Image;
					$option['support'] = $raw_p->Support;
					$option['id'] = $raw_p->ID;
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
				$vote['id'] = $raw_v->ID;
				$vote['part_num'] = $this->Vote_model->get_participate_num($vote['id']);
				$vote['comment_num'] = $this->Vote_model->get_comment_num($vote['id']);
				$vote['follow_num'] = $this->Vote_model->get_follow_num($vote['id']);
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
					$option['id'] = $raw_p->ID;
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
				$vote['id'] = $raw_v->ID;
				$vote['part_num'] = $this->Vote_model->get_participate_num($vote['id']);
				$vote['comment_num'] = $this->Vote_model->get_comment_num($vote['id']);
				$vote['follow_num'] = $this->Vote_model->get_follow_num($vote['id']);
				$raw_options = $this->Vote_model->get_options($raw_v->ID);
				$vote['options'] = array();
				foreach ($raw_options as $raw_p) {
					$option['title'] = $raw_p->Title;
					$option['desc'] = $raw_p->DescInfo;
					$option['path'] = $raw_p->Image;
					$option['support'] = $raw_p->Support;
					$option['id'] = $raw_p->ID;
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

	public function search() {
		$str = $this->input->get("search");
		$search_key = str_replace(" ", "+", $str);
		$data['keywords'] = $search_key;
		if (empty($str)) 
			redirect('/');
		else {
			$userid = $this->session->userdata('userid');
			$data['userid'] = $userid;
			$flag = true;  // true表示是登录用户
			if (!isset($userid)){
				$data['userid'] = -1;
				$data['username'] = 'null';
				$flag = false;
			}else{
				$user = $this->User_model->get($userid);
				$data['username'] = $user->Name;
				$data['avatar'] = $user->Avatar;
			}

			$keywords = explode(" ", $str);
			$len = count($keywords);
			if ($len >= 1) {
				// 先以标题中有相似字符串的投票为主
				$sql = "SELECT * FROM VOTE_INFO WHERE Title LIKE '%$keywords[0]%' ";
				for ($i = 1; $i < $len; $i++) {
					$sql = $sql."AND Title LIKE '%$keywords[$i]%' ";
				}
				$sql = $sql." ORDER BY CreateTime DESC";
				$rawvotes = $this->Vote_model->get_search($sql);
				$data['votes'] = array();
				foreach ($rawvotes as $v) {
					$vote = array();
					$owner = $this->User_model->get($v->OwnerID);
					$vote['ownername'] = $owner->Name;
					$vote['owneravatar'] = $owner->Avatar;
					$vote['id'] = $v->ID;
					$vote['status'] = $v->Status;
					$vote['part_num'] = $this->Vote_model->get_participate_num($vote['id']);
					$vote['comment_num'] = $this->Vote_model->get_comment_num($vote['id']);
					$vote['follow_num'] = $this->Vote_model->get_follow_num($vote['id']);
					// 为登录，默认为-1
					if ($flag == false) {
						$vote['participate'] = -1;
						$vote['follow'] = -1;
					}
					// 登录状态，1表示参与/关注过，0表示未参与/未关注
					else {
						$vote['participate'] = $this->User_model->is_participated($userid, $v->ID);
						$vote['follow'] = $this->User_model->is_followed($userid, $v->ID);
					}

					$rawoptions = $this->Vote_model->get_options($v->ID);
					$vote['options'] = array();
					foreach ($rawoptions as $raw) {
						$option['title'] = $raw->Title;
						$option['desc'] = $raw->DescInfo;
						$option['path'] = $raw->Image;
						$option['support'] = $raw->Support;
						$option['id'] = $raw->ID;
						array_push($vote['options'], $option);
					}
					$vote['title'] = $v->Title;
					$vote['desc'] = $v->DescInfo;
					$vote['createtime'] = $v->CreateTime;
					array_push($data['votes'], $vote);
				}
				// 再搜出标题中没有，但描述中有的
				$sql = "SELECT * FROM VOTE_INFO WHERE (Title NOT LIKE '%$keywords[0]%' AND DescInfo Like '%$keywords[0]%') ";
				for ($i = 1; $i < $len; $i++) {
					$sql = $sql."AND (Title NOT LIKE '%$keywords[$i]%' AND DescInfo Like '%$keywords[$i]%') ";
				}
				$sql = $sql." ORDER BY CreateTime DESC";
				$rawvotes = $this->Vote_model->get_search($sql);
				foreach ($rawvotes as $v) {
					$vote = array();
					$owner = $this->User_model->get($v->OwnerID);
					$vote['ownername'] = $owner->Name;
					$vote['owneravatar'] = $owner->Avatar;
					$vote['id'] = $v->ID;
					$vote['status'] = $v->Status;
					$vote['part_num'] = $this->Vote_model->get_participate_num($vote['id']);
					$vote['comment_num'] = $this->Vote_model->get_comment_num($vote['id']);
					$vote['follow_num'] = $this->Vote_model->get_follow_num($vote['id']);
					// 为登录，默认为-1
					if ($flag == false) {
						$vote['participate'] = -1;
						$vote['follow'] = -1;
					}
					// 登录状态，1表示参与/关注过，0表示未参与/未关注
					else {
						$vote['participate'] = $this->User_model->is_participated($userid, $v->ID);
						$vote['follow'] = $this->User_model->is_followed($userid, $v->ID);
					}

					$rawoptions = $this->Vote_model->get_options($v->ID);
					$vote['options'] = array();
					foreach ($rawoptions as $raw) {
						$option['title'] = $raw->Title;
						$option['desc'] = $raw->DescInfo;
						$option['path'] = $raw->Image;
						$option['support'] = $raw->Support;
						$option['id'] = $raw->ID;
						array_push($vote['options'], $option);
					}
					$vote['title'] = $v->Title;
					$vote['desc'] = $v->DescInfo;
					$vote['createtime'] = $v->CreateTime;
					array_push($data['votes'], $vote);
				}

				$this->load->view('header', $data);
				$this->load->view('searchresult');
				$this->load->view('footer');
			}
			else 
				redirect('/');
		}
		

	} 
}
