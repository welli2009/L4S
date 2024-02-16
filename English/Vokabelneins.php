<!DOCTYPE html>
<head>
<?php 
include($_SERVER['DOCUMENT_ROOT'].'/headeraufgaben.php');

 ?> 
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title> Learnforschool.de | Englisch Vocabeln </title>
<style>
.time{
position: absolute;
font-size: 15px;
text-align: left;
padding-up: 10px;
padding-top:10px

}
.score {
position: relative;
font-size: 15px;
text-align: right;
padding-top: 10px;
}
.frage{
width: 100%;
position: absolute;
top: 30%;
font-size: 30px;
text-align: center;
}

.antwortdiv{
width: 100%;
position: absolute;
top: 40%;
font-size: 40px;
text-align: center;
}
.antwort{
font-size: 25px;

}

.button {
  padding: .75rem 1.25rem;
  border-radius: 10rem;
  color: black;
}




</style>
</head>
<body>

<div class="time" id="time">Loading... </div>
<div class="score" id="score">Loading...</div>
<h2 class="frage" id="quest">PRÜFEN SIE OB JAVASCRIPT IN IHREM BROWSER AKTIVIERT IST!!</H2>


<div class="antwortdiv">
<input  class="antwort" id="antwort" type="text"></input></br>
<button class="button" id="uberprufen" onclick="auswertungfrage()">Bestätigen</button>
</div>



<script>
frage();


if(fr.length == de.length)
console.log(fr.length);
else
console.log("FEHLER, Beim PROGRAMMIEREN fragen nicht richtig definiert");

var input = document.getElementById("antwort");
input.addEventListener("keypress", function(event) {
  if (event.key === "Enter") {
    event.preventDefault();
    document.getElementById("uberprufen").click();
  }
});


var score = 0;
var fragencount = 0;

scoredisp();

function scoredisp(){
 document.getElementById("score").textContent="Richtige Antworten: " + score + " von " + fragencount + " Fragen";

}

function frage(){
fr = ["contrast", "the US",      "urban",   "endless",       "sparse", "populated",    "rural",          "single",         "tractor",    "desert",   "Southwest",   "temperature",  "degree Fahrenheit", "cactus",     "cool", "zone",      "immigrant", "European",                 "cultural",    "redwoodtree", "kid", "impression", "orientation", "suburb", "suburban","front yard", "shopping mall", "middle school","hallway", "dress code", "restroom"];
de = ["Kontrast", "die USA", "städtisch", "endlos", "dünn/spärlich", "bevölkert/besiedelt", "ländlich", "einzeln/einzig", "Traktor", "Wüste",  "Südwesten", "Temperatur",   "Grad Fahrenheit",          "Kaktus",  "kühl", "Zone",        "Einwanderer", "Europäer/europäisch",    "kulturell",   "Mammutbaum",  "Jugendlicher", "Eindruck", "Orientierung", "Vorort", "Vorstadt","Vorgarten", "Einkaufszentrum", "Mittelschule","Flur/Korridor", "Kleiderordnung", "Toilette"];

startcoundown(61);
fragen_typ = Math.floor(Math.random() * (2 - 0));

if(fragen_typ==0){
vocabel = Math.floor(Math.random() * (de.length - 0));
 document.getElementById("quest").textContent='Was heißt "' + de[vocabel]  + '" auf Englisch?';
}
else if(fragen_typ==1){
vocabel = Math.floor(Math.random() * (fr.length - 0));
 document.getElementById("quest").textContent='Was heißt "' + fr[vocabel]  + '" auf Deutsch?';
}
}

function auswertungfrage(){
let antwort = document.querySelector ("#antwort").value
if(fragen_typ==0)
{
	if(antwort==fr[vocabel])
		{
		document.querySelector ("#antwort").value = "";
		alert("richtig");
		clearInterval(countdown);
		score++;
		fragencount++;
		scoredisp();
			frage();
		}
			else
			{
			document.querySelector ("#antwort").value = "";
			alert("FALSCH, es wäre " + fr[vocabel] + " gewesen");
			clearInterval(countdown);
			fragencount++;
			scoredisp();
			frage();
			}
}
else if(fragen_typ==1)
{
		if(antwort==de[vocabel])
		{
		document.querySelector ("#antwort").value = "";
		alert("richtig");
		clearInterval(countdown);
		score++;
		fragencount++;
		scoredisp();
		frage();
		}
			else
			{
			document.querySelector ("#antwort").value = "";
			alert("FALSCH, es wäre " + de[vocabel] + " gewesen");
			clearInterval(countdown);
			fragencount++;
			scoredisp();
			frage();
			}
}
else
alert("ERRROR #404 MELDEN SIE IHN UMGEHEND AN EINEN ADMIN");







}







function startcoundown(countdowntime){
countdown = setInterval(function() {

if(countdowntime!=1)
{
countdowntime--
    document.getElementById("time").textContent="Verbleibende Zeit: " + countdowntime;
}
else{
    document.getElementById("time").textContent="Zeit abgelaufen!";
	clearInterval(countdown);
	document.querySelector ("#antwort").value = "";
if(fragen_typ==0)
{
				fragencount++;
				scoredisp();
				alert("ZEIT ABGELAUFEN, es wäre " + fr[vocabel] + " gewesen");
	document.querySelector ("#antwort").value = "";
		frage()
}
else if(fragen_typ==1)
{
				fragencount++;
				scoredisp();
				alert("ZEIT ABGELAUFEN, es wäre " + de[vocabel] + " gewesen");
document.querySelector ("#antwort").value = "";
	frage()
}
else
{
alert("ERRROR #404 MELDEN SIE IHN UMGEHEND AN EINEN ADMIN");
document.querySelector ("#antwort").value = "";
	frage()
}
	
}

}, 1000); 
}





</script>
</body>
</html>