<?php
include("../databaseverknuepfung.php");
print_r($_POST);

foreach ($_POST as $key => $value) {
    if (strpos($value, "'") !== false) {
        $_POST[$key] = str_replace("'", "\"", $value);
    }
}
function bearbeiten(){
	echo '
				<form method="post" action="bearbeiten.php">
				<input type="hidden" name="index" value="'. $_POST['index'].'">
				<input type="submit" value="Submit" id="erstellen">
			</form>
				<script>
					const button = document.getElementById("erstellen");

					// Um das formula neu zu senden für die datei bearbeiten
					button.click();
				</script>';
}
if(isset($_POST["tablename"])){
 if($_POST["tablename"] != "nutzer"){
	 echo '<h1>'. $_POST["tablename"]. '</h1>';
	 
	  if($_POST["tabletype"] == "frage"){
		  $sql = "INSERT INTO `".$_POST["tablename"] ."` VALUES ('". $_POST["ID"]. "', '". $_POST["Frage"]. "', '". $_POST["Antwort"]. "');";
		    if (mysqli_query($conn, $sql)) {
				// Weiterleitung zu addfach.php nach erfolgreichem Löschen
				bearbeiten();
  }
	  }else if($_POST["tabletype"] == "Vocabeln"){
		  
		  $sql = "INSERT INTO `".$_POST["tablename"] ."` VALUES ('". $_POST["ID"]. "', '". $_POST["Deutsch"]. "', '". $_POST["fremdsprache_antwort"]. "', '". $_POST["fremdsprache"]. "')";
		  
		  if (mysqli_query($conn, $sql)) {
		  bearbeiten();
		  }
	  }
	
 }else{
		mysqli_close($conn);
	 	echo '<script>window.location.replace("bearbeiten.php");</script>';
	 
 }
// Schließen der Verbindung zur Datenbank
}
else{
	mysqli_close($conn);
	echo '<script>window.location.replace("bearbeiten.php");</script>';
}
mysqli_close($conn);

?>