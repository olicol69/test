<div id="corps">
        <h1>Fiche personnel</h1>
		<p>
        <?php
			$id=$_POST['id'];
			$prenom=$_POST['prenom'];
			$nom=$_POST['nom'];
			$dateNaissance=$_POST['dateNaissance'];
			$dateArrivee=$_POST['dateArrivee'];
			$sexe=$_POST['sexe'];
			
			if ($sexe =='M') {$civilite='M.';} else {$civilite='Me';}
			
			$reqUpdatePersonnel = "";
			$reqUpdatePersonnel .= "update personnel set ";
			$reqUpdatePersonnel .= "prenom=\"".$prenom."\",";
			$reqUpdatePersonnel .= "nom=\"".$nom."\",";
			$reqUpdatePersonnel .= "dateNaissance=\"".$dateNaissance."\",";
			$reqUpdatePersonnel .= "dateArrivee=\"".$dateArrivee."\",";
			$reqUpdatePersonnel .= "sexe=\"".$sexe."\"";
			$reqUpdatePersonnel .= "where id=\"".$id."\"";
			
			$reponse = $bdd->query($reqUpdatePersonnel);
			echo "Mise à jour effectuée";
		?>
 		</p>
</div>
	