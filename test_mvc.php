<!DOCTYPE html>
<html>
<head>
	<!--entete de la page-->
	<meta charset="UTF-8" />
	<![if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]>
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/cssmenu/styles.css" />
	<link rel="stylesheet" href="css/cssdate/datepicker.css" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
	<title>Application Personnel</title>
</head>
<body>
	<?php
	//On démarre la session
	session_start();

	//librairie php
	include 'include/malibrairie.php';

	//logo du site et le menu
	include 'include/logo.php';
	include 'include/menu.php';

	//On se connecte à MySQL
	try
	{
		$options = array(
			PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES utf8",
			PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION
			);
		$bdd = new PDO('mysql:host=localhost;dbname=test', 'root','',$options);
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
		exit;
	} 
	?>
	<section>
	<?php
		//On inclut le contrôleur s'il existe et s'il est spécifié
		if ((!empty($_GET['objet'])) && (!empty($_GET['action'])))
		{
//			$nomPage = 'controleurs/'.$_GET['objet'].'/'.$_GET['action'].$_GET['objet'].'.php';
			$nomPage = 'controleurs/action'.$_GET['objet'].'.php';
			
			if (is_file($nomPage))
			{
					include $nomPage;
			}
			else
			{
			echo "Page ".$nomPage." introuvable<br/>'";
			}
		}
		else
		{
			include 'controleurs/accueil.php';
		}
		//On ferme la connexion à MySQL
		//mysql_close();
	?>
	</section>
</body>
<?php include 'include/pied.php' ?>
</html>