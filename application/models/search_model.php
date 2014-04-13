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
        $users = $this->db->query("SELECT * FROM profile WHERE id <>".$user['id']);
        $users = $users->result_array();
        foreach ($users as $key => $value) {
        	$score = 0;
        	$factors = preg_split('[-]', $users[$key]['personality']);
        	foreach ($factors as $key => $value) {
        		echo $factors[$key];
        	}
        	
        }
        
        //$query = $this->db->query("");
		//return $query->result_array();
	}
}

?>