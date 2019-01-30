<?php
	include('access1.php'); 
	include('include/connection.php');
	
	$fm_caid   	= $_SESSION['ca_id'];
	$fm_caname  = $_SESSION['sqyard_user'];

	if($_POST)
	{
		foreach ($_POST as $k => $value)
		{
			mysqli_real_escape_string($db_con,@$_POST[$k]);
		}
	}

	if(isset($_POST['hid_spouse_details']) && $_POST['hid_spouse_details'] == '1')
	{
		include('include/query-helper.php');

		$data['fm_id']						= @$_POST['hid_farmer_id'];
		$data['fm_caid']					= $fm_caid;
		$data['f3_spouse_fname']			= @$_POST['txt_spouse_name'];
		$data['f3_spouse_age']				= @$_POST['txt_spouse_age'];
		$data['f3_spouse_mobno']			= @$_POST['txt_spouse_mobile_no'];
		$data['f3_spouse_adhno']			= @$_POST['txt_spouse_aadhar'];
		$data['f3_spouse_shg']				= @$_POST['ddl_part_of_shg'];

		if($data['f3_spouse_shg'] == 'yes')	
		{
			$data['f3_spouse_shgname']		= @$_POST['txt_shg_name'];
		} 

		$data['f3_spouse_occp']				= @$_POST['ddl_spouse_occupation'];
		$data['f3_spouse_income']			= @$_POST['txt_spouse_incode'];
		$data['f3_spouse_mfi']				= @$_POST['ddl_mony_isTaken'];

		if($data['f3_spouse_mfi'] == 'yes')	
		{
			$data['f3_spouse_mfiname']		= @$_POST['txt_microfinance_name'];
			$data['f3_spouse_mfiamount']	= @$_POST['txt_mony_taken_from_mf'];
		}

		$data['f3_status']					= '1';
		$data['f3_created_date']			= $datetime;
		$data['f3_created_by']				= $fm_caid;

		$data['f3_affliation_status']		= @$_POST['ddl_affliation'];
		$data['f3_fpo_name']				= @$_POST['txt_fpo_name'];
		$data['f3_bank_name']				= @$_POST['txt_spouse_bank_name'];

		$check_exist = checkExist('tbl_spouse_details',array('fm_id'=>$data['fm_id']),array(),array(),array());

		if(!$check_exist)
		{
			$res = insert('tbl_spouse_details', $data);
			
			quit('Record Submitted Successfully..!',1);
		}
		else
		{
			$id 	= $check_exist['id'];
			
			$data['f3_modified_by']		= $fm_caid;
			$data['f3_modified_date']	= $datetime;

			$res =update('tbl_spouse_details',$data,array("id"=>$id),array(),array(),array());
			quit('Record Updated Successfully..!',1);
		}
	}
?>