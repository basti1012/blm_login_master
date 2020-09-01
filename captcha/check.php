<?php
    session_start();
    //print_r($_SESSION);
    if ($_POST['captcha_code'] == $_SESSION['captcha_spam']) {
        echo "capcha ok";
	} else {
		echo 'Du hast den Captcha-Code falsch eingegeben!';
	}
?>