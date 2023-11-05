<style>
    main {
        display: block;
        width: 100%;
    }

    .page_title {
        width: 90%;
        margin: auto;
    }

    
    #doc_code_generate_button {
        background-color: var(--white);
        display: block;
        width: 90%;
        height: 50px;
        margin: 30px auto;
        padding: 0 10px;
        border: none;
        font-size: 1.2em;        
        border-radius: 5px;
    }

    
    #doc_code_generate_button {
        background-color: var(--green);
        color: var(--white);
    }

    #code_generation_result {
        background-color: var(--white);
        width: 90%;
        margin: 10px auto;
        padding: 10px;
        border-radius: 5px;
        font-size: 1.2em;
    }

    #code_generation_result p:first-child {
        text-align: center;
    }

    #doc_code {
        text-align: center;
        font-weight: bold;
    }

    form label {
        display: flex;
        flex-direction: column;
        width: 90%;
        margin: 20px auto;
        font-size: 1.2em;
    }

    form label textarea {
        width: 100%;
        border-radius: 5px;
        margin-top: 5px;
    }

    form textarea {
        padding: 10px;
        font-size: 1.2em;
    }
</style>

<main>
    <h1 class="page_title">Generate DocCode</h1>
    <form action="_engine\backend_test.php">
        <label for="symptoms">
            Symptoms
            <textarea name="symptoms" id="symptoms" cols="30" rows="10"></textarea>
        </label>
        <label for="allergies">
            Allergies
            <textarea name="allergies" id="allergies" cols="30" rows="10"></textarea>
        </label>
        <label for="medical_history">
            Medical History
            <textarea name="medical_history" id="medical_history" cols="30" rows="10"></textarea>
        </label>
        <label for="family_medical_history">
            Family Medical History
            <textarea name="family_medical_history" id="family_medical_history" cols="30" rows="10"></textarea>
        </label>
        <input type="button" value="Generate" id="doc_code_generate_button">
    </form>
    <div id="code_generation_result"></div>
</main>

<script>
    $("#doc_code_generate_button").click(function(event) {
       $("#code_generation_result").load("_engine/consultation_creation.php", {
        patient_id: $("#patient_id").val(),
        medical_history: $("#medical_history").val(),
        family_medical_history: $("#family_medical_history").val(),
        symptoms: $("#symptoms").val(),
        allergies: $("#allergies").val()
       });
       // Perform desired action
     });
</script>