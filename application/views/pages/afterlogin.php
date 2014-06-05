<?php
    if(!$loggedin)
    {
        echo "you need to be logged in to see this page, this message should never be seen";
        exit;
    }
?>


<h2> Welcome <?php echo $user['name']; ?>!</h2>
<a href="<?php echo base_url(); ?>index.php/login/logout">Logout</a>
<?php
	// Check if the user has already done the personality test.
	if (strlen($user["personality"]) < 2) {
		//Redirect user to personality test
		echo " <h3>You've logged in and will be directed to the personality test soon!</h3>
			<p> skip the wait by clicking <a href='".base_url()."index.php/edit/personality'>here</a>!</p>";
		$this->output->set_header('refresh:6;url='.base_url().'index.php/edit/personality');
	} else {
		//we set a timer to wait for 6 seconds and then redirect the user to the homepage.
		echo "
			<h3> You've successfully logged in. Stand by for redirect to personalized homepage!</h3>
		";
		$this->output->set_header('refresh:6;url='.base_url());
	}
	
?>