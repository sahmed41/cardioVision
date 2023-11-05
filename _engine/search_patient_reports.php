<?php 
require_once("db_connection.php");
$patient_id = $_GET['patientId'];
$consultation_id = array();

// Get consulation id for patient id in the decenting date order
$sql = "SELECT id, physician, patient, docCode, date, docCodeUsed FROM consultation WHERE patient='$patient_id' ORDER BY date DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $sql1 = "SELECT id, consultation, picture, ai_interpretation, physician_interpretation, ai_confirm, date, viewed FROM diagnosis WHERE consultation='" . $row['id'] . "'";
        $result1 = $conn->query($sql1);
        while ($row1 = $result1->fetch_assoc()) {
?>
            <div class="diagnosis <?php if($row1['ai_interpretation'] == 1) { echo 'abnormal_result'; } else { echo 'normal_result'; } ?>">
                <div class="diagnosis_info ">
                    <p class="diagnosis_date"><?php echo $row['date'] ?></p>
                    <p class="diagnosis_id">Diagnosis 00<?php echo $row1['id'] ?></p>  
                    <p class="link_to_result"><a href="index.php?page=patientResult&diagnoseId=<?php echo $row1['id'] ?>">Open</a></p>
                </div>
<?php
            if ($row1['physician_interpretation'] == null) { 
                echo '<div class="new_indicator"><p class="new">New</p></div>';
            }
            echo '</div>';    
        }
    }
    // Get diagnosis for all consultation ids
}

for($x = 0; $x < count($consultation_id); $x++) {
    $sql = "SELECT id, consultation, picture, ai_interpretation, physician_interpretation, ai_confirm, date, viewed FROM diagnosis WHERE consultation='$consultation_id[$x]'";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        echo $row['id'] . "<br>";        
    }
}
require_once("db_disconnection.php");
?>