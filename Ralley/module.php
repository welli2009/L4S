<?php
session_start();
function dbconnect(){
        define('host','rdbms.strato.de');
        define('user','dbu382844');
        define('pass','iN9DQtH5vB%%XM6');
        define('db','dbs12503749');
        $conn = mysqli_connect(host, user, pass, db);
        if (!$conn){
            die("Connection failed: ". mysqli_connect_error());
        }
        return $conn;
    }

    function sqlbefehl($conn, $sqlbefehl){
        return $conn->query($sqlbefehl);
    }

    function checktableexistence($conn, $tablename){
        if(sqlbefehl($conn, "SHOW TABLES LIKE '$tablename'")->num_rows > 0){
            return true;
        } else{
            return false;
        }
    }

    function createtable($conn, $tablename){
        //erstellt eine tabelle wenn diese noch nicht existiert
        if($tablename=="stations"){
            if(!checktableexistence($conn, "stations")){
                sqlbefehl($conn, "
                    CREATE TABLE `stations` (
                    ID int NOT NULL AUTO_INCREMENT,
                    `Name` text COLLATE utf8mb4_general_ci NOT NULL,
                    `N-Koordinate` float NOT NULL,
                    `O-Koordinate` float NOT NULL,
                    PRIMARY KEY (ID),
                    UNIQUE (ID)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;"
                );
            }
            return;
        }
        if($tablename=="Gruppen") {
            if(!checktableexistence($conn, "Gruppen")){
                sqlbefehl($conn, "
                    CREATE TABLE `Gruppen` (
                    ID int NOT NULL AUTO_INCREMENT,
                    `Gruppenname` text COLLATE utf8mb4_general_ci NOT NULL,
                    `Passwort` text COLLATE utf8mb4_general_ci NOT NULL,
                    PRIMARY KEY (ID),
                    UNIQUE (ID)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;"
                );
            }
            return;
        }
    }


    function createfragetable($conn, $stationid){
        $tablename = getstationtablename($conn, removesqlinjection($stationid));
        if($tablename==false){
            return;
        }
        if(!checktableexistence($conn, $tablename)){
            $createtablesql = "
                CREATE TABLE `$tablename` (
                    ID int NOT NULL AUTO_INCREMENT,
                    `Frage` text COLLATE utf8mb4_general_ci NOT NULL,
                    `Antwort` text COLLATE utf8mb4_general_ci NOT NULL,
                    PRIMARY KEY (ID),
                    UNIQUE (ID)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
            sqlbefehl($conn, $createtablesql);
        }
    }

    function gethighestid($conn, $tablename){
        $sqlbefehl = "SELECT MAX(ID) AS MaxID FROM $tablename";
        $result = sqlbefehl($conn, $sqlbefehl);
        if ($result->num_rows > 0) {
            // Daten der einzelnen Zeile ausgeben
            while($row = $result->fetch_assoc()) {
                return $row["MaxID"];
            }
        } else {
            return false;
        }
    }

    function aktualisiereIds($conn, $tabelle) {
        $sqlbefehl = "SELECT * FROM " . $tabelle . " ORDER BY ID ASC";
        $resultat = sqlbefehl($conn, $sqlbefehl);
        if ($resultat === false) {
            echo "Fehler bei der Ausführung des SQL-Befehls: " . $conn->error;
        } elseif($resultat->num_rows > 0) {
            $neueId = 1;
            while ($zeile = $resultat->fetch_assoc()) {
                if ($zeile['ID'] != $neueId) {
                    $updateSql = "UPDATE " . $tabelle . " SET ID=" . $neueId . " WHERE ID=" . $zeile['ID'];
                    $updateResultat = sqlbefehl($conn, $updateSql);
                    if ($updateResultat === false) {
                        echo "Fehler bei der Aktualisierung der ID: " . $conn->error;
                    }
                }
                $neueId++;
            }
            $newincrement = gethighestid($conn, $tabelle);
            $sqlbefehl = "ALTER TABLE $tabelle AUTO_INCREMENT = $newincrement";
            sqlbefehl($conn, $sqlbefehl);
        }
    }
    
    
    function zeichneTabelle($conn, $tabelle, $fileid){
        $result = sqlbefehl($conn, "SELECT * FROM $tabelle");
        if ($result->num_rows > 0) {
            echo "<table><tr>";
            $fields = $result->fetch_fields();
            foreach ($fields as $field) {
                echo "<th>" . $field->name . "</th>";
            }
            echo "<th>Aktionen</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $data) {
                    echo "<td>" . $data . "</td>";
                }
                echo "<td><a href='edit.php?id=".$row['ID']."&tabelle=".$tabelle."'>Bearbeiten</a> | <a href='delete.php?id=".$row['ID']."&tabelle=".$tabelle."&fileid=". $fileid. "'>Löschen</a>";
                if ($tabelle == "stations"){
                    echo " | <a href='addfragen.php?stationid=".$row['ID']."'> Frage hinzufügen </a>";
                }
                echo "</td></tr>";
            }
            echo "</table>";
        }
    }
    
    function stationsasvar($conn){
        $result = sqlbefehl($conn, "SELECT * FROM stations");
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo("{ lat: ". $row['N-Koordinate']. ", lon: ". $row['O-Koordinate']. ", status: 'locked', label: '". $row['Name']."'},");
            }
        }
    }
    
    
    // Definiere eine Funktion, die alle Anführungszeichen, Semikolons und Apostrophe aus einem String entfernt
    function removesqlinjection($string) {
        $string = str_replace(array('"', ';', "'"), '', $string);
        return $string;
    }
  
  
    function getstationtablename($conn, $id){
        $sql = "SELECT Name FROM stations WHERE ID = $id";
    
        // Ausführen des SQL-Befehls
        $result = sqlbefehl($conn, $sql);
        
        if ($result->num_rows > 0) {
            // Holen Sie sich den Namen
            $row = $result->fetch_assoc();
            $name = $row['Name'];
            $name = str_replace(array('ä', 'ö', 'ü', 'ß'), array('ae', 'oe', 'ue', 'ss'), $name);
            // Ersetzen Sie alle Zeichen, die nicht für einen SQL-Tabellennamen zulässig sind
            $name = preg_replace('/[^A-Za-z0-9\_]/', '', $name);
            
            return $name;
        } else {
            return false;
        }
    }
    

    function getstationname($conn, $id){
        $sql = "SELECT Name FROM stations WHERE ID = $id";
        $result = sqlbefehl($conn, $sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $name = $row['Name'];
            return $name;
        }else{
            return;
        }
    }
    
    
    function httpsredirect(){
        if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off') {
            $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            header('HTTP/1.1 301 Moved Permanently');
            echo "
                <script>
                window.location.href = '". $redirect. "';
                </script>
            ";
        }
    }
    
    function anmelden($conn){
        if(isset($_POST["gruppenname"]) && isset($_POST["passwort"])){
            $gruppenname = removesqlinjection($_POST["gruppenname"]);
            $passwort = $_POST["passwort"];
            
            $sql = sqlbefehl($conn, "SELECT * FROM Gruppen WHERE Gruppenname='$gruppenname'");
                if (mysqli_num_rows($sql) > 0) {
                    $row = mysqli_fetch_assoc($sql);
                    if (password_verify($passwort, $row["Passwort"])) {
                        $_SESSION['gruppenname'] = $_POST["gruppenname"];
                        $_SESSION['ID'] = $row['ID'];
                        $_SESSION['Passwort'] = $row['Passwort'];
                        return;
                    }
                }
            echo "Falsche Anmeldetaten!";
        }
    }

    function angemeldet($conn) {
        if(isset($_SESSION['gruppenname']) && isset($_SESSION['ID'])){
            $gruppenname = removesqlinjection($_SESSION['gruppenname']);
            $id = removesqlinjection($_SESSION['ID']);
            $passwort = removesqlinjection($_SESSION['Passwort']);
            $sql = sqlbefehl($conn, "SELECT * FROM Gruppen WHERE Gruppenname='$gruppenname' AND ID='$id' AND Passwort='$passwort'");
            if(mysqli_num_rows($sql) > 0){
                return true;
            }else{
                return false;
            }
        }
        return false;
    }
    

    function loginmaske($conn) {
        anmelden($conn);
        if (!angemeldet($conn)) {
            $targetsite = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            echo '<div class="login">';
            echo '<div class="schrift">';
            echo '  <h1> Login </h1></br>';
            echo '</div>';
            echo '  <div class="formular">';
            echo '      <form action="'. $targetsite.'" method="post">';
            echo '        <input type="text" name="gruppenname" placeholder="Katzen" required></br>';
            echo '        <input type="password" name="passwort" placeholder="" required></br>';
            echo '        <input type="submit" value="Anmelden">';
            echo '      </form>';
            echo '  </div>';
            echo '</div>';
        } else {
            echo 'Willkommen Gruppe: , ' . $_SESSION['gruppenname'] . '!'; // Hier den Benutzernamen aus der Session verwenden
        }
    }
    
?>