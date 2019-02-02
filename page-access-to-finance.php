<?php
    include('config/autoload.php');
	
	$feature_name 	= 'Access To Finance';
	$home_name    	= "Home";
	$title			= 'Access To Finance';
	$home_url 	  	= "home.php";
	$filename		= 'view_farmers.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <?php
        /* This function used to call all header data like css files and links */
        headerdata($feature_name);
        /* This function used to call all header data like css files and links */
    	?>
    </head>
    <body class="<?php echo THEME_NAME; ?>" data-theme="<?php echo THEME_NAME; ?>">
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
                            <button type="button" class="btn-info_1" style= "float:right" onClick="location.href='view_farmers.php?pag=farmers';" >
                                <i class="icon-arrow-left"></i>&nbsp; Back
                            </button>
                        </div>
                        <div class="box-content nopadding">
                            <form method="POST" enctype="multipart/form-data" class='form-horizontal form-bordered form-validate' id="frm_access_to_finance" name="frm_access_to_finance">

                                <div class="control-group">
                                    <label for="text" class="control-label" style="margin-top:10px">What is your main sources of Credit or Finance? <span style="color:#F00">*</span></label>
                                    <div class="controls">
                                        <div class="col-md-12">
                                            <input type="checkbox" name="chk_main_source_of_finance" value="own_money" >  &nbsp;Own money
                                            <input type="checkbox" name="chk_main_source_of_finance" value="friends_and_relatives" >  &nbsp;Friends & relatives
                                            <input type="checkbox" name="chk_main_source_of_finance" value="bank" >  &nbsp;Bank     
                                            <input type="checkbox" name="chk_main_source_of_finance" value="kisan_credit_card" >  &nbsp;Kisan credit-card       
                                            <input type="checkbox" name="chk_main_source_of_finance" value="micro_finance_company" >  &nbsp;Micro-finance company   
                                        </div>
                                        <div class="col-md-12">
                                            <input type="checkbox" name="chk_main_source_of_finance" value="farmer_organisation" >  &nbsp;Farmer organisation     
                                            <input type="checkbox" name="chk_main_source_of_finance" value="govt_agency" >  &nbsp;Govt agency       
                                            <input type="checkbox" name="chk_main_source_of_finance" value="moneylender" >  &nbsp;Moneylender       
                                            <input type="checkbox" name="chk_main_source_of_finance" value="inputs_dealer" >  &nbsp;Inputs dealer        
                                            <input type="checkbox" name="chk_main_source_of_finance" value="trader_or_buyer" >  &nbsp;Trader/Buyer   
                                        </div>
                                        <div class="col-md-12">
                                            <input type="checkbox" name="chk_main_source_of_finance" value="others" >  &nbsp;Others
                                        </div>
                                    </div>
                                </div>	<!-- What is your main sources of Credit or Finance? -->

                                <div class="control-group">
                                    <label for="text" class="control-label" style="margin-top:10px">Do you have access of crop insurance? <span style="color:#F00">*</span></label>                                   
                                    <div class="controls">
                                        <select id="ddl_access_of_crop_insurance" name="ddl_access_of_crop_insurance" class="select2-me input-xlarge" onchange="displayDivIfYes(this.value, 'div_if_yes');">
                                            <option value="" disabled selected > Select here</option>
                                            <option value="yes"> YES</option>
                                            <option value="no"> NO</option>
                                        </select>
                                    </div>
                                </div>	<!-- Do you have access of Crop Insurance -->

                                <div id="div_if_yes" style="display:none;">
                                    <div class="control-group">
                                        <label for="text" class="control-label" style="margin-top:10px">What kind of Insurance? <span style="color:#F00">*</span></label>                                   
                                        <div class="controls">
                                            <select id="ddl_insurance_type" name="ddl_insurance_type" class="select2-me input-xlarge" >
                                                <option value="" disabled selected > Select here</option>
                                                <option value="weather_based"> Weather-based</option>
                                                <option value="yield_based"> Yield-based</option>
                                                <option value="no_insurance"> No Insurance</option>
                                            </select>
                                        </div>
                                    </div>  <!-- What kind of Insurance -->

                                    <div class="control-group">
                                        <label for="text" class="control-label" style="margin-top:10px">Name of Insurance Scheme? <span style="color:#F00">*</span></label>
                                        <div class="controls">
                                            <input type="text" id="insurance_sceme" name="insurance_sceme" class="input-xxlarge" data-rule-required="true" placeholder="Insurance Scheme Name">
                                        </div>
                                    </div>	<!-- Insurance Scheme Name -->

                                    <div class="control-group">
                                        <label for="text" class="control-label" style="margin-top:10px">What is the Insurance Value? <span style="color:#F00">*</span></label>
                                        <div class="controls">
                                            <input type="text" id="insurance_value" name="insurance_value" class="input-xlarge" data-rule-required="true" placeholder="Insurance Value">
                                        </div>
                                    </div>	<!-- What is the Insurance Value? -->

                                    <div class="control-group">
                                        <label for="text" class="control-label" style="margin-top:10px">How much premium do you payfor the insurance per year? (In Rs.) <span style="color:#F00">*</span></label>
                                        <div class="controls">
                                            <input type="text" id="insurance_premium" name="insurance_premium" class="input-xlarge" data-rule-required="true" placeholder="Insurance Premium">
                                        </div>
                                    </div>	<!-- How much premium do you payfor the insurance per year? (In Rs.) -->

                                    <div class="control-group">
                                        <label for="text" class="control-label" style="margin-top:10px">What is the Total Coverage offered by the Insurance Product? <span style="color:#F00">*</span></label>
                                        <div class="controls">
                                            <input type="text" id="insurance_tot_coverage" name="insurance_tot_coverage" class="input-xlarge" data-rule-required="true" placeholder="Total Coverage">
                                        </div>
                                    </div>	<!-- What is the Total Coverage offered by the Insurance Product? -->
                                </div>

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
        <script type="text/javascript">
            function displayDivIfYes(boolean_value, div_id)
            {
                alert(boolean_value);
                if(boolean_value == 'yes')
                {
                    $('#'+div_id).show();
                }
                else
                {
                    $('#'+div_id).hide();
                }
            }
        </script>
    </body>
</html>