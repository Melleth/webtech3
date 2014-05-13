<?php

class Login_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_user_from_login($email, $password)
	{
        $this->db->select('*')->from('profile')->where(array('email' => $email, 'password' => md5($password)));
        $query = $this->db->get();
		return $query->result_array();
	}
    
    public function insert_user($nickname, $name, $password, $email, $gender, $birthdate, $profile_pic, $description, $preferences, $pref_age_low, $pref_age_high)
    {
        $this->db->query("INSERT INTO profile VALUES( null, '" . $nickname . "', '" . $name . "', '" . md5($password) . "', '" . $email . "', '" . $gender . "', '" . $birthdate . "', '" . $profile_pic . "', '" . $description . "', '" . $preferences . "', '" . $pref_age_low . "', '" . $pref_age_high . "', \"\", \"\");");
    }
}

?>