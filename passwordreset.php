<?php
include('config.php');
?>
<!doctype html>
<html lang="de">
<head>
<?php
include('tamplate/header.php');
?>
<title><?php echo $language['title_pw_forgotten']; ?></title>
</head>
<body id="pwreset">
<?php
    $passwordreset=true;
    include('tamplate/nav.php');
    if (isset($_POST["submit"])) {
        $stmt = $mysql->prepare("SELECT * FROM `$tabelle` WHERE email = :email");
        $stmt->bindParam(":email", $_POST["email"]);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count != 0){
            $token = generateRandomString(25);
            $stmt = $mysql->prepare("UPDATE `$tabelle` SET token = :token WHERE email = :email");
            $stmt->bindParam(":token", $token);
            $stmt->bindParam(":email", $_POST["email"]);
            $stmt->execute();
            $link=$pwlink."setpassword.php?token=".$token;
            $sendetext = str_replace('{link}',$link,$sendetext);
 //echo $betreff;
 //echo $sendetext;
 //echo $header;
 //echo $_POST["email"];
            mail($_POST["email"], $betreff, $sendetext,$header);
            echo "<div class='alert alert-success' role='alert'>
                  <span class='glyphicon glyphicon-ok' aria-hidden='true'></span>
                  <span class='sr-only'>Ok:</span> ".$language['success_email']." </div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>
                  <span class='glyphicon glyphicon-removing' aria-hidden='true'></span>
                  <span class='sr-only'>Error:</span>  ".$language['error_email']."  </div>";
        }
    }
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    ?>
    <form class="well form-horizontal" action="passwordreset.php" method="post" id="contact_form">
        <fieldset>
            <h1><?php echo $language['pw_forgotten']; ?></h1>
        <div class="form-group">
                      <div class="col-md-4 inputGroupContainer">
          <div class="input-group">
             <span class="input-group-addon">
                  <i class="glyphicon glyphicon-envelope"></i>
             </span>
            <input autocomplete="off" class="form-control input_feld" type="email" name="email" placeholder="<?php echo $language['placeholder_email']; ?>" required><br>
          </div>
       </div>
    </div>
     <div class="form-group">
          <div class="col-md-4">
                <button class="input_feld" type="submit" name="submit"><?php echo $language['submit_forgotten']; ?></button>
             </div>
   </div>
  </fieldset>
    </form>
 <?php
    if(isset($footer_aktive) AND $footer_aktive=='true'){
     include('tamplate/footer.php');
}
?>
</body>
</html>