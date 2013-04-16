<?php
	function lireFichierXMLYoutube($fichier){
		$document_xml = new DomDocument(); // Instanciation de la classe DomDocument : création d'un nouvel objet
		$document_xml->load($fichier); 
		$lesVideos = $document_xml->getElementsByTagName('video');
		//array_reverse($lesVideos); //not a array
		$index = 0;
		foreach($lesVideos as $video){
			if($index == 4) return;
			$id = $lesVideos->item($index)->nodeValue;
			$content = file_get_contents("http://youtube.com/get_video_info?video_id=".$id);
			parse_str($content, $ytarr);
			echo '<td><img class="youtube" id="'.$id.'"  src="http://img.youtube.com/vi/'.$id.'/0.jpg" title="'.$ytarr['title'].'" /></td>';
			$index++;
		}
	}