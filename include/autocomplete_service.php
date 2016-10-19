<?php
//On se connecte à MySQL

	try
	{
		$options = array(
			PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES utf8",
			PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION
			);
		$bdd2 = new PDO('mysql:host=localhost;dbname=test', 'root','',$options);
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
		exit;
	} 
/* veillez bien à vous connecter à votre base de données */

$term = $_GET['term'];

$requete = $bdd2->prepare('SELECT * FROM service WHERE libelle LIKE :term'); // j'effectue ma requête SQL grâce au mot-clé LIKE
$requete->execute(array('term' => '%'.$term.'%'));

$array = array(); // on créé le tableau

while($donnee = $requete->fetch()) // on effectue une boucle pour obtenir les données
{
    array_push($array, $donnee['libelle']); // et on ajoute celles-ci à notre tableau
}

echo json_encode($array); // il n'y a plus qu'à convertir en JSON

?>