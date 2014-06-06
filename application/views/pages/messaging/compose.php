<a href="<?php echo base_url() ?>index.php/messaging/overview">Inbox</a> - 
<a href="<?php echo base_url() ?>index.php/messaging/compose">Write Message</a><br />

<h2>Compose Message</h2>

<?php echo validation_errors(); ?>

<div class="read_message_box">
    <table>
        <?php echo form_open('messaging/compose'); ?>
            <tr>
                <td>
                    <b>To:</b>
                </td>
                <td>
                    <select name="msg_to" title="List of users you can send messages to.">
                        <?php
                            foreach($cansendto as $msgto)
                                echo '<option value="' . $msgto['id'] . '">' . $msgto['name'] . '</option>';
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Subject:</b>
                </td>
                <td>
                    <input type="text" name="msg_subject"><br />
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <textarea name="msg_body" cols="60" rows="15">
                    </textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Send" />
                </td>
            </tr>
        </form>
    </table>
</div>