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
		$options_pic = $this->input->post('vote_options_pic');

		$options_count = count($options_desc);
		echo $options_count;
		if ($options_count < 2) {
			redirect('');
		}
		else {
			$upload_config = array(
				'upload_path' => '/img/vote_pictures/',
				'allowed_type' => 'gif|jpg|png',
				'max_size' => '2048'
			);

			$this->load->library('upload', $upload_config);

			$options_path = array();

			$flag = TRUE;

			// Upload pictures
			for ($i = 0; $i < $options_count; $i++) {
				echo $i;
				if (!$this->upload->do_upload($options_pic[$i])) {
					$error_message = array('error' => $this->upload->display_errors());
					$flag = FALSE;
					echo "Ha";
					echo $error_message['error'];
					//break;
				}
				else {
					$options_path[$i] = $upload_config['upload_path'] + $this->upload->data('file_name');
				}
			}

			// All upload success
			if ($flag == TRUE) {
				$vote_id = $this->Vote_model->add_vote($user_id, $vote_title, $vote_desc, $vote_duetime);
				for ($i = 0; $i < $options_count; $i++) {
					$this->Vote_model->add_option($vote_id, $options_title[$i], $options_desc[$i], $options_path[$i]);
				}
			}
		}
	}
}

