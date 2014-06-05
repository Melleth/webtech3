<?php

class Search_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
		$this->config->load('administration');
	}
	
	public function search_matches($genderPreference, $minage, $maxage, $personality, $brands, $me)
	{
		/* 
            Matching moet hier gebeuren. Alle gegevens zijn beschikbaar als parameters.
        */ 
        // We need to query the database for a set of profiles that match the clients prefferences
        // First we check for gender prefference.
        if ($genderPreference == 2) {
        	// If the client is a bisexual we need to modify the query a bit
        	$genderPreference = "0 OR gender = 1";
        }
        // If the client is just interested in 1 gender, we can leave it be.
        $query = $this->db->query("SELECT * FROM profile WHERE gender = " . $genderPreference . ""); //TODO: verwerk gender en age hier (rekening houden met gender kan beide zijn)
        // Put all the potential matches (age and genderPreference included in a new array matches[])
        $matches = [];
        foreach($query->result_array() as $row) {
        	if ($this->isInterestedInMe($me, $row) && $this->isInterestedInMe($row, $me)) {
        		array_push($matches, $row);
        	}
        }
        //$users = $query->result_array();
        /* OLD STUFF THAT WORKED!!! backup
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
				//print_r($psData);
				for ($i = 0; $i<4; $i++) {
					if ($userTypes[$i] == $candidateTypes[$i]) {
						// No conversion needed.
						$numerator += ($personalityData[$userTypes[$i]] - $psData[$candidateTypes[$i]]);
					} else {
						// Conversion needed.
						$convertedKey = $this->switch_types($candidateTypes[$i],$userTypes[$i]);
						echo "userkey: ".$userTypes[$i]." candidatekey: ".$candidateTypes[$i]."<br>";
						echo "converted key:  " . $convertedKey;
						$numerator += $personalityData[$userTypes[$i]] - (100 - $psData[$convertedKey]);
					}
				}
				// Devide by 400 to get the normalized score.
				$personalityScore = $numerator/"400";
			}
        }*/
        foreach ($matches as $key=>$match) {
        	$personalityDistance = 1-$this->personalityNormalisation($personality, $match["personality"]);
        	$reversePersonalityDistance = 1-$this->personalityNormalisation($match["personality"], $personality);
        	$maxPersonalityDistance = max($personalityDistance, $reversePersonalityDistance);
        	$querybrands = $this->db->query("SELECT `name` FROM `brands` WHERE id IN (SELECT `brand_id` FROM `brand_likes` WHERE `user_id` = '" . $match["id"] . "');");	
        	$matchBrands = $querybrands->result_array();
<<<<<<< HEAD
            
            $x = $this->config->item('xfactor');
        	$matches[$key]["finalScore"] = $x * $maxPersonalityDistance + (1 - $x) * $this->brandScore($brands, $matchBrands);
=======
        	$matches[$key]["finalScore"] = $this->config->item('x-factor') * $maxPersonalityDistance + (1 - $this->config->item('x-factor')) * $this->brandScore($brands, $matchBrands);
>>>>>>> 9ffe7f498ef3d1285cb170c47c28e21926b724a0
        }
        usort($matches, "sortFunction");
        return $matches;
	}

    public function personalityNormalisation($myPersonality, $otherPersonality) {
		$myPersonality = $this->stringToPersonalityArray($myPersonality);
		$otherPersonality = $this->stringToPersonalityArray($otherPersonality);

		$personalityScore  = 0;
    	$userTypes = array_keys($myPersonality);
    	$candidateTypes = array_keys($otherPersonality);
		$numerator = 0;
		//print_r($psData);
		for ($i = 0; $i<4; $i++) {
			if ($userTypes[$i] == $candidateTypes[$i]) {
				// No conversion needed.
				$numerator += ($myPersonality[$userTypes[$i]] - $otherPersonality[$candidateTypes[$i]]);
			} else {
				// Conversion needed.
				$convertedKey = $this->switch_types($candidateTypes[$i],$userTypes[$i]);
				$numerator += $myPersonality[$userTypes[$i]] - (100 - $otherPersonality[$convertedKey]);
			}
		}
		// Devide by 400 to get the normalized score.
		return $numerator/"400";

	}

	public function isInterestedInMe($me, $other)
	{
		// Cast both parameters to an array as always one of the two is an object.
		$me = (array)$me;
		$other = (array)$other;
        $c= date('Y-M-D');
        $y= date('Y-M-D', strtotime($me["birthdate"]));
	  	$me["age"] = $c-$y -1;
        if($me["age"] > $other['preferredagehigh'] || $me["age"] < $other['preferredagelow'])
            return FALSE;
        if($other['preferences'] != 2 && ($other['preferences'] != $me["gender"]))
            return FALSE;
        
        return TRUE;
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

    public function getAge($birthdate) {
    	$c= date('Y-M-D');
        $y= date('Y-M-D', strtotime($me['birthdate']));
	  	return ($c-$y -1);
    }

	public function DicesCoefficient($itemset1, $itemset2)
    {        
        $intersect = array_intersect($itemset1, $itemset2);
        return ((2 * count($intersect)) / (count($itemset1) + count($itemset2)));
    }
    
    public function JaccardsCoefficient($itemset1, $itemset2)
    {
        $intersect = array_intersect($itemset1, $itemset2);
        return (count($intersect) / (count($itemset1 + $itemset2))); //the + on arrays should be the union, backup check required
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

	public function switch_types($userType, $candidateType) {
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

	public function brandScore($set1, $set2)
    {
        //we need to transform the layout of these arrays
        $itemset1 = array();
        $itemset2 = array();
        foreach($set1 as $item)
        {
            array_push($itemset1, $item['name']);
        }
        foreach($set2 as $item)
        {
            array_push($itemset2, $item['name']);
        }       
        
        switch($this->config->item('sim_measure'))
        {
            case"Dice":
                return $this->DicesCoefficient($itemset1, $itemset2);
            break;
            case"Jaccard":
                return $this->JaccardsCoefficient($itemset1, $itemset2);
            break;
            case"Cosine":
                return $this->CosineCoefficient($itemset1, $itemset2);
            break;
            case"Overlap":
                return $this->OverlapCoefficient($itemset1, $itemset2);
            break;
            
        }
    }
}

function sortFunction($a, $b) {
	if ($a["finalScore"] == $b["finalScore"]) {
		return 0;
	}
	return ($a["finalScore"] < $b["finalScore"]) ? -1 : 1;
}	

?>