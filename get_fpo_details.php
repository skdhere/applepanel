<?php
	include('access1.php');
	include('include/connection.php');
	include('include/query-helper.php');

	$feature_name = 'FPO Details';
	$home_name    = "Home";
	$title        = 'FPO Details';
	$home_url     = "home.php";
	$filename     = 'view_fpo.php';
	$fpo_id       = (isset($_REQUEST['fpo_id'])?$_REQUEST['fpo_id']:"");

	if($fpo_id == "" && (!isset($_SESSION['sqyard_user'])) && $_SESSION['sqyard_user']=="")
    {
        ?>
        <script type="text/javascript">
            history.go(-1);
        </script>
        <?php
    }

	$fpo_name       = '';
	$fpo_email      = '';
	$fpo_mobile_num = '';

    // Query For getting the Farmer Info
	$res_get_fpo_info = lookup_value('tbl_change_agents',array(),array("id"=>$fpo_id),array(),array(),array());
	if($res_get_fpo_info)
	{
		$num_get_fpo_info	= mysqli_num_rows($res_get_fpo_info);
		if($num_get_fpo_info != 0)
		{
			$row_get_fpo_info	= mysqli_fetch_array($res_get_fpo_info);

			$fpo_name       = $row_get_fpo_info['fname'];
			$fpo_email      = $row_get_fpo_info['emailId'];
			$fpo_mobile_num = $row_get_fpo_info['contactno'];			
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<?php
        	//headerdata($feature_name);
			headerdata($fpo_name.'\'s Details');
		?>
<style type="text/css">
	    	/* pagination css */
	    	#container1 .pagination{
	    		width: 100%;
				height: 25px;
				margin: 0 15px;
				clear: both;
	    	}

	    	#container1 .pagination ul {
			    float: right;
			}

			.total {
			    margin: 10px;
			    font-family: arial;
			    color: #999;
			    float: left;
			}

			#container1 .pagination ul li.inactive, #container1 .pagination ul li.inactive:hover {
			    background-color: #ededed;
			    color: #bababa;
			    border: 1px solid #bababa;
			    cursor: default;
			}
			#container1 .pagination ul li:hover {
			    background-color: #DDDDDD !important;
			    color: #000;
			    cursor: pointer;
			}
			#container1 .pagination ul li {
			    list-style: none;
			    float: left;
			    border: 1px solid #329ea9;
			    padding: 2px 6px 2px 6px;
			    margin: 0 3px 0 3px;
			    font-family: arial;
			    font-size: 14px;
			    color: #329ea9;
			    font-weight: bold;
			    background-color: #f2f2f2;
			}

			/* pagination css */
	    </style>

	</head>
	<body class="<?php echo $theme_name; ?>" data-theme="<?php echo $theme_name; ?>">
		<?php
		/*START : Loader*/
		loader();
		/*END : Loader*/
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
				//breadcrumbs($home_url,$home_name,'Farmer Details',$filename,$feature_name);
				breadcrumbs($home_url,$home_name, $fpo_name.'\'s Details',$filename, 'Add FPO Details');
				/* this function used to add navigation menu to the page*/
				?>
				<div class="container-fluid">
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="box box-color box-bordered">
                                <div class="box-title">
                                    <h3>
                                        <i class="icon-table"></i>
                                        <?php echo $fpo_name.'\' Details'; ?>
                                    </h3>
                                </div>
                                <div class="box-content nopadding tab-content-inline">
                                	<ul class="tabs tabs-inline tabs-top">
                                        <li id="main_li_basic_information"  class='active open'>
                                            <a href="javascript:void(0)" data-toggle='tab' onclick="getRespectiveForm('main_li_basic_information','frm_basic_information', <?php echo $fpo_id; ?>);">
                                                <i class="fa fa-inbox"></i>Basic Information
                                            </a>
                                        </li>	<!-- Basic Information -->
                                        <li id="main_li_share_details" >
                                        	<a href="javascript:void(0)" data-toggle='tab' onclick="getRespectiveForm('main_li_share_details','frm_share_details', <?php echo $fpo_id; ?>);">
                                                <i class="fa fa-share"></i>Share Details
                                            </a>
                                        </li>	<!-- Share Details -->
                                        <li id="main_li_training_details" >
                                            <a href="javascript:void(0)" data-toggle='tab' onclick="getRespectiveForm('main_li_training_details','frm_training_details', <?php echo $fpo_id; ?>);">
                                                <i class="fa fa-tag"></i>Training And Assembly Details
                                            </a>
                                        </li>	<!-- Training And Assembly Details -->
                                        <li id="main_li_area_profile"> 
                                            <a href="javascript:void(0)" data-toggle='tab' onclick="getRespectiveForm('main_li_area_profile','frm_area_profile', <?php echo $fpo_id; ?>);">
                                                <i class="fa fa-trash-o"></i>Area Profile
                                            </a>
                                        </li>	<!-- Area Profile -->
                                        <li id="main_li_members"> 
                                            <a href="javascript:void(0)" data-toggle='tab' onclick="getRespectiveForm('main_li_members','frm_members', <?php echo $fpo_id; ?>);">
                                                <i class="fa fa-trash-o"></i>Members
                                            </a>
                                        </li>	<!-- Members -->
                                    </ul>

                                    <div id="div_container" class=" padding tab-content-bottom">
                                    	
                                    	<div class="tab-pane active" id="'.$div_id.'">
							                <div class="box box-bordered box-color">
							                    
							            			<div style="margin: 20px 10px;">
							            				
							            				<div id="div_basic_information">
							            					<?php include('frm_div_basic_information.php'); ?>
							            				</div>
							            				
							            				<div id="div_share_details" style="display: none;">
							            					<?php include('frm_div_share_details.php'); ?>
							            				</div>
							            				
							            				<div id="div_training_details" style="display: none;">
							            					<?php include('frm_div_training_details.php'); ?>
							            				</div>
							            				
							            				<div id="div_area_profile" style="display: none;">
							            					<?php include('frm_div_area_profile.php'); ?>
							            				</div>

														<div id="div_members" style="display: none;">
							            					<?php include('frm_div_members.php'); ?>
							            				</div>							            				

							            			
							                    </div>
							                </div>
							            </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
		<script type="text/javascript">

			$(document).ready(function(){
				// getRespectiveForm('main_li_basic_information', 'frm_basic_information', '<?php //echo $fpo_id; ?>');

			});

			function getOpen(elementId)
			{
				var chk_hasClass = $("#"+elementId).hasClass("open");

				if(chk_hasClass == false)
				{
					// Add Open Class
					$("#"+elementId).addClass("open");
				}
				else
				{
					// Remove Open Class
					$("#"+elementId).removeClass("open");
				}
			}

			function getRespectiveForm(elementId, div_id, fpo_id)
			{
				// alert(elementId+'<==>'+div_id+'<==>'+fpo_id);

				if(div_id == 'frm_basic_information')
				{
					$('#div_basic_information').css('display', 'block');
					$('#div_area_profile').css('display', 'none');
					$('#div_share_details').css('display', 'none');
					$('#div_training_details').css('display', 'none');
					$('#div_members').css('display', 'none');
				}
				else if(div_id == 'frm_share_details')
				{
					$('#div_share_details').css('display', 'block');
					$('#div_area_profile').css('display', 'none');
					$('#div_basic_information').css('display', 'none');
					$('#div_training_details').css('display', 'none');
					$('#div_members').css('display', 'none');
				}
				else if(div_id == 'frm_training_details')
				{
					$('#div_training_details').css('display', 'block');
					$('#div_area_profile').css('display', 'none');
					$('#div_basic_information').css('display', 'none');
					$('#div_share_details').css('display', 'none');
					$('#div_members').css('display', 'none');
				}
				else if(div_id == 'frm_area_profile')
				{
					$('#div_area_profile').css('display', 'block');
					$('#div_basic_information').css('display', 'none');
					$('#div_share_details').css('display', 'none');
					$('#div_training_details').css('display', 'none');
					$('#div_members').css('display', 'none');
				}
				else
				{
					$('#div_members').css('display', 'block');
					$('#div_area_profile').css('display', 'none');
					$('#div_basic_information').css('display', 'none');
					$('#div_share_details').css('display', 'none');
					$('#div_training_details').css('display', 'none');	
				}
			}

			function getDisplayDiv(mainDivVal, DisplayDivID, displayVal) // displayVal = "value on which div will be displayed"
			{
				// alert(mainDivVal+' <==> '+DisplayDivID+' <==> '+displayVal);
				if(mainDivVal == displayVal)
				{
					$('#'+DisplayDivID).slideDown();	
				}
				else
				{
					$('#'+DisplayDivID).slideUp();	
				}
			}

			function getDist(stateParameter, stateVal, distId, talId, villageId, distDivId, talDivId, VillageDivId)
			{
				var sendInfo	= {"stateVal":stateVal, "stateParameter":stateParameter, "distId":distId, "talId":talId, "villageId":villageId, "distDivId":distDivId, "talDivId":talDivId, "VillageDivId":VillageDivId, "load_dist":1};
				var dist_load 	= JSON.stringify(sendInfo);
				
				$.ajax({
					url: "load_farmer.php?",
					type: "POST",
					data: dist_load,
					contentType: "application/json; charset=utf-8",						
					success: function(response) 
					{
						data = JSON.parse(response);
						
						if(data.Success == "Success") 
						{
							$('#'+distDivId).html(data.resp);
							$('#'+distId).select2();
						} 
						else if(data.Success == "fail") 
						{
							//alert(data.resp);
							console.log(data.resp);
						}
					},
					error: function (request, status, error) 
					{
						$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
						$('#error_model').modal('toggle');						
					},
					complete: function()
					{
						//loading_hide();
						//alert("complete");
					}
				});	
			}
			
			function getTal(distParameter, distVal, talId, villageId, talDivId, VillageDivId)
			{
				var sendInfo	= {"distVal":distVal, "distParameter":distParameter, "talId":talId, "villageId":villageId, "talDivId":talDivId, "VillageDivId":VillageDivId, "load_tal":1};
				var tal_load 	= JSON.stringify(sendInfo);
				
				$.ajax({
					url: "load_farmer.php?",
					type: "POST",
					data: tal_load,
					contentType: "application/json; charset=utf-8",						
					success: function(response) 
					{
						data = JSON.parse(response);
						
						if(data.Success == "Success") 
						{
							$('#'+talDivId).html(data.resp);
							$('#'+talId).select2();
						} 
						else if(data.Success == "fail") 
						{
							//alert(data.resp);
							console.log(data.resp);
						}
					},
					error: function (request, status, error) 
					{
						$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
						$('#error_model').modal('toggle');						
					},
					complete: function()
					{
						//loading_hide();
						//alert("complete");
					}
				});	
			}
			
			function getVillage(talParameter, talVal, villageId, VillageDivId)
			{
				var sendInfo		= {"talVal":talVal, "talParameter":talParameter, "villageId":villageId, "VillageDivId":VillageDivId, "load_village":1};
				var village_load 	= JSON.stringify(sendInfo);
				
				$.ajax({
					url: "load_farmer.php?",
					type: "POST",
					data: village_load,
					contentType: "application/json; charset=utf-8",						
					success: function(response) 
					{
						data = JSON.parse(response);
						
						if(data.Success == "Success") 
						{
							$('#'+VillageDivId).html(data.resp);
							$('#'+villageId).select2();
						} 
						else if(data.Success == "fail") 
						{
							//alert(data.resp);
							console.log(data.resp);
						}
					},
					error: function (request, status, error) 
					{
						$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
						$('#error_model').modal('toggle');						
					},
					complete: function()
					{
						//loading_hide();
						//alert("complete");
					}
				});	
			}

			function numsonly(e)
			{
				var unicode=e.charCode? e.charCode : e.keyCode
				
				if (unicode !=8 && unicode !=32 &&  unicode !=46)
				{  // unicode<48||unicode>57 &&
					if ( unicode<48||unicode>57)  //if not a number
					return false //disable key press
				}
			}
		</script>
	</body>
</html>