<?php
include('access1.php');
include('include/connection.php');
date_default_timezone_set("Asia/Calcutta");
$todaydt = date("Y-m-d H:i:s");


$id=$_POST['adminusers'];


			
foreach($id as $adminusers){
	//banner deletion
	$sql_ban="delete from tbl_change_agents where id='$adminusers'";
	$res_ban = mysqli_query($db_con,$sql_ban); 
	if($res_ban)
	{
	?>
			<script type="text/javascript">
			window.open('view_adminusers.php?pag=users','_self');
			</script>
			<?php	
	}
	else
	{
	?>
	<script type="text/javascript">
	alert("adminusers cannot be deleted");
	history.go(-1);
	</script>
    <?php	
	}
	//banner deletion

}
	
	
	
?>