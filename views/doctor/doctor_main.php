<style>
    @import url(../resources/css/main.css);
    body {
        background-color: var(--bg_primary);
    }

    main {
        width: 100%;
        height: 70vh;
        display: flex;
        row-gap: 15px;
        justify-content: space-evenly;
        flex-wrap: wrap;
        margin: 100px 0;            


    }

    .icon {
        width: 150px;
        height: 150px;
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

    #diagnose_icon {            
        background-color: var(--yellow);
    }

    #my_profile_icon {
        background-color: var(--green);
    }
    

    
</style>
<main>
    <div id="generate_code_icon" class="icon">
        <img src="resources/pictures/code.png" alt="Image of a stethoscope" class="icon_image">
        <p class="icon_text">DocCode</p>
    </div>
    <div id="diagnose_icon" class="icon">
        <img src="resources/pictures/stethoscope.png" alt="Image of a stethoscope" class="icon_image">
        <p class="icon_text">Diagnose</p>
    </div>
    <div id="patient_history_icon" class="icon">
        <img src="resources/pictures/stethoscope.png" alt="Image of a stethoscope" class="icon_image">
        <p class="icon_text">Patient History</p>
    </div>
    <div id="view_results_icon" class="icon">
        <img src="resources/pictures/my_profile.png" alt="Image of a stethoscope" class="icon_image">
        <p class="icon_text">My Profile</p>
    </div>
    <div id="shared_results_icon" class="icon">
        <img src="resources/pictures/my_profile.png" alt="Image of a stethoscope" class="icon_image">
        <p class="icon_text">Shared</p>
    </div>

</main>