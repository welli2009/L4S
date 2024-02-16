<?php
include("../databaseverknuepfung.php");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
  // Get the last ID from the table
  $sql = "SELECT ID FROM wuerfelzeiten ORDER BY ID DESC LIMIT 1";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $last_id = $row["ID"] + 1;
    }
  } else {
    $last_id = 1;
  }
  
  // Prepare and bind statement
  $stmt = $conn->prepare("INSERT INTO wuerfelzeiten (ID, Namen, Zeit, Uhrzeit, Typ) VALUES (?, ?, ?, ?, ?)");
  if (!$stmt) {
    die("Error: " . $conn->error);
  }
  $stmt->bind_param("issss", $last_id, $_POST["name"], $_POST["timevalue"], $_POST["time"], $_POST["typ"]);
  
  // Execute statement
  $stmt->execute();
  
  echo "New record created successfully";
  
  $stmt->close();
  $conn->close();

print_r($_POST);
  ?>
  <script>
    location = "uhr.php";
</script>