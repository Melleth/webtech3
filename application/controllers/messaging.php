<?php

class Messaging extends CI_Controller 
{
    public function __construct()
	{
		parent::__construct();
        $this->load->model('Messaging_model');
		$this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
	}
    
	public function index()
    {
        $this->overview();
    }
    
    public function checkLogin()
    {
        if(!$this->session->userdata('loggedin'))
        {
            echo "you need to be logged in to view this page.<br />You will be redirected soon.";
            $this->output->set_header('refresh:5;url='.base_url().'index.php/login');
            
        }
    }
    
    public function overview()
    {
        $this->checkLogin();
        
        $user = $this->session->userdata('user');
        $msgs = $this->Messaging_model->getMessagesByUserID($user['id']);
        $data['copyright'] = 'by victor and siemen';
        $data['title'] = "Inbox";
        $data['messages'] = $msgs;
        $this->load->view('templates/header', $data);
        $this->load->view('pages/messaging/inbox', $data);
        $this->load->view('templates/footer', $data);
    }
    
    public function view($id)
    {
        $this->checkLogin();
        $user = $this->session->userdata('user');
        $msgs = $this->Messaging_model->getMessageByID($id, $user['id']);
        $data['copyright'] = 'by victor and siemen';
        $data['title'] = "Read Message";
        $data['messages'] = $msgs;
        $this->load->view('templates/header', $data);
        $this->load->view('pages/messaging/view', $data);
        $this->load->view('templates/footer', $data);
        
    }
    
    public function delete($id)
    {
        //NOTE: UNSAFE: can delete messages from ANY user through URL hacking.
        $this->checkLogin();
        
        $msgs = $this->Messaging_model->deleteMessage($id);
        $this->output->set_header('refresh:0;url='.base_url().'index.php/messaging/');
    }
    
    public function compose()
    {
        $this->checkLogin();
        $data['copyright'] = 'by victor and siemen';
        $data['title'] = "Compose Message";
        
        $this->form_validation->set_rules('submit', 'Send Button', 'required'); 
        $this->form_validation->set_rules('msg_subject', 'Message Subject', 'required');
        $this->form_validation->set_rules('msg_body', 'Message Body', 'required');
        $user = $this->session->userdata('user');
        
        if($this->form_validation->run() === FALSE)
        {
            $possibleDestinations = $this->Messaging_model->getPossibleDestinations($user['id']);
            $data['cansendto'] = $possibleDestinations;
            
            $this->load->view('templates/header', $data);
            $this->load->view('pages/messaging/compose', $data);
            $this->load->view('templates/footer', $data);
        }
        else
        {
            $this->Messaging_model->insertMessage($user['id'], $this->input->post('msg_to'), $this->input->post('msg_subject', TRUE), $this->input->post('msg_body', TRUE));
            echo "Message sent!";
            $this->output->set_header('refresh:2;url='.base_url().'index.php/messaging/');
        }
    }
}

?>