<style>
    @import url(resources/css/main.css);
    main {
        width: 100%;
        /* display: flex; */
        /* row-gap: 15px; */
        /* justify-content: space-evenly; */
        /* flex-wrap: wrap; */
        margin: 200px 0;            
    }

    #ecg_capture_container {
        display: block;
        background-color: var(--yellow);
        width: 100%;
        margin: 0 auto;
        padding: 20px;
    }

    #ecg_capture {
        display: none;
    }

    #ecg_capture_label {
        display: block;
        width: 90%;
        margin: 0 auto;
        text-align: center;
    }

    #ecg_capture_display {
        width: 100%;
        margin-bottom: 20px;
    }

    #ecg_capture_text {
        color: var(--white);
        font-size: 1.2em;
    }

    /* Buttons */

    #ecg_capture_form_buttons {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        width: 90%;
        margin: 10px auto;
    }

    #image_upload_button,
    #ecg_capture_clear_button {
        width: 48%;
        height: 50px;
        font-size: 1.2em;
        border-radius: 5px;
    }

    #image_upload_button {
        background-color: var(--green);
        color: var(--white);
    }

    
    #ecg_capture_clear_button {
        background-color: var(--orange);
        color: var(--white);
    }
    
    #image_upload_button:disabled,
    #ecg_capture_clear_button:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
    /* Interpretation Container */

    /* #ai_interpretation_container {
        background-color: var(--white);
        width: 90%;
        margin: 10px auto;
        padding: 10px;
        border-radius: 5px;
        cursor: pointer;
    } */

    #ai_interpretation_container h2 {
        margin: 5px 0;
    }

    /* Customising the AI interpretaion text */
    
    #ecg_interpretation_normal,
    #ecg_interpretation__abnormal { /* Normal and abnormal result */
        width: 90%;
        margin: 10px auto;
        padding: 10px;
        border-radius: 5px;        
    }

    #ecg_interpretation_normal { /* Normal result */
        background-color: var(--green);
        color: var(--white);
        
    }

    #ecg_interpretation__abnormal { /* Abnormal result */
        background-color: var(--orange);
        color: var(--white);
    }
    
</style>

<main>
    

<form action="_engine\ecg_image_processing.php" method="post" enctype="multipart/form-data" id="image_capture_upload_form">
    <label for="ecg_capture" id="ecg_capture_label">
        <div id="ecg_capture_container" for="ecg_capture">
            <img src="resources/pictures/camera.png" alt="" id="ecg_capture_display">
            <p id="ecg_capture_text">Capture Image</p>
        </div>
    </label>
    <input type="file" id="ecg_capture" name="ecg_capture" accept="image/*">
    <input type="hidden" name="input_type" value="capture">
    <div id="ecg_capture_form_buttons">
        <input type="submit" value="Interpret" id="image_upload_button" <?php if (isset($_GET['aiInterpreted']) and $_GET['aiInterpreted'] == 'true') {echo "disabled";}?>>
        <button id="ecg_capture_clear_button" <?php if (isset($_GET['aiInterpreted']) and $_GET['aiInterpreted'] == 'true') {echo "disabled";}?>>Clear ECG</button>
    </div>
</form>


<?php 
if (isset($_GET['aiInterpreted']) and $_GET['aiInterpreted'] == 'true') {
    require_once('_engine/db_connection.php'); // Connectiong to database
    // Extracting the consulation ID to get AI interpretation from the
    $doc_code = $_SESSION['doc_code'];
    $sql = "SELECT id FROM consultation WHERE docCode='$doc_code' ";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 1) {
      // output data of each row
      $row = $result->fetch_assoc();
      $consultation_id = $row["id"];
      //   Getting the AI interpretatoin for the ecg
      $sql = "SELECT picture, ai_interpretation FROM diagnosis WHERE consultation='$consultation_id'";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();            
            $ecg_image = $row['picture'];
            if ($row['ai_interpretation'] == 0) { // giving appropriate message based on the AI itnerpretation
                echo "<div id='ecg_interpretation_normal'>"; // A container to display system interpretaion
                echo "<h2>System Interpretation</h2>"; // System Interpretation heading
                echo "<p>Your results are sent to the doctor who prescribed you the test. Please await the physician's interpretation before making any decisions.</p>";
            } else {
                echo "<div id='ecg_interpretation__abnormal'>"; // A container to display system interpretaion
                echo "<h2>System Interpretation</h2>"; // System Interpretation heading
                echo "<p>Your results are sent to the doctor who prescribed you the test. Please contact your physician and get the interpretation of your ECG as soon as possible or book an appointment with the physician at your earliest convinience.</p>";
            }
            echo "</div>";
            echo "<script>";
            echo "ecg_capture_display.src = 'uploads/$ecg_image' ";  // Showing the ECG image even after interpretation
            echo "</script>";
        } else {
            echo "0 Results";
        }
    } else {
      echo "0 results";
    }
    
    require_once('_engine/db_disconnection.php'); // Disconnecting from database
}
?>

</main>



<script>
    let ecg_capture = document.getElementById('ecg_capture');
    let ecg_capture_display =document.getElementById('ecg_capture_display');
    ecg_capture.addEventListener("change", function(ev) {
        console.log(ecg_capture.files[0]);
        console.log(URL.createObjectURL(ecg_capture.files[0])); 
        ecg_capture_display.src = URL.createObjectURL(ecg_capture.files[0]); // Display image
        $("#ecg_capture_text").text("Reupload Image") // setting up the upload label after uploading
    })

    // Setting up the buttton to clear ecg
    $("#ecg_capture_clear_button").click(function(event) {
        event.preventDefault(); // Preventing the form from submitting once the clear button is clicked
        ecg_capture.value = ''; // Clearing the ECG image input
        ecg_capture.dispatchEvent(new Event("change")); // Making the change event occur once the clear button is clicked to deactivate the interpret button 
        ecg_capture_display.src = "resources/pictures/upload.png";
    });

    // Preventing the interpret button being clicked when there is no ECG is being uploaded
    if (!ecg_capture.files.length > 0) {
        document.getElementById("image_upload_button").disabled = true;
    }
    
    ecg_capture.addEventListener('change', function() { 
        if (ecg_capture.files.length > 0) { // When ECG is uploaded the interpret button becomes active    
            document.getElementById("image_upload_button").disabled = false;
        } else { // When ECG is cleared  the interpret button becomes deactive 
            document.getElementById("image_upload_button").disabled = true;
        }
    });


</script>

