<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Vote extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('Vote_model');
	}

	public function publish_vote() {

		$user_id = $this->session->userdata('userid');
		$data['userid'] = $user_id;
		if (!isset($user_id)) {
			redirect('/');
		}
		else {
			$user = $this->User_model->get($user_id);
			$data['username'] = $user->Name;
			$data['avatar'] = $user->Avatar;
			$this->load->view('header', $data);
			$this->load->view('newvote');
			$this->load->view('footer');
		}
	}

	public function submit_vote() {

		$user_id = $this->session->userdata('userid');


		$vote_title = $this->input->post('vote_title');
		$vote_desc = $this->input->post('vote_description');

		$options_title = $this->input->post('vote_options_title');
		$options_desc = $this->input->post('vote_options_desc');
		$options_pic = 'vote_options_pic_';
		
		$options_count = count($options_desc);
		if ($options_count < 2) {
			redirect('/');
		}
		else {
			$upload_config = array(
				'upload_path' => './img/vote_pics/',
				'allowed_types' => 'gif|jpg|jpeg|png',
				'file_name' => 'vote_pic',
				'max_size' => '20480'
			);

			$this->load->library('upload', $upload_config);

			$options_path = array();

			$flag = TRUE;

			for ($i = 0; $i < $options_count; $i++) {
				$options_pic_field = $options_pic . $i;
				if (!$this->upload->do_upload($options_pic_field)) {
					$data['error'] = $this->upload->display_errors();
					$flag = FALSE;
					echo $data['error'];
					break;
				}
				$file_name = $this->upload->data('file_name');
				$options_path[$i] = $upload_config['upload_path'] . $file_name;
			}

			if($flag == TRUE) {
				echo "Upload Success!<br/>";
				$vote_id = $this->Vote_model->add_vote($user_id, $vote_title, $vote_desc, $vote_duetime=0);
				echo $vote_id;
				for ($i = 0; $i < $options_count; $i++)
					$this->Vote_model->add_option($vote_id, $options_title[$i], $options_desc[$i], $options_path[$i]);
				redirect('/');
			}
		}
	}
	public function view($id){
		$userid = $this->session->userdata('userid');
		$data['userid'] = $userid;
		$flag = true;
		if (!isset($userid)){
			$data['userid'] = -1;
			$data['username'] = 'null';
			$flag = false;
		} else {
			$user = $this->User_model->get($userid);
			$data['username'] = $user->Name;
			$data['avatar'] = $user->Avatar;
		}
		
		#set vote info
		$vote = array();
		$vote['id'] = $id;
		$rowvote = $this->Vote_model->get($id);
		$vote['title'] = $rowvote->Title;
		$vote['desc'] = $rowvote->DescInfo;
		// 为登录，默认为-1
		if ($flag == false) {
			$vote['participate'] = -1;
			$vote['follow'] = -1;
		}
		// 登录状态，1表示参与/关注过，0表示未参与/未关注
		else {
			$vote['participate'] = $this->User_model->is_participated($userid, $id);
			$vote['follow'] = $this->User_model->is_followed($userid, $id);
		}
		#set owner info 
		$vote['ownerid'] = $rowvote->OwnerID;
		#echo "userid: " + $vote['ownerid'] + "<br />";
		$owner = $this->User_model->get($vote['ownerid']);
		$vote['ownername'] = $owner->Name;
		$vote['owneravatar'] = $owner->Avatar;
		$vote['status'] = $rowvote->Status;
		$vote['part_num'] = $this->Vote_model->get_participate_num($vote['id']);
		$vote['comment_num'] = $this->Vote_model->get_comment_num($vote['id']);
		$vote['follow_num'] = $this->Vote_model->get_follow_num($vote['id']);
		#set options info
		$options = array();
		$rowoptions = $this->Vote_model->get_options($id);
		$vote['participant'] = 0; #total number of the vote participants
		foreach($rowoptions as $rowoption){
			$option = array();
			$option['id'] = $rowoption->ID;
			$option['title'] = $rowoption->Title;
			$option['path'] = $rowoption->Image;
			$option['desc'] = $rowoption->DescInfo;
			$option['support'] = $rowoption->Support;
			$vote['participant'] += $option['support'];
			array_push($options, $option);
		}

		#set comments
		$rowrecords = $this->Vote_model->get_comments($id);
		$comments = array();
		//echo count($rowrecords);
		foreach ($rowrecords as $rowrecord) {
			$comment = array();
			$owner = $this->User_model->get($rowrecord->UserID);
			$comment['ownername'] = $owner->Name;
			$comment['owneravatar'] = $owner->Avatar;
			$comment['content'] = $rowrecord->Comment;
			$comment['time'] = $rowrecord->CreateTime;
			array_push($comments, $comment);
		}
		$vote['options'] = $options;
		$vote['comments'] = $comments;
		$data['vote'] = $vote;
		$this->load->view('header', $data);
		#echo $id;
		$this->load->view('viewvote', $data);
		$this->load->view('footer');
	}

	public function vote_comment() {
		$userid = $this->session->userdata('userid');
		if (!isset($userid)) {
			echo "您还未登录";
		}
		else {
			$voteid = $this->input->post("voteid");
			$optionid = $this->input->post("optionid");
			$comment = $this->input->post("comment");
			$srcurl = $this->input->post("srcurl");
			$v = $this->User_model->vote($userid, $voteid, $optionid, $comment);
			if ($v == -1) {
				echo "投票失败";
			}
			else {
				redirect($srcurl);
			}
			
		}		
	}
	

	public function comment($voteid) {
		$userid = $this->session->userdata('userid');
		$data['userid'] = $userid;
		if (!isset($userid)){
			echo "您还未登录";
		} else {
			$v = $this->User_model->comment($userid, $voteid);
			if ($v == -1) {
				echo "评论失败";
			}
			else 
				redirect('/');
		}
	}

	public function follow() {
		$userid = $this->session->userdata('userid');
		if (!isset($userid)){
			echo "您还未登录";
		} else {
			$voteid = $this->input->post("voteid");
			$srcurl = $this->input->post("srcurl");
			$this->User_model->follow_vote($userid, $voteid);
			redirect($srcurl);
		}
	}

	public function close_vote() {
		$userid = $this->session->userdata('userid');
		if (!isset($userid)){
			echo "您还未登录";
		} else {
			$voteid = $this->input->post("voteid");
			if ($this->Vote_model->close($userid, $voteid) == -1) {
				echo "关闭失败";
			}
			else
				redirect('/page/publishhistory');
		}
	}
}
