<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Auth extends Controller
{
	private $findAll;
	
	public function index()
	{
		//
	}

// 	function __construct()
//     {
//         parent::__construct();


// // Load required CI libraries and helpers.
//         $this->load->database();
//         $this->load->library("session");
//         $this->load->helper('url');
//         $this->load->helper('form');

//         $this->load->library(array('ion_auth', 'form_validation'));
//         $this->load->helper(array('url', 'language'));

//         $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

// 		$this->lang->load('auth');
		
// 	}
	public function login(){

		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('password', 'password', 'required|validate_user[email, password]');
		
		if ($this->form_validation->run() == FALSE)
		{
			echo json_encode(array("validation_error" => $this->form_validation->error_array()));
		} else
		{
	
		$email = $this->input->post("email");
		$password = $this->input->post("password");
		$this->load->model('auth');
		$validate_user =$this->auth->validateUser($email, $password);
		if(validate_user>0){
			echo('User is successfully logged in');
		}else{

			echo('The email or password entered is incorrect');	
			echo json_encode(array("error" => "The OTP supplied is Invalid"));
		}

		
		}

	}
}
?>