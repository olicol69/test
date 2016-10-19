<?php
function enregistrerPersonnel ($bdd,$donnee)
{
	$id=$donnee['id'];
	$prenom=$donnee['prenom'];
	$nom=$donnee['nom'];
	
	list($jour,$mois,$annee) = explode('/', $donnee['dateNaissance']);
	$dateNaissance=$annee."-".$mois."-".$jour;
	
	list($jour,$mois,$annee) = explode('/', $donnee['dateArrivee']);
	$dateArrivee=$annee."-".$mois."-".$jour;
	
	$sexe=$donnee['sexe'];
	$codeService=$donnee['codeService'];

	if (empty($id))
	{
		//si $id vide alors insert
		$req = $bdd->prepare('insert personnel (prenom,nom,dateNaissance,dateArrivee,sexe,codeService) values (:prenom,:nom,:dateNaissance,:dateArrivee,:sexe,:codeService)');
		$req->bindParam(':prenom', $prenom, PDO::PARAM_STR,100);
		$req->bindParam(':nom', $nom, PDO::PARAM_STR,100);
		$req->bindParam(':dateNaissance', $dateNaissance, PDO::PARAM_STR,12);
		$req->bindParam(':dateArrivee', $dateArrivee, PDO::PARAM_STR,12);
		$req->bindParam(':sexe', $sexe, PDO::PARAM_STR,1);
		$req->bindParam(':codeService', $codeService, PDO::PARAM_STR,100);

		try
		{
			$req->execute();
		
		}
		catch (Exception $e)
		{
			die('Erreur : ' . $e->getMessage());
			exit;
		} 
	}
	else
	{
		$req = $bdd->prepare('update personnel set prenom=:prenom, nom=:nom, dateNaissance=:dateNaissance, dateArrivee=:dateArrivee, sexe=:sexe,codeService=:codeService where id =:id');
		$req->bindparam(':id', $id, PDO::PARAM_INT);
		$req->bindParam(':prenom', $prenom, PDO::PARAM_STR,100);
		$req->bindParam(':nom', $nom, PDO::PARAM_STR,100);
		$req->bindParam(':dateNaissance', $dateNaissance, PDO::PARAM_STR,12);
		$req->bindParam(':dateArrivee', $dateArrivee, PDO::PARAM_STR,12);
		$req->bindParam(':sexe', $sexe, PDO::PARAM_STR,1);
		$req->bindParam(':codeService', $codeService, PDO::PARAM_STR,100);
//		$req->debugDumpParams();
		try
		{
			$req->execute();
			
		}
		catch (Exception $e)
		{
			die('Erreur : ' . $e->getMessage());
			exit;
		} 
	}
}
?>