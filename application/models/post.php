<?php
	/**
	 *  Post class used to perform CRUD on post based on user interaction.
	 */
	class Post extends CI_Model{
		/**
		 * Retrieves posts based on parameters.
		 * @param  integer $num   the number of post to retrieve
		 * @param  integer $start starting index
		 * @return array        post information
		 */
		function get_posts($num=20,$start=0){
			//$sql = "SELECT * FROM posts WHERE active=1 ORDER BY date_added DESC LIMIT 0,20;";
			$this->db->select()->from('posts')->where('active',1)->order_by('date_added','desc')->limit($num, $start);
			$query = $this->db->get();
			return $query->result_array();
		}//end get_posts

		/**
		 * Retrieves the total number of post in the database.
		 * @return int number of rows / post
		 */
		function get_posts_count(){
			$this->db->select('postID')->from('posts')->where('active',1);
			$query = $this->db->get();
			return $query->num_rows();
		}//end get_posts_count

		/**
		 * Retrieves a post based on the postID
		 * @param  int $postID postID
		 * @return array         post array
		 */
		function get_post($postID){
			$this->db->select()->from('posts')->where(array('postID' => $postID, 'active' => 1))->order_by('date_added','desc');
			$query = $this->db->get();
			return $query->first_row('array');
		}//end get_post

		/**
		 * Insert a new post into the database.
		 * @param  array $data post data to store into the database.
		 * @return int       returns postID
		 */
		function insert_post($data){
			$this->db->insert('posts',$data);
			return $this->db->insert_id();
		}//end insert_post

		/**
		 * Updates an existing post.
		 * @param  int $postID postID information
		 * @param  array $data   post array data
		 */
		function update_post($postID, $data){
			$this->db->where('postID', $postID);
			$this->db->update('posts',$data);
		}//end update_post

		/**
		 * Deletes a post from the database.
		 * @param  int $postID postID information
		 */
		function delete_post($postID){
			$this->db->where('postID',$postID);
			$this->db->delete('posts');
		}//end delete_post

		/**
		 * Retreives all active post.
		 * @return array post array data
		 */
		function query(){
			$sql = "SELECT * FROM posts WHERE active=1 ORDER BY date_added DESC LIMIT 0,20";
			$query = $this->db->query($sql);
			return $query->result_array();
		}//end query
	}
?>