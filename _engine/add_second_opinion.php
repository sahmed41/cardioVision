<?php 
require_once('db_connection.php'); // Connectiong to databasse
// Setting up second opinion id and second opinion values
$opinion = $_POST['opinion'];
$id = $_POST['secondOpinionId'];
$diagnosis_id = $_POST['diagnosisId'];

// Updating the database 
$sql = "UPDATE second_opinion
SET opinion='$opinion'
WHERE id=$id"; 

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}


require_once('db_disconnection.php'); // Disconnectiong from database

// Redirecting to the second opinion page
header("Location: ../index.php?page=doctorSharedResult&diagnosisId=99&secondOpinionId=$id&secondOpinion=$opinion&diagnosisId=$diagnosis_id"); 
?>