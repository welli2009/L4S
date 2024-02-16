<?php
include("../databaseverknuepfung.php");

if (isset($_POST['index'])) {
  // SQL-Statement zum Löschen der Zeile mit dem angegebenen Index
  $sql = "DELETE FROM fachnamen WHERE id=" . $_POST['index'];

  // Ausführen des SQL-Statements
  if (mysqli_query($conn, $sql)) {
    // Weiterleitung zu addfach.php nach erfolgreichem Löschen
	echo '<script>window.location.replace("addfach.php");</script>';
    exit;
  } else {
    echo "Fehler beim Löschen des Datensatzes: " . mysqli_error($conn);
  }
}

// Schließen der Verbindung zur Datenbank
mysqli_close($conn);

?>