<?php 
require_once('db_connection.php'); 
$Physician_id = $_GET['physician_id']; 

$sql = "SELECT id, diagnosis, second_physician, opinion, date FROM second_opinion WHERE second_physician='$Physician_id' ORDER BY date DESC"; // Getting the consultation ids for each pation
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
?>
        <!-- Displaying the shared results  -->
        <div class="diagnosis">
            <div class="diagnosis_information">
                <p class="second_opinion_date"><?php echo $row['date'] ?></p>
                <p class="diagnosis_id"><?php echo "Diagnosis 00". $row['diagnosis'] ?></p>
                <p class="link_to_result"><a href="index.php?page=doctorSharedResult&diagnosisId=<?php echo $row['diagnosis']; ?>&secondOpinionId=<?php echo $row['id']; ?>">Open</a></p>            

            </div>
        
<?php
            // Addintg new batch to the results that are not given second opinion yet
            if($row['opinion'] == null) { 
                echo '<div class="new_indicator"><p class="new">New</p></div>';
            } 
        echo "</div>";
    }
} else {
    echo "<p id='zero_shared_report_message'>You do not have any shared messages </p>";
}

require_once('db_disconnection.php'); 
?>


                  
    
    
    