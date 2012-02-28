<?php
	
	class TextBox {
		private $html;
		
		private $value;
		private $id;
		private $class;
		private $name;
		
		/****************************
		 * fonctions constructeurs
		 ****************************/
		public function __construct($nameCopy, $val){
			$this->$value = $val;
			$this->$nom = $nameCopy;
		}
		
		/****************************
		 * fonctions Getters
		 ****************************/
		public function setValue($id){
			$this->$value = $id;
		}
		public function setId($id1){
			$this->$id = $id1;
		}
		public function setClass($id){
			$this->$value = $id;
		}
		public function setNom($id){
			$this->$nom = $id;
		}
		
		/****************************
		 * fonctions Getters
		 ****************************/
		public function getValue(){
			return $this->$value;
		}
		public function getId(){
			return $this->$id;
		}
		public function getClass(){
			return $this->$value;
		}
		public function getNom(){
			return $this->$nom;
		}
		
		/**************************
		 * fonction qui return le label en html
		 *************************/
		public function getTextBox(){
			$html = '<input type="text" name="'.$nom.'" value="'.$value.'" id="'.$id.'" />';
			return $html;
		}
		/*
		 * fonction destructeur
		 */
		public function __destruct() {
    	}
	}

?>