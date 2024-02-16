<?php
session_start();

if (!isset($_SESSION["Logstatus"])) {
    header("Location: index.php"); // Hier den Namen deiner Login-Seite eintragen
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learnforschool.de | Aufgabenübersicht</title>
    <style>
            .ueberschrift {
        font-size: 20px;
        font-family: arial;
    }

    .text-1 {
        padding-left: 30px;
        font-size: 18px;
        font-family: arial;
        text-align: left;
    }

    .underline {
        text-decoration: underline;
    }

    li {
        padding-left: 5%;
    }

    a {
        color: grey;
    }

    .text {
        padding-left: 30px;
    }
    </style>
</head>
<body>
    <?php 
    include("header.php"); 
    include("databaseverknuepfung.php");
    ?>
    <div class="text">
        <div class="ueberschrift">
            <h1>Aufgabenübersicht:</h1>
        </div>


        <div class="ueberschrift">
        <h2>Klasse: 7 | Informatik:</h2>
        </div>
        <li> <a href="info/bin.php"> Übungen | Thema: Binärcode</a></li>
        <br>

        <div class="ueberschrift">
            <h2>Klasse: 7 | Mathe:</h2>
        </div>
        <li> <a href="Mathe/protzente.php"> Übungen | Thema: Prozentrechnung</a></li>
        <br>

        <div class="ueberschrift">
            <h2> Klasse 7 | Französisch:</h2>
        </div>
        <li> <a href="France/Vocabelneins.php"> Vokabeln | Tage und Unterricht</a></li>
        </br>
        <?php
        if (!$conn) {
            echo "Fehler: Verbindung zur Datenbank fehlgeschlagen: " . mysqli_connect_error();
        } else {
            $sql = "SELECT * FROM `frverben`";
            $result = $conn->query($sql);

            if ($result === false) {
                echo "Fehler beim Ausführen der Abfrage: " . mysqli_error($conn);
            } else {
                if ($result->num_rows > 0) {
                    // Ausgabe der Daten jeder Zeile
                    while ($row = $result->fetch_assoc()) {
                        if ($row["verbindex"] != 0) {
                            echo '<li> <a href="France/verbs.php?fr=' . $row["fr"] . '"> Unregelmäßige Verben | ' . $row["fr"] . '</a></li>';
                        }
                    }
                }
                echo '        
                <div class="ueberschrift">
                    <h2> Klasse 8 | Englisch:</h2>
                    </div>
                    <li> <a href="English/Vokabelneins.php"> Vokabeln | Unit: 1</a></li>
               <br>';
                $sql = "SELECT * FROM `fachnamen` ORDER BY Prioritaet DESC;";
                $result = $conn->query($sql);

                if ($result === false) {
                    echo "Fehler beim Ausführen der Abfrage: " . mysqli_error($conn);
                } else {
                    if ($result->num_rows > 0) {
                        // Ausgabe der Daten jeder Zeile
                        while ($row = $result->fetch_assoc()) {
                            echo "
                            <div class='ueberschrift'>
                                <h2>" . $row["Fachnamen"] . ":</h2>
                            </div>";

                            // Abfrage für Aufgaben mit demselben Fachnamen
                            $sql2 = "SELECT * FROM `aufgaben` WHERE Fach='" . $row["Fachnamen"] . "' ;";
                            $result2 = $conn->query($sql2);

                            if ($result2 === false) {
                                echo "Fehler beim Ausführen der Abfrage: " . mysqli_error($conn);
                            } else {
                                if ($result2->num_rows > 0) {
                                    // Ausgabe der Daten jeder Zeile
                                    while ($row2 = $result2->fetch_assoc()) {
                                        echo '
                                        <li> <a href="aufgaben/aufgabe.php?aufgabe=' . $row2["Aufgabentitel"] . '">' . $row2["Aufgabentitel"] . '</a></li>';
                                    }
                                } else {
                                    echo "Noch Keine wir arbeiten bereits dran! ;) </br>";
                                }
                            }
                        }
                    } else {
                        echo "Keine Fächer gefunden.<br>";
                    }
                }
            }
        }
        ?>

        </br>
    </div>
</body>
</html>


