<?php
    if(!$loggedin)
    {
        echo "you need to be logged in to see this page, this message should never be seen";
        exit;
    }
?>

<h3> You've successfully logged in. Stand by for redirect to personalized homepage!</h3>
<h2> Welcome <?php echo $user['name']; ?>!</h2>
<a href="<?php echo base_url(); ?>index.php/login/logout">Logout</a>
<?php
	//we set a timer to wait for 6 seconds and then redirect the user to the homepage.
	$this->output->set_header('refresh:6;url='.base_url());  
?>