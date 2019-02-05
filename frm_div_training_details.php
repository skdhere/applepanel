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
	$res_get_fpo_info = lookup_value('tbl_fpo_training_details',array(),array("fpo_id"=>$fpo_id),array(),array(),array());
	if($res_get_fpo_info)
	{
		$num_get_fpo_info	= mysqli_num_rows($res_get_fpo_info);
		if($num_get_fpo_info != 0)
		{
			$row_get_fpo_info	= mysqli_fetch_array($res_get_fpo_info);

			$isUpdated = '1';

			$id                                = $row_get_fpo_info['id'];
			$training_to_members               = $row_get_fpo_info['training_to_members'];
			$training_val_members              = $row_get_fpo_info['training_val_members'];
			$training_to_bod                   = $row_get_fpo_info['training_to_bod'];
			$training_val_bod                  = $row_get_fpo_info['training_val_bod'];
			$date_of_last_board_meeting        = $row_get_fpo_info['date_of_last_board_meeting'];
			$frequency_of_board_meeting        = $row_get_fpo_info['frequency_of_board_meeting'];
			$date_of_last_gen_assembly_meeting = $row_get_fpo_info['date_of_last_gen_assembly_meeting'];
			$isContactFullScaleAGM             = $row_get_fpo_info['isContactFullScaleAGM'];
			$haveCollectiveWarehouse           = $row_get_fpo_info['haveCollectiveWarehouse'];
			$warehouse_capacity                = $row_get_fpo_info['warehouse_capacity'];
			$warehouse_location                = $row_get_fpo_info['warehouse_location'];
			$procurement_facility              = $row_get_fpo_info['procurement_facility'];
			$value_of_asset                    = $row_get_fpo_info['value_of_asset'];
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
<form method="POST" enctype="multipart/form-data" class="form-horizontal form-bordered form-validate" id="frm_div_training_details" name="frm_div_training_details" >
	<input type="hidden" id="hid_div_training_details" name="hid_div_training_details" value="1">
	<input type="hidden" id="fpo_id" name="fpo_id" value="<?php echo $fpo_id; ?>">
	<input type="hidden" id="record_id" name="record_id" value="<?php if((isset($id)) && ($id != '')){ echo $id; } ?>">
	<input type="hidden" id="hid_isUpdate_flag" name="hid_isUpdate_flag" value="<?php echo $isUpdated; ?>">

	<div class="form-content">

		<div class="control-group">
            <label for="text" class="control-label" style="margin-top:10px">Do you provide regular trainings to the members? <span style="color:#F00">*</span></label>
            <div class="controls">
                <select id="training_to_members" name="training_to_members" class="select2-me input-xlarge" onChange="getDisplayDiv(this.value, 'div_training_to_members', 'yes');">	<!-- data-rule-required="true" -->
                	<option value="" disabled selected > Select here</option>
                	<option value="yes" <?php if((isset($training_to_members)) && ($training_to_members != '') && ($training_to_members == 'yes')) { ?> selected <?php } ?>> YES</option>
                	<option value="no" <?php if((isset($training_to_members)) && ($training_to_members != '') && ($training_to_members == 'no')) { ?> selected <?php } ?>> NO</option>
                </select>
            </div>
        </div>	<!-- // training_to_members -->

		<div id="div_training_to_members" style="display:none;">
            <div class="control-group">
                <label for="tasktitel" class="control-label">What type of training <span style="color:#F00">*</span></label>
                <div class="controls">
                	<input type="text" placeholder="What type of training!" value="<?php if((isset($training_val_members)) && ($training_val_members != '')) { echo $training_val_members; } ?>" name="training_val_members" id="training_val_members" class="input-xlarge" > <!-- // data-rule-maxlength="12" -->
                </div>
            </div>
        </div>	<!-- // What type of training -->

        <div class="control-group">
            <label for="text" class="control-label" style="margin-top:10px">Do you provide regular trainings to the BOD? <span style="color:#F00">*</span></label>
            <div class="controls">
                <select id="training_to_bod" name="training_to_bod" class="select2-me input-xlarge" onChange="getDisplayDiv(this.value, 'div_training_to_bod', 'yes');">	<!-- data-rule-required="true" -->
                	<option value="" disabled selected > Select here</option>
                	<option value="yes" <?php if((isset($training_to_bod)) && ($training_to_bod != '') && ($training_to_bod == 'yes')) { ?> selected <?php } ?>> YES</option>
                	<option value="no" <?php if((isset($training_to_bod)) && ($training_to_bod != '') && ($training_to_bod == 'no')) { ?> selected <?php } ?>> NO</option>
                </select>
            </div>
        </div>	<!-- // training_to_bod -->

		<div id="div_training_to_bod" style="display:none;">
            <div class="control-group">
                <label for="tasktitel" class="control-label">What type of training <span style="color:#F00">*</span></label>
                <div class="controls">
                	<input type="text" placeholder="What type of training!" value="<?php if((isset($training_val_bod)) && ($training_val_bod != '')) { echo $training_val_bod; } ?>" name="training_val_bod" id="training_val_bod" class="input-xlarge" > <!-- // data-rule-maxlength="12" -->
                </div>
            </div>
        </div>	<!-- // What type of training -->

		<div class="control-group">
        	<label for="tasktitel" class="control-label">When was the last board meeting? <span style="color:#F00">*</span></label>
            <div class="controls">
            	<input type="text" value="<?php if((isset($date_of_last_board_meeting)) && ($date_of_last_board_meeting != '')) { echo $date_of_last_board_meeting; } ?>" id="date_of_last_board_meeting" name="date_of_last_board_meeting" placeholder="When was the last board meeting?" class="datepicker input-large" />	<!-- data-rule-required="true" -->
            </div>
        </div>	<!-- // When was the last board meeting?                                         -->

        <div class="control-group">
            <label for="tasktitel" class="control-label">How frequently do you conduct board meetings? <span style="color:#F00">*</span></label>
            <div class="controls">
            	<input type="text" placeholder="How frequently do you conduct board meetings?" value="<?php if((isset($frequency_of_board_meeting)) && ($frequency_of_board_meeting != '')) { echo $frequency_of_board_meeting; } ?>" name="frequency_of_board_meeting" id="frequency_of_board_meeting" class="input-xlarge" data-rule-maxlength="12">
            </div>
        </div>	<!-- // How frequently do you conduct board meetings? -->

		<div class="control-group">
        	<label for="tasktitel" class="control-label">When was the general assembly meeting? <span style="color:#F00">*</span></label>
            <div class="controls">
            	<input type="text" value="<?php if((isset($date_of_last_gen_assembly_meeting)) && ($date_of_last_gen_assembly_meeting != '')) { echo $date_of_last_gen_assembly_meeting; } ?>" id="date_of_last_gen_assembly_meeting" name="date_of_last_gen_assembly_meeting" placeholder="When was the general assembly meeting?" class="datepicker input-large" />	<!-- data-rule-required="true" -->
            </div>
        </div>	<!-- // When was the general assembly meeting? -->

        <div class="control-group">
            <label for="text" class="control-label" style="margin-top:10px">Do you conduct full scale AGM at least once a year? <span style="color:#F00">*</span></label>
            <div class="controls">
                <select id="isContactFullScaleAGM" name="isContactFullScaleAGM" class="select2-me input-xlarge">	<!-- data-rule-required="true" -->
                	<option value="" disabled selected > Select here</option>
                	<option value="yes" <?php if((isset($isContactFullScaleAGM)) && ($isContactFullScaleAGM != '') && ($isContactFullScaleAGM == 'yes')) { ?> selected <?php } ?>> YES</option>
                	<option value="no" <?php if((isset($isContactFullScaleAGM)) && ($isContactFullScaleAGM != '') && ($isContactFullScaleAGM == 'no')) { ?> selected <?php } ?>> NO</option>
                </select>
            </div>
        </div>	<!-- // Do you conduct full scale AGM at least once a year? -->

        <div class="control-group">
            <label for="text" class="control-label" style="margin-top:10px">Do you have a collective warehouse? <span style="color:#F00">*</span></label>
            <div class="controls">
                <select id="haveCollectiveWarehouse" name="haveCollectiveWarehouse" class="select2-me input-xlarge" onChange="getDisplayDiv(this.value, 'div_haveCollectiveWarehouse', 'yes');">	<!-- data-rule-required="true" -->
                	<option value="" disabled selected > Select here</option>
                	<option value="yes" <?php if((isset($haveCollectiveWarehouse)) && ($haveCollectiveWarehouse != '') && ($haveCollectiveWarehouse == 'yes')) { ?> selected <?php } ?>> YES</option>
                	<option value="no" <?php if((isset($haveCollectiveWarehouse)) && ($haveCollectiveWarehouse != '') && ($haveCollectiveWarehouse == 'no')) { ?> selected <?php } ?>> NO</option>
                </select>
            </div>
        </div>	<!-- // Do you have a collective warehouse? -->

        <div id="div_haveCollectiveWarehouse" style="display:none;">

        	<div class="control-group" style="clear:both;">
            	<label for="tasktitel" class="control-label">what is the capacity? <span style="color:#F00">*</span></label>
                <div class="controls">
                	<input type="text" value="<?php if((isset($warehouse_capacity)) && ($warehouse_capacity != '')) { echo $warehouse_capacity; } ?>" id="warehouse_capacity" name="warehouse_capacity" placeholder="what is the capacity" class="input-large" data-rule-number="true" minlength="1" maxlength="4" size="4" />	<!-- data-rule-required="true" -->
                </div>
            </div>	<!-- //  what is the capacity -->

        	<div class="control-group">
                <label for="tasktitel" class="control-label">Where is it located? <span style="color:#F00">*</span></label>
                <div class="controls">
                	<input type="text" placeholder="Where is it located?" value="<?php if((isset($warehouse_location)) && ($warehouse_location != '')) { echo $warehouse_location; } ?>" name="warehouse_location" id="warehouse_location" class="input-xxlarge" data-rule-maxlength="255">
                </div>
            </div>	<!-- // Where is it located? -->

        	<div class="control-group">
                <label for="text" class="control-label" style="margin-top:10px">Does it have a procurement facility? <span style="color:#F00">*</span></label>
                <div class="controls">
                    <select id="procurement_facility" name="procurement_facility" class="select2-me input-xlarge">	<!-- data-rule-required="true" -->
                    	<option value="" disabled selected > Select here</option>
                    	<option value="yes" <?php if((isset($procurement_facility)) && ($procurement_facility != '') && ($procurement_facility == 'yes')) { ?> selected <?php } ?>> YES</option>
                    	<option value="no" <?php if((isset($procurement_facility)) && ($procurement_facility != '') && ($procurement_facility == 'no')) { ?> selected <?php } ?>> NO</option>
                    </select>
                </div>
            </div>	<!-- // Does it have a procurement facility? -->

        	<div class="control-group" style="clear:both;">
            	<label for="tasktitel" class="control-label">What is the value of the asset? <span style="color:#F00">*</span></label>
                <div class="controls">
                	<input type="text" value="<?php if((isset($value_of_asset)) && ($value_of_asset != '')) { echo $value_of_asset; } ?>" id="value_of_asset" name="value_of_asset" placeholder="What is the value of the asset?" class="input-large" data-rule-number="true"  />	<!-- data-rule-required="true" minlength="1" maxlength="4" size="4" -->
                </div>
            </div>	<!-- // What is the value of the asset? -->

        </div>	<!-- // Warehouse display Div -->

		<div class="form-actions" style="clear:both;">
		    <button id="submit" name="Submit" type="submit" class="btn btn-primary" >Submit</button>&nbsp;&nbsp;
		    <button id="reset" type="button" class="btn" onclick="window.history.back()">Cancel</button>
		</div>	<!-- // Submit -->

	</div>	
</form>

<script type="text/javascript">
	
	$(document).ready(function() 
	{
		// START : training_to_members
		if($('#training_to_members').val() == 'yes')
		{
			$('#div_training_to_members').show('swing');
		}
		else
		{
			$('#div_training_to_members').hide('swing');
			$('#div_training_to_members').find('input, select').val('').trigger('change');
		}
		// END : training_to_members

		// START : training_to_bod
		if($('#training_to_bod').val() == 'yes')
		{
			$('#div_training_to_bod').show('swing');
		}
		else
		{
			$('#div_training_to_bod').hide('swing');
			$('#div_training_to_bod').find('input, select').val('').trigger('change');
		}
		// END : training_to_bod

		// START : haveCollectiveWarehouse
		if($('#haveCollectiveWarehouse').val() == 'yes')
		{
			$('#div_haveCollectiveWarehouse').show('swing');
		}
		else
		{
			$('#div_haveCollectiveWarehouse').hide('swing');
			$('#div_haveCollectiveWarehouse').find('input, select').val('').trigger('change');
		}
		// END : haveCollectiveWarehouse
	});

	$('#frm_div_training_details').on('submit', function(e) 
	{
		e.preventDefault();
		if ($('#frm_div_training_details').valid())
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
						// getOpen('main_li_area_profile');
						
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
<!-- CREATE TABLE tbl_fpo_training_details
(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	fpo_id INT,
	training_to_members VARCHAR(10),
	training_val_members TEXT,
	training_to_bod VARCHAR(10),
	training_val_bod TEXT,
	date_of_last_board_meeting VARCHAR(100),
	frequency_of_board_meeting INT,
	date_of_last_gen_assembly_meeting VARCHAR(100),
	isContactFullScaleAGM VARCHAR(10),
	haveCollectiveWarehouse VARCHAR(10),
	warehouse_capacity VARCHAR(50),
	warehouse_location TEXT,
	procurement_facility VARCHAR(10),
	value_of_asset VARCHAR(50),
	status INT,
	created_date DATETIME,
	created_by INT,
	modified_date DATETIME,
	modified_by INT
) -->