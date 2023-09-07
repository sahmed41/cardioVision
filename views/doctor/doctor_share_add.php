<style>
    .search_list_physician {
        background-color: white;
        margin: 2px;

    }
</style>

<main>
    
    <h1>Diagnosis 0<?php echo $_GET['diagnoseId']?></h1>
    <input type="text" name="physician_search" id="physician_search">
    <button id="search_button">Search</button>
    <div id="physician_list"></div>
    <div id="shared_physician_list">

    </div>
</main>

<script>
    // As you type the search will appear
    $("#physician_search").keyup(function() {
        $("#physician_list").load('_engine/search_physician.php', {
            search_term: $("#physician_search").val(),
            diagnose_id: <?php echo $_GET['diagnoseId'] ?>
        })
    });

    // Setting up click even for the search button to retrieve matchin physicians
    $("#search_button").click(function() {
        $("#physician_list").load('_engine/search_physician.php', {
            search_term: $("#physician_search").val(),            
            diagnose_id: <?php echo $_GET['diagnoseId'] ?>
        })
    });

    // Clearing the element once focus is not on the input
    // $("#physician_search").focusout(function() {
    //     $("#physician_list").empty()
    // });
    // Listen for click events on the document
    $(document).on('click', function (event) {
        // If the clicked element is 'ap' or a child of 'ap', do nothing
        if ($(event.target).is($("#physician_search")) || $("#physician_search").has(event.target).length !== 0) {
            return;
        }
        // Otherwise, handle the click outside of 'ap'
        $("#physician_list").empty();
    });

    // Printing the list of doctors with whom the diagnosis is shared
    $(document).ready(function() {
        $("#shared_physician_list").load('_engine/get_shared_physicians.php', {
            search_term: $("#physician_search").val(),            
            diagnose_id: <?php echo $_GET['diagnoseId'] ?>
        })
    });
</script>