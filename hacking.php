<?php
if(!isset($hackingout)){
   die('Error');
}
include('config.php');
?>
<!DOCTYPE html>
<html lang="de">
<head>
<?php
include('tamplate/header.php');

$datum=date("d-M-Y h:i:s", time()); 
$ip = $_SERVER['REMOTE_ADDR'];

if($hackingout==1){
    $file='email-to-register.php';
    $error_out=$language['you_now_hacking'].'<br>File: '.$file.'<br>Date: '.$datum.'<br>Your Ip-adress :'.$ip; 
}
if($hackingout==2){
    $file='profil.php';
    $error_out=$language['error_hack'].'<br>File: '.$file.'<br>Date: '.$datum.'<br>Your Ip-adress :'.$ip; 
}


?>
<title><?php echo $error_out; ?></title>
 
<style>
body {
    background-image: url(images/hacking.jpg);
    background-repeat:no-repeat;
    background-size:cover;
    min-height:100vh;
    width:100%;
}
h1,h3{
    color:white;
    font-size:40px;
}
</style>
</head>
<body>
<?php
    $hackdata="<tr><td>$datum</td><td>$file</td><td>$ip</td></tr>";
    file_put_contents('hack_versuche.log', $hackdata, FILE_APPEND | LOCK_EX);
$wrror_page=true;
include('tamplate/nav.php');
?>
 
<h1><?php echo $error_out; ?></h1>
     <?php
    if(isset($footer_aktive) AND $footer_aktive=='true'){
     include('tamplate/footer.php');
}
    ?>
</body>
</html>