<?php
require('gestionArticle.php');
$fichier = 'articlesTest.xml';
echo '<table><tr>';
lireFichierXML($fichier);
echo '</tr></table>'
?>