<a href="<?php echo base_url() ?>index.php/likes/received">Who likes me?</a><br />
<a href="<?php echo base_url() ?>index.php/likes/given">Who have I liked?</a><br />
<a href="<?php echo base_url() ?>index.php/likes/mutual">With whom do i have a mutual like?</a><br />

<h1> Mutual likes (they like me, i like them) </h1>

<?php
    foreach($likes as $like)
    {
        echo '<a href="'. base_url() . 'index.php/homepage/view/' . $like['id'] . '/">' . $like['name'] . '</a><br />';
    }
?>