<?php
include('config.php');
?>
<!doctype html>
<html lang="de">
<head>
<?php
    include('tamplate/header.php');
?>
<title>
<?php 

   
   
   
   
   
/*
   register_emal_box
   register_email_betreff
   register_email_text
*/


if(isset($admin_logged_in) AND $admin_logged_in==true){
    echo $language['title_admin'];
}else{
    echo $language['title_admin_no_login'];
}
?>
</title>
</head>
<body id="adminsystem">
<?php
$admin2_page=true;
$logout_page_admin=true;
include('tamplate/nav.php');
$weiter=false;
$infok='';
$infno='';
if(isset($_POST['admin_pass']) and isset($_POST['admin_name'])){
   $admin_pw_form=$_POST['admin_pass'];
   $admin_name_form=$_POST['admin_name'];
}else{
   $admin_pw_form='';
   $admin_name_form='';
}
$r=0;
$sql = "SELECT * FROM login_system_config";
foreach ($mysql->query($sql) as $row) {
   $r++;
   if($r==$row['id']){
      $id[$r]=$row['wert'];
   } 
}
$gesammt=$r;
if(isset($admin_logged_in_name)==$id[5]){
       $weiter=true;
        $infok.="<div class='alert alert-success' role='alert'>
                 <span class='glyphicon glyphicon-ok' aria-hidden='true'></span>
                 <span class='sr-only'>Ok:</span> ".$language['admin_session_ok']." </div>";
       $z=0;
       if(isset($_POST['error_report'])){
             $a1='true';
             $z++;
       }else{
            $a1='false';
            $z++;
       }
       if(isset($_POST['error_report_file'])){
             $a2='true';
             $z++;
       }else{
            $a2='false';
            $z++;
       }
       if(isset($_POST['secret_link'])){
             $a3=$_POST['secret_link'];
             $z++;
       }else{
            $a3=false;
       }
       if(isset($_POST['secret_name'])){
             $a4=$_POST['secret_name'];
             $z++;
       }else{
            $a4=false;
       }
       if(isset($_POST['admin_name'])){
             $a5=$_POST['admin_name'];
             $z++;
       }else{
              $a5=false;
       }
       if(isset($_POST['admin_pw'])){
            if(!empty($_POST['admin_pw'])){
 
                $a6=password_hash($_POST['admin_pw'], PASSWORD_DEFAULT);
                $z++;
            }else{
                $a6=false;
                $z++;
            }
      }else{
              $a6=false;
      }
      if(isset($_POST['language_file'])){
                $a7=$_POST['language_file'];
                $z++;
      }else{
              $a7=false;
      }
      if(isset($_POST['email_text'])){
              $a8=$_POST['email_text'];
              $z++;
      }else{
              $a8=false;
      }
      if(isset($_POST['sent_email'])){
              $a9=$_POST['sent_email'];
              $z++;
      }else{
              $a9=false;
      }
      if(isset($_POST['sent_to_header'])){
              $a10='true';
              $z++;
      }else{
              $a10='false';
              $z++;
      }
      if(isset($_POST['antwort_email'])){
              $a11=$_POST['antwort_email'];
              $z++;
      }else{
              $a11=false;
      }    
      if(isset($_POST['replay_to_header'])){
              $a12='true';
              $z++;
      }else{
              $a12='false';
              $z++;
      }
      if(isset($_POST['email_header'])){
              $a13=$_POST['email_header'];
              $z++;
      }else{
              $a13=false;
      }
      if(isset($_POST['email_betreff'])){
              $a14=$_POST['email_betreff'];
              $z++;
      }else{
              $a14=false;
      }
      if(isset($_POST['baseline'])){
              $a15=$_POST['baseline'];
              $z++;
      }else{
              $a15=false;
              $z++;
      }
      if(isset($_POST['favicon'])){
              $a16='true';
              $z++;
      }else{
              $a16='false';
      }
      
      if(isset($_POST['captcha_checkbox'])){
            $a17='true';
            $z++;
      }else{
            $a17='false';
            $z++;
      }
      if(isset($_POST['datenschutz_checkbox'])){
            $a19='true';
            $z++;
      }else{
            $a19='false';
            $z++;
      }
      if(isset($_POST['datenschutz_text'])){
             $a18=$_POST['datenschutz_text'];
             $z++;
      }else{
            $a18=false;
      }
      if(isset($_POST['logout_time_checkbox'])){
            $a20='true';
            $z++;
       }else{
            $a20='false';
            $z++;
       }
      
       if(isset($_POST['logout_time'])){
             $a21=$_POST['logout_time'];
             $z++;
       }else{
            $a21=false;
       }
       if(isset($_POST['hosting_scripte'])){
            $a22='true';
            $z++;
       }else{
            $a22='false';
            $z++;
       }
       
       if(isset($_POST['register_emal_box'])){
            $a23='true';
            $z++;
       }else{
            $a23='false';
            $z++;
       }
       
              if(isset($_POST['register_email_betreff'])){
             $a24=$_POST['register_email_betreff'];
             $z++;
       }else{
            $a24=false;
       }
       
       
              if(isset($_POST['register_email_text'])){
             $a25=$_POST['register_email_text'];
             $z++;
       }else{
            $a25=false;
       }
          
   
   
       
       
       
       
       
       
       
 //echo $z.'='.$gesammt;
 if($z==$gesammt){
       for($r=1;$r<=$gesammt;$r++){
           $insert = $mysql->prepare("UPDATE `login_system_config` SET `wert` = :wert WHERE `id` = '$r'");
          if($r==1){   
               $result = $insert->execute(array('wert' => $a1));
          }
          if($r==2){   
               $result = $insert->execute(array('wert' => $a2));
          }        
          if($r==3){   
               $result = $insert->execute(array('wert' => $a3));
          }     
          if($r==4){   
               $result = $insert->execute(array('wert' => $a4));
          } 
          if($r==5){   
               $result = $insert->execute(array('wert' => $a5));
          }
          if($r==6){   
               if($a6!=false){
                    $result = $insert->execute(array('wert' => $a6));
               }else{
               $error=true;
               }
          }
          if($r==7){  
                  $result = $insert->execute(array('wert' => $a7));
          }
          if($r==8){   
               $result = $insert->execute(array('wert' => $a8));
          }
          if($r==9){   
               $result = $insert->execute(array('wert' => $a9));
          }
          if($r==10){   
               $result = $insert->execute(array('wert' => $a10));
          }
          if($r==11){   
               $result = $insert->execute(array('wert' => $a11));
          }
          if($r==12){   
               $result = $insert->execute(array('wert' => $a12));
          }
          if($r==13){   
               $result = $insert->execute(array('wert' => $a13));
          }
          if($r==14){   
               $result = $insert->execute(array('wert' => $a14));
          }
          if($r==15){   
               $result = $insert->execute(array('wert' => $a15));
          }
          if($r==16){   
               $result = $insert->execute(array('wert' => $a16));
          }
           if($r==17){   
               $result = $insert->execute(array('wert' => $a17));
          }
          if($r==18){   
               $result = $insert->execute(array('wert' => $a18));
          }
          if($r==19){   
               $result = $insert->execute(array('wert' => $a19));
          }
          if($r==20){   
               $result = $insert->execute(array('wert' => $a20));
          }
          if($r==21){   
               $result = $insert->execute(array('wert' => $a21));
          } 
           if($r==22){   
               $result = $insert->execute(array('wert' => $a22));
          } 
          if($r==23){   
               $result = $insert->execute(array('wert' => $a23));
          }
          if($r==24){   
               $result = $insert->execute(array('wert' => $a24));
          } 
           if($r==25){   
               $result = $insert->execute(array('wert' => $a25));
          }           
          
          
          
          
          if(!isset($error)){
                 $result = $insert->execute();
          }

      //setcookie("identifier",$identifier,time()+(3600*24*365)); //1 Jahr Gültigkeit
      //setcookie("securitytoken",$neuer_securitytoken,time()+(3600*24*365)); //1 Jahr Gültigkeit
          $infok.="<div class='alert alert-success' role='alert'>
                   <span class='glyphicon glyphicon-ok' aria-hidden='true'></span>
                   <span class='sr-only'>Ok:</span>  ".$language['admin_files_save']." </div>";
     }
     echo "<script>location.href='admin_system.php';</script>";
 }
}else{
    if(isset($_POST['admin_pass']) and isset($_POST['admin_name'])){
         $weiter=false;
            if(password_verify($_POST['admin_pass'],$id[6])){
                 if($id[5]==$admin_name_form){
                     $_SESSION['username_admin']=$admin_name_form;
                     $weiter=true;
                     $infok.="<div class='alert alert-success' role='alert'>
                              <span class='glyphicon glyphicon-ok' aria-hidden='true'></span>
                              <span class='sr-only'>Ok:</span>  ".$language['admin_pw_ok']." </div>";
                 }else{
                     $weiter=false;
                     $infno.="<div class='alert alert-danger' role='alert'>
                              <span class='glyphicon glyphicon-removing' aria-hidden='true'></span>
                              <span class='sr-only'>Error:</span> ".$language['admin_pw_wrong']." </div>";
                 }
            }else{
                 $infno.="<div class='alert alert-danger' role='alert'>
                          <span class='glyphicon glyphicon-removing' aria-hidden='true'></span>
                          <span class='sr-only'>Error:</span> ".$language['admin_pw_wrong']." </div>";
            }
    }else{
         $weiter=false;
    }
} 
if(!isset($_SESSION['username_admin'])) {
?>
<form class="well form-horizontal" action="admin_system.php" method="POST"  id="contact_form">
    <h1><?php echo $language['admin_h1_text']; ?></h1>
    <?php
    if($infok!=''){
         echo $infok;
    }
    if($infno!=''){
         echo $infno;
    }
?>
   <fieldset>
    <div class="form-group">
       <label class="col-md-4 control-label"><?php echo $language['admin_nickname']; ?></label>  
       <div class="col-md-4 inputGroupContainer">
          <div class="input-group">
             <span class="input-group-addon">
                  <i class="glyphicon glyphicon-user"></i>
             </span>  
             <input type="text" placeholder="<?php echo $language['placeholder_admin_name']; ?>" class="form-control"  name="admin_name" value="" />  
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
              <input type="password" placeholder="<?php echo $language['placeholder_admin_pw']; ?>" class="form-control"  name="admin_pass" value="">  
          </div>
       </div>
   </div>
   <div class="form-group">
       <label class="col-md-4 control-label"></label>
       <div class="col-md-4">
         <button type="submit" name="send" class="btn btn-warning"> 
         <?php echo $language['admin_login_submit']; ?> 
         <span class="glyphicon glyphicon-send"></span>
         </button>
       </div>
   </div>
  </fieldset>
</form>
<?php   
}
if($weiter==true){   ?>
<form class="well form-horizontal" action="admin_system.php" method="POST">
<fieldset>
<div class="form-group">
<label class="col-md-4 control-label"><?php echo $language['admin_error_report']; ?></label> 
<div class="col-md-4">
<?php
 if($id[1]=='true'){
     $ifcheck='checked';
 }else{
     $ifcheck='';
 }
 ?>
<input type="checkbox" name="error_report" <?php echo $ifcheck; ?>>
           <div class="info">[?]
              <span class="infotext"><?php echo $language['admin_error_report_text']; ?>
              </span>
          </div>
 </div>
 </div>
  <div class="form-group">
  <label class="col-md-4 control-label"><?php echo $language['admin_error_report_file']; ?></label> 
  <div class="col-md-4">
  <?php
 if($id[2]=='true'){
     $ifcheck1='checked';
 }else{
     $ifcheck1='';
 }
 ?> 
<input type="checkbox" name="error_report_file" <?php echo $ifcheck1; ?>>
</div>
</div>
<?php
if(file_exists('php_error.log')){
?>
<div class="form-group">
<label class="col-md-4 control-label"></label> 
<div class="col-md-4">
<button type="button" id='zeige_error_log'><?php echo $language['admin_error_file_link']; ?></button>
</div>
</div>
<div id="result">
<div style='display:flex'><div id='close'>X</div><div id='kill'><?php echo $language['kill_link']; ?></div></div>
<div id="loghtml"></div>
</div>
<div id="background"></div>
<script>
$('#zeige_error_log').click(function(){
   function load_error(){
      $.ajax({
             method: "GET",
             url: "php_error.log",
      }).done(function( msg ) {    
             $('#background').css("display","block");
             $('#result').css("display","block");
             $('#loghtml').html(msg);
             $('#close').click(function(){
                 $('#result').css("display","none");
                 $('#background').css("display","none");
             })
             $('#kill').click(function(){
                 $.ajax({
                       method: "GET",
                       url: "kill.php",
                 }).done(function( msg ) {    
                       $('#loghtml').html('<?php echo $language['kill_success']; ?>');
                 });
             });
      });
   }
load_error()
});
$('#background').click(function(){
    $('#result').css("display","none");
    $('#background').css("display","none");
})
</script>
<?php
}
?>
<div class="form-group">
<label class="col-md-4 control-label"><?php echo $language['scripte_hosting_text']; ?></label> 
<div class="col-md-4">
<?php
 if($id[22]=='true'){
     $ifcheck22='checked';
 }else{
     $ifcheck22='';
 }
 ?> 
<div id="scripte_result">
<div id='close1'>X</div>
<div id="scriptetext">
<?php
include('tamplate/scripte.php');
$menge_js=count($links_hosting_js);
$menge_css=count($links_hosting_css);
$all=0;
for($r=0;$r<$menge_js;$r++){
    $name=explode('/',$links_hosting_js[$r]);
    $last=count($name);
    $name_new=$name[$last-1];
     echo $links_hosting_js[$r].'<br>';
}
for($r=0;$r<$menge_css;$r++){
    $name=explode('/',$links_hosting_css[$r]);
    $last=count($name);
    $name_new=$name[$last-1];
    echo $links_hosting_css[$r].'<br>';
}
?></div>
</div>
<input type="checkbox" name="hosting_scripte" <?php echo $ifcheck22; ?>>
           <div class="info">[?]
              <span class="infotext"><?php echo $language['scripte_hosting_text_hint']; ?>
              </span>
          </div>
<button type="button" id="show_scripte"><?php echo $language['show_scripte_button']; ?></button>
</div>
</div>
<script>
$('#show_scripte').click(function(){
       $('#scripte_result').css("display","block");
       $('#background').css("display","block");
})
$('#close1').click(function(){
        $('#scripte_result').css("display","none");
        $('#background').css("display","none");
})
</script>
 <div class="form-group">
     <label class="col-md-4 control-label"><?php echo $language['admin_secret_link']; ?></label> 
     <div class="col-md-4">
         <input type="text" placeholder="<?php echo $language['placeholder_secret_link']; ?>" name="secret_link" value="<?php if(isset($id[3])){echo $id[3]; } ?>">
     </div>
 </div>
 <div class="form-group">
     <label class="col-md-4 control-label"><?php echo $language['admin_secret_link_text']; ?></label> 
     <div class="col-md-4">
         <input type="text" placeholder="<?php echo $language['placeholder_secret_link_text']; ?>" name="secret_name" value="<?php if(isset($id[4])){echo $id[4]; } ?>">
     </div>
 </div>
 <div class="form-group">
     <label class="col-md-4 control-label"><?php echo $language['admin_Name']; ?></label> 
     <div class="col-md-4">
         <input type="text" placeholder="<?php echo $language['placeholder_admin_Name']; ?>" name="admin_name" value="<?php if(isset($id[5])){echo $id[5]; } ?>">
    </div>
 </div>
 <div class="form-group">
     <label class="col-md-4 control-label"><?php echo $language['admin_passwort']; ?></label> 
     <div class="col-md-4">
         <input type="text" placeholder="<?php echo $language['placeholder_admin_Name']; ?>" name="admin_pw" value="">
         <div class="info">[?]
              <span class="infotext"><?php echo $language['admin_hint_text']; ?> 
              </span>
         </div>
     </div>
 </div>
 <div class="form-group">
     <label class="col-md-4 control-label"><?php echo $language['admin_language_file']; ?></label> 
     <div class="col-md-4">
         <select placeholder="<?php echo $language['admin_placeholder_language_file']; ?>" name="language_file">
<option value="german.txt"><?php if(isset($id[7])){echo $id[7]; } ?></option>
<?php
$verzeichnis = openDir("language");
while ($file = readDir($verzeichnis)) {
 if ($file != "." && $file != "..") {
  echo "<option value=\"$file\">$file</option>";
 }
}
closeDir($verzeichnis);
?>
</select>
</div>
</div>
<div class="form-group">
<label class="col-md-4 control-label"><?php echo $language['admin_email_betreff']; ?></label> 
<div class="col-md-4">
<textarea name="email_betreff" placeholder="<?php echo $language['placeholder_admin_email_betreff']; ?>">
<?php if(isset($id[14])){echo $id[14]; } ?>
</textarea>
</div>
</div>
<div class="form-group">
<label class="col-md-4 control-label"><?php echo $language['admin_email_text']; ?></label> 
<div class="col-md-4">
<textarea name="email_text" placeholder="<?php echo $language['placeholder_admin_email_text']; ?>">
<?php if(isset($id[8])){echo $id[8]; } ?>
</textarea>
         <div class="info">[?]
              <span class="infotext"><?php echo $language['email_text_hint']; ?> 
              </span>
         </div>
</div>
</div>





<div class="form-group">
<label class="col-md-4 control-label"><?php echo $language['admin_email_sent_email']; ?></label> 
<div class="col-md-4">
<input type="text" name="sent_email" value="<?php if(isset($id[9])){echo $id[9]; } ?>" placeholder="<?php echo $language['admin_placeholder_email_sent_email']; ?>">
</div>
</div>
<div class="form-group">
<label class="col-md-4 control-label"><?php echo $language['admin_email_sent_email_checkbox']; ?></label> 
<div class="col-md-4">
  <?php
 if($id[10]=='true'){
     $ifcheck3='checked';
 }else{
     $ifcheck3='';
 }
 ?> 
<input type="checkbox" name="sent_to_header" <?php echo $ifcheck3; ?> >
</div>
</div>
<div class="form-group">
<label class="col-md-4 control-label"><?php echo $language['admin_email_antwort_email']; ?></label> 
<div class="col-md-4">
<input type="text" name="antwort_email" value="<?php if(isset($id[11])){echo $id[11]; } ?>" placeholder="<?php echo $language['admin_placeholder_email_antwort_email']; ?>">
</div>
</div>
<div class="form-group">
<label class="col-md-4 control-label"><?php echo $language['admin_email_antwort_email_checkbox']; ?></label> 
<div class="col-md-4">
  <?php
 if($id[12]=='true'){
     $ifcheck4='checked';
 }else{
     $ifcheck4='';
 }
 ?> 
 <input type="checkbox" name="replay_to_header" <?php echo $ifcheck4; ?> >
</div>
</div>
    <div class="form-group">
  <label class="col-md-4 control-label"><?php echo $language['capcha_admin_text']; ?></label> 
  <div class="col-md-4">
  <?php
 if($id[17]=='true'){
     $ifcheck18='checked';
 }else{
     $ifcheck18='';
 }
 ?> 
<input type="checkbox" name="captcha_checkbox" <?php echo $ifcheck18; ?>>
</div>
</div>
 <div class="form-group">
  <label class="col-md-4 control-label"><?php echo $language['datenschutz_checkbox']; ?></label> 
  <div class="col-md-4">
  <?php
 if($id[19]=='true'){
     $ifcheck7='checked';
 }else{
     $ifcheck7='';
 }
 ?> 
<input type="checkbox" name="datenschutz_checkbox" <?php echo $ifcheck7; ?>>
</div>
</div>
     <div class="form-group">
      <label class="col-md-4 control-label"><?php echo $language['datenschutz_textin']; ?></label> 
      <div class="col-md-4">
         <textarea name="datenschutz_text" style='height:100px' placeholder="">
            <?php if(isset($id[18])){echo $id[18]; } ?>
         </textarea>
         <div class="info">[?]
            <span class="infotext">
               <?php echo $language['datenschutz_hint']; ?>
            </span>
         </div>
     </div>
   </div>
   <div class="form-group">
      <label class="col-md-4 control-label"><?php echo $language['admin_baseline']; ?></label> 
      <div class="col-md-4">
         <input type="text" name="baseline" value="<?php if(isset($id[15])){echo $id[15]; } ?>" placeholder="<?php echo $language['admin_baseline_placeholder']; ?>">
   <div class="info">[?]
        <span class="infotext"><?php echo $language['admin_email_baseline_hint']; ?>
        </span>
   </div>
</div>
   </div>

    <div class="form-group">
      <label class="col-md-4 control-label"><?php echo $language['login_time_text']; ?></label> 
         <div class="col-md-4">
         <?php
        if($id[20]=='true'){
            $ifcheck6='checked';
        }else{
            $ifcheck6='';
        }
        ?> 
      <input type="checkbox" name="logout_time_checkbox" <?php echo $ifcheck6; ?> >
   </div>
   </div>
    <div class="form-group">
      <label class="col-md-4 control-label"><?php echo $language['time_in_seconds_to_logout']; ?></label> 
      <div class="col-md-4">
         <input type="text" name="logout_time" value="<?php if(isset($id[21])){echo $id[21]; } ?>" placeholder="300">
   <div class="info">[?]
        <span class="infotext"><?php echo $language['auto_logout_hint']; ?>
        </span>
   </div>
</div>
   </div>

   <div class="form-group">
      <label class="col-md-4 control-label"><?php echo $language['favicon_checkbox']; ?></label> 
         <div class="col-md-4">
         <?php
        if($id[16]=='true'){
            $ifcheck5='checked';
        }else{
            $ifcheck5='';
        }
        ?> 
      <input type="checkbox" name="favicon" <?php echo $ifcheck5; ?> >
   </div>
   </div>
   <div class="form-group">
      <label class="col-md-4 control-label"><?php echo $language['admin_email_header']; ?></label> 
      <div class="col-md-4">
         <textarea name="email_header" style='height:100px' placeholder="test<?php echo $language['admin_email_header_placeholder']; ?>">
            <?php if(isset($id[13])){echo $id[13]; } ?>
         </textarea>
         <div class="info">[?]
            <span class="infotext">
               <?php echo $language['admin_email_header_hint']; ?>
            </span>
         </div>
     </div>
   </div>
   
   
   
   
   
   
       <div class="form-group">
      <label class="col-md-4 control-label"><?php echo $language['regisdter_link_active']; ?></label> 
      <div class="col-md-4">
               <?php
        if($id[23]=='true'){
            $ifcheck51='checked';
        }else{
            $ifcheck51='';
        }
        ?> 
      <input type="checkbox" name="register_emal_box" <?php echo $ifcheck51; ?> >
   <div class="info">[?]
        <span class="infotext"><?php echo $language['email_register_hint']; ?>
        </span>
   </div>
</div>
   </div>
   
   <div class="form-group">
      <label class="col-md-4 control-label"><?php echo $language['register_email_betreff']; ?></label> 
      <div class="col-md-4">
         <input type="text" name="register_email_betreff" value="<?php if(isset($id[24])){echo $id[24]; } ?>" placeholder="<?php echo $language['admin_email_betreff_activ_placeholder']; ?>">
      </div>
   </div>
   
   
      <div class="form-group">
      <label class="col-md-4 control-label"><?php echo $language['register_email_text']; ?></label> 
      <div class="col-md-4">
         <textarea name="register_email_text" style='height:100px' placeholder="<?php echo $language['admin_email_text_activ_placeholder']; ?>">
            <?php if(isset($id[25])){echo $id[25]; } ?>
         </textarea>
     </div>
   </div>
   

   
   
   
   
   
   <input type="submit"  class="btn btn-warning" value="<?php echo $language['submit_admin']; ?>">
</div>
</div>
</fieldset>
</form>
<?php
}else{
    echo $language['no_admin_in'];
}
 
    if(isset($footer_aktive) AND $footer_aktive=='true'){
     include('tamplate/footer.php');
}
    ?>
</body>
</html>