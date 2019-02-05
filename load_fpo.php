<?php
	include('config/autoload.php');

	
	$fm_caid   	= $_SESSION['login_id'];
	// $fm_caid   	= $_SESSION['ca_id'];
	$fm_caname  = $_SESSION['sqyard_user'];

	if((isset($obj->load_fpo)) == "1" && isset($obj->load_fpo))
	{
		$response_array = array();	
		$start_offset   = 0;
		$avg_of_points 	= 0;
		
		$page 			= mysqli_real_escape_string($db_con,$obj->page);	
		$per_page		= mysqli_real_escape_string($db_con,$obj->row_limit);
		$search_text	= mysqli_real_escape_string($db_con,$obj->search_text);	
		// $hid_user_type	= mysqli_real_escape_string($db_con,$obj->hid_user_type); 
		// $hid_ca_id 		= mysqli_real_escape_string($db_con,$obj->hid_ca_id);
		 
		if($page != "" && $per_page != "")	
		{
			$cur_page 		= $page;
			$page 	   	   	= $page - 1;
			$start_offset 	+= $page * $per_page;
			$start 			= $page * $per_page;
				
			$sql_load_data  = " select * from tbl_mgnt_users WHERE mu_mr_role_id='3' ";
			if($_SESSION['userType'] == '3')
			{
				$sql_load_data  .= " AND mu_org_id = '".$_SESSION['mu_org_id']."' ";
			}
			if($search_text != "")
			{
				$sql_load_data .= " and (mu_name like '%".$search_text."%' or mu_email like '%".$search_text."%' ";
				$sql_load_data .= " or mu_mobile like '%".$search_text."%') ";	
			}
			// quit($sql_load_data);
			$data_count		= 	dataPagination($sql_load_data,$per_page,$start,$cur_page);		
			$sql_load_data .=" ORDER BY mu_id DESC LIMIT $start, $per_page ";
			$result_load_data = mysqli_query($db_con,$sql_load_data) or die(mysqli_error($db_con));			
			
					
			if(strcmp($data_count,"0") !== 0)
			{		
				$fpo_data = "";			
				$fpo_data .='<form id="mainform1" method="post">';
				$fpo_data .= '<table id="tbl_fpo" class="table table-bordered dataTable" style="width:100%;text-align:center">';
				$fpo_data .= '<thead>';
					$fpo_data .= '<tr>';
						$fpo_data .= '<th>Sr no.</th>';
						$fpo_data .= '<th>Forms</th>';
						$fpo_data .= '<th>FPO ID</th>';
						$fpo_data .= '<th>FPO Name</th>';
						$fpo_data .= '<th>Mobile No</th>';
						$fpo_data .= '<th>Email ID</th>';
						$fpo_data .= '<th>Status</th>';
						$fpo_data .= '<th class="hidden-350">Created Date</th>';
						$fpo_data .= '<th>Edit</th>';
					$fpo_data .= '</tr>';
				$fpo_data .= '</thead>';
				$fpo_data .= '<tbody>';
				while($row_load_data = mysqli_fetch_array($result_load_data))
				{
					$fpo_data .= '<tr>';				
						$fpo_data .= '<td class="center-text">'.++$start_offset.'</td>';				
						$fpo_data .= '<td style="text-align:center;">';
							$fpo_data .= '<a href="get_fpo_details.php?pag=fpo&fpo_id='.$row_load_data['mu_id'].'" class="btn btn-primary">View Forms</a>';
						$fpo_data .= '</td>';	//<!-- Forms -->
						$fpo_data .= '<td>'.$row_load_data['mu_id'].'</td>';	//<!-- Farmer ID -->
						$fpo_data .= '<td>';
							$fpo_data .= ucwords($row_load_data['mu_name']);
						$fpo_data .= '</td>';	//<!-- Farmer Name -->
						$fpo_data .= '<td>'.$row_load_data['mu_mobile'].'</td>';	//<!-- Mobile Number -->
						$fpo_data .= '<td>'.$row_load_data['mu_email'].'</td>';	//<!-- Email -->
						$fpo_data .= '<td>'.$row_load_data['status'].'</td>';	//<!-- Status -->
						$fpo_data .= '<td>'.$row_load_data['created_date'].'</td>';	//<!-- Created Date -->
						$fpo_data .= '<td style="text-align:center;">';
							$fpo_data .= '<a href="edit_fpo.php?pag=fpo&fpo_id='.$row_load_data['mu_id'].'" class="btn btn-primary">Edit</a>';
						$fpo_data .= '</td>';	//<!-- Edit Farmers -->
					$fpo_data .= '</tr>';															
				}	
				$fpo_data .= '</tbody>';
				$fpo_data .= '</table>';
				$fpo_data .= '</form>';
				$fpo_data .= $data_count;
				$response_array = array("Success"=>"Success","resp"=>$fpo_data);					
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

	if((isset($_POST['hid_div_basic_information'])) == '1' && ($_POST['hid_div_basic_information'] != ''))
	{
		$hid_isUpdate_flag              = trim($_POST['hid_isUpdate_flag']);
		$record_id                      = trim($_POST['record_id']);
		$data['fpo_id']                 = trim($_POST['fpo_id']);
		$data['orgType']                = trim($_POST['orgType']);
		$data['orgType_val']            = trim($_POST['orgType_val']);
		$data['ddl_state']              = trim($_POST['ddl_state']);
		$data['ddl_dist']               = trim($_POST['ddl_dist']);
		$data['ddl_tal']                = trim($_POST['ddl_tal']);
		$data['ddl_village']            = trim($_POST['ddl_village']);
		$data['txt_pincode']            = trim($_POST['txt_pincode']);
		$data['contactPerson']          = trim($_POST['contactPerson']);
		$data['designation']            = trim($_POST['designation']);
		$data['org_reg_no']             = trim($_POST['org_reg_no']);
		$data['date_of_reg']            = trim($_POST['date_of_reg']);
		$data['date_of_formating']      = trim($_POST['date_of_formating']);
		$data['num_of_members']         = trim($_POST['num_of_members']);
		$data['num_of_village_covered'] = trim($_POST['num_of_village_covered']);
		$data['name_of_villages']       = trim($_POST['name_of_villages']);
		$data['status']                 = 1;
		

		if($hid_isUpdate_flag == '1') // It means Update 
		{
			$data['modified_date'] = $datetime;
			$data['modified_by']   = $fm_caid;

			$res_update_fpo_basic_info = update('tbl_fpo_basic_information', $data, array('id'=>$record_id, 'fpo_id'=>$data['fpo_id']));

			if($res_update_fpo_basic_info)
			{
				quit('Updation Successfull', 1);
			}
			else
			{
				quit('Updation Failed');
			}
		}
		elseif($hid_isUpdate_flag == '2') // It means Insert
		{
			$data['created_date'] = $datetime;
			$data['created_by']   = $fm_caid;

			$res_insert_fpo_basic_info = insert('tbl_fpo_basic_information', $data);

			if($res_insert_fpo_basic_info)
			{
				quit('Insertion Successfull', 1);
			}
			else
			{
				quit('Insertion Failed');
			}
		}
		exit();
	}

	if((isset($_POST['hid_div_training_details'])) == '1' && ($_POST['hid_div_training_details'] != ''))
	{
		$hid_isUpdate_flag                         = trim($_POST['hid_isUpdate_flag']);
		$record_id                                 = trim($_POST['record_id']);
		$data['fpo_id']                            = trim($_POST['fpo_id']);
		$data['training_to_members']               = trim($_POST['training_to_members']);
		$data['training_val_members']              = trim($_POST['training_val_members']);
		$data['training_to_bod']                   = trim($_POST['training_to_bod']);
		$data['training_val_bod']                  = trim($_POST['training_val_bod']);
		$data['date_of_last_board_meeting']        = trim($_POST['date_of_last_board_meeting']);
		$data['frequency_of_board_meeting']        = trim($_POST['frequency_of_board_meeting']);
		$data['date_of_last_gen_assembly_meeting'] = trim($_POST['date_of_last_gen_assembly_meeting']);
		$data['isContactFullScaleAGM']             = trim($_POST['isContactFullScaleAGM']);
		$data['haveCollectiveWarehouse']           = trim($_POST['haveCollectiveWarehouse']);
		$data['warehouse_capacity']                = trim($_POST['warehouse_capacity']);
		$data['warehouse_location']                = trim($_POST['warehouse_location']);
		$data['procurement_facility']              = trim($_POST['procurement_facility']);
		$data['value_of_asset']                    = trim($_POST['value_of_asset']);
		$data['status']                            = 1;
		

		if($hid_isUpdate_flag == '1') // It means Update 
		{
			$data['modified_date'] = $datetime;
			$data['modified_by']   = $fm_caid;

			$res_update_fpo_basic_info = update('tbl_fpo_training_details', $data, array('id'=>$record_id, 'fpo_id'=>$data['fpo_id']));

			if($res_update_fpo_basic_info)
			{
				quit('Updation Successfull', 1);
			}
			else
			{
				quit('Updation Failed');
			}
		}
		elseif($hid_isUpdate_flag == '2') // It means Insert
		{
			$data['created_date'] = $datetime;
			$data['created_by']   = $fm_caid;

			$res_insert_fpo_basic_info = insert('tbl_fpo_training_details', $data);

			if($res_insert_fpo_basic_info)
			{
				quit('Insertion Successfull', 1);
			}
			else
			{
				quit('Insertion Failed');
			}
		}
		exit();
	}

	if((isset($_POST['hid_div_area_profile'])) == '1' && ($_POST['hid_div_area_profile'] != ''))
	{
		// $data['chk_major_castes']               = trim($_POST['chk_major_castes']);
		// $data['chk_irrigation_facility']        = trim($_POST['chk_irrigation_facility']);
		// $data['chk_road_connectivity']          = trim($_POST['chk_road_connectivity']);
		// $data['chk_road_type']                  = trim($_POST['chk_road_type']);
		// $data['chk_institutions']               = trim($_POST['chk_institutions']);
		$hid_isUpdate_flag                      = trim($_POST['hid_isUpdate_flag']);
		$record_id                              = trim($_POST['record_id']);
		$data['fpo_id']                         = trim($_POST['fpo_id']);
		
		$data['chk_major_castes']               = trim($_POST['batch_chk_major_castes']);
		$data['chk_irrigation_facility']        = trim($_POST['batch_chk_irrigation_facility']);
		$data['chk_road_connectivity']          = trim($_POST['batch_chk_road_connectivity']);
		$data['chk_road_type']                  = trim($_POST['batch_chk_road_type']);
		$data['chk_institutions']               = trim($_POST['batch_chk_institutions']);
		
		$data['land_size_hector']               = trim($_POST['land_size_hector']);
		$data['land_size_acre']                 = trim($_POST['land_size_acre']);
		$data['land_size_guntha']               = trim($_POST['land_size_guntha']);
		
		$data['avg_land_holding']               = trim($_POST['avg_land_holding']);

		$data['major_crops_in_kharif']          = trim($_POST['major_crops_in_kharif']);
		$data['major_crops_in_rabi']            = trim($_POST['major_crops_in_rabi']);
		$data['major_crops_in_summer']          = trim($_POST['major_crops_in_summer']);
		$data['major_economic_activity']        = trim($_POST['major_economic_activity']);
		$data['education_male']                 = trim($_POST['education_male']);
		$data['education_female']               = trim($_POST['education_female']);
		$data['distance_nearest_market']        = trim($_POST['distance_nearest_market']);
		$data['name_of_institution']            = trim($_POST['name_of_institution']);
		$data['main_office_equidistant']        = trim($_POST['main_office_equidistant']);
		$data['main_office_has_access']         = trim($_POST['main_office_has_access']);
		$data['demographic_composition_male']   = trim($_POST['demographic_composition_male']);
		$data['demographic_composition_female'] = trim($_POST['demographic_composition_female']);
		$data['majority_age_range']             = trim($_POST['majority_age_range']);
		$data['education_level_range']          = trim($_POST['education_level_range']);
		$data['status']                         = 1;
		
		// quit($data['chk_major_castes']);

		if($hid_isUpdate_flag == '1') // It means Update 
		{
			$data['modified_date'] = $datetime;
			$data['modified_by']   = $fm_caid;

			$res_update_fpo_basic_info = update('tbl_fpo_area_profile', $data, array('id'=>$record_id, 'fpo_id'=>$data['fpo_id']));

			if($res_update_fpo_basic_info)
			{
				quit('Updation Successfull', 1);
			}
			else
			{
				quit('Updation Failed');
			}
		}
		elseif($hid_isUpdate_flag == '2') // It means Insert
		{
			$data['created_date'] = $datetime;
			$data['created_by']   = $fm_caid;

			$res_insert_fpo_basic_info = insert('tbl_fpo_area_profile', $data);

			if($res_insert_fpo_basic_info)
			{
				quit('Insertion Successfull', 1);
			}
			else
			{
				quit('Insertion Failed');
			}
		}
		exit();
	}	

	if((isset($_POST['hid_div_share_details'])) == '1' && ($_POST['hid_div_share_details'] != ''))
	{
		$hid_isUpdate_flag                          = trim($_POST['hid_isUpdate_flag']);
		$record_id                                  = trim($_POST['record_id']);
		$data['fpo_id']                             = trim($_POST['fpo_id']);
		
		$data['num_of_shares']                      = trim($_POST['num_of_shares']);
		$data['share_value_per_share'] 				= trim($_POST['share_value_per_share']);
		$data['share_amount_contribution']          = trim($_POST['share_amount_contribution']);
		$data['num_of_share_holders']               = trim($_POST['num_of_share_holders']);
		$data['membership_fee']                     = trim($_POST['membership_fee']);
		$data['total_share_capital']                = trim($_POST['total_share_capital']);
		$data['total_membership_amt_collected']     = trim($_POST['total_membership_amt_collected']);
		$data['resource_institution_name']          = trim($_POST['resource_institution_name']);
		$data['resource_institution_address']       = trim($_POST['resource_institution_address']);
		$data['resource_institution_contactPerson'] = trim($_POST['resource_institution_contactPerson']);
		$data['resource_nstitution_mobile_num']     = trim($_POST['resource_nstitution_mobile_num']);
		$data['resource_institution_email_id']      = trim($_POST['resource_institution_email_id']);
		$data['governing_org']                      = trim($_POST['governing_org']);
		$data['governing_org_val']                  = trim($_POST['governing_org_val']);
		$data['any_funding_received']               = trim($_POST['any_funding_received']);
		$data['type_of_funding_received']           = trim($_POST['type_of_funding_received']);
		$data['size_of_funding_received']           = trim($_POST['size_of_funding_received']);
		$data['private_org_name']                   = trim($_POST['private_org_name']);
		$data['funding_duration']                   = trim($_POST['funding_duration']);
		$data['date_of_support_ending']             = trim($_POST['date_of_support_ending']);
		$data['total_support_amount']               = trim($_POST['total_support_amount']);
		$data['funding_support_used_for']           = trim($_POST['funding_support_used_for']);
		$data['any_other_funding_support']          = trim($_POST['any_other_funding_support']);
		$data['fpo_own_assets']                     = trim($_POST['fpo_own_assets']);
		$data['aggregate_value_of_assets']          = trim($_POST['aggregate_value_of_assets']);
		$data['other_supports_to_members']          = trim($_POST['other_supports_to_members']);
		$data['bank_name']                          = trim($_POST['bank_name']);
		$data['any_funding_received_from_bank']     = trim($_POST['any_funding_received_from_bank']);
		$data['mention_funding_receving_details']   = trim($_POST['mention_funding_receving_details']);
		$data['num_of_villages_part_of_org']        = trim($_POST['num_of_villages_part_of_org']);
		$data['num_of_figs']                        = trim($_POST['num_of_figs']);
		$data['produces_deal_with']                 = trim($_POST['produces_deal_with']);
		$data['input_shop_associated_with_fpo']     = trim($_POST['input_shop_associated_with_fpo']);
		$data['annual_turnover_of_fpo_2013_14']     = trim($_POST['annual_turnover_of_fpo_2013_14']);
		$data['annual_turnover_of_fpo_2014_15']     = trim($_POST['annual_turnover_of_fpo_2014_15']);
		$data['annual_turnover_of_fpo_2015_16']     = trim($_POST['annual_turnover_of_fpo_2015_16']);
		$data['annual_turnover_of_fpo_2016_17']     = trim($_POST['annual_turnover_of_fpo_2016_17']);
		$data['used_any_software']                  = trim($_POST['used_any_software']);
		$data['mention_software_details']           = trim($_POST['mention_software_details']);
		$data['kharif_2014']                        = trim($_POST['kharif_2014']);
		$data['kharif_2015']                        = trim($_POST['kharif_2015']);
		$data['kharif_2016']                        = trim($_POST['kharif_2016']);
		$data['kharif_2017']                        = trim($_POST['kharif_2017']);
		$data['rabi_2014']                          = trim($_POST['rabi_2014']);
		$data['rabi_2015']                          = trim($_POST['rabi_2015']);
		$data['rabi_2016']                          = trim($_POST['rabi_2016']);
		$data['rabi_2017']                          = trim($_POST['rabi_2017']);
		$data['summer_2014']                        = trim($_POST['summer_2014']);
		$data['summer_2015']                        = trim($_POST['summer_2015']);
		$data['summer_2016']                        = trim($_POST['summer_2016']);
		$data['summer_2017']                        = trim($_POST['summer_2017']);
		$data['turnover_achieved_by_tradin_2014']   = trim($_POST['turnover_achieved_by_tradin_2014']);
		$data['turnover_achieved_by_tradin_2015']   = trim($_POST['turnover_achieved_by_tradin_2015']);
		$data['turnover_achieved_by_tradin_2016']   = trim($_POST['turnover_achieved_by_tradin_2016']);
		$data['turnover_achieved_by_tradin_2017']   = trim($_POST['turnover_achieved_by_tradin_2017']);
		$data['total_annual_turnover_of_fpo']       = trim($_POST['total_annual_turnover_of_fpo']);
		$data['produces_plan_for_2018']             = trim($_POST['produces_plan_for_2018']);
		$data['other_business_activities']          = trim($_POST['other_business_activities']);

		
		$data['status']                             = 1;
		

		if($hid_isUpdate_flag == '1') // It means Update 
		{
			$data['modified_date'] = $datetime;
			$data['modified_by']   = $fm_caid;

			// Delete The all records from the "tbl_share_value"
			// $num_chk_records_in_tbl_share_value = isExist('tbl_share_value', array('fpo_share_details_id'=>$record_id));
			// if($num_chk_records_in_tbl_share_value != 0)
			// {
			// 	$del_from_tbl_share_value = delete('tbl_share_value', array('fpo_share_details_id'=>$record_id));
			// }

			$res_update_fpo_share_details = update('tbl_fpo_share_details', $data, array('id'=>$record_id, 'fpo_id'=>$data['fpo_id']));

			if($res_update_fpo_share_details)
			{
				// for($i = 1; $i <= $data['num_of_shares']; $i++)
				// {
				// 	// Insert into "tbl_share_value"
				// 	$data_share_val['fpo_share_details_id'] = $record_id;
				// 	$data_share_val['share_value']          = $_POST['share_value_'.$i];
				// 	$data_share_val['created_date']         = $datetime;
				// 	$data_share_val['created_by']           = $fm_caid;

				// 	$res_insert_fpo_share_val = insert('tbl_share_value', $data_share_val);
				// }
				quit('Updation Successfull', 1);
			}
			else
			{
				quit('Updation Failed');
			}
		}
		elseif($hid_isUpdate_flag == '2') // It means Insert
		{
			$data['created_date'] = $datetime;
			$data['created_by']   = $fm_caid;

			$res_insert_fpo_share_details = insert('tbl_fpo_share_details', $data);

			if($res_insert_fpo_share_details)
			{
				// for($i = 1; $i <= $data['num_of_shares']; $i++)
				// {
				// 	// Insert into "tbl_share_value"
				// 	$data_share_val['fpo_share_details_id'] = $res_insert_fpo_share_details;
				// 	$data_share_val['share_value']          = $_POST['share_value_'.$i];
				// 	$data_share_val['created_date']         = $datetime;
				// 	$data_share_val['created_by']           = $fm_caid;

				// 	$res_insert_fpo_share_val = insert('tbl_share_value', $data_share_val);
				// }
				quit('Insertion Successfull', 1);
			}
			else
			{
				quit('Insertion Failed');
			}
		}
		exit();
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
		$hid_org_id      = mysqli_real_escape_string($db_con,$obj->hid_org_id);

		 
		if($page != "" && $per_page != "")	
		{
			$cur_page 		= $page;
			$page 	   	   	= $page - 1;
			$start_offset 	+= $page * $per_page;
			$start 			= $page * $per_page;
				
			$sql_load_data  = " select tf.*, tca.fname AS change_agent_name, torg.org_name ";
			$sql_load_data  .= " from tbl_farmers AS tf INNER JOIN tbl_change_agents AS tca ";
			$sql_load_data  .= " 	ON tf.fm_caid = tca.id INNER JOIN tbl_organization AS torg ";
			$sql_load_data  .= " 	ON tf.fm_org_id = torg.id ";
			$sql_load_data  .= " WHERE 1=1 ";
			if($hid_org_id != '')
			{
				$sql_load_data  .= " AND tf.fm_org_id='".$hid_org_id."' ";
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
				$cat_data .='<form id="mainform1" method="post">'; // &fmca_id='.$hid_ca_id.'
				$cat_data .= '<table id="tbl_farmer" class="table table-bordered dataTable" style="width:100%;text-align:center">';
				$cat_data .= '<thead>';
					$cat_data .= '<tr>';
						$cat_data .= '<th>Sr no.</th>';
						$cat_data .= '<th>Forms</th>';
						$cat_data .= '<th>Docs Upload</th>';
						$cat_data .= '<th>Farmer ID</th>';
						$cat_data .= '<th>Farmer Name</th>';
						$cat_data .= '<th>Total Points</th>';
					$cat_data .= '</tr>';
				$cat_data .= '</thead>';
				$cat_data .= '<tbody>';
				while($row_load_data = mysqli_fetch_array($result_load_data))
				{
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
								$cat_data .= ' <small style="color:red">Incomplete</small>';
							}
							else
							{
								$cat_data .= ' <small style="color:green">Complete</small>';
							}
							
							$cat_data .= '<br>';

						$cat_data .= '</td>';	//<!-- Farmer Name -->
						$cat_data .= '<td>'.$avg_of_points.'</td>';	//<!-- Loan Required (Rs.) -->
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
			$txt_name				= mysqli_real_escape_string($db_con,$_POST['txt_name']);
			$txt_father_name		= mysqli_real_escape_string($db_con,$_POST['txt_father_name']);
			$txt_mother_name		= mysqli_real_escape_string($db_con,$_POST['txt_mother_name']);
			$txt_dob				= mysqli_real_escape_string($db_con,$_POST['txt_dob']);
			$txt_age				= mysqli_real_escape_string($db_con,$_POST['txt_age']);
			$fm_mobileno			= mysqli_real_escape_string($db_con,$_POST['fm_mobileno']);
			$alt_mobileno			= mysqli_real_escape_string($db_con,$_POST['alt_mobileno']);
			$txt_farm_experience	= mysqli_real_escape_string($db_con,$_POST['txt_farm_experience']);
			
			$f1_any_other_occupation= mysqli_real_escape_string($db_con,$_POST['f1_any_other_occupation']);
			$f1_occupation_amt		= mysqli_real_escape_string($db_con,$_POST['f1_occupation_amt']);

			 $f1_required_loan		= mysqli_real_escape_string($db_con,$_POST['f1_required_loan']);
			 $f1_required_loan_amt	= mysqli_real_escape_string($db_con,$_POST['f1_required_loan_amt']);
			 $f1_loan_purpose		= mysqli_real_escape_string($db_con,$_POST['f1_loan_purpose']);
			 $f1_crop_cycle			= mysqli_real_escape_string($db_con,$_POST['f1_crop_cycle']);
			
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
				$sql_insert_farmer	= " INSERT INTO `tbl_farmers`(`fm_caid`, `fm_id`, `fm_name`, `fm_aadhar`, `fm_mobileno`, ";
				$sql_insert_farmer	.= " `fm_status`, `fm_createddt`, `fm_createdby`) ";
				$sql_insert_farmer	.= " VALUES ('".$fm_caid."', '".$fm_id."', '".$txt_name."', '".$fm_aadhar."', ";
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
			$txt_name				= mysqli_real_escape_string($db_con,$_POST['txt_name']);
			$txt_father_name		= mysqli_real_escape_string($db_con,$_POST['txt_father_name']);
			$txt_mother_name		= mysqli_real_escape_string($db_con,$_POST['txt_mother_name']);
			$txt_dob				= mysqli_real_escape_string($db_con,$_POST['txt_dob']);
			$txt_age				= mysqli_real_escape_string($db_con,$_POST['txt_age']);
			$fm_mobileno			= mysqli_real_escape_string($db_con,$_POST['fm_mobileno']);
			$alt_mobileno			= mysqli_real_escape_string($db_con,$_POST['alt_mobileno']);
			$txt_farm_experience	= mysqli_real_escape_string($db_con,$_POST['txt_farm_experience']);
			
			$f1_any_other_occupation= mysqli_real_escape_string($db_con,$_POST['f1_any_other_occupation']);
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
					
					$fm_caid	= $row_get_farmer_info['fm_caid'];
					
					// Query for Checking the User
					$sql_chk_farmer	= " SELECT * FROM `tbl_personal_detail` WHERE `fm_id`='".$hid_fm_id."' ";
					$res_chk_farmer	= mysqli_query($db_con, $sql_chk_farmer) or die(mysqli_error($db_con));
					$num_chk_farmer	= mysqli_num_rows($res_chk_farmer);
					
					$res_update_farmer_details	= 'false';
					
					if($num_chk_farmer != 0)
					{
						// Query for updating the farmer personal details into tbl_personal_detail
						$sql_update_farmer_details   = " UPDATE `tbl_personal_detail` ";
						$sql_update_farmer_details   .= " 	SET `f1_mfname`='".$txt_mother_name."', ";
						$sql_update_farmer_details   .= " 		`f1_father`='".$txt_father_name."', ";
						$sql_update_farmer_details   .= " 		`f1_age`='".$txt_age."', ";
						$sql_update_farmer_details   .= " 		`f1_dob`='".$txt_dob."', ";
						$sql_update_farmer_details   .= " 		`f1_mobno`='".$fm_mobileno."', ";
						$sql_update_farmer_details   .= " 		`f1_altno`='".$alt_mobileno."', ";
						$sql_update_farmer_details   .= " 		`f1_expfarm`='".$txt_farm_experience."', ";
						$sql_update_farmer_details   .= " 		`f1_any_other_occupation`='".$f1_any_other_occupation."', ";
						$sql_update_farmer_details   .= " 		`f1_occupation_amt`='".$f1_occupation_amt."', ";
						$sql_update_farmer_details .= " 		`f1_required_loan`='".$f1_required_loan."', ";
						$sql_update_farmer_details .= " 		`f1_required_loan_amt`='".$f1_required_loan_amt."', ";
						$sql_update_farmer_details .= " 		`f1_loan_purpose`='".$f1_loan_purpose."', ";
						$sql_update_farmer_details .= " 		`f1_crop_cycle`='".$f1_crop_cycle."', ";
						$sql_update_farmer_details   .= " 		`f1_status`='1', ";
						$sql_update_farmer_details   .= " 		`f1_points`='".$hid_personal_details_points."', ";
						$sql_update_farmer_details   .= " 		`f1_modified_date`='".$datetime."', ";
						$sql_update_farmer_details   .= " 		`f1_modified_by`='".$fm_caname."' ";
						$sql_update_farmer_details   .= " WHERE `fm_id`='".$hid_fm_id."' ";
						$res_update_farmer_details   = mysqli_query($db_con, $sql_update_farmer_details) or die(mysqli_error($db_con));
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

	if(isset($_POST['hid_user_reg']) && $_POST['hid_user_reg'] == '1')
	{
		$txt_email      = mysqli_real_escape_string($db_con,$_POST['txt_email']);
		$sql_adhnocheck = " select * from tbl_mgnt_users where mu_email = '".$txt_email."' ";
		$res_adhnocheck = mysqli_query($db_con,$sql_adhnocheck);
		$tot_adhnocheck = mysqli_num_rows($res_adhnocheck);
		
		if($tot_adhnocheck == 0)
		{
			$txt_name     = mysqli_real_escape_string($db_con,$_POST['txt_name']);
			$txt_userType = mysqli_real_escape_string($db_con,$_POST['txt_userType']);
			$txt_password = mysqli_real_escape_string($db_con,$_POST['txt_password']);
			$txt_mobileno = mysqli_real_escape_string($db_con,$_POST['txt_mobileno']);
			
			if($txt_name != '' && $txt_email != '' && $txt_mobileno != '' && $txt_password != '')
			{
				// Query for inserting the users into tbl_organization table
				$data_org['org_name']        = $txt_name;
				$data_org['org_email']       = $txt_email;
				$data_org['org_contact_num'] = $txt_mobileno;
				$data_org['status']          = '1';
				$data_org['created_date']    = $datetime;
				$data_org['created_by']      = $fm_caid;

				$res_insert_org = insert('tbl_organization', $data_org);

				if($res_insert_org)
				{
					// Query for inserting the users into tbl_change_agents table
					$data_ca['mu_org_id']      = $res_insert_org;
					$data_ca['mu_mr_role_id']    = 3;
					$data_ca['mu_name']       = $txt_name;
					$data_ca['mu_email']     = $txt_email;
					$data_ca['mu_mobile']   = $txt_mobileno;
					$data_ca['mu_password']    = md5($txt_password);
					$data_ca['status']  = '1';
					$data_ca['created_date'] = $datetime;

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
		$hid_org_id     = mysqli_real_escape_string($db_con,$_POST['hid_org_id']);
		
		$txt_email      = mysqli_real_escape_string($db_con,$_POST['txt_email']);
		$sql_adhnocheck = "Select * from tbl_mgnt_users where mu_email = '".$txt_email."' AND mu_id !='".$hid_user_id."'";
		
		//quit('error',$sql_adhnocheck);
		
		$res_adhnocheck = mysqli_query($db_con,$sql_adhnocheck);
		$tot_adhnocheck = mysqli_num_rows($res_adhnocheck);
		
		if($tot_adhnocheck == 0)
		{
			$txt_name     = mysqli_real_escape_string($db_con,$_POST['txt_name']);
			$txt_userType = mysqli_real_escape_string($db_con,$_POST['txt_userType']);
			$txt_password = mysqli_real_escape_string($db_con,$_POST['txt_password']);
			$txt_mobileno = mysqli_real_escape_string($db_con,$_POST['txt_mobileno']);

			
			if($txt_name != '' && $txt_email != '' && $txt_mobileno != '')
			{
				// Query for inserting the users into tbl_organization table
				$data_org['org_name']        = $txt_name;
				$data_org['org_email']       = $txt_email;
				$data_org['org_contact_num'] = $txt_mobileno;
				$data_org['status']          = '1';
				$data_org['modified_date']   = $datetime;
				$data_org['modified_by']     = $fm_caid;

				$res_update_org = update('tbl_organization', $data_org, array('id'=>$hid_org_id));

				if($res_update_org)
				{
					// Query for Updating the farmer into tbl_farmers table
					
					$data_ca['mu_name']      = $txt_name;
					$data_ca['mu_email']    = $txt_email;
					$data_ca['mu_mobile']  = $txt_mobileno;
					if($txt_password!=""){
						$data_ca['password']   = md5($txt_password);
					}
					
					$data_ca['modified_date'] = $datetime;
					$res_update_ca = update('tbl_mgnt_users', $data_ca, array('mu_id'=>$hid_user_id));

					if($res_update_ca)
					{
						quit('Success', 1);
					}
					else
					{
						quit('Updation Error, Please try after sometime');	
					}
				}
				else
				{
					quit('Updation Error, Please try after sometime');
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
?>