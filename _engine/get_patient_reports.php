<?php 
    session_start();

    //  Calculating patient age from dob  
    require_once('db_connection.php');  
    $patient_id = $_SESSION['id'];       
    $dob = new DateTime($_SESSION['dob']);
    $now = new DateTime();
    $interval = $now->diff($dob);
    $age = $interval->y;
    $consultation_ids = [];
    $message = "You have no results";
    ?>
    <div id="patient_profile">
        <h2>Patient ID: <?php echo $patient_id ?></h2>
        <p>Name: <?php echo $_SESSION['f_name'] . " " . $_SESSION['l_name']; ?></p>
        <p>Age: <?php echo $age;  ?></p>
        <p>Email: <?php echo $_SESSION['email'];  ?></p>
        <p>Phone: <?php echo $_SESSION['phone'];  ?></p>
    </div>

    <div id="diagnoses">
        <?php 
        $sql = "SELECT id FROM consultation WHERE patient='$patient_id' ORDER BY date DESC"; // Getting the consultation ids for each pation
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
             $sql1 = "SELECT id, consultation, picture, ai_interpretation, physician_interpretation, ai_confirm, date, viewed FROM diagnosis WHERE consultation='" . $row['id'] . "'"; // Getting diagnosis informaiton of each patiect for their consultation
             

             $result1 = $conn->query($sql1);
             if ($result1->num_rows > 0) {
                $message = "";
                while($row1 = $result1->fetch_assoc()) {
                    
        ?>
        <div class="diagnosis <?php if ($row1['ai_interpretation'] == 0) { echo 'normal'; } else { echo 'abnormal'; } // Adding appropriate classes for normal and abnoral AI interpretations?>" id="diagnosis">
            <div id="diagnosis_information">
                <p class="diagnosis_date"><?php echo $row1['date'] ?></p>
                <p class="diagnosis_id">Diagnosis <?php echo "00" . $row1['id'] ?></p>
                <p class="link_to_result"><a href="index.php?page=patientResult&diagnoseId=<?php echo $row1['id']; ?>">Open</a></p>
            </div>        

        <?php

                    if($row1['physician_interpretation'] != null and $row1['viewed'] == false) { 
                        echo '<div class="new_indicator"><p class="new">New</p></div>';
                    } ?>
            <script> // This will enable the feature of clicking anywther in the diagnosis to take you to corresponding result. I have uside inside the body not at the end, beause the diagnose id for each result is generted in this loop. 
                              
                
                $('.new_indicator').parent().css("border-left","5px solid var(--orange)"); // Giving the orange border to results that are not interpreted yet
                $('.new_indicator').prev().children(":last-child").css("background-color","var(--orange)"); // Giving the orange border to results that are not interpreted yet
                
                
            </script>
                    </div>
                <?php 
                }
            } 
            }
        } else {
            echo "0 results";
        }
        ?>
        

        </div>
    </div>
    <?php 
    echo $message;
    require_once('db_disconnection.php');
    ?>
