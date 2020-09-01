<?php
include('../mysql.php');
$sql = file_get_contents('login_system_config.sql');
$count = $mysql->exec($sql);
echo "<div class='error'>Datenbank Config wurde erstellt</div><br>";
?>