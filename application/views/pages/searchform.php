<h2>Find a Match!</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('search/viewSearchForm'); ?>

	<label for="gender">Gender</label>
	<select name="gender">
        <option value="0">Female</option>
        <option value="1">Male</option>
        <option value="2">Both</option>
    </select><br />
    
    <label for="minAge">Age Between</label>
    <input width="5" type="text" name="ageMin"></input> and <input width="5" type="text" name="ageMax"></input>
    <br />
    <br />
    <i>TODO!!! MORE SEARCH CRITERIA HERE!!!</i>
    <br />
	<input type="submit" name="submit" value="Find A Match!" />

</form>
