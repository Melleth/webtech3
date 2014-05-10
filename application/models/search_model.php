<?php

class Search_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
	
	public function search_matches($user) //TODO: MORE PREFERENCE REQUIREMENTS (SEE ASSIGNMENT)
	{
		//TODO: INSERT MATCHING QUERY HERE
        /*
        
            Matching query staat heel uigebreid toegelicht in de opdracht. De implementatie daarvan gaat hier plaatsvinden.
            Uiteindelijk moet deze functie een array met matches teruggeven. 
            Nu zijn nog niet alle parameters aanwezig! Het persoonlijkheidstype ontbreekt en ook de merken zijn hier nog niet aanwezig.
            Deze zullen uiteindelijk parameters worden van deze functie. 

        */
        //retrieve all user but yourself from the database.
        $users = $this->db->query("SELECT * FROM profile WHERE id <>".$user->id);
        $users = $users->result_array();
        // Convert own personality to something we can work with
        $splittedPersonality = preg_split('[-]', $user->personality);

        foreach ($users as $key => $value) {
        	$score = 0;
        	echo "personality: ". $users[$key]['personality'];
        	$factors = preg_split('[-]', $users[$key]['personality']);
        	foreach ($factors as $key => $value) {
        		if ($factors[$key][0] != $splittedPersonality[$key][0]) {
        			$factors[$key][0] = switch_types($splittedPersonality[$key], $factors[$key]);
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