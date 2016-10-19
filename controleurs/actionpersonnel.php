<?php
	// repecurer le parametre d'action
	
	if (isset($_GET['action']))
	{
		$action = $_GET['action'];
	}
	else
	{
		$action = "liste";
	}

	switch ($action) 
	{
    case "liste":
		/************************
		 *** Controleur LISTE ***
		 ************************/
		
		// inclure les fonctions modele et vue
		include "./modeles/personnel/listepersonnel.php";
		include "./vues/personnel/listepersonnel.php";
		
		$nbLigneParPage=3; //Nous allons afficher 3 lignes par page.

		$infoPagination = recupererPaginationPersonnel();
		
		//Nous allons maintenant compter le nombre de pages.
		$nombreDePages=ceil($infoPagination['nbLigne']/$nbLigneParPage);

		//Récupérer le numéro de page courant
		if(isset($_GET['page'])) // Si la variable $_GET['page'] existe...
		{
			$pageActuelle=intval($_GET['page']);
 
			if($pageActuelle>$nombreDePages) // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nombreDePages...
			{
				$pageActuelle=$nombreDePages;
			}
		}
		else // Sinon
		{
			$pageActuelle=1; // La page actuelle est la n°1    
		}

		
		//recuperer la liste des personnels
		$donnees = recupererListePersonnel($pageActuelle,$nbLigneParPage);
		
		// afficher la vue des personnels
		afficherListePersonnel($donnees,$nombreDePages,$pageActuelle);
        break;
    case "creer":
		/************************
		 *** Controleur CREER ***
		 ************************/
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
        break;
	case "modifier":
		/***************************
		 *** Controleur MODIFIER ***
		 ***************************/
		include "/modeles/personnel/recupererFichePersonnel.php";
		include "/vues/personnel/fichePersonnel.php";
		
		$donnee = recupererFichePersonnel($bdd,$_GET['id']);
		$err="";

		afficherFichePersonnel($donnee,$err);
		break;
	case "enregistrer":
		/******************************
		 *** Controleur ENREGISTRER ***
		 ******************************/
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
			echo "Fiche enregistrée";
		}
		afficherFichePersonnel($donnee,$err);
		break;

	case "supprimer":
		/****************************
		 *** Controleur SUPPRIMER ***
		 ****************************/

		 include "/modeles/personnel/supprimerpersonnel.php";
		$id=$_GET['id'];
		$result = false;
		if (isset($id)) {
			$result = supprimerPersonnel($bdd,$id);
		}
		if ($result) {
			echo "Fiche supprimée";
		}
		else{echo "Id non fourni";}
		
		break;
	}
?>