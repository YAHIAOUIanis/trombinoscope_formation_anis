<?php 

	
/**cette fonction génère un formulaire de connexion de l'étudiant
*@return un formulaire de connexion
*/

function formulaireConnexionEtudiant() {
	$var="\t\n<form method='post' action='connexion_etudiant.php'>";	
	$var.="\t\t\t\n<h2 style='text-align:center'>Un formulaire de connexion</h2>";
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<label for='username' class='labelId'>Identifiant : </label>";
	$var.="\t\t\t\n<input id='username' name='username' type='text' size='20' autocomplete='off'/>";
	$var.="\t\t\t\n</div>";					
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<label for='password' class='labelMp'>Mot de passe : </label>";
	$var.="\t\t\t\n<input id='password' name='password' type='password' size='20' autocomplete='off' />";
	$var.="\t\t\t\n</div>";					
	$var.="\t\t\t\n<input class='bouttonConnexion' type='submit' name='connexion' value='Connexion'/>";
	$var.="\t\t\t\n<p>Exemple de test : identifiant = yahiaoui / Mot de passe = 1234</p>";
	$var.="\t\t\t\n<p>Si vous n'êtes pas encore inscrits, cliquez sur <a href='./espace_etudiant.php'>Inscrivez-vous</a></p>";
	$var.="\t\n</form>";
	return $var;
}

/**cette fonction génère un formulaire d'inscription pour l'étudiant
*@return un formulaire d'inscription
*/

function formulaireInscriptionEtudiant() {
	$var="\t\n<form class='formConnexionEtudiant' action='espace_etudiant.php' method='post'>";	
	$var.="\t\t\t\n<h2 style='text-align:center'>Un formulaire d'inscription</h2>";
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<label for='cle' class='labelNum'>Clé d'inscription : </label>";
	$var.="\t\t\t\n</div>";					
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<input class='champ' id='cle' name='username' type='text' size='30' autocomplete='off'/>";
	$var.="\t\t\t\n</div>";					
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<label for='familyName' class='labelNom'>Nom : </label>";
	$var.="\t\t\t\n</div>";					
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<input class='champ' id='familyName' name='nom' type='text' size='30' autocomplete='off' />";
	$var.="\t\t\t\n</div>";
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<label for='firstName' class='labelPrenom'>Prénom : </label>";
	$var.="\t\t\t\n</div>";					
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<input class='champ' id='firstName' name='prenom' type='text' size='30' autocomplete='off' />";
	$var.="\t\t\t\n</div>";
	$var.="\t\t\t\n<input class='bouttonInscription' type='submit' name='inscription' value='Inscription'/>";
	$var.="\t\n</form>";
	return $var;
}

/**cette fonction génère un formulaire d'inscription (suite) pour l'étudiant
*@return un formulaire d'inscription
*/

function formulaireInscriptionEtudiantSuite() {
	$var="\t\n<form class='formConnexionEtudiant' action='upload.php' method='post' enctype='multipart/form-data'>";	
	$var.="\t\t\t\n<h2 style='text-align:center'>Suite de l'inscription</h2>";
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<label for='nombre' class='labelGroupeTd'>Choisissez votre groupe de TD : </label>\n";
	$var.="\t\t\t\n</div>";		
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<select name='groupeTd' id='groupeTd' class='champ'>\n";			
   $var.= liste_option('../arborescence/I');        				
	$var.= "\t\t\t\n</select>\n";
	$var.="\t\t\t\n</div>";
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<label for='photoEtu' class='labelPhoto'>Sélectionnez votre photo : </label>";
	$var.="\t\t\t\n</div>";					
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<input class='champ' id='fileToUpload' name='fileToUpload' type='file' />";
	$var.="\t\t\t\n</div>";
	$var.="\t\t\t\n<input class='bouttonInscription' type='submit' name='inscription' value='Inscription'/>";
	$var.="\t\n</form>";
	return $var;
}

	/*
	Cette fonction retourne un tableau html contenant les photos stockées dans le dossier spécifié.
	*/
	
	function getPhotosTable($dir,$lineSize=5) {
		$dir=str_replace(' ','_',$dir);
    	$tabFiles = scandir($dir);
    	$k=0;
    	$groupe=substr($dir,strripos($dir,'arborescence'));
    	$groupe=substr($groupe,13);
    	$groupe=str_replace('_',' ',$groupe);
    	$table="<table class='photosTable'>\n";
    	$table.="<tr><th colspan=".$lineSize.">".$groupe."</th></tr>";
    	foreach($tabFiles as $file){
        	if ($file!= "." && $file!= ".."){
				if ($k==0) {
    				$table.="<tr>\n";
    			}
        		$path = $dir.'/'.$file;
        		$lastmod= "Uploaded on : ".date('F d Y ', filectime($path));
				if (is_file($path)) { 
					$image ="<figure>";
					$image.="<img src='".$path."' alt='".$file."' title='".$lastmod."'>";
					$studentName=substr_replace($file,'',strpos($file,'.'));
					$studentName=str_replace('_',' ', $studentName);
					$image.="<figcaption style='text-align:center;'>".$studentName."</figcaption>";
					$image.="</figure>";
					$table.="<td>$image</td>\n";
				}
				$k++;
				if($k==$lineSize) {
    				$table.="</tr>\n";
    				$k=0;
    			}
        	} 	
    	}
    	if ($k>0 && $k<$lineSize) {
    		while ($k<$lineSize) {
    			$table.="<td></td>\n";
    			$k++;
    		}
    		$table.="</tr>\n";
    	}
    	$table.="</table>\n";
    	return $table;
	}

/**cette fonction génère une liste de filière dans un formulaire
*@return une liste de filière
*/

	function liste_option($dir,$i,$fillier=null) {
		$saut = "\n";
		$tab = "\t";
		
		$folder = opendir ($dir);
		$fil = null;
			
			while ($file = readdir ($folder)) {
				if($file != "." && $file != ".." && !strpos($file, ".")){
					
					$op = str_replace_espace(false,$file);
					if($file[0] == "L"){
						if($i > 0) {
							echo "\t\t</optgroup>\n";	
						}
						echo "\t\t<optgroup label='".$op."'>\n";
						$fil = $file;
					}
					else{
						echo "\t\t<option value='".$fillier."/".$file."'> ".$op." </option>\n";
					}
					
					$pathfile = $dir.'/'.$file;
					
					if(filetype($pathfile) == 'dir'){
						liste_option($pathfile,$i+1,$fil);
					}				
				}
			}
			closedir ($folder);	
	}
	
	

	function suiv_liste_option($dir){
		$var='';
		$folder = opendir ($dir); 
			while ($file = readdir ($folder)) { 
				if ($file != "." && $file != "..") { 
		$pathfile = $dir.'/'.$file; 
		
		$var.= "<option value='$file'>".liste_option($pathfile)."</option>\n";
		

	} 
} 
		closedir ($folder);
		return $var;
}


/**
 *cette fonction permet l'affichage d'une image prise au hazard dans le dossier passé en parametres
 *@param $dossierImages
 *		 chemin de dossier d'images
 *@return  une balise <figure> contenant l'image choisie
 */
 
function afficherImage($dossierImages){
	$tabImage=NULL;
	$i=0;
	if(is_dir($dossierImages)){
		if($dossier = opendir($dossierImages)){
			while ($s = readdir($dossier)) {
				if ($s != "." && $s != ".."){
					$tabImage[$i]=$s;
					$i++;
				}
			}
			closedir($dossier);
		}
	}

	$image = $tabImage[rand(0, count($tabImage)-1)];
	$var="\t\n<figure>";
	$var.="\t\t\n<img src='".$dossierImages.'/'.$image."' alt='image choisie aléatoirement' style='width:782px;height: 400px;'/>";
	$var.="\t\t\n<figcaption style='text-align:center'>";
	$var.=$image;
	$var.="\t\t\n</figcaption>";
	$var.="\t\t\n</figure>";		
	return $var; 
}

/**
 *cette fonction permet de vérifier si le login et le mot de passe passés en paramètre
 *existent bien dans le fichier csv spécifié. si c'est le cas, elle affiche le nom et le prénom
 *
 *@param le nom de fichier , login , password
 *
 *@return un message de validation ou d'avertissement 
 */

function validation($nomFichier,$login,$password){
	$fichier = fopen($nomFichier,'r');
	$trouver = false;
	while (!feof($fichier) && !$trouver) {
		$ligne=fgetcsv($fichier);
		if ($login==$ligne[2] && password_verify($password,$ligne[3])) {
			$trouver=true;
		}
	}
	if($trouver){
		return "\t\n<p style='text-align:center;color:blue'>Le couple login / password est valide, Nom : <strong>".$ligne[0]."</strong> Prénom : <strong>".$ligne[1]."</strong>.</p>\n";
	}
	else{
		return "\t\n<p style='text-align:center;color:red;'>Veuillez vérifier votre identifiant ou mot de passe !! Merci.</p>\n";		
	}
	fclose($fichier);
}
	

/**
*cette fonction génère le footer de la page de connexion pour l'étudiant
*
*/

function footerConnexionEtudiant(){
	$var="<div class='after-box'>";
	$var.="\t<footer>\n";
	$var.="\t\t<p style=' text-align :center'>
			Auteurs : <strong><a href='mailto:yahiaoui.anis11@gmail.com' style='color:black'>YAHIAOUI Anis & METIDJI Fares</a></strong> || Date : 01/02/2018 				
		</p>\n";
		$var.="\t\t<p style='text-align :center'>
			<a href='#'>haut de la page</a>
		</p>\n";
	$var.="\t</footer>\n";
	$var.="</div>";
	$var.="</body>\n";
	$var.="</html>\n";
	return $var;
}

	/*
	Cette fonction permet de supprimer une ligne d'un fichier texte, si elle contient la liste de mots passée en parametres.Elle retourne TRUE si la ligne est bien supprimée, FALSE sinon.
	*/

	function deleteLineText($fileName,$listWords){
		$originFile = fopen($fileName,'r');
		$newFile = fopen('temp','w');
		$lineRemoved=false;
		while ( ($currentLine = fgetcsv($originFile)) !== false ){
			$findWord=true;
			if (count($listWords) <= count($currentLine)) {
				$i= 0;
				while ( $i < count($listWords) and $findWord) {
					if (strcmp($currentLine[$i],$listWords[$i]) !== 0) {
						$findWord=false;
					}
					$i++;
				}	
			}else{
				$findWord=false;
			}
			if(!$findWord){
				fputcsv($newFile,$currentLine);
			}else{
				$lineRemoved=true;
			}	
		}
		fclose($originFile);
		fclose($newFile);
		rename('temp',$fileName);
		return $lineRemoved;
	}
	
	function str_replace_espace($espace,$string) {
		if($espace){
			$str = str_replace(" ", "_", $string);		
		}
		else{
			$str = str_replace("_", " ", $string);			
		}
		return $str;
	}
	
	function rmAllDir($strDirectory){
		
	    $handle = opendir($strDirectory);
	    while(false !== ($entry = readdir($handle))){
    	
        if($entry != '.' && $entry != '..'){
        	
            if(is_dir($strDirectory.'/'.$entry)){
                rmAllDir($strDirectory.'/'.$entry);
            }
            elseif(is_file($strDirectory.'/'.$entry)){
                unlink($strDirectory.'/'.$entry);
            }
        }
    }
    rmdir($strDirectory.'/'.$entry);
    closedir($handle);
	}

	/*
	cette fonction permet d'écrire des donées dans un fichier csv.
	*/

	function writeDataCSV($fileNameCSV,$listData){
		$file = fopen($fileNameCSV,'a+');
		fputcsv($file,$listData);
		fclose($file);
	}

	function creat_Groupe_ID($filier, $groupe) {
		$licence = substr($filier,0,2);
		$groupe_carac = substr($groupe,-1);
		
		$groupe_ID = $licence.'2018'.$groupe_carac;
		$listData = array($filier,$groupe,$groupe_ID);
		
		writeDataCSV("./dataGroupe_ID.csv",$listData);
	}	
	

function afficher_arbo($dir) {

		$saut = "\n";
		$tab = "\t"; 
		$folder = opendir ($dir);
		
			while ($file = readdir ($folder)) {
				if ($file != "." && $file != "..") {
					$pathfile = $dir.'/'.$file;
					$path = $dir.'/'.rawurlencode($file);
					if(!strpos($file, ".")){
						if(strripos($file, "roupe") or strripos($file, "TD") or strripos($file, "TP")){
							echo "\t\t\t<li style=' font-family: Arial, sans-serif;font-size: 100%;
  									color: black;display : list-item; margin-left:15%; margin-top:5%;'>
  									<a href=$path>$file</a></li>\n";
  						}
  						else {							
							echo "\t\t\t<li style=' font-family: Arial, sans-serif;font-size: 100%;
  									color: black;display : list-item; margin-top:5%;'>
  									<a href=$path>$file</a></li>\n";
  						}
					}
	
					if(filetype($pathfile) == 'dir'){
						afficher_arbo($pathfile,$path);
					} 
				} 
			} 
			closedir ($folder);
	}	







// la page gestionnaire des professeurs





/*
	Cette vérifie si une ligne précise existe dans un fichier csv. 
	*/
	function existeLineCSV($fileName,$listWords){
		$File = fopen($fileName,'r');
		$exist=false;
		while (!$exist && ($currentLine = fgetcsv($File)) !== false){
			if (count($listWords) == count($currentLine)) {
				$i= 0;
				$equals=true;
				while ( $i < count($listWords) && $equals) {
					if (strcmp($currentLine[$i],$listWords[$i]) !== 0) {
						$equals=false;
					}
					$i++;
				}
				if ( $i >= count($listWords)) {
					$exist=true;
				}
			}
		}
		fclose($File);
		return $exist;
	}



/*
	Cette fonction retourne une liste contenant des colonnes précises d'un fichier csv  
	*/
	function showListColumnsCSV($fileNameCSV,$listIndexColumns){
		
		$file = fopen($fileNameCSV,'r');
		$list="<ul style='font-weight: bold;font-size: 14pt; color : blue'>";
		while ($line=fgetcsv($file)) {
			$list.="<li>";
			foreach ($listIndexColumns as $index) {
				$list.=$line[$index]."  ";
			}
			$list.="</li>";
		}
		$list.="</ul>";
		fclose($file);
		return $list;
	}





//	la page de l'etudiant


	function VerifyGroupe_ID($Groupe_ID) {
		$list_info_filier = null;
		
		if(file_exists("../gestionnaire/dataGroupe_ID.csv")){
			
			$file = fopen("../gestionnaire/dataGroupe_ID.csv",'r');
		
			while (!feof($file) && $list_info_filier == null) {
				$line=fgetcsv($file);
			
				if ($Groupe_ID==$line[2]) {
					$list_info_filier = array(1=>$line[0],$line[1]);
				}
			}
			fclose($file);
		}	
		return $list_info_filier;		
	}
	


	function verifyEtudiant($numero,$Groupe_ID,$Nom,$Prenom) {

		$is_stu = false;
		$two_num = substr($numero,0,2);
		$list_info_filier = VerifyGroupe_ID($Groupe_ID);
		
		if(ctype_digit(intval($numero)) && strlen($numero) == 8 && ($two_num == 21 || $two_num == 20) && $numero[2] > 2 && $list_info_filier != null){
			$groupe = $list_info_filier[2];
			$filier = $list_info_filier[1];
			$listData = array($filier,$groupe,$numero,$Nom,$Prenom,'Non');
			if(!file_exists("../gestionnaire/dataEtudiant.csv") || !verify_groupe_etudiant($filier,$groupe,$Nom,$Prenom,$numero)){
				writeDataCSV("../gestionnaire/dataEtudiant.csv",$listData);
			
			}
			
			$is_stu = true;
			
		}	

		return $is_stu;
	}



	function verify_groupe_etudiant($fillier,$groupe,$nom,$prenom,$numero){
		$file = fopen("../gestionnaire/dataEtudiant.csv",'r');
		$find = false;
		
		while (!feof($file) && !$find) {
			$line=fgetcsv($file);

			if ($nom==$line[3] && $prenom==$line[4] && $numero==$line[2]) {
				if($fillier == $line[0] && $groupe == $line[1]){
					$find = true;
				}
			}
		}
		fclose($file);
		return $find;
	}
	
	
	function convertImage($source, $width, $height, $ext) {
		
		$imageSize = getimagesize($source);
		
		switch($ext) {
			case 'png':
			$imageRessource = imagecreatefrompng($source);
				break;		
				
			case 'jpg':
			$imageRessource = imagecreatefromjpeg($source);
				break;
				
			case 'jpeg':
			$imageRessource = imagecreatefromjpeg($source);
				break;	
		}
		
		$imageFinal = imagecreatetruecolor($width, $height);
		
		$final = imagecopyresampled($imageFinal, $imageRessource, 0, 0, 0, 0, $width, $height, $imageSize[0], $imageSize[1]);
		
		switch($ext) {
			case 'png':
			imagepng($imageFinal, $source);
				break;
				
			case 'jpg':
			imagejpeg($imageFinal, $source);
				break;
				
			case 'jpeg':
			imagejpeg($imageFinal, $source);
				break;	
		}
	}
	
	function incremat_effectif($fillier,$groupe) {
		$originFile = fopen('../gestionnaire/dataEffectifs.csv','r');
		$newFile = fopen('temp_temp','w');
		
		while ( ($currentLine = fgetcsv($originFile)) !== false ){		
			if(count($currentLine) == 2){
				if ($fillier!=$currentLine[0]) {
					fputcsv($newFile,$currentLine);
				}
				else {
					$list_effectif = array($currentLine[0],$currentLine[1]+1);
					fputcsv($newFile,$list_effectif);
				}			
			}
			else{
				if ($fillier!=$currentLine[0] || $groupe!=$currentLine[1]) {
					fputcsv($newFile,$currentLine);
				}
				else if($groupe == $currentLine[1]) {
					$list_effectif = array($currentLine[0],$currentLine[1],$currentLine[2]+1);
					fputcsv($newFile,$list_effectif);
				}		
			}
		}
		
		fclose($originFile);
		fclose($newFile);
		rename('temp_temp','../gestionnaire/dataEffectifs.csv');
	}
	
	function etudiant_upload_pic($nom,$prenom,$numero,$date,$destination_pic,$fillier) {
		$originFile = fopen('../gestionnaire/dataEtudiant.csv','r');
		$newFile = fopen('temp','w');
		
		$groupe_etudiant = explode('/', $fillier);
		
		while ( ($currentLine = fgetcsv($originFile)) !== false ){		
			
			if ($numero!=$currentLine[2] || $nom!=$currentLine[3] || $prenom!=$currentLine[4]) {
				fputcsv($newFile,$currentLine);
			}
			else if($numero==$currentLine[2] && $nom==$currentLine[3] && $prenom==$currentLine[4] && $currentLine[5] == 'Non') {
				
				incremat_effectif($groupe_etudiant[0],$groupe_etudiant[1]);
				
				$list_info_etu = array($currentLine[0],$currentLine[1],$numero,$nom,$prenom,$date,$destination_pic,"Ok");
				fputcsv($newFile,$list_info_etu);
			}
		}
		fclose($originFile);
		fclose($newFile);
		rename('temp','../gestionnaire/dataEtudiant.csv');
	}
	
	function upload_image_error($has_uploaded,$error_type=null) {
		$saut="\n";
		$tab="\t";
				
		$echec = "\t<div>\n";
		
		if($has_uploaded) {
			$echec .= "\t<div>\n";
			$echec .= "\t\t<div>\n";
			$echec .= "\t\t\t<p>Votre photo a été bien chargée</p>\n";
			$echec .= "\t\t</div>\n";
		}
		else {
			$echec .= "\t<div>\n";
			
			$echec .= "\t\t<div>\n";
			$echec .= "\t\t\t<p>échec de chargement</p>\n";
			$echec .= "\t\t</div>\n";
			if($error_type == "size"){
				$echec .= "\t\t<div>\n";
				$echec .= "\t\t\t<p>Il semble que vous avez saisi une photo de très grande taille
				veuillez changer de photo et recharger.</p>\n";
				$echec .= "\t\t</div>\n";				
			}
			elseif($error_type == "ext") {
				$echec .= "\t\t<div>\n";
				$echec .= "\t\t\t<p>Il semble que vous n'avez pas saisi une photo veuillez charger une photo s'il vous plait.</p>\n";
				$echec .= "\t\t</div>\n";		
			}
			else {
				$echec .= "\t\t<div>\n";
				$echec .= "\t\t\t<p>échec de chargement.</p>\n";
				$echec .= "\t\t</div>\n";						
			}
		}
		$echec .= "\t</div>\n";
		$echec .= "\t</div>\n";
		return $echec;
	}	
	
	function upload_image($destination,$nom,$prenom,$numero,$file_ext,$file_destination,$file_error,$file_size,$file_tmp) {
		
		$groupe_etudiant = explode('/', $destination);
		$allowed = array("png","jpg","jpeg");		
	
		if(in_array($file_ext, $allowed)){
			if($file_error === 0){
				if($file_size <= 2097152){
					if(move_uploaded_file($file_tmp, $file_destination)){
						convertImage($file_destination, '200', '200', $file_ext);
						etudiant_upload_pic($nom,$prenom,$numero,date('l-j-m-Y G:m:s',time()),$file_destination,$destination);
						echo upload_image_error(true);		
					}
					else {
						echo upload_image_error(false);
					}			
				}
				else{
					echo upload_image_error(false,"size");
				}
			}
			else{
				echo upload_image_error(false);
			}
		}
		else{
			echo upload_image_error(false,"ext");
		}	
	}
	
	
	function verify_pic_nom($nom,$prenom,$numero,$groupe){
		$file = fopen("../gestionnaire/dataEtudiant.csv",'r');
		
		$list_info_etu = array();
		$find = false;
		$groupe_liste = VerifyGroupe_ID($groupe);
		
		while (!feof($file) && !$find) {
			$line=fgetcsv($file);

			if ($nom==$line[3] && $prenom==$line[4] && $numero==$line[2] && $groupe_liste[1] == $line[0] && $groupe_liste[2] == $line[1] && $line[5] != 'Non') {
				$find = true;				
				$list_info_etu = array($line[0],$line[1],$line[5],$line[6]);
			}
		}
		fclose($file);
		return $list_info_etu;
	}
	
	
	function selection_groupe($dir) {
		$saut="\n";
		$tab="\t";
		
			echo "\t<table style='margin: auto;text-align:center'>\n";					
			echo "\t\t<tr>\n";
			echo "\t\t\t<td><label  for='filier'>Sélectionnez votre groupe de TD :</label></td><td><select name='filier' id='filier'>\n";
			echo "\t\t\t<option disabled selected value> -- Filière/Groupe -- </option>\n";			
			echo liste_option($dir,0);
			echo "\t\t\t</select></td>\n";
			echo "\t\t</tr>\n";
			echo "\t\t<tr>\n";			
			echo "\t\t\t<td><label for='file'>Importez votre photo : </label></td>\n";
			echo "\t\t\t<td><input id='file' name='file' type='file' accept='image/*'/></td>\n";
			echo "\t\t</tr>\n";
			echo "\t</table>\n";	
					echo "\t\t\t<input class='bouttonConnexion' type='submit' style='margin-left:34%' name='upload' value='Charger/Modifier' />\n";
	}
	
	
	/**
	*cette fonction nous retourn un formulaire d'inscription HTML composée de cinq input 
	*trois de type texte et deux de type password
	*ce formulaire permette a un nouveaux utilisateur de saisir son ID + Mot de passe .....
	*@return $form (Formulaire HTML)
	*/
	
	function formulaireEtudiant($check) {
			$saut = "\n";
			$tab = "\t";
		
			

			$form="\t<form class='formArbo' method='post' action='inscription_etudiant.php'>\n";
			$form.="<h2 style='text-align:center'>Authentification de l'Étudiant</h2>";
			$form.="<table style='margin-left:10%'>";
			$form.="\t\t<tr><td style='width:50%'><label class='labelId' for='numero'>Numéro de l'étudiant :</label></td>\n";
			$form.="\t\t<td><input id='numero' name='numero' type='text' size='25' required /></td></tr>\n";
		
		if(!$check){
		
			$form.="\t\t<tr><td style='width:60%'><label class='labelId' for='groupe'> Clé de groupe :</label></td>\n";
			$form.="\t\t<td><input id='groupe' name='groupe' type='text' size='25'  required /></td></tr>\n";
			$form.="\t\t<tr><td style='width:60%'><label for='nom' class='labelId'>Nom :</label></td>\n";
			$form.="\t\t<td><input id='nom' name='nom' type='text' size='25' required /></td></tr>\n";
			$form.="\t\t<tr><td style='width:60%'><label class='labelId' for='prenom'>Prénom :</label></td>\n";
			$form.="\t\t<td><input id='prenom' name='prenom' type='text' size='25' required /></td></tr>\n";
	
			
		}		
			$form.="\t\t</table>\n";
			$form.="\t\t<input type='submit' name='CONNECTER' value='Accéder' class='bouttonConnexion'/>\n";
			$form.="</form>\n";
			return $form;
	}
	
	function formulaireConnexionEnseignant() {
	
		$var="\t\n<form class='formConnexionEtudiant' method='post' action='arb.php'>";	
		$var.="\t\t\t\n<h2 style='text-align:center'> Formulaire de connexion</h2>";
		$var.="\t\t\t\n<div>";
		$var.="\t\t\t\n<label for='username' class='labelId'>Identifiant : </label>";
		$var.="\t\t\t\n<input id='username' name='username' type='text' size='20' autocomplete='off'/>";
		$var.="\t\t\t\n</div>";					
		$var.="\t\t\t\n<div>";
		$var.="\t\t\t\n<label for='password' class='labelMp'>Mot de passe : </label>";
		$var.="\t\t\t\n<input id='password' name='password' type='password' size='20' autocomplete='off' />";
		$var.="\t\t\t\n</div>";					
		$var.="\t\t\t\n<input class='bouttonConnexion' type='submit' name='connexion' value='Connexion'/>";
		$var.="\t\t\t\n<p>Exemple de test : identifiant = gestionnaire / Mot de passe = gestionnaire</p>";
		$var.="\t\n</form>";
		return $var;
}



	

?>