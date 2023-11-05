<style>
    @import url(resources/css/main.css);
    main {
        width: 100%;
        display: flex;
        row-gap: 15px;
        justify-content: space-evenly;
        flex-wrap: wrap;
        margin: 200px 0;            
    }

    #ecg_upload_container {
        display: block;
        background-color: var(--yellow);
        width: 100%;
        margin: 0 auto;
        padding: 20px;
    }

    #ecg_upload_label {
        display: block;
        width: 90%;
        margin: 0 auto;
        text-align: center;
    }

    

    #ecg_upload_display {
        width: 100%;
        margin-bottom: 20px;
    }

    #ecg_upload_text {
        color: var(--white);
        font-size: 1.2em;
    }

    #ecg_upload {
        display: none;
    }

    /* #image_upload_button {
        display: block;
        width: 90%;
        height: 50px;
        margin: 10px auto;
        background-color: var(--green);
        color: var(--white);
        font-size: 1.2em;
    } */

    /* Buttons */

    #ecg_upload_form_buttons {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        width: 90%;
        margin: 10px auto;
    }

    #image_upload_button,
    #ecg_upload_clear_button {
        width: 48%;
        height: 50px;
        font-size: 1.2em;
        border-radius: 5px;
    }

    #image_upload_button {
        background-color: var(--green);
        color: var(--white);
    }

    #ecg_upload_clear_button {
        background-color: var(--orange);
        color: var(--white);
    }
    
    #image_upload_button:disabled, 
    #ecg_upload_clear_button:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
    

    /* Interpretaion Conainter */
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
    <form method="post" action="_engine\ecg_image_processing.php" enctype="multipart/form-data">
        <label for="ecg_upload" id="ecg_upload_label">
            <div id="ecg_upload_container">
                <img src="resources/pictures/upload.png" alt="" id="ecg_upload_display">
                <p id="ecg_upload_text">upload Image</p>            
            </div>
        </label>        
        <input type="hidden" name="input_type" value="upload">
        <div id="ecg_upload_form_buttons">
            <input type="file" name="ecg_capture" accept="image/*" id="ecg_upload" >
            <input type="submit" value="Interpret" id="image_upload_button" <?php if (isset($_GET['aiInterpreted']) and $_GET['aiInterpreted'] == 'true') {echo "disabled";}?>>        
            <button id="ecg_upload_clear_button" <?php if (isset($_GET['aiInterpreted']) and $_GET['aiInterpreted'] == 'true') {echo "disabled";}?>>Clear ECG</button>
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
            echo "ecg_upload_display.src = 'uploads/$ecg_image' ";  // Showing the ECG image even after interpretation
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
    let ecg_upload =document.getElementById('ecg_upload');
    let ecg_upload_display =document.getElementById('ecg_upload_display');
    ecg_upload.addEventListener("change", function(ev) {
        console.log(ecg_upload.files[0]);
        console.log(URL.createObjectURL(ecg_upload.files[0])); 
        ecg_upload_display.src = URL.createObjectURL(ecg_upload.files[0]); // Display image
    })


    // Setting up the buttton to clear ecg
    $("#ecg_upload_clear_button").click(function(event) {
        event.preventDefault();
        ecg_upload.value = ''; // Clearing the ECG image input
        ecg_upload.dispatchEvent(new Event("change")); // Making the change event occur once the clear button is clicked to deactivate the interpret button 
        ecg_upload_display.src = "resources/pictures/upload.png";
    });

    // Preventing the interpret button being clicked when there is no ECG is being uploaded
    if (!ecg_upload.files.length > 0) {
        document.getElementById("image_upload_button").disabled = true;
    }
    
    ecg_upload.addEventListener('change', function() { 
        if (ecg_upload.files.length > 0) { // When ECG is uploaded the interpret button becomes active    
            document.getElementById("image_upload_button").disabled = false;
        } else { // When ECG is cleared  the interpret button becomes deactive 
            document.getElementById("image_upload_button").disabled = true;
        }
    });


</script>

