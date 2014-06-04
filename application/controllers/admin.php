<?php

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->config->load('administration');
	}

	public function index()
	{
		$this->showPanel();
	}
    
    public function checkPrivilege()
    {
        if(!$this->session->userdata('loggedin'))
        {
            echo "you need to be logged in to be here";
            $this->output->set_header('refresh:1;url='.base_url().'index.php');
            return;
        }
        $user = $this->session->userdata('user');
        if($user['admin'] < 1)
        {
            echo "you need to be an admin to view this page";
            $this->output->set_header('refresh:1;url='.base_url().'index.php');
        }
    }
    
    public function showPanel()
    {
        $this->checkPrivilege();
        $data['copyright'] = 'by victor and siemen';
        $data['title'] = "Compose Message";
        
        $this->form_validation->set_rules('submit', 'Submit Button', 'required'); 
        $this->form_validation->set_rules('setting_alpha', 'Alpha', 'required|greater_than[0]|less_than[1]'); 
        $this->form_validation->set_rules('setting_simmeasure', 'Similarity', 'required'); 
        $this->form_validation->set_rules('setting_xfactor', 'X-factor', 'required|greater_than[0]|less_than[1]'); 
        
        if($this->form_validation->run() === FALSE)
        {
            $data['alpha'] = $this->config->item('alpha');
            $data['sim_measure'] = $this->config->item('sim_measure');
            $data['xfactor'] = $this->config->item('xfactor');
            $data['done'] = false;
            
            $this->load->view('templates/header', $data);
            $this->load->view('pages/adminpanel', $data);
            $this->load->view('templates/footer', $data);
        }
        else
        {
            $this->config->set_item('alpha', $this->input->post('setting_alpha'));
            $this->config->set_item('sim_measure', $this->input->post('setting_simmeasure'));
            $this->config->set_item('xfactor', $this->input->post('setting_xfactor'));
            
            $data['alpha'] = $this->config->item('alpha');
            $data['sim_measure'] = $this->config->item('sim_measure');
            $data['xfactor'] = $this->config->item('xfactor');
            $data['done'] = TRUE;
            $this->load->view('templates/header', $data);
            $this->load->view('pages/adminpanel', $data);
            $this->load->view('templates/footer', $data);
        }
    }
}
