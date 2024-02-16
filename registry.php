<?php 
if (isset($_POST["username"])) {
$post_data_username = $_POST["username"];    
if($post_data_username) {


if (isset($_POST["passwort"])) {
    $post_data_password = $_POST["passwort"];
    if($post_data_password) {
        testuser($post_data_password, $post_data_username);
        
    }
}
}
}

function testuser($newpassword,$newname){


    include("databaseverknuepfung.php");

$namegenutz=false;
if(!$conn)
{
    echo "sadman";
}
else{
    $sql = "SELECT ID, Username, Passwort FROM `nutzer`";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

      // output data of each row
      while($row = $result->fetch_assoc()) {
            $newID=$row["ID"]+1;
            if($newname==$row["Username"])
            {
                $namegenutz=true;
            }

      }
      if(!$namegenutz){
        $newpassword = password_hash($newpassword, PASSWORD_DEFAULT);
    $passwordnew= '"'. $newpassword. '"';
    $namenew= '"'. $newname. '"';
    $sql = "INSERT INTO `nutzer` VALUES ($newID, $namenew, $passwordnew);";
    $result = $conn->query($sql);

    echo "Erfolgreich";
    echo "<script>window.location='index.php';</script>";
      }
      else 
      {
      echo "name bereits verwendet!";
      }
}
}
}








?>

<html>
<head><title> Learnforschool.de | Registrierung </title></head>
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
<form action="registry.php" method="post">
    <div class="layout">
<h1>Account erstellen</h1>
<input placeholder="Nutzername" name='username' value=""  type='text' required></input></br></br>
<input placeholder="Passwort"name='passwort' value=""  type='password' required></input></br></br></br>
<button class="" style="font-size:20px;" type="submit" value="Submit" submit-btn >Account erstellen</button></br></br><hr></form>
<button style="font-size:10px;" onclick="location = 'index.php'">Zurück</button>
        </div>

</div>
<a href="http://localhost/main/rechtliches/Datenschutz.php"> Datenschutz </a></br>
<a href="http://localhost/main/rechtliches/Impressum.php"> Impressum </a></br>
<p  style="font-size: 15px;color: orange;">© Copyright 2023 - Learnforschool - Alle Rechte Vorbehalten</p>

</html>