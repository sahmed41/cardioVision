<style>
    
    .page_heading {
        background-color: var(--white);
        width: 100%;
        margin: 20px auto;
        padding: 10px;
        border-radius: 5px;
    }

    #search_container {
        width: 100%;
        margin: 10px auto;
    }

    #patient_search,
    #search_button {
        width: 70%;
        height: 50px;
        padding: 10px;
        border: none;
        border-radius: 5px;
        font-size: 1.2em;
    }

    #search_button {        
        background-color: var(--green);
        width: 29%;        
        color: var(--white);
    }

    /* Patient List - Start */
    #patient_list {
        width: 100%;
        background-color: var(--white);
    }
    
    #patient_list p {
        width: 100%;
        margin: 10px 0;
        padding: 10px;
        border-radius: 5px;
    }

    #patient_list a {
        display: block;
        width: 100%;
        color: var(--dark);
        text-decoration: none;
        font-size: 1.2em;
        cursor: pointer;
    }
    /* Patient List - End */

    /* Patient Info - Start */
    #patient_info {
        background-color: var(--white);
        padding: 10px;
        border-radius: 5px;
    }

    #patient_info h1,
    #patient_info p {
        margin: 10px 0;
    }

    #patient_info p {
        font-size: 1.2em;
    }
    /* Patient Info - End */

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
<h1 class="page_heading">Patient History</h1>    
<div id="search_container">
    <input type="text" name="patient_search" id="patient_search" placeholder="Enter patient name">
    <button id="search_button">Search</button>
</div>
<!-- The list of patients from the search -->
<div id="patient_list"></div>
<!-- Displaying Patient Inforamtion -->
<div id="patient_info">
    <?php 
    if (isset($_GET['id'])) {
        echo '<h1 id="patient_name">Patient ID: 00' . $_GET['id'] . '</h1>';
        echo '<p id="patient_name">Name: ' . $_GET['fName'] . " " . $_GET['lName']  . '</p>';
        echo '<p id="patient_age">Age: ' . $_GET['age'] . '</p>';    
        echo '<p id="patient_email">Email: ' . $_GET['email'] . '</p>';    
        echo '<p id="patient_phone">Phone: ' . $_GET['phone'] . '</p>';    
    }
    ?>
</div>
<!-- Displayiing patient diagnosis/reports -->
<div id="patient_reports"></div>
</main>

<script>
    $("#patient_search").keyup(function() {
        $("#patient_list").load('_engine/search_patient.php', {
            search_term: $("#patient_search").val()
        })
    });

    $("#search_button").click(function() {
        $("#patient_list").load('_engine/search_patient.php', {
            search_term: $("#patient_search").val()
        })
    });

    // Listen for click events on the document and close the list 
    $(document).on('click', function (event) {
        // If the clicked element is 'ap' or a child of 'ap', do nothing
        if ($(event.target).is($("#patient_search")) || $("#patient_search").has(event.target).length !== 0) {
            return;
        }
        // Otherwise, handle the click outside of 'ap'
        $("#patient_list").empty();
    });

    <?php 
    if (isset($_GET['id'])) {
    ?>
        $.get('_engine/search_patient_reports.php',{patientId: <?php echo $_GET['id']; ?>}, function(data){
            $("#patient_reports").html(data);
        });    
    <?php
    }
    ?>
    // Adding click events to patients in the list. I follow the method because the list is added after initial page load dynamically
    $(document).on('click', '.searched_patient', function() {
    });


</script>