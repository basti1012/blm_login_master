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