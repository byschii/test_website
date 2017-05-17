<?php

/*
questo script contiene le informazioni per stabilire la
connessione con il database
è incluso in 'custom' e in 'index'

utente e password attualmente inseriti sono relativo alle impostazioni
di default per (xamp)Windows.
nel caso delle distribuzioni linux dovrebbero essere: -u "root" -p"password"

servername : dove risiede il db, va bene anche in indirizzo ip
username e password: sono i dati dell utente, meglio se ha tutti i privilegi
nomedb: identifica il database a cui accedere

non ho inserito la parte di connessione in questo script perche, in 
alcuni casi potrebbe variare la modalità e ho preferito adare in base alla 
situazione dello script
*/
$servername = "localhost";
$username = "root"; 
$password = "";
$nomedb = "test";

$tab_master= "atomo"; //tabella con le informazioni master
$tab_detail= "molecole";//tabella che contiene i dati detail

?>