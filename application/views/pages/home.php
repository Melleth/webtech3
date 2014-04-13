<?php
	foreach($profiles as $profile)
	{
		$imgString = "<img class=\"homepageSilhouette\" src=\"" . base_url() . "/includes/img/silhouetteMan.png\" alt=\"Silhouette\">";
		if($profile['gender'] == 1)
			$imgString = "<img class=\"homepageSilhouette\" src=\"" . base_url() . "/includes/img/silhouetteWoman.png\" alt=\"Silhouette\">";
		
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
		<i>MORE SHIT HERE (views/pages/home.php)</i>
		
		
		
		
		</div>";
	}
?>
<div id="homepageRightPanel">
	<a href="<?php echo base_url() ?>index.php/Homepage/display/<?php echo count($profiles) + 6; ?>">More!</a>
	<font size=2>note: this button works but there are no more records in the table</font>
</div>