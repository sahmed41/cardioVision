<?php 

require_once('db_connection.php');
session_start();

$patient_id = $_SESSION['id'];
$doc_code = $_POST['doc_code'];

// Setup Patient ID in Consultation Table
$sql = "UPDATE consultation
SET patient = $patient_id
WHERE docCode='$doc_code'";
$result = $conn->query($sql);



// Confirming and reroutin for diagnosis
$sql = "SELECT id, physician, patient, docCode, docCodeUsed FROM consultation WHERE patient=$patient_id AND docCode='$doc_code'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
  // output data of each row
    $row = $result->fetch_assoc();
    echo $row['id'] . " " . $row['patient'] . " " . $row['physician'] . " " . $row['docCode'] . " "; 
    if ($row['docCodeUsed'] == 0) {
      $_SESSION['doc_code'] = $_POST['doc_code'];
      header("Location: ../index.php?page=patientDiagnoseScreen"); 
    } else {
      header("Location: ../index.php?page=patientDiagnoseCode&message=used_docCode"); 

    }
  
} else {
  header("Location: ../index.php?page=patientDiagnoseCode&message=invalid_docCode"); 
  // echo "No such docCode exists <br>";
  // echo '<a href="../index.php">Go back</a>';

}

require_once('db_disconnection.php');



?>
