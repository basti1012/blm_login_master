<?php
session_start();
include('config.php');
if(isset($you_logged_in) AND $you_logged_in==true){

}else{
    $error_out=$language['error_secret'];
    include('error_page.php');
    exit;
}
?><!DOCTYPE html>
<html lang="de">
<head>
<?php
include('tamplate/header.php');
?>
<title><?php echo $language['title_aecret']; ?></title>
</head>
<body id="secretpage">
<?php
$geheime_page=true;
include('tamplate/nav.php');
?>
    <h1><?php echo $language['secret_h1'].' '.$nach_login_text; ?></h1>
    <?php
    if(isset($_SESSION["username"])){
         echo "<h3>Willkommen ".$_SESSION["username"]."</h3>";
    }
    ?>
        <?php
    if(isset($footer_aktive) AND $footer_aktive=='true'){
     include('tamplate/footer.php');
}
    ?>
</body>
</html>