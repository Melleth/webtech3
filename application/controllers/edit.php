<?php

class Edit extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Brands_model");
        $this->load->model("Profile_model");
		$this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
		$this->load->library('session');
	}
	
    public function index()
    {
        echo "ERROR: You haven't selected what to edit! You should not see this message!";
        $this->output->set_header('refresh:5;url='.base_url().'index.php');
    }
    
    public function brands()
    {
        if(!$this->session->userdata('loggedin') && !$this->session->userdata('searchinprogress'))
        {
            echo "ERROR: You need to be logged in to view this page!";
            $this->output->set_header('refresh:5;url='.base_url().'index.php');
            exit;
        }
        
        $data['title'] = "Edit Brands";
        $data['copyright'] = "By Victor and Siemen";
        $data['loggedin'] = true;
        $data['loggedin'] = $this->session->userdata('loggedin');
		$data['user'] = $this->session->userdata('user');
        
        $user = $this->session->userdata('user');
        
        $this->form_validation->set_rules('confirm', 'Confirmation', 'required'); 
        
        $allbrands = $this->Brands_model->get_brands();
        $data['allbrands'] = $allbrands;
        
        if($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('pages/editbrandsform', $data);
            $this->load->view('templates/footer', $data);
        }
        else
        {
            if(!$this->session->userdata('searchinprogress')) //we are doing a brands edit for a member
            {
                $this->Brands_model->remove_likes($user['id']); //first clear all the likes
                //then add them from the new data
                foreach($allbrands as $brnd)
                {
                    $box = $this->input->post('brandno' . $brnd['id']);
                    if($box == "brands")
                    {
                        $this->Brands_model->like_brand($user['id'], $brnd['id']);
                    }
                }
                $this->output->set_header('refresh:0;url='.base_url().'index.php/homepage/view/' . $user['id']);
            }
            else //we are doing a brands like for non-members
            {
                $brandstring = "";
                foreach($allbrands as $brnd)
                {
                    $box = $this->input->post('brandno' . $brnd['id']);
                    if($box == "brands")
                    {
                        $brandstring .= $brnd['id'] . ",";
                    }
                }
                //remove the last comma
                $brandstring = substr($brandstring, 0, strlen($brandstring)-1); 
                $this->session->set_userdata("searchbrands", $brandstring);
                $this->session->set_userdata("searchcomplete", true);
                $this->output->set_header('refresh:0;url='.base_url().'index.php/search');
            }
        }
    }
    
    public function personality()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
    
        if(!$this->session->userdata('loggedin') && !$this->session->userdata('searchinprogress'))
        {
            echo "you must be logged in!";
            echo "you will be redirected to the homepage";
            $this->output->set_header('refresh:5;url='.base_url().'index.php');
            exit;
        }
        //first check if this personality isn't already tested
        $user = $this->session->userdata('user');
        $data['title'] = "Personality Test";
        $data['copyright'] = "By victor and siemen";
        $data['loggedin'] = $this->session->userdata('loggedin');
		$data['user'] = $this->session->userdata('user');
        
        if($user['personality'] != "" && !$this->session->userdata('searchinprogress'))
        {
            echo "you are not allowed to do the personality test twice!<br />";
            echo "you will be redirected to your profile";
            $this->output->set_header('refresh:5;url='.base_url().'index.php/homepage/view/self');
            exit;
        }
        
        $this->form_validation->set_rules('Q1', 'Question 1', 'required');
        $this->form_validation->set_rules('Q2', 'Question 2', 'required');
        $this->form_validation->set_rules('Q3', 'Question 3', 'required');
        $this->form_validation->set_rules('Q4', 'Question 4', 'required');
        $this->form_validation->set_rules('Q5', 'Question 5', 'required');
        $this->form_validation->set_rules('Q6', 'Question 6', 'required');
        $this->form_validation->set_rules('Q7', 'Question 7', 'required');
        $this->form_validation->set_rules('Q8', 'Question 8', 'required');
        $this->form_validation->set_rules('Q9', 'Question 9', 'required');
        $this->form_validation->set_rules('Q10', 'Question 10', 'required');
        $this->form_validation->set_rules('Q11', 'Question 11', 'required');
        $this->form_validation->set_rules('Q12', 'Question 12', 'required');
        $this->form_validation->set_rules('Q13', 'Question 13', 'required');
        $this->form_validation->set_rules('Q14', 'Question 14', 'required');
        $this->form_validation->set_rules('Q15', 'Question 15', 'required');
        $this->form_validation->set_rules('Q16', 'Question 16', 'required');
        $this->form_validation->set_rules('Q17', 'Question 17', 'required');
        $this->form_validation->set_rules('Q18', 'Question 18', 'required');
        $this->form_validation->set_rules('Q19', 'Question 19', 'required');
        
        if($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('pages/personalityform', $data);
            $this->load->view('templates/footer', $data);
        }
        else
        {
            $e = 50;
            $i = 50;
            $n = 50;
            $s = 50;
            $t = 50;
            $f = 50;
            $j = 50;
            $p = 50;
            
            //E and I
            if($this->input->post('Q1') == "A") { $e+=10; $i-=10; }
            if($this->input->post('Q2') == "A") { $e+=10; $i-=10; }
            if($this->input->post('Q3') == "A") { $e+=10; $i-=10; }
            if($this->input->post('Q4') == "A") { $e+=10; $i-=10; }
            if($this->input->post('Q5') == "A") { $e+=10; $i-=10; }
            if($this->input->post('Q1') == "B") { $i+=10; $e-=10; }
            if($this->input->post('Q2') == "B") { $i+=10; $e-=10; }
            if($this->input->post('Q3') == "B") { $i+=10; $e-=10; }
            if($this->input->post('Q4') == "B") { $i+=10; $e-=10; }
            if($this->input->post('Q5') == "B") { $i+=10; $e-=10; }
            
            //N and S
            if($this->input->post('Q6') == "A") { $n+=12.5; $s-=12.5; }
            if($this->input->post('Q7') == "A") { $n+=12.5; $s-=12.5; }
            if($this->input->post('Q8') == "A") { $n+=12.5; $s-=12.5; }
            if($this->input->post('Q9') == "A") { $n+=12.5; $s-=12.5; }
            if($this->input->post('Q6') == "B") { $s+=12.5; $n-=12.5; }
            if($this->input->post('Q7') == "B") { $s+=12.5; $n-=12.5; }
            if($this->input->post('Q8') == "B") { $s+=12.5; $n-=12.5; }
            if($this->input->post('Q9') == "B") { $s+=12.5; $n-=12.5; }
            
            //T and F
            if($this->input->post('Q10') == "A") { $t+=12.5; $f-=12.5; }
            if($this->input->post('Q11') == "A") { $t+=12.5; $f-=12.5; }
            if($this->input->post('Q12') == "A") { $t+=12.5; $f-=12.5; }
            if($this->input->post('Q13') == "A") { $t+=12.5; $f-=12.5; }
            if($this->input->post('Q10') == "B") { $f+=12.5; $t-=12.5; }
            if($this->input->post('Q11') == "B") { $f+=12.5; $t-=12.5; }
            if($this->input->post('Q12') == "B") { $f+=12.5; $t-=12.5; }
            if($this->input->post('Q13') == "B") { $f+=12.5; $t-=12.5; }
            
            //J and P
            if($this->input->post('Q14') == "A") { $j+=8.333; $p-=8.333; }
            if($this->input->post('Q15') == "A") { $j+=8.333; $p-=8.333; }
            if($this->input->post('Q16') == "A") { $j+=8.333; $p-=8.333; }
            if($this->input->post('Q17') == "A") { $j+=8.333; $p-=8.333; }
            if($this->input->post('Q18') == "A") { $j+=8.333; $p-=8.333; }
            if($this->input->post('Q19') == "A") { $j+=8.333; $p-=8.333; }
            if($this->input->post('Q14') == "B") { $p+=8.333; $j-=8.333; }
            if($this->input->post('Q15') == "B") { $p+=8.333; $j-=8.333; }
            if($this->input->post('Q16') == "B") { $p+=8.333; $j-=8.333; }
            if($this->input->post('Q17') == "B") { $p+=8.333; $j-=8.333; }
            if($this->input->post('Q18') == "B") { $p+=8.333; $j-=8.333; }
            if($this->input->post('Q19') == "B") { $p+=8.333; $j-=8.333; }
            
            $ei = max($e, $i);
            $ns = max($n, $s);
            $tf = max($t, $f);
            $jp = max($j, $p);
            
            $resultstring = "";
            $partnerstring = "";
            if($ei == $e && $e!=$i) {
                $resultstring .= "E" . $e;
                $partnerstring .= "I" . $e;
            }
            if($ei == $i && $e!=$i) {
                $resultstring .= "I" . $i;
                $partnerstring .= "E" . $i;
            }
            if ($e == $i) {
                $resultstring .= "E" . $e;
                $partnerstring .= "I" . $i;
            }
            $resultstring .= "-";
            $partnerstring .= "-";
            if($ns == $n && $n != $s) {
                $resultstring .= "N" . $n; 
                $partnerstring .= "S" . $n;
            }
            if($ns == $s && $n != $s) {
                $resultstring .= "S" . $s; 
                $partnerstring .= "N" . $s;
            }
            if ($s == $n) {
                $resultstring .= "N" . $n; 
                $partnerstring .= "S" . $n;
            }
            $resultstring .= "-";
            $partnerstring .= "-";
            if($tf == $t && $t != $f) {
                $resultstring .= "T" . $t; 
                $partnerstring .= "F" . $t;
            }
            if($tf == $f && $t != $f) {
                $resultstring .= "F" . $f; 
                $partnerstring .= "T" . $f;
            }
            if ($t == $f) {
                $resultstring .= "F" . $f; 
                $partnerstring .= "T" . $f;
            }
            $resultstring .= "-";
            $partnerstring .= "-";
            if($jp == $j && $j != $p) {
                $resultstring .= "J" . $j;
                $partnerstring .= "P" . $j;
            }
            if($jp == $p && $j != $p) {
                $resultstring .= "P" . $p; 
                $partnerstring .= "J" . $p;
            }
            if ($j == $p) {
                $resultstring .= "J" . $j;
                $partnerstring .= "P" . $j;
            }
            
            
            if(!$this->session->userdata('searchinprogress')) //we are doing the test for a user
            {
                $this->Profile_model->set_personality($user['id'], $resultstring, $partnerstring);

                // Check if the user has their brands set.
                if (count($this->Profile_model->get_profile($user["id"])->brands) == 0) {
                    $this->output->set_header('refresh:0;url='.base_url().'index.php/edit/brands');
                } else {
                    $this->output->set_header('refresh:0;url='.base_url().'index.php/homepage/view/self');    
                }
            }
            else //we are doing the test for a non-member match-search 
            {
                $this->session->set_userdata('searchpersonality', $partnerstring);
                $this->output->set_header('refresh:0;url='.base_url().'index.php/edit/brands');
            }
        }
        
    }
}
    
?>