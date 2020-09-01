<?php
if(isset($_POST['submit'])){
    if($register_email=='true'){
      if (filter_var($_POST["username"], FILTER_VALIDATE_EMAIL)) {
          $stmt = $mysql->prepare("SELECT * FROM $tabelle WHERE email = :email");
          $stmt->bindParam(":email",$_POST["username"]);
      } else {
          $stmt = $mysql->prepare("SELECT * FROM $tabelle WHERE user = :user");
          $stmt->bindParam(":user",$_POST["username"]);
      } 
      $stmt->execute();
      $dnn = $stmt->fetch();
      if($dnn['active']=='no'){
          $error_out=$language['you_click_on_email']='Du mußt erst deine Email bestätigen';
          include('error_page.php');
          exit;
      }
    }else{
      if (filter_var($_POST["username"], FILTER_VALIDATE_EMAIL)) {
          $stmt = $mysql->prepare("SELECT * FROM $tabelle WHERE email = :email");
          $stmt->bindParam(":email",$_POST["username"]);
      } else {
          $stmt = $mysql->prepare("SELECT * FROM $tabelle WHERE user = :user");
          $stmt->bindParam(":user",$_POST["username"]);
      } 
    }
    $stmt->execute();
    $count = $stmt->rowCount();
    if($count == 1){
         $row = $stmt->fetch();
         if(password_verify($_POST["pw"], $row["pass"])){
            $_SESSION["username"] = $row["user"];
            if($nach_login!=''){
                 header("Location: $nach_login");
                 $_SESSION["LastActivity"] = time();
            }
         }else{
            $infos="<div class='alert alert-danger' role='alert'>
                    <span class='glyphicon glyphicon-removing' aria-hidden='true'></span>
                    <span class='sr-only'>Error:</span>
                    ".$language['error_pw']." </div>";
         }
    }else{
            $infos="<div class='alert alert-danger' role='alert'>
                    <span class='glyphicon glyphicon-removing' aria-hidden='true'></span>
                    <span class='sr-only'>Error:</span>
                    ".$language['error_user']."
                    </div>";
    }
}
?>