<?php
	include('access1.php');
	include('include/connection.php');
	include('include/query-helper.php');

	$feature_name 	= 'Farmer';
	$home_name    	= "Home";
	$title			= 'View Farmer';
	$home_url 	  	= "home.php";
	$filename		= 'view_farmers.php';
	
	if(!isset($_SESSION['sqyard_user']) && $_SESSION['sqyard_user']=="")
	{
		?>
		<script type="text/javascript">
        history.go(-1);
        </script>
        <?php	
	}
	
	$ca_id	= $_SESSION['ca_id'];
    if($_SESSION['userType']=="Admin")
    {
        $sql   = "select * from tbl_farmers order by id desc";
    }
    else
    {
       $sql	= "select * from tbl_farmers where fm_caid='".$ca_id."' order by id desc";
    }
	$res	= mysqli_query($db_con,$sql) or die(mysqli_error($db_con));
	$r		= 1;	
?>	
<!doctype html>
<html>
    <head>
        <?php
        /* This function used to call all header data like css files and links */
        headerdata($feature_name);
        /* This function used to call all header data like css files and links */
    	?>

    
    </head>
    
    <body class="<?php echo $theme_name; ?>" data-theme="<?php echo $theme_name; ?>">
        <?php
		/*include Bootstrap model pop up for error display*/
		modelPopUp();
		/*include Bootstrap model pop up for error display*/
		/* this function used to add navigation menu to the page*/
		navigation_menu();
		/* this function used to add navigation menu to the page*/
		?> <!-- Navigation Bar -->
        <div class="container-fluid" id="content">
            <div id="main" style="margin-left:0px !important">
                <?php
				/* this function used to add navigation menu to the page*/
				breadcrumbs($home_url,$home_name,'View Farmers',$filename,$feature_name);
				/* this function used to add navigation menu to the page*/
				?>
                <div class="container-fluid">
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="box box-color box-bordered">
                                <div class="box-title">
                                    <h3>
                                        <i class="icon-table"></i>
                                        Farmers
                                    </h3>
                                </div>
                                <div class="box-content nopadding">
                                    <div style="padding:20px">
                                        <a href="add_farmers.php?pag=farmers" class="btn btn-primary">
                                            Add Farmer
                                        </a>
                                    </div>
                                    <form id="mainform" action="deletefarmers.php" method="post">
                                        <div id="comp_1">
                                            <table class="table table-bordered dataTable dataTable-scroll-x">
                                                <thead>
                                                    <tr>
                                                        <th>Sr no.</th>
                                                        <th>Forms</th>
                                                        <th>Docs Upload</th>
                                                        <th>Farmer ID</th>
                                                        <th>Farmer Name</th>
                                                        <th>Aadhaar No</th>
                                                        <th>Mobile No</th>
                                                        <th>Total Points</th>
                                                        <th>Status</th>
                                                        <th class='hidden-350'>Created Date</th>
                                                        <th>Edit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    while($row = mysqli_fetch_array($res))
                                                    {
														$result = lookup_value('tbl_points',array(),array("fm_id"=>$row['fm_id']),array(),array(),array());
														if($result)
														{
															$num	= mysqli_num_rows($result);
															if($num != 0)
															{
																$pt_row	= mysqli_fetch_array($result);
															}
														}
														
														$sum_of_points	= $pt_row['pt_frm1'] + $pt_row['pt_frm2'] + $pt_row['pt_frm3'] + $pt_row['pt_frm4'] + $pt_row['pt_frm5'] + $pt_row['pt_frm6'] + $pt_row['pt_frm7'] + $pt_row['pt_frm8'] + $pt_row['pt_frm8_fh'] + $pt_row['pt_frm9'] + $pt_row['pt_frm10'] + $pt_row['pt_frm11'] + $pt_row['pt_frm12'] + $pt_row['pt_frm13'] + $pt_row['pt_frm14'];
														
														$avg_of_points	= round($sum_of_points / 15, 2);
														
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $r; ?></td>	<!-- Sr. No. -->
                                                            <td style="text-align:center;">
                                                            	<a href="get_farmer_details.php?pag=farmers&fm_id=<?php echo $row['fm_id']; ?>" class="btn btn-primary">View Forms</a>
                                                            </td>	<!-- Forms -->
                                                            <td style="text-align:center;">
                                                                <a href="get_farmerdoc.php?pag=farmers&fm_id=<?php echo $row['fm_id']; ?>" class="btn btn-primary">View Uploads</a>
                                                            </td>	<!-- Docs Upload -->
                                                            <td><?php echo $row['fm_id']; ?></td>	<!-- Farmer ID -->
                                                            <td><?php echo ucwords($row['fm_name']); ?>
                                                            <?php
                                                            $sql_check_point  	= " SELECT * FROM tbl_points ";
															$sql_check_point  	.= " WHERE pt_frm1 !='' AND pt_frm2 !='' ";
															$sql_check_point  	.= " 	AND pt_frm3 !='' AND pt_frm8_fh !='' ";
															$sql_check_point  	.= " 	AND pt_frm6 !='' AND pt_frm7 !='' ";
															$sql_check_point  	.= " 	AND pt_frm8 !='' AND pt_frm9 !='' ";
															$sql_check_point  	.= " 	AND pt_frm10 !='' AND pt_frm5 !='' ";
															$sql_check_point  	.= " 	AND pt_frm12 !='' AND pt_frm13 !='' ";
															$sql_check_point  	.= " 	AND pt_frm11 !='' ";
															$sql_check_point  	.= " 	AND fm_id='".$row['fm_id']."' ";
                                                            $res_check_point  = mysqli_query($db_con,$sql_check_point) or die(mysqli_error($db_con));
                                                            $num_check_point  = mysqli_num_rows($res_check_point);
                                                            if($num_check_point==0)
                                                            {
                                                                echo '<small style="color:red">Incomplete</small>';
                                                            }
                                                            else
                                                            {
                                                                echo '<small style="color:green">Complete</small>';
                                                            }
                                                            ?>
                                                            
                                                            </td>	<!-- Farmer Name -->
                                                            <td><?php echo $row['fm_aadhar']; ?></td>	<!-- Aadhaar Number -->
                                                            <td><?php echo $row['fm_mobileno']; ?></td>	<!-- Mobile Number -->
                                                            <td><?php echo $avg_of_points; ?></td>	<!-- Loan Required (Rs.) -->
                                                            <td><?php echo $row['fm_status']; ?></td>	<!-- Status -->
                                                            <td><?php echo $row['fm_createddt']; ?></td>	<!-- Created Date -->
                                                            <td style="text-align:center;">
                                                            	<a href="edit_farmer.php?pag=farmers&fm_id=<?php echo $row['fm_id']; ?>" class="btn btn-primary">Edit</a>
                                                            </td>	<!-- Edit Farmers -->
                                                        </tr>
                                                        <?php
                                                        $r++;
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       	</div>
    	<script>
        $(document).ready(function(e) {
            
            $("#selectall").click(function(){
                $(".case").attr("checked",this.checked);
            });
            
            $(".case").click(function(){
                if($(".case").length==$(".case:checked").length){
                    $("#selectall").attr("checked","checked");
                }
                else{
                    $("#selectall").removeAttr("checked");
                }
            });
            
        });
        </script>	<!-- Nice Scroll -->
        <script type="text/javascript">
    function confirmAction(id)
    {
            var r = confirm("Do you want to delete?");
            if(r==true)
            {
                window.open('deletevideos.php?id='+id,'_self');
            }
            else
            {
            }
    }
    </script>
		<script language="javascript">
        function getXMLHTTP() { //fuction to return the xml http object
                var xmlhttp=false;	
                try{
                    xmlhttp=new XMLHttpRequest();
                }
                catch(e)	{		
                    try{			
                        xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    catch(e){
                        try{
                        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                        }
                        catch(e1){
                            xmlhttp=false;
                        }
                    }
                }
                    
                return xmlhttp;
            }
            
            function sord(c_value,c_id,c_type) {
                
                
                var strURL="findspasorder.php?c_value="+c_value+"&c_id="+c_id+"&c_type="+c_type;
                var req = getXMLHTTP();
                
                if (req) {
                    
                    req.onreadystatechange = function() {
                        if (req.readyState == 4) {
                            // only if "OK"
                            if (req.status == 200) {						
                                document.getElementById('comp_1').innerHTML=req.responseText;						
                            } else {
                                alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                            }
                        }				
                    }			
                    req.open("GET", strURL, true);
                    req.send(null);
                }		
            }
            
            
            
        
            
        </script>    
	</body>
</html>
