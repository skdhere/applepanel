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
	
	$res_get_fpo_info = lookup_value('tbl_fpo_basic_information',array(),array("fpo_id"=>$fpo_id),array(),array(),array());
	if($res_get_fpo_info)
	{
		$num_get_fpo_info	= mysqli_num_rows($res_get_fpo_info);
		if($num_get_fpo_info != 0)
		{
			$row_get_fpo_info	= mysqli_fetch_array($res_get_fpo_info);

			$isUpdated = '1';

			$id 					= $row_get_fpo_info['id'];
			$orgType                = $row_get_fpo_info['orgType'];
			$orgType_val            = $row_get_fpo_info['orgType_val'];
			$ddl_state              = $row_get_fpo_info['ddl_state'];
			$ddl_dist               = $row_get_fpo_info['ddl_dist'];
			$ddl_tal                = $row_get_fpo_info['ddl_tal'];
			$ddl_village            = $row_get_fpo_info['ddl_village'];
			$txt_pincode            = $row_get_fpo_info['txt_pincode'];
			$contactPerson          = $row_get_fpo_info['contactPerson'];
			$designation            = $row_get_fpo_info['designation'];
			$org_reg_no             = $row_get_fpo_info['org_reg_no'];
			$date_of_reg            = $row_get_fpo_info['date_of_reg'];
			$date_of_formating      = $row_get_fpo_info['date_of_formating'];
			$num_of_members         = $row_get_fpo_info['num_of_members'];
			$num_of_village_covered = $row_get_fpo_info['num_of_village_covered'];
			$name_of_villages       = $row_get_fpo_info['name_of_villages'];
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
<form method="POST" enctype="multipart/form-data" class="form-horizontal form-bordered form-validate" id="frm_div_basic_information" name="frm_div_basic_information" >
	<input type="hidden" id="hid_div_basic_information" name="hid_div_basic_information" value="1">
	<input type="hidden" id="fpo_id" name="fpo_id" value="<?php echo $fpo_id; ?>">
	<input type="hidden" id="record_id" name="record_id" value="<?php if((isset($id)) && ($id != '')){ echo $id; } ?>">
	<input type="hidden" id="hid_isUpdate_flag" name="hid_isUpdate_flag" value="<?php echo $isUpdated; ?>">

	<div class="form-content">

		<div class="control-group">
		    <label for="text" class="control-label" style="margin-top:10px">Type of Organization <span style="color:#F00">*</span></label>
		    <div class="controls">
		        <select id="orgType" name="orgType" class="select2-me input-xlarge"  onChange="getDisplayDiv(this.value, 'div_orgType', 'OTHERS');">	<!-- data-rule-required="true" -->
		        	<option value="" disabled selected> Select here</option>
		        	<option value="PRODUCER CO" <?php if((isset($orgType)) && ($orgType != '') && ($orgType == 'PRODUCER CO')) { ?> selected <?php } ?>> PRODUCER CO</option>
		        	<option value="SOCIETY" <?php if((isset($orgType)) && ($orgType != '') && ($orgType == 'SOCIETY')) { ?> selected <?php } ?>> SOCIETY</option>
		        	<option value="PVT LTD CO" <?php if((isset($orgType)) && ($orgType != '') && ($orgType == 'PVT LTD CO')) { ?> selected <?php } ?>> PVT LTD CO</option>
		        	<option value="OTHERS" <?php if((isset($orgType)) && ($orgType != '') && ($orgType == 'OTHERS')) { ?> selected <?php } ?>> OTHERS</option>
		        </select>
		    </div>
		</div>	<!-- // Org. Type -->

		<div id="div_orgType" style="display:none;">
		    <div class="control-group">
		        <label for="tasktitel" class="control-label">PLEASE MENTION TYPE <span style="color:#F00">*</span></label>
		        <div class="controls">
		        	<input type="text" value="<?php if((isset($orgType_val)) && ($orgType_val != '')) { echo $orgType_val; } ?>" placeholder="PLEASE MENTION TYPE!" name="orgType_val" id="orgType_val" class="input-xlarge" data-rule-maxlength="12">
		        </div>
		    </div>
		</div>	<!-- // Org type val -->

		<div class="control-group" style="clear:both;">
			<label for="tasktitel" class="control-label">State <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<select id="ddl_state" name="ddl_state" onChange="getDist('p', this.value, 'ddl_dist', 'ddl_tal', 'ddl_village', 'div_dist', 'div_tal', 'div_village');" class="select2-me input-large" >
		        	<option value="" disabled selected>Select State</option>
		        	<?php
		        	$res_get_state	= lookup_value('tbl_state',array(),array(),array(),array(),array());
					
					if($res_get_state)
					{
						while ($row = mysqli_fetch_array($res_get_state) ) 
						{
							?>
							<option value="<?php echo $row['id']; ?>" <?php if((isset($ddl_state)) && ($ddl_state == $row['id'])) { ?> selected <?php } ?> ><?php echo strtoupper($row['st_name']); ?></option>
							<?php
						}
					}
					?>
				</select>
		    </div>
		</div>	<!-- // state -->

		<div class="control-group" style="clear:both;">
			<label for="tasktitel" class="control-label">District <span style="color:#F00">*</span></label>
		    <div class="controls" id="div_dist">
		    	<select id="ddl_dist" name="ddl_dist" class="select2-me input-large" >
		        	<option value="" disabled selected>Select District</option>
	                <?php
	                if(isset($ddl_state))
					{
						$result = lookup_value('tbl_district',array(),array("dt_stid"=>$ddl_state),array(),array(),array());

						if($result)
						{
							while ($row = mysqli_fetch_array($result))
							{
								?>
								<option value="<?php echo $row['id']; ?>" <?php if((isset($ddl_dist)) && $ddl_dist == $row['id']) { ?> selected <?php } ?>>
                                	<?php echo strtoupper($row['dt_name']); ?>
                               	</option>
								<?php
							}
						}
					}
	                ?>
		        </select>
		    </div>
		</div>	<!-- // dist -->

		<div class="control-group" style="clear:both;">
			<label for="tasktitel" class="control-label">Taluka <span style="color:#F00">*</span></label>
		    <div class="controls" id="div_tal">
		    	<select id="ddl_tal" name="ddl_tal" class="select2-me input-large" >
		        	<option value="" disabled selected>Select Taluka</option>
		        	<?php
					if(isset($ddl_dist))
					{   
						$tal_result = lookup_value('tbl_taluka',array(),array("tk_dtid"=>$ddl_dist),array(),array(),array());

						if($tal_result)
						{
							while ($tal_row = mysqli_fetch_array($tal_result) ) {
								echo '<option value="'.$tal_row['id'].'"';
								if($tal_row['id']==$ddl_tal)
								{
									echo ' selected ';
								}
								echo '>'.strtoupper($tal_row['tk_name']).'</option>';
							}
						}
					}
					?>
		        </select>
		    </div>
		</div>	<!-- // Taluka -->

		<div class="control-group" style="clear:both;">
			<label for="tasktitel" class="control-label">Village Name <span style="color:#F00">*</span></label>
		    <div class="controls" id="div_village">
		    	<select id="ddl_village" name="ddl_village" class="select2-me input-large" >
		        	<option value="" disabled selected>Select Village</option>
		        	<?php
					if(isset($ddl_tal))
					{   
						$result = lookup_value('tbl_village',array(),array("vl_tkid"=>$ddl_tal),array(),array(),array());

						if($result)
						{
							while ($row = mysqli_fetch_array($result) ) 
							{
								?>
								<option value="<?php echo $row['id'];?>" <?php if((isset($ddl_village)) && $ddl_village == $row['id']) { ?> selected <?php } ?>>
                                	<?php echo strtoupper($row['vl_name']); ?>
                                </option>
								<?php
							}
						}
					}
					?>
		        </select>
		    </div>
		</div>	<!-- // Village -->

		<div class="control-group" style="clear:both;">
			<label for="tasktitel" class="control-label">Pin-Code <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" value="<?php if((isset($txt_pincode)) && ($txt_pincode != '')){ echo $txt_pincode; } ?>" id="txt_pincode" name="txt_pincode" placeholder="Pin-Code" class="input-large"  data-rule-number="true" minlength="6" maxlength="6" size="6" />	<!-- data-rule-required="true" -->
		    </div>
		</div>	<!-- // PinCode -->

		<div class="control-group">
		    <label for="tasktitel" class="control-label">Name Of the Contact Person <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" placeholder="Name Of the Contact Person" value="<?php if((isset($contactPerson)) && ($contactPerson != '')) { echo $contactPerson; } ?>" name="contactPerson" id="contactPerson" class="input-xlarge" data-rule-maxlength="50">
		    </div>
		</div>	<!-- // Contact Person name -->

		<div class="control-group">
		    <label for="tasktitel" class="control-label">Designation <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" placeholder="Designation" value="<?php if((isset($designation)) && ($designation != '')) { echo $designation; } ?>" name="designation" id="designation" class="input-xlarge" data-rule-maxlength="50">
		    </div>
		</div>	<!-- // Designation -->

		<div class="control-group">
		    <label for="numberfield" class="control-label">Organization Registered Number <span style="color:#F00">*</span></label>
			<div class="controls">
		        <input type="text" placeholder="Organization Registered Number" value="<?php if((isset($org_reg_no)) && ($org_reg_no != '')) { echo $org_reg_no; } ?>" name="org_reg_no" id="org_reg_no" autocomplete="off"   class="input-xlarge"> <!-- // data-rule-minlength="10"  data-rule-maxlength="10" maxlength="10"   v_number -->	<!-- data-rule-required="true" -->
		        <label id="comp_2" style="color:#FF0000;width:200px;margin-left:100px;"></label>    
		    </div>
		</div>	<!-- // org. reg. Number -->

		<div class="control-group">
			<label for="tasktitel" class="control-label">Date Of Registration <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" value="<?php if((isset($date_of_reg)) && ($date_of_reg != '')) { echo $date_of_reg; } ?>" id="date_of_reg" name="date_of_reg" placeholder="Date Of Registration" class="datepicker input-large"  />	<!-- data-rule-required="true" -->
		    </div>
		</div>	<!-- // Date Of reg -->

		<div class="control-group">
			<label for="tasktitel" class="control-label">Date of Formating <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" value="<?php if((isset($date_of_formating)) && ($date_of_formating != '')) { echo $date_of_formating; } ?>" id="date_of_formating" name="date_of_formating" placeholder="Date of Formating" class="datepicker input-large"  />	<!-- data-rule-required="true" -->
		    </div>
		</div>	<!-- // Date of Formating -->

		<div class="control-group" style="clear:both;">
			<label for="tasktitel" class="control-label">Number Of Members <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" value="<?php if((isset($num_of_members)) && ($num_of_members != '')) { echo $num_of_members; } ?>" id="num_of_members" name="num_of_members" placeholder="Number Of members" class="input-large"  data-rule-number="true" minlength="1" maxlength="4" size="4" onKeyPress="return numsonly(event);" />	<!-- data-rule-required="true" -->
		    </div>
		</div>	<!-- // no. of members  -->

		<div class="control-group" style="clear:both;">
			<label for="tasktitel" class="control-label">Number Of Village Covered <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" value="<?php if((isset($num_of_village_covered)) && ($num_of_village_covered != '')) { echo $num_of_village_covered; } ?>" id="num_of_village_covered" name="num_of_village_covered" placeholder="Number Of Village Covered" class="input-large"  data-rule-number="true" minlength="1" maxlength="4" size="4"  onKeyPress="return numsonly(event);"/>	<!-- data-rule-required="true" -->
		    </div>
		</div>	<!-- // no. of village covered  -->

		<div class="control-group">
		    <label for="tasktitel" class="control-label">Name Of the Villages <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<!-- <input type="text" placeholder="Name Of the Villages" value="<?php //if((isset($name_of_villages)) && ($name_of_villages != '')) { echo $name_of_villages; } ?>" name="name_of_villages" id="name_of_villages" class="input-xxlarge" > -->
		    	<textarea name="name_of_villages" id="name_of_villages" rows="12" cols="15" class="input-xxlarge"><?php if((isset($name_of_villages)) && ($name_of_villages != '')) { echo $name_of_villages; } ?></textarea>
		    </div>
		</div>	<!-- // name of the Village -->

		<div class="form-actions" style="clear:both;">
		    <button id="submit" name="Submit" type="submit" class="btn btn-primary" >Submit</button>&nbsp;&nbsp;
		    <button id="reset" type="button" class="btn" onclick="window.history.back()">Cancel</button>
		</div>	<!-- // Submit -->

	</div>	
</form>

<script type="text/javascript">
	
	$(document).ready(function() 
	{
		if($('#orgType').val() == 'OTHERS')
		{
			$('#div_orgType').show('swing');
		}
		else
		{
			$('#div_orgType').hide('swing');
			$('#div_orgType').find('input, select').val('').trigger('change');
		}
	});

	$('#frm_div_basic_information').on('submit', function(e) 
	{
		e.preventDefault();
		if ($('#frm_div_basic_information').valid())
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
						//getOpen('main_li_share_details');
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
<!-- CREATE TABLE tbl_fpo_basic_information
(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	fpo_id INT,
	orgType VARCHAR(100),
	orgType_val TEXT,
	ddl_state INT,
	ddl_dist INT,
	ddl_tal INT,
	ddl_village INT,
	txt_pincode INT,
	contactPerson VARCHAR(100),
	designation VARCHAR(100),
	org_reg_no VARCHAR(50),
	date_of_reg DATETIME,
	date_of_formating DATETIME,
	num_of_members INT,
	num_of_village_covered INT,
	name_of_villages TEXT,
	status INT,
	created_date DATETIME,
	created_by INT,
	modified_date DATETIME,
	modified_by INT
) -->