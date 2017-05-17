<?php
/*
QUESTA è LA PAGINA PRINCIPALE, QUI C'è SIA LA MASTER CHE LA DETAIL
le due sono distinte dal url con il quale si accede alla pagina 
 ( [...].php?elem=[...] ) se non è presente 'elem' su accede alla MASTER
*/

// Turn off all error reporting, così se manca qualche file che dovrebbe essere incluso, lo script non mostra 'warnings'
//error_reporting(0);

//prendo le info per accere al database
include ($_SERVER["DOCUMENT_ROOT"]."/dashboard/include/infodb.php");
include ($_SERVER["DOCUMENT_ROOT"]."/dashboard/include/funzioni_html.php");
include "imp_material_design_lite.php";

//se esiste 'elem' in _GET 
if (array_key_exists("elem", $_GET)){
	//allora soo nella DETAIL e quindi come titolo della pagina metto il nome delle elmento
	$tit_pagina = $_GET["elem"];	
}else{
	//altrimenti, questo è il nome della pagina
	$tit_pagina = "Elenco atomi";
}

$file_di_script=array("https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js", 
	"script_java.js", 
	"https://code.getmdl.io/1.3.0/material.min.js", 
	"https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"
	);

$file_di_stile=array("stile_css.css", 
	"https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en",
	"https://code.getmdl.io/1.3.0/material.indigo-pink.min.css", 
	"https://fonts.googleapis.com/icon?family=Material+Icons");

echo "<!DOCTYPE html>";
echo "<html>";
echo(print_head(rtrim($tit_pagina,","),$file_di_script,$file_di_stile));
echo "<body>";

//creo l oggetto connessione con i dati di 'infodb'
$conn = new mysqli($servername, $username, $password, $nomedb);
if($conn->connect_error)echo "<script> conn_Err() </script>";

$href_testata=array("Credits"=>"credits/crediti.html", "MyPhpMyAdmin"=>"mpma/mpma.php");
echo(print_testata("Progetto: Master/Detail",$href_testata));

if($tit_pagina=="Elenco atomi") print_pagina("home", $conn, $tab_master);
	else print_pagina($tit_pagina, $conn, $tab_detail);

echo "</div>";
echo "</main>";
echo "</div>";
echo "</body>";
echo "</html>";

/*
//### C:\xampp\htdocs\dashboard -> è la cartella deva va inserito il sito (win)
//### /var/www/html -> è la cartella per [linux]
*/









/*
#############
FUNZIONE GENERALE PER LA STAMPA DELLA PAGINA
#############
*/



function print_pagina($pag, $connessione, $tabella_di_riferimento){
/*
FUNZION ECHE VA EFFETTIVAMENTE A CREARE IL CORPO DELLA PAGINA
$pag contine il valore secondo il quale stampare la pagina
 -> se uguale a "home", stampa la home
 -> altrimente stampa l' elenco di molecole
$connessione riceve l oggeto sul quale fare le query
*/

	//come solito decido quale pagina stampare
	if ($pag == "home"){
	/*
	pagina MASTER
	*/
		$didascalia = "Questa pagina offre un elenco degli atomi nel database.<br> Selezione gli atomi per vedere in quali molecole sono contenuti, poi clicca su \"mostra\" per vedere i risultati.<br>"; //titoletto della pagina

		$query_master = select_query(["*"], [$tabella_di_riferimento]);//funzione di sopra, risultato: select nome, simbolo from atomo;
		$sql=$connessione->query($query_master); // eseguo la query
		$nrighe=$sql->num_rows;// ed estraggo il numero di rige risultanti (0 = non a buon fine)
		

		//creo la 'div' dove verrà stampato il 'ris'ultato
	
		echo (print_card($pag, $didascalia." Query utilizzata:<b id=\"sql\" > ".$query_master."</b>", 
			"continua",
			"select")
		);

		echo(print_tab($sql,true));

		

	}else{
	/*
	pagina DETAIL.
	*/	

		//$pag contiene il simbolo delle elementi di cui vedere i dettagli
		$pag= explode(",",$pag);
		array_pop($pag);

		$wheree="";
		foreach ($pag as $ind)  { 
			$wheree=$wheree . "(atomo0='".$ind."' or atomo1='".$ind."' or atomo2='".$ind."')";	
		}
		$pag=explode(")(",$wheree);
		$pag=join(")and(",$pag);
		
		$didascalia = "In questa pagina vengono stampate tutte le molecole (registrate nel db) che contengono l' elemento selezionato.";
		
		//creo la query con la mia funzione
		$query_detail = select_query(["*"],[$tabella_di_riferimento],$pag);
		$sql = $connessione -> query($query_detail);//esecuzione query
		$nrighe = $sql ->num_rows;//controllo numero dei risultato



		echo (print_card("Molecole",
			$didascalia." Query utilizzata:<b id=\"sql\" > ".$query_detail."</b>", 
			"indietro","back")
			);// stampa titolo

		echo (print_card("AJAX",
			"Prova una query \"select\" <br>".print_input_txt(),
			 "prova","ajax")
		);

		echo(print_tab($sql));
		

	}

}

?>
