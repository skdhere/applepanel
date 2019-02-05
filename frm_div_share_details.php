<?php
	if($fpo_id == "" && (!isset($_SESSION['sqyard_user'])) && $_SESSION['sqyard_user']=="")
	{
        ?>
        <script type="text/javascript">
            history.go(-1);
        </script>
        <?php
    }

    // Query For getting the Farmer Info
	$res_get_fpo_info = lookup_value('tbl_fpo_share_details',array(),array("fpo_id"=>$fpo_id),array(),array(),array());

	if($res_get_fpo_info)
	{
		$num_get_fpo_info	= mysqli_num_rows($res_get_fpo_info);
		if($num_get_fpo_info != 0)
		{
			$row_get_fpo_info	= mysqli_fetch_array($res_get_fpo_info);

			$isUpdated = '1';

			$id = $row_get_fpo_info['id'];
			
			$num_of_shares                      = $row_get_fpo_info['num_of_shares'];
			$share_value_per_share				= $row_get_fpo_info['share_value_per_share'];
			$share_amount_contribution          = $row_get_fpo_info['share_amount_contribution'];
			$num_of_share_holders               = $row_get_fpo_info['num_of_share_holders'];
			$membership_fee                     = $row_get_fpo_info['membership_fee'];
			$total_share_capital                = $row_get_fpo_info['total_share_capital'];
			$total_membership_amt_collected     = $row_get_fpo_info['total_membership_amt_collected'];
			$resource_institution_name          = $row_get_fpo_info['resource_institution_name'];
			$resource_institution_address       = $row_get_fpo_info['resource_institution_address'];
			$resource_institution_contactPerson = $row_get_fpo_info['resource_institution_contactPerson'];
			$resource_nstitution_mobile_num     = $row_get_fpo_info['resource_nstitution_mobile_num'];
			$resource_institution_email_id      = $row_get_fpo_info['resource_institution_email_id'];
			$governing_org                      = $row_get_fpo_info['governing_org'];
			$governing_org_val                  = $row_get_fpo_info['governing_org_val'];
			$any_funding_received               = $row_get_fpo_info['any_funding_received'];
			$type_of_funding_received           = $row_get_fpo_info['type_of_funding_received'];
			$size_of_funding_received           = $row_get_fpo_info['size_of_funding_received'];
			$private_org_name                   = $row_get_fpo_info['private_org_name'];
			$funding_duration                   = $row_get_fpo_info['funding_duration'];
			$date_of_support_ending             = $row_get_fpo_info['date_of_support_ending'];
			$total_support_amount               = $row_get_fpo_info['total_support_amount'];
			$funding_support_used_for           = $row_get_fpo_info['funding_support_used_for'];
			$any_other_funding_support          = $row_get_fpo_info['any_other_funding_support'];
			$fpo_own_assets                     = $row_get_fpo_info['fpo_own_assets'];
			$aggregate_value_of_assets          = $row_get_fpo_info['aggregate_value_of_assets'];
			$other_supports_to_members          = $row_get_fpo_info['other_supports_to_members'];
			$bank_name                          = $row_get_fpo_info['bank_name'];
			$any_funding_received_from_bank     = $row_get_fpo_info['any_funding_received_from_bank'];
			$mention_funding_receving_details   = $row_get_fpo_info['mention_funding_receving_details'];
			$num_of_villages_part_of_org        = $row_get_fpo_info['num_of_villages_part_of_org'];
			$num_of_figs                        = $row_get_fpo_info['num_of_figs'];
			$produces_deal_with                 = $row_get_fpo_info['produces_deal_with'];
			$input_shop_associated_with_fpo     = $row_get_fpo_info['input_shop_associated_with_fpo'];
			$annual_turnover_of_fpo_2013_14     = $row_get_fpo_info['annual_turnover_of_fpo_2013_14'];
			$annual_turnover_of_fpo_2014_15     = $row_get_fpo_info['annual_turnover_of_fpo_2014_15'];
			$annual_turnover_of_fpo_2015_16     = $row_get_fpo_info['annual_turnover_of_fpo_2015_16'];
			$annual_turnover_of_fpo_2016_17     = $row_get_fpo_info['annual_turnover_of_fpo_2016_17'];
			$used_any_software                  = $row_get_fpo_info['used_any_software'];
			$mention_software_details           = $row_get_fpo_info['mention_software_details'];
			$kharif_2014                        = $row_get_fpo_info['kharif_2014'];
			$kharif_2015                        = $row_get_fpo_info['kharif_2015'];
			$kharif_2016                        = $row_get_fpo_info['kharif_2016'];
			$kharif_2017                        = $row_get_fpo_info['kharif_2017'];
			$rabi_2014                          = $row_get_fpo_info['rabi_2014'];
			$rabi_2015                          = $row_get_fpo_info['rabi_2015'];
			$rabi_2016                          = $row_get_fpo_info['rabi_2016'];
			$rabi_2017                          = $row_get_fpo_info['rabi_2017'];
			$summer_2014                        = $row_get_fpo_info['summer_2014'];
			$summer_2015                        = $row_get_fpo_info['summer_2015'];
			$summer_2016                        = $row_get_fpo_info['summer_2016'];
			$summer_2017                        = $row_get_fpo_info['summer_2017'];
			$turnover_achieved_by_tradin_2014   = $row_get_fpo_info['turnover_achieved_by_tradin_2014'];
			$turnover_achieved_by_tradin_2015   = $row_get_fpo_info['turnover_achieved_by_tradin_2015'];
			$turnover_achieved_by_tradin_2016   = $row_get_fpo_info['turnover_achieved_by_tradin_2016'];
			$turnover_achieved_by_tradin_2017   = $row_get_fpo_info['turnover_achieved_by_tradin_2017'];
			$total_annual_turnover_of_fpo       = $row_get_fpo_info['total_annual_turnover_of_fpo'];
			$produces_plan_for_2018             = $row_get_fpo_info['produces_plan_for_2018'];
			$other_business_activities          = $row_get_fpo_info['other_business_activities'];

		}
		else
		{
			$isUpdated = '2';
		}
	}
	else
	{
		$isUpdated = '2';
	}
?>
<form method="POST" enctype="multipart/form-data" class="form-horizontal form-bordered form-validate" id="frm_div_share_details" name="frm_div_share_details" >
	<input type="hidden" id="hid_div_share_details" name="hid_div_share_details" value="1">
	<input type="hidden" id="fpo_id" name="fpo_id" value="<?php echo $fpo_id; ?>">
	<input type="hidden" id="record_id" name="record_id" value="<?php if((isset($id)) && ($id != '')){ echo $id; } ?>">
	<input type="hidden" id="hid_isUpdate_flag" name="hid_isUpdate_flag" value="<?php echo $isUpdated; ?>">

	<div class="form-content">

		<div class="control-group" style="clear:both;">
			<label for="tasktitel" class="control-label">Number of Shares issued <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" value="<?php if((isset($num_of_shares)) && ($num_of_shares != '')){ echo $num_of_shares; } ?>" id="num_of_shares" name="num_of_shares" placeholder="Number of Shares issued" class="input-large"  data-rule-number="true" minlength="1" maxlength="6" size="6" onBlur="getDisplayDiv1(this.value, 'div_share_value');" onKeyPress="return numsonly(event);"/> <!-- data-rule-required="true" getShareValue(this.value); -->
		    </div>
		</div>	<!-- // Number of Shares issued -->

		<div id="div_share_value" style="display: none;">
			<div class="control-group" style="clear:both;">
				<label for="tasktitel" class="control-label">Share Value (Per Share) <span style="color:#F00">*</span></label>
			    <div class="controls">
			    	<input type="text" value="<?php if((isset($share_value_per_share)) && ($share_value_per_share != '')){ echo $share_value_per_share; } ?>" id="share_value_per_share" name="share_value_per_share" placeholder="Share Value (Per Share)" class="input-large" minlength="1" maxlength="10" size="10" onKeyPress="return numsonly(event);"/> <!-- // data-rule-required="true" -->
			    </div>
			</div>	
		</div>	<!-- // Share Value (Per Share)  -->

		<div class="control-group" style="clear:both;">
			<label for="tasktitel" class="control-label">Share Amount Contribution per Member <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" value="<?php if((isset($share_amount_contribution)) && ($share_amount_contribution != '')){ echo $share_amount_contribution; } ?>" id="share_amount_contribution" name="share_amount_contribution" placeholder="Share Amount Contribution per Member" class="input-xxlarge"  data-rule-number="true" minlength="1" maxlength="6" size="6" onKeyPress="return numsonly(event);" /> <!-- data-rule-required="true" -->
		    </div>
		</div>	<!-- // Share Amount Contribution per Member -->

		<div class="control-group" style="clear:both;">
			<label for="tasktitel" class="control-label">Number of Share Holders <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" value="<?php if((isset($num_of_share_holders)) && ($num_of_share_holders != '')){ echo $num_of_share_holders; } ?>" id="num_of_share_holders" name="num_of_share_holders" placeholder="Number of Share Holders" class="input-large"  data-rule-number="true" minlength="1" maxlength="6" size="6" onKeyPress="return numsonly(event);" /> <!-- data-rule-required="true" -->
		    </div>
		</div>	<!-- // Number of Share Holders -->

		<div class="control-group" style="clear:both;">
			<label for="tasktitel" class="control-label">Membership Fee Collected Per Member <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" value="<?php if((isset($membership_fee)) && ($membership_fee != '')){ echo $membership_fee; } ?>" id="membership_fee" name="membership_fee" placeholder="Membership Fee Collected Per Member" class="input-xxlarge"  data-rule-number="true" minlength="1" maxlength="6" size="6" onKeyPress="return numsonly(event);" /> <!-- data-rule-required="true" -->
		    </div>
		</div>	<!-- // Membership Fee Collected Per Member -->

		<div class="control-group" style="clear:both;">
			<label for="tasktitel" class="control-label">Total Share Capital <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" value="<?php if((isset($total_share_capital)) && ($total_share_capital != '')){ echo $total_share_capital; } ?>" id="total_share_capital" name="total_share_capital" placeholder="Total Share Capital" class="input-large"  data-rule-number="true" minlength="1" maxlength="6" size="6" onKeyPress="return numsonly(event);" /> <!-- data-rule-required="true" -->
		    </div>
		</div>	<!-- // Total Share Capital -->

		<div class="control-group" style="clear:both;">
			<label for="tasktitel" class="control-label">Total Membership Amount Collected <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" value="<?php if((isset($total_membership_amt_collected)) && ($total_membership_amt_collected != '')){ echo $total_membership_amt_collected; } ?>" id="total_membership_amt_collected" name="total_membership_amt_collected" placeholder="Total Membership Amount Collected" class="input-xxlarge"  data-rule-number="true" minlength="1" maxlength="12" size="12" onKeyPress="return numsonly(event);" /> <!-- //  --> <!-- data-rule-required="true" -->
		    </div>
		</div>	<!-- // Total Membership Amount Collected -->

		<div class="control-group">
		    <label for="tasktitel" class="control-label">Resource Institution Name <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" placeholder="Resource Institution Name" value="<?php if((isset($resource_institution_name)) && ($resource_institution_name != '')) { echo $resource_institution_name; } ?>" name="resource_institution_name" id="resource_institution_name" class="input-xlarge" data-rule-maxlength="50" > <!-- data-rule-required="true" -->
		    </div>
		</div>	<!-- // Resource Institution Name -->

		<div class="control-group">
		    <label for="tasktitel" class="control-label">Resource Institution Address <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<textarea name="resource_institution_address" id="resource_institution_address" ><?php if((isset($resource_institution_address)) && ($resource_institution_address != '')) { echo $resource_institution_address; } ?></textarea> <!-- data-rule-required="true" -->
		    </div>
		</div>	<!-- // Resource Institution Address -->

		<div class="control-group">
		    <label for="tasktitel" class="control-label">Resource Institution Contact Person Name <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" placeholder="Resource Institution Contact Person Name" value="<?php if((isset($resource_institution_contactPerson)) && ($resource_institution_contactPerson != '')) { echo $resource_institution_contactPerson; } ?>" name="resource_institution_contactPerson" id="resource_institution_contactPerson" class="input-xlarge" data-rule-maxlength="50" > <!-- data-rule-required="true" -->
		    </div>
		</div>	<!-- // Resource Institution Contact Person Name -->

		<div class="control-group">
            <label for="numberfield" class="control-label">Resource Institution Mobile Number <span style="color:#F00">*</span></label>
            <div class="controls">
                <input type="text" value="<?php if((isset($resource_nstitution_mobile_num)) && $resource_nstitution_mobile_num != '') { echo $resource_nstitution_mobile_num; } ?>" placeholder="Resource Institution Mobile Number" name="resource_nstitution_mobile_num" id="resource_nstitution_mobile_num" class="input-xlarge v_number" data-rule-number="true" maxlength="10" onKeyPress="return numsonly(event);" data-rule-minlength="10"  data-rule-maxlength="10"  > <!-- data-rule-required="true" -->
            </div>
        </div>	<!-- // Resource Institution Mobile Number -->

		<div class="control-group">
            <label for="text" class="control-label" style="margin-top:10px">Resource Institution Email ID <span style="color:#F00">*</span></label>
            <div class="controls">
                <input type="text" value="<?php if((isset($resource_institution_email_id)) && ($resource_institution_email_id != '')) { echo $resource_institution_email_id; } ?>" id="resource_institution_email_id" name="resource_institution_email_id" class="input-xlarge"  data-rule-email="true" placeholder="Resource Institution Email ID"> <!-- data-rule-required="true" -->
            </div>
        </div>	<!-- // Resource Institution Email ID -->

		<div class="control-group">
		    <label for="text" class="control-label" style="margin-top:10px">Governing Organization <span style="color:#F00">*</span></label>
		    <div class="controls">
		        <select id="governing_org" name="governing_org" class="select2-me input-xlarge"  onChange="getDisplayDiv(this.value, 'div_governing_org', 'OTHERS');"> <!-- data-rule-required="true" -->
		        	<option value="" disabled selected> Select here</option>
		        	<option value="NABARD" <?php if((isset($governing_org)) && ($governing_org != '') && ($governing_org == 'NABARD')) { ?> selected <?php } ?>> NABARD</option>
		        	<option value="SFAC" <?php if((isset($governing_org)) && ($governing_org != '') && ($governing_org == 'SFAC')) { ?> selected <?php } ?>> SFAC</option>
		        	<option value="OTHERS" <?php if((isset($governing_org)) && ($governing_org != '') && ($governing_org == 'OTHERS')) { ?> selected <?php } ?>> OTHERS</option>
		        </select>
		    </div>
		</div>	<!-- // Governing Organization -->

		<div id="div_governing_org" <?php if((isset($governing_org)) && $governing_org=='OTHERS'){ ?> style="display:block;" <?php } else { ?> style="display:none;" <?php  } ?> >
		    <div class="control-group">
		        <label for="tasktitel" class="control-label">PLEASE MENTION <span style="color:#F00">*</span></label>
		        <div class="controls">
		        	<input type="text" value="<?php if((isset($governing_org_val)) && ($governing_org_val != '')) { echo $governing_org_val; } ?>" placeholder="PLEASE MENTION TYPE!" name="governing_org_val" id="governing_org_val" class="input-xlarge" data-rule-maxlength="12">
		        </div>
		    </div>
		</div>	<!-- // Governing Organization Value [ If OTHERs ] -->

		<div class="control-group">
            <label for="text" class="control-label" style="margin-top:10px">Do you provide regular trainings to the members? <span style="color:#F00">*</span></label>
            <div class="controls">
                <select id="any_funding_received" name="any_funding_received" class="select2-me input-xlarge"  onChange="getDisplayDiv(this.value, 'div_any_funding_received', 'yes');"> <!-- data-rule-required="true" -->
                	<option value="" disabled selected > Select here</option>
                	<option value="yes" <?php if((isset($any_funding_received)) && ($any_funding_received != '') && ($any_funding_received == 'yes')) { ?> selected <?php } ?>> YES</option>
                	<option value="no" <?php if((isset($any_funding_received)) && ($any_funding_received != '') && ($any_funding_received == 'no')) { ?> selected <?php } ?>> NO</option>
                </select>
            </div>
        </div>	<!-- // Any Funding received (y/n) -->

        <div id="div_any_funding_received" <?php if((isset($any_funding_received)) && $any_funding_received == 'yes') { ?> style="display:block;" <?php } else { ?> style="display:none;" <?php } ?>>

			<div class="control-group">
			    <label for="tasktitel" class="control-label">Type of Funding received <span style="color:#F00">*</span></label>
			    <div class="controls">
			    	<input type="text" placeholder="Type of Funding received" value="<?php if((isset($type_of_funding_received)) && ($type_of_funding_received != '')) { echo $type_of_funding_received; } ?>" name="type_of_funding_received" id="type_of_funding_received" class="input-xlarge" data-rule-maxlength="50" > <!-- data-rule-required="true" -->
			    </div>
			</div>	<!-- // Type of Funding received (If Yes) -->

			<div class="control-group">
			    <label for="tasktitel" class="control-label">Size of funding received <span style="color:#F00">*</span></label>
			    <div class="controls">
			    	<input type="text" placeholder="Size of funding received" value="<?php if((isset($size_of_funding_received)) && ($size_of_funding_received != '')) { echo $size_of_funding_received; } ?>" name="size_of_funding_received" id="size_of_funding_received" class="input-xlarge" data-rule-maxlength="50" > <!-- data-rule-required="true" -->
			    </div>
			</div>	<!-- // Size of funding received (If Yes) -->

		</div>

		<div class="control-group">
		    <label for="tasktitel" class="control-label">Which is the Private Organization Supporting the FPO / NGO <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" placeholder="Which is the Private Organization Supporting the FPO / NGO" value="<?php if((isset($private_org_name)) && ($private_org_name != '')) { echo $private_org_name; } ?>" name="private_org_name" id="private_org_name" class="input-xxlarge" data-rule-maxlength="50" > <!-- data-rule-required="true" -->
		    </div>
		</div>	<!-- // Which is the Private Organization Supporting the FPO / NGO -->

		<div class="control-group">
		    <label for="tasktitel" class="control-label">What is the Funding Support Duration <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" placeholder="What is the Funding Support Duration" value="<?php if((isset($funding_duration)) && ($funding_duration != '')) { echo $funding_duration; } ?>" name="funding_duration" id="funding_duration" class="input-xlarge" data-rule-maxlength="50" > <!-- data-rule-required="true" -->
		    </div>
		</div>	<!-- // What is the Funding Support Duration -->

		<div class="control-group">
			<label for="tasktitel" class="control-label">When is the support ending? <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" value="<?php if((isset($date_of_support_ending)) && ($date_of_support_ending != '')) { echo $date_of_support_ending; } ?>" id="date_of_support_ending" name="date_of_support_ending" placeholder="When is the support ending?" class="datepicker input-large"  /> <!-- data-rule-required="true" -->
		    </div>
		</div>	<!-- // When is the support ending? -->

		<div class="control-group" style="clear:both;">
			<label for="tasktitel" class="control-label">How much is the total support amount? <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" value="<?php if((isset($total_support_amount)) && ($total_support_amount != '')){ echo $total_support_amount; } ?>" id="total_support_amount" name="total_support_amount" placeholder="How much is the total support amount?" class="input-xxlarge"  data-rule-number="true" minlength="1" maxlength="12" size="12" onKeyPress="return numsonly(event);" /> <!-- data-rule-required="true" -->
		    </div>
		</div>	<!-- // How much is the total support amount? -->

		<div class="control-group">
		    <label for="tasktitel" class="control-label">What is the Funding Support Used for? <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<textarea name="funding_support_used_for" id="funding_support_used_for" ><?php if((isset($funding_support_used_for)) && ($funding_support_used_for != '')) { echo $funding_support_used_for; } ?></textarea> <!-- data-rule-required="true" -->
		    </div>
		</div>	<!-- // What is the Funding Support Used for? -->

		<div class="control-group">
		    <label for="tasktitel" class="control-label">Please mention if any other funding support is received? <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" placeholder="Please mention if any other funding support is received?" value="<?php if((isset($any_other_funding_support)) && ($any_other_funding_support != '')) { echo $any_other_funding_support; } ?>" name="any_other_funding_support" id="any_other_funding_support" class="input-xxlarge" data-rule-maxlength="50">
		    </div>
		</div>	<!-- // Please mention if any other funding support is received? -->

		<div class="control-group">
		    <label for="tasktitel" class="control-label">What Assets Does the FPO own? <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" placeholder="What Assets Does the FPO own?" value="<?php if((isset($fpo_own_assets)) && ($fpo_own_assets != '')) { echo $fpo_own_assets; } ?>" name="fpo_own_assets" id="fpo_own_assets" class="input-xlarge">
		    </div>
		</div>	<!-- // What Assets Does the FPO own? -->

		<div class="control-group">
		    <label for="tasktitel" class="control-label">What is the Aggregated Value of all the Assets? <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" placeholder="What is the Aggregated Value of all the Assets?" value="<?php if((isset($aggregate_value_of_assets)) && ($aggregate_value_of_assets != '')) { echo $aggregate_value_of_assets; } ?>" name="aggregate_value_of_assets" id="aggregate_value_of_assets" class="input-xxlarge">
		    </div>
		</div>	<!-- // What is the Aggregated Value of all the Assets?  -->

		<div class="control-group">
		    <label for="tasktitel" class="control-label">What other Support do you provide to the Members <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" placeholder="What other Support do you provide to the Members" value="<?php if((isset($other_supports_to_members)) && ($other_supports_to_members != '')) { echo $other_supports_to_members; } ?>" name="other_supports_to_members" id="other_supports_to_members" class="input-xxlarge"> <br>[ Ex. Technology, Farming Equipment, Harvesting Machines ]
		    </div>
		</div>	<!-- // What other Support do you provide to the Members [ Ex. Technology, Farming Equipment, Harvesting Machines ] -->

		<div class="control-group">
		    <label for="tasktitel" class="control-label">Which Bank do you Deal with? <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" placeholder="Which Bank do you Deal with?" value="<?php if((isset($bank_name)) && ($bank_name != '')) { echo $bank_name; } ?>" name="bank_name" id="bank_name" class="input-xlarge">
		    </div>
		</div>	<!-- // Which Bank do you Deal with? -->

		<div class="control-group">
            <label for="text" class="control-label" style="margin-top:10px">Have you received any Funding / Loan from a Bank / Financial institution? <span style="color:#F00">*</span></label>
            <div class="controls">
                <select id="any_funding_received_from_bank" name="any_funding_received_from_bank" class="select2-me input-xlarge"  onChange="getDisplayDiv(this.value, 'div_any_funding_received_from_bank', 'yes');"> <!-- data-rule-required="true" -->
                	<option value="" disabled selected > Select here</option>
                	<option value="yes" <?php if((isset($any_funding_received_from_bank)) && ($any_funding_received_from_bank != '') && ($any_funding_received_from_bank == 'yes')) { ?> selected <?php } ?>> YES</option>
                	<option value="no" <?php if((isset($any_funding_received_from_bank)) && ($any_funding_received_from_bank != '') && ($any_funding_received_from_bank == 'no')) { ?> selected <?php } ?>> NO</option>
                </select>
            </div>
        </div>	<!-- // Have you received any Funding / Loan from a Bank / Financial institution? (y/n) -->

		<div id="div_any_funding_received_from_bank" <?php if((isset($any_funding_received_from_bank)) && $any_funding_received_from_bank == 'yes') { ?> style="display:block;" <?php } else { ?> style="display:none;" <?php } ?>>

			<div class="control-group">
			    <label for="tasktitel" class="control-label">Mention details <span style="color:#F00">*</span></label>
			    <div class="controls">
			    	<input type="text" placeholder="Mention details" value="<?php if((isset($mention_funding_receving_details)) && ($mention_funding_receving_details != '')) { echo $mention_funding_receving_details; } ?>" name="mention_funding_receving_details" id="mention_funding_receving_details" class="input-xlarge" data-rule-maxlength="50" > <!-- data-rule-required="true" -->
			    </div>
			</div>	<!-- // Mention details (If Yes) -->

		</div>	

		<div class="control-group" style="clear:both;">
			<label for="tasktitel" class="control-label">Number of villages that are a part of the organization <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" value="<?php if((isset($num_of_villages_part_of_org)) && ($num_of_villages_part_of_org != '')){ echo $num_of_villages_part_of_org; } ?>" id="num_of_villages_part_of_org" name="num_of_villages_part_of_org" placeholder="Number of villages that are a part of the organization" class="input-xxlarge"  data-rule-number="true" minlength="1" maxlength="12" size="12" onKeyPress="return numsonly(event);" /> <!-- data-rule-required="true" -->
		    </div>
		</div>	<!-- // Number of villages that are a part of the organization -->

		<div class="control-group" style="clear:both;">
			<label for="tasktitel" class="control-label">Total Number of FIGs <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" value="<?php if((isset($num_of_figs)) && ($num_of_figs != '')){ echo $num_of_figs; } ?>" id="num_of_figs" name="num_of_figs" placeholder="Total Number of FIGs" class="input-large"  data-rule-number="true" minlength="1" maxlength="12" size="12" onKeyPress="return numsonly(event);" /> <!-- data-rule-required="true" -->
		    </div>
		</div>	<!-- // Total Number of FIGs  -->

		<div class="control-group">
		    <label for="tasktitel" class="control-label">What are the Produces do you deal with? (Crops) <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" placeholder="What are the Produces do you deal with? (Crops)" value="<?php if((isset($produces_deal_with)) && ($produces_deal_with != '')) { echo $produces_deal_with; } ?>" name="produces_deal_with" id="produces_deal_with" class="input-xxlarge">
		    </div>
		</div>	<!-- // What are the Produces do you deal with? (Crops) -->

		<div class="control-group">
            <label for="text" class="control-label" style="margin-top:10px">Is there an Input Shop associated with FPO <span style="color:#F00">*</span></label>
            <div class="controls">
                <select id="input_shop_associated_with_fpo" name="input_shop_associated_with_fpo" class="select2-me input-xlarge" > <!-- data-rule-required="true" -->
                	<option value="" disabled selected > Select here</option>
                	<option value="yes" <?php if((isset($input_shop_associated_with_fpo)) && ($input_shop_associated_with_fpo != '') && ($input_shop_associated_with_fpo == 'yes')) { ?> selected <?php } ?>> YES</option>
                	<option value="no" <?php if((isset($input_shop_associated_with_fpo)) && ($input_shop_associated_with_fpo != '') && ($input_shop_associated_with_fpo == 'no')) { ?> selected <?php } ?>> NO</option>
                </select>
            </div>
        </div>	<!-- // Is there an Input Shop associated with FPO: (Y/N) -->

        <h2>What is the Annual Turnover of the FPO Input shop?</h2> <!-- // What is the Annual Turnover of the FPO Input shop? -->

		<div class="control-group span6">
			<label for="tasktitel" class="control-label">2013-14 <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" value="<?php if((isset($annual_turnover_of_fpo_2013_14)) && ($annual_turnover_of_fpo_2013_14 != '')){ echo $annual_turnover_of_fpo_2013_14; } ?>" id="annual_turnover_of_fpo_2013_14" name="annual_turnover_of_fpo_2013_14" placeholder="Annual Turnover of FPO for 2013-14" class="input-large"  data-rule-number="true" minlength="1" maxlength="12" size="12" onKeyPress="return numsonly(event);" /> <!-- data-rule-required="true" -->
		    </div>
		</div>	<!-- // 2013-14 -->

		<div class="control-group span6">
			<label for="tasktitel" class="control-label">2014-15 <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" value="<?php if((isset($annual_turnover_of_fpo_2014_15)) && ($annual_turnover_of_fpo_2014_15 != '')){ echo $annual_turnover_of_fpo_2014_15; } ?>" id="annual_turnover_of_fpo_2014_15" name="annual_turnover_of_fpo_2014_15" placeholder="Annual Turnover of FPO for 2014-15" class="input-large"  data-rule-number="true" minlength="1" maxlength="12" size="12" onKeyPress="return numsonly(event);" /> <!-- data-rule-required="true" -->
		    </div>
		</div>	<!-- // 2014-15 -->

		<div class="control-group span6">
			<label for="tasktitel" class="control-label">2015-16 <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" value="<?php if((isset($annual_turnover_of_fpo_2015_16)) && ($annual_turnover_of_fpo_2015_16 != '')){ echo $annual_turnover_of_fpo_2015_16; } ?>" id="annual_turnover_of_fpo_2015_16" name="annual_turnover_of_fpo_2015_16" placeholder="Annual Turnover of FPO for 2015-16" class="input-large"  data-rule-number="true" minlength="1" maxlength="12" size="12" onKeyPress="return numsonly(event);" /> <!-- data-rule-required="true" -->
		    </div>
		</div>	<!-- // 2015-16 -->

		<div class="control-group span6">
			<label for="tasktitel" class="control-label">2016-17 <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" value="<?php if((isset($annual_turnover_of_fpo_2016_17)) && ($annual_turnover_of_fpo_2016_17 != '')){ echo $annual_turnover_of_fpo_2016_17; } ?>" id="annual_turnover_of_fpo_2016_17" name="annual_turnover_of_fpo_2016_17" placeholder="Annual Turnover of FPO for 2016-17" class="input-large"  data-rule-number="true" minlength="1" maxlength="12" size="12" onKeyPress="return numsonly(event);" /> <!-- data-rule-required="true" -->
		    </div>
		</div>	<!-- // 2016-17 -->
		
		<div class="clearfix"></div>
				
		<div class="control-group">
            <label for="text" class="control-label" style="margin-top:10px">Do you use any software to Manage the Input Shop? Like Tally? <span style="color:#F00">*</span></label>
            <div class="controls">
                <select id="used_any_software" name="used_any_software" class="select2-me input-xlarge"  onChange="getDisplayDiv(this.value, 'div_used_any_software', 'yes');"> <!-- data-rule-required="true" -->
                	<option value="" disabled selected > Select here</option>
                	<option value="yes" <?php if((isset($used_any_software)) && ($used_any_software != '') && ($used_any_software == 'yes')) { ?> selected <?php } ?>> YES</option>
                	<option value="no" <?php if((isset($used_any_software)) && ($used_any_software != '') && ($used_any_software == 'no')) { ?> selected <?php } ?>> NO</option>
                </select>
            </div>
        </div>	<!-- // Do you use any software to Manage the Input Shop? Like Tally? (y/n) -->

		<div id="div_used_any_software" <?php if((isset($used_any_software)) && $used_any_software == 'yes') { ?> style="display:block;" <?php } else { ?> style="display:none;" <?php } ?>>
			
			<div class="control-group">
			    <label for="tasktitel" class="control-label">Mention details <span style="color:#F00">*</span></label>
			    <div class="controls">
			    	<input type="text" placeholder="Mention details" value="<?php if((isset($mention_software_details)) && ($mention_software_details != '')) { echo $mention_software_details; } ?>" name="mention_software_details" id="mention_software_details" class="input-xlarge" data-rule-maxlength="50" > <!-- data-rule-required="true" -->
			    </div>
			</div>	<!-- // mention details (If Yes) -->

		</div>	

		<h2>What are the Produces did you procure last 4 years</h2>	<!-- // What are the Produces did you procure last 4 years -->

		<h3>Kharif</h3>	<!-- // Kharif -->
		
		<div class="control-group span6">
		    <label for="tasktitel" class="control-label">2014 <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" placeholder="2014" value="<?php if((isset($kharif_2014)) && ($kharif_2014 != '')) { echo $kharif_2014; } ?>" name="kharif_2014" id="kharif_2014" class="input-xlarge" data-rule-maxlength="50" > <!-- data-rule-required="true" -->
		    </div>
		</div>	<!-- // 2014 -->

		<div class="control-group span6">
		    <label for="tasktitel" class="control-label">2015 <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" placeholder="2015" value="<?php if((isset($kharif_2015)) && ($kharif_2015 != '')) { echo $kharif_2015; } ?>" name="kharif_2015" id="kharif_2015" class="input-xlarge" data-rule-maxlength="50" > <!-- data-rule-required="true" -->
		    </div>
		</div>	<!-- // 2015 -->

		<div class="clearfix"></div>

		<div class="control-group span6">
		    <label for="tasktitel" class="control-label">2016 <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" placeholder="2016" value="<?php if((isset($kharif_2016)) && ($kharif_2016 != '')) { echo $kharif_2016; } ?>" name="kharif_2016" id="kharif_2016" class="input-xlarge" data-rule-maxlength="50" > <!-- data-rule-required="true" -->
		    </div>
		</div>	<!-- // 2016 -->

		<div class="control-group span6">
		    <label for="tasktitel" class="control-label">2017 <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" placeholder="2017" value="<?php if((isset($kharif_2017)) && ($kharif_2017 != '')) { echo $kharif_2017; } ?>" name="kharif_2017" id="kharif_2017" class="input-xlarge" data-rule-maxlength="50" > <!-- data-rule-required="true" -->
		    </div>
		</div>	<!-- // 2017 -->

		<div class="clearfix"></div>

		<h3>Rabi</h3>	<!-- // Rabi -->
		
		<div class="control-group span6">
		    <label for="tasktitel" class="control-label">2014 <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" placeholder="2014" value="<?php if((isset($rabi_2014)) && ($rabi_2014 != '')) { echo $rabi_2014; } ?>" name="rabi_2014" id="rabi_2014" class="input-xlarge" data-rule-maxlength="50" > <!-- data-rule-required="true" -->
		    </div>
		</div>	<!-- // 2014 -->

		<div class="control-group span6">
		    <label for="tasktitel" class="control-label">2015 <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" placeholder="2015" value="<?php if((isset($rabi_2015)) && ($rabi_2015 != '')) { echo $rabi_2015; } ?>" name="rabi_2015" id="rabi_2015" class="input-xlarge" data-rule-maxlength="50" > <!-- data-rule-required="true" -->
		    </div>
		</div>	<!-- // 2015 -->

		<div class="clearfix"></div>

		<div class="control-group span6">
		    <label for="tasktitel" class="control-label">2016 <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" placeholder="2016" value="<?php if((isset($rabi_2016)) && ($rabi_2016 != '')) { echo $rabi_2016; } ?>" name="rabi_2016" id="rabi_2016" class="input-xlarge" data-rule-maxlength="50" > <!-- data-rule-required="true" -->
		    </div>
		</div>	<!-- // 2016 -->

		<div class="control-group span6">
		    <label for="tasktitel" class="control-label">2017 <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" placeholder="2017" value="<?php if((isset($rabi_2017)) && ($rabi_2017 != '')) { echo $rabi_2017; } ?>" name="rabi_2017" id="rabi_2017" class="input-xlarge" data-rule-maxlength="50" > <!-- data-rule-required="true" -->
		    </div>
		</div>	<!-- // 2017 -->

		<div class="clearfix"></div>		
					
		<h3>Summer</h3>	<!-- // Summer -->
		
		<div class="control-group span6">
		    <label for="tasktitel" class="control-label">2014 <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" placeholder="2014" value="<?php if((isset($summer_2014)) && ($summer_2014 != '')) { echo $summer_2014; } ?>" name="summer_2014" id="summer_2014" class="input-xlarge" data-rule-maxlength="50" > <!-- data-rule-required="true" -->
		    </div>
		</div>	<!-- // 2014 -->

		<div class="control-group span6">
		    <label for="tasktitel" class="control-label">2015 <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" placeholder="2015" value="<?php if((isset($summer_2015)) && ($summer_2015 != '')) { echo $summer_2015; } ?>" name="summer_2015" id="summer_2015" class="input-xlarge" data-rule-maxlength="50" > <!-- data-rule-required="true" -->
		    </div>
		</div>	<!-- // 2015 -->

		<div class="clearfix"></div>

		<div class="control-group span6">
		    <label for="tasktitel" class="control-label">2016 <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" placeholder="2016" value="<?php if((isset($summer_2016)) && ($summer_2016 != '')) { echo $summer_2016; } ?>" name="summer_2016" id="summer_2016" class="input-xlarge" data-rule-maxlength="50" > <!-- data-rule-required="true" -->
		    </div>
		</div>	<!-- // 2016 -->

		<div class="control-group span6">
		    <label for="tasktitel" class="control-label">2017 <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" placeholder="2017" value="<?php if((isset($summer_2017)) && ($summer_2017 != '')) { echo $summer_2017; } ?>" name="summer_2017" id="summer_2017" class="input-xlarge" data-rule-maxlength="50" > <!-- data-rule-required="true" -->
		    </div>
		</div>	<!-- // 2017 -->

		<div class="clearfix"></div>			
				

		<h2>What was the turnover achieved by Trading Activities</h2>	<!-- // What was the turnover achieved by Trading Activities: -->
		
		<div class="control-group span6">
			<label for="tasktitel" class="control-label">2014 <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" value="<?php if((isset($turnover_achieved_by_tradin_2014)) && ($turnover_achieved_by_tradin_2014 != '')){ echo $turnover_achieved_by_tradin_2014; } ?>" id="turnover_achieved_by_tradin_2014" name="turnover_achieved_by_tradin_2014" placeholder="2014" class="input-large"  data-rule-number="true" minlength="1" maxlength="12" size="12" onKeyPress="return numsonly(event);" /> <!-- data-rule-required="true" -->
		    </div>
		</div>	<!-- // 2014 -->


		<div class="control-group span6">
			<label for="tasktitel" class="control-label">2015 <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" value="<?php if((isset($turnover_achieved_by_tradin_2015)) && ($turnover_achieved_by_tradin_2015 != '')){ echo $turnover_achieved_by_tradin_2015; } ?>" id="turnover_achieved_by_tradin_2015" name="turnover_achieved_by_tradin_2015" placeholder="2015" class="input-large"  data-rule-number="true" minlength="1" maxlength="12" size="12" onKeyPress="return numsonly(event);" /> <!-- data-rule-required="true" -->
		    </div>
		</div>	<!-- // 2015 -->
		
		<div class="control-group span6">
			<label for="tasktitel" class="control-label">2016 <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" value="<?php if((isset($turnover_achieved_by_tradin_2016)) && ($turnover_achieved_by_tradin_2016 != '')){ echo $turnover_achieved_by_tradin_2016; } ?>" id="turnover_achieved_by_tradin_2016" name="turnover_achieved_by_tradin_2016" placeholder="2016" class="input-large"  data-rule-number="true" minlength="1" maxlength="12" size="12" onKeyPress="return numsonly(event);" /> <!-- data-rule-required="true" -->
		    </div>
		</div>	<!-- // 2016 -->
		
		<div class="control-group span6">
			<label for="tasktitel" class="control-label">2017 <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" value="<?php if((isset($turnover_achieved_by_tradin_2017)) && ($turnover_achieved_by_tradin_2017 != '')){ echo $turnover_achieved_by_tradin_2017; } ?>" id="turnover_achieved_by_tradin_2017" name="turnover_achieved_by_tradin_2017" placeholder="2017" class="input-large"  data-rule-number="true" minlength="1" maxlength="12" size="12" onKeyPress="return numsonly(event);" /> <!-- data-rule-required="true" -->
		    </div>
		</div>	<!-- // 2017			 -->

		<div class="clearfix"></div>

		<div class="control-group ">
			<label for="tasktitel" class="control-label">Therefore, total annual turnover of the FPO <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" value="<?php if((isset($total_annual_turnover_of_fpo)) && ($total_annual_turnover_of_fpo != '')){ echo $total_annual_turnover_of_fpo; } ?>" id="total_annual_turnover_of_fpo" name="total_annual_turnover_of_fpo" placeholder="Therefore, total annual turnover of the FPO" class="input-xxlarge"  data-rule-number="true" minlength="1" maxlength="12" size="12" onKeyPress="return numsonly(event);" /> <!-- data-rule-required="true" -->
		    </div>
		</div>	<!-- // Therefore, total annual turnover of the FPO -->

		<div class="control-group ">
		    <label for="tasktitel" class="control-label">What Produces are you planning to procure for 2018 <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" placeholder="What Produces are you planning to procure for 2018" value="<?php if((isset($produces_plan_for_2018)) && ($produces_plan_for_2018 != '')) { echo $produces_plan_for_2018; } ?>" name="produces_plan_for_2018" id="produces_plan_for_2018" class="input-xxlarge" data-rule-maxlength="50" > <!-- data-rule-required="true" -->
		    </div>
		</div>	<!-- // What Produces are you planning to procure for 2018 -->

		<div class="control-group ">
		    <label for="tasktitel" class="control-label">What other business activities do you undertake at FPO? <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" placeholder="What other business activities do you undertake at FPO?" value="<?php if((isset($other_business_activities)) && ($other_business_activities != '')) { echo $other_business_activities; } ?>" name="other_business_activities" id="other_business_activities" class="input-xxlarge"  > <!-- data-rule-maxlength="50" data-rule-required="true" -->
		    </div>
		</div>	<!-- // What other business activities do you undertake at FPO? -->

		<div class="form-actions" style="clear:both;">
		    <button id="submit" name="Submit" type="submit" class="btn btn-primary" >Submit</button>&nbsp;&nbsp;
		    <button id="reset" type="button" class="btn" onclick="window.history.back()">Cancel</button>
		</div>	<!-- // Submit -->

	</div>	
</form>

<script type="text/javascript">
	
	$(document).ready(function() 
	{
		// // START : share_value
		// 	<?php
		// 	if(isset($num_of_shares))
		// 	{
		// 		?>
		// 		getDisplayDiv1('<?php //echo $share_value; ?>', 'div_share_value');
		// 		<?php
		// 	}
		// 	?>
		// // END : share_value

		// // START : governing_org
		// 	if($('#governing_org').val() == 'OTHERS')
		// 	{
		// 		$('#div_governing_org').show('swing');
		// 	}
		// 	else
		// 	{
		// 		$('#div_governing_org').hide('swing');
		// 		$('#div_governing_org').find('input, select').val('').trigger('change');
		// 	}
		// // END : governing_org
		
		// // START : any_funding_received
		// 	if($('#any_funding_received').val() == 'yes')
		// 	{
		// 		$('#div_any_funding_received').show('swing');
		// 	}
		// 	else
		// 	{
		// 		$('#div_any_funding_received').hide('swing');
		// 		$('#div_any_funding_received').find('input, select').val('').trigger('change');
		// 	}
		// // END : any_funding_received
		
		// // START : any_funding_received_from_bank
		// 	if($('#any_funding_received_from_bank').val() == 'yes')
		// 	{
		// 		$('#div_any_funding_received_from_bank').show('swing');
		// 	}
		// 	else
		// 	{
		// 		$('#div_any_funding_received_from_bank').hide('swing');
		// 		$('#div_any_funding_received_from_bank').find('input, select').val('').trigger('change');
		// 	}
		// // END : any_funding_received_from_bank
		
		// // START : used_any_software
		// 	if($('#used_any_software').val() == 'yes')
		// 	{
		// 		$('#div_used_any_software').show('swing');
		// 	}
		// 	else
		// 	{
		// 		$('#div_used_any_software').hide('swing');
		// 		$('#div_used_any_software').find('input, select').val('').trigger('change');
		// 	}
		// // END : used_any_software

	});

	function getDisplayDiv1(mainDivVal, DisplayDivID)
	{
		if(mainDivVal != 0)
		{
			$('#'+DisplayDivID).slideDown();
		}
		else
		{
			$('#'+DisplayDivID).slideUp();
		}
	}

	$('#frm_div_share_details').on('submit', function(e) 
	{
		e.preventDefault();
		if ($('#frm_div_share_details').valid())
		{
			loading_show();	
			
			$.ajax({
				type: "POST",
				url: "load_fpo.php",
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
						loading_hide();
						// getOpen('main_li_training_details');
						
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

</script>
<!-- CREATE TABLE tbl_fpo_share_details
(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	fpo_id INT,
	
	num_of_shares VARCHAR(255),
	share_amount_contribution VARCHAR(255),
	num_of_share_holders VARCHAR(255),
	membership_fee VARCHAR(255),
	total_share_capital VARCHAR(255),
	total_membership_amt_collected VARCHAR(255),
	resource_institution_name VARCHAR(255),
	resource_institution_address VARCHAR(255),
	resource_institution_contactPerson VARCHAR(255),
	resource_nstitution_mobile_num VARCHAR(255),
	resource_institution_email_id VARCHAR(255),
	governing_org VARCHAR(255),
	governing_org_val VARCHAR(255),
	any_funding_received VARCHAR(255),
	type_of_funding_received VARCHAR(255),
	size_of_funding_received VARCHAR(255),
	private_org_name VARCHAR(255),
	funding_duration VARCHAR(255),
	date_of_support_ending VARCHAR(255),
	total_support_amount VARCHAR(255),
	funding_support_used_for VARCHAR(255),
	any_other_funding_support VARCHAR(255),
	fpo_own_assets VARCHAR(255),
	aggregate_value_of_assets VARCHAR(255),
	other_supports_to_members VARCHAR(255),
	bank_name VARCHAR(255),
	any_funding_received_from_bank VARCHAR(255),
	mention_funding_receving_details VARCHAR(255),
	num_of_villages_part_of_org VARCHAR(255),
	num_of_figs VARCHAR(255),
	produces_deal_with VARCHAR(255),
	input_shop_associated_with_fpo VARCHAR(255),
	annual_turnover_of_fpo_2013_14 VARCHAR(255),
	annual_turnover_of_fpo_2014_15 VARCHAR(255),
	annual_turnover_of_fpo_2015_16 VARCHAR(255),
	annual_turnover_of_fpo_2016_17 VARCHAR(255),
	used_any_software VARCHAR(255),
	mention_software_details VARCHAR(255),
	kharif_2014 VARCHAR(255),
	kharif_2015 VARCHAR(255),
	kharif_2016 VARCHAR(255),
	kharif_2017 VARCHAR(255),
	rabi_2014 VARCHAR(255),
	rabi_2015 VARCHAR(255),
	rabi_2016 VARCHAR(255),
	rabi_2017 VARCHAR(255),
	summer_2014 VARCHAR(255),
	summer_2015 VARCHAR(255),
	summer_2016 VARCHAR(255),
	summer_2017 VARCHAR(255),
	turnover_achieved_by_tradin_2014 VARCHAR(255),
	turnover_achieved_by_tradin_2015 VARCHAR(255),
	turnover_achieved_by_tradin_2016 VARCHAR(255),
	turnover_achieved_by_tradin_2017 VARCHAR(255),
	total_annual_turnover_of_fpo VARCHAR(255),
	produces_plan_for_2018 VARCHAR(255),
	other_business_activities VARCHAR(255),
	status INT,
	created_date DATETIME,
	created_by INT,
	modified_date DATETIME,
	modified_by INT
) 

CREATE TABLE tbl_share_value
(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	fpo_share_details_id INT,
	share_value VARCHAR(255),	
	created_date DATETIME,
	created_by INT,
	modified_date DATETIME,
	modified_by INT
)

-->