<?php
/* $errno : type de l'erreur
$errstr : message d'erreur
$errfile : fichier correspondant à l'erreur
$errline : ligne correspondante à l'erreur */

/*
 * fonction qui chargera de gerer les erreurs appeler dans index.php
 * <?php set_error_handler('recuperer_erreur'); ?>
 * */
function recuperer_erreur($errno,$errstr,$errfile,$errline)
{
	// On définit le type de l'erreur
	switch($errno)
	{
		case E_USER_ERROR :
			$type = "Fatal:";
			break;
		case E_USER_WARNING :
			$type = "Erreur:";
			break;
		case E_USER_NOTICE :
			$type = "Warning:";
			break;
		case E_ERROR :
			$type = "Fatal";
			break;
		case E_WARNING :
			$type = "Erreur:";
			break;
		case E_NOTICE :
			$type = "Warning:";
			break;
		default :
			$type = "Inconnu:";
			break;
	}

	// On définit l'erreur.
	$erreur = $type."Message d'erreur : [".$errno."]".$errstr.
	"Ligne :".$errline." Fichier :".$errfile;

	/* Pour passer les valeurs des différents tableaux, nous utilisons la fonction serialize()
        Le rapport d'erreur contient le type de l'erreur, la date, l'ip, et les tableaux. */

	$info = date("d/m/Y H:i:s",time()).
	":".$_SERVER['REMOTE_ADDR'].
	"GET:".serialize($_GET).
	"POST:".serialize($_POST).
	"SERVER:".serialize($_SERVER).
	"COOKIE:".(isset($_COOKIE)? serialize($_COOKIE) : "Undefined").
	"SESSION:".(isset($_SESSION)? serialize($_SESSION) : "Undefined");

	// On ouvre le fichier
	$handle = fopen("log.txt", "a");

	// On écrit $erreur et $info
	if ($handle)
		fwrite($handle,$erreur.$info);
	else echo"Erreur d'ouverture du fichier.";

	fclose($handle);
}
?>