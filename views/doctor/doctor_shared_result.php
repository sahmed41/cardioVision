<style>
    main {
        width: 90%;
        margin: 150px auto;
    }

    #page_title {
        background-color: var(--white);
        padding: 5px;
        border-radius: 5px;
    }

    /* Patient Profile Card Styles - Start */
    #patient_profile,
    #physician_profile {
        background-color: var(--white);
        width: 100%;
        margin: 10px auto;
        padding: 10px;
        border-radius: 5px;
    }

    #patient_profile h1,
    #patient_profile p,
    #physician_profile h1,
    #physician_profile p {
        margin: 10px 0;
    }
    
    /* Patient Profile Card Styles - End */

    #ecg_image_container {
        background-color: var(--white);
        width: 100%;
        padding: 2%;
        margin: 10px auto;
    }

    #ecg_image {
        display: block;
        width: 100%;
    }

    #physician_interpretation {
        background-color: var(--white);
        display: block;
        width: 100%;
        margin: 10px auto;
        padding: 10px;
        border-radius: 5px;
    }

    #physician_interpretation h2,
    #physician_interpretation p {
        margin: 0;
    }
    /* Your Opinion /Second Opinon Card - Start */
    #second_opinion,
    #symptoms,
    #allergies,
    #medical_history,
    #family_medical_history {
        background-color: var(--white);
        width: 100%;
        margin: 10px auto;
        padding: 10px;
        border-radius: 5px;
    }
    
    #second_opinion #opinion,
    #second_opinion #second_opinion_post_button {
        display: block;
        width: 100%;
        margin: 10px auto;
        border-radius: 5px;
        font-size: 1.1em;
    }
    
    #second_opinion #second_opinion_post_button {
        background-color: var(--green);
        height: 50px;
        color: var(--white);
    }    
    
    #opinion { /* Opininng textarea */
        padding: 10px;
    }

    #second_opinion h2,
    #second_opinion p { /* Displaying opinion */
        margin: 10px 0;
    }

    #second_opininon_edit_button {
        background-color: var(--dark-blue);
        width: 100%;
        height: 50px;
        margin: 10px auto;
        color: var(--white);
        font-size: 1.2em;
    }
    /* Your Opinion /Second Opinon Card - End */
</style>

<main>
    <?php 
    $diagnosis_id = $_GET['diagnosisId']; // Getting the diagnosis id from the page doctor_shared_results
    $consultation_id = ''; // will hold consultation id
    $patient_id = '';
    $physician_id = '';
    $symptoms = '';
    $allergies = '';
    $medical_history = '';
    $family_medical_history = '';

    $second_opinion_id = $_GET['secondOpinionId'];
    if (isset($_GET['secondOpinion'])){
        $second_opinion = $_GET['secondOpinion'];
    } else {
        $second_opinion = '';
    }

    // if (isset($_GET['patientId'])){ // Setting up patient id
    //     $patient_id = $_GET['patientId'];
    // } else {
    //     $patient_id = '';
    // }
   
    
    
    // Get consulation id
        
    $sql = "SELECT consultation FROM diagnosis WHERE id='$diagnosis_id'"; // Getting the consultation ids for each pation
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $consultation_id = $row["consultation"];
    }
    
    // Get patient information
    


    $sql = "SELECT patient, physician FROM consultation WHERE id='$consultation_id'"; // Getting the consultation ids for each pation
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $patient_id = $row["patient"];
        $physician_id = $row["physician"];
        
    }
    // Get primary physician inormation
    // Dipslay results
    ?>
    <h1 id='page_title'>Diagnosis 00<?php echo $diagnosis_id; ?></h1>
    <div id="patient_profile"></div>
    <div id="physician_profile"></div>
    
    <div id="shared_results"></div>
    <!-- The second opinon will be displayed if it exists if not the text box to update the second opinion will be displayed -->
    <?php
        // Gettin second opinion for the second opinoin table 
    $sql = "SELECT opinion FROM second_opinion WHERE id=$second_opinion_id"; 
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $second_opinion = $row["opinion"];
    }
        // Check whther the opoinon is null or not and if null display text box if not display opinon
    if ($second_opinion == null) {
    ?>
    
    <form action="_engine/add_second_opinion.php" method="post" id="second_opinion">
        <h2>Your Opinion</h2>
        <textarea name="opinion" id="opinion" cols="30" rows="10"></textarea>
        <input type="hidden" name="secondOpinionId" value="<?php echo $_GET['secondOpinionId']; ?>">
        <input type="hidden" name="patientId" value="<?php echo $patient_id; ?>">
        <input type="hidden" name="diagnosisId" value="<?php echo $diagnosis_id; ?>">
        <input type="submit" value="Post" id="second_opinion_post_button">
    </form>
    <?php } else { ?>
    <div id="second_opinion">
        <h2>Your Opinion</h2>
        <p id="second_opinion_text"><?php echo $second_opinion; ?></p>
        <button id="second_opininon_edit_button">Edit</button>
    </div>
    <?php } ?>
</main>

<script>
    // Importing share results
    $.get('_engine/get_shared_result.php',{diagnosis_id: <?php echo $diagnosis_id;?>}, function(data) {
        $("#shared_results").html(data);
    })

    // Importing Patient profile
    $.get('_engine/get_user_profile.php',{patient_id: <?php echo $patient_id ?>, title: "Patient"}, function(data) {
        $("#patient_profile").html(data);
    })    

    // Importing Physician profile
    $.get('_engine/get_user_profile.php',{patient_id: <?php echo $physician_id; ?>, title: "Physician"}, function(data) {
        $("#physician_profile").html(data);
    })

    // Second opinion edit button 
    var second_opinion_text = $("#second_opinion_text").text(); // Existing second opinion
    $("#second_opininon_edit_button").click(function() { // Change p to text area
        $("#second_opinion").replaceWith($('<form>', {
            action: "_engine/add_second_opinion.php",
            method: "post",
            id:"second_opinion"
        }));
                
        $("#second_opininon_edit_button").css("display", "none"); // Hide edit button
        $('#second_opinion').append('<textarea name="opinion" id="opinion" cols="30" rows="10">' + second_opinion_text + ' </textarea>');
        $('#second_opinion').append('<input type="hidden" name="secondOpinionId" value="<?php echo $_GET['secondOpinionId']; ?>">');
        $('#second_opinion').append('<input type="hidden" name="diagnosisId" value="<?php echo $diagnosis_id; ?>">');
        $('#second_opinion').append('<input type="submit" value="Post" id="second_opinion_post_button">');
    });

</script>