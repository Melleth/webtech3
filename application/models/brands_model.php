<?php

class Brands_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
    
    public function get_brands()
    {
        $query = $this->db->get('brands');
        return $query->result_array();
    }
    
    public function remove_likes($userid)
    {
        $this->db->query("DELETE FROM brand_likes WHERE user_id = '" . $userid . "'");
    }
    
    public function like_brand($userid, $brandid)
    {
        $this->db->query("INSERT INTO brand_likes VALUES (null, '" . $brandid . "', '" . $userid . "')"); 
    }
}

?>