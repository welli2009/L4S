<?php 
if (isset($_POST["deutsch"])) {
$post_data_deutsch = $_POST["deutsch"];    
if($post_data_deutsch) {


if (isset($_POST["fr"])) {
    $post_data_fr = $_POST["fr"];
    if($post_data_fr) {
        testuser($post_data_deutsch, $post_data_fr, $_POST["je"], $_POST["tu"], $_POST["il"], $_POST["nous"], $_POST["vous"], $_POST["ils"]);
        
    }
}
}
}

function testuser($de, $fr, $je, $tu, $il, $nous, $vous, $ils){


    include("../databaseverknuepfung.php");

$verbbereits=false;
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
		  $newID=$row["verbindex"]+1;
            if($de==$row["deutsch"])
            {
                $verbbereits=true;
            }

      }
      if(!$verbbereits){
		  
    $de = makeitstring($de);
    $fr = makeitstring($fr);
	
	$je = makeitstring($je);
	$tu = makeitstring($tu);
	$il = makeitstring($il);
	
	$nous = makeitstring($nous);
	$vous = makeitstring($vous);
	$ils = makeitstring($ils);
	
    $sql = "INSERT INTO `frverben` VALUES ($newID, 1, $de, $fr, $je, $tu, $il, $nous, $vous, $ils);";
    $result = $conn->query($sql);

    echo "Erfolgreich";
      }
      else 
      {
      echo "verb bereits vorhanden!";
      }
}
}
}

function makeitstring($stringcontent){
	return	'"'. $stringcontent. '"';
}






?>

<html>
<head><title> Learnforschool.de | Verb Registrierung </title></head>
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
<form action="verbsconfig.php" method="post">
    <div class="layout">
<h1>Verb erstellen</h1>
<input placeholder="Auf Deutsch:" name='deutsch' value=""  type='text' required></input></br></br>
<input placeholder="Auf Französich:"name='fr' value=""  type='text' required></input></br></br>
<input placeholder="je:"name='je' value=""  type='text' required></input></br></br>
<input placeholder="tu:"name='tu' value=""  type='text' required></input></br></br>
<input placeholder="il / elle:" name='il' value=""  type='text' required></input></br></br>
<input placeholder="nous" name='nous' value=""  type='text' required></input></br></br>
<input placeholder="vous" name='vous' value=""  type='text' required></input></br></br>
<input placeholder="ils / elles" name='ils' value=""  type='text' required></input></br></br></br>
<button class="" style="font-size:20px;" type="submit" value="Submit" submit-btn >Verb erstellen</button></br></br><hr></form>
<button style="font-size:10px;" onclick="location = '../index.php'">Zurück</button>
        </div>

</div>
</html>