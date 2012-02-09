<?php
	
	class ElementForm {
		private $html;
		
		private $value;
		private $id;
		private $class;
		private $type;
		private $nom;
		
		/****************************
		 * fonctions constructeurs
		 ****************************/
		public function __construct($typeParam, $valueParm, $nameParm, $idParam){
			$this->$value = $valueParam;
			$this->$type = $typeParam;
			$this->$id = $idParam;
			$this->$nameParam = $nameParm;
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
		public function setType($id){
			$this->$type = $id;
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
		public function getType(){
			return $this->$type;
		}
		
		/**************************
		 * fonction qui return le label en html
		 *************************/
		public function getHTML(){
			$html = '<input type="'.$type.'" name="'.$nom.'" value="'.$value.'" id="'.$id.'" />';
			return $html;
		}
		/*
		 * fonction destructeur
		 */
		public function __destruct() {
    	}
	}

?>