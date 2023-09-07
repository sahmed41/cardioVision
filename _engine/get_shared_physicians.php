<!-- <h1>Hi there, hello</h1>
<h2>You have a shared physician for me</h2> -->

<?php 
$diagnose_id = $_POST['diagnose_id'];

require_once('db_connection.php'); 

$sql = "SELECT id, second_physician, opinion FROM second_opinion WHERE diagnosis='$diagnose_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $second_opinion_id = $row['id'];
        $sql_user = "SELECT id, f_name, l_name FROM user WHERE id='" . $row['second_physician'] . "'";
        $result_user = $conn->query($sql_user);

        if($result_user->num_rows == 1 ) {
            $row_user = $result_user->fetch_assoc();
            echo '<div class="second_opinion_physicians">';
            echo $row_user['f_name'] . " " . $row_user['l_name'];
            echo "<a href=\"_engine/remove_share_physician.php?secondOpinionId=" . $second_opinion_id . "&diagnoseId=" . $diagnose_id . "\" class='second_physician_remove_button'> Remove</a>"; // Link to removing a physicina from shared list
            echo '</div>';   
        }

    }
    
} else {
    echo "This diagnosis has not been shared with any physicians";
}

require_once('db_disconnection.php');
?> 
