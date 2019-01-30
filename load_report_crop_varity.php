<?php
	include('access1.php'); 
	include('include/connection.php');
	include('include/query-helper.php');
	include('include/pagination-helper.php');

	if((isset($obj->load_crop)) == '1' && (isset($obj->load_crop)))
	{
		$response_array = array();	
		$start_offset   = 0;
		$avg_of_points  = 0;
		
		$page           = mysqli_real_escape_string($db_con,$obj->page);	
		$per_page       = mysqli_real_escape_string($db_con,$obj->row_limit);
		$search_text    = mysqli_real_escape_string($db_con,$obj->search_text);	
		$hid_user_type  = mysqli_real_escape_string($db_con,$obj->hid_user_type); 
		$hid_ca_id      = mysqli_real_escape_string($db_con,$obj->hid_ca_id);

		if($page != "" && $per_page != "")	
		{
			$cur_page 		= $page;
			$page 	   	   	= $page - 1;
			$start_offset 	+= $page * $per_page;
			$start 			= $page * $per_page;
				
			$sql_load_data  = "  ";

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
						$cat_data .= '<th>Crops</th>';
						$cat_data .= '<th>Total Acreage</th>';
					$cat_data .= '</tr>';
				$cat_data .= '</thead>';
				$cat_data .= '<tbody>';
				while($row_load_data = mysqli_fetch_array($result_load_data))
				{
					$cat_data .= '<tr>';				
						$cat_data .= '<td class="center-text">'.++$start_offset.'</td>';	//Sr. No.
						$cat_data .= '<td><a href="javascript:void(0);" onclick="getVarity(\''.$row_load_data[''].'\')">'.$row_load_data[''].'</a></td>';	//<!-- Crops -->
						$cat_data .= '<td>'.$row_load_data[''].'</td>';	//<!-- Aadhaar Number -->
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

	if((isset($obj->load_varity)) == '1' && (isset($obj->load_varity)))
	{
		$ddl_crop_seasson	= $obj->ddl_crop_seasson;
		$crop_val			= $obj->crop_val;

		if($crop_val != '')
		{
			
		}
		else
		{
			quit('Ooops, Something went wrong, Please try after sometime');
		}
		exit();
	}
?>