<?php
	include "/vues/personnel/fichePersonnel.php";
	
	$err="";
	$donnee['id']="";
	$donnee['prenom']="";
	$donnee['nom']="";
	$donnee['dateNaissance']="";
	$donnee['dateArrivee']="";
	$donnee['sexe']="M";
	$donnee['codeService']="";
	
	afficherFichePersonnel($donnee,$err);
?>