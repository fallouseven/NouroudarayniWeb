<?php
	class LecteurArticle{
		private $fichier;
		private $nbMots;
		private $nbLignes;
		
		public function __construct(){
		}
		
		public function getNbLignes(){
			return $this->$nbLignes;
		}
		
		public function getNbMots(){
			return $this->$nbMots;
		}
	}
?>