<?php
include('config.php');
?>
<!doctype html>
<html lang="de">
<head>
<?php
include('tamplate/header.php');
?>
<title><?php echo $language['title_kill_accound']; ?></title>
</head>
<body id="deletepage">
<?php
$delete_page=true;
include('tamplate/nav.php');
?>
<?php
if(isset($you_logged_in) AND $you_logged_in==true){
$name=$you_logged_in_name;
}else{
    echo "<div class='alert alert-danger' role='alert'>
          <span class='glyphicon glyphicon-removing' aria-hidden='true'></span>
          <span class='sr-only'>Error:</span> ".$language['kill_not_logged']." </div>";
    exit;
}
if(isset($_GET['delete']) and !isset($_POST['name_to_hand'])){
?>
<form class="well form-horizontal" action="delete.php?delete"  method="POST" id="contact_form">
<fieldset>
<h1><?php echo $language['kill_user_text']; ?></h1>
<input  class="input_feld" type="text" name="name_to_hand" placeholder="<?php echo $language['placeholder_kill_name']; ?>" required><br>
<button  class="input_feld" type="submit" name="submit"><?php echo $language['kill_your_accound_submit']; ?></button>
</fieldset>
</form>
<?php
}
if(isset($_GET['delete']) AND isset($_POST['name_to_hand'])){
    if($name==$_POST['name_to_hand']){
       $stmt = $mysql->prepare("DELETE FROM $tabelle WHERE user=:user");
       $stmt->bindParam(":user",$_POST["username"]);
       $stmt->execute();
       echo "<div class='alert alert-success' role='alert'>
             <span class='glyphicon glyphicon-ok' aria-hidden='true'></span>
             <span class='sr-only'>Ok:</span> ".$language['accound_kill_ok']." </div>";
             echo "<META HTTP-EQUIV=\"refresh\" content=\"1;URL=logout.php\">";
    }else{  
       echo "<div class='alert alert-danger' role='alert'>
             <span class='glyphicon glyphicon-removing' aria-hidden='true'></span>
             <span class='sr-only'>Error:</span>  ".$language['name_is_not_session']."
             <br><a class='links' href='javascript:history.back()'>".$language['back']."</a></div>";
    }
}
?>
</body>
</html>