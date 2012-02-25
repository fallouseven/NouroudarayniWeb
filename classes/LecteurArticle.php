<?php
	class LecteurArticle{
		private $fichier; //tableau un article stocker par ligne
		private $nbMots;
		private $nbLignes;
		private $mapLigne;
		
		public function __construct(){
		}
		
		public function getNbLignes(){
			return $this->$nbLignes;
		}
		
		public function getNbMots(){
			return $this->$nbMots;
		}
		
		public function motParLigne(int $nbMot){
			
		}
		
		private function construireMap(){
			foreach($fichier as $ligne){
				relier($ligne);
			}
		}
		private function countMot($tabMot){
			return count($tabMot);
		}
		
		private function construireTabMot($ligne){
			$tabMot = explode(" ", $ligne);
			return $tabMot;
		}
		
		private function relier($ligne){
			$mapLigne[$ligne] = count($ligne);
		}
		
		private function extraireMot(int $nb, $tabMot){
			$newTab = array();
			$i = 0;
			while($i<count($tabMot) && $nb<0){
				
			}
		}
	}
?>