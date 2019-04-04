<?php
	include_once("../include/fonctions.inc.php");
	echo title_page("Espace Gestionnaire");
	include_once("../include/util.inc.php");
	include_once("../include/header.inc.php");
?>
<body>
	<div>
	<header>
		<h1 style="text-align:center ; color:white">Espace Gestionnaire</h1>
		<nav> 	
			<ul class="menu">	
				<li><a href="../index.html">		Accueil		</a></li>
				<li><a href="./gestionnaire.php">		Gestion de l'Arborescence </a></li>
				<li><a href="./gestionnaire_secret.php">		Gestion des Secrétaires	</a></li>
			</ul>
		</nav>		
	</header>
	</div>
	<section class="formProf">
		<form class="formArbo" method="post" action="gestionnaire_prof.php">
			<h2 style="text-align:center">Gestion des Professeurs</h2>
			<table style="margin-left:10%">
				<tr>
					<td style="width:50%"><label for="nom" class="labelId">Nom : </label></td>
					<td><input id="nom" name="nom" type="text" size="20"/></td>
				</tr>	
				<tr>
					<td style="width:50%"><label for="prenom" class="labelMp">Prénom : </label></td>
					<td><input id="prenom" name="prenom" type="text" size="20"/></td>
				</tr>
				<tr>
					<td style="width:50%"><label for="id" class="labelId">Identifiant : </label></td>
					<td><input id="id" name="id" type="text" size="20"/></td>
				</tr>							
				<tr>
					<td style="width:50%"><label for="mdp" class="labelMp">Mot de passe : </label></td>
					<td><input id="mdp" name="mdp" type="password" size="20"/></td>
				</tr>
			</table>									
			<input class="bouttonConnexion" type="submit" name="ajouter" value="Ajouter"/>
			<input style="margin-left: 2%; background-color: bisque;" type="submit" name="supprimer" value="Supprimer"/>
		</form>
		<?php
			if(isset($_POST['id']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mdp'])){
				//cette partie ajoute les enseignant
				if(isset($_POST['ajouter'])){
					$hashedPassWord=password_hash($_POST['mdp'],PASSWORD_DEFAULT);
					$listData = array($_POST["nom"],$_POST["prenom"],$_POST["id"],$hashedPassWord);
					if(!existeLineCSV("dataProf.csv",$listData)){
						writeDataCSV("dataProf.csv",$listData);
						echo"<p style='text-align:center; color:green;'>Professeur ajouté avec succès!</p>\n";
					}else{
						echo"<p style='text-align:center; color:red;'>Ce professeur est déjà inscrit!</p>\n";
					}
				}
				// cette partie supprime professeur
				if(isset($_POST['supprimer'])){
					$listWords = array($_POST['nom'],$_POST['prenom'],$_POST['id']);
					$remove = deleteLineText("dataProf.csv",$listWords);
					if($remove){
						echo"<p style='text-align:center; color:green;'>Professeur est supprimé avec succès!</p>\n";
					}
					else {
						echo"<p style='text-align:center; color:red;'>Professeur inexistant!</p>\n";
					}
				}
			}
		?>		
	</section>	
	<hr style="width:40%;text-align:center">
	<section class="liste_profs">
		<h2 style="text-align:center;">Liste des Professeurs</h2>
		<?php
			echo showListColumnsCSV("dataProf.csv",array(0,1));
		?>
	</section>
<?php
	echo footerConnexionEtudiant();
?>
