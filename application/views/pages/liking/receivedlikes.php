<h1> people who like me! </h1>

<?php
    foreach($likes as $like)
    {
        echo '<a href="'. base_url() . 'index.php/Homepage/view/' . $like['id'] . '/">' . $like['name'] . '</a><br />';
    }
?>