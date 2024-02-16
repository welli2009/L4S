<!DOCTYPE html>
<head>
<?php 
include($_SERVER['DOCUMENT_ROOT'].'/headeraufgaben.php');
 ?> 
<meta charset="UFT-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title> Learnforschool.de | Mathe Prozentrechnung </title>
<head>
<body>

<div style='transform: scale(0.65); position: relative; top: -100px;'>
  <h3>Welche Art von Prozentrechnung möchtest du lernen?</h3>
  <hr/>

  <div id='block-11' style='padding: 10px;'>
    <label for='option-11' style=' padding: 5px; font-size: 2.5rem;'>
      <input type='radio' name='option' value='6/24' id='option-11' style='transform: scale(1.6); margin-right: 10px; vertical-align: middle; margin-top: -2px;' />
      Prozentwert</label>
    <span id='result-11'></span>
  </div>
  <hr />

  <div id='block-12' style='padding: 10px;'>
    <label for='option-12' style=' padding: 5px; font-size: 2.5rem;'>
      <input type='radio' name='option' value='6' id='option-12' style='transform: scale(1.6); margin-right: 10px; vertical-align: middle; margin-top: -2px;' />
      Grundwert</label>
    <span id='result-12'></span>
  </div>
  <hr />

  <div id='block-13' style='padding: 10px;'>
    <label for='option-13' style=' padding: 5px; font-size: 2.5rem;'>
      <input type='radio' name='option' value='1/3' id='option-13' style='transform: scale(1.6); margin-right: 10px; vertical-align: middle; margin-top: -2px;' />
      Prozentsatz</label>
    <span id='result-13'></span>
  </div>
  <hr />
  
    <div id='block-14' style='padding: 10px;'>
    <label for='option-14' style=' padding: 5px; font-size: 2.5rem;'>
      <input type='radio' name='option' value='1/3' id='option-14' style='transform: scale(1.6); margin-right: 10px; vertical-align: middle; margin-top: -2px;' />
      Ach egal, hauptsache Prozentrechnung</label>
    <span id='result-14'></span>
  </div>
  <hr />
  
  <button type='button' onclick='displayAnswer2()' style='width: 100px; height: 40px; border-radius: 3px; background-color: lightblue; font-weight: 700;'>Los geht's!</button>
</div>

<script>
  function displayAnswer2() {
    if (document.getElementById('option-11').checked) 
{
      document.getElementById('block-11').style.border = '3px solid green'
      document.getElementById('result-11').style.color = 'green'
      document.getElementById('result-11').innerHTML = 'Gute wahl'	
	  protzentwert()
    }







    if (document.getElementById('option-12').checked) 
{
      document.getElementById('block-12').style.border = '3px solid green'
      document.getElementById('result-12').style.color = 'green'
      document.getElementById('result-12').innerHTML = 'gute wahl'
	        grundwert()
    }


	
	
	
	
	
	
    if (document.getElementById('option-13').checked) 
{
      document.getElementById('block-13').style.border = '3px solid green'
      document.getElementById('result-13').style.color = 'green'
      document.getElementById('result-13').innerHTML = 'gute wahl'
	  protzentsatz()
    }

    if (document.getElementById('option-14').checked) 
{
      document.getElementById('block-14').style.border = '3px solid green'
      document.getElementById('result-14').style.color = 'green'
      document.getElementById('result-14').innerHTML = "gute wahl"
	  zufall()
    }
}
  
    
  
  
  
  

  function zufall() {
var min = 1;
var max = 4;
var z = Math.floor(Math.random() * (max - min)) + min;
  
  if(z==1)
 protzentwert()
  else if(z==2)
  grundwert()
  else if (z==3)
  protzentsatz()
  }
  
  function showCorrectAnswer1() {
    let showAnswer1 = document.createElement('p')
    showAnswer1.innerHTML = 'Sind sie sich ganz sicher das sie cheaten wollen? Dann klick mich!'
    showAnswer1.style.position = 'relative'
    showAnswer1.style.top = '-180px'
    showAnswer1.style.fontSize = '1.75rem'
    document.getElementById('showanswer1').appendChild(showAnswer1)
    showAnswer1.addEventListener('click', () => {
      document.getElementById(c).style.border = '3px solid limegreen'
      document.getElementById(b).style.color = 'limegreen'
      document.getElementById(b).innerHTML = 'WIN'
      document.getElementById('showanswer1').removeChild(showAnswer1)
	  alert("sie müssen sich erst anmelden!");
	  login()
    })
  }
  
  function protzentwert() {
  var min = 1;
var max = 10000;
var G = Math.floor(Math.random() * (max - min)) + min;

var min = 1;
var max = 150;
var p = Math.floor(Math.random() * (max - min)) + min;

var W = G*p/100
	  W = Math.round(W);

	  
var fragew=prompt("Der Prozentsatz beträgt: " + p + ", der Grundwert entspricht " + G + ". Wie viel beträgt der Prozentwert (auf Einer gerundet) ");
                if(fragew==W)
				{
alert("Richtig");
alert("Rechenweg: \n\nGeg:    p: " + p + "                     Ges: W \n           G: " + G + " \n\nLösung: \n\n             W = G * p : 100 \n                 = " + G + " * " + p + " : 100 \n                 = " + W);
}
	else
	{
alert("Falsch, es wäre " + W + " gewesen");	
alert("Rechenweg: \n\nGeg:    p: " + p + "                     Ges: W \n           G: " + G + " \n\nLösung: \n\n             W = G * p : 100 \n                 = " + G + " * " + p + " : 100 \n                 = " + W);
}
reload();
}
   
    function grundwert() {
var min = 1;
var max = 150;
var p = Math.floor(Math.random() * (max - min)) + min;

var min = 1;
var max = 1000;
var W = Math.floor(Math.random() * (max - min)) + min;

var G = W*100/p
	  G = Math.round(G);

	  
var frageg=prompt("Der Prozentwert beträgt: " + W + ", der Prozentsatz entspricht " + p + ". Wie viel beträgt der Grundwert (auf Einer gerundet) ");
                if(frageg==p)
				{
alert("Richtig");
alert("Rechenweg: \n\nGeg:    p: " + p + "                     Ges: G \n           W: " + W + " \n\nLösung: \n\n             p = W * 100 : p \n                = " + W + " * 100 : " + p + "\n                = " + G);
}
	else
	{
alert("Falsch, es wäre " + G + " gewesen");	
alert("Rechenweg: \n\nGeg:    p: " + p + "                     Ges: G \n           W: " + W + " \n\nLösung: \n\n             p = W * 100 : p \n                = " + W + " * 100 : " + p + "\n                = " + G);
}
reload();
	}
  

    function protzentsatz() {
var min = 1;
var max = 1000;
var G = Math.floor(Math.random() * (max - min)) + min;

var min = 1;
var max = 1000;
var W = Math.floor(Math.random() * (max - min)) + min;
var p = W*100/G
	  p = Math.round(p);

	  
var fragep=prompt("Der Grundwert beträgt: " + G + ", der Prozentwert entspricht " + W + ". Wie viel Prozend ist W von G? (auf Einer gerundet) ");
                if(fragep==p)
				{
alert("Richtig");
alert("Rechenweg: \n\nGeg:    G: " + G + "                     Ges: p \n           W: " + W + " \n\nLösung: \n\n             p = W * 100 : G \n                = " + W + " * 100 : " + G + "\n                = " + p);
}
	else
	{
alert("Falsch, es wäre " + p + " gewesen");	
alert("Rechenweg: \n\nGeg:    G: " + G + "                     Ges: p \n           W: " + W + " \n\nLösung: \n\n             p = W * 100 : G \n                = " + W + " * 100 : " + G + "\n                = " + p);
}
reload();
    }

</script>

</body>
</html>
