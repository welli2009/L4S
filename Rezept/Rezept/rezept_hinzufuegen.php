<!DOCTYPE html>
<html>
<head>
    <title>Rezept hinzufügen</title>
<script>
    let schrittNummer = 1;

    function addStep() {
        const stepDiv = document.createElement("div");
        stepDiv.classList.add("schritt");

        stepDiv.innerHTML = `
            <h3>Schritt ${schrittNummer}</h3>
            <label>Name des Schrittes:</label>
            <input type="text" name="schritte[${schrittNummer}][name]" required><br>
            <label>Dauer:</label>
            <input type="text" name="schritte[${schrittNummer}][dauer]" required><br>
            <label>Benötigte Zutaten:</label>
            <input type="text" name="schritte[${schrittNummer}][zutaten][]" placeholder="Zutat"><br>
            <button type="button" onclick="addIngredient(this)">Zutat hinzufügen</button><br>
            <label>Detaillierte Anweisungen:</label>
            <textarea name="schritte[${schrittNummer}][anweisungen]"></textarea><br>
        `;

        document.getElementById("schritte").appendChild(stepDiv);
        schrittNummer++;
    }

    function addIngredient(button) {
        const parentDiv = button.parentNode;
        const zutatenInput = document.createElement("input");
        zutatenInput.type = "text";
        zutatenInput.name = `schritte[${schrittNummer - 1}][zutaten][]`;
        zutatenInput.placeholder = "Zutat";
        parentDiv.insertBefore(zutatenInput, button);
    }
</script>

</head>
<body>
    <h1>Rezept hinzufügen</h1>
    <form action="erzeuge_rezept.php" method="post">
        <label for="rezept_name">Name des Rezepts:</label>
        <input type="text" id="rezept_name" name="rezept_name"><br><br>
        
        <label for="gesamtdauer">Gesamtdauer:</label>
        <input type="text" id="gesamtdauer" name="gesamtdauer"><br><br>

        <h2>Schritte:</h2>
        <div id="schritte">
            <button type="button" onclick="addStep()">Schritt hinzufügen</button>
        </div><br><br>
        
        <input type="submit" value="Rezept erstellen">
    </form>
</body>
</html>