<!DOCTYPE html>
<html>
<head>
    <title>Alle Rezepte</title>
</head>
<body>
<div class="main">
    <h1>Alle Rezepte</h1>
    <ul>
        <?php
        $rezepte_datei = 'Rezept/rezepte.txt'; // Passe den Dateinamen an, wenn nötig
        
        if (file_exists($rezepte_datei)) {
            $rezepte_liste = file($rezepte_datei, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            
            foreach ($rezepte_liste as $rezept_info) {
                list($rezept_name, $rezept_datei) = explode(": ", $rezept_info);
                echo "<li><a href='$rezept_datei'>$rezept_name</a></li>";
            }
        } else {
            echo "Keine Rezepte vorhanden.";
        }
        ?>
    </ul>
    <a href="Rezept/rezept_hinzufuegen.php">Rezept hinzuf&uuml;gen</a>
</div>
</body>
<style>
html{
background-color: black;
color: white;
}
h1, h2, h3, h4, h5, h6 {
  color: blue;
}
h1:hover, h2:hover, h3:hover, h4:hover, h5:hover, h6:hover {
  color: red;
}
.main{
  position: relative;
  width: 1000px; 
  height: 200px; 
  top: 50%;
  left: 65%;
  transform: translate(-50%, -50%);
  margin-top: 200px;
}


}
</style>
</html>