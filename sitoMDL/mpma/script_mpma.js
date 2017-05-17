

$(document).ready(function(){

	console.log( "ready!" );
	$('select').material_select();//serve inizializzare il menu a tenda
	



	$("a.btn").click(function(){// in questo modo capisco in qule tabella si vogliono aggiungere delle righe
		
		var tipo_btn=$(this).attr("id");	
		window.alert(tipo_btn);

		
	});

	function ins_atomo(){
		var arr="";
		var regex_nome=/^[a-zA-Z0-9]+$/;//per mettere controllo sullas tringa
		var regex_simb=/^[a-zA-Z]{1,2}/;//
		var regex_num=/^[0-9]{1,3}/;

		
		$("li.active input").each(function(index){
			
			var ins = $(this).val();
			switch(index){
				case 0:{
					if(regex_nome.test(ins)){
						arr=arr + " " + ins;
						$(this).addClass("valid");
						$(this).removeClass("invalid");
					}
					else{
						$(this).addClass("invalid");
						$(this).removeClass("valid");
					}
				}break;
				case 1:{
					if(regex_simb.test(ins)){
						arr=arr + " " + ins;
						$(this).addClass("valid");
						$(this).removeClass("invalid");
					}
					else{
						$(this).addClass("invalid");
						$(this).removeClass("valid");
					}
				}break;
				case 2:{
					if(regex_num.test(ins)){
						arr=arr + " " + ins;
						$(this).addClass("valid");
						$(this).removeClass("invalid");
					}
					else{
						$(this).addClass("invalid");
						$(this).removeClass("valid");
					}
				}break;
				default:{
					if((ins == "")==false){
						arr=arr + " " + ins;
						$(this).addClass("valid");
						$(this).removeClass("invalid");
					}
					else{
						$(this).addClass("invalid");
						$(this).removeClass("valid");
					}
				}
			}

		});

		window.alert( arr );

	}

	function fai_ajax_peratomi(valori){ //chiamata ajax per inserire atomi

		$.ajax({
  			url: "custom.php",
  			type: "get", //send it through get method
  			//dataType: "text",
  			data:{"val": valori},
  			success: function(response) {
    			//toast che dice tutto ok
    		},
  			error: function(num,s,d){
  				//toast che dice
			}
		});
	};



});