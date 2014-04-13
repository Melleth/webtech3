<?php

class Homepage extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Profile_model");
		$this->load->helper('url');
		$this->load->library('session');
	}
	
	public function index()
	{
		$this->display(6); //default show 6
	}
	
	public function display($num)
	{
		$data['profiles'] = $this->Profile_model->get_profiles($num);
		$data['copyright'] = 'By Victor And Siemen';
		$data['title'] = "Home";
		$data['session'] = $this->session;
		//Seperate cases for logged in users and lurkers.
		if($this->session->userdata('loggedin')) {
			//TODO: Do logged in stuff.
			//Making mijn profiel.
			$data['loggedin'] = $this->session->userdata('loggedin');

		} else {
			//TODO: Do lurker stuff.	
		}
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/home', $data);
		$this->load->view('templates/footer', $data);
	}
	
	public function view($id)
	{
		$data['profile'] = $this->Profile_model->get_profile($id);
		$data['copyright'] = 'By Victor And Siemen';
		$data['title'] = "Viewing profile";
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/viewprofile', $data);
		$this->load->view('templates/footer', $data);
	}
}

?>