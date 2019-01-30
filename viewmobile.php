<?php
include('include/connection.php');
$comp2=strtolower($_REQUEST['comp2']);
if($comp2!="")
{
$sql_pin1="select * from tbl_farmers where fm_mobileno='$comp2'";
$res_pin1=mysqli_query($db_con,$sql_pin1) or die(mysqli_error($db_con));
$tot_pin1=mysqli_num_rows($res_pin1);

?>

				<?php
				if($tot_pin1==0)
				{	
				?>			
				<input type="text" id="mobile"  style="display:none" value="1"  /><span style="color:#063"></span>
                
				<?php
			
			  }
			  else
			  {
				  ?>
				<input type="text" id="mobile"  style="display:none"  value="2"   /> <span>Mobile Number already in use</span>
			  
              <?php
			   }
}
			  ?>
