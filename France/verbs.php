<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lerne 
<?php
if (isset($_GET['fr'])) {
    $frverb = $_GET['fr'];
    echo "$frverb";
}
?>
	</title>
	<?php
include("../header.php");
include("../databaseverknuepfung.php");

if(!$conn)
{
    echo "sadman";
}

else{
    $sql = "SELECT * FROM `frverben`";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

      // output data of each row
      while($row = $result->fetch_assoc()) {
            if($frverb==$row["fr"])
            {
				$deutsch = $row["deutsch"];
				$jeverb = $row["je"];
				$tuverb = $row["tu"];
				$ilverb = $row["il"];
				$nousverb = $row["nous"];
				$vousverb = $row["vous"];
				$ilsverb = $row["ils"];
				
				break;
            }

      }
	}
}
?>
    <script>
        function senden() {
            i=0;
			testen("deutsch", "<?php echo $deutsch; ?>")
            testen("je-verb", "<?php echo $jeverb; ?>");
            testen("tu-verb", "<?php echo $tuverb; ?>");
            testen("il-verb", "<?php echo $ilverb; ?>");
            testen("nous-verb", "<?php echo $nousverb; ?>");
            testen("vous-verb", "<?php echo $vousverb; ?>");
            testen("ils-verb", "<?php echo $ilsverb; ?>");
            if(i==7){
                alert("alles Richtig 👍")
            }else{
                alert("Übe noch ein wenig weiter....");
            }

  }

    function testen(id, antwort){
        if(document.getElementById(id).value == antwort){
                document.getElementById(id).style.color = "lightgreen";
                i++;
            }
            else{
                document.getElementById(id).style.color = "red";
                document.getElementById(id).value = antwort;
            }
    }
    </script>
</head>
<body>
    <table>
        <tr>
            <th><?php echo "$frverb"; ?></th>
            <th><?php echo "$frverb"; ?></th>
        </tr>

        <tr>
            <th>Auf Deutsch:</th>

            <th>
                <input value="" id="deutsch" type="text" name="deutsch"></input>
            </th>

        </tr>
		
        <tr>
            <th>je</th>

            <th>
                <input value="" id="je-verb" type="text" name="je-verb"></input>
            </th>

        </tr>
        
        <tr>
            <th>tu</th>

            <th>
                <input value="" id="tu-verb" type="text" name="tu-verb"></input>
            </th>

        </tr>

        <tr>
            <th>il</th>

            <th>
                <input value="" id="il-verb" type="text" name="il-verb"></input>
            </th>

        </tr>

        <tr>
            <th>nous</th>

            <th>
                <input value="" id="nous-verb" type="text" name="nous-verb"></input>
            </th>

        </tr>

        <tr>
            <th>vous</th>

            <th>
                <input value="" id="vous-verb" type="text" name="vous-verb"></input>
            </th>

        </tr>

        <tr>
            <th>ils</th>

            <th>
                <input value="" id="ils-verb" type="text" name="ils-verb"></input>
            </th>

        </tr>
    </table>
<button onclick="senden()">prüfen</button>
</body>

</html>