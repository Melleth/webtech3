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
		$data['owner'] = ($this->session->userdata('user')['id'] == $id);
		$data['profile'] = $this->Profile_model->get_profile($id);
		$data['copyright'] = 'By Victor And Siemen';
		$data['title'] = "Viewing profile";
		$data['loggedin'] = ($this->session->userdata('loggedin') == true);
		// Do profile page form stuff, if we're the owner of the profile we are viewing.
		if ($data['owner']) {
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'nickname', 'email', 'birthday', 'description', 'required');
			if ($this->form_validation->run() === FALSE) {
				// Return to the viewprofile page
				$this->load->view('templates/header', $data);
				$this->load->view('pages/viewprofile', $data);
				$this->load->view('templates/footer', $data);
				return;

			} else {
				$values['id'] = $id;
				foreach ($_POST as $key => $value) {
					$values[$key] = $this->input->post($key);
				}
				$this->Profile_model->update_profile($values);
				$data['profile'] = $this->Profile_model->get_profile($values['id']);
				// Profile updated, review updated changes.
				$this->load->view('templates/header', $data);
				$this->load->view('pages/viewprofile', $data);
				$this->load->view('templates/footer', $data);
				return;
			}
		}
		
		// View the actual profile
		$this->load->view('templates/header', $data);
		$this->load->view('pages/viewprofile', $data);
		$this->load->view('templates/footer', $data);
		return;
	}
}

?>