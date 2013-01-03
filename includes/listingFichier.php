<?php

/**
	Ici on gère la recherche des balises et des attributs, ainsi que leur comptage.
	Liste des fonctions:
		=>is_valid_url:		 teste la validité d' une url.
		=>startParse:		 fonction principale, démarre la recherche et renvoie le résultat formaté pour être traduit au format json.
		=>n_liens:		 cherche les premiers liens d' un site afin de les analyser.
		=>read:			 cherche les débuts de balises dans le site.
		=>parse:		 retourne les balises les unes après les autres.
		=>parse_balise:		 décompose une balise et effectue le comptage.
		=>ajout_part		 effectue les tâches particulières ( autres que les comptages de balises et attributs).
		=>get_adresse_absolue:	 retourne une adresse absolue d' un fichier lié à ouvrir.
	Liste des variables importantes:
		=>$perso:	 degré de personnalisation de la recherche
		=>$analyse:	 arbre de stockage des résultats
		=>$valide:	 état de la validité de l' adresse du site à analyser
		=>$url:		 url du site en cours d' analyse
		=>$text:	 tableau de stockage des caractères du site
		=>$txt:		 une balise complète sous forme de chaîne de caractères
		=>$element:	 nom de l' élément de la balise en cours
		=>$attribut:	 nom de l' attribut en cours d' analyse
		=>$adresse:	 adresse lue dans un attribut
		=>$val_attribut: valeur de l' attribut en cours d' analyse
*/
if(!isset($_SESSION))session_start();
include_once('analyse.php');
error_reporting(E_ALL);

//fonction de test de la validité d' une url
function is_valid_url($url){
    $url = @parse_url($url);
    if (!$url){
        return false;
    }
    $url = array_map('trim', $url);
    $url['port'] = (!isset($url['port'])) ? 80 : (int)$url['port'];
    $path = (isset($url['path'])) ? $url['path'] : '';
    if ($path == ''){
        $path = '/';
    }
    $path .= (isset($url['query'])) ? "?$url[query]" : '';
    if (isset($url['host']) AND $url['host'] != gethostbyname($url['host'])){
        $headers = get_headers("$url[scheme]://$url[host]:$url[port]$path");
        $headers = (is_array($headers)) ? implode("\n", $headers) : $headers;
        return (bool)preg_match('#^HTTP/.*\s+[(200|301|302)]+\s#i', $headers);
    }
    return false;
}

/*
initialise les outils de recherche, prenant en paramètre l' url su site à traiter
	1)teste si l' url est valide
	2)stocke le site dans un tableau
	3)lance le comptage
	4)Renvoie le résultat formaté à json pour l' interprétation javascript	*/
function startParse($url){
	$valide=true;
		$perso=$_SESSION['perso'];
		$liste=$_SESSION['liste'];
		$analyse = new analyse(new init ($perso,$liste));
	if ( is_valid_url($url)==false ){
		$valide=false;
	}
	if ($valide){
		$tab = array();
		$text=@file($url);
		if($text!=false){
			//on convertit le texte en tableau a 2 dimens...
			for($i=0;$i<count($text);$i++){
			     for($i2=0;$i2<strlen($text[$i]);$i2++){
				     $char = substr($text[$i],$i2,1);
				     $tab[$i][$i2] = $char;
			     }
			}
			read($tab,$analyse,$url);
			if($_SESSION['w3c']){
				$analyse->valid_w3c($url);
			}//fin if
		}//fin réussite ouverture
	}//fin validité url
	$json=$analyse->to_json();
	if ( (!$valide) || ($text==false) ){
		$json['val']=null;
	}
	$json['nb_analyse']=$_SESSION['nb_analyse']--;
	return $json;
}

/*
prend en praramètres l' adresse du site à analyser($url), ainsi que le nombre de liens à trouver($nb_liens)
retourne les premiers liens trouvés(jusqu' à nb_liens), ou l' url du site si celui-ci n' a pas pu être ouvert.		*/
function n_liens($url,$nb_liens){
	$text=@file_get_contents($url);
	$compteur=0;
	$liens=array($url);
	if($text!=false){
		do{
			$pos=strpos($text,'<');
			if ((($pos!=false)||($text[0]=='<'))){//nouvelle balise
				if (substr($text,$pos,4)=='<!--'){//la balise est un commentaire
					$text=substr($text,(strpos($text,'-->')+3));
				}else{//la balise n' est pas un commentaire
					$text=substr($text,$pos+1);
					$pos=true;
					$ltrim=ltrim($text);
					while($text!=$ltrim){//suppression des caractères indésirables
						$text=$ltrim;

						$ltrim=ltrim($text);
					}
					if ($text[0]=='a'){//si a estl' élément de la balise
						$text=substr($text,1);
						$ltrim=ltrim($text);
						while($text!=$ltrim){//suppression des caractères indésirables
							$text=$ltrim;
							$ltrim=ltrim($text);
						}
						$href=strpos($text,'href');
						//si href est attribut de la balise dont l' élément est a:
						if (($href<strpos($text,'>')&&$href!=false)||(substr($text,0,4)=='href')){
							$text=substr($text,$href);
							$href=strpos($text,'"');
							$href_b=strpos($text,"'");
							$char='"';
							if (($href>$href_b)&&($href_b!=false)){
								$href=$href_b;
								$char="'";
							}
							$text=substr($text,($href+1));
							$href=strpos($text,$char);
							$liens[$compteur]=get_adresse_absolue ($url,substr($text,0,$href));
							$compteur++;
						}//fin si href est attribut de la balise
					}//fin si a est l' élément de la balise
				}//fin balise
			}//fin non commentaire
		}while(($compteur<$nb_liens)&&($pos!=false));//fin tant qu'il n' y a pas assez de liens et que la fin de fichier n' est pas atteinte
	}
//print_r($liens);
	return $liens;
}

/*
prend en paramètre le tableau dans lequel est stocké le text($text), la liste des éléments recherchés($analyse), l' adresse($url)
cherche les débuts de balises dans le texte et appelle la fonction  parse pour les traiter						*/ 
function read ($text,$analyse,$url)
{
	$max_lin=count($text);
        for($count=0;$count<$max_lin;$count++){
	    $max_col = count($text[$count]);
            for($count2=0;$count2<$max_col;$count2++){
                $char = $text[$count][$count2];
                if($char == "<"){
			$r = parse($count,$count2,$text,$analyse,$url);
			if (isset($text[$r[0]][$r[1]-1])){
	                        $count = $r[0];
	                        $count2 = $r[1]-1;
	    			$max_col = count($text[$count]);
			}else{
				$count = $r[0]-1;
				$max_col = count($text[$count]);
			        $count2 = $max_col;
			}
		}
            }
        }
}

/*
prend en paramètre la position de la balise à traiter($lin,$col), le texte($text), les éléments à rechercher($analyse), ainsi que l' adresse du site
cherche la fin d' une balise, si des balises sont imbriquées, et appelle la fonction parse_balise pour les traiter les unes après les autres
retourne la position de fin de la balise traitée afin de reprendre la recherche à la bonne position						*/
function parse($lin,$col,$text,$analyse,$url){
		 $txt = "";
		 $col++;
		 $max_lin=count($text);
		 for($count=$lin;$count < $max_lin;$count++){
			$max_col = count($text[$count]);
		    	for($count2=$col;$count2 < $max_col;$count2++){
				     $col=0;
				     $char=$text[$count][$count2];
				     if($char == "<"){
				               	$r = parse($count,$count2,$text,$analyse,$url);
					if (isset($text[$r[0]][$r[1]-1])){
						$count = $r[0];
						$count2 = $r[1]-1;
					}else{
						$count = $r[0]-1;
						$count2 = $r[1];
						$max_col = count($text[$count]);
					}
				     }else if ($char == ">"){
				                $txt=$txt.$char;
						parse_balise ( $txt , $analyse,$url );
				                return array(($count),($count2));
				     }else{
				       $txt=$txt.$char;
				     }
		    	}
		 }
		 return array(($count),($count2));
}

/*
prend en paramètre une balise($txt), les éléments recherchés($analyse) et l' adresse($url)
décompose la balise afin de prendre les éléments dont nous avons besoin			*/
function parse_balise ( $txt , $analyse ,$url ){
	$txt=str_replace('>',' ',$txt);
	//suppression des éventuels caractères gênants avant le nom de l' élément
	$ltrim=ltrim($txt);
	while ( !($ltrim==$txt)){
		$txt=substr($txt,1,(strlen($txt)-1));
		$ltrim=ltrim($txt);
	}
	$espace=strpos($txt, ' ');
	//$element est le nom  de l' élément
	$element=strtolower(substr($txt,0,$espace));
	if ($element=='!doctype'){
		$analyse->traite_doctype( substr ($txt , strlen($element) , (strlen($txt)-strlen($element)) ));
	}
	$balises=$analyse->get_balises();
	//si l' élément trouvé est l' un de ceux recherchés
	if ( isset ( $balises[$element] ) ){
		$analyse->ajout_elt( $element );
		//si on cherche des attributs pour cet élément
		if ( count($balises[$element]>1) ){
			$txt=substr($txt,($espace+1),(strlen($txt)-$espace-1));
			 do{//analyse d' un attribut
				$espace=strpos($txt, ' ');
				//$attribut est l' attribut en cours d' analyse
				$attribut=substr($txt,0,$espace);
				//suppressions des éventuels caractères gênants avant le nom de l' attribut
				$trim=trim($attribut);
				while ( !($trim==$attribut)){
					$attribut=$trim;
					$trim=trim($attribut);
				}
				$attribut=str_replace('"','',$attribut);
				$attribut=str_replace('=','_',$attribut);
				//est-ce un attribut recherché?		
				if ( isset ( $balises[$element][$attribut] ) ){
					$analyse->ajout_attribut($element,$attribut);
				}else{
					$temp=$attribut;
					$attribut=substr($attribut,0,strpos($attribut,'_'));
					if ( isset ( $balises[$element][$attribut] ) ) {
						$analyse->ajout_attribut($element,$attribut);
					}
					$part=$analyse->get_particuliers_ana();
					if ( isset ( $part[($element.$attribut)] )){
						$val_attribut=substr($temp,(strpos($temp,'_')+1),(strlen($temp)-strpos($temp,'_')-1));
						ajout_part( $analyse ,$part , $element.$attribut , $val_attribut , $url);
					}
				}
				$txt=substr($txt,($espace+1),(strlen($txt)-$espace-1));
			 //tant qe tous les attributs de la balise n' ont pas été analysés
			}while  ( strpos($txt,' ') != false );
		}
	}
}

/*
prend en paramètre la liste de recherche($analyse), les recherches particulières($part), un attribut($attribut), sa valeur($val_attribut), l' url du site ($url)
fonction traitant les recherches particulières ( comme le comptage des lignes et fichiers .js et .css )		*/
function ajout_part( $analyse ,$part , $attribut , $val_attribut , $url){
	if ( ( substr ( $val_attribut , (strlen($val_attribut)-strlen($part[$attribut]['extension'])) , strlen($part[$attribut]['extension']) ) == $part[$attribut]['extension'] ) && ( !isset ($part[$attribut][$val_attribut] )) ){
		$adresse = get_adresse_absolue($url,$val_attribut);
		$analyse->ajout_adresse ( $attribut , $val_attribut , $adresse );
		$nb_lignes=@file($adresse);
		$nb_lignes=count($nb_lignes);
		$analyse->ajout_lignes ( $attribut, $nb_lignes );
		$part=$analyse->get_particuliers_ana();
	}
}

/*
prend en paramètre l' url du site($url)  et $adresse(une adresse trouvée dans une balise)
retourne cette adresse sous forme d' adresse absolue						*/
function get_adresse_absolue ( $url , $adresse ){
	if ( substr($adresse,0,7)==('http://')){
		return $adresse;
	}else{
		if ( strrpos($url,'/')==(strlen($url)-1)){
			$url=substr($url,0,(strlen($url)-1));
		}
		if ( substr($adresse,0,1)=='/'){
			$adresse=substr($adresse,1,(strlen($url)-1));
		}
		while ( substr($adresse,0,3)=='../' ){
			$url=substr($url,0,(strrpos($url,'/')-1));
			$adresse=substr($adresse,3,(strlen($adresse)-3));
		}
		if ( !is_valid_url($url.'/'.$adresse) ){
			$url=substr($url,0,(strrpos($url,'/')));
		}
		return ($url.'/'.$adresse);
	}
}

?>

