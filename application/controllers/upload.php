<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Upload extends CI_Controller{
		/**
		 * Upload constructor used to load form helper upon instantiating this class.
		 */
		function __construct(){
			parent::__construct();
			$this->load->helper('form');
		}//end constructor

		/**
		 * Index controller.
		 */
		function index(){
			// Load header, upload_form, and footer views.
			$this->load->view('header');
			$this->load->view('upload_form',array('error' => ''));
			$this->load->view('footer');
		}//end index

		/**
		 * Perform upload.
		 */
		function do_upload(){
			// Upload configuration.
			$config['upload_path'] = './uploads';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '100';
			$config['max_width'] = '1024';
			$config['max_height'] = '768';

			// Load upload library and pass in configuration.
			$this->load->library('upload',$config);

			// If there's been an error with the upload then display the error.
			if(!$this->upload->do_upload('file_upload')){
				$error = array('error' => $this->upload->display_errors());

				// Load new header, upload_form, and footer views with error message displayed.
				$this->load->view('header');
				$this->load->view('upload_form', $error);
				$this->load->view('footer');
			}//end if

			// Else store the uploaded data and resize the image.
			else{
				$data = array('upload_data' => $this->upload->data());

				// Resize the uploaded file.
				$this->resize($data['upload_data']['full_path'], $data['upload_data']['file_name']);

				// Load the header, upload_success, and footer views.
				$this->load->view('header');
				$this->load->view('upload_success', $data);
				$this->load->view('footer');
			}//end else
		}//end do_upload

		/**
		 * Resizes and image.
		 * @param  string $path path to a file.
		 * @param  string $file name of a file.
		 */
		function resize($path, $file){
			// Image configuration.
			$config['image_library'] = 'gd2';
			$config['source_image'] = $path;
			$config['create_thumb'] = true;
			$config['maintain_ratio'] = true;
			$config['width'] = 150;
			$config['height'] = 75;
			$config['new_image'] = './uploads/'.$file;

			// Load image library and resize the image based on the configuration.
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
		}//end resize
	}//end Upload
?>