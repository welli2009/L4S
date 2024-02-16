<?php
include("../databaseverknuepfung.php");
$order="'off'";



if(!$conn)
{
    echo "sadman";
}
else{
	echo "<script> console.log('DB Verbindung erfolgreich');</script>";




$result = $conn->query("SHOW TABLES LIKE 'aufgaben'");
$tableExists = $result->num_rows > 0;

// Create table if it doesn't exist
if (!$tableExists) {
	$sql = "CREATE TABLE `$db`.`aufgaben` (`ID` INT NOT NULL UNIQUE, `Aufgabentitel` TEXT NOT NULL , `Typ` TEXT NOT NULL , `Reinfolgezufall` TEXT NOT NULL , `Zeitbegrenzung` TEXT NOT NULL , `Priorität` INT NOT NULL , `Aufgabentabelle` TEXT NOT NULL, `Fach` TEXT NOT NULL ) ENGINE = InnoDB;";
	
	if ($conn->query($sql) === TRUE) {
		echo "Table Aufgaben muste NEU erstellt werden diese meldung ist bei der ERSTEN Verwendung NORMAL";
	} else {
			echo "Error creating table: " . $conn->error;
		}
	}
	
	if(isset($_POST['dbtitel'])){
		if($_POST['dbtitel']!="nutzer"){
	foreach ($_POST as $key => $value) {
		${$key} = "'". $value. "'";
	}
	
	$sql = "SELECT COALESCE(MAX(`ID`), 0) FROM `aufgaben`;";
	$result = $conn->query($sql);
	
	// Ergebnis abrufen und um 1 erhöhen
	if ($result !== false && $result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$id = $row["COALESCE(MAX(`ID`), 0)"] + 1;
	} else {
		echo "Fehler: " . mysqli_error($conn);
	}
		

	$sql = "INSERT INTO `aufgaben` (`ID`, `Aufgabentitel`, `Typ`, `Reinfolgezufall`, `Zeitbegrenzung`, `Prioritaet`, `Aufgabentabelle`, `Fach`) VALUES 
									($id, $aufgabentitel, $aufgabentyp, $order, $zeitbegrenzungsnummer, $prioritaet, $dbtitel, $fach)";
	$result = $conn->query($sql);
	
	echo "erfolgreich erstellt $aufgabentitel";
}
	}
}











?>
<html>
<head>
    <style>
            .layout{
                background-color:white;
                border-width:10px;
                border: solid 3px #797989;

                width:20%;

                padding:20px;
                padding-top:0px;
                position:absolute;
                left:50%;
                top:50%;
                transform: translate(-50%,-50%);
                border-radius:10px;
                font-size:20px;
            }

            .table{
                background-color:white;
                border-width:10px;
                border: solid 3px #797989;
				width:40%;
                padding:20px;
                padding-top:0px;
                top:100%;
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
<form action="Aufgabenerstellen.php" method="post">
		<title> Learnforschool.de | Aufgabe erstellen</title>
		<script>
		
		function addFachumleitung(){
			if (document.getElementById("fach").value === "addfach") {
			
				window.location = "addfach.php";
				
			}
		}
		
        function zeitbegrenzung() {
            var checkBox = document.getElementById("Zeitbegrenzung");
            var text = document.getElementById("Zeitbegrenzungnummer");
                if (checkBox.checked == true){
                   text.style.display = "block";
                 } 

                 else {
                    text.style.display = "none";
                    text.value = "0";
                 }
}
		</script>
</head>
    <body bgcolor=FFFFFF>
        <div class=layout>

<h1>Aufgabe erstellen</h1>

<label for="fach">Fach: </label>
	<select name="fach" id="fach" onchange="addFachumleitung()">
		<option value="" onclick="">--Auswählen--</option>
		<?php 
$result = $conn->query("SHOW TABLES LIKE 'fachnamen'");
$tableExists = $result->num_rows > 0;

// Create table if it doesn't exist
if (!$tableExists) {
	$sql = "CREATE TABLE `$db`.`fachnamen` (`id` INT NOT NULL , `Fachnamen` TEXT NOT NULL , `Prioritaet` INT NOT NULL ) ENGINE = InnoDB;";
	
	if ($conn->query($sql) === TRUE) {
		echo "<script>alert('Es musste die Fächertabelle erstellt werden.')</script>";
	} 
	}

			$sql = "SELECT fachnamen FROM fachnamen";
			$result = $conn->query($sql);
			
		if ($result->num_rows > 0) {
			// Ausgabe der Daten jeder Zeile
			while($row = $result->fetch_assoc()) {
				echo "<option value='".$row["fachnamen"]."'>".$row["fachnamen"]."</option>";
			}
			
			}

		?>
		<option value="addfach" onclick="">Fach Hinzufügen</option>
	</select>
	
</br></br>

<label for="aufgabentitel"> Anzeigetitel: </label>
	<input id="aufgabentitel" name="aufgabentitel" placeholder="Katzen | Katzenartbestimmen" value=""  type='text' required></input>

</br></br>

<label for="dbtitel"> DBTitel: </label>
	<input id="dbtitel" name="dbtitel" placeholder="Katzenartbestimmen" value=""  type='text' required></input>

</br></br>

<label for="aufgabentyp"> Aufgabentyp: </label>
	<select name="aufgabentyp" id="fach">
		<option value="frage"> Frage </option>
        <option value="Vocabeln"> Vocabeln </option>
        <option value="multiple_choice"> Multiple Choice</option>
    </select>

</br></br>

<label for="Zeitbegrenzung"> Zeitbegrenzung in Sekunden </label>
    <input type="checkbox" name="Zeitbegrenzung" id="Zeitbegrenzung" onclick="zeitbegrenzung()"></input>
</br>

    <input type="number" min="0" max="1800" name="zeitbegrenzungsnummer" id="Zeitbegrenzungnummer" value="0" style="display:none"></input>
</br>
</br>

<label for="order">Zufällige Reihenfolge</label>
    <input id="order" name="order" type="checkbox"></input>

</br></br>

<label for="prioritaet">Priorität</label>
    <input id="prioritaet" name="prioritaet" type="number" min="1" max="255" required></input> 
 
</br></br></br>

<button class="" style="font-size:20px;" id='erstellen' type="submit" value="Submit" submit-btn >erstellen</button></br></br><hr></form>
<button style="font-size:10px;" onclick="location = '../index.php'">Zurück</button>
</div>
</div>


<a href="..\rechtliches/Datenschutz.php"> Datenschutz </a></br>
<a href="..\rechtliches/Impressum.php"> Impressum </a></br>
<p  style="font-size: 15px;color: orange;">© Copyright 2023 - Learnforschool - Alle Rechte Vorbehalten</p>

<div class="table">
</form>
<?php
    $sql = "SELECT * FROM aufgaben";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    
if($row){
   echo "<table>";
   
            foreach($row as $schluessel => $innen) {
                echo '<th>'. $schluessel. '</th>';

            }
            echo '</tr>';
            foreach($row as $key) {
                echo '<td>'. $key. '</td>';

            }
			echo "
				  <td>
					<form method='post' action='deleteaufgabe.php'>
						<input type='hidden' name='index' value='".$row['ID']."'>
						<input type='submit' name='delete' value='Delete'>
					</form>
				  </td>
				  
				  <td>
					<form method='post' action='bearbeiten.php'>
						<input type='hidden' name='index' value='".$row['ID']."'>
						<input type='submit' name='edit' value='edit'>
					</form>
				  </td>
					";
			echo '<tr>';
            while($row = $result->fetch_assoc()) {
                foreach($row as $key) {
                    echo '<td>'. $key. '</td>';
                }
				echo "
				  <td>
					<form method='post' action='deleteaufgabe.php'>
						<input type='hidden' name='index' value='".$row['ID']."'></input>
						<input type='submit' name='delete' value='Delete'></input>
					</form>
				  </td>
				  
				  <td>
					<form method='post' action='bearbeiten.php'>
						<input type='hidden' name='index' value='".$row['ID']."'></input>
						<input type='submit' name='edit' value='edit'></input>
					</form>
				  </td>
				";
				
				
				echo '<tr>';
				
            }
}else{
	echo "noch keine daten";
}

		$conn->close();
?>
</div>
</body>
</html>
