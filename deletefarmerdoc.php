<?php
include('access1.php');
include('include/connection.php');
date_default_timezone_set("Asia/Calcutta");
$todaydt = date("Y-m-d H:i:s");

$fm_id = $_REQUEST['fm_id'];

$id=$_POST['docs'];


			
foreach($id as $docs){
	//banner deletion
	$sql_ban="delete from tbl_doc_uploads where id='$docs'";
	$res_ban = mysqli_query($db_con,$sql_ban); 
	if($res_ban)
	{
	?>
			<script type="text/javascript">
			window.open('get_farmerdoc.php?pag=farmers&fm_id=<?php echo $fm_id; ?>','_self');
			</script>
			<?php	
	}
	else
	{
	?>
	<script type="text/javascript">
	alert("docs cannot be deleted");
	history.go(-1);
	</script>
    <?php	
	}
	//banner deletion

}
	
	
	
?>