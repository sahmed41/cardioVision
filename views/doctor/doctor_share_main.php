<style>
    .second_opinion {
        border: 1px solid black;
    }
</style>
<main>
<?php 
$diagnose_id = $_GET['diagnoseId'];

require_once('_engine/db_connection.php'); 

$sql = "SELECT id, second_physician, opinion FROM second_opinion WHERE diagnosis='$diagnose_id'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    // output data of each row
    $row = $result->fetch_assoc();
    echo '<div class="second_opinion">';
    echo $row['id'] . '-';
    echo $row['second_physician'];
    echo "<br>";
    echo $row['opinion'];
    echo '</div>';   
} else {
    echo "This diagnosis has not been shared with any physicians";
}

require_once('_engine/db_disconnection.php') 
?> 
<a href="index.php?page=doctorShareAdd&diagnoseId=<?php echo $diagnose_id ?>">Add More Physicians</a>
</main>
