<style>
    .page_heading {
        width: 90%;
        margin: 20px auto;
    }

    .diagnosis {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }
    /* Open button */
    .link_to_result {
        width: 40%;
        margin: 5px 0;
        padding: 2px;
        text-align: center;
    }

    /* New Batch sytyle */
    .new {
        width: 10%;
        color: var(--green);
        font-size: 1.1em;
    }
    
    .diagnosis.abnormal .new {
        color: var(--orange);
    }


    
    

</style>
<main>
    <h1 class="page_heading">To Interpret</h1>
    <p class="screen_instruction">The following reports are yet to be interpreted by you. The reports the system concidereds abnormal are colour coded in orange and the reports the system concidereds normal are colour coded in green.</p>
<?php 
$physician_id = $_SESSION['id'];
$message = "You have no diagnosis to perform";

$sql = "SELECT id, date FROM consultation WHERE physician='$physician_id'  ORDER BY date DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $sql1 = "SELECT id, consultation, picture, ai_interpretation, physician_interpretation, ai_confirm, date, viewed FROM diagnosis WHERE consultation='" . $row['id'] . "'"; // Set it to only give you the interpretations for non- interpreted results by adding the following to sql1 ' AND physician_interpretation IS NULL'        
        
        $result1 = $conn->query($sql1);
        if ($result1->num_rows > 0) {
        // output data of each row
        $message = "";
        while($row1 = $result1->fetch_assoc()) {
            
?>
<div class="diagnosis <?php if ($row1['ai_interpretation'] == 0) { echo 'normal'; } else { echo 'abnormal'; } // Adding appropriate classes for normal and abnoral AI interpretations?>"> 
    <div id="diagnosis_information">
        <p class="diagnosis_date"><?php echo $row['date'] ?></p>
        <p class="diagnosis_id">Diagnosis <?php echo "00" . $row1['id'] ?></p>
        <p class="link_to_result"><a href="index.php?page=patientResult&diagnoseId=<?php echo $row1['id']; ?>">Open</a></p>
    </div>
    <?php 
    if($row1['physician_interpretation'] == null) { 
        echo '<div class="new_indicator"><p class="new">New</p></div>';
    }
?> 
</div>
<?php

            
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

