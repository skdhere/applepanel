<?php
//include('access1.php'); 
include('../../include/connection.php');
include('../../include/query-helper.php');

date_default_timezone_set("Asia/Calcutta");
$dt=date('Y-m-d H:i:s');
$temp_dt=date('d F Y');


require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Punit Panchal');
$pdf->SetTitle('SQ');
$pdf->SetSubject('Complete Entry');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

$pdf->SetHeaderData('', '', 'Sqoreyard Form','');

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}


	$json 	= file_get_contents('php://input');
    $obj 	= json_decode($json);


    $fm_id         = $obj->fm_id;
	
	
	function generatePdf($fm_id,$db_con)
	{
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
		
		
		//echo $avg_of_points;
		
		// Query For getting the Farmer Info
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
		
	    $res_spouse_details     = lookup_value('tbl_spouse_details',array(),array("fm_id"=>$fm_id),array(),array(),array());
	    if($res_spouse_details)
	    {
	        $num_spouse_details = mysqli_num_rows($res_spouse_details);

	        if($num_spouse_details != 0)
	        {
	            $row_spouse_details = mysqli_fetch_array($res_spouse_details);

	            $data['f3_spouse_fname']            = $row_spouse_details['f3_spouse_fname'];
	            $data['f3_spouse_dob']				= $row_spouse_details['f3_spouse_dob'];
	            $data['f3_spouse_age']              = $row_spouse_details['f3_spouse_age'];
	            $data['f3_spouse_mobno']            = $row_spouse_details['f3_spouse_mobno'];
	            $data['f3_spouse_adhno']            = $row_spouse_details['f3_spouse_adhno'];
	           
	            $data['f3_spouse_occp']             = $row_spouse_details['f3_spouse_occp'];
	            
				$data['f3_is_fpo_member'] 			= $row_spouse_details['f3_is_fpo_member'];
	            $data['f3_points']					= $row_spouse_details['f3_points'];
				$data['f3_married_reg_points']		= $row_spouse_details['f3_married_reg_points'];
	        }
	    }
		
		$res_applicant_knowledge = lookup_value('tbl_applicant_knowledge',array(),array("fm_id"=>$fm_id),array(),array(),array());
		if($res_applicant_knowledge)
		{
			$num_applicant_knowledge    = mysqli_num_rows($res_applicant_knowledge);
			if($num_applicant_knowledge !=0)
			{
				$row_applicant_knowledge  = mysqli_fetch_array($res_applicant_knowledge);
				$data['f2_edudetail']     = $row_applicant_knowledge['f2_edudetail'];
				$data['f2_proficiency']   = $row_applicant_knowledge['f2_proficiency'];
				// $data['f2_participation'] = $row_applicant_knowledge['f2_participation'];
				$data['f2_points']        = $row_applicant_knowledge['f2_points'];
				
				$data['f2_typeprog']      = $row_applicant_knowledge['f2_typeprog'];
				$data['f2_condprog']      = $row_applicant_knowledge['f2_condprog'];
				$data['f2_cropprog']      = $row_applicant_knowledge['f2_cropprog'];
				$data['f2_durprog']       = $row_applicant_knowledge['f2_durprog'];
			}
		}
		
		$res_applicant_phone = lookup_value('tbl_applicant_phone',array(),array("fm_id"=>$fm_id),array(),array(),array());
		if($res_applicant_phone)
		{
			$num_applicant_phone    = mysqli_num_rows($res_applicant_phone);
			if($num_applicant_phone != 0)
			{
				$row_applicant_phone      				= mysqli_fetch_array($res_applicant_phone);
				$data['f5_phonetype']     				= $row_applicant_phone['f5_phonetype'];
				//$data['f5_servpro']       				= $row_applicant_phone['f5_servpro'];
				$data['f5_network']       				= $row_applicant_phone['f5_network'];
				$data['f5_datapack']      				= $row_applicant_phone['f5_datapack'];
				$data['f5_datapackname']  				= $row_applicant_phone['f5_datapackname'];
				$data['f5_appuse']        				= $row_applicant_phone['f5_appuse'];
				$data['f5_farmapp']       				= $row_applicant_phone['f5_farmapp'];
				$data['f5_any_one_have_smart_phone']	= $row_applicant_phone['f5_any_one_have_smart_phone'];
				$data['f5_app_name']					= $row_applicant_phone['f5_app_name'];
				$data['f5_points']						= $row_applicant_phone['f5_points'];

			}
			else
			{
				$data['f5_phonetype']     				= '';
				//$data['f5_servpro']       				= '';
				$data['f5_network']       				= '';
				$data['f5_datapack']      				= '';
				$data['f5_datapackname']  				= '';
				$data['f5_appuse']        				= '';
				$data['f5_farmapp']       				= '';
				$data['f5_any_one_have_smart_phone']	= '';
				$data['f5_app_name']					= '';
				$data['f5_points']						= 0;

			}
		}
		
		$res_family_details = lookup_value('tbl_family_details',array(),array("fm_id"=>$fm_id),array(),array(),array());
		if($res_family_details)
		{
			$num_family_details    = mysqli_num_rows($res_family_details);
			if($num_family_details !=0)
			{
				$row_family_details       = mysqli_fetch_array($res_family_details);
				$data['f6_points']        = $row_family_details['f6_points'];
				//$data['f6_jointfamily']   = $row_family_details['f6_jointfamily'];
				$data['f6_members']       = $row_family_details['f6_members'];
				$data['f6_children']      = $row_family_details['f6_children'];
				//$data['f6_smartuse']      = $row_family_details['f6_smartuse'];
			}
			else
			{
				$data['f6_points']        = 0;
				//$data['f6_jointfamily']   = '';
				$data['f6_members']       = '';
				$data['f6_children']      = '';
				//$data['f6_smartuse']      = '';
			}
		}
		
		$res_residence_details = lookup_value('tbl_residence_details',array(),array("fm_id"=>$fm_id),array(),array(),array());
		if($res_residence_details)
		{
			$num_residence_details    = mysqli_num_rows($res_residence_details);
			if($num_residence_details !=0)
			{
				$row_residence_details    = mysqli_fetch_array($res_residence_details);
				
				$data['f7_points']        = @$row_residence_details['f7_points'];
				$data['f7_television']    = @$row_residence_details['f7_television'];
				$data['f7_refrigerator']  = @$row_residence_details['f7_refrigerator'];
				$data['f7_wmachine']      = @$row_residence_details['f7_wmachine'];
				$data['f7_mixer']         = @$row_residence_details['f7_mixer'];
				$data['f7_stove']         = @$row_residence_details['f7_stove'];
				$data['f7_bicycle']       = @$row_residence_details['f7_bicycle'];
				$data['f7_ccylinder']     = @$row_residence_details['f7_ccylinder'];
				$data['f7_fans']          = @$row_residence_details['f7_fans'];
				$data['f7_motorcycle']    = @$row_residence_details['f7_motorcycle'];
				$data['f7_car']           = @$row_residence_details['f7_car'];
				$data['f7_reg_points']    = @$row_residence_details['f7_reg_points'];
				
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
				$row_asset_details					= mysqli_fetch_array($res_asset_details);

				$data['f12_TRACTOR']				= $row_asset_details['f12_TRACTOR'];
				
				$data['f12_Sprayer']				= $row_asset_details['f12_Sprayer'];
				
				$data['f12_Pumps']					= $row_asset_details['f12_Pumps'];
				$data['f12_Protavator']				= $row_asset_details['f12_Protavator'];
				
				$data['f12_Cultivators']			= $row_asset_details['f12_Cultivators'];

				$data['f12_machinery']				= $row_asset_details['f12_machinery'];
				$data['f12_vehicle']				= $row_asset_details['f12_vehicle'];
				$data['f12_total_val_of_vehical']	= $row_asset_details['f12_total_val_of_vehical'];
				$data['f12_total_val_of_machinery']	= $row_asset_details['f12_total_val_of_machinery'];
				$data['f12_any_other_assets']		= $row_asset_details['f12_any_other_assets'];
				$data['f12_name_of_other_assets']	= $row_asset_details['f12_name_of_other_assets'];
				$data['f12_mention_value_of_assets']= $row_asset_details['f12_mention_value_of_assets'];

				$data['f12_points']= $row_asset_details['f12_points'];

			}
			else
			{
				$data['f12_TRACTOR']				= '';
				
				$data['f12_Sprayer']				= '';
				//$data['f12_Rice_Huller']			= '';
				$data['f12_Pumps']					= '';
				$data['f12_Protavator']				= '';
				//$data['f12_Blower']					= '';
				//$data['f12_Cutters']				= '';
				$data['f12_Cultivators']			= '';

				$data['f12_machinery']				= '';
				$data['f12_vehicle']				= '';
				$data['f12_total_val_of_vehical']	= '';
				$data['f12_total_val_of_machinery']	= '';
				$data['f12_any_other_assets']		= '';
				$data['f12_name_of_other_assets']	= '';
				$data['f12_mention_value_of_assets']= '';  

				$data['f12_points']= 0;

			}
		}
		
		$res_livestock_details = lookup_value('tbl_livestock_details',array(),array("fm_id"=>$fm_id),array(),array(),array());
		if($res_livestock_details)
		{
			$num_livestock_details    = mysqli_num_rows($res_livestock_details);
			if($num_livestock_details != 0)
			{
				$row_livestock_details 			= mysqli_fetch_array($res_livestock_details);
				$data['f13_dairy_cattle']		= $row_livestock_details['f13_dairy_cattle'];
				$data['f13_draft_cattle']		= $row_livestock_details['f13_draft_cattle'];
				$data['f13_buffalo']			= $row_livestock_details['f13_buffalo'];
				$data['f13_ox']					= $row_livestock_details['f13_ox'];
				$data['f13_sheep']				= $row_livestock_details['f13_sheep'];
				$data['f13_goat']				= $row_livestock_details['f13_goat'];
				$data['f13_pig']				= $row_livestock_details['f13_pig'];
				$data['f13_poultry']			= $row_livestock_details['f13_poultry'];
				$data['f13_donkeys']			= $row_livestock_details['f13_donkeys'];
				$data['f13_livestock_count']	= $row_livestock_details['f13_livestock_count'];
				$data['f13_livestock_income']	= $row_livestock_details['f13_livestock_income'];
				$data['f13_livestock_income_year']	= $row_livestock_details['f13_livestock_income_year'];

				$data['f13_points']	= $row_livestock_details['f13_points'];

			}
			else
			{
				$data['f13_dairy_cattle']		= '';
				$data['f13_draft_cattle']		= '';
				$data['f13_buffalo']			= '';
				$data['f13_ox']					= '';
				$data['f13_sheep']				= '';
				$data['f13_goat']				= '';
				$data['f13_pig']				= '';
				$data['f13_poultry']			= '';
				$data['f13_donkeys']			= '';
				$data['f13_livestock_count']	= '';
				$data['f13_livestock_income']	= '';
				$data['f13_livestock_income_year']	= '';

				$data['f13_points']	= 0;

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
		
	    // Query for chacking user is married or not
	    $sql_chk_married_status = " SELECT * FROM `tbl_spouse_details` WHERE `fm_id`='".$fm_id."' ";
	    $res_chk_married_status = mysqli_query($db_con, $sql_chk_married_status) or die(mysqli_error($db_con));
	    $row_chk_married_status = mysqli_fetch_array($res_chk_married_status);

	    $married_status     = $row_chk_married_status['f3_married'];
	    
	    $html ='
	    <table id="tbl_farmer" class="table table-bordered" style="width:100%;text-align:center">
            <tbody>
            	<tr>
                	<td><b>Name</b> :'.$farmer_name.'</td>
                	<td><b>Point :</b>'.round($avg_of_points, 2).'</td>
            	</tr>
        		<tr>
        			<th colspan="2" class="text-center">Spouse Details</th>
        		</tr>
            	<tr>
                	<td><b>Spouse Name</b> :'.@$data['f3_spouse_fname'].'</td>
                	<td><b>Spouse Date Of Birth  :</b>'.checkIsset($data['f3_spouse_dob']).'</td>
            	</tr>
            	<tr>
                	<td><b>Mobile no.</b> :'.@$data['f3_spouse_mobno'].'</td>
                	<td><b>Aadhaar no.  :</b> '.checkIsset($data['f3_spouse_adhno']).' </td>
            	</tr>
            	<tr>
                	<td><b>Occupation</b> : '.@$data['f3_spouse_occp'].'</td>
                	<td><b>Is the Spouse also member of the same FPO?  :</b>'. checkIsset($data['f3_is_fpo_member']).'</td>
            	</tr>'; 

            	return $html; ?>

            	<tr>
        			<th colspan="2" class="text-center">Aplicant Knowledge</th>
        		</tr>
        		<tr>
                	<td><b>Educational Qualification Details</b> : <?php echo @$data['f2_edudetail'] ?></td>
                	<td><b>Regional Language Knowledge :</b> <?php echo checkIsset($data['f2_proficiency']); ?> </td>
            	</tr>

            	<tr>
        			<th colspan="2" class="text-center">Phone Details</th>
        		</tr>
        		<tr>
                	<td><b>Type of phone ownership</b> : <?php echo @$data['f5_phonetype'] ?></td>
                	<td><b>Does any of your family member own a Smart Phone? :</b> <?php echo checkIsset($data['f5_any_one_have_smart_phone']); ?> </td>
            	</tr>
            	<tr>
                	<td><b>Service Provider</b> : 
                		<?php
                        // Query For getting the Service Provider list for that user
                        $sql_get_farmer_servpro	= " SELECT * FROM `tbl_farmer_servpro` WHERE `fm_id`='".$fm_id."' ";
                        $res_get_farmer_servpro	= mysqli_query($db_con, $sql_get_farmer_servpro) or die(mysqli_error($db_con));
                        $num_get_farmer_servpro	= mysqli_num_rows($res_get_farmer_servpro);
                        
                        $Service_pro = array();

                        while($row = mysqli_fetch_array($res_get_farmer_servpro))
                        {
                        	array_push($Service_pro, ucwords($row['serv_pro_name']));
                        }

                        ?>
                		<?php echo checkIsset(@implode(',', $Service_pro));?></td>
                	<td><b>Is the Network Good? :</b> <?php echo checkIsset($data['f5_network']); ?> </td>
            	</tr>
            	<?php 
            	if($data['f5_phonetype']=='smartphone')
            	{?>
					<tr>
                	<td><b>Data Pack on Phone</b> : <?php echo @$data['f5_datapack'] ?></td>
                	<td><b>Data pack :</b> <?php echo checkIsset($data['f5_datapackname']); ?> </td>
            	</tr>
            	<tr>
                	<td><b>Use apps regularly</b> : <?php echo @$data['f5_appuse'] ?></td>
                	<td><b>Subscriptions to Farming Advisory Apps? :</b> <?php echo checkIsset($data['f5_app_name']); ?> </td>
            	</tr>
            	<?php
            	if($data['f5_appuse']=='yes')
            	{?>
            		<tr>
                    	<td colspan="2"><b>App regularly  use</b> : <?php echo @$data['f5_farmapp'] ?></td>
                	</tr>
            	<?php
            	}
            	?>

            	<?php }
            	?>
            	<!-- End Phonr detail -->
            	<tr>
        			<th colspan="2" class="text-center">Family Details</th>
        		</tr>
        		<tr>
                	<td><b>Members in family?</b> : <?php echo @$data['f6_members'] ?></td>
                	<td><b>Number of Children :</b> <?php echo checkIsset($data['f6_children']); ?> </td>
            	</tr>

            	<tr>
        			<th colspan="2" class="text-center">Appliance / Motors Detail</th>
        		</tr>
        		<tr>
                	<td><b>Television</b> : <?php echo checkIsset(@$data['f7_television']); ?></td>
                	<td><b>Refrigerator:</b> <?php echo checkIsset($data['f7_refrigerator']); ?> </td>
            	</tr>
            	<tr>
                	<td><b>Washing Machine?</b> : <?php echo checkIsset(@$data['f7_wmachine']); ?></td>
                	<td><b>Mixer :</b> <?php echo checkIsset($data['f7_mixer']); ?> </td>
            	</tr>
            	<tr>
                	<td><b>Gas Stove?</b> : <?php echo checkIsset(@$data['f7_stove']); ?></td>
                	<td><b>Bicycle :</b> <?php echo checkIsset($data['f7_bicycle']); ?> </td>
            	</tr>
            	<tr>
                	<td><b>Cooking Cylinder?</b> : <?php echo checkIsset(@$data['f7_ccylinder']); ?></td>
                	<td><b>Lights & Fans :</b> <?php echo checkIsset($data['f7_fans']); ?> </td>
            	</tr>
            	<tr>
                	<td><b>Motorcycle?</b> : <?php echo checkIsset(@$data['f7_motorcycle']); ?></td>
                	<td><b>Car :</b> <?php echo checkIsset($data['f7_car']); ?> </td>
            	</tr>

            	<tr>
            		<th colspan="2">Farm and Land Details</th>
            	</tr>
            	<?php

                for($i = 0; $i < $no_of_land; $i++)
				{
					$id	= $i+1;
				?>
					<tr>
						<td><b>Size [in Acres] :</b><?php echo checkIsset(@$land_arr[$i]['f9_land_size']); ?></td>
						<td><b>Ownership :</b><?php echo checkIsset(@$land_arr[$i]['f9_owner']); ?></td>
					</tr>

					<?php
					if(@$land_arr[$i]['f9_owner']=='Rented')
					{
						echo '<tr>
								<td colspan="2"><b>Mention tha amount per month on rent :'.checkIsset(@$land_arr[$i]['f9_amount_on_rent']).'</b></td>
							  </tr>';
					}

					if(@$land_arr[$i]['f9_owner']=='Leased')
					{
						echo '<tr>
								<td colspan="2"><b>No. of Lease year :'.checkIsset(@$land_arr[$i]['f9_lease_year']).'</b></td>
							  </tr>';
					}

					if(@$land_arr[$i]['f9_owner']=='Contracted')
					{
						echo '<tr>
								<td colspan="2"><b>No. of Contract year :'.checkIsset(@$land_arr[$i]['f9_contract_year']).'</b></td>
							  </tr>';
					}
					?>

					<tr>
						<td><b>State  :</b>
						<?php
						$state = lookup_value('tbl_state',array('st_name'),array('id'=>$land_arr[$i]['f9_state']),array(),array(),array());
						echo ucwords($state);
						?>

						</td>
						<td><b>District  :</b><?php
						$district = lookup_value('tbl_district',array('dt_name'),array('id'=>$land_arr[$i]['f9_district']),array(),array(),array());
						echo ucwords($district);
						?></td>
					</tr>
					<tr>
						<td><b>Taluka   :</b><?php
						$district = lookup_value('tbl_taluka',array('tk_name'),array('id'=>$land_arr[$i]['f9_taluka']),array(),array(),array());
						echo ucwords($district);
						?></td>
						<td><b>Village Name   :</b><?php
						$district = lookup_value('tbl_village',array('vl_name'),array('id'=>$land_arr[$i]['f9_vilage']),array(),array(),array());
						echo ucwords($district);
						?></td>
					</tr>
					<tr>
						<td><b>Survey Number  :</b><?php echo checkIsset(@$land_arr[$i]['f9_survey_number']); ?></td>
						<td><b>Gat Number  :</b><?php echo checkIsset(@$land_arr[$i]['f9_gat_number']); ?></td>
					</tr>
					<tr>
						<td><b>Pin-Code  :</b><?php echo checkIsset(@$land_arr[$i]['f9_pincode']); ?></td>
						<td><b>latitude   :</b><?php echo checkIsset(@$land_arr[$i]['f9_lat']); ?></td>
					</tr>
					<tr>
						<td><b>longitude   :</b><?php echo checkIsset(@$land_arr[$i]['f9_long']); ?></td>
						<td><b>Type of Soil :</b><?php echo checkIsset(@$land_arr[$i]['f9_soil_type']); ?></td>
					</tr>
					<tr>
						<td><b>Have you had the soil tested in your land?  :</b><?php echo checkIsset(@$land_arr[$i]['f9_soil_tested']); ?></td>
						<td><b>Soil Depth  :</b><?php echo checkIsset(@$land_arr[$i]['f9_soil_depth']); ?></td>
					</tr>
					<tr>
						<td colspan="2">
					<?php
					// Query For getting the Service Provider list for that user
			        $sql_get_f9_farmer_water_source	= " SELECT * FROM `tbl_f9_farmer_water_source` WHERE `fm_id`='".$fm_id."' AND count='".$id."' ";
			        $res_get_f9_farmer_water_source	= mysqli_query($db_con, $sql_get_f9_farmer_water_source) or die(mysqli_error($db_con));
			        $num_get_f9_farmer_water_source	= mysqli_num_rows($res_get_f9_farmer_water_source);
			        $startOffset_f9	= 0;

			        $water_arr = array();
			        while($row = mysqli_fetch_array($res_get_f9_farmer_water_source))
			        {
			        	array_push($water_arr,ucwords($row['water_source_name']));
			        }

			        echo checkIsset(@implode(', ', $water_arr));
					?>
				    </td>
				   </tr>

				<?php
				}?>
            	<tr>
            		<th colspan="2">Assets Details</th>
            	</tr>
            	<tr>
            		<td><b>TRACTOR  : </b><?php echo checkIsset(@$data['f12_TRACTOR']); ?></td>
					<td><b>Vehical Owned   : </b><?php echo checkIsset(@$f12_vehicle); ?></td>
				</tr>
				<tr>
            		<td><b>Total Value of the Vehical  :</b><?php echo checkIsset(@$data['f12_total_val_of_vehical']); ?></td>
					<td><b>Protavator   : </b><?php echo checkIsset(@$data['f12_Protavator']); ?></td>
				</tr>
				<tr>
            		<td><b>Sprayer  : </b><?php echo checkIsset(@$data['f12_Sprayer']); ?></td>
					<td><b>Pumps : </b><?php echo checkIsset(@$data['f12_Pumps']); ?></td>
				</tr>
				<tr>
            		<td><b>Cultivators  : </b><?php echo checkIsset(@$data['f12_Cultivators']); ?></td>
					<td><b>Machinery Owned: </b><?php echo checkIsset(@$f12_machinery); ?></td>
				</tr>
				<tr>
            		<td><b>Value of the Machinery : </b><?php echo checkIsset(@$data['f12_total_val_of_machinery']); ?></td>
					<td><b>Any Other Assets : </b><?php echo checkIsset(@$data['f12_any_other_assets']); ?></td>
				</tr>

				<tr>
            		<th colspan="2">Live Stock</th>
            	</tr>
            	<tr>
            		<td><b>Dairy Cattle  : </b><?php echo checkIsset(@$data['f13_dairy_cattle']); ?></td>
					<td><b>Draft Cattle : </b><?php echo checkIsset(@$data['f13_draft_cattle']); ?></td>
				</tr>
				<tr>
            		<td><b>Buffalo   :</b><?php echo checkIsset(@$data['f13_buffalo']); ?></td>
					<td><b>Ox    : </b><?php echo checkIsset(@$data['f13_ox']); ?></td>
				</tr>
				<tr>
            		<td><b>Sheep   : </b><?php echo checkIsset(@$data['f13_sheep']); ?></td>
					<td><b>Goat  : </b><?php echo checkIsset(@$data['f13_goat']); ?></td>
				</tr>
				<tr>
            		<td><b>Pig   : </b><?php echo checkIsset(@$data['f13_pig']); ?></td>
					<td><b>Poultry  : </b><?php echo checkIsset(@$data['f13_poultry']); ?></td>
				</tr>
				<tr>
            		<td colspan="2"><b>Donkeys  : </b><?php echo checkIsset(@$data['f13_donkeys']); ?></td>
				</tr>

				<tr>
            		<th colspan="2">Financial Details</th>
            	</tr>
            	<tr>
            		<?php
                        // Query for getting the Previous Crop Cycle Income for Crop1, Crop2, Crop3, etc...
						$sql_get_sum_prev_crop_income	= " SELECT SUM(`f11_income`) AS prev_crop_income FROM `tbl_yield_details` WHERE `fm_id`='".$fm_id."' ";
						$res_get_sum_prev_crop_income	= mysqli_query($db_con, $sql_get_sum_prev_crop_income) or die(mysqli_error($db_con));
						$row_get_sum_prev_crop_income	= mysqli_fetch_array($res_get_sum_prev_crop_income);
						
						if($row_get_sum_prev_crop_income['prev_crop_income'] == '')
						{
							$prev_crop_income	= 0;
						}
						else
						{
							$prev_crop_income	= $row_get_sum_prev_crop_income['prev_crop_income'];
							
						}
						//echo '<br>';
						// Query for getting the Live Stock Income
						$sql_get_sum_livestock_income	= " SELECT SUM(`f13_livestock_income`) AS livestock_income FROM `tbl_livestock_details` WHERE `fm_id`='".$fm_id."' ";
						$res_get_sum_livestock_income	= mysqli_query($db_con, $sql_get_sum_livestock_income) or die(mysqli_error($db_con));
						$row_get_sum_livestock_income	= mysqli_fetch_array($res_get_sum_livestock_income);
						
						if($row_get_sum_livestock_income['livestock_income'] == '')
						{
							$livestock_income	= 0;
						}
						else
						{
							$livestock_income	= $row_get_sum_livestock_income['livestock_income'];
							
						}
						//echo '<br>';
						$avg_monthly_income	= ($prev_crop_income + $livestock_income) / 12;
						//echo '<br>';
						?>
            		<td><b>Avg or Fixed Monthly Income : </b> <?php echo round($avg_monthly_income,2); ?> In Rs. </td>
            		<td><b>Any Loan taken : </b> <?php echo ucwords($data['f8_loan_taken']) ?></td>
            	</tr>

            	<?php
            	for($m=0;$m<$no_of_loan;$m++)
				{?>
				
				<tr>
					<td colspan="2"><b>Loan Type : </b><?php echo @$loan_arr[$m]['f8_loan_type']; ?></td>
				</tr>
				<tr>
					<td colspan="2"><b>Loan Amount : </b><?php echo @$loan_arr[$m]['f8_loan_amount']; ?></td>

				</tr>
				<tr>
					<td colspan="2"><b>Provider : </b><?php echo ucwords(@$loan_arr[$m]['f8_loan_provider']); ?></td>
				</tr>

				<?php
				}
            	?>
            </tbody>
        </table>
	    <?php
	}


	$pdf->AddPage();

	$html1   = generatePdf($fm_id,$db_con);

	
	$pdf->SetFont('helvetica', '', 10);
    $pdf->writeHTML($html1, true, 0, true, true);

    // $pdf->lastPage();

	  // ---------------------------------------------------------
	  // ob_end_clean();
	  //Close and output PDF document
	  //$pdf->Output($row_org['org_name']."_customer".'.pdf', 'D');
	  $pdf->Output('../../h.pdf', 'F');

    function checkIsset($val)
    { 	
    	if(@$val=="")
    	{
    		return '<span class="incompete" style="color:red">Incomplete</span>';
    	}

    	return $val;
    }

?>