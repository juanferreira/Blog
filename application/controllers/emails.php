<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Emails extends CI_Controller{
		/**
		 * Email controller.
		 */
		function email(){
			// Load the user model.
			$this->load->model('user');

			// Get all emails from the user database.
			$emails = $this->user->get_emails();

			// Load the email library.
			$this->load->library('email');

			// Configure email mail type and intialize the email.
			$config['mailtype'] = 'html';
			$this->email->initialize($config);

			// Send an email to every user in the database.
			foreach($emails as $email){
				if($email['email']){
					$this->email->from('juan.ferreira83@gmail.com', 'Juan Ferreira');
					$this->email->to($email['email']);
					$this->email->subject('Email test newsletter');
					$this->email->message('Hey this is my first email test! <strong>Bold test</strong>');
					$this->email->send();
					$this->email->clear();
				}//end if
			}//end foreach
		}//end email
	}
?>