<?php
	 include('./config/autoload.php');

	$feature_name  = 'Farmer Details';
	$home_name     = "Home";
	$title		   = 'Farmer Details';
	$home_url      = "home.php";
	$filename      = 'view_farmers.php';
	$fm_id         = (isset($_REQUEST['fm_id'])?$_REQUEST['fm_id']:"");
	
	if($fm_id == "" && (!isset($_SESSION['sqyard_user'])) && $_SESSION['sqyard_user']=="")
    {
        ?>
        <script type="text/javascript">
            history.go(-1);
        </script>
        <?php
    }
	
	$avg_of_points	= '';
	
	
	
	//echo $avg_of_points;
	
	// Query For getting the Farmer Info
	$res_get_farmer_info = lookup_value('tbl_farmers',array(),array("fm_id"=>$fm_id),array(),array(),array());
	if($res_get_farmer_info)
	{
		$num_get_farmer_info	= mysqli_num_rows($res_get_farmer_info);
		if($num_get_farmer_info != 0)
		{
			$row_get_farmer_info	= mysqli_fetch_array($res_get_farmer_info);
		}
	}
	
	$farmer_name          = ucwords($row_get_farmer_info['fm_name']);
	$farmer_mobile_number = $row_get_farmer_info['fm_mobileno'];
	$farmer_ca_id         = $row_get_farmer_info['fm_caid'];
	
   
	
	
	
	
	
	
	
	
	
    // Query for chacking user is married or not
    
?>
<!DOCTYPE html>
<html>
    <head>
    	<?php
        	//headerdata($feature_name);
			headerdata($farmer_name.'\'s Details');
		?>
		
    </head>
    
    <body class="<?php echo THEME_NAME ?>" data-theme="<?php echo THEME_NAME ?>">
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
				breadcrumbs($home_url,$home_name, $farmer_name.'\'s Details',$filename, $farmer_name.'\'s Details');
				/* this function used to add navigation menu to the page*/
				?>
                <div class="container-fluid">
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="box box-color box-bordered">
                                <div class="box-title">
                                    <h3>
                                        <i class="icon-table"></i>
                                        <?php echo $farmer_name.'\' Details'; ?>
                                    </h3>
                                </div>
                                <div class="box-content nopadding tab-content-inline">
	                            	<ul class="tabs tabs-inline tabs-top">
                                        <li id="main_li_section_b" class='active'>
                                            <a href="#section_b" data-toggle='tab'>
                                                <i class="fa fa-inbox"></i>Section B
                                            </a>
                                        </li>	<!-- Section B -->
                                        <li id="main_li_land">
                                        	<a href="#land" data-toggle='tab'>
                                                <i class="fa fa-share"></i>Section C
                                            </a>
                                        </li>	<!-- Section c -->
                                        <li id="main_li_crop">
                                            <a href="#crop" data-toggle='tab'>
                                                <i class="fa fa-tag"></i>Section D
                                            </a>
                                        </li>	<!-- Section d -->
                                        <li id="main_li_assets">
                                            <a href="#assets" data-toggle='tab'>
                                                <i class="fa fa-trash-o"></i>Section F
                                            </a>
                                        </li>	<!-- Section F -->
                                    </ul>
                                    <div class="tab-content padding tab-content-inline tab-content-bottom">
                                        <!-- =========== -->
                                        <!-- START : KYC -->
                                        <!-- =========== -->
                                        <div class="tab-pane active" id="section_b">
                                            <div class="box box-bordered box-color lightgrey">
                                                <div class="box-content nopadding">
                                                    <div class="tas-container">
                                                        <ul class="tabs tabs-inline tabs-left">
                                                            
                                                            <li id="li_appli_knowledge" class="active">
                                                                <a href="#div_appli_knowledge"  data-toggle='tab'>
                                                                    <i class="fa fa-user"></i>What is your farm's land size		
                                                                   
                                                                </a>
                                                            </li>	<!-- Applicant's Knowledge -->
                                                            <li id="li_phone_details">
                                                                <a href="#div_phone_details" data-toggle='tab'>
                                                                    <i class="fa fa-twitter"></i>Which are the mail crops (Food grains, Fruits and vegetables) that you grown		

                                                                   
                                                                </a>
                                                            </li>	<!-- Applicant's Phone Details -->
                                                            <li id="li_family_details">
                                                                <a href="#div_family_details" data-toggle='tab'>
                                                                    <i class="fa fa-twitter"></i>What are the main sources of irrigation in your orchard (Can be more than one)		

                                                                   
                                                                </a>
                                                            </li>	<!-- Family Details -->
                                                            <li id="li_appliances_motors">
                                                                <a href="#div_appliances_motors" data-toggle='tab'>
                                                                    <i class="fa fa-twitter"></i>Appliances / Motors
                                                                    
                                                                </a>
                                                            </li>	<!-- Appliances / Motors -->
                                                        </ul>
                                                    </div>	<!-- Side Menu [Form Name] -->
                                                    <div class="tab-content padding tab-content-inline">
                                                        
                                                        <div class="tab-pane active" style="min-height: 340px"  id="div_appli_knowledge">
                                                           	<form method="POST" enctype="multipart/form-data" class='form-horizontal form-bordered form-validate' id="frm_applicant_knowledge" name="frm_applicant_knowledge">
                                                            	
                                                                <input type="hidden" id="add_knowledge_detail" name="add_knowledge_detail" value="1">
                                                                <input type="hidden" id="fm_id" name="fm_id" value="<?php echo $fm_id ?>">
                                                                <input type="hidden" id="fm_caid" name="fm_caid" value="<?php echo $farmer_ca_id; ?>">
                                                                <input type="hidden" id="f2_points" name="f2_points" value="<?php if(isset($data['f2_points'])) {echo $data['f2_points'];} ?>">
                                                                
                                                                <div class="form-content">
                                                                	
                                                                    <div class="control-group">
                                                                        <label for="text" class="control-label" style="margin-top:10px">Educational Qualification Details <span style="color:#F00">*</span></label>
                                                                        <div class="controls">
                                                                            <select id="f2_edudetail" name="f2_edudetail" class="select2-me input-xlarge" data-rule-required="true" onchange="calTotal_f2()">
                                                                                <option value="" disabled selected> Select here</option>
                                                                                <option value="illiterate" point="2" <?php if((isset($data['f2_edudetail'])) && $data['f2_edudetail'] == 'illiterate'){ ?> selected <?php } ?>>Illiterate</option>
                                                                                <option value="primary education" point="4" <?php if((isset($data['f2_edudetail'])) && $data['f2_edudetail'] == 'primary education'){ ?> selected <?php } ?>>Primary Education</option>
                                                                                <option value="matriculate" point="6" <?php if((isset($data['f2_edudetail'])) && $data['f2_edudetail'] == 'matriculate'){ ?> selected <?php } ?>>Matriculate</option>
                                                                                
                                                                                <option value="12th Standard" point="8" <?php if((isset($data['f2_edudetail'])) && $data['f2_edudetail'] == '12th Standard'){ ?> selected <?php } ?>>12th Standard</option>

                                                                                <option value="graduate" point="8" <?php if((isset($data['f2_edudetail'])) && $data['f2_edudetail'] == 'graduate'){ ?> selected <?php } ?>>Graduate</option>

                                                                                <option value="post graduate" point="10" <?php if((isset($data['f2_edudetail'])) && $data['f2_edudetail'] == 'post graduate'){ ?> selected <?php } ?>>Post Graduate</option>

																				<option value="phd" point="10" <?php if((isset($data['f2_edudetail'])) && $data['f2_edudetail'] == 'phd'){ ?> selected <?php } ?>>Ph. D.</option>                                                                                
                                                                            </select>
                                                                        </div>
                                                                    </div>	<!-- Educational Qualification Details [DDL] -->
                                                                    
                                                                    <div class="control-group">
                                                                        <label for="text" class="control-label" style="margin-top:10px">Regional Language Knowledge <span style="color:#F00">*</span></label>
                                                                        <div class="controls">
                                                                            <select id="f2_proficiency" data-rule-required="true" name="f2_proficiency" class="select2-me input-xlarge" onchange="calTotal_f2()">
                                                                                <option value="" disabled selected> Select here</option>
                                                                                <option value="read write" point="10" <?php if((isset($data['f2_proficiency'])) && $data['f2_proficiency'] == 'read write'){ ?> selected <?php } ?>>Read and Write</option>
                                                                                <option value="read only" point="5" <?php if((isset($data['f2_proficiency'])) && $data['f2_proficiency'] == 'read only'){ ?> selected <?php } ?>>Read Only</option>
                                                                                <option value="understand only" point="0" <?php if((isset($data['f2_proficiency'])) && $data['f2_proficiency'] == 'understand only'){ ?> selected <?php } ?>>Understand Only</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>	<!-- Regional Language Knowledge [DDL] -->
                                                                    
                                                                    <!-- <div class="control-group">
                                                                        <label for="text" class="control-label" style="margin-top:10px">Participation in Farming Programs</label>
                                                                        <div class="controls">
                                                                            <select id="f2_participation" data-rule-required="true" name="f2_participation" class="select2-me input-xlarge">
                                                                                <option value="" disabled selected> Select here</option>
                                                                                <option value="yes" point="10" <?php //if((isset($data['f2_participation'])) && $data['f2_participation'] == 'yes'){ ?> selected <?php //} ?>> Yes</option>
                                                                                <option value="no" point="0" <?php //if((isset($data['f2_participation'])) && $data['f2_participation'] == 'no'){ ?> selected <?php //} ?>> No</option>
                                                                            </select>
                                                                        </div>
                                                                    </div> -->	<!-- Participation in any Farming Program / Trainings [DDL] -->
                                                                    
                                                                    <div id="program_detail" style="display: none; padding: 10px; border:1px solid #d6d6d6; margin: 20px;">
                                                                    	
                                                                        <div class="control-group">
                                                                            <label for="text" class="control-label" style="margin-top:10px">Type of the training Programs<span style="color:#F00">*</span></label>
                                                                            <div class="controls">
                                                                                <select id="f2_typeprog" name="f2_typeprog" class="select2-me input-xxlarge" data-rule-required="true">
                                                                                    <option value="" disabled selected> Select here</option>
                                                                                   
                                                                                </select>
                                                                            </div>
                                                                        </div>	<!-- Type of Training Programs [If Yes] -->
                                                                    
                                                                    	<div class="control-group">
                                                                            <label for="numberfield" class="control-label">
                                                                                What was the duration of the program?<span style="color:#F00">*</span>
                                                                            </label>
                                                                            <div class="controls">
                                                                                <input type="text" placeholder="00" id="f2_durprog" name="f2_durprog" value="<?php if((isset($data['f2_durprog'])) && $data['f2_durprog'] != ''){ echo $data['f2_durprog']; } ?>" class="input-xlarge v_number" data-rule-required="true" data-rule-number="true"  data-rule-maxlength="3"> Days
                                                                            </div>
                                                                        </div>  <!-- What was the duration of the program [If Yes] -->
                                                                        
                                                                        <div class="control-group">
                                                                            <label for="text" class="control-label" style="margin-top:10px">
                                                                                Who conducted the Program? <span style="color:#F00">*</span>
                                                                            </label>
                                                                            <div class="controls">
                                                                                <input type="text" placeholder="Who conducted the Program" id="f2_condprog" name="f2_condprog" value="<?php if((isset($data['f2_condprog'])) && $data['f2_condprog'] != ''){ echo $data['f2_condprog']; } ?>" class="input-xlarge v_name" data-rule-required="true" data-rule-minlength="4" data-rule-maxlength="100">
                                                                            </div>
                                                                        </div>  <!-- Who conducted the Program [If Yes] -->
                                                                        
                                                                        <div class="control-group">
                                                                            <label for="text" class="control-label" style="margin-top:10px">
                                                                                For which crop was the program held? <span style="color:#F00">*</span>
                                                                            </label>
                                                                            <div class="controls">
                                                                                <input type="text" placeholder="Name" id="f2_cropprog" name="f2_cropprog" class="input-xlarge v_name" value="<?php if((isset($data['f2_cropprog'])) && $data['f2_cropprog'] != ''){ echo $data['f2_cropprog']; } ?>" data-rule-required="true" data-rule-minlength="4" data-rule-maxlength="100">
                                                                            </div>
                                                                        </div>  <!-- For which crop was the program held [If Yes] -->
                                                                        
                                                                    </div>
                                                                    
                                                                    <div class="form-actions">
                                                                        <input type="reset" class="btn" value="Back" id="back">
                                                                        <input type="submit" class="btn btn-primary" value="Save" id="save">
                                                                    </div>	<!-- Back and Save -->
                                                                    
                                                                </div>
                                                            
                                                            </form>
                                                            <h1 id="applicant_knowledge_g_total">0</h1> 
                                                        </div>	<!-- Applicant's Knowledge -->
                                                        <div class="tab-pane" style="min-height: 340px" id="div_phone_details">
                                                           	Applicant's Phone Details
                                                        	
                                                            <h1 id="phone_details_g_total">0</h1>
                                                        </div>	<!-- Applicant's Phone Details -->
                                                        <div class="tab-pane" style="min-height: 340px" id="div_family_details">
                                                            Family Details
                                                            
                                                            <h1 id="family_details_g_total">0</h1> 
                                                        </div>	<!-- Family Details -->
                                                        <div class="tab-pane" style="min-height: 340px" id="div_appliances_motors">
                                                            <div class="span10" style="padding: 5px; border: 1px solid #d6d6d6; margin: 5px;">
                                                                <h3>What appliances are there in your house? Also mention their count.</h3>
                                                            	
                                                                <h1 id="appliances_motors_g_total">0</h1> 
                                                            </div>
                                                        </div>	<!-- Appliances / Motors -->
                                                    </div>	<!-- Main Forms -->
                                                </div>
                                            </div>
                                        </div>	<!-- KYC [COMPLETE] -->
                                        <!-- =========== -->
                                        <!-- END   : KYC -->
                                        <!-- =========== -->
                                        
                                        
                                    </div>
                                </div>
                            </div>
                       	</div>
                   	</div>
               	</div>
           	</div>
        </div>

        <div class="modal fade" id="confirm_box_land" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">Remove Confirmation</h4>
                    </div>
                    <div class="modal-body">
                        <p >Are you sure want to remove land?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="addMoreLand(1);" data-dismiss="modal">
                            Yes
                        </button>
                        &nbsp;
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            No
                        </button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>	<!-- confirm_box_land -->

		<div class="modal fade" id="confirm_box_crop" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    	<h4 class="modal-title">Remove Confirmation</h4>
                    </div>
                    <div class="modal-body">
                    	<p >Are you sure want to remove crop?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary removeCrop_btn"  data-dismiss="modal">Yes</button>&nbsp;
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>	<!-- confirm_box_crop -->
        
        <div class="modal fade" id="confirm_box_prev_crop" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    	<h4 class="modal-title">Remove Confirmation</h4>
                    </div>
                    <div class="modal-body">
                    	<p >Are you sure want to remove crop?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary removePrevCrop_btn"  data-dismiss="modal">Yes</button>&nbsp;
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>	<!-- confirm_box_prev_crop -->
        
        <div class="modal fade" id="confirm_box_cur_crop" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    	<h4 class="modal-title">Remove Confirmation</h4>
                    </div>
                    <div class="modal-body">
                    	<p >Are you sure want to remove crop?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary removeCurCrop_btn"  data-dismiss="modal">Yes</button>&nbsp;
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>	<!-- confirm_box_cur_crop -->
        
        <div class="modal fade" id="confirm_box_loan_frm1" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    	<h4 class="modal-title">Remove Confirmation</h4>
                    </div>
                    <div class="modal-body">
                    	<p >Are you sure want to remove this Loan part?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary removeLoanFrm1_btn"  data-dismiss="modal">Yes</button>&nbsp;
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>	<!-- confirm_box_loan_frm1 -->
		
        <script type="text/javascript">
			var spouse_g_total 				= 0;
			var applicant_knowledge_g_total	= 0;
			var phone_details_g_total		= 0;
			var family_details_g_total		= 0;
			var appliances_motors_g_total	= 0;
			var farm_land_details_g_total	= 0;
			var asset_details_g_total		= 0;
			var live_stock_g_total			= 0;
			var crop_cultivation_g_total	= 0;
			var prev_crop_cycle_g_total		= 0;
			var cur_crop_cycle_g_total		= 0;
			var financial_details_g_total	= 0;
			var financial_history_g_total	= 0;
			
			var contentCountLand 			= <?php echo $no_of_land; ?>;
			var contentCountCrop 			= <?php echo $no_of_crops; ?>;
			var contentCountPrevCrop 		= <?php echo $no_of_prev_crops; ?>;
			var contentCountCurCrop			= <?php echo $no_of_cur_crops; ?>;
			var contentCountLoanFrm1		= <?php echo $no_of_loan || 1; ?> ;

			$(document).ready(function()
			{
				getYearlyIncome($('#f13_livestock_income').val());

				// START : f3 //#f3_spouse_shg, , #f3_spouse_income
				$('body').on('change','#f3_spouse_age, #f3_spouse_occp', function(){
					calTotal_f3();
				});
	
				/*$('#f3_married').on('change', function(){
					
					if($(this).val() == 'yes'){
						$('#spouse_detail').show('swing');
					}
					else
					{
						$('#spouse_detail').hide('swing');
						$('#spouse_detail').find('input, select').val('').trigger('change');
					}
					calTotal_f3();
				});*/
				
				 
				// $('#f3_spouse_owned_prop').on('change', function(){
					
				// 	if($(this).val() == 'yes')
				// 	{
				// 		$('#div_f3_spouse_owned_prop_display').show('swing');
				// 	}
				// 	else
				// 	{
				// 		$('#div_f3_spouse_owned_prop_display').hide('swing');
				// 		$('#div_f3_spouse_owned_prop_display').find('input, select').val('').trigger('change');
				// 	}
				// });
				
				// if($('#f3_spouse_owned_prop').val() == 'yes')
				// {
				// 	$('#div_f3_spouse_owned_prop_display').show('swing');
				// }
				// else
				// {
				// 	$('#div_f3_spouse_owned_prop_display').hide('swing');
				// 	$('#div_f3_spouse_owned_prop_display').find('input, select').val('').trigger('change');
				// }
				
				// $('#f3_spouse_prop_type').on('change', function(){
					
				// 	if($(this).val() == 'Other')
				// 	{
				// 		$('#div_other_prop_display').show('swing');
				// 	}
				// 	else
				// 	{
				// 		$('#div_other_prop_display').hide('swing');
				// 		$('#div_other_prop_display').find('input, select').val('').trigger('change');
				// 	}
				// });
				
				// if($('#f3_spouse_prop_type').val() == 'Other')
				// {
				// 	$('#div_other_prop_display').show('swing');
				// }
				// else
				// {
				// 	$('#div_other_prop_display').hide('swing');
				// 	$('#div_other_prop_display').find('input, select').val('').trigger('change');
				// }
				
				  
				// $('#f3_spouse_get_any_income').on('change', function(){
					
				// 	if($(this).val() == 'yes')
				// 	{
				// 		$('#div_income_display').show('swing');
				// 	}
				// 	else
				// 	{
				// 		$('#div_income_display').hide('swing');
				// 		$('#div_income_display').find('input, select').val('').trigger('change');
				// 	}
				// });
				
				// if($('#f3_spouse_get_any_income').val() == 'yes')
				// {
				// 	$('#div_income_display').show('swing');
				// }
				// else
				// {
				// 	$('#div_income_display').hide('swing');
				// 	$('#div_income_display').find('input, select').val('').trigger('change');
				// }
				
				if($('#f3_married').val() == 'yes')
				{
					$('#spouse_detail').show('swing');
					calTotal_f3();
				}
				else
				{
					$('#spouse_detail').hide('swing');
					$('#spouse_detail').find('input, select').val('').trigger('change');
					calTotal_f3();	
				}
	
				// $('#f3_spouse_mfi').on('change', function(){
				// 	if($(this).val() == 'yes'){
				// 		$('#microfinance').show('swing');
				// 	}
				// 	else
				// 	{
				// 		$('#microfinance').hide('swing');
				// 		$('#microfinance').find('input, select').val('').trigger('change');
				// 	}
				// 	calTotal_f3();
				// });
	
				// if($('#f3_spouse_mfi').val() == 'yes')
				// {
				// 	$('#microfinance').show('swing');
				// }
				// else
				// {
				// 	$('#microfinance').find('input, select').val('');
				// }
	
				// $('#f3_affliation_status').on('change', function(){
				// 	if($(this).val() == 'yes'){
				// 		$('#div_affliation_display').show('swing');
				// 	}
				// 	else
				// 	{
				// 		$('#div_affliation_display').hide('swing');
				// 		$('#div_affliation_display').find('input, select').val('');
				// 	}
				// 	calTotal_f3();	
				// });
				
				// if($('#f3_affliation_status').val() == 'yes')
				// {
				// 	$('#div_affliation_display').show('swing');	
				// }
				// else
				// {
				// 	$('#div_affliation_display').find('input, select').val('');
				// }
	
				// $('#f3_spouse_shg').on('change', function(){
				// 	if($(this).val() == 'yes'){
				// 		$('#shg_name').show('swing');
				// 	}
				// 	else
				// 	{
				// 		$('#shg_name').hide('swing');
				// 		$('#shg_name').find('input, select').val('');
				// 	}
				// 	calTotal_f3();
				// });
				
				// if($('#f3_spouse_shg').val() == 'yes')
				// {
				// 	$('#shg_name').show('swing');
				// }
				// else
				// {
				// 	$('#shg_name').find('input, select').val('');
				// }
	
				$('#f3_spouse_occp').on('change', function(){
					if($(this).val() == 'housewife'){
						$('#input_income').hide('swing').find('input').val('');
					}
					else
					{
						$('#input_income').show('swing');
						$('#input_income').val('');
					}
					calTotal_f3();
				});

				if($('#f3_spouse_occp').val() == 'other' || $('#f3_spouse_occp').val() == 'farmer')
				{
					$('#input_income').show('swing');	
				}
				else
				{
					$('#input_income').find('input, select').val('');
				}
				
				if($('#f3_married').val() == 'yes'){
					$('#spouse_detail').show('swing');
				}
				
				// if($('#f3_spouse_occp').val() == 'other' || $('#f3_spouse_occp').val() == 'farmer')
				// {
				// 	$('#input_income').show('swing');	
				// }
				// END : f3
				
				// START : f2
				$('#f2_edudetail').on('change', function(){
					calTotal_f2();
				});
				
				$('#f2_proficiency').on('change', function(){
					calTotal_f2();
				});
				//$('#f2_participation').trigger('change');
				//$('#f2_typeprog').trigger('change');
				// END : f2
				
				// START : f5
				$('#f5_phonetype').on('change', function(){
					if($(this).val() == 'smartphone'){
						$('#div_smartphone_display').show('swing');
					}
					else
					{
						$('#div_smartphone_display').hide('swing');
						$('#div_smartphone_display').find('input, select').val('').trigger('change');
					}
					calTotal_f5();
				});
				
				$('#f5_any_one_have_smart_phone').on('change', function(){
					calTotal_f5();
				}); 
				
				$('#f5_datapack').on('change', function(){ 
					calTotal_f5();
				});
				
				$('#f5_farmapp').on('change', function(){
					calTotal_f5();
				});
				
				$('#f5_appuse').on('change', function(){
					if($(this).val() == 'yes'){
						$('#div_app_name_display').show('swing');
					}
					else
					{
						$('#div_app_name_display').hide('swing');
						$('#div_app_name_display').find('input, select').val('').trigger('change');
					}
				});
				// END : f5
				
				// START : f6
				// $('#f6_children').on('change', function(){
				// 	if($(this).val() == '0' || $(this).val() == '' || $(this).val() == null){
				// 		//$('#use_smartphone').show('swing');
				// 		$('#use_smartphone').hide('swing');
				// 		$('#use_smartphone').find('input, select').val('').trigger('change');
				// 	}
				// 	else
				// 	{
				// 		//$('#use_smartphone').hide('swing');
				// 		//$('#use_smartphone').find('input, select').val('').trigger('change');
				// 		$('#use_smartphone').show('swing');
				// 	}
				// 	calTotal_f6();
				// });
				// END : f6
				
				// START : f7
				$('#f7_television').on('blur', function(){
					if($(this).val() != '' && $(this).val() != 'null')
					{
						calTotal_f7();
					}
				});
				
				$('#f7_refrigerator').on('blur', function(){
					if($(this).val() != '' && $(this).val() != 'null')
					{
						calTotal_f7();
					}
				});
				
				$('#f7_wmachine').on('blur', function(){
					if($(this).val() != '' && $(this).val() != 'null')
					{
						calTotal_f7();
					}
				});
				   
				$('#f7_mixer').on('blur', function(){
					if($(this).val() != '' && $(this).val() != 'null')
					{
						calTotal_f7();
					}
				});
				
				$('#f7_stove').on('blur', function(){
					if($(this).val() != '' && $(this).val() != 'null')
					{
						calTotal_f7();
					}
				});
				
				$('#f7_bicycle').on('blur', function(){
					if($(this).val() != '' && $(this).val() != 'null')
					{
						calTotal_f7();
					}
				});
				   
				$('#f7_ccylinder').on('blur', function(){
					if($(this).val() != '' && $(this).val() != 'null')
					{
						calTotal_f7();
					}
				});
				
				$('#f7_fans').on('blur', function(){
					if($(this).val() != '' && $(this).val() != 'null')
					{
						calTotal_f7();
					}
				});
				
				$('#f7_motorcycle').on('blur', function(){
					if($(this).val() != '' && $(this).val() != 'null')
					{
						calTotal_f7();
					}
				});
				
				$('#f7_car').on('blur', function(){
					if($(this).val() != '' && $(this).val() != 'null')
					{
						calTotal_f7();
					}
				});
				// END : f7
				
				// START : f12
				$('#f12_TRACTOR').on('blur', function(){
					if($(this).val() != '' && $(this).val() != 'null')
					{
						calTotal_f12();
					}
				});

				// $('#f12_COMBINE_HARVESTER').on('blur', function(){
				// 	if($(this).val() != '' && $(this).val() != 'null')
				// 	{
				// 		calTotal_f12();
				// 	}
				// });

				// $('#f12_PLOW').on('blur', function(){
				// 	if($(this).val() != '' && $(this).val() != 'null')
				// 	{
				// 		calTotal_f12();
				// 	}
				// });

				// $('#f12_PLANTER').on('blur', function(){
				// 	if($(this).val() != '' && $(this).val() != 'null')
				// 	{
				// 		calTotal_f12();
				// 	}
				// });

				// $('#f12_LOADER').on('blur', function(){
				// 	if($(this).val() != '' && $(this).val() != 'null')
				// 	{
				// 		calTotal_f12();
				// 	}
				// });

				// $('#f12_BAILER').on('blur', function(){
				// 	if($(this).val() != '' && $(this).val() != 'null')
				// 	{
				// 		calTotal_f12();
				// 	}
				// });

				// $('#f12_SKID_STEER_LOADER').on('blur', function(){
				// 	if($(this).val() != '' && $(this).val() != 'null')
				// 	{
				// 		calTotal_f12();
				// 	}
				// });

				// $('#f12_MOWER').on('blur', function(){
				// 	if($(this).val() != '' && $(this).val() != 'null')
				// 	{
				// 		calTotal_f12();
				// 	}
				// });

				// $('#f12_REAPER').on('blur', function(){
				// 	if($(this).val() != '' && $(this).val() != 'null')
				// 	{
				// 		calTotal_f12();
				// 	}
				// });

				// $('#f12_THRESHING_MACHINE').on('blur', function(){
				// 	if($(this).val() != '' && $(this).val() != 'null')
				// 	{
				// 		calTotal_f12();
				// 	}
				// });

				// $('#f12_SEED_DRILL').on('blur', function(){
				// 	if($(this).val() != '' && $(this).val() != 'null')
				// 	{
				// 		calTotal_f12();
				// 	}
				// });

				// $('#f12_DISC_HARROW').on('blur', function(){
				// 	if($(this).val() != '' && $(this).val() != 'null')
				// 	{
				// 		calTotal_f12();
				// 	}
				// });

				// $('#f12_TRANSPLANTER').on('blur', function(){
				// 	if($(this).val() != '' && $(this).val() != 'null')
				// 	{
				// 		calTotal_f12();
				// 	}
				// });

				// $('#f12_ROLLER').on('blur', function(){
				// 	if($(this).val() != '' && $(this).val() != 'null')
				// 	{
				// 		calTotal_f12();
				// 	}
				// });

				// $('#f12_SUBSPOILER').on('blur', function(){
				// 	if($(this).val() != '' && $(this).val() != 'null')
				// 	{
				// 		calTotal_f12();
				// 	}
				// });

				// $('#f12_STONE_PICKER').on('blur', function(){
				// 	if($(this).val() != '' && $(this).val() != 'null')
				// 	{
				// 		calTotal_f12();
				// 	}
				// });

				// $('#f12_DRILL').on('blur', function(){
				// 	if($(this).val() != '' && $(this).val() != 'null')
				// 	{
				// 		calTotal_f12();
				// 	}
				// });

				// $('#f12_CONDITIONER').on('blur', function(){
				// 	if($(this).val() != '' && $(this).val() != 'null')
				// 	{
				// 		calTotal_f12();
				// 	}
				// });

				// $('#f12_CHASER_BIN').on('blur', function(){
				// 	if($(this).val() != '' && $(this).val() != 'null')
				// 	{
				// 		calTotal_f12();
				// 	}
				// });

				// $('#f12_STEAM_TRACTOR').on('blur', function(){
				// 	if($(this).val() != '' && $(this).val() != 'null')
				// 	{
				// 		calTotal_f12();
				// 	}
				// });

				// $('#f12_HAY_RAKE').on('blur', function(){
				// 	if($(this).val() != '' && $(this).val() != 'null')
				// 	{
				// 		calTotal_f12();
				// 	}
				// });

				$('#f12_Sprayer').on('blur', function(){
					if($(this).val() != '' && $(this).val() != 'null')
					{
						calTotal_f12();
					}
				});

				// $('#f12_Rice_Huller').on('blur', function(){
				// 	if($(this).val() != '' && $(this).val() != 'null')
				// 	{
				// 		calTotal_f12();
				// 	}
				// });

				$('#f12_Pumps').on('blur', function(){
					if($(this).val() != '' && $(this).val() != 'null')
					{
						calTotal_f12();
					}
				});

				$('#f12_Protavator').on('blur', function(){
					if($(this).val() != '' && $(this).val() != 'null')
					{
						calTotal_f12();
					}
				});

				// $('#f12_Blower').on('blur', function(){
				// 	if($(this).val() != '' && $(this).val() != 'null')
				// 	{
				// 		calTotal_f12();
				// 	}
				// });

				// $('#f12_Cutters').on('blur', function(){
				// 	if($(this).val() != '' && $(this).val() != 'null')
				// 	{
				// 		calTotal_f12();
				// 	}
				// });

				$('#f12_Cultivators').on('blur', function(){
					if($(this).val() != '' && $(this).val() != 'null')
					{
						calTotal_f12();
					}
				});

				$('#f12_any_other_assets').on('change', function(){
					if($(this).val() == 'yes'){
						$('#div_any_other_assets_display').show('swing');
					}
					else
					{
						$('#div_any_other_assets_display').hide('swing');
						$('#div_any_other_assets_display').find('input, select').val('').trigger('change');
					}
					calTotal_f12();
				});
				// END : f12
				
				// START : f13
				$('#f13_dairy_cattle').on('blur', function(){
					if($(this).val() != '' && $(this).val() != 'null')
					{
						calTotal_f13();
					}
				});
				
				$('#f13_draft_cattle').on('blur', function(){
					if($(this).val() != '' && $(this).val() != 'null')
					{
						calTotal_f13();
					}
				});
				
				$('#f13_buffalo').on('blur', function(){
					if($(this).val() != '' && $(this).val() != 'null')
					{
						calTotal_f13();
					}
				});
				   
				$('#f13_ox').on('blur', function(){
					if($(this).val() != '' && $(this).val() != 'null')
					{
						calTotal_f13();
					}
				});
				
				$('#f13_sheep').on('blur', function(){
					if($(this).val() != '' && $(this).val() != 'null')
					{
						calTotal_f13();
					}
				});
				
				$('#f13_goat').on('blur', function(){
					if($(this).val() != '' && $(this).val() != 'null')
					{
						calTotal_f13();
					}
				});
				   
				$('#f13_pig').on('blur', function(){
					if($(this).val() != '' && $(this).val() != 'null')
					{
						calTotal_f13();
					}
				});
				
				$('#f13_poultry').on('blur', function(){
					if($(this).val() != '' && $(this).val() != 'null')
					{
						calTotal_f13();
					}
				});
				
				$('#f13_livestock_income').on('blur', function(){
					if($(this).val() != '' && $(this).val() != 'null')
					{
						calTotal_f13();
					}
				});
				// END : f13
				
				$('#f5_phonetype').val('<?= @$data['f5_phonetype']; ?>');
				$('#f5_servpro').val('<?= @$data['f5_servpro']; ?>');
				$('#f5_network').val('<?= @$data['f5_network']; ?>');
				$('#f5_datapack').val('<?= @$data['f5_datapack']; ?>');
				$('#f5_datapackname').val('<?= @$data['f5_datapackname']; ?>');
				$('#f5_appuse').val('<?= @$data['f5_appuse']; ?>');
				$('#f5_farmapp').val('<?= @$data['f5_farmapp']; ?>');
				$('#f5_any_one_have_smart_phone').val('<?= @$data['f5_any_one_have_smart_phone']; ?>');
				$('#f5_app_name').val('<?= @$data['f5_app_name']; ?>');
				//$('input, select').trigger('change');
				
				$('#f6_members').val('<?= @$data['f6_members']; ?>');
				$('#f6_children').val('<?= @$data['f6_children']; ?>');
				
				$('#f12_machinery').val('<?= @$data['f12_machinery']; ?>');
				$('#f12_vehicle').val('<?= @$data['f12_vehicle']; ?>');	
				$('#f12_total_val_of_vehical').val('<?= @$data['f12_total_val_of_vehical']; ?>');	
				$('#f12_total_val_of_machinery').val('<?= @$data['f12_total_val_of_machinery']; ?>');	
				$('#f12_any_other_assets').val('<?= @$data['f12_any_other_assets']; ?>');		
				$('#f12_name_of_other_assets').val('<?= @$data['f12_name_of_other_assets']; ?>');
				$('#f12_mention_value_of_assets').val('<?= @$data['f12_mention_value_of_assets']; ?>');
				
				if($('#f5_phonetype').val() == 'smartphone')
				{
					$('#div_smartphone_display').show('swing');
				}
				else
				{
					$('#div_smartphone_display').find('input, select').val('');
				}
				
				if($('#f5_appuse').val() == 'yes')
				{
					$('#div_app_name_display').show('swing');
				}
				else
				{
					$('#div_app_name_display').find('input, select').val('');
				}
				
				
				// if($('#f6_children').val() != '0' || $('#f6_children').val() != ''  || $(this).val() != null)
				// {
				// 	$('#use_smartphone').show('swing');
				// }
				// else
				// {
				// 	$('#use_smartphone').find('input, select').val('');
				// }
				
				
				if($('#f12_any_other_assets').val() == 'yes')
				{
					$('#div_any_other_assets_display').show('swing');
				}
				else
				{
					$('#div_any_other_assets_display').find('input, select').val('');
				}
	
				$('#spouse_detail').find('input, select').trigger('change');
				
				
				$('body').on('change','#f13_dairy_cattle, #f13_donkeys,#f13_draft_cattle', function(){
					calTotal_f13();
				});
				
				$('body').on('change','#f13_poultry, #f13_pig,#f13_goat', function(){
					calTotal_f13();
				});
				
				$('body').on('change','#f13_sheep, #f13_ox, #f13_buffalo,f13_livestock_count', function(){
					calTotal_f13();
				});
				
				$('.addCrop').click(function(){
					appendContent();
				});
	
				$('.removeCrop_btn').click(function(){
					removeContent();
				});
				
				$('.addPrevCrop').click(function(){
					appendPrevCropContent();
				});
	
				$('.removePrevCrop_btn').click(function(){
					removePrevCropContent();
				});
				
				$('.addCurCrop').click(function(){
					appendCurCropContent();
				});
	
				$('.removeCurCrop_btn').click(function(){
					removeCurCropContent();
				});
				
				
				$('.addLoanFrm1').click(function(){
					appendLoanFrm1Content();
				});
	
				$('.removeLoanFrm1_btn').click(function(){
					removeLoanFrm1Content();
				});
				
				if($('#f8_loan_taken').val() == 'yes')
				{
					$('#loan_taken').show('swing');
				}
				else
				{
					$('#loan_taken').hide('swing');
					$('#loan_taken').find('input, select').val('');
				}
				
				// if($('#f8_any_insurance').val() == 'yes')
				// {
				// 	$('#div_any_insurance_display').show('swing');
				// }
				// else
				// {
				// 	$('#div_any_insurance_display').hide('swing');
				// 	$('#div_any_insurance_display').find('input, select').val('');
				// }

				f8_crop_insurance
				if($('#f8_crop_insurance').val() == 'yes')
				{
					$('#div_crop_insurance_display').show('swing');
				}
				else
				{
					$('#div_crop_insurance_display').hide('swing');
					$('#div_crop_insurance_display').find('input, select').val('');
				}

				
				if($('#f8_any_subsidies').val() == 'yes')
				{
					$('#div_any_subsidies_display').show('swing');
				}
				else
				{
					$('#div_any_subsidies_display').hide('swing');
					$('#div_any_subsidies_display').find('input, select').val('');
				}
				
				if($('#f8_any_loan_waivers').val() == 'yes')
				{
					$('#div_any_loan_waivers_display').show('swing');
				}
				else
				{
					$('#div_any_loan_waivers_display').hide('swing');
					$('#div_any_loan_waivers_display').find('input, select').val('');
				}
				
				// $('#f8_loan_borrowed_from').on('change', function(){
				// 	calTotal_f8();
				// });
				
				// $('#f8_other_insurance').on('change', function(){
				// 	calTotal_f8();
				// });
				
				// $('#f8_any_insurance').on('change', function(){
					
				// 	if($(this).val() == 'yes')
				// 	{
				// 		$('#div_any_insurance_display').show('swing');
				// 	}
				// 	else
				// 	{
				// 		$('#div_any_insurance_display').hide('swing');
				// 	}
				// 	calTotal_f8();
				// });

				$('#f8_crop_insurance').on('change', function(){
					
					if($(this).val() == 'yes')
					{
						$('#div_crop_insurance_display').show('swing');
					}
					else
					{
						$('#div_crop_insurance_display').hide('swing');
					}
				});
				
				$('#f8_any_subsidies').on('change', function(){
					
					if($(this).val() == 'yes')
					{
						$('#div_any_subsidies_display').show('swing');
					}
					else
					{
						$('#div_any_subsidies_display').hide('swing');
					}
				});
				
				$('#f8_any_loan_waivers').on('change', function(){
					
					if($(this).val() == 'yes')
					{
						$('#div_any_loan_waivers_display').show('swing');
					}
					else
					{
						$('#div_any_loan_waivers_display').hide('swing');
					}
				});
				 
				/*calTotal_f2();
				calTotal_f3();
				calTotal_f5();
				calTotal_f6();
				calTotal_f7();
				calTotal_f8();
				calTotal_f9();
				calTotal_f10();
				calTotal_f11();
				calTotal_f12();
				calTotal_f13();
				calTotal_f14();*/
			});

			// , #f3_spouse_income

			$('body').on('change','#f3_spouse_age, #f3_spouse_occp', function(){
				calTotal_f3();
			});

			// $('#f3_spouse_owned_prop').on('change', function(){
				
			// 	if($(this).val() == 'yes')
			// 	{
			// 		$('#div_f3_spouse_owned_prop_display').show('swing');
			// 	}
			// 	else
			// 	{
			// 		$('#div_f3_spouse_owned_prop_display').hide('swing');
			// 		$('#div_f3_spouse_owned_prop_display').find('input, select').val('').trigger('change');
			// 	}
			// });

			// if($('#f3_spouse_owned_prop').val() == 'yes')
			// {
			// 	$('#div_f3_spouse_owned_prop_display').show('swing');
			// }
			// else
			// {
			// 	$('#div_f3_spouse_owned_prop_display').hide('swing');
			// 	$('#div_f3_spouse_owned_prop_display').find('input, select').val('').trigger('change');
			// }

			$('#f5_phonetype').on('change', function(){
				if($(this).val() == 'smartphone'){
					$('#div_smartphone_display').show('swing');
				}
				else
				{
					$('#div_smartphone_display').hide('swing');
					$('#div_smartphone_display').find('input, select').val('').trigger('change');
				}
				calTotal_f5();
			});

			if($('#f5_phonetype').val() == 'smartphone'){
				$('#div_smartphone_display').show('swing');
			}
			else
			{
				$('#div_smartphone_display').hide('swing');
				$('#div_smartphone_display').find('input, select').val('').trigger('change');
			}

			$('#f5_any_one_have_smart_phone').on('change', function(){
				calTotal_f5();
			});

			$('#f5_datapack').on('change', function(){ 
				calTotal_f5();
			});

			$('#f5_farmapp').on('change', function(){
				calTotal_f5();
			});

			$('#f5_appuse').on('change', function(){
				if($(this).val() == 'yes'){
					$('#div_app_name_display').show('swing');
				}
				else
				{
					$('#div_app_name_display').hide('swing');
					$('#div_app_name_display').find('input, select').val('').trigger('change');
				}
			});

			$('.addCrop').click(function(){
				appendContent();
			});

			$('.removeCrop_btn').click(function(){
				removeContent();
			});
			
			$('.addPrevCrop').click(function(){
				appendPrevCropContent();
			});

			$('.removePrevCrop_btn').click(function(){
				removePrevCropContent();
			});
			
			$('.addCurCrop').click(function(){
				appendCurCropContent();
			});

			$('.removeCurCrop_btn').click(function(){
				removeCurCropContent();
			});
			
			
			$('.addLoanFrm1').click(function(){
				appendLoanFrm1Content();
			});

			$('.removeLoanFrm1_btn').click(function(){
				removeLoanFrm1Content();
			});

			if($('#f8_loan_taken').val() == 'yes')
			{
				$('#loan_taken').show('swing');
			}
			else
			{
				$('#loan_taken').hide('swing');
				$('#loan_taken').find('input, select').val('');
			}

			function convertIncomeToPoint(x)
			{
				if(x >= 500 && x <= 2500)
				{
					return 2;
				}
				else if(x >= 2501 && x <= 5000)
				{
					return 4;
				}
				else if(x >= 5001 && x <= 7500)
				{
					return 6;
				}
				else if(x > 7500)
				{
					return 8;	
				}
				else
				{
				  return 0;
				}
			}
			
			function convertMfiamountToPoint(x)
			{
				if(x >= 100 && x <= 2500)
				{
					return 2;
				}
				else if(x >= 2501 && x <= 5000)
				{
					return 4;
				}
				else if(x >= 5001 && x <= 7500)
				{
					return 8;
				}
				else if(x >= 7501 && x <= 10000)
				{
					return 10;
				}
				else if(x > 10000)
				{
					return 6;	
				}
				else
				{
				  return 0;
				}	
			}
			
			function convertMemebersToPoint(x)
			{
				if(x >= 0 && x <= 2)
				{
				  return 10;
				}
				else if(x >= 3 && x <= 5)
				{
				  return 4;
				}
				else if(x >= 6 && x <= 7)
				{
				  return 2;
				}
				else if(x >= 8)
				{
				  return 0;
				}
				else
				{
				  return 0;
				}
			}
			
			function convertAppliancesToPoint(x, typeVal)
			{
				
				if(typeVal == 1)
				{
					if(x > 0)
					{
					  return 4;
					}
					else
					{
					  return 0;
					}
				}
				else if(typeVal == 2)
				{
					if(x > 0)
					{
					  return 8;
					}
					else
					{
					  return 0;
					}
				}
				else
				{
					if(x > 0)
					{
					  return 10;
					}
					else
					{
					  return 0;
					}	
				}
			}
			
			function convertAssetsToPoint(x)
			{
				if(x >= 0 && x <= 50000)
				{
					return 2;
				}
				else if(x >= 50001 && x <= 100000)
				{
				  return 4;
				}
				else if(x >= 100001 && x <= 500000)
				{
				  return 6;
				}
				else if(x >= 500001 && x <= 1000000)
				{
				  return 8;
				}
				else if(x >= 1000001)
				{
				  return 10;
				}
				else
				{
				  return 0;
				}	
			}
			
			function convertLiveAssetsToPoints(x, val)
			{
				if(val == 'dairy_cattle' && x != 0)
				{
					return 1;
				}
				if(val == 'donkeys' && x != 0)
				{
					return 1;
				}
				if(val == 'draft_cattle' && x != 0)
				{
					return 1;
				}
				if(val == 'poultry' && x != 0)
				{
					return 1;
				}
				if(val == 'pig' && x != 0)
				{
					return 1;
				}
				if(val == 'goat' && x != 0)
				{
					return 1;
				}
				if(val == 'sheep' && x != 0)
				{
					return 1;
				}
				if(val == 'ox' && x != 0)
				{
					return 1;
				}
				else if(val == 'buffalo' && x != 0)
				{
					return 1;	
				}
				else
				{
					return 0;	
				}
			}
			
			function convertLiveStockCountToPoints(x)
			{
				if(x >= 0 && x <= 50)
				{
					return 4;
				}
				else if(x >= 51 && x <= 100)
				{
				  return 6;
				}
				else if(x >= 101)
				{
				  return 10;
				}
				else
				{
				  return 0;
				}	
			}
			
			function convertLiveStockIncomeToPoints(x)
			{
				if(x >= 0 && x <= 5000)
				{
					return 4;
				}
				else if(x >= 5001 && x <= 20000)
				{
				  return 6;
				}
				else if(x >= 20001 && x <= 50000)
				{
				  return 8;
				}
				else if(x >= 50001)
				{
				  return 10;
				}
				else
				{
				  return 0;
				}	
			}
			
			function cal_land_size_pt(x)
			{
				if(x > 0 && x <= 3)
				{
				  return 5;
				}
				else if(x >= 4 && x <= 6)
				{
				  return 7;
				}
				else if(x >= 7 && x <= 10)
				{
				  return 8;
				}
				else if(x >= 11 && x <= 15)
				{
				  return 9;
				}
				else if(x >= 16 && x <= 20)
				{
				  return 10;
				}
				else if(x >= 21)
				{
				  return 10;
				}
				else
				{
					return 0;
				}
			}
			
			function convertTonnesToPoint(x)
			{
				if(x >= 0 && x <= 20)
				{
				  return 5;
				}
				else if(x >= 21 && x <= 40)
				{
				  return 6;
				}
				else if(x >= 41 && x <= 60)
				{
				  return 7;
				}
				else if(x >= 61 && x <= 80)
				{
				  return 8;
				}
				else if(x >= 81 && x <= 100)
				{
				  return 9;
				}
				else
				{
				  return 0;
				}
			}
			
			function convertPriceToPoint(x)
			{
				if(x >= 10000 && x <= 20000)
				{
				  return 4;
				}
				else if(x >= 20001 && x <= 30000)
				{
				  return 6;
				}
				else if(x >= 30001 && x <= 40000)
				{
				  return 10;
				}
				else
				{
				  return 0;
				}
			}
			
			function convertIncomeToPointF10(x)
			{
				if(x >= 5000 && x <= 25000)
				{
				  return 3;
				}
				else if(x >= 25001 && x <= 50000)
				{
				  return 4;
				}
				else if(x >= 50001 && x <= 75000)
				{
				  return 5;
				}
				else if(x >= 75001 && x <= 100000)
				{
				  return 8;
				}
				else if(x >= 100001 && x <= 500000)
				{
				  return 10;
				}
				else
				{
				  return 0;
				}
			}
			
			function convertIncomeToPointF11(x)
			{
				if(x > 0 && x <= 2500)
				{
				  return 4;
				}
				else if(x >= 2501 && x <= 5000)
				{
				  return 6;
				}
				else if(x >= 5001 && x <= 10000)
				{
				  return 7;
				}
				else if(x >= 10001 && x <= 25000)
				{
				  return 8;
				}
				else if(x >= 25001 && x <= 50000)
				{
				  return 9;
				}
				else if(x >= 50001)
				{
				  return 10;
				}
				else
				{
				  return 0;
				}
			}
			
			function convertAchievedToPoint(x)
			{
				if(x >= 0 && x <= 2)
				{
				  return 3;
				}
				else if(x >= 3 && x <= 4)
				{
				  return 5;
				}
				else if(x >= 5 && x <= 6)
				{
				  return 7;
				}
				else if(x >= 7)
				{
				  return 10;
				}
				else
				{
				  return 0;
				}
			}
			
			function convertLoanAmountToPointF14(x)
			{
				
				if(x > 0 && x <= 5000)
				{
				  return 10;
				}
				else if(x >= 5001 && x <= 15000)
				{
				  return 8;
				}
				else if(x >= 15001 && x <= 30000)
				{
				  return 6;
				}
				else if(x >= 30001 && x <= 45000)
				{
				  return 4;
				}
				else if(x >= 45001)
				{
				  return 2;
				}
				else
				{
				  return 0;
				}
			
			}
			
			function convertAssetsVehicalToPoints(x)
			{
				if(x == 1)
				{
				  return 5;
				}
				else if(x == 2)
				{
				  return 7;
				}
				else if(x == 3)
				{
				  return 8;
				}
				else if(x >= 4)
				{
				  return 10;
				}
				else
				{
				  return 0;
				}
			} 

			function convertAssetsMachineryToPoints(x)
			{
				if(x == 1)
				{
				  return 2;
				}
				else if(x == 2)
				{
				  return 4;
				}
				else if(x == 3)
				{
				  return 6;
				}
				else if(x >= 4)
				{
				  return 8;
				}
				else
				{
				  return 0;
				}
			}

			function calTotal_f2()
			{
				// START : f2
				var a = parseInt($('option:selected','#f2_proficiency').attr('point')) || 0;
				var b = parseInt($('option:selected','#f2_edudetail').attr('point')) || 0;
				// var c = parseInt($('option:selected','#f2_participation').attr('point')) || 0;
				applicant_knowledge_g_total = a + b; // + c
				
				//alert(applicant_knowledge_g_total +'='+ a +'<>'+ b +'<>'+ c);
				
				document.getElementById('applicant_knowledge_g_total').innerHTML=applicant_knowledge_g_total;
				
				var f2_pt = applicant_knowledge_g_total/2;
				f2_pt     = f2_pt.toFixed(2);
				$('#f2_points').val(f2_pt);
				
				$('#f2_pt').html(f2_pt);
				// END : f2
			}
			
			function calTotal_f3()
			{
				// START : f3
				//var f3_married	= '<?php //echo $married_status; ?>';
				var f3_married	= $('#f3_married').val() || 'yes';
				var married	= 0;
				if(f3_married == 'yes')
				{
					married 	= 10;
				}
				else if(f3_married == 'no')
				{
					married 	= 2;
				}
				
				//var married	= parseInt($('option:selected','#f3_married').attr('point')) || 0;
				
				if(married === 10)
				{
					var age 		= parseInt($('#f3_spouse_age').val()) || 0;
					//var shg 		= parseInt($('option:selected','#f3_spouse_shg').attr('point'))  || 0;
					var occp 		= parseInt($('option:selected','#f3_spouse_occp').attr('point')) || 0;
					//var affliation	= parseInt($('option:selected','#f3_affliation_status').attr('point')) || 0;
					// var income 		= parseInt($('#f3_spouse_income').val()) || 0;
					
					//age 	= convertAgeToPoint(age);
					income 	= convertIncomeToPoint(income);
					
					// if($('#f3_spouse_mfi').val() === 'yes')
					// {
					// 	var f3_spouse_mfi	= 10
					// 	var mfiamount	= parseInt($('#f3_spouse_mfiamount').val()) || 0;
					// 	mfiamount	= convertMfiamountToPoint(mfiamount);
					// 	// spouse_g_total = married + shg + occp + income + affliation + mfiamount + f3_spouse_mfi;
					// 	spouse_g_total = married + occp + income + affliation + mfiamount + f3_spouse_mfi;
					// }
					// else
					// {
					// 	// spouse_g_total = married + shg + occp + income + affliation;
					// 	spouse_g_total = married + occp + income + affliation;
					// }
					
					spouse_g_total = married + occp;	//+ affliation + income

	
				}
				else
				{
					spouse_g_total = married ;
				}
				
				if(f3_married == 'yes')
				{
					document.getElementById('spouse_g_total').innerHTML = spouse_g_total;
					var no_of_point	= 2;
					
					if($('#f3_spouse_occp').val() != 'housewife')
					{
						no_of_point	+= 1;
					}
					
					// if($('#f3_spouse_mfi').val() == 'yes')
					// {
					// 	no_of_point	+= 1;
					// }
					
					var f3_pt = spouse_g_total/no_of_point;
					
					f3_pt     = f3_pt.toFixed(2);
					//alert(f3_pt);
					$('#f3_points').val(f3_pt);
					$('#f3_pt').html(f3_pt);
				}
				else if(f3_married == 'no')
				{
					document.getElementById('spouse_g_total').innerHTML = 0;
					$('#f3_points').val(0);
					$('#f3_pt').html(0);	
				}
				// END : f3
			}
			
			function calTotal_f5()
			{
				// START : f5
				var phoneType		= parseInt($('option:selected','#f5_phonetype').attr('point')) || 0;
				var anyOtherSPUser	= parseInt($('option:selected','#f5_any_one_have_smart_phone').attr('point')) || 0;
				var dataPack		= parseInt($('option:selected','#f5_datapack').attr('point')) || 0;
				var farmApp			= parseInt($('option:selected','#f5_farmapp').attr('point')) || 0;
				
				phone_details_g_total	= phoneType + anyOtherSPUser + dataPack + farmApp;
				//alert(phone_details_g_total	+' = '+ phoneType +'<>'+ anyOtherSPUser +'<>'+ dataPack +'<>'+ farmApp);
				document.getElementById('phone_details_g_total').innerHTML=phone_details_g_total;
				
				var f5_pt = phone_details_g_total/4;
				f5_pt     = f5_pt.toFixed(2);
				$('#f5_points').val(f5_pt);
				$('#f5_pt').html(f5_pt);
				// END : f5
			}
			
			function calTotal_f6()
			{
				// START : f6
				//var jointFamily = parseInt($('option:selected','#f6_jointfamily').attr('point')) || 0;
				var children 	= $('#f6_children').val() != '' ? parseInt($('#f6_children').val()) : '';
				//var smartuse 	= parseInt($('option:selected','#f6_smartuse').attr('point')) || 0;
	
				children = convertMemebersToPoint(children);
	
				family_details_g_total = children; // jointFamily + smartuse
				document.getElementById('family_details_g_total').innerHTML=family_details_g_total;
				var f6_pt = '';
				if($('#f6_children').val() == '' || $('#f6_children').val() == 0)
				{
					f6_pt = family_details_g_total/1;
				}
				else
				{
					f6_pt = family_details_g_total/1;
				}
	
				f6_pt     = f6_pt.toFixed(2);
				$('#f6_points').val(f6_pt);
				$('#f6_pt').html(f6_pt);
				// END : f6
			}
			
			function calTotal_f7()
			{
				// START : f7
				var reg_resi_points	= "<?php echo $data['f7_reg_points']; ?>";
				
				var f7_television	= parseInt($('#f7_television').val()) || 0;
				var f7_refrigerator	= parseInt($('#f7_refrigerator').val()) || 0;
				var f7_wmachine 	= parseInt($('#f7_wmachine').val()) || 0;
				var f7_mixer 		= parseInt($('#f7_mixer').val()) || 0;
				var f7_stove 		= parseInt($('#f7_stove').val()) || 0;
				var f7_bicycle 		= parseInt($('#f7_bicycle').val()) || 0;
				var f7_ccylinder 	= parseInt($('#f7_ccylinder').val()) || 0;
				var f7_fans 		= parseInt($('#f7_fans').val()) || 0;
				var f7_motorcycle 	= parseInt($('#f7_motorcycle').val()) || 0;
				var f7_car			= parseInt($('#f7_car').val()) || 0;
				
				f7_television 		= convertAppliancesToPoint(f7_television, 1);
				f7_refrigerator 	= convertAppliancesToPoint(f7_refrigerator, 1);
				f7_wmachine 		= convertAppliancesToPoint(f7_wmachine, 1);
				f7_mixer 			= convertAppliancesToPoint(f7_mixer, 1);
				f7_stove 			= convertAppliancesToPoint(f7_stove, 1);
				f7_bicycle 			= convertAppliancesToPoint(f7_bicycle, 1);
				f7_ccylinder 		= convertAppliancesToPoint(f7_ccylinder, 1);
				f7_fans 			= convertAppliancesToPoint(f7_fans, 1);
				f7_motorcycle 		= convertAppliancesToPoint(f7_motorcycle, 2);
				f7_car				= convertAppliancesToPoint(f7_car, 3);
				
				appliances_motors_g_total	= f7_television + f7_refrigerator + f7_wmachine + f7_mixer + f7_stove + f7_bicycle + f7_ccylinder + f7_fans + f7_motorcycle + f7_car;
				
				document.getElementById('appliances_motors_g_total').innerHTML=appliances_motors_g_total;
				var f7_pt = appliances_motors_g_total/10;
				f7_pt     = f7_pt.toFixed(2);
				$('#f7_points').val(f7_pt);
				var display_f7_pts	= parseInt(reg_resi_points) + parseInt(f7_pt);
				$('#f7_pt').html(display_f7_pts);
				// END : f7
			}
			
			function calTotal_f8()
			{
				// START : f8 [Loan Frm 1]
				
				f8_loan_taken	= parseInt($('option:selected','#f8_loan_taken').attr('point')) || 0;
				
				financial_details_g_total = f8_loan_taken;
				
				document.getElementById('financial_details_g_total').innerHTML=financial_details_g_total;
				f8_pt     = financial_details_g_total/(contentCountLoanFrm1*1)
				f8_pt     = f8_pt.toFixed(2);
				$('#f8_points').val(f8_pt);
				$('#f8_pt').html(f8_pt);
				
				$('#num_of_loan').val(contentCountLoanFrm1);
				
				if(contentCountLoanFrm1 == 1)
				{
					$('.removeLoanFrm1').hide('swing');
				}
				// END : f8 [Loan Frm 1]
				
				// START : f8 [Loan frm 2]
				var divided_by	= 1;
				//var f8_other_insurance	= 0;
				//var f8_loan_borrowed_from 	= parseInt($('option:selected','#f8_loan_borrowed_from').attr('point')) || 0;
				//var f8_any_insurance 		= parseInt($('option:selected','#f8_any_insurance').attr('point')) || 0;
				
				//f8_any_insurance_val	= $('#f8_any_insurance').val();
				
				// if(f8_any_insurance_val == 'yes')
				// {
				// 	f8_other_insurance 		= parseInt($('option:selected','#f8_other_insurance').attr('point')) || 0;		
				// 	divided_by	+= 1;
				// }
				
				financial_history_g_total	= 0; //f8_loan_borrowed_from + f8_other_insurance + f8_any_insurance
				
				document.getElementById('financial_history_g_total').innerHTML = financial_history_g_total;
				
				var f8_pt_fh = financial_history_g_total/divided_by;
				f8_pt_fh     = f8_pt_fh.toFixed(2);
				$('#f8_financial_history_points').val(f8_pt_fh);
				$('#f8_pt_fh').html(f8_pt_fh); 
				// END : f8 [Loan frm 2]
			}
			
			function calTotal_f9()
			{
				
				// START : f9
				var no_of_points        	= 5;
				var f9_land_size_tpt		= 0;
				var f9_owner_tpt			= 0;
				var f9_soil_tested_pt   	= 0;
				var f9_soil_type_tpt    	= 0;
				var f9_source_of_water_tpt	= 0;
			
				for(var i=1; i <= contentCountLand; i++)
				{
					var f9_land_size     =  $('#f9_land_size'+i).val() || 0;
					var f9_land_size_pt  = cal_land_size_pt(f9_land_size);
					f9_land_size_tpt  += f9_land_size_pt;
					
					var f9_owner	= parseInt($('option:selected','#f9_owner'+i).attr('point')) || 0;
					f9_owner_tpt	+= f9_owner;
					
					var f9_soil_tested  = $('#f9_soil_tested'+i).val() || 'no';
					f9_soil_tested_pt 	+= parseInt($('option:selected','#f9_soil_tested'+i).attr('point')) || 0;
					
					var f9_soil_type 	= parseInt($('option:selected','#f9_soil_type'+i).attr('point')) || 0;
					f9_soil_type_tpt    += f9_soil_type ;
					
					var f9_source_of_water	= parseInt($('option:selected','#f9_source_of_water'+i).attr('point')) || 0;
					f9_source_of_water_tpt	+= f9_source_of_water; 
				}
				
				farm_land_details_g_total	= parseInt(f9_land_size_tpt) + parseInt(f9_soil_tested_pt) + parseInt(f9_soil_type_tpt) + parseInt(f9_owner_tpt) + parseInt(f9_source_of_water_tpt);
				//alert(farm_land_details_g_total);
				//alert(farm_land_details_g_total);
				
				document.getElementById('farm_land_details_g_total').innerHTML = farm_land_details_g_total;
				
				//alert(no_of_points+'*'+contentCountLand);
				
				var f9_pt = farm_land_details_g_total/(no_of_points*contentCountLand) ;
				f9_pt     = f9_pt.toFixed(2);
				$('#f9_points').val(f9_pt);
				$('#f9_pt').html(f9_pt);
				$('#no_of_land').val(contentCountLand);
				
				/*if(contentCountLand > 1)
				{
					$('#removeLandType').show('swing');
				}*/
				
				if(contentCountLand == 1)
				{
				   $('#removeLandType').hide('swing');
				}
				else
				{
					$('#removeLandType').show('swing');
				}
				
				// END : f9
			}
			
			function calTotal_f10()
			{
				// START : f10
				var cultivating = 0;
				var stage       = 0;
				var diseases	= 0;
				var pest		= 0;
				var tonnes		= 0;
				var price       = 0;
				var income      = 0;
				//var f10_filt_type	= 0;
				
				for(var i=1; i<=contentCountCrop; i++)
				{
					pnts = 0;
					cultivating 		+= parseInt($('option:selected','#f10_cultivating'+i).attr('point')) || 0;
					//f10_filt_type 		+= parseInt($('option:selected','#f10_filt_type'+i).attr('point')) || 0;
					
					stage       		+= parseInt($('option:selected','#f10_stage'+i).attr('point')) || 0;
					diseases    		+= parseInt($('option:selected','#f10_diseases'+i).attr('point')) || 0;
					//pest        		+= parseInt($('option:selected','#f10_pest'+i).attr('point')) || 0;
					tonnes_pt  			= $('#f10_expected'+i).val() ? (parseInt($('#f10_expected'+i).val()) || 0) : undefined;
					//price_pt    		= parseInt($('#f10_expectedprice'+i).val()) || 0;
					//income_pt  		= parseInt($('#f10_expectedincome'+i).val()) || 0;
					price_pt	= 0;
					income_pt	= 0;
	
					tonnes	+= convertTonnesToPoint(tonnes_pt);
					price 	+= convertPriceToPoint(price_pt);
					income 	+= convertIncomeToPointF10(income_pt);
				}
				
				crop_cultivation_g_total = cultivating + stage + diseases + tonnes + price + income; //+ f10_filt_type + pest 
				
				//alert(cultivating +'<>'+ stage +'<>'+ diseases +'<>'+ pest +'<>'+ tonnes +'<>'+ price +'<>'+ income +'<>'+ f10_filt_type);
				
				document.getElementById('crop_cultivation_g_total').innerHTML=crop_cultivation_g_total;
				crop_cultivation_g_total =(crop_cultivation_g_total/(contentCountCrop*5));
				
				f10_pt     = crop_cultivation_g_total.toFixed(2);
				
				$('#f10_points').val(f10_pt);
				$('#f10_pt').html(f10_pt);
				$('#no_of_crops').val(contentCountCrop);
	
				if(contentCountCrop==1)
				{
				   $('.removeCrop').hide('swing');
				}
				else
				{
					$('.removeCrop').show('swing');
				}
				// END : f10
			}
			
			function calTotal_f11()
			{
				// START : f11
				var income 		= 0;
				var diseases    = 0;
				var fertilizers = 0;
				var achieved 	= 0;
				//var f11_damaged_prev_crop	= 0;
				
				for(var i=1; i <= contentCountPrevCrop; i++)
				{
					income_pt             = parseInt($('#f11_income'+i).val()) || 0;
					//diseases            += parseInt($('option:selected','#f11_diseases'+i).attr('point')) || 0;
					//fertilizers         += parseInt($('option:selected','#f11_fertilizers'+i).attr('point')) || 0;
					//f11_damaged_prev_crop += parseInt($('option:selected','#f11_damaged_prev_crop'+i).attr('point')) || 0;
					//achieved_pt         = parseInt($('#f11_expected'+i).val()) || 0;
					
					//achieved            += convertAchievedToPoint(achieved_pt);
					income                += convertIncomeToPointF11(income_pt);
				}
					
				// prev_crop_cycle_g_total = diseases + fertilizers + achieved + income + f11_damaged_prev_crop;
				prev_crop_cycle_g_total = achieved + income; //+ fertilizers diseases + + f11_damaged_prev_crop

				
				document.getElementById('prev_crop_cycle_g_total').innerHTML=prev_crop_cycle_g_total;
				
				// f11_pt     = prev_crop_cycle_g_total/(contentCountPrevCrop * 3);
				f11_pt     = prev_crop_cycle_g_total/(contentCountPrevCrop * 2);
				f11_pt     = f11_pt.toFixed(2);
				$('#f11_points').val(f11_pt);
				$('#f11_pt').html(f11_pt);
				
				$('#no_of_yield').val(contentCountPrevCrop);
				/*if(contentCountPrevCrop == 1)
				{
					$('.removePrevCrop').hide('swing');
				}*/
				
				if(contentCountPrevCrop==1)
				{
				   $('.removePrevCrop').hide('swing');
				}
				else
				{
					$('.removePrevCrop').show('swing');
				}
				// END : f11
			}
			
			function calTotal_f12()
			{
				// START : f12
				var divided_by	= 4;
				var f12_mention_value_of_assets	= 0;
				
				f12_TRACTOR  			 = parseInt($('#f12_TRACTOR').val() || 0);
				//f12_COMBINE_HARVESTER  = parseInt($('#f12_COMBINE_HARVESTER').val() || 0);
				// f12_PLOW              = parseInt($('#f12_PLOW').val() || 0);
				// f12_PLANTER           = parseInt($('#f12_PLANTER').val() || 0);
				// f12_LOADER            = parseInt($('#f12_LOADER').val() || 0);
				// f12_BAILER            = parseInt($('#f12_BAILER').val() || 0);
				// f12_SKID_STEER_LOADER = parseInt($('#f12_SKID_STEER_LOADER').val() || 0);
				// f12_MOWER             = parseInt($('#f12_MOWER').val() || 0);
				// f12_REAPER            = parseInt($('#f12_REAPER').val() || 0);
				// f12_THRESHING_MACHINE = parseInt($('#f12_THRESHING_MACHINE').val() || 0);
				// f12_SEED_DRILL        = parseInt($('#f12_SEED_DRILL').val() || 0);
				// f12_DISC_HARROW       = parseInt($('#f12_DISC_HARROW').val() || 0);
				// f12_TRANSPLANTER      = parseInt($('#f12_TRANSPLANTER').val() || 0);
				// f12_ROLLER            = parseInt($('#f12_ROLLER').val() || 0);
				// f12_SUBSPOILER        = parseInt($('#f12_SUBSPOILER').val() || 0);
				// f12_STONE_PICKER      = parseInt($('#f12_STONE_PICKER').val() || 0);
				// f12_DRILL             = parseInt($('#f12_DRILL').val() || 0);
				// f12_CONDITIONER       = parseInt($('#f12_CONDITIONER').val() || 0);
				// f12_CHASER_BIN        = parseInt($('#f12_CHASER_BIN').val() || 0);
				// f12_STEAM_TRACTOR     = parseInt($('#f12_STEAM_TRACTOR').val() || 0);
				// f12_HAY_RAKE          = parseInt($('#f12_HAY_RAKE').val() || 0);
				
				// total_vehical_count		= f12_TRACTOR + f12_COMBINE_HARVESTER + f12_PLOW + f12_PLANTER + f12_LOADER + f12_BAILER  +f12_SKID_STEER_LOADER + f12_MOWER + f12_REAPER + f12_THRESHING_MACHINE + f12_SEED_DRILL + f12_DISC_HARROW  +f12_TRANSPLANTER + f12_ROLLER + f12_SUBSPOILER + f12_STONE_PICKER + f12_DRILL + f12_CONDITIONER + f12_CHASER_BIN  + f12_STEAM_TRACTOR + f12_HAY_RAKE;

				total_vehical_count		= f12_TRACTOR;

				$('#f12_vehicle').val(total_vehical_count);


				f12_Sprayer 			= parseInt($('#f12_Sprayer').val() || 0);		
				//f12_Rice_Huller 		= parseInt($('#f12_Rice_Huller').val() || 0);		
				f12_Pumps 				= parseInt($('#f12_Pumps').val() || 0);		
				f12_Protavator 			= parseInt($('#f12_Protavator').val() || 0);		
				//f12_Blower 				= parseInt($('#f12_Blower').val() || 0);		
				//f12_Cutters 			= parseInt($('#f12_Cutters').val() || 0);		
				f12_Cultivators 		= parseInt($('#f12_Cultivators').val() || 0);

				//total_machinery_count 	= f12_Sprayer + f12_Rice_Huller + f12_Pumps + f12_Protavator + f12_Blower + f12_Cutters +  f12_Cultivators;
				total_machinery_count 	= f12_Sprayer + f12_Pumps + f12_Protavator + f12_Cultivators;

				$('#f12_machinery').val(total_machinery_count);		

				var f12_vehicle					= $('#f12_vehicle').val() || 0;
				f12_vehicle						= convertAssetsVehicalToPoints(f12_vehicle);
				var f12_total_val_of_vehical	= $('#f12_total_val_of_vehical').val();
				f12_total_val_of_vehical		= convertAssetsToPoint(f12_total_val_of_vehical);
				var f12_machinery				= $('#f12_machinery').val() || 0;
				f12_machinery            		= convertAssetsMachineryToPoints(f12_machinery);
				var f12_total_val_of_machinery	= $('#f12_total_val_of_machinery').val();
				f12_total_val_of_machinery		= convertAssetsToPoint(f12_total_val_of_machinery);
				
				var f12_any_other_assets	= $('#f12_any_other_assets').val();
				//alert(f12_any_other_assets);
				if(f12_any_other_assets == 'yes')
				{
					f12_mention_value_of_assets = $('#f12_mention_value_of_assets').val();
					f12_mention_value_of_assets = convertAssetsToPoint(f12_mention_value_of_assets);	
					divided_by	= 5;
				}
				
				asset_details_g_total	= f12_vehicle + f12_total_val_of_vehical + f12_machinery + f12_total_val_of_machinery + f12_mention_value_of_assets;
				
				//alert(asset_details_g_total	+'='+ f12_vehicle +'<>'+ f12_total_val_of_vehical +'<>'+ f12_machinery +'<>'+ f12_total_val_of_machinery +'<>'+ f12_mention_value_of_assets);
				
				document.getElementById('asset_details_g_total').innerHTML = asset_details_g_total;
				var f12_pt = asset_details_g_total/divided_by;
				f12_pt     = f12_pt.toFixed(2);
				$('#f12_points').val(f12_pt);
				$('#f12_pt').html(f12_pt);
				// END : f12
			}
			
			function calTotal_f13()
			{
				// START : f13
				f13_dairy_cattle = parseInt($('#f13_dairy_cattle').val() || '0');
				f13_donkeys      = parseInt($('#f13_donkeys').val()|| '0');
				f13_draft_cattle = parseInt($('#f13_draft_cattle').val()|| '0');
				f13_poultry		 = parseInt($('#f13_poultry').val()|| '0');
				f13_pig 		 = parseInt($('#f13_pig').val()|| '0');
				f13_goat  		 = parseInt($('#f13_goat').val()|| '0');
				f13_sheep		 = parseInt($('#f13_sheep').val()|| '0');
				f13_ox			 = parseInt($('#f13_ox').val()|| '0');
				f13_buffalo 	 = parseInt($('#f13_buffalo').val()|| '0');
				
				total_p          = f13_dairy_cattle + f13_donkeys + f13_draft_cattle + f13_poultry +f13_pig +f13_goat +f13_sheep + f13_ox +f13_buffalo;
				//alert(total_p +'='+ f13_dairy_cattle +'<>'+ f13_donkeys +'<>'+ f13_draft_cattle +'<>'+ f13_poultry +'<>'+ f13_pig +'<>'+ f13_goat +'<>'+ f13_sheep +'<>'+ f13_ox +'<>'+ f13_buffalo);
				if(total_p == 0)
				{
					$('#livestock_count').hide('wing');
					$('#f13_livestock_count').val("");
					$('#f13_livestock_income').val("");
				}
				else
				{
					$('#livestock_count').show('wing');
					$('#f13_livestock_count').val(total_p);
				}
				
				var f13_dairy_cattle_pt	= convertLiveAssetsToPoints(f13_dairy_cattle, 'dairy_cattle');
				var f13_donkeys_pt      = convertLiveAssetsToPoints(f13_donkeys, 'donkeys');
				var f13_draft_cattle_pt = convertLiveAssetsToPoints(f13_draft_cattle, 'draft_cattle');
				var f13_poultry_pt		= convertLiveAssetsToPoints(f13_poultry, 'poultry');
				var f13_pig_pt 		 	= convertLiveAssetsToPoints(f13_pig, 'pig');
				var f13_goat_pt  		= convertLiveAssetsToPoints(f13_goat, 'goat');
				var f13_sheep_pt		= convertLiveAssetsToPoints(f13_sheep, 'sheep');
				var f13_ox_pt			= convertLiveAssetsToPoints(f13_ox, 'ox');
				var f13_buffalo_pt		= convertLiveAssetsToPoints(f13_buffalo, 'buffalo');
				
				var f13_livestock_count	= $('#f13_livestock_count').val();
				var f13_livestock_count_pt	= convertLiveStockCountToPoints(f13_livestock_count);
				
				var f13_livestock_income	= $('#f13_livestock_income').val();
				var f13_livestock_income_pt	= convertLiveStockIncomeToPoints(f13_livestock_income);
				
				live_stock_g_total	= f13_dairy_cattle_pt + f13_donkeys_pt + f13_draft_cattle_pt + f13_poultry_pt + f13_pig_pt + f13_goat_pt + f13_sheep_pt + f13_ox_pt + f13_buffalo_pt + f13_livestock_count_pt + f13_livestock_income_pt;
				
				//alert(live_stock_g_total +'='+ f13_dairy_cattle_pt +'<>'+ f13_donkeys_pt +'<>'+ f13_draft_cattle_pt +'<>'+ f13_poultry_pt +'<>'+ f13_pig_pt +'<>'+ f13_goat_pt +'<>'+ f13_sheep_pt +'<>'+ f13_ox_pt +'<>'+ f13_buffalo_pt +'<>'+ f13_livestock_count_pt +'<>'+ f13_livestock_income_pt);
				
				document.getElementById('live_stock_g_total').innerHTML = live_stock_g_total;
				var f13_pt = live_stock_g_total/3;
				f13_pt     = f13_pt.toFixed(2);
				$('#f13_points').val(f13_pt);
				$('#f13_pt').html(f13_pt);
				// END : f13
			}
			
			function calTotal_f14()
			{
				// START : f14
				var f14_seed_type		= 0;
				//var f14_loan_taken		= 0;
				//var f14_loan_amount		= 0;
				//var f14_loan_amount_pt		= 0;
				//var f14_borrow_loan_from	= 0;
				var f14_water_source_type	= 0;
				var divided_by	= 0;
				
				for(var i=1; i <= contentCountCurCrop; i++)
				{
					divided_by	+= 2;
					
					f14_seed_type   		+= parseInt($('option:selected','#f14_seed_type'+i).attr('point')) || 0;
					//f14_loan_taken   		+= parseInt($('option:selected','#f14_loan_taken'+i).attr('point')) || 0;
					//f14_loan_taken_val	= $('#f14_loan_taken'+i).val();
					
					// if(f14_loan_taken_val == 'yes')
					// {
					// 	f14_loan_amount 		= parseInt($('#f14_loan_amount'+i).val()) || 0;
					// 	f14_loan_amount_pt   	+= convertLoanAmountToPointF14(f14_loan_amount);
						
					// 	f14_borrow_loan_from	+= parseInt($('option:selected','#f14_borrow_loan_from'+i).attr('point')) || 0;	
						
					// 	divided_by	+= 2;
					// }
					
					f14_water_source_type	+= parseInt($('option:selected','#f14_water_source_type'+i).attr('point')) || 0;
					
				}
					
				cur_crop_cycle_g_total = f14_seed_type + f14_water_source_type; //+ f14_loan_taken + f14_loan_amount_pt f14_borrow_loan_from
				
				//alert(cur_crop_cycle_g_total +'='+ f14_seed_type +'<>'+ f14_loan_taken +'<>'+ f14_borrow_loan_from +'<>'+ f14_water_source_type +'<>'+ f14_loan_amount_pt);
				
				document.getElementById('cur_crop_cycle_g_total').innerHTML=cur_crop_cycle_g_total;
				
				//alert(f14_pt +' = '+ cur_crop_cycle_g_total +' / ( '+ contentCountCurCrop +' * '+ divided_by +' )');
				
				//f14_pt     = cur_crop_cycle_g_total/(contentCountCurCrop * divided_by);
				f14_pt     = cur_crop_cycle_g_total/(divided_by);
				f14_pt     = f14_pt.toFixed(2);
				$('#f14_points').val(f14_pt);
				$('#f14_pt').html(f14_pt);
				
				$('#no_of_cur_crop_forecast').val(contentCountCurCrop);
				if(contentCountCurCrop == 1)
				{
					$('.removeCurCrop').hide('swing');
				}
				// END : f14
			}
			
			$('#frm_knowledge_detail').on('submit', function(e) 
			{
				//alert('1');
				e.preventDefault();
				//alert('2');
				if ($('#frm_knowledge_detail').valid())
				{
					//alert('3');
					
					loading_show();	
					//alert('4')
					
					$.ajax({
							type: "POST",
							url: "action_pages/action_frm3.php",
							data: new FormData(this),
							processData: false,
							contentType: false,
							cache: false,
							success: function(msg)
							{
								data = JSON.parse(msg);
								//alert(data.Success);
								//return false;
								if(data.Success == "Success")
								{
									alert(data.resp);
									//window.location.href="get_farmer_details.php?pag=farmers&fm_id=<?php //echo $fm_id; ?>";
									
									$('#li_spouse_details').removeClass('active');
									$('#li_appli_knowledge').addClass('active');

									$('#div_spouse_details').removeClass('active');  
									$('#div_appli_knowledge').addClass('active');
									loading_hide();
								}
								else if(data.Success == "fail") 
								{
									alert(data.resp);
									loading_hide();	
								}	
							},
							error: function (request, status, error)
							{
								loading_hide();	
							},
							complete: function()
							{
								loading_hide();	
							}	
						});
				}
			});
			
			$('#frm_applicant_knowledge').on('submit', function(e) 
			{
				e.preventDefault();
				if ($('#frm_applicant_knowledge').valid())
				{
					loading_show();	
					$.ajax({
						type: "POST",
						url: "action_pages/action_frm2.php",
						data: new FormData(this),
						processData: false,
						contentType: false,
						cache: false,
						success: function(msg)
						{
							data = JSON.parse(msg);
						
							if(data.Success == "Success")
							{
								alert(data.resp);
								//window.location.href="get_farmer_details.php?pag=farmers&fm_id=<?php //echo $fm_id; ?>";
								
								$('#li_appli_knowledge').removeClass('active');
								$('#li_phone_details').addClass('active');

								$('#div_appli_knowledge').removeClass('active');  
								$('#div_phone_details').addClass('active');

								loading_hide();
							}
							else if(data.Success == "fail") 
							{
								alert(data.resp);
								loading_hide();	
							}	
						},
						error: function (request, status, error)
						{
							loading_hide();	
						},
						complete: function()
						{
							loading_hide();	
						}	
					});
				}
			});
			
			$('#frm_applicant_phone').on('submit', function(e) 
			{
				e.preventDefault();
				if ($('#frm_applicant_phone').valid())
				{
					// console.log($('#f5_servpro').val());
					// return false;

					loading_show();	
					$.ajax({
							type: "POST",
							url: "action_pages/action_frm5.php",
							data: new FormData(this),
							processData: false,
							contentType: false,
							cache: false,
							success: function(msg)
							{
								data = JSON.parse(msg);
							
								if(data.Success == "Success")
								{
									alert(data.resp);
									//window.location.href="get_farmer_details.php?pag=farmers&fm_id=<?php //echo $fm_id; ?>";
									
									$('#li_phone_details').removeClass('active');
									$('#li_family_details').addClass('active');

									$('#div_phone_details').removeClass('active');  
									$('#div_family_details').addClass('active');

									loading_hide();
								}
								else if(data.Success == "fail") 
								{
									alert(data.resp);
									loading_hide();	
								}	
							},
							error: function (request, status, error)
							{
								loading_hide();	
							},
							complete: function()
							{
								loading_hide();	
							}	
						});
				}
			});	
		
			$('#frm_family_details').on('submit', function(e) 
			{
				e.preventDefault();
				if ($('#frm_family_details').valid())
				{
					loading_show();	
					$.ajax({
						type: "POST",
						url: "action_pages/action_frm6.php",
						data: new FormData(this),
						processData: false,
						contentType: false,
						cache: false,
						success: function(msg)
						{
							data = JSON.parse(msg);
						
							if(data.Success == "Success")
							{
								alert(data.resp);
								//window.location.href="get_farmer_details.php?pag=farmers&fm_id=<?php //echo $fm_id; ?>";
								
								$('#li_family_details').removeClass('active');
								$('#li_appliances_motors').addClass('active');

								$('#div_family_details').removeClass('active');  
								$('#div_appliances_motors').addClass('active');

								loading_hide();
							}
							else if(data.Success == "fail") 
							{
								alert(data.resp);
								loading_hide();	
							}	
						},
						error: function (request, status, error)
						{
							loading_hide();	
						},
						complete: function()
						{
							loading_hide();	
						}	
					});
				}
			});
			
			$('#frm_appliances_motors').on('submit', function(e) 
			{
				e.preventDefault();
				if ($('#frm_appliances_motors').valid())
				{
					loading_show();	
					$.ajax({
						type: "POST",
						url: "action_pages/action_frm7.php",
						data: new FormData(this),
						processData: false,
						contentType: false,
						cache: false,
						success: function(msg)
						{
							data = JSON.parse(msg);
							
							if(data.Success == "Success")
							{
								alert(data.resp);
								//window.location.href="get_farmer_details.php?pag=farmers&fm_id=<?php //echo $fm_id; ?>";
								
								$('#main_li_kyc').removeClass('active');
								$('#main_li_land').addClass('active');

								$('#kyc').removeClass('active');
								$('#land').addClass('active');

								$('#li_appliances_motors').removeClass('active');
								$('#li_farm_land_details').addClass('active');

								$('#div_appliances_motors').removeClass('active');  
								$('#div_farm_land_details').addClass('active');

								loading_hide();
							}
							else if(data.Success == "fail") 
							{
								alert(data.resp);
								loading_hide();	
							}	
						},
						error: function (request, status, error)
						{
							loading_hide();	
						},
						complete: function()
						{
							loading_hide();	
						}	
					});
				}
			});
			
			$('#frm_farm_land_details').on('submit', function(e) 
			{
				e.preventDefault();
				if ($('#frm_farm_land_details').valid())
				{
					loading_show();	
					$.ajax({
							type: "POST",
							url: "action_pages/action_frm9.php",
							data: new FormData(this),
							processData: false,
							contentType: false,
							cache: false,
							success: function(msg)
							{
								data = JSON.parse(msg);
							
								if(data.Success == "Success")
								{
									alert(data.resp);
									//window.location.href="get_farmer_details.php?pag=farmers&fm_id=<?php //echo $fm_id; ?>";
									
									$('#main_li_land').removeClass('active');  
									$('#main_li_crop').addClass('active');

									$('#land').removeClass('active');  
									$('#crop').addClass('active');		

									$('#li_farm_land_details').removeClass('active');  
									$('#li_crop_cultivation').addClass('active');							

									$('#div_farm_land_details').removeClass('active');  
									$('#div_crop_cultivation').addClass('active');	

									loading_hide();
								}
								else if(data.Success == "fail") 
								{
									alert(data.resp);
									loading_hide();	
								}	
							},
							error: function (request, status, error)
							{
								loading_hide();	
							},
							complete: function()
							{
								loading_hide();	
							}	
						});
				}
			});
			
			$('#frm_crop_cultivation').on('submit', function(e) 
			{
				var no_of_crops = $('#no_of_crops').val();

				for (i = 1; i <= no_of_crops; i++) 
				{
					var arr_chk_f10_other_inputs_used	= [];

					// ===========================================
		            // START : other_inputs_used
		            // ===========================================
		            $(".cls_batch_chk_f10_other_inputs_used"+i+":checked").each(function ()
		            {
		                arr_chk_f10_other_inputs_used.push($(this).val());
		            });
		            // ===========================================
		            // END : other_inputs_used
		            // ===========================================

		            $('#batch_chk_f10_other_inputs_used'+i).val(arr_chk_f10_other_inputs_used);

		            var f10_other_farming_expenses = $('#f10_other_farming_expenses'+i).val();

		            if(f10_other_farming_expenses == 'yes')
		            {
		            	var arr_chk_f10_type_other_farming_expenses	= [];

						// ===========================================
			            // START : type_other_farming_expenses
			            // ===========================================
			            $(".cls_batch_chk_f10_type_other_farming_expenses"+i+":checked").each(function ()
			            {
			                arr_chk_f10_type_other_farming_expenses.push($(this).val());
			            });
			            // ===========================================
			            // END : type_other_farming_expenses
			            // ===========================================

			            $('#batch_chk_f10_type_other_farming_expenses'+i).val(arr_chk_f10_type_other_farming_expenses);
		            }
				}

				e.preventDefault();
				if ($('#frm_crop_cultivation').valid())
				{
					loading_show();	
					$.ajax({
							type: "POST",
							url: "action_pages/action_frm10.php",
							data: new FormData(this),
							processData: false,
							contentType: false,
							cache: false,
							success: function(msg)
							{
								data = JSON.parse(msg);
							
								if(data.Success == "Success")
								{
									alert(data.resp);
									//window.location.href="get_farmer_details.php?pag=farmers&fm_id=<?php //echo $fm_id; ?>";
									
									$('#li_crop_cultivation').removeClass('active');  
									$('#li_prev_crop_cycle').addClass('active');							

									$('#div_crop_cultivation').removeClass('active');  
									$('#div_prev_crop_cycle').addClass('active');

									loading_hide();
								}
								else if(data.Success == "fail") 
								{
									alert(data.resp);
									loading_hide();	
								}	
							},
							error: function (request, status, error)
							{
								loading_hide();	
							},
							complete: function()
							{
								loading_hide();	
							}	
						});
				}
			});	
			
			$('#frm_prev_crop_cycle').on('submit', function(e) 
			{
				var no_of_crops = contentCountPrevCrop;
				$('#no_of_yield').val(contentCountPrevCrop);
				for (i = 1; i <= no_of_crops; i++) 
				{
					var arr_chk_f11_other_inputs_used	= [];

					// ===========================================
		            // START : other_inputs_used
		            // ===========================================
		            $(".cls_batch_chk_f11_other_inputs_used"+i+":checked").each(function ()
		            {
		                arr_chk_f11_other_inputs_used.push($(this).val());
		            });
		            // ===========================================
		            // END : other_inputs_used
		            // ===========================================

		            $('#batch_chk_f11_other_inputs_used'+i).val(arr_chk_f11_other_inputs_used);

		            var f11_other_farming_expenses = $('#f11_other_farming_expenses'+i).val();

		            if(f11_other_farming_expenses == 'yes')
		            {
		            	var arr_chk_f11_type_other_farming_expenses	= [];

						// ===========================================
			            // START : type_other_farming_expenses
			            // ===========================================
			            $(".cls_batch_chk_f11_type_other_farming_expenses"+i+":checked").each(function ()
			            {
			                arr_chk_f11_type_other_farming_expenses.push($(this).val());
			            });
			            // ===========================================
			            // END : type_other_farming_expenses
			            // ===========================================

			            $('#batch_chk_f11_type_other_farming_expenses'+i).val(arr_chk_f11_type_other_farming_expenses);
		            }
				}


				e.preventDefault();
				if ($('#frm_prev_crop_cycle').valid())
				{
					loading_show();	
					$.ajax({
							type: "POST",
							url: "action_pages/action_frm11.php",
							data: new FormData(this),
							processData: false,
							contentType: false,
							cache: false,
							success: function(msg)
							{
								data = JSON.parse(msg);
							
								if(data.Success == "Success")
								{
									alert(data.resp);
									//window.location.href="get_farmer_details.php?pag=farmers&fm_id=<?php //echo $fm_id; ?>";
									
									$('#li_prev_crop_cycle').removeClass('active');  
									$('#li_cur_crop_cycle').addClass('active');							

									$('#div_prev_crop_cycle').removeClass('active');  
									$('#div_cur_crop_cycle').addClass('active');

									loading_hide();
								}
								else if(data.Success == "fail") 
								{
									alert(data.resp);
									loading_hide();	
								}	
							},
							error: function (request, status, error)
							{
								loading_hide();	
							},
							complete: function()
							{
								loading_hide();	
							}	
						});
				}
			});
			
			$('#frm_cur_crop_cycle').on('submit', function(e) 
			{
				var no_of_crops = contentCountCurCrop;
				$('#no_of_cur_crop_forecast').val(contentCountCurCrop);
				for (i = 1; i <= no_of_crops; i++) 
				{
					var arr_chk_f14_other_inputs_used	= [];

					// ===========================================
		            // START : other_inputs_used
		            // ===========================================
		            $(".cls_batch_chk_f14_other_inputs_used"+i+":checked").each(function ()
		            {
		                arr_chk_f14_other_inputs_used.push($(this).val());
		            });
		            // ===========================================
		            // END : other_inputs_used
		            // ===========================================

		            $('#batch_chk_f14_other_inputs_used'+i).val(arr_chk_f14_other_inputs_used);

		            var f14_other_farming_expenses = $('#f14_other_farming_expenses'+i).val();

		            if(f14_other_farming_expenses == 'yes')
		            {
		            	var arr_chk_f14_type_other_farming_expenses	= [];

						// ===========================================
			            // START : type_other_farming_expenses
			            // ===========================================
			            $(".cls_batch_chk_f14_type_other_farming_expenses"+i+":checked").each(function ()
			            {
			                arr_chk_f14_type_other_farming_expenses.push($(this).val());
			            });
			            // ===========================================
			            // END : type_other_farming_expenses
			            // ===========================================

			            $('#batch_chk_f14_type_other_farming_expenses'+i).val(arr_chk_f14_type_other_farming_expenses);
		            }
				}

				e.preventDefault();
				if ($('#frm_cur_crop_cycle').valid())
				{
					loading_show();	
					$.ajax({
							type: "POST",
							url: "action_pages/action_frm14.php",
							data: new FormData(this),
							processData: false,
							contentType: false,
							cache: false,
							success: function(msg)
							{
								data = JSON.parse(msg);
							
								if(data.Success == "Success")
								{
									alert(data.resp);
									//window.location.href="get_farmer_details.php?pag=farmers&fm_id=<?php //echo $fm_id; ?>";
									
									$('#main_li_crop').removeClass('active');  
									$('#main_li_assets').addClass('active');

									$('#crop').removeClass('active');  
									$('#assets').addClass('active');

									$('#li_cur_crop_cycle').removeClass('active');  
									$('#li_asset_details').addClass('active');							

									$('#div_cur_crop_cycle').removeClass('active');  
									$('#div_asset_details').addClass('active');

									loading_hide();
								}
								else if(data.Success == "fail") 
								{
									alert(data.resp);
									loading_hide();	
								}	
							},
							error: function (request, status, error)
							{
								loading_hide();	
							},
							complete: function()
							{
								loading_hide();	
							}	
						});
				}
			});	

			$('#frm_asset_details').on('submit', function(e) 
			{
				e.preventDefault();
				if ($('#frm_asset_details').valid())
				{
					loading_show();	
					$.ajax({
							type: "POST",
							url: "action_pages/action_frm12.php",
							data: new FormData(this),
							processData: false,
							contentType: false,
							cache: false,
							success: function(msg)
							{
								data = JSON.parse(msg);
							
								if(data.Success == "Success")
								{
									alert(data.resp);
									//window.location.href="get_farmer_details.php?pag=farmers&fm_id=<?php //echo $fm_id; ?>";
									
									$('#li_asset_details').removeClass('active');  
									$('#li_live_stock').addClass('active');

									$('#div_asset_details').removeClass('active');  
									$('#div_live_stock').addClass('active');

									loading_hide();
								}
								else if(data.Success == "fail") 
								{
									alert(data.resp);
									loading_hide();	
								}	
							},
							error: function (request, status, error)
							{
								loading_hide();	
							},
							complete: function()
							{
								loading_hide();	
							}	
						});
				}
			});	
		
			$('#frm_live_stock').on('submit', function(e) 
			{
				e.preventDefault();
				if ($('#frm_live_stock').valid())
				{
					loading_show();	
					$.ajax({
							type: "POST",
							url: "action_pages/action_frm13.php",
							data: new FormData(this),
							processData: false,
							contentType: false,
							cache: false,
							success: function(msg)
							{
								data = JSON.parse(msg);
							
								if(data.Success == "Success")
								{
									alert(data.resp);
									//window.location.href="get_farmer_details.php?pag=farmers&fm_id=<?php //echo $fm_id; ?>";
									
									$('#main_li_assets').removeClass('active');  
									$('#main_li_loan').addClass('active');

									$('#assets').removeClass('active');  
									$('#loan').addClass('active');

									$('#li_live_stock').removeClass('active');  
									$('#li_financial_details').addClass('active');

									$('#div_live_stock').removeClass('active');  
									$('#div_financial_details').addClass('active');

									var hid_f11_income			= parseInt($('#hid_f11_income').val()) || 0;
									var hid_livestock_income	= parseInt($('#hid_livestock_income').val()) || 0;
									//alert('hid_f11_income : '+hid_f11_income);
									//alert('hid_livestock_income : '+hid_livestock_income);
									var fx_monthly_income	= (hid_f11_income + hid_livestock_income) / 12;
									//alert(fx_monthly_income);
									$('#fx_monthly_income').val(fx_monthly_income);

									loading_hide();
								}
								else if(data.Success == "fail") 
								{
									alert(data.resp);
									loading_hide();	
								}	
							},
							error: function (request, status, error)
							{
								loading_hide();	
							},
							complete: function()
							{
								loading_hide();	
							}	
						});
				}
			});
			
			$('#frm_financial_details').on('submit', function(e) 
			{
				e.preventDefault();
				if ($('#frm_financial_details').valid())
				{
					loading_show();	
					$.ajax({
							type: "POST",
							url: "action_pages/action_frm8.php",
							data: new FormData(this),
							processData: false,
							contentType: false,
							cache: false,
							success: function(msg)
							{
								data = JSON.parse(msg);
							
								if(data.Success == "Success")
								{
									alert(data.resp);
									//window.location.href="get_farmer_details.php?pag=farmers&fm_id=<?php //echo $fm_id; ?>";
									
									$('#li_financial_details').removeClass('active');  
									$('#li_financial_history').addClass('active');

									$('#div_financial_details').removeClass('active');  
									$('#div_financial_history').addClass('active');

									loading_hide();
								}
								else if(data.Success == "fail") 
								{
									alert(data.resp);
									loading_hide();	
								}	
							},
							error: function (request, status, error)
							{
								loading_hide();	
							},
							complete: function()
							{
								loading_hide();	
							}	
						});
				}
			});	
		
			$('#frm_financial_history').on('submit', function(e) 
			{
				e.preventDefault();
				if ($('#frm_financial_history').valid())
				{
					loading_show();	
					$.ajax({
							type: "POST",
							url: "action_pages/action_frm8_fh.php",
							data: new FormData(this),
							processData: false,
							contentType: false,
							cache: false,
							success: function(msg)
							{
								data = JSON.parse(msg);
							
								if(data.Success == "Success")
								{
									alert(data.resp);
									//window.location.href="get_farmer_details.php?pag=farmers&fm_id=<?php //echo $fm_id; ?>";
									
									window.location.href="view_farmers.php?pag=farmers";

									loading_hide();
								}
								else if(data.Success == "fail") 
								{
									alert(data.resp);
									loading_hide();	
								}	
							},
							error: function (request, status, error)
							{
								loading_hide();	
							},
							complete: function()
							{
								loading_hide();	
							}	
						});
				}
			});
			
			
			// $('#f2_participation').on('change', function(){
			// 	if($(this).val() == 'yes'){
			// 		$('#program_detail').show('swing');
			// 	}
			// 	else
			// 	{
			// 		$('#program_detail').hide('swing');
			// 		$('#program_detail').find('input, select').val('').trigger('change');
			// 	}
			// 	calTotal_f2();
			// });


			// if($('#f2_participation').val() == 'yes')
			// {
			// 	$('#program_detail').show('swing');
			// }
			// else
			// {
			// 	$('#program_detail').hide('swing');
			// 	$('#program_detail').find('input, select').val('').trigger('change');
			// }
			
			$('#f2_typeprog').on('change', function(){
				if($(this).val()){
					$('#progType').text($(this).val());
				}
				else{
					$('#progType').text('Crop');
				}
			});
			
			$('#f8_loan_taken').on('change', function(){
				
				if($(this).val() == 'yes')
				{
					$('#loan_taken').show('swing');
					$('#num_of_loan').val(1);
				}
				else
				{
					$('#loan_taken').hide('swing');
					$('#num_of_loan').val();
				}
				calTotal_f8();
			});
			
			// $('#f8_loan_borrowed_from').on('change', function(){
			// 	calTotal_f8();
			// });
			
			// $('#f8_other_insurance').on('change', function(){
			// 	calTotal_f8();
			// });
			
			// $('#f8_any_insurance').on('change', function(){
				
			// 	if($(this).val() == 'yes')
			// 	{
			// 		$('#div_any_insurance_display').show('swing');
			// 	}
			// 	else
			// 	{
			// 		$('#div_any_insurance_display').hide('swing');
			// 	}
			// 	calTotal_f8();
			// });

			$('#f8_crop_insurance').on('change', function(){
				
				if($(this).val() == 'yes')
				{
					$('#div_crop_insurance_display').show('swing');
				}
				else
				{
					$('#div_crop_insurance_display').hide('swing');
				}
			});
			
			$('#f8_any_subsidies').on('change', function(){
				
				if($(this).val() == 'yes')
				{
					$('#div_any_subsidies_display').show('swing');
				}
				else
				{
					$('#div_any_subsidies_display').hide('swing');
				}
			});
			
			$('#f8_any_loan_waivers').on('change', function(){
				
				if($(this).val() == 'yes')
				{
					$('#div_any_loan_waivers_display').show('swing');
				}
				else
				{
					$('#div_any_loan_waivers_display').hide('swing');
				}
			});
			
			$('#f12_any_other_assets').on('change', function(){
				if($(this).val() == 'yes'){
					$('#div_any_other_assets_display').show('swing');
				}
				else
				{
					$('#div_any_other_assets_display').hide('swing');
					$('#div_any_other_assets_display').find('input, select').val('').trigger('change');
				}
				calTotal_f12();
			});
			
			$('#f7_television').on('blur', function(){
				if($(this).val() != '' && $(this).val() != 'null')
				{
					calTotal_f7();
				}
			});
			
			$('#f7_refrigerator').on('blur', function(){
				if($(this).val() != '' && $(this).val() != 'null')
				{
					calTotal_f7();
				}
			});
			
			$('#f7_wmachine').on('blur', function(){
				if($(this).val() != '' && $(this).val() != 'null')
				{
					calTotal_f7();
				}
			});
			   
			$('#f7_mixer').on('blur', function(){
				if($(this).val() != '' && $(this).val() != 'null')
				{
					calTotal_f7();
				}
			});
			
			$('#f7_stove').on('blur', function(){
				if($(this).val() != '' && $(this).val() != 'null')
				{
					calTotal_f7();
				}
			});
			
			$('#f7_bicycle').on('blur', function(){
				if($(this).val() != '' && $(this).val() != 'null')
				{
					calTotal_f7();
				}
			});
			   
			$('#f7_ccylinder').on('blur', function(){
				if($(this).val() != '' && $(this).val() != 'null')
				{
					calTotal_f7();
				}
			});
			
			$('#f7_fans').on('blur', function(){
				if($(this).val() != '' && $(this).val() != 'null')
				{
					calTotal_f7();
				}
			});
			
			$('#f7_motorcycle').on('blur', function(){
				if($(this).val() != '' && $(this).val() != 'null')
				{
					calTotal_f7();
				}
			});
			
			$('#f7_car').on('blur', function(){
				if($(this).val() != '' && $(this).val() != 'null')
				{
					calTotal_f7();
				}
			});
			

			// START : f12

			$('#f12_TRACTOR').on('blur', function(){
				if($(this).val() != '' && $(this).val() != 'null')
				{
					calTotal_f12();
				}
			});

			// $('#f12_COMBINE_HARVESTER').on('blur', function(){
			// 	if($(this).val() != '' && $(this).val() != 'null')
			// 	{
			// 		calTotal_f12();
			// 	}
			// });

			// $('#f12_PLOW').on('blur', function(){
			// 	if($(this).val() != '' && $(this).val() != 'null')
			// 	{
			// 		calTotal_f12();
			// 	}
			// });

			// $('#f12_PLANTER').on('blur', function(){
			// 	if($(this).val() != '' && $(this).val() != 'null')
			// 	{
			// 		calTotal_f12();
			// 	}
			// });

			// $('#f12_LOADER').on('blur', function(){
			// 	if($(this).val() != '' && $(this).val() != 'null')
			// 	{
			// 		calTotal_f12();
			// 	}
			// });

			// $('#f12_BAILER').on('blur', function(){
			// 	if($(this).val() != '' && $(this).val() != 'null')
			// 	{
			// 		calTotal_f12();
			// 	}
			// });

			// $('#f12_SKID_STEER_LOADER').on('blur', function(){
			// 	if($(this).val() != '' && $(this).val() != 'null')
			// 	{
			// 		calTotal_f12();
			// 	}
			// });

			// $('#f12_MOWER').on('blur', function(){
			// 	if($(this).val() != '' && $(this).val() != 'null')
			// 	{
			// 		calTotal_f12();
			// 	}
			// });

			// $('#f12_REAPER').on('blur', function(){
			// 	if($(this).val() != '' && $(this).val() != 'null')
			// 	{
			// 		calTotal_f12();
			// 	}
			// });

			// $('#f12_THRESHING_MACHINE').on('blur', function(){
			// 	if($(this).val() != '' && $(this).val() != 'null')
			// 	{
			// 		calTotal_f12();
			// 	}
			// });

			// $('#f12_SEED_DRILL').on('blur', function(){
			// 	if($(this).val() != '' && $(this).val() != 'null')
			// 	{
			// 		calTotal_f12();
			// 	}
			// });

			// $('#f12_DISC_HARROW').on('blur', function(){
			// 	if($(this).val() != '' && $(this).val() != 'null')
			// 	{
			// 		calTotal_f12();
			// 	}
			// });

			// $('#f12_TRANSPLANTER').on('blur', function(){
			// 	if($(this).val() != '' && $(this).val() != 'null')
			// 	{
			// 		calTotal_f12();
			// 	}
			// });

			// $('#f12_ROLLER').on('blur', function(){
			// 	if($(this).val() != '' && $(this).val() != 'null')
			// 	{
			// 		calTotal_f12();
			// 	}
			// });

			// $('#f12_SUBSPOILER').on('blur', function(){
			// 	if($(this).val() != '' && $(this).val() != 'null')
			// 	{
			// 		calTotal_f12();
			// 	}
			// });

			// $('#f12_STONE_PICKER').on('blur', function(){
			// 	if($(this).val() != '' && $(this).val() != 'null')
			// 	{
			// 		calTotal_f12();
			// 	}
			// });

			// $('#f12_DRILL').on('blur', function(){
			// 	if($(this).val() != '' && $(this).val() != 'null')
			// 	{
			// 		calTotal_f12();
			// 	}
			// });

			// $('#f12_CONDITIONER').on('blur', function(){
			// 	if($(this).val() != '' && $(this).val() != 'null')
			// 	{
			// 		calTotal_f12();
			// 	}
			// });

			// $('#f12_CHASER_BIN').on('blur', function(){
			// 	if($(this).val() != '' && $(this).val() != 'null')
			// 	{
			// 		calTotal_f12();
			// 	}
			// });

			// $('#f12_STEAM_TRACTOR').on('blur', function(){
			// 	if($(this).val() != '' && $(this).val() != 'null')
			// 	{
			// 		calTotal_f12();
			// 	}
			// });

			// $('#f12_HAY_RAKE').on('blur', function(){
			// 	if($(this).val() != '' && $(this).val() != 'null')
			// 	{
			// 		calTotal_f12();
			// 	}
			// });

			$('#f12_Sprayer').on('blur', function(){
				if($(this).val() != '' && $(this).val() != 'null')
				{
					calTotal_f12();
				}
			});

			// $('#f12_Rice_Huller').on('blur', function(){
			// 	if($(this).val() != '' && $(this).val() != 'null')
			// 	{
			// 		calTotal_f12();
			// 	}
			// });

			$('#f12_Pumps').on('blur', function(){
				if($(this).val() != '' && $(this).val() != 'null')
				{
					calTotal_f12();
				}
			});

			$('#f12_Protavator').on('blur', function(){
				if($(this).val() != '' && $(this).val() != 'null')
				{
					calTotal_f12();
				}
			});

			// $('#f12_Blower').on('blur', function(){
			// 	if($(this).val() != '' && $(this).val() != 'null')
			// 	{
			// 		calTotal_f12();
			// 	}
			// });

			// $('#f12_Cutters').on('blur', function(){
			// 	if($(this).val() != '' && $(this).val() != 'null')
			// 	{
			// 		calTotal_f12();
			// 	}
			// });

			$('#f12_Cultivators').on('blur', function(){
				if($(this).val() != '' && $(this).val() != 'null')
				{
					calTotal_f12();
				}
			});

			// END : f12

			// START : f13
			$('#f13_dairy_cattle').on('blur', function(){
				if($(this).val() != '' && $(this).val() != 'null')
				{
					calTotal_f13();
				}
			});
			
			$('#f13_draft_cattle').on('blur', function(){
				if($(this).val() != '' && $(this).val() != 'null')
				{
					calTotal_f13();
				}
			});
			
			$('#f13_buffalo').on('blur', function(){
				if($(this).val() != '' && $(this).val() != 'null')
				{
					calTotal_f13();
				}
			});
			   
			$('#f13_ox').on('blur', function(){
				if($(this).val() != '' && $(this).val() != 'null')
				{
					calTotal_f13();
				}
			});
			
			$('#f13_sheep').on('blur', function(){
				if($(this).val() != '' && $(this).val() != 'null')
				{
					calTotal_f13();
				}
			});
			
			$('#f13_goat').on('blur', function(){
				if($(this).val() != '' && $(this).val() != 'null')
				{
					calTotal_f13();
				}
			});
			   
			$('#f13_pig').on('blur', function(){
				if($(this).val() != '' && $(this).val() != 'null')
				{
					calTotal_f13();
				}
			});
			
			$('#f13_poultry').on('blur', function(){
				if($(this).val() != '' && $(this).val() != 'null')
				{
					calTotal_f13();
				}
			});
			
			$('#f13_livestock_income').on('blur', function(){
				if($(this).val() != '' && $(this).val() != 'null')
				{
					calTotal_f13();
				}
			});
			// END : f13
			
			// $('#f3_spouse_mfiamount').on('blur', function(){
			
			// 	calTotal_f3();
				
			// });
			
			// $('#f3_spouse_owned_prop').on('change', function()
			// {
			// 	if($(this).val() == 'yes')
			// 	{
			// 		$('#div_f3_spouse_owned_prop_display').show('swing');
			// 	}
			// 	else
			// 	{
			// 		$('#div_f3_spouse_owned_prop_display').hide('swing');
			// 		$('#div_f3_spouse_owned_prop_display').find('input, select').val('').trigger('change');
			// 	}
			// });
			
			// $('#f3_spouse_get_any_income').on('change', function(){
				
			// 	if($(this).val() == 'yes')
			// 	{
			// 		$('#div_income_display').show('swing');
			// 	}
			// 	else
			// 	{
			// 		$('#div_income_display').hide('swing');
			// 		$('#div_income_display').find('input, select').val('').trigger('change');
			// 	}
			// });
			
			// if($('#f3_spouse_get_any_income').val() == 'yes')
			// {
			// 	$('#div_income_display').show('swing');
			// }
			// else
			// {
			// 	$('#div_income_display').hide('swing');
			// 	$('#div_income_display').find('input, select').val('').trigger('change');
			// }

			function numsonly(e)
			{
				var unicode=e.charCode? e.charCode : e.keyCode
				
				if (unicode !=8 && unicode !=32 &&  unicode !=46)
				{  // unicode<48||unicode>57 &&
					if ( unicode<48||unicode>57)  //if not a number
					return false //disable key press
				}
			}
			
			
			/*var xland = document.getElementById("xland");
			
			function getLocation1()
			{
				alert("hello geo");
				 if (navigator.geolocation) {
        				navigator.geolocation.getCurrentPosition(showPosition, showError);
   				 } else { 
        			x.innerHTML = "Geolocation is not supported by this browser.";
   				 }
			}
			
			function showPosition(position) {
				x.innerHTML = "Latitude: " + position.coords.latitude + 
				"<br>Longitude: " + position.coords.longitude;
			}
			
			function showError(error) {
				switch(error.code) {
					case error.PERMISSION_DENIED:
						x.innerHTML = "User denied the request for Geolocation."
						break;
					case error.POSITION_UNAVAILABLE:
						x.innerHTML = "Location information is unavailable."
						break;
					case error.TIMEOUT:
						x.innerHTML = "The request to get user location timed out."
						break;
					case error.UNKNOWN_ERROR:
						x.innerHTML = "An unknown error occurred."
						break;
				}
			}
			*/
			
			function ownership(id,value)
			{
				if(value == 'Leased')
				{
					$('#div_lease_display'+id).show('swing');
					$('#div_rental_display'+id).hide('swing');
					$('#div_contract_display'+id).hide('swing');
					
					$('#f9_amount_on_rent'+id).val('');
					$('#f9_contract_year'+id).val('');
				}
				else if(value == 'Contracted')
				{
					$('#div_contract_display'+id).show('swing');
					$('#div_rental_display'+id).hide('swing');
					$('#div_lease_display'+id).hide('swing');
					
					$('#f9_amount_on_rent'+id).val('');
					$('#f9_lease_year'+id).val('');
				}
				else if(value == 'Rented')
				{
					$('#div_rental_display'+id).show('swing');
					$('#div_contract_display'+id).hide('swing');
					$('#div_lease_display'+id).hide('swing');
					
					$('#f9_contract_year'+id).val('');
					$('#f9_lease_year'+id).val('');
				}
				else if(value == 'Owned')
				{
					$('#div_rental_display'+id).hide('swing');
					$('#div_contract_display'+id).hide('swing');
					$('#div_lease_display'+id).hide('swing');
					
					$('#f9_contract_year'+id).val('');
					$('#f9_amount_on_rent'+id).val('');
					$('#f9_lease_year'+id).val('');
				}
				else if(value == 'Ancestral')
				{
					$('#div_rental_display'+id).hide('swing');
					$('#div_contract_display'+id).hide('swing');
					$('#div_lease_display'+id).hide('swing');
					
					$('#f9_contract_year'+id).val('');
					$('#f9_amount_on_rent'+id).val('');
					$('#f9_lease_year'+id).val('');	
				}
				
				calTotal_f9();
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
			
			function addMoreLand(remove)
			{
				if(remove==1)
				{
					if(contentCountLand > 1)
					{
						$('#lands').find('#land'+contentCountLand).slideUp("slow", function(){
							$(this).remove();
							contentCountLand--;
							calTotal_f9();
						});
					}
					/*$('#lands').find('#land'+contentCountLand).slideUp("slow");
					contentCountLand    = contentCountLand - 1
					if(contentCountLand==1)
					{
						$('#removeLandType').hide('swing');
					}
					calTotal_f9();*/
					return false;
				}
				
				var farmer_id 		= "<?php echo $fm_id; ?>";
				contentCountLand    = contentCountLand + 1
				
				landData	= '';


				var sendInfo 	= {"contentCountLand":contentCountLand, "farmer_id":farmer_id, "addLandData":1};
				var del_cat 	= JSON.stringify(sendInfo);								
				$.ajax({
					url: "load_farmer.php?",
					type: "POST",
					data: del_cat,
					contentType: "application/json; charset=utf-8",						
					success: function(response) 
					{	
						data = JSON.parse(response);
						if(data.Success == "Success") 
						{	
							//console.log(data.resp);
							//landData	= data.resp;
							$('#lands').append(data.resp).find('#land'+contentCountLand).slideDown("slow");

						} 
						else
						{
							alert(data.resp);
							//loading_hide();
						}
					},
					error: function (request, status, error) 
					{
						alert(request.responseText);
						//loading_hide();
					},
					complete: function()
					{
						//loading_hide();
						//alert("complete");
					}
				});

				/*alert(landData);
				return false;*/
				
				$('#lands').append(landData).find('#land'+contentCountLand).slideDown("slow");
				
				//getSelect();
				$('#f9_owner'+contentCountLand).select2();
				$('#f9_state'+contentCountLand).select2();
				$('#f9_district'+contentCountLand).select2();
				$('#f9_taluka'+contentCountLand).select2();
				$('#f9_vilage'+contentCountLand).select2();
				$('#f9_soil_type'+contentCountLand).select2();
				$('#f9_soil_tested'+contentCountLand).select2();
				$('#f9_source_of_water'+contentCountLand).select2();
				
				if(contentCountLand >= 2)
				{
					$('#removeLandType').show('swing');
				}
			}
			
			function removeContent()
			{
				if(contentCountCrop > 1){
					
					$('#formContent').find('#crop'+contentCountCrop).slideUp("slow", function(){
						$(this).remove();
						contentCountCrop--;
						calTotal_f10();
					});
				}
			}
			
			function appendContent()
			{
				contentCountCrop++;
				var farmer_id 	= '<?php echo $fm_id; ?>';
				// var cropData	= '';
				// alert('Hi');
				
				var sendInfo 	= {"contentCountCrop":contentCountCrop, "farmer_id":farmer_id, "addCropData":1};
				var del_cat 	= JSON.stringify(sendInfo);								


				$.ajax({
					url: "load_farmer.php?",
					type: "POST",
					data: del_cat,
					contentType: "application/json; charset=utf-8",						
					success: function(response) 
					{	
						data = JSON.parse(response);

						if(data.Success == "Success") 
						{	
							$('#formContent').append(data.resp).find('#crop'+contentCountCrop).slideDown("slow");
						} 
						else
						{
							alert(data.resp);
							//loading_hide();
						}
					},
					error: function (request, status, error) 
					{
						alert(request.responseText);
						//loading_hide();
					},
					complete: function()
					{
						//loading_hide();
						//alert("complete");
					}
				});

				// $('#formContent').append(cropData).find('#crop'+contentCountCrop).slideDown("slow");
				
				$('.datepicker').datepicker({format:'yyyy-mm-dd'});
				$('#f10_crop_season'+contentCountCrop).select2();
				$('#f10_cultivating'+contentCountCrop).select2();
				$('#f10_stage'+contentCountCrop).select2();
				$('#f10_potential_market'+contentCountCrop).select2();
				$('#f10_crop_storage'+contentCountCrop).select2();
				$('#f10_diseases'+contentCountCrop).select2();
				// $('#f10_pest'+contentCountCrop).select2();
				//$('#f10_filt_type'+contentCountCrop).select2();
				
				calTotal_f10();
			}
			
			function removePrevCropContent()
			{
				if(contentCountPrevCrop > 1){
					
					$('#prev_crop').find('#prevcrop'+contentCountPrevCrop).slideUp("slow", function(){
						$(this).remove();
						contentCountPrevCrop--;
						if(contentCountPrevCrop==1)
						{
							$('.removePrevCrop').hide('swing');
						}
						calTotal_f11();
					});
				}
			}
			
			function appendPrevCropContent()
			{
				contentCountPrevCrop++;
				var farmer_id 	= '<?php echo $fm_id; ?>';
				// var prevCropData	= '';
				
				var sendInfo 	= {"contentCountPrevCrop":contentCountPrevCrop, "farmer_id":farmer_id, "addPrevCropData":1};
				var del_cat 	= JSON.stringify(sendInfo);								
				$.ajax({
					url: "load_farmer.php?",
					type: "POST",
					data: del_cat,
					contentType: "application/json; charset=utf-8",						
					success: function(response) 
					{	
						data = JSON.parse(response);
						if(data.Success == "Success") 
						{	
							if(contentCountPrevCrop>1)
							{
								$('.removePrevCrop').show('swing');
							}
							$('#prev_crop').append(data.resp).find('#prevcrop'+contentCountPrevCrop).slideDown("slow");
						} 
						else
						{
							alert(data.resp);
							//loading_hide();
						}
					},
					error: function (request, status, error) 
					{
						alert(request.responseText);
						//loading_hide();
					},
					complete: function()
					{
						//loading_hide();
						//alert("complete");
					}
				});
				
				$('.datepicker'+contentCountPrevCrop).datepicker({format:'yyyy-mm-dd'});
				$('#f11_cultivating'+contentCountPrevCrop).select2();
				//$('#f11_diseases'+contentCountPrevCrop).select2();
				//$('#f11_fertilizers'+contentCountPrevCrop).select2();
				//$('#f11_damaged_prev_crop'+contentCountPrevCrop).select2();
				$('#f11_what_was_the_reason'+contentCountPrevCrop).select2();


				calTotal_f11();
			}
			
			function removeCurCropContent()
			{
				if(contentCountCurCrop > 1){
					
					$('#cur_crop').find('#curcrop'+contentCountCurCrop).slideUp("slow", function(){
						$(this).remove();
						contentCountCurCrop--;
						if(contentCountCurCrop==1)
						{
							$('.removeCurCrop').hide('swing');
						}
						calTotal_f14();
					});
				}
			}
			
			function appendCurCropContent()
			{
				contentCountCurCrop++;
				
				var farmer_id 	= '<?php echo $fm_id; ?>';
				var curCropData	= '';
				
				var sendInfo 	= {"contentCountCurCrop":contentCountCurCrop, "farmer_id":farmer_id, "addCurCropData":1};
				var del_cat 	= JSON.stringify(sendInfo);								
				$.ajax({
					url: "load_farmer.php?",
					type: "POST",
					data: del_cat,
					contentType: "application/json; charset=utf-8",						
					success: function(response) 
					{	
						data = JSON.parse(response);
						if(data.Success == "Success") 
						{	
							if(contentCountCurCrop>1)
							{
								$('.removeCurCrop').show('swing');
							}
							$('.datepicker'+contentCountCurCrop+'').datepicker({format:'yyyy-mm-dd'});
							$('#cur_crop').append(data.resp).find('#curcrop'+contentCountCurCrop).slideDown("slow");
						} 
						else
						{
							alert(data.resp);
							//loading_hide();
						}
					},
					error: function (request, status, error) 
					{
						alert(request.responseText);
						//loading_hide();
					},
					complete: function()
					{
						//loading_hide();
						//alert("complete");
					}
				});
				
				

				$('#f14_crop_type'+contentCountCurCrop).select2();
				$('#f14_cultivating'+contentCountCurCrop).select2();
				$('#f14_variety'+contentCountCurCrop).select2();
				$('#f14_seed_type'+contentCountCurCrop).select2();
				// $('#f14_use_self_grown_seeds'+contentCountCurCrop).select2();
				//$('#f14_loan_taken'+contentCountCurCrop).select2();
				//$('#f14_borrow_loan_from'+contentCountCurCrop).select2();
				$('#f14_diseases'+contentCountCurCrop).select2();
				$('#f14_water_source_type'+contentCountCurCrop).select2();


				calTotal_f14();
			}
			
			function removeLoanFrm1Content()
			{
				if(contentCountLoanFrm1 > 1){
					
					$('#loans_type').find('#loan'+contentCountLoanFrm1).slideUp("slow", function(){
						$(this).remove();
						contentCountLoanFrm1--;
						if(contentCountLoanFrm1==1)
						{
							$('.removeLoanFrm1').hide('swing');
						}
						calTotal_f8();
					});
				}
			}
			
			function appendLoanFrm1Content()
			{
				contentCountLoanFrm1++;
				
				var loanData	= '';
				
				loanData	+= '<div id="loan'+contentCountLoanFrm1+'" style="padding:5px;border:1px solid #d6d6d6;margin:5px;display:none">';
					loanData	+= '<h3>Loan '+contentCountLoanFrm1+'</h3>';
					loanData	+= '<input type="hidden" name="id[]" id="id" value="">';
									
					loanData	+= '<div class="control-group">';
						loanData	+= '<label for="text" class="control-label" style="margin-top:10px">Mention the Loan Type<span style="color:#F00">*</span></label>';
						loanData	+= '<div class="controls">';
							loanData	+= '<select onchange="calTotal_f8();" id="f8_loan_type'+contentCountLoanFrm1+'" name="f8_loan_type'+contentCountLoanFrm1+'" class="select2-me input-xlarge" data-rule-required="true">';
								loanData	+= '<option value="" disabled selected> Select here</option>';
								loanData	+= '<option value="Education" >Education</option>';
								loanData	+= '<option value="Land">Land</option>';
								loanData	+= '<option value="Agriculture">Agriculture</option>';
								loanData	+= '<option value="Two Wheeler">Two Wheeler</option>';
								loanData	+= '<option value="Equipment">Equipment</option>';
								loanData	+= '<option value="Irrigation">Irrigation</option>';
								loanData	+= '<option value="Fencing">Fencing</option>';
								loanData	+= '<option value="Housing">Housing</option>';
								loanData	+= '<option value="Construction OR Renovation">Construction/Renovation</option>';
								loanData	+= '<option value="Four Wheeler">Four Wheeler</option>';
								loanData	+= '<option value="Electronics">Electronics</option>';
								loanData	+= '<option value="NA">NA</option>';
								loanData	+= '<option value="Others">Others</option>';
							loanData	+= '</select>';
						loanData	+= '</div>';
					loanData	+= '</div>';
									
					loanData	+= '<div class="control-group">';
						loanData	+= '<label for="numberfield" class="control-label">Total Loan Amount<span style="color:#F00">*</span></label>';
						loanData	+= '<div class="controls">';
							loanData	+= '<input type="text" class="input-xlarge" placeholder="Loan Amount" name="f8_loan_amount'+contentCountLoanFrm1+'" id="f8_loan_amount'+contentCountLoanFrm1+'" onKeyPress=" return numsonly(event);"  data-rule-required="true"  maxlength="10">';
						loanData	+= '</div>';
					loanData	+= '</div>';
									
					loanData	+= '<div class="control-group">';
						loanData	+= '<label for="numberfield" class="control-label">Provider<span style="color:#F00">*</span></label>';
						loanData	+= '<div class="controls">';
							loanData	+= '<input type="text" class="input-xlarge ui-wizard-content" placeholder="Loan Provider" name="f8_loan_provider'+contentCountLoanFrm1+'" id="f8_loan_provider'+contentCountLoanFrm1+'" data-rule-required="true"   >';
							loanData	+= '<label id="f8_loan_provider1_err" style="color:#FF0000;width:200px;margin-left:100px;"></label>';
						loanData	+= '</div>';
					loanData	+= '</div>';
					
					// loanData	+= '<div class="control-group">';
					//                  	loanData	+= '<label for="text" class="control-label" style="margin-top:10px">Has Loan Matured<span style="color:#F00">*</span></label>';
					//                    loanData	+= '<div class="controls">';
					//                    	loanData	+= '<select onchange="divDisplayOpen(this.value, \'f8_has_loan_matured_display'+contentCountLoanFrm1+'\');" id="f8_has_loan_matured'+contentCountLoanFrm1+'" name="f8_has_loan_matured'+contentCountLoanFrm1+'" class="select2-me input-xlarge" data-rule-required="true">';
					//                         	loanData	+= '<option value="" disabled selected> Select here</option>';
					//                            loanData	+= '<option value="yes" >Yes</option>';
					//                            loanData	+= '<option value="no">No</option>';
					//                        loanData	+= '</select>';
					//                    loanData	+= '</div>';
					//                loanData	+= '</div>';
					
					//                loanData	+= '<div id="f8_has_loan_matured_display'+contentCountLoanFrm1+'" style="display:none;">';
					//                    loanData	+= '<div class="control-group">';
					// 		loanData	+= '<label for="numberfield" class="control-label">Current Outstanding Loan Amount With Interest<span style="color:#F00">*</span></label>';
					// 		loanData	+= '<div class="controls">';
					// 			loanData	+= '<input onchange="calTotal_f8();" data-rule-required="true" type="text" class="input-xlarge ui-wizard-content" onKeyPress="return numsonly(event);" placeholder="Outstanding Loan Amount With Interest" name="f8_outstanding_loan'+contentCountLoanFrm1+'" id="f8_outstanding_loan'+contentCountLoanFrm1+'" data-rule-number="true" data-rule-maxlength="10">';
					// 		loanData	+= '</div>';
					// 	loanData	+= '</div>';
										
					// 	// loanData	+= '<div class="control-group">';
					// 	// 	loanData	+= '<label for="numberfield" class="control-label">Therefore, No. of Months to clear Outstanding</label>';
					// 	// 	loanData	+= '<div class="controls">';
					// 	// 		loanData	+= '<input  type="text" class="input-xlarge ui-wizard-content" placeholder="No. Of EMI Remaining" name="f8_remaining_emi'+contentCountLoanFrm1+'" id="f8_remaining_emi'+contentCountLoanFrm1+'" data-rule-number="true" data-rule-required="true"  data-rule-maxlength="10">';
					// 	// 	loanData	+= '</div>';
					// 	// loanData	+= '</div>';
					// loanData	+= '</div>';
									
				loanData	+= '</div>';
				
				if(contentCountLoanFrm1>1)
				{
					$('.removeLoanFrm1').show('swing');
				}
				
				$('#loans_type').append(loanData).find('#loan'+contentCountLoanFrm1).slideDown("slow");
				
				$('#f8_loan_type'+contentCountLoanFrm1).select2();
				//$('#f8_has_loan_matured'+contentCountLoanFrm1).select2();
				
				calTotal_f8();
			}
			
			function get_variety(crop_id,no_of_crop, f_num)
			{
				
				$('#'+f_num+'_variety'+no_of_crop).html("");
				
				var sendInfo 	= {"crop_id":crop_id,"get_variety":1};
				var crop_data 	= JSON.stringify(sendInfo);	
				
					$.ajax({
						url: "action_pages/action_frm10.php?",
						type: "POST",
						data: crop_data,
						contentType: "application/json; charset=utf-8",						
						async:true,					
						success: function(response) 
						{		
							data = JSON.parse(response);
							
							if(data.Success == "Success") 
							{	
								$('#'+f_num+'_variety'+no_of_crop).html(data.resp);
							} 
							else
							{
																				
							}
						},
						error: function (request, status, error) 
						{
							//$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
							//$('#error_model').modal('toggle');						
							loading_hide();
						},
						complete: function()
						{
							loading_hide();
							//$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');
							//$('#error_model').modal('toggle');
						}
					});			
			}
			
			function divDisplayOpen(mainDivVal, DisplayDivID)
			{
				//alert(mainDivVal +' <> '+ DisplayDivID);
				if(mainDivVal == 'yes')
				{
					$('#'+DisplayDivID).show('swing');
				}
				else
				{
					$('#'+DisplayDivID).hide('swing');
					$('#'+DisplayDivID).find('input, select').val('').trigger('change');
				}
			}
			
			function getHusbandMobileNumber(husbandMobileNumber)
			{
				$('#f3_spouse_mobno').val(husbandMobileNumber);	
			}
			
			// function getMonthlyIncome(yearIncomeVal)
			// {
			// 	//alert(yearIncomeVal);
			// 	var spouse_monthly_income	= yearIncomeVal / 12;
			// 	// $('#f3_spouse_income').val(spouse_monthly_income);
			// }
			
			// function getOtherDivDisplay(propType)
			// {
			// 	if(propType == 'Other')
			// 	{
			// 		$('#div_other_prop_display').show('swing');
			// 	}
			// 	else
			// 	{
			// 		$('#div_other_prop_display').hide('swing');
			// 		$('#div_other_prop_display').find('input, select').val('').trigger('change');
			// 	}
			// }
			
			function getAcre(entredVal, parameter, displayID, incrementalID)
			{
				var acreVal		= 0;
				var f9_land_size_hector = 0;
				var f9_land_size_acre 	= 0;
				var f9_land_size_guntha = 0;
				
				//alert(parameter);

				if(parameter == 'hector')
				{
					f9_land_size_hector	= entredVal * (5/2);
					f9_land_size_acre	= parseInt($('#f9_land_size_acre'+incrementalID).val()) || 0;
					f9_land_size_guntha	= parseInt($('#f9_land_size_guntha'+incrementalID).val()) || 0;
					f9_land_size_guntha	= f9_land_size_guntha / 40;

					if(isNaN(f9_land_size_acre) == true)
					{
						f9_land_size_acre = 0;	
					}	

					if(isNaN(f9_land_size_hector) == true)
					{
						f9_land_size_hector = 0;	
					}

					if(isNaN(f9_land_size_guntha) == true)
					{
						f9_land_size_guntha = 0;	
					}

					//alert(acreVal	+' = '+ parseInt(f9_land_size_hector) +'<>'+ f9_land_size_acre +'<>'+ f9_land_size_guntha);
					acreVal	= parseInt(f9_land_size_hector) + f9_land_size_acre + f9_land_size_guntha;
					//alert(acreVal	+' = '+ parseInt(f9_land_size_hector) +'<>'+ f9_land_size_acre +'<>'+ f9_land_size_guntha);
				}
				
				if(parameter == 'acre')
				{
					f9_land_size_hector	= parseInt($('#f9_land_size_hector'+incrementalID).val()) || 0;
					f9_land_size_hector	= f9_land_size_hector * (5/2);
					f9_land_size_guntha	= parseInt($('#f9_land_size_guntha'+incrementalID).val()) || 0;
					f9_land_size_guntha	= f9_land_size_guntha / 40;
					f9_land_size_acre	= parseInt(entredVal);

					if(isNaN(f9_land_size_acre) == true)
					{
						f9_land_size_acre = 0;	
					}	

					if(isNaN(f9_land_size_hector) == true)
					{
						f9_land_size_hector = 0;	
					}

					if(isNaN(f9_land_size_guntha) == true)
					{
						f9_land_size_guntha = 0;	
					}


					//alert(acreVal	+' = '+ f9_land_size_hector +'<>'+ parseInt(f9_land_size_acre) +'<>'+ f9_land_size_guntha);
					acreVal	= f9_land_size_hector + parseInt(f9_land_size_acre) + f9_land_size_guntha;
					//alert(acreVal	+' = '+ f9_land_size_hector +'<>'+ parseInt(f9_land_size_acre) +'<>'+ f9_land_size_guntha);
					//alert(f9_land_size_hector +'<>'+ f9_land_size_acre +'<>'+ f9_land_size_guntha)

				}
				
				if(parameter == 'guntha')
				{
					f9_land_size_hector	= parseInt($('#f9_land_size_hector'+incrementalID).val()) || 0;
					f9_land_size_hector	= f9_land_size_hector * (5/2);
					f9_land_size_acre	= parseInt($('#f9_land_size_acre'+incrementalID).val()) || 0;
					f9_land_size_guntha	= entredVal / 40;

					if(isNaN(f9_land_size_acre) == true)
					{
						f9_land_size_acre = 0;	
					}	

					if(isNaN(f9_land_size_hector) == true)
					{
						f9_land_size_hector = 0;	
					}

					if(isNaN(f9_land_size_guntha) == true)
					{
						f9_land_size_guntha = 0;	
					}

					//alert(acreVal	+' = '+ f9_land_size_hector +'<>'+ f9_land_size_acre +'<>'+ parseInt(f9_land_size_guntha));
					acreVal	= f9_land_size_hector + f9_land_size_acre + parseInt(f9_land_size_guntha);
					//alert(acreVal	+' = '+ f9_land_size_hector +'<>'+ f9_land_size_acre +'<>'+ parseInt(f9_land_size_guntha));
				}
				
				$('#'+displayID).val(acreVal);
				calTotal_f9();
			}
			
			function getAcre_f10(entredVal, parameter, displayID, incrementalID)
			{
				var acreVal				= 0;
				var f10_total_hector 	= 0; 
				var f10_total_acre 		= 0;
				var f10_total_guntha 	= 0;
				
				if(parameter == 'hector')
				{
					f10_total_hector	= entredVal * (5/2);
					f10_total_acre		= parseInt($('#f10_total_acre'+incrementalID).val()) || 0;
					f10_total_guntha	= parseInt($('#f10_total_guntha'+incrementalID).val()) || 0;
					f10_total_guntha	= f10_total_guntha / 40;

					if(isNaN(f10_total_acre) == true)
					{
						f10_total_acre = 0;	
					}	

					if(isNaN(f10_total_guntha) == true)
					{
						f10_total_guntha = 0;	
					}

					if(isNaN(f10_total_hector) == true)
					{
						f10_total_hector = 0;	
					}

					acreVal	= f10_total_hector + f10_total_acre + f10_total_guntha;
				}
				
				if(parameter == 'acre')
				{
					f10_total_hector	= parseInt($('#f10_total_hector'+incrementalID).val()) || 0;
					f10_total_hector	= f10_total_hector * (5/2);
					f10_total_guntha	= parseInt($('#f10_total_guntha'+incrementalID).val()) || 0;
					f10_total_guntha	= f10_total_guntha / 40;
					f10_total_acre	= parseInt(entredVal);

					if(isNaN(f10_total_acre) == true)
					{
						f10_total_acre = 0;	
					}	

					if(isNaN(f10_total_guntha) == true)
					{
						f10_total_guntha = 0;	
					}

					if(isNaN(f10_total_hector) == true)
					{
						f10_total_hector = 0;	
					}

					acreVal	= f10_total_hector + f10_total_acre + f10_total_guntha;
					//alert(f10_total_hector +'<>'+ f10_total_acre +'<>'+ f10_total_guntha)
				}
				
				if(parameter == 'guntha')
				{
					f10_total_hector	= parseInt($('#f10_total_hector'+incrementalID).val()) || 0;
					f10_total_hector	= f10_total_hector * (5/2);
					f10_total_acre	= parseInt($('#f10_total_acre'+incrementalID).val()) || 0;
					f10_total_guntha	= entredVal / 40;

					if(isNaN(f10_total_acre) == true)
					{
						f10_total_acre = 0;	
					}	

					if(isNaN(f10_total_guntha) == true)
					{
						f10_total_guntha = 0;	
					}

					if(isNaN(f10_total_hector) == true)
					{
						f10_total_hector = 0;	
					}

					acreVal	= f10_total_hector + f10_total_acre + f10_total_guntha;
				}
				
				$('#'+displayID).val(acreVal);
			}

			function getAcre_f11(entredVal, parameter, displayID, incrementalID)
			{
				var acreVal				= 0;
				var f11_total_hector 	= 0; 
				var f11_total_acre 		= 0;
				var f11_total_guntha 	= 0;
				
				if(parameter == 'hector')
				{
					f11_total_hector	= entredVal * (5/2);
					f11_total_acre		= parseInt($('#f11_total_acre'+incrementalID).val()) || 0;
					f11_total_guntha	= parseInt($('#f11_total_guntha'+incrementalID).val()) || 0;
					f11_total_guntha	= f11_total_guntha / 40;

					if(isNaN(f11_total_acre) == true)
					{
						f11_total_acre = 0;	
					}	

					if(isNaN(f11_total_guntha) == true)
					{
						f11_total_guntha = 0;	
					}

					if(isNaN(f11_total_hector) == true)
					{
						f11_total_hector = 0;	
					}

					acreVal	= f11_total_hector + f11_total_acre + f11_total_guntha;
				}
				
				if(parameter == 'acre')
				{
					f11_total_hector	= parseInt($('#f11_total_hector'+incrementalID).val()) || 0;
					f11_total_hector	= f11_total_hector * (5/2);
					f11_total_guntha	= parseInt($('#f11_total_guntha'+incrementalID).val()) || 0;
					f11_total_guntha	= f11_total_guntha / 40;
					f11_total_acre	= parseInt(entredVal);

					if(isNaN(f11_total_acre) == true)
					{
						f11_total_acre = 0;	
					}	

					if(isNaN(f11_total_guntha) == true)
					{
						f11_total_guntha = 0;	
					}

					if(isNaN(f11_total_hector) == true)
					{
						f11_total_hector = 0;	
					}

					acreVal	= f11_total_hector + f11_total_acre + f11_total_guntha;
					//alert(f11_total_hector +'<>'+ f11_total_acre +'<>'+ f11_total_guntha)
				}
				
				if(parameter == 'guntha')
				{
					f11_total_hector	= parseInt($('#f11_total_hector'+incrementalID).val()) || 0;
					f11_total_hector	= f11_total_hector * (5/2);
					f11_total_acre	= parseInt($('#f11_total_acre'+incrementalID).val()) || 0;
					f11_total_guntha	= entredVal / 40;

					if(isNaN(f11_total_acre) == true)
					{
						f11_total_acre = 0;	
					}	

					if(isNaN(f11_total_guntha) == true)
					{
						f11_total_guntha = 0;	
					}

					if(isNaN(f11_total_hector) == true)
					{
						f11_total_hector = 0;	
					}

					acreVal	= f11_total_hector + f11_total_acre + f11_total_guntha;
				}
				
				$('#'+displayID).val(acreVal);
			}

			function getAcre_f14(entredVal, parameter, displayID, incrementalID)
			{
				var acreVal				= 0;
				var f14_total_hector 	= 0; 
				var f14_total_acre 		= 0;
				var f14_total_guntha 	= 0;
				
				if(parameter == 'hector')
				{
					f14_total_hector	= entredVal * (5/2);
					f14_total_acre		= parseInt($('#f14_total_acre'+incrementalID).val()) || 0;
					f14_total_guntha	= parseInt($('#f14_total_guntha'+incrementalID).val()) || 0;
					f14_total_guntha	= f14_total_guntha / 40;

					if(isNaN(f14_total_acre) == true)
					{
						f14_total_acre = 0;	
					}	

					if(isNaN(f14_total_guntha) == true)
					{
						f14_total_guntha = 0;	
					}

					if(isNaN(f14_total_hector) == true)
					{
						f14_total_hector = 0;	
					}

					acreVal	= f14_total_hector + f14_total_acre + f14_total_guntha;
				}
				
				if(parameter == 'acre')
				{
					f14_total_hector	= parseInt($('#f14_total_hector'+incrementalID).val()) || 0;
					f14_total_hector	= f14_total_hector * (5/2);
					f14_total_guntha	= parseInt($('#f14_total_guntha'+incrementalID).val()) || 0;
					f14_total_guntha	= f14_total_guntha / 40;
					f14_total_acre	= parseInt(entredVal);

					if(isNaN(f14_total_acre) == true)
					{
						f14_total_acre = 0;	
					}	

					if(isNaN(f14_total_guntha) == true)
					{
						f14_total_guntha = 0;	
					}

					if(isNaN(f14_total_hector) == true)
					{
						f14_total_hector = 0;	
					}

					acreVal	= f14_total_hector + f14_total_acre + f14_total_guntha;
					//alert(f14_total_hector +'<>'+ f14_total_acre +'<>'+ f14_total_guntha)
				}
				
				if(parameter == 'guntha')
				{
					f14_total_hector	= parseInt($('#f14_total_hector'+incrementalID).val()) || 0;
					f14_total_hector	= f14_total_hector * (5/2);
					f14_total_acre	= parseInt($('#f14_total_acre'+incrementalID).val()) || 0;
					f14_total_guntha	= entredVal / 40;

					if(isNaN(f14_total_acre) == true)
					{
						f14_total_acre = 0;	
					}	

					if(isNaN(f14_total_guntha) == true)
					{
						f14_total_guntha = 0;	
					}

					if(isNaN(f14_total_hector) == true)
					{
						f14_total_hector = 0;	
					}

					acreVal	= f14_total_hector + f14_total_acre + f14_total_guntha;
				}
				
				$('#'+displayID).val(acreVal);
			}
			
			function getTotalExpectedIncome(incrementalID, f_num)
			{
				var f_num_expected 		= parseInt($('#'+f_num+'_expected'+incrementalID).val()) || 0;
				var f_num_expectedprice	= parseInt($('#'+f_num+'_expectedprice'+incrementalID).val()) || 0;
				var f_num_expectedincome	= f_num_expected * f_num_expectedprice;

				if(f_num == 'f11')
				{
					$('#'+f_num+'_income'+incrementalID).val(f_num_expectedincome);
				}
				else
				{
					$('#'+f_num+'_expectedincome'+incrementalID).val(f_num_expectedincome);
				}
			}

			function getYearlyIncome(MonthlyIncome)
			{
				var monthly_income 	= parseInt(MonthlyIncome) * 12;

				if(isNaN(monthly_income) == true)
				{
					monthly_income = 0;	
				}

				$('#f13_livestock_income_year').val(monthly_income);
			}

			function multipleServProDelete(farmer_id)
			{			
				//loading_show();		
				var farmer_servpro = [];
				$(".farmer_servpro:checked").each(function ()
				{
					farmer_servpro.push(parseInt($(this).val()));
				});
				if (typeof farmer_servpro.length == 0)
				{
					$("#model_body").html('<span style="style="color:#F00;">Please select checkbox to delete Service Provider</span>');
					$('#error_model').modal('toggle');
					loading_hide();						
				}
				else
				{
					var sendInfo 	= {"farmer_id":farmer_id, "farmer_servpro":farmer_servpro, "remove_farmer_service_provider":1};
					var del_cat 	= JSON.stringify(sendInfo);								
					$.ajax({
						url: "load_farmer.php?",
						type: "POST",
						data: del_cat,
						contentType: "application/json; charset=utf-8",						
						success: function(response) 
						{	
							data = JSON.parse(response);
							if(data.Success == "Success") 
							{						
								$('#div_serv_prov_display').html(data.resp);
								//viewStudent(team_id);							
							} 
							else
							{
								alert(data.resp);
								//loading_hide();
							}
						},
						error: function (request, status, error) 
						{
							alert(request.responseText);
							//loading_hide();
						},
						complete: function()
						{
							//loading_hide();
							//alert("complete");
						}
					});					
				}
			} 

			function addServProv(farmer_id)
			{
				var f5_servpro	= $('#f5_servpro').val();
				// console.log(f5_servpro);
				// return false;
				var sendInfo 	= {"farmer_id":farmer_id, "f5_servpro":f5_servpro, "add_serv_prov":1};
					var del_cat 	= JSON.stringify(sendInfo);								
					$.ajax({
						url: "load_farmer.php?",
						type: "POST",
						data: del_cat,
						contentType: "application/json; charset=utf-8",						
						success: function(response) 
						{	
							data = JSON.parse(response);
							if(data.Success == "Success") 
							{						
								$('#div_serv_prov_display').html(data.resp);
								//viewStudent(team_id);							
							} 
							else
							{
								alert(data.resp);
								//loading_hide();
							}
						},
						error: function (request, status, error) 
						{
							alert(request.responseText);
							//loading_hide();
						},
						complete: function()
						{
							//loading_hide();
							//alert("complete");
						}
					});

			}

			function addf9WaterSource(farmer_id, incrementalID)
			{
				var f9_source_of_water	= $('#f9_source_of_water'+incrementalID).val();
				// console.log(f5_servpro);
				// return false;
				var sendInfo 		= {"farmer_id":farmer_id, "f9_source_of_water":f9_source_of_water, "incrementalID":incrementalID, "add_f9_water_source":1};
					var del_cat 	= JSON.stringify(sendInfo);								
					$.ajax({
						url: "load_farmer.php?",
						type: "POST",
						data: del_cat,
						contentType: "application/json; charset=utf-8",						
						success: function(response) 
						{	
							data = JSON.parse(response);
							if(data.Success == "Success") 
							{						
								$('#div_f9_source_of_water'+incrementalID).html(data.resp);
								//viewStudent(team_id);							
							} 
							else
							{
								alert(data.resp);
								//loading_hide();
							}
						},
						error: function (request, status, error) 
						{
							alert(request.responseText);
							//loading_hide();
						},
						complete: function()
						{
							//loading_hide();
							//alert("complete");
						}
					});
			}

			function multipleWaterSourceDelete_f9(farmer_id, incrementalID)
			{
				//loading_show();		
				var f9_water_source = [];
				$(".f9_water_source:checked").each(function ()
				{
					f9_water_source.push(parseInt($(this).val()));
				});
				if (typeof f9_water_source.length == 0)
				{
					alert('Please select checkbox to delete Water Source');
					loading_hide();						
				}
				else
				{
					var sendInfo 	= {"farmer_id":farmer_id, "incrementalID":incrementalID, "f9_water_source":f9_water_source, "remove_farmer_f9_water_source":1};
					var del_cat 	= JSON.stringify(sendInfo);								
					$.ajax({
						url: "load_farmer.php?",
						type: "POST",
						data: del_cat,
						contentType: "application/json; charset=utf-8",						
						success: function(response) 
						{	
							data = JSON.parse(response);
							if(data.Success == "Success") 
							{						
								$('#div_f9_source_of_water'+incrementalID).html(data.resp);
								//viewStudent(team_id);							
							} 
							else
							{
								alert(data.resp);
								//loading_hide();
							}
						},
						error: function (request, status, error) 
						{
							alert(request.responseText);
							//loading_hide();
						},
						complete: function()
						{
							//loading_hide();
							//alert("complete");
						}
					});					
				}
			}

			function addf10WaterSource(farmer_id, incrementalID)
			{
				var f10_water_source_type	= $('#f10_water_source_type'+incrementalID).val();
				// console.log(f5_servpro);
				// return false;
				var sendInfo 		= {"farmer_id":farmer_id, "f10_water_source_type":f10_water_source_type, "incrementalID":incrementalID, "add_f10_water_source":1};
					var del_cat 	= JSON.stringify(sendInfo);								
					$.ajax({
						url: "load_farmer.php?",
						type: "POST",
						data: del_cat,
						contentType: "application/json; charset=utf-8",						
						success: function(response) 
						{	
							data = JSON.parse(response);
							if(data.Success == "Success") 
							{						
								$('#div_f10_water_source_type'+incrementalID).html(data.resp);
								//viewStudent(team_id);							
							} 
							else
							{
								alert(data.resp);
								//loading_hide();
							}
						},
						error: function (request, status, error) 
						{
							alert(request.responseText);
							//loading_hide();
						},
						complete: function()
						{
							//loading_hide();
							//alert("complete");
						}
					});
			}

			function multipleWaterSourceDelete_f10(farmer_id, incrementalID)
			{
				//loading_show();		
				var f10_water_source = [];
				$(".f10_water_source:checked").each(function ()
				{
					f10_water_source.push(parseInt($(this).val()));
				});
				if (typeof f10_water_source.length == 0)
				{
					alert('Please select checkbox to delete Water Source');
					loading_hide();						
				}
				else
				{
					var sendInfo 	= {"farmer_id":farmer_id, "incrementalID":incrementalID, "f10_water_source":f10_water_source, "remove_farmer_f10_water_source":1};
					var del_cat 	= JSON.stringify(sendInfo);								
					$.ajax({
						url: "load_farmer.php?",
						type: "POST",
						data: del_cat,
						contentType: "application/json; charset=utf-8",						
						success: function(response) 
						{	
							data = JSON.parse(response);
							if(data.Success == "Success") 
							{						
								$('#div_f10_water_source_type'+incrementalID).html(data.resp);
								//viewStudent(team_id);							
							} 
							else
							{
								alert(data.resp);
								//loading_hide();
							}
						},
						error: function (request, status, error) 
						{
							alert(request.responseText);
							//loading_hide();
						},
						complete: function()
						{
							//loading_hide();
							//alert("complete");
						}
					});					
				}
			}

			function addf11WaterSource(farmer_id, incrementalID)
			{
				var f11_water_source_type	= $('#f11_water_source_type'+incrementalID).val();
				// console.log(f5_servpro);
				// return false;
				var sendInfo 		= {"farmer_id":farmer_id, "f11_water_source_type":f11_water_source_type, "incrementalID":incrementalID, "add_f11_water_source":1};
					var del_cat 	= JSON.stringify(sendInfo);								
					$.ajax({
						url: "load_farmer.php?",
						type: "POST",
						data: del_cat,
						contentType: "application/json; charset=utf-8",						
						success: function(response) 
						{	
							data = JSON.parse(response);
							if(data.Success == "Success") 
							{						
								$('#div_f11_water_source_type'+incrementalID).html(data.resp);
								//viewStudent(team_id);							
							} 
							else
							{
								alert(data.resp);
								//loading_hide();
							}
						},
						error: function (request, status, error) 
						{
							alert(request.responseText);
							//loading_hide();
						},
						complete: function()
						{
							//loading_hide();
							//alert("complete");
						}
					});
			}

			function multipleWaterSourceDelete_f11(farmer_id, incrementalID)
			{
				//loading_show();		
				var f11_water_source = [];
				$(".f11_water_source:checked").each(function ()
				{
					f11_water_source.push(parseInt($(this).val()));
				});
				if (typeof f11_water_source.length == 0)
				{
					alert('Please select checkbox to delete Water Source');
					loading_hide();						
				}
				else
				{
					var sendInfo 	= {"farmer_id":farmer_id, "incrementalID":incrementalID, "f11_water_source":f11_water_source, "remove_farmer_f11_water_source":1};
					var del_cat 	= JSON.stringify(sendInfo);								
					$.ajax({
						url: "load_farmer.php?",
						type: "POST",
						data: del_cat,
						contentType: "application/json; charset=utf-8",						
						success: function(response) 
						{	
							data = JSON.parse(response);
							if(data.Success == "Success") 
							{						
								$('#div_f11_water_source_type'+incrementalID).html(data.resp);
								//viewStudent(team_id);							
							} 
							else
							{
								alert(data.resp);
								//loading_hide();
							}
						},
						error: function (request, status, error) 
						{
							alert(request.responseText);
							//loading_hide();
						},
						complete: function()
						{
							//loading_hide();
							//alert("complete");
						}
					});					
				}
			}

			function addf14WaterSource(farmer_id, incrementalID)
			{
				var f14_water_source_type	= $('#f14_water_source_type'+incrementalID).val();
				// console.log(f5_servpro);
				// return false;
				var sendInfo 		= {"farmer_id":farmer_id, "f14_water_source_type":f14_water_source_type, "incrementalID":incrementalID, "add_f14_water_source":1};
					var del_cat 	= JSON.stringify(sendInfo);								
					$.ajax({
						url: "load_farmer.php?",
						type: "POST",
						data: del_cat,
						contentType: "application/json; charset=utf-8",						
						success: function(response) 
						{	
							data = JSON.parse(response);
							if(data.Success == "Success") 
							{						
								$('#div_f14_water_source_type'+incrementalID).html(data.resp);
								//viewStudent(team_id);							
							} 
							else
							{
								alert(data.resp);
								//loading_hide();
							}
						},
						error: function (request, status, error) 
						{
							alert(request.responseText);
							//loading_hide();
						},
						complete: function()
						{
							//loading_hide();
							//alert("complete");
						}
					});
			}

			function multipleWaterSourceDelete_f14(farmer_id, incrementalID)
			{
				//loading_show();		
				var f14_water_source = [];
				$(".f14_water_source:checked").each(function ()
				{
					f14_water_source.push(parseInt($(this).val()));
				});
				if (typeof f14_water_source.length == 0)
				{
					alert('Please select checkbox to delete Water Source');
					loading_hide();						
				}
				else
				{
					var sendInfo 	= {"farmer_id":farmer_id, "incrementalID":incrementalID, "f14_water_source":f14_water_source, "remove_farmer_f14_water_source":1};
					var del_cat 	= JSON.stringify(sendInfo);								
					$.ajax({
						url: "load_farmer.php?",
						type: "POST",
						data: del_cat,
						contentType: "application/json; charset=utf-8",						
						success: function(response) 
						{	
							data = JSON.parse(response);
							if(data.Success == "Success") 
							{						
								$('#div_f14_water_source_type'+incrementalID).html(data.resp);
								//viewStudent(team_id);							
							} 
							else
							{
								alert(data.resp);
								//loading_hide();
							}
						},
						error: function (request, status, error) 
						{
							alert(request.responseText);
							//loading_hide();
						},
						complete: function()
						{
							//loading_hide();
							//alert("complete");
						}
					});					
				}
			}

			$('.datepicker').datepicker({format:'yyyy-mm-dd'});	

			// $('#f3_spouse_dob').on('changeDate', function(e){
			// 	alert('2');
			// 	var date1 = new Date($(this).val());
			// 	var date2 = new Date();
			// 	var timeDiff = Math.abs(date2.getTime() - date1.getTime());
			// 	var diffyears = (Math.ceil(timeDiff / (365 * 1000 * 3600 * 24))) - 1; 
				
			// 	$('#f3_spouse_age').val(diffyears);
				
			// 	if(date1 != '')
			// 	{
			// 		calTotal_f3();	
			// 	}
			// });

			// $('#f3_spouse_dob').blur(function(e){
			// 	alert('1');
			// 	var date1 = new Date($(this).val());
			// 	var date2 = new Date();
			// 	var timeDiff = Math.abs(date2.getTime() - date1.getTime());
			// 	var diffyears = (Math.ceil(timeDiff / (365 * 1000 * 3600 * 24))) - 1; 
				
			// 	$('#f3_spouse_age').val(diffyears);
				
			// 	if(date1 != '')
			// 	{
			// 		calTotal_f3();	
			// 	}
			// });

			$('#f3_spouse_dob').bind('blur changeDate', function(e){
				// alert('1');
				var date1 = new Date($(this).val());
				var date2 = new Date();
				var timeDiff = Math.abs(date2.getTime() - date1.getTime());
				var diffyears = (Math.ceil(timeDiff / (365 * 1000 * 3600 * 24))) - 1; 
				
				$('#f3_spouse_age').val(diffyears);
				
				if(date1 != '')
				{
					calTotal_f3();	
				}
			});			

			function getTotalMoneySpend(txt_id_1, txt_id_2, txt_id_3, txt_id_4, txt_id_5, txt_id_6, txt_total_val, incrementalID, f_num)
			{
				var val_1 	= parseInt($('#'+txt_id_1+incrementalID).val()) || 0;
				var val_2 	= parseInt($('#'+txt_id_2+incrementalID).val()) || 0;
				var val_3 	= parseInt($('#'+txt_id_3+incrementalID).val()) || 0;
				var val_4 	= parseInt($('#'+txt_id_4+incrementalID).val()) || 0;
				var val_5 	= parseInt($('#'+txt_id_5+incrementalID).val()) || 0;
				var val_6 	= parseInt($('#'+txt_id_6+incrementalID).val()) || 0;

				if(isNaN(val_1) == true)
				{
					val_1	= 0;
				}

				if(isNaN(val_2) == true)
				{
					val_2	= 0;
				}
				
				if(isNaN(val_3) == true)
				{
					val_3	= 0;
				}
				
				if(isNaN(val_4) == true)
				{
					val_4	= 0;
				}
				
				if(isNaN(val_5) == true)
				{
					val_5	= 0;
				}

				if(isNaN(val_6) == true)
				{
					val_6	= 0;
				}				


				var total_val = val_1 + val_2 + val_3 + val_4 + val_5 + val_6;

				$('#'+txt_total_val+incrementalID).val(total_val);

				getTotalProfit(incrementalID, f_num);
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

			function getSeedsBrand(isHomeSeeds, seedsBrand_id, seedsType_id, spendMoneyForSeeds_id)
			{
				if(isHomeSeeds == 'yes')
				{
					$('#'+seedsBrand_id).val('NA');
					$('#'+seedsType_id).prop('selectedIndex',1);
					// $('#'+seedsType_id).val('NA').hide().show('swing');;
					$('#'+spendMoneyForSeeds_id).val('0');

					$('#'+seedsBrand_id).prop('readonly', true);
					$('#'+seedsType_id).prop('readonly', true);
					$('#'+spendMoneyForSeeds_id).prop('readonly', true);
				}
				else
				{
					$('#'+seedsBrand_id).prop('readonly', false);
					$('#'+seedsType_id).prop('readonly', false);
					$('#'+spendMoneyForSeeds_id).prop('readonly', false);
					// $('#'+seedsBrand_id).val('');
				}
			}

			function getTotalIncome(current_id, f_num)
			{
				var f_num_total_acrage   = $('#'+f_num+'_total_acrage'+current_id).val();
				if(f_num == 'f11')
				{
					var f_num_expectedincome = $('#'+f_num+'_income'+current_id).val();
				}
				else
				{
					var f_num_expectedincome = $('#'+f_num+'_expectedincome'+current_id).val();
				}
				
				// alert('1 : '+f_num_total_acrage+'<==>'+f_num_expectedincome);

				var f_num_totalincome    = f_num_total_acrage * f_num_expectedincome;

				// alert('2 : '+f_num_totalincome);
				
				$('#'+f_num+'_totalincome'+current_id).val(f_num_totalincome);

				getTotalProfit(current_id, f_num);
			}

			function getTotalProfit(current_id, f_num)
			{
				var f_num_totalincome       = $('#'+f_num+'_totalincome'+current_id).val();
				var f_num_spend_money_total = $('#'+f_num+'_spend_money_total'+current_id).val();

				var f_num_total_profit = f_num_totalincome - f_num_spend_money_total;
				$('#'+f_num+'_total_profit'+current_id).val(f_num_total_profit);
			}
		</script>
        
		<script type="text/javascript">
        
        
	        var apiGeolocationSuccess = function(position) {
	            //alert("API geolocation success!\n\nlat = " + position.coords.latitude + "\nlng = " + position.coords.longitude);
	            var IncrementedID	= $('#hid_incrementalID').val();
	            $('#f9_lat'+IncrementedID).val(position.coords.latitude);
	            $('#f9_long'+IncrementedID).val(position.coords.longitude);
	        };
	        
	        var tryAPIGeolocation = function(IncrementedID) 
	        {
	            $('#hid_incrementalID').val(IncrementedID);
	            
	            jQuery.post( "https://www.googleapis.com/geolocation/v1/geolocate?key=AIzaSyDT6LXw4hG20ph_vnQNuG28nByhEoax_9M", function(success) {
	                apiGeolocationSuccess({coords: {latitude: success.location.lat, longitude: success.location.lng}});
	          })
	          .fail(function(err) {
	            alert("API Geolocation error! \n\n"+err);
	          });
	        };
	        
	        var browserGeolocationSuccess = function(position) {
	            //alert("Browser geolocation success!\n\nlat = " + position.coords.latitude + "\nlng = " + position.coords.longitude);
	            
	        };
	        
	        var browserGeolocationFail = function(error) {
	          switch (error.code) {
	            case error.TIMEOUT:
	              alert("Browser geolocation error !\n\nTimeout.");
	              break;
	            case error.PERMISSION_DENIED:
	              if(error.message.indexOf("Only secure origins are allowed") == 0) {
	                tryAPIGeolocation();
	              }
	              break;
	            case error.POSITION_UNAVAILABLE:
	              alert("Browser geolocation error !\n\nPosition unavailable.");
	              break;
	          }
	        };
	        
	        var tryGeolocation = function() {
	            alert("hello geo");
	          if (navigator.geolocation) {
	              alert("hello ge1");
	            navigator.geolocation.getCurrentPosition(
	                browserGeolocationSuccess,
	              browserGeolocationFail,
	              {maximumAge: 50000, timeout: 20000, enableHighAccuracy: true});
	          }
	        };
        
	        //tryGeolocation();
	        
	        // JavaScript Document
        </script>
        
    </body>
</html>