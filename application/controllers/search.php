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
	}
	
	public function index()
	{
		if(false)//TODO: IF WE ARE LOGGED IN
        {
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