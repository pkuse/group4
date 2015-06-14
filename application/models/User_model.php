<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	public function authen() {
		$this->db->where('Name', $this->input->post('Name'));
		$this->db->where('Pwd', md5($this->input->post('Pwd')));
		$q = $this->db->get('USER_INFO');
		if ($q->num_rows() > 0){
			if ($q->num_rows() > 1){
				return -1;
			}
			$user = $q->row(0);
			return $user->ID;
		} else {
			echo '登陆失败';
			return -1;
		}
	}
	public function add(){
		$data['Email'] = $this->input->post('Email');
		$data['Name'] = $this->input->post('Name');
		$data['Pwd'] = $this->input->post('Pwd');
		$data['Info'] = "该用户比较懒，什么都没有留下。";
		$data['Avatar'] = "/img/defaultavatar.png";
		$PwdConfirm = $this->input->post('PwdConfirm');
		if ($data['Pwd'] != $PwdConfirm){
			echo '两次密码不一致';
		} else {
			$data['Pwd'] = md5($PwdConfirm);
			$this->db->insert('USER_INFO', $data);
			echo '创建成功';
		}
	}
	function get($userid){
		$this->db->where('ID', $userid);
		$q = $this->db->get('USER_INFO');
		if ($q->num_rows() == 1){
			return $q->row(0);
		} else return NULL;
	}

	function update_profile($user_id) {
		$query = $this->db->get_where("USER_INFO", array("ID" => $user_id));
		if ($query->num_rows() <= 0) {
			echo "没有该用户";
			echo "<br/>";
			return -1;
		}
		$user['Name'] = $this->input->post("user_name");
		$user['Email'] = $this->input->post("user_email");
		$user['Info'] = $this->input->post("user_desc");
		$this->db->update("USER_INFO", $user, array("ID" => $user_id));
	}
	function update_avatar($user_id, $path) {
		$query = $this->db->get_where("USER_INFO", array("ID" => $user_id));
		if ($query->num_rows() <= 0) {
			echo "没有该用户";
			echo "<br/>";
			return -1;
		}
		$user['Avatar'] = $path;
		$this->db->update("USER_INFO", $user, array("ID" => $user_id));
	}


	function is_participated($user_id, $vote_id) {
		$record_query = $this->db->query("SELECT * FROM VOTE_RECORD WHERE UserID = $user_id AND VoteID = $vote_id");
		if ($record_query->num_rows() <= 0) 
			return 0;
		else 
			return 1;
	}
	function is_followed($user_id, $vote_id) {
		$follow_query = $this->db->get_where("VOTE_FOLLOW", array("UserID" => $user_id, "VoteID" => $vote_id));
		if ($follow_query->num_rows() <= 0) 
			return 0;
		else 
			return 1;
	}

	function vote($user_id, $vote_id, $option_id, $comment) {
		if ($this->is_participated($user_id, $vote_id) == 1) {
			echo "已经参与过投票";
			echo "<br/>";
			return -1;
		}
		$option_query = $this->db->query("SELECT * FROM VOTE_OPTION WHERE ID = $option_id AND VoteID = $vote_id");
		if ($option_query->num_rows() <= 0) {
			echo "没有该选项";
			echo "<br/>";
			return -1;
		}
		$record["UserID"] = $user_id;
		$record["VoteID"] = $vote_id;
		$record["OptionID"] = $option_id;
		if (!empty($comment)) {
			$record["Comment"] = $comment;
		}
		$this->db->insert("VOTE_RECORD", $record);
		$option_row = $option_query->row();
		$option["Support"] = $option_row->Support + 1;
		$this->db->update("VOTE_OPTION", $option, array("ID" => $option_id));
		return 0;
	}

	function follow_vote($user_id, $vote_id) {
		if ($this->is_followed($user_id, $vote_id) == 1) {
			$this->db->delete("VOTE_FOLLOW", array("UserID" => $user_id, "VoteID" => $vote_id));
			echo "取消关注";
		}
		else {
			$data["UserID"] = $user_id;
			$data["VoteID"] = $vote_id;
			$this->db->insert("VOTE_FOLLOW", $data);
			echo "关注";
		}
	}

}
