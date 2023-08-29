<?php
session_start();
require_once('db_connection.php');

$patient_id = $_SESSION['id'];
$doc_code =  $_SESSION['doc_code'];
$doc_code_used = false;
echo $doc_code;
// Make sure that docCod is not used before

$sql_doc_code = "SELECT docCodeUsed FROM consultation WHERE docCode='$doc_code'";
$result = $conn->query($sql_doc_code);

if ($result->num_rows == 1) {
  // output data of each row
  $row = $result->fetch_assoc();
  
  if ($row['docCodeUsed'] == 1) {
    $doc_code_used = true;
  }  else {
    $doc_code_used = false;
  }
} else {
  echo "No such docCode exists <br>";
  echo '<a href="../index.php">Go back</a>';
}



if (!$doc_code_used) {
  date_default_timezone_set("Asia/Colombo");
  $patient_last_name = $_SESSION['l_name'];
  $consultation_id = '';
  $consultation_date = "";
  
  // Getting consultation ID and Date
  $sql = "SELECT id, date FROM consultation WHERE patient=$patient_id";
  $result = $conn->query($sql);
  
  if ($result->num_rows == 1) {
    // output data of each row
    $row = $result->fetch_assoc();
  
    $consultation_id = $row['id'];
    $consultation_date = $row['date'];
    $consultation_date = str_replace(":", "-", $consultation_date);
    $consultation_date = str_replace(" ", "-", $consultation_date);  
  } else {
    echo "No such docCode exists <br>";
    echo '<a href="../index.php">Go back</a>';
  }
  
  // Setup docCode to used
  $sql = "UPDATE consultation SET docCodeUsed = true WHERE id=$consultation_id";
  
  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  
  // Setting up photoname
  $target_dir = "C:/xampp/htdocs/cardioVision/uploads/";
  $target_file = $target_dir . basename($_FILES["ecg_capture"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  $ecg_image = $_SESSION['l_name'] . "-" . $_SESSION['doc_code'] . ".$imageFileType";
  $target_file = $target_dir . basename($ecg_image);
  
  
  
  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["ecg_capture"]["tmp_name"]);
    if($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }
  }
  
  
  
  
  // Uploading the photo
  move_uploaded_file($_FILES["ecg_capture"]["tmp_name"], $target_file);
  
  
  // Setting up a diagnosis entry
  
  $sql = "INSERT INTO diagnosis (consultation, picture, ai_interpretation) VALUES ('$consultation_id', '$ecg_image', 'You do not have any problems')";
  
  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  header("Location: ../index.php?page=patientCaptureImage&aiInterpreted=true"); 

} else {
  echo "The doc code is alread used.";  
  echo '<a href="../index.php?page=patientDiagnoseCode">Go back</a>';
}


require_once('db_disconnection.php');


?>