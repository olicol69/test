<?php
//On se connecte � MySQL

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
/* veillez bien � vous connecter � votre base de donn�es */

$term = $_GET['term'];

$requete = $bdd2->prepare('SELECT * FROM service WHERE libelle LIKE :term'); // j'effectue ma requ�te SQL gr�ce au mot-cl� LIKE
$requete->execute(array('term' => '%'.$term.'%'));

$array = array(); // on cr�� le tableau

while($donnee = $requete->fetch()) // on effectue une boucle pour obtenir les donn�es
{
    array_push($array, $donnee['libelle']); // et on ajoute celles-ci � notre tableau
}

echo json_encode($array); // il n'y a plus qu'� convertir en JSON

?>