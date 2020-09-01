<?php
include('config.php');
if(isset($admin_logged_in) AND $admin_logged_in==true){
     $login=true;
}else{
     $login=false;
     $error_out=$language['not_login_as_admin'];
     include('error_page.php');
     exit;
}
?>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <title>Admin Login</title>
    <?php
    include('tamplate/header.php');
    if($id[22]=='true'){
?>
<script src="hosting/jquery.min.js"></script>"
<link rel="stylesheet" href="hosting/bootstrap.min.css">
<link rel="stylesheet" href="hosting/buttons.bootstrap.min.css">
<link rel="stylesheet" href="hosting/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="hosting/sweet-alert.css">
<script src="hosting/sweet-alert.min.js"></script>
<?php
}else{
?>
<link rel="stylesheet" href="https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css">
<script src="https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
<?php
}
?>
</head>
<body id="adminuser">
<?php
$admin1_page=true;
$logout_page_admin=true;
include('tamplate/nav.php');
if($login==true){
      echo $language['admin_user_works'];
      if(isset($_GET['kill']) AND isset($_GET['id']) AND $_GET['id']!=''){   
        echo '     
   <script>
   setTimeout(function(){
    swal({
		title: "'.$language['are_you_sure'].'",
		text: "'.$language['kill_accound_sure'].'",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "'.$language['deletet_it'].'",
		closeOnConfirm: false,
		//closeOnCancel: false
	},
	function(){
         $.ajax({
             method: "POST",
             url: "killid.php",
             data: { kill: "kill", id: '.$_GET['id'].' }
        }).done(function( msg ) {
             swal("Id:'.$_GET['id'].''.$language['he_deletet'].'", msg, "success");
             setTimeout(function(){
                 location.href="admin-user.php";
             },1000);
        });
	});
   },1000);
 </script>';  
        
      }
      if(isset($_GET['name_bearbeiten']) AND isset($_GET['email_bearbeiten'])){
            $data = [
            'name' => $_GET['name_bearbeiten'],
            'id' => $_GET['id_bearbeiten'],
            'email' => $_GET['email_bearbeiten']];
            $sql = "UPDATE $tabelle SET user=:name, email=:email WHERE id=:id";
            $stmt= $mysql->prepare($sql);
            $stmt->execute($data);
            echo "".$language['admin_user_data1']."  ".$_GET['name_bearbeiten']." ".$language['admin_user_changes1']."";
      }
      if(isset($_GET['bearbeiten']) AND isset($_GET['id']) AND $_GET['id']!=''){
      ?>
      <form action="admin-user.php">
      <input type="hidden" name="id_bearbeiten" value="<?php echo $_GET['id']; ?>">
      <label>Name :<input  class="input_feld" type="text" name="name_bearbeiten" value="<?php echo $_GET['name']; ?>"></label>
      <label>Email :<input class="input_feld"  type="text" name="email_bearbeiten" value="<?php echo $_GET['email']; ?>"></label>
      <input style="color:black" type="submit" value="Daten ändern">
      </form>
 <?php
      }else{
?>
<table id='example'>
    <thead>
    <tr>
        <th>user</th>
        <th>nachname</th>
        <th>address</th>
        <th>townnumber</th>
        <th>city</th>
        <th>land</th>
        <th>phone</th>
        <th>geschlecht</th> 
        <th>created_at</th>
        <th>email</th>
        <th>comment</th>
        <th>delete ?</th>
        <th>to edit</th> 
    </tr>
    </thead>
    <tbody id="logrein">
<?php
      $sql = "SELECT * FROM $tabelle";
      foreach ($mysql->query($sql) as $row) {
      ?>
        <tr>
              <td><?php echo $row['user']; ?></td>
              <td><?php echo $row['nachname']; ?></td>
              <td><?php echo $row['address']; ?></td>
              <td><?php echo $row['townnumber']; ?></td>
              <td><?php echo $row['city']; ?></td>
              <td><?php echo $row['land']; ?></td>
              <td><?php echo $row['phone']; ?></td>
              <td><?php echo $row['geschlecht']; ?></td>    
              <td><?php echo $row['created_at']; ?></td>
              <td><?php echo $row['email']; ?></td>
              <td><?php echo $row['comment']; ?></td>
              <td><a href="admin-user.php?kill&id=<?php echo $row['id']; ?>"><?php echo $language['delete_link']; ?></a></td>
              <td><a href="admin-user.php?bearbeiten&id=<?php echo $row['id']; ?>&name=<?php echo $row['user']; ?>&email=<?php echo $row['email']; ?>"><?php echo $language['delete_link1']; ?></a></td>
        </tr>
      <?php
      }
?>
    </tbody>
</table> 
<script>
$(document).ready(function() {
    document.title='Simple DataTable';
        var hCols = [2,3,4,5,6];
    $('#example').DataTable({
				"dom": "<'row'<'col-sm-4'B><'col-sm-2'l><'col-sm-6'p<br/>i>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-12'p<br/>i>>",
				"paging": true,
				"autoWidth": true,
				"columnDefs": [{
					"visible": false,
					"targets": hCols
				}],
				"buttons": [
                 'copyHtml5',
				'print',
                {
					extend: 'colvis',
					collectionLayout: 'three-column',
					text: function() {
						var totCols = $('#example thead th').length;
						var hiddenCols = hCols.length;
						var shownCols = totCols - hiddenCols;
						return 'Columns (' + shownCols + ' of ' + totCols + ')';
					},
					prefixButtons: [{
						extend: 'colvisGroup',
						text: 'Show all',
						show: ':hidden'
					}, {
						extend: 'colvisRestore',
						text: 'Restore'
					}]
				}, {
					extend: 'collection',
					text: 'Export',
					buttons: [{
							text: 'Excel',
							extend: 'excelHtml5',
							footer: false,
							exportOptions: {
								columns: ':visible'
							}
						}, {
							text: 'CSV',
							extend: 'csvHtml5',
							fieldSeparator: ';',
							exportOptions: {
								columns: ':visible'
							}
						}, {
							text: 'PDF Portrait',
							extend: 'pdfHtml5',
							message: '',
							exportOptions: {
								columns: ':visible'
							}
						}, {
							text: 'PDF Landscape',
							extend: 'pdfHtml5',
							message: '',
							orientation: 'landscape',
							exportOptions: {
								columns: ':visible'
							}
						}]
					}] 
				,oLanguage: {
            oPaginate: {
                sNext: '<span class="pagination-default">&#x276f;</span>',
                sPrevious: '<span class="pagination-default">&#x276e;</span>'
            }
        }
    	,"initComplete": function(settings, json) {
						$('#example').on('column-visibility.dt', function(e, settings, column, state) {
							var visCols = $('#example thead tr:first th').length;
							var tblCols = $('.dt-button-collection li[aria-controls=example] a').length - 2;
							$('.buttons-colvis[aria-controls=example] span').html('Columns (' + visCols + ' of ' + tblCols + ')');
							e.stopPropagation();
						});
	   }
   });
});
</script>
<?php
}
if($id[22]=='true'){
?>
<script src="hosting/jquery.dataTables.min.js"></script>
<script src="hosting/dataTables.buttons.min.js"></script>
<script src="hosting/buttons.colVis.min.js"></script>
<script src="hosting/buttons.html5.min.js"></script>
<script src="hosting/buttons.print.min.js"></script>
<script src="hosting/dataTables.bootstrap.min.js"></script>
<script src="hosting/buttons.bootstrap.min.js"></script>
<script src="hosting/jszip.min.js"></script>
<script src="hosting/vfs_fonts.js"></script>
<script src="hosting/pdfmake.min.js"></script>
<?php
}else{
?>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<?php
}
}
?>
    <?php
    if(isset($footer_aktive) AND $footer_aktive=='true'){
     include('tamplate/footer.php');
}
    ?>

</body>
</html>