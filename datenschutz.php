<?php
include('config.php');
?>
<!DOCTYPE html>
<html lang="de">
<head>
<?php
include('tamplate/header.php');
?>
<title><?php echo $language['title_datenschtz']; ?></title>
</head>
<body id="Kontaktformularseite">
<?php
$datenschutz_page=true;
include('tamplate/nav.php');
?>

 
<h1><?php echo $language['datasecret_h1']; ?></h1>
 

<div class="kontaktformular">
 <fieldset class="kontaktdaten">
 <?php
 echo $datenschutztext;
 ?>
 </fieldset>
</div>
    <?php
    if(isset($footer_aktive) AND $footer_aktive=='true'){
     include('tamplate/footer.php');
}
    ?>
</body>
</html>