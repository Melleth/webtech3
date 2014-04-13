<?php

class Pages extends CI_Controller 
{
	public function __construct() {
		parent::__construct();
		$this->load->library('session');
	}
	public function index()
	{
		$this->view("home");
	}

	public function view($page = "home")
	{
		$this->load->helper('url');
		
		if(!file_exists('application/views/pages/'.$page.'.php'))
		{
			show_404();
		}
		
		$data['title'] = ucfirst($page); //set the title of the page to the title name
		$data['copyright'] = 'By Victor And Siemen';
		//set the logged in data
		if ($this->session->userdata('loggedin')) {
			$data['loggedin'] = true;	
		} else {
			$data['loggedin'] = false;
		}
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/'.$page, $data);
		$this->load->view('templates/footer', $data);
	}	
}


?>