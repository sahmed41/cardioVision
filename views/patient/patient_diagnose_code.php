<style>
    @import url(resources/css/main.css);
     main {
        width: 100%;
        /* height: 70vh; */
        /* display: flex; */
        /* row-gap: 15px; */
        /* justify-content: space-evenly; */
        /* flex-wrap: wrap; */
        /* margin: 100px 0;             */
    }
    
    #doc_code,
    #doc_code_submit_button {
        display: block;
        width: 90%;
        height: 50px;
        margin: 30px auto;        
        padding: 0 10px;      
        font-size: 1.2em;           
        border: none;     
        border-radius: 5px;
    }

    #doc_code {
        background-color: var(--white);
    }

    #doc_code_submit_button {
        background-color: var(--green);
        color: var(--white);
    }

    /* Error Message styling */
    #docCode_verification {
    width: 90%;
    margin: auto;
    height: 100px;
    font-size: 1.2em;
    color: var(--orange);
    }

</style>

<main>
    <form method="post" action="_engine/docCode_processing.php">
        <input type="text" name="doc_code" id="doc_code">
        <input type="submit" value="Enter" id="doc_code_submit_button">
    </form>
    <div id="docCode_verification">
        <p>
        <?php 
        if (isset($_GET['message']) and $_GET['message'] == "invalid_docCode") {
            echo "You have provided an incorrect docCode!";
        } else if (isset($_GET['message']) and $_GET['message'] == "used_docCode") {
            echo "The docCode is already used!";
        }
        ?>
        </p>
    </div>
</main>