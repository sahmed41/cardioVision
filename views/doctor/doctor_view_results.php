<main>
    <h1>View Results</h1>
    <p>This page contains all the results interpreted by you</p>
    <div id="results_container"></div>

</main>

<script>
    $.get('_engine/get_interpreted_results.php', {physicianId: <?php echo $_SESSION['id']; ?>}, function(data) {
        $("#results_container").html(data);
    });
</script>