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

    #ecg_capture_container {
        width: 90%;
    }

    #ecg_capture_display {
        width: 100%;
    }
    
    
</style>

<main>
    
<div id="ecg_capture_container">
    <img src="" alt="" id="ecg_capture_display">
</div>
<form action="_engine\ecg_image_processing.php" method="post" enctype="multipart/form-data">
    <input type="file" id="ecg_capture" name="ecg_capture" accept="image/*" capture >
    <!-- <input type="hidden" id="doc_code" name="doc_code" value=> -->
    <input type="submit" value="Interpret">
</form>

<!-- <input type="file" id="img" name="img" accept="image/*" id="upload_button"> -->
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
            echo $row['ai_interpretation'];
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
        ecg_capture_display.src = URL.createObjectURL(ecg_capture.files[0]);       
    })
</script>

