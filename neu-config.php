<?php
if(!isset($_SESSION)){ 
        session_start(); 
} 
$header='';
include('mysql.php');

$r=0;
$sql = "SELECT * FROM login_system_config";
foreach ($mysql->query($sql) as $row) {
   $r++;
   if($r==$row['id']){
      $id[$r]=$row['wert'];
   } 
}

if($id[1]==true){
    error_reporting(E_ALL); 
    ini_set('display_errors', true);
}

if($id[1]==true){
// file erstellen
}

if($id[3]!=''){
$nach_login=$id[3];// nach login umleiten nach ( url )
$nach_login_text=$id[4];
}

$admin_name=$id[5];
$admin_pw=$id[6];
$speak_file=$id[7];




$sendetext=$id[8];




$absender   = $id[9];
if($id[10]==true){
    $header .= "From: $absender\r\n";
}
$antwortan  = $id[11];
if($id[12]==true){
    $header .= "Reply-To: $antwortan\r\n";
}
$header.=$id[13];





$betreff    = $id[14];
$favicons=$id[16];
$baselink=$id[15];


if(!empty($speak_file)){
include($speak_file);
}else{
include('language/german.txt');
}



    
?>