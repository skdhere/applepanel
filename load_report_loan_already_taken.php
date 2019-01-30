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
		$avg_of_points 	= 0;
		
		$page 			= mysqli_real_escape_string($db_con,$obj->page);	
		$per_page		= mysqli_real_escape_string($db_con,$obj->row_limit);
		$search_text	= mysqli_real_escape_string($db_con,$obj->search_text);	
		$hid_user_type	= mysqli_real_escape_string($db_con,$obj->hid_user_type); 
		$hid_ca_id 		= mysqli_real_escape_string($db_con,$obj->hid_ca_id);
		 
		if($page != "" && $per_page != "")	
		{
			$cur_page 		= $page;
			$page 	   	   	= $page - 1;
			$start_offset 	+= $page * $per_page;
			$start 			= $page * $per_page;
			
			$sql_load_data  = " SELECT DISTINCT tf.fm_id, tf.fm_caid, tf.fm_name, tf.fm_mobileno, ";
			$sql_load_data  .= " SUM(tbld.f8_loan_amount) AS loan_amount ";
			$sql_load_data  .= " FROM tbl_farmers AS tf INNER JOIN  tbl_loan_details AS tld ";
			$sql_load_data  .= " 	ON tf.fm_id = tld.fm_id INNER JOIN tbl_bank_loan_detail AS tbld ";
        	$sql_load_data  .= " 	ON tld.fm_id = tbld.fm_id ";
			$sql_load_data  .= " WHERE tld.f8_loan_taken = 'yes' ";
			if(strcmp($hid_user_type,'Admin')!==0)
			{
				$sql_load_data  .= " AND tf.fm_caid='".$hid_ca_id."' ";
			}
			if($search_text != "")
			{
				$sql_load_data .= " and (tf.fm_name like '%".$search_text."%' or tf.fm_mobileno like '%".$search_text."%') ";	
			}
			$sql_load_data .= " GROUP BY tbld.fm_id ";
			// quit($sql_load_data);
			$data_count		= 	dataPagination($sql_load_data,$per_page,$start,$cur_page);		
			$sql_load_data .=" ORDER BY tbld.fm_id ASC LIMIT $start, $per_page ";
			$result_load_data = mysqli_query($db_con,$sql_load_data) or die(mysqli_error($db_con));			
			
					
			if(strcmp($data_count,"0") !== 0)
			{		
				$farmer_data = "";			
				$farmer_data .='<form id="mainform1" action="deletefarmerdetails.php?pag=farmers&fmca_id='.$hid_ca_id.'" method="post">';
				$farmer_data .= '<table id="tbl_farmer" class="table table-bordered dataTable" style="width:100%;text-align:center">';
				$farmer_data .= '<thead>';
					$farmer_data .= '<tr>';
						$farmer_data .= '<th>Sr no.</th>';
						$farmer_data .= '<th>Farmer ID</th>';
						$farmer_data .= '<th>Farmer Name</th>';
						$farmer_data .= '<th>Mobile No</th>';
						$farmer_data .= '<th>Loan Amount (In Rs.)</th>';
					$farmer_data .= '</tr>';
				$farmer_data .= '</thead>';
				$farmer_data .= '<tbody>';
				while($row_load_data = mysqli_fetch_array($result_load_data))
				{
					$farmer_data .= '<tr>';				
						$farmer_data .= '<td class="center-text">'.++$start_offset.'</td>';				
						$farmer_data .= '<td>'.$row_load_data['fm_id'].'</td>';	//<!-- Farmer ID -->
						$farmer_data .= '<td>';
							$farmer_data .= ucwords($row_load_data['fm_name']);
						$farmer_data .= '</td>';	//<!-- Farmer Name -->
						$farmer_data .= '<td>'.$row_load_data['fm_mobileno'].'</td>';	//<!-- Mobile Number -->
						$farmer_data .= '<td>'.$row_load_data['loan_amount'].'</td>';	//<!-- loan_amount -->
					$farmer_data .= '</tr>';															
				}	
				$farmer_data .= '</tbody>';
				$farmer_data .= '</table>';
				$farmer_data .= '</form>';
				$farmer_data .= $data_count;
				$response_array = array("Success"=>"Success","resp"=>$farmer_data);					
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