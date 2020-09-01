<?php
if(isset($_POST['townnumber'])){ 
    $ausgabe='';
    include('mysql.php');
 
     $stmt = $mysql->prepare("SELECT * FROM `PLZ` WHERE `PLZ` LIKE ?");
 
 
$params = array("%".$_POST['townnumber']."%");
 
$stmt->execute($params);
        $count = $stmt->rowCount();
    
    
    if($count != 0){
      
      
         foreach ($stmt as $row) {
              $town=htmlspecialchars($row['Ort']);
              echo '<option value="'.$row['PLZ'].'">'.$town.' ('.$row['PLZ'].'</option>';
         }
    }else{
         echo '<option>Kein Treffeer</option>';
    }
}else{
    echo "ERROR";
}
?>
















