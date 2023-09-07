<style>
    .page_title {
        background-color: var(--white);
        width: 90%;
        margin: 0 auto;
        padding: 10px;
        border-radius: 5px;
    }

    #no_second_physican_message {
        background-color: var(--orange);
        width: 90%;
        margin: 10px auto;
        padding: 10px;
        color: var(--white);
        font-size: 1.2em;
    }

    .second_opinion {
        border: 1px solid black;
    }

    .second_opinion_physician {
        background-color: var(--white);
        width: 90%;
        margin: 10px auto;
        padding: 10px;
        border-radius: 5px;
        font-size: 1.2em;
    }

    .second_physician_name {
        background-color: var(--orange);
        padding: 10px;
        border-radius: 5px;
        color: var(--white);
    }

    .second_physician_opinion {
        margin: 10px auto;
        padding: 10px;
        text-align: justify;
    }

    #add_more_physicans_button {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: var(--green);
        width: 90%;
        height: 50px;
        margin: 10px auto;
        border-radius: 5px;
        color: var(--white);
        font-size: 1.2em;        
        text-decoration: none;
    }
</style>
<main>
    
<?php 
$diagnose_id = $_GET['diagnoseId'];

require_once('_engine/db_connection.php'); 

echo "<h1 class='page_title'>Diagnosis 00$diagnose_id Second Opinions</h1>";

$sql = "SELECT id, second_physician, opinion FROM second_opinion WHERE diagnosis='$diagnose_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $sql1 = "SELECT id, f_name, l_name FROM user WHERE id='" . $row['second_physician'] . "'";
        $result1 = $conn->query($sql1);

        echo '<div class="second_opinion_physician">';
        if ($result1->num_rows == 1) {
            while($row1 = $result1->fetch_assoc()) {
                echo  '<p class="second_physician_name"> Dr. ' . $row1['f_name'] . " ". $row1['l_name'] . "</p>";
            }
        }
        
        if($row['opinion'] == null) {
            echo  '<p class="second_physician_opinion">The physician has not provided his second opinion yet</p>';
        } else {
            echo  '<p class="second_physician_opinion">' . $row['opinion'] . '</p>';
        }
        echo '</div>'; 
    }
    
} else {
    echo "<p id='no_second_physican_message'>This diagnosis has not been shared with any physicians</p>";
}

require_once('_engine/db_disconnection.php') 
?> 
<a href="index.php?page=doctorShareAdd&diagnoseId=<?php echo $diagnose_id ?>" id="add_more_physicans_button">Add More Physicians</a>
</main>
