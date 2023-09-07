<style>
    .diagnosis {
        border: 1px solid black;
    }
</style>
<main>
<?php 
$physician_id = $_SESSION['id'];
$message = "You have no diagnosis to perform";

$sql = "SELECT id FROM consultation WHERE physician='$physician_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $sql1 = "SELECT id, consultation, picture, ai_interpretation, physician_interpretation, ai_confirm, date, viewed FROM diagnosis WHERE consultation='" . $row['id'] . "'";
        
        
        $result1 = $conn->query($sql1);
        if ($result1->num_rows > 0) {
        // output data of each row
        $message = "";
        while($row1 = $result1->fetch_assoc()) {
            
?>
<div class="diagnosis">
    <p class="diagnosis_date"><?php echo "00" . $row1['date'] ?></p>
    <p class="diagnosis_id"><?php echo "00" . $row1['id'] ?></p>
    <p><a href="index.php?page=patientResult&diagnoseId=<?php echo $row1['id']; ?>">Open</a></p>


<?php

            if($row1['physician_interpretation'] == null) { 
                echo '<p class="new">New</p>';
            }
    echo "</div>";
        }
    } else {
        
    }
    }
} else {
    echo "0 resultS";
}
if ($message) {
    echo $message;
}
?>
</main>