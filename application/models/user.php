<?php
	/**
	 * User class used to validate a user, create new user, and retreive details for users.
	 */
	class User extends CI_Model{
		/**
		 * Create a new user in the database.
		 * @param  array $data user data such as username, password, and admin type
		 * @return void    
		 */
		function create_user($data){
			$this->db->insert('users',$data);
		}//end create_user

		/**
		 * Validates login credentials.
		 * @param  string $username username input by user
		 * @param  string $password password input by user
		 * @param  string $type     user type
		 * @return array           data returned from the database. If empty then login not successful.
		 */
		function login($username, $password, $type){
			$data = array(
				'username' => $username,
				'password' => sha1($password),
				'user_type' => $type
			);

			$this->db->select()->from('users')->where($data);
			$query = $this->db->get();
			return $query->first_row('array');
		}//end login

		/**
		 * Returns all email address for every user.
		 * @return array of all user emails.
		 */
		function get_emails(){
			$this->db->select('email')->from('users');
			$query = $this->db->get();
			return $query->result_array();
		}//end get_emails
	}
?>