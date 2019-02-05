<?php
	include('config/autoload.php');

	
	$fm_caid   	= $_SESSION['login_id'];
	// $fm_caid   	= $_SESSION['ca_id'];
	$fm_caname  = $_SESSION['sqyard_user'];

	if(isset($_POST['hid_user_reg']) && $_POST['hid_user_reg'] == '1')
	{
		$txt_email      = mysqli_real_escape_string($db_con,$_POST['txt_email']);
		$sql_adhnocheck = " select * from tbl_mgnt_users where mu_email = '".$txt_email."' ";
		$res_adhnocheck = mysqli_query($db_con,$sql_adhnocheck);
		$tot_adhnocheck = mysqli_num_rows($res_adhnocheck);
		
		if($tot_adhnocheck == 0)
		{
			$data_ca['mu_org_id']      = mysqli_real_escape_string($db_con,$_POST['org_id']);
			$data_ca['mu_mr_role_id']    = mysqli_real_escape_string($db_con,$_POST['txt_userType']);
			$data_ca['mu_name']       = mysqli_real_escape_string($db_con,$_POST['txt_name']);
			$data_ca['mu_email']     = $txt_email;
			$data_ca['mu_password']   = md5(mysqli_real_escape_string($db_con,$_POST['txt_password']));
			$data_ca['mu_mobile']    = mysqli_real_escape_string($db_con,$_POST['txt_mobileno']);
			$data_ca['status']  = '1';
			$data_ca['created_date'] = $datetime;
			
			if($data_ca['mu_email'] != '' && $data_ca['mu_mobile'] != '' && $data_ca['mu_password'] != '')
			{
				// Query for inserting the users into tbl_change_agents table
				$res_insert_ca = insert('tbl_mgnt_users', $data_ca);
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
		$sql_adhnocheck = "Select * from tbl_mgnt_users where mu_email = '".$txt_email."' AND mu_id !='".$hid_user_id."'";
		
		//quit('error',$sql_adhnocheck);
		
		$res_adhnocheck = mysqli_query($db_con,$sql_adhnocheck);
		$tot_adhnocheck = mysqli_num_rows($res_adhnocheck);
		
		if($tot_adhnocheck == 0)
		{
			$data_ca['mu_org_id']     = mysqli_real_escape_string($db_con,$_POST['org_id']);
			$data_ca['mu_mr_role_id']   = mysqli_real_escape_string($db_con,$_POST['txt_userType']);
			$data_ca['mu_name']      = mysqli_real_escape_string($db_con,$_POST['txt_name']);
			$data_ca['mu_email']    = $txt_email;
			$mu_password = mysqli_real_escape_string($db_con,@$_POST['txt_password']);
			if($mu_password!=""){
				$data_ca['mu_password']= md5($mu_password);
			}
			$data_ca['mu_mobile']   = mysqli_real_escape_string($db_con,$_POST['txt_mobileno']);
			$data_ca['modified_date'] = $datetime;

			if($data_ca['mu_email'] != '' && $data_ca['mu_mobile'] != ''&& $data_ca['mu_org_id'] != '' && $data_ca['mu_name'] != '')
			{
				// Query for Updating the farmer into tbl_farmers table
				$res_update_ca = update('tbl_mgnt_users', $data_ca, array('mu_id'=>$hid_user_id));

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
	
	