<?php 
session_start();
require_once('db_connection.php'); // Connecting to DB
// Setting up the search term
$search_term = '*';
$patient_id = '';
if (isset($_POST['search_term'])) {
    $search_term = $_POST['search_term'];
}

// Retrieving Pateing List
$sql = "SELECT id, f_name, l_name, dob, email, phone, role, nm_id, password FROM user WHERE CONCAT_WS('', f_name, l_name)  LIKE '%$search_term%' AND role='patient'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $patient_id = $row["id"];
    echo '<p><a href="_engine/search_patient_return.php?patient_id='. $row['id'] . '&title=Patient" class="searched_patient">' . $row['f_name'] . " " . $row["l_name"] . '</a></p>';    
  }
  
} else {
  // echo "0 results";
}




require_once('db_disconnection.php'); // Disconnecting from DB

?>

