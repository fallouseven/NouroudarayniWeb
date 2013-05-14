<?php
	require_once('Image.php');
	
	class Diaporama{
		private $_dossier = './images/diaporama/';
		private $_images = array();
		
		public function __construct(){
			$_images = array();
		}
		
		public function ajouterImage($image){
			$_images[] = $image;
		}
		
		public function copierImage($tabImage){
			$_images = $tabImage;
		}
		
		public function afficherDiaporama(){
			$content = '<ul>';
			foreach($_images as $img){
				$content.= '<li><img src="'.$dossier.$img->getUrl().'" alt="'.$img->getUrl().'" title="'.$img->getTitle().'" /></li>';
				$content .= '</ul>';
			}
			return $content;
		}
	}
?>