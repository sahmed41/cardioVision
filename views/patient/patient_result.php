<style>
    main {
        display: block;
        width: 100%;
    }

    /* Patient Profile */
    #patient_profile {
        width: 90%;
        margin: auto;
        padding: 5px;
        background-color: var(--white);
        border-radius: 5px;
    }

    #patient_profile h2,
    #patient_profile p {
        margin: 5px 0;
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
        background-color: var(--dark-blue);
        width: 50%;
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

    /* AI Verification Informaion Styling */
    #ai_verification {
        font-size: 1.2em;
    }
    #ai_verification.ai_confirmed {
        color: var(--green);
    }
    #ai_verification.ai_denied {
        color: var(--orange);
    }

    /* Medical History */
    #medical_history,
    #family_medical_history,
    #symptoms,
    #allergies {
        background-color: var(--white);
        width: 90%;
        margin: 10px auto;
        padding: 10px;
        border-radius: 5px;
    }

    #medical_history h2,
    #family_medical_history h2,
    #symptoms h2,
    #allergies h2 {
        margin-bottom: 10px;
    }

    /* Patient History button */
    #patient_history {
        display: block;
        background-color: var(--green);
        width: 90%;
        margin: 10px auto;
        height: 50px;
        color: var(--white);
        font-size: 1.2em;
    }
</style>

<?php 
$diagnosis_id = $_GET['diagnoseId']; 
$ecg_image = "";
$ai_interpretation = "";
$ai_confirm = "";
$physician_interpretation = "";

// Setting up patient informaiton
$medical_history = '';
$family_medical_history = '';
$symptoms = '';
$allergies = '';


// Set viewed to true
$sql = "UPDATE diagnosis
SET viewed=1
WHERE id='$diagnosis_id'";
$result = $conn->query($sql);

// Getting the Result
$sql = "SELECT consultation, picture, ai_interpretation, physician_interpretation, ai_confirm FROM diagnosis WHERE id='$diagnosis_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $consultation = $row['consultation'];
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
    <div id="patient_profile">
        <!-- Getting Ptient  profile and and physician id -->
            <!-- Get consultation id -->
            <!-- Get Patient id -->
            <!-- Get physician id -->
            <?php 
            $sql = "SELECT patient, physician, medical_history, family_medical_history, symptoms, allergies FROM consultation WHERE id='$consultation'";
            

            $result = $conn->query($sql);
    
            if ($result->num_rows == 1) {
                // output data of each row
                $id = "";
                $title = "";
                $row = $result->fetch_assoc();
                if ($_SESSION['role'] == "patient") {
                    $id = $row['physician'];
                    $title = "Physician";
                } else {
                    $id = $row['patient'];
                    $title = "Patient";
                }
                // Setting up patient informaiton
                $medical_history = $row['medical_history'];
                $family_medical_history = $row['family_medical_history'];
                $symptoms = $row['symptoms'];
                $allergies = $row['allergies'];
                
            } else {
                echo "0 results";
            }
            echo $ecg_image;
            ?>    
    </div>
    <?php if (isset($_SESSION['role']) and $_SESSION['role'] == 'physician') {?>
    <button id="patient_history">Patient History</button> <!-- The button will take the physicians to the patient history -->
    <?php } ?>
    <h1 class="page_title">Diagnosis ID: 00<?php echo $diagnosis_id; ?></h1>  
    
    <img src="<?php echo $ecg_image ?>" alt="Image of the ECG" id="ecg_image">     
    <?php 
    if (($_SESSION['role'] == 'patient' and !$physician_interpretation) or $_SESSION['role'] == 'physician' ) { // AI interpretation will only be displayed if the physician have not provited his interpretation.
        if ($ai_interpretation  == 0) { // giving appropriate message based on the AI itnerpretation
            echo "<div id='ecg_interpretation_normal'>"; // A container to display system interpretaion
            echo "<h2>System Interpretation</h2>"; // System Interpretation heading
            echo "<p>Your results are sent to the doctor who prescribed you the test. Please await the physician's interpretation before making any decisions.</p>";
        } else {
            echo "<div id='ecg_interpretation__abnormal'>"; // A container to display system interpretaion
            echo "<h2>System Interpretation</h2>"; // System Interpretation heading
            echo "<p>Your results are sent to the doctor who prescribed you the test. Please contact your physician and get the interpretation of your ECG as soon as possible or book an appointment with the physician at your earliest convinience.</p>";
        }
    
    ?>
    </div>
    <?php if ($medical_history != null) {
        echo '<div id="medical_history">';
        echo '<h2>Medical History</h2>';
        echo '<p>' . $medical_history . '</p>';
        echo '</div>';
    } ?>
    <?php if ($family_medical_history != null) {
        echo '<div id="family_medical_history">';
        echo '<h2>Family Medical History</h2>';
        echo '<p>' . $family_medical_history . '</p>';
        echo '</div>';
    } ?>
    <?php if ($symptoms != null) {
        echo '<div id="symptoms">';
        echo '<h2>Symptoms</h2>';
        echo '<p>' . $symptoms . '</p>';
        echo '</div>';
    } ?>
    <?php if ($allergies != null) {
        echo '<div id="allergies">';
        echo '<h2>Allergies</h2>';
        echo '<p>' . $allergies . '</p>';
        echo '</div>';
    } ?>    
    
    <?php 
        if ($ai_confirm == null and $_SESSION['role'] == 'physician') {
            echo "<p id='ai_verification' class='ai_not_verified'>AI interpetations is yet to be verified</p>";
        } elseif ($ai_confirm == true and $_SESSION['role'] == 'physician') {
            echo "<p id='ai_verification' class='ai_confirmed'>AI interpetations is confirmed</p>";
        } elseif ($ai_confirm == false and $_SESSION['role'] == 'physician') {
            echo "<p id='ai_verification' class='ai_denied'>AI interpretation is denied</p>";
        }
    }
    ?>
    
    <div id="physician_interpretation">
    <?php 
        if ($physician_interpretation) {
            echo "<h2>Physician Interpretation</h2>";            
           
            if ($_SESSION['role'] == 'physician' and isset($_GET['mode']) and $_GET['mode'] == 'edit') { ?>
                <form action="_engine/edit_doctor_interpretation.php" method="post" id="physician_interpretation_edit_form">
                    <textarea name="physican_interpratation_edit" id="doctor_interpretation_edit" cols="30" rows="10"><?php echo $physician_interpretation ?></textarea>

                    <input type="hidden" name="diagnosisId" value="<?php echo $diagnosis_id; ?>">
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
        <button id="physician_share_button">Share</button>
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

    // Adding functionality patient_history butto to take to the patient history
    $("#patient_history").click(function() {
        window.location = "index.php?page=doctorPatientReports&patientId=<?php echo $id; ?>";
    });

    // Getting patient informaiton
    // $("#patient_profile").load("_engine/get_patient_profile.php", {
    //         patient_id: "Ahmed"; ?>
    // });

    $.get("_engine/get_user_profile.php", {patient_id: "<?php echo $id; ?>", title: "<?php echo $title; ?>"} , function(data){
        $("#patient_profile").html(data);
    });
    
</script>

