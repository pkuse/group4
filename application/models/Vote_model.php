<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vote_model extends CI_Model {

	function add_vote ($user_id, $title, $desc, $due_time) {
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

	function add_option($vote_id, $title, $desc, $pic_path) {
		$option_data['VoteID'] = $vote_id;
		$option_data['Title'] = $title;
		$option_data['DescInfo'] = $desc;
		$option_data['Image'] = $pic_path;
		$this->db->insert('VOTE_OPTION', $option_data);
	}

	function get_all_votes() {
		$query = $this->db->query("SELECT * FROM VOTE_INFO ORDER BY CreateTime DESC");
		return $query->result();
	}

	function get_options($vote_id) {
		$query = $this->db->get_where('VOTE_OPTION', array('VoteID' => $vote_id));
		return $query->result();
	}
	function get($id) {
		$query = $this->db->get_where("VOTE_INFO", array('ID' => $id));
		if ($query->num_rows() == 1)
			return $query->row(0);
		else return NULL;
	}

	function get_followed($user_id) {
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

	function get_voted_record($user_id, $vote_id) {
		$query = $this->db->get_where("VOTE_RECORD", array('UserID' => $user_id, 'VoteID' => $vote_id));
		if ($query->num_rows() == 1)
			return $query->row(0);
		else return NULL;
	}

	function get_voted($user_id) {
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
	function get_published($user_id) {
		$query = $this->db->query("SELECT * FROM VOTE_INFO WHERE OwnerID = $user_id ORDER BY CreateTime DESC");
		return $query->result();
	}

	function get_comments($vote_id) {
		$query = $this->db->query("SELECT * FROM VOTE_RECORD WHERE VoteID = $vote_id AND Comment IS NOT NULL");
		return $query->result();
	}
	function get_participate_num($vote_id) {
		$query = $this->db->query("SELECT * FROM VOTE_RECORD WHERE VoteID = $vote_id");
		return $query->num_rows();
	}

	function get_comment_num($vote_id) {
		$query = $this->db->query("SELECT * FROM VOTE_RECORD WHERE VoteID = $vote_id AND Comment IS NOT NULL");
		return $query->num_rows();
	}

	function get_follow_num($vote_id) {
		$query = $this->db->query("SELECT * FROM VOTE_FOLLOW WHERE VoteID = $vote_id");
		return $query->num_rows();
	}

	function close($user_id, $vote_id) {
		$query = $this->db->query("SELECT * FROM VOTE_INFO WHERE ID = $vote_id AND OwnerID = $user_id");
		if ($query->num_rows() <= 0) {
			return -1;
		}
		else {
			$v = $query->row();
			if ($v->Status == 0) {
				echo "已关闭";
				return -1;
			}

			$vote['Status'] = 0;
			$this->db->update("VOTE_INFO", $vote, array("ID" => $vote_id));
			return 0;
		}
	}

	function get_search($sql) {
		$query = $this->db->query($sql);
		return $query->result();
	}

	function delete_vote($vote_id) {
		$this->db->delete("VOTE_RECORD", array("VoteID" => $vote_id));
		$this->db->delete("VOTE_FOLLOW", array("VoteID" => $vote_id));
		$this->db->delete("VOTE_OPTION", array("VoteID" => $vote_id));
		$this->db->delete("VOTE_INFO", array("ID" => $vote_id));
	}

	function delete_comment($user_id, $vote_id) {
		// 把评论设为NULL
		$query = $this->db->query("SELECT * FROM VOTE_RECORD WHERE UserID = $user_id AND VoteID = $vote_id");
		if ($query->num_rows() != 1) {
			echo "记录不为1";
		}
		else {
			$record["Comment"] = NULL;
			$this->db->update("VOTE_RECORD", $record, array("UserID" => $user_id, "VoteID" => $vote_id));
		}
	}

	function get_all_comments() {
		$query = $this->db->query("SELECT * FROM VOTE_RECORD WHERE Comment IS NOT NULL");
		return $query->result();
	}

}


