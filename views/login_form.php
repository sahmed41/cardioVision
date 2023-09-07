<main id="login_main">
    <img src="resources/pictures/hero_image.png" alt="A single ecg wave" id="hero_image">
    <form method="post" action="_engine\login.php" id="login_form">
        <input type="text" name="nm_id" id="nm_id" placeholder="Enter your NIC number or Medical ID" required>
        <input type="password" name="password" id="password" placeholder="Enter your password" required>
        <input type="submit" value="Login">
    </form>
    <p id="register_message"><a href="">Register</a> if you do not have an account</p>
</main>