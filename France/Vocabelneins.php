<!DOCTYPE html>
<head>
<?php 
include($_SERVER['DOCUMENT_ROOT'].'/headeraufgaben.php');
 ?> 
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title> Learnforschool.de | Französisch Vocabeln </title>
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
console.log("FEHLER, Beim PRAGRAMMIEREN fragen nicht richtig difiniert");

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
 document.getElementById("score").textContent="Richtige Anworten: " + score + " von " + fragencount + " Fragen";

}

function frage(){
fr = ["le lundi", "le mardi",      "le mercredi",   "le jeudi",       "le vendredi", "le samedi",   "le dimanche", "le matin",   "à midi",    "l'après-midi",   "histoire/géo",   "allemand",  "la récréation", "anglais",  "français",    "la cantine", "les SVT",      "maths", "les mathématiques", "latin",    "les arts plastiques", "les sciences physiques", "soir"];
de = ["der Montag", "der Dienstag", "der Mittwoch", "der Donnerstag", "der Freitag", "der Samstag", "der Sonntag", "morgens", "mittags", "nachmittags",  "Geschichte/Geo", "Deutsch",   "die Pause",   "Englisch", "Französisch", "die Kantine", "die Biologie", "Mathe", "die Mathematik",    "Latein",   "die Bildende Kunst",  "die Physik", "abends"];

startcoundown(61);
fragen_typ = Math.floor(Math.random() * (2 - 0));

if(fragen_typ==0){
vocabel = Math.floor(Math.random() * (de.length - 0));
 document.getElementById("quest").textContent='Was heißt "' + de[vocabel]  + '" auf Französisch?';
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