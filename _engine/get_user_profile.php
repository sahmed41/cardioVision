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

    // calculating age
    $dob = new DateTime($_SESSION['dob']);
    $now = new DateTime();
    $interval = $now->diff($dob);
    $age = $interval->y;

    
?>
<h2><?php echo $title; ?> Information</h2>
<p><?php echo "<p>$title ID: 00$id"; ?></p>
<p>Name: <?php echo $row['f_name'] . " " . $row['l_name']; ?></p>
<?php if ($row['role'] != "physician") {echo "<p>Age: $age </p>";} ?>
<p>Email: <?php echo $_SESSION['email'];  ?></p>
<p>Phone: <?php echo $_SESSION['phone'];  ?></p>


<?php

}

// $patient_id = $_SESSION['id'];      
// $dob = new DateTime($_SESSION['dob']);
// $now = new DateTime();
// $interval = $now->diff($dob);
// $age = $interval->y;
// $consultation_ids = [];
// $message = "You have no results";


?>



<?php require_once('db_disconnection.php'); ?>