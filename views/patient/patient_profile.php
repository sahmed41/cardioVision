<style>
    @import url("resources/css/main.css");
    /* body {
        display: initial;
    } */
    main {
        width: 100%;
    }

    #patient_profile {
        width: 90%;
        margin: 100px auto 25px auto;
        padding: 5px;
        background-color: var(--white);
        border-radius: 5px;
    }

    #patient_profile h2,
    #patient_profile p {
        margin: 5px 0;
    }

    .diagnosis {
        display: flex;
        justify-content: space-between;
        background-color: var(--white);
        width: 90%;
        margin: 10px auto;
        padding: 10px;
        border-left: 5px solid var(--green);
        border-radius: 5px;
        cursor: pointer;
    }

    .diagnosis .diagnosis_date {
        font-size: 0.8em;
    }

    .diagnosis .diagnosis_id {
        font-size: 1.2em;
    }

    .link_to_result {
        background-color: var(--green);
        width: 40%;
        margin: 5px 0;
        padding: 2px;
        text-align: center;
    }
    
    .link_to_result a {
        color: var(--white);                
        text-decoration: none;
    }

    .new {
        color: var(--orange);
        font-size: 1.1em;
    }
</style>

<main>
    <?php 
    //  Calculating patient age from dob  
    require_once('_engine/db_connection.php');
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
        $sql = "SELECT id FROM consultation WHERE patient='$patient_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
             $sql1 = "SELECT id, consultation, picture, ai_interpretation, physician_interpretation, ai_confirm, date, viewed FROM diagnosis WHERE consultation='" . $row['id'] . "'";
             

             $result1 = $conn->query($sql1);
             if ($result1->num_rows > 0) {
                $message = "";
                while($row1 = $result1->fetch_assoc()) {
                    
        ?>
        <div class="diagnosis" id="diagnosis">
            <div id="diagnosis_information">
                <p class="diagnosis_date"><?php echo "00" . $row1['date'] ?></p>
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
        <div class="diagnosis">

        </div>
    </div>
    <?php echo $message?>
</main>




<?php require_once('_engine/db_disconnection.php'); ?>