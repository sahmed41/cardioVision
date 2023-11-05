
<a href="http://localhost/cardioVision" class="back_button">Main Menu</a>
<a href="_engine/logout.php" class="logout_button">Logout</a>
<p id="user_info">
    Welcome! 
    <?php 
    if(isset($_SESSION['id'])) {
        echo $_SESSION['f_name'] . " " .  $_SESSION['l_name'];
    }
    ?>
</p>


