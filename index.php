<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="resources/css/main.css">
    <link rel="stylesheet" href="resources/css/styles.css">
    <title>CardioVision</title>
</head>
<body>
    
    <?php
       session_start();
       
    if (isset($_SESSION['id'])) {
        require_once('views/main.php');
    } else {
        require_once('views/login_form.php');
    }
    
    ?>
    
</body>
</html>