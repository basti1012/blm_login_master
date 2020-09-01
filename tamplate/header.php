<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php  if(!empty($baselink)){  ?>
<base href="<?php echo $baselink; ?>">
<?php  }  ?>
<?php  if($favicons==true){  ?>
<link rel="apple-touch-icon" sizes="57x57" href="images/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="images/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="images/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="images/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="images/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="images/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="images/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="images/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="images/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="images/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="images/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
<link rel="manifest" href="images/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="images/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<?php  }  ?>
<link rel="stylesheet" href="style.css">
<?php
/*
$verzeichnis = "./hosting/";
$e=0;

if ( is_dir ( $verzeichnis )){
    if ( $handle = opendir($verzeichnis) ){
        while (($file = readdir($handle)) !== false){
        }
    }    
}

*/
if(isset($id[22]) AND $id[22]=='true'){  ?>
<script src="hosting/jquery.min.js"></script>
<script src="hosting/bootstrap.min.js"></script>
<script src="hosting/bootstrapvalidator.min.js"></script>
<link rel="stylesheet" href="hosting/font-awesome.min.css">
<link rel="stylesheet" href="hosting/bootstrap.min.css">
<link rel="stylesheet" href="hosting/bootstrap-theme.min.css">
<link rel="stylesheet" href="hosting/bootstrapValidator.min.css">
<link rel='stylesheet' href='hosting/sweet-alert.css'>
<script src='hosting/sweet-alert.min.js'></script>";
<?php
  }else{  ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.0/css/bootstrapValidator.min.css">
<link rel='stylesheet' href='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css'>
<script src='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.min.js'></script>
<?php  }  ?>