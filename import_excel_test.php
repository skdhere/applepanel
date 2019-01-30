<?php
session_start();
include('include/connection.php');
include('include/query-helper.php');
include('xlsxwriter.class.php');
$writer          = new XLSXWriter();
$header = array(
	'Sr No.' =>'string',	
	'Org Id' =>'string'
	
);


if(isset($_POST['hid_user_reg']) && $_POST['hid_user_reg'] == "1")
{
	$data_arr  = [];
	
	$sourcePath 			= $_FILES['file']['tmp_name'];      // Storing source path of the file in a variable
	$inputFileName 			= 'upload_excel/'.$_FILES['file']['name']; // Target path where file is to be stored
	move_uploaded_file($sourcePath,$inputFileName) ;

	set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
	include 'PHPExcel/IOFactory.php';
	try 
	{
		$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
	} 
	catch(Exception $e) 
	{
		die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
	}	
	$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
	$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet


	//echo json_encode($arrayCount);exit();

	if(strcmp($inputFileName, "")!==0)
	{
		$date = date('Y-m-d h:i:s');
		for($i=2;$i<=$arrayCount;$i++)
		{
                //echo "Array Count: ". $arrayCount . " <br>i: " . $i;

			$error_msg       = '';
			$farmerEntryFlag = false ;

			$fpo_id          = $allDataInSheet[$i]["A"];							
			$fpo_name        = $allDataInSheet[$i]["B"];
			$agent_id        = $allDataInSheet[$i]["C"];
            

			$data['fm_caid']    = $agent_id;
            //$data['org_id']     = $fpo_id;



			$agent_name          = $allDataInSheet[$i]["D"];
			$farmer_id           = $allDataInSheet[$i]["E"];
			$aadhar_no           = $allDataInSheet[$i]["F"];
			$data['fm_aadhar']   = $aadhar_no;
			$mobile_no           = $allDataInSheet[$i]["G"];
			$data['fm_mobileno'] = $mobile_no;
		    $survey_date1        = $allDataInSheet[$i]["H"];
			$survey_date1        = explode('-',$survey_date1); // added bt satish
	    	$survey_date1        = $survey_date1[1].'-'.$survey_date1[0].'-20'.$survey_date1[2];
			//added by punit 1 oct 2018 taking long date in excel as parameter
            $survey_date         = date('Y-m-d', strtotime($survey_date1));
            $data['fm_createddt']= $survey_date.' 00:00:00';
			//added by punit 1 oct 2018
			 
			if($data['fm_createddt']=='')
			{
				$data['fm_createddt'] = $date;
			}else
			{
				$date   = $data['fm_createddt'];
			}

			$farmer_name     = $allDataInSheet[$i]["I"];
			
			$data['fm_name'] = $farmer_name;
			
			
			//added by punit 1 oct 2018
        
			$sql_check         = "SELECT * FROM tbl_change_agents where id='".$agent_id."'";
			$res_check         = mysqli_query($db_con,$sql_check) or die(mysqli_error($db_con));
			$agent_num_check   = mysqli_num_rows($res_check);
			$agent_row         = mysqli_fetch_array($res_check);
			$data['fm_org_id'] = $agent_row['org_id'];
			
			//added by punit 1 oct 2018
			
			$sql_check       = "SELECT * FROM tbl_change_agents where id='".$fpo_id."'";
			$res_check       = mysqli_query($db_con,$sql_check) or die(mysqli_error($db_con));
			$org_num_check   = mysqli_num_rows($res_check);
			
			
			$sql_check_farmer = "SELECT * FROM tbl_farmers where (fm_aadhar='".$aadhar_no."' or fm_mobileno='".$mobile_no."')";
			$res_check_farmer = mysqli_query($db_con,$sql_check_farmer) or die(mysqli_error($db_con));
			$num_check_farmer = mysqli_num_rows($res_check_farmer);
            // echo $agent_num_check;
            // echo $org_num_check;
            // echo $num_check_farmer;
            // echo '<br>';
            // var_dump($data);
			if($agent_num_check !=0  && $num_check_farmer == 0)
			{
                
                $get_farmer_id        = " SELECT (fm_id + 1) as fm_id FROM tbl_farmers order BY fm_id DESC LIMIT 1";
                $res_farmer_id        = mysqli_query($db_con,$get_farmer_id) or die(mysqli_error($db_con));
                $row_farmer_id        = mysqli_fetch_array($res_farmer_id);
                $fm_id                = $row_farmer_id['fm_id'];
                $data['fm_id']        = $fm_id;
                $data['fm_status']    = 1;
                $data['fm_createdby'] = $_SESSION['sqyard_user'];
                
                if(valid($data)){
				  insert('tbl_farmers',$data);
				  $farmerEntryFlag = true;
				}else
				{
					foreach($data as $k=>$v)
					{
						if($v=="")
						{
							$error_msg .= $k.' is blank in farmer entry ';
						}
					}
				}
				

				if($farmerEntryFlag)
				{
					$pdata['fm_caid']         = $data['fm_caid']; //added by punit 1 oct 2018
					$pdata['fm_id']           = $fm_id;
					$pdata['f1_mfname']       = $allDataInSheet[$i]["K"];
					$pdata['f1_father']       = $allDataInSheet[$i]["J"];
					$pdata['f1_dob']          = $allDataInSheet[$i]["L"];
					$pdata['f1_dob']          =  date('Y-m-d', strtotime($pdata['f1_dob'])); //added by punit 1 oct 2018
				    $pdata['f1_age']          = $allDataInSheet[$i]["M"];
					if(valid($pdata) && $farmerEntryFlag){
	                     $pdata['f1_expfarm']      = $allDataInSheet[$i]["S"];
	                     $pdata['f1_status']       = '1'; //added by punit 1 oct 2018
	                     $pdata['f1_points']       = 5; //added by punit 1 oct 2018
	                     $pdata['f1_created_date'] = $date;
	                     $pdata['f1_created_by']   =$_SESSION['sqyard_user'];
	                     // var_dump($farmerEntryFlag$pdata);
					  insert('tbl_personal_detail',$pdata);
					}else
					{
						foreach($pdata as $k=>$v)
						{
							if($v=="")
							{
								$error_msg .= $k.' is blank in personal detail ';
							}
						}
					}
					
					
					
	                // echo 2 ;
	                $rdata['fm_caid'] = $agent_id;
					$rdata['fm_id']  = $fm_id; 
					$village         = $allDataInSheet[$i]["N"];
					$taluka          = $allDataInSheet[$i]["O"];
					$district        = $allDataInSheet[$i]["P"];
					$state           = $allDataInSheet[$i]["Q"];
					$rdata['f7_ppin'] = $allDataInSheet[$i]["R"];

					$rdata['f7_pvillage']   = lookup_value('tbl_village',array('id'),array('vl_name'=>$village),array(),array());
					if(!$rdata['f7_pvillage']){
						$rdata['village_txt']= $village;
					}

					
					$rdata['f7_ptaluka']   = lookup_value('tbl_taluka',array('id'),array('tk_name'=>$taluka),array(),array());
					if(!$rdata['f7_ptaluka']){
						$rdata['taluka_txt']= $taluka;
					}
					$rdata['f7_pdistrict']  = lookup_value('tbl_district',array('id'),array('dt_name'=>$district),array(),array());
					if(!$rdata['f7_pdistrict']){
						$rdata['district_txt']= $district;
					}
					$rdata['f7_pstate'] = lookup_value('tbl_state',array('id'),array('st_name'=>$state),array(),array());
					if(!$rdata['f7_pstate'])
					{
						$rdata['state_txt']= $state;
					}

	                $rdata['f7_reg_points'] = 5; // added by satish 01 Oct 2018
	                // var_dump($rdata);
					if(valid($rdata) && $farmerEntryFlag)
					{
						$rdata['f7_created_date'] = $date;
						// var_dump($rdata);
					    insert('tbl_residence_details',$rdata);
					}else
					{
						foreach($rdata as $k=>$v)
						{
							if($v=="")
							{
								$error_msg .= $k.' is blank in residence detail ';
							}
						}
					}
					
					


	                // echo 3 ;
	                $ldata                      = [];
	                unset($ldata);
	                $ldata['fm_caid']             = $agent_id;
					$ldata['fm_id']             = $fm_id;
					$ldata['f9_survey_number']  = $allDataInSheet[$i]["T"];
					$land_size_unit1            = $allDataInSheet[$i]["W"];
					$ldata['f9_land_size']      = $allDataInSheet[$i]["X"];
					$ldata['f9_land_size_acre'] = $allDataInSheet[$i]["Y"];
					$ldata['f9_owner']          = $allDataInSheet[$i]["Z"];
					
					if(valid($ldata) && $farmerEntryFlag)
					{  
	                    $ldata['f9_pincode']  = $rdata['f7_ppin']; // Added by punit 3 oct 2018
	                    $ldata['f9_state']    = $rdata['f7_pstate']; // Added by punit 3 oct 2018
	                    $ldata['f9_district'] = $rdata['f7_pdistrict']; // Added by punit 3 oct 2018
	                    $ldata['f9_taluka']   = $rdata['f7_ptaluka']; // Added by punit 3 oct 2018
	                    $ldata['f9_vilage']   = $rdata['f7_pvillage']; // Added by punit 3 oct 2018
					    
	                    $ldata['f9_soil_type'] =$allDataInSheet[$i]["AO"];
	                    $ldata['f9_lat'] = $allDataInSheet[$i]["U"];
	                    $ldata['f9_long'] = $allDataInSheet[$i]["V"];
	                    $ldata['f9_status'] = 1; // added by satish 01 Oct 2018
	                    $ldata['f9_points'] = 5; // added by satish 01 Oct 2018
	                    $ldata['f9_created_date'] = $date;
	                    insert('tbl_land_details',$ldata);
					}else
					{
						foreach($ldata as $k=>$v)
						{
							if($v=="")
							{
								$error_msg .= $k.' is blank in land 1 detail ';
							}
						}
					}
					
					
	                $ldata                      = [];
	                unset($ldata);
	                $ldata['fm_caid']           = $agent_id;
	                $ldata['fm_id']             = $fm_id;
	                $ldata['f9_survey_number']  = $allDataInSheet[$i]["AA"];
	                $land_size_unit1            = $allDataInSheet[$i]["W"];
	                $ldata['f9_land_size']      = $allDataInSheet[$i]["AE"];
	                $ldata['f9_land_size_acre'] = $allDataInSheet[$i]["AF"];
	                $ldata['f9_owner']          = $allDataInSheet[$i]["AG"];

	                if(valid($ldata) && $farmerEntryFlag)
					{
					    $ldata['f9_pincode'] = $rdata['f7_ppin']; // Added by punit 3 oct 2018
					    $ldata['f9_state'] = $rdata['f7_pstate']; // Added by punit 3 oct 2018
					    $ldata['f9_district'] = $rdata['f7_pdistrict']; // Added by punit 3 oct 2018
					    $ldata['f9_taluka'] = $rdata['f7_ptaluka']; // Added by punit 3 oct 2018
					    $ldata['f9_vilage'] = $rdata['f7_pvillage']; // Added by punit 3 oct 2018
						
						$ldata['f9_soil_type']    =$allDataInSheet[$i]["AO"];
						$ldata['f9_lat']            = $allDataInSheet[$i]["AB"];
						$ldata['f9_long']           = $allDataInSheet[$i]["AC"];
						$ldata['f9_status']         = 1; // added by satish 01 Oct 2018
						$ldata['f9_points']         = 5; // added by satish 01 Oct 2018
						$ldata['f9_created_date']   = $date;
						insert('tbl_land_details',$ldata);
					}else
					{
						foreach($ldata as $k=>$v)
						{
							if($v=="")
							{
								$error_msg .= $k.' is blank in land 2 detail ';
							}
						}
					}
	                
	                // echo 4;
	                $ldata                      = [];
	                unset($ldata);
	                $ldata['fm_caid']             = $agent_id;
					$ldata['fm_id']             = $fm_id;
					$ldata['f9_survey_number']  = $allDataInSheet[$i]["AH"];
					$land_size_unit1            = $allDataInSheet[$i]["W"];
					$ldata['f9_land_size']      = $allDataInSheet[$i]["AL"];
					$ldata['f9_land_size_acre'] = $allDataInSheet[$i]["AM"];
					$ldata['f9_owner']          = $allDataInSheet[$i]["AN"];

					if(valid($ldata) && $farmerEntryFlag)
					{
						$ldata['f9_pincode'] = $rdata['f7_ppin']; // Added by punit 3 oct 2018
					    $ldata['f9_state'] = $rdata['f7_pstate']; // Added by punit 3 oct 2018
					    $ldata['f9_district'] = $rdata['f7_pdistrict']; // Added by punit 3 oct 2018
					    $ldata['f9_taluka'] = $rdata['f7_ptaluka']; // Added by punit 3 oct 2018
					    $ldata['f9_vilage'] = $rdata['f7_pvillage']; // Added by punit 3 oct 2018
					    
						$ldata['f9_soil_type']    =$allDataInSheet[$i]["AO"];
						$ldata['f9_lat']          = $allDataInSheet[$i]["AI"];
						$ldata['f9_long']         = $allDataInSheet[$i]["AJ"];
						$ldata['f9_status']         = 1; // added by satish 01 Oct 2018
						$ldata['f9_points']         = 5; // added by satish 01 Oct 2018
						$ldata['f9_created_date'] = $date;
					    insert('tbl_land_details',$ldata);
					}else
					{
						foreach($ldata as $k=>$v)
						{
							if($v=="")
							{
								$error_msg .= $k.' is blank in land 3 detail ';
							}
						}
					}
					
				

	                // Crop 1 Strat here
	                $cdata['fm_id']           = $fm_id;
					$cdata['fm_caid']         = $agent_id;
					//$cdata['f10_survay_no']   = $allDataInSheet[$i]["AP"];
					$cdata['f10_total_acre']  = $allDataInSheet[$i]["AQ"];
					$cdata['f10_crop_season'] = $allDataInSheet[$i]["AT"];
					$cdata['f10_crop_type']   = $allDataInSheet[$i]["AU"];
					$crop_name                = $allDataInSheet[$i]["AV"];
					$cdata['f10_cultivating'] = lookup_value('tbl_crops',array('crop_id'),array('crop_name'=>$crop_name),array(),array());
					if(!$cdata['f10_cultivating'])
					{
						$cdata['crop_txt']  =  $crop_name;
					}
					$cdata['f10_variety']   = $allDataInSheet[$i]["AW"];
					$cdata['practice_type'] = $allDataInSheet[$i]["AX"];
					$cdata['f10_stage']     = $allDataInSheet[$i]["AY"];
					$cdata['harvest_month'] = $allDataInSheet[$i]["AZ"];
	                    
					if(valid($cdata) && $farmerEntryFlag)
					{
					     
					    $cdata['f10_points']  = 5;
					    $cdata['f10_status']  = 1;
						$cdata['f10_created_date'] = $date;
						$cdata['f10_created_by'] = $_SESSION['ca_id'];
						insert('tbl_cultivation_data',$cdata);

						$wdata['fm_id'] = $fm_id;
						$wdata['water_source_name'] = $allDataInSheet[$i]["AR"];
						// $wdata['water_adequacy']    = $allDataInSheet[$i]["AS"];
						if(valid($wdata) && $farmerEntryFlag)
						{
							$wdata['created_date'] = $date;
							$wdata['created_by'] = $_SESSION['ca_id'];
							insert('tbl_f10_farmer_water_source',$wdata);
						}
					}else
					{
						foreach($cdata as $k=>$v)
						{
							if($v=="")
							{
								$error_msg .= $k.' is blank in crop 1 detail ';
							}
						}
					}
					
					
	                
					

	                unset($cdata);
	                // Crop 2 Strat here
					$cdata1['fm_id']           = $fm_id;
					$cdata1['fm_caid']         = $agent_id;
					//$cdata1['f10_survay_no']   = $allDataInSheet[$i]["BA"];
					$cdata1['f10_total_acre']  = $allDataInSheet[$i]["BB"];
					$cdata1['f10_crop_season'] = $allDataInSheet[$i]["BE"];
					$cdata1['f10_crop_type']   = $allDataInSheet[$i]["BF"];
					$crop_name                = $allDataInSheet[$i]["BG"];
					$cdata1['f10_cultivating'] = lookup_value('tbl_crops',array('crop_id'),array('crop_name'=>$crop_name),array(),array());
					if(!$cdata1['f10_cultivating'])
					{
						$cdata1['crop_txt']  =  $crop_name;
					}
					$cdata1['f10_variety']   = $allDataInSheet[$i]["BH"];
					$cdata1['practice_type'] = $allDataInSheet[$i]["BI"];
					$cdata1['f10_stage']     = $allDataInSheet[$i]["BJ"];
					$cdata1['harvest_month'] = $allDataInSheet[$i]["BK"];
	                
					if(valid($cdata1) && $farmerEntryFlag)
					{
						$cdata1['f10_created_date'] = $date;
						$cdata1['f10_created_by'] = $_SESSION['ca_id'];
						insert('tbl_cultivation_data',$cdata1);

						$wdata1['fm_id'] = $fm_id;
						$wdata1['water_source_name'] = $allDataInSheet[$i]["BC"];
						// $wdata['water_adequacy']              = $allDataInSheet[$i]["BD"];
						if(valid($wdata1) && $farmerEntryFlag)
						{
							$wdata1['created_date'] = $date;
							$wdata1['created_by'] = $_SESSION['ca_id'];
							insert('tbl_f10_farmer_water_source',$wdata1);
						}
					}
					else
					{
						foreach($cdata1 as $k=>$v)
						{
							if($v=="")
							{
								$error_msg .= $k.' is blank in crop 2 detail, ';
							}
						}
					}
					unset($cdata);

	                // Crop 3 Strat here
					$cdata2['fm_id']           = $fm_id;
					$cdata2['fm_caid']         = $agent_id;
					$cdata2['f10_total_acre']  = $allDataInSheet[$i]["BM"];
					$cdata2['f10_crop_season'] = $allDataInSheet[$i]["BP"];
					$cdata2['f10_crop_type']   = $allDataInSheet[$i]["BQ"];
					$crop_name                = $allDataInSheet[$i]["BR"];
					$cdata2['f10_cultivating'] = lookup_value('tbl_crops',array('crop_id'),array('crop_name'=>$crop_name),array(),array());
					if(!$cdata2['f10_cultivating'])
					{
						$cdata2['crop_txt']  =  $crop_name;
					}
					$cdata2['f10_variety']   = $allDataInSheet[$i]["BS"];
					$cdata2['practice_type'] = $allDataInSheet[$i]["BT"];
					$cdata2['f10_stage']     = $allDataInSheet[$i]["BU"];
					$cdata2['harvest_month'] = $allDataInSheet[$i]["BV"];

					if(valid($cdata2) && $farmerEntryFlag)
					{
						$cdata2['f10_created_date'] = $date;
						$cdata2['f10_created_by'] = $_SESSION['ca_id'];
						insert('tbl_cultivation_data',$cdata2);

						$wdata2['fm_id']             = $fm_id;
		                $wdata2['water_source_name'] = $allDataInSheet[$i]["BN"];
		                // $wdata['water_adequacy']    = $allDataInSheet[$i]["BO"];
						if(valid($wdata2) && $farmerEntryFlag)
						{
		                    $wdata2['created_date'] = $date;
		                    $wdata2['created_by']   = $_SESSION['ca_id'];
		                    insert('tbl_f10_farmer_water_source',$wdata2);
						}
					}else
					{
						foreach($cdata2 as $k=>$v)
						{
							if($v=="")
							{
								$error_msg .= $k.' is blank in crop 3 detail, ';
							}
						}
					}
					unset($cdata);

					if($farmerEntryFlag)
					{
						$pt_data['fm_id'] = $fm_id;
						$pt_data['pt_frm10']='5';// cultivation
						$pt_data['pt_frm9'] ='5';// land_detail
						$pt_data['pt_frm1'] ='5';// personal detail
						$pt_data['pt_frm1'] = '5';// residense detail
						insert('tbl_points',$pt_data);
					}
				}

			}else
			{
				if($agent_num_check==0)
				{
					$error_msg .= 'Change agent_id not found ,';
				}

				if($num_check_farmer !=0)
				{
					$error_msg .= 'Farmer aadhar or mobile already exist ,';
				}
			}

			if($error_msg !="")
			{
				$arr = getErrorDataRow($allDataInSheet[$i],$error_msg);
				array_push($data_arr, $arr);
			}			

		}// for loop end
	}		
	
	if(!empty($data_arr))
	{
		$writer->setAuthor('Satish');
		$writer->writeSheet($data_arr,'demo',$header);
		echo $inputFileName;
		echo '<pre>';
		var_dump($data_arr);
		$timestamp			= date('mdYhis', time());
		$writer->writeToFile('upload_excel/error_'.$inputFileName.'.xlsx');
	}
	else
	{
		$response_array = array("Success"=>"Success","resp"=>"Farmers successfully uploaded.");
		echo json_encode($response_array);		
	}
}

function valid($data){
	foreach ($data as $key => $value) {
		if($value==''){
			return false;
		}
	}
	return true;
}


function getErrorDataRow($allDataInSheet,$error_msg)
{
	$temp_arr   = [];
	$temp_arr[] = $allDataInSheet["A"];
	$temp_arr[] = $allDataInSheet["B"];
	$temp_arr[] = $allDataInSheet["C"];
	$temp_arr[] = $allDataInSheet["D"];
	$temp_arr[] = $allDataInSheet["E"];
	$temp_arr[] = $allDataInSheet["F"];
	$temp_arr[] = $allDataInSheet["G"];
	$temp_arr[] = $allDataInSheet["H"];
	$temp_arr[] = $allDataInSheet["I"];
	$temp_arr[] = $allDataInSheet["J"];
	$temp_arr[] = $allDataInSheet["K"];
	$temp_arr[] = $allDataInSheet["L"];
	$temp_arr[] = $allDataInSheet["M"];
	$temp_arr[] = $allDataInSheet["N"];
	$temp_arr[] = $allDataInSheet["O"];
	$temp_arr[] = $allDataInSheet["P"];
	$temp_arr[] = $allDataInSheet["Q"];
	$temp_arr[] = $allDataInSheet["R"];
	$temp_arr[] = $allDataInSheet["S"];
	$temp_arr[] = $allDataInSheet["T"];
	$temp_arr[] = $allDataInSheet["U"];
	$temp_arr[] = $allDataInSheet["V"];
	$temp_arr[] = $allDataInSheet["W"];
	$temp_arr[] = $allDataInSheet["X"];
	$temp_arr[] = $allDataInSheet["Y"];
	$temp_arr[] = $allDataInSheet["Z"];

	$temp_arr[] = $allDataInSheet["AA"];
	$temp_arr[] = $allDataInSheet["AB"];
	$temp_arr[] = $allDataInSheet["AC"];
	$temp_arr[] = $allDataInSheet["AD"];
	$temp_arr[] = $allDataInSheet["AE"];
	$temp_arr[] = $allDataInSheet["AF"];
	$temp_arr[] = $allDataInSheet["AG"];
	$temp_arr[] = $allDataInSheet["AH"];
	$temp_arr[] = $allDataInSheet["AI"];
	$temp_arr[] = $allDataInSheet["AJ"];
	$temp_arr[] = $allDataInSheet["AK"];
	$temp_arr[] = $allDataInSheet["AL"];
	$temp_arr[] = $allDataInSheet["AM"];
	$temp_arr[] = $allDataInSheet["AN"];
	$temp_arr[] = $allDataInSheet["AO"];
	$temp_arr[] = $allDataInSheet["AP"];
	$temp_arr[] = $allDataInSheet["AQ"];
	$temp_arr[] = $allDataInSheet["AR"];
	$temp_arr[] = $allDataInSheet["AS"];
	$temp_arr[] = $allDataInSheet["AT"];
	$temp_arr[] = $allDataInSheet["AU"];
	$temp_arr[] = $allDataInSheet["AV"];
	$temp_arr[] = $allDataInSheet["AW"];
	$temp_arr[] = $allDataInSheet["AX"];
	$temp_arr[] = $allDataInSheet["AY"];
	$temp_arr[] = $allDataInSheet["AZ"];

	$temp_arr[] = $allDataInSheet["BA"];
	$temp_arr[] = $allDataInSheet["BB"];
	$temp_arr[] = $allDataInSheet["BC"];
	$temp_arr[] = $allDataInSheet["BD"];
	$temp_arr[] = $allDataInSheet["BE"];
	$temp_arr[] = $allDataInSheet["BF"];
	$temp_arr[] = $allDataInSheet["BG"];
	$temp_arr[] = $allDataInSheet["BH"];
	$temp_arr[] = $allDataInSheet["BI"];
	$temp_arr[] = $allDataInSheet["BJ"];
	$temp_arr[] = $allDataInSheet["BK"];
	$temp_arr[] = $allDataInSheet["BL"];
	$temp_arr[] = $allDataInSheet["BM"];
	$temp_arr[] = $allDataInSheet["BN"];
	$temp_arr[] = $allDataInSheet["BO"];
	$temp_arr[] = $allDataInSheet["BP"];
	$temp_arr[] = $allDataInSheet["BQ"];
	$temp_arr[] = $allDataInSheet["BR"];
	$temp_arr[] = $allDataInSheet["BS"];
	$temp_arr[] = $allDataInSheet["BT"];
	$temp_arr[] = $allDataInSheet["BU"];
	$temp_arr[] = $allDataInSheet["BV"];
	
	$temp_arr[] = $error_msg;
	return $temp_arr;
	
}