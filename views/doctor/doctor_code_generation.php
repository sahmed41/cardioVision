<style>
    main {
        display: block;
        width: 100%;
    }

    .page_title {
        width: 90%;
        margin: auto;
    }

    
    #patient_id,
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
</style>

<main>
    <h1 class="page_title">Generate DocCode</h1>
    <form action="_engine\backend_test.php">
        <input type="number" name="patient_id" id="patient_id">
        <input type="button" value="Generate" id="doc_code_generate_button">
    </form>
    <div id="code_generation_result"></div>
</main>

<script>
    $("#doc_code_generate_button").click(function(event) {
       $("#code_generation_result").load("_engine/consultation_creation.php", {
        patient_id: $("#patient_id").val()
       });
       // Perform desired action
     });

</script>