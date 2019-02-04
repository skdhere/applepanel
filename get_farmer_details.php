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
                                        <li id="main_li_section_c">
                                        	<a href="#section_c" data-toggle='tab'>
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

                                        <!-- =========== -->
                                        <!-- START : KYC -->
                                        <!-- =========== -->
                                        <div class="tab-pane" id="section_c">
                                            <div class="box box-bordered box-color lightgrey">
                                                <div class="box-content nopadding">
                                                    <div class="tas-container">
                                                        <ul class="tabs tabs-inline tabs-left">
                                                            
                                                            <li id="producation_and_sale" class="active">
                                                                <a href="#div_producation_and_sale"  data-toggle='tab'>
                                                                    <i class="fa fa-user"></i>Question 1
                                                                   
                                                                </a>
                                                            </li>   <!-- Applicant's Knowledge -->
                                                            <li id="li_phone_details">
                                                                <a href="#div_phone_details" data-toggle='tab'>
                                                                    <i class="fa fa-twitter"></i>Which are the mail crops (Food grains, Fruits and vegetables) that you grown       

                                                                   
                                                                </a>
                                                            </li>   <!-- Applicant's Phone Details -->
                                                            <li id="li_family_details">
                                                                <a href="#div_family_details" data-toggle='tab'>
                                                                    <i class="fa fa-twitter"></i>What are the main sources of irrigation in your orchard (Can be more than one)     

                                                                   
                                                                </a>
                                                            </li>   <!-- Family Details -->
                                                            <li id="li_appliances_motors">
                                                                <a href="#div_appliances_motors" data-toggle='tab'>
                                                                    <i class="fa fa-twitter"></i>Appliances / Motors
                                                                </a>
                                                            </li>   <!-- Appliances / Motors -->
                                                        </ul>
                                                    </div>  <!-- Side Menu [Form Name] -->
                                                    <div class="tab-content padding tab-content-inline">
                                                        
                                                        <div class="tab-pane active" style="min-height: 340px"  id="div_producation_and_sale">
                                                            <h3>Production and sales data of main crops (Food-grains, Fruits & Vegetables)?</h3>
                                                            <form method="POST" enctype="multipart/form-data" class='form-horizontal form-bordered form-validate' id="frm_applicant_knowledge" name="frm_applicant_knowledge">
                                                                
                                                                
                                                                
                                                                <div class="form-content">
                                                                    
                                                                    
                                                                    <table class="table table-bordered dataTable" id="SectionC1Content">
                                                                        <tr>
                                                                            <th style="text-align: center;width: 30%">Crops</th>
                                                                            <th style="text-align: center;width: 30%">Annual Quantity Sold (Tons)</th>
                                                                            <th style="text-align: center;width: 30%">Annual Sale Value (Rs.)</th>
                                                                            <th style="text-align: center;width: 10%">Action</th>
                                                                        </tr>
                                                                        <tr>
                                                                            <input type="hidden" name="id1" value="" />
                                                                            <td style="text-align: center;width: 30%"><input type="text" class="form-control" name="crop1" id="crop1"></td>
                                                                            <td style="text-align: center;width: 30%"><input type="text" class="form-control" name="annual_quantity1" id="annual_quantity1"></td>
                                                                            <td style="text-align: center;width: 30%"><input type="text" class="form-control" name="annual_income1" id="annual_income1"></td>
                                                                            <td style="text-align: center;width: 10%">
                                                                                <button type="button" id="addbtn1" onclick="AddSectionC1Content(this)">Add</button>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                    
                                                                        
                                                                    </div>
                                                                    
                                                                    <div class="form-actions">
                                                                        <input type="reset" class="btn" value="Back" id="back">
                                                                        <input type="submit" class="btn btn-primary" value="Save" id="save">
                                                                    </div>  <!-- Back and Save -->
                                                                    
                                                                </div>
                                                            
                                                            </form>
                                                           
                                                        </div>  <!-- Applicant's Knowledge -->
                                                        <div class="tab-pane" style="min-height: 340px" id="div_phone_details">
                                                            Applicant's Phone Details
                                                            
                                                            <h1 id="phone_details_g_total">0</h1>
                                                        </div>  <!-- Applicant's Phone Details -->
                                                        <div class="tab-pane" style="min-height: 340px" id="div_family_details">
                                                            Family Details
                                                            
                                                            <h1 id="family_details_g_total">0</h1> 
                                                        </div>  <!-- Family Details -->
                                                        <div class="tab-pane" style="min-height: 340px" id="div_appliances_motors">
                                                            <div class="span10" style="padding: 5px; border: 1px solid #d6d6d6; margin: 5px;">
                                                                <h3>What appliances are there in your house? Also mention their count.</h3>
                                                                
                                                                <h1 id="appliances_motors_g_total">0</h1> 
                                                            </div>
                                                        </div>  <!-- Appliances / Motors -->
                                                    </div>  <!-- Main Forms -->
                                                </div>
                                            </div>
                                        </div>  <!-- KYC [COMPLETE] -->
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

        <script type="text/javascript">
            function AddSectionC1Content(e){
                
                rows = $('#SectionC1Content').find('tr');
                cnt = rows.length;
                html ='<tr>';
                    html +='<input type="hidden" name="id'+cnt+'" value="" />';
                    html +='<td style="text-align: center;width: 30%"><input type="text" class="form-control" name="crop'+cnt+'" id="crop'+cnt+'"></td>';
                    html +='<td style="text-align: center;width: 30%"><input type="text" class="form-control" name="annual_quantity'+cnt+'" id="annual_quantity'+cnt+'"></td>';
                    html +='<td style="text-align: center;width: 30%"><input type="text" class="form-control" name="annual_income'+cnt+'" id="annual_income'+cnt+'"></td>';
                    html +='<td style="text-align: center;width: 10%">'; 
                        html +='<button type="button" id="addbtn'+cnt+'"  onclick="AddSectionC1Content(this)">Add</button>';
                        html +='<button type="button" id="rmbtn'+cnt+'"  onclick="removeSectionC1Content(this)">Remove</button>';
                    html +='</td>';
                html +='</tr>';

                btn ='<button type="button" onclick="removeSectionC1Content(this)">Remove</button>';
                // $(btn).insertAfter(e);
                $(e).parent().find('button').hide();
                $('#SectionC1Content').append(html);
            }

            function removeSectionC1Content(e){
                m =$(e).parent().parent();
                $(m).remove();
                rows = $('#SectionC1Content').find('tr');
                cnt = rows.length - 1;
                
                $('#addbtn'+cnt).show();
                $('#rmbtn'+cnt).show();
                
            }
        </script>
        
    </body>
</html>