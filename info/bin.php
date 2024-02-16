<!DOCTYPE html>
<head>
<?php 
include($_SERVER['DOCUMENT_ROOT'].'/headeraufgaben.php');
 ?> 
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title> Learnforschool.de | Informatik Binärecode </title>
<style>
.fragecounter {
position: absolute;
font-size: 15px;
text-align: left;
padding-top: 10px;
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
-webkit-transform: translateY(-30%);
-ms-transform: translateY(-70%);
font-size: 20px;
text-align: center;
}


.antwort{
width: 100%;
position: absolute;
top: 45%;
-webkit-transform: translateY(-50%);
-ms-transform: translateY(-50%);
font-size: 20px;
text-align: center;
}




.toggle-buttons input[type="radio"] {
  clip: rect(0 0 0 0);
  clip-path: inset(50%);
  height: 1px;
  overflow: hidden;
  position: absolute;
  white-space: nowrap;
  width: 1px;
}
.toggle-buttons label {
  border: 1px solid #333;
  border-radius: 0.5em;
  padding: 0.5em;
}
 
.toggle-buttons input:checked + label {
  background: #ebf5d7;
  color: #5a9900;
  box-shadow: none;
}

input:hover + label,
input:focus + label {
  background: #ffebe6; 
}

.back{
color: red;
width: 100%;
position: absolute;
top: 93%;
font-size: 30px;
text-align: center;
cursor: pointer;
}
</style>
</head>
<body>
<div class="frage">
<script>
function timef(){
	var today = new Date();
var d = today.getDate();
var m = today.getMonth() + 1;
var y = today.getFullYear();
var today = new Date();
var h = today.getHours();
var s = today.getMinutes();
var se = today.getSeconds();
 

 
var date = d + m  + y  + h  + s + se;
dmy = date / 32
}

function linkback(){
timef();
window.location ="../../../Klasse7.html?dmy=" + dmy;

}








    var url_string = window.location;
    var url = new URL(url_string);
    var times = url.searchParams.get("dmy");
time = times * 32

	var today = new Date();
var d = today.getDate();
var m = today.getMonth() + 1;
var y = today.getFullYear();
var today = new Date();
var h = today.getHours();
var s = today.getMinutes();
var se = today.getSeconds();
 


 
var dmy = d +  m  + y  + h  + s + se;

if(time == dmy)
0
else
0


function finish(){
if(score==maxfragen)
{
document.write("<H1 onclick=reset()>Herzlichen Glückwunsch</h1>");
document.write("<H2 onclick=reset()>Du hast " + score + " richtige Antworten also alle Richtig</h2>");
}
else
{
document.write("<H1 onclick=reset()>Fertig!</h1>");
document.write("<H2 onclick=reset()>Du hast " + score + " richtige Antworten von "+ maxfragen +"!!!</h2>");
}
 }
 function reset(){
 timef();
 window.location = "?frage=1&score=0";
 }
</script>
</div>
<script>
function frageeins(){
document.write("<H2>Was ist "+ b + " im Binärecode?</H2>");
}

function fragezwei(){
document.write("<H2>Was ist "+ ab + " im Dezimalsystem?</H2>");

}
var min = 1;
var max = 100;
var c = Math.floor(Math.random() * (max - min)) + min;
var b = Math.floor(Math.random() * (max - min)) + min;
var d = Math.floor(Math.random() * (max - min)) + min;
if (c==b)
var c = Math.floor(Math.random() * (max - min)) + min;
else if(d==b)
var d = Math.floor(Math.random() * (max - min)) + min;
else if(c==d)
var c = Math.floor(Math.random() * (max - min)) + min;
else
0

var a = convertToBinary(c)
var ab = convertToBinary(b)
var ac = convertToBinary(d)
	var min = 1;
	var max = 4;
    var w = Math.floor(Math.random() * (max - min)) + min;
if(w==1)
{
var aeins = a;
var azwei = ab;
var adrei = ac;
var beins = c;
var bzwei = b;
var bdrei = d;
}
else if(w==2)
{
var aeins = ab;
var azwei = ac;
var adrei = a;
var beins = d;
var bzwei = c;
var bdrei = b;
}
else if(w==3)
{
var aeins = ac;
var azwei = a;
var adrei = ab;
var beins = b;
var bzwei = d;
var bdrei = c;
}

function convertToBinary (number, bin) {
    if (number > 0) {
        return convertToBinary( parseInt(number / 2) ) + (number % 2)
    };
    return '';
	
}

function antworteins(){
document.write("<div class=toggle-buttons><input onclick=auswertena() type=radio id=b1 name=group-b/><label for=b1>" + aeins + "</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=radio onclick=auswertenb() id=b2 name=group-b/><label for=b2>"+ azwei +"</label><input onclick=auswertenc() type=radio id=b3 name=group-b/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label for=b3>"+ adrei + "</label></div></div>");

}
function antwortzwei(){
document.write("<div class=toggle-buttons><input onclick=auswertena() type=radio id=b1 name=group-b/><label for=b1>" + beins + "</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=radio onclick=auswertenb() id=b2 name=group-b/><label for=b2>"+ bzwei +"</label><input onclick=auswertenc() type=radio id=b3 name=group-b/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label for=b3>"+ bdrei + "</label></div></div>");


}

</script>
<div class="fragecounter">
<script> 

    var url_string = window.location;
    var url = new URL(url_string);
    var score = url.searchParams.get("score");
	
    var url_string = window.location;
    var url = new URL(url_string);
    var welchefrage = url.searchParams.get("frage");
var maxfragen = 10
if(welchefrage==10)
document.write('<nobr>Letzte Frage von </nobr>' + maxfragen + " <nobr> Fragen</nobr>");
else if(welchefrage==11)
0
else
document.write('<nobr> Frage </nobr>' + welchefrage + " <nobr> von </nobr>" + maxfragen + " <nobr> Fragen </nobr>");


function auswertena()
{
if(aeins==ab)
{
score++;
nextfrage();
}
else if(beins==b)
{
score++;
nextfrage();
}
else
nextfrage();
}

function auswertenb()
{
if(azwei==ab)
{
score++;
nextfrage();
}
else
nextfrage();
}
function auswertenc()
{
if(adrei==ab)
{
score++;
nextfrage();
}
else
nextfrage();
}
</script>
</div>
<div class="score">
<script>
if(welchefrage==11)
0
else
document.write("<nobr> Aktueller score: " + score)
</script>
</div>
<script>
function nextfrage(){
let i = ++welchefrage;
timef();
		window.location = "?frage=" + i + "&score=" + score;

}

</script>
<div class="frage">
<script>
if(welchefrage==1)
frageeins();
else if(welchefrage==2)
fragezwei();
else if(welchefrage==3)
frageeins();
else if(welchefrage==4)
fragezwei();
else if(welchefrage==5)
frageeins();
else if(welchefrage==6)
fragezwei();
else if(welchefrage==7)
frageeins();
else if(welchefrage==8)
fragezwei();
else if(welchefrage==9)
frageeins();
else if(welchefrage==10)
fragezwei();
else if(welchefrage==11)
finish();
else{
timef();
window.location= "?frage=1&score=0";
}
</script>
</div>
<div class="antwort">
<script>
if(welchefrage==1)
antworteins();
else if(welchefrage==2)
antwortzwei();
else if(welchefrage==3)
antworteins();
else if(welchefrage==4)
antwortzwei();
else if(welchefrage==5)
antworteins();
else if(welchefrage==6)
antwortzwei();
else if(welchefrage==7)
antworteins();
else if(welchefrage==8)
antwortzwei();
else if(welchefrage==9)
antworteins();
else if(welchefrage==10)
antwortzwei();
</script>
</div>
</body>
</html>


