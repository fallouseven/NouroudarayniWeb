<?php require('../includes/gestionVideos.php');?>
<script  type="text/javascript">
		$(function () {
			$("img.youtube").YouTubePopup({ idAttribute: 'id' });
			});
</script>
<div class="separateur">Video</div>
<div class="video_preview">
			<table>
				<tr>
					<?php lireFichierXMLYoutube("../ressources/youtubeVideos.xml"); ?>
					<!--<td><img class="youtube" id="iOj2u6b-YEI"  src="http://img.youtube.com/vi/iOj2u6b-YEI/0.jpg" title="..." /></td>
					<td><img class="youtube" id="VQ2AVz63F2I"  src="http://img.youtube.com/vi/VQ2AVz63F2I/0.jpg" title="..." /></td>
					<td><img class="youtube" id="XRnFqPgBocI"  src="http://img.youtube.com/vi/XRnFqPgBocI/0.jpg" title="..." /></td>
					<td><img class="youtube" id="MKR0HW9dtcE"  src="http://img.youtube.com/vi/MKR0HW9dtcE/0.jpg" title="..." /></td>-->
				</tr>
			</table>
</div>
