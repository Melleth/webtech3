<?php

class Search_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
	
	public function search_matches($genderPref, $minAgePref, $maxAgePref) //TODO: MORE PREFERENCE REQUIREMENTS (SEE ASSIGNMENT)
	{
		//TODO: INSERT MATCHING QUERY HERE
        /*
        
            Matching query staat heel uigebreid toegelicht in de opdracht. De implementatie daarvan gaat hier plaatsvinden.
            Uiteindelijk moet deze functie een array met matches teruggeven. 
            Nu zijn nog niet alle parameters aanwezig! Het persoonlijkheidstype ontbreekt en ook de merken zijn hier nog niet aanwezig.
            Deze zullen uiteindelijk parameters worden van deze functie. 

        */
        
        //$query = $this->db->query("");
		//return $query->result_array();
	}
}

?>