<?php
	class Utilitaire{
		/*
		* Cette fonction recoit en parametre un fichier xml 
		* et un tagName. Qui va retourner tous les elements du 
		* du noeud dans un tableau
		*/
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
		
		/*
		* Cette fonction prend en parametre un fichier 
		* et retourne le contenu
		*/
		public static function lireFichier($url){
			$contenu = array();
			$contenu = file($url);
			//print_r($contenu);
			//$contenu = fpassthru(file($url));
			return $contenu;
		}
		
		/*
		* Cette fonction prend en parametre un url d'un dossier
		* et retourne un tableau de fichiers.
		*/		
		public static function getFichiers($urlDossier){
			// Create 
 			$rep=opendir($urlDossier);
			$tabFichier = array();
			$index = 0;
			while ($sous_fichier=readdir($rep)) 	{ // parcours du répertoire
				if (($sous_fichier==".") || ($sous_fichier=="..")){ }
				else 
				{
					$tabFichier	[$index] = $sous_fichier;
					$index++;
				}
			}
			closedir($rep);
			
			return $tabFichier;
		}
		
		public static function getMots($contenu, $nbMot){
			$tabContenu = explode(" ", $contenu);
			for($i=0 ; $i<$nbMot && $i<count($tabCoutenu); $i++){
				$mots[] = $tabCoutenu[$i];
			}
			return $mots;
		}
		
		public static function unset_empty_values(&$array) {
			foreach ($array as  $v) {
				if(is_array($v))
				{
				   foreach($v as $cle => $valeur)
				   {
					  if(empty($valeur))
					  {
						 unset($array[$cle]);
					  }
				   }
				}
		   }
		}//end function
		
		public static function lireFichierXML($fichier, $parent, $tabNoeud, $nomClass){
			$tabArticles = array();
			$tabObject = array();
			//$url = "../ressources/".$fichier;
			$document_xml = new DomDocument(); // Instanciation de la classe DomDocument : création d'un nouvel objet
			$document_xml->load($fichier); 
			$lesElements = $document_xml->getElementsByTagName($parents);
			$index = 0;
			$page_article_prev = '';
			foreach($lesElements as $element){
				$params = array();
				foreach($tabNoeud as $noeud){
					$params[] = $element->getElementsByTagName($noeud)->item(0)->nodeValue;
				}
				//creer objet avec params $tabItems
				$tabObject[] = new create_instance($class, $params);
			}
			return $tabObject;
		}
	
		public static function create_instance($className, $params) {
			$reflection_class = new ReflectionClass($className);
			return $reflection_class->newInstanceArgs($params);
		}
		public static function getProperties($className){
			$object = new ReflectionClass($className);
			$props   = $object->getProperties();
			$tabName = array();
			foreach ($props as $prop) {
				$tabName[]= $prop->getName() . "\n";
			}
			return $tabName;
		}
		
}
?>