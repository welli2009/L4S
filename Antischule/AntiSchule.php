<?php
header('Content-Type: text/html; charset=utf-8');
if(isset($_SERVER['HTTP_REFERER'])) {
    $previousSite = $_SERVER['HTTP_REFERER'];
    echo "Sie haben eine Verbotene/Unerwuenschte Website Besucht. Bitte Unterlassen sie dies in Zukunft: " . $previousSite;
} else {
    echo "Keine Referrer-Informationen verfuegbar, trotzdem
    haben sie eine unerwuenschte/verbotene Website besucht. Bitte unterlassen Sie dies zukuenftig.";
}
?>