
<script type="text/javascript">
			  $(document).ready(function(){
				 $("a.ajax").click(function() {
					 $.ajax({
						   url:$(this).attr("href"),
						   success: function(retour){
						  $("div.contenant").empty().append(retour);
						   }
					   });
					   return false;
				 });
			  });
		</script>
<div id="news"><?php include './newspreview.php' ?></div>
<hr/><br />
<div class="videoNew"><?php include './video_new.php' ?></div>