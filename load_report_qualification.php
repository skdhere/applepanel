<?php
	include('access1.php'); 
	include('include/connection.php');
	include('include/query-helper.php');
	include('include/pagination-helper.php');

	function getImage($fm_id, $doc_type)
	{
		global $db_con;
		$return_val	= '';

		// checking for Profile Image of respective Farmer
		$sql_get_profile_images	= " SELECT * FROM `tbl_doc_uploads` WHERE `fm_id`='".$fm_id."' AND `doc_type`='".$doc_type."' ";
		$res_get_profile_images	= mysqli_query($db_con, $sql_get_profile_images) or die(mysqli_error($db_con));
		$num_get_profile_images	= mysqli_num_rows($res_get_profile_images);

		if($num_get_profile_images != 0)
		{
			$row_get_profile_images	= mysqli_fetch_array($res_get_profile_images);

			$return_val	= $row_get_profile_images['file_name'];
		}

		return $return_val;
	}

	if((isset($obj->load_farmer)) == '1' && (isset($obj->load_farmer)))
	{
		$response_array = array();	
		$start_offset   = 0;
		$avg_of_points  = 0;
		
		$page           = mysqli_real_escape_string($db_con,$obj->page);	
		$per_page       = mysqli_real_escape_string($db_con,$obj->row_limit);
		$search_text    = mysqli_real_escape_string($db_con,$obj->search_text);	
		$hid_user_type  = mysqli_real_escape_string($db_con,$obj->hid_user_type); 
		$hid_ca_id      = mysqli_real_escape_string($db_con,$obj->hid_ca_id);
		$hid_page_type  = mysqli_real_escape_string($db_con,$obj->hid_page_type);

		if($page != "" && $per_page != "")	
		{
			$cur_page 		= $page;
			$page 	   	   	= $page - 1;
			$start_offset 	+= $page * $per_page;
			$start 			= $page * $per_page;
				
			$sql_load_data  = " SELECT tf.* ";
			$sql_load_data  .= " FROM `tbl_farmers` AS tf INNER JOIN `tbl_applicant_knowledge` AS tp ON tf.fm_id = tp.fm_id ";
			$sql_load_data 	.= " WHERE 1=1 ";

			if(strcmp($hid_user_type,'Admin')!==0)
			{
				$sql_load_data  .= " AND tf.fm_caid='".$hid_ca_id."' ";
			}

			if($hid_page_type == 'Illiterate')
			{
				$sql_load_data  .= " AND tp.f2_edudetail = 'illiterate' ";	
			}

			if($hid_page_type == 'Primary Education')
			{
				$sql_load_data 	.= " AND tp.f2_edudetail = 'primary education' ";
			}

			if($hid_page_type == 'Matriculate')
			{
				$sql_load_data  .= " AND tp.f2_edudetail = 'matriculate' ";	
			}

			if($hid_page_type == 'HSC')
			{
				$sql_load_data 	.= " AND tp.f2_edudetail = '12th Standard' ";
			}

			if($hid_page_type == 'Graduate')
			{
				$sql_load_data  .= " AND tp.f2_edudetail = 'graduate' ";	
			}

			if($hid_page_type == 'Post Graduate')
			{
				$sql_load_data 	.= " AND tp.f2_edudetail = 'post graduate' ";
			}

			if($hid_page_type == 'phd')
			{
				$sql_load_data  .= " AND tp.f2_edudetail = 'phd' ";	
			}
			
			if($search_text != "")
			{
				$sql_load_data .= " AND (tf.fm_name like '%".$search_text."%' OR tf.fm_aadhar like '%".$search_text."%' ";
				$sql_load_data .= " OR tf.fm_mobileno like '%".$search_text."%' OR tf.fm_id LIKE '%".$search_text."%') ";	
			}

			$data_count		= 	dataPagination($sql_load_data,$per_page,$start,$cur_page);		
			$sql_load_data .=" ORDER BY id DESC LIMIT $start, $per_page ";
			$result_load_data = mysqli_query($db_con,$sql_load_data) or die(mysqli_error($db_con));			
			
					
			if(strcmp($data_count,"0") !== 0)
			{		
				$cat_data = "";			
				$cat_data .='<form id="mainform1" action="deletefarmerdetails.php?pag=farmers&fmca_id='.$hid_ca_id.'" method="post">';
				$cat_data .= '<table id="tbl_farmer" class="table table-bordered dataTable" style="width:100%;text-align:center">';
				$cat_data .= '<thead>';
					$cat_data .= '<tr>';
						$cat_data .= '<th>Sr no.</th>';
						$cat_data .= '<th>Profile Image</th>';
						$cat_data .= '<th>Farmer ID</th>';
						$cat_data .= '<th>Farmer Name</th>';
						$cat_data .= '<th>Qualification</th>';
						$cat_data .= '<th>Aadhaar No</th>';
						$cat_data .= '<th>Mobile No</th>';
						$cat_data .= '<th>Total Points</th>';
						$cat_data .= '<th>Status</th>';
						$cat_data .= '<th class="hidden-350">Created Date</th>';
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

					$Profile_Photo_image      = getImage($row_load_data['fm_id'], 'Profile Photo');
					
					$cat_data .= '<tr>';				
						$cat_data .= '<td class="center-text">'.++$start_offset.'</td>';	//Sr. No.
						$cat_data .= '<td style="text-align:center;">';
							if($Profile_Photo_image != '')
							{
								$cat_data .= '<img src="data/'.$row_load_data['fm_id'].'/'.$Profile_Photo_image.'" alt="'.$row_load_data['fm_name'].'" width="70" height="70">';
							}
							else
							{
								$cat_data .= '<img src="images/person.jpg" alt="No Image" width="70" height="70">';
							}
						$cat_data .= '</td>';
						$cat_data .= '<td>'.$row_load_data['fm_id'].'</td>';	//<!-- Farmer ID -->
						$cat_data .= '<td>';
							$cat_data .= '<a href="get_farmer_details.php?pag=farmers&fm_id='.$row_load_data['fm_id'].'" >'.ucwords($row_load_data['fm_name']).'</a>';
							
							$sql_check_point  	= " SELECT * FROM tbl_points ";
							$sql_check_point  	.= " WHERE pt_frm1 !='' AND pt_frm2 !='' ";
							$sql_check_point  	.= " 	AND pt_frm3 !=''  ";
							$sql_check_point  	.= " 	AND pt_frm7 !='' ";
							$sql_check_point  	.= " 	AND pt_frm8 !='' AND pt_frm9 !='' ";
							$sql_check_point  	.= " 	AND pt_frm10 !='' AND pt_frm5 !='' ";
							$sql_check_point  	.= " 	AND pt_frm12 !='' AND pt_frm13 !='' ";
							$sql_check_point  	.= " 	AND pt_frm11 !='' AND pt_frm14 !='' "; //AND pt_frm8_fh !='' AND pt_frm6 !=''
							$sql_check_point  	.= " 	AND fm_id='".$row_load_data['fm_id']."' ";
							$res_check_point  = mysqli_query($db_con,$sql_check_point) or die(mysqli_error($db_con));
							$num_check_point  = mysqli_num_rows($res_check_point);
							if($num_check_point==0)
							{
								$cat_data .= ' ( <small style="color:red">Incomplete</small> ) ';
							}
							else
							{
								$cat_data .= ' ( <small style="color:green">Complete</small> ) ';
							}
						$cat_data .= '</td>';										//<!-- Farmer Name -->
						$cat_data .= '<td>';
							if($hid_page_type == 'Illiterate')
							{
								$cat_data .= "Illiterate";	
							}
							
							if($hid_page_type == 'Primary Education')
							{
								$cat_data .= "Primary Education";
							}
							
							if($hid_page_type == 'Matriculate')
							{
								$cat_data .= "Matriculate";	
							}
							
							if($hid_page_type == 'HSC')
							{
								$cat_data .= "12th Standard";
							}
							
							if($hid_page_type == 'Graduate')
							{
								$cat_data .= "Graduate";	
							}
							
							if($hid_page_type == 'Post Graduate')
							{
								$cat_data .= "Post Graduate";
							}
							
							if($hid_page_type == 'phd')
							{
								$cat_data .= "phd";	
							}
						$cat_data .= '</td>';	//<!-- Qualification -->
						$cat_data .= '<td>'.$row_load_data['fm_aadhar'].'</td>';	//<!-- Aadhaar Number -->
						$cat_data .= '<td>'.$row_load_data['fm_mobileno'].'</td>';	//<!-- Mobile Number -->
						$cat_data .= '<td>'.$avg_of_points.'</td>';					//<!-- Loan Required (Rs.) -->
						$cat_data .= '<td>'.$row_load_data['fm_status'].'</td>';	//<!-- Status -->
						$cat_data .= '<td>'.$row_load_data['fm_createddt'].'</td>';	//<!-- Created Date -->
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
?>