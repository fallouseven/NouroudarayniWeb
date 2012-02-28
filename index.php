<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<title>Nourou Darayni</title>
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
        <!-- include the Tools -->
        <script src="./scripts/jquery.tools.min.js"></script>
        <script type="text/javascript" src="./scripts/jquery.easing.1.3.js"></script>
        <script type="text/javascript" src="./scripts/webwidget_menu_glide.js"></script>
        <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon"/>
		<link type="text/css" href="./styles/style.css" rel="stylesheet" media="screen" />
        <!-- tabs styling -->
		<link type="text/css" href="./styles/tabs.css" rel="stylesheet" media="screen" />
        <!-- tabs jQuery-->
		<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>

	</head>	
	
	<body>
		<div id="page">
			<div id="contenu">
                  <ul class="tabs">
                      <li><a href="./includes/home.php">Home</a></li>	
                      <li><a href="./includes/dahira.php">Dahira</a></li>
                      <li><a href="./includes/islam.php">Islam</a></li>
                      <li><a href="./includes/mediatheque.php"" >Mediatheque</a></li>
                      <li><a href="#tv">TV</a></li>
                  </ul>
                  <!-- tab "panes" -->
				<div class="panes">
                	<div id="sous-menu"></div>
            		<div class = "contenant" style="display:block"></div>
				</div>
			</div>
				
			<div id="sideBar">
					<div id="diaporama">
                    	<?php include './includes/diaporama.php' ?>
					</div>
					<div id="citation">
                    <?php include './includes/citation.php' ?>
					</div>
					
					<div id="fbkBoxe">
                        <fb:like-box href="https://www.facebook.com/pages/Dahira-Nourou-Dareyni-Montreal/131945646847236" width="240" show_faces="true" stream="false" header="false"></fb:like-box>
					</div>
				
			</div>
                
            <div id="footer">
				<p>Footer Ici !!!!   menu ici et &copy; copyright</p>
			</div>
			
		</div>
            <script language="JavaScript" type="text/javascript" src="./scripts/tabs.js"></script>
		</div>
	</body>
	
</html>