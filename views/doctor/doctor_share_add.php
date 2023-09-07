<style>
    .page_heading {
        background-color: var(--white);
        width: 90%;
        margin: 20px auto;
        padding: 10px;
        border-radius: 5px;
    }

    #search_container {
        width: 90%;
        margin: 10px auto;
    }

    #physician_search,
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

    

    .search_list_physician {
        background-color: var(--white);
        width: 90%;
        height: 50px;
        margin: 5px auto;
    }

    .search_list_physician a {
        display: block;
        width: 100%;
        height: 100%;
        padding-top: 15px;
        text-align: center;
        text-decoration: none;
    }

    #shared_physician_list {
        width: 90%;
        margin: 10px auto;        
    }

    .second_opinion_physicians {
        display: flex;
        justify-content: space-between;
        background-color: var(--white);
        width: 100%;
        margin: 10px auto;
        padding: 10px;
        font-size: 1.2em;
    }

    .second_physician_remove_button {
        background-color: var(--orange);
        padding: 5px;
        border-radius: 5px;
        color: var(--white);
        text-decoration: none;
    }

    
</style>

<main>
    
    <h1 class="page_heading">Diagnosis 0<?php echo $_GET['diagnoseId']?> Add Second Physician</h1>
    <div id="search_container">
        <input type="text" name="physician_search" id="physician_search">
        <button id="search_button">Search</button>
    </div>
    <div id="physician_list"></div>
    <div id="shared_physician_list"></div>
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