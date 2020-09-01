<?php
include('setup-language.php');
$pfad=$_SERVER['PHP_SELF'];
$HOST=$_SERVER['HTTP_HOST'];
$pfad=explode('/',$pfad);
$count_ordner=count($pfad)-1;
for($f=0;$f<$count_ordner;$f++){
    $HOST.=$pfad[$f].'/';
}
$filename3='mysql.php';
if(!file_exists($filename3)) {
   echo $setup[0]."<br>";
   $filename1 = 'setupdatei.php';
   if (file_exists($filename1)) {
       echo $setuo[1]."<br>";
   }else{
       echo $setuo[2]."<br>";
   }
   exit;
} else {
?>
<div id="setupcontainer">
<h1><?php echo $setup[3]; ?></h1>
<p><?php echo $setup[4]; ?></p>
<img src="install/setup.png" style="height:300px"><br>
<p><?php echo $setup[5]; ?></p>
<img src="install/register.png" style="height:300px"><br>
<p><?php echo $setup[26]; ?></p>
<img src="install/admin.png" style="height:300px"><br>
<p><?php echo $setup[23]; ?></p>
<img src="install/profil.png" style="height:300px"><br>
<p><?php echo $setup[25]; ?></p>

</div>
<form id="install" name="eingabe" action="install/setupdatei.php" method="post">   
     <h1><?php echo $setup[7]; ?></h1>
     <label>
          <p><?php echo $setup[8]; ?></p>
          <input type="text" id="dbhost" name="dbhost" class="input_feld">
     </label> 
     <label>
          <p><?php echo $setup[9]; ?> </p>
          <input type="text" id="dbname" name="dbname" class="input_feld">
     </label> 
     <label>
          <p><?php echo $setup[10]; ?></p>
          <input type="text" id="dbuser" name="dbuser" class="input_feld">
     </label> 
     <label>
          <p><?php echo $setup[11]; ?></p>
          <input type="text" id="name_tabelle" name="name_tabelle" value="users" class="input_feld">
     </label> 
     <label>
          <p><?php echo $setup[12]; ?> </p>
          <input type="text" id="dbpw" name="dbpw"  class="input_feld">
     </label> 
     <label>
          <p><?php echo $setup[13]; ?></p>
          <input  type="text" id="pw_link"  class="input_feld input_feld_info" name="pw_link" value="<?php echo $HOST; ?>">
          <div class="info">[?]
              <span class="infotext"><?php echo $setup[14]; ?>
              </span>
          </div>
     </label>
  <!--
     <label>
         <p><?php echo $setup[15]; ?></p>
         <input type="checkbox" name="kill" value="kill"> 
              <div class="info">[?]
                  <span class="infotext"><?php echo $setup[16]; ?>
                  </span>
              </div>
     </label>
     <label>
          <p><?php echo $setup[17]; ?></p>
          <input type="checkbox" name="kill_bild" value="kill_bild">  
          <div class="info">[?]
              <span class="infotext">
                 <?php echo $setup[18]; ?>
              </span>
          </div>
     </label>
  -->
  <label>
        <input type="submit" class="buttonstyle" value="Setup Starten">
  </label>
    <!--
  <small><?php echo $setup[20]; ?></small>
-->
  <h5><?php echo $setup[19]; ?></h5>
</form>
<?php
}
?>
