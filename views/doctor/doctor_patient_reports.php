<?php $id = $_GET['patientId']; ?>
<style>
    
    /* Patient Profile */
    #patient_profile {
        width: 100%;
        margin: auto;
        padding: 5px;
        background-color: var(--white);
        border-radius: 5px;
    }

    #patient_profile h2,
    #patient_profile p {
        margin: 5px 0;
    }

    /* Patient Reports - Start */
    .diagnosis {
        display: flex;
        justify-content: space-between;
        background-color: var(--white);
        width: 100%;
        margin: 10px auto;
        padding: 10px;
        border-left: 5px solid var(--green);
        border-radius: 5px;
        cursor: pointer;
    }
    
    .diagnosis.abnormal_result {
        border-left: 5px solid var(--orange);
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

    .diagnosis.abnormal_result .link_to_result {
        background-color: var(--orange);
    }
    
    .link_to_result a {
        color: var(--white);                
        text-decoration: none;
    }

    .new {
        color: var(--green);
        font-size: 1.1em;
    }
    
    .diagnosis.abnormal_result .new {
        color: var(--orange);
    }
    /* Patient Reports - End */
</style>

<main>
    <div id="patient_profile"></div>
    <div id="patient_results"></div>
</main>

<script>
    $.get("_engine/get_user_profile.php", {patient_id: "<?php echo $id; ?>", title: "Patient"} , function(data){
        $("#patient_profile").html(data);
    });

    $.get("_engine/search_patient_reports.php", {patientId: "<?php echo $id; ?>"}, function(data){
        $("#patient_results").html(data);
    });
</script>