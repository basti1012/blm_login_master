<?php
include('config.php');
?>
<?php
if(isset($you_logged_in) AND $you_logged_in==true){
}else{
    $error_out=$language['profil_you_must_login'];
    include('error_page.php');
    exit;
}
$sms='';
$nopw=false;
$hack=false;
$plicht1=false;
$plicht2=false;
$error=false;
if(isset($you_logged_in) AND $you_logged_in==true){
    if(isset($_POST['send'])){
        if($_POST['username']==$you_logged_in){
            if(!empty($_POST['password'])){
                if(isset($_POST['password'])){
                    if(isset($_POST['passverif'])){
                        if($_POST['password']==$_POST['passverif']){
                            if(strlen($_POST['password'])>=4){
                                 $plicht1=true;
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
                  $nopw=true;
                  $error=false;
            }     
        }else{
            $hack=true;
            $sms.=$language['hack'].'<br>';
        }
        if(isset($_POST['email'])){
            if(preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',$_POST['email'])){
                $plicht1=true;
            }else{
                $sms.=$language['email_not_valide'].'<br>';
                $error=true;
            }   
        }else{
            $sms.=$language['email_is_empty'].'<br>';
            $error=true;
        }   
        if($plicht1==true){
            if(get_magic_quotes_gpc()){
                $_POST['username'] = stripslashes($_POST['username']);
                $_POST['password'] = stripslashes($_POST['password']);
                $_POST['passverif'] = stripslashes($_POST['passverif']);
                $_POST['email'] = stripslashes($_POST['email']);
            }            
        }else{
            $sms.=$language['is_inputs_empty'].'<br>';
            $error=true;
        }
        $stmt = $mysql->prepare("SELECT * FROM `$tabelle` WHERE user = :user"); //Username überprüfen
        $stmt->bindParam(":user", $_POST["username"]);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count == 0){
            $error=true; 
            $hack=true;
            $sms.=$language['user_name_givet_not'].'<br>';
        }else{
            echo "'.$error.' Error";
            if($error==false){    
                $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
                if($nopw==true){
                    $data = [
                    'name' => $_POST['username'],
                    'email' => $_POST['email'],
                    'comment'=>$_POST['comment'],
                    'townnumber'=>$_POST['townnumber'],
                    'land'=>$_POST['land'],
                    'nachname'=>$_POST['nachname'],
                    'phone'=>$_POST['phone'],
                    'address'=>$_POST['address'],
                    'city'=>$_POST['city'],
                    'geschlecht'=>$_POST['geschlecht'],
                    'user' => $_POST['username']];

                       $sql = "UPDATE $tabelle SET 
                       user=:name,
                       email=:email,
                       comment=:comment,
                       townnumber=:townnumber,
                       land=:land,
                       nachname=:nachname,
                       phone=:phone,
                       address=:address,
                       city=:city,
                       geschlecht=:geschlecht
                       WHERE user=:user";
                }else{
                      $data = [
                      'name' => $_POST['username'],
                      'email' => $_POST['email'],
                      'password' => $hash,
                      'comment'=>$_POST['comment'],
                      'townnumber'=>$_POST['townnumber'],
                      'land'=>$_POST['land'],
                      'nachname'=>$_POST['nachname'],
                      'phone'=>$_POST['phone'],
                      'address'=>$_POST['address'],
                      'city'=>$_POST['city'],
                      'geschlecht'=>$_POST['geschlecht'],
                      'user' => $_POST['username']];

                       $sql = "UPDATE $tabelle SET 
                       user=:name,
                       email=:email,
                       pass=:password,
                       comment=:comment,
                       townnumber=:townnumber,
                       land=:land,
                       nachname=:nachname,
                       phone=:phone,
                       address=:address,
                       city=:city,
                       geschlecht=:geschlecht
                       WHERE user=:user";
               }
//print_r($data);
               $stmt= $mysql->prepare($sql);
               $stmt->execute($data);
               echo "".$language['user_data_new']." ".$_POST['username']." ".$language['is_changed']."";
               echo "<div class='alert alert-success' role='alert'>
                  <span class='glyphicon glyphicon-ok' aria-hidden='true'></span>
                  <span class='sr-only'>Ok:</span>
                  ".$language['prfil_update_ok']."
                  </div>";
            }else{
               $form = true;
               $sms.=$language['sometimes_errror'];
            }
        }   
     }else{
        //$sms.=$language['more_errors'];
       // echo "No request";
     }
}else{
   //echo "NIcht eingeloggt";
}
if($hack==true){

   $hackingout=2;
   include('hacking.php');
   exit;
}
?>
<!doctype html>
<html lang="de">
<head>
<?php
include('tamplate/header.php');
?>
<title>
<?php 
if(isset($you_logged_in) AND $you_logged_in==true){
    echo $language['title_profil']." ".$you_logged_in_name;
}else{
    echo $language['title_profil_no_login'];
}
?>
</title>
</head>
<body id="profil_pages">
<?php
$profil_page=true;
include('tamplate/nav.php');
if(isset($you_logged_in) AND $you_logged_in==true){
   $user =  $you_logged_in_name;
   $statement = $mysql->prepare("SELECT * FROM $tabelle WHERE user = :user");
   $result = $statement->execute(array('user' => $user));
   $dnn = $statement->fetch();
?>
<form class="well form-horizontal" action="profil.php" method="post"  id="contact_form">
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
<h1><?php echo $language['form_profil_from']; ?> <?php echo $user; ?></h1>
<label><?php echo $language['profil_registri_time']; ?> <?php echo $dnn['created_at']; ?> </label>  
<div class="form-group">
  <label class="col-md-4 control-label"><?php echo $language['new_username']; ?> *</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>  
  <input type="hidden" name="username" value="<?php echo htmlentities($dnn['user']); ?>">
 <input type="text" placeholder="<?php echo $language['placeholder_firstname']; ?>" class="form-control"  name="username" value="<?php echo htmlentities($dnn['user']); ?>" disabled>  
    </div>
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label" ><?php echo $language['profil_zwoname']; ?></label> 
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  <input type="text" placeholder="<?php echo $language['placeholder_zwoname']; ?>" class="form-control"  name="nachname" value="<?php echo htmlentities($dnn['nachname']); ?>" />  
    </div>
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label" ><?php echo $language['placeholder_password']; ?> *</label> 
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
  <input autocomplete="off" type="password" placeholder="<?php echo $language['placeholder_password']; ?>" class="form-control"  name="password" value="" />  
    </div>
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label" ><?php echo $language['pw_two']; ?> *</label> 
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
  <input autocomplete="off" type="password" placeholder="<?php echo $language['placeholder_pw_two']; ?>" class="form-control"  name="passverif"  value="" />  
    </div>
  </div>
</div>
 <div class="form-group">
  <label class="col-md-4 control-label"><?php echo $language['profil_email']; ?>*</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
  <input autocomplete="off" name="email" placeholder="<?php echo $language['placeholder_email']; ?>" class="form-control"  value="<?php echo htmlentities($dnn['email'], ENT_QUOTES, 'UTF-8'); ?>" type="text">
    </div>
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label"><?php echo $language['profil_gender']; ?></label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><img id="geschlecht" src='images/<?php echo htmlentities($dnn['geschlecht']); ?>.jpg'></span>
  <select name="geschlecht" class="form-control">
  <option><?php echo htmlentities($dnn['geschlecht']); ?></option>
  <option value="male"><?php echo $language['profil_gender_male']; ?></option>
  <option value="female"><?php echo $language['profil_gender_female']; ?></option>
  <option value="gender"><?php echo $language['profil_gender_gender']; ?></option>
  </select>
    </div>
</div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label"> <?php echo $language['profil_phone']; ?> </label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
  <input name="phone" placeholder="<?php echo $language['placeholder_phone']; ?>" class="form-control" value="<?php echo htmlentities($dnn['phone']); ?>" type="text">
    </div>
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label"><?php echo $language['profil_adress']; ?></label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
  <input name="address" placeholder="<?php echo $language['placeholder_adress']; ?>" class="form-control" value=" <?php echo htmlentities($dnn['address']); ?>" type="text">
    </div>
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label"><?php echo $language['profil_town']; ?></label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
  <input name="city" placeholder="<?php echo $language['placeholder_town']; ?>" class="form-control" value="<?php echo htmlentities($dnn['city']); ?>" type="text">
    </div>
  </div>
</div>
<div class="form-group"> 
  <label class="col-md-4 control-label"><?php echo $language['profil_land']; ?></label>
    <div class="col-md-4 selectContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
        <select name="land" class="form-control selectpicker" >
              <option value="<?php echo htmlentities($dnn['land']); ?>"><?php echo htmlentities($dnn['land']); ?></option>
              <?php include('town.php'); ?>
        </select>
  </div>
</div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label"><?php echo $language['profil_plz']; ?></label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
  <input name="townnumber" id="go" placeholder="<?php echo $language['placeholder_plz']; ?>" class="form-control" value="<?php echo htmlentities($dnn['townnumber']); ?>" type="text">
  <select id="testwiese"  class="form-control selectpicker" ><option value="'.$town.'">Suche ...</option></select>
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
$('#go').keyup(function(){
    var townnumber=$('#go').val();
    var was=townnumber.length;
    if(was>=3){
         console.log(townnumber);
                $.ajax({
                      type: 'POST',
                      url: 'postleitzahlen.php',
                      data: {townnumber:townnumber},
                      success: function(data){ 
                    document.getElementById('testwiese').innerHTML=data;
                      }
                });
    }
});
</script>
<div class="form-group">
  <label class="col-md-4 control-label"><?php echo $language['profil_text']; ?></label>
    <div class="col-md-4 inputGroupContainer">
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
            <textarea class="form-control" name="comment" placeholder="<?php echo $language['placeholder_profil_text']; ?>">
                 <?php echo htmlentities($dnn['comment']); ?>   
            </textarea>
      </div>  
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4">
    <button type="submit" name="send" class="btn btn-warning" ><?php echo $language['submit_profil']; ?> <span class="glyphicon glyphicon-send"></span></button>
  </div>
</div>
</fieldset>
</form>
<?php
}else{ 
?>
</div></div>
<?php
}
 
    if(isset($footer_aktive) AND $footer_aktive=='true'){
     include('tamplate/footer.php');
}
?>
</body>
</html>