<?php

include ($_SERVER['DOCUMENT_ROOT']."/dashboard/include/funzioni_html.php");
include "imp_materialize.php";

$file_di_script=array("https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js", 
	"https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js",
	"script_mpma.js");

$file_di_stile=array("https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en",
	"https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css", 
	"https://fonts.googleapis.com/icon?family=Material+Icons","stile_mpma.css");


echo "<!DOCTYPE html>";
echo "<html>";
echo(print_head("MyPhpMyAdmin",$file_di_script,$file_di_stile));
echo "<body>";


echo (print_testata("Insert Into"));
echo "<div class=\"container\">";


$elenco = array(
	"titolo" => array(
		0 => "list", 1 => "Tabelle"
		),
	"righe" => array(
		insert_into_atomo(),
		insert_into_molecole(),
		)
	);

echo( print_elenco_exp($elenco) );




echo "</div>";
echo "</body>";
echo "</html>";



function insert_into_atomo(){
	include ($_SERVER['DOCUMENT_ROOT']."/dashboard/include/infodb.php");
	$conn = new mysqli($servername, $username, $password, $nomedb);
	$queri = "select `COLUMN_NAME` from information_schema.columns WHERE `TABLE_SCHEMA`='".$nomedb."' and `TABLE_NAME`='".$tab_master."'";
	$sql=$conn->query($queri);
	$sql-> fetch_row();

	$val =array(0 => "x", 1 => "Atomi", 2 => "");
	
	while ($tab = $sql-> fetch_row())
		$val[2] = $val[2] . print_input_txt($tab[0]);
	
	$val[2] = $val[2] . print_bottone("controlla e aggiungi", "atomo");
	

	return $val;
}



function insert_into_molecole(){

	include ($_SERVER['DOCUMENT_ROOT']."/dashboard/include/infodb.php");
	$conn = new mysqli($servername, $username, $password, $nomedb);
	$queri1 = "select nome from ".$tab_master;
	$queri2 = "select `COLUMN_NAME` from information_schema.columns WHERE `TABLE_SCHEMA`='".$nomedb."' and `TABLE_NAME`='".$tab_detail."'";
	
	$sql1 = $conn -> query($queri1);
	$sql2 = $conn -> query($queri2);
	$sql2-> fetch_row();
	$sql2-> fetch_row();

	$val=array(0 => "x", 1 => "Molecola", 2 => "");
	$val[2] =print_input_txt("Nome");


	$opz = array();
	while ($nome = $sql1-> fetch_assoc()) $opz[]=$nome["nome"];

	while ($campo = $sql2-> fetch_row() ) {
		
		$val[2] = $val[2] . print_menu("Un atomo presente", $campo[0], $opz) ;

	}



	$val[2] = $val[2] . print_bottone("controlla e aggiungi","molecola");

	return $val;
	
	
}




?>