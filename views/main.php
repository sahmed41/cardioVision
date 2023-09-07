<?php 



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
        } elseif (isset($_GET['page']) and $_GET['page'] == "patientProfile") {
            require_once('patient/patient_profile.php'); // Rout to patient profile page
        } elseif (isset($_GET['page']) and $_GET['page'] == "patientResult") {
            require_once('patient/patient_result.php'); // Rout to patient result page
        }else {
            require_once('patient/patient_main.php');

        }
    } elseif ($_SESSION['role'] == 'physician') {
        if (isset($_GET['page']) and $_GET['page'] == "doctorCodeGeneration") {
            require_once('doctor/doctor_code_generation.php');
        } elseif (isset($_GET['page']) and $_GET['page'] == "doctorToDiagnose") {
            require_once('doctor/doctor_to_diagnose.php'); // Route to doctore diagnose page where all the results are listed at.
        } elseif (isset($_GET['page']) and $_GET['page'] == "patientResult") {
            require_once('patient/patient_result.php'); // Route to patient result page
        } elseif (isset($_GET['page']) and $_GET['page'] == "doctorShareMain") {
            require_once('doctor/doctor_share_main.php'); // Route to doctor share page
        } elseif (isset($_GET['page']) and $_GET['page'] == "doctorShareAdd") {
            require_once('doctor/doctor_share_add.php'); // Route to doctor share page
        }  else {
            require_once('doctor/doctor_main.php');
        }

        
    }
}


    




// echo $_GET['user']; // testing
?>
    
    
