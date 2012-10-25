<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="./scripts/cufon-yui.js" type="text/javascript"></script>
<script src="./scripts/Bebas_400.font.js" type="text/javascript"></script>
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
<title>Home</title>
</head>

<body>
<div id="news"><?php include './newspreview.php' ?></div>
<hr/><br />
<div class="videoNew"><?php include './video_new.php' ?></div>
</body>
</html>