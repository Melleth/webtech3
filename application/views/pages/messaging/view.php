View Message
<?php
    foreach($messages as $msg)
    {
        echo '<div class="read_message_box">
                <b>From: </b> ' . $msg['name'] . ' <br />
                <b>Subject: </b> ' . $msg['subject'] . ' <br />
                <br />
                <hr>
                ' . $msg['body'] . '
                <hr>
            </div>';
    }
?>