<?php
include('config.php');
?>
<!doctype html>
<html lang="de">
<head>
<?php
include('tamplate/header.php');
?>
<title><?php echo $language['title_new_pw']; ?></title>
</head>
<body id="setpassword">
<?php

if(empty($_GET['token'])){
  $tokk='';
}else{
  $tokk='setpassword.php?token='.$_GET['token'];
}
?>
  <form class="well form-horizontal create" action="<?php echo $tokk; ?>" method="POST">
    <fieldset>  
    <?php
    if(isset($_GET["token"])){
        $stmt = $mysql->prepare("SELECT * FROM `$tabelle` WHERE token = :token");
        $stmt->bindParam(":token", $_GET["token"]);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count != 0){
            if(isset($_POST["submit"])){
                if($_POST["pw1"] == $_POST["pw2"]){
                    $hash = password_hash($_POST["pw1"], PASSWORD_BCRYPT);
                    $stmt = $mysql->prepare("UPDATE `$tabelle` SET pass = :pw, token = null WHERE token = :token");
                    $stmt->bindParam(":pw", $hash);
                    $stmt->bindParam(":token", $_GET["token"]);
                    $stmt->execute();
                    echo "<div class='succes'>".$language['pw_ne_success']."</div><br>
                    <a class='links' href='index.php'> ".$language['link_login']."</a>";
                } else {
                    echo "<div class='error'>".$language['one_pw_wrong']."</div>";
                }
            }
            ?>
               <h1><?php echo $language['new_pw_give_in']; ?></h1>
                <input autocomplete="off" class="input_feld" type="password" name="pw1" placeholder="<?php echo $language['placeholder_password']; ?>" required><br>
                <input autocomplete="off" class="input_feld" type="password" name="pw2" placeholder="<?php echo $language['placeholder_pw_two']; ?>" required><br>
                <button class="input_feld erstelle" type="submit" name="submit"><?php echo $language['submit_pw']; ?></button>
            <?php
        } else {
            echo "<div class='error'>".$language['error_token']."</div><a class='links' href='passwordreset.php'>".$language['link_new_pw']."</a>";
        }
    } else {
        echo "<div class='error'>".$language['error_token2']."</div><a class='links' href='passwordreset.php'>".$language['link_new_pw2']."</a>";
    }
    ?>
    </fieldset>   
  </form>
      <?php
    if(isset($footer_aktive) AND $footer_aktive=='true'){
     include('tamplate/footer.php');
}
    ?>

</body>
</html>