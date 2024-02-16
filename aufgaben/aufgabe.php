<?php
$richtig = array();
if(isset($_GET["richtig"])){
$richtig = $_GET["richtig"];
}
$aufgabentabelle = getaufgabe("Aufgabentabelle", "aufgaben", $_GET['aufgabe'], "aufgabentitel");
if($_GET["aktAufgabe"]!=1){
if(getaufgabe("Antwort", $aufgabentabelle, $_GET["order"][$_GET["aktAufgabe"]-2], "ID")==$_GET["antwort"]){
    global $richtig;
    array_push($richtig, $_GET["aktAufgabe"]-1);
}else{
    echo getaufgabe("Antwort", $aufgabentabelle, $_GET["order"][$_GET["aktAufgabe"]-2], "ID")==$_GET["antwort"];
}
}


function getaufgabe($spallte, $table, $Searchfor, $Searchin){ //gibt ein die Aufgabenname wenn aufgabe verfügbar gibt sonst nichts zurück
	if(isset($_GET['aufgabe'])){
        include("../databaseverknuepfung.php");
		$sql = "SELECT * FROM ".$table." WHERE ".$Searchin. "='$Searchfor'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			return $row[$spallte];
		}
		} else {
		return;
		}
    }
    return;
}




function checkorder($aufgabe){ //SChaut ob eine reinfolge existiert und prüft diese
    if(isset($_GET['order'])){
        $order = $_GET['order'];
        sort($order);
        if($order!=getsortorder($aufgabe)){
            createorder(getsortorder($aufgabe));
        }
        $order = $_GET['order'];
        return $order;
    }

    createorder(getsortorder($aufgabe));
}

function getsortorder($aufgabe){ //gennerierteine sortierte reinfolge der aufgabe 
    include("../databaseverknuepfung.php");
    $sql = "SELECT ID FROM  $aufgabe";
    $result = $conn->query($sql);
    $id_array = array();
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        array_push($id_array, $row["ID"]);
      }
      sort($id_array);
      return $id_array;
    } else {
      echo "Keine Einträge gefunden.";
      return;
    }
}

function createorder($sortedorder){
    if(getaufgabe("Reinfolgezufall", "aufgaben", $_GET['aufgabe'], "aufgabentitel")== "on"){
        shuffle($sortedorder);
    }
    $query = http_build_query(array("order" => $sortedorder));
    $url = "https://$_SERVER[HTTP_HOST]/aufgaben/aufgabe.php?aufgabe=". getaufgabe('Aufgabentitel', "aufgaben", $_GET['aufgabe'], "aufgabentitel"). "&aktAufgabe=1". "&" . $query;
    echo '<script> window.location="'.$url.'";</script></html>';
}

function makesetup(){
	if(!getaufgabe("Aufgabentabelle", "aufgaben", $_GET['aufgabe'], "aufgabentitel")){
		echo "Aufgabe nicht verfügbar!";
        echo getaufgabe("Aufgabentabelle", "aufgaben", $_GET['aufgabe'], "aufgabentitel");
		return;
	}
	    checkorder(getaufgabe("Aufgabentabelle", "aufgaben", $_GET['aufgabe'], "aufgabentitel"));
}

function createformlink($toaufgabe){
    global $richtig;
    $url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $parts = parse_url($url);
    parse_str($parts['query'], $query);
    $order = getsortorder(getaufgabe("Aufgabentabelle", "aufgaben", $_GET['aufgabe'], "aufgabentitel"));
    $getaufgabe = $_GET["aktAufgabe"];
    if(max($order)>=$getaufgabe){
    $query['aktAufgabe'] = $toaufgabe;
    }
    foreach($richtig as $key => $value) {
        $query["richtig[$key]"] = $value;
    }
    unset($query['antwort']); // Zeile hinzugefügt, um 'antwort' zu entfernen
    $new_query_string = http_build_query($query);
    $new_url = $parts['scheme'] . '://' . $parts['host'] . $parts['path'] . '?' . $new_query_string;
    return $new_url;
    
}
makesetup();


?>

<!DOCTYPE html>
<?php 

include($_SERVER['DOCUMENT_ROOT'].'/headeraufgaben.php');
 ?> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo getaufgabe("Aufgabentitel", "aufgaben", $_GET['aufgabe'], "aufgabentitel");?></title>
    <style>
            .leisteframe{
                position: relative;
                display: flex;
                justify-content: center;
                align-items: center;
                margin-top: -1%;
            }

            #leiste {
              width: 85%;
              height: 1em;
              display: inline-flex;
              border-radius: 2em;
              border-style: solid;
              overflow: hidden;
              color: transparent;
            }

            #leiste div{
                text-align: center;
                color: black;
                border-color: transparent;
                font-family: Arial, Helvetica, sans-serif;
                font-size: 0.5em;
                padding-top: 0.25em;
            }



            .falsch {
              width: 50%;
              height: 100%;
              float: left;
              border-style: solid;
              background-color: red;
            }

            .richtig {
              width: 50%;
              height: 100%;
              float: left;
              border-style: solid;
              background-color: green;
            }

            .aktuellleiste{
              width: 50%;
              height: 100%;
              float: left;
              border-style: solid;
              background-color: rgb(128, 128, 128);
            }

            .unbearbeitet {
              width: 50%;
              height: 100%;
              float: left;
              border-style: solid;
              background-color: rgb(218, 206, 206);
            }

            .time{
                text-align: left;
                margin-top: 1%;
                font-size: 1em;
                color: black;
            }

            .frage{
                text-align: center;
                color: orange;
                font-size: 1.5em;
                font-family: Arial, Helvetica, sans-serif;
                margin-top: 15%;
            }


            .antwort {
                text-align: center;
            }

            .antwort input{
                position: relative;
                text-align: center;
                color: orange;
                font-size: 2.5em;
                font-family: Arial, Helvetica, sans-serif;
                border-radius: 1.5em;
                border-width: 0.03em;
                border-top-right-radius: 0;
                border-bottom-right-radius: 0;
                border-color: transparent;
                background-color: rgb(226, 226, 226);
                text-align: left;
                padding-left: 1em;
                width: 20%;
                height: 2em;
                margin-left: -4em;
            }

            .antwort button{
                position: absolute;
                border-color: transparent;
                background-color: rgb(226, 226, 226);
                border-top-right-radius: 1em;
                border-bottom-right-radius: 1em;
                font-size: 2.5em;
                margin-top: -0em;
                padding-top: 0.43em;
                padding-bottom: 0.43em;
            }

            .antwort button:hover{
                background-color: rgb(210, 210, 210);
            }



            .zurueck{
                position: relative;
                text-align: center;
                margin-top: 
                <?php
                $order = getsortorder(getaufgabe("Aufgabentabelle", "aufgaben", $_GET['aufgabe'], "aufgabentitel"));
                $getaufgabe = $_GET["aktAufgabe"];
                if(max($order)>=$getaufgabe){
                    echo "25%";
                }else{
                    echo "15%";
                }
                ?>;
            }

            .zurueck a{
                color: orange;
                text-decoration: none;
                font-size: 2.5em;
            }
    </style>
        <script>
        document.addEventListener("DOMContentLoaded", function() {
          var eingabe = document.getElementById("antwort");
          eingabe.addEventListener("keydown", function(e) {
            if (e.code === "Enter") {
                sendanswere();
            }
          });
        });

        function sendanswere(){
            let antwort =document.querySelector("#antwort").value
            <?php 
                echo "window.location = '". createformlink($_GET["aktAufgabe"]+1). "&antwort=' + antwort;";

            ?>
            
        }
        <?php
        if(getaufgabe("Zeitbegrenzung", "aufgaben", $_GET['aufgabe'], "aufgabentitel")!=0){
            $order = getsortorder(getaufgabe("Aufgabentabelle", "aufgaben", $_GET['aufgabe'], "aufgabentitel"));
            $getaufgabe = $_GET["aktAufgabe"];
            if(max($order)>=$getaufgabe){
            echo "let count =". getaufgabe("Zeitbegrenzung", "aufgaben", $_GET['aufgabe'], "aufgabentitel"); 
            echo '
        const countdown = setInterval(() => {
            document.querySelector(".time").textContent = "Verbleibende Sekunden: " + count;
            count--;
            if(count < 0) {
                clearInterval(countdown);
                sendanswere();
            }
        }, 1000);';
    }}

    ?>
</script>
</head>
<body>
    <div class="time">
        <?php
        $order = getsortorder(getaufgabe("Aufgabentabelle", "aufgaben", $_GET['aufgabe'], "aufgabentitel"));
        $getaufgabe = $_GET["aktAufgabe"];
        if(max($order)>$getaufgabe){
        if(getaufgabe("Zeitbegrenzung", "aufgaben", $_GET['aufgabe'], "aufgabentitel")!=0){
            echo "Verbleibende Sekunden: ". getaufgabe("Zeitbegrenzung", "aufgaben", $_GET['aufgabe'], "aufgabentitel");
        }
    }
        ?>



    </div>

    <div class="leisteframe">
        <div id="leiste">
            <?php
            
            $aufgabentabelle = getaufgabe("Aufgabentabelle", "aufgaben", $_GET['aufgabe'], "aufgabentitel");
            foreach(getsortorder(getaufgabe("Aufgabentabelle", "aufgaben", $_GET['aufgabe'], "aufgabentitel")) as $aufgabennummer){
                if($_GET["aktAufgabe"]==$aufgabennummer){
                    echo '<div class="aktuellleiste" title="Aufgabe '. $aufgabennummer. ' wird gerade bearbeitet." onclick="link" >'. $aufgabennummer. '</div>';
                }else if(($_GET["aktAufgabe"]!=1) AND ($_GET["aktAufgabe"]-1==$aufgabennummer)){
                    if(getaufgabe("Antwort", $aufgabentabelle, $_GET["order"][$_GET["aktAufgabe"]-2], "ID")==$_GET["antwort"]){
                        echo '<div class="richtig" title="Aufgabe '. $aufgabennummer. ' ist richtig." onclick="link" >'. $aufgabennummer. '</div>';
                    }else{
                        echo '<div class="falsch" title="Aufgabe '. $aufgabennummer. ' ist falsch." onclick="link" >'. $aufgabennummer. '</div>'; 
                    }
                }elseif($aufgabennummer<$_GET["aktAufgabe"]){
                    if(in_array($aufgabennummer, $richtig)){
                        echo '<div class="richtig" title="Aufgabe '. $aufgabennummer. ' ist richtig." onclick="link" >'. $aufgabennummer. '</div>';
                    }else{
                        echo '<div class="falsch" title="Aufgabe '. $aufgabennummer. ' ist falsch." onclick="link" >'. $aufgabennummer. '</div>'; 
                    }
                }else{
                    echo '<div class="unbearbeitet" title="Aufgabe '. $aufgabennummer. ' wurde noch nicht bearbeitet." onclick="link" >'. $aufgabennummer. '</div>';
                }
            }
        
            ?>

        </div>
    </div>


    <div class="frage">
        <h1>
            <?php
                $order = getsortorder(getaufgabe("Aufgabentabelle", "aufgaben", $_GET['aufgabe'], "aufgabentitel"));
                $getaufgabe = $_GET["aktAufgabe"];
                if(max($order)<$getaufgabe){
                    echo "Aufgabe beendet";
                }else{
                $aufgabentabelle = getaufgabe("Aufgabentabelle", "aufgaben", $_GET['aufgabe'], "aufgabentitel");
                echo getaufgabe("Frage", $aufgabentabelle, $_GET["order"][$_GET["aktAufgabe"]-1], "ID");
                }
           
            ?>
        </h1>
        <h1 style="font-size: 1em; color: red">     
        <?php           
            if($_GET["aktAufgabe"]!=1){
                if(getaufgabe("Antwort", $aufgabentabelle, $_GET["order"][$_GET["aktAufgabe"]-2], "ID")!=$_GET["antwort"]){
                    echo "Falsch, ".getaufgabe("Antwort", $aufgabentabelle, $_GET["order"][$_GET["aktAufgabe"]-2], "ID"). " wäre richtig gewesen.";
                }
            }
        ?>
        </h1>

    </div>

    
        <?php
    echo '<div class="antwort">';
    $order = getsortorder(getaufgabe("Aufgabentabelle", "aufgaben", $_GET['aufgabe'], "aufgabentitel"));
                $getaufgabe = $_GET["aktAufgabe"];
                if(max($order)>=$getaufgabe){
                    echo '       
                    <input label="antwort" id="antwort" value="" name="antwort" title="Geben Sie die Antwort auf die Frage ein!" type="text">
                        <button label="senden" id="send" title="sendet die antwort ab!" onclick="sendanswere()">Senden</button>
                    </input>';
                }

        echo '</div>';
        ?>
    
    
    <div class="zurueck">
        <a href="../aufgaben.php" title="Gehe zurück zur Aufgaben übersicht.">zurück</a>
    </div>



</body>

</html>