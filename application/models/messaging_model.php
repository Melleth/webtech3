<?php

class Messaging_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
        $this->load->helper('string');
	}
	
	public function getMessagesByUserID($id)
	{
        $query = $this->db->query("SELECT m.*, p.name 
                                   FROM messages m
                                   INNER JOIN profile p ON m.from = p.id
                                   WHERE m.to = '" . $id . "'");
		return $query->result_array();
	}
    
    public function deleteMessage($id)
    {
        $this->db->query("DELETE FROM messages WHERE id = '" . $id . "'");
    }
    
    public function getMessageByID($id, $userid)
    {
        //function is safe, you cannot view messages from other users
        $query = $this->db->query("SELECT m.*, p.id, p.name 
                                   FROM messages m
                                   INNER JOIN profile p ON m.from = p.id
                                   WHERE m.id = '" . $id . "'
                                   AND m.to = '" . $userid . "'");
		return $query->result_array();
    }
    
    public function getPossibleDestinations($id)
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
    
    public function insertMessage($fromid, $toid, $subject, $body)
    {
        
        $body = quotes_to_entities($body);
        $body = str_replace("\n", "<br />", $body);
        
        
        $this->db->query("  INSERT INTO messages
                            VALUES (null, '" . $fromid . "', '" . $toid . "', '" . $subject . "', '" . $body . "')");
    }
}

?>