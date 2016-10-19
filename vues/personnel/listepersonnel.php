<?php
	function afficherListePersonnel ($reponse,$nbPage,$pageActuelle)
	{
		echo "<h1>Liste du personnel</h1>";
		echo "
		<table class=\"grille\">
			<tr>
				<th></th>
				<th></th>
				<th>Prénom</th>
				<th>Nom</th>
				<th>Dt naissance</th>
				<th>Dt arrivée</th>
				<th>Sexe</th>
				<th>Service</th>
			</tr>
		";
		while ($donnee = $reponse->fetch())
		{
			$id=$donnee['id'];
			$prenom=$donnee['prenom'];
			$nom=$donnee['nom'];
			$dateNaissance=$donnee['dateNaissance'];
			$dateArrivee=$donnee['dateArrivee'];
			$sexe=$donnee['sexe'];
			$service=$donnee['service'];
			
			echo 
			"<tr>
				<td><a href=\"test_mvc.php?objet=personnel&action=modifier&id=".$id."\"><img src=\"/test/vues/images/modify.png\"></a></td>
				<td><a href=\"test_mvc.php?objet=personnel&action=supprimer&id=".$id."\" class=\"confirmation\"><img src=\"/test/vues/images/delete.png\"  class=\"confirmation\"></a></td>
				<td>".$prenom."</td>
				<td>".$nom."</td>
				<td>".$dateNaissance."</td>
				<td>".$dateArrivee."</td>
				<td>".$sexe."</td>
				<td>".$service."</td>.
			</tr>";
		}
		$reponse->closeCursor();
		
    echo "</table>";
	echo '<p align="center">Page : '; //Pour l'affichage, on centre la liste des pages
	for($i=1; $i<=$nbPage; $i++) //On fait notre boucle
	{
		 //On va faire notre condition
		 if($i==$pageActuelle) //Si il s'agit de la page actuelle...
		 {
			 echo ' [ '.$i.' ] '; 
		 }	
		 else //Sinon...
		 {
			  echo ' <a href="test_mvc.php?objet=personnel&action=liste&page='.$i.'">'.$i.'</a> ';
		 }
	}
	echo '</p>';
// javascript
	echo "<script src=\"js/malibrairie.js\"></script>";
	}
?>
