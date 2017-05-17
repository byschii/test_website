<?php

/*
QUESTO è LO SCRIPT CHE ELABORA LA CHIAMATA AJAX
prima fa un SEMPLICISSIMO E MOLTO VULNERABILISSIMO controllo sulla query
poi, se possibile restituisce il risultato
*/

//prendo le informazione per accedere ad database
include ($_SERVER["DOCUMENT_ROOT"]."/dashboard/include/infodb.php");
include ($_SERVER["DOCUMENT_ROOT"]."/dashboard/include/funzioni_html.php");
include "imp_material_design_lite.php";
//prendo la prima parola della query
$parole = preg_split("/[\s,]+/", $_REQUEST["query"]);
//creo un array di parole che non si posso usare
$non_select=array("insert", "alter", "create", "grant", "revoke", "limit", "begin", "commit", "rollback", "truncate", "delete", "update");
//con un ciclo controllo che non che la prima parola sia valida
foreach ($non_select as $comando) {
 	if (strtolower($parole[0])==$comando){
 		//se è una di quelle proibite, notifico che ci ha provato e arresto lo script
 		echo "Guardare ma non toccare!";
 		return;
 	}else{
 		continue;
 	}
 }

//in questa riga creo l oggetto della connessione(senza variabile, perche non ne avrò piu bisogno) ed eseguo la query, la query sta nella variabile _GET perche il tipo dell AJAX lo mette lì. metto il tutto in 'test'
$sql = (new mysqli($servername, $username, $password, $nomedb))->query($_REQUEST["query"]);//provo ad effettuare la query

//se la query da risultati
if ( $sql){
	echo ( print_tab($sql) );

}else{//se la query non da risultati 
	//stampo un messaggio di errore
	echo "!/\ NESSUN RISULTATO /\!";
}

?>