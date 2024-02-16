<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rezept_name = $_POST['rezept_name'] ?? '';
    $gesamtdauer = $_POST['gesamtdauer'] ?? '';

    // Schritte verarbeiten
    $schritte = $_POST['schritte'] ?? [];
    $rezept_content = "Name: $rezept_name\n";
    $rezept_content .= "Gesamtdauer: $gesamtdauer\n\n";

    $schrittNummer = 1;
    foreach ($schritte as $index => $schritt) {
        if (isset($schritt['name']) && isset($schritt['dauer']) && isset($schritt['anweisungen'])) {
            $rezept_content .= "Schritt $schrittNummer: {$schritt['name']}\n";
            $rezept_content .= "Dauer: {$schritt['dauer']}\n";
            $rezept_content .= "Anweisungen: {$schritt['anweisungen']}\n";
            
            if (isset($schritt['zutaten'])) {
                $rezept_content .= "Benötigte Zutaten:\n";
                foreach ($schritt['zutaten'] as $zutat) {
                    $rezept_content .= "- $zutat\n";
                }
            }
            $rezept_content .= "\n";
            $schrittNummer++;
        }
    }

    $rezept_datei = "$rezept_name.php";
    file_put_contents($rezept_datei, $rezept_content);

    $rezepte_datei = 'rezepte.txt';
    $rezept_info = "$rezept_name: Rezept/$rezept_datei\n";
    file_put_contents($rezepte_datei, $rezept_info, FILE_APPEND);

    echo "Das Rezept wurde erfolgreich erstellt!<br><br>";
    echo '<a href="https://learnforschool.de/Rezept/Rezept.php">Zurück zur Startseite</a>';
} else {
    echo "Ungültige Anfrage";
}
?>
