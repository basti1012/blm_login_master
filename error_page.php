<?php
if(!isset($error_out)){
   die('Error');
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
<?php
include('tamplate/header.php');
?>
<title><?php echo $error_out; ?></title>
<style>
.sweet-alert p {
    color: orange !important;
    font-weight:900 !important;
}
</style>
</head>
<body id="errorpage">
<?php
$wrror_page=true;
include('tamplate/nav.php');
if($id[22]=='true'){ 
?>
<link rel="stylesheet" href="hosting/sweet-alert.css">
<script src="hosting/sweet-alert.min.js"></script>
<?php
}else{
?>
<link rel="stylesheet" href="https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css">
<script src="https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.min.js"></script>
<?php
}
?>
<script>
  setTimeout(function(){
      swal("Error !!", "<?php echo $error_out; ?>", "error");
   },200);
</script>
    <?php
    if(isset($footer_aktive) AND $footer_aktive=='true'){
     include('tamplate/footer.php');
}
    ?>

</body>
</html>