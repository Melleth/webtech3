<script type="text/javascript">
    $(document).ready(function() {
        // Disable the submit button.
        $('#registerForm input[type="submit"]').attr('disabled','disabled');
        // Initialize listeners for all fields that trigger validation
        $('#registerForm input[type="text"]').each(function() {
            $(this).keyup(validationCheck);
        });
        $('#registerForm input[type="password"]').keyup(validationCheck);
        $('#registerForm input[type="date"]').keyup(validationCheck);
        $('#registerForm textarea').keyup(validationCheck);
        function validationCheck() {
            if ($('#registerForm input[type="password"]').val().length == 0) {
                $('#registerForm input[type="submit"]').attr('disabled','disabled');
                return;
            }
            if ($('#registerForm textarea').val().length == 0) {
                $('#registerForm input[type="submit"]').attr('disabled','disabled');
                return;
            }
            if ($('#registerForm input[type="date"]').val().length == 0) {
                $('#registerForm input[type="submit"]').attr('disabled','disabled');
                return;
            }
            var validText = [];
            $('#registerForm input[type="text"]').each(function() {
                if ($(this).val().length == 0) {
                    validText.push(false);
                } else {
                    validText.push(true);
                }
            });
            for (var i=0; i<5; i++) {
                if (validText[i] == false) { 
                    $('#registerForm input[type="submit"]').attr('disabled','disabled');
                    return;
                }
            }
            $('#registerForm input[type="submit"]').removeAttr('disabled');
        }
    });
    
</script>
<?php echo validation_errors(); ?>

<?php echo form_open('login/register', array('id' => 'registerForm')); ?>

    <br />
    <br />
	Nickname: <input type="text" name="nickname"><br />
    Real name: <input type="text" name="realname"><br />
    Password: <input type="password" name="password"><br />
    Email: <input type="text" name="email"><br />
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
