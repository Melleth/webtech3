<?php

class Search_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
	
	public function search_matches($gender, $minage, $maxage, $personality, $brands)
	{
		/* 
            Matching moet hier gebeuren. Alle gegevens zijn beschikbaar als parameters.
        */ 
        //retrieve all user but yourself from the database.
        $query = $this->db->query("SELECT * FROM profile WHERE gender = " . $gender . ""); //TODO: verwerk gender en age hier (rekening houden met gender kan beide zijn)
        $users = $query->result_array();
        // Convert own personality to something we can work with
        $splittedPersonality = preg_split('[-]', $personality);

        foreach ($users as $key => $value) {
        	$score = 0;
        	echo "personality: ". $users[$key]['personality'];
        	$factors = preg_split('[-]', $users[$key]['personality']);
        	foreach ($factors as $key => $value) {
        		if ($factors[$key][0] != $splittedPersonality[$key][0]) {
        			$factors[$key][0] = $this->switch_types($splittedPersonality[$key], $factors[$key]);
        			//
        		}
        	}
        	
        }

        return $users;
        //$query = $this->db->query("");
		//return $query->result_array();
	}

	private function switch_types($userType, $candidateType) {
		if ($userType == "I" && $candidateType == "E")
			return "I";
		if ($userType == "E" && $candidateType == "I")
			return "E";
		if ($userType == "S" && $candidateType == "N")
			return "S";
		if ($userType == "N" && $candidateType == "S") 
			return "N";
		if ($userType == "T" && $candidateType == "F")
			return "T";
		if ($userType == "F" && $candidateType == "T")
			return "F";
		if ($userType == "J" && $candidateType == "P")
			return "J";
		if ($userType == "P" && $candidateType == "J")
			return "P";
	}
}

?>