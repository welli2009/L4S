<html>
  <head>
    <meta charset="utf-8">
    <title>Stopwatch</title>
    <style>
      body {
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
  </style>
  </head>
  <body>
<?php
include("../databaseverknuepfung.php");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get all types from the table
$sql = "SELECT DISTINCT Typ FROM wuerfelzeiten";
$result = $conn->query($sql);

// Create a select box for all types
echo "<form method='post' action=''>";
echo "<select name='typ'>";
while ($row = $result->fetch_assoc()) {
    echo "<option value='" . $row['Typ'] . "'>" . $row['Typ'] . "</option>";
}
echo "</select>";
echo "<input type='submit' value='Auswählen'></input>";
echo "</form>";

// Get all data for the selected type and sort by timevalue
if (isset($_POST['typ'])) {
    $typ = $_POST["typ"];
    $sql = "SELECT * FROM wuerfelzeiten WHERE Typ='$typ' ORDER BY Zeit ASC";
    $result = $conn->query($sql);

    // Output the data as a table with a delete button for each row
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Name</th><th>Zeit</th><th>Uhrzeit</th><th>Typ</th><th></th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["ID"] . "</td><td>" . $row["Namen"] . "</td><td>" . $row["Zeit"] . "</td><td>" . $row["Uhrzeit"] . "</td><td>" . $row["Typ"] . "</td><td><form method='post' action=''><input type='hidden' name='id' value='" . $row["ID"] . "'><input type='submit' name='delete' value='Delete'></form></td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
}

// Delete the selected row if the delete button is clicked
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM wuerfelzeiten WHERE ID='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>
</body>
