<?php
	// Declare some basic stuff that everybody is allowed to see.
	$profiledata = [];
	$profiledata['nickname'] = $profile->nickname;
	$profiledata['name'] = $profile->name;
	$profiledata[''] = $profile->nickname;
	$profiledata['description'] = $profile->description;
	//Age calculation
	$c= date('Y-M-D');
	$y= date('Y-M-D', strtotime($profile->birthdate));
	$age = $c-$y -1;	
	$profiledata['age'] = $age;
	$profiledata['birthdate'] = $profile->birthdate;
	echo($profiledata['birthdate']);
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
	
	// Check if we are logged in and/or viewing our own profile.
	if ($loggedin) {
		// We are logged in, therefore we can view more stuff.
		// Declerate some values.
		$imgString = $profile->profile_pic;
		if ($owner) {
			// We are the owner of this profile we're viewing, fill accordingly.
			echo "OWNER OF DIS SHIZ";
			$profiledata['imgLink'] = "<a href=\"" . base_url() . "index.php/Homepage/view/" . $profile->id . "\">" . $imgString . "</a>";
		} else {
			echo "LOGGED IN BUT NOT THE OWNER KEKE";
			$profiledata['imgLink'] = "<a href=\"" . base_url() . "index.php/Homepage/view/" . $profile->id . "\">" . $imgString . "</a>";
		}
	} else {
		// Do stuff for the anonymous user.
		// Set profile image to anoymous user thumbnails
		$imgString = "<img class=\"homepageSilhouette\" src=\"" . base_url() . "/includes/img/silhouetteMan.png\" alt=\"Silhouette\">";
		if($profile->gender == 1)
			$imgString = "<img class=\"homepageSilhouette\" src=\"" . base_url() . "/includes/img/silhouetteWoman.png\" alt=\"Silhouette\">";
		$profiledata['imgLink'] = "<a href=\"" . base_url() . "index.php/Homepage/view/" . $profile->id . "\">" . $imgString . "</a>";
	
	}
	
	// Create the image link from the string.

	viewprofile($profiledata, $owner);

	function viewProfile($profiledata, $owner) {
		if (!$owner) {
			echo "<div class=\"homepageProfileBlock\">
			" . $profiledata['imgLink'] . "
			<h3>" . $profiledata['name'] . "</h3><br />
			Nickname: " . $profiledata['nickname'] . "<br />
			Age: " . $profiledata['age'] . "<br />
			Description: " . $profiledata['description'] . "<br />
			Brands: " . $brands . "<br />
			
			<i>MORE SHIT HERE (views/pages/viewprofile.php)</i>

			</div>";
		} else {
			echo form_open('changeProfile');
			echo "<div class=\"homepageProfileBlock\">
			" . $profiledata["imgLink"] . " <a href=\"" . base_url() . "index.php/upload\">Upload new Picture</a>
			Nickname: <input type=\"text\" class=\"owner nickname\" value=\"".$profiledata['nickname']."\" /> <br>
			Birth Day (YYYY/MM/DD): <input type=\"date\" class\"owner age\" value=\"". $profiledata['birthdate'] ."\" /> <br />
			Description: <input type=\"text\" class=\"owner description\" value=\"" . $profiledata['description'] ."\" /><br />
			Brands: " . $brands . "<br />
			<input type =

		}
	}
?>
