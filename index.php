<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<title>Nourou Darayni</title>
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
		<script src="./scripts/utils.js" type="text/javascript"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
		
		<script src="./scripts/cufon-yui.js" type="text/javascript"></script>
		<script src="./scripts/Bebas_400.font.js" type="text/javascript"></script>

        <!-- include the Tools -->
        <script src="./scripts/jquery.tools.min.js"></script>
       <!-- <script type="text/javascript" src="./scripts/jquery.easing.1.3.js"></script>-->
        <script type="text/javascript" src="./scripts/webwidget_menu_glide.js"></script>
        <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon"/>
		<link type="text/css" href="./styles/style.css" rel="stylesheet" media="screen" />
        <link href="./styles/webwidget_menu_glide.css" rel="stylesheet" type="text/css"></link>
		<link rel="stylesheet" type="text/css" href="./includes/playlists/playlist_styles.css" />
        <!-- tabs styling -->
		<link type="text/css" href="./styles/tabs.css" rel="stylesheet" media="screen" />
		<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css" rel="stylesheet" />
        <!-- tabs jQuery-->
		<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
		<script type="text/javascript" src="./scripts/jquery.youtubepopup.min.js"></script>
       	<!--<script type="text/javascript" src="./scripts/jquery.history.js"></script>-->
       	<script type="text/javascript" src="./scripts/history.js"></script>
        <script type="text/javascript">
        
			/* $(document).ready(function(){
			  	$.ajax({
						   url:$(".home").attr("href"),
						   success: function(retour){
						  $("div.contenant").empty().append(retour);
						   }
					   });
				 $("a.ajax").click(function() {
					 $.ajax({
						   url:$(this).attr("href"),
						   success: function(retour){
						  $("div.contenant").empty().append(retour);
						   }
					   });
					   return false;
				 });
			  });*/
			  
			  
		</script>

	</head>	
	
	<body>
		<div id="page">
			<div id="contenu">
                  <ul class="tabs">
                      <li><a class = "ajax home" href="./includes/home.php">Home</a></li>	
                      <li><a class = "ajax" href="./includes/dahira.php">Dahira</a></li>
                      <li><a class = "ajax" href="./includes/islam.php">Islam</a></li>
                      <li><a class = "ajax" href="./includes/mediatheque.php" >Mediatheque</a></li>
                      <li><a href="#">TV</a></li>
                  </ul>
                  <!-- tab "panes" -->
				<div class="panes">
            		<div class="contenant" style="display:block"></div>
				</div>
			</div>
				
			<div id="sideBar">
					<div id="calendrier">
                    	<?php include './includes/calendrier/calendrier.php' ?>
					</div>
					<div id="diaporama">
                    	<?php include './includes/diaporama.php' ?>
					</div>
					<div id="citation">
                    <?php include './includes/citation.php' ?>
					</div>
					<div id="playlist">
						<?php include './includes/playlists/playlist.php' ?>
					</div>
					<div id="fbkBoxe">
                        <fb:like-box href="https://www.facebook.com/pages/Dahira-Nourou-Dareyni-Montreal/131945646847236" width="240" show_faces="true" stream="false" header="false"></fb:like-box>
					</div>
				
			</div>
                
            <div id="footer">
				<p>Footer Ici !!!!   menu ici et &copy; copyright</p>
			</div>
			
		</div>
            <!--<script language="JavaScript" type="text/javascript" src="./scripts/tabs.js"></script>-->
		</div>
	</body>
	
</html>