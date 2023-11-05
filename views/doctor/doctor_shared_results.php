<style>
    .diagnosis { /* Setting up the layout for each second diagnosis card */
        display: flex;
        justify-content: space-between;
        
        border-left: 5px solid var(--green);
    }

    .link_to_result {
        background-color: var(--green);
        width: 35%;
    }
</style>
<main>
    <h1>Share Results</h1>
    <p>The following results are shared with you by your collegeus for your second opinion.</p>
    <div id="shared_results_container">

    </div>
</main>

<script>
    $.get('_engine/get_shared_results.php', {physician_id: <?php echo $_SESSION['id'] ?>}, function(data) {
        $("#shared_results_container").html(data);
    })

    // This will enable the feature of clicking anywther in the diagnosis to take you to corresponding result. I have uside inside the body not at the end, beause the diagnose id for each result is generted in this loop. 
    // $('.new_indicator').parent().css("border-left","5px solid var(--orange)"); // Giving the orange border to results that are not interpreted yet
    // $('.new_indicator').prev().children(":last-child").css("background-color","var(--orange)"); // Giving the orange border to results that are not interpreted yet

</script>
