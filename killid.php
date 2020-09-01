<?php
if(isset($_POST)){
      if(isset($_POST['kill']) AND $_POST['kill']=='kill' AND isset($_POST['id'])){
             include('config.php');
             $stmt = $mysql->prepare("DELETE FROM $tabelle WHERE id=:id");
             $stmt->bindParam(":id",$_POST['id']);
             $stmt->execute();
              echo  $language['admin_user_delete_user']." ".$_POST['id']."";    
      }else{
          $error_out=$language['no_hacking'];
          include('hacking.php');
      }
}else{
    $error_out=$language['no_open_this_site'];
    include('error_page.php');
}
?>