<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<title>Nourou Darayni</title>
<link rel="stylesheet" href="./styles/articlePreview.css" type="text/css" media="screen"/>
</head>
<body>
<?php
require('gestionArticle.php');
$fichier = 'articles.xml';
echo '<table><tr>';
lireFichierXML($fichier);
echo '</tr></table>'
?>
</body>
</html>