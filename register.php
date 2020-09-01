<?php
$sms='';
 $sweetout=false;
include('config.php');
$register_page=false;
$plicht3=false;
$plicht4=false;
if(isset($you_logged_in) AND $you_logged_in==true){
}else{
    if($captcha_aktiv=='true'){
        if(isset($_POST['captcha_code'])){
            if ($_POST['captcha_code'] == $_SESSION['captcha_spam']) {
                  $plicht3=true;
            } else {
                  $sms.=$language['register_wrong_capacha'].'<br>';
                  $plicht3=false;
                  $error=true;
            }
        }
    }else{
        $plicht3=true;
    }
    if($datenschutz_read=='true'){
        if(isset($_POST['data_checkbox'])){
            $plicht4=true;
        } else {
            if(!isset($_POST['data_checkbox']) AND isset($_POST["username"])){
                $sms.=$language['data_checkbox_not_true'].'<br>';
                $plicht4=false;
                $error=true;
            }
        }
    }else{
        $plicht4=true;
    }
    if(isset($_POST['send'])){
      $plicht1=false;
      $plicht2=false;
      $error=false;
      if(isset($_POST['username'])){
         if(isset($_POST['password'])){
            if(isset($_POST['passverif'])){
               if($_POST['password']==$_POST['passverif']){
                    if(strlen($_POST['password'])>=4){
                         $plicht1=true;
                         $pwend=stripslashes($_POST['password']);
                    }else{
                         $sms.=$language['register_4_letter'].'<br>';
                         $error=true;
                    }
               }else{
                      $sms.=$language['register_pw_not_pw'].'<br>';
                      $error=true;
               }
            }else{
               $sms.=$language['register_passwort_again'].'<br>';
               $error=true;
            }
         }else{
               $sms.=$language['register_ist_empty'].'<br>';
               $error=true;
         }   
      }else{
        $sms.=$language['register_username_is_empty'].'<br>';
      }
      if($plicht1==true){
        if(isset($_POST['email'])){
              if(preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',$_POST['email'])){
                   $plicht2=true;
              }else{
                   $sms.=$language['email_not_valide'].'<br>';
                   $error=true;
              }   
        }else{
              $sms.=$language['email_is_empty'].'<br>';
              $error=true;
        }   
      }
      if($plicht1==true AND $plicht2==true AND $plicht3==true AND $plicht4==true){
      }else{
        $sms.=$language['is_inputs_empty'].'<br>';
        $error=true;
      }
     $stmt = $mysql->prepare("SELECT * FROM `$tabelle` WHERE user = :user"); //Username überprüfen
     $stmt->bindParam(":user", $_POST["username"]);
     $stmt->execute();
     $count = $stmt->rowCount();
     if($count == 0){
         $error=false; 
     }else{
         $sms.=$language['user_name_givet'].'<br>';
         $error=true;
     }
     $stmt = $mysql->prepare("SELECT * FROM `$tabelle` WHERE email = :email");
     $stmt->bindParam(":email", $_POST["email"]);
     $stmt->execute();
     $count = $stmt->rowCount();
     if($count == 0){
         $error=false; 
     }else{
         $sms.=$language['email_givet_in'].'<br>';
         $error=true;
     }
     if($error==false){    
        $ip = $_SERVER['REMOTE_ADDR'];
        if($register_email=='true'){
            $sid = session_id();
            $regkey = rand(1, 99999999);
            $active='no'; 
            $register_email_ok=true;
        }else{
            $sid =0;
            $regkey =0;
            $active='yes';
            $register_email_ok=false;
        }
        $stmt = $mysql->prepare("INSERT INTO `$tabelle` (user, pass, email,comment,townnumber,land,nachname,phone,address,city,geschlecht,ip,active,regkey,sid)
        VALUES (:user, :pass, :email, :comment, :townnumber, :land, :nachname, :phone, :address, :city, :geschlecht, :ip, :active, :regkey, :sid)");
        $stmt->bindParam(":user", $_POST['username']);
        $hash = password_hash($pwend, PASSWORD_DEFAULT);
        $stmt->bindParam(":pass", $hash);
        $stmt->bindParam(":email",$_POST['email']);
        $stmt->bindParam(":comment",$_POST['comment']);
        $stmt->bindParam(":townnumber",$_POST['townnumber']);
        $stmt->bindParam(":land",$_POST['land']);
        $stmt->bindParam(":nachname",$_POST['nachname']);
        $stmt->bindParam(":phone",$_POST['phone']);     
        $stmt->bindParam(":address",$_POST['address']);
        $stmt->bindParam(":city",$_POST['city']);
        $stmt->bindParam(":geschlecht",$_POST['geschlecht']); 
        $stmt->bindParam(":ip",$ip); 
        $stmt->bindParam(":active",$active);   
        $stmt->bindParam(":regkey",$regkey);        
        $stmt->bindParam(":sid",$sid);
        $stmt->execute();
        if($stmt){
            $form = false;
              echo "<div class='alert alert-success' role='alert'>
                  <span class='glyphicon glyphicon-ok' aria-hidden='true'></span>
                  <span class='sr-only'>Ok:</span>
                  ".$language['register_in_ok']."
                  </div>";
              if($register_email=='true'){ 
                    $id = $mysql->lastInsertId();
                    include('email-to-register.php');   
                    $sweetout=true;
              }else{
                    $sweetout=false;
              }
                  
        }else{
               $form = true;
               $sms.=$language['sometimes_errror'];
        }
     }else{
        $sms.=$language['more_errors'];
     }
   }else{
   }
}
?>
<!doctype html>
<html lang="de">
<head>
<?php
include('tamplate/header.php');
?>
</head>
<body id="bodyregister">
<?php
$register_page=true;
include('tamplate/nav.php');
?>
<?php
if(isset($you_logged_in) AND $you_logged_in==true){
?>
<form class="well form-horizontal" action="register.php" method="post" id="contact_form">
    <fieldset>
        <legend>
                <?php
                      echo $language['register_login_name'];
                      if(isset($_SESSION['username'])) {
                          echo $_SESSION['username'];
                      }
                ?>
        </legend>
        <?php
               echo "<div class='alert alert-danger' role='alert'>
                     <span class='glyphicon glyphicon-removing' aria-hidden='true'></span>
                     <span class='sr-only'>Error:</span>
                     ".$language['register_not_login']."
                    </div>"; 
        ?>
    </fieldset>
</form>
<?php
}else{
?>
<div class="container">
    <form class="well form-horizontal" action="register.php" method="post" id="contact_form">
        <fieldset>
        <?php
            if(isset($sms) AND $sms!=''){
                echo "<div class='alert alert-danger' role='alert'>
                        <span class='glyphicon glyphicon-removing' aria-hidden='true'></span>
                        <span class='sr-only'>Error:</span>
                        $sms
                   </div>";  
            }
        ?>
            <legend><?php echo $language['register_legend']; ?></legend>
            <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo $language['register_name']; ?></label>
                        <div class="col-md-4 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input autocomplete="off" type="text" placeholder="First Name" class="form-control" name="username" value="<?php if(isset($_POST['username'])){echo htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8');} ?>" />
                            </div>
                        </div>
            </div>
            <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo $language['register_next_name']; ?></label>
                        <div class="col-md-4 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input autocomplete="off" type="text" placeholder="Nach Name" class="form-control" name="nachname" value="<?php if(isset($_POST['nachname'])){echo htmlentities($_POST['nachname'], ENT_QUOTES, 'UTF-8');} ?>" />
                            </div>
                        </div>
            </div>
            <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo $language['register_password']; ?></label>
                        <div class="col-md-4 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input autocomplete="off" type="password" placeholder="Password" class="form-control" name="password" value="<?php if(isset($_POST['password'])){echo htmlentities($_POST['password'], ENT_QUOTES, 'UTF-8');} ?>" />
                            </div>
                        </div>
            </div>
            <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo $language['register_password_two']; ?></label>
                        <div class="col-md-4 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input autocomplete="off" type="password" placeholder="Password" class="form-control" name="passverif" value="<?php if(isset($_POST['password'])){echo htmlentities($_POST['password'], ENT_QUOTES, 'UTF-8');} ?>" />
                            </div>
                        </div>
            </div>
            <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo $language['register_email']; ?></label>
                        <div class="col-md-4 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                <input autocomplete="off" name="email" placeholder="E-Mail Address" class="form-control" value="<?php if(isset($_POST['email'])){echo htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8');} ?>" type="text">
                            </div>
                        </div>
            </div>
            <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo $language['genders']; ?></label>
                        <div class="col-md-4 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-sort"></i></span>
                                <select name="geschlecht" class="form-control">
                                      <option></option>
                                      <option value="male"><?php echo $language['register_man']; ?></option>
                                      <option value="female"><?php echo $language['register_woman']; ?></option>
                                      <option value="gender"><?php echo $language['register_man_wom']; ?></option>
                                </select>
                            </div>
                        </div>
            </div>
            <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo $language['register_phone']; ?></label>
                        <div class="col-md-4 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                <input name="phone" placeholder="(845)555-1212" class="form-control" value="<?php if(isset($_POST['phone'])){echo htmlentities($_POST['phone'], ENT_QUOTES, 'UTF-8');} ?>" type="text">
                            </div>
                        </div>
            </div>
            <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo $language['register_adress']; ?></label>
                        <div class="col-md-4 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                                <input name="address" placeholder="Address" class="form-control" value="<?php if(isset($_POST['address'])){echo htmlentities($_POST['address'], ENT_QUOTES, 'UTF-8');} ?>" type="text">
                            </div>
                        </div>
            </div>
            <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo $language['register_town']; ?></label>
                        <div class="col-md-4 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                                <input name="city" placeholder="city" class="form-control" value="<?php if(isset($_POST['city'])){echo htmlentities($_POST['city'], ENT_QUOTES, 'UTF-8');} ?>" type="text">
                            </div>
                        </div>
            </div>
            <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo $language['register_land']; ?></label>
                        <div class="col-md-4 selectContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                <select name="land" class="form-control selectpicker">
                                      <?php include('town.php'); ?>
                                </select>
                            </div>
                        </div>
            </div>
            <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo $language['register_plz']; ?></label>
                        <div class="col-md-4 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                                <input name="townnumber" id="go" placeholder="Postleitzahl" class="form-control" value="<?php if(isset($_POST['townnumber'])){echo htmlentities($_POST['townnumber'], ENT_QUOTES, 'UTF-8');} ?>" type="text">
                                <select id="testwiese" class="form-control selectpicker"><option value="'.$town.'">Suche ...</option></select>
                            </div>
                        </div>
            </div>
                    <script>
                        selectionChange = function() {
                            var elStatePage = document.getElementById('go');
                            elStatePage.value = this.value;
                        }
                        var e = document.getElementById('testwiese');
                        e.onchange = selectionChange;
                        $('#go').keyup(function() {
                            var townnumber = $('#go').val();

                            var was = townnumber.length;
                            if (was >= 3) {
                                console.log(townnumber);
                                $.ajax({
                                    type: 'POST',
                                    url: 'postleitzahlen.php',
                                    data: {
                                        townnumber: townnumber
                                    },
                                    success: function(data) {
                                        document.getElementById('testwiese').innerHTML = data;
                                    }
                                });
                            }
                        });
                    </script>
            <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo $language['register_comment']; ?></label>
                        <div class="col-md-4 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                                <textarea class="form-control" name="comment" placeholder="Project Description">
                                     <?php if(isset($_POST['comment'])){echo htmlentities($_POST['comment'], ENT_QUOTES, 'UTF-8');} ?>   
                                </textarea>
                            </div>
                        </div>
            </div>
                    <?php
                    if($captcha_aktiv=='true'){
                    ?>
            <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo $language['captcha_input']; ?></label>
                        <div class="col-md-4 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                                <img src="captcha/captcha.php?RELOAD=" alt="Captcha" title="Klicken, um das Captcha neu zu laden" onclick="this.src+=1;document.getElementById('captcha_code').value='';" style="width:140px;height:40px">                    
                                <input autocomplete="off" name="captcha_code" id="captcha_code" placeholder="" class="form-control" value="" type="text">
                           </div>
                        </div>
            </div>        
                    <?php
                    }
                    if($datenschutz_read=='true'){
                    ?>
            <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4 inputGroupContainer">
                            <div class="input-group">
                               <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign"></i><?php echo $language['data_text']; ?>
                                    <input name="data_checkbox" id="data_checkbox" type="checkbox"> <a class="links" href="datenschutz.php"><?php echo $language['data_link_text']; ?></a>
                               </span>
                            </div>
                        </div>
            </div>        
                    <?php
                    }
                    ?>
            <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4">
                            <button type="submit" name="send" class="btn btn-warning"><?php echo $language['register_send']; ?><span class="glyphicon glyphicon-send"></span></button>
                        </div>
            </div>
            <span class="small"><?php echo $language['register_text']; ?></span>
        </fieldset>
        <br>
    </form>
</div>
<?php
include('tamplate/footer.php');
?>
</body>
<?php
if($sweetout==true){
     echo $scripte;
}
?>
</html>
<?php
}
?>