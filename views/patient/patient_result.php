<style>
    main {
        display: block;
        width: 100%;
    }

    

    .page_title,
    #ecg_image,
    #system_diagnosis,
    #ai_verification,
    #physician_interpretation {
        background-color: var(--white);
        display: block;
        width: 90%;
        margin: 10px auto;
        padding: 10px;
        border-radius: 5px;
    }

    #doctor_interpretation,
    #doctor_interpretation_edit {
        width: 100%;
        padding: 10px;
        font-size: 1.1em;
    }

    #ai_interpretation_verification_label,
    #ai_interpretation_verification_edit_label {
        display: block;
        width: 100%;
        height: 50px;
        margin: 10px auto;
    }

    #ai_interpretation_verification,
    #ai_interpretation_verification_edit {
        /* height: 50px; */
        font-size: 1.1em;
    }

    #doctor_interpretation_save_button,
    #doctor_interpretation_update_button {
        background-color: var(--green);
        width: 100%;
        height: 50px;
        margin: 0 auto 10px auto;
        color: var(--white);
        font-size: 1.2em;
    }

    #physician_button_container {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        margin: 10px auto;
        width: 100%;
    }

    #physician_edit_button,
    #physician_share_button {
        width: 48%;
        height: 50px;
        color: var(--white);
        font-size: 1.2em;
    }

    #physician_edit_button {
        background-color: var(--dark-blue);
    }

    #physician_share_button {
        background-color: var(--green);
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

    <h1 class="page_title">Diagnosis ID: 00<?php echo $diagnosis_id; ?></h1>
    <img src="<?php echo $ecg_image ?>" alt="Image of the ECG" id="ecg_image">
    <div id="system_diagnosis">
        <h2>System Diagnosis</h2>
        <p><?php 
        if ($ai_interpretation == 0) {
            echo "The results show that your readings are normal but to waint for the doctors interpretation before making any decisions";
        } else {
            echo "The system recommonds you to consult the physician at your earliest convinience";
        } 
        ?>
        </p>
    </div>

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
    <div id="physician_interpretation">
    <?php 
        if ($physician_interpretation) {
            echo "<h2>Physician Interpretation</h2>";
            
            
            if ($_SESSION['role'] == 'physician' and isset($_GET['mode']) and $_GET['mode'] == 'edit') { ?>
                <form action="_engine/edit_doctor_interpretation.php" method="post" id="physician_interpretation_edit_form">
                    <textarea name="physican_interpratation_edit" id="doctor_interpretation_edit" cols="30" rows="10" placeholder="<?php echo $physician_interpretation ?>"></textarea>

                    <input type="hidden" name="diagnosisId" value="<?php echo $diagnosis_id ?>">
                    <label for="ai_interpretation_verification_edit" id="ai_interpretation_verification_edit_label">Do you agree with the AI's interpretation:
                        <select name="ai_interpretation_verification_edit" id="ai_interpretation_verification_edit">
                            <?php if ($ai_confirm == 1) { ?>
                                <option value="1">Confirm</option>
                                <option value="0">Deny</option>
                            <?php }  else { ?>
                                <option value="0">Deny</option>
                                <option value="1">Confirm</option>
                            <?php } ?>
                        </select>
                    </label>
                    <br>
                    <input type="submit" value="Update" id="doctor_interpretation_update_button">
                </form>
            <?php 
            } elseif ($_SESSION['role'] == 'physician') {
                echo '<p id="physician_interpretaion_content">'.$physician_interpretation.'</p>';
                echo '<div id="physician_button_container">';
                echo '<button id="physician_edit_button">Edit</button>';
                echo '<button id="physician_share_button">Share</button>'; 
                echo '</div>';
            } else {
                echo '<p id="physician_interpretaion_content">'.$physician_interpretation.'</p>';
            }
        } elseif ($_SESSION['role'] == 'physician') {
    ?>
        <div id="doctor_interpretation_container">
            <textarea name="doctor_interpretation" id="doctor_interpretation" cols="30" rows="10" placeholder="Enter your interpretation here"></textarea>
        </div>
        
        <label for="ai_interpretation_verification" id="ai_interpretation_verification_label">Do you agree with the AI's interpretation:
            <select name="ai_interpretation_verification" id="ai_interpretation_verification">
                <option value="1">Confirm</option>
                <option value="0">Deny</option>
            </select>
        </label>
        <button id="doctor_interpretation_save_button">Save</button>
    <?php } ?>  
    </div>  
    
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

