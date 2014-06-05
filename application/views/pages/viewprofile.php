<script language="javascript">

function getDeleteConfirm()
{
    var r = confirm("are you sure you want to delete your account? :(");
    if(r)
    {
        window.location = "<?php echo base_url() ?>index.php/login/deregister"; 
    }
}

</script>

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
		if ($liked) {
			$likestring = "You liked this profile!";
		} else {
			$likestring = "<a href=\"". base_url() . "index.php/likes/like/" . $profile->id . "\">Like</a> this user, and be able to message them!";	
		}
        
		if ($profile->profile_pic != "") {
			$imgString = '<img class="viewPageImg" src="' . base_url() . 'uploads/'.$profile->profile_pic.'"></img>';
		} else {
			// Set the silhoutte if the user has not set a profile picture.
			$imgString = "<img class=\"viewPageImg\" src=\"" . base_url() . "/includes/img/silhouetteMan.png\" alt=\"Silhouette\">";
			if ($profile->gender == 1)
				$imgString = "<img class=\"viewPageImg\" src=\"" . base_url() . "/includes/img/silhouetteWoman.png\" alt=\"Silhouette\">";
		}
		$profiledata['imgLink'] = '<a href="' . base_url() . 'uploads/' . $profile->profile_pic.'">' . $imgString . '</a>';
		
	} else {
    
        $likestring = "<a href=\"". base_url() . "index.php/login/register\">Create an account</a> to get in touch with this user!";
		// Do stuff for the anonymous user.
		// Set profile image to anoymous user thumbnails
		$imgString = "<img class=\"viewPageImg\" src=\"" . base_url() . "/includes/img/silhouetteMan.png\" alt=\"Silhouette\">";
		if ($profile->gender == 1)
			$imgString = "<img class=\"viewPageImg\" src=\"" . base_url() . "/includes/img/silhouetteWoman.png\" alt=\"Silhouette\">";
		$profiledata['imgLink'] = "<a href=\"" . base_url() . "index.php/Homepage/view/" . $profile->id . "\">" . $imgString . "</a>";
	
	}
    
    
	
	if (!$owner) {
		echo "<div class=\"viewProfileBlock\">
		" . $profiledata['imgLink'] . "
		<h3>" . $profile->name . "</h3><br />
		Nickname: " . $profile->nickname . "<br />
		Age: " . $age . "<br />
		Description: " . $profile->description . "<br />
		Brands: " . $brands . "<br />
		Personality: " . $profile->personality . "<br />
        Looking for ages between: " . $profile->preferredagelow . " and " . $profile->preferredagehigh . "<br />
        " . $likestring . "

		</div>";
	} else {
		// We are the owner, so we need to change all fields to input fields.
		echo form_open('homepage/view/'. $profile->id);
		echo "<div class=\"viewProfileBlock\">
			" . $profiledata["imgLink"] . " <a href=\"" . base_url() . "index.php/upload\">Upload new Picture</a> 
			<a href=\"".base_url()."index.php/edit/brands\">Edit my brands</a><br>
			Name: <input type=\"text\" name=\"name\" value=\"".$profile->name."\" /> <br>
			Nickname: <input type=\"text\" name=\"nickname\" value=\"".$profile->nickname."\" /> <br>
			Birth Day (YYYY/MM/DD): <input type=\"date\" name=\"birthdate\" value=\"". $profile->birthdate ."\" /> <br />
			Description: <input type=\"text\" name=\"description\" value=\"" . $profile->description ."\" /><br />
			Brands: " . $brands . "<br />
			Email: <input type =\"text\" value=\"".$profile->email."\" name=\"email\" /> </br>
			<input type=\"submit\" name=\"submit\" value=\"Update Profile\" /> <br>
			<a href=\"".base_url()."index.php/login/logout\">Logout</a><br />
            <a href=\"".base_url()."index.php/upload/removeProfilePic\">Remove Profile Picture</a><br />
            <a href=\"#\" onClick=\"getDeleteConfirm()\">Delete Account</a>
            
		</form>";

	}
?>
