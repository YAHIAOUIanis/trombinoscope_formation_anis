<?php
	if(isset($_COOKIE['poste'])){
		header('location: ./compte_etudiant.php');
	}	
	include_once("../include/fonctions.inc.php");
	include_once("../include/util.inc.php");
	
	if(isset($_POST['CONNECTER'])){		
		if (isset($_POST['nom']) and isset($_POST['prenom'])){

			$nom = $_POST['nom'];
			$prenom = $_POST['prenom'];			
			$nom=str_replace("-", "_", $nom);
			$nom=str_replace(" ", "_", $nom);
			$nom=str_replace("'", "", $nom);
			$prenom=str_replace("-", "_", $prenom);
			$prenom=str_replace(" ", "_", $prenom);
			$prenom=str_replace("'", "", $prenom);
			setcookie("nom",$nom,time()+3600);
			setcookie("prenom",$prenom,time()+3600);
							
		}		
		elseif(isset($_COOKIE['nom']) and isset($_COOKIE['prenom'])){

			$nom = $_COOKIE['nom'];
			$prenom = $_COOKIE['prenom'];
			
		}
			
		if (verifyEtudiant($_POST['numero'],$_POST['groupe'],$nom,$prenom) ) {
			setcookie("groupe",$_POST['groupe'],time()+3600);
			setcookie("poste",true,time()+3600);
			setcookie("numero",$_POST['numero'],time()+3600);
			sleep(1);
			header('location: ./compte_etudiant.php');
			exit();
		}
		elseif(isset($_COOKIE['stop']) and $_COOKIE['stop'] == $nom) {
			$stop = true;
		}
		else {
			setcookie("stop",$_COOKIE['nom'],time()+1);
			sleep(1);
		}
	}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Inscription Etudiant</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<link href="./style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<header>
	 	<h1 style="text-align:center ; color:white">Espace Étudiant</h1>
		<nav> 	
			<ul class="menu">	
				<li><a href="../index.html">		Accueil		</a></li>
			</ul>
		</nav>		
	</header>
	<section class="formProf">
<?php
	if(isset($stop) and $stop){
		echo formulaireEtudiant(false);
	}
	elseif(!isset($stop) and isset($_POST['CONNECTER'])) {
		echo formulaireEtudiant(false);
		echo "\n\t<div>";
		echo  "\n\t\t<fieldset style='margin-left:10%;margin-right:10%;margin-bottom:5%;'>";
		echo  "\n\t\t\t<legend style='color: red;'><strong>Attention : </strong></legend>";
		echo   "\n\t\t\t<p>Si vous voulez s'inscrire en tant que<strong> $nom $prenom</strong>, Veuillez saisir la clé de votre groupe de td qu'on vous a donné antérieurement...Merci!</p>";
		echo  "\n\t\t</fieldset>";
		echo   "\n\t</div>";
	}
	else {
		echo formulaireEtudiant(false);
	}	
?>
	</section>
<?php
	echo footerConnexionEtudiant();
?>