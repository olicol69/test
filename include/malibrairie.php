<?php
function dblQuote($texte)
{
	return "\"".$texte."\"";
}

function afficherChampFormulaire($id,$label,$type,$tailleMax,$flagObligatoire,$flagModifiable,$valeur,$liste)
{
	$chfTailleMax="";
	if ($tailleMax>0) {$chfTailleMax="maxlength=\"".$tailleMax."\" ";}
	$obligatoire="";
	$iconeObligatoire="";
	if ($flagObligatoire) {$obligatoire = "required";$iconeObligatoire="<span class=\"obligatoire\">*</span>";}
	$modifiable="readonly";
	if ($flagModifiable) {$modifiable = "";}
	
	$html="<label for=\"".$id."\">".$label."</label>";
	
	if ($type<>"select")
	{
	//ajout champ text, date,... 
		//les champs date ont une classe date pour utiliser les calendriers jscript
		if ($type=="date")
		{
			$type="text";
			$classe="class=\"date\"";
		}
		else
		{
			$classe="";
		}	
		
		$html = $html."<input type=\"".$type."\" ".
		$modifiable.
		" name=\"".$id."\" ".
		"id=\"".$id."\" ".
		$classe." ".
		"value=\"".$valeur."\"".
		$chfTailleMax." ".
		$obligatoire.
		"/>".$iconeObligatoire."<br/>";
	}
	else
	
	//ajout liste de roulante remplie à partir du tableau $liste à 2 dimensions [code, libelle] 
	{
		$html = $html."<select name=".$id.
		" size=\"1\" ".
		"id=\"".$id."\" ".
		$chfTailleMax.
		$obligatoire.">";

		foreach($liste as $optionCode=>$optionLibelle)
		{
			if ($valeur == $optionCode)
			{
				$selected="selected";
			}
			else
			{
				$selected="";
			}
			
			$html = $html."<option value=\"".$optionCode."\" ".$selected.">".$optionLibelle.
			
			"</option>";
		};
		
		$html=$html.
		
		"</select>".$iconeObligatoire."<br/>";
	}
	return $html;
}

?>
	