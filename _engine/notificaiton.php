<?php
session_start();
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
// header("Content-Type: text/event-stream");
// header("Cache-Control: no-cache");
header("Access-Control-Allow-Origin: *");
require_once("db_connection.php");

$user_id = $_SESSION['id'];
$number_of_uninterpreted_results = 0;

if (isset($_SESSION['role']) and $_SESSION['role'] == 'physician') {
    $sql = "SELECT id FROM consultation WHERE physician='$user_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $sql1 = "SELECT id FROM diagnosis WHERE consultation ='" . $row['id'] . "' AND physician_interpretation IS NULL";
            $result1 = $conn->query($sql1);
            if ($result1->num_rows > 0) {
                $row1 = $result1->fetch_assoc();
                $number_of_uninterpreted_results += 1;
            }
            
        }}
}

// header('Content-Type: text/event-stream');
// header('Cache-Control: no-cache');
// // header("Content-Type: text/event-stream");
// // header("Cache-Control: no-cache");
// header("Access-Control-Allow-Origin: *");


while (true) {
    
    if ($number_of_uninterpreted_results > 0) {
        // Simulate data for demonstration purposes
        $sseData = [
            'message' => 'notification: ' . "You have results to interpret", // You can replace this with your data
        ];

        // Send data to the client
        echo 'data: ' . json_encode($sseData) . "\n\n";
        ob_flush();
        flush();
    }
    
    if (connection_aborted()) {
        exit();
    };
    // You can adjust the interval between updates
    sleep(100);
}

require_once("db_disconnection.php");
?>