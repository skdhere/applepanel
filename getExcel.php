<?php

	include('include/connection.php');
	include('include/query-helper.php');
    include('getExcelHeader.php');
	include('xlsxwriter.class.php');
   
    if(isset($_POST) && !empty($_POST['batch']))
    {
    	$fm_ids  = $_POST['batch'];
    }

	$writer1          = new XLSXWriter();
	$excelHeaders     = new excelHeaders();
	$Filter           = new Filter();
	
	// $fm_ids           = array(100021,
	// 						  100026,
	// 						  100031,
	// 						  100036,
	// 						  100101,
	// 						  100180,
	// 						  100181,
	// 						  100481,
	// 						  100185,
	// 						  100572,
	// 						  100557,
	// 						  100037,
	// 						  100038,
	// 						  100046,
	// 						  100555,
	// 						  100054,
	// 						  100056,
	// 						  100003,
	// 						  100059,
	// 						  100066,
	// 						  100067,
	// 						  100071,
	// 						  100086,
	// 						  100093,
	// 						  100158,
	// 						  100409,
	// 						  100407,
	// 						  100379,
	// 						  100117,
	// 						  100146,
	// 						  100175,
	// 						  100283,
	// 						  100405,
	// 						  100284,
	// 						  100410,
	// 						  100174,
	// 						  100445,
	// 						  100552,
	// 						  100556,
	// 						  100431,
	// 						  100368,
	// 						  100152,
	// 						  100403,
	// 						  100344,
	// 						  100161,
	// 						  100258,
	// 						  100168,
	// 						  100251,
	// 						  100107,
	// 						  100169,
	// 						  100308,
	// 						  100004,
	// 						  100006,
	// 						  100262,
	// 						  100135,
	// 						  100009,
	// 						  100268,
	// 						  100270,
	// 						  100160,
	// 						  100060,
	// 						  100278,
	// 						  100167,
	// 						  100442,
	// 						  100162,
	// 						  100461,
	// 						  100236,
	// 						  100446,
	// 						  100373,
	// 						  100560,
	// 						  100309,
	// 						  100044,
	// 						  100323,
	// 						  100413,
	// 						  100105,
	// 						  100329,
	// 						  100350,
	// 						  100118,
	// 						  100336,
	// 						  100360,
	// 						  100337,
	// 						  100137,
	// 						  100007,
	// 						  100396,
	// 						  100215,
	// 						  100093,
	// 						  100010,
	// 						  100249,
	// 						  100005,
	// 						  100468,
	// 						  100416,
	// 						  100178,
	// 						  100287,
	// 						  100008,
	// 						  100294,
	// 						  100412,
	// 						  100017,
	// 						  100018,
	// 						  100019,
	// 						  100024,
	// 						  100028,
	// 						  100034,
	// 						  100035,
	// 						  100342
	// 						);
	
	$farmerHeader     = array();
	$farmerData       = array();
	
	$spouseHeader     = array();
	$spouseData       = array();
	
	$appKnowHeader    = array();
	$appKnowData      = array();
	
	$appPhoneHeader   = array();
	$appPhoneData     = array();
	
	$appFamilyHeader  = array();
	$appFamilyData    = array();
	
	$applianceHeader  = array();
	$applianceData    = array();
	
	$assetData        = array();
	$assetHeader      = array();
	
	$livestockData    = array();
	$livestockHeader  = array();
	
	$landHeader       = array();
	$landData         = array();
	
	$loanData         = array();
	$loanHeader       = array();
	
	$loanDetailData   = array();
	$loanDetailHeader = array();
	
	$financialHeader  = array();
	$financialData    = array();
	
	$cropHeader       = array();
	$cropData         = array();
	
	$prevCropHeader   = array();
	$prevCropData     = array();
	
	$forecastHeader   = array();
	$forecastData     = array();
	
	$addHeader        = array();
	$addData          = array();
	
	$count            = 1;


    foreach ($fm_ids as $fm_id) {
    	
    	
    	// ==============================start Farmer detail========================//
		$result = lookup_value('tbl_farmers',array(),array("fm_id"=>$fm_id));
		$row    = mysqli_fetch_assoc($result);

		$row['sr_no']                   = count($farmerData)+1;
		$row['org_name']                = lookup_value('tbl_organization',array('org_name'),array("id"=>$row['fm_org_id']));
		$row['ca_name']                 = lookup_value('tbl_change_agents',array('fname'),array("id"=>$row['fm_caid']));
		$row['f1_father']               = lookup_value('tbl_personal_detail',array('f1_father'),array("fm_id"=>$row['fm_id']));
		$row['f1_mfname']               = lookup_value('tbl_personal_detail',array('f1_mfname'),array("fm_id"=>$row['fm_id']));
		
		$row['f1_dob']                  = lookup_value('tbl_personal_detail',array('f1_dob'),array("fm_id"=>$row['fm_id']));
		$row['f1_age']                  = lookup_value('tbl_personal_detail',array('f1_age'),array("fm_id"=>$row['fm_id']));
		$row['f1_expfarm']              = lookup_value('tbl_personal_detail',array('f1_expfarm'),array("fm_id"=>$row['fm_id']));
		$row['f1_expfarm']              = lookup_value('tbl_personal_detail',array('f1_expfarm'),array("fm_id"=>$row['fm_id']));
		$row['f1_any_other_occupation'] = lookup_value('tbl_personal_detail',array('f1_any_other_occupation'),array("fm_id"=>$row['fm_id']));
		$row['f1_occupation_amt']       = lookup_value('tbl_personal_detail',array('f1_occupation_amt'),array("fm_id"=>$row['fm_id']));
		$row['f1_loan_purpose']         = lookup_value('tbl_personal_detail',array('f1_loan_purpose'),array("fm_id"=>$row['fm_id']));
		$row['f1_crop_cycle']           = lookup_value('tbl_personal_detail',array('f1_crop_cycle'),array("fm_id"=>$row['fm_id']));
		$row['ddl_married_status']      = lookup_value('tbl_spouse_details',array('f3_married'),array("fm_id"=>$row['fm_id']));
		$row['f7_resistatus']           = lookup_value('tbl_residence_details',array('f7_resistatus'),array("fm_id"=>$row['fm_id']));
		$row['f7_rent_amount']          = lookup_value('tbl_residence_details',array('f7_rent_amount'),array("fm_id"=>$row['fm_id']));

		if($row['fm_status'] == 1)
		{
			$row['fm_status'] = 'Active';
		}else
		{
			$row['fm_status']   = 'Inactive';
		}

		$data   = $Filter->filterExtraData('farmerHeader',$row);
		array_push($farmerData,$data);
		if(empty($farmerHeader))
		{
			$farmerHeader  = $Filter->filterExtraHeader('farmerHeader',$row);
		}
		
		//=========================================================================//
		//======================Start Residence Detail==========================//
		$res    = lookup_value('tbl_residence_details',array(),array("fm_id"=>$fm_id));
	    if($res)
	    {
	        $num = mysqli_num_rows($res);

	        if($num != 0)
	        {
				$row             = mysqli_fetch_assoc($res);
				$row['sr_no']    = count($addData)+1;

				$row['f7_cvillage']  = lookup_value('tbl_village',array('vl_name'),array("id"=>$row['f7_cvillage']));
				$row['f7_ctaluka']   = lookup_value('tbl_taluka',array('tk_name'),array("id"=>$row['f7_ctaluka']));
				$row['f7_cdistrict'] = lookup_value('tbl_district',array('dt_name'),array("id"=>$row['f7_cdistrict']));
				$row['f7_cstate']    = lookup_value('tbl_state',array('st_name'),array("id"=>$row['f7_cstate']));

				$row['f7_pvillage']  = lookup_value('tbl_village',array('vl_name'),array("id"=>$row['f7_pvillage']));
				$row['f7_ptaluka']   = lookup_value('tbl_taluka',array('tk_name'),array("id"=>$row['f7_ptaluka']));
				$row['f7_pdistrict'] = lookup_value('tbl_district',array('dt_name'),array("id"=>$row['f7_pdistrict']));
				$row['f7_pstate']    = lookup_value('tbl_state',array('st_name'),array("id"=>$row['f7_pstate']));
				
				$row['a_type'] = 'Current ';
				$data          = $Filter->filterExtraData('caddressHeader',$row);
				array_push($addData,$data);

				$row['a_type'] = 'Permanent ';
				$row['sr_no']  = count($addData)+1;
				$data          = $Filter->filterExtraData('paddressHeader',$row);
				array_push($addData,$data);

				if(empty($addHeader))
				{
					$addHeader  = $Filter->filterExtraHeader('paddressHeader',$row);
				}
			}
		}

		//=========================================================================//
		//==============================Start Spouse Detail==========================//
		$res_spouse_details     = lookup_value('tbl_spouse_details',array(),array("fm_id"=>$fm_id));
	    if($res_spouse_details)
	    {
	        $num = mysqli_num_rows($res_spouse_details);

	        if($num != 0)
	        {
				$row            = mysqli_fetch_assoc($res_spouse_details);
				$row['sr_no']   = count($spouseData)+1;
				$row['ca_name'] = lookup_value('tbl_change_agents',array('fname'),array("id"=>$row['fm_caid']));
				
				$data           = $Filter->filterExtraData('spouseHeader',$row);
				array_push($spouseData,$data);

				if(empty($spouseHeader))
				{
					$spouseHeader  = $Filter->filterExtraHeader('spouseHeader',$row);
				}
			}
		}

		//=========================================================================//
		//==============================Start Spouse Detail==========================//
		$res_applicant_knowledge = lookup_value('tbl_applicant_knowledge',array(),array("fm_id"=>$fm_id));
		if($res_applicant_knowledge)
		{
			$num    = mysqli_num_rows($res_applicant_knowledge);
			if($num !=0)
			{
				$row            = mysqli_fetch_assoc($res_applicant_knowledge);
				$row['sr_no']   = count($appKnowData)+1;
				$row['ca_name'] = lookup_value('tbl_change_agents',array('fname'),array("id"=>$row['fm_caid']));
				$data           = $Filter->filterExtraData('appliKnowHeader',$row);
				array_push($appKnowData,$data);
				if(empty($appKnowHeader))
				{
					$appKnowHeader  = $Filter->filterExtraHeader('appliKnowHeader',$row);
				}
			}
		}

		//=========================================================================//
		//==============================Start Phone Detail==========================//
		$res_applicant_phone = lookup_value('tbl_applicant_phone',array(),array("fm_id"=>$fm_id));
		if($res_applicant_phone)
		{
			$num    = mysqli_num_rows($res_applicant_phone);
			if($num != 0)
			{	
				$row            = mysqli_fetch_assoc($res_applicant_phone);
				
				$row['sr_no']   = count($appPhoneData)+1;
				$row['ca_name'] = lookup_value('tbl_change_agents',array('fname'),array("id"=>$row['fm_caid']));
				
				$sql            = " SELECT group_concat(serv_pro_name) as sp FROM `tbl_farmer_servpro` WHERE  fm_id='".$fm_id."' ";
				$res            = mysqli_query($db_con, $sql) or die(mysqli_error($db_con));

				if($res)
				{
					$rw                = mysqli_fetch_array($res);
					$row['f5_servpro'] = $rw['sp'];
				}

				$data         = $Filter->filterExtraData('appliPhoneHeader',$row);
				array_push($appPhoneData,$data);
				if(empty($appPhoneHeader))
				{
					$appPhoneHeader  = $Filter->filterExtraHeader('appliPhoneHeader',$row);
				}
			}
		}

		
		//=========================================================================//
		//==============================Start Family Detail==========================//
		$res = lookup_value('tbl_family_details',array(),array("fm_id"=>$fm_id));
		if($res)
		{
			$num    = mysqli_num_rows($res);
			if($num !=0)
			{
				$row          = mysqli_fetch_assoc($res);
				$row['sr_no'] = count($appFamilyData)+1;
				$data         = $Filter->filterExtraData('appliFamilyHeader',$row);
				array_push($appFamilyData,$data);
				if(empty($appFamilyHeader))
				{
					$appFamilyHeader  = $Filter->filterExtraHeader('appliFamilyHeader',$row);
				}
			}
		}

		//=========================================================================//
		//==============================Start Appliance Detail==========================//
		$res = lookup_value('tbl_residence_details',array(),array("fm_id"=>$fm_id));
		if($res)
		{
			$num  = mysqli_num_rows($res);
			if($num !=0)
			{
				$row          = mysqli_fetch_assoc($res);
				$row['sr_no'] = count($applianceData)+1;
				$data         = $Filter->filterExtraData('applianceHeader',$row);
				array_push($applianceData,$data);
				if(empty($applianceHeader))
				{
					$applianceHeader  = $Filter->filterExtraHeader('applianceHeader',$row);
				}
			}
		}

		//=========================================================================//
		//==============================Start Assets Detail==========================//
		$res	= lookup_value('tbl_asset_details',array(),array("fm_id"=>$fm_id));
		if($res)
		{
			$num	= mysqli_num_rows($res);
			if($num != 0)
			{
				$row = mysqli_fetch_assoc($res);
				$row['sr_no'] = count($assetData)+1;
				$data         = $Filter->filterExtraData('assetHeader',$row);
				array_push($assetData,$data);
				if(empty($assetHeader))
				{
					$assetHeader  = $Filter->filterExtraHeader('assetHeader',$row);
				}
			}
		}

		//=========================================================================//
		//==============================Start Assets Detail==========================//
		$res = lookup_value('tbl_livestock_details',array(),array("fm_id"=>$fm_id));
		if($res)
		{
			$num    = mysqli_num_rows($res);
			if($num != 0)
			{
				$row          = mysqli_fetch_assoc($res);
				$row['sr_no'] = count($livestockData)+1;
				$data         = $Filter->filterExtraData('livestockHeader',$row);
				array_push($livestockData,$data);
				if(empty($livestockHeader))
				{
					$livestockHeader  = $Filter->filterExtraHeader('livestockHeader',$row);
				}
			}
		}

		//=========================================================================//
		//==============================Start Land Detail==========================//
		$res 	= lookup_value('tbl_land_details',array(),array("fm_id"=>$fm_id));
		if($res)
		{
			$num = mysqli_num_rows($res);
			if($num != 0)
			{
				$no_of_land	= 1;
				while($row	= mysqli_fetch_assoc($res))
				{
					$row['sr_no']       = count($landData)+1;
					$row['f9_vilage']   = lookup_value('tbl_village',array('vl_name'),array("id"=>$row['f9_vilage']));
					$row['f9_taluka']   = lookup_value('tbl_taluka',array('tk_name'),array("id"=>$row['f9_taluka']));
					$row['f9_district'] = lookup_value('tbl_district',array('dt_name'),array("id"=>$row['f9_district']));
					$row['f9_state']    = lookup_value('tbl_state',array('st_name'),array("id"=>$row['f9_state']));

					$sql	= " SELECT group_concat(water_source) as wname FROM `tbl_water_source` WHERE `status`='1' AND water_source IN (SELECT DISTINCT(water_source_name) FROM tbl_f9_farmer_water_source WHERE fm_id='".$fm_id."' AND count='".$no_of_land."') ";
					$res1    = mysqli_query($db_con, $sql) or die(mysqli_error($db_con));

					if($res1)
					{
						$rw                        = mysqli_fetch_array($res1);
						$row['f9_source_of_water'] = $rw['wname'];
					}
					$data         = $Filter->filterExtraData('landHeader',$row);
					array_push($landData,$data);
					if(empty($landHeader))
					{
						$landHeader  = $Filter->filterExtraHeader('landHeader',$row);
					}

					$no_of_land++;
				}
			}
		}

		$res = lookup_value('tbl_loan_details',array(),array("fm_id"=>$fm_id));
		if($res)
		{
			$num = mysqli_num_rows($res);
			if($num !=0)
			{
				$row          = mysqli_fetch_assoc($res);
				$row['sr_no'] = count($loanData)+1;
				$data         = $Filter->filterExtraData('loanHeader',$row);
				array_push($loanData,$data);
				if(empty($loanHeader))
				{
					$loanHeader = $Filter->filterExtraHeader('loanHeader',$row);
				}

				$row['sr_no'] = count($financialData)+1;
				$data         = $Filter->filterExtraData('financeHeader',$row);
				array_push($financialData,$data);
				if(empty($financialHeader))
				{
					$financialHeader = $Filter->filterExtraHeader('financeHeader',$row);
				}
			}
		}

		$loan_result = lookup_value('tbl_bank_loan_detail',array(),array("fm_id"=>$fm_id));
			
		if($loan_result)
		{
			while($ln_row = mysqli_fetch_assoc($loan_result))
			{
				$ln_row['sr_no'] = count($loanDetailData)+1;
				$data            = $Filter->filterExtraData('loanDetailHeader',$ln_row);
				array_push($loanDetailData,$data);
				if(empty($loanDetailHeader))
				{
					$loanDetailHeader = $Filter->filterExtraHeader('loanDetailHeader',$ln_row);
				}
			}
		}

		$res = lookup_value('tbl_cultivation_data',array(),array("fm_id"=>$fm_id));
		if($res)
		{ 
			$head      = array();
			$dum_arr   = array();
			$main_data = array();
			$count     = 1;
		    $no_of_crops	= 1;
			while($row = mysqli_fetch_assoc($res))
			{
				$sql1 = " SELECT group_concat(water_source) as wname FROM `tbl_water_source` WHERE `status`='1' AND water_source IN (SELECT DISTINCT(water_source_name) FROM tbl_f10_farmer_water_source WHERE fm_id='".$fm_id."' AND count='".$no_of_crops."') ";
				$res1 = mysqli_query($db_con, $sql1) or die(mysqli_error($db_con));

				if($res1)
				{
					$rw                       = mysqli_fetch_array($res1);
					$row['water_source_name'] = $rw['wname'];
				}

				$row['f10_cultivating'] = lookup_value('tbl_crops',array('crop_name'),array("crop_id"=>$row['f10_cultivating']));
				$row['sr_no']           = count($cropData) + 1;
				$data                   = $Filter->filterExtraData('cropCultHeader',$row);
				array_push($cropData,$data);
				if(empty($cropHeader))
				{
					$cropHeader = $Filter->filterExtraHeader('cropCultHeader',$row);
				}

				$no_of_crops++;
			}
		}

		$res = lookup_value('tbl_yield_details',array(),array("fm_id"=>$fm_id));
		if($res)
		{	
			$no_of_prev_crops	= 1;
			
			while($row = mysqli_fetch_assoc($res))
			{
				$sql1	= " SELECT group_concat(water_source) as wname FROM `tbl_water_source` WHERE `status`='1' AND water_source IN (SELECT DISTINCT(water_source_name) FROM tbl_f11_farmer_water_source WHERE fm_id='".$fm_id."' AND count='".$no_of_prev_crops."') ";
				$res1    = mysqli_query($db_con, $sql1) or die(mysqli_error($db_con));

				if($res1)
				{
					$rw                       = mysqli_fetch_array($res1);
					$row['water_source_name'] = $rw['wname'];
				}

				$row['sr_no']           = count($prevCropData) + 1;
				$row['f11_cultivating'] = lookup_value('tbl_crops',array('crop_name'),array("crop_id"=>$row['f11_cultivating']));
				
				$data = $Filter->filterExtraData('yieldHeader',$row);
				array_push($prevCropData,$data);
				if(empty($prevCropHeader))
				{
					$prevCropHeader  = $Filter->filterExtraHeader('yieldHeader',$row);
				}
				$no_of_prev_crops++;
			}
		}

		$res = lookup_value('tbl_current_crop_forecast',array(),array("fm_id"=>$fm_id));
		if($res)
		{
			$no_of_cur_crops	= 1;
			
			while($row = mysqli_fetch_assoc($res))
			{	
				$sql1	= " SELECT group_concat(water_source) as wname FROM `tbl_water_source` WHERE `status`='1' AND water_source IN (SELECT DISTINCT(water_source_name) FROM tbl_f14_farmer_water_source WHERE fm_id='".$fm_id."' AND count='".$no_of_cur_crops."') ";
				$res1    = mysqli_query($db_con, $sql1) or die(mysqli_error($db_con));

				if($res1)
				{
					$rw                         = mysqli_fetch_array($res1);
					$row['water_source_name'] = $rw['wname'];
				}
				$row['sr_no']           = count($forecastData) + 1;
				$row['f14_cultivating'] = lookup_value('tbl_crops',array('crop_name'),array("crop_id"=>$row['f14_cultivating']));
				$data                   = $Filter->filterExtraData('forecastHeader',$row);
				array_push($forecastData,$data);
				if(empty($forecastHeader))
				{
					$forecastHeader  = $Filter->filterExtraHeader('forecastHeader',$row);
				}
				$no_of_cur_crops++;
			}
		}
	}// for end

    //===============================For Farmer Detail===========================//

   	writeSheet($farmerHeader,$farmerData,'Farmer Detail');
    writeSheet($addHeader,$addData,'Address Detail');
	writeSheet($spouseHeader,$spouseData,'Spouse Detail');
    writeSheet($appKnowHeader,$appKnowData,'Applicant Knowledge');
    writeSheet($appPhoneHeader,$appPhoneData,'Applicant Phone');
    writeSheet($appFamilyHeader,$appFamilyData,'Family Detail');
    writeSheet($applianceHeader,$applianceData,'Appliance Detail');
    writeSheet($assetHeader,$assetData,'Assets Detail');
    writeSheet($livestockHeader,$livestockData,'Livestock Detail');
    writeSheet($landHeader,$landData,'Land Detail');
    writeSheet($cropHeader,$cropData,'Current Crop Detail');
    writeSheet($prevCropHeader,$prevCropData,'Previous year Crop Detail');
    writeSheet($forecastHeader,$forecastData,'Crop cycle forecast');
    writeSheet($loanHeader,$loanData,'Loan');
    writeSheet($loanDetailHeader,$loanDetailData,'Loan Detail');
    writeSheet($financialHeader,$financialData,'Financial History');
    
	$filename = writeExcel();

	echo json_encode(array('Success'=>'Success','resp'=>$filename));
	function writeSheet($header = array(), $main_data = array(), $sheet= "sheet")
	{

		global $writer1;
		$writer1->setAuthor('Satish');
		$writer1->writeSheet($main_data,$sheet,$header);
		
	}
		
	function writeExcel()
	{
		global $writer1;
		
		$timestamp			= date('mdYhis', time());
		$writer1->writeToFile('excel_download/_'.$timestamp.'.xlsx');
		return 'excel_download/_'.$timestamp.'.xlsx';
	}
	
?>

