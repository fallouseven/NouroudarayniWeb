<?php
	class Utilitaire{
		public static function parseDom($url, $tagName){
			$document_xml = new DomDocument(); // Instanciation de la classe DomDocument : création d'un nouvel objet
			$tab = array();
			$document_xml->load($url); // Chargement à partir de citations.xml
		
			$elements = $document_xml->getElementsByTagName($tagName);
		
			foreach($elements as $element){
				$tab[]=$element->nodeValue;
			}
			
			return $tab;
		}
		
		private static function lireFichier($url){
			$contenu = array();
			$contenu = file($url);
			print_r($contenu_array);
			return $contenu;
		}
	}
?>