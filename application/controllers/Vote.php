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
				'max_size' => '2048'
			);

			$this->load->library('upload', $upload_config);

			$options_path = array();

			$flag = TRUE;

			for ($i = 0; $i < $options_count; $i++) {
				$options_pic_field = $options_pic . $i;
				if (!$this->upload->do_upload($options_pic_field)) {
					$data['error'] = $this->upload->display_errors();
					$flag = FALSE;
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
		if (!isset($userid)){
			$data['userid'] = -1;
			$data['username'] = 'null';
		} else {
			$user = $this->User_model->get($userid);
			$data['username'] = $user->Name;
			$data['useravatar'] = $user->Avatar;
		}
		
		#set vote info
		$vote = array();
		$vote['id'] = $id;
		$rawvote = $this->Vote_model->get($id);
		$vote['title'] = 'default vote title';
		$vote['desc'] = $rawvote->DescInfo;
		
		#set owner info 
		$vote['ownerid'] = $rawvote->OwnerID;
		#echo "userid: " + $vote['ownerid'] + "<br />";
		$owner = $this->User_model->get($vote['ownerid']);
		$vote['ownername'] = $owner->Name;
		$vote['owneravatar'] = $owner->Avatar;
		
		#set options info
		$options = array();
		$rawoptions = $this->Vote_model->get_options($id);
		$vote['participant'] = 0; #total number of the vote participants
		foreach($rawoptions as $rawoption){
			$option = array();
			$option['id'] = $rawoption->ID;
			$option['title'] = 'default option title';
			$option['image'] = $rawoption->Image;
			$option['desc'] = $rawoption->DescInfo;
			$option['support'] = $rawoption->Support;
			$vote['participant'] += $option['support'];
			array_push($options, $option);
		}

		$vote['options'] = $options;
		$data['vote'] = $vote;
		$this->load->view('header', $data);
		#echo $id;
		$this->load->view('viewvote', $data);
		$this->load->view('footer');
	}

	public function vote($voteid, $optionid) {
		$userid = $this->session->userdata('userid');
		$data['userid'] = $userid;
		if (!isset($userid)){
			$data['userid'] = -1;
			$data['username'] = 'null';
		} else {
			$user = $this->User_model->get($userid);
			$data['username'] = $user->Name;
			$data['useravatar'] = $user->Avatar;
		}
		$v = $this->User_model->vote($userid, $voteid, $optionid);
		if ($v == -1) {
			echo "投票失败";
		}
		else 
			redirect('/');
	}

	public function comment($voteid) {
		$userid = $this->session->userdata('userid');
		$data['userid'] = $userid;
		if (!isset($userid)){
			$data['userid'] = -1;
			$data['username'] = 'null';
		} else {
			$user = $this->User_model->get($userid);
			$data['username'] = $user->Name;
			$data['useravatar'] = $user->Avatar;
		}
		$v = $this->User_model->comment($userid, $voteid);
		if ($v == -1) {
			echo "评论失败";
		}
		else 
			redirect('/');
	}
}
