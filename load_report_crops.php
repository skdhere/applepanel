<?php
	include('access1.php'); 
	include('include/connection.php');
	include('include/query-helper.php');
	include('include/pagination-helper.php');
	
	$fm_caid   	= $_SESSION['ca_id'];
	$fm_caname  = $_SESSION['sqyard_user'];

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
		$hid_page_type  = mysqli_real_escape_string($db_con,$obj->hid_page_type);
		 
		if($page != "" && $per_page != "")	
		{
			$cur_page 		= $page;
			$page 	   	   	= $page - 1;
			$start_offset 	+= $page * $per_page;
			$start 			= $page * $per_page;
			
			$sql_load_data  = " SELECT DISTINCT SUM(tccf.`f14_total_acrage`) AS total_sugarcane_area, tf.fm_id, tf.fm_name, tf.fm_mobileno ";
			$sql_load_data  .= " FROM tbl_farmers As tf INNER JOIN tbl_current_crop_forecast AS tccf ";
			$sql_load_data  .= " 	ON tf.fm_id = tccf.fm_id ";
			$sql_load_data  .= " WHERE tccf.f14_cultivating = '68' ";
			
			if($search_text != "")
			{
				$sql_load_data .= " and (tf.fm_mobileno like '%".$search_text."%' OR tf.fm_name like '%".$search_text."%') ";	
			}
			$sql_load_data  .= " GROUP By tf.fm_id ";
			// quit($sql_load_data);
			$data_count		= 	dataPagination($sql_load_data,$per_page,$start,$cur_page);		
			$sql_load_data .=" ORDER BY tf.fm_id ASC LIMIT $start, $per_page ";
			$result_load_data = mysqli_query($db_con,$sql_load_data) or die(mysqli_error($db_con));			
			
					
			if(strcmp($data_count,"0") !== 0)
			{		
				$variety_data = "";			
				$variety_data .='<form id="mainform1" action="deletefarmerdetails.php?pag=farmers&fmca_id='.$hid_ca_id.'" method="post">';
				$variety_data .= '<table id="tbl_farmer" class="table table-bordered dataTable" style="width:100%;text-align:center">';
				$variety_data .= '<thead>';
					$variety_data .= '<tr>';
						$variety_data .= '<th>Sr no.</th>';
						$variety_data .= '<th>Farmer ID</th>';
						$variety_data .= '<th>Farmer Name</th>';
						$variety_data .= '<th>Farmer Mobile</th>';
						$variety_data .= '<th>Total Area</th>';
					$variety_data .= '</tr>';
				$variety_data .= '</thead>';
				$variety_data .= '<tbody>';
				while($row_load_data = mysqli_fetch_array($result_load_data))
				{
					$variety_data .= '<tr>';				
						$variety_data .= '<td class="center-text">'.++$start_offset.'</td>';				
						$variety_data .= '<td>'.$row_load_data['fm_id'].'</td>';	//<!-- Crop ID -->
						$variety_data .= '<td>';
							$variety_data .= ucwords($row_load_data['fm_name']);
						$variety_data .= '</td>';	//<!-- Crop Name -->
						$variety_data .= '<td>'.$row_load_data['fm_mobileno'].'</td>';	//<!-- Crop ID -->
						$variety_data .= '<td>'.$row_load_data['total_sugarcane_area'].'</td>';	//<!-- total_sugarcane_area -->
					$variety_data .= '</tr>';															
				}	
				$variety_data .= '</tbody>';
				$variety_data .= '</table>';
				$variety_data .= '</form>';
				$variety_data .= $data_count;
				$response_array = array("Success"=>"Success","resp"=>$variety_data);					
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