<?php
require_once('db_connection.php');

$diagnosis_id = $_GET['diagnoseId'];
$second_physician = $_GET['secondPhysician'];

$sql = "INSERT INTO second_opinion (diagnosis, second_physician)
VALUES ('$diagnosis_id', '$second_physician')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
  echo $diagnosis_id;
  header("Location: ../index.php?page=doctorShareAdd&diagnoseId=$diagnosis_id");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

require_once('db_disconnection.php');
?>