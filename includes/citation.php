<?php
	$url = './ressources/citations.xml';
	$document_xml = new DomDocument(); // Instanciation de la classe DomDocument : création d'un nouvel objet
	$tab = array();
	$document_xml->load($url); // Chargement à partir de citations.xml
	
	$elements = $document_xml->getElementsByTagName('citation');
	
	foreach($elements as $element){
		$tab[]=$element->nodeValue;
	}
	
	echo "<blockquote> <center><b>"._("CITATION DU JOUR")."</b></center></blockquote> <br />";
	
	echo $tab[rand(0, count($tab)-1)];
?>