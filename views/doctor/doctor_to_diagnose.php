<style>
    .page_heading {
        width: 90%;
        margin: 20px auto;
    }

    .diagnosis {
        background-color: var(--white);
        width: 90%;
        margin: 10px auto;
        border-radius: 5px;
        padding: 10px;        
        border-left: 5px solid var(--orange);
        cursor: pointer;
    }

    .diagnosis .diagnosis_date {
        font-size: 0.8em;
    
    }

    .diagnosis .diagnosis_id {
        font-size: 1.2em;
    }

    .link_to_result {
        background-color: var(--orange);
        width: 20%;
        margin: 5px 0;
        padding: 2px;
        text-align: center;
    }
    
    .link_to_result a {
        color: var(--white);                
        text-decoration: none;
    }

</style>
<main>
    <h1 class="page_heading">To Interpret</h1>
<?php 
$physician_id = $_SESSION['id'];
$message = "You have no diagnosis to perform";

$sql = "SELECT id FROM consultation WHERE physician='$physician_id'";
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
<div class="diagnosis">
    <p class="diagnosis_date"><?php echo "00" . $row1['date'] ?></p>
    <p class="diagnosis_id">Diagnosis <?php echo "00" . $row1['id'] ?></p>
    <p class="link_to_result"><a href="index.php?page=patientResult&diagnoseId=<?php echo $row1['id']; ?>">Open</a></p>
    

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

