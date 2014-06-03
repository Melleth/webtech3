<h1>inbox (views/pages/messaging/inbox.php)</h1>

<table id="inboxTable">
    <tr>
        <td>
            <b>From</b>
        </td>
        <td>
            <b>Subject</b>
        </td>
        <td>
            <b>Actions</b>
        </td>
    </tr>
    <?php
        $i = 0;
        foreach($messages as $msg)
        {
            $i++;
            echo '<tr class="inboxRowMod' . $i % 2 . '">
                    <td>
                        ' . $msg['name'] . '
                    </td>
                    <td>
                        ' . $msg['subject'] . '
                    </td>
                    <td>
                        <b><a href="' . base_url() . 'index.php/messaging/view/' . $msg['id'] . '">Read</a> <a href="' . base_url() . 'index.php/messaging/delete/' . $msg['id'] . '">Delete</a></b>
                    </td>
                </tr>';
        }
    ?>
</table>