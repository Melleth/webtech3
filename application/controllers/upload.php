<?php

class Upload extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $this->load->model('Profile_model');
	}

	public function index()
	{
		if(!$this->session->userdata('loggedin'))
        {
            echo "you need to be logged in to upload a pic!";
            return;
        }
        $data['loggedin'] = true;
        $data['user'] = $this->session->userdata('user');
        $data['title'] = "Profile Picture";
        $data['copyright'] = "By Victor and Siemen";
        $this->load->view('templates/header', $data);
        $this->load->view('pages/uploadpic', $data);
        $this->load->view('templates/footer', $data);
	}

	public function do_upload()
	{
		$config['upload_path'] = APPPATH . '../uploads';
		$config['allowed_types'] = 'jpg|png';
		$config['max_size']	= '500';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
        $config['overwrite'] = false;
        
        $data['loggedin'] = true;
        $data['user'] = $this->session->userdata('user');

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('profilepic'))
		{
			$error = array('error' => $this->upload->display_errors());
            $data['title'] = "Profile Picture";
            $data['copyright'] = "By Victor and Siemen";
			$this->load->view('templates/header', $data);
            $this->load->view('pages/uploadpic', $error);
            $this->load->view('templates/footer', $data);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
            $user = $this->session->userdata('user');
            $this->Profile_model->set_profile_picture_path($user['id'], $data['upload_data']['file_name']);
            $user['profile_pic'] = $data['upload_data']['file_name'];
            $this->session->set_userdata('user', $user);
			$this->output->set_header('refresh:0;url='.base_url().'index.php/Homepage/view/'.$user['id']);
		}
	}
    
    public function removeProfilePic()
    {
        $data['title'] = "Profile Picture";
        $data['copyright'] = "By Victor and Siemen";
        $data['loggedin'] = true;
        $data['user'] = $this->session->userdata('user');
        $user = $this->session->userdata('user');
        $this->Profile_model->set_profile_picture_path($user['id'], '');
        $this->output->set_header('refresh:0;url='.base_url().'index.php/Homepage/view/self');
    }
}
