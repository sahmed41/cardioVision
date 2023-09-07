<main>
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