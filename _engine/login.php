<?php
require_once('db_connection.php');

$nm_id = $_POST['nm_id'];
$password = $_POST['password'];


$sql = "SELECT id, f_name, l_name, dob, email, phone, role, nm_id, password FROM user WHERE nm_id='$nm_id' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
  // output data of each row
    session_start();
    session_destroy();
    session_unset();
    session_start();
    $row = $result->fetch_assoc();
  
  
    // echo "nic: " . $row["nic"]. ", Password: " . $row["password"];
    $_SESSION['id'] = $row['id'] ;
    $_SESSION['f_name'] = $row['f_name'];
    $_SESSION['l_name'] = $row['l_name'];
    $_SESSION['dob'] = $row['dob'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['phone'] = $row['phone'];
    $_SESSION['role'] = $row['role'];
    $_SESSION['nm_id'] = $row['nm_id'];
    $_SESSION['password'] = $row['password'];

  header("Location: ../index.php"); 
} else {
  header("Location: ../index.php?message=wrong_credentials"); 
}

// echo $_SESSION['f_name']; // Testing
require_once('db_disconnection.php');

?>