<!DOCTYPE html>

<html lang="de">

  <head>

    <meta charset="utf-8">

    <title><?php echo $setup[21]; ?></title>

    <link href="../style.css" rel="stylesheet">

  </head>

  <body>

<?php









include('../install/setup-language.php');

function setup(){

   if(empty($_POST['dbhost']) OR empty($_POST['dbpw']) OR  empty($_POST['dbname']) OR  empty($_POST['dbuser']) OR empty($_POST['pw_link']) OR empty($_POST['name_tabelle'])){

      echo "<div class='error'>Bitte fülle alle Felder aus</div>";

      echo "<a href='javascript:history.back()'>Zurück</a>";

   }else{

      $zeile='<?php $pwlink="'.$_POST['pw_link'].'"; $tabelle="'.$_POST['name_tabelle'].'";try{$mysql = new PDO("mysql:host='.$_POST['dbhost'].';dbname='.$_POST['dbname'].'", "'.$_POST['dbuser'].'", "'.$_POST['dbpw'].'");$mysql->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );}catch (PDOException $e){echo "SQL Error: ".$e->getMessage();}?>';

      file_put_contents("../mysql.php", $zeile);

      include('../mysql.php');

      try{

         $query="CREATE TABLE `$tabelle`(

         `id` int(20) unsigned NOT NULL AUTO_INCREMENT,

         `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,

         `user` varchar(20) COLLATE utf8_unicode_ci NOT NULL,

         `pass` varchar(250) COLLATE utf8_unicode_ci NOT NULL,

         `comment` varchar(2250) COLLATE utf8_unicode_ci NOT NULL,

         `townnumber` varchar(250) COLLATE utf8_unicode_ci NOT NULL,

         `land` varchar(250) COLLATE utf8_unicode_ci NOT NULL,

         `nachname` varchar(250) COLLATE utf8_unicode_ci NOT NULL,

         `phone` varchar(250) COLLATE utf8_unicode_ci NOT NULL,

         `address` varchar(250) COLLATE utf8_unicode_ci NOT NULL,

         `city` varchar(250) COLLATE utf8_unicode_ci NOT NULL,

         `geschlecht` varchar(250) COLLATE utf8_unicode_ci NOT NULL,

         `identifier` varchar(255) COLLATE utf8_unicode_ci NOT NULL,

         `securitytoken` varchar(255) COLLATE utf8_unicode_ci NOT NULL,

         `token` varchar(250) COLLATE utf8_unicode_ci NOT NULL,

         `regkey` varchar(100) COLLATE utf8_unicode_ci NOT NULL,         

         `sid` varchar(100) COLLATE utf8_unicode_ci NOT NULL,         

         `ip` varchar(100) COLLATE utf8_unicode_ci NOT NULL,        

         `active` varchar(10) COLLATE utf8_unicode_ci NOT NULL,                

         `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,

          PRIMARY KEY (`id`)

         ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";



           $mysql->exec($query);

           echo "<div class='succes'>$tabelle Tabelle wurde erstellt</div>";

           include('install-plz.php');

                      include('install-config.php');

           $eins=true;

      } catch(PDOException $e) {

           echo $e->getMessage();

           $eins=false;

           echo "<div class='error'>Fehler beim erstellen der Tabelle  $tabelle  </div>";

      }

      $filename2 = 'mysql.php';

      if (file_exists($filename2) AND $eins==true){

          if(isset($_POST['kill'])){

              //unlink('setupdatein.php');

              //unlink('install.php');

              echo "<div class='succes'>Setup Datein wurden gelöscht</div>";

          }

          if(isset($_POST['kill_bild'])){

              //unlink('accound.png');

              //unlink('setup.png');

              //unlink('anmeldung.png');

              echo "<div class='succes'>Setup Bilder Datein wurden gelöscht</div>";

          }

      }else{

           if(isset($_POST['kill'])){

               echo "<div class='error'>Setupdatein wurde nicht gelöscht</div>";

           }

           if(isset($_POST['kill_bild'])){

               echo "<div class='error'>Bilder aus Setup wurde nicht gelöscht</div>";

           }

      }

      echo "<a href='../admin_system.php'>Gehe jetzt zum Admin-config um alle anderen Einstellungen einzustellen</a><br>";

      echo "<a href='../register.php'>Zum registrieren</a><br><a href='../index.php'>Zum einloggen</a>";

   }

}

if(isset($_POST['dbpw'])){

   setup();

}

?> 

 

</body>

</html>

