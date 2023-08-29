<style>
    .diagnosis {
        border: 1px solid black;
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
    ?>
    <div id="profile">
        <h2>Patient Profile</h2>
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
                // output data of each row
                while($row1 = $result1->fetch_assoc()) {
                    
        ?>
        <div class="diagnosis">
            <p class="diagnosis_date"><?php echo "00" . $row1['date'] ?></p>
            <p class="diagnosis_id"><?php echo "00" . $row1['id'] ?></p>

        </div>

        <?php

                    if($row1['physician_interpretation'] != null and $row1['viewed'] == false) { 
                        echo '<p class="new">New</p>';
                    }
                }
            } else {
                echo "0 results";
            }
            }
        } else {
            echo "0 results";
        }
        ?>
        <div class="diagnosis">

        </div>
    </div>
</main>


<?php require_once('_engine/db_disconnection.php'); ?>