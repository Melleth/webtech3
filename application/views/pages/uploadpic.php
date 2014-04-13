<?php if(isSet($error)) echo $error;?>

<?php echo form_open_multipart('upload/do_upload');?>

Upload your profile picture here!<br />
<input type="file" name="profilepic" size="20" />

<br /><br />

<input type="submit" value="Change profile pic!" />

</form>