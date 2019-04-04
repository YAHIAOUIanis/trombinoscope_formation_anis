<?php
session_start ();
if (!isset($_SESSION['username']) or !isset($_SESSION['password'])) {
	header ('location: ./espace_enseignant.php');
	exit();
}
require_once "../include/util.inc.php";
require_once "../include/fonctions.inc.php";

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<title>trombinoscopes</title>
<meta charset="UTF-8"/>
<link rel="stylesheet" href="style.css" />
<?php echo generTrombinoCSS(); ?>
</head>
<body>
<header>
		
		<h1 style="text-align:center ; color:white">Espace trombinoscopes</h1>
<nav>
	<ul>
		<li><a href="../index.html">Accueil</a></li>
		<li><a href="./professeur_secretaire.php">Enseignant et Secrétaires</a></li>
		<li><a href="./logout.php">Déconnexion</a></li>
	</ul>
</nav>
</header>

<div>
	<?php
		if(isset($_POST['afficher'])   && isset($_POST['format'])){
			if(isset($_POST['groupe'])){
				$_SESSION['trombinoPath']="../gestionnaire/arborescence/".$_POST['groupe'];
				$_SESSION['trombinoType']='groupe';
				echo getPhotosTable($_SESSION['trombinoPath'],$_POST['format']);
			}
		}
		else{
			header ('location: ./professeur_secretaire.php');
		}
	?>			
</div>
<footer>
	<p style=" text-align :center">
			Auteurs : <strong><a href="mailto:yahiaoui.anis11@gmail.com" style="color:black">YAHIAOUI Anis & METIDJI Fares</a></strong> || Date : 01/02/2018 				
		</p>
		<p style="text-align :center">
			<a href="#tete">retour en haut de la page</a>
		</p>
	<?php 
	$infos = get_name_surname("../gestionnaire/dataProf.csv",$_SESSION['username']);
	if($infos == null){
		$infos = get_name_surname("../gestionnaire/dataSecret.csv",$_SESSION['username']);
	}
		echo "<p>Vous êtes connectés en tant que ".$infos["nom"]." , ".$infos["prénom"]."</p>";
	?>
</footer>
</body>
</html>
