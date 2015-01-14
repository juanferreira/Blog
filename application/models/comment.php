<?php
	/**
	 * Comment class used to add and retrieve comments from the database.
	 */
	class Comment extends CI_Model{
		/**
		 * Adds a comment to the database.
		 */
		function add_comment($data){
			$this->db->insert('comments', $data);
		}

		/**
		 * Retreives a comment from the database.
		 * @param  int $postID postID information
		 * @return array         comments array data
		 */
		function get_comments($postID){
			$this->db->select('comments.*, users.username')->from('comments')->join('users','users.userID=comments.userID','left')->where('postID',$postID)->order_by('date_added', 'asc');
			$query = $this->db->get();
			return $query->result_array();
		}
	}
?>