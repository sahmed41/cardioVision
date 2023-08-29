<style>
    @import url(../resources/css/main.css);
    body {
        background-color: var(--bg_primary);
    }

    main {
        width: 100%;
        /* height: 70vh; */
        display: flex;
        row-gap: 15px;
        justify-content: space-evenly;
        flex-wrap: wrap;
        /* margin: 100px 0;             */
    }

    .icon {
        width: 150px;
        height: 150px;
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

    #patient_diagnose_icon {            
        background-color: var(--yellow);
    }

    #my_profile_icon {
        background-color: var(--green);
    }
</style>

<main>
    <div id="patient_diagnose_icon" class="icon">
        <img src="resources/pictures/stethoscope.png" alt="Image of a stethoscope" class="icon_image">
        <p class="icon_text">Diagnose</p>
    </div>
    <div id="my_profile_icon" class="icon">
        <img src="resources/pictures/my_profile.png" alt="Image of a stethoscope" class="icon_image">
        <p class="icon_text">My Profile</p>
    </div>
</main>


<script>
    let patient_diagnose_icon = document.getElementById('patient_diagnose_icon');
    patient_diagnose_icon.addEventListener("click", function(){
        window.location = "index.php?page=patientDiagnoseCode";
    });

    let my_profile_icon =document.getElementById('my_profile_icon');
    my_profile_icon.addEventListener("click", function() {
        window.location = "index.php?page=patientProfile"; 
    })
</script>
    

    
    
    
    
 
