
<?php

/**
 * classe article
 * 
 * <p>la article a pour but de creer des articles
 * de pouvoir avoir tous les informations sur un article
 * </p>
 * 
 * @classe Article
 * @author Moussa Thimbo <moussa.thimbo@gmail.com> 
 * @copyright Moussa Thimbo 2012
 * @version 1.0.0
 * @package classe
 */
 
 class Article {
 
    /*~*~*~*~*~*~*~*~*~*~*/
    /*  1. propriétés    */
    /*~*~*~*~*~*~*~*~*~*~*/
	
    private $titre;
	private $dateArticle;
	private $auteur;
	private $description;
	private $url;
	private $image;
	private $images = array();
	private $contenu;
    /*~*~*~*~*~*~*~*~*~*~*/
    /*  2. méthodes      */
    /*~*~*~*~*~*~*~*~*~*~*/
    
    /**
    * Constructeur
    * 
    * <p>création de l'instance de la classe</p>
    * 
    * @name Article::__construct()
    * @return void 
    *//*
    public function __construct() {
		$this->$titre;
		$this->$date = new DateTime();
		$this->$images = array();
    } 
	*/
	/**
    * Constructeur
    * 
    * <p>création de l'instance de la classe</p>
    * 
    * @name Article::__construct()
    * @param titre
    * @param date
    * @param auteur
	* @param description
    * @param url
    * @param images
	* @param pages
    * @return void 
    */
    public function __construct($unTitre, $uneDate, $unAuteur, $uneDesc, $unUrl, $uneImage) {
		$this->titre = $unTitre;
		$this->dateArticle = $uneDate;
		$this->auteur = $unAuteur;
		$this->description = $uneDesc;
		$this->url = $unUrl;
		$this->image = $uneImage;
    } 
	
	
    
    /*~*~*~*~*~*~*~*~*~*~*~*~*~*/
    /*  2.1 méthodes privées   */
    /*~*~*~*~*~*~*~*~*~*~*~*~*~*/
	private function lireFichier(){
		$contenu = array();
		$contenu = file($url);
		print_r($contenu_array);
	}
    
    /*~*~*~*~*~*~*~*~*~*~*~*~*~*/
    /*  2.1 méthodes getters   */
    /*~*~*~*~*~*~*~*~*~*~*~*~*~*/
	public function getTitre(){
		return $this->titre;
	}
	
	public function getAuteur(){
		return $this->auteur;
	}
	
	public function getDate(){
		return $this->dateArticle;
	}
	
	public function getDescription(){
		return $this->description;
	}
	
	public function getUrl(){
		return $this->url;
	}
	
	public function getImage(){
		if(count($this->images)>0) 
			return $this->images[0];
		else return $this->image;
	}
	
	public function getContenu(){
		return $this->contenu;
	}
	/*~*~*~*~*~*~*~*~*~*~*~*~*~*/
    /*  2.1 méthodes setters   */
    /*~*~*~*~*~*~*~*~*~*~*~*~*~*/
	public function setTitre($unTitre){
		$this->unTitre = $unTitre;
	}
	
	public function setAuteur($unAuteur){
		$this->auteur = $unAuteur;
	}
	
	public function setDate($uneDate){
		$this->dateArticle= $uneDate;
	}
	
	public function setDescription($desc){
		$this->description = $desc;
	}
	
	public function setUrl($location){
		$this->url = $location;
	}
	
	public function setImage($img){
		$this->image = $img;
	}
	
	public function setImages($imgs){
		$this->images = $imgs;
	}
	
	public function setContenu($txt){
		$this->contenu = $txt;
	}
	
	public function addImage($img){
		$this->images[]= $img;
	}
	
	public function creationPageArticle($article){
		$page = "";
		//echo $article->getImage();
		$page = '<section class="article">
				<header>
					<h1>'.$article->getTitre().'</h1>
			  	</header>'.
			  $page.= $article->getImage() !== "blank.jpg"? 
			  '<div class="imageArticle"><center><img  class="imgArticle" src="./images/images articles/'.$article->getImage().'" /></center></div>':'';
			  $page.= '<article>
			   <article>'.$article->getContenu().'</article>
			   <footer class="signature">
				 <p>
					Auteur : '.$article->getAuteur().'
					 <time datetime="'.$article->getDate().'">'.$article->getDate().'</time>
				 </p>
			   </footer>
			 </article>
			 </section>
			 <script src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php" type="text/javascript"></script>
			<fb:comments></fb:comments>';//facebook comment
			//echo $page;
			$fichier = fopen($article->getUrl(), "w+");
			fwrite($fichier, $page); 
			fclose($fichier); 
			
			//echo "la page \n".$page;
	}
	   
    /**
    * Destructeur
    * 
    * <p>Destruction de l'instance de classe</p>
    * 
    * @name Nom de la classe::__destruct()
    * @param nom du premier paramètre
    * @param nom du second paramètre
    * @param etc ...
    * @return void
    */
    public function __destruct() {
    }
 }
 ?> 