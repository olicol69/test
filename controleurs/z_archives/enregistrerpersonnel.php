<?php
	include "/modeles/personnel/enregistrerPersonnel.php";
	include "/vues/personnel/fichePersonnel.php";
	//récupérer les valeurs saisies dans le formulaire
	$donnee['id']=$_POST['id'];
	$donnee['prenom']=$_POST['prenom'];
	$donnee['nom']=$_POST['nom'];
	$donnee['dateNaissance']=$_POST['dateNaissance'];
	$donnee['dateArrivee']=$_POST['dateArrivee'];
	$donnee['sexe']=$_POST['sexe'];
	$donnee['codeService']=$_POST['codeService'];
	
	//Contrôler les valeurs saisies
	$err="";
	
	if (!preg_match("/^([a-zA-Z'àâéèêôùûçÀÂÉÈÔÙÛÇ[:blank:]-]{1,100})$/",$donnee['prenom']))
	{
		$err="prenom";
		afficherFichePersonnel($donnee,$err);
		exit;
	}
	if (!preg_match("/^([a-zA-Z'àâéèêôùûçÀÂÉÈÔÙÛÇ[:blank:]-]{1,100})$/",$donnee['nom']))
	{
		$err="nom";
		afficherFichePersonnel($donnee,$err);
		exit;
	}
	
	list($jour,$mois,$annee) = explode('/', $donnee['dateNaissance']);
	if (!checkdate($mois,$jour,$annee))
	{
		$err="dateNaissance";
		afficherFichePersonnel($donnee,$err);
		exit;
	}
	
	list($jour,$mois,$annee) = explode('/', $donnee['dateArrivee']);
	if(!checkdate($mois,$jour,$annee))
	{
		$err="dateArrivee";
		afficherFichePersonnel($donnee,$err);
		exit;
	}

	if (!preg_match("/^([a-zA-Z'àâéèêôùûçÀÂÉÈÔÙÛÇ[:blank:]-]{1,100})$/",$donnee['codeService']))
	{
		$err="codeService";
		afficherFichePersonnel($donnee,$err);
		exit;
	}

	
	//si saisie OK alors Enregistrer
	if ($err=="")
	{
		enregistrerPersonnel($bdd,$donnee);
		echo "Fiche personnel enregistrée";
	}
	afficherFichePersonnel($donnee,$err);
?>
