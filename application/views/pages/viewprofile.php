<?php
	//Age calculation
	$c= date('Y-M-D');
	$y= date('Y-M-D', strtotime($profile->birthdate));
	$age = $c-$y -1;	
	$profiledata['age'] = $age;
	$profiledata['birthdate'] = $profile->birthdate;
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
			$profiledata['imgLink'] = "<a href=\"" . base_url() . "index.php/Homepage/view/" . $profile->id . "\">" . $imgString . "</a>";
		} else {
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
		// We are the owner, so we need to change all fields to input fields.
		echo form_open('homepage/view/'. $profile->id);
		echo "<div class=\"homepageProfileBlock\">
			" . $profiledata["imgLink"] . " <a href=\"" . base_url() . "index.php/upload\">Upload new Picture</a> <br>
			Name: <input type=\"text\" name=\"name\" value=\"".$profile->name."\" /> <br>
			Nickname: <input type=\"text\" name=\"nickname\" value=\"".$profile->nickname."\" /> <br>
			Birth Day (YYYY/MM/DD): <input type=\"date\" name=\"birthdate\" value=\"". $profile->birthdate ."\" /> <br />
			Description: <input type=\"text\" name=\"description\" value=\"" . $profile->description ."\" /><br />
			Brands: " . $brands . "<br />
			Email: <input type =\"text\" value=\"".$profile->email."\" name=\"email\" /> </br>
			<input type=\"submit\" name=\"submit\" value=\"Update Profile\" />
		</form>";

	}
?>
