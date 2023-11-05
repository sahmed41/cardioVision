<?php
session_start();
require_once("db_connection.php");

$user_id = $_SESSION['id'];
$number_of_uninterpreted_results = 0;
$number_results_to_see = 0;


if (isset($_SESSION['role']) and $_SESSION['role'] == 'physician') {
    $sql = "SELECT id FROM consultation WHERE physician='$user_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $sql1 = "SELECT id FROM diagnosis WHERE consultation ='" . $row['id'] . "' AND physician_interpretation IS NULL";
        $result1 = $conn->query($sql1);
        if ($result1->num_rows > 0) {
            while($row1 = $result1->fetch_assoc()){

                $number_of_uninterpreted_results += 1;
            }
        }
        
    }}
    if ($number_of_uninterpreted_results > 0) {
        echo $number_of_uninterpreted_results;
    }
} elseif ($_SESSION['role'] == 'patient') {
    $sql = "SELECT id FROM consultation WHERE patient='$user_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $sql1 = "SELECT id FROM diagnosis WHERE consultation ='" . $row['id'] . "' AND viewed = 0";
        $result1 = $conn->query($sql1);
        if ($result1->num_rows > 0) {
            while($row1 = $result1->fetch_assoc()){
                $number_results_to_see += 1;
            }
            
        }        
    }}
    if ($number_results_to_see > 0) {
        echo $number_results_to_see;
    }
}






require_once("db_disconnection.php");
?>