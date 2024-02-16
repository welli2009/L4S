<?php
session_start();

if ($_SESSION["Logstatus"]) {
    include("databaseverknuepfung.php");

    $userID = $_SESSION["ID"]; // Wert der Session speichern

    // Verhindere SQL Injection
    $stmt = $conn->prepare("DELETE FROM `nutzer` WHERE `ID` = ?");
    $stmt->bind_param("s", $userID);
    $stmt->execute();

    // Überprüfe, ob der Eintrag gelöscht wurde und leite zur Logout-Seite weiter
    if ($stmt->affected_rows > 0) {
        if (!headers_sent()) {
            header("Location: logout.php");
            exit;
        } else {
            echo '<script type="text/javascript">
                window.location.href="logout.php";
            </script>';
            exit;
        }
    } else {
        echo "Fehler beim Löschen des Benutzers.";
        exit;
    }
} else {
    header("Location: logout.php");
    exit;
}

// Zerstöre die Session-Daten
session_destroy();
?>
