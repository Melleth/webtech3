<?php

class Edit extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Brands_model");
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
        if(!$this->session->userdata('loggedin'))
        {
            echo "ERROR: You need to be logged in to view this page!";
            $this->output->set_header('refresh:5;url='.base_url().'index.php');
            exit;
        }
        
        $data['title'] = "Edit Brands";
        $data['copyright'] = "By Victor and Siemen";
        $data['loggedin'] = true;
        
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
    }
}
    
?>