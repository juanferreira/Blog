<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Posts extends CI_Controller{
		
		/**
		 * Post constructor loading the post model.
		 */
		function __construct(){
			parent::__construct();
			$this->load->model('post');
		}//end constructor

		/**
		 * Index controller
		 * @param  integer $start set the start index.
		 */
		function index($start = 0){
			// Set the number of post per page.
			$num_post = 5;

			// Retrieve post from database.
			$data['posts'] = $this->post->get_posts($num_post, $start);

			//Add and configure pagination.
			$this->load->library('pagination');
			$config['base_url'] = base_url().'posts/index/';
			$config['total_rows'] = $this->post->get_posts_count();
			$config['per_page'] = $num_post;
			$this->pagination->initialize($config);
			$data['pages'] = $this->pagination->create_links();

			// Load the header, post_view, and footer views.
			$this->load->view('header');
			$this->load->view('post_view',$data);
			$this->load->view('footer');
		}//end index

		/**
		 * [post description]
		 * @param  [type] $postID [description]
		 * @return [type]         [description]
		 */
		function post($postID){
			// Validates if the user is at least an author. If not redirect back to the posts index page.
			if(!$this->correct_permissions('user')){
				redirect(base_url(),'posts/');
			}//end if

			// Load the comment model.
			$this->load->model('comment');

			// Store both post and comments into the data array.
			$data['post'] = $this->post->get_post($postID);
			$data['comments'] = $this->comment->get_comments($postID);

			// Load captcha helper, configure it and store captcha information into the data array.
			$this->load->helper('captcha');
			$vals = array(
				'img_path' => './captcha/',
				'img_url' => base_url().'/captcha/',
				'img_width' => '150',
				'img_height' => '30'
			);
			$cap = create_captcha($vals);
			$this->session->set_userdata('captcha', $cap['word']);
			$data['captcha'] = $cap['image'];

			// Load the header, post, and footer views passing in the data array.
			$this->load->view('header');
			$this->load->view('post',$data);
			$this->load->view('footer');
		}//end post

		/**
		 * Insert new post controller.
		 */
		function new_post(){
			// Validates if the user is at least an author. If not redirect back to the posts index page.
			if(!$this->correct_permissions('author')){
				redirect(base_url(),'posts/');
			}//end if

			// Check if the data has been submited via POST method.
			if($_POST){
				$data = array(
					'title' => $_POST['title'],
					'post' => $_POST['post'],
					'active' => 1
				);
				
				// Insert post data into the database.
				$this->post->insert_post($data);

				// Redirect back to the index page.
				redirect(base_url(),'posts/');
			}//end if

			else{
				// Load header, new_post, and footer view.
				$this->load->view('header');
				$this->load->view('new_post');
				$this->load->view('footer');
			}//end else

		}//end new_post

		/**
		 * Edit post controller.
		 * @param  int $postID postID information
		 */
		function editpost($postID){
			// Validates if the user is at least an author. If not redirect back to the posts index page.
			if(!$this->correct_permissions('author')){
				redirect(base_url(),'posts/');
			}

			$data['success'] = 0; // Initialize data success to 0

			// Check if the data has been submited via POST method.
			if($_POST){
				$data_post = array(
					'title' => $_POST['title'],
					'post' => $_POST['post'],
					'active' => 1
				);

				// Update post and set data success to 1
				$this->post->update_post($postID,$data_post);
				$data['success'] = 1;
			}//end if
			$data['post'] = $this->post->get_post($postID);

			// Load header, edit_post, and footer views.
			$this->load->view('header');
			$this->load->view('edit_post',$data);
			$this->load->view('footer');
		}//end editpost

		/**
		 * Delete post from the database.
		 * @param  int $postID postID information
		 */
		function deletepost($postID){
			// Validates if the user is at least an author. If not redirect back to the posts index page.
			if(!$this->correct_permissions('admin')){
				redirect(base_url(),'posts/');
			}

			// Remove a post based on the postID from the databse.
			$this->post->delete_post($postID);

			// Redirect to the index posts.
			redirect(base_url(),'posts');
		}//end deletepost

		/**
		 * Checks if user has correct permissions to perform a task.
		 * @param  string $required the required permission to access a page.
		 */
		function correct_permissions($required){
			// Retrieve the user type from a session.
			$user_type = $this->session->userdata('userType');

			// Returns true if user has the required priveldge to access the site. Otherwise returns false.
			if($required == "user"){
				if($user_type){ 
					return true;
				}//end if
			}//end if
			elseif($required == "author"){
				if($user_type == "author" || $user_type == "admin"){
					 return true;
				}//end if
			}//end elseif
			elseif($required == "admin"){
				if($user_type == "admin"){ 
					return true;
				}//end if
			}//end elseif

			return false;
		}//end correct_permissions
	}
?>