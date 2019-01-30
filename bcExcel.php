<?php

	include('include/connection.php');
    include('getExcelHeader.php');
	$feature_name  = 'Farmer Details';
	$home_name     = "Home";
	$title		   = 'Farmer Details';
	$home_url      = "home.php";
	$filename      = 'view_farmers.php';
	$fm_id         = '100580';
	
	include('xlsxwriter.class.php');
   
    $writer1 			= new XLSXWriter();
	$excelHeaders       = new excelHeaders();
	$Filter             = new Filter();

	if($fm_id == "" && (!isset($_SESSION['sqyard_user'])) && $_SESSION['sqyard_user']=="")
    {
        ?>
        <script type="text/javascript">
            history.go(-1);
        </script>
        <?php
    }
	


	$avg_of_points	= '';
	$result = lookup_value('tbl_points',array(),array("fm_id"=>$fm_id),array(),array(),array());
	if($result)
	{
		$num	= mysqli_num_rows($result);
		if($num != 0)
		{
			$pt_row	= mysqli_fetch_array($result);

			$sum_of_points	= $pt_row['pt_frm1'] + $pt_row['pt_frm2'] + $pt_row['pt_frm3'] + $pt_row['pt_frm4'] + $pt_row['pt_frm5'] + $pt_row['pt_frm7'] + $pt_row['pt_frm8'] + $pt_row['pt_frm8_fh'] + $pt_row['pt_frm9'] + $pt_row['pt_frm10'] + $pt_row['pt_frm11'] + $pt_row['pt_frm12'] + $pt_row['pt_frm13'] + $pt_row['pt_frm14']; // $pt_row['pt_frm6'] + 
	
			// $avg_of_points	= $sum_of_points / 15;
			$avg_of_points	= $sum_of_points / 14;
		}
	}
	
	
	
	$res_get_farmer_info = lookup_value('tbl_farmers',array(),array("fm_id"=>$fm_id),array(),array(),array());
	if($res_get_farmer_info)
	{
		$num_get_farmer_info	= mysqli_num_rows($res_get_farmer_info);
		if($num_get_farmer_info != 0)
		{
			$row_get_farmer_info	= mysqli_fetch_array($res_get_farmer_info);
		}
	}
	
	$farmer_name          = ucwords($row_get_farmer_info['fm_name']);
	$farmer_mobile_number = $row_get_farmer_info['fm_mobileno'];
	$farmer_ca_id         = $row_get_farmer_info['fm_caid'];
	

	$tbl_arr        = array('tbl_spouse_details',
							'tbl_applicant_knowledge',
							'tbl_applicant_phone'
							);

	$func_arr       = array('spouseHeader',
							'appliKnowHeader',
							'appliPhoneHeader'
							);

	$sheet_name_arr = array('Spouse Detail',
							'Applicant Phone',
							'Applicant Phone'
							);

	$n = 0;
	foreach ($tbl_arr as $table) {
		$res    = lookup_value($table,array(),array("fm_id"=>$fm_id));
		if($res)
		{
        	$num = mysqli_num_rows($res);
        	if($num != 0)
        	{
				$row       = mysqli_fetch_assoc($res);
				$main_data = $Filter->filterData($func_arr[$n],$row);
				$header    = $excelHeaders->$func_arr[$n]();
		        writeSheet($header,array($main_data),$sheet_name_arr[$n]);
		    }
		}

		if($n==1)	{
			break;
		}
		$n++;
		
	}

 //    $res_spouse_details     = lookup_value('tbl_spouse_details',array(),array("fm_id"=>$fm_id),array(),array(),array());
 //    if($res_spouse_details)
 //    {
 //        $num_spouse_details = mysqli_num_rows($res_spouse_details);

 //        if($num_spouse_details != 0)
 //        {
 //            $row_spouse_details = mysqli_fetch_assoc($res_spouse_details);
	// 	}

	// 	$main_data = $Filter->filterData('spouseHeader',$row_spouse_details);
	// 	$header    = $excelHeaders->spouseHeader();
 //        writeSheet($header,array($main_data),'Spouse Detail');
	// }
	
	// $res_applicant_knowledge = lookup_value('tbl_applicant_knowledge',array(),array("fm_id"=>$fm_id),array(),array(),array());
	// if($res_applicant_knowledge)
	// {
	// 	$num_applicant_knowledge    = mysqli_num_rows($res_applicant_knowledge);
	// 	if($num_applicant_knowledge !=0)
	// 	{
	// 		$row_applicant_knowledge  = mysqli_fetch_assoc($res_applicant_knowledge);
	// 	}

	// 	$header    = $excelHeaders->appliKnowHeader();
	// 	$data = $Filter->filterData('appliKnowHeader',$row_applicant_knowledge);
	// 	writeSheet($header,array($data),'Applicant Knowledge');
	// }
	
	// $res_applicant_phone = lookup_value('tbl_applicant_phone',array(),array("fm_id"=>$fm_id),array(),array(),array());
	// if($res_applicant_phone)
	// {
	// 	$num_applicant_phone    = mysqli_num_rows($res_applicant_phone);
	// 	if($num_applicant_phone != 0)
	// 	{
	// 		$row_applicant_phone = mysqli_fetch_assoc($res_applicant_phone);
	// 		$header              = $excelHeaders->appliPhoneHeader();
	// 		$main_data                = $Filter->filterData('appliPhoneHeader',$row_applicant_phone);

	// 		print_r(implode(',',$header));
	// 		echo '<br><br>';
	// 		print_r(implode(',',$main_data));

	// 		writeSheet($header,array($main_data),'Applicant Phone');

			

	// 	}
	// }
	// writeExcel();
	
	$res_family_details = lookup_value('tbl_family_details',array(),array("fm_id"=>$fm_id),array(),array(),array());
	if($res_family_details)
	{
		$num_family_details    = mysqli_num_rows($res_family_details);
		if($num_family_details !=0)
		{
			$row_family_details       = mysqli_fetch_assoc($res_family_details);
			$header              = $excelHeaders->appliFamilyHeader();
			$data                = $Filter->filterData('appliFamilyHeader',$row_family_details);
			writeSheet($header,array($data),'Family Detail');
		}
	}
	
	$res_residence_details = lookup_value('tbl_residence_details',array(),array("fm_id"=>$fm_id),array(),array(),array());
	if($res_residence_details)
	{
		$num_residence_details    = mysqli_num_rows($res_residence_details);
		if($num_residence_details !=0)
		{
			$row_residence_details    = mysqli_fetch_assoc($res_residence_details);
			$header              = $excelHeaders->applianceHeader();
			$data                = $Filter->filterData('applianceHeader',$row_residence_details);
			writeSheet($header,array($data),'Appliances');
		}
	}
	
	$no_of_land	= 1;
	$land_arr  	= array();
	$res_land_details 	= lookup_value('tbl_land_details',array(),array("fm_id"=>$fm_id),array(),array(),array());
	if($res_land_details)
	{
		$num_land_details    = mysqli_num_rows($res_land_details);
		if($num_land_details != 0)
		{
			while($row_land_details	= mysqli_fetch_array($res_land_details))
			{
				array_push($land_arr ,$row_land_details);
				print_r($land_arr);
			}
			$no_of_land = sizeof($land_arr);
		}
	}
	
	$no_of_crops	= 1;
	$crops_arr  	= array();
	$res_cultivation_data = lookup_value('tbl_cultivation_data',array(),array("fm_id"=>$fm_id),array(),array(),array());
	if($res_cultivation_data)
	{
		while($row_cultivation_data = mysqli_fetch_array($res_cultivation_data))
		{
			array_push($crops_arr ,$row_cultivation_data);
		}
		$no_of_crops = sizeof($crops_arr);
	}
	
	$no_of_prev_crops	= 1;
	$prev_crops_arr		= array();
	$res_yield_details 	= lookup_value('tbl_yield_details',array(),array("fm_id"=>$fm_id),array(),array(),array());
	if($res_yield_details)
	{
		while($row_yield_details = mysqli_fetch_array($res_yield_details))
		{
		  array_push($prev_crops_arr ,$row_yield_details);
		}
		$no_of_prev_crops = sizeof($prev_crops_arr);
	}
	
	$no_of_cur_crops	= 1;
	$cur_crops_arr		= array();
	$res_current_crop_forecast 	= lookup_value('tbl_current_crop_forecast',array(),array("fm_id"=>$fm_id),array(),array(),array());
	if($res_current_crop_forecast)
	{
		while($row_current_crop_forecast = mysqli_fetch_array($res_current_crop_forecast))
		{
		  array_push($cur_crops_arr ,$row_current_crop_forecast);
		}
		$no_of_cur_crops = sizeof($cur_crops_arr);
	}
	
	$res_asset_details	= lookup_value('tbl_asset_details',array(),array("fm_id"=>$fm_id),array(),array(),array());
	if($res_asset_details)
	{
		$num_asset_details	= mysqli_num_rows($res_asset_details);
		if($num_asset_details != 0)
		{
			$row_asset_details = mysqli_fetch_assoc($res_asset_details);
			$header            = $excelHeaders->assetHeader();
			$data              = $Filter->filterData('assetHeader',$row_asset_details);
			writeSheet($header,array($data),'Assets');

		}
		
	}
	
	$res_livestock_details = lookup_value('tbl_livestock_details',array(),array("fm_id"=>$fm_id),array(),array(),array());
	if($res_livestock_details)
	{
		$num_livestock_details    = mysqli_num_rows($res_livestock_details);
		if($num_livestock_details != 0)
		{
			$row_livestock_details = mysqli_fetch_assoc($res_livestock_details);
			$header                = $excelHeaders->livestockHeader();
			$data                  = $Filter->filterData('livestockHeader',$row_livestock_details);
			writeSheet($header,array($data),'Livestock');
		}
	}
	
	$no_of_loan	= "";
	$loan_arr  	= array();
	
	$res_loan_details	= lookup_value('tbl_loan_details',array(),array("fm_id"=>$fm_id),array(),array(),array());
	if($res_loan_details)
	{
		$num    = mysqli_num_rows($res_loan_details);
		if($num !=0)
		{
			$row_loan_details                     = mysqli_fetch_array($res_loan_details);
			$data['fx_monthly_income']            = $row_loan_details['fx_monthly_income'];
			$data['f8_loan_taken']                = $row_loan_details['f8_loan_taken'];
			$data['f8_points']                    = $row_loan_details['f8_points'];
			
			
			$data['f8_crop_insurance']            = $row_loan_details['f8_crop_insurance'];
			$data['f8_insurance_amount']          = $row_loan_details['f8_insurance_amount'];
			$data['f8_insurer_name']              = $row_loan_details['f8_insurer_name'];
			
			$data['f8_any_subsidies']             = $row_loan_details['f8_any_subsidies'];
			$data['f8_subsidy_name']              = $row_loan_details['f8_subsidy_name'];
			$data['f8_any_loan_waivers']          = $row_loan_details['f8_any_loan_waivers'];
			$data['f8_waiver_name']               = $row_loan_details['f8_waiver_name'];
			$data['f8_financial_history_points']  = $row_loan_details['f8_financial_history_points'];
			
			$loan_result     = lookup_value('tbl_bank_loan_detail',array(),array("fk_loan_detailsid"=>$row_loan_details['id']),array(),array(),array());
			
			if($loan_result)
			{
				while($ln_row = mysqli_fetch_array($loan_result))
				{
					array_push($loan_arr ,$ln_row);
				}
				$no_of_loan = sizeof($loan_arr);
			}
		}
	}
	
    $sql_chk_married_status = " SELECT * FROM `tbl_spouse_details` WHERE `fm_id`='".$fm_id."' ";
    $res_chk_married_status = mysqli_query($db_con, $sql_chk_married_status) or die(mysqli_error($db_con));
    $row_chk_married_status = mysqli_fetch_array($res_chk_married_status);

    $married_status     = $row_chk_married_status['f3_married'];

   




	
	writeExcel();

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
		$writer1->writeToFile('product_sheet_.xlsx');
	}
	
?>

