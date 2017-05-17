<!doctype html>
<html lang="it">
<head>
	<meta charset="UTF-8">
	<title>Pong</title>

	<!-- Basic styling, centering the canvas -->
	<style>
	canvas {
		display: block;
		position: absolute;
		margin: auto;
		top: 0;
		bottom: 0;
		left: 0;
		right: 0;
	}
	</style>
</head>
<body>
<script>
//costanti
var LARGHEZZA  = 700, ALTEZZA = 600, frecciaSu = 38, frecciaGiu = 40,
//variabili per il gioco(canvas: per l elemento html, contesto:per disegnare sul canvas, key: per controllare i stati)
canvas, contesto, keystate ={},

player = {//li bacchetto del giocatore
	x: null,
	y: null,
	width:  20,
	height: 100,
	update: function() { // serve ad cambiare la posizione quando viene premuta la freccia
		//in base al tasto premuto
		if (keystate[frecciaSu]) this.y -= 10;
		if (keystate[frecciaGiu]) this.y += 10;

		//mi assicuro che il rettangolo non esca dal campo (var=comesefossetutto[...])
		var inbasso=ALTEZZA-this.height;
		var inalto=0;
		this.y = Math.max(Math.min(this.y, inbasso), inalto);
		},

	draw: function() {//disegna il rettangolo dentro nel 'contesto'
		contesto.fillRect(this.x, this.y, this.width, this.height);
		}
},

ai = {//il bastoncino dell ai
	x: null,
	y: null,
	width:  20,
	height: 100,
	
	update: function() {//aggiorno la posizione dell intelligenza
		var destinazione;
		if (ball.vel.x <0){
			destinazione = ALTEZZA/2 -this.height/2;
		}
		//pos in altezza se fosse a fianco della palla
		else{
			destinazione = ball.y - (this.height - ball.lato)/2;
		}
		
		//aggiorno la posizione(dovedeve andare, meno dove è , per la velocita)
		this.y += (destinazione - this.y) * 0.07;
		
		// controllo che non esca dal campo
		//mi assicuro che il rettangolo non esca dal campo (var=comesefossetutto[...])
		var inbasso=ALTEZZA-this.height;
		var inalto=0;
		this.y = Math.max(Math.min(this.y, inbasso), inalto);
		
		},
	
	draw: function() { //disegno il rectangolo dell ai nel contesto
		contesto.fillRect(this.x, this.y, this.width, this.height);
		}
},

ball = {//la palla
	x:   null,//posizione sullo schermo
	y:   null,
	vel: null,//insieme delle velocita
	lato:  20,//lunghezza del quadrato della palla
	speed: 15,//velocita della palla
	
	serve: function(lato_inizio) {//mette in gioco la palla
		//lato -> il lato da dove va inserita la palla(se è uno si parte dal giocatore)
		
		//imposto la posizione
		var rand = Math.random();
		this.x = lato_inizio==1? player.x+player.width : ai.x-this.lato;
		this.y = (ALTEZZA - this.lato)*rand;
		
		//imposto la velocita per far muovere la palla
		this.vel = {
			x: this.speed*Math.cos(rand) *lato_inizio,
			y: this.speed*Math.sin(rand)
		}
	},

	//aggiorno la posizione della palla
	update: function() {
		//prima di tutto cambio la posizione, in base alla velocità
		this.x += this.vel.x;
		this.y += this.vel.y;

		// controllo il rimbalzo su cima e fondo
		if (0 > this.y || this.y+this.lato > ALTEZZA) {
			this.vel.y = this.vel.y* -1;//inverto la velocità su e giu
			}

		//questa funzione serve a capire se la palla sta sbattendo contro qualche cosa(a è l oggetto, b è la palla)
		var ha_colpito = function(ax, ay, aw, ah, bx, by, bw, bh) {
			return ((ax < bx+bw) && (ay < by+bh)) && ((bx < ax+aw) && (by < ay+ah));
			};

		//controllo verso quale bacchetto sta andando la palla, se la veocità è negativa sono io, altrimenti è il pc.
		var stik = this.vel.x < 0 ? player : ai;//stik contiene l ogetto verso il quale sista dirigendo la palla
		
		//se la palla ha colpito un bacchetto
		if (ha_colpito(stik.x, stik.y, stik.width, stik.height,this.x, this.y, this.lato, this.lato)) {	
			
			//in base a dove andava, reimposto la x della palla
			this.x = stik===player ? player.x+player.width : ai.x - this.lato;
			//poi ne cambio la direzione
			this.vel.x = (stik===player ? 1 : -1)*this.speed;
			}

		//rimetto la palla in gioco se è uscita
		if (0 > this.x+this.lato || this.x > LARGHEZZA) {
			this.serve(stik===player ? 1 : -1);
			}
	},
	
	draw: function() { //funzione di disegno della palla
		contesto.fillRect(this.x, this.y, this.lato, this.lato);
	}
};



function main() {

	// creo l elementno che conterra il campo
	canvas = document.createElement("canvas");
	canvas.width = LARGHEZZA;
	canvas.height = ALTEZZA;
	contesto = canvas.getContext("2d");
	document.body.appendChild(canvas);//metto il canvas nella pagina

	// metto un controllo su i tasti premuti
	document.addEventListener("keydown", function(event) {//quando un tasto viene premuto
		//(event.keycode = è uguale al codice del tasto che premo)
		var key =event.keyCode;//controllo quale è stato pfermuto
		keystate[key] = true;//metto l array, nella posizione del tasto, come vero
	});
	document.addEventListener("keyup", function(event) {//quando il tasto viene lasciato
		delete keystate[event.keyCode];//cancello il valore vero, altrimenti il bacchetto continuerebbe a muoversi
	});

	//sistemo i bacchetti dei due giocatori
	player.x = 0;
	player.y = (ALTEZZA - player.height)/2;
	ai.x = LARGHEZZA - ai.width;
	ai.y = (ALTEZZA - ai.height)/2;
	//metto la palla in gioco
	ball.serve(1);

	// game loop function
	var loop = function() {
		update();
		draw();
		window.requestAnimationFrame(loop, canvas);
	};
	window.requestAnimationFrame(loop, canvas);
}

function update() {//controlla la posizione dei vari oggetti in gioco
	player.update();
	ai.update();
	ball.update();
}

function draw() {//disegno tutte le parti del gioco
	//prima il rettangolo
	contesto.fillRect(0, 0, LARGHEZZA, ALTEZZA);
	contesto.save();
	contesto.fillStyle = "#fff";
	
	///poi gli oggetti
	ball.draw();
	player.draw();
	ai.draw();
	debug();

	contesto.restore();
}

function debug(){
	var deb ="posizione giocatore: ("+player.x+";"+player.y+").\
	 posizione palla: ("+Math.round(ball.x)+";"+Math.round(ball.y)+").\
	 posizione dell ai: ("+Math.round(ai.x)+";"+Math.round(ai.y)+").";
	contesto.fillText(deb,(1/4)*ALTEZZA,(1/3)*ALTEZZA,400);
}

main();
</script>
<p id="debug"></p>
</body>
</html>











