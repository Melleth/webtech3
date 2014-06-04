<?php

class Search extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Search_model");
        $this->load->model("Profile_model");
		$this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
	}
	
	public function index()
	{
        // Check for logged in status from the session.
        $data['loggedin'] = $this->session->userdata( 'loggedin' );
        
		if($data['loggedin'])
        {
            $data['copyright'] = 'By Victor And Siemen';
            // Set the profile data so we can excecute a search
            // Make sure it is up to date by reloading it from the db (assuming the id is still the same as it shoudl never change).
            $user = $this->Profile_model->get_profile($this->session->userdata('user')['id']);
            // Check if a user has done a personality test
            if (strlen($user->personality) > 2) {
                //do a search with the profile data
                $gender = $user->preferences;
                $minage = $user->preferredagelow;
                $maxage = $user->preferredagehigh;
                $personality = $user->personality_lookingfor;
                $searchbrands = $user->brands;
                
                $data['matches'] = $this->Search_model->search_matches($gender, $minage, $maxage, $personality, $searchbrands);
                $data['user'] = $this->session->userdata('user');
                
                $this->load->view('templates/header.php');
                $this->load->view('pages/searchresults', $data);
                $this->load->view('templates/footer.php');    
            } else {
                // Redirect the user to the personality test.
                $this->output->set_header('refresh:0;url='.base_url().'index.php/edit/personality');
            }
            
            
        }
        else //we are not logged in.
        {
            //we have already collected the data
            if($this->session->userdata('searchcomplete'))
            {
                $gender = $this->session->userdata('searchgender');
                $minage = $this->session->userdata('searchminage');
                $maxage = $this->session->userdata('searchmaxage');
                $personality = $this->session->userdata('searchpersonality');
                $searchbrands = $this->session->userdata('searchbrands');
                
                $data['matches'] = $this->Search_model->search_matches($gender, $minage, $maxage, $personality, $searchbrands);
                $data['loggedin'] = $this->session->userdata('loggedin');
                $data['user'] = $this->session->userdata('user');
                
                $this->session->unset_userdata('searchinprogress');
                $this->session->unset_userdata('searchcomplete');
                $this->session->unset_userdata('searchgender');
                $this->session->unset_userdata('searchmaxage');
                $this->session->unset_userdata('searchminage');
                $this->session->unset_userdata('searchpersonality');
                $this->session->unset_userdata('searchbrands');
                
                $this->load->view('templates/header.php');
                $this->load->view('pages/searchresults', $data);
                $this->load->view('templates/footer.php');    
            }
            else //we have not yet collected data
            {
                //do a search with form data
                $this->viewSearchForm();
            }
        }
	}
	
	public function viewSearchForm()
	{
		$data['copyright'] = 'By Victor And Siemen';
		$data['title'] = "Search for Match";
		$data['loggedin'] = $this->session->userdata('loggedin');
		$data['user'] = $this->session->userdata('user');
        
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
            $this->session->set_userdata('searchinprogress', true);
            $this->session->set_userdata('searchgender', $this->input->post('gender'));
            $this->session->set_userdata('searchminage', $this->input->post('ageMin'));
            $this->session->set_userdata('searchmaxage', $this->input->post('ageMax'));
            //redirect to personality test
            $this->output->set_header('refresh:0;url='.base_url().'index.php/edit/personality');
        }
	}
}

?>