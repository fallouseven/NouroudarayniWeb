<?php
	require('../classes/Article.php');
	$dossierBaseArticle = "../articles/nouveau/*";
	$dossierArticle = "./articles/";
	$dossierImage ="./images/images articles/";
	$dossierImagePreview = './images/images articles/preview/';
	$dossierRessource = "../ressources/";
	
	function lireFichierXML($fichier){
		$tabArticles = array();
		$url = "../ressources/".$fichier;
		$document_xml = new DomDocument(); // Instanciation de la classe DomDocument : création d'un nouvel objet
		$document_xml->load($url); 
		$lesArticles = $document_xml->getElementsByTagName('article');
		//array_reverse($lesArticles); //not a array
		$index = 0;
		foreach($lesArticles as $article){
			if($index == 4) return;
			$titre = $article->getElementsByTagName('titre')->item(0)->nodeValue;
			$auteur = $article->getElementsByTagName('auteur')->item(0)->nodeValue;
			$date = $article->getElementsByTagName('date')->item(0)->nodeValue;
			$description = $article->getElementsByTagName('description')->item(0)->nodeValue;
			$image = $article->getElementsByTagName('image')->item(0)->nodeValue;
			$url = $article->getElementsByTagName('url')->item(0)->nodeValue;
			$image = './images/images articles/preview/'.$image;
			//$url = '../articles/'.$url;
			$unArticle = new Article($titre, $date, $auteur, $description, $url, $image);
			/*if($index == 0){
				AfficherFirstArticle($unArticle->getUrl());
			}*/
			afficherArticle($unArticle, $index);	
			$index++;
		}
		
	}

	function afficherArticle($article, $index){
		$content;
		$content= '<div class="cn_content"><table class="articlePrev">';
		if($article->getImage() !== "blank.jpg"){
			$content.= '<tr><td cellspacing="0" cellpadding="0"><img src="'.$article->getImage().'" alt=""/></td></tr>';
		}
		
		$content.= '<tr><td cellspacing="0" cellpadding="0"><div class="title">'.$article->getTitre().'</div></td></tr>
		<tr><td cellspacing="0" cellpadding="0"><div class="description">'.$article->getDescription().'</div></td></tr>
		<tr><td><span class="cn_date">'.$article->getDate().'</span></td></tr>
		<tr><td class="lireSuite"><span class="cn_more"><a class="cn_more ajax" href="'.$article->getUrl().'">Lire suite</a></span></td></tr>
	</table></div>';
	echo $content;
	}
	
	function creerArticleXML(){
		$valide_extensions = array('jpg', 'jpeg', 'gif', 'png', 'bmp');
		$dossierBaseArticle = "../articles/nouveau/*";
		$dossierArticle = "../articles/";
		$dossierImage ="./images/images articles/";
		$fileArticleXML = "../ressources/articlesTest.xml";
		$exist = false;
		// Get an instance of Domdocument 
		$doc = new DOMDocument();
		  if(!file_exists($fileArticleXML)){
			  // specify the version and encoding
			  $doc->version = '1.0';
			  $doc->encoding = 'utf-8';
			  
			  // Create a comment
			  $comment_elt = $doc->createComment("lister les fichiers d'un dosssier");
			  // Put this comment at the Root of the XML doc
			  $doc->appendChild($comment_elt);
			  
			  // Create an Empty element 'note'
			  $note_elt = $doc->createElement('articles');
			  // Put the 'note' element at the Root of the XML doc (just after the comment)
			  $doc->appendChild($note_elt);
		  }else{
			 $exist = true;
			 $doc->load($fileArticleXML); // Chargement à partir de citations.xml
			 $note_elt = $doc->getElementsByTagName('articles')->item(0);
		  }
		  
		  
		//titre-auteur-date
		foreach (glob($dossierBaseArticle) as $rep){
			if (is_dir($rep)) {
				//list($titre, $auteur) = explode("-", $rep);
				$titre = basename(strtok($rep, "-"));
				$auteur = strtok("-");
				$date = date("d/m/Y");
				foreach (glob("$rep/*.txt") as $filename) {
					$elem = $doc->createElement('aricle', basename($filename));
					$elem->appendChild($doc->createElement('titre', $titre));
					$elem->appendChild($doc->createElement('auteur', $auteur));
					$elem->appendChild($doc->createElement('date', $date));
					rename($filename, "../articles/articles/".basename($filename));
	
					foreach (glob("$rep/*") as $filenameImg)
					{
						$ext = strtolower(pathinfo($filenameImg,  PATHINFO_EXTENSION));
	
						if(in_array($ext, $valide_extensions))
						{
							$elem->appendChild($doc->createElement('image', basename($filenameImg)));
							rename($filenameImg, $dossierImage.basename($filenameImg));
						}
					}
					$note_elt->appendChild($elem); 
				}
			}//fin if
		}//fin foreach
		rmdir($rep);
		 // Beautify   
	 	  $doc->preserveWhiteSpace = FALSE;
		  $doc->formatOutput = true;  
		  
		  // Display the XML content we just created
		  //echo $doc->saveXML();
		  
		  $doc->save('../ressources/articles.xml');
	}
	
?>
