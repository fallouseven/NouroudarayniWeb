<?php
	require('../classes/Utilitaire.php');
	require('testplaylist.php');
	require('../classes/Article.php');
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
	$doc = new DOMDocument();
	  if(!file_exists($fileArticleXML)){ //TODO tester cas vide
		  // specify the version and encoding
		  $doc->version = '1.0';
		  $doc->encoding = 'utf-8';
		  
		  // Create a comment
		  $comment_elt = $doc->createComment("lister les fichiers d'un dosssier");
		  // Put this comment at the Root of the XML doc
		  $doc->appendChild($comment_elt);
		  
		  // Create an Empty element 'articles'
		  $note_elt = $doc->createElement('articles');
		  // Put the 'note' element at the Root of the XML doc (just after the comment)
		  $doc->appendChild($note_elt);
	  }else{
		 $exist = true;
		 $doc->load($fileArticleXML); // Chargement à partir de citations.xml
		 $note_elt = $doc->getElementsByTagName('articles')->item(0);
	  }
	  
	  
	//titre-auteur-date
	foreach (glob("../articles/depot/*") as $rep){
		
		if (is_dir($rep)) {
			foreach (glob("$rep/*.txt") as $filename) {
				$contientfichierText = true;
				//$contenu = Utilitaire::lireFichier($filename);
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
				/*echo '<br>titre = '.$titre;
				echo '<br>auteur = '.$auteur;
				echo '<br>date = '.$date;
				echo '<br>description = '.$description;
				echo '<br>url = '.$url.'<br>';*/
				$elem->appendChild($doc->createElement('titre', $titre));
				$elem->appendChild($doc->createElement('auteur', $auteur));
				$elem->appendChild($doc->createElement('description', $description));
				$elem->appendChild($doc->createElement('date', $date));
				$elem->appendChild($doc->createElement('url',"./articles/articles/".basename($url)));
				
				//($unTitre, $uneDate, $unAuteur, $uneDesc, $unUrl, $uneImage)
				$article = new Article($titre, $date, $auteur, $description, $url, "");
				$article->setContenu($contenu);
				
				//rename($filename, "../articles/articles/".basename($filename));

				foreach (glob("$rep/*") as $filenameImg)
				{
					$ext = strtolower(pathinfo($filenameImg,  PATHINFO_EXTENSION));

					if(in_array($ext, $valide_image_extensions))
					{
						$articleAvecImage = true;
						$elem->appendChild($doc->createElement('image', basename($filenameImg)));
						//$filenameImg = str_replace("./images/images articles/", "./", $filenameImg);
						$article->addImage(basename($filenameImg));
						//rename($filenameImg, "../images/images articles/".basename($filenameImg));
					}
					else if(in_array($ext, $valide_audio_extensions))
					{
						$elem->appendChild($doc->createElement('audio', basename($filenameImg)));
						//rename($filenameImg, "../media/audio/".basename($filenameImg));
					}
				}
				if(!$articleAvecImage){
					$elem->appendChild($doc->createElement('image', "blank.jpg"));
					$article->addImage("blank.jpg");
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
	
	function lireFichierXML($fichier){
		echo  "in in in";
		$tabArticles = array();
		$url = "../ressources/".$fichier;
		$document_xml = new DomDocument(); // Instanciation de la classe DomDocument : création d'un nouvel objet
		$document_xml->load($url); 
		$lesArticles = $document_xml->getElementsByTagName('article');
		//array_reverse($lesArticles); //not a array
		$index = 0;
		$page_article_prev = '';
		foreach($lesArticles as $article){
			if($index == 4) break;
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
			$page_article_prev .= saveArticle($unArticle);	
			//echo $page_article_prev;
			$index++;
		}
		echo $page_article_prev;
		$file_article_prev = fopen('articles_new.php', "x+");
			fwrite($file_article_prev, $page_article_prev); 
			fclose($file_article_prev); 
		
	}

	function saveArticle($article){
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
	return $content;
	}

?>