<?php
	
	class Label {
		private $html;
		
		private $value;
		private $id;
		private $class;
		private $accessKey;
		private $title;
		private $lang;
		
		/****************************
		 * fonctions constructeurs
		 ****************************/
		public function __construct($val){
			$this->$value = $val;
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
		public function setAccessKey($id){
			$this->$accessKey = $id;
		}
		public function setTitle($id){
			$this->$title = $id;
		}
		public function setLang($id){
			$this->$lang = $id;
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
		public function getAccessKey(){
			return $this->$accessKey;
		}
		public function getTitle(){
			return $this->$title;
		}
		public function getLang(){
			return $this->$lang;
		}
		
		/**************************
		 * fonction qui return le label en html
		 *************************/
		public function getLabel(){
			$html = '<label for='.$id.'>'.$value.'</label>';
			return $html;
		}
		/*
		 * fonction destructeur
		 */
		public function __destruct() {
    	}
	}

?>