<?php
	require_once('Multimedia.php');
	
	class Video extends Multimedia {
		
		public function __construct(){
			parent::__construct();
		}
		public function __construct($url, $titre, $nom, $alt){
			parent::__construct($url, $titre, $nom, $alt);
		}
		public function toString(){
		}
		
	}
?>