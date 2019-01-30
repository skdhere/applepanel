<?php
	function dataPagination($query,$per_page,$start,$cur_page)
	{
		global $db_con;
		
		$start_offset1  	= 1;	// Start Point
		$start_offset2  	= 1;	// End of the Limit
		$previous_btn 		= true;
		$next_btn 			= true;
		$first_btn 			= true;
		$last_btn 			= true;
		$msg 				= "";
		$result_pag_num 	= mysqli_query($db_con,$query) or die(mysqli_error($db_con));;
		$record_count		= mysqli_num_rows($result_pag_num);	// Total Count of the Record
		$no_of_paginations 	= ceil($record_count / $per_page);	// Getting the total number of pages
		
		/*Edit Count Query*/
		/* ---------------Calculating the starting and endign values for the loop----------------------------------- */
		
		if($cur_page >= 7) 
		{
			$start_loop = $cur_page - 3;
			if ($no_of_paginations > $cur_page + 3)
			{
				$end_loop = $cur_page + 3;			
			}
			elseif($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) 
			{
				$start_loop = $no_of_paginations - 6;
				$end_loop = $no_of_paginations;
			}
			else
			{
				$end_loop = $no_of_paginations;
			}
		} 
		else 
		{		
			$start_loop = 1;
			if ($no_of_paginations > 7)
			{
				$end_loop = 7;			
			}
			else
			{
				$end_loop = $no_of_paginations;			
			}
		}
		/* ----------------------------------------------------------------------------------------------------------- */
		$msg .= "<br><div class='pagination'><ul style='margin-right:20px'>";
		// FOR ENABLING THE FIRST BUTTON
		if ($first_btn && $cur_page > 1) 
		{
			$msg .= "<li p='1' class='active' style='background: none repeat scroll 0 0 #eee;color: #333;font-family: Open Sans,sans-serif;font-size: 13px !important;font-weight:normal;border:none'>First</li>";
		} 
		else if ($first_btn) 
		{
			$msg .= "<li p='1' class='inactive'  style='background: none repeat scroll 0 0 #eee;color: #333;font-family: Open Sans,sans-serif;font-size: 13px !important;font-weight:normal;border:none'>First</li>";
		}
		// FOR ENABLING THE PREVIOUS BUTTON
		if ($previous_btn && $cur_page > 1) 
		{
			$pre = $cur_page - 1;
			$msg .= "<li p='$pre' class='active' style='background: none repeat scroll 0 0 #eee;color: #333;font-family: Open Sans,sans-serif;font-size: 13px !important;font-weight:normal;border:none'>Previous</li>";
		} 
		else if ($previous_btn) 
		{
			$msg .= "<li class='inactive' style='background: none repeat scroll 0 0 #eee;color: #333;font-family: Open Sans,sans-serif;font-size: 13px !important;font-weight:normal;border:none'>Previous</li>";
		}
		
		for ($i = $start_loop; $i <= $end_loop; $i++) 
		{
			if ($cur_page == $i)
				$msg .= "<li p='$i' value='$i' name='li_current' style='background: none repeat scroll 0 0 #F8A31F;color: #ffffff;font-family: Open Sans,sans-serif;font-size: 13px !important;font-weight:normal;border:none' class='active selected'>{$i}</li>";
			else
				$msg .= "<li p='$i' class='active' style='background: none repeat scroll 0 0 #eee;color: #333;font-family: Open Sans,sans-serif;font-size: 13px !important;font-weight:normal;border:none'>{$i}</li>";
		}
		
		// TO ENABLE THE NEXT BUTTON
		if ($next_btn && $cur_page < $no_of_paginations) 
		{
			$nex = $cur_page + 1;
			$msg .= "<li p='$nex' class='active' style='background: none repeat scroll 0 0 #eee;color: #333;font-family: Open Sans,sans-serif;font-size: 13px !important;font-weight:normal;border:none'>Next</li>";
		} 
		else if ($next_btn) 
		{
			$msg .= "<li class='inactive' style='background: none repeat scroll 0 0 #eee;color: #333;font-family: Open Sans,sans-serif;font-size: 13px !important;font-weight:normal;border:none'>Next</li>";
		}
		// TO ENABLE THE END BUTTON
		if ($last_btn && $cur_page < $no_of_paginations) 
		{
			$msg .= "<li p='$no_of_paginations' class='active' style='background: none repeat scroll 0 0 #eee;color: #333;font-family: Open Sans,sans-serif;font-size: 13px !important;font-weight:normal;border:none'>Last</li>";
		} 
		else if ($last_btn) 
		{
			$msg .= "<li p='$no_of_paginations' class='inactive' style='background: none repeat scroll 0 0 #eee;color: #333;font-family: Open Sans,sans-serif;font-size: 13px !important;font-weight:normal;border:none'>Last</li>";
		}
		$goto = "<input type='text' class='goto' size='1' style='margin-top:-1px;margin-left:60px;width:25px !important;'/>";
		$goto .= "<input type='button' id='go_btn' class='go_button' value='Go'/>";
		
		$start_offset1 = $cur_page * $per_page + 1 - $per_page;
		if($end_loop == $cur_page)
		{
			$start_offset2 = $record_count;
		}
		else
		{
			$start_offset2 = $cur_page * $per_page;
		}
		
		// $total_string [Is the actual string i.e. 1 to 20 of 4000 entries only, there is no any pagination include in it]
		$total_string = "</ul>";
		$total_string .= "<div class='total' a='$no_of_paginations' style='color:#333333;font-family: Open Sans,sans-serif;font-size: 13px !important;'>Showing <b>".$start_offset1."</b> to <b>$start_offset2</b> of <b>$record_count</b> entries</div>";
		
		// $msg	[Is the actual string that contain the pagination part first-prev-1-2-3-4-5-6-7-next-last only]
		
		$msg1 = $msg . $total_string ;  // Content for pagination
		if(!$record_count=='0')
		{
			return $msg1;
		}
		else
		{
			return 0;	
		}
	}
?>