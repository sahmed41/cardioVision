<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="resources/css/main.css">
    <link rel="stylesheet" href="resources/css/styles.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <title>CardioVision</title>
</head>
<body>
    
    <?php
    date_default_timezone_set("Asia/Colombo");
    require_once('_engine/db_connection.php');
    session_start();
    require_once('components\navigation.php');
    
    if (isset($_SESSION['id'])) {
        require_once('views/main.php');
    } else {
        require_once('views/login_form.php');
    }
    
    require_once('_engine/db_disconnection.php');
    ?>
    
</body>
</html>