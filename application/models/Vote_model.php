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
		$query = $this->db->query("SELECT * FROM VOTE_INFO");
		return $query->result();
	}

	public function get_options($vote_id) {
		$query = $this->db->get_where('VOTE_OPTION', array('VoteID' => $vote_id));
		return $query->result();
	}
}


