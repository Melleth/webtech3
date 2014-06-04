<?php

class Likes_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
	
	public function insertLike($liker, $likes)
    {
        $this->db->query("  INSERT INTO likes
                            VALUES (null, '" . $liker . "', '" . $likes . "');");
    }
    
    public function userLikesUser($liker, $likes)
    {
        $query = $this->db->query("SELECT count(*) as num FROM likes WHERE liker = '" . $liker . "' AND likes = '" . $likes . "'");
        $result = $query->row();
        
        return($result->num);
    }
    
    public function mutualLikeCheck($like1, $like2)
    {
        if($this->userLikesUser($like1, $like2) && $this->userLikesUser($like2, $like1))
            return TRUE;
        return FALSE;
    }
    
    public function getReceivedLikesByUserID($id)
    {
        $query = $this->db->query(" SELECT *
                                    FROM profile p
                                    WHERE p.id IN (
                                        SELECT liker 
                                        FROM likes
                                        WHERE likes = '" . $id . "')");
        return $query->result_array();
    }
    
    public function getGivenLikesByUserID($id)
    {
        $query = $this->db->query(" SELECT *
                                    FROM profile p
                                    WHERE p.id IN (
                                        SELECT likes 
                                        FROM likes
                                        WHERE liker = '" . $id . "')");
        return $query->result_array();
    }
    
    public function getMutualLikesByUserID($id)
    {
        $query = $this->db->query(" SELECT *
                                    FROM profile p
                                    WHERE p.id IN (
                                        SELECT likes
                                        FROM likes l
                                        WHERE liker = '" . $id . "')
                                    AND p.id IN (
                                        SELECT liker
                                        FROM likes
                                        WHERE likes = '" . $id . "')");
        return $query->result_array();
    }
}

?>