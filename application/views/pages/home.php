<script type="text/javascript">
function getProfiles()
{
    $.ajax({
        url: "<?php echo base_url(); ?>index.php/Homepage/display/",
        success: function(html)
        {
            $( "#profileList" ).empty ( );
            $( "#profileList" ).append( html );
        }
    });
}

getProfiles();
</script>
<div id="profileList">
</div>
<div id="homepageRightPanel">
	<a href="#" onClick="getProfiles()">More!</a>
</div>