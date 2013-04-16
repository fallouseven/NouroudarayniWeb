<?php
lireFichierXML();
	function lireFichierXML(){
		$chaine = '';
		$url = "../ressources/organigramme.xml";
		$document_xml = new DOMDocument(); // Instanciation de la classe DomDocument : création d'un nouvel objet
		$document_xml->load($url); 
		$xpath = new DomXpath($document_xml);
		
		$elementsDieuwrigne = $document_xml->getElementsByTagName('dieuwrigne');
		/*if($elementsDieuwrigne->hasAttribute("nom"))
			echo $elementsDieuwrigne->getAttribute("nom");*/
		$result = $xpath->query("/dieuwrigne/@nom");
		//print_r($result);
		echo $result->item(0)->textContent;
		//lister($elementsDieuwrigne);
			
	}
	function lister($node) {
		echo 'li';
	    foreach ($node as $element) {
	        echo $element->getName().' : '.$element."\n";
	        if ($element->children()) {
	            echo "<br />";
	            lister($element);
	        }
	    }
	} 

?>