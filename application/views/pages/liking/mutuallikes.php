<h1> Mutual likes (they like me, i like them) </h1>

<?php
    foreach($likes as $like)
    {
        echo '<a href="'. base_url() . 'index.php/Homepage/view/' . $like['id'] . '/">' . $like['name'] . '</a><br />';
    }
?>