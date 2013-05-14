<?php
	class Page{
		private $_content = '';
		private $_header = '';
		private $_sideBar = '';
		private $_footer = '';
		private $_metas = array();
		private $_js = array();
		private $_css = array();
		private $_titre ='';
		
		public function __construct(){
		}
		public function addMetaItem($key, $value){
			$this->_meta[$key] = $value;
		}
		public function addJs($item){
			$this->_js[] = $item;
		}
		public function addCss($item){
			$this->_css[] = $item;
		}
		
		public function setContent($content){
			$this->_content = $content;
		}
		public function setHeader($header){
			$this->_header = $header;
		}
		public function setSideBar($sideBar){
			$this->_sideBar = $sideBar;
		}
		public function setFooter($footer){
			$this->_footer = $footer;
		}
		public function setMetas($metas){
			$this->_metas = $metas;
		}
		public function setJs($js){
			$this->_js = $js;
		}
		public function setCss($css){
			$this->_css = $css;
		}
		public function setTitre($titre){
			$this->_titre = $titre;
		}
		
		public function getContent(){
			return $this->_content;
		}
		public function getHeader(){
			return $this->_header;					
		}
		public function getSideBar(){
			return $this->_sideBar;
		}
		public function getFooter(){
			return $this->_footer;
		}
		public function getMetas(){
			return $this->_metas;
		}
		public function getJs(){
			return $this->_js;
		}
		public function getCss(){
			return $this->_css;
		}
		
		public function afficherContent()
		{
			if(file_exists($this->getContent()))
				include $this->getContent();
		}
		public function afficherHeader()
		{
			if(file_exists($this->getHeader()))
				include $this->getHeader();
		}
		public function afficherSideBar()
		{
			if(file_exists($this->getSideBar()))
				include $this->getSideBar();
		}
		public function afficherFooter()
		{
			if(file_exists($this->getFooter()))
				include $this->getFooter();
		}
		public function afficherTitre()
		{
			echo '<title>'.$this->_titre.'</title>';
		}
		public function afficherMetas()
		{
			$html ='';
			foreach($this->_metas as $nom => $content){
				$html.= '<meta name="'.$nom.'" content="'.$content.'">';
			}
			echo $html;
		}
		public function afficherJs()
		{
			$html = '';
			foreach($this->_js as $js){
				$html.= '<script src="'.$js.'" type="text/javascript"></script>';
			}
			echo $html;
		}
		public function afficherCss()
		{
			$html = '';
			foreach($this->_css as $css){
				$html.= '<link type="text/css" href="'.$css.'" rel="stylesheet" media="screen" />';
			}
			echo $html;
		}
		
		public function afficherPage()
		{
			echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        			"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
				<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
					<head>';
					$this->afficherTitre();
					$this->afficherMetas();
					$this->afficherCss();
					$this->afficherJs();
			echo	'</head>
					<body>
						<div id="page">';
							$this->afficherHeader();
							echo '<div id="contenu" class="contenant" style="display:block">';
								$this->afficherContent();
							echo '</div>
							<div id="sideBar">';
								$this->afficherSideBar();
							echo '</div>
							<div id="footer">';
								$this->afficherFooter();
							echo '</div>
						</div>
					</body>
				</html>';
		}
	}
?>