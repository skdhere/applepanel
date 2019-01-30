
	<?php


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
	

	$tbl_arr        = array('tbl_spouse_details');
	$func_arr       = array('spouseHeader');
	$sheet_name_arr = array('Spouse Detail');

	$n = 0;
	// foreach ($tbl_arr as $table) {
	// 	$res    = lookup_value($table,array(),array("fm_id"=>$fm_id));
	// 	if($res)
	// 	{
 //        	$num = mysqli_num_rows($res);
 //        	if($num != 0)
 //        	{
	// 			$row       = mysqli_fetch_assoc($res);
	// 			$main_data = $Filter->filterData($func_arr[$n],$row);
	// 			$header    = $excelHeaders->$func_arr[$n]();
	// 	        writeSheet($header,array($main_data),$sheet_name_arr[$n]);
 //        	}
	// 	}

	// 	$n++;
	// }


    $res_spouse_details     = lookup_value('tbl_spouse_details',array(),array("fm_id"=>$fm_id),array(),array(),array());
    if($res_spouse_details)
    {
        $num_spouse_details = mysqli_num_rows($res_spouse_details);

        if($num_spouse_details != 0)
        {
            $row_spouse_details = mysqli_fetch_assoc($res_spouse_details);
		}

		$main_data = $Filter->filterData('spouseHeader',$row_spouse_details);
		$header    = $excelHeaders->spouseHeader();
        writeSheet($header,array($main_data),'Spouse Detail');
	}
	
	$res_applicant_knowledge = lookup_value('tbl_applicant_knowledge',array(),array("fm_id"=>$fm_id),array(),array(),array());
	if($res_applicant_knowledge)
	{
		$num_applicant_knowledge    = mysqli_num_rows($res_applicant_knowledge);
		if($num_applicant_knowledge !=0)
		{
			$row_applicant_knowledge  = mysqli_fetch_assoc($res_applicant_knowledge);
		}

		$header    = $excelHeaders->appliKnowHeader();
		$data = $Filter->filterData('appliKnowHeader',$row_applicant_knowledge);
		writeSheet($header,array($data),'Applicant Knowledge');
	}
	
	$res_applicant_phone = lookup_value('tbl_applicant_phone',array(),array("fm_id"=>$fm_id),array(),array(),array());
	if($res_applicant_phone)
	{
		$num_applicant_phone    = mysqli_num_rows($res_applicant_phone);
		if($num_applicant_phone != 0)
		{
			$row_applicant_phone = mysqli_fetch_assoc($res_applicant_phone);
			$header              = $excelHeaders->appliPhoneHeader();
			$data                = $Filter->filterData('appliPhoneHeader',$row_applicant_phone);
			writeSheet($header,array($data),'Applicant Phone');

		}
	}
	
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
			while($row_land_details	= mysqli_fetch_assoc($res_land_details))
			{
				array_push($land_arr ,$row_land_details);
				
			}

			$main_header = array();
			$main_data   = array();

			foreach ($land_arr as $land) {

				$land['fm_caid']  = lookup_value('tbl_change_agents',array('fname'),array("id"=>$land['fm_caid']));
				$land['f9_vilage'] = lookup_value('tbl_village',array('vl_name'),array("id"=>$land['f9_vilage']));
				$land['f9_taluka'] = lookup_value('tbl_taluka',array('tk_name'),array("id"=>$land['f9_taluka']));
				$land['f9_district'] = lookup_value('tbl_district',array('dt_name'),array("id"=>$land['f9_district']));
				$land['f9_state'] = lookup_value('tbl_state',array('st_name'),array("id"=>$land['f9_state']));


				$data     = $Filter->filterExtraData('landHeader',$land);
				$header1  = $Filter->filterExtraHeader('landHeader',$land);

				if(count($main_header)==0)
				{
					$header    = $header1;
					array_push($main_header , $header1);
				}else
				{
					
					$arr       = array();

					$dum_arr   = array();
					foreach ($header as $key => $value) {

						array_push($dum_arr, '');
						array_push($arr, $key);
					}
					array_push($main_data ,$dum_arr);
					array_push($main_data ,$dum_arr);
					array_push($main_data ,$arr);
				}
				
				array_push($main_data , $data);
			}
			
			writeSheet($header,$main_data,'Land');
			
			$no_of_land = sizeof($land_arr);
		}
	}
	
	$no_of_crops	= 1;
	$crops_arr  	= array();
	$res_cultivation_data = lookup_value('tbl_cultivation_data',array(),array("fm_id"=>$fm_id),array(),array(),array());
	if($res_cultivation_data)
	{ 
		$head      = array();
		$dum_arr   = array();
		$main_data = array();
		$count     = 1;
		while($row_c = mysqli_fetch_assoc($res_cultivation_data))
		{
			$sql = " SELECT group_concat(water_source) as wname FROM `tbl_water_source` WHERE `status`='1' AND water_source IN (SELECT DISTINCT(water_source_name) FROM tbl_f10_farmer_water_source WHERE fm_id='".$fm_id."' AND count='".$count."') ";
			$res 	= mysqli_query($db_con, $sql) or die(mysqli_error($db_con));

			if($res)
			{
				$rw = mysqli_fetch_array($res);
				$row_c['water_source_name'] = $rw['wname'];
			}

			$row_c['fm_caid']  = lookup_value('tbl_change_agents',array('fname'),array("id"=>$row_c['fm_caid']));
			$row_c['f10_cultivating'] = lookup_value('tbl_crops',array('crop_name'),array("crop_id"=>$row_c['f10_cultivating']));

			$header1  = $Filter->filterExtraHeader('cropCultHeader',$row_c);
			$data     = $Filter->filterExtraData('cropCultHeader',$row_c);
		    
			if(count($head)==0)
			{
				$header    = $header1;
				array_push($head , $header1);
			}else
			{
				$nhead = array();
				foreach ($header1 as $k=>$v) {
					array_push($dum_arr,'');
					array_push($nhead,$k);
				}
				array_push($main_data,$nhead);
			}

			array_push($main_data,$data);
			$count++;
		}

		writeSheet($header,$main_data,'Current Crop Detail');
		$no_of_crops = sizeof($crops_arr);
	}
	
	$no_of_prev_crops	= 1;
	$prev_crops_arr		= array();
	$res_yield_details 	= lookup_value('tbl_yield_details',array(),array("fm_id"=>$fm_id),array(),array(),array());
	if($res_yield_details)
	{	
		$count = 1;
		$head      = array();
		$dum_arr   = array();
		$main_data = array();
		while($row_y = mysqli_fetch_assoc($res_yield_details))
		{

			$sql	= " SELECT group_concat(water_source) as wname FROM `tbl_water_source` WHERE `status`='1' AND water_source IN (SELECT DISTINCT(water_source_name) FROM tbl_f11_farmer_water_source WHERE fm_id='".$fm_id."' AND count='".$count."') ";
			$res    = mysqli_query($db_con, $sql) or die(mysqli_error($db_con));

			if($res)
			{
				$rw = mysqli_fetch_array($res);
				$row_y['water_source_name'] = $rw['wname'];
			}

			$row_y['f11_cultivating'] = lookup_value('tbl_crops',array('crop_name'),array("crop_id"=>$row_y['f11_cultivating']));
			$row_y['fm_caid']         = lookup_value('tbl_change_agents',array('fname'),array("id"=>$row_y['fm_caid']));
		  	

		  	$header1  = $Filter->filterExtraHeader('yieldHeader',$row_y);
		  	$data     = $Filter->filterExtraData('yieldHeader',$row_y);

		  	if(count($head)==0)
			{
				$header    = $header1;
				array_push($head , $header1);
			}else
			{
				$nhead = array();
				foreach ($header1 as $k=>$v) {
					array_push($dum_arr,'');
					array_push($nhead,$k);
				}
				array_push($main_data,$nhead);
			}

			array_push($main_data,$data);
			$count++;
		}

		writeSheet($header,$main_data,'Previous year Crop Detail');
	}
	
	$no_of_cur_crops	= 1;
	$cur_crops_arr		= array();
	$res_current_crop_forecast 	= lookup_value('tbl_current_crop_forecast',array(),array("fm_id"=>$fm_id),array(),array(),array());
	if($res_current_crop_forecast)
	{
		$count = 1;
		$head      = array();
		$dum_arr   = array();
		$main_data = array();
		while($row_f = mysqli_fetch_assoc($res_current_crop_forecast))
		{	
			$sql	= " SELECT group_concat(water_source) as wname FROM `tbl_water_source` WHERE `status`='1' AND water_source IN (SELECT DISTINCT(water_source_name) FROM tbl_f14_farmer_water_source WHERE fm_id='".$fm_id."' AND count='".$count."') ";
			$res    = mysqli_query($db_con, $sql) or die(mysqli_error($db_con));

			if($res)
			{
				$rw                         = mysqli_fetch_array($res);
				$row_f['water_source_name'] = $rw['wname'];
			}

			$row_f['f14_cultivating'] = lookup_value('tbl_crops',array('crop_name'),array("crop_id"=>$row_f['f14_cultivating']));
			$row_f['fm_caid']         = lookup_value('tbl_change_agents',array('fname'),array("id"=>$row_f['fm_caid']));

			// var_dump($row_f);
		    $header1  = $Filter->filterExtraHeader('forecastHeader', $row_f);
		    $data     = $Filter->filterExtraData('forecastHeader', $row_f);

			if(count($head)==0)
			{
				$header    = $header1;
				array_push($head , $header1);
			}else
			{
				$nhead = array();
				foreach ($header1 as $k=>$v) {
					array_push($dum_arr,'');
					array_push($nhead,$k);
				}
				array_push($main_data,$nhead);
			}

			array_push($main_data,$data);
			$count++;
		}
		
		writeSheet($header,$main_data,'Crop cycle forecast');
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
			$row_loan = mysqli_fetch_assoc($res_loan_details);
			$data     = $Filter->filterExtraData('financeHeader',$row_loan);
			$header   = $Filter->filterExtraHeader('financeHeader',$row_loan);
			
			writeSheet($header,array($data),'Financial History');

			$main_data = array();
			$data      = $Filter->filterExtraData('loanHeader',$row_loan);
			$header    = $Filter->filterExtraHeader('loanHeader',$row_loan);

			array_push($main_data,$data);
			
			$loan_result     = lookup_value('tbl_bank_loan_detail',array(),array("fk_loan_detailsid"=>$row_loan['id']));
			
			if($loan_result)
			{
				$head_arr  = array();
				while($ln_row = mysqli_fetch_assoc($loan_result))
				{
					$data      = $Filter->filterExtraData('loanDetailHeader',$ln_row);
					$header1    = $Filter->filterExtraHeader('loanDetailHeader',$ln_row);

					$dum_arr   = array();
					if(count($head_arr)==0)
					{
						foreach ($header1 as $k=>$v) {
							array_push($dum_arr,'');
							array_push($head_arr,$k);
						}
						array_push($main_data,$dum_arr);
						array_push($main_data,$dum_arr);
						array_push($main_data,$head_arr);
					}
					
					array_push($main_data,$data);
				}

				writeSheet($header,$main_data,'Financial Details');
				$no_of_loan = sizeof($loan_arr);
			}
		}
	}
	
    ?>