<html>
<head>
    <style>


            .layout{
                background-color:white;
                border-width:10px;
                border: solid 3px #797989;
                padding:20px;
                padding-top:0px;
                top:50%;
                border-radius:10px;
                font-size:20px;
				position:absolute;
				left:50%;
				transform: translate(-50%,-50%);
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
		<title> Learnforschool.de | Aufgabe erstellen</title>
		<script>
		</script>
</head>
    <body bgcolor=FFFFFF>
        <div class=layout>

		
<?php
include("../databaseverknuepfung.php");

if (isset($_POST['index'])) {
	
	
	$erg = $conn->query("SELECT * FROM aufgaben WHERE ID ='". $_POST['index']. "'");
	
	if ($erg->num_rows) {
		$row = $erg->fetch_assoc();
		echo "Aufgabe: " . $row["Aufgabentabelle"];
		
		$result = $conn->query("SHOW TABLES LIKE '". $row["Aufgabentabelle"]. "'");
		$tableExists = $result->num_rows > 0;
		
		$tabletype = $row["Typ"];
		$tablename = $row['Aufgabentabelle'];
		// Create table if it doesn't exist
		if (!$tableExists) {
			if($row["Typ"]=="frage"){
				$sql = "CREATE TABLE `$db`.`$tablename` (`ID` INT NOT NULL UNIQUE, `Frage` TEXT NOT NULL , `Antwort` TEXT NOT NULL ) ENGINE = InnoDB;";
			}else if($row["Typ"]=="Vocabeln"){
				$sql = "CREATE TABLE `$db`.`$tablename` (`ID` INT NOT NULL UNIQUE, `Deutsch` TEXT NOT NULL , `fremdsprache_antwort` TEXT NOT NULL, `fremdsprache` TEXT NOT NULL) ENGINE = InnoDB;";
			}
			
			if ($conn->query($sql) === TRUE) {
				echo "Table Aufgaben muste NEU erstellt werden. Diese Meldung ist bei der ERSTEN Verwendung NORMAL";
			} else {
					echo "Error creating table: " . $conn->error;
				}
			}
	}


$sql = "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$tablename'";

// Ausführen der Abfrage
$result = mysqli_query($conn, $sql);

// Erstellen der Tabelle mit den Spaltennamen
$IDnew = 1;
echo "<table>";
echo "<tr>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<th>" . $row["COLUMN_NAME"] . "</th>";
}
echo "</tr>";

    $sql = "SELECT * FROM `$tablename`";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
	if($row){
foreach($row as $key) {
                echo '<td>'. $key. '</td>';
            }
            echo '<tr>';
            while($row = $result->fetch_assoc()) {
                foreach($row as $key) {
                    echo '<td>'. $key. '</td>';
                }
                echo '</tr>';
            }


	}
	
	$sql = "SELECT COALESCE(MAX(`ID`), 0) FROM `$tablename`;";
	$result = $conn->query($sql);
	
	// Ergebnis abrufen und um 1 erhöhen
	if ($result !== false && $result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$IDnew = $row["COALESCE(MAX(`ID`), 0)"] + 1;
	} else {
		echo "Fehler: " . mysqli_error($conn);
	}
	
	
	$sql = "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$tablename'";

// Ausführen der Abfrage
	$result = mysqli_query($conn, $sql);

// Erstellen der Tabelle mit den Spaltennamen
	echo '
	<tr>
	<form method="post" action="newfrage.php">
	';
	while ($row = mysqli_fetch_assoc($result)) {
		if($row["COLUMN_NAME"]=="ID"){
			echo '
			<td>'.
			$IDnew.
			'<input type="hidden" name="ID" value="'.$IDnew.'"></input>
			</td>
			';
		}else{
			echo '
			<td>
			<input name="'. $row["COLUMN_NAME"].'" type="text" placeholder="'. $row["COLUMN_NAME"]. '" required></input>
			</td>
			';
		}
	}
	echo '
	<td>
	<input type="hidden" name="tablename" value="'.$tablename.'"></input>
	<input type="hidden" name="tabletype" value="'.$tabletype.'"></input>
	<input type="hidden" name="index" value="'.$_POST['index'].'"></input>
	<input value=erstellen type=submit></input>
	</td>
	</form>	
	</tr></br>
	<a href="Aufgabenerstellen.php">Zurück</a>';


	
	
	
	echo "</table>";

// Schließen der Verbindung zur Datenbank



}else{
	echo 'Keine Tabelle ausgewählt</br>
	<a href="Aufgabenerstellen.php">Zurück</a>';
}
mysqli_close($conn);	
?>

</div>

<a href="..\rechtliches/Datenschutz.php"> Datenschutz </a></br>
<a href="..\rechtliches/Impressum.php"> Impressum </a></br>
<p  style="font-size: 15px;color: orange;">© Copyright 2023 - Learnforschool - Alle Rechte Vorbehalten</p>

</body>
</html>
