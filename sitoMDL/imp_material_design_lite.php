<?php



function print_testata($tit, $link){
	$print="";
	$print="<div class=\"mdl-layout mdl-js-layout mdl-layout--fixed-header\">
  		<header class=\"mdl-layout__header\">
	    	<div class=\"mdl-layout__header-row\">
	      		<span class=\"mdl-layout-title\">".$tit."</span>
	      		<div class=\"mdl-layout-spacer\"></div>
	      		<nav class=\"mdl-navigation\">";
	        		foreach ($link as $nome => $dest) {
	        			$print=$print. "<a class=\"mdl-navigation__link\" href=\"".$dest."\">".$nome."</a>";
	        		}
	        	$print=$print.="
	      		</nav>
	    	</div>
  		</header>";

	$print=$print."<main class=\"mdl-layout__content\">
    	<div class=\"page-content\">";
	/*
	#########
	importante:
	prima di chiudere il body, bisogna chiudere 
	/DIV , /MAIN , /DIV
	#########
	*/

	return $print;
}

function print_tab($sql, $select=false){
	$print="";
	$print= "<table class=\"mdl-data-table mdl-js-data-table element-item ";
	if($select)$print=$print." mdl-data-table--selectable ";
	$print=$print."mdl-shadow--2dp\"><thead><tr>";
    foreach (($sql->fetch_fields()) as $campo) 
    	$print=$print."<th>".ucfirst($campo->name)."</th>"; 
    $print=$print."</tr></thead><tbody>";

 	while ($campi = $sql -> fetch_assoc()){ 
 		$print=$print. "<tr>";
		foreach ($campi as $val) 
			$print=$print. "<td>".ucfirst($val) ." </td>";
		$print=$print. "</tr>"; 
	} 
	$print=$print." </tbody></table>";

	return $print;
}

function print_card($titolo,$didascalia,$bottone, $funzione=""){
	$print="<div class=\"demo-card-wide mdl-layout-spacer mdl-card mdl-shadow--2dp mdl-grid element-item\">
			<div class=\"mdl-card__title\">
				<h2 class=\"mdl-card__title-text\">".ucfirst($titolo)."</h2>
			</div>
  			<div class=\"mdl-card__supporting-text\">"
  				.$didascalia.
  			"</div>
  			<div class=\" mdl-card--border\">
      			<button class=\"mdl-button mdl-button--colored mdl-js-button\" data-funzione=\"".$funzione."\">"
      			.$bottone.
      			"</button>
      		</div>
      		</div>";

    return $print;
}

function print_input_txt($icona="search"){
	$print="<div class=\"mdl-textfield mdl-js-textfield mdl-textfield--expandable\">
    			<label class=\"mdl-button mdl-js-button mdl-button--icon\" for=\"inp\">
      				<i class=\"material-icons\">".$icona."</i>
    			</label>
    		<div class=\"mdl-textfield__expandable-holder\">
      			<input class=\"mdl-textfield__input\" type=\"text\" id=\"inp\">
      			<label class=\"mdl-textfield__label\" for=\"sample-expandable\">
      			Expandable Input
      			</label>
    		</div>
  			</div>";
  		return $print;
}


//QUESTA FUNZIONE SERVE A CREARE UN MODO piu o meno carino DELLE SELECT
function select_query($select, $from, $where="", $altro=""){
/*
$selct , $from -> somo array(1d) dove ci va il nome della colonna da prendere e le tabelle da cui prelevare
$where -> la condizione, come stringa
$altro -> altre cose tipo ordinamento

ritorna la stringa della query

es:  select_query(["nome", "simbolo"], ["atomo"], "indice =1")
*/
	
	$i=0;//var per contare quando sono all ultima parola
	$query= "select";//var che alla fine conterrà tuta la query, si costituira con il tempo
	foreach ($select as $colonna) {//ciclo che scorre tutte le colonne a cui appartengono i valori da prelevare
		$i++;//incremento la variabile per vedere a che punto dell array sono
		$query = $query. " ". $colonna;//aggiungo il nome della colonna
		if($i != count($select)){//se non sono alla fine dell array
			$query = $query. ",";//aggiungo la virgola per separare le colonne
		}
	}

	//stesso identico comportamento del ciclo sopra, ma per le tabella
	$i=0;
	$query = $query . " from";
	foreach ($from as $tabelle) {
		$i++;
		$query = $query. " ". $tabelle;
		if($i != count($from)){
			$query = $query. ",";
		}
	}

	if ($where!=""){//se 'where' è stata scritta
		$query= $query . " where " . $where;// la aggiungo alla query
	}
	$query = $query . " " . $altro;//aggiungo a prescindere anche 'altro' ( tipo l ordinamento) 

	//ritorno la query appena creata
	return $query;
}


?>