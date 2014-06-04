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
        // We need to query the database for a set of profiles that match the clients prefferences
        // First we check for gender prefference.
        if ($gender == 2) {
        	// If the client is a bisexual we need to modify the query a bit
        	$gender = "0 OR gender = 1";
        }
        // If the client is just interested in 1 gender, we can leave it be.
        $query = $this->db->query("SELECT * FROM profile WHERE gender = " . $gender . ""); //TODO: verwerk gender en age hier (rekening houden met gender kan beide zijn)
        foreach($query->result() as $row) {
        	foreach ($row as $result) {
        		echo $result.'<br>';
        	}
        }
        $users = $query->result_array();
        // Create datastructure for our own personality
        $splittedPersonality = preg_split("/-/", $personality);
        $personalityData = [];
        foreach ($splittedPersonality as $key => $value) {
        	$dichotomy = $value[0];
        	$score = substr($value, 1, strlen($value)-1);
        	$personalityData[$dichotomy] = $score;
        }
        print_r($personalityData);
        echo '<br>'.$minage;
        echo '<br>'.$maxage;
        

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