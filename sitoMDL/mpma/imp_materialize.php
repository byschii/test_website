<?php

function print_input_txt($indicazione){
	$print="";
	$print="
	<div class=\"row\">
    <div class=\"col s12\">
      <div class=\"row\">
        <div class=\"input-field col s12\">
          <input type=\"text\" id=\"autocomplete-input\" class=\"autocomplete\">
          <label for=\"autocomplete-input\" >".$indicazione."</label>
        </div>
      </div>
    </div>
  	</div>";

  	return $print;
}

function print_tab($sql){
	$print="";
	$print="<table class=\"striped centered\"><thead><tr>";
	foreach (($sql->fetch_fields()) as $campo) 
    	$print=$print."<th>".ucfirst($campo->name)."</th>"; 
    $print=$print."</tr></thead><tbody>";
    while ($campi = $sql -> fetch_assoc()){ 
 		$print=$print. "<tr>";
		foreach ($campi as $val) 
			$print=$print. "<td>".ucfirst($val) ." </td>";
		$print=$print. "</tr>"; 
	} 
    return ($print."</tbody></table>");
}

function print_testata($titolo){
	$print="";
	$print="
	<nav>
    <div class=\"nav-wrapper\">
      <a href=\"#\" class=\"brand-logo\">".$titolo."</a>
      <ul id=\"nav-mobile\" class=\"right hide-on-med-and-down\">
        <li><a href=\"../index.php\">Indietro  </a></li>
      </ul>
    </div>
  </nav>";

  return $print;
}

function print_menu($titolo, $suggerimento, $opzioni){
	$print="";
	$print="<div class=\"input-field col s12\"><select>
      <option value=\"\" disabled selected>".$suggerimento."</option>";

      foreach ($opzioni as $key => $value) {
      	$print=$print."<option value=\"".($key+1)."\">".$value."</option>";
      }
    
    $print=$print."</select><label>".$titolo."</label></div>";
    return $print;
}

function print_bottone( $testo, $scopo){
	$print="<a class=\"waves-effect waves-light btn\" id=\"".$scopo."\">".$testo."</a>";
		return $print;
}

function print_elenco_exp($contenuto){
  $print = "";

  $print = "<ul class=\"collapsible\" data-collapsible=\"accordion\">";

  $print = $print ."<li> 
      <div class=\"collapsible-header\">
      <i class=\"material-icons\">"
      .$contenuto["titolo"][0].
      "</i>"
      .$contenuto["titolo"][1].
      "</div>
      </li>";

  foreach ($contenuto["righe"] as $dentro) {
    $print = $print . 
      "<li id=\"".$dentro[1]."\">
      <div class=\"collapsible-header\">
        <i class=\"material-icons\">".$dentro[0]."</i>"
      .$dentro[1]."</div>
      <div class=\"collapsible-body\">
        <br>
        <div class=\"container\">"
        .$dentro[2].
        "<br><br>
        </div>
      </div>
      </li>";
  }

  $print = $print. "</ul>";

  return $print;

}



?>