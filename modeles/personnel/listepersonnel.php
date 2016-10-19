<?php
	//modele liste personnel
	
	//r�cup�rer les infos de pagination
	function recupererPaginationPersonnel()
	{
		global $bdd;
		global $nbLigneParPage;
		$retour_total = $bdd->query("
		SELECT 
			count(*) as 'total'
		FROM personnel p;");
		
		$donnees_total=$retour_total->fetch(); //On range retour sous la forme d'un tableau.
		$info['nbLigne']=$donnees_total['total']; //On r�cup�re le total pour le placer dans la variable $total.
		$info['nbPage']=$donnees_total['total']/$nbLigneParPage; // On r�cup�re le NB de page.

		return $info;
	}
	
	//r�cup�rer la liste des personnels
	function recupererListePersonnel($noPage, $nbLigneParPage)
	{
		global $bdd;
		$premiereEntree=($noPage-1)*$nbLigneParPage; // On calcul la premi�re entr�e � lire
		$reponse = $bdd->query("
		SELECT 
			id,nom,prenom,sexe,
			DATE_FORMAT(dateNaissance,'%d/%m/%Y') as 'dateNaissance',
			DATE_FORMAT(dateArrivee,'%d/%m/%Y') as 'dateArrivee',
			s.libelle as 'service' 
		FROM personnel p,
			service s 
		where p.codeService=s.code order by nom,prenom,id limit ".$premiereEntree.", ".$nbLigneParPage);

		return $reponse;
	}
	
?>
