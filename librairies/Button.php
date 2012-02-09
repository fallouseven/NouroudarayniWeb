<?php
	
	class Button {
		private $html;
		
		private $value;
		private $id;
		private $class;
		private $type;
		
		/****************************
		 * fonctions constructeurs
		 ****************************/
		public function __construct($typeCopy, $val){
			$this->$value = $val;
			$this->$type = $typeCopy;
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
		public function getType(){
			return $this->$type;
		}
		
		/**************************
		 * fonction qui return le bouton en html
		 *************************/
		public function getButton(){
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