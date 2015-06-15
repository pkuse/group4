<?php
	class User_model_test extends CI_Controller{
		public function __construct() {
			parent::__construct();
			$this->load->library('unit_test');
			$this->load->model('User_model');
		}
		public function test(){
			$this->auten_test();
			$this->add_test();
			$this->get_test();
			$this->update_profile_test();
			$this->is_participated_test();
			$this->is_participated_test();
			$this->is_followed_test();
			$this->vote_test();
			$this->follow_vote_test();
			echo $this->unit->report();
		}
		public function auten_test(){

		}
		public function add_test(){

		}
		public function get_test(){
			$this->unit->run( $this->User_model->get(0), NULL, 'test get by Id', 'When id is not in the db');
			$this->unit->run( $this->User_model->get(1), 'is_object', 'test get by Id', 'When id is in the db');
		}
		public function update_profile_test(){
			$this->unit->run( $this->User_model->update_profile(0), '-1', 'test update profile', 'When id is not in the db');
			//$this->unit->run( $this->User_model->get(1), 'is_object', 'test get by Id', 'When id is in the db');
		}
		public function update_avatar_test(){
			$this->unit->run( $this->User_model->update_avatar(0), '-1', 'test update avatar', 'When id is not in the db');
		}
		public function is_participated_test(){
			$this->unit->run( $this->User_model->is_participated(0, 0), '0', 'test is is_participated', 'When user id and vote id neither is in the db');
			$this->unit->run( $this->User_model->is_participated(1, 0), '0', 'test is is_participated', 'When user id is in db and vote not');
			$this->unit->run( $this->User_model->is_participated(0, 9), '0', 'test is is_participated', 'When user id is not in db and vote is');
			$this->unit->run( $this->User_model->is_participated(1, 9), '1', 'test is is_participated', 'When user id and vote id is both in the db');
		}
		public function is_followed_test(){
			$this->unit->run( $this->User_model->is_followed(0, 0), '0', 'test is is_followed', 'When user id and vote id neither is in the db');
			$this->unit->run( $this->User_model->is_followed(1, 0), '0', 'test is is_followed', 'When user id is in db and vote not');
			$this->unit->run( $this->User_model->is_followed(0, 15), '0', 'test is is_followed', 'When user id is not in db and vote is');
			$this->unit->run( $this->User_model->is_followed(1, 15), '1', 'test is is_followed', 'When user id and vote id is both in the db');
		}
		public function vote_test(){
			$this->unit->run( $this->User_model->vote(1, 0, 5, ""), '-1', 'test is vote', 'When user id and vote id neither is in the db');
			$this->unit->run( $this->User_model->vote(0, 9, 5, ""), '-1', 'test is vote', 'When user id is in db and vote not');
			$this->unit->run( $this->User_model->vote(1, 9, 0, ""), '-1', 'test is vote', 'When user id is not in db and vote is');
			$this->unit->run( $this->User_model->vote(0, 0, 5, ""), '-1', 'test is vote', 'When user id and vote id is both in the db but option_id is illegle');
			$this->unit->run( $this->User_model->vote(0, 9, 0, ""), '-1', 'test is vote', 'When user id and vote id is both in the db and option_id is in db');
			$this->unit->run( $this->User_model->vote(1, 0, 0, ""), '-1', 'test is vote', 'When user id and vote id is both in the db and option_id is in db');
			//$this->unit->run( $this->User_model->vote(1, 9, 5, ""), '-1', 'test is vote', 'comment not null');
		}
		public function follow_vote_test(){

		}
	}
 ?>