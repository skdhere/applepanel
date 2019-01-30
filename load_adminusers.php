<?php
	include('access1.php'); 
	include('include/connection.php');
	include('include/query-helper.php');
	include('include/pagination-helper.php');
	
	$fm_caname  = $_SESSION['sqyard_user'];

	if(isset($_POST['hid_user_reg']) && $_POST['hid_user_reg'] == '1')
	{
		$txt_email      = mysqli_real_escape_string($db_con,$_POST['txt_email']);
		$sql_adhnocheck = " select * from tbl_change_agents where emailId = '".$txt_email."' ";
		$res_adhnocheck = mysqli_query($db_con,$sql_adhnocheck);
		$tot_adhnocheck = mysqli_num_rows($res_adhnocheck);
		
		if($tot_adhnocheck == 0)
		{
			$data_ca['org_id']      = mysqli_real_escape_string($db_con,$_POST['org_id']);
			$data_ca['userType']    = mysqli_real_escape_string($db_con,$_POST['txt_userType']);
			$data_ca['fname']       = mysqli_real_escape_string($db_con,$_POST['txt_name']);
			$data_ca['emailId']     = $txt_email;
			$data_ca['contactno']   = mysqli_real_escape_string($db_con,$_POST['txt_mobileno']);
			$data_ca['password']    = mysqli_real_escape_string($db_con,$_POST['txt_password']);
			$data_ca['reg_status']  = '1';
			$data_ca['register_dt'] = $datetime;
			
			if($data_ca['emailId'] != '' && $data_ca['contactno'] != '' && $data_ca['password'] != '')
			{
				// Query for inserting the users into tbl_change_agents table
				$res_insert_ca = insert('tbl_change_agents', $data_ca);
				if($res_insert_ca)
				{
					quit('Success', 1);
				}
				else
				{
					quit('Insertion Error, Please try after sometime');	
				}
			}
			else
			{
				quit('Email,Mobile and Password no cannot be blank!!!');	
			}
		}
		else
		{
			quit('Email id already in use!!!');	
		}
	}
	
	if(isset($_POST['hid_user_edit']) && $_POST['hid_user_edit'] == '1')
	{
		$hid_user_id    = mysqli_real_escape_string($db_con,$_POST['hid_user_id']);
		
		$txt_email      = mysqli_real_escape_string($db_con,$_POST['txt_email']);
		$sql_adhnocheck = "Select * from tbl_change_agents where emailId = '".$txt_email."' AND id !='".$hid_user_id."'";
		
		//quit('error',$sql_adhnocheck);
		
		$res_adhnocheck = mysqli_query($db_con,$sql_adhnocheck);
		$tot_adhnocheck = mysqli_num_rows($res_adhnocheck);
		
		if($tot_adhnocheck == 0)
		{
			$data_ca['org_id']     = mysqli_real_escape_string($db_con,$_POST['org_id']);
			$data_ca['userType']   = mysqli_real_escape_string($db_con,$_POST['txt_userType']);
			$data_ca['fname']      = mysqli_real_escape_string($db_con,$_POST['txt_name']);
			$data_ca['emailId']    = $txt_email;
			$data_ca['contactno']  = mysqli_real_escape_string($db_con,$_POST['txt_mobileno']);
			$data_ca['password']   = mysqli_real_escape_string($db_con,$_POST['txt_password']);
			$data_ca['updated_dt'] = $datetime;

			if($data_ca['emailId'] != '' && $data_ca['contactno'] != '' && $data_ca['password'] != '' && $data_ca['org_id'] != '' && $data_ca['fname'] != '')
			{
				// Query for Updating the farmer into tbl_farmers table
				$res_update_ca = update('tbl_change_agents', $data_ca, array('id'=>$hid_user_id));

				if($res_update_ca)
				{
					quit('Success', 1);
				}
				else
				{
					quit('Insertion Error, Please try after sometime');
				}
			}
			else
			{
				quit('Email, Mobile, Password no cannot be blank!!!');	
			}
		}
		else
		{
			quit('Email id  already in use!!!');	
		}	
	}
	
	