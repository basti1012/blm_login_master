<?php
if(!isset($register_email_ok) AND empty($_GET)){
     $hackingout=1;  
    include('hacking.php');
    exit;
}
$scripte='';
if($register_email_ok==true){
     $scripte.="<style>
     .sweet-alert p {
         color: orange !important;
         font-weight:900 !important;
     }
     </style>";     
     $registerlink="<a href='".$pwlink."email-to-register.php?regkey=$regkey&sid=$sid&id=$id' target='_blank'>".$language['active_your_accound_email_link']."</a>";     
     $sendetext_register = str_replace('{registerlink}',$registerlink,$sendetext_register);         
     mail($_POST["email"], $betreff_register, $sendetext_register,$header);
     $scripte.="<script>
                  setTimeout(function(){
                       swal('".$language['atension']."', '".$language['info_register_email']."', 'success');
                  },200);
                </script>";
} 
if(isset($_GET['regkey']) AND isset($_GET['sid']) AND isset($_GET['id'])){
    include('config.php');
    echo "<html>
           <head>
              <title>".$language['title_register_email_back']."</title>
                      <style>
                         .sweet-alert p {
                             color: orange !important;
                             font-weight:900 !important;
                         }
                      </style>";
                      include('tamplate/header.php');
     echo "</head>
           <body id='emailaktivieren'>";
     include('tamplate/nav.php');
     $regkey = $_GET['regkey'];
     $sid = $_GET['sid'];
     $id = $_GET['id'];
     $stmt = $mysql->prepare("SELECT * FROM `$tabelle` WHERE id = :id");
     $stmt->bindParam(":id", $id);
     $stmt->execute();
     $count = $stmt->rowCount();
     if($count == 0){
          echo "<div class='alert alert-danger' role='alert'>
                <span class='glyphicon glyphicon-removing' aria-hidden='true'></span>
                <span class='sr-only'>Error:</span>
                ".$language['rigister_email_no_id']."
          </div>"; 
     }else{
          $stmt = $mysql->prepare("SELECT * FROM `$tabelle` WHERE id = :id AND active='no'");
          $stmt->bindParam(":id", $id);
          $stmt->execute();
          $count = $stmt->rowCount();
          if($count == 0){
         
                  echo "<div class='alert alert-danger' role='alert'>
                     <span class='glyphicon glyphicon-removing' aria-hidden='true'></span>
                     <span class='sr-only'>Error:</span>
                     ".$language['rigister_email_active_ok']."
                    </div>";
             
          }else{
              $ausgabe= $stmt->fetch();
              if($ausgabe['sid']==$sid){
                  if($ausgabe['regkey']==$regkey){                     
                     $sql = "UPDATE $tabelle SET sid=?, regkey=?,active=? WHERE id=?";
                     $stmt= $mysql->prepare($sql);
                     $stmt->execute([0, 0,'yes', $id]);     
                   
                     echo "<script>
                        setTimeout(function(){
                           swal('Super !!', '".$language['accound_is_free']."', 'success');
                        },200);
                         </script>";
                  }
              }
          }
     }
?>
</body>
</html>
<?php
}else{
        if(!isset($register_email_ok)){
            echo "<div class='alert alert-danger' role='alert'>
            <span class='glyphicon glyphicon-removing' aria-hidden='true'></span>
            <span class='sr-only'>Error:</span>
            ".$language['error_regkey']."
            </div>";
            echo "<script>
                 setTimeout(function(){
                    swal('Error !!', '".$language['error_regkey']."', 'error');
                 },200);
                 </script>";
       }
}  
?>