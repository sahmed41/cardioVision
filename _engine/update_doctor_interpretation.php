<?php 
require_once("db_connection.php");
$diagnosis_id = $_POST['diagnosis_id'];
$physician_interpretation = $_POST['physician_interpretation'];
$date = date("Y-m-d H:i:s"); //Denotes to the date on which the physician interpreted the results
$ai_interpretation_verification = $_POST['ai_verification'];





// Inserting Doctor Interpretation to Diagnosis DB
$sql = "UPDATE diagnosis SET physician_interpretation='$physician_interpretation', ai_confirm='$ai_interpretation_verification', date='$date' WHERE id='$diagnosis_id'";

if ($conn->query($sql) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . $conn->error;
}
require_once("db_disconnection.php");

?>