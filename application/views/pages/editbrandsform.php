<h2>Like Brands</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('edit/brands'); ?>
    
    
    
    <br />
    <br />
	
    <?php
        foreach($allbrands as $brand)
        {
            echo '<input type="checkbox" value="brands" name="brandno' . $brand['id'] . '" />';
            echo $brand['name'];
            echo "<br />";
        }
    ?>
    <br />
    <br />
    
    <input type="checkbox" value="confirm" name="confirm" /> I am sure I like these brands!
    
	<input type="submit" name="submit" value="Like checked brands!" />

</form>
