<?php
	$url = './ressources/citations.xml';
	$document_xml = new DomDocument(); // Instanciation de la classe DomDocument : cr�ation d'un nouvel objet
	$tab = array();
	$document_xml->load($url); // Chargement � partir de citations.xml
	
	$elements = $document_xml->getElementsByTagName('citation');
	
	foreach($elements as $element){
		$tab[]=$element->nodeValue;
	}
	
	echo "<center><b>CITATION DU JOUR</b></center><br />";
	
	echo $tab[rand(0, count($tab)-1)];
?>