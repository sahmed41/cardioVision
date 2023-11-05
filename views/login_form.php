<style>
#main_heading {
    /* position: absolute;
    top: 100px; */
    width: 90%;
    margin: 50px auto;
    text-align: center;
    font-size: 3em;
}

#login_main {
    width: 100%;
    margin: 0 0 0 0;
    min-height: 100vh;
}

#hero_image {
    width: 100%;
    margin: 50px 0 50px 0;
}

#login_form input {
    display: block;
    width: 90%;
    height: 50px;
    margin: 30px auto;
}

#login_form input[type="text"],
#login_form input[type="password"] {
    background-color: var(--white);
    padding: 0 10px;
    font-size: 1.2em;
    border: none;
    
    border-radius: 5px;
}

#login_form input[type="submit"] {
    background-color: var(--green);
    /* outline: none; */
    font-size: 1.2em;
    color: var(--white);
} 


#register_message {
    width: 90%;
    margin: auto;
}

#login_message {
    width: 90%;
    margin: auto;
    height: 100px;
    font-size: 1.2em;
    color: var(--orange);
}
</style>
<main id="login_main">
    <h1 id="main_heading">CardioVision</h1>
    <img src="resources/pictures/hero_image.png" alt="A single ecg wave" id="hero_image">
    <form method="post" action="_engine\login.php" id="login_form">
        <input type="text" name="nm_id" id="nm_id" placeholder="Enter your NIC number or Medical ID" required>
        <input type="password" name="password" id="password" placeholder="Enter your password" required>
        <input type="submit" value="Login">
    </form>
    <div id="login_message">
        <p>
        <?php 
        if (isset($_GET['message']) and $_GET['message'] == "wrong_credentials") {
            echo "Your user or password might be incorrect!";
        }
        ?>
        </p>
    </div>
</main>
