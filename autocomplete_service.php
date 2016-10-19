<?php

/* veillez bien � vous connecter � votre base de donn�es */

$term = $_GET['term'];

$requete = $bdd->prepare('SELECT * FROM service WHERE libelle LIKE :term'); // j'effectue ma requ�te SQL gr�ce au mot-cl� LIKE
$requete->execute(array('term' => '%'.$term.'%'));

$array = array(); // on cr�� le tableau

while($donnee = $requete->fetch()) // on effectue une boucle pour obtenir les donn�es
{
    array_push($array, $donnee['libelle']); // et on ajoute celles-ci � notre tableau
}

echo json_encode($array); // il n'y a plus qu'� convertir en JSON

?>