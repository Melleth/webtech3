<html>
<head>
	<title><?php echo $title; ?> - DataDate</title>
	<link rel="stylesheet" href="<?php echo base_url() ?>/includes/style.css" type="text/css" />
    <script type='text/javascript' src="<?php echo base_url() ?>/includes/javascript/jquery-1.11.1.min.js"></script>
</head>
<body>
<center>
<div id="mainFrame">
<img src="<?php echo base_url() ?>/includes/img/headerImg.jpg" width="1000px" alt="Happy People">
<div id="menuBar">
	<ul>
		<li><a href="<?php echo base_url() ?>index.php">Home</a></li>
		<li><a href="<?php echo base_url() ?>index.php/pages/view/about">About</a></li>
        <li><a href="<?php echo base_url() ?>index.php/search/">Search People</a></li>
        
        <?php
        	// If we are logged in, do not show the login button, but a my profile button.
        	if(isset($loggedin)&&$loggedin) {
        		//echo ('<li><a href="'.base_url().'"index.php/myprofile/">My Profile</a></li>');
        		echo "<li><a href='".base_url()."index.php/homepage/view/self'>My Profile</a></li>";
                echo "  <li><a href=\"" . base_url() . "index.php/messaging/\">Messaging</a></li>
                        <li><a href=\"" . base_url() . "index.php/likes/\">Likes</a></li>
                        <li><a href=\"" . base_url() . "index.php/login/logout/\">Logout</a></li>";
                if(isSet($user) && $user['admin'] > 0)
                {
                    echo "<li><a href=\"" . base_url() . "index.php/admin/\">Administration</a></li>";
                }
        	} else {
        		//echo ('<li><a href="'.base_url()'"index.php/login/">Login</a></li>');
        		echo "<li><a href='".base_url()."index.php/login'>Login</a></li>";
        	}
        ?>
        
	</ul>
</div>