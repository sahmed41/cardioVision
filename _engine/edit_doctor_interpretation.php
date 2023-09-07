<?php 
require_once('db_connection.php');


if (isset($_POST['physican_interpratation_edit']) and isset($_POST['diagnosisId'])) {
    $new_physician_interpretation =  $_POST['physican_interpratation_edit'];
    $diagnosis_id = $_POST['diagnosisId'];
    $ai_confirm = $_POST['ai_interpretation_verification_edit'];
    $sql = "UPDATE diagnosis SET physician_interpretation='$new_physician_interpretation', ai_confirm = '$ai_confirm' WHERE id='$diagnosis_id'";
  
    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
      header("Location: ../index.php?page=patientResult&diagnoseId=21"); 
      
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "invalid operation";
}

require_once('db_disconnection.php');

?>