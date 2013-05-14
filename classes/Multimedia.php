<?php
	class Multimedia{
		private $_url = '';
		private $_titre = '';
		private $_alt = '';
		private $_nom = '';
		
		public function __construct(){
		}
		public function __construct($url, $titre, $nom, $alt){
			$this->setUrl($url);
			$this->setTitre($titre);
			$this->setNom($nom);
			$this->setAlt= $alt;
		}
		
		public function getUrl(){
			return $this->_url;
		}
		
		public function getTitre(){
			return $this->_titre;
		}
		public function getNom(){
			return $this->_nom;
		}
		public function getAlt(){
			return $this->_alt;
		}
		public function setUrl($url){
			$this->_url = $url;
		}
		public function setTitre($titre){
			$this->_titre = $titre;
		}
		public function setNom($nom){
			$this->_nom = $nom;
		}
		public function setAlt($alt){
			$this->_alt = $alt;
		}	
		
	}
?>