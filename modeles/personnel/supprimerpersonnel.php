<?php
function supprimerPersonnel ($bdd,$id)
{
	$result = false;
	if (!empty($id))
	{
		//si $id fourni alors delete

		$req = $bdd->prepare('delete from personnel where id =:id');
		$req->bindparam(':id', $id, PDO::PARAM_INT);
		try
		{
			$req->execute();
			$result = true;
		
		}
		catch (Exception $e)
		{
			die('Erreur : ' . $e->getMessage());
			$result = false;
			exit;
		} 
	}
	return $result;
}
?>