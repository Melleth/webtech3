<h2>Admin Panel!</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('admin/showPanel'); ?>

    <?php
        if($done)
        {
            echo "<h1>Settings succesfully saved!</h1>";
        }
    ?>
    <b>Alpha</b><br />
    <input type="text" name="setting_alpha" value="<?php echo $alpha; ?>"></input><br />
    <br />
    current Lifestyle Similarity Measure = <?php echo $sim_measure; ?><br />
    <select name="setting_simmeasure">
        <option value="Dice">Dice's Coefficient</option>
        <option value="Jaccard">Jaccard's Coefficient</option>
        <option value="Cosine">Cosine Coefficient</option>
        <option value="Overlap">Overlap Coefficient</option>
    </select><br />
    <br />
    <b>X-Factor</b><br />
    <input type="text" name="setting_xfactor" value="<?php echo $xfactor; ?>"></input>
    
    <br />
	<input type="submit" name="submit" value="Submit" />

</form>
