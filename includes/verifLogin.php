<?php
// On d�marre la session
session_start();

 $loginOK = false;  // cf Astuce
 $password = "1234";
 $hostname = "localhost";
 $database = "nourouDarayni";
 $username = "root";
 
 
// On n'effectue les traitement qu'� la condition que
// les informations aient �t� effectivement post�es
if ( isset($_POST) && (!empty($_POST['login'])) && (!empty($_POST['password'])) ) {

  //extract($_POST);  // je vous renvoie � la doc de cette fonction
 $login = $_POST['login'];
 $mdp = $_POST['password'];
	
$conn = mysql_connect($hostname, $username, $password) 
	or die("Connecting to MySQL failed");

mysql_select_db($database, $conn)
	or die("Selecting MySQL database failed");
	
  // On va chercher le mot de passe aff�rent � ce login
  $sql = "SELECT* FROM membre WHERE pseudo = \"$login\"";
  $req = mysql_query($sql, $conn) or die('Erreur SQL : <br />'.$sql);
 
  // On v�rifie que l'utilisateur existe bien
  if (mysql_num_rows($req) > 0) {
     $data = mysql_fetch_assoc($req);
  }

    // On v�rifie que son mot de passe est correct
   if ($mdp == $data['motDePasse']) {
      $loginOK = true;
      echo "mot de passe = $mdp";
  }
  
  if($loginOK == true){
  	echo  $data['nom'];
   echo '<br>';
   echo  $data['prenom'];
   echo '<br>';
   echo  $data['email'];
   echo '<br>';
   echo  $data['adresse'];
   echo '<br>';
   echo  $data['telephone'];
  }
  else{
	echo 'Mot de passe incorrect!!!';
  }
  mysql_close($conn);
}
else{
	echo 'le mot de passe ou le login est vide';
}



// Si le login a �t� valid� on met les donn�es en sessions



/*$sSQL =  "SELECT nom, prenom FROM membre";
$result = mysql_query($sSQL, $conn);

while($row = mysql_fetch_object($result)) { 
	echo $row->nom . " " . $row->prenom . "
";
}*/

?>