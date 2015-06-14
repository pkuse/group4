<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vote_model extends CI_Model {

	public function add_vote ($user_id, $title, $desc, $due_time) {
		$vote_data['OwnerID'] = $user_id;
		$vote_data['Title'] = $title;
		$vote_data['DescInfo'] = $desc;
		$vote_data['DueTime'] = $due_time;
		$this->db->insert('VOTE_INFO', $vote_data);
		$query = $this->db->query("SELECT ID FROM VOTE_INFO ORDER BY CreateTime DESC LIMIT 1");
		if ($query->num_rows() > 0) {
			$row = $query->row(0);
			return $row->ID;
		}
		else {

			redirect('/');
		}
	}

	public function add_option($vote_id, $title, $desc, $pic_path) {
		$option_data['VoteID'] = $vote_id;
		$option_title['Title'] = $title;
		$option_data['DescInfo'] = $desc;
		$option_data['Image'] = $pic_path;
		$this->db->insert('VOTE_OPTION', $option_data);
	}

	public function get_all_votes() {
		$query = $this->db->query("SELECT * FROM VOTE_INFO ORDER BY CreateTime DESC");
		return $query->result();
	}

	public function get_options($vote_id) {
		$query = $this->db->get_where('VOTE_OPTION', array('VoteID' => $vote_id));
		return $query->result();
	}
	public function get($id) {
		$query = $this->db->get_where("VOTE_INFO", array('ID' => $id));
		if ($query->num_rows() == 1)
			return $query->row(0);
		else return NULL;
	}

	public function get_followed($user_id) {
		$query = $this->db->query("SELECT * FROM VOTE_FOLLOW WHERE UserID = $user_id ORDER BY FollowTime DESC");
		$votes = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$q = $this->db->get_where("VOTE_INFO", array('ID' => $row->VoteID));
				foreach ($q->result() as $r)
					array_push($votes, $r);
			}
		}
		return $votes;
	}

	public function get_voted_record($user_id, $vote_id) {
		$query = $this->db->get_where("VOTE_RECORD", array('UserID' => $user_id, 'VoteID' => $vote_id));
		if ($query->num_rows() == 1)
			return $query->row(0);
		else return NULL;
	}

	public function get_voted($user_id) {
		$query = $this->db->query("SELECT * FROM VOTE_RECORD WHERE UserID = $user_id ORDER BY CreateTime DESC");
		$votes = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$q = $this->db->get_where("VOTE_INFO", array('ID' => $row->VoteID));
				foreach ($q->result() as $r) 
					array_push($votes, $r);
			}
		}
		return $votes;
	}
	public function get_published($user_id) {
		$query = $this->db->query("SELECT * FROM VOTE_INFO WHERE OwnerID = $user_id ORDER BY CreateTime DESC");
		return $query->result();
	}
}


