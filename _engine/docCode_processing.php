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
  
    // echo "nic: " . $row["nic"]. ", Password: " . $row["password"];
    // $_SESSION['id'] = $row['id'] ;
    // $_SESSION['f_name'] = $row['f_name'];
    // $_SESSION['l_name'] = $row['l_name'];
    // $_SESSION['dob'] = $row['dob'];
    // $_SESSION['email'] = $row['email'];
    // $_SESSION['phone'] = $row['phone'];
    // $_SESSION['role'] = $row['role'];
    // $_SESSION['nm_id'] = $row['nm_id'];
    // $_SESSION['password'] = $row['password'];

  header("Location: ../index.php?page=patientDiagnoseScreen"); 
  
} else {
  echo "No such docCode exists <br>";
  echo '<a href="../index.php">Go back</a>';

}

require_once('db_disconnection.php');



?>
<h1>Hello</h1>
<h2>We process docCode here</h2>
<h3><?php echo $_POST['doc_code'] ?></h3>
<h3><?php echo $_SESSION['id'] ?></h3>