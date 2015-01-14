<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Users extends CI_Controller{

		/**
		 * Login controller. Validates if supplied login credentials are correct.
		 */
		function login(){
			$data['error'] = 0; // Set error to 0

			// Check if the data has been submited via POST method.
			if($_POST){
				// Assign POST input to variables.
				$username = $_POST['username'];
				$password = $_POST['password'];
				$user_type = $_POST['user_type'];

				// Load the user model to authenticate login credentials.
				$this->load->model('user');
				$user = $this->user->login($username, $password, $user_type);

				// If no data returned back then set error to 1. Otherwise pass user information into a variable and redirect to the posts controller.
				if(!$user){
					$data['error'] = 1;
				}//end if
				else{
					$this->session->set_userdata('userType', $user['user_type']);
					$this->session->set_userdata('userName', $user['username']);
					$this->session->set_userdata('userID', $user['userID']);
					redirect(base_url(),'posts/');
				}//end else
			}//end if

			// Load header, login, and footer views. Passing in data to the login view.
			$this->load->view('header');
			$this->load->view('login', $data);
			$this->load->view('footer');
		}//end login

		/**
		 * Logout controller. Destroys the current session.
		 */
		function logout(){
			$this->session->sess_destroy();
			redirect(base_url(),'posts/');
		}//end logout

		/**
		 * Register controller. Adds a new user into the database.
		 */
		function register(){
			$data = array();
			
			// Check if the data has been submited via POST method.
			if($_POST){
				// Load form helper.
				$this->load->helper('form');
				
				// Configure the form helper.
				$config = array(
					array(
						'field' => 'username',
						'label' => 'Username',
						'rules' => 'trim|required|min_length[3]|is_unique[users.username]',
						'value' => set_value('username'),
					),
					array(
						'field' => 'password',
						'label' => 'Password',
						'rules' => 'trim|required|min_length[5]|max_length[15]',
					),
					array(
						'field' => 'password2',
						'label' => 'Confirm password',
						'rules' => 'trim|required|min_length[5]|max_length[15]|matches[password]',
					),
					array(
						'field' => 'user_type',
						'label' => 'User type',
						'rules' => 'required',
					),
					array(
						'field' => 'email',
						'label' => 'Email',
						'rules' => 'trim|required|is_unique[users.email]|valid_email',
						'value' => set_value('email'),
					),
				);

				// Validate the form based on form configuration settings. 
				$this->load->library('form_validation');
				$this->form_validation->set_rules($config);

				// If unsuccessful then output the errors.
				if($this->form_validation->run() == false){
					$data['errors'] = validation_errors();
				}//end if

				// Else add new user into the database and redirect to the posts controller.
				else{
					$data = array(
						'username' => $_POST['username'],
						'password' => sha1($_POST['password']),
						'user_type' => $_POST['user_type']
					);

					// Load the user model and create new user.
					$this->load->model('user');
					$this->user->create_user($data);

					// Store a session of the user information.
					$this->session->set_userdata('userType', $_POST['user_type']);
					$this->session->set_userdata('userName', $_POST['username']);

					// Redirect page to the posts controller.
					redirect(base_url(),'posts/');
				}//end else

			}//end if
			
			// Load header, register_user, and footer views. Passing in data to the register_user view.
			$this->load->view('header');
			$this->load->view('register_user',$data);
			$this->load->view('footer');
		}//end register
	}
?>