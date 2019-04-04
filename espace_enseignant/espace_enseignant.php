<?php 
	session_start ();
	include_once("../include/fonctions.inc.php");
	include_once("../include/util.inc.php");	
	if (isset($_SESSION['username']) and isset($_SESSION['password'])) {
		if (verify("../gestionnaire/dataProf.csv",$_SESSION['username'],$_SESSION['password']) OR verify("../gestionnaire/dataSecret.csv",$_SESSION['username'],$_SESSION['password'])) {
			header('location: ./professeur_secretaire.php');
			exit();
		}		
	}
	$verify = true;       
	if(isset($_POST['CONNECTER'])){
		if(!empty($_POST['username'])){
			$_SESSION['username']=$_POST['username'];
		}
			if (verify("../gestionnaire/dataProf.csv",$_SESSION['username'],$_POST['password']) OR verify("../gestionnaire/dataSecret.csv",$_SESSION['username'],$_POST['password'])){
				$verify = true; 
				$_SESSION['password']=$_POST['password'];
				header('location: ./professeur_secretaire.php');
				exit();
      		}
      	else {
      		$verify = false;
      	}
 	 }  
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Enseignant/Secrétaire</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<link href="./style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<header>
	 	<h1 style="text-align:center ; color:white">Espace Enseignant / Secrétaire</h1>
		<nav> 	
			<ul class="menu">	
				<li><a href="../index.html">		Accueil		</a></li>
			</ul>
		</nav>		
	</header>
	<section class="formProf">
		<?php
		if(isset($_SESSION['username']) and (verify_login("../gestionnaire/dataProf.csv",$_SESSION['username']) || verify_login("../gestionnaire/dataSecret.csv",$_SESSION['username']))){
			$infos = get_name_surname("../gestionnaire/dataProf.csv",$_SESSION['username']);
			if($infos == null) {
				$infos = get_name_surname("../gestionnaire/dataSecret.csv",$_SESSION['username']);
			}			
			echo Echec_login_ProfsSecret(true,$infos['nom'],$infos['prénom']);
			echo loginFomulaProf(true);
		}
		else if(isset($_SESSION['username']) and (!verify_login("../gestionnaire/dataProf.csv",$_SESSION['username'])|| !verify_login("../gestionnaire/dataSecret.csv",$_SESSION['username']))){
			echo Echec_login_ProfsSecret(false);
			echo loginFomulaProf(false);
		}
		else {
			echo loginFomulaProf(false);
		}
		?>
	</section>
<?php
	echo footerConnexionEtudiant();
?>
