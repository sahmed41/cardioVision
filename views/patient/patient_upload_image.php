<style>
    @import url(resources/css/main.css);
    main {
        width: 100%;
        display: flex;
        row-gap: 15px;
        justify-content: space-evenly;
        flex-wrap: wrap;
        margin: 200px 0;            
    }

    #ecg_upload_container {
        width: 90%;
    }

    #ecg_upload_display {
        width: 100%;
    }
    
    
</style>
<main>
    <div id="ecg_upload_container">
        <img src="" alt="" id="ecg_upload_display">
    </div>
    <form method="post" action="_engine\ecg_image_processing.php" enctype="multipart/form-data">
        <input type="file" name="ecg_capture" accept="image/*" id="ecg_upload">
        <input type="submit" value="Interpret">
    </form>
</main>

<script>
    let ecg_upload =document.getElementById('ecg_upload');
    let ecg_upload_display =document.getElementById('ecg_upload_display');
    ecg_upload.addEventListener("change", function(ev) {
        console.log(ecg_upload.files[0]);
        console.log(URL.createObjectURL(ecg_upload.files[0])); 
        ecg_upload_display.src = URL.createObjectURL(ecg_upload.files[0]); // Display image
    })
</script>