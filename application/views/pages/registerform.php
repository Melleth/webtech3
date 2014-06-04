<h2>Register Form (views/pages/registerform.php)</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('login/register'); ?>

    <br />
    <br />
	Nickname: <input type="text" name="nickname"></input><br />
    Real name: <input type="text" name="realname"></input><br />
    Password: <input type="password" name="password"></input><br />
    Email: <input type="text" name="email"></input><br />
    Gender: 
    <select name="gender">
        <option value="1">Female</option>
        <option value="0">Male</option>
    </select><br />
    Birthday (YYYY/MM/DD): <input type="date" name="birthday"></input><br />
    About me:<br />
    <textarea name="description" cols="10" rows="5"></textarea>
    <br />
    Interested in: 
    <select name="genderpreference">
        <option value="1">Women</option>
        <option value="0">Men</option>
        <option value="2">Both</option>
    </select><br />
    Looking for ages between:
    <input width="5" type="text" name="ageMin"></input> and <input width="5" type="text" name="ageMax"></input>

	<input type="submit" name="submit" value="Sign Me Up!" />

</form>
