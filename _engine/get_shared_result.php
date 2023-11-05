<?php 
require_once("db_connection.php");
$diagnosis_id = $_GET['diagnosis_id'];
// Get Diagnosis information
$sql = "SELECT id, consultation, picture, ai_interpretation, physician_interpretation, ai_confirm, date, viewed FROM diagnosis WHERE id='$diagnosis_id'"; // Getting the consultation ids for each pation
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $consultation_id = $row["consultation"];
        $ecg_image = "uploads/" . $row['picture'];
        $physician_interpretation = $row['physician_interpretation'];
        
?>
        <div id="ecg_image_container">
            <img src="<?php echo $ecg_image; ?>" alt="Image of the ECG" id="ecg_image">
        </div>
        <div id="physician_interpretation">
            <h2>Physician Interpretation</h2>
            <p id="physician_interpretation"><?php echo $physician_interpretation; ?></p>
        </div>
<?php
    // Getting patient consultation information
    $sql1 = "SELECT id, medical_history, family_medical_history, symptoms, allergies FROM consultation WHERE id='$consultation_id'"; // Getting the consultation ids for each pation
    $result1 = $conn->query($sql1);
    if ($result1->num_rows === 1) {
        $row1 = $result1->fetch_assoc();
        $symptoms = $row1['symptoms'];
        $allergies = $row1['allergies'];
        $medical_history = $row1['medical_history'];
        $family_medical_history = $row1['family_medical_history'];
?>
        <?php if ($symptoms !== null and $symptoms !== '') { ?>
        <div id="symptoms">
            <h2>Symptoms</h2>
            <p><?php echo $symptoms; ?></p>
        </div>
        <?php } ?>

        <?php if ($allergies !== null and $allergies !== '') { ?>
        <div id="allergies">
            <h2>Allergies</h2>
            <p><?php echo $allergies; ?></p>
        </div>
        <?php } ?>

        <?php if ($medical_history !== null and $medical_history !== '') { ?>
        <div id="medical_history">
            <h2>Medical History</h2>
            <p><?php echo $medical_history; ?></p>
        </div>
        <?php } ?>

        <?php if ($family_medical_history !== null and $family_medical_history !== '') { ?>
        <div id="family_medical_history">
            <h2>Family Medical History</h2>
            <p><?php echo $family_medical_history; ?></p>
        </div>
        <?php } ?>

<?php
    } else {
        echo "0 rows";
    }

    
    }
} else {
    echo 'This report was not shared with you';
}
// Get patient information
// Get primary physician inormation
// Dipslay results

require_once("db_disconnection.php");
?>