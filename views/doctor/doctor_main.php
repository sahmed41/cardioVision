<style>
    @import url(../resources/css/main.css);
    body {
        background-color: var(--bg_primary);
    }

    main {
        display: flex;
        justify-content: space-evenly;
        row-gap: 15px;
        flex-wrap: wrap;
        width: 90%;
        height: 70vh;
        margin: 150px auto;            


    }

    .icon {
        width: 150px;
        height: 180px;
        background-color: var(--yellow);
        /* border: 1px solid black; */
        padding: 10px 10px 150px 10px;
        cursor: pointer;
    }

    .icon_image {
        display: block;
        width: 100px;
        height: 100px;
        margin: auto;
    }

    .icon_text {
        font-size: 1.2em;
        color: #fff;
        text-align: center;
        margin: 15px auto 0 auto;
    }

    #generate_code_icon {            
        background-color: var(--yellow);
    }

    #doctor_diagnose_icon {
        background-color: var(--light-blue);
    }
    
    #patient_history_icon {
        background-color: var(--light-green);
    }
    
    #view_results_icon {
        background-color: var(--green);
    }
    
    #shared_results_icon {
        background-color: var(--red);
    }
    

    
</style>
<main>
    <div id="generate_code_icon" class="icon">
        <img src="resources/pictures/code.png" alt="Image of a stethoscope" class="icon_image">
        <p class="icon_text">Consult</p>
    </div>
    <div id="doctor_diagnose_icon" class="icon">
        <img src="resources/pictures/doctor_diagnose.png" alt="Image of a stethoscope" class="icon_image">
        <p class="icon_text">Diagnose</p>
    </div>
    <div id="patient_history_icon" class="icon">
        <img src="resources/pictures/patient_history.png" alt="Image of a stethoscope" class="icon_image">
        <p class="icon_text">Patient History</p>
    </div>
    <div id="view_results_icon" class="icon">
        <img src="resources/pictures/view_results.png" alt="Image of a stethoscope" class="icon_image">
        <p class="icon_text">View Results</p>
    </div>
    <div id="shared_results_icon" class="icon">
        <img src="resources/pictures/shared_results.png" alt="Image of a stethoscope" class="icon_image">
        <p class="icon_text">Shared Results</p>
    </div>
</main>

<script>
  let generate_code_icon = document.getElementById("generate_code_icon");
  generate_code_icon.addEventListener("click", function() {
    window.location = "index.php?page=doctorCodeGeneration";
  });

  let doctor_diagnose_icon = document.getElementById("doctor_diagnose_icon");
  doctor_diagnose_icon.addEventListener("click", function() {
    window.location = "index.php?page=doctorToDiagnose";
  });
    
  let shared_results_icon = document.getElementById("shared_results_icon");
  shared_results_icon.addEventListener("click", function() {
    window.location = "index.php?page=doctorSharedResults";
  });

  let patient_history_icon = document.getElementById("patient_history_icon");
  patient_history_icon.addEventListener("click", function() {
    window.location = "index.php?page=doctorPatientHistory";
  });
    
  let view_results_icon = document.getElementById("view_results_icon");
  view_results_icon.addEventListener("click", function() {
    window.location = "index.php?page=doctorViewResults";
  });    
</script>