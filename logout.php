<?php
if(isset($_GET['logout'])){
    session_start();
    session_destroy();
    echo "<META HTTP-EQUIV=\"refresh\" content=\"0;URL=logout.php\">";
}
include('config.php');
?>
<!doctype html>
<html lang="de">
<head>
<?php
include('tamplate/header.php');
?>
<title><?php echo $language['title_logout']; ?></title>
</head>
<body id="logoutpage">
<?php
$logout_page=true;
include('tamplate/nav.php');
echo "<div class='alert alert-danger' role='alert'>
      <span class='glyphicon glyphicon-removing' aria-hidden='true'></span>
      <span class='sr-only'>Error:</span> ".$language['you_logged_out']." </div>";
?>
</body>
</html>