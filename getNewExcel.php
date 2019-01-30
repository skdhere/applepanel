<?php

	include('include/connection.php');
	include('include/query-helper.php');
    include('getExcelHeader.php');
	include('xlsxwriter.class.php');
   
    if(isset($_POST) && !empty($_POST['batch']))
    {
    	$fm_ids  = $_POST['batch'];
    }
    $fm_ids = array(101850,101860,101854,101861);
	$writer1          = new XLSXWriter();
	$excelHeaders     = new excelHeaders();
	$Filter           = new Filter();
	
	$header = array(
			'Sr No.'                                    =>'string',	
			'Org Id'                                    =>'string',
			'Organisation Name'                         =>'string',
			'CA ID'                                     =>'string',	
			'CA Name'                                   =>'string',	
			'Farmer Id'                                 =>'string',		
			'Farmer Name'                               =>'string',
			'Father\'s / Spouse\'s Name'                =>'String',
			'Mother Name'                               => 'String',
			'Date of Birth'                             =>' String',
			'Age'                                       =>'String',
			'Aadhar Number'                             =>'String',
			'Mobile Number'                             =>'String',
			'Experience In Farming'                     => 'String',
			'Farmer id2'                                =>'String',
			'Land Size'                                 =>'string',	
			'Land Size in Hector'                       =>'string',	
			'Land Size in Acre'                         =>'string',		
			'Land size in Guntha'                       =>'string',
			'Ownership'                                 =>'String',
			'Rent Amount'                               => 'String',
			'Lease Year'                                =>' String',
			'Contract Year'                             =>'String',
			'Survey Number'                             =>'String',
			'GAT Number'                                =>'String',
			'Village'                                   => 'String',
			"Taluka"                                    =>"String",
			"District"                                  =>"String",		
			"State"                                     =>"String",		
			"Pincode"                                   =>"String",		
			"Lat"                                       =>"String",		
			"Long"                                      =>"String",		
			"Geo Tag"                                   =>"String",		
			"Is Soil Tested"                            =>"String",		
			"Soil Type"                                 =>"String",		
			"Soil Depth"                                =>"String",		
			"Sourse of Water"                           =>"String",		
			"Farmer id1"                                =>"String",		
			"Crop Season"                               =>"String",		
			"Crop Type"                                 =>"String",		
			"Cultivating"                               =>"String",		
			"Crop Name"                                 =>"String",		
			"Variety"                                   =>"String",		
			"Stage"                                     =>"String",		
			"Farming Type"                              =>"String",		
			"Potential Market"                          =>"String",		
			"Crop Storage"                              =>"String",		
			"Water Source Name"                         =>"String",		
			"Total Hector"                              =>"String",		
			"Total Acre"                                =>"String",		
			"Total Guntha"                              =>"String",		
			"Total Acrage"                              =>"String",		
			"Harvest Date"                              =>"String",		
			"Expected Yield"                            =>"String",		
			"Expected Price"                            =>"String",		
			"Expected Income"                           =>"String",		
			"Total Income"                              =>"String",		
			"Is Homegrown Seeds"                        =>"String",		
			"Farming Type"                              =>"String",		
			"Brand of Seeds"                            =>"String",		
			"Seed Type"                                 =>"String",		
			"Consumtion Seeds"                          =>"String",		
			"Spend Money"                               =>"String",		
			"Brand of Fertiliser"                       =>"String",		
			"Money Spend in buying Fertiliser"          =>"String",		
			"Brand of Pesticide"                        =>"String",		
			"Consumption Pesticides"                    =>"String",		
			"Spend money on pesticide"                  =>"String",		
			"Other inputs used"                         =>"String",		
			"Consumption other inputs"                  =>"String",		
			"Spend money on other expenses"             =>"String",		
			"Spend money on labour"                     =>"String",	
			"Other farming expenses"                    =>"String",		
			"Spend money on  farming expenses"          =>"String",		
			"Spend money total"                         =>"String",
			"Farmer id4"                                =>"String",		
			"Prev Crop Season"                      =>"String",		
			"Prev Crop Type"                        =>"String",		
			"Prev Cultivating"                      =>"String",		
			"Prev Crop Name"                        =>"String",		
			"Prev Variety"                          =>"String",				
			"Prev Farming Type"                     =>"String",		
			"Prev Potential Market"                 =>"String",		
			"Prev Crop Storage"                     =>"String",		
			"Prev Water Source Name"                =>"String",		
			"Prev Total Hector"                     =>"String",		
			"Prev Total Acre"                       =>"String",		
			"Prev Total Guntha"                     =>"String",		
			"Prev Total Acrage"                     =>"String",		
			"Prev Harvest Date"                     =>"String",		
			"Prev Expected Yield"                   =>"String",		
			"Prev Expected Price"                   =>"String",		
			"Prev Expected Income"                  =>"String",		
			"Prev Total Income"                     =>"String",		
			"Prev Is Homegrown Seeds"               =>"String",		
			"Prev Brand of Seeds"                   =>"String",		
			"Prev Seed Type"                        =>"String",		
			"Prev Consumtion Seeds"                 =>"String",		
			"Prev Spend Money"                      =>"String",		
			"Prev Brand of Fertiliser"              =>"String",		
			"Prev Money Spend in buying Fertiliser" =>"String",		
			"Prev Brand of Pesticide"               =>"String",		
			"Prev Consumption Pesticides"           =>"String",		
			"Prev Spend money on pesticide"         =>"String",		
			"Prev Other inputs used"                =>"String",		
			"Prev Consumption other inputs"         =>"String",		
			"Prev Spend money on other expenses"    =>"String",		
			"Prev Spend money on labour"            =>"String",	
			"Prev Other farming expenses"           =>"String",		
			"Prev Spend money on  farming expenses" =>"String",		
			"Prev Spend money total"                =>"String",
			"Forecast id3"                              =>"String",		
			"Forecast Crop Season"                      =>"String",		
			"Forecast Crop Type"                        =>"String",		
			"Forecast Cultivating"                      =>"String",		
			"Forecast Crop Name"                        =>"String",		
			"Forecast Variety"                          =>"String",				
			"Forecast Farming Type"                     =>"String",		
			"Forecast Potential Market"                 =>"String",		
			"Forecast Crop Storage"                     =>"String",		
			"Forecast Water Source Name"                =>"String",		
			"Forecast Total Hector"                     =>"String",		
			"Forecast Total Acre"                       =>"String",		
			"Forecast Total Guntha"                     =>"String",		
			"Forecast Total Acrage"                     =>"String",		
			"Forecast Harvest Date"                     =>"String",		
			"Forecast Expected Yield"                   =>"String",		
			"Forecast Expected Price"                   =>"String",		
			"Forecast Expected Income"                  =>"String",		
			"Forecast Total Income"                     =>"String",		
			"Forecast Is Homegrown Seeds"               =>"String",		
			"Forecast Brand of Seeds"                   =>"String",		
			"Forecast Seed Type"                        =>"String",		
			"Forecast Consumtion Seeds"                 =>"String",		
			"Forecast Spend Money"                      =>"String",		
			"Forecast Brand of Fertiliser"              =>"String",		
			"Forecast Money Spend in buying Fertiliser" =>"String",		
			"Forecast Brand of Pesticide"               =>"String",		
			"Forecast Consumption Pesticides"           =>"String",		
			"Forecast Spend money on pesticide"         =>"String",		
			"Forecast Other inputs used"                =>"String",		
			"Forecast Consumption other inputs"         =>"String",		
			"Forecast Spend money on other expenses"    =>"String",		
			"Forecast Spend money on labour"            =>"String",	
			"Forecast Other farming expenses"           =>"String",		
			"Forecast Spend money on  farming expenses" =>"String",		
			"Forecast Spend money total"                =>"String"			
			);
	
	$basic_arr        = array();
	$kyc_arr          = array();
	
	$current_crop_arr = array();

	$count            = 1;

	$farmerData       = array();

	$main_arr         = array();
	$sr_no            = 1;
    foreach ($fm_ids as $fm_id) {
    	
    	// ==============================start Farmer detail========================//
		$result   = lookup_value('tbl_farmers',array(),array("fm_id"=>$fm_id));
		$row      = mysqli_fetch_assoc($result);
		
		
		$org_id   = $row['fm_org_id'];
		
		$org_name = lookup_value('tbl_organization',array('org_name'),array("id"=>$row['fm_org_id']));
		$ca_id    = $row['fm_caid'];
		$fm_id    = $row['fm_id'];
		$ca_name  = lookup_value('tbl_change_agents',array('fname'),array("id"=>$row['fm_caid']));

		$personalResult = lookup_value('tbl_personal_detail',array(),array("fm_id"=>$fm_id));
		$personalRow    = mysqli_fetch_assoc($personalResult);

		$farmer_name   = $row['fm_name'];
		$father_name   = $personalRow['f1_father'];
		$mother_name   = $personalRow['f1_mfname'];
		$date_of_birth = $personalRow['f1_dob'];
		$age           = $personalRow['f1_age'];
		$aadhar_num    = $row['fm_aadhar'];
		$mobile_number = $row['fm_mobileno'];
		$experience    = $personalRow['f1_expfarm'];

		$personalDetail = array(array($sr_no,$org_id,$org_name,$ca_id,$ca_name,$fm_id,$farmer_name,$father_name,$mother_name,$date_of_birth,$age,$aadhar_num,$mobile_number,$experience));



		//=========================================================================//
		//==============================Start Land Detail==========================//
		$res 	= lookup_value('tbl_land_details',array(),array("fm_id"=>$fm_id));
		if($res)
		{
			$num = mysqli_num_rows($res);
			if($num != 0)
			{
				$land_arr = array();
				$no_of_land	= 1;
				while($row	= mysqli_fetch_assoc($res))
				{
					$farmer_id        = $row['fm_id'];
					
					$land_size        = $row['f9_land_size'];
					$land_size_hect   = $row['f9_land_size_hector'];
					$land_size_acre   = $row['f9_land_size_acre'];
					$land_size_guntha = $row['f9_land_size_guntha'];

					$ownership        = $row['f9_owner'];

					$rent             = $row['f9_amount_on_rent'];
					$lease_year       = $row['f9_lease_year'];
					$contract_year    = $row['f9_contract_year'];
					$survay_num       = $row['f9_survey_number'];
					$gat_number       = $row['f9_gat_number'];
					$vilage           = lookup_value('tbl_village',array('vl_name'),array("id"=>$row['f9_vilage']));
					$taluka           = lookup_value('tbl_taluka',array('tk_name'),array("id"=>$row['f9_taluka']));
					$district         = lookup_value('tbl_district',array('dt_name'),array("id"=>$row['f9_district']));
					$state            = lookup_value('tbl_state',array('st_name'),array("id"=>$row['f9_state']));
					$pincode          = $row['f9_pincode'];
					
					$lat              = $row['f9_lat'];
					$lon              = $row['f9_long'];
					$geo_tag          = $row['f9_geo_tag'];
					$soil_tested      = $row['f9_soil_tested'];
					$soil_type        = $row['f9_soil_type'];
					$soil_depth       = $row['f9_soil_depth'];
					$sourse_of_water  = '';

					$sql	= " SELECT group_concat(water_source) as wname FROM `tbl_water_source` WHERE `status`='1' AND water_source IN (SELECT DISTINCT(water_source_name) FROM tbl_f9_farmer_water_source WHERE fm_id='".$fm_id."' AND count='".$no_of_land."') ";
					$res1    = mysqli_query($db_con, $sql) or die(mysqli_error($db_con));

					if($res1)
					{
						$rw                        = mysqli_fetch_array($res1);
						$sourse_of_water  = $rw['wname'];
					}
					
					$dum_arr = array($farmer_id,$land_size,$land_size_hect,$land_size_acre,$land_size_guntha,$ownership,$rent,$lease_year,$contract_year,$survay_num,$gat_number,$vilage,$taluka,$district,$state,$pincode,$lat,$lon,$geo_tag,$soil_tested,$soil_type,$soil_depth,$sourse_of_water);

					array_push($land_arr,$dum_arr);
					$no_of_land++;
				}
			}
		}

		$cropRes 	= lookup_value('tbl_cultivation_data',array(),array("fm_id"=>$fm_id));
		if($cropRes){
			$num = mysqli_num_rows($cropRes);
			if($num != 0)
			{
				$curr_crop_arr = array();
				$no_of_crop    = 1;
				while($cropRow = mysqli_fetch_array($cropRes))
				{
					$t_arr = array();// temporary array;

					$farmer_id        = $cropRow['fm_id'];
					array_push($t_arr,$farmer_id);
					$crop_season      = $cropRow['f10_crop_season'];
					array_push($t_arr,$crop_season);

					// $t_arr = array($$farmer_id);
					$crop_type        =$cropRow['f10_crop_type'];
					array_push($t_arr,$crop_type);
					$cultivating      = lookup_value('tbl_crops',array('crop_name'),array("crop_id"=>$cropRow['f10_cultivating'])); 
					array_push($t_arr,$cultivating);
					
					$crop_name        = $cropRow['f10_other_crop_name'];
					array_push($t_arr,$crop_name);
					
					$Variety          = lookup_value('tbl_crop_varieties',array('variety_name'),array("variety_id"=>$cropRow['f10_variety']));
					array_push($t_arr,$Variety);
					$stage            = $cropRow['f10_stage'];
					array_push($t_arr,$stage);
					$farming_type     = $cropRow['f10_filt_type'];
					array_push($t_arr,$farming_type);
					$potentoal_market = $cropRow['f10_potential_market'];
					array_push($t_arr,$potentoal_market);
					$crop_storage     = $cropRow['f10_crop_storage'];
					array_push($t_arr,$crop_storage);
					$water_source ='';
					$sql1 = " SELECT group_concat(water_source) as wname FROM `tbl_water_source` WHERE `status`='1' AND water_source IN (SELECT DISTINCT(water_source_name) FROM tbl_f10_farmer_water_source WHERE fm_id='".$fm_id."' AND count='".$no_of_crop."') ";
						$res1 = mysqli_query($db_con, $sql1) or die(mysqli_error($db_con));

						if($res1)
						{
							$rw                       = mysqli_fetch_array($res1);
							$water_source = $rw['wname'];
						}
					array_push($t_arr,$water_source);

					$total_hect                 = $cropRow['f10_total_hector'];
					array_push($t_arr,$total_hect);
					$total_acre                 = $cropRow['f10_total_acre'];
					array_push($t_arr,$total_acre);
					$total_guntha               = $cropRow['f10_total_guntha'];
					array_push($t_arr,$total_guntha);
					$total_acrage               = $cropRow['f10_total_acrage'];
					array_push($t_arr,$total_acrage);
					$harvest_date               = $cropRow['f10_harvest_date'];
					array_push($t_arr,$harvest_date);
					$expected_yield             = $cropRow['f10_expected'];
					array_push($t_arr,$expected_yield);
					$expected_price             = $cropRow['f10_expectedprice'];
					array_push($t_arr,$expected_price);
					$expected_income            = $cropRow['f10_expectedincome'];
					array_push($t_arr,$expected_income);
					$total_income               = $cropRow['f10_totalincome'];
					array_push($t_arr,$total_income);
					$ishome_seed                = $cropRow['f10_is_homegrown_seeds'];
					array_push($t_arr,$ishome_seed);
					$seed_brand                 = $cropRow['f10_brand_of_input_used'];
					array_push($t_arr,$seed_brand);
					$seed_type                  = $cropRow['f10_seed_type'];
					array_push($t_arr,$seed_type);
					$cons_seed                  = $cropRow['f10_consumption_seeds'];// consumption
					array_push($t_arr,$cons_seed);
					$money_spend                = $cropRow['f10_spend_money'];
					array_push($t_arr,$money_spend);
					$ferti_brand                = $cropRow['f10_brand_of_fertiliser'];
					array_push($t_arr,$ferti_brand);
					$money_spend_on_ferti       = $cropRow['f10_spend_money_fertiliser'];
					array_push($t_arr,$money_spend_on_ferti);
					$pesticide_brand            = $cropRow['f10_brand_of_pesticide'];
					array_push($t_arr,$pesticide_brand);
					$consumption_pesticide      = $cropRow['f10_consumption_pesticides'];
					array_push($t_arr,$consumption_pesticide);
					$money_spend_on_pesti       = $cropRow['f10_spend_money_pesticide'];
					array_push($t_arr,$money_spend_on_pesti);
					$other_inp                  = $cropRow['f10_other_inputs_used'];
					array_push($t_arr,$other_inp);
					$cons_oth_inp               = $cropRow['f10_consumption_other_inputs'];
					array_push($t_arr,$cons_oth_inp);
					$money_spend_on_oth_exp     = $cropRow['f10_spend_money_other_expenses'];
					array_push($t_arr,$money_spend_on_oth_exp);
					$money_spend_on_labour      = $cropRow['f10_spend_money_labour'];
					array_push($t_arr,$money_spend_on_labour);
					$other_farming_exp          = $cropRow['f10_other_farming_expenses'];
					array_push($t_arr,$other_farming_exp);
					$money_spend_on_farming_exp = $cropRow['f10_spend_money_farming_expenses'];
					array_push($t_arr,$money_spend_on_farming_exp);
					$spend_money_total          = $cropRow['f10_spend_money_total'];
					array_push($t_arr,$spend_money_total);

					array_push($curr_crop_arr,$t_arr);
					$no_of_crop++;
				}
			}
		}


		$cropRes 	= lookup_value('tbl_yield_details',array(),array("fm_id"=>$fm_id));
		if($cropRes){
			$num = mysqli_num_rows($cropRes);
			if($num != 0)
			{
				$prev_crop_arr = array();
				$no_of_crop    = 1;
				while($cropRow = mysqli_fetch_array($cropRes))
				{
					$t_arr = array();// temporary array;

					$farmer_id        = $cropRow['fm_id'];
					array_push($t_arr,$farmer_id);
					$crop_season      = $cropRow['f11_crop_season'];
					array_push($t_arr,$crop_season);

					// $t_arr = array($$farmer_id);
					$crop_type        =$cropRow['f11_crop_type'];
					array_push($t_arr,$crop_type);
					$cultivating      = lookup_value('tbl_crops',array('crop_name'),array("crop_id"=>$cropRow['f11_cultivating'])); 
					array_push($t_arr,$cultivating);
					
					$crop_name        = $cropRow['f11_other_crop_name'];
					array_push($t_arr,$crop_name);
					
					$Variety          = lookup_value('tbl_crop_varieties',array('variety_name'),array("variety_id"=>$cropRow['f11_variety']));
					array_push($t_arr,$Variety);


					// $stage            = $cropRow['f11_stage'];
					// array_push($t_arr,$stage);
					$farming_type     = $cropRow['f11_farming_type'];
					array_push($t_arr,$farming_type);
					$potentoal_market = $cropRow['f11_potential_market'];
					array_push($t_arr,$potentoal_market);
					$crop_storage     = $cropRow['f11_crop_storage'];
					array_push($t_arr,$crop_storage);
					$water_source ='';
					$sql1 = " SELECT group_concat(water_source) as wname FROM `tbl_water_source` WHERE `status`='1' AND water_source IN (SELECT DISTINCT(water_source_name) FROM tbl_f11_farmer_water_source WHERE fm_id='".$fm_id."' AND count='".$no_of_crop."') ";
						$res1 = mysqli_query($db_con, $sql1) or die(mysqli_error($db_con));

						if($res1)
						{
							$rw                       = mysqli_fetch_array($res1);
							$water_source = $rw['wname'];
						}
					array_push($t_arr,$water_source);

					$total_hect                 = $cropRow['f11_total_hector'];
					array_push($t_arr,$total_hect);
					$total_acre                 = $cropRow['f11_total_acre'];
					array_push($t_arr,$total_acre);
					$total_guntha               = $cropRow['f11_total_guntha'];
					array_push($t_arr,$total_guntha);
					$total_acrage               = $cropRow['f11_total_acrage'];
					array_push($t_arr,$total_acrage);
					$harvest_date               = $cropRow['f11_harvest_date'];
					array_push($t_arr,$harvest_date);
					$expected_yield             = $cropRow['f11_expected'];
					array_push($t_arr,$expected_yield);
					$expected_price             = $cropRow['f11_expectedprice'];
					array_push($t_arr,$expected_price);
					$expected_income            = $cropRow['f11_income'];
					array_push($t_arr,$expected_income);
					$total_income               = $cropRow['f11_totalincome'];
					array_push($t_arr,$total_income);
					$ishome_seed                = $cropRow['f11_is_homegrown_seeds'];
					array_push($t_arr,$ishome_seed);
					$seed_brand                 = $cropRow['f11_brand_of_input_used'];
					array_push($t_arr,$seed_brand);
					$seed_type                  = $cropRow['f11_seed_type'];
					array_push($t_arr,$seed_type);
					$cons_seed                  = $cropRow['f11_consumption_seeds'];// consumption
					array_push($t_arr,$cons_seed);
					$money_spend                = $cropRow['f11_spend_money'];
					array_push($t_arr,$money_spend);
					$ferti_brand                = $cropRow['f11_brand_of_fertiliser'];
					array_push($t_arr,$ferti_brand);
					$money_spend_on_ferti       = $cropRow['f11_spend_money_fertiliser'];
					array_push($t_arr,$money_spend_on_ferti);
					$pesticide_brand            = $cropRow['f11_brand_of_pesticide'];
					array_push($t_arr,$pesticide_brand);
					$consumption_pesticide      = $cropRow['f11_consumption_pesticides'];
					array_push($t_arr,$consumption_pesticide);
					$money_spend_on_pesti       = $cropRow['f11_spend_money_pesticide'];
					array_push($t_arr,$money_spend_on_pesti);
					$other_inp                  = $cropRow['f11_other_inputs_used'];
					array_push($t_arr,$other_inp);
					$cons_oth_inp               = $cropRow['f11_consumption_other_inputs'];
					array_push($t_arr,$cons_oth_inp);
					$money_spend_on_oth_exp     = $cropRow['f11_spend_money_other_expenses'];
					array_push($t_arr,$money_spend_on_oth_exp);
					$money_spend_on_labour      = $cropRow['f11_spend_money_labour'];
					array_push($t_arr,$money_spend_on_labour);
					$other_farming_exp          = $cropRow['f11_other_farming_expenses'];
					array_push($t_arr,$other_farming_exp);
					$money_spend_on_farming_exp = $cropRow['f11_spend_money_farming_expenses'];
					array_push($t_arr,$money_spend_on_farming_exp);
					$spend_money_total          = $cropRow['f11_spend_money_total'];
					array_push($t_arr,$spend_money_total);

					array_push($prev_crop_arr,$t_arr);
					$no_of_crop++;
				}
			}
		}

		$cropRes 	= lookup_value('tbl_current_crop_forecast',array(),array("fm_id"=>$fm_id));
		if($cropRes){
			$num = mysqli_num_rows($cropRes);
			if($num != 0)
			{
				$fore_crop_arr = array();
				$no_of_crop    = 1;
				while($cropRow = mysqli_fetch_array($cropRes))
				{
					$t_arr = array();// temporary array;

					$farmer_id        = $cropRow['fm_id'];
					array_push($t_arr,$farmer_id);
					$crop_season      = $cropRow['f14_crop_season'];
					array_push($t_arr,$crop_season);

					// $t_arr = array($$farmer_id);
					$crop_type        =$cropRow['f14_crop_type'];
					array_push($t_arr,$crop_type);
					$cultivating      = lookup_value('tbl_crops',array('crop_name'),array("crop_id"=>$cropRow['f14_cultivating'])); 
					array_push($t_arr,$cultivating);
					
					$crop_name        = $cropRow['f14_other_crop_name'];
					array_push($t_arr,$crop_name);
					
					$Variety          = lookup_value('tbl_crop_varieties',array('variety_name'),array("variety_id"=>$cropRow['f14_variety']));
					array_push($t_arr,$Variety);


					// $stage            = $cropRow['f14_stage'];
					// array_push($t_arr,$stage);
					$farming_type     = $cropRow['f14_farming_type'];
					array_push($t_arr,$farming_type);
					$potentoal_market = $cropRow['f14_potential_market'];
					array_push($t_arr,$potentoal_market);
					$crop_storage     = $cropRow['f14_crop_storage'];
					array_push($t_arr,$crop_storage);
					$water_source ='';
					$sql1 = " SELECT group_concat(water_source) as wname FROM `tbl_water_source` WHERE `status`='1' AND water_source IN (SELECT DISTINCT(water_source_name) FROM tbl_f14_farmer_water_source WHERE fm_id='".$fm_id."' AND count='".$no_of_crop."') ";
						$res1 = mysqli_query($db_con, $sql1) or die(mysqli_error($db_con));

						if($res1)
						{
							$rw                       = mysqli_fetch_array($res1);
							$water_source = $rw['wname'];
						}
					array_push($t_arr,$water_source);

					$total_hect                 = $cropRow['f14_total_hector'];
					array_push($t_arr,$total_hect);
					$total_acre                 = $cropRow['f14_total_acre'];
					array_push($t_arr,$total_acre);
					$total_guntha               = $cropRow['f14_total_guntha'];
					array_push($t_arr,$total_guntha);
					$total_acrage               = $cropRow['f14_total_acrage'];
					array_push($t_arr,$total_acrage);
					$harvest_date               = $cropRow['f14_harvest_date'];
					array_push($t_arr,$harvest_date);
					$expected_yield             = $cropRow['f14_expected'];
					array_push($t_arr,$expected_yield);
					$expected_price             = $cropRow['f14_expectedprice'];
					array_push($t_arr,$expected_price);
					$expected_income            = @$cropRow['f14_income'];
					array_push($t_arr,$expected_income);
					$total_income               = $cropRow['f14_totalincome'];
					array_push($t_arr,$total_income);
					$ishome_seed                = $cropRow['f14_is_homegrown_seeds'];
					array_push($t_arr,$ishome_seed);
					$seed_brand                 = $cropRow['f14_brand_of_input_used'];
					array_push($t_arr,$seed_brand);
					$seed_type                  = $cropRow['f14_seed_type'];
					array_push($t_arr,$seed_type);
					$cons_seed                  = $cropRow['f14_consumption_seeds'];// consumption
					array_push($t_arr,$cons_seed);
					$money_spend                = $cropRow['f14_spend_money'];
					array_push($t_arr,$money_spend);
					$ferti_brand                = $cropRow['f14_brand_of_fertiliser'];
					array_push($t_arr,$ferti_brand);
					$money_spend_on_ferti       = $cropRow['f14_spend_money_fertiliser'];
					array_push($t_arr,$money_spend_on_ferti);
					$pesticide_brand            = $cropRow['f14_brand_of_pesticide'];
					array_push($t_arr,$pesticide_brand);
					$consumption_pesticide      = $cropRow['f14_consumption_pesticides'];
					array_push($t_arr,$consumption_pesticide);
					$money_spend_on_pesti       = $cropRow['f14_spend_money_pesticide'];
					array_push($t_arr,$money_spend_on_pesti);
					$other_inp                  = $cropRow['f14_other_inputs_used'];
					array_push($t_arr,$other_inp);
					$cons_oth_inp               = $cropRow['f14_consumption_other_inputs'];
					array_push($t_arr,$cons_oth_inp);
					$money_spend_on_oth_exp     = $cropRow['f14_spend_money_other_expenses'];
					array_push($t_arr,$money_spend_on_oth_exp);
					$money_spend_on_labour      = $cropRow['f14_spend_money_labour'];
					array_push($t_arr,$money_spend_on_labour);
					$other_farming_exp          = $cropRow['f14_other_farming_expenses'];
					array_push($t_arr,$other_farming_exp);
					$money_spend_on_farming_exp = $cropRow['f14_spend_money_farming_expenses'];
					array_push($t_arr,$money_spend_on_farming_exp);
					$spend_money_total          = $cropRow['f14_spend_money_total'];
					array_push($t_arr,$spend_money_total);

					array_push($fore_crop_arr,$t_arr);
					$no_of_crop++;
				}
			}
		}

		if(count($land_arr)>count($curr_crop_arr) ){
			$total_row = count($land_arr);
		}else
		{
			$total_row = count($curr_crop_arr);
		}
		$total_row = max(count($land_arr),count($curr_crop_arr),count($prev_crop_arr),count($fore_crop_arr));

		for($i=0;$i<$total_row;$i++)
		{
			$temp_arr = array();
			for($j=0;$j<14;$j++){
				array_push($temp_arr,@$personalDetail[$i][$j]);
			}

			for($k=0;$k<=22;$k++)
			{
				array_push($temp_arr,@$land_arr[$i][$k]);
			}

			for($l=0;$l<37;$l++)
			{
				array_push($temp_arr,@$curr_crop_arr[$i][$l]);
			}

			for($m=0;$m<37;$m++)
			{
				array_push($temp_arr,@$prev_crop_arr[$i][$m]);
				var_dump(@$prev_crop_arr[$i][$m]);
			}

			for($n=0;$n<37;$n++)
			{
				array_push($temp_arr,@$fore_crop_arr[$i][$n]);
				var_dump(@$prev_crop_arr[$i][$n]);
			}

			array_push($main_arr,$temp_arr);
			
		}

		$sr_no++;

		// array_push($farmerData,$personalDetail);
	}// for end


	$writer1->setAuthor('Satish');
	$writer1->writeSheet($main_arr,'demo',$header);
	$timestamp			= date('mdYhis', time());
	$writer1->writeToFile('excel_download/_'.$timestamp.'.xlsx');
    //===============================For Farmer Detail===========================//
?>
  <script type="text/javascript">
  	window.open('excel_download/_<?php echo $timestamp ?>.xlsx');
  </script>

