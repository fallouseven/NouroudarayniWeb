<?php
	require('../classes/Utilitaire.php');
	require('testplaylist.php');
	require('../classes/Article.php');
	$valide_image_extensions = array('jpg', 'jpeg', 'gif', 'png', 'bmp');
	$valide_audio_extensions = array('mp3','mp4','wma');
	$dossierBaseArticle = "../articles/nouveau/*";
	$dossierArticle = "../articles/";
	$dossierImage ="../images/images articles/";
	$fileArticleXML = "../ressources/articlesTest.xml";
	$fileAudioXML = "../ressources/playlist.xml";
	$fileImageXML = "../ressources/diapo.xml";
	$exist = false;
	$contientfichierText = false;
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
	foreach (glob("../articles/nouveau/*") as $rep){
		
		if (is_dir($rep)) {
			foreach (glob("$rep/*.txt") as $filename) {
				$contientfichierText = true;
				$contenu = Utilitaire::lireFichier($filename);
				for($i=0; $i<count($contenu); $i++) $contenu[$i] = trim($contenu[$i]);
				$contenu = array_filter($contenu);
				$chaine = html_entity_decode(implode(" ",array_filter( $contenu)));//use htmlentities to save html format
				$elem = $doc->createElement('article');
				$titre = (preg_match('#<h1>(.*)</h1>#', $chaine , $regs))?$regs[1]:"";
				$auteur = (preg_match('#<i>(.*)</i>#', $chaine , $regs))?$regs[1]:"";
				$description = (preg_match('#<p>(.*)</p>#', $chaine , $regs))?current(str_split($regs[1], 100)):"";
				$date = date("d/m/Y");
				$url = "../articles/articles/".basename($filename);
				echo '<br>titre = '.$titre;
				echo '<br>auteur = '.$auteur;
				echo '<br>date = '.$date;
				echo '<br>description = '.$description;
				echo '<br>url = '.$url.'<br>';
				$elem->appendChild($doc->createElement('titre', $titre));
				$elem->appendChild($doc->createElement('auteur', $auteur));
				$elem->appendChild($doc->createElement('description', $description));
				$elem->appendChild($doc->createElement('date', $date));
				$elem->appendChild($doc->createElement('url', $url));
				//($unTitre, $uneDate, $unAuteur, $uneDesc, $unUrl, $uneImage)
				$url = str_replace(".txt", ".php", $url);
				$article = new Article($titre, $date, $auteur, $description, $url, "");
				$article->setContenu($chaine);
				creationPageArticle($article);
				//rename($filename, "../articles/articles/".basename($filename));

				foreach (glob("$rep/*") as $filenameImg)
				{
					$ext = strtolower(pathinfo($filenameImg,  PATHINFO_EXTENSION));

					if(in_array($ext, $valide_image_extensions))
					{
						$elem->appendChild($doc->createElement('image', basename($filenameImg)));
						//rename($filenameImg, "../images/images articles/".basename($filenameImg));
					}
					else if(in_array($ext, $valide_audio_extensions))
					{
						$elem->appendChild($doc->createElement('audio', basename($filenameImg)));
						//rename($filenameImg, "../media/audio/".basename($filenameImg));
					}
				}
				if($elem !== NULL) $note_elt->appendChild($elem); 
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
		  
		  // Save this to images.xml
		  $doc->save('../ressources/articlesTest.xml');
	function creationPageArticle($article){
		$page = "";
	$page = '<section>
			  <div class="imageArticle">iamge</div>
			  <article>
			  	<header>
				<h1>'.$article->getTitre().'</h1>
			  	</header>
			   <p>'.$article->getContenu().'</p>
			   <footer>
				 <p>
					Auteur : '.$article->getAuteur().'
					 <time datetime="'.$article->getDate().'">'.$article->getDate().'</time>
				 </p>
			   </footer>
			 </article>
			 </section>';
			
			$fichier = fopen($article->getUrl(), "w+");
			fwrite($fichier, $page); 
			fclose($fichier); 
			
			echo "la page \n".$page;
	
	}

?>