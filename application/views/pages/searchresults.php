<?php
	//$matches contains the found matches
	//TODO: IMPLEMENt
	printf($matches);
	foreach($matches as $match) {
		//display the matches
		echo $match['name'] . ' '. $match['gender']. "<br>";
	}
?>