<?php

class Likes extends CI_Controller 
{
    public function __construct()
	{
		parent::__construct();
        $this->load->model('Likes_model');
		$this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
	}
    
	public function index()
    {
        $this->received();
    }
    
    public function checkLogin()
    {
        if(!$this->session->userdata('loggedin'))
        {
            echo "you need to be logged in to view this page.<br />You will be redirected soon.";
            $this->output->set_header('refresh:5;url='.base_url().'index.php/login');
            return;
        }
    }
    
    public function like($id)
    {
        $this->checkLogin();
        
        $user = $this->session->userdata('user');
        
        if($this->Likes_model->userLikesUser($user['id'], $id))
        {
            echo "you already like this person";
            $this->output->set_header('refresh:1;url='.base_url().'index.php/homepage/view/' . $id);
            return;
        }
        
        $this->Likes_model->updatePersonality($id, $user);
        
        $this->Likes_model->insertLike($user['id'], $id);
        $this->output->set_header('refresh:0;url='.base_url().'index.php/homepage/view/' . $id);
    }
    
    public function check($liker, $likes)
    {
        echo "a likes b = " . $this->Likes_model->userLikesUser($liker, $likes) . "<br />";
        echo "b likes a = " . $this->Likes_model->userLikesUser($likes, $liker) . "<br />";
        echo "a mutual b =" . $this->Likes_model->mutualLikeCheck($liker, $likes) . "<br />";
        echo "<br />empty space behing the = means false";
    }
    
    public function updateLikeTest($id)
    {
        $user = $this->session->userdata('user');
        $this->Likes_model->updatePersonality($id, $user);   
    }
    
    public function received()
    {
        $this->checkLogin();
        
        $user = $this->session->userdata('user');
        $likes = $this->Likes_model->getReceivedLikesByUserID($user['id']);
        $data['copyright'] = 'by victor and siemen';
        $data['title'] = "Received Likes";
        $data['likes'] = $likes;
        $data['loggedin'] = $this->session->userdata('loggedin');
		$data['user'] = $this->session->userdata('user');
        $this->load->view('templates/header', $data);
        $this->load->view('pages/liking/receivedlikes', $data);
        $this->load->view('templates/footer', $data);
        
    }
    
    public function given()
    {
        $this->checkLogin();
        
        $user = $this->session->userdata('user');
        $likes = $this->Likes_model->getGivenLikesByUserID($user['id']);
        $data['copyright'] = 'by victor and siemen';
        $data['title'] = "Likes";
        $data['likes'] = $likes;
        $data['loggedin'] = $this->session->userdata('loggedin');
		$data['user'] = $this->session->userdata('user');
        $this->load->view('templates/header', $data);
        $this->load->view('pages/liking/givenlikes', $data);
        $this->load->view('templates/footer', $data);
        
    }
    
    public function mutual()
    {
        $this->checkLogin();
        
        $user = $this->session->userdata('user');
        $likes = $this->Likes_model->getMutualLikesByUserID($user['id']);
        $data['copyright'] = 'by victor and siemen';
        $data['title'] = "Likes";
        $data['likes'] = $likes;
        $data['loggedin'] = $this->session->userdata('loggedin');
		$data['user'] = $this->session->userdata('user');
        $this->load->view('templates/header', $data);
        $this->load->view('pages/liking/mutuallikes', $data);
        $this->load->view('templates/footer', $data);
        
    }
}

?>