<?php


include('scripte.php');


$menge_js=count($links_hosting_js);
$menge_css=count($links_hosting_css);
$all=0;
for($r=0;$r<$menge_js;$r++){
    $name=explode('/',$links_hosting_js[$r]);
    $last=count($name);
    $name_new=$name[$last-1];
    $html_js=file_get_contents($links_hosting_js[$r]);
    file_put_contents("hosting/$name_new",$html_js);
               echo "<div class='alert alert-success' role='alert'>
  <span class='glyphicon glyphicon-ok' aria-hidden='true'></span>
  <span class='sr-only'>Ok:</span>
 $name_new ".$language['createt_now']."<br>
</div>";
    $all++;
}


for($r=0;$r<$menge_css;$r++){
    $name=explode('/',$links_hosting_css[$r]);
    $last=count($name);
    $name_new=$name[$last-1];
    $html_css=file_get_contents($links_hosting_css[$r]);
    file_put_contents("hosting/$name_new",$html_css);
  //  echo "$name_new ".$language['createt_now']."<br>";
    
    
            echo "<div class='alert alert-success' role='alert'>
  <span class='glyphicon glyphicon-ok' aria-hidden='true'></span>
  <span class='sr-only'>Ok:</span>
 $name_new ".$language['createt_now']."<br>
</div>";
    
    
    $all++;
}

if($all<=($menge_css+$menge_js)){
   // echo "<div style='color:red'></div>";
  //  echo "<div style='color:green'></div>";
    
    
    echo "<div class='alert alert-danger' role='alert'>
  <span class='glyphicon glyphicon-removing' aria-hidden='true'></span>
  <span class='sr-only'>Error:</span>
 ".$language['dsgvo']."
</div>";
        echo "<div class='alert alert-success' role='alert'>
  <span class='glyphicon glyphicon-ok' aria-hidden='true'></span>
  <span class='sr-only'>Ok:</span>
  ".$language['dsgvo_text']."
</div>";
    
    
    
}



?>