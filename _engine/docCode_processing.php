<?php 

require_once('db_connection.php');
session_start();

$patient_id = $_SESSION['id'];
$doc_code = $_POST['doc_code'];

$sql = "SELECT id, physician, patient, docCode FROM consultation WHERE patient=$patient_id AND docCode='$doc_code'";

$result = $conn->query($sql);

if ($result->num_rows == 1) {
  // output data of each row
    $row = $result->fetch_assoc();
    echo $row['id'] . " " . $row['patient'] . " " . $row['physician'] . " " . $row['docCode'] . " "; 
    $_SESSION['doc_code'] = $_POST['doc_code'];
    header("Location: ../index.php?page=patientDiagnoseScreen"); 
  
} else {
  echo "No such docCode exists <br>";
  echo '<a href="../index.php">Go back</a>';

}

require_once('db_disconnection.php');



?>
