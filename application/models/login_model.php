<?php

class Login_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_user_from_login($email, $password)
	{
        $this->db->select('*')->from('profile')->where(array('email' => $email, 'password' => $password));
        $query = $this->db->get();
		return $query->result_array();
	}
}

?>