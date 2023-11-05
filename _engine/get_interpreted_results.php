<?php 
require_once("db_connection.php");
$physician_id =  $_GET['physicianId'];
// Get Consultaitons for the patient id
$sql = "SELECT id, date FROM consultation WHERE physician=$physician_id";
$result = $conn->query($sql);

if($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Get diagnosis for each consultation
        $sql1 = "SELECT id, ai_interpretation FROM diagnosis WHERE consultation=". $row['id'];
        $result1 = $conn->query($sql);

        if($result1->num_rows > 0) {
            while ($row1 = $result1->fetch_assoc()) {  

?>
                <div class="diagnosis <?php if($row1['ai_interpretation'] == 1) { echo 'abnormal_result'; } else { echo 'normal_result'; } ?>">
                    <div class="diagnosis_info">
                        <p class="diagnosis_date"><?php echo $row['date'] ?></p>
                        <p class="diagnosis_id">Diagnosis 00<?php echo $row1['id'] ?></p>  
                        <p class="link_to_result"><a href="index.php?page=patientResult&diagnoseId=<?php echo $row1['id'] ?>">Open</a></p>
                    </div>
                </div>
<?php
            }
        }

     }
}
require_once("db_disconnection.php");
 ?>