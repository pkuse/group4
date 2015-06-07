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
			redirect('');
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
			
			}

			/*
			// Upload pictures
			for ($i = 0; $i < $options_count; ++$i){
				$pic = 'vote_options_pic_' . $i;
				echo "title<br>";
				echo $options_title[$i];
				echo "<br>pic:<br>";
				echo $pic;
				echo "<br>";
				if (!$this->upload->do_upload($pic)) {
					$error_message = array('error' => $this->upload->display_errors());
					$flag = FALSE;
					echo "upload failed<br>";
					echo $this->upload->display_errors('<p>', '</p>');
					//break;
				}
				else {
					echo "upload success<br>";
					//$option_path[$i] = $upload_config['upload_path'] + $this->upload->data('file_name');
					array_push($options_path, $upload_config['upload_path'] + $this->upload->data('file_name'));
				}
			}

			// All upload success
			if ($flag == TRUE) {
				$vote_id = $this->Vote_model->add_vote($user_id, $vote_title, $vote_desc, $vote_duetime=0);
				for ($i = 0; $i < $options_count; $i++) {
					$this->Vote_model->add_option($vote_id, $options_title[$i], $options_desc[$i], $options_path[$i]);
				}
			}*/
		}
	}
}
