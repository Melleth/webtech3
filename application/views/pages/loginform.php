<h2>Login Form (views/pages/loginform.php)</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('login'); ?>

<?php if($loginfailed) echo "Login failed, check your email and password and try again."; ?>
    <br />
    <br />
	Email: <input type="text" name="email"></input><br />
    Password: <input type="password" name="password"></input><br />
    
	<input type="submit" name="submit" value="Find A Match!" />

</form>
<a href="<?php echo base_url()."index.php/login/register"; ?>">Register here!</a>
