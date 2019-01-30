<?php
	include('access1.php'); 
	include('include/connection.php');
	include('include/query-helper.php');
	include('include/pagination-helper.php');
	
	$fm_caid   	= $_SESSION['ca_id'];
	// $fm_caid   	= $_SESSION['ca_id'];
	$fm_caname  = $_SESSION['sqyard_user'];

	if((isset($obj->load_dist)) == '1' && (isset($obj->load_dist)))
	{
		$stateId		= $obj->stateVal;
		$stateParameter	= $obj->stateParameter;
		$distId			= $obj->distId;
		$talId   		= $obj->talId;
		$villageId 		= $obj->villageId;
		$distDivId		= $obj->distDivId;
		$talDivId		= $obj->talDivId;
		$VillageDivId	= $obj->VillageDivId;
 		$data			= '';
		
		$data	.= '<select id="'.$distId.'" name="'.$distId.'" class="select2-me input-large" onChange="getTal(\''.$stateParameter.'\', this.value, \''.$talId.'\', \''.$villageId.'\', \''.$talDivId.'\', \''.$VillageDivId.'\');" >';
			if($stateId != '')
			{
				$data	.= '<option value="" disabled selected>Select District</option>';
				$res_get_dist	= lookup_value('tbl_district',array(),array("dt_stid"=>$stateId),array(),array(),array());
				if($res_get_dist)
				{
					while ($row = mysqli_fetch_array($res_get_dist)) 
					{
						$data	.= '<option value="'.$row['id'].'">'.strtoupper($row['dt_name']).'</option>';
					}
				}
				else
				{
					$data	.= '<option value="" disabled selected>No Match Found</option>';	
				}
			}
			else
			{
				$data	.= '<option value="" disabled selected>No Match Fund</option>';	
			}
		$data	.= '</select>';
		
		quit(utf8_encode($data), 1);	
	}
	
	if((isset($obj->load_tal)) == '1' && (isset($obj->load_tal)))
	{
		$distId			= $obj->distVal;
		$distParameter	= $obj->distParameter;
		$talId 			= $obj->talId;
		$villageId 		= $obj->villageId;
		$talDivId		= $obj->talDivId;
		$VillageDivId	= $obj->VillageDivId;
		$data			= '';
		
		$data	.= '<select id="'.$talId.'" name="'.$talId.'" class="select2-me input-large" onChange="getVillage(\''.$distParameter.'\', this.value, \''.$villageId.'\', \''.$VillageDivId.'\');" >';
			if($distId != '')
			{
				$data	.= '<option value="" disabled selected>Select Taluka</option>';
				$res_get_tal	= lookup_value('tbl_taluka',array(),array("tk_dtid"=>$distId),array(),array(),array());
				if($res_get_tal)
				{
					while ($row = mysqli_fetch_array($res_get_tal)) 
					{
						$data	.= '<option value="'.$row['id'].'">'.strtoupper($row['tk_name']).'</option>';
					}
				}
				else
				{
					$data	.= '<option value="" disabled selected>No Match Found</option>';	
				}
			}
			else
			{
				$data	.= '<option value="" disabled selected>No Match Fund</option>';	
			}
		$data	.= '</select>';
		
		quit(utf8_encode($data), 1);	
	}
	
	if((isset($obj->load_village)) == '1' && (isset($obj->load_village)))
	{
		$talId			= $obj->talVal;
		$talParameter	= $obj->talParameter;
		$villageId 		= $obj->villageId;
		$data			= '';
		
		$data	.= '<select id="'.$villageId.'" name="'.$villageId.'" class="select2-me input-large" >';
			if($talId != '')
			{
				$data	.= '<option value="" disabled selected>Select Village</option>';
				$res_get_village	= lookup_value('tbl_village',array(),array("vl_tkid"=>$talId),array(),array(),array());
				if($res_get_village)
				{
					while ($row = mysqli_fetch_array($res_get_village)) 
					{
						$data	.= '<option value="'.$row['id'].'">'.strtoupper($row['vl_name']).'</option>';
					}
				}
				else
				{
					$data	.= '<option value="" disabled selected>No Match Found</option>';	
				}
			}
			else
			{
				$data	.= '<option value="" disabled selected>No Match Fund</option>';	
			}
		$data	.= '</select>';
		
		quit(utf8_encode($data), 1);	
	}
	
	if(isset($_POST['hid_farmer_reg']) && $_POST['hid_farmer_reg'] == '1')
	{
		$fm_aadhar	= mysqli_real_escape_string($db_con,$_POST['fm_aadhar']);
		$sql_adhnocheck		= " select * from tbl_farmers where fm_aadhar = '".$fm_aadhar."' ";
		$res_adhnocheck  	= mysqli_query($db_con,$sql_adhnocheck);
		$tot_adhnocheck 	= mysqli_num_rows($res_adhnocheck);
		
		if($tot_adhnocheck == 0)
		{
			$fm_org_id                   = mysqli_real_escape_string($db_con,$_POST['fm_org_id']);
			$txt_name                    = mysqli_real_escape_string($db_con,$_POST['txt_name']);
			$txt_father_name             = mysqli_real_escape_string($db_con,$_POST['txt_father_name']);
			$txt_mother_name             = mysqli_real_escape_string($db_con,$_POST['txt_mother_name']);
			$txt_dob                     = mysqli_real_escape_string($db_con,$_POST['txt_dob']);
			$txt_age                     = mysqli_real_escape_string($db_con,$_POST['txt_age']);
			$fm_mobileno                 = mysqli_real_escape_string($db_con,$_POST['fm_mobileno']);
			$alt_mobileno                = mysqli_real_escape_string($db_con,$_POST['alt_mobileno']);
			$txt_farm_experience         = mysqli_real_escape_string($db_con,$_POST['txt_farm_experience']);
			$f1_any_other_occupation     = mysqli_real_escape_string($db_con,$_POST['f1_any_other_occupation']);
			$f1_occupation_amt           = mysqli_real_escape_string($db_con,$_POST['f1_occupation_amt']);
			$f1_required_loan            = mysqli_real_escape_string($db_con,$_POST['f1_required_loan']);
			$f1_required_loan_amt        = mysqli_real_escape_string($db_con,$_POST['f1_required_loan_amt']);
			$f1_loan_purpose             = mysqli_real_escape_string($db_con,$_POST['f1_loan_purpose']);
			$f1_crop_cycle               = mysqli_real_escape_string($db_con,$_POST['f1_crop_cycle']);
			$ddl_married_status          = mysqli_real_escape_string($db_con,$_POST['ddl_married_status']);
			$ddl_residence_status        = mysqli_real_escape_string($db_con,$_POST['ddl_residence_status']);
			$txt_rent                    = mysqli_real_escape_string($db_con,$_POST['txt_rent']);
			$txt_p_house_no              = mysqli_real_escape_string($db_con,$_POST['txt_p_house_no']);
			$txt_c_house_no              = mysqli_real_escape_string($db_con,$_POST['txt_c_house_no']);
			$txt_p_street_name           = mysqli_real_escape_string($db_con,$_POST['txt_p_street_name']);
			$txt_c_street_name           = mysqli_real_escape_string($db_con,$_POST['txt_c_street_name']);
			$txt_p_area_name             = mysqli_real_escape_string($db_con,$_POST['txt_p_area_name']);
			$txt_c_area_name             = mysqli_real_escape_string($db_con,$_POST['txt_c_area_name']);
			$ddl_p_state                 = mysqli_real_escape_string($db_con,$_POST['ddl_p_state']);
			$ddl_c_state                 = mysqli_real_escape_string($db_con,$_POST['ddl_c_state']);
			$ddl_p_dist                  = mysqli_real_escape_string($db_con,$_POST['ddl_p_dist']);
			$ddl_c_dist                  = mysqli_real_escape_string($db_con,$_POST['ddl_c_dist']);
			$ddl_p_tal                   = mysqli_real_escape_string($db_con,$_POST['ddl_p_tal']);
			$ddl_c_tal                   = mysqli_real_escape_string($db_con,$_POST['ddl_c_tal']);
			$ddl_p_village               = mysqli_real_escape_string($db_con,$_POST['ddl_p_village']);
			$ddl_c_village               = mysqli_real_escape_string($db_con,$_POST['ddl_c_village']);
			$txt_p_pincode               = mysqli_real_escape_string($db_con,$_POST['txt_p_pincode']);
			$txt_c_pincode               = mysqli_real_escape_string($db_con,$_POST['txt_c_pincode']);
			//$hid_frm_reg_points        = mysqli_real_escape_string($db_con,$_POST['hid_frm_reg_points']);
			$hid_residence_points        = mysqli_real_escape_string($db_con,$_POST['hid_residence_points']);
			$hid_personal_details_points = mysqli_real_escape_string($db_con,$_POST['hid_personal_details_points']);
			$f3_married_reg_points       = mysqli_real_escape_string($db_con,$_POST['f3_married_reg_points']);
			
			
			$ipaddress				= $_SERVER['REMOTE_ADDR'];
			
			$sql_fm_id	= mysqli_query($db_con,"select fm_id from tbl_farmers order by id desc limit 0,1");
			$res_fm_id	= mysqli_fetch_array($sql_fm_id);
			$fm_id		= $res_fm_id['fm_id'];
			if($fm_id == '')
			{
				$fm_id	= 100000;
			}
			else
			{
				$fm_id	= $fm_id + 1;
			}
			
			if($txt_name != '' && $fm_mobileno != '' && $fm_aadhar != '')
			{
				// Query for inserting the farmer into tbl_farmers table
				$sql_insert_farmer	= " INSERT INTO `tbl_farmers`(`fm_caid`, `fm_org_id`, `fm_id`, `fm_name`, `fm_aadhar`, `fm_mobileno`, ";
				$sql_insert_farmer	.= " `fm_status`, `fm_createddt`, `fm_createdby`) ";
				$sql_insert_farmer	.= " VALUES ('".$fm_caid."', '".$fm_org_id."', '".$fm_id."', '".$txt_name."', '".$fm_aadhar."', ";
				$sql_insert_farmer	.= " '".$fm_mobileno."', '1', '".$datetime."', '".$fm_caname."') ";
				$res_insert_farmer	= mysqli_query($db_con, $sql_insert_farmer) or die(mysqli_error($db_con));
				if($res_insert_farmer)
				{
					// Query for inserting the farmer personal details into tbl_personal_detail
					$sql_insert_farmer_details	= " INSERT INTO `tbl_personal_detail`(`fm_caid`, `fm_id`, `f1_mfname`, ";
					$sql_insert_farmer_details	.= " `f1_father`, `f1_age`, `f1_dob`, `f1_mobno`, `f1_altno`, ";
					$sql_insert_farmer_details	.= " `f1_expfarm`, `f1_status`, `f1_created_date`, `f1_created_by`, `f1_points`, ";
					$sql_insert_farmer_details	.= " `f1_required_loan`, `f1_required_loan_amt`, `f1_loan_purpose`, `f1_crop_cycle`, ";
					$sql_insert_farmer_details	.= " `f1_any_other_occupation`, `f1_occupation_amt`) ";
					$sql_insert_farmer_details	.= " VALUES ('".$fm_caid."', '".$fm_id."', '".$txt_mother_name."', ";
					$sql_insert_farmer_details	.= " '".$txt_father_name."', '".$txt_age."', '".$txt_dob."', '".$fm_mobileno."', ";
					$sql_insert_farmer_details	.= " '".$alt_mobileno."', '".$txt_farm_experience."', '1', '".$datetime."', '".$fm_caname."', ";
					$sql_insert_farmer_details	.= " '".$hid_personal_details_points."', ";
					$sql_insert_farmer_details	.= " '".$f1_required_loan."', '".$f1_required_loan_amt."', '".$f1_loan_purpose."', '".$f1_crop_cycle."', ";
					$sql_insert_farmer_details	.= " '".$f1_any_other_occupation."', '".$f1_occupation_amt."' ) ";
					$res_insert_farmer_details	= mysqli_query($db_con, $sql_insert_farmer_details) or die(mysqli_error($db_con));
					
 					if($res_insert_farmer_details)
					{
						// Query for inserting the married status in tbl_spouse_details
						$sql_insert_farmer_IsMarried	= " INSERT INTO `tbl_spouse_details`(`fm_caid`, `fm_id`, `f3_married`, ";
						$sql_insert_farmer_IsMarried	.= " `f3_created_date`, `f3_created_by`, `f3_married_reg_points`) ";
						$sql_insert_farmer_IsMarried	.= " VALUES ('".$fm_caid."', '".$fm_id."', '".$ddl_married_status."', ";
						$sql_insert_farmer_IsMarried	.= " '".$datetime."', '".$fm_caname."', '".$f3_married_reg_points."') ";
						$res_insert_farmer_IsMarried	=mysqli_query($db_con, $sql_insert_farmer_IsMarried) or die(mysqli_error($db_con));
						
						if($res_insert_farmer_IsMarried)
						{
							// Query For inserting the recidencial data into tbl_residence_details
							$sql_insert_farmer_address	= " INSERT INTO `tbl_residence_details`(`fm_caid`, `fm_id`, `f7_resistatus`, `f7_rent_amount`, ";
							$sql_insert_farmer_address	.= " `f7_phouse`, `f7_pstreet`, `f7_parea`, `f7_pstate`, `f7_pdistrict`, ";
							$sql_insert_farmer_address	.= " `f7_ptaluka`, `f7_pvillage`, `f7_ppin`, `f7_chouse`, `f7_cstreet`, ";
							$sql_insert_farmer_address	.= " `f7_carea`, `f7_cstate`, `f7_cdistrict`, `f7_ctaluka`, `f7_cvillage`, ";
							$sql_insert_farmer_address	.= " `f7_cpin`, `f7_created_date`, `f7_created_by`, `f7_reg_points`) ";
							$sql_insert_farmer_address	.= " VALUES ('".$fm_caid."', '".$fm_id."', '".$ddl_residence_status."', '".$txt_rent."', ";
							$sql_insert_farmer_address	.= " '".$txt_p_house_no."', '".$txt_p_street_name."', '".$txt_p_area_name."', ";
							$sql_insert_farmer_address	.= " '".$ddl_p_state."', '".$ddl_p_dist."', '".$ddl_p_tal."', '".$ddl_p_village."', ";
							$sql_insert_farmer_address	.= " '".$txt_p_pincode."', '".$txt_c_house_no."', '".$txt_c_street_name."', ";
							$sql_insert_farmer_address	.= " '".$txt_c_area_name."', '".$ddl_c_state."', '".$ddl_c_dist."', '".$ddl_c_tal."', ";
							$sql_insert_farmer_address	.= " '".$ddl_c_village."', '".$txt_c_pincode."', '".$datetime."', '".$fm_caname."', ";
							$sql_insert_farmer_address	.= " '".$hid_residence_points."') ";
							$res_insert_farmer_address	= mysqli_query($db_con, $sql_insert_farmer_address) or die(mysqli_error($db_con));
							
							if($res_insert_farmer_address)
							{
								// Query for inserting the record for Points of the f1 and f7
								$sql_insert_points	= " INSERT INTO `tbl_points`(`fm_id`, `pt_frm1`, `pt_frm7`, `pt_frm3`) ";
								$sql_insert_points	.= " VALUES ('".$fm_id."', '".$hid_personal_details_points."', '".$hid_residence_points."', '".$f3_married_reg_points."') ";
								$res_insert_points	= mysqli_query($db_con, $sql_insert_points) or die(mysqli_error($db_con));
								
								if($res_insert_points)
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
								quit('Insertion Error, Please try after sometime');			
							}
						}
						else
						{
							quit('Insertion Error, Please try after sometime');	
						}
					}
					else
					{
						quit('Insertion Error, Please try after sometime');	
					}
				}
				else
				{
					quit('Insertion Error, Please try after sometime');	
				}
			}
			else
			{
				quit('Name, Aadhar no, Mobile no cannot be blank!!!');	
			}
		}
		else
		{
			quit('Aadhar no already in use!!!');	
		}
	}
	
	if(isset($_POST['hid_farmer_edit']) && $_POST['hid_farmer_edit'] == '1')
	{
		$hid_fm_id				= mysqli_real_escape_string($db_con,$_POST['hid_fm_id']);
		
		$fm_aadhar	= mysqli_real_escape_string($db_con,$_POST['fm_aadhar']);
		$sql_adhnocheck		= " select * from tbl_farmers where fm_aadhar = '".$fm_aadhar."' AND fm_id != '".$hid_fm_id."' ";
		$res_adhnocheck  	= mysqli_query($db_con,$sql_adhnocheck);
		$tot_adhnocheck 	= mysqli_num_rows($res_adhnocheck);
		
		if($tot_adhnocheck == 0)
		{
			$fm_org_id               = mysqli_real_escape_string($db_con,$_POST['fm_org_id']);
			$txt_name                = mysqli_real_escape_string($db_con,$_POST['txt_name']);
			$txt_father_name         = mysqli_real_escape_string($db_con,$_POST['txt_father_name']);
			$txt_mother_name         = mysqli_real_escape_string($db_con,$_POST['txt_mother_name']);
			$txt_dob                 = mysqli_real_escape_string($db_con,$_POST['txt_dob']);
			$txt_age                 = mysqli_real_escape_string($db_con,$_POST['txt_age']);
			$fm_mobileno             = mysqli_real_escape_string($db_con,$_POST['fm_mobileno']);
			$alt_mobileno            = mysqli_real_escape_string($db_con,$_POST['alt_mobileno']);
			$txt_farm_experience     = mysqli_real_escape_string($db_con,$_POST['txt_farm_experience']);
			
			$f1_any_other_occupation = mysqli_real_escape_string($db_con,$_POST['f1_any_other_occupation']);
			if(isset($_POST['f1_occupation_amt']))
			{
				$f1_occupation_amt	= mysqli_real_escape_string($db_con,$_POST['f1_occupation_amt']);
			}
			else
			{
				$f1_occupation_amt	= '';	
			}

			 $f1_required_loan		= mysqli_real_escape_string($db_con,$_POST['f1_required_loan']);
			 $f1_required_loan_amt	= mysqli_real_escape_string($db_con,$_POST['f1_required_loan_amt']);
			 if(isset($_POST['f1_loan_purpose']))
		     {
			 	$f1_loan_purpose		= mysqli_real_escape_string($db_con,$_POST['f1_loan_purpose']);	
			 }
			 else
			 {
			 	$f1_loan_purpose		= '';
			 }
			
			 if(isset($_POST['f1_crop_cycle']))
			 {
			 	$f1_crop_cycle			= mysqli_real_escape_string($db_con,$_POST['f1_crop_cycle']);
			 }
			 else
			 {
			 	$f1_crop_cycle	= '';		
			 }

			
			$ddl_married_status		= mysqli_real_escape_string($db_con,$_POST['ddl_married_status']);
			$ddl_residence_status	= mysqli_real_escape_string($db_con,$_POST['ddl_residence_status']);
			$txt_rent				= mysqli_real_escape_string($db_con,$_POST['txt_rent']);
			$txt_p_house_no			= mysqli_real_escape_string($db_con,$_POST['txt_p_house_no']);
			$txt_c_house_no			= mysqli_real_escape_string($db_con,$_POST['txt_c_house_no']);
			$txt_p_street_name		= mysqli_real_escape_string($db_con,$_POST['txt_p_street_name']);
			$txt_c_street_name		= mysqli_real_escape_string($db_con,$_POST['txt_c_street_name']);
			$txt_p_area_name		= mysqli_real_escape_string($db_con,$_POST['txt_p_area_name']);
			$txt_c_area_name		= mysqli_real_escape_string($db_con,$_POST['txt_c_area_name']);
			$ddl_p_state			= mysqli_real_escape_string($db_con,$_POST['ddl_p_state']);
			$ddl_c_state			= mysqli_real_escape_string($db_con,$_POST['ddl_c_state']);
			$ddl_p_dist				= mysqli_real_escape_string($db_con,$_POST['ddl_p_dist']);
			$ddl_c_dist				= mysqli_real_escape_string($db_con,$_POST['ddl_c_dist']);
			$ddl_p_tal				= mysqli_real_escape_string($db_con,$_POST['ddl_p_tal']);
			$ddl_c_tal				= mysqli_real_escape_string($db_con,$_POST['ddl_c_tal']);
			$ddl_p_village			= mysqli_real_escape_string($db_con,$_POST['ddl_p_village']);
			$ddl_c_village			= mysqli_real_escape_string($db_con,$_POST['ddl_c_village']);
			$txt_p_pincode			= mysqli_real_escape_string($db_con,$_POST['txt_p_pincode']);
			$txt_c_pincode			= mysqli_real_escape_string($db_con,$_POST['txt_c_pincode']);
			
			//$hid_frm_reg_points 			= mysqli_real_escape_string($db_con,$_POST['hid_frm_reg_points']);
            $hid_residence_points 			= mysqli_real_escape_string($db_con,$_POST['hid_residence_points']);
            $hid_personal_details_points 	= mysqli_real_escape_string($db_con,$_POST['hid_personal_details_points']);
			$f3_married_reg_points			= mysqli_real_escape_string($db_con,$_POST['f3_married_reg_points']);
			
			
			$ipaddress				= $_SERVER['REMOTE_ADDR'];
			
			if($txt_name != '' && $fm_mobileno != '' && $fm_aadhar != '')
			{
				// Query for Updating the farmer into tbl_farmers table
				$sql_update_farmer	= " UPDATE `tbl_farmers` ";
				$sql_update_farmer	.= " 	SET `fm_name`='".$txt_name."', ";
				$sql_update_farmer	.= " 		`fm_caid`='".$fm_caid."', ";
				$sql_update_farmer	.= " 		`fm_org_id`='".$fm_org_id."', ";
				$sql_update_farmer	.= " 		`fm_aadhar`='".$fm_aadhar."', ";
				$sql_update_farmer	.= " 		`fm_mobileno`='".$fm_mobileno."', ";
				$sql_update_farmer	.= " 		`fm_status`='1', ";
				$sql_update_farmer	.= " 		`fm_modifieddt`='".$datetime."', ";
				$sql_update_farmer	.= " 		`fm_modifiedby`='".$fm_caname."' ";
				$sql_update_farmer	.= " WHERE `fm_id`='".$hid_fm_id."' ";
				$res_update_farmer	= mysqli_query($db_con, $sql_update_farmer) or die(mysqli_error($db_con));
				
				if($res_update_farmer)
				{
					// Query For getting the Farmer Info
					$sql_get_farmer_info	= " SELECT * FROM `tbl_farmers` WHERE `fm_id`='".$hid_fm_id."' ";
					$res_get_farmer_info	= mysqli_query($db_con, $sql_get_farmer_info) or die(mysqli_error($db_con));
					$row_get_farmer_info	= mysqli_fetch_array($res_get_farmer_info);
					
					// $fm_caid	= $row_get_farmer_info['fm_caid'];
					
					// Query for Checking the User
					$sql_chk_farmer	= " SELECT * FROM `tbl_personal_detail` WHERE `fm_id`='".$hid_fm_id."' ";
					$res_chk_farmer	= mysqli_query($db_con, $sql_chk_farmer) or die(mysqli_error($db_con));
					$num_chk_farmer	= mysqli_num_rows($res_chk_farmer);
					
					$res_update_farmer_details	= 'false';
					
					if($num_chk_farmer != 0)
					{
						// Query for updating the farmer personal details into tbl_personal_detail
						$sql_update_farmer_details = " UPDATE `tbl_personal_detail` ";
						$sql_update_farmer_details .= " 	SET `f1_mfname`='".$txt_mother_name."', ";
						$sql_update_farmer_details .= " 		`f1_father`='".$txt_father_name."', ";
						$sql_update_farmer_details .= " 		`fm_caid`='".$fm_caid."', ";
						$sql_update_farmer_details .= " 		`f1_age`='".$txt_age."', ";
						$sql_update_farmer_details .= " 		`f1_dob`='".$txt_dob."', ";
						$sql_update_farmer_details .= " 		`f1_mobno`='".$fm_mobileno."', ";
						$sql_update_farmer_details .= " 		`f1_altno`='".$alt_mobileno."', ";
						$sql_update_farmer_details .= " 		`f1_expfarm`='".$txt_farm_experience."', ";
						$sql_update_farmer_details .= " 		`f1_any_other_occupation`='".$f1_any_other_occupation."', ";
						$sql_update_farmer_details .= " 		`f1_occupation_amt`='".$f1_occupation_amt."', ";
						$sql_update_farmer_details .= " 		`f1_required_loan`='".$f1_required_loan."', ";
						$sql_update_farmer_details .= " 		`f1_required_loan_amt`='".$f1_required_loan_amt."', ";
						$sql_update_farmer_details .= " 		`f1_loan_purpose`='".$f1_loan_purpose."', ";
						$sql_update_farmer_details .= " 		`f1_crop_cycle`='".$f1_crop_cycle."', ";
						$sql_update_farmer_details .= " 		`f1_status`='1', ";
						$sql_update_farmer_details .= " 		`f1_points`='".$hid_personal_details_points."', ";
						$sql_update_farmer_details .= " 		`f1_modified_date`='".$datetime."', ";
						$sql_update_farmer_details .= " 		`f1_modified_by`='".$fm_caname."' ";
						$sql_update_farmer_details .= " WHERE `fm_id`='".$hid_fm_id."' ";
						$res_update_farmer_details = mysqli_query($db_con, $sql_update_farmer_details) or die(mysqli_error($db_con));
					}
					else
					{
						// Query for updating the farmer personal details into tbl_personal_detail
						$sql_update_farmer_details    = " INSERT INTO `tbl_personal_detail`(`fm_caid`, `fm_id`, `f1_mfname`, ";
						$sql_update_farmer_details	.= "  `f1_father`, `f1_age`, `f1_dob`, `f1_mobno`, `f1_altno`, ";
						$sql_update_farmer_details	.= " `f1_expfarm`, ";
						$sql_update_farmer_details	.= " `f1_required_loan`, `f1_required_loan_amt`, `f1_loan_purpose`, `f1_crop_cycle`, ";
						$sql_update_farmer_details	.= " `f1_any_other_occupation`, `f1_occupation_amt`, ";
						$sql_update_farmer_details	.= " `f1_status`, `f1_points`, ";
						$sql_update_farmer_details	.= " `f1_created_date`, `f1_created_by`) ";
						$sql_update_farmer_details	.= " VALUES ('".$fm_caid."', '".$hid_fm_id."', '".$txt_mother_name."', ";
						$sql_update_farmer_details	.= " '".$txt_father_name."', '".$txt_age."', '".$txt_dob."', '".$fm_mobileno."', ";
						$sql_update_farmer_details	.= " '".$alt_mobileno."', '".$txt_farm_experience."', ";
						$sql_update_farmer_details	.= " '".$f1_required_loan."', '".$f1_required_loan_amt."', '".$f1_loan_purpose."', '".$f1_crop_cycle."', ";
						$sql_update_farmer_details	.= " '".$f1_any_other_occupation."', '".$f1_occupation_amt."', ";
						$sql_update_farmer_details	.= " '1', '".$hid_personal_details_points."', ";
						$sql_update_farmer_details	.= " '".$datetime."', '".$fm_caname."') ";
						$res_update_farmer_details	= mysqli_query($db_con, $sql_update_farmer_details) or die(mysqli_error($db_con));
					}
					
 					if($res_update_farmer_details)
					{
						$sql_chk_sd_farmer	= " SELECT * FROM `tbl_spouse_details` WHERE `fm_id`='".$hid_fm_id."' ";
						$res_chk_sd_farmer	= mysqli_query($db_con, $sql_chk_sd_farmer) or die(mysqli_error($db_con));
						$num_chk_sd_farmer	= mysqli_num_rows($res_chk_sd_farmer);
						
						$res_update_farmer_IsMarried	= 'false';
						
						if($num_chk_sd_farmer != 0)
						{
							// Query for inserting the married status in tbl_spouse_details
							$sql_update_farmer_IsMarried	= " UPDATE `tbl_spouse_details` ";
							$sql_update_farmer_IsMarried	.= " 	SET `f3_married`='".$ddl_married_status."', ";
							$sql_update_farmer_IsMarried	.= " 		`fm_caid`='".$fm_caid."', ";
							$sql_update_farmer_IsMarried	.= " 		`f3_married_reg_points`='".$f3_married_reg_points."', ";
							$sql_update_farmer_IsMarried	.= " 		`f3_modified_date`='".$datetime."', ";
							$sql_update_farmer_IsMarried	.= " 		`f3_modified_by`='".$fm_caname."' ";
							$sql_update_farmer_IsMarried	.= "  WHERE `fm_id`='".$hid_fm_id."' ";
							$res_update_farmer_IsMarried	= mysqli_query($db_con, $sql_update_farmer_IsMarried) or die(mysqli_error($db_con));
						}
						else
						{
							// Query for inserting the married status in tbl_spouse_details
							$sql_update_farmer_IsMarried	= " INSERT INTO `tbl_spouse_details`(`fm_caid`, `fm_id`, `f3_married`, ";
							$sql_update_farmer_IsMarried	.= " `f3_married_reg_points`, `f3_created_date`, `f3_created_by`) ";
							$sql_update_farmer_IsMarried	.= " VALUES ('".$fm_caid."', '".$hid_fm_id."', '".$ddl_married_status."', ";
							$sql_update_farmer_IsMarried	.= " '".$f3_married_reg_points."', '".$datetime."', '".$fm_caname."') ";
							$res_update_farmer_IsMarried	= mysqli_query($db_con, $sql_update_farmer_IsMarried) or die(mysqli_error($db_con));
						}
						
						if($res_update_farmer_IsMarried)
						{
							$sql_chk_rd_farmer	= " SELECT * FROM `tbl_residence_details` WHERE `fm_id`='".$hid_fm_id."' ";
							$res_chk_rd_farmer	= mysqli_query($db_con, $sql_chk_rd_farmer) or die(mysqli_error($db_con));
							$num_chk_rd_farmer	= mysqli_num_rows($res_chk_rd_farmer);
							
							$res_update_farmer_address	= 'false';
							
							if($num_chk_rd_farmer != 0)
							{
								// Query For updating the recidencial data into tbl_residence_details
								$sql_update_farmer_address	= " UPDATE `tbl_residence_details` ";
								$sql_update_farmer_address	.= " 	SET `f7_resistatus`='".$ddl_residence_status."', ";
								$sql_update_farmer_address	.= " 		`fm_caid`='".$fm_caid."', ";
								$sql_update_farmer_address	.= " 		`f7_rent_amount`='".$txt_rent."', ";
								$sql_update_farmer_address	.= " 		`f7_phouse`='".$txt_p_house_no."', ";
								$sql_update_farmer_address	.= " 		`f7_pstreet`='".$txt_p_street_name."', ";
								$sql_update_farmer_address	.= " 		`f7_parea`='".$txt_p_area_name."', ";
								$sql_update_farmer_address	.= " 		`f7_pstate`='".$ddl_p_state."', ";
								$sql_update_farmer_address	.= " 		`f7_pdistrict`='".$ddl_p_dist."', ";
								$sql_update_farmer_address	.= " 		`f7_ptaluka`='".$ddl_p_tal."', ";
								$sql_update_farmer_address	.= " 		`f7_pvillage`='".$ddl_p_village."', ";
								$sql_update_farmer_address	.= " 		`f7_ppin`='".$txt_p_pincode."', ";
								$sql_update_farmer_address	.= " 		`f7_chouse`='".$txt_c_house_no."', ";
								$sql_update_farmer_address	.= " 		`f7_cstreet`='".$txt_c_street_name."', ";
								$sql_update_farmer_address	.= " 		`f7_carea`='".$txt_c_area_name."', ";
								$sql_update_farmer_address	.= " 		`f7_cstate`='".$ddl_c_state."', ";
								$sql_update_farmer_address	.= " 		`f7_cdistrict`='".$ddl_c_dist."', ";
								$sql_update_farmer_address	.= " 		`f7_ctaluka`='".$ddl_c_tal."', ";
								$sql_update_farmer_address	.= " 		`f7_cvillage`='".$ddl_c_village."', ";
								$sql_update_farmer_address	.= " 		`f7_cpin`='".$txt_c_pincode."', ";
								$sql_update_farmer_address	.= " 		`f7_reg_points`='".$hid_residence_points."', ";
								$sql_update_farmer_address	.= " 		`f7_modified_date`='".$datetime."', ";
								$sql_update_farmer_address	.= " 		`f7_modified_by`='".$fm_caname."' ";
								$sql_update_farmer_address	.= " WHERE `fm_id`='".$hid_fm_id."' ";
								$res_update_farmer_address	= mysqli_query($db_con, $sql_update_farmer_address) or die(mysqli_error($db_con));
							}
							else
							{
								// Query For updating the recidencial data into tbl_residence_details
								$sql_update_farmer_address	= " INSERT INTO `tbl_residence_details`(`fm_caid`, `fm_id`, `f7_resistatus`, ";
								$sql_update_farmer_address	.= " `f7_rent_amount`, `f7_phouse`, `f7_pstreet`, `f7_parea`, ";
								$sql_update_farmer_address	.= " `f7_pstate`, `f7_pdistrict`, `f7_ptaluka`, `f7_pvillage`, ";
								$sql_update_farmer_address	.= " `f7_ppin`, `f7_chouse`, `f7_cstreet`, `f7_carea`, ";
								$sql_update_farmer_address	.= " `f7_cstate`, `f7_cdistrict`, `f7_ctaluka`, `f7_cvillage`, `f7_cpin`, ";
								$sql_update_farmer_address	.= " `f7_reg_points`, `f7_created_date`, `f7_created_by`) ";
								$sql_update_farmer_address	.= " VALUES ('".$fm_caid."', '".$hid_fm_id."',  '".$ddl_residence_status."', '".$txt_rent."', ";
								$sql_update_farmer_address	.= " '".$txt_p_house_no."', '".$txt_p_street_name."', '".$txt_p_area_name."', '".$ddl_p_state."', '".$ddl_p_dist."', ";
								$sql_update_farmer_address	.= " '".$ddl_p_tal."', '".$ddl_p_village."', '".$txt_p_pincode."', '".$txt_c_house_no."', '".$txt_c_street_name."', ";
								$sql_update_farmer_address	.= " '".$txt_c_area_name."', '".$ddl_c_state."', '".$ddl_c_dist."', '".$ddl_c_tal."', '".$ddl_c_village."', ";
								$sql_update_farmer_address	.= " '".$txt_c_pincode."', '".$hid_residence_points."', '".$datetime."', '".$fm_caname."') ";
								$res_update_farmer_address	= mysqli_query($db_con, $sql_update_farmer_address) or die(mysqli_error($db_con));
							}
							
							if($res_update_farmer_address)
							{
								$sql_chk_tp_farmer	= " SELECT * FROM `tbl_points` WHERE `fm_id`='".$hid_fm_id."' ";
								$res_chk_tp_farmer	= mysqli_query($db_con, $sql_chk_tp_farmer) or die(mysqli_error($db_con));
								$num_chk_tp_farmer	= mysqli_num_rows($res_chk_tp_farmer);
								
								$res_update_points	= 'false';
								
								if($num_chk_tp_farmer != 0)
								{
									// Query for updating the record for Points of the f1 and f7
									$sql_update_points	= " UPDATE `tbl_points` ";
									$sql_update_points	.= " 	SET `pt_frm1`='".$hid_personal_details_points."', ";
									$sql_update_points	.= " 		`pt_frm3`='".$f3_married_reg_points."', ";
									$sql_update_points	.= " 		`pt_frm7`='".$hid_residence_points."' ";
									$sql_update_points	.= " WHERE `fm_id`='".$hid_fm_id."' ";
									$res_update_points	= mysqli_query($db_con, $sql_update_points) or die(mysqli_error($db_con));
								}
								else
								{
									// Query for updating the record for Points of the f1 and f7
									$sql_update_points	= " INSERT INTO `tbl_points`(`fm_id`, `pt_frm1`, `pt_frm3`, `pt_frm7`) ";
									$sql_update_points	.= " VALUES ('".$hid_fm_id."', '".$hid_personal_details_points."', '".$f3_married_reg_points."', '".$hid_residence_points."') ";
									$res_update_points	= mysqli_query($db_con, $sql_update_points) or die(mysqli_error($db_con));
								}
								
								if($res_update_points)
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
								quit('Insertion Error, Please try after sometime');			
							}
						}
						else
						{
							quit('Insertion Error, Please try after sometime');	
						}
					}
					else
					{
						quit('Insertion Error, Please try after sometime');	
					}
				}
				else
				{
					quit('Insertion Error, Please try after sometime');	
				}
			}
			else
			{
				quit('Name, Aadhar no, Mobile no cannot be blank!!!');	
			}
		}
		else
		{
			quit('Aadhar no already in use!!!');	
		}	
	}
	
	if((isset($obj->load_farmer)) == "1" && isset($obj->load_farmer))
	{
		$response_array = array();	
		$start_offset   = 0;
		$avg_of_points  = 0;
		
		$page           = mysqli_real_escape_string($db_con,$obj->page);	
		$per_page       = mysqli_real_escape_string($db_con,$obj->row_limit);
		$search_text    = mysqli_real_escape_string($db_con,$obj->search_text);	
		$hid_user_type  = mysqli_real_escape_string($db_con,$obj->hid_user_type); 
		$hid_ca_id      = mysqli_real_escape_string($db_con,$obj->hid_ca_id);
		$hid_org_id 	= mysqli_real_escape_string($db_con,$obj->hid_org_id);
		 
		if($page != "" && $per_page != "")	
		{
			$cur_page 		= $page;
			$page 	   	   	= $page - 1;
			$start_offset 	+= $page * $per_page;
			$start 			= $page * $per_page;
				
			$sql_load_data  = " select tf.*, tca.fname AS change_agent_name, torg.org_name from tbl_farmers AS tf INNER JOIN tbl_change_agents AS tca ON tf.fm_caid = tca.id INNER JOIN tbl_organization AS torg ON tf.fm_org_id = torg.id WHERE 1=1 ";
			if(strcmp($hid_user_type,'Admin')!==0)
			{
				if(strcmp($hid_user_type,'FPO')===0)
				{
					$sql_load_data  .= " AND tf.fm_org_id='".$hid_org_id."' ";
				}
				else
				{
					$sql_load_data  .= " AND tf.fm_caid='".$hid_ca_id."' ";
				}
			}
			if($search_text != "")
			{
				$sql_load_data .= " and (tf.fm_id LIKE '%".$search_text."%' OR tf.fm_name like '%".$search_text."%' or tf.fm_aadhar like '%".$search_text."%' ";
				$sql_load_data .= " or tf.fm_mobileno like '%".$search_text."%' OR torg.org_name LIKE '%".$search_text."%') ";	
			}
			// quit($sql_load_data);
			$data_count		= 	dataPagination($sql_load_data,$per_page,$start,$cur_page);		
			$sql_load_data .=" ORDER BY tf.id DESC LIMIT $start, $per_page ";
			$result_load_data = mysqli_query($db_con,$sql_load_data) or die(mysqli_error($db_con));			
			
					
			if(strcmp($data_count,"0") !== 0)
			{		
				$cat_data = "";			
				$cat_data .='<form id="mainform1" action="deletefarmerdetails.php?pag=farmers" method="post">'; // &fmca_id='.$hid_ca_id.'
				$cat_data .= '<table id="tbl_farmer" class="table table-bordered dataTable" style="width:100%;text-align:center">';
				$cat_data .= '<thead>';
					$cat_data .= '<tr>';
						$cat_data .= '<th>Sr no.</th>';
						$cat_data .= '<th>Forms</th>';
						$cat_data .= '<th>Docs Upload</th>';
						$cat_data .= '<th>Farmer ID</th>';
						$cat_data .= '<th>Farmer Name</th>';
						$cat_data .= '<th>Aadhaar No</th>';
						$cat_data .= '<th>Mobile No</th>';
						$cat_data .= '<th>Total Points</th>';
						$cat_data .= '<th>Organisation</th>';
						$cat_data .= '<th>Change Agent</th>';
						$cat_data .= '<th>Status</th>';
						$cat_data .= '<th class="hidden-350">Created Date</th>';
						$cat_data .= '<th>PDF<br>Download</th>';
						$cat_data .= '<th>Edit</th>';
						$cat_data .= '<th>';
						$cat_data .= '<a href="javascript:void(0)" onclick="getExcel()" class="btn btn-primary">Excel</a>';

						$cat_data .='</th>';
						if($_SESSION['userType']=="Admin")
						{
							$cat_data .= '<th style="text-align:center" class="hidden-480"><a href="#"><input type="checkbox" id="selectall" /></a>
							<input type="submit" name="main" value="Delete" style="margin-left:10px; width:80px;height:30px;font-size:16px" /></th>';
						}
					$cat_data .= '</tr>';
				$cat_data .= '</thead>';
				$cat_data .= '<tbody>';
				while($row_load_data = mysqli_fetch_array($result_load_data))
				{
					$farmer_isComplete = '';
					$result = lookup_value('tbl_points',array(),array("fm_id"=>$row_load_data['fm_id']),array(),array(),array());
					if($result)
					{
						$num	= mysqli_num_rows($result);
						if($num != 0)
						{
							$pt_row	= mysqli_fetch_array($result);

							$sum_of_points	= $pt_row['pt_frm1'] + $pt_row['pt_frm2'] + $pt_row['pt_frm3'] + $pt_row['pt_frm4'] + $pt_row['pt_frm5'] + $pt_row['pt_frm7'] + $pt_row['pt_frm8'] + $pt_row['pt_frm9'] + $pt_row['pt_frm10'] + $pt_row['pt_frm11'] + $pt_row['pt_frm12'] + $pt_row['pt_frm13'] + $pt_row['pt_frm14']; //$pt_row['pt_frm6'] + + $pt_row['pt_frm8_fh'] 
					
							// $avg_of_points	= round($sum_of_points / 15, 2);
							$avg_of_points	= round($sum_of_points / 14, 2);
						}
					}
					$cat_data .= '<tr>';				
						$cat_data .= '<td class="center-text">'.++$start_offset.'</td>';				
						$cat_data .= '<td style="text-align:center;">';
							$cat_data .= '<a href="get_farmer_details.php?pag=farmers&fm_id='.$row_load_data['fm_id'].'" class="btn btn-primary">View Forms</a>';
						$cat_data .= '</td>';	//<!-- Forms -->
						$cat_data .= '<td style="text-align:center;">';
							$cat_data .= '<a href="get_farmerdoc.php?pag=farmers&fm_id='.$row_load_data['fm_id'].'" class="btn btn-primary">View Uploads</a>';
						$cat_data .= '</td>';	//<!-- Docs Upload -->
						$cat_data .= '<td>'.$row_load_data['fm_id'].'</td>';	//<!-- Farmer ID -->
						$cat_data .= '<td>';
							$cat_data .= ucwords($row_load_data['fm_name']);
						
							$sql_check_point  	= " SELECT * FROM tbl_points ";
							$sql_check_point  	.= " WHERE pt_frm1 !='' AND pt_frm2 !='' ";
							$sql_check_point  	.= " 	AND pt_frm3 !=''  ";
							$sql_check_point  	.= " 	 AND pt_frm7 !='' ";
							$sql_check_point  	.= " 	AND pt_frm8 !='' AND pt_frm9 !='' ";
							$sql_check_point  	.= " 	AND pt_frm10 !='' AND pt_frm5 !='' ";
							$sql_check_point  	.= " 	AND pt_frm12 !='' AND pt_frm13 !='' ";
							$sql_check_point  	.= " 	AND pt_frm11 !='' "; //AND pt_frm8_fh !='' AND pt_frm6 !=''
							$sql_check_point  	.= " 	AND fm_id='".$row_load_data['fm_id']."' ";
							$res_check_point  = mysqli_query($db_con,$sql_check_point) or die(mysqli_error($db_con));
							$num_check_point  = mysqli_num_rows($res_check_point);
							if($num_check_point==0)
							{
								$cat_data .= ' <br><small style="color:red">Incomplete</small>';
								$farmer_isComplete = 2;
							}
							else
							{
								$cat_data .= ' <br><small style="color:green">Complete</small>';
								$farmer_isComplete = 1;
							}
							
							$cat_data .= '<br>';

						$cat_data .= '</td>';	//<!-- Farmer Name -->
						$cat_data .= '<td>'.$row_load_data['fm_aadhar'].'</td>';	//<!-- Aadhaar Number -->
						$cat_data .= '<td>'.$row_load_data['fm_mobileno'].'</td>';	//<!-- Mobile Number -->
						$cat_data .= '<td>'.$avg_of_points.'</td>';	//<!-- Loan Required (Rs.) -->
						$cat_data .= '<td>'.ucwords($row_load_data['org_name']).'</td>';	//<!-- Organisation -->
						$cat_data .= '<td>'.ucwords($row_load_data['change_agent_name']).'</td>';	//<!-- Change Agent Name -->
						$cat_data .= '<td>';
						if($row_load_data['fm_status'] == '1')
						{
							$cat_data .= 'Active';
						}
						else
						{
							$cat_data .= 'Inactive';
						}
						$cat_data .= '</td>';	//<!-- Status -->
						$cat_data .= '<td>'.$row_load_data['fm_createddt'].'</td>';	//<!-- Created Date -->
						$cat_data .= '<td>';
							$cat_data .= '<a href="javascript:void(0)" onclick="getPdfDownload('.$row_load_data['fm_id'].', '.$farmer_isComplete.')" class="btn btn-primary" download>PDF DOWNLOAD</a>';
						$cat_data .= '</td>';	// PDF DOWNLOAD
						$cat_data .= '<td style="text-align:center;">';
							$cat_data .= '<a href="edit_farmer.php?pag=farmers&fm_id='.$row_load_data['fm_id'].'" class="btn btn-primary">Edit</a>';
						$cat_data .= '</td>';	//<!-- Edit Farmers -->

						$cat_data .='<td><div align="center"><input type="checkbox" class="case-excel"  value="'.$row_load_data['fm_id'].'" /></div></td>'; //<!-- Delete Farmers -->

						if($_SESSION['userType']=="Admin")
						{
						$cat_data .='<td><div align="center"><input type="checkbox" class="case" name="farmer_id[]" value="'.$row_load_data['fm_id'].'" /></div></td>'; //<!-- Delete Farmers -->
						}


					$cat_data .= '</tr>';															
				}	
				$cat_data .= '</tbody>';
				$cat_data .= '</table>';
				$cat_data .= '</form>';
				$cat_data .= $data_count;
				$response_array = array("Success"=>"Success","resp"=>$cat_data);					
			}
			else
			{
				$response_array = array("Success"=>"fail","resp"=>"No Data Available");
			}
		}
		else
		{
			$response_array = array("Success"=>"fail","resp"=>"No Row Limit and Page Number Specified");
		}
		echo json_encode($response_array);	
	}

	if((isset($obj->remove_farmer_service_provider)) == 1 && isset($obj->remove_farmer_service_provider))
	{
		$farmer_servpro = $obj->farmer_servpro;
		$farmer_id 		= $obj->farmer_id;
		$delete_flag    = 0;
		
		foreach($farmer_servpro as $id)
		{
			$sql_delete = " DELETE FROM tbl_farmer_servpro WHERE id='".$id."' ";
			$res_delete = mysqli_query($db_con,$sql_delete) or die(mysqli_error($db_con));
			if($res_delete)
			{
				$delete_flag = 1;
			}
		}
		if($delete_flag==1)
		{
			$servProvData	= getServProvPart($farmer_id);

			quit(utf8_encode($servProvData),1);
		}
		quit('Something went wrong..!');
	}

	if((isset($obj->add_serv_prov)) == '1' && (isset($obj->add_serv_prov)))
	{
		$farmer_id 		= $obj->farmer_id;
		$servProvIds	= $obj->f5_servpro;

		foreach($servProvIds as $servProvId)
		{
			$data1['fm_id']			= $farmer_id;
			$data1['serv_pro_name']	= $servProvId;
			$data1['status']		= '1';
			$data1['created_date']	= $datetime;
			$data1['created_by']	= $fm_caid;

			insert('tbl_farmer_servpro',$data1);
		}

		$displayPart	= getServProvPart($farmer_id);

		quit(utf8_encode($displayPart),1);
	}

	function getServProvPart($farmer_id)
	{
		global $db_con;
		$startOffset    = 0;
		$servProvData	= '';

		// Query For Getting the list of service Provider
		$sql_get_list_servpro	= " SELECT * FROM `tbl_servpro` WHERE `servpro_status`='1' AND servpro_name NOT IN (SELECT DISTINCT(serv_pro_name) FROM tbl_farmer_servpro WHERE fm_id='".$farmer_id."') ";
		$res_get_list_servpro	= mysqli_query($db_con, $sql_get_list_servpro) or die(mysqli_error($db_con));
		$num_get_list_servpro	= mysqli_num_rows($res_get_list_servpro);

		$servProvData	.= '<select multiple="multiple"  onChange="console.log($(this).children(\':selected\').length)" placeholder="Select Service Provider" id="f5_servpro" name="f5_servpro[]" class="select2-me input-xxlarge" >';
        if($num_get_list_servpro != 0)
        {
        	while($row_get_list_servpro = mysqli_fetch_array($res_get_list_servpro))
        	{
        		$servProvData	.= '<option value="'.$row_get_list_servpro['servpro_name'].'" >';
            		$servProvData	.= ucwords($row_get_list_servpro['servpro_name']);
            	$servProvData	.= '</option>';
            }
        }
        $servProvData	.= '</select>';

        $servProvData	.= '<input value="Add Here" class="btn-success" type="button" onclick="addServProv('.$farmer_id.');">';

        $servProvData .= '<script type="text/javascript">';
		$servProvData .= '$("#f5_servpro").select2();';
		$servProvData .= '</script>';

		$sql_get_farmer_servpro	= " SELECT * FROM `tbl_farmer_servpro` WHERE `fm_id`='".$farmer_id."' ";
        $res_get_farmer_servpro	= mysqli_query($db_con, $sql_get_farmer_servpro) or die(mysqli_error($db_con));
        $num_get_farmer_servpro	= mysqli_num_rows($res_get_farmer_servpro);

		

		$servProvData	.= '<table class="table table-bordered dataTable">';
			$servProvData	.= '<thead>';
			$servProvData	.= '	<th>Sr. No.</th>';
			$servProvData	.= '	<th>Service Provider</th>';
			$servProvData	.= '	<th style="text-align:center">';
			$servProvData	.= '		<div style="text-align:center">';
			$servProvData	.= '			<input type="button" value="Delete" onclick="multipleServProDelete('.$farmer_id.');" class="btn-danger"/>';
			$servProvData	.= '		</div>';
			$servProvData	.= '	</th>';
			$servProvData	.= '</thead>';
			$servProvData	.= '<tbody>';
			if($num_get_farmer_servpro != 0)
			{
				while($row_get_farmer_servpro = mysqli_fetch_array($res_get_farmer_servpro))
				{
					$servProvData	.= '<tr>';
						$servProvData	.= '<td>'.++$startOffset.'</td>';
						$servProvData	.= '<td>'.ucwords($row_get_farmer_servpro['serv_pro_name']).'</td>';
						$servProvData	.= '<td align="center">';
							$servProvData	.= '<input type="checkbox" value="'.$row_get_farmer_servpro['id'].'" id="farmer_servpro_'.$row_get_farmer_servpro['id'].'" name="farmer_servpro_'.$row_get_farmer_servpro['id'].'" class="css-checkbox farmer_servpro">';
						$servProvData	.= '</td>';
					$servProvData	.= '</tr>';
				}
			}
			else
			{
				$servProvData	.= '<td>&nbsp;</td>';
				$servProvData	.= '<td>No Match Found</td>';
			}
			$servProvData	.= '</tbody>';
		$servProvData	.= '</table>';

		return $servProvData;
	}

	if((isset($obj->add_f9_water_source)) == '1' && (isset($obj->add_f9_water_source)))
	{
		$farmer_id 			= $obj->farmer_id;
		$f9_source_of_water	= $obj->f9_source_of_water;
		$incrementalID		= $obj->incrementalID;

		foreach($f9_source_of_water as $f9_source_of_water_name)
		{
			$data1['fm_id']             = $farmer_id;
			$data1['water_source_name'] = $f9_source_of_water_name;
			$data1['count']             = $incrementalID;
			$data1['status']            = '1';
			$data1['created_date']      = $datetime;
			$data1['created_by']        = $fm_caid;

			insert('tbl_f9_farmer_water_source',$data1);
		}

		$displayPart	= getf9WaterSource($farmer_id, $incrementalID);

		quit(utf8_encode($displayPart),1);
	}

	if((isset($obj->remove_farmer_f9_water_source)) == 1 && isset($obj->remove_farmer_f9_water_source))
	{
		$f9_water_source = $obj->f9_water_source;
		$farmer_id 		= $obj->farmer_id;
		$incrementalID	= $obj->incrementalID;
		$delete_flag    = 0;
		
		foreach($f9_water_source as $id)
		{
			$sql_delete = " DELETE FROM tbl_f9_farmer_water_source WHERE id='".$id."' ";
			$res_delete = mysqli_query($db_con,$sql_delete) or die(mysqli_error($db_con));
			if($res_delete)
			{
				$delete_flag = 1;
			}
		}
		if($delete_flag==1)
		{
			$f9_waterSourceData	= getf9WaterSource($farmer_id, $incrementalID);

			quit(utf8_encode($f9_waterSourceData),1);
		}
		quit('Something went wrong..!');
	}

	if((isset($obj->add_f10_water_source)) == '1' && (isset($obj->add_f10_water_source)))
	{
		$farmer_id             = $obj->farmer_id;
		$f10_water_source_type = $obj->f10_water_source_type;
		$incrementalID         = $obj->incrementalID;

		foreach($f10_water_source_type as $f10_water_source_type_name)
		{
			$data1['fm_id']             = $farmer_id;
			$data1['water_source_name'] = $f10_water_source_type_name;
			$data1['count']             = $incrementalID;
			$data1['status']            = '1';
			$data1['created_date']      = $datetime;
			$data1['created_by']        = $fm_caid;

			insert('tbl_f10_farmer_water_source',$data1);
		}

		$displayPart	= getf10WaterSource($farmer_id, $incrementalID);

		quit(utf8_encode($displayPart),1);
	}

	if((isset($obj->remove_farmer_f10_water_source)) == 1 && isset($obj->remove_farmer_f10_water_source))
	{
		$f10_water_source = $obj->f10_water_source;
		$farmer_id        = $obj->farmer_id;
		$incrementalID    = $obj->incrementalID;
		$delete_flag      = 0;
		
		foreach($f10_water_source as $id)
		{
			$sql_delete = " DELETE FROM tbl_f10_farmer_water_source WHERE id='".$id."' ";
			$res_delete = mysqli_query($db_con,$sql_delete) or die(mysqli_error($db_con));
			if($res_delete)
			{
				$delete_flag = 1;
			}
		}
		if($delete_flag==1)
		{
			$f10_waterSourceData	= getf10WaterSource($farmer_id, $incrementalID);

			quit(utf8_encode($f10_waterSourceData),1);
		}
		quit('Something went wrong..!');
	}

	if((isset($obj->add_f11_water_source)) == '1' && (isset($obj->add_f11_water_source)))
	{
		$farmer_id             = $obj->farmer_id;
		$f11_water_source_type = $obj->f11_water_source_type;
		$incrementalID         = $obj->incrementalID;

		foreach($f11_water_source_type as $f11_water_source_type_name)
		{
			$data1['fm_id']             = $farmer_id;
			$data1['water_source_name'] = $f11_water_source_type_name;
			$data1['count']             = $incrementalID;
			$data1['status']            = '1';
			$data1['created_date']      = $datetime;
			$data1['created_by']        = $fm_caid;

			insert('tbl_f11_farmer_water_source',$data1);
		}

		$displayPart	= getf11WaterSource($farmer_id, $incrementalID);

		quit(utf8_encode($displayPart),1);
	}

	if((isset($obj->remove_farmer_f11_water_source)) == 1 && isset($obj->remove_farmer_f11_water_source))
	{
		$f11_water_source = $obj->f11_water_source;
		$farmer_id        = $obj->farmer_id;
		$incrementalID    = $obj->incrementalID;
		$delete_flag      = 0;
		
		foreach($f11_water_source as $id)
		{
			$sql_delete = " DELETE FROM tbl_f11_farmer_water_source WHERE id='".$id."' ";
			$res_delete = mysqli_query($db_con,$sql_delete) or die(mysqli_error($db_con));
			if($res_delete)
			{
				$delete_flag = 1;
			}
		}
		if($delete_flag==1)
		{
			$f11_waterSourceData	= getf11WaterSource($farmer_id, $incrementalID);

			quit(utf8_encode($f11_waterSourceData),1);
		}
		quit('Something went wrong..!');
	}

	if((isset($obj->add_f14_water_source)) == '1' && (isset($obj->add_f14_water_source)))
	{
		$farmer_id             = $obj->farmer_id;
		$f14_water_source_type = $obj->f14_water_source_type;
		$incrementalID         = $obj->incrementalID;

		foreach($f14_water_source_type as $f14_water_source_type_name)
		{
			$data1['fm_id']             = $farmer_id;
			$data1['water_source_name'] = $f14_water_source_type_name;
			$data1['count']             = $incrementalID;
			$data1['status']            = '1';
			$data1['created_date']      = $datetime;
			$data1['created_by']        = $fm_caid;

			insert('tbl_f14_farmer_water_source',$data1);
		}

		$displayPart	= getf14WaterSource($farmer_id, $incrementalID);

		quit(utf8_encode($displayPart),1);
	}

	if((isset($obj->remove_farmer_f14_water_source)) == 1 && isset($obj->remove_farmer_f14_water_source))
	{
		$f14_water_source = $obj->f14_water_source;
		$farmer_id        = $obj->farmer_id;
		$incrementalID    = $obj->incrementalID;
		$delete_flag      = 0;
		
		foreach($f14_water_source as $id)
		{
			$sql_delete = " DELETE FROM tbl_f14_farmer_water_source WHERE id='".$id."' ";
			$res_delete = mysqli_query($db_con,$sql_delete) or die(mysqli_error($db_con));
			if($res_delete)
			{
				$delete_flag = 1;
			}
		}
		if($delete_flag==1)
		{
			$f14_waterSourceData	= getf14WaterSource($farmer_id, $incrementalID);

			quit(utf8_encode($f14_waterSourceData),1);
		}
		quit('Something went wrong..!');
	}
	
	function getf9WaterSource($farmer_id, $incrementalID)
	{
		global $db_con;
		$startOffset    	= 0;
		$f9WaterSourceData	= '';

		// Query For getting the list of Water Source
		$sql_get_f9_water_source_list	= " SELECT * FROM `tbl_water_source` ";
		$sql_get_f9_water_source_list	.= " WHERE `status`='1' AND water_source NOT IN (SELECT DISTINCT(water_source_name) ";
		$sql_get_f9_water_source_list	.= " FROM tbl_f9_farmer_water_source ";
		$sql_get_f9_water_source_list	.= " WHERE fm_id='".$farmer_id."' AND count='".$incrementalID."') ";
    	$res_get_f9_water_source_list 	= mysqli_query($db_con, $sql_get_f9_water_source_list) or die(mysqli_error($db_con));
		if($res_get_f9_water_source_list)
		{
			$num_get_f9_water_source_list	= mysqli_num_rows($res_get_f9_water_source_list);
			
			$f9WaterSourceData	.= '<select id="f9_source_of_water'.$incrementalID.'" name="f9_source_of_water'.$incrementalID.'[]" multiple="multiple"  onChange="console.log($(this).children(\':selected\').length)" placeholder="Select Water Source" class="select2-me input-xxlarge" >';
               	if($num_get_f9_water_source_list != 0)
				{
					while($row_get_f9_water_source_list	= mysqli_fetch_array($res_get_f9_water_source_list))
					{
                		$f9WaterSourceData	.= '<option point="'.$row_get_f9_water_source_list['points'].'" value="'.$row_get_f9_water_source_list['water_source'].'">'.trim(ucwords($row_get_f9_water_source_list['water_source'])).'</option>';
                    }
				}
				else
				{
					$f9WaterSourceData	.= '<option point="0" value="">No Match Found</option>';
                }
            $f9WaterSourceData	.= '</select>';

            $f9WaterSourceData .= '<script type="text/javascript">';
			$f9WaterSourceData .= '$("#f9_source_of_water'.$incrementalID.'").select2();';
			$f9WaterSourceData .= '</script>';

            $f9WaterSourceData	.= '<input value="Add Here" class="btn-success" type="button" onclick="addf9WaterSource('.$farmer_id.', '.$incrementalID.');">';
			// Query For getting the Service Provider list for that user
            $sql_get_f9_farmer_water_source	= " SELECT * FROM `tbl_f9_farmer_water_source` WHERE `fm_id`='".$farmer_id."' AND count='".$incrementalID."' ";
            $res_get_f9_farmer_water_source	= mysqli_query($db_con, $sql_get_f9_farmer_water_source) or die(mysqli_error($db_con));
            $num_get_f9_farmer_water_source	= mysqli_num_rows($res_get_f9_farmer_water_source);
            $startOffset_f9	= 0;
            
            $f9WaterSourceData	.= '<table class="table table-bordered dataTable">';
            	$f9WaterSourceData	.= '<thead>';
            		$f9WaterSourceData	.= '<th>Sr. No.</th>';
            		$f9WaterSourceData	.= '<th>Water Source</th>';
            		$f9WaterSourceData	.= '<th style="text-align:center">';
            			$f9WaterSourceData	.= '<div style="text-align:center">';
            				$f9WaterSourceData	.= '<input type="button" value="Delete" onclick="multipleWaterSourceDelete('.$farmer_id.', '.$incrementalID.');" class="btn-danger"/>';
            			$f9WaterSourceData	.= '</div>';
            		$f9WaterSourceData	.= '</th>';
            	$f9WaterSourceData	.= '</thead>';
            	$f9WaterSourceData	.= '<tbody>';
            		if($num_get_f9_farmer_water_source != 0)
            		{
            			while($row_get_f9_farmer_water_source = mysqli_fetch_array($res_get_f9_farmer_water_source))
            			{
            				$f9WaterSourceData	.= '<tr>';
								$f9WaterSourceData	.= '<td>'.++$startOffset_f9.'</td>';
								$f9WaterSourceData	.= '<td>'.ucwords($row_get_f9_farmer_water_source['water_source_name']).'</td>';
								$f9WaterSourceData	.= '<td align="center">';
									$f9WaterSourceData	.= '<input type="checkbox" value="'.$row_get_f9_farmer_water_source['id'].'" id="f9_water_source_'.$row_get_f9_farmer_water_source['id'].'" name="f9_water_source_'.$row_get_f9_farmer_water_source['id'].'" class="css-checkbox f9_water_source">';
								$f9WaterSourceData	.= '</td>';
							$f9WaterSourceData	.= '</tr>';
            			}
            		}
            		else
            		{
            			$f9WaterSourceData	.= '<tr>';
                			$f9WaterSourceData	.= '<td>&nbsp;</td>';
							$f9WaterSourceData	.= '<td>No Match Found</td>';
                			$f9WaterSourceData	.= '<td>&nbsp;</td>';
            			$f9WaterSourceData	.= '</tr>';
            		}
            	$f9WaterSourceData	.= '</tbody>';
            $f9WaterSourceData	.= '</table>';
		}

		return $f9WaterSourceData;
	}

	function getf10WaterSource($farmer_id, $incrementalID)
	{
		global $db_con;
		$startOffset    	= 0;
		$f10WaterSourceData	= '';

		// Query For getting the list of Water Source
		$sql_get_f10_water_source_list	= " SELECT * FROM `tbl_water_source` ";
		$sql_get_f10_water_source_list	.= " WHERE `status`='1' AND water_source NOT IN (SELECT DISTINCT(water_source_name) ";
		$sql_get_f10_water_source_list	.= " FROM tbl_f10_farmer_water_source ";
		$sql_get_f10_water_source_list	.= " WHERE fm_id='".$farmer_id."' AND count='".$incrementalID."') ";
    	$res_get_f10_water_source_list 	= mysqli_query($db_con, $sql_get_f10_water_source_list) or die(mysqli_error($db_con));
		if($res_get_f10_water_source_list)
		{
			$num_get_f10_water_source_list	= mysqli_num_rows($res_get_f10_water_source_list);
			
			$f10WaterSourceData	.= '<select id="f10_water_source_type'.$incrementalID.'" name="f10_water_source_type'.$incrementalID.'[]" multiple="multiple"  onChange="console.log($(this).children(\':selected\').length)" placeholder="Select Water Source" class="select2-me input-xxlarge" >';
               	if($num_get_f10_water_source_list != 0)
				{
					while($row_get_f10_water_source_list	= mysqli_fetch_array($res_get_f10_water_source_list))
					{
                		$f10WaterSourceData	.= '<option point="'.$row_get_f10_water_source_list['points'].'" value="'.$row_get_f10_water_source_list['water_source'].'">'.trim(ucwords($row_get_f10_water_source_list['water_source'])).'</option>';
                    }
				}
				else
				{
					$f10WaterSourceData	.= '<option point="0" value="">No Match Found</option>';
                }
            $f10WaterSourceData	.= '</select>';

            $f10WaterSourceData .= '<script type="text/javascript">';
			$f10WaterSourceData .= '$("#f10_water_source_type'.$incrementalID.'").select2();';
			$f10WaterSourceData .= '</script>';

            $f10WaterSourceData	.= '<input value="Add Here" class="btn-success" type="button" onclick="addf10WaterSource('.$farmer_id.', '.$incrementalID.');">';
			// Query For getting the Service Provider list for that user
            $sql_get_f10_farmer_water_source	= " SELECT * FROM `tbl_f10_farmer_water_source` WHERE `fm_id`='".$farmer_id."' AND count='".$incrementalID."' ";
            $res_get_f10_farmer_water_source	= mysqli_query($db_con, $sql_get_f10_farmer_water_source) or die(mysqli_error($db_con));
            $num_get_f10_farmer_water_source	= mysqli_num_rows($res_get_f10_farmer_water_source);
            $startOffset_f10	= 0;
            
            $f10WaterSourceData	.= '<table class="table table-bordered dataTable">';
            	$f10WaterSourceData	.= '<thead>';
            		$f10WaterSourceData	.= '<th>Sr. No.</th>';
            		$f10WaterSourceData	.= '<th>Water Source</th>';
            		$f10WaterSourceData	.= '<th style="text-align:center">';
            			$f10WaterSourceData	.= '<div style="text-align:center">';
            				$f10WaterSourceData	.= '<input type="button" value="Delete" onclick="multipleWaterSourceDelete_f10('.$farmer_id.', '.$incrementalID.');" class="btn-danger"/>';
            			$f10WaterSourceData	.= '</div>';
            		$f10WaterSourceData	.= '</th>';
            	$f10WaterSourceData	.= '</thead>';
            	$f10WaterSourceData	.= '<tbody>';
            		if($num_get_f10_farmer_water_source != 0)
            		{
            			while($row_get_f10_farmer_water_source = mysqli_fetch_array($res_get_f10_farmer_water_source))
            			{
            				$f10WaterSourceData	.= '<tr>';
								$f10WaterSourceData	.= '<td>'.++$startOffset_f10.'</td>';
								$f10WaterSourceData	.= '<td>'.ucwords($row_get_f10_farmer_water_source['water_source_name']).'</td>';
								$f10WaterSourceData	.= '<td align="center">';
									$f10WaterSourceData	.= '<input type="checkbox" value="'.$row_get_f10_farmer_water_source['id'].'" id="f10_water_source_'.$row_get_f10_farmer_water_source['id'].'" name="f10_water_source_'.$row_get_f10_farmer_water_source['id'].'" class="css-checkbox f10_water_source">';
								$f10WaterSourceData	.= '</td>';
							$f10WaterSourceData	.= '</tr>';
            			}
            		}
            		else
            		{
            			$f10WaterSourceData	.= '<tr>';
                			$f10WaterSourceData	.= '<td>&nbsp;</td>';
							$f10WaterSourceData	.= '<td>No Match Found</td>';
                			$f10WaterSourceData	.= '<td>&nbsp;</td>';
            			$f10WaterSourceData	.= '</tr>';
            		}
            	$f10WaterSourceData	.= '</tbody>';
            $f10WaterSourceData	.= '</table>';
		}

		return $f10WaterSourceData;
	}

	function getf11WaterSource($farmer_id, $incrementalID)
	{
		global $db_con;
		$startOffset    	= 0;
		$f11WaterSourceData	= '';

		// Query For getting the list of Water Source
		$sql_get_f11_water_source_list	= " SELECT * FROM `tbl_water_source` ";
		$sql_get_f11_water_source_list	.= " WHERE `status`='1' AND water_source NOT IN (SELECT DISTINCT(water_source_name) ";
		$sql_get_f11_water_source_list	.= " FROM tbl_f11_farmer_water_source ";
		$sql_get_f11_water_source_list	.= " WHERE fm_id='".$farmer_id."' AND count='".$incrementalID."') ";
    	$res_get_f11_water_source_list 	= mysqli_query($db_con, $sql_get_f11_water_source_list) or die(mysqli_error($db_con));
		if($res_get_f11_water_source_list)
		{
			$num_get_f11_water_source_list	= mysqli_num_rows($res_get_f11_water_source_list);
			
			$f11WaterSourceData	.= '<select id="f11_water_source_type'.$incrementalID.'" name="f11_water_source_type'.$incrementalID.'[]" multiple="multiple"  onChange="console.log($(this).children(\':selected\').length)" placeholder="Select Water Source" class="select2-me input-xxlarge" >';
               	if($num_get_f11_water_source_list != 0)
				{
					while($row_get_f11_water_source_list	= mysqli_fetch_array($res_get_f11_water_source_list))
					{
                		$f11WaterSourceData	.= '<option point="'.$row_get_f11_water_source_list['points'].'" value="'.$row_get_f11_water_source_list['water_source'].'">'.trim(ucwords($row_get_f11_water_source_list['water_source'])).'</option>';
                    }
				}
				else
				{
					$f11WaterSourceData	.= '<option point="0" value="">No Match Found</option>';
                }
            $f11WaterSourceData	.= '</select>';

            $f11WaterSourceData .= '<script type="text/javascript">';
			$f11WaterSourceData .= '$("#f11_water_source_type'.$incrementalID.'").select2();';
			$f11WaterSourceData .= '</script>';

            $f11WaterSourceData	.= '<input value="Add Here" class="btn-success" type="button" onclick="addf11WaterSource('.$farmer_id.', '.$incrementalID.');">';
			// Query For getting the Service Provider list for that user
            $sql_get_f11_farmer_water_source	= " SELECT * FROM `tbl_f11_farmer_water_source` WHERE `fm_id`='".$farmer_id."' AND count='".$incrementalID."' ";
            $res_get_f11_farmer_water_source	= mysqli_query($db_con, $sql_get_f11_farmer_water_source) or die(mysqli_error($db_con));
            $num_get_f11_farmer_water_source	= mysqli_num_rows($res_get_f11_farmer_water_source);
            $startOffset_f11	= 0;
            
            $f11WaterSourceData	.= '<table class="table table-bordered dataTable">';
            	$f11WaterSourceData	.= '<thead>';
            		$f11WaterSourceData	.= '<th>Sr. No.</th>';
            		$f11WaterSourceData	.= '<th>Water Source</th>';
            		$f11WaterSourceData	.= '<th style="text-align:center">';
            			$f11WaterSourceData	.= '<div style="text-align:center">';
            				$f11WaterSourceData	.= '<input type="button" value="Delete" onclick="multipleWaterSourceDelete_f11('.$farmer_id.', '.$incrementalID.');" class="btn-danger"/>';
            			$f11WaterSourceData	.= '</div>';
            		$f11WaterSourceData	.= '</th>';
            	$f11WaterSourceData	.= '</thead>';
            	$f11WaterSourceData	.= '<tbody>';
            		if($num_get_f11_farmer_water_source != 0)
            		{
            			while($row_get_f11_farmer_water_source = mysqli_fetch_array($res_get_f11_farmer_water_source))
            			{
            				$f11WaterSourceData	.= '<tr>';
								$f11WaterSourceData	.= '<td>'.++$startOffset_f11.'</td>';
								$f11WaterSourceData	.= '<td>'.ucwords($row_get_f11_farmer_water_source['water_source_name']).'</td>';
								$f11WaterSourceData	.= '<td align="center">';
									$f11WaterSourceData	.= '<input type="checkbox" value="'.$row_get_f11_farmer_water_source['id'].'" id="f11_water_source_'.$row_get_f11_farmer_water_source['id'].'" name="f11_water_source_'.$row_get_f11_farmer_water_source['id'].'" class="css-checkbox f11_water_source">';
								$f11WaterSourceData	.= '</td>';
							$f11WaterSourceData	.= '</tr>';
            			}
            		}
            		else
            		{
            			$f11WaterSourceData	.= '<tr>';
                			$f11WaterSourceData	.= '<td>&nbsp;</td>';
							$f11WaterSourceData	.= '<td>No Match Found</td>';
                			$f11WaterSourceData	.= '<td>&nbsp;</td>';
            			$f11WaterSourceData	.= '</tr>';
            		}
            	$f11WaterSourceData	.= '</tbody>';
            $f11WaterSourceData	.= '</table>';
		}

		return $f11WaterSourceData;
	}

	function getf14WaterSource($farmer_id, $incrementalID)
	{
		global $db_con;
		$startOffset    	= 0;
		$f14WaterSourceData	= '';

		// Query For getting the list of Water Source
		$sql_get_f14_water_source_list	= " SELECT * FROM `tbl_water_source` ";
		$sql_get_f14_water_source_list	.= " WHERE `status`='1' AND water_source NOT IN (SELECT DISTINCT(water_source_name) ";
		$sql_get_f14_water_source_list	.= " FROM tbl_f14_farmer_water_source ";
		$sql_get_f14_water_source_list	.= " WHERE fm_id='".$farmer_id."' AND count='".$incrementalID."') ";
    	$res_get_f14_water_source_list 	= mysqli_query($db_con, $sql_get_f14_water_source_list) or die(mysqli_error($db_con));
		if($res_get_f14_water_source_list)
		{
			$num_get_f14_water_source_list	= mysqli_num_rows($res_get_f14_water_source_list);
			
			$f14WaterSourceData	.= '<select id="f14_water_source_type'.$incrementalID.'" name="f14_water_source_type'.$incrementalID.'[]" multiple="multiple"  onChange="console.log($(this).children(\':selected\').length)" placeholder="Select Water Source" class="select2-me input-xxlarge" >';
               	if($num_get_f14_water_source_list != 0)
				{
					while($row_get_f14_water_source_list	= mysqli_fetch_array($res_get_f14_water_source_list))
					{
                		$f14WaterSourceData	.= '<option point="'.$row_get_f14_water_source_list['points'].'" value="'.$row_get_f14_water_source_list['water_source'].'">'.trim(ucwords($row_get_f14_water_source_list['water_source'])).'</option>';
                    }
				}
				else
				{
					$f14WaterSourceData	.= '<option point="0" value="">No Match Found</option>';
                }
            $f14WaterSourceData	.= '</select>';

            $f14WaterSourceData .= '<script type="text/javascript">';
			$f14WaterSourceData .= '$("#f14_water_source_type'.$incrementalID.'").select2();';
			$f14WaterSourceData .= '</script>';

            $f14WaterSourceData	.= '<input value="Add Here" class="btn-success" type="button" onclick="addf14WaterSource('.$farmer_id.', '.$incrementalID.');">';
			// Query For getting the Service Provider list for that user
            $sql_get_f14_farmer_water_source	= " SELECT * FROM `tbl_f14_farmer_water_source` WHERE `fm_id`='".$farmer_id."' AND count='".$incrementalID."' ";
            $res_get_f14_farmer_water_source	= mysqli_query($db_con, $sql_get_f14_farmer_water_source) or die(mysqli_error($db_con));
            $num_get_f14_farmer_water_source	= mysqli_num_rows($res_get_f14_farmer_water_source);
            $startOffset_f14	= 0;
            
            $f14WaterSourceData	.= '<table class="table table-bordered dataTable">';
            	$f14WaterSourceData	.= '<thead>';
            		$f14WaterSourceData	.= '<th>Sr. No.</th>';
            		$f14WaterSourceData	.= '<th>Water Source</th>';
            		$f14WaterSourceData	.= '<th style="text-align:center">';
            			$f14WaterSourceData	.= '<div style="text-align:center">';
            				$f14WaterSourceData	.= '<input type="button" value="Delete" onclick="multipleWaterSourceDelete_f14('.$farmer_id.', '.$incrementalID.');" class="btn-danger"/>';
            			$f14WaterSourceData	.= '</div>';
            		$f14WaterSourceData	.= '</th>';
            	$f14WaterSourceData	.= '</thead>';
            	$f14WaterSourceData	.= '<tbody>';
            		if($num_get_f14_farmer_water_source != 0)
            		{
            			while($row_get_f14_farmer_water_source = mysqli_fetch_array($res_get_f14_farmer_water_source))
            			{
            				$f14WaterSourceData	.= '<tr>';
								$f14WaterSourceData	.= '<td>'.++$startOffset_f14.'</td>';
								$f14WaterSourceData	.= '<td>'.ucwords($row_get_f14_farmer_water_source['water_source_name']).'</td>';
								$f14WaterSourceData	.= '<td align="center">';
									$f14WaterSourceData	.= '<input type="checkbox" value="'.$row_get_f14_farmer_water_source['id'].'" id="f14_water_source_'.$row_get_f14_farmer_water_source['id'].'" name="f14_water_source_'.$row_get_f14_farmer_water_source['id'].'" class="css-checkbox f14_water_source">';
								$f14WaterSourceData	.= '</td>';
							$f14WaterSourceData	.= '</tr>';
            			}
            		}
            		else
            		{
            			$f14WaterSourceData	.= '<tr>';
                			$f14WaterSourceData	.= '<td>&nbsp;</td>';
							$f14WaterSourceData	.= '<td>No Match Found</td>';
                			$f14WaterSourceData	.= '<td>&nbsp;</td>';
            			$f14WaterSourceData	.= '</tr>';
            		}
            	$f14WaterSourceData	.= '</tbody>';
            $f14WaterSourceData	.= '</table>';
		}

		return $f14WaterSourceData;
	}

	if((isset($obj->addLandData)) == 1 && (isset($obj->addLandData)))
	{
		$contentCountLand	= $obj->contentCountLand;
		$farmer_id 			= $obj->farmer_id;

		$landData 			= '';

		$landData	.= '<div id="land'.$contentCountLand.'" style="padding:5px;border:1px solid #d6d6d6;margin:5px;display:none;">';
			$landData	.= '<div style=" padding: 10px; margin: 5px;">';
								
				$landData	.= '<input type="hidden" name="id[]" id="id" value="">';
				$landData	.= '<h2>Farm Land '.$contentCountLand.' Details</h2>';
								
				$landData	.= '<div class="control-group">';
				$landData	.= '<label for="text" class="control-label" style="margin-top:10px">Size [in Acres]<span style="color:#F00">*</span><br>[Hector-Acre-Guntha]</label>';
					$landData	.= '<div class="controls">';
						$landData	.= '<input placeholder="Size in Hector" type="text" onKeyPress="return numsonly(event);" onKeyUp="getAcre(this.value, \'hector\', \'f9_land_size'.$contentCountLand.'\', '.$contentCountLand.');" id="f9_land_size_hector'.$contentCountLand.'" name="f9_land_size_hector'.$contentCountLand.'" class="input-small" value="" data-rule-required="true" maxlength="6">';
						$landData	.= '&nbsp;-&nbsp;';
                        $landData	.= '<input placeholder="Size in Acre" type="text" onKeyPress="return numsonly(event);" onKeyUp="getAcre(this.value, \'acre\', \'f9_land_size'.$contentCountLand.'\', '.$contentCountLand.');" id="f9_land_size_acre'.$contentCountLand.'" name="f9_land_size_acre'.$contentCountLand.'" class="input-small" value="" maxlength="6">';
						$landData	.= '&nbsp;-&nbsp;';
                        $landData	.= '<input placeholder="Size in Guntha" type="text" onKeyPress="return numsonly(event);" onKeyUp="getAcre(this.value, \'guntha\', \'f9_land_size'.$contentCountLand.'\', '.$contentCountLand.');" id="f9_land_size_guntha'.$contentCountLand.'" name="f9_land_size_guntha'.$contentCountLand.'" class="input-small" value="" maxlength="6">';
                        $landData 	.= '<br>';

                        $landData	.= '<input type="text" onKeyPress="return numsonly(event);" id="f9_land_size'.$contentCountLand.'" name="f9_land_size'.$contentCountLand.'" class="input-small" value="" data-rule-required="true" maxlength="6" readonly>Total Acres';
					$landData	.= '</div>';
				$landData	.= '</div>';
								
				$landData	.= '<div class="control-group">';
					$landData	.= '<label for="text" class="control-label" style="margin-top:10px">Ownership<span style="color:#F00">*</span></label>';
						$landData	.= '<div class="controls">';
						$landData	.= '<select id="f9_owner'.$contentCountLand.'" name="f9_owner'.$contentCountLand.'" onChange="ownership('.$contentCountLand.',this.value)" class="select2-me input-xlarge" data-rule-required="true">';
							$landData	.= '<option value="" disabled selected> Select here</option>';
							$landData	.= '<option value="Owned" point="10">Owned</option>';
							$landData	.= '<option value="Ancestral" point="5">Ancestral</option>';
							$landData	.= '<option value="Rented" point="5">Rented</option>';
							$landData	.= '<option value="Contracted" point="5">Contracted</option>';
							$landData	.= '<option value="Leased" point="3">Leased</option>';
						$landData	.= '</select>';
					$landData	.= '</div>';
				$landData	.= '</div>	';
								
				$landData	.= '<div id="div_lease_display'.$contentCountLand.'" style="display: none; padding: 10px; border:1px solid #d6d6d6; margin: 20px;">';
					$landData	.= '<div class="control-group">';
						$landData	.= '<label for="text" class="control-label" style="margin-top:10px">No. of Lease year<span style="color:#F00">*</span></label>';
						$landData	.= '<div class="controls">';
							$landData	.= '<input value="" type="text" class="input-xlarge v_number" placeholder="Lease Year" name="f9_lease_year'.$contentCountLand.'" id="f9_lease_year'.$contentCountLand.'" data-rule-required="true" onKeyPress="return numsonly(event);" maxlength="10">';
						$landData	.= '</div>';
					$landData	.= '</div>';
				$landData	.= '</div>	';
								
				$landData	.= '<div id="div_rental_display'.$contentCountLand.'" style="display: none; padding: 10px; border:1px solid #d6d6d6; margin: 20px;">';
					$landData	.= '<div class="control-group">';
						$landData	.= '<label for="text" class="control-label" style="margin-top:10px">Mention tha amount per month on rent<span style="color:#F00">*</span></label>';
						$landData	.= '<div class="controls">';
							$landData	.= '<input value="" type="text" class="input-xlarge v_number" placeholder="amount per month on rent" name="f9_amount_on_rent'.$contentCountLand.'" id="f9_amount_on_rent'.$contentCountLand.'" data-rule-required="true" onKeyPress="return numsonly(event);" maxlength="10">';
						$landData	.= '</div>';
					$landData	.= '</div>';
				$landData	.= '</div>	';
								
				$landData	.= '<div id="div_contract_display'.$contentCountLand.'" style="display: none; padding: 10px; border:1px solid #d6d6d6; margin: 20px;">';
					$landData	.= '<div class="control-group">';
						$landData	.= '<label for="text" class="control-label" style="margin-top:10px"> No. of Contract year<span style="color:#F00">*</span></label>';
						$landData	.= '<div class="controls">';
							$landData	.= '<input type="text" class="input-xlarge ui-wizard-content" placeholder="Contract Year" name="f9_contract_year'.$contentCountLand.'" id="f9_contract_year'.$contentCountLand.'" value="" data-rule-required="true" onKeyPress="return numsonly(event);" maxlength="10">';
						$landData	.= '</div>';
					$landData	.= '</div>';
				$landData	.= '</div>	';
								
				$landData	.= '<h3>Land Address</h3>';
								 
				$landData	.= '<div class="control-group" >';
					$landData	.= '<label for="tasktitel" class="control-label">State <span style="color:#F00">*</span></label>';
					$landData	.= '<div class="controls">';
						$landData	.= '<select name="f9_state'.$contentCountLand.'" id="f9_state'.$contentCountLand.'" data-rule-required="true" onChange="getDist(\'p\', this.value, \'f9_district'.$contentCountLand.'\', \'f9_taluka'.$contentCountLand.'\', \'f9_vilage'.$contentCountLand.'\', \'div_p_dist'.$contentCountLand.'\', \'div_p_tal'.$contentCountLand.'\', \'div_p_village'.$contentCountLand.'\');" class="input-xlarge">';
							$landData	.= '<option value="">Select State</option>';
							$landData	.= '<option value="1">TELANGANA</option>';
							$landData	.= '<option value="2">MAHARASHTRA</option>';
							$landData	.= '<option value="3">MADHYA PRADESH</option>';
							$landData	.= '<option value="4">GUJARAT</option>';
							$landData	.= '<option value="5">KARNATAKA</option>';
						$landData	.= '</select>';
					$landData	.= '</div>';
				$landData	.= '</div>  ';
								
				$landData	.= '<div class="control-group">';
					$landData	.= '<label for="tasktitel" class="control-label">District <span style="color:#F00">*</span></label>';
					$landData	.= '<div class="controls" id="div_p_dist'.$contentCountLand.'">';
						$landData	.= '<select id="f9_district'.$contentCountLand.'" name="f9_district'.$contentCountLand.'" class="select2-me input-large" >';
							$landData	.= '<option value="" disabled selected>Select District</option>';
						$landData	.= '</select>';
					$landData	.= '</div>';
				$landData	.= '</div> '; 
								
				$landData	.= '<div class="control-group">';
					$landData	.= '<label for="tasktitel" class="control-label">Taluka <span style="color:#F00">*</span></label>';
					$landData	.= '<div class="controls" id="div_p_tal'.$contentCountLand.'">';
						$landData	.= '<select id="f9_taluka'.$contentCountLand.'" name="f9_taluka'.$contentCountLand.'" class="select2-me input-large" >';
							$landData	.= '<option value="" disabled selected>Select Taluka</option>';
						$landData	.= '</select>';
					$landData	.= '</div>';
				$landData	.= '</div>  ';
								
				$landData	.= '<div class="control-group" >';
					$landData	.= '<label for="tasktitel" class="control-label">Village Name <span style="color:#F00">*</span></label>';
					$landData	.= '<div class="controls" id="div_p_village'.$contentCountLand.'">';
						$landData	.= '<select id="f9_vilage'.$contentCountLand.'" name="f9_vilage'.$contentCountLand.'" class="select2-me input-large" >';
							$landData	.= '<option value="" disabled selected>Select Village</option>';
						$landData	.= '</select>';
					$landData	.= '</div>';
				$landData	.= '</div> ';
								
				$landData	.= '<div class="control-group">';
					$landData	.= '<label for="text" class="control-label" style="margin-top:10px">Survey Number<span style="color:#F00">*</span></label>';
					$landData	.= '<div class="controls">';
						$landData	.= '<input placeholder="Survey Number" type="text" id="f9_survey_number'.$contentCountLand.'" name="f9_survey_number'.$contentCountLand.'" class="input-xlarge" value="" data-rule-required="true" maxlength="10">';
					$landData	.= '</div>';
				$landData	.= '</div>';
				
				$landData	.= '<div class="control-group">';
					$landData	.= '<label for="text" class="control-label" style="margin-top:10px">Gat Number<span style="color:#F00">*</span></label>';
					$landData	.= '<div class="controls">';
						$landData	.= '<input placeholder="Gat Number" type="text" id="f9_gat_number'.$contentCountLand.'" name="f9_gat_number'.$contentCountLand.'" class="input-xlarge" value="" data-rule-required="true" maxlength="10">';
					$landData	.= '</div>';
				$landData	.= '</div>';
								
				$landData	.= '<div class="control-group" >';
					$landData	.= '<label for="tasktitel" class="control-label">Pin-Code <span style="color:#F00">*</span></label>';
					$landData	.= '<div class="controls">';
						$landData	.= '<input type="text" id="f9_pincode'.$contentCountLand.'" name="f9_pincode'.$contentCountLand.'" placeholder="Pin-Code" class="input-large" data-rule-required="true" onKeyPress="return numsonly(event);" minlength="6" maxlength="6" size="6" />';
					$landData	.= '</div>';
				$landData	.= '</div>';
				
				$landData	.= '<div class="control-group" >';
					$landData	.= '<label for="tasktitel" class="control-label" >Get Geo Location</label>';
					$landData	.= '<div class="controls">';
						$landData	.= '<a href="javascript:void(0);" onClick="tryAPIGeolocation('.$contentCountLand.')">Get Location<a>';
						$landData	.= '<p id="xland"></p>';
						$landData	.= '<span id="span_error'.$contentCountLand.'"></span>';
					$landData	.= '</div>';
				$landData	.= '</div>';
								
				$landData	.= '<div class="control-group" >';
					$landData	.= '<label for="tasktitel" class="control-label">latitude <span style="color:#F00"></span></label>';
					$landData	.= '<div class="controls">';
						$landData	.= '<input type="text" id="f9_lat'.$contentCountLand.'" name="f9_lat'.$contentCountLand.'" placeholder="Latitude" class="input-large" onKeyPress="return numsonly(event);" maxlength="100"/>';
					$landData	.= '</div>';
				$landData	.= '</div>  ';
								
				$landData	.= '<div class="control-group" >';
					$landData	.= '<label for="tasktitel" class="control-label">longitude <span style="color:#F00"></span></label>';
					$landData	.= '<div class="controls">';
						$landData	.= '<input type="text" id="f9_long'.$contentCountLand.'" name="f9_long'.$contentCountLand.'" placeholder="Longitude" class="input-large" onKeyPress="return numsonly(event);" maxlength="100"/>';
					$landData	.= '</div>';
				$landData	.= '</div>  ';
								
				$landData	.= '<div class="control-group">';
					$landData	.= '<label for="text" class="control-label" style="margin-top:10px">Type of Soil<span style="color:#F00">*</span></label>';
					$landData	.= '<div class="controls">';
						$landData	.= '<select id="f9_soil_type'.$contentCountLand.'" name="f9_soil_type'.$contentCountLand.'" class="select2-me input-xlarge" data-rule-required="true" onChange="calTotal_f9()">';
							$landData	.= '<option value="" disabled selected> Select here</option>';
							$landData	.= '<option value="Alluvial Soil" point="10">Alluvial Soil</option>';
							$landData	.= '<option value="Black Soil" point="9">Black Soil</option>';
							$landData	.= '<option value="Red Soil" point="8">Red Soil</option>';
							$landData	.= '<option value="Mountain Soil" point="6">Mountain Soil</option>';
							$landData	.= '<option value="Peat" point="5">Peat</option>';
							$landData	.= '<option value="Laterite Soil" point="5">Laterite Soil</option>';
							$landData	.= '<option value="Desert Soil" point="2">Desert Soil</option>';
						$landData	.= '</select>';
					$landData	.= '</div>';
				$landData	.= '</div>	';
								
				$landData	.= '<div class="control-group">';
					$landData	.= '<label for="text" class="control-label" style="margin-top:10px">Have you had the soil tested in your land?<span style="color:#F00">*</span></label>';
					$landData	.= '<div class="controls">';
						$landData	.= '<select id="f9_soil_tested'.$contentCountLand.'" name="f9_soil_tested'.$contentCountLand.'" class="select2-me input-xlarge" data-rule-required="true" onChange="calTotal_f9()">';
							$landData	.= '<option value="" disabled selected> Select here</option>';
							$landData	.= '<option value="yes" point="10">Yes</option>';
							$landData	.= '<option value="no" point="0">no</option>';
						$landData	.= '</select>';
					$landData	.= '</div>';
				$landData	.= '</div>	';
								
				$landData	.= '<div class="control-group">';
					$landData	.= '<label for="text" class="control-label" style="margin-top:10px">Soil Depth<span style="color:#F00">*</span></label>';
					$landData	.= '<div class="controls">';
						$landData	.= '<input placeholder="Soil Depth" type="text" id="f9_soil_depth'.$contentCountLand.'" name="f9_soil_depth'.$contentCountLand.'" class="input-xlarge" value="" data-rule-required="true"> In Feets';
					$landData	.= '</div>';
				$landData	.= '</div>  ';
								
				$landData	.= '<div class="control-group">';
					$landData	.= '<label for="text" class="control-label" style="margin-top:10px">Source Of Water';
					$landData	.= '<span style="color:#F00">*</span></label>';
					$landData	.= '<div class="controls">';
						
						$landData	.= '<div id="div_f9_source_of_water'.$contentCountLand.'">';
                    		
                    		$sql_get_f9_water_source_list	= " SELECT * FROM `tbl_water_source` WHERE `status`='1' AND water_source NOT IN (SELECT DISTINCT(water_source_name) FROM tbl_f9_farmer_water_source WHERE fm_id='".$farmer_id."' AND count='".$contentCountLand."') ";	
							$res_get_f9_water_source_list 	= mysqli_query($db_con, $sql_get_f9_water_source_list) or die(mysqli_error($db_con));

							if($res_get_f9_water_source_list)
							{
								$num_get_f9_water_source_list	= mysqli_num_rows($res_get_f9_water_source_list);

								$landData 	.= '<select id="f9_source_of_water'.$contentCountLand.'" name="f9_source_of_water'.$contentCountLand.'[]" multiple="multiple"  onChange="console.log($(this).children(\':selected\').length)" placeholder="Select Water Source" class="select2-me input-xxlarge" data-rule-required="true">'; 
									if($num_get_f9_water_source_list != 0)
									{
										while($row_get_f9_water_source_list	= mysqli_fetch_array($res_get_f9_water_source_list))
										{
											$landData 	.= '<option point="'.$row_get_f9_water_source_list['points'].'" value="'.$row_get_f9_water_source_list['water_source'].'">'.trim(ucwords($row_get_f9_water_source_list['water_source'])).'</option>';
										}
									}
									else
									{
										$landData 	.= '<option point="0" value="">No Match Found</option>';
									}
								$landData 	.= '</select>';

								$landData 	.= '<script type="text/javascript">';
									$landData 	.= '$("#f9_source_of_water'.$contentCountLand.'").select2();';
								$landData 	.= '</script>';

								$landData 	.= '<input value="Add Here" class="btn-success" type="button" onclick="addf9WaterSource('.$farmer_id.', '.$contentCountLand.');">';
								
								// Query For getting the Service Provider list for that user
						        $sql_get_f9_farmer_water_source	= " SELECT * FROM `tbl_f9_farmer_water_source` WHERE `fm_id`='".$farmer_id."' AND `count`='".$contentCountLand."' ";
						        $res_get_f9_farmer_water_source	= mysqli_query($db_con, $sql_get_f9_farmer_water_source) or die(mysqli_error($db_con));
						        $num_get_f9_farmer_water_source	= mysqli_num_rows($res_get_f9_farmer_water_source);
						        $startOffset_f9	= 0;
								
								$landData 	.= '<table class="table table-bordered dataTable">';
									$landData 	.= '<thead>';
										$landData 	.= '<th>Sr. No.</th>';
						        		$landData 	.= '<th>Water Source</th>';
						        		$landData 	.= '<th style="text-align:center">';
						        			$landData 	.= '<div style="text-align:center">';
						        				$landData 	.= '<input type="button" value="Delete" onclick="multipleWaterSourceDelete('.$farmer_id.', '.$contentCountLand.');" class="btn-danger"/>';
						        			$landData 	.= '</div>';
						        		$landData 	.= '</th>';
									$landData 	.= '</thead>';
									$landData 	.= '<tbody>';
										
										if($num_get_f9_farmer_water_source != 0)
						        		{
						        			while($row_get_f9_farmer_water_source = mysqli_fetch_array($res_get_f9_farmer_water_source))
						        			{
						        				$landData 	.= '<tr>';
													$landData 	.= '<td>'.++$startOffset_f9.'</td>';
													$landData 	.= '<td>'.ucwords($row_get_f9_farmer_water_source['water_source_name']).'</td>';
													$landData 	.= '<td align="center">';
														$landData 	.= '<input type="checkbox" value="'.$row_get_f9_farmer_water_source['id'].'" id="f9_water_source_'.$row_get_f9_farmer_water_source['id'].'" name="f9_water_source_'.$row_get_f9_farmer_water_source['id'].'" class="css-checkbox f9_water_source">';
													$landData 	.= '</td>';
												$landData 	.= '</tr>';
						        			}
						        		}
						        		else
						        		{
						        			$landData 	.= '<tr>';
						            			$landData 	.= '<td>&nbsp;</td>';
												$landData 	.= '<td>No Match Found</td>';
						            			$landData 	.= '<td>&nbsp;</td>';
						        			$landData 	.= '</tr>';
						        		}
									$landData 	.= '</tbody>';
								$landData 	.= '</table>';
						    }
						$landData	.= '</div>';
					$landData	.= '</div>';
				$landData	.= '</div>  ';
			$landData	.= '</div>';
		$landData	.= '</div>';

		$landData 	.= '<script type="text/javascript">';
			$landData 	.= '$("#f9_owner'.$contentCountLand.'").select2();';
			$landData 	.= '$("#f9_state'.$contentCountLand.'").select2();';
			$landData 	.= '$("#f9_district'.$contentCountLand.'").select2();';
			$landData 	.= '$("#f9_taluka'.$contentCountLand.'").select2();';
			$landData 	.= '$("#f9_vilage'.$contentCountLand.'").select2();';
			$landData 	.= '$("#f9_soil_type'.$contentCountLand.'").select2();';
			$landData 	.= '$("#f9_soil_tested'.$contentCountLand.'").select2();';
		$landData 	.= '</script>';

		quit(utf8_encode($landData),1);
	}

	if((isset($obj->addCurCropData)) == 1 && (isset($obj->addCurCropData)))		// f14
	{
		$contentCountCurCrop	= $obj->contentCountCurCrop;
		$fm_id 					= $obj->farmer_id;

		$curCropData 			= '';

		$curCropData	.= '<div id="curcrop'.$contentCountCurCrop.'" style="padding:5px;border:1px solid #d6d6d6;margin:5px;display:none;">';
			$curCropData	.= '<input type="hidden" name="id[]" id="id" value="">';
			$curCropData	.= '<h3>Future Crop '.$contentCountCurCrop.' Forecast</h3>';
			
			$curCropData	.= '<div class="control-group">';
	            $curCropData	.= '<label for="tasktitel" class="control-label">Which season you will farm next? <span style="color:#F00">*</span>';
	            $curCropData	.= '</label>';
	            $curCropData	.= '<div class="controls">';
	                $curCropData	.= '<select id="f14_crop_season'.$contentCountCurCrop.'" name="f14_crop_season'.$contentCountCurCrop.'" data-rule-required="true" class="select2-me input-xlarge" >';
	                    $curCropData	.= '<option value="" disabled selected>Select here</option>';
	                    $curCropData	.= '<option value="Kharif" >Kharif</option>';
	                    $curCropData	.= '<option value="Rabi" >Rabi</option>';
	                    $curCropData	.= '<option value="Annual" >Annual</option>';
	                $curCropData	.= '</select>';
	            $curCropData	.= '</div>';
	        $curCropData	.= '</div>';  // <!-- Current Crop Season [DDL] -->

			$curCropData	.= '<div class="control-group">';
				$curCropData	.= '<label for="text" class="control-label" style="margin-top:10px">What type of crop planned?<span style="color:#F00">*</span></label>';
				$curCropData	.= '<div class="controls">';
					$curCropData	.= '<select id="f14_crop_type'.$contentCountCurCrop.'" name="f14_crop_type'.$contentCountCurCrop.'" class="select2-me input-xlarge" data-rule-required="true">';
						$curCropData	.= '<option value="" disabled selected> Select here</option>';
						$curCropData	.= '<option value="Commercial" >Commercial</option>';
						$curCropData	.= '<option value="Seasonal" >Seasonal</option>';
					$curCropData	.= '</select>';
				$curCropData	.= '</div>';
			$curCropData	.= '</div>';	// What type of crop planned?
							
			$curCropData	.= '<div class="control-group">';
				$curCropData	.= '<label for="text" class="control-label" style="margin-top:10px">Type Of Crop Cultivating This Year<span style="color:#F00">*</span></label>';
				$curCropData	.= '<div class="controls">';
					$curCropData	.= '<select id="f14_cultivating'.$contentCountCurCrop.'" name="f14_cultivating'.$contentCountCurCrop.'" class="select2-me input-xlarge" data-rule-required="true" onchange="get_variety(this.value,'.$contentCountCurCrop.', \'f14\');getDisplayDiv(this.value, \'div_f14_cultivating'.$contentCountCurCrop.'\', \'other\');">';
						$curCropData	.= '<option value=""  selected> Select here</option>';
						$curCropData	.= '<option point="7" value="other" >Other</option>';
						$crops = lookup_value('tbl_crops',array(),array("crop_status"=>1),array(),array(),array());
						while($crop = mysqli_fetch_array($crops))
						{
							$curCropData	.= '<option value="'.$crop['crop_id'].'" point="7" >'.trim($crop['crop_name']).'</option>'; 
						}
					$curCropData	.= '</select>';
				$curCropData	.= '</div>';
			$curCropData	.= '</div>';	// Type Of Crop Cultivating This Year

			$curCropData	.= '<div id="div_f14_cultivating'.$contentCountCurCrop.'" style="display: none;">';
	            $curCropData	.= '<div class="control-group">';
			        $curCropData	.= '<label for="tasktitel" class="control-label">Mention Crop Name <span style="color:#F00">*</span></label>';
			        $curCropData	.= '<div class="controls">';
			        	$curCropData	.= '<input type="text" placeholder="Other Crop Name!" data-rule-required="true" name="f14_other_crop_name'.$contentCountCurCrop.'" id="f14_other_crop_name'.$contentCountCurCrop.'" class="input-xlarge" >';
			        $curCropData	.= '</div>';
		        $curCropData	.= '</div>';
		        $curCropData	.= '<div style="clear: both;"></div>';
            $curCropData	.= '</div>';	// Mention Crop Name 
								
			$curCropData	.= '<div class="control-group">';
				$curCropData	.= '<label for="text" class="control-label" style="margin-top:10px">Variety<span style="color:#F00">*</span></label>';
				$curCropData	.= '<div class="controls">';
					$curCropData	.= '<select id="f14_variety'.$contentCountCurCrop.'" name="f14_variety'.$contentCountCurCrop.'" class="select2-me input-xlarge" data-rule-required="true" >';
						$curCropData	.= '<option value="" disabled selected> Select here</option>';
						
					$curCropData	.= '</select>';
				$curCropData	.= '</div>';
			$curCropData	.= '</div>';	// Variety

			$curCropData	.= '<div class="control-group">';
                $curCropData	.= '<label for="text" class="control-label" style="margin-top:10px">What Type Of Farming You are Doing?<span style="color:#F00">*</span></label>';
                $curCropData	.= '<div class="controls">';
                    $curCropData	.= '<select id="f14_farming_type'.$contentCountCurCrop.'" name="f14_farming_type'.$contentCountCurCrop.'" class="select2-me input-xlarge" data-rule-required="true" >'; // <!-- // onChange="calTotal_f14();" -->
                        $curCropData	.= '<option value="" disabled selected> Select here</option>';
                        $curCropData	.= '<option value="Organic">Organic</option>'; //<!-- point="10" -->
                        $curCropData	.= '<option value="Non Organic">Non-Organic</option>'; //<!-- point="0" -->
                        $curCropData	.= '<option value="Both">Both</option>'; //<!-- point="0" -->
                    $curCropData	.= '</select>';
                $curCropData	.= '</div>';
          	$curCropData	.= '</div>';	// <!-- What Type Of Farming You are Doing? -->

          	$curCropData	.= '<div class="control-group">';
                $curCropData	.= '<label for="tasktitel" class="control-label">Potential Market for Selling Crop? <span style="color:#F00">*</span></label>';
                $curCropData	.= '<div class="controls">';
                    $curCropData	.= '<select id="f14_potential_market'.$contentCountCurCrop.'" name="f14_potential_market'.$contentCountCurCrop.'" class="select2-me input-xlarge" >';
                        $curCropData	.= '<option value="" disabled selected>Select here</option>';
                        $curCropData	.= '<option value="Local Mandis and Location">Local Mandis and Location</option>';
                        $curCropData	.= '<option value="FPO">FPO</option>';
                        $curCropData	.= '<option value="Private Buyer">Private Buyer (Companies)</option>';
                        $curCropData	.= '<option value="Government">Government</option>';
                        $curCropData	.= '<option value="Other">Other</option>';
                    $curCropData	.= '</select>';
                $curCropData	.= '</div>';
            $curCropData	.= '</div>';  //<!-- Potential Market for Selling Crop? [DDL] -->

            $curCropData	.= '<div class="control-group">';
                $curCropData	.= '<label for="tasktitel" class="control-label">Crop Storage for Future Crop <span style="color:#F00">*</span>';
                $curCropData	.= '</label>';
                $curCropData	.= '<div class="controls">';
                    $curCropData	.= '<select id="f14_crop_storage'.$contentCountCurCrop.'" name="f14_crop_storage'.$contentCountCurCrop.'" class="select2-me input-xlarge" >';
                        $curCropData	.= '<option value="" disabled selected>Select here</option>';
                        $curCropData	.= '<option value="Govt Warehouse">Govt. Warehouse</option>';
                        $curCropData	.= '<option value="Pvt Warehouse">Pvt. Warehouse</option>';
                        $curCropData	.= '<option value="Factory">Factory</option>';
                        $curCropData	.= '<option value="Mandis Direct">Mandis Direct</option>';
                    $curCropData	.= '</select>';
                $curCropData	.= '</div>';
            $curCropData	.= '</div>';  //  <!-- Crop Storage for Future Crop [DDL] -->


            $curCropData	.= '<div class="clearfix"></div>';

            $curCropData	.= '<div class="control-group">';
				$curCropData	.= '<label for="text" class="control-label" style="margin-top:10px">What type of water sources you are depending on?<span style="color:#F00">*</span></label>';
				$curCropData	.= '<div class="controls">';
					$curCropData	.= '<div id="div_f14_water_source_type'.$contentCountCurCrop.'">';
                		// Query For getting the list of Water Source
						$sql_get_f14_water_source_list	= " SELECT * FROM `tbl_water_source` WHERE `status`='1' AND water_source NOT IN (SELECT DISTINCT(water_source_name) FROM tbl_f14_farmer_water_source WHERE fm_id='".$fm_id."' AND count='".$contentCountCurCrop."') ";
						$res_get_f14_water_source_list 	= mysqli_query($db_con, $sql_get_f14_water_source_list) or die(mysqli_error($db_con));

						if($res_get_f14_water_source_list)
						{
							$num_get_f14_water_source_list	= mysqli_num_rows($res_get_f14_water_source_list);

							$curCropData	.= '<select id="f14_water_source_type'.$contentCountCurCrop.'" name="f14_water_source_type'.$contentCountCurCrop.'[]" multiple="multiple"  onChange="console.log($(this).children(\':selected\').length)" placeholder="Select Water Source" class="select2-me input-xxlarge" data-rule-required="true">';
					    		if($num_get_f14_water_source_list != 0)
								{
									while($row_get_f14_water_source_list	= mysqli_fetch_array($res_get_f14_water_source_list))
									{
					            		$curCropData	.= '<option point="'.$row_get_f14_water_source_list['points'].'" value="'.$row_get_f14_water_source_list['water_source'].'">'.trim(ucwords($row_get_f14_water_source_list['water_source'])).'</option>';
					    			}
								}
								else
								{
						    		$curCropData	.= '<option point="0" value="">No Match Found</option>';
					    		}
					        $curCropData	.= '</select>';

					        $curCropData 	.= '<script type="text/javascript">';
								$curCropData 	.= '$("#f14_water_source_type'.$contentCountCurCrop.'").select2();';
							$curCropData 	.= '</script>';

							$curCropData	.= '<input value="Add Here" class="btn-success" type="button" onclick="addf14WaterSource('.$fm_id.', '.$contentCountCurCrop.');">';
							// Query For getting the Service Provider list for that user
					        $sql_get_f14_farmer_water_source	= " SELECT * FROM `tbl_f14_farmer_water_source` WHERE `fm_id`='".$fm_id."' AND count='".$contentCountCurCrop."' ";
					        $res_get_f14_farmer_water_source	= mysqli_query($db_con, $sql_get_f14_farmer_water_source) or die(mysqli_error($db_con));
					        $num_get_f14_farmer_water_source	= mysqli_num_rows($res_get_f14_farmer_water_source);
					        $startOffset_f14	= 0;
						    $curCropData	.= '<table class="table table-bordered dataTable">';
					        	$curCropData	.= '<thead>';
					        		$curCropData	.= '<th>Sr. No.</th>';
					        		$curCropData	.= '<th>Water Source</th>';
					        		$curCropData	.= '<th style="text-align:center">';
					        			$curCropData	.= '<div style="text-align:center">';
					        				$curCropData	.= '<input type="button" value="Delete" onclick="multipleWaterSourceDelete_f14('.$fm_id.', '.$contentCountCurCrop.');" class="btn-danger"/>';
					        			$curCropData	.= '</div>';
					        		$curCropData	.= '</th>';
					        	$curCropData	.= '</thead>';
					        	$curCropData	.= '<tbody>';
					        		if($num_get_f14_farmer_water_source != 0)
					        		{
					        			while($row_get_f14_farmer_water_source = mysqli_fetch_array($res_get_f14_farmer_water_source))
					        			{
					        				$curCropData	.= '<tr>';
												$curCropData	.= '<td>'.++$startOffset_f14.'</td>';
												$curCropData	.= '<td>'.ucwords($row_get_f14_farmer_water_source['water_source_name']).'</td>';
												$curCropData	.= '<td align="center">';
													$curCropData	.= '<input type="checkbox" value="'.$row_get_f14_farmer_water_source['id'].'" id="f14_water_source_'.$row_get_f14_farmer_water_source['id'].'" name="f14_water_source_'.$row_get_f14_farmer_water_source['id'].'" class="css-checkbox f14_water_source">';
												$curCropData	.= '</td>';
											$curCropData	.= '</tr>';
					        			}
					        		}
					        		else
					        		{
					        			$curCropData	.= '<tr>';
					            			$curCropData	.= '<td>&nbsp;</td>';
											$curCropData	.= '<td>No Match Found</td>';
					            			$curCropData	.= '<td>&nbsp;</td>';
					        			$curCropData	.= '</tr>';
					        		}
					        	$curCropData	.= '</tbody>';
					        $curCropData	.= '</table>';
					    }
					$curCropData	.= '</div>';
				$curCropData	.= '</div>';
			$curCropData	.= '</div>';	// What type of water sources you are depending on?

			$curCropData	.= '<div class="control-group">';
                $curCropData	.= '<label for="text" class="control-label" style="margin-top:10px">In How many acres did you sow the crop '.$contentCountCurCrop.'?<span style="color:#F00">*</span><br>[Hector-Acre-Guntha]</label>';
                $curCropData	.= '<div class="controls">';
                    $curCropData	.= '<input type="text" onKeyUp="getAcre_f14(this.value, \'hector\', \'f14_total_acrage'.$contentCountCurCrop.'\', '.$contentCountCurCrop.');getTotalIncome('.$contentCountCurCrop.', \'f14\');" value="" id="f14_total_hector'.$contentCountCurCrop.'" name="f14_total_hector'.$contentCountCurCrop.'" class="input-small" onKeyPress="return numsonly(event);" maxlength="10" data-rule-required="true" placeholder="Hector">&nbsp;&nbsp;-&nbsp;';
                    $curCropData	.= '<input type="text" onKeyUp="getAcre_f14(this.value, \'acre\', \'f14_total_acrage'.$contentCountCurCrop.'\', '.$contentCountCurCrop.');getTotalIncome('.$contentCountCurCrop.', \'f14\');" value="" id="f14_total_acre'.$contentCountCurCrop.'" name="f14_total_acre'.$contentCountCurCrop.'" class="input-small" onKeyPress="return numsonly(event);" maxlength="10" placeholder="Acre">&nbsp;&nbsp;-&nbsp;';
                    $curCropData	.= '<input type="text" onKeyUp="getAcre_f14(this.value, \'guntha\', \'f14_total_acrage'.$contentCountCurCrop.'\', '.$contentCountCurCrop.');getTotalIncome('.$contentCountCurCrop.', \'f14\');" value="" id="f14_total_guntha'.$contentCountCurCrop.'" name="f14_total_guntha'.$contentCountCurCrop.'" class="input-small" onKeyPress="return numsonly(event);" maxlength="10" placeholder="Guntha">';
                    $curCropData	.= '<input type="text" value="" id="f14_total_acrage'.$contentCountCurCrop.'" name="f14_total_acrage'.$contentCountCurCrop.'" class="input-large" onKeyPress="return numsonly(event);" maxlength="10" data-rule-required="true" placeholder="Total Acrage" readonly>Total Acres';
                $curCropData	.= '</div>';
            $curCropData	.= '</div>';	// <!-- Total Acrage -->

            $curCropData	.= '<div class="control-group">';
                $curCropData	.= '<label for="tasktitel" class="control-label">When is the harvest date? <span style="color:#F00">*</span><br>[YYYY-MM-DD]</label>';
                $curCropData	.= '<div class="controls">';
                   $curCropData	.= '<input type="text" id="f14_harvest_date'.$contentCountCurCrop.'" name="f14_harvest_date'.$contentCountCurCrop.'" placeholder="[YYYY-MM-DD]" class="datepicker input-large" data-rule-required="true" />';
                $curCropData	.= '</div>';
            $curCropData	.= '</div>';	//<!-- harvest date -->

            $curCropData	.= '<div class="control-group">';
                $curCropData	.= '<label for="tasktitel" class="control-label">Expected Yield <span style="color:#F00">*</span> <br>[Quintals per Acre] </label>';
                $curCropData	.= '<div class="controls">';
                    $curCropData	.= '<input type="text" id="f14_expected'.$contentCountCurCrop.'" name="f14_expected'.$contentCountCurCrop.'" class="input-xlarge" onKeyPress="return numsonly(event);" onBlur="getTotalExpectedIncome('.$contentCountCurCrop.', \'f14\');getTotalIncome('.$contentCountCurCrop.', \'f14\');" data-rule-required="true" maxlength="10" placeholder="Expected Yield"> Quintals';
                $curCropData	.= '</div>';
            $curCropData	.= '</div>';  //<!-- Expected Yield [Quintals per Acre] -->

            $curCropData	.= '<div class="control-group">';
                $curCropData	.= '<label for="text" class="control-label" style="margin-top:10px">Future Crop Price <span style="color:#F00">*</span><br>[Rupees Per Quintal]</label>';
                $curCropData	.= '<div class="controls">';
                    $curCropData	.= '<input type="text" id="f14_expectedprice'.$contentCountCurCrop.'" name="f14_expectedprice'.$contentCountCurCrop.'" class="input-xlarge" data-rule-required="true"  onKeyPress="return numsonly(event);" onBlur="getTotalExpectedIncome('.$contentCountCurCrop.', \'f14\');getTotalIncome('.$contentCountCurCrop.', \'f14\');" placeholder="Expected Price"> In Rs.';
                $curCropData	.= '</div>';
            $curCropData	.= '</div>';	//<!--Expected price this year -->

            $curCropData	.= '<div class="control-group span6">';
                $curCropData	.= '<label for="text" class="control-label" style="margin-top:10px">What is the Total income you are expecting in this crop cycle? <span style="color:#F00">*</span><br>[Rupees Per Acre]</label>';
                $curCropData	.= '<div class="controls">';
                    $curCropData	.= '<input readonly type="text" id="f14_expectedincome'.$contentCountCurCrop.'" name="f14_expectedincome'.$contentCountCurCrop.'" class="input-small"  data-rule-required="true"  onKeyPress="return numsonly(event);" placeholder=""> In Rs.';
                $curCropData	.= '</div>';
            $curCropData	.= '</div>';	//<!--Total Income Expected this year [ Per Acre Per Crop ] -->

            $curCropData	.= '<div class="control-group span6">';
                $curCropData	.= '<label for="text" class="control-label" style="margin-top:10px">Total Income <span style="color:#F00">*</span><br><br><br><br><br></label>';
                $curCropData	.= '<div class="controls">';
                    $curCropData	.= '<input readonly type="text" id="f14_totalincome'.$contentCountCurCrop.'" name="f14_totalincome'.$contentCountCurCrop.'" class="input-small"  data-rule-required="true"  onKeyPress="return numsonly(event);" placeholder="Total Income"> In Rs.';
                $curCropData	.= '</div>';
            $curCropData	.= '</div>';	//<!--Total Income  -->

        	$curCropData	.= '<div class="clearfix"></div>';

        	//<!-- =================== -->
            //<!-- START : Seeds -->
            //<!-- =================== -->
            $curCropData	.= '<div class="control-group">';
                $curCropData	.= '<label for="text" class="control-label" style="margin-top:10px">Are they Homegrown seeds?<span style="color:#F00">*</span></label>';
                $curCropData	.= '<div class="controls">';
                    $curCropData	.= '<select id="f14_is_homegrown_seeds'.$contentCountCurCrop.'" name="f14_is_homegrown_seeds'.$contentCountCurCrop.'" class="select2-me input-xlarge" data-rule-required="true" onChange="getSeedsBrand(this.value, \'f14_brand_of_seeds'.$contentCountCurCrop.'\', \'f14_seed_type'.$contentCountCurCrop.'\', \'f14_spend_money'.$contentCountCurCrop.'\');getTotalMoneySpend(\'f14_spend_money\', \'f14_spend_money_fertiliser\', \'f14_spend_money_pesticide\', \'f14_spend_money_labour\', \'f14_spend_money_other_expenses\', \'f14_spend_money_farming_expenses\', \'f14_spend_money_total\','.$contentCountCurCrop.', \'f14\');">';
                        $curCropData	.= '<option value="" disabled selected> Select here</option>';
                        $curCropData	.= '<option value="yes" >Yes</option>';
                        $curCropData	.= '<option value="no" >No</option>';
                    $curCropData	.= '</select>';
                $curCropData	.= '</div>';
          	$curCropData	.= '</div>';	//<!-- Are they Homegrown seeds?  -->

          	$curCropData	.= '<div class="clearfix"></div>';

            $curCropData	.= '<div class="control-group span6">';
                $curCropData	.= '<label for="text" class="control-label" style="margin-top:10px">Brand Of Seeds<span style="color:#F00">*</span><br><br></label>';
                $curCropData	.= '<div class="controls">';
                    $curCropData	.= '<input type="text" id="f14_brand_of_seeds'.$contentCountCurCrop.'" name="f14_brand_of_seeds'.$contentCountCurCrop.'" class="input-xlarge" data-rule-required="true" placeholder="Brand Of Seeds">';
                $curCropData	.= '</div>';
            $curCropData	.= '</div>';	//<!-- Brand Of Seeds -->

            $curCropData	.= '<div class="control-group span6">';
                $curCropData	.= '<label for="text" class="control-label" style="margin-top:10px">What type of seeds you plan to buy?<span style="color:#F00">*</span></label>';
                $curCropData	.= '<div class="controls">';
                    $curCropData	.= '<select id="f14_seed_type'.$contentCountCurCrop.'" name="f14_seed_type'.$contentCountCurCrop.'" class="select2-me input-xlarge" data-rule-required="true" > ';
                        $curCropData	.= '<option value="" disabled selected> Select here</option>';
                        $curCropData	.= '<option value="NA" >NA</option> ';
                        $curCropData	.= '<option point="10" value="Hybrid" >Hybrid</option> ';
                        $curCropData	.= '<option point="0" value="Non Hybrid" >Non-Hybrid</option> ';
                    $curCropData	.= '</select>';
                $curCropData	.= '</div>';
          	$curCropData	.= '</div>';	//<!-- What type of seeds you plan to buy -->

            $curCropData	.= '<div class="clearfix"></div>';

            $curCropData	.= '<div class="control-group span6">';
                $curCropData	.= '<label for="text" class="control-label" style="margin-top:10px">How much was the total consumption of Seeds in KGs <span style="color:#F00">*</span></label>';
                $curCropData	.= '<div class="controls">';
                    $curCropData	.= '<input type="text" id="f14_consumption_seeds'.$contentCountCurCrop.'" name="f14_consumption_seeds'.$contentCountCurCrop.'" class="input-xlarge" onKeyPress="return numsonly(event);" maxlength="10" data-rule-required="true" placeholder="How much was the total consumption of Seeds in KGs"> KGs';
                $curCropData	.= '</div>';
            $curCropData	.= '</div>';	//<!-- How much was the total consumption of Seeds in KGs -->

            $curCropData	.= '<div class="control-group span6">';
                $curCropData	.= '<label for="text" class="control-label" style="margin-top:10px">How much money you spend in buying seeds?<span style="color:#F00">*</span></label>';
                $curCropData	.= '<div class="controls">';
                    $curCropData	.= '<input type="text" onBlur="getTotalMoneySpend(\'f14_spend_money\', \'f14_spend_money_fertiliser\', \'f14_spend_money_pesticide\', \'f14_spend_money_labour\', \'f14_spend_money_other_expenses\', \'f14_spend_money_farming_expenses\', \'f14_spend_money_total\','.$contentCountCurCrop.', \'f14\');" id="f14_spend_money'.$contentCountCurCrop.'" name="f14_spend_money'.$contentCountCurCrop.'" class="input-xlarge" onKeyPress="return numsonly(event);" maxlength="10" data-rule-required="true" placeholder="money you spend in buying seeds">Rs';
                $curCropData	.= '</div>';
            $curCropData	.= '</div>';	//<!-- spend money for seeds -->

            $curCropData	.= '<div class="clearfix"></div>';
            
            //<!-- =================== -->
            //<!-- END : Seeds -->
            //<!-- =================== -->

            //<!-- =================== -->
            //<!-- START : FERTILISER -->
            //<!-- =================== -->

            $curCropData	.= '<div class="control-group">';
                $curCropData	.= '<label for="text" class="control-label" style="margin-top:10px">Brand Of Fertiliser<span style="color:#F00">*</span></label>';
                $curCropData	.= '<div class="controls">';
                    $curCropData	.= '<input type="text" id="f14_brand_of_fertiliser'.$contentCountCurCrop.'" name="f14_brand_of_fertiliser'.$contentCountCurCrop.'" class="input-xlarge" data-rule-required="true" placeholder="Brand Of Fertiliser">';
                $curCropData	.= '</div>';
            $curCropData	.= '</div>';	//<!-- Brand Of Fertiliser -->

            $curCropData	.= '<div class="clearfix"></div>';

            $curCropData	.= '<div class="control-group span6">';
                $curCropData	.= '<label for="text" class="control-label" style="margin-top:10px">How much was the total consumption of Fertilizer in KGs <span style="color:#F00">*</span></label>';
                $curCropData	.= '<div class="controls">';
                    $curCropData	.= '<input type="text" id="f14_consumption_fertilizer'.$contentCountCurCrop.'" name="f14_consumption_fertilizer'.$contentCountCurCrop.'" class="input-xlarge" onKeyPress="return numsonly(event);" maxlength="10" data-rule-required="true" placeholder="How much was the total consumption of Fertilizer in KGs"> KGs';
                $curCropData	.= '</div>';
            $curCropData	.= '</div>';	//<!-- How much was the total consumption of Fertilizer in KGs -->

            $curCropData	.= '<div class="control-group span6">';
                $curCropData	.= '<label for="text" class="control-label" style="margin-top:10px">How much money you spend in buying Fertiliser?<span style="color:#F00">*</span></label>';
                $curCropData	.= '<div class="controls">';
                    $curCropData	.= '<input type="text" onBlur="getTotalMoneySpend(\'f14_spend_money\', \'f14_spend_money_fertiliser\', \'f14_spend_money_pesticide\', \'f14_spend_money_labour\', \'f14_spend_money_other_expenses\', \'f14_spend_money_farming_expenses\', \'f14_spend_money_total\','.$contentCountCurCrop.', \'f14\');" id="f14_spend_money_fertiliser'.$contentCountCurCrop.'" name="f14_spend_money_fertiliser'.$contentCountCurCrop.'" class="input-xlarge" onKeyPress="return numsonly(event);" maxlength="10" data-rule-required="true" placeholder="money you spend in buying fertiliser">Rs';
                $curCropData	.= '</div>';
            $curCropData	.= '</div>';	//<!-- spend money for Fertiliser -->

            $curCropData	.= '<div class="clearfix"></div>';
            
            //<!-- =================== -->
            //<!-- END : FERTILISER -->
            //<!-- =================== -->

            //<!-- =================== -->
            //<!-- START : Pesticides -->
            //<!-- =================== -->

            $curCropData	.= '<div class="control-group">';
                $curCropData	.= '<label for="text" class="control-label" style="margin-top:10px">Brand Of Pesticide <span style="color:#F00">*</span></label>';
                $curCropData	.= '<div class="controls">';
                    $curCropData	.= '<input type="text" id="f14_brand_of_pesticide'.$contentCountCurCrop.'" name="f14_brand_of_pesticide'.$contentCountCurCrop.'" class="input-xlarge" data-rule-required="true" placeholder="Brand Of Pesticide">';
                $curCropData	.= '</div>';
            $curCropData	.= '</div>';	//<!-- Brand Of Pesticide -->

            $curCropData	.= '<div class="clearfix"></div>';

            $curCropData	.= '<div class="control-group span6">';
                $curCropData	.= '<label for="text" class="control-label" style="margin-top:10px">How much was the total consumption of Pesticides in KGs <span style="color:#F00">*</span></label>';
                $curCropData	.= '<div class="controls">';
                    $curCropData	.= '<input type="text" id="f14_consumption_pesticides'.$contentCountCurCrop.'" name="f14_consumption_pesticides'.$contentCountCurCrop.'" class="input-xlarge" onKeyPress="return numsonly(event);" maxlength="10" data-rule-required="true" placeholder="How much was the total consumption of Pesticides in KGs"> KGs';
                $curCropData	.= '</div>';
            $curCropData	.= '</div>';	//<!-- How much was the total consumption of Pesticides in KGs -->

            $curCropData	.= '<div class="control-group span6">';
                $curCropData	.= '<label for="text" class="control-label" style="margin-top:10px">How much money you spend in buying Pesticide?<span style="color:#F00">*</span></label>';
                $curCropData	.= '<div class="controls">';
                    $curCropData	.= '<input type="text" onBlur="getTotalMoneySpend(\'f14_spend_money\', \'f14_spend_money_fertiliser\', \'f14_spend_money_pesticide\', \'f14_spend_money_labour\', \'f14_spend_money_other_expenses\', \'f14_spend_money_farming_expenses\', \'f14_spend_money_total\','.$contentCountCurCrop.', \'f14\');" id="f14_spend_money_pesticide'.$contentCountCurCrop.'" name="f14_spend_money_pesticide'.$contentCountCurCrop.'" class="input-xlarge" onKeyPress="return numsonly(event);" maxlength="10" data-rule-required="true" placeholder="money you spend in buying pesticide">Rs';
                $curCropData	.= '</div>';
            $curCropData	.= '</div>';	//<!-- spend money for Pesticide -->

            $curCropData	.= '<div class="clearfix"></div>';
            
            //<!-- =================== -->
            //<!-- END : Pesticides -->
            //<!-- =================== -->

            //<!-- =================== -->
            //<!-- START : Other Inputs -->
            //<!-- =================== -->
            $curCropData	.= '<div class="control-group span6">';
                $curCropData	.= '<label for="text" class="control-label" style="margin-top:10px">Brand of The Input Used<span style="color:#F00">*</span><br>[comma separated names]<br><br><br><br></label>';
                $curCropData	.= '<div class="controls">';
                    $curCropData	.= '<input type="text" id="f14_brand_of_input_used'.$contentCountCurCrop.'" name="f14_brand_of_input_used'.$contentCountCurCrop.'" class="input-xlarge" data-rule-required="true" placeholder="Brand of The Input Used">';
                $curCropData	.= '</div>';
            $curCropData	.= '</div>';	//<!-- Brand of The Input Used -->

            $curCropData	.= '<input type="hidden" id="batch_chk_f14_other_inputs_used'.$contentCountCurCrop.'" name="batch_chk_f14_other_inputs_used'.$contentCountCurCrop.'" value="">';
            
            $curCropData	.= '<div class="control-group span6">';
                $curCropData	.= '<label for="text" class="control-label" style="margin-top:10px">What were the Other Inputs You Use?<span style="color:#F00">*</span></label>';
                $curCropData	.= '<div class="controls">';
                	$curCropData	.= '<input type="checkbox" name="f14_other_inputs_used'.$contentCountCurCrop.'" class="cls_batch_chk_f14_other_inputs_used'.$contentCountCurCrop.'" value="Herbicide"> &nbsp;Herbicide &nbsp;&nbsp;<br>';
					$curCropData	.= '<input type="checkbox" name="f14_other_inputs_used'.$contentCountCurCrop.'" class="cls_batch_chk_f14_other_inputs_used'.$contentCountCurCrop.'" value="Insecticide"> &nbsp;Insecticide &nbsp;&nbsp;<br>';
					$curCropData	.= '<input type="checkbox" name="f14_other_inputs_used'.$contentCountCurCrop.'" class="cls_batch_chk_f14_other_inputs_used'.$contentCountCurCrop.'" value="Fungicide"> &nbsp;Fungicide &nbsp;&nbsp;<br>';
					$curCropData	.= '<input type="checkbox" name="f14_other_inputs_used'.$contentCountCurCrop.'" class="cls_batch_chk_f14_other_inputs_used'.$contentCountCurCrop.'" value="Growth Accelerator"> &nbsp;Growth Accelerator &nbsp;&nbsp;<br>';
					$curCropData	.= '<input type="checkbox" name="f14_other_inputs_used'.$contentCountCurCrop.'" class="cls_batch_chk_f14_other_inputs_used'.$contentCountCurCrop.'" value="Manure_Compost"> &nbsp;Manure / Compost &nbsp;&nbsp;<br>';
					$curCropData	.= '<input type="checkbox" name="f14_other_inputs_used'.$contentCountCurCrop.'" class="cls_batch_chk_f14_other_inputs_used'.$contentCountCurCrop.'" value="Rodenticide"> &nbsp;Rodenticide &nbsp;&nbsp;<br>';
					$curCropData	.= '<input type="checkbox" name="f14_other_inputs_used'.$contentCountCurCrop.'" class="cls_batch_chk_f14_other_inputs_used'.$contentCountCurCrop.'" value="Bactericides"> &nbsp;Bactericides &nbsp;&nbsp;<br>';
					$curCropData	.= '<input type="checkbox" name="f14_other_inputs_used'.$contentCountCurCrop.'" class="cls_batch_chk_f14_other_inputs_used'.$contentCountCurCrop.'" value="Larvicide"> &nbsp;Larvicide &nbsp;&nbsp;';
                $curCropData	.= '</div>';
          	$curCropData	.= '</div>';	//<!-- What were the Other Inputs You Use? -->

          	$curCropData	.= '<div class="clearfix"></div>';

            $curCropData	.= '<div class="control-group span6">';
                $curCropData	.= '<label for="text" class="control-label" style="margin-top:10px">How much was the total consumption of Other Inputs in KGs <span style="color:#F00">*</span></label>';
                $curCropData	.= '<div class="controls">';
                    $curCropData	.= '<input type="text" id="f14_consumption_other_inputs'.$contentCountCurCrop.'" name="f14_consumption_other_inputs'.$contentCountCurCrop.'" class="input-xlarge" onKeyPress="return numsonly(event);" maxlength="10" data-rule-required="true" placeholder="How much was the total consumption of Other Inputs in KGs"> KGs';
                $curCropData	.= '</div>';
            $curCropData	.= '</div>';	//<!-- How much was the total consumption of Other Inputs in KGs -->

            $curCropData	.= '<div class="control-group span6">';
                $curCropData	.= '<label for="text" class="control-label" style="margin-top:10px">How much money you spend in buying Other Inputs?<span style="color:#F00">*</span></label>';
                $curCropData	.= '<div class="controls">';
                    $curCropData	.= '<input type="text" onBlur="getTotalMoneySpend(\'f14_spend_money\', \'f14_spend_money_fertiliser\', \'f14_spend_money_pesticide\', \'f14_spend_money_labour\', \'f14_spend_money_other_expenses\', \'f14_spend_money_farming_expenses\', \'f14_spend_money_total\','.$contentCountCurCrop.', \'f14\');" id="f14_spend_money_other_expenses'.$contentCountCurCrop.'" name="f14_spend_money_other_expenses'.$contentCountCurCrop.'" class="input-xlarge" onKeyPress="return numsonly(event);" maxlength="10" data-rule-required="true" placeholder="How much money you spend in buying Other Inputs?">Rs';
                $curCropData	.= '</div>';
            $curCropData	.= '</div>';	//<!-- spend money for Other Expenses -->

            $curCropData	.= '<div class="clearfix"></div>';
            //<!-- =================== -->
            //<!-- END : Other Inputs -->
            //<!-- =================== -->

            $curCropData	.= '<div class="control-group">';
                $curCropData	.= '<label for="text" class="control-label" style="margin-top:10px">How much money you spend in buying Labour?<span style="color:#F00">*</span></label>';
                $curCropData	.= '<div class="controls">';
                    $curCropData	.= '<input type="text" onBlur="getTotalMoneySpend(\'f14_spend_money\', \'f14_spend_money_fertiliser\', \'f14_spend_money_pesticide\', \'f14_spend_money_labour\', \'f14_spend_money_other_expenses\', \'f14_spend_money_farming_expenses\', \'f14_spend_money_total\','.$contentCountCurCrop.', \'f14\');" id="f14_spend_money_labour'.$contentCountCurCrop.'" name="f14_spend_money_labour'.$contentCountCurCrop.'" class="input-xlarge" onKeyPress="return numsonly(event);" maxlength="10" data-rule-required="true" placeholder="money you spend in buying labour">Rs';
                $curCropData	.= '</div>';
            $curCropData	.= '</div>';	// <!-- spend money for Labour -->

            $curCropData	.= '<div class="control-group">';
                $curCropData	.= '<label for="text" class="control-label" style="margin-top:10px">Did you have any other farming expenses? <span style="color:#F00">*</span></label>';
                $curCropData	.= '<div class="controls">';
                    $curCropData	.= '<select id="f14_other_farming_expenses'.$contentCountCurCrop.'" name="f14_other_farming_expenses'.$contentCountCurCrop.'" class="select2-me input-xlarge" data-rule-required="true" onChange="getDisplayDiv(this.value, \'div_f14_other_farming_expenses'.$contentCountCurCrop.'\', \'yes\');">;';
                        $curCropData	.= '<option value="" disabled selected> Select here</option>';
                        $curCropData	.= '<option value="yes" >Yes</option>';
                        $curCropData	.= '<option value="no" >No</option>';
                    $curCropData	.= '</select>';
                    $curCropData	.= '[Ex. like wiring, fencing, crop protection measures winery stands for the grape to grow etc]';
                $curCropData	.= '</div>';
          	$curCropData	.= '</div>';	// <!-- Did you have any other farming expenses? like wiring, fencing, crop protection measures winery stands for the grape to grow etc  -->

          	$curCropData	.= '<div id="div_f14_other_farming_expenses'.$contentCountCurCrop.'" style="display: none;">';
          		
          		$curCropData	.= '<input type="hidden" id="batch_chk_f14_type_other_farming_expenses'.$contentCountCurCrop.'" name="batch_chk_f14_type_other_farming_expenses'.$contentCountCurCrop.'" value="">';
                
                $curCropData	.= '<div class="control-group span6">';
                    $curCropData	.= '<label for="text" class="control-label" style="margin-top:10px">Type of other farming expenses<span style="color:#F00">*</span></label>';
                    $curCropData	.= '<div class="controls">';
                    	$curCropData	.= '<input type="checkbox" name="f14_type_other_farming_expenses'.$contentCountCurCrop.'" class="cls_batch_chk_f14_type_other_farming_expenses'.$contentCountCurCrop.'" value="Rent"> &nbsp;Rent &nbsp;&nbsp;<br>';
						$curCropData	.= '<input type="checkbox" name="f14_type_other_farming_expenses'.$contentCountCurCrop.'" class="cls_batch_chk_f14_type_other_farming_expenses'.$contentCountCurCrop.'" value="Repairs and Maintainance"> &nbsp;Repairs and Maintainance &nbsp;&nbsp;<br>';
						$curCropData	.= '<input type="checkbox" name="f14_type_other_farming_expenses'.$contentCountCurCrop.'" class="cls_batch_chk_f14_type_other_farming_expenses'.$contentCountCurCrop.'" value="Crop Protection and Safety"> &nbsp;Crop Protection and Safety &nbsp;&nbsp;<br>';
						$curCropData	.= '<input type="checkbox" name="f14_type_other_farming_expenses'.$contentCountCurCrop.'" class="cls_batch_chk_f14_type_other_farming_expenses'.$contentCountCurCrop.'" value="Other Tools"> &nbsp;Other Tools &nbsp;&nbsp;<br>';
                    $curCropData	.= '</div>';
              	$curCropData	.= '</div>';	// <!-- What were the Other Inputs You Use? -->

              	$curCropData	.= '<div class="control-group span6">';
                    $curCropData	.= '<label for="text" class="control-label" style="margin-top:10px">How much money did you spend on those farming expenses ?<span style="color:#F00">*</span></label>';
                    $curCropData	.= '<div class="controls">';
                        $curCropData	.= '<input type="text" onBlur="getTotalMoneySpend(\'f14_spend_money\', \'f14_spend_money_fertiliser\', \'f14_spend_money_pesticide\', \'f14_spend_money_labour\', \'f14_spend_money_other_expenses\', \'f14_spend_money_farming_expenses\', \'f14_spend_money_total\','.$contentCountCurCrop.', \'f14\');" id="f14_spend_money_farming_expenses'.$contentCountCurCrop.'" name="f14_spend_money_farming_expenses'.$contentCountCurCrop.'" class="input-xlarge" onKeyPress="return numsonly(event);" maxlength="10" data-rule-required="true" placeholder="">Rs';
                    $curCropData	.= '</div>';
                $curCropData	.= '</div>';	// <!-- How much money did you spend on those farming expenses ? -->

                $curCropData	.= '<div class="clearfix"></div>';
          	$curCropData	.= '</div>';

          	$curCropData	.= '<div class="clearfix"></div>';

            $curCropData	.= '<div class="control-group">';
                $curCropData	.= '<label for="text" class="control-label" style="margin-top:10px">Total spend money for this Crop<span style="color:#F00">*</span></label>';
                $curCropData	.= '<div class="controls">';
                    $curCropData	.= '<input readonly type="text" id="f14_spend_money_total'.$contentCountCurCrop.'" name="f14_spend_money_total'.$contentCountCurCrop.'" class="input-xlarge" onKeyPress="return numsonly(event);" maxlength="10" data-rule-required="true" placeholder="Total spend money for this Crop">Rs';
                $curCropData	.= '</div>';
            $curCropData	.= '</div>';	// <!-- Total spend money for this Crop -->

            $curCropData	.= '<div class="control-group span6">';
                $curCropData	.= '<label for="text" class="control-label" style="margin-top:10px">Total Profit Gained for this crop?<span style="color:#F00">*</span></label>';
                $curCropData	.= '<div class="controls">';
                    $curCropData	.= '<input type="text" id="f14_total_profit_gained'.$contentCountCurCrop.'" name="f14_total_profit_gained'.$contentCountCurCrop.'" class="input-xlarge" onKeyPress="return numsonly(event);" maxlength="10" data-rule-required="true" placeholder="Total Profit Gained for this crop">Rs';
                $curCropData	.= '</div>';
            $curCropData	.= '</div>';	// <!-- Total Profit Gained for this crop? -->

            $curCropData	.= '<div class="control-group span6">';
                $curCropData	.= '<label for="text" class="control-label" style="margin-top:10px">Total Profit <span style="color:#F00">*</span><br><br></label>';
                $curCropData	.= '<div class="controls">';
                    $curCropData	.= '<input type="text" readonly id="f14_total_profit'.$contentCountCurCrop.'" name="f14_total_profit'.$contentCountCurCrop.'" class="input-xlarge" onKeyPress="return numsonly(event);" maxlength="10" data-rule-required="true" placeholder="">Rs';
                $curCropData	.= '</div>';
            $curCropData	.= '</div>';	// <!-- Total Profit  -->

            $curCropData	.= '<div class="clearfix"></div>';

            $curCropData	.= '<div class="control-group span6">';
                $curCropData	.= '<label for="text" class="control-label" style="margin-top:10px">Potential Crop Damage<span style="color:#F00">*</span></label>';
                $curCropData	.= '<div class="controls">';
                    $curCropData	.= '<select id="f14_diseases'.$contentCountCurCrop.'" name="f14_diseases'.$contentCountCurCrop.'" class="select2-me input-xlarge" data-rule-required="true" onchange="calTotal_f14()">';
                        $curCropData	.= '<option value="" disabled selected> Select here</option>';
                        $curCropData	.= '<option point="1" value="Disease" > Disease</option>';
                        $curCropData	.= '<option point="4" value="Pest" > Pest</option>';
                        $curCropData	.= '<option point="5" value="Both" > Both</option>';
                        $curCropData	.= '<option point="10" value="None" > None</option>';
                    $curCropData	.= '</select>';
                $curCropData	.= '</div>';
            $curCropData	.= '</div>';	// <!--Potential crop Damage-->
            
            $curCropData	.= '<div class="clearfix"></div>';

		$curCropData	.= '</div>';

		$curCropData 	.= '<script type="text/javascript">';
			$curCropData 	.= '$(".datepicker").datepicker({format:\'yyyy-mm-dd\'});';
			$curCropData 	.= '$("#f14_crop_season'.$contentCountCurCrop.'").select2();';
			$curCropData 	.= '$("#f14_farming_type'.$contentCountCurCrop.'").select2();';
			$curCropData 	.= '$("#f14_potential_market'.$contentCountCurCrop.'").select2();';
			$curCropData 	.= '$("#f14_crop_storage'.$contentCountCurCrop.'").select2();';
			$curCropData 	.= '$("#f14_is_homegrown_seeds'.$contentCountCurCrop.'").select2();';
			$curCropData 	.= '$("#f14_other_farming_expenses'.$contentCountCurCrop.'").select2();';
			$curCropData 	.= '$("#f14_crop_type'.$contentCountCurCrop.'").select2();';
			$curCropData 	.= '$("#f14_cultivating'.$contentCountCurCrop.'").select2();';
			$curCropData 	.= '$("#f14_variety'.$contentCountCurCrop.'").select2();';
			$curCropData 	.= '$("#f14_seed_type'.$contentCountCurCrop.'").select2();';
			$curCropData 	.= '$("#f14_use_self_grown_seeds'.$contentCountCurCrop.'").select2();';
			$curCropData 	.= '$("#f14_diseases'.$contentCountCurCrop.'").select2();';
		$curCropData 	.= '</script>';

		quit(utf8_encode($curCropData),1);
	}

	if((isset($obj->addPrevCropData)) == 1 && (isset($obj->addPrevCropData)))	// f11
	{
		$contentCountPrevCrop = $obj->contentCountPrevCrop;
		$fm_id                = $obj->farmer_id;
		
		$prevCropData         = '';

		$prevCropData	.= '<div id="prevcrop'.$contentCountPrevCrop.'" style="padding:5px;border:1px solid #d6d6d6;margin:5px; display:none;">';
			$prevCropData	.= '<input type="hidden" name="id[]" id="id" value="">';   
			$prevCropData	.= '<h3>Previous Crop '.$contentCountPrevCrop.' Details</h3>';

			$prevCropData	.= '<div class="control-group">';
                $prevCropData	.= '<label for="tasktitel" class="control-label">Which season did you farm last? <span style="color:#F00">*</span>';
                $prevCropData	.= '</label>';
                $prevCropData	.= '<div class="controls">';
                    $prevCropData	.= '<select id="f11_crop_season'.$contentCountPrevCrop.'" name="f11_crop_season'.$contentCountPrevCrop.'" class="select2-me input-xlarge" >';
	                    $prevCropData	.= '<option value="" disabled selected>Select here</option>';
	                    $prevCropData	.= '<option value="Kharif" >Kharif</option>';
	                    $prevCropData	.= '<option value="Rabi" >Rabi</option>';
	                    $prevCropData	.= '<option value="Annual" >Annual</option>';
                    $prevCropData	.= '</select>';
                $prevCropData	.= '</div>';
            $prevCropData	.= '</div>';  	// <!-- Current Crop Season [DDL] -->

            $prevCropData	.= '<div class="control-group">';
                $prevCropData	.= '<label for="text" class="control-label" style="margin-top:10px">What Type of Crop  you grew?<span style="color:#F00">*</span></label>';
                $prevCropData	.= '<div class="controls">';
                    $prevCropData	.= '<select id="f11_crop_type'.$contentCountPrevCrop.'" name="f11_crop_type'.$contentCountPrevCrop.'" class="select2-me input-xlarge" data-rule-required="true">';
	                    $prevCropData	.= '<option value="" disabled selected> Select here</option>';
	                    $prevCropData	.= '<option value="Commercial" >Commercial</option>';
	                    $prevCropData	.= '<option value="Seasonal" >Seasonal</option>';
                    $prevCropData	.= '</select>';
                $prevCropData	.= '</div>';
          	$prevCropData	.= '</div>';	// <!--  Crop Type-->
								
			$prevCropData	.= '<div class="control-group">';
				$prevCropData	.= '<label for="tasktitel" class="control-label">Type of crop cultivating previous year <span style="color:#F00">*</span></label>';
				$prevCropData	.= '<div class="controls">';
					$prevCropData	.= '<select id="f11_cultivating'.$contentCountPrevCrop.'" name="f11_cultivating'.$contentCountPrevCrop.'" class="select2-me input-xlarge" data-rule-required="true" onchange="calTotal_f11();get_variety(this.value,'.$contentCountPrevCrop.', \'f11\');getDisplayDiv(this.value, \'div_f11_cultivating'.$contentCountPrevCrop.'\', \'other\');">';
						$prevCropData	.= '<option value="" disabled selected> Select here</option>';
						$prevCropData	.= '<option point="7" value="other" >Other</option>';
											
											$crops = lookup_value('tbl_crops',array(),array("crop_status"=>1),array(),array(),array());
											while($crop = mysqli_fetch_array($crops))
											{
												$prevCropData	.= '<option point="7" value="'.$crop['crop_id'].'">';
													$prevCropData	.= strtoupper(trim($crop['crop_name']));
												$prevCropData	.= '</option>';
											}
										
					$prevCropData	.= '</select>';
				$prevCropData	.= '</div>';
			$prevCropData	.= '</div>';	// Type of crop cultivating previous year 

			$prevCropData	.= '<div id="div_f11_cultivating'.$contentCountPrevCrop.'" style="display: none;">';
                $prevCropData	.= '<div class="control-group">';
			        $prevCropData	.= '<label for="tasktitel" class="control-label">Mention Crop Name <span style="color:#F00">*</span></label>';
			        $prevCropData	.= '<div class="controls">';
			        	$prevCropData	.= '<input type="text" placeholder="Other Crop Name!" data-rule-required="true" name="f11_other_crop_name'.$contentCountPrevCrop.'" id="f11_other_crop_name'.$contentCountPrevCrop.'" class="input-xlarge" >';
			        $prevCropData	.= '</div>';
		        $prevCropData	.= '</div>';
		        $prevCropData	.= '<div style="clear: both;"></div>';
            $prevCropData	.= '</div>';	// Mention Crop Name 

            $prevCropData	.= '<div class="control-group">';
				$prevCropData	.= '<label for="text" class="control-label" style="margin-top:10px">Variety of crop used?<span style="color:#F00">*</span></label>';
				$prevCropData	.= '<div class="controls">';
					$prevCropData	.= '<select id="f11_variety'.$contentCountPrevCrop.'" name="f11_variety'.$contentCountPrevCrop.'" class="select2-me input-xlarge" data-rule-required="true" >';
						$prevCropData	.= '<option value="" disabled selected> Select here</option>';
					$prevCropData	.= '</select>';
				$prevCropData	.= '</div>';
			$prevCropData	.= '</div>';	// Variety of crop used?

			$prevCropData	.= '<div class="control-group">';
                $prevCropData	.= '<label for="text" class="control-label" style="margin-top:10px">What Type Of Farming You are Doing?<span style="color:#F00">*</span></label>';
                $prevCropData	.= '<div class="controls">';
                    $prevCropData	.= '<select id="f11_farming_type'.$contentCountPrevCrop.'" name="f11_farming_type'.$contentCountPrevCrop.'" class="select2-me input-xlarge" data-rule-required="true" >';
                        $prevCropData	.= '<option value="" disabled selected> Select here</option>';
                        $prevCropData	.= '<option value="Organic">Organic</option>';
                        $prevCropData	.= '<option value="Non Organic">Non-Organic</option>';
                        $prevCropData	.= '<option value="Both">Both</option>';
                    $prevCropData	.= '</select>';
                $prevCropData	.= '</div>';
          	$prevCropData	.= '</div>';	// <!-- What Type Of Farming You are Doing? -->

          	$prevCropData	.= '<div class="control-group span6">';
                $prevCropData	.= '<label for="tasktitel" class="control-label">Market you sold your crop to? <span style="color:#F00">*</span></label>';
                $prevCropData	.= '<div class="controls">';
                    $prevCropData	.= '<select id="f11_potential_market'.$contentCountPrevCrop.'" name="f11_potential_market'.$contentCountPrevCrop.'" class="select2-me input-xlarge" >';
                        $prevCropData	.= '<option value="" disabled selected>Select here</option>';
                        $prevCropData	.= '<option value="Local Mandis and Location" >Local Mandis and Location</option>';
                        $prevCropData	.= '<option value="FPO" >FPO</option>';
                        $prevCropData	.= '<option value="Private Buyer" >Private Buyer (Companies)</option>';
                        $prevCropData	.= '<option value="Government" >Government</option>';
                        $prevCropData	.= '<option value="Other" >Other</option>';
                    $prevCropData	.= '</select>';
                $prevCropData	.= '</div>';
            $prevCropData	.= '</div>';  	// <!-- Market you sold your crop to? [DDL] -->

            $prevCropData	.= '<div class="control-group span6">';
                $prevCropData	.= '<label for="tasktitel" class="control-label">Crop Storage In Previous Season <span style="color:#F00">*</span>';
                $prevCropData	.= '</label>';
                $prevCropData	.= '<div class="controls">';
                    $prevCropData	.= '<select id="f11_crop_storage'.$contentCountPrevCrop.'" name="f11_crop_storage'.$contentCountPrevCrop.'" class="select2-me input-xlarge" >';
                        $prevCropData	.= '<option value="" disabled selected>Select here</option>';
                        $prevCropData	.= '<option value="Govt Warehouse">Govt. Warehouse</option>';
                        $prevCropData	.= '<option value="Pvt Warehouse">Pvt. Warehouse</option>';
                        $prevCropData	.= '<option value="Factory">Factory</option>';
                        $prevCropData	.= '<option value="Mandis Direct">Mandis Direct</option>';
                    $prevCropData	.= '</select>';
                $prevCropData	.= '</div>';
            $prevCropData	.= '</div>';  	// <!-- Crop Storage In Previous Season [DDL] -->

            $prevCropData	.= '<div class="clearfix"></div>';

            $prevCropData	.= '<div class="control-group">';
					$prevCropData	.= '<label for="text" class="control-label" style="margin-top:10px">What was your Water Source for that crop?<span style="color:#F00">*</span></label>';
					$prevCropData	.= '<div class="controls">';
						$prevCropData	.= '<div id="div_f11_water_source_type'.$contentCountPrevCrop.'">';
	                		// Query For getting the list of Water Source
							$sql_get_f11_water_source_list	= " SELECT * FROM `tbl_water_source` WHERE `status`='1' AND water_source NOT IN (SELECT DISTINCT(water_source_name) FROM tbl_f11_farmer_water_source WHERE fm_id='".$fm_id."' AND count='".$contentCountPrevCrop."') ";
							$res_get_f11_water_source_list 	= mysqli_query($db_con, $sql_get_f11_water_source_list) or die(mysqli_error($db_con));

							if($res_get_f11_water_source_list)
							{
								$num_get_f11_water_source_list	= mysqli_num_rows($res_get_f11_water_source_list);

								$prevCropData	.= '<select id="f11_water_source_type'.$contentCountPrevCrop.'" name="f11_water_source_type'.$contentCountPrevCrop.'[]" multiple="multiple"  onChange="console.log($(this).children(\':selected\').length)" placeholder="Select Water Source" class="select2-me input-xxlarge" data-rule-required="true">';
						    		if($num_get_f11_water_source_list != 0)
									{
										while($row_get_f11_water_source_list	= mysqli_fetch_array($res_get_f11_water_source_list))
										{
						            		$prevCropData	.= '<option point="'.$row_get_f11_water_source_list['points'].'" value="'.$row_get_f11_water_source_list['water_source'].'">'.trim(ucwords($row_get_f11_water_source_list['water_source'])).'</option>';
						    			}
									}
									else
									{
							    		$prevCropData	.= '<option point="0" value="">No Match Found</option>';
						    		}
						        $prevCropData	.= '</select>';

						        $prevCropData 	.= '<script type="text/javascript">';
									$prevCropData 	.= '$("#f11_water_source_type'.$contentCountPrevCrop.'").select2();';
								$prevCropData 	.= '</script>';

								$prevCropData	.= '<input value="Add Here" class="btn-success" type="button" onclick="addf11WaterSource('.$fm_id.', '.$contentCountPrevCrop.');">';
								// Query For getting the Service Provider list for that user
						        $sql_get_f11_farmer_water_source	= " SELECT * FROM `tbl_f11_farmer_water_source` WHERE `fm_id`='".$fm_id."' AND count='".$contentCountPrevCrop."' ";
						        $res_get_f11_farmer_water_source	= mysqli_query($db_con, $sql_get_f11_farmer_water_source) or die(mysqli_error($db_con));
						        $num_get_f11_farmer_water_source	= mysqli_num_rows($res_get_f11_farmer_water_source);
						        $startOffset_f11	= 0;
							    $prevCropData	.= '<table class="table table-bordered dataTable">';
						        	$prevCropData	.= '<thead>';
						        		$prevCropData	.= '<th>Sr. No.</th>';
						        		$prevCropData	.= '<th>Water Source</th>';
						        		$prevCropData	.= '<th style="text-align:center">';
						        			$prevCropData	.= '<div style="text-align:center">';
						        				$prevCropData	.= '<input type="button" value="Delete" onclick="multipleWaterSourceDelete_f11('.$fm_id.', '.$contentCountPrevCrop.');" class="btn-danger"/>';
						        			$prevCropData	.= '</div>';
						        		$prevCropData	.= '</th>';
						        	$prevCropData	.= '</thead>';
						        	$prevCropData	.= '<tbody>';
						        		if($num_get_f11_farmer_water_source != 0)
						        		{
						        			while($row_get_f11_farmer_water_source = mysqli_fetch_array($res_get_f11_farmer_water_source))
						        			{
						        				$prevCropData	.= '<tr>';
													$prevCropData	.= '<td>'.++$startOffset_f11.'</td>';
													$prevCropData	.= '<td>'.ucwords($row_get_f11_farmer_water_source['water_source_name']).'</td>';
													$prevCropData	.= '<td align="center">';
														$prevCropData	.= '<input type="checkbox" value="'.$row_get_f11_farmer_water_source['id'].'" id="f11_water_source_'.$row_get_f11_farmer_water_source['id'].'" name="f11_water_source_'.$row_get_f11_farmer_water_source['id'].'" class="css-checkbox f11_water_source">';
													$prevCropData	.= '</td>';
												$prevCropData	.= '</tr>';
						        			}
						        		}
						        		else
						        		{
						        			$prevCropData	.= '<tr>';
						            			$prevCropData	.= '<td>&nbsp;</td>';
												$prevCropData	.= '<td>No Match Found</td>';
						            			$prevCropData	.= '<td>&nbsp;</td>';
						        			$prevCropData	.= '</tr>';
						        		}
						        	$prevCropData	.= '</tbody>';
						        $prevCropData	.= '</table>';
						    }
						$prevCropData	.= '</div>';
					$prevCropData	.= '</div>';
			$prevCropData	.= '</div>';	// What was your Water Source for that crop?

			$prevCropData	.= '<div class="control-group">';
				$prevCropData	.= '<label for="text" class="control-label" style="margin-top:10px">In How many acres did you sow the crop '.$contentCountPrevCrop.'<span style="color:#F00">*</span><br>[Hector-Acre-Guntha]</label>';
				$prevCropData	.= '<div class="controls">';
					$prevCropData	.= '<input type="text" onKeyUp="getAcre_f11(this.value, \'hector\', \'f11_total_acrage'.$contentCountPrevCrop.'\', '.$contentCountPrevCrop.');getTotalIncome('.$contentCountPrevCrop.', \'f11\');" value="" id="f11_total_hector'.$contentCountPrevCrop.'" name="f11_total_hector'.$contentCountPrevCrop.'" class="input-small" onKeyPress="return numsonly(event);" maxlength="10" placeholder="Hector">&nbsp;&nbsp;-&nbsp;';
					$prevCropData	.= '<input type="text" onKeyUp="getAcre_f11(this.value, \'acre\', \'f11_total_acrage'.$contentCountPrevCrop.'\', '.$contentCountPrevCrop.');getTotalIncome('.$contentCountPrevCrop.', \'f11\');" value="" id="f11_total_acre'.$contentCountPrevCrop.'" name="f11_total_acre'.$contentCountPrevCrop.'" class="input-small" onKeyPress="return numsonly(event);" maxlength="10" placeholder="Acre">&nbsp;&nbsp;-&nbsp;';
					$prevCropData	.= '<input type="text" onKeyUp="getAcre_f11(this.value, \'guntha\', \'f11_total_acrage'.$contentCountPrevCrop.'\', '.$contentCountPrevCrop.');getTotalIncome('.$contentCountPrevCrop.', \'f11\');" value="" id="f11_total_guntha'.$contentCountPrevCrop.'" name="f11_total_guntha'.$contentCountPrevCrop.'" class="input-small" onKeyPress="return numsonly(event);" maxlength="10" placeholder="Guntha">';
					$prevCropData	.= '<input type="text" value="" id="f11_total_acrage'.$contentCountPrevCrop.'" name="f11_total_acrage'.$contentCountPrevCrop.'" class="input-small" onKeyPress="return numsonly(event);" maxlength="10" data-rule-required="true" placeholder="" readonly>Total Acres';
				$prevCropData	.= '</div>';
			$prevCropData	.= '</div>';	// In How many acres did you sow the crop

			$prevCropData	.= '<div class="control-group">';
                $prevCropData	.= '<label for="tasktitel" class="control-label">When Did You Harvest The Crop? <span style="color:#F00">*</span><br>[YYYY-MM-DD]</label>';
                $prevCropData	.= '<div class="controls">';
                    $prevCropData	.= '<input type="text" id="f11_harvest_date'.$contentCountPrevCrop.'" name="f11_harvest_date'.$contentCountPrevCrop.'" placeholder="[YYYY-MM-DD]" class="datepicker input-large" data-rule-required="true" />';
                $prevCropData	.= '</div>';
            $prevCropData	.= '</div>';  	// 	<!-- When Did You Harvest The Crop? -->

            $prevCropData	.= '<div class="control-group">';
				$prevCropData	.= '<label for="text" class="control-label" style="margin-top:10px">Total Yield Achieved Last Year <span style="color:#F00">*</span> <br>[Quintals per Acre]</label>';
				$prevCropData	.= '<div class="controls">';
					$prevCropData	.= '<input type="text" id="f11_expected'.$contentCountPrevCrop.'" name="f11_expected'.$contentCountPrevCrop.'" class="input-xlarge"  onKeyPress="return numsonly(event);" maxlength="10" data-rule-required="true" onBlur="getTotalExpectedIncome('.$contentCountPrevCrop.', \'f11\');getTotalIncome('.$contentCountPrevCrop.', \'f11\');" onchange="calTotal_f11()" placeholder="Yield Achieved"> Quintals';
				$prevCropData	.= '</div>';
			$prevCropData	.= '</div>';	// Total Yield Achieved Last Year 

			$prevCropData	.= '<div class="control-group">';
				$prevCropData	.= '<label for="text" class="control-label" style="margin-top:10px">Previous Season Crop Price Per Quintal<span style="color:#F00">*</span><br>[Rupees Per Quintal]</label>';
				$prevCropData	.= '<div class="controls">';
					$prevCropData	.= '<input type="text" id="f11_expectedprice'.$contentCountPrevCrop.'" name="f11_expectedprice'.$contentCountPrevCrop.'" class="input-xlarge" data-rule-required="true"  onKeyPress="return numsonly(event);" maxlength="10" onBlur="getTotalExpectedIncome('.$contentCountPrevCrop.', \'f11\');getTotalIncome('.$contentCountPrevCrop.', \'f11\');" placeholder="Expected Price">  Rs.';
				$prevCropData	.= '</div>';
			$prevCropData	.= '</div>';	// Previous Season Crop Price Per Quintal

			$prevCropData	.= '<div class="control-group span6">';
				$prevCropData	.= '<label for="text" class="control-label" style="margin-top:10px">Total Income Achieved Last Year <span style="color:#F00">*</span> <br>[Rupees Per Acre]</label>';
				$prevCropData	.= '<div class="controls">';
					$prevCropData	.= '<input type="text" readonly id="f11_income'.$contentCountPrevCrop.'" name="f11_income'.$contentCountPrevCrop.'" class="input-xlarge" onKeyPress="return numsonly(event);" data-rule-required="true" onchange="calTotal_f11()" placeholder="Income Achieved"> Rs.';
				$prevCropData	.= '</div>';
			$prevCropData	.= '</div>';	// Total Income Achieved Last Year

			$prevCropData	.= '<div class="control-group span6">';
		        $prevCropData	.= '<label for="text" class="control-label" style="margin-top:10px">Total Income <span style="color:#F00">*</span><br><br><br></label>';
		        $prevCropData	.= '<div class="controls">';
		            $prevCropData	.= '<input readonly type="text" id="f11_totalincome'.$contentCountPrevCrop.'" name="f11_totalincome'.$contentCountPrevCrop.'" class="input-small"  data-rule-required="true"  onKeyPress="return numsonly(event);" placeholder=""> Rs.'; // onchange="calTotal_f10()"
		        $prevCropData	.= '</div>';
		    $prevCropData	.= '</div>';	// <!--Total Income  -->

		    $prevCropData	.= '<div class="clearfix"></div>';

		    // ====================================					
			// START : Seeds
			// ====================================
		    $prevCropData	.= '<div class="control-group">';
                $prevCropData	.= '<label for="text" class="control-label" style="margin-top:10px">Are they Homegrown seeds?<span style="color:#F00">*</span></label>';
                $prevCropData	.= '<div class="controls">';
                    $prevCropData	.= '<select id="f11_is_homegrown_seeds'.$contentCountPrevCrop.'" name="f11_is_homegrown_seeds'.$contentCountPrevCrop.'" class="select2-me input-xlarge" data-rule-required="true" onChange="getSeedsBrand(this.value, \'f11_brand_of_seeds'.$contentCountPrevCrop.'\', \'f11_seed_type'.$contentCountPrevCrop.'\', \'f11_spend_money'.$contentCountPrevCrop.'\');getTotalMoneySpend(\'f11_spend_money\', \'f11_spend_money_fertiliser\', \'f11_spend_money_pesticide\', \'f11_spend_money_labour\', \'f11_spend_money_other_expenses\', \'f11_spend_money_farming_expenses\', \'f11_spend_money_total\','.$contentCountPrevCrop.', \'f11\');">';
                        $prevCropData	.= '<option value="" disabled selected> Select here</option>';
                        $prevCropData	.= '<option value="yes">Yes</option>';
                        $prevCropData	.= '<option value="no">No</option>';
                    $prevCropData	.= '</select>';
                $prevCropData	.= '</div>';
          	$prevCropData	.= '</div>';	// <!-- Are they Homegrown seeds?  -->

          	$prevCropData	.= '<div class="clearfix"></div>';

			$prevCropData	.= '<div class="control-group span6">';
                $prevCropData	.= '<label for="text" class="control-label" style="margin-top:10px">Brand Of Seeds<span style="color:#F00">*</span><br><br></label>';
                $prevCropData	.= '<div class="controls">';
                    $prevCropData	.= '<input type="text" id="f11_brand_of_seeds'.$contentCountPrevCrop.'" name="f11_brand_of_seeds'.$contentCountPrevCrop.'" class="input-xlarge" data-rule-required="true" placeholder="Brand Of Seeds">';
                $prevCropData	.= '</div>';
            $prevCropData	.= '</div>';	//<!-- Brand Of Seeds -->

            $prevCropData	.= '<div class="control-group span6">';
                $prevCropData	.= '<label for="text" class="control-label" style="margin-top:10px">What type of seeds you used?<span style="color:#F00">*</span></label>';
                $prevCropData	.= '<div class="controls">';
                    $prevCropData	.= '<select id="f11_seed_type'.$contentCountPrevCrop.'" name="f11_seed_type'.$contentCountPrevCrop.'" class="select2-me input-xlarge" data-rule-required="true" >';
                        $prevCropData	.= '<option value="" disabled selected> Select here</option>';
                        $prevCropData	.= '<option value="NA">NA</option>';
                        $prevCropData	.= '<option value="Hybrid">Hybrid</option>';
                        $prevCropData	.= '<option value="Non Hybrid">Non-Hybrid</option>';
                    $prevCropData	.= '</select>';
                $prevCropData	.= '</div>';
          	$prevCropData	.= '</div>';	//<!-- seed type -->

            $prevCropData	.= '<div class="clearfix"></div>';

            $prevCropData	.= '<div class="control-group span6">';
                $prevCropData	.= '<label for="text" class="control-label" style="margin-top:10px">How much was the total consumption of Seeds in KGs <span style="color:#F00">*</span></label>';
                $prevCropData	.= '<div class="controls">';
                    $prevCropData	.= '<input type="text" id="f11_consumption_seeds'.$contentCountPrevCrop.'" name="f11_consumption_seeds'.$contentCountPrevCrop.'" class="input-xlarge" onKeyPress="return numsonly(event);" maxlength="10" data-rule-required="true" placeholder="How much was the total consumption of Seeds in KGs"> KGs';
                $prevCropData	.= '</div>';
            $prevCropData	.= '</div>';	//<!-- How much was the total consumption of Seeds in KGs -->

            $prevCropData	.= '<div class="control-group span6">';
                $prevCropData	.= '<label for="text" class="control-label" style="margin-top:10px">How much money you spend in buying seeds?<span style="color:#F00">*</span></label>';
                $prevCropData	.= '<div class="controls">';
                    $prevCropData	.= '<input type="text" onBlur="getTotalMoneySpend(\'f11_spend_money\', \'f11_spend_money_fertiliser\', \'f11_spend_money_pesticide\', \'f11_spend_money_labour\', \'f11_spend_money_other_expenses\', \'f11_spend_money_farming_expenses\', \'f11_spend_money_total\', '.$contentCountPrevCrop.', \'f11\');" id="f11_spend_money'.$contentCountPrevCrop.'" name="f11_spend_money'.$contentCountPrevCrop.'" class="input-xlarge" onKeyPress="return numsonly(event);" maxlength="10" data-rule-required="true" placeholder="money you spend in buying seeds">Rs';
                $prevCropData	.= '</div>';
            $prevCropData	.= '</div>';	//<!-- spend money for seeds -->

            $prevCropData	.= '<div class="clearfix"></div>';
			// ====================================					
			// END : Seeds
			// ====================================

            //<!-- =================== -->
            //<!-- START : FERTILISER -->
            //<!-- =================== -->

            $prevCropData	.= '<div class="control-group">';
                $prevCropData	.= '<label for="text" class="control-label" style="margin-top:10px">Brand Of Fertiliser<span style="color:#F00">*</span></label>';
                $prevCropData	.= '<div class="controls">';
                    $prevCropData	.= '<input type="text" id="f11_brand_of_fertiliser'.$contentCountPrevCrop.'" name="f11_brand_of_fertiliser'.$contentCountPrevCrop.'" class="input-xlarge" data-rule-required="true" placeholder="Brand Of Fertiliser">';
                $prevCropData	.= '</div>';
            $prevCropData	.= '</div>';	// <!-- Brand Of Fertiliser -->

            $prevCropData	.= '<div class="clearfix"></div>';

            $prevCropData	.= '<div class="control-group span6">';
                $prevCropData	.= '<label for="text" class="control-label" style="margin-top:10px">How much was the total consumption of Fertilizer in KGs <span style="color:#F00">*</span></label>';
                $prevCropData	.= '<div class="controls">';
                    $prevCropData	.= '<input type="text" id="f11_consumption_fertilizer'.$contentCountPrevCrop.'" name="f11_consumption_fertilizer'.$contentCountPrevCrop.'" class="input-xlarge" onKeyPress="return numsonly(event);" maxlength="10" data-rule-required="true" placeholder="How much was the total consumption of Fertilizer in KGs"> KGs';
                $prevCropData	.= '</div>';
            $prevCropData	.= '</div>';	// <!-- How much was the total consumption of Fertilizer in KGs -->

            $prevCropData	.= '<div class="control-group span6">';
                $prevCropData	.= '<label for="text" class="control-label" style="margin-top:10px">How much money you spend in buying Fertiliser?<span style="color:#F00">*</span></label>';
                $prevCropData	.= '<div class="controls">';
                    $prevCropData	.= '<input type="text" onBlur="getTotalMoneySpend(\'f11_spend_money\', \'f11_spend_money_fertiliser\', \'f11_spend_money_pesticide\', \'f11_spend_money_labour\', \'f11_spend_money_other_expenses\', \'f11_spend_money_farming_expenses\', \'f11_spend_money_total\','.$contentCountPrevCrop.', \'f11\');" id="f11_spend_money_fertiliser'.$contentCountPrevCrop.'" name="f11_spend_money_fertiliser'.$contentCountPrevCrop.'" class="input-xlarge" onKeyPress="return numsonly(event);" maxlength="10" data-rule-required="true" placeholder="money you spend in buying fertiliser">Rs';
                $prevCropData	.= '</div>';
            $prevCropData	.= '</div>';	// <!-- spend money for Fertiliser -->

            $prevCropData	.= '<div class="clearfix"></div>';
            
            //<!-- =================== -->
            //<!-- END : FERTILISER -->
            //<!-- =================== -->

            //<!-- =================== -->
            //<!-- START : Pesticides -->
            //<!-- =================== -->

            $prevCropData	.= '<div class="control-group">';
                $prevCropData	.= '<label for="text" class="control-label" style="margin-top:10px">Brand Of Pesticide <span style="color:#F00">*</span></label>';
                $prevCropData	.= '<div class="controls">';
                    $prevCropData	.= '<input type="text" id="f11_brand_of_pesticide'.$contentCountPrevCrop.'" name="f11_brand_of_pesticide'.$contentCountPrevCrop.'" class="input-xlarge" data-rule-required="true" placeholder="Brand Of Pesticide">';
                $prevCropData	.= '</div>';
            $prevCropData	.= '</div>';	//<!-- Brand Of Pesticide -->

            $prevCropData	.= '<div class="clearfix"></div>';

            $prevCropData	.= '<div class="control-group span6">';
                $prevCropData	.= '<label for="text" class="control-label" style="margin-top:10px">How much was the total consumption of Pesticides in KGs <span style="color:#F00">*</span></label>';
                $prevCropData	.= '<div class="controls">';
                    $prevCropData	.= '<input type="text" id="f11_consumption_pesticides'.$contentCountPrevCrop.'" name="f11_consumption_pesticides'.$contentCountPrevCrop.'" class="input-xlarge" onKeyPress="return numsonly(event);" maxlength="10" data-rule-required="true" placeholder="How much was the total consumption of Pesticides in KGs"> KGs';
                $prevCropData	.= '</div>';
            $prevCropData	.= '</div>';	//<!-- How much was the total consumption of Pesticides in KGs -->

            $prevCropData	.= '<div class="control-group span6">';
                $prevCropData	.= '<label for="text" class="control-label" style="margin-top:10px">How much money you spend in buying Pesticide?<span style="color:#F00">*</span></label>';
                $prevCropData	.= '<div class="controls">';
                    $prevCropData	.= '<input type="text" onBlur="getTotalMoneySpend(\'f11_spend_money\', \'f11_spend_money_fertiliser\', \'f11_spend_money_pesticide\', \'f11_spend_money_labour\', \'f11_spend_money_other_expenses\', \'f11_spend_money_farming_expenses\', \'f11_spend_money_total\','.$contentCountPrevCrop.', \'f11\');" id="f11_spend_money_pesticide'.$contentCountPrevCrop.'" name="f11_spend_money_pesticide'.$contentCountPrevCrop.'" class="input-xlarge" onKeyPress="return numsonly(event);" maxlength="10" data-rule-required="true" placeholder="money you spend in buying pesticide">Rs';
                $prevCropData	.= '</div>';
            $prevCropData	.= '</div>';	//<!-- spend money for Pesticide -->

            $prevCropData	.= '<div class="clearfix"></div>';
            
            //<!-- =================== -->
            //<!-- END : Pesticides -->
            //<!-- =================== -->

            //<!-- =================== -->
            //<!-- START : Other Inputs -->
            //<!-- =================== -->
			$prevCropData	.= '<div class="control-group span6">';
                $prevCropData	.= '<label for="text" class="control-label" style="margin-top:10px">Brand of The Input Used<span style="color:#F00">*</span><br>[comma separated names]<br><br><br><br></label>';
                $prevCropData	.= '<div class="controls">';
                    $prevCropData	.= '<input type="text" id="f11_brand_of_input_used'.$contentCountPrevCrop.'" name="f11_brand_of_input_used'.$contentCountPrevCrop.'" class="input-xlarge" data-rule-required="true" placeholder="Brand of The Input Used">';
                $prevCropData	.= '</div>';
            $prevCropData	.= '</div>';	//<!-- Brand of The Input Used -->

            $prevCropData	.= '<input type="hidden" id="batch_chk_f11_other_inputs_used'.$contentCountPrevCrop.'" name="batch_chk_f11_other_inputs_used'.$contentCountPrevCrop.'" value="">';
            $prevCropData	.= '<div class="control-group span6">';
                $prevCropData	.= '<label for="text" class="control-label" style="margin-top:10px">What were the Other Inputs You Use?<span style="color:#F00">*</span></label>';
                $prevCropData	.= '<div class="controls">';
                	$prevCropData	.= '<input type="checkbox" name="f11_other_inputs_used'.$contentCountPrevCrop.'" class="cls_batch_chk_f11_other_inputs_used'.$contentCountPrevCrop.'" value="Herbicide"> &nbsp;Herbicide &nbsp;&nbsp;<br>';
					$prevCropData	.= '<input type="checkbox" name="f11_other_inputs_used'.$contentCountPrevCrop.'" class="cls_batch_chk_f11_other_inputs_used'.$contentCountPrevCrop.'" value="Insecticide"> &nbsp;Insecticide &nbsp;&nbsp;<br>';
					$prevCropData	.= '<input type="checkbox" name="f11_other_inputs_used'.$contentCountPrevCrop.'" class="cls_batch_chk_f11_other_inputs_used'.$contentCountPrevCrop.'" value="Fungicide"> &nbsp;Fungicide &nbsp;&nbsp;<br>';
					$prevCropData	.= '<input type="checkbox" name="f11_other_inputs_used'.$contentCountPrevCrop.'" class="cls_batch_chk_f11_other_inputs_used'.$contentCountPrevCrop.'" value="Growth Accelerator"> &nbsp;Growth Accelerator &nbsp;&nbsp;<br>';
					$prevCropData	.= '<input type="checkbox" name="f11_other_inputs_used'.$contentCountPrevCrop.'" class="cls_batch_chk_f11_other_inputs_used'.$contentCountPrevCrop.'" value="Manure_Compost"> &nbsp;Manure / Compost &nbsp;&nbsp;<br>';
					$prevCropData	.= '<input type="checkbox" name="f11_other_inputs_used'.$contentCountPrevCrop.'" class="cls_batch_chk_f11_other_inputs_used'.$contentCountPrevCrop.'" value="Rodenticide"> &nbsp;Rodenticide &nbsp;&nbsp;<br>';
					$prevCropData	.= '<input type="checkbox" name="f11_other_inputs_used'.$contentCountPrevCrop.'" class="cls_batch_chk_f11_other_inputs_used'.$contentCountPrevCrop.'" value="Bactericides"> &nbsp;Bactericides &nbsp;&nbsp;<br>';
					$prevCropData	.= '<input type="checkbox" name="f11_other_inputs_used'.$contentCountPrevCrop.'" class="cls_batch_chk_f11_other_inputs_used'.$contentCountPrevCrop.'" value="Larvicide"> &nbsp;Larvicide &nbsp;&nbsp;';
                $prevCropData	.= '</div>';
          	$prevCropData	.= '</div>';	//<!-- What were the Other Inputs You Use? -->

          	$prevCropData	.= '<div class="clearfix"></div>';

            $prevCropData	.= '<div class="control-group span6">';
                $prevCropData	.= '<label for="text" class="control-label" style="margin-top:10px">How much was the total consumption of Other Inputs in KGs <span style="color:#F00">*</span></label>';
                $prevCropData	.= '<div class="controls">';
                    $prevCropData	.= '<input type="text" id="f11_consumption_other_inputs'.$contentCountPrevCrop.'" name="f11_consumption_other_inputs'.$contentCountPrevCrop.'" class="input-xlarge" onKeyPress="return numsonly(event);" maxlength="10" data-rule-required="true" placeholder="How much was the total consumption of Other Inputs in KGs"> KGs';
                $prevCropData	.= '</div>';
            $prevCropData	.= '</div>';	//<!-- How much was the total consumption of Other Inputs in KGs -->

            $prevCropData	.= '<div class="control-group span6">';
                $prevCropData	.= '<label for="text" class="control-label" style="margin-top:10px">How much money you spend in buying Other Inputs?<span style="color:#F00">*</span></label>';
                $prevCropData	.= '<div class="controls">';
                    $prevCropData	.= '<input type="text" onBlur="getTotalMoneySpend(\'f11_spend_money\', \'f11_spend_money_fertiliser\', \'f11_spend_money_pesticide\', \'f11_spend_money_labour\', \'f11_spend_money_other_expenses\', \'f11_spend_money_farming_expenses\', \'f11_spend_money_total\','.$contentCountPrevCrop.', \'f11\');" id="f11_spend_money_other_expenses'.$contentCountPrevCrop.'" name="f11_spend_money_other_expenses'.$contentCountPrevCrop.'" class="input-xlarge" onKeyPress="return numsonly(event);" maxlength="10" data-rule-required="true" placeholder="How much money you spend in buying Other Inputs?">Rs';
                $prevCropData	.= '</div>';
            $prevCropData	.= '</div>';	//<!-- How much money you spend in buying Other Inputs? -->

            $prevCropData	.= '<div class="clearfix"></div>';
            //<!-- =================== -->
            //<!-- END : Other Inputs -->
            //<!-- =================== -->

            $prevCropData	.= '<div class="control-group">';
	            $prevCropData	.= '<label for="text" class="control-label" style="margin-top:10px">How much money you spend in buying Labour?<span style="color:#F00">*</span></label>';
	            $prevCropData	.= '<div class="controls">';
	                $prevCropData	.= '<input type="text" onBlur="getTotalMoneySpend(\'f11_spend_money\', \'f11_spend_money_fertiliser\', \'f11_spend_money_pesticide\', \'f11_spend_money_labour\', \'f11_spend_money_other_expenses\', \'f11_spend_money_farming_expenses\', \'f11_spend_money_total\','.$contentCountPrevCrop.', \'f11\');" id="f11_spend_money_labour'.$contentCountPrevCrop.'" name="f11_spend_money_labour'.$contentCountPrevCrop.'" class="input-xlarge" onKeyPress="return numsonly(event);" maxlength="10" data-rule-required="true" placeholder="money you spend in buying labour">Rs';
	            $prevCropData	.= '</div>';
	        $prevCropData	.= '</div>';	//<!-- spend money for Labour -->

	        $prevCropData	.= '<div class="control-group">';
	            $prevCropData	.= '<label for="text" class="control-label" style="margin-top:10px">Did you have any other farming expenses? <span style="color:#F00">*</span></label>';
	            $prevCropData	.= '<div class="controls">';
	                $prevCropData	.= '<select id="f11_other_farming_expenses'.$contentCountPrevCrop.'" name="f11_other_farming_expenses'.$contentCountPrevCrop.'" class="select2-me input-xlarge" data-rule-required="true" onChange="getDisplayDiv(this.value, \'div_f11_other_farming_expenses'.$contentCountPrevCrop.'\', \'yes\');">';
	                    $prevCropData	.= '<option value="" disabled selected> Select here</option>';
	                    $prevCropData	.= '<option value="yes">Yes</option>';
	                    $prevCropData	.= '<option value="no">No</option>';
	                $prevCropData	.= '</select>';
	                $prevCropData	.= '[Ex. like wiring, fencing, crop protection measures winery stands for the grape to grow etc]';
	            $prevCropData	.= '</div>';
	      	$prevCropData	.= '</div>';	//<!-- Did you have any other farming expenses? like wiring, fencing, crop protection measures winery stands for the grape to grow etc  -->

	      	$prevCropData	.= '<div id="div_f11_other_farming_expenses'.$contentCountPrevCrop.'" style="display: none;">';
	      		
	      		$prevCropData	.= '<input type="hidden" id="batch_chk_f11_type_other_farming_expenses'.$contentCountPrevCrop.'" name="batch_chk_f11_type_other_farming_expenses'.$contentCountPrevCrop.'" value="">';
	            $prevCropData	.= '<div class="control-group span6">';
	                $prevCropData	.= '<label for="text" class="control-label" style="margin-top:10px">Type of other farming expenses<span style="color:#F00">*</span></label>';
	                $prevCropData	.= '<div class="controls">';
	                	$prevCropData	.= '<input type="checkbox" name="f11_type_other_farming_expenses'.$contentCountPrevCrop.'" class="cls_batch_chk_f11_type_other_farming_expenses'.$contentCountPrevCrop.'" value="Rent"> &nbsp;Rent &nbsp;&nbsp;<br>';
						$prevCropData	.= '<input type="checkbox" name="f11_type_other_farming_expenses'.$contentCountPrevCrop.'" class="cls_batch_chk_f11_type_other_farming_expenses'.$contentCountPrevCrop.'" value="Repairs and Maintainance"> &nbsp;Repairs and Maintainance &nbsp;&nbsp;<br>';
						$prevCropData	.= '<input type="checkbox" name="f11_type_other_farming_expenses'.$contentCountPrevCrop.'" class="cls_batch_chk_f11_type_other_farming_expenses'.$contentCountPrevCrop.'" value="Crop Protection and Safety"> &nbsp;Crop Protection and Safety &nbsp;&nbsp;<br>';
						$prevCropData	.= '<input type="checkbox" name="f11_type_other_farming_expenses'.$contentCountPrevCrop.'" class="cls_batch_chk_f11_type_other_farming_expenses'.$contentCountPrevCrop.'" value="Other Tools"> &nbsp;Other Tools &nbsp;&nbsp;<br>';
	                $prevCropData	.= '</div>';
	          	$prevCropData	.= '</div>';	//<!-- What were the Other Inputs You Use? -->

	          	$prevCropData	.= '<div class="control-group span6">';
	                $prevCropData	.= '<label for="text" class="control-label" style="margin-top:10px">How much money did you spend on those farming expenses ?<span style="color:#F00">*</span></label>';
	                $prevCropData	.= '<div class="controls">';
	                    $prevCropData	.= '<input type="text" onBlur="getTotalMoneySpend(\'f11_spend_money\', \'f11_spend_money_fertiliser\', \'f11_spend_money_pesticide\', \'f11_spend_money_labour\', \'f11_spend_money_other_expenses\', \'f11_spend_money_farming_expenses\', \'f11_spend_money_total\','.$contentCountPrevCrop.', \'f11\');" id="f11_spend_money_farming_expenses'.$contentCountPrevCrop.'" name="f11_spend_money_farming_expenses'.$contentCountPrevCrop.'" class="input-xlarge" onKeyPress="return numsonly(event);" maxlength="10" data-rule-required="true" placeholder="">Rs';
	                $prevCropData	.= '</div>';
	            $prevCropData	.= '</div>';	//<!-- How much money did you spend on those farming expenses ? -->

	            $prevCropData	.= '<div class="clearfix"></div>';
	      	$prevCropData	.= '</div>';

	      	$prevCropData	.= '<div class="clearfix"></div>';

	        $prevCropData	.= '<div class="control-group">';
	            $prevCropData	.= '<label for="text" class="control-label" style="margin-top:10px">Total spend money for this Crop<span style="color:#F00">*</span></label>';
	            $prevCropData	.= '<div class="controls">';
	                $prevCropData	.= '<input readonly type="text" id="f11_spend_money_total'.$contentCountPrevCrop.'" name="f11_spend_money_total'.$contentCountPrevCrop.'" class="input-xlarge" onKeyPress="return numsonly(event);" maxlength="10" data-rule-required="true" placeholder="Total spend money for this Crop">Rs';
	            $prevCropData	.= '</div>';
	        $prevCropData	.= '</div>';	//<!-- Total spend money for this Crop -->

	        $prevCropData	.= '<div class="control-group span6">';
	            $prevCropData	.= '<label for="text" class="control-label" style="margin-top:10px">Total Profit Gained for this crop? <span style="color:#F00">*</span></label>';
	            $prevCropData	.= '<div class="controls">';
	                $prevCropData	.= '<input type="text" id="f11_total_profit_gained'.$contentCountPrevCrop.'" name="f11_total_profit_gained'.$contentCountPrevCrop.'" class="input-xlarge" onKeyPress="return numsonly(event);" maxlength="10" data-rule-required="true" placeholder="Total Profit Gained for this crop">Rs';
	            $prevCropData	.= '</div>';
	        $prevCropData	.= '</div>';	//<!-- Total Profit Gained for this crop? -->

	        $prevCropData	.= '<div class="control-group span6">';
	            $prevCropData	.= '<label for="text" class="control-label" style="margin-top:10px">Total Profit <span style="color:#F00">*</span><br><br></label>';
	            $prevCropData	.= '<div class="controls">';
	                $prevCropData	.= '<input type="text" readonly id="f11_total_profit'.$contentCountPrevCrop.'" name="f11_total_profit'.$contentCountPrevCrop.'" class="input-xlarge" onKeyPress="return numsonly(event);" maxlength="10" data-rule-required="true" placeholder="">Rs';
	            $prevCropData	.= '</div>';
	        $prevCropData	.= '</div>';	//<!-- Total Profit  -->

	        $prevCropData	.= '<div class="clearfix"></div>';
		$prevCropData	.= '</div>';

		$prevCropData 	.= '<script type="text/javascript">';
			$prevCropData 	.= '$(".datepicker").datepicker({format:\'yyyy-mm-dd\'});';
			$prevCropData 	.= '$("#f11_crop_season'.$contentCountPrevCrop.'").select2();';
			$prevCropData 	.= '$("#f11_crop_type'.$contentCountPrevCrop.'").select2();';
			$prevCropData 	.= '$("#f11_cultivating'.$contentCountPrevCrop.'").select2();';
			$prevCropData 	.= '$("#f11_variety'.$contentCountPrevCrop.'").select2();';
			$prevCropData 	.= '$("#f11_farming_type'.$contentCountPrevCrop.'").select2();';
			$prevCropData 	.= '$("#f11_potential_market'.$contentCountPrevCrop.'").select2();';
			$prevCropData 	.= '$("#f11_crop_storage'.$contentCountPrevCrop.'").select2();';
			$prevCropData 	.= '$("#f11_is_homegrown_seeds'.$contentCountPrevCrop.'").select2();';
			$prevCropData 	.= '$("#f11_seed_type'.$contentCountPrevCrop.'").select2();';
			$prevCropData 	.= '$("#f11_other_farming_expenses'.$contentCountPrevCrop.'").select2();';
		$prevCropData 	.= '</script>';

		quit(utf8_encode($prevCropData),1);
	}

	if((isset($obj->addCropData)) == '1' && (isset($obj->addCropData))) 		// f10
	{
		$contentCountCrop = $obj->contentCountCrop;
		$fm_id            = $obj->farmer_id;
		
		$cropData         = '';

		$cropData	.= '<div id="crop'.$contentCountCrop.'" style="padding:5px;border:1px solid #d6d6d6;margin:5px;display:none;">';
			$cropData	.= '<input type="hidden" name="id[]" id="id" value="">';
			$cropData	.= '<div id="crop_detail" style=" padding: 10px; margin: 5px;">';
				$cropData	.= '<h2>Crop '.$contentCountCrop.' Details</h2>';
								
				$cropData	.= '<div class="control-group">';
					$cropData	.= '<label for="tasktitel" class="control-label">Current Crop Season <span style="color:#F00">*</span></label>';
					$cropData	.= '<div class="controls">';
						$cropData	.= '<select id="f10_crop_season'.$contentCountCrop.'" name="f10_crop_season'.$contentCountCrop.'" class="select2-me input-xlarge" >';
							$cropData	.= '<option value="" disabled selected>Select here</option>';
							$cropData	.= '<option value="Kharif">Kharif</option>';
							$cropData	.= '<option value="Rabi" >Rabi</option>';
							$cropData	.= '<option value="Annual">Annual</option>';
						$cropData	.= '</select>';
					$cropData	.= '</div>';
				$cropData	.= '</div>';	// Current Crop Season

				$cropData	.= '<div class="control-group">';
                    $cropData	.= '<label for="text" class="control-label" style="margin-top:10px">What Type of Crop You are Growing?<span style="color:#F00">*</span></label>';
                    $cropData	.= '<div class="controls">';
	                    $cropData	.= '<select id="f10_crop_type'.$contentCountCrop.'" name="f10_crop_type'.$contentCountCrop.'" class="select2-me input-xlarge" data-rule-required="true">';
		                    $cropData	.= '<option value="" disabled selected> Select here</option>';
		                    $cropData	.= '<option value="Commercial" >Commercial</option>';
		                    $cropData	.= '<option value="Seasonal" >Seasonal</option>';
	                    $cropData	.= '</select>';
                    $cropData	.= '</div>';
              	$cropData	.= '</div>';	// <!--  Crop Type-->
							
				$cropData	.= '<div class="control-group">';
					$cropData	.= '<label for="tasktitel" class="control-label">Type of crop cultivating this year <span style="color:#F00">*</span></label>';
					$cropData	.= '<div class="controls">';
						$cropData	.= '<select id="f10_cultivating'.$contentCountCrop.'" name="f10_cultivating'.$contentCountCrop.'" class="select2-me input-xlarge" data-rule-required="true" onchange="calTotal_f10();get_variety(this.value,'.$contentCountCrop.', \'f10\');getDisplayDiv(this.value, \'div_f10_cultivating'.$contentCountCrop.'\', \'other\');">';
							$cropData	.= '<option value="" disabled selected> Select here</option>';
							$cropData	.= '<option point="7" value="other" >Other</option>';
											
											$crops = lookup_value('tbl_crops',array(),array("crop_status"=>1),array(),array(),array());
											while($crop = mysqli_fetch_array($crops))
											{
												$cropData	.= '<option point="7" value="'.$crop['crop_id'].'">';
													$cropData	.= strtoupper(trim($crop['crop_name']));
												$cropData	.= '</option>';
												
											}
										
						$cropData	.= '</select>';
					$cropData	.= '</div>';
				$cropData	.= '</div>';	// Type of crop cultivating this year 

				$cropData	.= '<div id="div_f10_cultivating'.$contentCountCrop.'" style="display: none;">';
                    $cropData	.= '<div class="control-group">';
				        $cropData	.= '<label for="tasktitel" class="control-label">Mention Crop Name <span style="color:#F00">*</span></label>';
				        $cropData	.= '<div class="controls">';
				        	$cropData	.= '<input type="text" placeholder="Other Crop Name!" data-rule-required="true" name="f10_other_crop_name'.$contentCountCrop.'" id="f10_other_crop_name'.$contentCountCrop.'" class="input-xlarge" >';
				        $cropData	.= '</div>';
			        $cropData	.= '</div>';
			        $cropData	.= '<div style="clear: both;"></div>';
                $cropData	.= '</div>';	// Mention Crop Name 

                $cropData	.= '<div class="control-group">';
					$cropData	.= '<label for="text" class="control-label" style="margin-top:10px">Variety of crop using?<span style="color:#F00">*</span></label>';
					$cropData	.= '<div class="controls">';
						$cropData	.= '<select id="f10_variety'.$contentCountCrop.'" name="f10_variety'.$contentCountCrop.'" class="select2-me input-xlarge" data-rule-required="true" >';
							$cropData	.= '<option value="" disabled selected> Select here</option>';
						$cropData	.= '</select>';
					$cropData	.= '</div>';
				$cropData	.= '</div>';	// Variety of crop using?
							
				$cropData	.= '<div class="control-group">';
					$cropData	.= '<label for="tasktitel" class="control-label">Current Stage Of Crop<span style="color:#F00">*</span></label>';
					$cropData	.= '<div class="controls">';
						$cropData	.= '<select id="f10_stage'.$contentCountCrop.'" name="f10_stage'.$contentCountCrop.'" class="select2-me input-xlarge" data-rule-required="true" onchange="calTotal_f10()">';
							$cropData	.= '<option value="" disabled selected> Select here</option>';
							$cropData	.= '<option point="5" value="Land Tilling" >Land Tilling</option>';
							$cropData	.= '<option point="7" value="Sowing" >Sowing</option>';
							$cropData	.= '<option point="6" value="Manure Adding OR Fertilizer" >Manure Adding / Fertilizer</option>';
							$cropData	.= '<option point="7" value="Irrigation" >Irrigation</option>';
							$cropData	.= '<option point="7" value="Weeding" >Weeding</option>';
							$cropData	.= '<option point="8" value="Growing">Growing</option>';
							$cropData	.= '<option point="7" value="Harvesting" >Harvesting</option>';
							$cropData	.= '<option point="5" value="Threshing" >Threshing</option>';
							$cropData	.= '<option point="2" value="Storing" >Storing</option>';
							$cropData	.= '<option point="2" value="Annual" >Annual</option>';
						$cropData	.= '</select>';
					$cropData	.= '</div>';
				$cropData	.= '</div>';	// Current Stage Of Crop

				$cropData	.= '<div class="control-group">';
                    $cropData	.= '<label for="text" class="control-label" style="margin-top:10px">What Type Of Farming You are Doing?<span style="color:#F00">*</span></label>';
                    $cropData	.= '<div class="controls">';
                        $cropData	.= '<select id="f10_farming_type'.$contentCountCrop.'" name="f10_farming_type'.$contentCountCrop.'" class="select2-me input-xlarge" data-rule-required="true" >';
                            $cropData	.= '<option value="" disabled selected> Select here</option>';
                            $cropData	.= '<option value="Organic">Organic</option>'; // <!-- point="10" -->
                            $cropData	.= '<option value="Non Organic">Non-Organic</option>'; // <!-- point="0" -->
                            $cropData	.= '<option value="Both">Both</option>'; //  <!-- point="0" -->
                        $cropData	.= '</select>';
                    $cropData	.= '</div>';
              	$cropData	.= '</div>';	// <!-- What Type Of Farming You are Doing? -->

              	$cropData	.= '<div class="control-group span6">';
					$cropData	.= '<label for="tasktitel" class="control-label">Potential market <span style="color:#F00">*</span></label>';
					$cropData	.= '<div class="controls">';
						$cropData	.= '<select id="f10_potential_market'.$contentCountCrop.'" name="f10_potential_market'.$contentCountCrop.'" data-rule-required="true" class="select2-me input-xlarge" >';
							$cropData	.= '<option value="" disabled selected>Select here</option>';
							$cropData	.= '<option value="Local Mandis and Location" >Local Mandis and Location</option>';
							$cropData	.= '<option value="FPO">FPO</option>';
							$cropData	.= '<option value="Private Buyer" >Private Buyer (Companies)</option>';
							$cropData	.= '<option value="Government" >Government</option>';
							$cropData	.= '<option value="Other" >Other</option>';
						$cropData	.= '</select>';
					$cropData	.= '</div>';
				$cropData	.= '</div>';	// Potential market 
								
				$cropData	.= '<div class="control-group span6">';
					$cropData	.= '<label for="tasktitel" class="control-label">Crop Storage <span style="color:#F00">*</span></label>';
					$cropData	.= '<div class="controls">';
						$cropData	.= '<select id="f10_crop_storage'.$contentCountCrop.'" name="f10_crop_storage'.$contentCountCrop.'" data-rule-required="true" class="select2-me input-xlarge" >';
							$cropData	.= '<option value="" disabled selected>Select here</option>';
							$cropData	.= '<option value="Govt Warehouse" >Govt. Warehouse</option>';
							$cropData	.= '<option value="Pvt Warehouse" >Pvt. Warehouse</option>';
							$cropData	.= '<option value="Factory" >Factory</option>';
							$cropData	.= '<option value="Mandis Direct" >Mandis Direct</option>';
						$cropData	.= '</select>';
					$cropData	.= '</div>';
				$cropData	.= '</div>';	// Crop Storage 

				$cropData	.= '<div class="clearfix"></div>';
							
				$cropData	.= '<div class="control-group">';
					$cropData	.= '<label for="text" class="control-label" style="margin-top:10px">What is your Water Source for Current Cycle<span style="color:#F00">*</span></label>';
					$cropData	.= '<div class="controls">';
						$cropData	.= '<div id="div_f10_water_source_type'.$contentCountCrop.'">';
	                		// Query For getting the list of Water Source
							$sql_get_f10_water_source_list	= " SELECT * FROM `tbl_water_source` WHERE `status`='1' AND water_source NOT IN (SELECT DISTINCT(water_source_name) FROM tbl_f10_farmer_water_source WHERE fm_id='".$fm_id."' AND count='".$contentCountCrop."') ";
							$res_get_f10_water_source_list 	= mysqli_query($db_con, $sql_get_f10_water_source_list) or die(mysqli_error($db_con));

							if($res_get_f10_water_source_list)
							{
								$num_get_f10_water_source_list	= mysqli_num_rows($res_get_f10_water_source_list);

								$cropData	.= '<select id="f10_water_source_type'.$contentCountCrop.'" name="f10_water_source_type'.$contentCountCrop.'[]" multiple="multiple"  onChange="console.log($(this).children(\':selected\').length)" placeholder="Select Water Source" class="select2-me input-xxlarge" data-rule-required="true">';
						    		if($num_get_f10_water_source_list != 0)
									{
										while($row_get_f10_water_source_list	= mysqli_fetch_array($res_get_f10_water_source_list))
										{
						            		$cropData	.= '<option point="'.$row_get_f10_water_source_list['points'].'" value="'.$row_get_f10_water_source_list['water_source'].'">'.trim(ucwords($row_get_f10_water_source_list['water_source'])).'</option>';
						    			}
									}
									else
									{
							    		$cropData	.= '<option point="0" value="">No Match Found</option>';
						    		}
						        $cropData	.= '</select>';

						        $cropData 	.= '<script type="text/javascript">';
									$cropData 	.= '$("#f10_water_source_type'.$contentCountCrop.'").select2();';
								$cropData 	.= '</script>';

								$cropData	.= '<input value="Add Here" class="btn-success" type="button" onclick="addf10WaterSource('.$fm_id.', '.$contentCountCrop.');">';
								// Query For getting the Service Provider list for that user
						        $sql_get_f10_farmer_water_source	= " SELECT * FROM `tbl_f10_farmer_water_source` WHERE `fm_id`='".$fm_id."' AND count='".$contentCountCrop."' ";
						        $res_get_f10_farmer_water_source	= mysqli_query($db_con, $sql_get_f10_farmer_water_source) or die(mysqli_error($db_con));
						        $num_get_f10_farmer_water_source	= mysqli_num_rows($res_get_f10_farmer_water_source);
						        $startOffset_f10	= 0;
							    $cropData	.= '<table class="table table-bordered dataTable">';
						        	$cropData	.= '<thead>';
						        		$cropData	.= '<th>Sr. No.</th>';
						        		$cropData	.= '<th>Water Source</th>';
						        		$cropData	.= '<th style="text-align:center">';
						        			$cropData	.= '<div style="text-align:center">';
						        				$cropData	.= '<input type="button" value="Delete" onclick="multipleWaterSourceDelete_f10('.$fm_id.', '.$contentCountCrop.');" class="btn-danger"/>';
						        			$cropData	.= '</div>';
						        		$cropData	.= '</th>';
						        	$cropData	.= '</thead>';
						        	$cropData	.= '<tbody>';
						        		if($num_get_f10_farmer_water_source != 0)
						        		{
						        			while($row_get_f10_farmer_water_source = mysqli_fetch_array($res_get_f10_farmer_water_source))
						        			{
						        				$cropData	.= '<tr>';
													$cropData	.= '<td>'.++$startOffset_f10.'</td>';
													$cropData	.= '<td>'.ucwords($row_get_f10_farmer_water_source['water_source_name']).'</td>';
													$cropData	.= '<td align="center">';
														$cropData	.= '<input type="checkbox" value="'.$row_get_f10_farmer_water_source['id'].'" id="f10_water_source_'.$row_get_f10_farmer_water_source['id'].'" name="f10_water_source_'.$row_get_f10_farmer_water_source['id'].'" class="css-checkbox f10_water_source">';
													$cropData	.= '</td>';
												$cropData	.= '</tr>';
						        			}
						        		}
						        		else
						        		{
						        			$cropData	.= '<tr>';
						            			$cropData	.= '<td>&nbsp;</td>';
												$cropData	.= '<td>No Match Found</td>';
						            			$cropData	.= '<td>&nbsp;</td>';
						        			$cropData	.= '</tr>';
						        		}
						        	$cropData	.= '</tbody>';
						        $cropData	.= '</table>';
						    }
						$cropData	.= '</div>';
					$cropData	.= '</div>';
				$cropData	.= '</div>';	// What is your Water Source for Current Cycle

				$cropData	.= '<div class="control-group">';
                    $cropData	.= '<label for="text" class="control-label" style="margin-top:10px">In how many acres is the crop '.$contentCountCrop.' grown? <span style="color:#F00">*</span><br>[Hector-Acre-Guntha]</label> ';
                    $cropData	.= '<div class="controls">';
                    	// <!-- f10_total_acrage -->
                        $cropData	.= '<input type="text" onKeyUp="getAcre_f10(this.value, \'hector\', \'f10_total_acrage'.$contentCountCrop.'\', '.$contentCountCrop.');getTotalIncome('.$contentCountCrop.', \'f10\');" value="" id="f10_total_hector'.$contentCountCrop.'" name="f10_total_hector'.$contentCountCrop.'" class="input-small" onKeyPress="return numsonly(event);" maxlength="10" data-rule-required="true" placeholder="Hector">&nbsp;&nbsp;-&nbsp;';
                        $cropData	.= '<input type="text" onKeyUp="getAcre_f10(this.value, \'acre\', \'f10_total_acrage'.$contentCountCrop.'\', '.$contentCountCrop.');getTotalIncome('.$contentCountCrop.', \'f10\');" value="" id="f10_total_acre'.$contentCountCrop.'" name="f10_total_acre'.$contentCountCrop.'" class="input-small" onKeyPress="return numsonly(event);" maxlength="10" placeholder="Acre">&nbsp;&nbsp;-&nbsp;';
                        $cropData	.= '<input type="text" onKeyUp="getAcre_f10(this.value, \'guntha\', \'f10_total_acrage'.$contentCountCrop.'\', '.$contentCountCrop.');getTotalIncome('.$contentCountCrop.', \'f10\');" value="" id="f10_total_guntha'.$contentCountCrop.'" name="f10_total_guntha'.$contentCountCrop.'" class="input-small" onKeyPress="return numsonly(event);" maxlength="10" placeholder="Guntha">';
                        $cropData	.= '<input type="text" id="f10_total_acrage'.$contentCountCrop.'" name="f10_total_acrage'.$contentCountCrop.'" class="input-small" onKeyPress="return numsonly(event);" maxlength="10" data-rule-required="true" placeholder="" readonly>Total Acres';
                    $cropData	.= '</div>';
                $cropData	.= '</div>';	// <!-- Total Acrage -->

				$cropData	.= '<div class="control-group">';
                    $cropData	.= '<label for="tasktitel" class="control-label">When is The Harvest Date for This Cycle? <span style="color:#F00">*</span><br>[YYYY-MM-DD]</label>';
                    $cropData	.= '<div class="controls">';
                        $cropData	.= '<input type="text" id="f10_harvest_date'.$contentCountCrop.'" name="f10_harvest_date'.$contentCountCrop.'" placeholder="[YYYY-MM-DD]" class="datepicker input-large" data-rule-required="true" />';
                    $cropData	.= '</div>';
                $cropData	.= '</div>';	// <!-- When is The Harvest Date for This Cycle? -->

                $cropData	.= '<div class="control-group">';
					$cropData	.= '<label for="tasktitel" class="control-label">Total Yield Expected <span style="color:#F00">*</span> [Quintals per Acre]</label>';
					$cropData	.= '<div class="controls">';
						$cropData	.= '<input type="text" id="f10_expected'.$contentCountCrop.'" name="f10_expected'.$contentCountCrop.'" class="input-xlarge" onKeyPress="return numsonly(event);" data-rule-required="true" maxlength="10" onchange="calTotal_f10()" onBlur="getTotalExpectedIncome('.$contentCountCrop.', \'f10\');getTotalIncome('.$contentCountCrop.', \'f10\');" placeholder="Total Yield Expected"> Quintals';
					$cropData	.= '</div>';
				$cropData	.= '</div>';	// Total Yield Expected 

                $cropData	.= '<div class="control-group">';
					$cropData	.= '<label for="text" class="control-label" style="margin-top:10px">Expected Price This Year <span style="color:#F00">*</span><br>[Rupees Per Quintal]</label>';
					$cropData	.= '<div class="controls">';
						$cropData	.= '<input type="text" id="f10_expectedprice'.$contentCountCrop.'" name="f10_expectedprice'.$contentCountCrop.'" class="input-xlarge" data-rule-required="true"  onKeyPress="return numsonly(event);" maxlength="10" onchange="calTotal_f10()" onBlur="getTotalExpectedIncome('.$contentCountCrop.', \'f10\');getTotalIncome('.$contentCountCrop.', \'f10\');" placeholder="Expected Price">  In Rs.';
					$cropData	.= '</div>';
				$cropData	.= '</div>';	// Expected Price This Year

				$cropData	.= '<div class="control-group span6">';
					$cropData	.= '<label for="text" class="control-label" style="margin-top:10px">Total Income Expected This Year<span style="color:#F00">*</span> <br>[Rupees Per Acre]</label>';
					$cropData	.= '<div class="controls">';
						$cropData	.= '<input readonly type="text" id="f10_expectedincome'.$contentCountCrop.'" name="f10_expectedincome'.$contentCountCrop.'" class="input-small"  data-rule-required="true"  onKeyPress="return numsonly(event);" onchange="calTotal_f10()" placeholder="Total Income Expected">  In Rs.';
					$cropData	.= '</div>';
				$cropData	.= '</div>';	// Total Income Expected This Year

              	$cropData	.= '<div class="control-group span6">';
                    $cropData	.= '<label for="text" class="control-label" style="margin-top:10px">Total Income <span style="color:#F00">*</span><br><br><br></label>';
                    $cropData	.= '<div class="controls">';
                        $cropData	.= '<input readonly type="text" id="f10_totalincome'.$contentCountCrop.'" name="f10_totalincome'.$contentCountCrop.'" class="input-small"  data-rule-required="true"  onKeyPress="return numsonly(event);" onchange="calTotal_f10()" placeholder="Total Income"> In Rs.';
                    $cropData	.= '</div>';
                $cropData	.= '</div>';	//<!--Total Income  -->

                $cropData	.= '<div class="clearfix"></div>';

				// <!-- =================== -->
                // <!-- START : Seeds -->
                // <!-- =================== -->
				$cropData	.= '<div class="control-group">';
                    $cropData	.= '<label for="text" class="control-label" style="margin-top:10px">Are they Homegrown seeds?<span style="color:#F00">*</span></label>';
                    $cropData	.= '<div class="controls">';
                        $cropData	.= '<select id="f10_is_homegrown_seeds'.$contentCountCrop.'" name="f10_is_homegrown_seeds'.$contentCountCrop.'" class="select2-me input-xlarge" data-rule-required="true" onChange="getSeedsBrand(this.value, \'f10_brand_of_seeds'.$contentCountCrop.'\', \'f10_seed_type'.$contentCountCrop.'\', \'f10_spend_money'.$contentCountCrop.'\');"> ';
                            $cropData	.= '<option value="" disabled selected> Select here</option>';
                            $cropData	.= '<option value="yes" >Yes</option>';
                            $cropData	.= '<option value="no" >No</option>';
                        $cropData	.= '</select>';
                    $cropData	.= '</div>';
              	$cropData	.= '</div>';	// <!-- Are they Homegrown seeds?  -->

              	$cropData	.= '<div class="clearfix"></div>';

                $cropData	.= '<div class="control-group span6">';
	                $cropData	.= '<label for="text" class="control-label" style="margin-top:10px">Brand Of Seeds<span style="color:#F00">*</span><br><br></label>';
	                $cropData	.= '<div class="controls">';
	                	$cropData	.= '<input type="text" id="f10_brand_of_seeds'.$contentCountCrop.'" name="f10_brand_of_seeds'.$contentCountCrop.'" class="input-xlarge" data-rule-required="true" placeholder="Brand Of Seeds">';
	                $cropData	.= '</div>';
                $cropData	.= '</div>';	// <!-- Brand Of Seeds -->

                $cropData	.= '<div class="control-group span6">';
                    $cropData	.= '<label for="text" class="control-label" style="margin-top:10px">What type of seeds you used?<span style="color:#F00">*</span></label>';
                    $cropData	.= '<div class="controls">';
                        $cropData	.= '<select id="f10_seed_type'.$contentCountCrop.'" name="f10_seed_type'.$contentCountCrop.'" class="select2-me input-xlarge" data-rule-required="true" >'; //  <!-- // onChange="calTotal_f14();" -->
                            $cropData	.= '<option value="" disabled selected> Select here</option>';
                            $cropData	.= '<option value="NA" >NA</option>'; // <!-- point="10" -->
                            $cropData	.= '<option value="Hybrid" >Hybrid</option>'; // <!-- point="10" -->
                            $cropData	.= '<option value="Non Hybrid" >Non-Hybrid</option>'; // <!-- point="0" -->
                        $cropData	.= '</select>';
                    $cropData	.= '</div>';
              	$cropData	.= '</div>';	// <!-- seed type -->

                $cropData	.= '<div class="clearfix"></div>';

                $cropData	.= '<div class="control-group span6">';
	                $cropData	.= '<label for="text" class="control-label" style="margin-top:10px">How much was the total consumption of Seeds in KGs <span style="color:#F00">*</span></label>';
	                $cropData	.= '<div class="controls">';
	                	$cropData	.= '<input type="text" id="f10_consumption_seeds'.$contentCountCrop.'" name="f10_consumption_seeds'.$contentCountCrop.'" class="input-xlarge" onKeyPress="return numsonly(event);" maxlength="10" data-rule-required="true" placeholder="How much was the total consumption of Seeds in KGs"> KGs';
	                $cropData	.= '</div>';
                $cropData	.= '</div>';	// <!-- How much was the total consumption of Seeds in KGs -->

                $cropData	.= '<div class="control-group span6">';
	                $cropData	.= '<label for="text" class="control-label" style="margin-top:10px">How much money you spend in buying seeds?<span style="color:#F00">*</span></label>';
	                $cropData	.= '<div class="controls">';
	                	$cropData	.= '<input type="text" onBlur="getTotalMoneySpend(\'f10_spend_money\', \'f10_spend_money_fertiliser\', \'f10_spend_money_pesticide\', \'f10_spend_money_labour\', \'f10_spend_money_other_expenses\', \'f10_spend_money_farming_expenses\', \'f10_spend_money_total\','.$contentCountCrop.', \'f10\');" id="f10_spend_money'.$contentCountCrop.'" name="f10_spend_money'.$contentCountCrop.'" class="input-xlarge" onKeyPress="return numsonly(event);" maxlength="10" data-rule-required="true" placeholder="money you spend in buying seeds">Rs';
	                $cropData	.= '</div>';
                $cropData	.= '</div>';	// <!-- spend money for seeds -->

                $cropData	.= '<div class="clearfix"></div>';
                
                // <!-- =================== -->
                // <!-- END : Seeds -->
                // <!-- =================== -->

				// ==========================================
				// START : Fertiliser
				// ==========================================

				$cropData	.= '<div class="control-group">';
	                $cropData	.= '<label for="text" class="control-label" style="margin-top:10px">Brand Of Fertiliser<span style="color:#F00">*</span></label>';
	                $cropData	.= '<div class="controls">';
	                	$cropData	.= '<input type="text" id="f10_brand_of_fertiliser'.$contentCountCrop.'" name="f10_brand_of_fertiliser'.$contentCountCrop.'" class="input-xlarge" data-rule-required="true" placeholder="Brand Of Fertiliser">';
	                $cropData	.= '</div>';
                $cropData	.= '</div>';	// <!-- Brand Of Fertiliser -->

                $cropData	.= '<div class="clearfix"></div>';

                $cropData	.= '<div class="control-group span6">';
	                $cropData	.= '<label for="text" class="control-label" style="margin-top:10px">How much was the total consumption of Fertilizer in KGs <span style="color:#F00">*</span></label>';
	                $cropData	.= '<div class="controls">';
	                	$cropData	.= '<input type="text" id="f10_consumption_fertilizer'.$contentCountCrop.'" name="f10_consumption_fertilizer'.$contentCountCrop.'" class="input-xlarge" onKeyPress="return numsonly(event);" maxlength="10" data-rule-required="true" placeholder="How much was the total consumption of Fertilizer in KGs"> KGs';
	                $cropData	.= '</div>';
                $cropData	.= '</div>';	// <!-- How much was the total consumption of Fertilizer in KGs -->

                $cropData	.= '<div class="control-group span6">';
	                $cropData	.= '<label for="text" class="control-label" style="margin-top:10px">How much money you spend in buying Fertiliser?<span style="color:#F00">*</span></label>';
	                $cropData	.= '<div class="controls">';
	                	$cropData	.= '<input type="text" onBlur="getTotalMoneySpend(\'f10_spend_money\', \'f10_spend_money_fertiliser\', \'f10_spend_money_pesticide\', \'f10_spend_money_labour\', \'f10_spend_money_other_expenses\', \'f10_spend_money_farming_expenses\', \'f10_spend_money_total\','.$contentCountCrop.', \'f10\');" id="f10_spend_money_fertiliser'.$contentCountCrop.'" name="f10_spend_money_fertiliser'.$contentCountCrop.'" class="input-xlarge" onKeyPress="return numsonly(event);" maxlength="10" data-rule-required="true" placeholder="money you spend in buying fertiliser">Rs';
	                $cropData	.= '</div>';
                $cropData	.= '</div>';	// <!-- spend money for Fertiliser -->

                $cropData	.= '<div class="clearfix"></div>';

                // ==========================================
				// END : Fertiliser
				// ==========================================

                // <!-- =================== -->
                // <!-- START : Pesticides -->
                // <!-- =================== -->

                $cropData	.= '<div class="control-group">';
	                $cropData	.= '<label for="text" class="control-label" style="margin-top:10px">Brand Of Pesticide <span style="color:#F00">*</span></label>';
	                $cropData	.= '<div class="controls">';
	                	$cropData	.= '<input type="text" id="f10_brand_of_pesticide'.$contentCountCrop.'" name="f10_brand_of_pesticide'.$contentCountCrop.'" class="input-xlarge" data-rule-required="true" placeholder="Brand Of Pesticide">';
	                $cropData	.= '</div>';
                $cropData	.= '</div>';	// <!-- Brand Of Pesticide -->

                $cropData	.= '<div class="clearfix"></div>';

                $cropData	.= '<div class="control-group span6">';
	                $cropData	.= '<label for="text" class="control-label" style="margin-top:10px">How much was the total consumption of Pesticides in KGs <span style="color:#F00">*</span></label>';
	                $cropData	.= '<div class="controls">';
	                	$cropData	.= '<input type="text" id="f10_consumption_pesticides'.$contentCountCrop.'" name="f10_consumption_pesticides'.$contentCountCrop.'" class="input-xlarge" onKeyPress="return numsonly(event);" maxlength="10" data-rule-required="true" placeholder="How much was the total consumption of Pesticides in KGs"> KGs';
	                $cropData	.= '</div>';
                $cropData	.= '</div>';	// <!-- How much was the total consumption of Pesticides in KGs -->

                $cropData	.= '<div class="control-group span6">';
	                $cropData	.= '<label for="text" class="control-label" style="margin-top:10px">How much money you spend in buying Pesticide?<span style="color:#F00">*</span></label>';
	                $cropData	.= '<div class="controls">';
	                	$cropData	.= '<input type="text" onBlur="getTotalMoneySpend(\'f10_spend_money\', \'f10_spend_money_fertiliser\', \'f10_spend_money_pesticide\', \'f10_spend_money_labour\', \'f10_spend_money_other_expenses\', \'f10_spend_money_farming_expenses\', \'f10_spend_money_total\','.$contentCountCrop.', \'f10\');" id="f10_spend_money_pesticide'.$contentCountCrop.'" name="f10_spend_money_pesticide'.$contentCountCrop.'" class="input-xlarge" onKeyPress="return numsonly(event);" maxlength="10" data-rule-required="true" placeholder="money you spend in buying pesticide">Rs';
	                $cropData	.= '</div>';
                $cropData	.= '</div>';	// <!-- spend money for Pesticide -->

                $cropData	.= '<div class="clearfix"></div>';
                
                // <!-- =================== -->
                // <!-- END : Pesticides -->
                // <!-- =================== -->

                // <!-- =================== -->
                // <!-- START : Other Inputs -->
                // <!-- =================== -->
                $cropData	.= '<div class="control-group span6">';
                    $cropData	.= '<label for="text" class="control-label" style="margin-top:10px">Brand of The Input Used<span style="color:#F00">*</span><br>[comma separated names]<br><br><br><br></label>';
                    $cropData	.= '<div class="controls">';
                        $cropData	.= '<input type="text" id="f10_brand_of_input_used'.$contentCountCrop.'" name="f10_brand_of_input_used'.$contentCountCrop.'" class="input-xlarge" data-rule-required="true" placeholder="Brand of The Input Used">';
                    $cropData	.= '</div>';
                $cropData	.= '</div>';	// <!-- Brand of The Input Used -->

                $cropData	.= '<input type="hidden" id="batch_chk_f10_other_inputs_used'.$contentCountCrop.'" name="batch_chk_f10_other_inputs_used'.$contentCountCrop.'" value="">';
                $cropData	.= '<div class="control-group span6">';
                    $cropData	.= '<label for="text" class="control-label" style="margin-top:10px">What were the Other Inputs You Use?<span style="color:#F00">*</span></label>';
                    $cropData	.= '<div class="controls">';
                    	$cropData	.= '<input type="checkbox" name="f10_other_inputs_used'.$contentCountCrop.'" class="cls_batch_chk_f10_other_inputs_used'.$contentCountCrop.'" value="Herbicide" > &nbsp;Herbicide &nbsp;&nbsp;<br>';
						$cropData	.= '<input type="checkbox" name="f10_other_inputs_used'.$contentCountCrop.'" class="cls_batch_chk_f10_other_inputs_used'.$contentCountCrop.'" value="Insecticide" > &nbsp;Insecticide &nbsp;&nbsp;<br>';
						$cropData	.= '<input type="checkbox" name="f10_other_inputs_used'.$contentCountCrop.'" class="cls_batch_chk_f10_other_inputs_used'.$contentCountCrop.'" value="Fungicide" > &nbsp;Fungicide &nbsp;&nbsp;<br>';
						$cropData	.= '<input type="checkbox" name="f10_other_inputs_used'.$contentCountCrop.'" class="cls_batch_chk_f10_other_inputs_used'.$contentCountCrop.'" value="Growth Accelerator" > &nbsp;Growth Accelerator &nbsp;&nbsp;<br>';
						$cropData	.= '<input type="checkbox" name="f10_other_inputs_used'.$contentCountCrop.'" class="cls_batch_chk_f10_other_inputs_used'.$contentCountCrop.'" value="Manure_Compost" > &nbsp;Manure / Compost &nbsp;&nbsp;<br>';
						$cropData	.= '<input type="checkbox" name="f10_other_inputs_used'.$contentCountCrop.'" class="cls_batch_chk_f10_other_inputs_used'.$contentCountCrop.'" value="Rodenticide" > &nbsp;Rodenticide &nbsp;&nbsp;<br>';
						$cropData	.= '<input type="checkbox" name="f10_other_inputs_used'.$contentCountCrop.'" class="cls_batch_chk_f10_other_inputs_used'.$contentCountCrop.'" value="Bactericides" > &nbsp;Bactericides &nbsp;&nbsp;<br>';
						$cropData	.= '<input type="checkbox" name="f10_other_inputs_used'.$contentCountCrop.'" class="cls_batch_chk_f10_other_inputs_used'.$contentCountCrop.'" value="Larvicide" > &nbsp;Larvicide &nbsp;&nbsp;';
                    $cropData	.= '</div>';
              	$cropData	.= '</div>';	// <!-- What were the Other Inputs You Use? -->

              	$cropData	.= '<div class="clearfix"></div>';

              	$cropData	.= '<div class="control-group span6">';
                    $cropData	.= '<label for="text" class="control-label" style="margin-top:10px">How much was the total consumption of Other Inputs in KGs <span style="color:#F00">*</span></label>';
                    $cropData	.= '<div class="controls">';
                    	$cropData	.= '<input type="text" id="f10_consumption_other_inputs'.$contentCountCrop.'" name="f10_consumption_other_inputs'.$contentCountCrop.'" class="input-xlarge" onKeyPress="return numsonly(event);" maxlength="10" data-rule-required="true" placeholder="How much was the total consumption of Other Inputs in KGs"> KGs';
                    $cropData	.= '</div>';
                $cropData	.= '</div>';	// How much was the total consumption of Other Inputs in KGs

                $cropData	.= '<div class="control-group span6">';
                    $cropData	.= '<label for="text" class="control-label" style="margin-top:10px">How much money you spend in buying Other Inputs?<span style="color:#F00">*</span></label>';
                    $cropData	.= '<div class="controls">';
                    	$cropData	.= '<input type="text" onBlur="getTotalMoneySpend(\'f10_spend_money\', \'f10_spend_money_fertiliser\', \'f10_spend_money_pesticide\', \'f10_spend_money_labour\', \'f10_spend_money_other_expenses\', \'f10_spend_money_farming_expenses\', \'f10_spend_money_total\','.$contentCountCrop.', \'f10\');" id="f10_spend_money_other_expenses'.$contentCountCrop.'" name="f10_spend_money_other_expenses'.$contentCountCrop.'" class="input-xlarge" onKeyPress="return numsonly(event);" maxlength="10" data-rule-required="true" placeholder="How much money you spend in buying Other Inputs?">Rs';
                    $cropData	.= '</div>';
                $cropData	.= '</div>';	// <!-- How much money you spend in buying Other Inputs? -->

                $cropData	.= '<div class="clearfix"></div>';
                // <!-- =================== -->
                // <!-- END : Other Inputs -->
                // <!-- =================== -->

                $cropData	.= '<div class="control-group">';
                    $cropData	.= '<label for="text" class="control-label" style="margin-top:10px">How much money you spend in buying Labour?<span style="color:#F00">*</span></label>';
                    $cropData	.= '<div class="controls">';
                    	$cropData	.= '<input type="text" onBlur="getTotalMoneySpend(\'f10_spend_money\', \'f10_spend_money_fertiliser\', \'f10_spend_money_pesticide\', \'f10_spend_money_labour\', \'f10_spend_money_other_expenses\', \'f10_spend_money_farming_expenses\', \'f10_spend_money_total\','.$contentCountCrop.', \'f10\');" id="f10_spend_money_labour'.$contentCountCrop.'" name="f10_spend_money_labour'.$contentCountCrop.'" class="input-xlarge" onKeyPress="return numsonly(event);" maxlength="10" data-rule-required="true" placeholder="money you spend in buying labour">Rs';
                    $cropData	.= '</div>';
                $cropData	.= '</div>';	// How much money you spend in buying Labour?

                $cropData	.= '<div class="control-group">';
                    $cropData	.= '<label for="text" class="control-label" style="margin-top:10px">Did you have any other farming expenses?  <span style="color:#F00">*</span></label>';
                    $cropData	.= '<div class="controls">';
                        $cropData	.= '<select id="f10_other_farming_expenses'.$contentCountCrop.'" name="f10_other_farming_expenses'.$contentCountCrop.'" class="select2-me input-xlarge" data-rule-required="true" onChange="getDisplayDiv(this.value, \'div_f10_other_farming_expenses'.$contentCountCrop.'\', \'yes\');">';
                            $cropData	.= '<option value="" disabled selected> Select here</option>';
                            $cropData	.= '<option value="yes" >Yes</option>';
                            $cropData	.= '<option value="no" >No</option>';
                        $cropData	.= '</select>';
                        $cropData	.= '[Ex. like wiring, fencing, crop protection measures winery stands for the grape to grow etc]';
                    $cropData	.= '</div>';
              	$cropData	.= '</div>';	// <!-- Did you have any other farming expenses? like wiring, fencing, crop protection measures winery stands for the grape to grow etc  -->

              	$cropData	.= '<div id="div_f10_other_farming_expenses'.$contentCountCrop.'" style="display: none;">';
	                                                                              		
              		$cropData	.= '<input type="hidden" id="batch_chk_f10_type_other_farming_expenses'.$contentCountCrop.'" name="batch_chk_f10_type_other_farming_expenses'.$contentCountCrop.'" value="">';
                    $cropData	.= '<div class="control-group span6">';
                        $cropData	.= '<label for="text" class="control-label" style="margin-top:10px">Type of other farming expenses<span style="color:#F00">*</span></label>';
                        $cropData	.= '<div class="controls">';
                        	$cropData	.= '<input type="checkbox" name="f10_type_other_farming_expenses'.$contentCountCrop.'" class="cls_batch_chk_f10_type_other_farming_expenses'.$contentCountCrop.'" value="Rent" > &nbsp;Rent &nbsp;&nbsp;<br>';
							$cropData	.= '<input type="checkbox" name="f10_type_other_farming_expenses'.$contentCountCrop.'" class="cls_batch_chk_f10_type_other_farming_expenses'.$contentCountCrop.'" value="Repairs and Maintainance" > &nbsp;Repairs and Maintainance &nbsp;&nbsp;<br>';
							$cropData	.= '<input type="checkbox" name="f10_type_other_farming_expenses'.$contentCountCrop.'" class="cls_batch_chk_f10_type_other_farming_expenses'.$contentCountCrop.'" value="Crop Protection and Safety" > &nbsp;Crop Protection and Safety &nbsp;&nbsp;<br>';
							$cropData	.= '<input type="checkbox" name="f10_type_other_farming_expenses'.$contentCountCrop.'" class="cls_batch_chk_f10_type_other_farming_expenses'.$contentCountCrop.'" value="Other Tools" > &nbsp;Other Tools &nbsp;&nbsp;<br>';
                        $cropData	.= '</div>';
                  	$cropData	.= '</div>';	// <!-- What were the Other Inputs You Use? -->

                  	$cropData	.= '<div class="control-group span6">';
                        $cropData	.= '<label for="text" class="control-label" style="margin-top:10px">How much money did you spend on those farming expenses ?<span style="color:#F00">*</span></label>';
                        $cropData	.= '<div class="controls">';
                            $cropData	.= '<input type="text" onBlur="getTotalMoneySpend(\'f10_spend_money\', \'f10_spend_money_fertiliser\', \'f10_spend_money_pesticide\', \'f10_spend_money_labour\', \'f10_spend_money_other_expenses\', \'f10_spend_money_farming_expenses\', \'f10_spend_money_total\','.$contentCountCrop.', \'f10\');" id="f10_spend_money_farming_expenses'.$contentCountCrop.'" name="f10_spend_money_farming_expenses'.$contentCountCrop.'" class="input-xlarge" onKeyPress="return numsonly(event);" maxlength="10" data-rule-required="true" placeholder="">Rs';
                        $cropData	.= '</div>';
                    $cropData	.= '</div>';	// <!-- How much money did you spend on those farming expenses ? -->

                    $cropData	.= '<div class="clearfix"></div>';
              	$cropData	.= '</div>';

              	$cropData	.= '<div class="clearfix"></div>';

                $cropData	.= '<div class="control-group">';
                    $cropData	.= '<label for="text" class="control-label" style="margin-top:10px">Total spend money for this Crop<span style="color:#F00">*</span></label>';
                    $cropData	.= '<div class="controls">';
                    	$cropData	.= '<input readonly type="text" id="f10_spend_money_total'.$contentCountCrop.'" name="f10_spend_money_total'.$contentCountCrop.'" class="input-xlarge" onKeyPress="return numsonly(event);" maxlength="10" data-rule-required="true" placeholder="Total spend money for this Crop">Rs';
                    $cropData	.= '</div>';
                $cropData	.= '</div>';	// Total spend money for this Crop

                $cropData	.= '<div class="control-group span6">';
                    $cropData	.= '<label for="text" class="control-label" style="margin-top:10px">Total Profit Gained for this crop?<span style="color:#F00">*</span></label>';
                    $cropData	.= '<div class="controls">';
                    	$cropData	.= '<input type="text" id="f10_total_profit_gained'.$contentCountCrop.'" name="f10_total_profit_gained'.$contentCountCrop.'" class="input-xlarge" onKeyPress="return numsonly(event);" maxlength="10" data-rule-required="true" placeholder="Total Profit Gained for this crop">Rs';
                    $cropData	.= '</div>';
                $cropData	.= '</div>';	// Total Profit Gained for this crop?

                $cropData	.= '<div class="control-group span6">';
                    $cropData	.= '<label for="text" class="control-label" style="margin-top:10px">Total Profit <span style="color:#F00">*</span><br><br></label>';
                    $cropData	.= '<div class="controls">';
                        $cropData	.= '<input type="text" readonly id="f10_total_profit'.$contentCountCrop.'" name="f10_total_profit'.$contentCountCrop.'" class="input-xlarge" onKeyPress="return numsonly(event);" maxlength="10" data-rule-required="true" placeholder="">Rs';
                    $cropData	.= '</div>';
                $cropData	.= '</div>';	// <!-- Total Profit  -->

                $cropData	.= '<div class="clearfix"></div>';

                $cropData	.= '<div class="control-group span6">';
					$cropData	.= '<label for="text" class="control-label" style="margin-top:10px">Potential Crop Damage<span style="color:#F00">*</span></label>';
					$cropData	.= '<div class="controls">';
						$cropData	.= '<select id="f10_diseases'.$contentCountCrop.'" name="f10_diseases'.$contentCountCrop.'" class="select2-me input-xlarge" data-rule-required="true" onchange="calTotal_f10()">';
							$cropData	.= '<option value="" disabled selected> Select here</option>';
							$cropData	.= '<option point="1" value="Disease" > Disease</option>';
							$cropData	.= '<option point="4" value="Pest" > Pest</option>';
							$cropData	.= '<option point="5" value="Both" > Both</option>';
							$cropData	.= '<option point="10" value="None"> None</option>';
						$cropData	.= '</select>';
					$cropData	.= '</div>';
				$cropData	.= '</div>';	// Potential Crop Damage
							
				$cropData	.= '<div class="control-group span6">';
					$cropData	.= '<label for="text" class="control-label" style="margin-top:10px">Percentage of damaged<span style="color:#F00">*</span></label>';
					$cropData	.= '<div class="controls">';
						$cropData	.= '<input type="text" value="" id="f10_percentage_of_damaged'.$contentCountCrop.'" name="f10_percentage_of_damaged'.$contentCountCrop.'" class="input-xlarge"  data-rule-required="true"  onKeyPress="return numsonly(event);" maxlength="10" placeholder="Percentage of damaged"> %';
					$cropData	.= '</div>';
				$cropData	.= '</div>';	// Percentage of damaged

				$cropData	.= '<div class="clearfix"></div>';
							
			$cropData	.= '</div>';
		$cropData	.= '</div>';

		$cropData 	.= '<script type="text/javascript">';
			$cropData 	.= '$(".datepicker").datepicker({format:\'yyyy-mm-dd\'});';
			$cropData 	.= '$("#f10_crop_season'.$contentCountCrop.'").select2();';
			$cropData 	.= '$("#f10_crop_type'.$contentCountCrop.'").select2();';
			$cropData 	.= '$("#f10_cultivating'.$contentCountCrop.'").select2();';
			$cropData 	.= '$("#f10_variety'.$contentCountCrop.'").select2();';
			$cropData 	.= '$("#f10_stage'.$contentCountCrop.'").select2();';
			$cropData 	.= '$("#f10_farming_type'.$contentCountCrop.'").select2();';
			$cropData 	.= '$("#f10_potential_market'.$contentCountCrop.'").select2();';
			$cropData 	.= '$("#f10_crop_storage'.$contentCountCrop.'").select2();';
			$cropData 	.= '$("#f10_is_homegrown_seeds'.$contentCountCrop.'").select2();';
			$cropData 	.= '$("#f10_seed_type'.$contentCountCrop.'").select2();';
			$cropData 	.= '$("#f10_other_farming_expenses'.$contentCountCrop.'").select2();';
			$cropData 	.= '$("#f10_diseases'.$contentCountCrop.'").select2();';
		$cropData 	.= '</script>';

		quit(utf8_encode($cropData),1);
	}
?>