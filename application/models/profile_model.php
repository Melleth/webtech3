<?php

class Profile_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_profiles($num = 6)
	{
		$query = $this->db->get('profile', $num);
		return $query->result_array();
	
	}
	
	public function get_profile($id)
	{
		$this->db->select('*')->from('profile')->where('id', $id);
		$query = $this->db->get();
		$user = $query->row();
		
		$querybrands = $this->db->query("SELECT `name` FROM `brands` WHERE id IN (SELECT `brand_id` FROM `brand_likes` WHERE `id` = '" . $id . "');");		
		$user->brands = $querybrands->result_array();
		
		return $user;
	}
    
    public function set_profile_picture_path($id, $path)
    {
        $this->db->query("UPDATE profile SET profile_pic = '" . $path . "' WHERE id = '".$id."';");
    }

    public function update_profile($values) {
    	$this->db->query("UPDATE profile SET name='".$values['name']."', nickname ='".$values['nickname']."', description='".$values['description']."', email='".$values['email']."', birthdate='".$values['birthdate']."' WHERE id='".$values['id']."'");
    }
}

?>