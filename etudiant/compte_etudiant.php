<?php
if(!isset($_COOKIE['nom']) and !isset($_COOKIE['prenom'])) {
	header('location: ./identificationetudiants.php');
}
	require_once "../include/fonctions.inc.php";	
	require_once "../include/util.inc.php";	
	
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Compte Etudiant</title>
	<link href="./style.css" rel="stylesheet" type="text/css">
</head>
<body>
<header>
		<h1 style="text-align:center;color:white">Espace Étudiant</h1>
		<nav>
			<ul>
				<li><a href="../index.html">Accueil</a></li>
				<li><a href="./logout.php">Déconnexion</a></li>
			</ul>
		</nav>
</header>
<section class="formProf" style="width:60%">
	<h2 style="text-align:center;color:white">Mon Compte Personnel</h2>
	<?php 
		echo "<p>Bienvenu(e), <strong>".strtoupper($_COOKIE["nom"]." ".$_COOKIE["prenom"])."</strong> sur votre compte.</p>";
	?>
	<table style="margin-bottom:2%;"> 
	<tr>
	<td>
		<form style="width: 50%; margin: 10% auto;" method="post" action="compte_etudiant.php" enctype="multipart/form-data">
			<fieldset style="background-color: #fefbd8;">
	
			<legend style="background-color: #fefbd8;"><strong>Charger/Modifier votre photo :</strong></legend>
			<?php
				echo selection_groupe("../gestionnaire/arborescence");
			?>
			</fieldset>	
	</form>
	<?php
	if(isset($_POST['upload'])){
		if(isset($_POST['filier']) and isset($_FILES['file'])){
			$file = $_FILES['file'];
			
			$groupe_etudiant = explode('/', $_POST['filier']);

			$file_name = $file['name'];
			$file_tmp = $file['tmp_name'];
			$file_size = $file['size'];
			$file_error = $file['error'];		
		
			$nom = $_COOKIE['nom'];
			$prenom = $_COOKIE['prenom'];
			$numero = $_COOKIE['numero'];
			$file_ext = explode('.', $file_name);
			$file_ext = strtolower(end($file_ext));
		
			$fillier = $_POST['filier'];
		
			$file_name_new = strtoupper($nom)."_".$prenom.'.'.$file_ext;
			$file_destination = "../gestionnaire/arborescence/".$fillier.'/'.$file_name_new;
			
			if(verify_groupe_etudiant($groupe_etudiant[0], $groupe_etudiant[1], $nom, $prenom, $numero)){
				$has_upload = true;
				upload_image($_POST['filier'],$nom,$prenom,$numero,$file_ext,$file_destination,$file_error,$file_size,$file_tmp);
			}
			else {
				$has_upload = false;
				echo "<p style='color:red;text-align:center'>Tentative de changement de groupe. 
				Veuillez sélectionner votre vrai filière!</p>\n";
			}
		}
		else {
			if(!isset($_POST['filier'])){
				echo "<p style='color:red;text-align:center'>Veuillez sélectionner votre filière!</p>\n";
			}
		}
	}	
	?>	
	</td>
		<td>
		<?php
		$saut = "\n";
		$tab = "\t";
			if(!empty($file_destination) and $has_upload) {
				echo "\t<figure style='margin: 50px 200px auto;'>\n";	
				echo "\t\t<img style='border:3px solid black;' src='".$file_destination."' alt='".$_COOKIE['nom']."' />\n";		
				echo "\t<figcaption style='caption-side: bottom; text-align: center; background-color: #fefbd8; opacity: 0.7;'><em>".date('l-j-m-Y G:m:s')."</em></figcaption>\n";			
				echo "\t</figure>\n";				
			}
			else if(verify_pic_nom($_COOKIE['nom'],$_COOKIE['prenom'],$_COOKIE['numero'],$_COOKIE['groupe']) != null){
				$liste = verify_pic_nom($_COOKIE['nom'],$_COOKIE['prenom'],$_COOKIE['numero'],$_COOKIE['groupe']);
				echo "\t<figure style='margin: 50px 200px auto;'>\n";	
				echo "\t\t<img style='border:3px solid black;' src='".$liste[3]."' alt='".$_COOKIE['nom']."' />\n";			
				echo "\t<figcaption style='caption-side: bottom; text-align: center; background-color: #fefbd8; opacity: 0.7;'><em>".$liste[2]."</em></figcaption>\n";		
				echo "\t</figure>\n";
			
			}
		?>
	</td>
	</tr>
	</table>
	</section>
<?php
	echo footerConnexionEtudiant();
?>
