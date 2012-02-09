<?php include '../classes/Article.php' ?>
<?php include '../classes/Utilitaire.php' ?>

<?php
$url = "../articles/recent";

$tabFichArticle = Utilitaire::getFichiers($url);
$contenuArticle = array();
$index = 0;
foreach($tabFichArticle as $fichier){
	echo $fichier.'<br/>';
	$contenuArticle[$index] = Utilitaire::lireFichier($url.'/'.$fichier);
	$index++;//echo $fichier.'<br/>';
}

//test affichage
foreach($contenuArticle as $article){
	$i = 0;
	foreach($article as $ligne){
		echo $ligne.'<br/>';
	}
}

?>