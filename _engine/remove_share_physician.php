<h1>Hi there, hello</h1>
<h2>You have a share remove for me?</h2>
<?php 
$second_opinion_id = $_GET['secondOpinionId'];
$diagnose_id =  $_GET['diagnoseId'];
require_once('db_connection.php'); 
// sql to delete a physican from the shared list
$sql = "DELETE FROM second_opinion WHERE id='$second_opinion_id'";

if ($conn->query($sql) === TRUE) {
  echo "Record deleted successfully";
  header("Location: ../index.php?page=doctorShareAdd&diagnoseId=$diagnose_id"); 
} else {
  echo "Error deleting record: " . $conn->error;
}


require_once('db_disconnection.php');
?>