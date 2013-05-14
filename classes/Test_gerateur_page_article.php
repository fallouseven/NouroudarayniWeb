<?php
	require('../classes/Utilitaire.php');
	require('testplaylist.php');
	require('../classes/Article.php');
	require('../classes/Dom_Object.php');
	$valide_image_extensions = array('jpg', 'jpeg', 'gif', 'png', 'bmp');
	$valide_audio_extensions = array('mp3','mp4','wma');
	$dossierBaseArticle = "../articles/depot/*";
	$dossierArticle = "../articles/";
	$dossierImage ="../images/images articles/";
	$fileArticleXML = "../ressources/articles.xml";
	$fileAudioXML = "../ressources/playlist.xml";
	$fileImageXML = "../ressources/diapo.xml";
	$exist = false;
	$contientfichierText = false;
	$articleAvecImage = false;
	// Get an instance of Domdocument 
	$domObject = new Dom_Object();
	$domObject->createDOM($fileArticleXML, 'articles');	  
	  
	//titre-auteur-date
	foreach (glob("../articles/depot/*") as $rep){
		
		if (is_dir($rep)) {
			foreach (glob("$rep/*.txt") as $filename) {
				$contientfichierText = true;
				//$contenu = Utilitaire::lireFichier($filename);
				$article = create_instance_article($filename);
				//$domObject->setObject($article);
				$domObject->appendChild($article);

				foreach (glob("$rep/*") as $filenameImg)
				{
					$ext = strtolower(pathinfo($filenameImg,  PATHINFO_EXTENSION));

					if(in_array($ext, $valide_image_extensions))
					{
						$articleAvecImage = true;
						$domObject->appendChild($article, 'image', basename($filenameImg));
					}
					else if(in_array($ext, $valide_audio_extensions))
					{
						$domObject->appendChild($article, 'audio', basename($filenameImg));
					}
				}
				if(!$articleAvecImage){
					$domObject->appendChild($article, 'image',"blank.jpg");
				}
				if($elem !== NULL) $note_elt->appendChild($elem); 
				
				creationPageArticle($article);
			}
			if(!$contientfichierText){
				$docImage = new DOMDocument();
				$docAudio = new DOMDocument();
				  if(!file_exists($fileImageXML)){
					  $docImage->version = '1.0';
					  $docImage->encoding = 'utf-8';
					  $image_elt = $docImage->createElement('images');
					  $docImage->appendChild($image_elt);
				  }else{
					 $docImage->load($fileImageXML);
					 $image_elt = $docImage->getElementsByTagName('images')->item(0);
				  };
				  if(!file_exists($fileAudioXML)){
					  $docAudio->version = '1.0';
					  $docAudio->encoding = 'utf-8';
					  $audio_elt = $docAudio->createElement('audios');
					  $docAudio->appendChild($audio_elt);
				  }else{
					 $docAudio->load($fileAudioXML);
					 $audio_elt = $docAudio->getElementsByTagName('audios')->item(0);
				  };
				$audioArray = array();
				foreach (glob("$rep/*") as $filename)
				{
					$ext = strtolower(pathinfo($filename,  PATHINFO_EXTENSION));

					if(in_array($ext, $valide_image_extensions))
					{
						$image_elt->appendChild($docImage->createElement('image', basename($filename)));
						//rename($filename, "../images/images articles/".basename($filename));
					}
					else if(in_array($ext, $valide_audio_extensions))
					{
						$audio_elt->appendChild($docAudio->createElement('audio', basename($filename)));
						array_push($audioArray, $filename);
						//rename($filename, "../media/audio/".basename($filename));
					}
				}
				creerPlayList('khassaide', $audioArray);
				if($docImage !== NULL){
					 $docImage->preserveWhiteSpace = FALSE;
					 $docImage->formatOutput = true;  
					$docImage->save($fileImageXML);
				}
				if($docAudio !==NULL){
					$docAudio->preserveWhiteSpace = FALSE;
					 $docAudio->formatOutput = true;  
					$docAudio->save($fileAudioXML);
				}
			}
		}//fin if
	}//fin foreach
	//rmdir($rep);
	 // Beautify   
	 	  $doc->preserveWhiteSpace = FALSE;
		  $doc->formatOutput = true;  
		  
		  // Display the XML content we just created
		  //echo $doc->saveXML();
		  
		  // Savegarder dans article.xml
		  $doc->save($fileArticleXML);
		  
		  lireFichierXML($fileArticleXML);
		  
	function creationPageArticle($article){
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
	
	function lireFichierXML($fichier, $parent, $tabNoeud, $nomClass){
		$tabObject = array();
		//$url = "../ressources/".$fichier;
		$document_xml = new DomDocument(); // Instanciation de la classe DomDocument : création d'un nouvel objet
		$document_xml->load($fichier); 
		$lesElements = $document_xml->getElementsByTagName($parent);
		$index = 0;
		$page_article_prev = '';
		foreach($lesElements as $element){
			$params = array();
			foreach($tabNoeud as $noeud){
				$params[] = $element->getElementsByTagName($noeud)->item(0)->nodeValue;
			}
			//creer objet avec params $tabItems
			$tabObject[] = new create_instance($nomClass, $params);
		}
		return $tabObject;
	}
	
	function create_instance($class, $params) {
		$reflection_class = new ReflectionClass($class);
		return $reflection_class->newInstanceArgs($params);
	}
	
	function create_instance_article($filename) {
		$chaine = Utilitaire::lireFichier($filename);
		for($i=0; $i<count($chaine); $i++) $chaine[$i] = trim($chaine[$i]);
		$chaine = implode(" ",array_filter( $chaine));
		//echo "chaine = $chaine";
		$contenu = (preg_match('#<article>(.*)</article>#', $chaine , $regs))?$regs[1]:"";
		$elem = $doc->createElement('article');
		$titre = (preg_match('#<titre>(.*)</titre>#', $chaine , $regs))?$regs[1]:"";
		$auteur = (preg_match('#<auteur>(.*)</auteur>#', $chaine , $regs))?$regs[1]:"";
		$description = (preg_match('#<article>(.*)</article>#', $chaine , $regs))?current(str_split($regs[1], 100)):"";
		$date = date("d/m/Y");
		$url = "../articles/articles/".basename($filename);
		$url = str_replace(".txt", ".php", $url);		
		//($unTitre, $uneDate, $unAuteur, $uneDesc, $unUrl, $uneImage)
		$article = new Article($titre, $date, $auteur, $description, $url, "");
		$article->setContenu($contenu);
		return $article;
	}

?>