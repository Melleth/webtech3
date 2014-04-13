<?php

class Login extends CI_Controller 
{
    public function __construct()
	{
		parent::__construct();
		$this->load->model("Login_model");
		$this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
	}
    
	public function index()
	{
		if($this->session->userdata('loggedin')) //TODO: is user logged in? --> redirecting them to homepage!
        {
            $data['Title'] = "Logged in!";
            $data['copyright'] = "By Victor and Siemen";
            $data['loggedin'] = true;
            $data['user'] = $this->session->userdata('user');
            $this->load->view('templates/header', $data);
            $this->load->view('pages/afterlogin', $data);
            $this->load->view('templates/footer', $data);
        }
        else
        {
            $this->viewLoginForm();
        }
	}
    
    public function register()
    {
        $data['copyright'] = 'By Victor And Siemen';
		$data['title'] = "Register";
        
        $this->form_validation->set_rules('nickname', 'Nickname', 'required');
        $this->form_validation->set_rules('realname', 'Name', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('description', 'Description', 'required');

        $this->load->view('templates/header', $data);
        
        if ($this->form_validation->run() === FALSE)
        {
            //form failed to validate
            $this->load->view('pages/registerform', $data);
        }
        else
        {
            //form succesfully validated
            $this->Login_model->insert_user($this->input->post('nickname'), $this->input->post('realname'), $this->input->post('password'), $this->input->post('email'), $this->input->post('gender'), $this->input->post('birthday'), "", $this->input->post('description'), $this->input->post('genderpreference'), $this->input->post('ageMin'), $this->input->post('ageMax'));
            $this->session->unset_userdata('loggedin');
            $this->session->unset_userdata('user');
            $this->output->set_header('refresh:0;url='.base_url().'index.php/login');
        }
        $this->load->view('templates/footer', $data);
    }

	public function viewLoginForm()
	{		
		$data['copyright'] = 'By Victor And Siemen';
		$data['title'] = "Member Login";
		$data['loginfailed'] = false;
        $data['loggedin'] = false;
        $this->session->unset_userdata('loggedin');
        $this->session->unset_userdata('user');
        
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            //form failed to validate
            $this->load->view('templates/header', $data);
            $this->load->view('pages/loginform', $data);
            $this->load->view('templates/footer', $data);
        }
        else
        {
            //form succesfully validated
            $users = $this->Login_model->get_user_from_login($this->input->post('email'), $this->input->post('password'));
            
            $this->load->view('templates/header', $data);
            if(count($users) > 0)
            {
                $user = reset($users); //gets the first element
                //properties of this user can now be accessed by user['field'];   
                $this->session->set_userdata('user', $user);
                $this->session->set_userdata('loggedin', true);
                $data['loggedin'] = true;
                $data['user'] = $user;
                $this->load->view('pages/afterlogin', $data);

            }
            else
            {                
                $data['loginfailed'] = true;
                $this->load->view('pages/loginform', $data);
            }
            $this->load->view('templates/footer', $data);
        }
	}
    
    public function logout()
    {
        $this->session->unset_userdata('loggedin');
        $this->session->unset_userdata('user');
        $this->index();
    }
}

?>