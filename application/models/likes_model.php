<?php

class Likes_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
        $this->config->load('administration');
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

    public function updatePersonality($id, $me) {
        $query = $this->db->query("SELECT * FROM profile WHERE id ='" . $id . "'");
        $other = $query->row_array();
        
        $myPersonalityPreference = $this->stringToPersonalityArray($me['personality_lookingfor']);
		$otherPersonality = $this->stringToPersonalityArray($other['personality']);
        
        $alpha = $this->config->item('alpha');
        $beta = 1-$alpha;
        
        //echo "current personality preference:<br />";
        //print_r($myPersonalityPreference);
        //echo "<br />other persons personality<br/>";
        //print_r($otherPersonality);
        
    	$userTypes = array_keys($myPersonalityPreference);
    	$candidateTypes = array_keys($otherPersonality);
		for ($i = 0; $i<4; $i++) {
			if ($userTypes[$i] == $candidateTypes[$i]) {
				// No conversion needed.
				$myPersonalityPreference[$userTypes[$i]] = $alpha * $myPersonalityPreference[$userTypes[$i]] + $beta * $otherPersonality[$candidateTypes[$i]];
			} else {
				// Conversion needed.
				$myPersonalityPreference[$userTypes[$i]] = $alpha * $myPersonalityPreference[$userTypes[$i]] + $beta * (100 - $otherPersonality[$candidateTypes[$i]]);
			}
		}
        //echo "<br />new personalitypreference:<br />";
        //print_r($myPersonalityPreference);

        $personalityString = $this->personalityArrayToString($myPersonalityPreference);
        $this->db->query("  UPDATE profile
                            SET personality_lookingfor = '" . $personalityString . "'
                            WHERE id = '" . $me['id'] . "'" );
        //echo "<br /> PersonalityString: <br />" . $personalityString;
        
    }
    
    public function stringToPersonalityArray($string) {
    	$splittedPersonality = preg_split("/-/", $string);
        $personalityData = [];
        foreach ($splittedPersonality as $key => $value) {
        	$dichotomy = $value[0];
        	$score = substr($value, 1, strlen($value)-1);
        	$personalityData[$dichotomy] = $score;
        }
        return $personalityData;
    }
    
    public function personalityArrayToString($array)
    {
        $keys = array_keys($array);
        $result = "";
        for($i = 0; $i < 4; $i++)
        {
            $result .= $keys[$i] . $array[$keys[$i]] . "-";
        }
        $result = substr($result, 0, strlen($result)-1);
        return $result;
    }
}

?>