
<?php
	require('./classes/Article.php');
	function lireFichierXML($fichier){
		$url = './ressources/'.$fichier;
		$document_xml = new DomDocument(); // Instanciation de la classe DomDocument : création d'un nouvel objet
		$document_xml->load($url); // Chargement à partir de citations.xml
		$lesArticles = $document_xml->getElementsByTagName('article');
		$index = 0;
		foreach($lesArticles as $article){
			$titre = $article->getElementsByTagName('titre')->item(0)->nodeValue;
			$auteur = $article->getElementsByTagName('auteur')->item(0)->nodeValue;
			$date = $article->getElementsByTagName('date')->item(0)->nodeValue;
			$description = $article->getElementsByTagName('description')->item(0)->nodeValue;
			$image = $article->getElementsByTagName('image')->item(0)->nodeValue;
			$url = $article->getElementsByTagName('url')->item(0)->nodeValue;
			$image = './images/images articles/preview/'.$image;
			$url = './articles/'.$url;
			$unArticle = new Article($titre, $date, $auteur, $description, $url, $image);
			afficherArticle($unArticle, ++$index);
		}
		
	}
	
	function afficherArticle($article, $index){
		$content = '<td><div class="cn_content"><table>
		<tr><td colspan="2" cellspacing="0" cellpadding="0"><img src="'.$article->getImage().'" alt=""/></td></tr>
		<tr><td colspan="2" cellspacing="0" cellpadding="0"><h1 class="title">'.$article->getTitre().'</h1></td></tr>
		<tr><td colspan="2" cellspacing="0" cellpadding="0"><p>'.$article->getDescription().'</p></td></tr>
		<tr><td><span class="cn_date">'.$article->getDate().'</span></td>
		<td align="left"><span class="cn_auteur">'.$article->getAuteur().'</span></td></tr>
		<tr><td colspan="2"><a href="'.$article->getUrl().'" target="_blank" class="cn_more">Read more</a></td></tr>
	</table></div></td>';
	echo $content.'<br/>';
	}
?>
