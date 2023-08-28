<style>
    @import url(resources/css/main.css);
    main {
        width: 100%;
        display: flex;
        row-gap: 15px;
        justify-content: space-evenly;
        flex-wrap: wrap;
        margin: 100px 0;            
    }
    
    #doc_code,
    #doc_code_submit_button {
        display: block;
        width: 90%;
        height: 50px;
        margin: 30px auto;        
        padding: 0 10px;      
        font-size: 1.2em;           
        border: none;     
        border-radius: 5px;
    }

    #doc_code {
        background-color: var(--white);
    }

    #doc_code_submit_button {
        background-color: var(--green);
        color: var(--white);
    }
</style>

<main>
<form action="" method="post" enctype="multipart/form-data">
    <input type="file" id="ecg_capture" name="ecg_image" accept="image/*" capture >
    <input type="submit">

</form>
<input type="file" id="img" name="img" accept="image/*" id="upload_button">


</main>

<script>
    let ecg_capture =document.getElementById('ecg_capture');
    ecg_capture.addEventListener("change", function(ev) {
        console.log(ecg_capture.files[0]);
        console.log(URL.createObjectURL(ecg_capture.files[0]));
        
    })
</script>