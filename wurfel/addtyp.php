<?php
include("../databaseverknuepfung.php");
$id=0;



if(!$conn)
{
    echo "sadman";
}
else{
	echo "<script> console.log('Verbindung erfolgreich');</script>";




$result = $conn->query("SHOW TABLES LIKE 'wuerfeltypen'");
$tableExists = $result->num_rows > 0;

// Create table if it doesn't exist
if (!$tableExists) {
	$sql = "CREATE TABLE `$db`.`wuerfeltypen` (`ID` INT NOT NULL , `Typ` TEXT NOT NULL , `Priorität` INT NOT NULL ) ENGINE = InnoDB;";
	
	if ($conn->query($sql) === TRUE) {
		echo "Table wuerfeltypen musste NEU erstellt werden. Diese Meldung ist bei der ERSTEN Verwendung NORMAL";
	} else {
			echo "Error creating table: " . $conn->error;
		}
	}
}


	if(isset($_POST['Typ'])){
	foreach ($_POST as $key => $value) {
		${$key} = "'". $value. "'";
	}
	
	
	$sql = "SELECT COALESCE(MAX(`ID`), 0) FROM `wuerfeltypen`;";
	$result = $conn->query($sql);
	
	// Ergebnis abrufen und um 1 erhöhen
	if ($result !== false && $result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$id = $row["COALESCE(MAX(`ID`), 0)"] + 1;
	} else {
		echo "Fehler: " . mysqli_error($conn);
	}
	echo $id;


	$sql = "INSERT INTO `wuerfeltypen` (`ID`, `Typ`, `Priorität`) VALUES 
									($id, $Typ, $prioritaet)";
	$result = $conn->query($sql);
	
	echo "Erfolgreich erstellt ". $Typ;
	
}
?>
<html>
	<head>
		<style>
				.layout{
					background-color:white;
					border-width:10px;
					border: solid 3px #797989;
	
					width:280px;
	
					padding:20px;
					padding-top:0px;
					position:absolute;
					left:50%;
					top:50%;
					transform: translate(-50%,-50%);
					border-radius:10px;
					font-size:20px;
				}
	
	
				input{
					font-size:20px;
				}
				
				a{
					color: orange;
					background-color: transparent;
					text-decoration: none;
				}
				
		</style>
		<meta charset="ISO-8859-1">
		<title> Learnforschool.de | Würfeltyp Hinzufügen</title>
	</head>
<form action="addtyp.php" method="post">

    <body>
        <div class=layout>

<h1>Würfeltyp Hinzufügen</h1>
<label for="Typ">Typ: </label>
<input placeholder="3x3" name='Typ' value=""  type='text' required></input></br></br>

<label for="prioritaet">Priorität: </label>
    <input id="prioritaet" name="prioritaet" type="number" min="1" max="255" required></input> 
</br></br>
<p>Bereits erstellte Fächer: </p>
<?php
$sql = "SELECT
 * FROM wuerfeltypen";
$result = $conn->query($sql);

// Erstellen Sie eine HTML-Tabelle und fügen Sie die Daten in die Tabelle ein
if ($result->num_rows > 0) {
  echo "<table><tr><th>ID</th><th>Wuerfeltypen</th><th>Priotität</th></tr>";
  // Ausgabe der Daten jeder Zeile
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>".$row["ID"]."</td><td>".$row["Typ"]."</td><td>".$row["Priorität"]."</td><td></form><form method='post' action='deletetyp.php'><input type='hidden' name='index' value='".$row['ID']."'><input type='submit' name='delete' value='Delete'></form></td></tr>";
  }
  echo "</table>";
} else {
  echo "Keine Typen bisher";
}

$conn->close();
?>
</br></br></br>

<button class="" style="font-size:20px;" id='Login' type="submit" value="Submit" submit-btn >Erstellen</button></br></br><hr></form>
<button style="font-size:10px;" onclick="location = 'uhr.php'">Zurück</button>
</div>
</div>


<a href="..\rechtliches/Datenschutz.php"> Datenschutz </a></br>
<a href="..\rechtliches/Impressum.php"> Impressum </a></br>
<p  style="font-size: 15px;color: orange;">© Copyright 2023 - Learnforschool - Alle Rechte Vorbehalten</p>

</body>
</html>