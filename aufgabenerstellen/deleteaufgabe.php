<?php
include("../databaseverknuepfung.php");

if (isset($_POST['index'])) {

$erg = $conn->query("SELECT * FROM aufgaben WHERE ID = ". $_POST['index']);
	if ($erg->num_rows) {
		$row = $erg->fetch_assoc();
		$tablename = $row["Aufgabentabelle"];
		
		$sql = "DROP TABLE `". $tablename. "`";
		$result = $conn->query($sql);

	}
	
  // SQL-Statement zum Löschen der Zeile mit dem angegebenen Index
  $sql = "DELETE FROM aufgaben WHERE ID=" . $_POST['index'];

  // Ausführen des SQL-Statements
  if (mysqli_query($conn, $sql)) {
    // Weiterleitung zu addfach.php nach erfolgreichem Löschen
  } else {
    echo "Fehler beim Löschen des Datensatzes: " . mysqli_error($conn);
  }
  
  
  
}

// Schließen der Verbindung zur Datenbank
echo '<script>window.location.replace("Aufgabenerstellen.php");</script>';
exit;
mysqli_close($conn);

?>