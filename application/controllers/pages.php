<?php

class Pages extends CI_Controller 
{
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
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/'.$page, $data);
		$this->load->view('templates/footer', $data);
	}	
}


?>