<?php
	class Vote_model_test extends CI_Controller{
		public function __construct() {
			parent::__construct();
			$this->load->library('unit_test');
			$this->load->model('Vote_model');
		}
		public function test(){
			$this->add_vote_test();
			$this->add_option_test();
			$this->get_all_votes_test();
			$this->get_options_test();
			$this->get_test();
			$this->get_followed_test();
			$this->get_voted_record_test();
			$this->get_voted_test();
			$this->get_published_test();
			$this->get_comments_test();
			$this->get_participate_num_test();
			$this->get_comment_num_test();
			$this->get_follow_num_test();
			$this->close_test();
			echo $this->unit->report();
		}
		public function add_vote_test(){

		}
		public function add_option_test(){

		}
		public function get_all_votes_test(){
			$this->unit->run($this->Vote_model->get_all_votes(), 'is_array', "test is get_all_votes", "");
		}
		public function get_options_test(){
			$this->unit->run($this->Vote_model->get(0), NULL, "test is get_options", "id is in db");
		}
		public function get_test(){
			$this->unit->run($this->Vote_model->get(0), NULL, "test is get", "vote id is not in db");
			$this->unit->run($this->Vote_model->get(9), 'is_object', "test is get", "vote id is in db");
		}
		public function get_followed_test(){
			$this->unit->run($this->Vote_model->get_followed(0), 'is_array', "test is get_followed", "id is not in db");
			$this->unit->run($this->Vote_model->get_followed(1), 'is_array', "test is get_followed", "id is in db");
		}
		public function get_voted_record_test(){
			$this->unit->run( $this->Vote_model->get_voted_record(0, 0), NULL, 'test is get_voted_record', 'When user id and vote id neither is in the db');
			$this->unit->run( $this->Vote_model->get_voted_record(1, 0), NULL, 'test is get_voted_record', 'When user id is in db and vote not');
			$this->unit->run( $this->Vote_model->get_voted_record(0, 9), NULL, 'test is get_voted_record', 'When user id is not in db and vote is');
			$this->unit->run( $this->Vote_model->get_voted_record(1, 9), 'is_object', 'test is get_voted_record', 'When user id and vote id is both in the db');
		}
		public function get_voted_test(){
			$this->unit->run($this->Vote_model->get_voted(0), 'is_array', "test is get_voted", "id is not in db");
			$this->unit->run($this->Vote_model->get_voted(9), 'is_array', "test is get_voted", "id is in db");
		}
		public function get_published_test(){
			$this->unit->run($this->Vote_model->get_published(0), NULL, "test is get_publishe", "vote id is not in db");
			$this->unit->run($this->Vote_model->get_published(9), 'is_array', "test is get_publishe", "vote id is in db");

		}
		public function get_comments_test(){
			$this->unit->run($this->Vote_model->get_comments(0), NULL, "test is get_comments", "vote id is not in db");
			$this->unit->run($this->Vote_model->get_comments(9), 'is_array', "test is get_comments", "vote id is in db");

		}
		public function get_participate_num_test(){
			$this->unit->run($this->Vote_model->get_participate_num(0), NULL, "test is get_participate_num", "vote id is not in db");
			$this->unit->run($this->Vote_model->get_participate_num(9), '1', "test is get_participate_num", "vote id is in db");

		}
		public function get_comment_num_test(){
			$this->unit->run($this->Vote_model->get_comment_num(0), NULL, "test is get_comment_num", "vote id is not in db");
			$this->unit->run($this->Vote_model->get_comment_num(9), '1', "test is get_comment_num", "vote id is in db");

		}
		public function get_follow_num_test(){
			$this->unit->run($this->Vote_model->get_follow_num(0), NULL, "test is get_follow_num", "vote id is not in db");
			$this->unit->run($this->Vote_model->get_follow_num(9), '0', "test is get_follow_num", "vote id is in db");

		}
		public function close_test(){
			$this->unit->run( $this->Vote_model->close(0, 0), '-1', 'test is close_test', 'When user id and vote id neither is in the db');
			$this->unit->run( $this->Vote_model->close(1, 0), '-1', 'test is close_test', 'When user id is in db and vote not');
			$this->unit->run( $this->Vote_model->close(0, 9), '-1', 'test is close_test', 'When user id is not in db and vote is');
			$this->unit->run( $this->Vote_model->close(9, 1), '-1', 'test is close_test', 'When user id and vote id is both in the db but is closed');
		}
	}
?>