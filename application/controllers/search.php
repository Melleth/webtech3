<?php

class Search extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Search_model");
		$this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
	}
	
	public function index()
	{
        // Check for logged in status from the session.
        $data['loggedin'] = ($this->session->userdata('loggedin') == true);
        
		if($data['loggedin'])
        {
            // Set the preferred data so we can excecute a search
            $profile_gender_preference = $this->session->userdata('user')['preferences'];
            $profile_min_age_pref = $this->session->userdata('user')['preferredagelow'];
            $profile_max_age_pref = $this->session->userdata('user')['preferredagehigh'];
            //do a search with the profile data
            $data['matches'] = $this->Search_model->search_matches($profile_gender_preference, $profile_min_age_pref, $profile_max_age_pref);
            $this->load->view('pages/searchresults', $data);
        }
        else //we are not logged in.
        {
            //do a search with form data
            $this->viewSearchForm();
        }
	}
	
	public function viewSearchForm()
	{
		$data['copyright'] = 'By Victor And Siemen';
		$data['title'] = "Search for Match";
		
        $this->form_validation->set_rules('ageMin', 'Minimum Age', 'required|is_natural_no_zero|greater_than[18]');
        $this->form_validation->set_rules('ageMax', 'Maximum Age', 'required|is_natural_no_zero|less_than[99]');

        if ($this->form_validation->run() === FALSE)
        {
            //form failed to validate
            $this->load->view('templates/header', $data);
            $this->load->view('pages/searchform', $data);
            $this->load->view('templates/footer', $data);
        }
        else
        {
            //form succesfully validated
            $data['matches'] = $this->Search_model->search_matches($this->input->post('gender'), $this->input->post('ageMin'), $this->input->post('ageMax'));
            $this->load->view('templates/header', $data);
            $this->load->view('pages/searchresults', $data);
            $this->load->view('templates/footer', $data);
        }
	}
}

?>