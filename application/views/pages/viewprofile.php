<?php

	//Profile image
	$imgString = "<img class=\"homepageSilhouette\" src=\"" . base_url() . "/includes/img/silhouetteMan.png\" alt=\"Silhouette\">";
	if($profile->gender == 1)
		$imgString = "<img class=\"homepageSilhouette\" src=\"" . base_url() . "/includes/img/silhouetteWoman.png\" alt=\"Silhouette\">";
	$imgLink = "<a href=\"" . base_url() . "index.php/Homepage/view/" . $profile->id . "\">" . $imgString . "</a>";
	
	//Age calculation
	$c= date('Y-M-D');
	$y= date('Y-M-D', strtotime($profile->birthdate));
	$age = $c-$y -1;	
	
	//liked brands
	$brands = "";
	$i = 0;
	$max = 5;
	foreach($profile->brands as $liked_brand)
	{
		$i++;
		if($i > $max)
			break;
		$brands .= $liked_brand['name'] . " - ";
	}
	$brands = substr($brands, 0, count($brands) - 3);
	
	//and finally echo the output
	echo "<div class=\"homepageProfileBlock\">
	" . $imgLink . "
	<h3>" . $profile->name . "</h3><br />
	Nickname: " . $profile->nickname . "<br />
	Age: " . $age . "<br />
	Description: " . $profile->description . "<br />
	Brands: " . $brands . "<br />
	
	<i>MORE SHIT HERE (views/pages/viewprofile.php)</i>

	</div>";
	
?>
