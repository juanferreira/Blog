<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Comments extends CI_Controller{
		/**
		 * Add comment to a postID.
		 * @param int $postID postID information.
		 */
		function add_comment($postID){
			// Check if the data has not been submited via POST method.
			if(!$_POST){
				redirect(base_url(),'posts/post/'.$postID);
			}//end if

			// Get user type from the session variable userType.
			$user_type = $this->session->userdata('userType');

			// If no user_type has been set then redirect to the users login.
			if(!$user_type){
				redirect(base_url(),'users/login/');
			}//end if

			// Validate if the captch match the user input. If not display error message.
			if(strtolower($this->session->userdata('captcha')) != strtolower($_POST['captcha'])){
				echo '<p>The captcha code is incorrect.</p>';
				echo "<p>You typed in ".$_POST['captcha']." when the code generated was ".$this->session->userdata('captcha').".</p>";
			}//end if

			// Otherwise add comment into the database.
			else{
				$this->load->model('comment');

				$data = array(
					'postID' => $postID,
					'userID' => $this->session->userdata('userID'),
					'comment' => $_POST['comment']
				);

				// Add comment into the database.
				$this->comment->add_comment($data);

				// Redirect to the given post.
				redirect(base_url(),'posts/post/'.$postID);
			}//end else
		}
	}
?>