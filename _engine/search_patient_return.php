<?php 
require_once('db_connection.php');
session_start();

if (isset($_GET['patient_id'])) {
    $id = $_GET['patient_id'];
}
if (isset($_GET['title'])) {
    $title = $_GET['title'];
}

$sql = "SELECT  id,f_name, l_name, dob, gender, email, phone, role, nm_id, password FROM user WHERE id='$id'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    // output data of each row
    $row = $result->fetch_assoc();
    // Patient informaitn
    $f_name = $row['f_name'];
    $l_name = $row['l_name'];
    $email = $row['email'];
    $phone = $row['phone'];
        // calculating age
    $dob = new DateTime($row['dob']);
    $now = new DateTime();
    $interval = $now->diff($dob);
    $age = $interval->y;
    header("Location: ../index.php?page=doctorPatientHistory&id=$id&fName=$f_name&lName=$l_name&age=$age&email=$email&phone=$phone");
    

    
?>



<?php

}

$patient_id = $_SESSION['id'];      
$dob = new DateTime($_SESSION['dob']);
$now = new DateTime();
$interval = $now->diff($dob);
$age = $interval->y;
$consultation_ids = [];
$message = "You have no results";


?>



<?php require_once('db_disconnection.php'); ?>