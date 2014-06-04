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
        // Remove incompatible birthdates.
        $validAges = [];
        foreach($query->result_array() as $row) {
        	
			$c= date('Y-M-D');
			$y= date('Y-M-D', strtotime($row['birthdate']));
			$row['age'] = $c-$y -1;
			if ($row['age'] >= $minage && $row['age']<=$maxage) {
				$row["score"] = 0;
				array_push($validAges, $row);
			}
        }
        //$users = $query->result_array();
        // Create datastructure for our own personality
        $splittedPersonality = preg_split("/-/", $personality);
        $personalityData = [];
        foreach ($splittedPersonality as $key => $value) {
        	$dichotomy = $value[0];
        	$score = substr($value, 1, strlen($value)-1);
        	$personalityData[$dichotomy] = $score;
        }
        unset($dichotomy); unset($score);
        // Calculate scores of personality
        foreach ($validAges as $profile) {
        	$split = explode("-", $profile["personality"]);
        	if (count($split) > 1) {
	        	$psData = [];
	        	foreach ($split as $type) {
	    			$dichotomy = $type[0];
	        		$score = substr($type, 1, strlen($type)-1);
	        		$psData[$dichotomy] = $score;
	        	}
	        	$personalityScore  = 0;
	        	$userTypes = array_keys($personalityData);
	        	$candidateTypes = array_keys($psData);
				$numerator = 0;
				for ($i = 0; $i<4; $i++) {
					if ($userTypes[$i] == $candidateTypes[$i]) {
						// No conversion needed.
						echo "numerator: ". $numerator;
						$numerator += ($personalityData[$i] - $psData[$i]);
					} else {
						// Conversion needed.
						echo "numerator: ". $numerator;
						$numerator += $personalityData[$i] - (100 - $psData[$i]);
					}
				}
				echo "personality normalisation result: ".$numerator/"400"."<br>";
			}
        }

        print_r($validAges);
        print_r($personalityData);
        echo '<br>'.$minage;
        echo '<br>'.$maxage;
        

        return $validAges;
        //$query = $this->db->query("");
		//return $query->result_array();
	}

	public function DicesCoefficient($itemset1, $itemset2)
    {
        $intersect = array_intersect($itemset1, $itemset2);
        return ((2 * count($intersect)) / (count($itemset1) + count($itemset2)));
    }
    
    public function JaccardsCoefficient($itemset1, $itemset2)
    {
        $intersect = array_intersect($itemset1, $itemset2);
        return (count($intersect) / (count($itemset + $itemset2))); //the + on arrays should be the union, backup check required
    }
    
    public function CosineCoefficient($itemset1, $itemset2)
    {
        $intersect = array_intersect($itemset1, $itemset2);
        return (count($intersect) / (sqrt(count($itemset1)) * sqrt(count($itemset2))));
    }
    
    public function OverlapCoefficient($itemset1, $itemset2)
    {
        $intersect = array_intersect($itemset1, $itemset2);
        return (count($intersect) / min(count($itemset1), count($itemset2)));
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