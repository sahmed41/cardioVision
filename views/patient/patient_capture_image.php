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

    #ai_interpretation_container {
        background-color: var(--white);
        width: 90%;
        margin: 10px auto;
        padding: 10px;
        border-radius: 5px;
        cursor: pointer;
    }

    #ai_interpretation_container h2 {
        margin: 5px 0;
    }
    
</style>

<main>
    

<form action="_engine\ecg_image_processing.php" method="post" enctype="multipart/form-data">
    <label for="ecg_capture" id="ecg_capture_label">
        <div id="ecg_capture_container" for="ecg_capture">
            <img src="resources/pictures/upload.png" alt="" id="ecg_capture_display">
            <p id="ecg_capture_text">upload Image</p>
        </div>
    </label>
    <input type="file" id="ecg_capture" name="ecg_capture" accept="image/*" capture >
    <div id="ecg_capture_form_buttons">
        <input type="submit" value="Interpret" id="image_upload_button">
        <button id="ecg_capture_clear_button">Clear ECG</button>
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
            echo "<div id='ai_interpretation_container'>"; // A container to display system interpretaion
            echo "<h2>System Interpretation</h2>"; // System Interpretation heading
            if ($row['ai_interpretation'] == 0) { // giving appropriate message based on the AI itnerpretation
                echo "<p id='ecg_interpretation'>The results show that your readings are normal but to waint for the doctors interpretation before making any decisions</p>";
            } else {
                echo "<p id='ecg_interpretation'>The system recommonds you to consult the physician at your earliest convinience</p>";
            } 
            echo "</div>";
            echo "<script>";
            echo "ecg_capture_display.src = 'uploads/$ecg_image' ";  
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
    let ecg_capture =document.getElementById('ecg_capture');
    let ecg_capture_display =document.getElementById('ecg_capture_display');
    ecg_capture.addEventListener("change", function(ev) {
        console.log(ecg_capture.files[0]);
        console.log(URL.createObjectURL(ecg_capture.files[0])); 
        ecg_capture_display.src = URL.createObjectURL(ecg_capture.files[0]); // Display image
        $("#ecg_capture_text").text("Reupload Image") // setting up the upload label after uploading
    })

    // Setting up the buttton to clear ecg
    $("#ecg_capture_clear_button").click(function(event) {
        event.preventDefault();
        ecg_capture_display.src = "resources/pictures/upload.png";
    });
</script>

