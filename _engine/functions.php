<?php
function getRandomString($n) { // Used for generating docCode
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}

function checkDocCode($doc_code) { // Checks if the geneated docCode exists
    global $conn;
    $sql = "SELECT id, docCode FROM consultation WHERE docCode='$doc_code'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        return true;
    } else {
        return false; 
    }
}
?>