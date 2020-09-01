<?php
if(file_exists('mysql.php')){
include('config.php');
$infos='';
if(isset($you_logged_in) AND $you_logged_in==true){

}else{
    include('login.php');
}
?>
<!doctype html>
<html lang="de">
<head>
<?php
$index_page=true;
include('tamplate/header.php');
?>
<title><?php echo $language['title_login']; ?></title>
</head>
<body id="indexpage">
<?php
include('tamplate/nav.php');
echo $infos;
?>
<form class="well form-horizontal" action="index.php"  method="post" id="contact_form">
<fieldset>
<?php
if(isset($you_logged_in) AND $you_logged_in==true){
     echo "<div class='alert alert-success' role='alert'>
              <span class='glyphicon glyphicon-ok' aria-hidden='true'></span>
              <span class='sr-only'>".$language['login_name_1']." ".$you_logged_in_name."</span>
              ".$language['text_login']."
              </div>";
} else {
    if(isset($_GET['logout'])){
        echo "<div class='alert alert-success' role='alert'>
              <span class='glyphicon glyphicon-ok' aria-hidden='true'></span>
              <span class='sr-only'>Ok:</span>
              ".$language['succes_login']."
              </div>";
    }
?>
<h1><?php echo $language['user_login_text']; ?></h1>
 
    <div class="form-group">
       <label class="col-md-4 control-label"><?php echo $language['admin_nickname']; ?></label>  
       <div class="col-md-4 inputGroupContainer">
          <div class="input-group">
             <span class="input-group-addon">
                  <i class="glyphicon glyphicon-user"></i>
             </span>  
             <input type="text" placeholder="<?php echo $language['placeholder_name']; ?>" class="form-control"  name="username" value="" require>  
          </div>
       </div>
    </div>
   <div class="form-group">
       <label class="col-md-4 control-label" ><?php echo $language['admin_password']; ?></label> 
       <div class="col-md-4 inputGroupContainer">
          <div class="input-group">
              <span class="input-group-addon">
                   <i class="glyphicon glyphicon-lock"></i>
              </span>
              <input type="password" placeholder="<?php echo $language['placeholder_password']; ?>" class="form-control"  name="pw" value="" require>  
          </div>
       </div>
   </div>
   <div class="form-group">
       <label class="col-md-4 control-label"></label>
       <div class="col-md-4">
         <button type="submit" name="submit" class="btn btn-warning"> 
        <?php echo $language['placeholder_submit']; ?> 
         <span class="glyphicon glyphicon-send"></span>
         </button>
       </div>
   </div>
  </fieldset>
</form>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
<?php
}
}else{
?>
<html lang="de">
<head>
<?php
include('tamplate/header.php');
?>
<title><?php echo $language['title_install']; ?></title>
</head>
<body>
<?php
include('install/install.php');
}
if(isset($footer_aktive) AND $footer_aktive=='true'){
     include('tamplate/footer.php');
}
?>
</body>
</html>