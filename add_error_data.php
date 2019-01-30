<?php 
	include('access1.php'); 
	include('include/connection.php');
	include('include/query-helper.php');
	
    // echo $fm_caid        = $_SESSION['ca_id'];
    $id = $_REQUEST['id'];

    $sql = " SELECT * FROM tbl_upload_errors WHERE id ='".$id."'";
    $res =  mysqli_query($db_con,$sql) or die(mysqli_error($db_con));
    $row = mysqli_fetch_array($res);

    // echo $row['error_mssg'];

    $error_data  = json_decode($row['error_data']);
    $farmer_data = $error_data->farmer_data;
	$feature_name 	= 'Farmer';
	$home_name    	= "Home";
	$title			= 'Add Farmer';
	$home_url 	  	= "home.php";
	$filename		= 'view_farmers.php';
?>

<!DOCTYPE html>
<html class="not-ie no-js" lang="en">
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
		/* this function used to add naigation menu to the page*/
		navigation_menu();
		/* this function used to add navigation menu to the page*/
		?> <!-- Navigation Bar -->
        <div class="container-fluid" id="content">
            <div id="main" style="margin-left:0px !important">
	            <?php
				/* this function used to add navigation menu to the page*/
				breadcrumbs($home_url,$home_name,'Add Farmer',$filename,$feature_name);
				/* this function used to add navigation menu to the page*/
				?>
                <div class="container-fluid">
                    <div class="box box-color box-bordered lightgreen" style="padding:0px;">
                        <div class="box-title">
                            <h3>
                            	Add Farmer  
                            </h3>
                            <button type="button" class="btn-info_1" style= "float:right" onClick="location.href='<?php echo $BaseFolder; ?>view_farmers.php';" >
                                <i class="icon-arrow-left"></i>&nbsp; Back
                            </button>
                        </div>
                        <div class="box-content nopadding">
                            <form method="POST" enctype="multipart/form-data" class='form-horizontal form-bordered form-validate' id="frm_add_farmer" name="frm_add_farmer">
                            	
                                <input type="hidden" id="hid_farmer_reg" name="hid_farmer_reg" value="1">
                                <!--<input type="hidden" id="hid_frm_reg_points" name="hid_frm_reg_points" value="">-->
                                <input type="hidden" id="hid_residence_points" name="hid_residence_points" value="">
                                <input type="hidden" id="hid_personal_details_points" name="hid_personal_details_points" value="">
                                <input type="hidden" id="f3_married_reg_points" name="f3_married_reg_points" value="">
                                
                                <div class="control-group">
                                    <label for="tasktitel" class="control-label">Select FPO <span style="color:#F00">*</span></label>
                                    <div class="controls">
                                        <select id="fm_org_id" name="fm_org_id" class="select2-me input-xlarge" >
                                            <?php
                                            // Query For getting the list of the all FPOs
                                            if($_SESSION['org_id'] != '1')
                                            {
                                                $res_get_list_of_fpos = getRecord('tbl_organization', array('id'=>$_SESSION['org_id']));
                                            }
                                            else
                                            {
                                                $res_get_list_of_fpos = getRecord('tbl_organization');
                                            }
                                            if($res_get_list_of_fpos)
                                            {
                                                $num_get_list_of_fpos = mysqli_num_rows($res_get_list_of_fpos);
                                                if($num_get_list_of_fpos != 0)
                                                {
                                                    ?>
                                                    <option value="" disabled selected>Select here</option>
                                                    <?php
                                                    while($row_get_list_of_fpos = mysqli_fetch_array($res_get_list_of_fpos))
                                                    {
                                                        ?>
                                                        <option value="<?php echo $row_get_list_of_fpos['id']; ?>" >
                                                            <?php echo ucwords(mb_strtolower($row_get_list_of_fpos['org_name'])); ?>
                                                        </option>
                                                        <?php
                                                    }
                                                }
                                            }
                                            else
                                            {
                                                ?>
                                                <option value="">No Match Found</option>
                                                <?php
                                            }


                                            ?>
                                        </select>
                                    </div>
                                </div>  <!-- Select FPO -->

                                <div class="control-group">
                                    <label for="text" class="control-label" style="margin-top:10px">
                                    	Name <span style="color:#F00">*</span>
                                    </label>
                                    
                                    <div class="controls">
                                    	<input type="text" id="txt_name" name="txt_name" class="input-xlarge v_name" data-rule-required="true" placeholder="Enter Your Name" value="<?php echo $farmer_data->farmer_name; ?>">
                                    </div>
                                </div>	<!-- Name -->
                                
                                <div class="control-group">
                                    <label for="text" class="control-label" style="margin-top:10px">
                                    	Father's / Spouse's Name <span style="color:#F00">*</span>
                                    </label>
                                    <div class="controls">
                                    	<input type="text" id="txt_father_name" name="txt_father_name" class="input-xlarge" data-rule-required="true" placeholder="Father's / Spouse's Name">
                                    </div>
                                </div>	<!-- Father's / Spouse's Name -->
                                
                                <div class="control-group">
                                    <label for="text" class="control-label" style="margin-top:10px">
                                    	Mother's Name <span style="color:#F00">*</span>
                                    </label>
                                    <div class="controls">
                                    	<input type="text" id="txt_mother_name" name="txt_mother_name" class="input-xlarge v_name" data-rule-required="true" placeholder="Mother Name" >
                                    </div>
                                </div>	<!-- Mother's Name -->
                                
                                <div class="control-group">
                                	<label for="tasktitel" class="control-label">
                                    	Date Of Birth <span style="color:#F00">*</span><br>
                                        [YYYY-MM-DD]
                                    </label>
                                    <div class="controls">
                                    	<input type="text" id="txt_dob" name="txt_dob" placeholder="Date Of Birth" class="datepicker input-large" data-rule-required="true" />
                                    </div>
                                </div>	<!-- DOB -->
                                
                                <div class="control-group">
                                	<label for="tasktitel" class="control-label">
                                    	Age [In Year]<span style="color:#F00">*</span>
                                    </label>
                                    <div class="controls">
                                    	<input type="text" id="txt_age" name="txt_age" placeholder="Age" class="input-large" data-rule-required="true" data-rule-number="true" readonly />
                                    </div>
                                </div>	<!-- Age In-Between -->
                                
                                <div class="control-group">
                                	<label for="numberfield" class="control-label">
                                    	Mobile No. <span style="color:#F00">*</span><br>
                                        [10 Digits]
                                    </label>
                                
                                    <div class="controls">
                                        <input type="text" placeholder="Mobile no" name="fm_mobileno" id="fm_mobileno" maxlength="10"  autocomplete="off" data-rule-required="true" onBlur="Mobile(this.value);"  data-rule-minlength="10"  data-rule-maxlength="10" class="input-xlarge v_number">
                                        <label id="comp_2" style="color:#FF0000;width:200px;margin-left:100px;"></label>    
                                    </div>
                                </div> <!-- Mobile No -->
                                
                                <div class="control-group">
                                	<label for="numberfield" class="control-label">
                                    	Alternative Mobile No.<br>[10 Digits]
                                    </label>
                                
                                    <div class="controls">
                                        <input type="text" placeholder="Alternative Mobile no" name="alt_mobileno" id="alt_mobileno" data-rule-number="true" maxlength="10" autocomplete="off" onBlur="Mobile(this.value);" data-rule-minlength="10"  data-rule-maxlength="10" class="input-xlarge v_number">
                                        <label id="comp_2" style="color:#FF0000;width:200px;margin-left:100px;"></label>    
                                    </div>
                                </div> <!-- Alternative Mobile No -->
                                
                                <div class="control-group">
                                    <label for="numberfield" class="control-label">
                                    	Aadhaar No. <span style="color:#F00">*</span><br>[12 Digits]
                                    </label>
                                    <div class="controls">
                                    	<input type="text" placeholder="Aadhaar no" name="fm_aadhar" id="fm_aadhar" data-rule-number="true" maxlength="12" data-rule-required="true" onBlur="Aadhaar(this.value);"  data-rule-minlength="12"  data-rule-maxlength="12" class="input-xlarge v_number">
                                    	<label id="comp_1" style="color:#FF0000;width:200px;margin-left:100px;"></label>
                                    </div>
                                </div> <!-- Aadhar Number -->
                                
                                <div class="control-group">
                                	<label for="tasktitel" class="control-label">
                                    	Experience In Farming <span style="color:#F00">*</span>
                                    </label>
                                    <div class="controls">
                                    	<input type="text" placeholder="Experience In Farming" name="txt_farm_experience" id="txt_farm_experience" class="v_number input-xlarge" data-rule-number="true" data-rule-required="true" data-rule-maxlength="2">
                                    </div>
                                </div>	<!-- Experience In Farming -->
                                
                                
                                <div class="control-group">
                                    <label for="tasktitel" class="control-label">Do you have any other occupation? <span style="color:#F00">*</span></label>
                                    <div class="controls">
                                        <select id="f1_any_other_occupation" name="f1_any_other_occupation" class="select2-me input-xlarge" onChange="getDisplayDiv(this.value, 'div_any_other_occupation_display')">
                                            <option value="" disabled selected>Select here</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>  <!-- Do you have any other occupation? -->
                                
                                <div id="div_any_other_occupation_display" style="display:none;">
                                    
                                    <div class="control-group">
                                        <label for="tasktitel" class="control-label">mention the amount earned annually <span style="color:#F00">*</span></label>
                                        <div class="controls">
                                            <input type="text" placeholder="mention the amount earned annually" onKeyPress="return numsonly(event);" name="f1_occupation_amt" id="f1_occupation_amt" class="v_number input-xlarge" data-rule-required="true" data-rule-maxlength="12">
                                        </div>
                                    </div>  <!-- mention the amount earned annually -->

                                </div>

                                <div class="control-group">
                                	<label for="tasktitel" class="control-label">Do you required a loan? <span style="color:#F00">*</span></label>
                                    <div class="controls">
                                    	<select id="f1_required_loan" name="f1_required_loan" class="select2-me input-xlarge" onChange="getDisplayDiv(this.value, 'div_required_loan_display')">
                                            <option value="" disabled selected>Select here</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>	<!-- Do you required a loan [DDL] -->
                                
                                <!-- START : Display Div -->
                                <div id="div_required_loan_display" style="display:none;">
                                    
                                    <div class="control-group">
                                        <label for="tasktitel" class="control-label">How much amount of loan you required?<span style="color:#F00">*</span></label>
                                        <div class="controls">
                                            <input type="text" placeholder="How much amount of loan you required" onKeyPress="return numsonly(event);" name="f1_required_loan_amt" id="f1_required_loan_amt" class="v_number input-xlarge" data-rule-required="true" data-rule-maxlength="12">
                                        </div>
                                    </div>	<!-- How much amount [If yes] -->
                                    
                                    <div class="control-group">
                                        <label for="tasktitel" class="control-label">Loan Purpose <span style="color:#F00">*</span></label>
                                        <div class="controls">
                                            <select id="f1_loan_purpose" name="f1_loan_purpose" class="select2-me input-xlarge" onChange="calTotal();">
                                                <option value="" disabled selected>Select here</option>
                                                <option point="5" value="Whole Crop Process">Whole Crop Process</option>
                                                <option point="5" value="Buy Machinery">Buy Machinery</option>
                                                <option point="5" value="Buy Seeds">Buy Seeds</option>
                                                <option point="5" value="Buy Tools">Buy Tools</option>
                                                <option point="5" value="Buy Irrigation">Buy Irrigation</option>
                                                <option point="5" value="Others">Others</option>
                                            </select>
                                        </div>
                                    </div>	<!-- Loan Purpose -->
                                    
                                    <div class="control-group">
                                        <label for="tasktitel" class="control-label">Crop Cycle for loan required <span style="color:#F00">*</span></label>
                                        <div class="controls">
                                            <select id="f1_crop_cycle" name="f1_crop_cycle" class="select2-me input-xlarge">
                                                <option value="" disabled selected>Select here</option>
                                                <option value="Kharif">Kharif</option>
                                                <option value="Rabi">Rabi</option>
                                                <option value="Summer">Summer</option>
                                                <option value="All Year Round">All Year Round</option>
                                            </select>
                                        </div>
                                    </div>	<!-- Crop Cycle for loan required -->
                                
                                </div>
                                <!-- END : Display Div -->
                                
                                <div class="control-group">
                                	<label for="tasktitel" class="control-label">
                                    	Are You Married? <span style="color:#F00">*</span>
                                    </label>
                                    <div class="controls">
                                    	<select id="ddl_married_status" name="ddl_married_status" class="select2-me input-xlarge">
                                            <option value="" disabled selected>Select here</option>
                                            <option point="10" value="yes">Yes</option>
                                            <option point="2" value="no">No</option>
                                        </select>
                                    </div>
                                </div>	<!-- Married Or Not -->
                                
                                <div class="control-group">
                                	<label for="tasktitel" class="control-label">
                                    	Residence Status <span style="color:#F00">*</span>
                                    </label>
                                    <div class="controls">
                                    	<select id="ddl_residence_status" name="ddl_residence_status" class="select2-me input-large">
                                        	<option value="" disabled selected>Select Residence Status</option>
                                            <option point="2" value="Rented">Rented</option>
                                            <option point="10" value="Owned">Owned</option>
                                            <option point="6" value="Ancestral">Ancestral</option>
                                        </select>
                                    </div>
                                </div>	<!-- Residence Status -->
                                
                                <div id="div_ifRental" style="display:none;">
                                    <div class="control-group">
                                        <label for="tasktitel" class="control-label">Rent</label>
                                        <div class="controls">
                                        	<input type="text" id="txt_rent" name="txt_rent" placeholder="Rent" data-rule-number="true" class="input-large" data-rule-maxlength="5" maxlength="5" size="5">
                                        </div>
                                    </div>	<!-- Rent [Only If Rental will select] -->
								</div>	<!-- Rent [Only If Rental will select] -->
                                
                                <!-- START : Address Details -->
                                <div class="control-group">
                                    <div>
                                        <div style="float:left">
                                            <h3 style="margin:0px;">Address Details</h3>
                                        </div>
                                        <div style="margin-left:640px;">
                                            <small>
                                            <a id="btnsame" class="btn btn-warning btn-sm">
                                                Same as Permanent
                                            </a>
                                            </small>
                                        </div>
                                    </div>
                                </div>	<!-- Address Details -->
                                
                                <div class="control-group span6" style="clear:both;">
                                    <label for="tasktitel">
                                    	<h4>Permanent Address</h4>
                                    </label>
                                </div>	<!-- Permanent Address -->
                                
                                <div class="control-group span6">
                                    <label for="tasktitel">
                                    	<h4>Current Address</h4>
                                    </label>
                                </div>	<!-- Current Address -->
                                
                                <div class="control-group span6" style="clear:both;">
                                	<label for="tasktitel" class="control-label">House No. / Address<span style="color:#F00">*</span></label>
                                    <div class="controls">
                                    	<input type="text" id="txt_p_house_no" name="txt_p_house_no" placeholder="House Number" class="input-large" data-rule-required="true" maxlength="150" size="150" />
                                    </div>
                                </div>	<!-- P House No. -->
                                
                                <div class="control-group span6">
                                	<label for="tasktitel" class="control-label">House No.  / Address<span style="color:#F00">*</span></label>
                                    <div class="controls">
                                    	<input type="text" id="txt_c_house_no" name="txt_c_house_no" placeholder="House Number" class="input-large" data-rule-required="true" maxlength="150" size="150" />
                                    </div>
                                </div>	<!-- C House No. -->
                                
                                <div class="control-group span6" style="clear:both;">
                                	<label for="tasktitel" class="control-label">Street Name <span style="color:#F00">*</span></label>
                                    <div class="controls">
                                    	<input type="text" id="txt_p_street_name" name="txt_p_street_name" placeholder="Street Name" class="input-large" data-rule-required="true" />
                                    </div>
                                </div>	<!-- P Street Name -->
                                
                                <div class="control-group span6">
                                	<label for="tasktitel" class="control-label">Street Name <span style="color:#F00">*</span></label>
                                    <div class="controls">
                                    	<input type="text" id="txt_c_street_name" name="txt_c_street_name" placeholder="Street Name" class="input-large" data-rule-required="true" />
                                    </div>
                                </div>	<!-- C Street Name -->
                                
                                <div class="control-group span6" style="clear:both;">
                                	<label for="tasktitel" class="control-label">Area Name <span style="color:#F00">*</span></label>
                                    <div class="controls">
                                    	<input type="text" id="txt_p_area_name" name="txt_p_area_name" placeholder="Area Name" class="input-large" data-rule-required="true" />
                                    </div>
                                </div>	<!-- P Area Name -->
                                
                                <div class="control-group span6">
                                	<label for="tasktitel" class="control-label">Area Name <span style="color:#F00">*</span></label>
                                    <div class="controls">
                                    	<input type="text" id="txt_c_area_name" name="txt_c_area_name" placeholder="Area Name" class="input-large" data-rule-required="true" />
                                    </div>
                                </div>	<!-- C Area Name -->
                                
                                <div class="control-group span6" style="clear:both;">
                                	<label for="tasktitel" class="control-label">State <span style="color:#F00">*</span></label>
                                    <div class="controls">
                                    	<select id="ddl_p_state" name="ddl_p_state" onChange="getDist('p', this.value, 'ddl_p_dist', 'ddl_p_tal', 'ddl_p_village', 'div_p_dist', 'div_p_tal', 'div_p_village');" class="select2-me input-large" >
                                        	<option value="" disabled selected>Select State</option>
                                        	<?php
                                            $res_get_state	= lookup_value('tbl_state',array(),array(),array(),array(),array());
											
											if($res_get_state)
											{
												while ($row = mysqli_fetch_array($res_get_state) ) 
												{
													echo '<option value="'.$row['id'].'">'.strtoupper($row['st_name']).'</option>';
												}
											}
											?>
                                        </select>
                                    </div>
                                </div>	<!-- P State -->
                                
                                <div class="control-group span6">
                                	<label for="tasktitel" class="control-label">State <span style="color:#F00">*</span></label>
                                    <div class="controls">
                                    	<select id="ddl_c_state" name="ddl_c_state"  onChange="getDist('c', this.value, 'ddl_c_dist', 'ddl_c_tal', 'ddl_c_village', 'div_c_dist', 'div_c_tal', 'div_c_village');" class="select2-me input-large" >
                                        	<option value="" disabled selected>Select State</option>
                                        	<?php
                                            $res_get_state	= lookup_value('tbl_state',array(),array(),array(),array(),array());
											
											if($res_get_state)
											{
												while ($row = mysqli_fetch_array($res_get_state) ) 
												{
													echo '<option value="'.$row['id'].'">'.strtoupper($row['st_name']).'</option>';
												}
											}
											?>
                                        </select>
                                    </div>
                                </div>	<!-- C State -->
                                
                                <div class="control-group span6" style="clear:both;">
                                	<label for="tasktitel" class="control-label">District <span style="color:#F00">*</span></label>
                                    <div class="controls" id="div_p_dist">
                                    	<select id="ddl_p_dist" name="ddl_p_dist" class="select2-me input-large" >
                                        	<option value="" disabled selected>Select District</option>
                                        </select>
                                    </div>
                                </div>	<!-- P District -->
                                
                                <div class="control-group span6">
                                	<label for="tasktitel" class="control-label">District <span style="color:#F00">*</span></label>
                                    <div class="controls" id="div_c_dist">
                                    	<select id="ddl_c_dist" name="ddl_c_dist" class="select2-me input-large" >
                                        	<option value="" disabled selected>Select District</option>
                                        </select>
                                    </div>
                                </div>	<!-- C District -->
                                
                                <div class="control-group span6" style="clear:both;">
                                	<label for="tasktitel" class="control-label">Taluka <span style="color:#F00">*</span></label>
                                    <div class="controls" id="div_p_tal">
                                    	<select id="ddl_p_tal" name="ddl_p_tal" class="select2-me input-large" >
                                        	<option value="" disabled selected>Select Taluka</option>
                                        </select>
                                    </div>
                                </div>	<!-- P Taluka -->
                                
                                <div class="control-group span6">
                                	<label for="tasktitel" class="control-label">Taluka <span style="color:#F00">*</span></label>
                                    <div class="controls" id="div_c_tal">
                                    	<select id="ddl_c_tal" name="ddl_c_tal" class="select2-me input-large" >
                                        	<option value="" disabled selected>Select Taluka</option>
                                        </select>
                                    </div>
                                </div>	<!-- C Taluka -->
                                
                                <div class="control-group span6" style="clear:both;">
                                	<label for="tasktitel" class="control-label">Village Name <span style="color:#F00">*</span></label>
                                    <div class="controls" id="div_p_village">
                                    	<select id="ddl_p_village" name="ddl_p_village" class="select2-me input-large" >
                                        	<option value="" disabled selected>Select Village</option>
                                        </select>
                                    </div>
                                </div>	<!-- P Village Name -->
                            
                                <div class="control-group span6">
                                	<label for="tasktitel" class="control-label">Village Name <span style="color:#F00">*</span></label>
                                    <div class="controls" id="div_c_village">
                                    	<select id="ddl_c_village" name="ddl_c_village" class="select2-me input-large" >
                                        	<option value="" disabled selected>Select Village</option>
                                        </select>
                                    </div>
                                </div>	<!-- C Village Name -->
                                
                                <div class="control-group span6" style="clear:both;">
                                	<label for="tasktitel" class="control-label">Pin-Code <span style="color:#F00">*</span><br>[6 Digits]</label>
                                    <div class="controls">
                                    	<input type="text" id="txt_p_pincode" name="txt_p_pincode" placeholder="Pin-Code" class="input-large" data-rule-required="true" data-rule-number="true" minlength="6" maxlength="6" size="6" />
                                    </div>
                                </div>	<!-- P Pin-Code -->
                                
                                <div class="control-group span6">
                                	<label for="tasktitel" class="control-label">Pin-Code <span style="color:#F00">*</span><br>[6 Digits]</label>
                                    <div class="controls">
                                    	<input type="text" id="txt_c_pincode" name="txt_c_pincode" placeholder="Pin-Code" class="input-large" data-rule-required="true" data-rule-number="true" minlength="6" maxlength="6" size="6" />
                                    </div>
                                </div>	<!-- C Pin-Code -->
								<!-- END : Address Details -->
                                
                                <div class="form-actions" style="clear:both;">
                                    <button id="submit" name="Submit" type="submit" class="btn btn-primary" >Submit</button>
                                    <button id="reset" type="button" class="btn" onclick="window.history.back()">Cancel</button>
                                </div> <!-- Submit -->
                            
                            </form>	
                    	</div>
                	</div>   
                </div>
	        </div>
        </div>
    	<script language="javascript">
    		
			var baseurll 			= '<?php echo $BaseFolder; ?>';
			//var farmer_reg_g_total	= 0;
			var residence_points	= 0;
			var personal_details_points	= 0;
			
			$(document).ready(function(){
				//$('#div_ifRental').slideUp();	
				$("#txt_rent").keydown(function (e) {
					// Allow: backspace, delete, tab, escape, enter and .
					if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
					// Allow: Ctrl/cmd+A
					(e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
					// Allow: Ctrl/cmd+C
					(e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
					// Allow: Ctrl/cmd+X
					(e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
					// Allow: home, end, left, right
					(e.keyCode >= 35 && e.keyCode <= 39)) 
					{
					// let it happen, don't do anything
						return;
					}
					// Ensure that it is a number and stop the keypress
					if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
						e.preventDefault();
					}
				});
				
			});
			
			function convertAgeToPoints(x)  
			{
				if(x >= 21 && x <= 25)
				{
					return 4;
				}
				else if(x >= 26 && x <= 30)
				{
					return 6;
				}
				else if(x >= 31 && x <= 35)
				{
					return 7;
				}
				else if(x >= 36 && x <= 45)
				{
					return 10;
				}
				else if(x >= 46 && x <= 60)
				{
					return 8;
				}
				else if(x > 60)
				{
					return 0;	
				}
				else
				{
				  return 0;
				}	
			}
			
			function convertFarmExpToPoints(x)  
			{
				if(x >= 1 && x <= 5)
				{
					return 2;
				}
				else if(x >= 6 && x <= 10)
				{
					return 4;
				}
				else if(x >= 11 && x <= 15)
				{
					return 6;
				}
				else if(x >= 16 && x <= 20)
				{
					return 8;
				}
				else if(x > 20)
				{
					return 10;	
				}
				else
				{
				  return 0;
				}
			}
			 
			function convertRentAmountToPoint(x)
			{
				if(x >= 1 && x <= 500)
				{
					return 4;
				}
				else if(x >= 501 && x <= 800)
				{
					return 6;
				}
				else if(x >= 801 && x <= 1000)
				{
					return 10;
				}
				else if(x >= 1001 && x <= 2500)
				{
					return 8;
				}
				else
				{
				  return 0;
				}
			}
		
			function calTotal()
			{
				var f1_dob			= 5;
				var f1_age			= convertAgeToPoints($('#txt_age').val());
				var f1_mobno		= 7;
				var alt_mono		= $('#alt_mobileno').val();
				var f1_altno		= 0;
				if(alt_mono != '')
				{
					f1_altno		= 3; 	
				}
				var fm_aadhar		= 10;
				var f1_expfarm		= convertFarmExpToPoints($('#txt_farm_experience').val());
				
				var f1_loan_purpose	= parseInt($('option:selected','#f1_loan_purpose').attr('point')) || 0;
				
				var f7_resistatus	= parseInt($('option:selected','#ddl_residence_status').attr('point')) || 0;
				
				var resiStatusVal	= $('#ddl_residence_status').val();
				var f7_rent_amount	= 0;
				var divided_by		= 1;
				if(resiStatusVal == "Rented")
				{
					f7_rent_amount	= convertRentAmountToPoint($('#txt_rent').val());
					divided_by		= 2;	
				}
				var f3_married_reg_points	= parseInt($('option:selected','#ddl_married_status').attr('point')) || 0;
				
				//farmer_reg_g_total		= f1_dob + f1_age + f1_mobno + f1_altno + fm_aadhar + f1_expfarm + f7_resistatus + f7_rent_amount;
				residence_points		= f7_resistatus + f7_rent_amount;
				personal_details_points	= f1_dob + f1_age + f1_mobno + f1_altno + fm_aadhar + f1_expfarm + f1_loan_purpose;
				
				var residence_pt 		= residence_points/divided_by;
				var personal_details_pt	= personal_details_points/7;
				
				//farmReg_pt     = farmReg_pt.toFixed(2);
				residence_pt     		= residence_pt.toFixed(2);
				personal_details_pt     = personal_details_pt.toFixed(2);
				
				$('#hid_residence_points').val(residence_pt);
				$('#hid_personal_details_points').val(personal_details_pt);
				$('#f3_married_reg_points').val(f3_married_reg_points);
				//$('#farmer_reg_g_total').val(farmReg_pt);
				//$('#hid_frm_reg_points').html(farmReg_pt);
			}
		
			// $('#txt_dob').on('changeDate', function(e){
			// 	var date1 = new Date($(this).val());
			// 	var date2 = new Date();
			// 	var timeDiff = Math.abs(date2.getTime() - date1.getTime());
			// 	var diffyears = (Math.ceil(timeDiff / (365 * 1000 * 3600 * 24))) - 1; 
				
			// 	$('#txt_age').val(diffyears);
				
			// 	if(date1 != '')
			// 	{
			// 		calTotal();	
			// 	}
			// });

            $('#txt_dob').bind('blur changeDate', function(e){
                var date1 = new Date($(this).val());
                var date2 = new Date();
                var timeDiff = Math.abs(date2.getTime() - date1.getTime());
                var diffyears = (Math.ceil(timeDiff / (365 * 1000 * 3600 * 24))) - 1; 
                
                $('#txt_age').val(diffyears);
                
                if(date1 != '')
                {
                    calTotal(); 
                }
            });
			
			$('#ddl_residence_status').on('change', function(e){
				var residence_status	= $('#ddl_residence_status').val();
				if(residence_status == "Rented")
				{
					$('#div_ifRental').slideDown();	
				}
				else
				{
					$('#div_ifRental').slideUp();	
				}
				
				calTotal();
			});
			
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
			
			$('#btnsame').on('click', function(e){
				e.preventDefault();

				$('#ddl_c_state').html($('#ddl_p_state').html());
				$('#ddl_c_dist').html($('#ddl_p_dist').html());
				$('#ddl_c_tal').html($('#ddl_p_tal').html());
				$('#ddl_c_village').html($('#ddl_p_village').html());

				$('#txt_c_house_no').val($('#txt_p_house_no').val()).hide().show('swing');
				$('#txt_c_street_name').val($('#txt_p_street_name').val()).hide().show('swing');
				$('#txt_c_pincode').val($('#txt_p_pincode').val()).hide().show('swing');
				$('#ddl_c_village').val($('#ddl_p_village').val()).hide().show('swing');
				$('#ddl_c_tal').val($('#ddl_p_tal').val()).hide().show('swing');
				$('#ddl_c_dist').val($('#ddl_p_dist').val()).hide().show('swing');
				$('#ddl_c_state').val($('#ddl_p_state').val()).hide().show('swing');
				$('#txt_c_area_name').val($('#txt_p_area_name').val()).hide().show('swing');
			});
			
			$('#frm_add_farmer').on('submit', function(e) 
			{
				e.preventDefault();
				if ($('#frm_add_farmer').valid())
				{
					calTotal();
					
					$.ajax({
						url: "load_farmer.php?",
						type: "POST",
						data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
						contentType: false,       // The content type used when sending data to the server.
						cache: false,             // To unable request pages to be cached
						processData:false,        // To send DOMDocument or non processed data file it is set to false
						async:true,						
							success: function(response) 
							{   data = JSON.parse(response);
								if(data.Success == "Success") 
								{  
									location.href	= baseurll + "view_farmers.php?pag=farmers";
								} 
								else 
								{   
									alert(data.resp);
									location.href	= baseurll + "error-404";
								}
							},
							error: function (request, status, error) 
							{
								$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
								$('#error_model').modal('toggle');	
								loading_hide();
							},
							complete: function()
							{
								//alert("complete");
								loading_hide();
							}
						});
				}
			});
			
			function getXMLHTTP()	//fuction to return the xml http object 
			{ 
			
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
			
			function Aadhaar(comp1) 
			{		
				if(!isNaN(comp1) && comp1 != '' && comp1 != 'undefined' && comp1.length === 12)
				{
					var strURL="viewaadhaar.php?comp1="+comp1;
					var req = getXMLHTTP();
					if (req) {
		
						
		
						req.onreadystatechange = function() {
		
							if (req.readyState == 4) {
		
								// only if "OK"
		
								if (req.status == 200) {						
		
									document.getElementById('comp_1').innerHTML=req.responseText;
		
										var g=document.getElementById('fm_aadhar').value;
		
										if(g==2)
		
										{
		
											<!--alert(" User Already registered with this username");-->
		
												document.getElementById('fm_aadhar').value="";
		
										}
		
										else
		
										{
		
											
		
										}						
		
								} else {
		
									alert("There was a problem while using XMLHTTP:\n" + req.statusText);
		
								}
		
							}				
		
						}			
		
						req.open("GET", strURL, true);
		
						req.send(null);
		
					}
				}
			}	
			
			function Mobile(comp2) 
			{		
				if(!isNaN(comp2) && comp2 != '' && comp2 != 'undefined' && comp2.length === 10)
				{
					
					var strURL="viewmobile.php?comp2="+comp2;
					var req = getXMLHTTP();
					if (req) {
		
						
		
						req.onreadystatechange = function() {
		
							if (req.readyState == 4) {
		
								// only if "OK"
		
								if (req.status == 200) {						
		
									document.getElementById('comp_2').innerHTML=req.responseText;
		
										var g=document.getElementById('fm_mobileno').value;
		
										if(g==2)
		
										{
		
											<!--alert(" User Already registered with this username");-->
		
												document.getElementById('fm_mobileno').value="";
		
										}
		
										else
		
										{
		
											
		
										}						
		
								} else {
		
									alert("There was a problem while using XMLHTTP:\n" + req.statusText);
		
								}
		
							}				
		
						}			
		
						req.open("GET", strURL, true);
		
						req.send(null);
		
					}
				}
			}		
				
			function getDisplayDiv(mainDivVal, DisplayDivID)
			{
				if(mainDivVal == 'yes')
				{
					$('#'+DisplayDivID).slideDown();	
				}
				else
				{
					$('#'+DisplayDivID).slideUp();	
				}	
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