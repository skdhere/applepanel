<?php
//done By Bravo 26 oct 2017
include('access1.php');
include('include/connection.php');
include('include/query-helper.php');

date_default_timezone_set("Asia/Calcutta");
$todaydt = date("Y-m-d H:i:s");
$fmca_id = $_REQUEST['fmca_id'];
$id      = $_POST['farmer_id'];

// 1.tbl_applicant_knowledge
// 2.tbl_applicant_phone
// 3.tbl_asset_details
// 4.tbl_bank_loan_detail
// 5.tbl_cultivation_data
// 6.tbl_current_crop_forecast
// 7.tbl_doc_uploads
// 8.tbl_family_details
// 9.tbl_land_details
// 10.tbl_livestock_details
// 11.tbl_loan_details
// 12.tbl_personal_detail
// 13.tbl_points
// 14.tbl_residence_details
// 15.tbl_spouse_details
// 16.tbl_yield_details
// 17.tbl_farmers

foreach($id as $fm_id){

	$cnt_farmer1=isExist('tbl_applicant_knowledge',array("fm_id"=>$fm_id),array(),array(),array());
	if($cnt_farmer1 != 0)
	{

		//1.farmer  Applicant Knowledge deletion
		$sql_farmer1="delete from tbl_applicant_knowledge where fm_id='$fm_id'";
		$res_farmer1 = mysqli_query($db_con,$sql_farmer1); 
			if($res_farmer1)
			{
				$farmer1 = 1;
			}
			else
			{
				$farmer1 = 0;
			?>
			<script type="text/javascript">
				alert("Farmer's Applicant Knowledge cannot be deleted");
			</script>
		    <?php	
			}
	}
	else
	{
		$farmer1 = 1;
	}	
	

	$cnt_farmer2=isExist('tbl_applicant_phone',array("fm_id"=>$fm_id),array(),array(),array());
	if($cnt_farmer2 != 0)
	{

		//2.farmer  Applicant Phone deletion
		$sql_farmer2="delete from tbl_applicant_phone where fm_id='$fm_id'";
		$res_farmer2 = mysqli_query($db_con,$sql_farmer2); 
			if($res_farmer2)
			{
				$farmer2 = 1;
			}
			else
			{
				$farmer2 = 0;	
			?>
			<script type="text/javascript">
				alert("Farmer's Applicant Phone cannot be deleted");
			</script>
		    <?php	
			}	
	}
	else
	{
		$farmer2 = 1;
	}

	$cnt_farmer3=isExist('tbl_asset_details',array("fm_id"=>$fm_id),array(),array(),array());
	if($cnt_farmer3 != 0)
	{

		//3.farmer  Asset Details deletion
		$sql_farmer3="delete from tbl_asset_details where fm_id='$fm_id'";
		$res_farmer3 = mysqli_query($db_con,$sql_farmer3); 
			if($res_farmer3)
			{
				$farmer3 = 1;
			}
			else
			{
				$farmer3 = 0;
			?>
			<script type="text/javascript">
				alert("Farmer's Asset Details cannot be deleted");
			</script>
		    <?php	
			}
	}
	else
	{
		$farmer3 = 1;
	}


	$cnt_farmer4=isExist('tbl_bank_loan_detail',array("fm_id"=>$fm_id),array(),array(),array());
	if($cnt_farmer4 != 0)
	{

		//4.farmer Bank Loan Details deletion
		$sql_farmer4="delete from tbl_bank_loan_detail where fm_id='$fm_id'";
		$res_farmer4 = mysqli_query($db_con,$sql_farmer4); 
			if($res_farmer4)
			{
				$farmer4 = 1;
			}
			else
			{
				$farmer4 = 0;	
			?>
			<script type="text/javascript">
				alert("Farmer's Bank Loan Details cannot be deleted");
			</script>
		    <?php	
			}
	}
	else
	{
		$farmer4 = 1;
	}


	$cnt_farmer5=isExist('tbl_cultivation_data',array("fm_id"=>$fm_id),array(),array(),array());
	if($cnt_farmer5 != 0)
	{
	
		//5.farmer Cultivation Data deletion
		$sql_farmer5="delete from tbl_cultivation_data where fm_id='$fm_id'";
		$res_farmer5 = mysqli_query($db_con,$sql_farmer5); 
			if($res_farmer5)
			{
				$farmer5 = 1;
			}
			else
			{
				$farmer5 = 0;
			?>
			<script type="text/javascript">
				alert("Farmer's Cultivation Data cannot be deleted");
			</script>
		    <?php	
			}
	}
	else
	{
		$farmer5 = 1;
	}

	$cnt_farmer6=isExist('tbl_current_crop_forecast',array("fm_id"=>$fm_id),array(),array(),array());
	if($cnt_farmer6 != 0)
	{

		//6.farmer Current Crop Forecast deletion
		$sql_farmer6="delete from tbl_current_crop_forecast where fm_id='$fm_id'";
		$res_farmer6 = mysqli_query($db_con,$sql_farmer6); 
			if($res_farmer6)
			{
				$farmer6 = 1;
			}
			else
			{
				$farmer6 = 0;
			?>
			<script type="text/javascript">
				alert("Farmer's Current Crop Forecast cannot be deleted");
			</script>
		    <?php	
			}
	}
	else
	{
		$farmer6 = 1;
	}

	$cnt_farmer7=isExist('tbl_doc_uploads',array("fm_id"=>$fm_id),array(),array(),array());
	if($cnt_farmer7 != 0)
	{	

		//7.farmer  Document Upload deletion
		$sql_farmer7="delete from tbl_doc_uploads where fm_id='$fm_id'";
		$res_farmer7 = mysqli_query($db_con,$sql_farmer7); 
			if($res_farmer7)
			{
				$farmer7 = 1;
			}
			else
			{
				$farmer7 = 0;
			?>
			<script type="text/javascript">
				alert("Farmer's Document Upload cannot be deleted");
			</script>
		    <?php	
			}
	}
	else
	{
		$farmer7 = 1;
	}

	$cnt_farmer8=isExist('tbl_family_details',array("fm_id"=>$fm_id),array(),array(),array());
	if($cnt_farmer8 != 0)
	{	

		//8.farmer Family Details deletion
		$sql_farmer8="delete from tbl_family_details where fm_id='$fm_id'";
		$res_farmer8 = mysqli_query($db_con,$sql_farmer8); 
			if($res_farmer8)
			{
				$farmer8 = 1;
			}
			else
			{
				$farmer8 = 0;
			?>
			<script type="text/javascript">
				alert("Farmer's Applicant Phone cannot be deleted");
			</script>
		    <?php	
			}
	}
	else
	{
		$farmer8 = 1;
	}


	$cnt_farmer9=isExist('tbl_land_details',array("fm_id"=>$fm_id),array(),array(),array());
	if($cnt_farmer9 != 0)
	{

		//9.farmer Land Details deletion
		$sql_farmer9="delete from tbl_land_details where fm_id='$fm_id'";
		$res_farmer9 = mysqli_query($db_con,$sql_farmer9); 
			if($res_farmer9)
			{
				$farmer9 = 1;
			}
			else
			{
				$farmer9 = 0;
			?>
			<script type="text/javascript">
				alert("Farmer's Land Details cannot be deleted");
			</script>
		    <?php	
			}
	}
	else
	{
		$farmer9 = 1;
	}

	$cnt_farmer10=isExist('tbl_livestock_details',array("fm_id"=>$fm_id),array(),array(),array());
	if($cnt_farmer10 != 0)
	{

		//10.farmer Livestock Detail deletion
		$sql_farmer10="delete from tbl_livestock_details where fm_id='$fm_id'";
		$res_farmer10 = mysqli_query($db_con,$sql_farmer10); 
			if($res_farmer10)
			{
				$farmer10 = 1;
			}
			else
			{
				$farmer10 = 0;
			?>
			<script type="text/javascript">
				alert("Farmer's Livestock Detail cannot be deleted");
			</script>
		    <?php	
			}
	}
	else
	{
		$farmer10 = 1;
	}

	$cnt_farmer11=isExist('tbl_loan_details',array("fm_id"=>$fm_id),array(),array(),array());
	if($cnt_farmer11 != 0)
	{

		//11.farmer Loan Details deletion
		$sql_farmer11="delete from tbl_loan_details where fm_id='$fm_id'";
		$res_farmer11 = mysqli_query($db_con,$sql_farmer11); 
			if($res_farmer11)
			{
				$farmer11 = 1;
			}
			else
			{
				$farmer11 = 0;
			?>
			<script type="text/javascript">
				alert("Farmer's Loan Details cannot be deleted");
			</script>
		    <?php	
			}
	}
	else
	{
		$farmer11 = 1;
	}

	$cnt_farmer12=isExist('tbl_personal_detail',array("fm_id"=>$fm_id),array(),array(),array());
	if($cnt_farmer12 != 0)
	{

		//12.farmer Personal Details deletion
		$sql_farmer12="delete from tbl_personal_detail where fm_id='$fm_id'";
		$res_farmer12 = mysqli_query($db_con,$sql_farmer12); 
			if($res_farmer12)
			{
				$farmer12 = 1;
			}
			else
			{
				$farmer12 = 0;
			?>
			<script type="text/javascript">
				alert("Farmer's Personal Details cannot be deleted");
			</script>
		    <?php	
			}
	}
	else
	{
		$farmer12 = 1;
	}

	$cnt_farmer13=isExist('tbl_points',array("fm_id"=>$fm_id),array(),array(),array());
	if($cnt_farmer13 != 0)
	{

		//13.farmer Points deletion
		$sql_farmer13="delete from tbl_points where fm_id='$fm_id'";
		$res_farmer13 = mysqli_query($db_con,$sql_farmer13); 
			if($res_farmer13)
			{
				$farmer13 = 1;
			}
			else
			{
				$farmer13 = 0;
			?>
			<script type="text/javascript">
				alert("Farmer's Points cannot be deleted");
			</script>
		    <?php	
			}
	}
	else
	{
		$farmer13 = 1;
	}

	$cnt_farmer14=isExist('tbl_residence_details',array("fm_id"=>$fm_id),array(),array(),array());
	if($cnt_farmer14 != 0)
	{	

		//14.farmer Residence Details deletion
		$sql_farmer14="delete from tbl_residence_details where fm_id='$fm_id'";
		$res_farmer14 = mysqli_query($db_con,$sql_farmer14); 
			if($res_farmer14)
			{
				$farmer14 = 1;
			}
			else
			{
				$farmer14 = 0;
			?>
			<script type="text/javascript">
				alert("Farmer's Residence Details cannot be deleted");
			</script>
		    <?php	
			}
	}
	else
	{
		$farmer14 = 1;
	}

	$cnt_farmer15=isExist('tbl_spouse_details',array("fm_id"=>$fm_id),array(),array(),array());
	if($cnt_farmer15 != 0)
	{

		//15.farmer Spouse Details deletion
		$sql_farmer15="delete from tbl_spouse_details where fm_id='$fm_id'";
		$res_farmer15 = mysqli_query($db_con,$sql_farmer15); 
			if($res_farmer15)
			{
				$farmer15 = 1;
			}
			else
			{
				$farmer15 = 0;
			?>
			<script type="text/javascript">
				alert("Farmer's Spouse Details cannot be deleted");
			</script>
		    <?php	
			}
	}
	else
	{
		$farmer15 = 1;
	}

	$cnt_farmer16=isExist('tbl_yield_details',array("fm_id"=>$fm_id),array(),array(),array());
	if($cnt_farmer16 != 0)
	{
		//16.farmer Yield Details deletion
		$sql_farmer16="delete from tbl_yield_details where fm_id='$fm_id'";
		$res_farmer16 = mysqli_query($db_con,$sql_farmer16); 
			if($res_farmer16)
			{
				$farmer16 = 1;
			}
			else
			{
				$farmer16 = 0;
			?>
			<script type="text/javascript">
				alert("Farmer's Yield Details cannot be deleted");
			</script>
		    <?php	
			}
	}
	else
	{
		$farmer16 = 1;
	}

	if($farmer1 == 1 && $farmer2 == 1 && $farmer3 == 1 && $farmer4 == 1 && $farmer5 == 1 && $farmer6 == 1 && $farmer7 == 1 && $farmer8 == 1 && $farmer9 == 1 && $farmer10 == 1 && $farmer11 == 1 && $farmer12 == 1 && $farmer13 == 1 && $farmer14 == 1 && $farmer15 == 1 && $farmer16 == 1 )
	{
		//17.farmer deletion
		$sql_farmer17="delete from tbl_farmers where fm_id='$fm_id'";
		$res_farmer17 = mysqli_query($db_con,$sql_farmer17); 
			if($res_farmer17)
			{
					?>
					<script type="text/javascript">
					window.open('view_farmers.php?pag=farmers','_self');
					</script>
					<?php
			}
			else
			{
					?>
					<script type="text/javascript">
						alert("Farmer cannot be deleted");
						history.go(-1);
					</script>
				    <?php	
			}	

	}
	else
	{
		?>
		<script type="text/javascript">
			alert("Farmer cannot be deleted");
			history.go(-1);
		</script>
	    <?php		
	}

	
	

}
	
	
	
?>