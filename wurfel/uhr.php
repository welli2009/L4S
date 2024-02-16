<!DOCTYPE html>
<?php
include("../databaseverknuepfung.php");



if(!$conn)
{
    echo "sadman";
}
else{
	echo "<script> console.log('Verbindung erfolgreich');</script>";




$result = $conn->query("SHOW TABLES LIKE 'wuerfelzeiten'");
$tableExists = $result->num_rows > 0;

// Create table if it doesn't exist
if (!$tableExists) {
	$sql = "CREATE TABLE `$db`.`wuerfelzeiten` (`ID` INT NOT NULL , `Namen` TEXT NOT NULL , `Zeit` TEXT NOT NULL , `Uhrzeit` TEXT NOT NULL , `Typ` TEXT NOT NULL) ENGINE = InnoDB;";
	
	if ($conn->query($sql) === TRUE) {
		echo "Table wuerfelzeiten muste NEU erstellt werden diese meldung ist bei der ERSTEN Verwendung NORMAL";
	} else {
			echo "Error creating table: " . $conn->error;
		}
	}
}
?>
<html>
  <head>
    <meta charset="utf-8">
    <title>Stopwatch</title>
    <style>
      body {
		position: absolute;
		top: 50%;
		left: 50%;
		margin-left: -350px;
		margin-top: -250px;
		text-align: center;
      }
	  
      h1 { 
        font-size: 25px;
        margin-top: 0;
      }
	  
	 h2 {
        font-size: 5em;
        margin-top: 0;
      }
	  
      button {
        font-size: 2em;
        margin: 1em;
        padding: 0.5em 1em;
      }
	  
	  input{
		font-size: 25px;
		margin-top: 0;
	  }
    </style>
  </head>
  <body>
  <form action="Uhradd.php" method="post" id="formuhr">
    <input hidden type="text" name="time" id="time" title="Uhrzeit"></input>
  <h1> 
	    Name und Klasse:
	  	<input type="name" placeholder="Max Musterman 14a" id="name" name="name"></input>
  </br>
      Würfeltyp:
      <select id="typ" name="typ" title="typ" onchange="addtyp()">
        <option>----Bitte Auswählen----</option>
      <?php 
$result = $conn->query("SHOW TABLES LIKE 'wuerfeltypen'");
$tableExists = $result->num_rows > 0;

// Create table if it doesn't exist
if (!$tableExists) {
	$sql = "CREATE TABLE `$db`.`wuerfeltypen` (`ID` INT NOT NULL , `Typ` TEXT NOT NULL , `Priorität` INT NOT NULL ) ENGINE = InnoDB;";
	
	if ($conn->query($sql) === TRUE) {
		echo "<script>alert('Es musste die wuerfeltypen erstellt werden.')</script>";
	} 
	}

			$sql = "SELECT Typ FROM wuerfeltypen";
			$result = $conn->query($sql);
			
		if ($result->num_rows > 0) {
			// Ausgabe der Daten jeder Zeile
			while($row = $result->fetch_assoc()) {
				echo "<option value='".$row["Typ"]."'>".$row["Typ"]."</option>";
			}
			
			}

		?>
		<option value="addtyp" onclick="">Typ Hinzufügen</option>
      </select>
    
  </h1>
  </br>
    <h2 id="timebar">0:0:00</h1>
    <button id="start">Start</button>
    <button disabled="true" id="stop">Stop</button>
    <button disabled="true" id="reset">Reset</button>
	  <button disabled="true" id="senden">Senden</button>
    <input  hidden name="timevalue" id="timevalue"></input>
    <button hidden></button>
  </form>
    <script>
var seconds = 0;
var millisec = 0;
var minuten = 0;
var inseconds;
var timerId;
timebar=document.getElementById("timebar");
start=document.getElementById("start");
stop=document.getElementById("stop");
reset=document.getElementById("reset");
senden=document.getElementById("senden");
time=document.getElementById("time");
timevalue=document.getElementById("timevalue");

function incrementSeconds() {
  millisec += 1;
  if (millisec == 100) {
    millisec = 0;
    seconds += 1;
  }
  
    if (seconds == 60) {
    seconds = 0;
    minuten += 1;
  }
  
  timebar.innerText =
    minuten + ":" + seconds + ":" + millisec.toString().padStart(2, "0");
}



start.addEventListener("click", function () {
  timerId = setInterval(incrementSeconds, 10);
  start.disabled=true;
  stop.disabled=false;
  reset.disabled=false;
  senden.disabled=false;
});

stop.addEventListener("click", function () {
  inseconds = (minuten * 60 + seconds) + ("," + millisec);
  clearInterval(timerId);
  start.disabled=false;
  stop.disabled=true;
  reset.disabled=false;
  senden.disabled=false;
});

reset.addEventListener("click", function () {
  clearInterval(timerId);
  inseconds = (minuten * 60 + seconds) + ("," + millisec);
  seconds = 0;
  millisec = 0;
  minuten = 0;
  timebar.innerText = "0:0:00";
  start.disabled=false;
  stop.disabled=true;
  reset.disabled=true;
  senden.disabled=true;
});


senden.addEventListener("click", function () {
  clearInterval(timerId);
  let jetzt = new Date();
  time.value = jetzt.getHours() + ":" + jetzt.getMinutes() + ":" + jetzt.getSeconds();
  inseconds = (minuten * 60 + seconds) + ("," + millisec);
  seconds = 0;
  millisec = 0;
  minuten = 0;
  timebar.innerText = inseconds;
  timevalue.value = inseconds;
  start.disabled=false;
  stop.disabled=true;
  reset.disabled=true;
  senden.disabled=true;
  document.getElementById('formuhr').submit();
});



function addtyp(){
			if (document.getElementById("typ").value === "addtyp") {
			
				window.location = "addtyp.php";
				
			}
		}

    </script>
  </body>
</html>
