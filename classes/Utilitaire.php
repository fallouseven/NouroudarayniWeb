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
		
	}
?>