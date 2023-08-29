<?php 
require_once('components\navigation.php');


if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'patient') {
        if (isset($_GET['page']) and $_GET['page'] == "patientDiagnoseCode") {
            require_once('patient/patient_diagnose_code.php');
        } elseif (isset($_GET['page']) and $_GET['page'] == "patientDiagnoseScreen") {
            require_once('patient/patient_diagnose_screen.php');
        } elseif (isset($_GET['page']) and $_GET['page'] == "patientCaptureImage") {
            require_once('patient/patient_capture_image.php');
        } elseif (isset($_GET['page']) and $_GET['page'] == "patientDiagnoseCode") {
            require_once('patient/patient_diagnose_code.php'); // Rout to the page to enter docCode again
        } elseif (isset($_GET['page']) and $_GET['page'] == "patientUploadImage") {
            require_once('patient/patient_upload_image.php'); // Rout to the ecg image upload page
        } else {
            require_once('patient/patient_main.php');

        }
    } elseif ($_SESSION['role'] == 'physician') {
        require_once('doctor/doctor_main.php');
    }
}


    




// echo $_GET['user']; // testing
?>
    
    
