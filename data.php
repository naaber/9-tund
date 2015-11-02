<?php

    require_once("functions.php");
    

    if(!isset($_SESSION['user_id'])){
        header("Location: login.php");
		//ära enam midagi edasi tee
		exit();
    }

    if(isset($_GET["logout"])){
        session_destroy();
        header("Location: login.php");
    }
    
?>

Tere, <?=$_SESSION['user_email'];?> <a href="?logout=1">Logi välja</a>
<br>
<?php if(isSet($_SESSION['login_message'])):?>
<p style="color:green"><?=$_SESSION['login_message'];?></p>
<?php endif; ?>
</p>

<?php
	//kustutan muutuja, et rohkem ei näidataks
	unset($_SESSION['login_message']);
?>

