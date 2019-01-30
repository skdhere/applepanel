<?php
include('access1.php');
include('include/connection.php');
date_default_timezone_set("Asia/Calcutta");
$todaydt = date("Y-m-d H:i:s");




if(isset($_POST["U_Submit"]))
{

	$ca_id = $_SESSION['ca_id'];

	$farmer_id = mysqli_real_escape_string($db_con,$_REQUEST['fm_id']);

	$res_get_farmer_info = lookup_value('tbl_farmers',array(),array("fm_id"=>$farmer_id),array(),array(),array());
	if($res_get_farmer_info)
	{
		$num_get_farmer_info	= mysqli_num_rows($res_get_farmer_info);
		if($num_get_farmer_info != 0)
		{
			$row_get_farmer_info	= mysqli_fetch_array($res_get_farmer_info);
			
		}
		else
		{
			 ?>
        		<script type="text/javascript">
            		history.go(-1);
        		</script>
        <?php
		}
	}



	if(isset($_FILES['files1'])) // for Declaration Documents
		{
			$errors1= array();
				foreach($_FILES['files1']['tmp_name'] as $key1 => $tmp_name1 )
				{
					
					$file_name1 =$_FILES['files1']['name'][$key1];
					$file_size1 =$_FILES['files1']['size'][$key1];
					$file_tmp1 =$_FILES['files1']['tmp_name'][$key1];
					$file_type1=$_FILES['files1']['type'][$key1];
					
					$file_extention1 = pathinfo($file_name1, PATHINFO_EXTENSION);

					if($file_size1 > 5242880) // file size
					{
						$errors1[]='File size must be less than 5 MB';
					}
					
					if($file_size1 != 0)// files size less than 0
					{
						
						//for insert
						 $query1="INSERT into tbl_doc_uploads (fm_caid,fm_id,file_name,file_type,file_size,file_extention,doc_type,status,created_date) VALUES('$ca_id','$farmer_id','$file_name1','$file_type1','$file_size1','$file_extention1','Aadhar','1','$todaydt'); ";
										
						$desired_dir1= "data/".$farmer_id;
						
						if(empty($errors1)==true)
						{
							  if(is_dir($desired_dir1)==false)
							  {
									mkdir("$desired_dir1", 0777);// Create directory if it does not exist
							  }
							  
							  if(is_dir("$desired_dir1/".$file_name1)==false)
							  {
									move_uploaded_file($file_tmp1,"$desired_dir1/".$file_name1);
							  }
							  else
							  {		// rename the file if another one exist
									$new_dir1="$desired_dir1/".$file_name1.time();
									rename($file_tmp1,$new_dir1) ;				
							  }
							mysqli_query($db_con,$query1);
						 }
						 else
						 {
							 print_r($errors1);
						 }
						}
				 }//end of foreach
	} // supporting document
	

	if(isset($_FILES['files2'])) // for Declaration Documents
		{
			$errors2= array();
				foreach($_FILES['files2']['tmp_name'] as $key2 => $tmp_name2 )
				{
					
					$file_name2 =$_FILES['files2']['name'][$key2];
					$file_size2 =$_FILES['files2']['size'][$key2];
					$file_tmp2  =$_FILES['files2']['tmp_name'][$key2];
					$file_type2 =$_FILES['files2']['type'][$key2];

					$file_extention2 = pathinfo($file_name2, PATHINFO_EXTENSION);

					if($file_size2 > 5242880) // file size
					{
						$errors2[]='File size must be less than 5 MB';
					}
					
					if($file_size2 != 0)// files size less than 0
					{
						
						
						 $query2="INSERT into tbl_doc_uploads (fm_caid,fm_id,file_name,file_type,file_size,file_extention,doc_type,status,created_date) VALUES('$ca_id','$farmer_id','$file_name2','$file_type2','$file_size2','$file_extention2','Pancard','1','$todaydt'); ";
						
										
						$desired_dir2= "data/".$farmer_id;
						
						if(empty($errors2)==true)
						{
							  if(is_dir($desired_dir2)==false)
							  {
									mkdir("$desired_dir2", 0777);// Create directory if it does not exist
							  }
							  
							  if(is_dir("$desired_dir2/".$file_name2)==false)
							  {
									move_uploaded_file($file_tmp2,"$desired_dir2/".$file_name2);
							  }
							  else
							  {		// rename the file if another one exist
									$new_dir2="$desired_dir2/".$file_name2.time();
									rename($file_tmp2,$new_dir2) ;				
							  }
							mysqli_query($db_con,$query2);
						 }
						 else
						 {
							 print_r($errors2);
						 }
						}
				 }//end of foreach
	} // supporting document


	if(isset($_FILES['files3'])) // for Declaration Documents
		{
			$errors3= array();
				foreach($_FILES['files3']['tmp_name'] as $key3 => $tmp_name3 )
				{
					
					$file_name3 =$_FILES['files3']['name'][$key3];
					$file_size3 =$_FILES['files3']['size'][$key3];
					$file_tmp3 =$_FILES['files3']['tmp_name'][$key3];
					$file_type3 =$_FILES['files3']['type'][$key3];

					$file_extention3 = pathinfo($file_name3, PATHINFO_EXTENSION);

					if($file_size3 > 5242880) // file size
					{
						$errors3[]='File size must be less than 5 MB';
					}
					
					if($file_size3 != 0)// files size less than 0
					{
						
						
						$query3="INSERT into tbl_doc_uploads (fm_caid,fm_id,file_name,file_type,file_size,file_extention,doc_type,status,created_date) VALUES('$ca_id','$farmer_id','$file_name3','$file_type3','$file_size3','$file_extention3','7/12','1','$todaydt'); ";
										
						$desired_dir3= "data/".$farmer_id;
						
						if(empty($errors3)==true)
						{
							  if(is_dir($desired_dir3)==false)
							  {
									mkdir("$desired_dir3", 0777);// Create directory if it does not exist
							  }
							  
							  if(is_dir("$desired_dir3/".$file_name3)==false)
							  {
									move_uploaded_file($file_tmp3,"$desired_dir3/".$file_name3);
							  }
							  else
							  {		// rename the file if another one exist
									$new_dir3="$desired_dir3/".$file_name3.time();
									rename($file_tmp3,$new_dir3) ;				
							  }
							mysqli_query($db_con,$query3);
						 }
						 else
						 {
							 print_r($errors3);
						 }
						}
				 }//end of foreach
	} // supporting document


	if(isset($_FILES['files4'])) // for Declaration Documents
		{
			$errors4= array();
				foreach($_FILES['files4']['tmp_name'] as $key4 => $tmp_name4 )
				{
					
					$file_name4 =$_FILES['files4']['name'][$key4];
					$file_size4 =$_FILES['files4']['size'][$key4];
					$file_tmp4 =$_FILES['files4']['tmp_name'][$key4];
					$file_type4 =$_FILES['files4']['type'][$key4];

					$file_extention4 = pathinfo($file_name4, PATHINFO_EXTENSION);

					if($file_size4 > 5242880) // file size
					{
						$errors4[]='File size must be less than 5 MB';
					}
					
					if($file_size4 != 0)// files size less than 0
					{
						
						$query4="INSERT into tbl_doc_uploads (fm_caid,fm_id,file_name,file_type,file_size,file_extention,doc_type,status,created_date) VALUES('$ca_id','$farmer_id','$file_name4','$file_type4','$file_size4','$file_extention4','land Registration','1','$todaydt'); ";

						$desired_dir4= "data/".$farmer_id;
						
						if(empty($errors4)==true)
						{
							  if(is_dir($desired_dir4)==false)
							  {
									mkdir("$desired_dir4", 0777);// Create directory if it does not exist
							  }
							  
							  if(is_dir("$desired_dir4/".$file_name4)==false)
							  {
									move_uploaded_file($file_tmp4,"$desired_dir4/".$file_name4);
							  }
							  else
							  {		// rename the file if another one exist
									$new_dir4="$desired_dir4/".$file_name4.time();
									rename($file_tmp4,$new_dir4) ;				
							  }
							mysqli_query($db_con,$query4);
						 }
						 else
						 {
							 print_r($errors4);
						 }
						}
				 }//end of foreach
	} // supporting document


	if(isset($_FILES['files5'])) // for Declaration Documents
		{
			$errors5= array();
				foreach($_FILES['files5']['tmp_name'] as $key5 => $tmp_name5 )
				{
					
					$file_name5 =$_FILES['files5']['name'][$key5];
					$file_size5 =$_FILES['files5']['size'][$key5];
					$file_tmp5 =$_FILES['files5']['tmp_name'][$key5];
					$file_type5 =$_FILES['files5']['type'][$key5];

					$file_extention5 = pathinfo($file_name5, PATHINFO_EXTENSION);

					if($file_size5 > 5242880) // file size
					{
						$errors5[]='File size must be less than 5 MB';
					}
					
					if($file_size5 != 0)// files size less than 0
					{
						
						$query5="INSERT into tbl_doc_uploads (fm_caid,fm_id,file_name,file_type,file_size,file_extention,doc_type,status,created_date) VALUES('$ca_id','$farmer_id','$file_name5','$file_type5','$file_size5','$file_extention5','land Valuation','1','$todaydt'); ";
										
						$desired_dir5= "data/".$farmer_id;
						
						if(empty($errors5)==true)
						{
							  if(is_dir($desired_dir5)==false)
							  {
									mkdir("$desired_dir5", 0777);// Create directory if it does not exist
							  }
							  
							  if(is_dir("$desired_dir5/".$file_name5)==false)
							  {
									move_uploaded_file($file_tmp5,"$desired_dir5/".$file_name5);
							  }
							  else
							  {		// rename the file if another one exist
									$new_dir5="$desired_dir5/".$file_name5.time();
									rename($file_tmp5,$new_dir5) ;				
							  }
							mysqli_query($db_con,$query5);
						 }
						 else
						 {
							 print_r($errors5);
						 }
						}
				 }//end of foreach
	} // supporting document

	if(isset($_FILES['files6'])) // for Declaration Documents
		{
			$errors6= array();
				foreach($_FILES['files6']['tmp_name'] as $key6 => $tmp_name6 )
				{
					
					$file_name6 =$_FILES['files6']['name'][$key6];
					$file_size6 =$_FILES['files6']['size'][$key6];
					$file_tmp6 =$_FILES['files6']['tmp_name'][$key6];
					$file_type6 =$_FILES['files6']['type'][$key6];

					$file_extention6 = pathinfo($file_name6, PATHINFO_EXTENSION);

					if($file_size6 > 5242880) // file size
					{
						$errors6[]='File size must be less than 5 MB';
					}
					
					if($file_size6 != 0)// files size less than 0
					{
						
						$query6="INSERT into tbl_doc_uploads (fm_caid,fm_id,file_name,file_type,file_size,file_extention,doc_type,status,created_date) VALUES('$ca_id','$farmer_id','$file_name6','$file_type6','$file_size6','$file_extention6','Soil test document','1','$todaydt'); ";
										
						$desired_dir6= "data/".$farmer_id;
						
						if(empty($errors6)==true)
						{
							  if(is_dir($desired_dir6)==false)
							  {
									mkdir("$desired_dir6", 0777);// Create directory if it does not exist
							  }
							  
							  if(is_dir("$desired_dir6/".$file_name6)==false)
							  {
									move_uploaded_file($file_tmp6,"$desired_dir6/".$file_name6);
							  }
							  else
							  {		// rename the file if another one exist
									$new_dir6="$desired_dir6/".$file_name6.time();
									rename($file_tmp6,$new_dir6) ;				
							  }
							mysqli_query($db_con,$query6);
						 }
						 else
						 {
							 print_r($errors6);
						 }
						}
				 }//end of foreach
	} // supporting document


	if(isset($_FILES['files7'])) // for Declaration Documents
		{
			$errors7= array();
				foreach($_FILES['files7']['tmp_name'] as $key7 => $tmp_name7 )
				{
					
					$file_name7 =$_FILES['files7']['name'][$key7];
					$file_size7 =$_FILES['files7']['size'][$key7];
					$file_tmp7 =$_FILES['files7']['tmp_name'][$key7];
					$file_type7 =$_FILES['files7']['type'][$key7];

					$file_extention7 = pathinfo($file_name7, PATHINFO_EXTENSION);

					if($file_size7 > 5242880) // file size
					{
						$errors7[]='File size must be less than 5 MB';
					}
					
					if($file_size7 != 0)// files size less than 0
					{
						
						$query7="INSERT into tbl_doc_uploads (fm_caid,fm_id,file_name,file_type,file_size,file_extention,doc_type,status,created_date) VALUES('$ca_id','$farmer_id','$file_name7','$file_type7','$file_size7','$file_extention7','Kisan Credit Card','1','$todaydt'); ";
										
						$desired_dir7= "data/".$farmer_id;
						
						if(empty($errors7)==true)
						{
							  if(is_dir($desired_dir7)==false)
							  {
									mkdir("$desired_dir7", 0777);// Create directory if it does not exist
							  }
							  
							  if(is_dir("$desired_dir7/".$file_name7)==false)
							  {
									move_uploaded_file($file_tmp7,"$desired_dir7/".$file_name7);
							  }
							  else
							  {		// rename the file if another one exist
									$new_dir7="$desired_dir7/".$file_name7.time();
									rename($file_tmp7,$new_dir7) ;				
							  }
							mysqli_query($db_con,$query7);
						 }
						 else
						 {
							 print_r($errors7);
						 }
						}
				 }//end of foreach
	} // supporting document

	if(isset($_FILES['files8'])) // for Declaration Documents
		{
			$errors8= array();
				foreach($_FILES['files8']['tmp_name'] as $key8 => $tmp_name8 )
				{
					
					$file_name8 =$_FILES['files8']['name'][$key8];
					$file_size8 =$_FILES['files8']['size'][$key8];
					$file_tmp8 =$_FILES['files8']['tmp_name'][$key8];
					$file_type8=$_FILES['files8']['type'][$key8];
					
					$file_extention8 = pathinfo($file_name8, PATHINFO_EXTENSION);

					if($file_size8 > 5242880) // file size
					{
						$errors8[]='File size must be less than 5 MB';
					}
					
					if($file_size8 != 0)// files size less than 0
					{
						
						//for insert
						 $query8="INSERT into tbl_doc_uploads (fm_caid,fm_id,file_name,file_type,file_size,file_extention,doc_type,status,created_date) VALUES('$ca_id','$farmer_id','$file_name8','$file_type8','$file_size8','$file_extention8','Profile Photo','1','$todaydt'); ";
										
						$desired_dir8= "data/".$farmer_id;
						
						if(empty($errors8)==true)
						{
							  if(is_dir($desired_dir8)==false)
							  {
									mkdir("$desired_dir8", 0777);// Create directory if it does not exist
							  }
							  
							  if(is_dir("$desired_dir8/".$file_name8)==false)
							  {
									move_uploaded_file($file_tmp8,"$desired_dir8/".$file_name8);
							  }
							  else
							  {		// rename the file if another one exist
									$new_dir8="$desired_dir8/".$file_name8.time();
									rename($file_tmp8,$new_dir8) ;				
							  }
							mysqli_query($db_con,$query8);
						 }
						 else
						 {
							 print_r($errors8);
						 }
						}
				 }//end of foreach
	} // supporting document

		?>
		<script type="text/javascript">
			alert ("Upload Complete!!!");	
			history.go(-1);
		</script>
		<?php				

}
else
{
		?>
		<script type="text/javascript">
			alert ("You Dont Have Access");	
			history.go(-1);
		</script>
		<?php

}

?>
