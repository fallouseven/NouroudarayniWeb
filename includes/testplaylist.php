<?php


	function creerPlayList($type, $audios){
		$typePlaysList = array('khassaide', 'wakhtane', 'xamxam', 'zikroullah', );
		$baseLocation = "";
		$creator = 'Cheikh Ahmadou Bamba';
		$image = "";
		$link = "";
		$info = "";
		$album ="";
		$title = "";
		$annotation ="";
		$duration = "";
		  $filePlayList = "../ressources/".$type."Playlist.xml";
		// Get an instance of Domdocument 
		  $doc = new DOMDocument();
		  if(!file_exists($filePlayList)){
			  // specify the version and encoding
			  $doc->version = '1.0';
			  $doc->encoding = 'utf-8';
			  
			  // Create a comment
			  $comment_elt = $doc->createComment("playlist audios");
			  // Put this comment at the Root of the XML doc
			  $doc->appendChild($comment_elt);
			  
			   $playlist_elt = $doc->createElement('playlist');
			   $playlist_elt->version = '1';
			   $playlist_elt->xmlns = 'http://xspf.org/ns/0/';
			   $doc->appendChild($playlist_elt);
			   
			   $playlist_elt->appendChild($doc->createElement('title', $type));
			   $playlist_elt->appendChild($doc->createElement('creator', $creator));
			   $playlist_elt->appendChild($doc->createElement('link', $link));
			   $playlist_elt->appendChild($doc->createElement('info', $info));
			   $trackList_elt = $doc->createElement('trackList');
			   $playlist_elt->appendChild($trackList_elt);
		  }else{
		  		$doc->load($filePlayList); // Chargement à partir de citations.xml
		 		$trackList_elt = $doc->getElementsByTagName('trackList')->item(0);
		  }
		  
		
			foreach ($audios as $audio) {
				$track_elt = $doc->createElement('track');
				$trackList_elt->appendChild($track_elt);
				
				$track_elt->appendChild($doc->createElement('location', $audio)); 
				$track_elt->appendChild($doc->createElement('creator', $creator));
				$track_elt->appendChild($doc->createElement('album', $album));
				$track_elt->appendChild($doc->createElement('title', basename($audio)));
				$track_elt->appendChild($doc->createElement('annotation', $annotation));
				$track_elt->appendChild($doc->createElement('durarion', $duration));
				$track_elt->appendChild($doc->createElement('image', $image));
				$track_elt->appendChild($doc->createElement('info', $info));
				$track_elt->appendChild($doc->createElement('link', $link));
			}
		  
		  // Beautify   
		  $doc->formatOutput = true;  
		  
		  // Display the XML content we just created
		  //echo $doc->saveXML();
		  
		  // Save this to images.xml
		  $doc->save($filePlayList);
	} 
?>