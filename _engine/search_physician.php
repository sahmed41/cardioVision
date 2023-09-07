<?php 
// Setting up the search term
$diagnose_id = $_POST['diagnose_id'];
$search_term = '*';
if (isset($_POST['search_term'])) {
    $search_term = $_POST['search_term'];
}

require_once('db_connection.php'); // Connecting to DB

$sql = "SELECT id, f_name, l_name, dob, email, phone, role, nm_id, password FROM user WHERE CONCAT_WS('', f_name, l_name)  LIKE '%$search_term%' AND role='physician'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row - print every physician with the search term on his/her name
    while($row = $result->fetch_assoc()) { 
      $sql_so = "SELECT id  FROM second_opinion WHERE second_physician='" . $row['id']. "' AND diagnosis=$diagnose_id";
      $result_so = $conn->query($sql_so);
      if ($result_so->num_rows == 0) { ?>
        
        <div class="search_list_physician">
            <a href="_engine\add_second_physician.php?diagnoseId=<?php echo $diagnose_id; ?>&secondPhysician=<?php echo $row['id'] ?>">
              <?php echo $row['f_name'] . " " . $row['l_name']; ?>
            </a> <!-- Clicking on a physician will add him/her to the shared lis and share the resul with him/her. This link will send diagnose id and  second physian id for that purpose-->
        </div>

    <?php }
    }     
} else {
  // echo "0 results";
}



require_once('db_disconnection.php'); // Disconnecting from DB

?>