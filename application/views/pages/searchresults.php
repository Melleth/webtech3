<h1>matches (views/pages/searchresult.php)</h1>
<?php
	foreach($matches as $match) {
		//display the matches
		echo $match['name'] . ' '. $match['finalScore']. "<br>";
	}
?>