

$(document).ready(function(){//quando la pagina è tutta caricata
	
	console.log( "ready!" );

	$("div.page-content").isotope({//per ordinare le cards
		itemSelector: ".element-item",
		layoutMode: "fitRows",
	});

	document.addEventListener("keyup", function(event) { //aggiungo anche un evento che parte quando viene rilascato un stato
		if (event.keyCode==13){ //13 è il codice per il tasto invio
			fai_ajax();
		}
	});

	$("button.mdl-button").click(function(){
		var scopo= $(this).attr("data-funzione");

		switch(scopo){
			case "select":{
				var elem = $("tr.is-selected").text();
				elem=elem.split(" ");
				elem.shift();
				elem.shift();
				var el="";
				for (var i = 0 ; i <elem.length; i++) {
					if(i%4==0)el=el+elem[i]+",";}
				window.open("index.php?elem="+el,"_self");
			}break;

			case "back":{
				window.open("index.php","_self");
			}break;

			case "ajax":{
				fai_ajax();

			}break;
		}
	});


	function fai_ajax(){
		var qr = $("input").val();//prendi il contenuto della casella di test

		$.ajax({
  			url: "custom.php",
  			type: "get", //send it through get method
  			//dataType: "text",
  			data:{"query": qr},
  			success: function(response) {
    			$("table").html(response);
    			$("table").css({"padding":"50px"});
  				},
  			error: function(num,s,d){
  				$("table").html("qualcosa e' andato storto"+num+s+d);
  				}
		});
	};

	function conn_Err(){
	window.alert("Problemi con la connessione al database.\nProvare a ricaricare la pagina.\nSe il problema persiste, contattare l' \"\"\"adim\"\"\"");
	};



});
