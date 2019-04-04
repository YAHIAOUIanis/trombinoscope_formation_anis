<?php

/*cette fonction affiche le début de code html de chaque page
*@param un entier
*	numéro de tp
*@return titre de la page
*/


	function generTrombinoCSS(){
		return
		'<style>
		.photosTable{
			margin: auto;
			background-color: #80ced6;
			font-weight: bold;
			font-style: italic;
			color: black;
			font-size: 15pt;
			text-align: center;
			margin-bottom:20px;
		}
		.photosTable th{
 			border-bottom: 2px solid #fefbd8;
 			font-size: 25pt;
 			padding: 0.2%;
		}
		li{
			list-style-type: none;
		}
		</style>';	
	}


	function Echec_login_ProfsSecret($find,$nom=null,$prenom=null){
		$saut = "\n";
		$tab = "\t";		
		$echec = "\t<div class='message1'>\n";
		$echec .= "\t\t\t<p style='text-align:center;color:red'>Identifiant ou Mot de Passe incorrecte !</p>\n";
		$echec .= "\t\t</div>\n";
		return $echec;	
	}


	function verify_login($fileNameCSV,$login){	
		$file = fopen($fileNameCSV,'r');
		$find = false;
		while (!feof($file) && !$find) {
			$line=fgetcsv($file);
			if ($login==$line[2]){
				$find=true;
			}
		}
		fclose($file);
		return $find;
	}

function title_page($numero) {
	$var="<!DOCTYPE html>\n";
	$var.="<html lang='fr'>\n";
	$var.="<head>\n";
	$var.="\t<title>".$numero."</title>\n";
	return $var;
}

	function get_name_surname($fileNameCSV,$login) {
		$file = fopen($fileNameCSV,'r');
		$infos = array();
		$find = false;
		
		while (!feof($file) && !$find) {
			$line=fgetcsv($file);
			if ($login==$line[2]){
				$infos = array("nom"=>$line[0],"prénom"=>$line[1]);
				$find=true;
			}
		}
		fclose($file);
		return $infos;	
	}

	function verify($fileNameCSV,$login,$password){
		$file = fopen($fileNameCSV,'r');
		$find = false;
		while (!feof($file) && !$find) {
			$line=fgetcsv($file);
			if ($login==$line[2] && password_verify($password,$line[3])) {
				$find=true;
			}
		}
		fclose($file);
		return $find;
	}

function loginFomulaProf($verify) {
		$saut = "\n";
		$tab = "\t";
		
		$form = "<div>\n";
		$form.="\t<form class='formArbo' method='post' action='./espace_enseignant.php'>\n";
		
		$form.="\t<h2 style='text-align:center'>Authentification de l'Enseignant / Secrétaire</h2>\n";
		$form.="<table style='margin-left:10%'>";
		
		if(!$verify){
			
				
			$form.="\t\t<tr><td style='width:50%'><label class='labelId' for='username'>Identifiant :</label></td>\n";
			$form.="\t\t<td><input id='username' name='username' type='text' size='25' required /></td></tr>\n";
		
		}
		
		
		$form.="\t\t<tr><td style='width:50%'><label class='labelId' for='password'>Mot de passe :</label></td>\n";
		$form.="\t\t<td><input id='password' name='password' type='password' size='25' required /></td></tr>\n";

		$form.="\t\t</table>\n";

		$form.="\t\t<input class='bouttonConnexion' type='submit' name='CONNECTER' value='SE CONNECTER'/>\n";
	
		$form.="</form>\n";
		$form.="</div>\n";
		
		return $form;
	}



?>
