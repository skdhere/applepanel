<?php
	include('access1.php');
	include('include/connection.php');

	$var	= 1;

	if($var != 1)
	{
		$sql_get_user_id	= " SELECT DISTINCT tf.fm_id FROM tbl_farmers AS tf INNER JOIN tbl_current_crop_forecast AS tccf ON tf.fm_id = tccf.fm_id ";
		$res_get_user_id	= mysqli_query($db_con, $sql_get_user_id) or die(mysqli_error($db_con));

		while($row_get_user_id = mysqli_fetch_array($res_get_user_id))
		{
			$sql 	= " SELECT tccf.id, tf.fm_id, tccf.f14_water_source_type ";
			$sql	.= " FROM tbl_farmers AS tf INNER JOIN tbl_current_crop_forecast AS tccf ";
			$sql	.= " 	ON tf.fm_id = tccf.fm_id ";
			$sql	.= " WHERE tf.fm_id = '".$row_get_user_id['fm_id']."' ";
			$sql 	.= " ORDER BY tccf.id DESC ";
			
			$res 	= mysqli_query($db_con, $sql) or die(mysqli_error($db_con));
			$num 	= mysqli_num_rows($res);
			
			while($row = mysqli_fetch_array($res))
			{
				$sql_insert_1	= " INSERT INTO `tbl_f14_farmer_water_source`(`fm_id`, `water_source_name`, `count`, `status`, `created_date`, `created_by`) ";
				$sql_insert_1	.= " VALUES ('".$row['fm_id']."', '".$row['f14_water_source_type']."', '".$num--."', '1', NOW(), '1') ";
				$res_insert_1	= mysqli_query($db_con, $sql_insert_1) or die(mysqli_error($db_con));
			}
		}

		$sql_get_user_id1	= " SELECT DISTINCT tf.fm_id FROM tbl_farmers AS tf INNER JOIN tbl_land_details AS tccf ON tf.fm_id = tccf.fm_id ";
		$res_get_user_id1	= mysqli_query($db_con, $sql_get_user_id1) or die(mysqli_error($db_con));

		while($row_get_user_id1 = mysqli_fetch_array($res_get_user_id1))
		{
			$sql1 	= " SELECT tccf.id, tf.fm_id, tccf.f9_source_of_water ";
			$sql1	.= " FROM tbl_farmers AS tf INNER JOIN tbl_land_details AS tccf ";
			$sql1	.= " 	ON tf.fm_id = tccf.fm_id ";
			$sql1	.= " WHERE tf.fm_id = '".$row_get_user_id1['fm_id']."' ";
			$sql1 	.= " ORDER BY tccf.id DESC ";
			
			$res1 	= mysqli_query($db_con, $sql1) or die(mysqli_error($db_con));
			$num1 	= mysqli_num_rows($res1);
			
			while($row1 = mysqli_fetch_array($res1))
			{
				$sql_insert_2	= " INSERT INTO `tbl_f9_farmer_water_source`(`fm_id`, `water_source_name`, `count`, `status`, `created_date`, `created_by`) ";
				$sql_insert_2	.= " VALUES ('".$row1['fm_id']."', '".$row1['f9_source_of_water']."', '".$num1--."', '1', NOW(), '1') ";
				$res_insert_2	= mysqli_query($db_con, $sql_insert_2) or die(mysqli_error($db_con));
			}
		}
	}
	else
	{
		echo 'Already Dn';
	}
?>