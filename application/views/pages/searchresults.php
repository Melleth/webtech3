<h1>Matches</h1>
<?php
    if(count($matches) < 1)
    {
        echo "We have no matches in our database for you :("; 
    }
	foreach($matches as $profile) {
		//display the matches
		//echo $match['name'] . ' '. $match['finalScore']. "<br>";

        if($loggedin && $profile['profile_pic'] != "")
        {
            $imgString = "<img class=\"homepageSilhouette\" src=\"" . base_url() . "/uploads/" . $profile['profile_pic'] . "\" alt=\"Silhouette\">";
        }
        else
        {
            $imgString = "<img class=\"homepageSilhouette\" src=\"" . base_url() . "/includes/img/silhouetteMan.png\" alt=\"Silhouette\">";
            if($profile['gender'] == 1)
                $imgString = "<img class=\"homepageSilhouette\" src=\"" . base_url() . "/includes/img/silhouetteWoman.png\" alt=\"Silhouette\">";
        }    
            $imgLink = "<a href=\"" . base_url() . "index.php/Homepage/view/" . $profile['id'] . "\">" . $imgString . "</a>";
        
		$c= date('Y-M-D');
		$y= date('Y-M-D', strtotime($profile['birthdate']));
		$age = $c-$y -1;
		
		$descr = substr($profile['description'], 0, 250) . "...";
		
		echo "<div class=\"homepageProfileBlock\">
		" . $imgLink . "
		<h3>" . $profile['name'] . "</h3><br />
		Nickname: " . $profile['nickname'] . "<br />
		Age: " . $age . "<br />
		Description: " . $descr . "<br />
        Personality: " . $profile['personality'] . "
        
        
		</div>";
	}
?>