<style>
    @import url(../resources/css/main.css);
    body {
        background-color: var(--bg_primary);
    }

    main {
        width: 100%;
        /* height: 70vh; */
        display: flex;
        row-gap: 15px;
        justify-content: space-evenly;
        flex-wrap: wrap;
        /* margin: 100px 0;             */
    }

    .icon {
        width: 150px;
        height: 150px;
        /* border: 1px solid black; */
        padding: 10px 10px 150px 10px;
        cursor: pointer;
    }

    .icon_image {
        display: block;
        width: 100px;
        height: 100px;
        margin: auto;
    }

    .icon_text {
        font-size: 1.2em;
        color: #fff;
        text-align: center;
        margin: 15px auto 0 auto;
    }

    #take_photo_icon {            
        background-color: var(--yellow);
    }

    #upload_icon {
        background-color: var(--green);
    }
</style>

<main>
    <div id="take_photo_icon" class="icon">
        <img src="resources/pictures/camera.png" alt="Image of a camera" class="icon_image">
        <p class="icon_text">capture</p>
    </div>
    <div id="upload_icon" class="icon">
        <img src="resources/pictures/upload_picture.png" alt="Image of an arrow pointing upwards on top of an image" class="icon_image">
        <p class="icon_text">Upload</p>
    </div>
</main>


<script>
    let take_photo_icon = document.getElementById('take_photo_icon');
    let upload_icon = document.getElementById('upload_icon');


    take_photo_icon.addEventListener("click", function(){
        window.location ="index.php?page=patientCaptureImage";
    });

    upload_icon.addEventListener("click", function(){
        window.location = "index.php?page=patientUploadImage";
    });
</script>
    

    
    
    
    
 
