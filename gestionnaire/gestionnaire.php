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
				<li><a href="./gestionnaire_prof.php">		Gestion des Professeurs </a></li>
				<li><a href="./gestionnaire_secret.php">		Gestion des Secrétaires	</a></li>
			</ul>
		</nav>		
	</header>
	</div>
	<div class="floating-box">
		<form class="formArbo" method="post" action="gestionnaire.php">
			<h2 style="text-align:center">Gestion de l'Arborescence</h2>
			<table style="margin-left:20%">
				<tr>
					<td style="width:40%"><label for="filiere" class="labelId">Filiere : </label></td>
					<td><input id="filiere" name="filiere" type="text" size="20"/></td>
				</tr>
							
				<tr>
					<td style="width:40%"><label for="groupeTd" class="labelMp">Groupe TD : </label></td>
					<td><input id="groupeTd" name="groupeTd" type="text" size="20"/></td>
				</tr>
			</table>									
			<input class="bouttonConnexion" type="submit" name="ajouter" value="Ajouter"/>
			<input style="margin-left: 2%; background-color: bisque;" type="submit" name="supprimer" value="Supprimer"/>
		</form>
		<?php
		// cette première partie ajoute filière/groupe:
			if(isset($_POST['filiere']) AND isset($_POST['groupeTd'])){				
				if (isset($_POST['ajouter'])) {
					$grp = str_replace_espace(true,$_POST['groupeTd']);
					$filier = str_replace_espace(true,$_POST['filiere']);
					$directory='./arborescence/'.$filier.'/'.$grp;
					$directory_Filier = './arborescence/'.$filier;
					if (!file_exists($directory) AND !empty($_POST['groupeTd'])) {	
						$listData = array($filier,$grp,0);
						$listData2 = array($filier,0);
						if(!file_exists($directory_Filier)){							
							writeDataCSV("./dataEffectifs.csv",$listData2);
						}
						writeDataCSV("./dataEffectifs.csv",$listData);
						creat_Groupe_ID($filier,$grp);
						mkdir($directory,0777,true);		
						echo "<p style='color:green;text-align:center'>Groupe ajouté avec succès</p>";
					}
					elseif(!file_exists($directory_Filier) AND empty($_POST['groupe'])){
							mkdir($directory_Filier,0777,true);
							$listData = array($filier,0);
							writeDataCSV("./dataEffectifs.csv",$listData);
							echo "<p style='color:green;text-align:center'>Filière ajoutée avec succès</p>";
					}	
					else{
						echo "<p style='color:red;text-align:center'>Ce repertoire existe déja!</p>\n";
					}
				}
			}			
			
		//cette deuxième partie supprime filière/groupe
			if(isset($_POST['filiere']) AND isset($_POST['groupeTd'])){
				if(isset($_POST['supprimer'])) {
					$groupe = str_replace_espace(true,$_POST['groupeTd']);
					$filier = str_replace_espace(true,$_POST['filiere']);
					if (!empty($_POST['filiere']) AND !empty($_POST['groupeTd'])) {
						$directory='./arborescence/'.$filier.'/'.$groupe;
						if (file_exists($directory)) {
							$listWords = array($filier,$groupe);
							if(file_exists('dataEtudiant.csv')){
								deleteLineText("dataEtudiant.csv",$listWords);
							}
							deleteLineText("./dataGroupe_ID.csv",$listWords);
							deleteLineText("./dataEffectifs.csv",$listWords);
							rmAllDir($directory);
						}
					}
					elseif(!empty($_POST['filiere']) AND empty($_POST['groupeTd'])) {
						$directory='./arborescence/'.$filier;
						if (file_exists($directory)) {
							$listWords = array($filier);
							if(file_exists('./dataEtudiant.csv')){
								deleteLineText("../gestionnaire/dataEtudiant.csv",$listWords);
							}
							deleteLineText("./dataGroupe_ID.csv",$listWords);
							deleteLineText("./dataEffectifs.csv",$listWords);
							rmAllDir($directory);
						}
					}
				}
			}
		?>		
	</div>	
	<div class="floating-box2">
		<h2 style="text-align:center">Affichage de l'Arborescence</h2>
		<ul class="folder" style="margin: auto;overflow:auto;height:300px;width: 50%;">
			<?php afficher_arbo("./arborescence"); ?>
		</ul>	
	</div>
<?php
	echo footerConnexionEtudiant();
?>