<?php
include("../databaseverknuepfung.php");




if(!$conn)
{
    echo "sadman";
}
else{
	echo "<script> console.log('Verbindung erfolgreich');</script>";




$result = $conn->query("SHOW TABLES LIKE 'fachnamen'");
$tableExists = $result->num_rows > 0;

// Create table if it doesn't exist
if (!$tableExists) {
	$sql = "CREATE TABLE `$db`.`fachnamen` (`id` INT NOT NULL , `Fachnamen` TEXT NOT NULL , `Prioritaet` INT NOT NULL ) ENGINE = InnoDB;";
	
	if ($conn->query($sql) === TRUE) {
		echo "Table Fach musste NEU erstellt werden. Diese Meldung ist bei der ERSTEN Verwendung NORMAL";
	} else {
			echo "Error creating table: " . $conn->error;
		}
	}
}


	if(isset($_POST['fachname'])){
	foreach ($_POST as $key => $value) {
		${$key} = "'". $value. "'";
	}
	
	
	$sql = "SELECT COALESCE(MAX(`id`), 0) FROM `fachnamen`;";
	$result = $conn->query($sql);
	
	// Ergebnis abrufen und um 1 erhöhen
	if ($result !== false && $result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$id = $row["COALESCE(MAX(`id`), 0)"] + 1;
	} else {
		echo "Fehler: " . mysqli_error($conn);
	}
	echo $id;


	$sql = "INSERT INTO `fachnamen` (`id`, `Fachnamen`, `Prioritaet`) VALUES 
									($id, $fachname, $prioritaet)";
	$result = $conn->query($sql);
	
	echo "Erfolgreich erstellt ". $fachname;
	
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
		<title> Learnforschool.de | LOGIN</title>
	</head>
<form action="addfach.php" method="post">

    <body bgcolor=FFFFFF>
        <div class=layout>

<h1>Fach Hinzufügen</h1>
<label for="fach">Fachname: </label>
<input placeholder="Politik" name='fachname' value=""  type='text' required></input></br></br>

<label for="prioritaet">Priorität: </label>
    <input id="prioritaet" name="prioritaet" type="number" min="1" max="255" required></input> 
</br></br>

<p>Bereits erstellte Fächer: </p>
<?php
$sql = "SELECT * FROM fachnamen";
$result = $conn->query($sql);

// Erstellen Sie eine HTML-Tabelle und fügen Sie die Daten in die Tabelle ein
if ($result->num_rows > 0) {
  echo "<table><tr><th>id</th><th>Fachnamen</th><th>Priotität</th></tr>";
  // Ausgabe der Daten jeder Zeile
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>".$row["id"]."</td><td>".$row["Fachnamen"]."</td><td>".$row["Prioritaet"]."</td><td></form><form method='post' action='deletefach.php'><input type='hidden' name='index' value='".$row['id']."'><input type='submit' name='delete' value='Delete'></form></td></tr>";
  }
  echo "</table>";
} else {
  echo "Keine Fächer bisher";
}

$conn->close();
?>
</br></br></br>

<button class="" style="font-size:20px;" id='Login' type="submit" value="Submit" submit-btn >Erstellen</button></br></br><hr></form>
<button style="font-size:10px;" onclick="location = 'Aufgabenerstellen.php'">Zurück</button>
</div>
</div>


<a href="..\rechtliches/Datenschutz.php"> Datenschutz </a></br>
<a href="..\rechtliches/Impressum.php"> Impressum </a></br>
<p  style="font-size: 15px;color: orange;">© Copyright 2023 - Learnforschool - Alle Rechte Vorbehalten</p>

</body>
</html>