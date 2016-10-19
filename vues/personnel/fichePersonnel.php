<?php
function afficherFichePersonnel ($donnee,$err)
{
	$label['id']="id";
	$id=$donnee['id'];
	$label['prenom']="Prénom";
	$prenom=$donnee['prenom'];
	$label['nom']="Nom";
	$nom=$donnee['nom'];
	$label['dateNaissance']="Date de naissance";
	$dateNaissance=$donnee['dateNaissance'];
	$label['dateArrivee']="Date d'arrivée";
	$dateArrivee = $donnee['dateArrivee'];
	$label['sexe']="Sexe";
	
	
	//initialiser tableau des sexes
	//!! a transférer dnas la partie MODELE dans un script chargeant toutes les listes code&libelle
	//et passer ces listes en paramètre ARRAY  à la partie vue
	$listeSexe = array("F"=>"Féminin","M"=>"Masculin");
	
	$sexe=$donnee['sexe'];
	$label['codeService']="Service";
	$codeService=$donnee['codeService'];
	
	//chargement tableau code/libelle des services
	$listecodeService[""] = ""; //ajout choix "valeur non renseignée"
	//chargement table service
	global $bdd;
	$reponse = $bdd->query("SELECT code,libelle FROM service"); 
	while ($donnee = $reponse->fetch())
	{
		$listecodeService[$donnee['code']] = $donnee['libelle'];
	}
	$reponse->closeCursor();
		
	echo 
	"<div id=\"corps\">
		<h1>Fiche personnel</h1>
		<p>
			<form method=\"post\" action=\"test_mvc.php?objet=personnel&action=enregistrer\">";

			echo afficherChampFormulaire("id",$label['id'],"text",10,true,false,$id,"");
			echo afficherChampFormulaire("prenom",$label['prenom'],"text",100,true,true,$prenom,"");
			echo afficherChampFormulaire("nom",$label['nom'],"text",100,true,true,$nom,"");
			echo afficherChampFormulaire("dateNaissance",$label['dateNaissance'],"date",0,false,true,$dateNaissance,"");
			echo afficherChampFormulaire("dateArrivee",$label['dateArrivee'],"date",0,true,true,$dateArrivee,"");
			echo afficherChampFormulaire("sexe",$label['sexe'],"select",100,true,true,$sexe,$listeSexe);
			echo afficherChampFormulaire("codeService",$label['codeService'],"select",100,true,true,$codeService,$listecodeService);
			echo "<input type=\"submit\" value=\"Enregistrer\"/>
			<INPUT type=\"button\" value=\"Retour\" onClick=\"window.history.back()\">
			</form>
		</p>
	</div><br/>";
	
	//En cas d'erreur
	if ($err!="")
	{
	//Indiquer les erreurs de saisie
		echo "<div class=\"erreur\">";
		echo "Valeur erronée dans la zone ".$label[$err]."<br/>";
		echo "Veuillez corriger le formulaire<br/>";
	//mettre le focus sur le champ à corriger
		echo "<script>document.getElementById(\"".$err."\").focus()</script>";
		echo "</div><br/>";
	}
	
	// javascript
	echo "<script src=\"js/malibrairie.js\"></script>";
}
?>