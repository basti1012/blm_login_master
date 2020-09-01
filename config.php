<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['username'])) {
    $you_logged_in = true;
    $you_logged_in_name = $_SESSION['username'];
}
if (isset($_SESSION['username_admin'])) {
    $admin_logged_in = true;
    $admin_logged_in_name = $_SESSION['username_admin'];
}
$header = '';
include ('mysql.php');
$r = 0;
$sql = "SELECT * FROM login_system_config";
foreach ($mysql->query($sql) as $row) {
    $r++;
    if ($r == $row['id']) {
        $id[$r] = $row['wert'];
    }
}
if ($id[1] == true) {
    error_reporting(E_ALL);
    ini_set('display_errors', true);
} else {
    ini_set('display_errors', 0);
}
if ($id[2] == true) {
    error_reporting(E_ALL);
    ini_set('error_log', 'php_error.log');
    ini_set('log_errors', 'On');
}
$nach_login = $id[3];
$nach_login_text = $id[4];
$speak_file = "language/" . $id[7];
if ($id[7] != '') {
    include ($speak_file);
} else {
    include ('language/englisch.txt');
}
$sendetext = $id[8];
$absender = $id[9];
if ($id[10] == true) {
    $header.= "From: $absender\r\n";
}
$antwortan = $id[11];
if ($id[12] == true) {
    $header.= "Reply-To: $antwortan\r\n";
}
$arr = explode("<br>", trim($id[13]));
for ($i = 0;$i < count($arr);$i++) {
    $header.= $arr[$i] . '\n';
}
/*
$header.="MIME-Version: 1.0";
$header.="Content-type: text/html; charset=utf-8";
//$header.="Cc: $cc";
$header.="X-Mailer: PHP ".phpversion().";";
*/
$betreff = $id[14];
$favicons = $id[16];
$baseline = $id[15];
$captcha_aktiv = $id[17];
$datenschutztext = $id[18];
$datenschutz_read = $id[19];
$login_time_active = $id[20];
$logout_time_in_sec = $id[21];
if (isset($you_logged_in) AND $you_logged_in == true) {
    if (!isset($_SESSION["LastActivity"])) {
        $_SESSION["LastActivity"] = time();
    } else {
        if ($_SESSION["LastActivity"] < (time() - $logout_time_in_sec)) {
            unset($_SESSION["username"]);
            unset($_SESSION["LastActivity"]);
            header('location:index.php');
        } else {
            $from = $_SESSION["LastActivity"];
            if ($login_time_active == 'true') {
                $resttime = "
         <script>
         var start=$logout_time_in_sec;
         setInterval(function(){
           start--;
           if(start<=0){
                 location.href='logout.php?logout';          
            }else{
                 document.getElementById('resttime').innerHTML='Logout in '+start+'';
            }
            if(start<=100){
                document.querySelector('#clock_to_end a span').style.background='orange';
                window.getComputedStyle(
                       document.querySelector('#clock_to_end a span'), ':after'
                );
            }
            if(start<=50){
               document.querySelector('#clock_to_end a span').style.background='red';
               setTimeout(function(){
               document.querySelector('#clock_to_end a span').style.background='yellow';
               },500);
            }
         },1000);
         </script>
         ";
            } else {
                $resttime = '';
            }
            $_SESSION["LastActivity"] = time();
        }
    }
}
function is_dir_empty($dir) {
    if (!is_readable($dir)) return NULL;
    return (count(scandir($dir)) == 2);
}
$dir = 'hosting/';
if (is_dir_empty($dir)) {
    $back_folder = 1;
} else {
    $back_folder = 2;
}
$ordner_status = $back_folder;
if ($id[22] == 'true') {
    if ($ordner_status == 1) {
        include ('tamplate/selfing_hosting.php');
    } else {
    }
} else {
    if ($ordner_status == 2) {
        foreach (glob("hosting/*.*") as $filename) {
            unlink($filename);
        }
    } else {
    }
}
$register_email = $id[23];
$betreff_register = $id[24];
$sendetext_register = $id[25];
$footer_aktive = true;
?>
