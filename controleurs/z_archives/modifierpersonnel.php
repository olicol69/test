<?php
	include "/modeles/personnel/recupererFichePersonnel.php";
	include "/vues/personnel/fichePersonnel.php";
	
	$donnee = recupererFichePersonnel($bdd,$_GET['id']);
	$err="";

	afficherFichePersonnel($donnee,$err);
?>