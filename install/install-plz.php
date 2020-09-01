<?php
include('../mysql.php');
$sql = file_get_contents('postleitzahlen.sql');
$count = $mysql->exec($sql);
echo "<div class='error'>Datenbank PLZ wurde erstellt</div><br>";
?>