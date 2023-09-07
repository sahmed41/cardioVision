<style>
    main {
        width: 90%;
    }

    #ecg_image {
        width: 100%
    }

</style>

<?php 
$diagnosis_id = $_GET['diagnoseId']; 
$ecg_image = "";
$ai_interpretation = "";
$ai_confirm = "";
$physician_interpretation = "";

$sql = "SELECT consultation, picture, ai_interpretation, physician_interpretation, ai_confirm FROM diagnosis WHERE id='$diagnosis_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $ecg_image = "uploads/" . $row['picture'];
        $ai_interpretation = $row['ai_interpretation'];
        $ai_confirm = $row['ai_confirm'];
        $physician_interpretation = $row['physician_interpretation'];
    }
} else {
    echo "0 results";
}
?>
<main>

    <h1>Diagnosis ID: 00<?php echo $diagnosis_id; ?></h1>
    <img src="<?php echo $ecg_image ?>" alt="" id="ecg_image">
    <h2>System Diagnosis</h2>
    <p><?php 
    if ($ai_interpretation == 0) {
        echo "The results show that your readings are normal but to waint for the doctors interpretation before making any decisions";
    } else {
        echo "The system recommonds you to consult the physician at your earliest convinience";
    } 
    ?></p>
    <p id="ai_verification">
        <?php 
        if ($ai_confirm == null) {
            echo "AI interpetations is yet to be verified";
        } elseif ($ai_confirm == true) {
            echo "AI interpetations is confirmed";
        } elseif ($ai_confirm == false) {
            echo "AI interpretation is denied";
        }
        ?>
    </p>
    <?php 
        if ($physician_interpretation) {
            echo "<h2>Physician Interpretation</h2>";
            
            
            if ($_SESSION['role'] == 'physician' and isset($_GET['mode']) and $_GET['mode'] == 'edit') { ?>
                <form action="_engine/edit_doctor_interpretation.php" method="post" id="physician_interpretation_edit_form">
                    <textarea name="physican_interpratation_edit" id="" cols="30" rows="10" placeholder="<?php echo $physician_interpretation ?>"></textarea>

                    <input type="hidden" name="diagnosisId" value="<?php echo $diagnosis_id ?>">
                    <br>
                    <label for="ai_interpretation_verification_edit" id="ai_interpretation_verification_label">Do you agree with the AI's interpretation:</label>
                    <select name="ai_interpretation_verification_edit" id="ai_interpretation_verification_edit">
                        <?php if ($ai_confirm == 1) { ?>
                            <option value="1">Confirm</option>
                            <option value="0">Deny</option>
                        <?php }  else { ?>
                            <option value="0">Deny</option>
                            <option value="1">Confirm</option>
                        <?php } ?>
                    </select>
                    <br>
                    <input type="submit" value="Update">
                </form>
            <?php 
            } elseif ($_SESSION['role'] == 'physician') {
                echo '<p id="physician_interpretaion_content">'.$physician_interpretation.'</p>';
                echo '<button id="physician_edit_button">Edit</button>';
                echo '<button id="physician_share_button">Share</button>'; 
            } else {
                echo '<p id="physician_interpretaion_content">'.$physician_interpretation.'</p>';
            }
        } elseif ($_SESSION['role'] == 'physician') {
    ?>
        <div id="doctor_interpretation_container">
            <textarea name="doctor_interpretation" id="doctor_interpretation" cols="30" rows="10" placeholder="Enter your interpretation here"></textarea>
        </div>
        
        <label for="ai_interpretation_verification" id="ai_interpretation_verification_label">Do you agree with the AI's interpretation:</label>
        <select name="ai_interpretation_verification" id="ai_interpretation_verification">
            <option value="1">Confirm</option>
            <option value="0">Deny</option>
        </select>
        <button id="doctor_interpretation_save_button">Save</button>
    <?php } ?>    
    
    <div id="home"></div>
</main>

<script>
    $("#doctor_interpretation_save_button").click(function(event) {
        $("#home").load("_engine/update_doctor_interpretation.php", {
            diagnosis_id: <?php echo $diagnosis_id; ?>,
            physician_interpretation: $("#doctor_interpretation").val(),
            ai_verification: $("#ai_interpretation_verification").val()
        }, function() {
            location.reload();
        });
    });

    // Setting up event for clicking the edit button by physician to edit an exisitng result
    $("#physician_edit_button").click(function() {
        // let physician_interpretation = $("#physician_interpretaion_content").html();
        window.location = "index.php?page=patientResult&diagnoseId=" + <?php echo $diagnosis_id ?> + "&mode=edit";
    });

    // Setting up event for clicking on the share button
    $("#physician_share_button").click(function() {
        window.location = "index.php?page=doctorShareMain&diagnoseId=<?php echo $diagnosis_id; ?>";
    });
</script>

