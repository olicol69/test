<?php
function recupererFichePersonnel ($bdd,$id)
{
	$reponse = $bdd->query(
	"SELECT 
		id,nom,prenom,sexe,
		DATE_FORMAT(dateNaissance,'%d/%m/%Y') as 'dateNaissance',
		DATE_FORMAT(dateArrivee,'%d/%m/%Y') as 'dateArrivee',
		codeService 
	FROM personnel 
		where id=".$id);
		
	$donnee = $reponse->fetch();
	return $donnee;
}
?>