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
	$res_get_fpo_info = lookup_value('tbl_fpo_area_profile',array(),array("fpo_id"=>$fpo_id),array(),array(),array());
	if($res_get_fpo_info)
	{
		$num_get_fpo_info	= mysqli_num_rows($res_get_fpo_info);
		if($num_get_fpo_info != 0)
		{
			$row_get_fpo_info	= mysqli_fetch_array($res_get_fpo_info);

			$isUpdated = '1';

            $id                             = $row_get_fpo_info['id'];
            
            $chk_major_castes               = $row_get_fpo_info['chk_major_castes'];
            $arr_major_castes               = explode(',', $chk_major_castes);
            
            $land_size_hector               = $row_get_fpo_info['land_size_hector'];
            $land_size_acre                 = $row_get_fpo_info['land_size_acre'];
            $land_size_guntha               = $row_get_fpo_info['land_size_guntha'];
            
            $avg_land_holding               = $row_get_fpo_info['avg_land_holding'];
            $major_crops_in_kharif          = $row_get_fpo_info['major_crops_in_kharif'];
            $major_crops_in_rabi            = $row_get_fpo_info['major_crops_in_rabi'];
            $major_crops_in_summer          = $row_get_fpo_info['major_crops_in_summer'];
            
            $chk_irrigation_facility        = $row_get_fpo_info['chk_irrigation_facility'];
            $arr_irrigation_facility        = explode(',', $chk_irrigation_facility);
            
            $major_economic_activity        = $row_get_fpo_info['major_economic_activity'];
            $education_male                 = $row_get_fpo_info['education_male'];
            $education_female               = $row_get_fpo_info['education_female'];
            
            $chk_road_connectivity          = $row_get_fpo_info['chk_road_connectivity'];
            $arr_road_connectivity          = explode(',', $chk_road_connectivity);
            
            $chk_road_type                  = $row_get_fpo_info['chk_road_type'];
            $arr_road_type                  = explode(',', $chk_road_type);
            
            $distance_nearest_market        = $row_get_fpo_info['distance_nearest_market'];
            
            $chk_institutions               = $row_get_fpo_info['chk_institutions'];
            $arr_institutions               = explode(',', $chk_institutions);
            
            $name_of_institution            = $row_get_fpo_info['name_of_institution'];
            $main_office_equidistant        = $row_get_fpo_info['main_office_equidistant'];
            $main_office_has_access         = $row_get_fpo_info['main_office_has_access'];
            $demographic_composition_male   = $row_get_fpo_info['demographic_composition_male'];
            $demographic_composition_female = $row_get_fpo_info['demographic_composition_female'];
            $majority_age_range             = $row_get_fpo_info['majority_age_range'];
            $education_level_range          = $row_get_fpo_info['education_level_range'];
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
<form method="POST" enctype="multipart/form-data" class="form-horizontal form-bordered form-validate" id="frm_div_area_profile" name="frm_div_area_profile" >
	<input type="hidden" id="hid_div_area_profile" name="hid_div_area_profile" value="1">
	<input type="hidden" id="fpo_id" name="fpo_id" value="<?php echo $fpo_id; ?>">
	<input type="hidden" id="record_id" name="record_id" value="<?php if((isset($id)) && ($id != '')){ echo $id; } ?>">
	<input type="hidden" id="hid_isUpdate_flag" name="hid_isUpdate_flag" value="<?php echo $isUpdated; ?>">

    <input type="hidden" id="batch_chk_major_castes" name="batch_chk_major_castes" value="">
    <input type="hidden" id="batch_chk_irrigation_facility" name="batch_chk_irrigation_facility" value="">
    <input type="hidden" id="batch_chk_road_connectivity" name="batch_chk_road_connectivity" value="">
    <input type="hidden" id="batch_chk_road_type" name="batch_chk_road_type" value="">
    <input type="hidden" id="batch_chk_institutions" name="batch_chk_institutions" value="">

	<div class="form-content">

		<div class="control-group">
            <label for="text" class="control-label" style="margin-top:10px">What are the major castes in your area? <span style="color:#F00">*</span></label>
            <div class="controls">
                <input type="checkbox" name="chk_major_castes" class="cls_batch_chk_major_castes" value="OBC" 
                <?php if((isset($chk_major_castes))) { for($i = 0; $i < sizeof($arr_major_castes); $i++) { if((isset($chk_major_castes)) && $arr_major_castes[$i] == 'OBC') { ?> checked <?php  }  } } ?> > &nbsp;OBC &nbsp;&nbsp;
                <input type="checkbox" name="chk_major_castes" class="cls_batch_chk_major_castes" value="SC" 
                <?php if((isset($chk_major_castes))) { for($i = 0; $i < sizeof($arr_major_castes); $i++) { if((isset($chk_major_castes)) && $arr_major_castes[$i] == 'SC') { ?> checked <?php  }  } } ?> > &nbsp;SC &nbsp;&nbsp;
                <input type="checkbox" name="chk_major_castes" class="cls_batch_chk_major_castes" value="GENERAL" 
                <?php if((isset($chk_major_castes))) { for($i = 0; $i < sizeof($arr_major_castes); $i++) { if((isset($chk_major_castes)) && $arr_major_castes[$i] == 'GENERAL') { ?> checked <?php  }  } } ?> > &nbsp;GENERAL &nbsp;&nbsp;
                <input type="checkbox" name="chk_major_castes" class="cls_batch_chk_major_castes" value="ST" 
                <?php if((isset($chk_major_castes))) { for($i = 0; $i < sizeof($arr_major_castes); $i++) { if((isset($chk_major_castes)) && $arr_major_castes[$i] == 'ST') { ?> checked <?php  }  } } ?> > &nbsp;ST &nbsp;&nbsp;
            </div>
        </div>	<!-- // What are the major castes in your area? -->

        <div class="control-group">
            <label for="text" class="control-label" style="margin-top:10px">Size in Acres<span style="color:#F00">*</span></label> 
            <div class="controls">
                <!-- land_size -->
                <input placeholder="Size in Hector" type="text" onKeyPress="return numsonly(event);" onKeyUp="getAcre(this.value, 'hector', 'avg_land_holding');" id="land_size_hector" name="land_size_hector" class="input-small" value="<?php if((isset($land_size_hector)) && $land_size_hector != ''){ echo $land_size_hector; } ?>" data-rule-required="true" maxlength="6">
                <input placeholder="Size in Acres" type="text" onKeyPress="return numsonly(event);" onKeyUp="getAcre(this.value, 'acre', 'avg_land_holding');" id="land_size_acre" name="land_size_acre" class="input-small" value="<?php if((isset($land_size_acre)) && $land_size_acre != ''){ echo $land_size_acre; } ?>" maxlength="6">
                <input placeholder="Size in Guntha" type="text" onKeyPress="return numsonly(event);" onKeyUp="getAcre(this.value, 'guntha', 'avg_land_holding');" id="land_size_guntha" name="land_size_guntha" class="input-small" value="<?php if((isset($land_size_guntha)) && $land_size_guntha != ''){ echo $land_size_guntha; } ?>" maxlength="6">
                <br>
                <input type="text" onKeyPress="return numsonly(event);" id="avg_land_holding" name="avg_land_holding" class="input-xlarge" value="<?php if((isset($avg_land_holding)) && $avg_land_holding != ''){ echo $avg_land_holding; } else { ?> 0 <?php } ?>" data-rule-required="true" maxlength="6" readonly>Acre
            </div>
        </div>  <!-- Size in Acres -->

		<div class="control-group">
            <label for="tasktitel" class="control-label">Major Crops grown in Kharif <span style="color:#F00">*</span></label>
            <div class="controls">
            	<input type="text" placeholder="Major Crops grown in Kharif" value="<?php if((isset($major_crops_in_kharif)) && $major_crops_in_kharif != '') { echo $major_crops_in_kharif; } ?>" name="major_crops_in_kharif" id="major_crops_in_kharif" class="input-xxlarge" data-rule-maxlength="255">
            </div>
        </div>	<!-- // Major Crops grown in Kharif -->

		<div class="control-group">
            <label for="tasktitel" class="control-label">Major Crops grown in Rabi <span style="color:#F00">*</span></label>
            <div class="controls">
            	<input type="text" placeholder="Major Crops grown in Rabi" value="<?php if((isset($major_crops_in_rabi)) && $major_crops_in_rabi != '') { echo $major_crops_in_rabi; } ?>" name="major_crops_in_rabi" id="major_crops_in_rabi" class="input-xxlarge" data-rule-maxlength="255">
            </div>
        </div>	<!-- // Major Crops grown in Rabi -->
		
		<div class="control-group">
            <label for="tasktitel" class="control-label">Major Crops grown in Summer <span style="color:#F00">*</span></label>
            <div class="controls">
            	<input type="text" placeholder="Major Crops grown in Summer" value="<?php if((isset($major_crops_in_summer)) && $major_crops_in_summer != '') { echo $major_crops_in_summer; } ?>" name="major_crops_in_summer" id="major_crops_in_summer" class="input-xxlarge" data-rule-maxlength="255">
            </div>
        </div>	<!-- // Major Crops grown in Summer -->

		<div class="control-group">
            <label for="text" class="control-label" style="margin-top:10px">Irrigation Facilities <span style="color:#F00">*</span></label>
            <div class="controls">
                <input type="checkbox" name="chk_irrigation_facility" class="cls_batch_chk_irrigation_facility" value="Arid" 
                <?php if((isset($chk_irrigation_facility))) { for($i = 0; $i < sizeof($arr_irrigation_facility); $i++) { if((isset($chk_irrigation_facility)) && $arr_irrigation_facility[$i] == 'Arid') { ?> checked <?php  }  } } ?> > &nbsp;Arid &nbsp;&nbsp;
				<input type="checkbox" name="chk_irrigation_facility" class="cls_batch_chk_irrigation_facility" value="Semi-Arid" 
                <?php if((isset($chk_irrigation_facility))) { for($i = 0; $i < sizeof($arr_irrigation_facility); $i++) { if((isset($chk_irrigation_facility)) && $arr_irrigation_facility[$i] == 'Semi-Arid') { ?> checked <?php  }  } } ?> > &nbsp;Semi-Arid &nbsp;&nbsp;
				<input type="checkbox" name="chk_irrigation_facility" class="cls_batch_chk_irrigation_facility" value="Rainfed" 
                <?php if((isset($chk_irrigation_facility))) { for($i = 0; $i < sizeof($arr_irrigation_facility); $i++) { if((isset($chk_irrigation_facility)) && $arr_irrigation_facility[$i] == 'Rainfed') { ?> checked <?php  }  } } ?> > &nbsp;Rainfed &nbsp;&nbsp;
				<input type="checkbox" name="chk_irrigation_facility" class="cls_batch_chk_irrigation_facility" value="Canal" 
                <?php if((isset($chk_irrigation_facility))) { for($i = 0; $i < sizeof($arr_irrigation_facility); $i++) { if((isset($chk_irrigation_facility)) && $arr_irrigation_facility[$i] == 'Canal') { ?> checked <?php  }  } } ?> > &nbsp;Canal &nbsp;&nbsp;
				<input type="checkbox" name="chk_irrigation_facility" class="cls_batch_chk_irrigation_facility" value="Groundwater" 
                <?php if((isset($chk_irrigation_facility))) { for($i = 0; $i < sizeof($arr_irrigation_facility); $i++) { if((isset($chk_irrigation_facility)) && $arr_irrigation_facility[$i] == 'Groundwater') { ?> checked <?php  }  } } ?> > &nbsp;Groundwater &nbsp;&nbsp;
				<input type="checkbox" name="chk_irrigation_facility" class="cls_batch_chk_irrigation_facility" value="River" 
                <?php if((isset($chk_irrigation_facility))) { for($i = 0; $i < sizeof($arr_irrigation_facility); $i++) { if((isset($chk_irrigation_facility)) && $arr_irrigation_facility[$i] == 'River') { ?> checked <?php  }  } } ?> > &nbsp;River &nbsp;&nbsp;
				<input type="checkbox" name="chk_irrigation_facility" class="cls_batch_chk_irrigation_facility" value="Dam" 
                <?php if((isset($chk_irrigation_facility))) { for($i = 0; $i < sizeof($arr_irrigation_facility); $i++) { if((isset($chk_irrigation_facility)) && $arr_irrigation_facility[$i] == 'Dam') { ?> checked <?php  }  } } ?> > &nbsp;Dam &nbsp;&nbsp;
				<input type="checkbox" name="chk_irrigation_facility" class="cls_batch_chk_irrigation_facility" value="Well" 
                <?php if((isset($chk_irrigation_facility))) { for($i = 0; $i < sizeof($arr_irrigation_facility); $i++) { if((isset($chk_irrigation_facility)) && $arr_irrigation_facility[$i] == 'Well') { ?> checked <?php  }  } } ?> > &nbsp;Well &nbsp;&nbsp;
            </div>
        </div>	<!-- // Irrigation Facilities -->

		<div class="control-group">
            <label for="tasktitel" class="control-label">Other major economic activities in the region <span style="color:#F00">*</span></label>
            <div class="controls">
            	<input type="text" placeholder="Other major economic activities in the region" value="<?php if((isset($major_economic_activity)) && $major_economic_activity != '') { echo $major_economic_activity; } ?>" name="major_economic_activity" id="major_economic_activity" class="input-xxlarge" data-rule-maxlength="255">
            </div>
        </div>	<!-- // Other major economic activities in the region: -->

		<div class="control-group">
            <label for="tasktitel" class="control-label">Education level of the village for Male <span style="color:#F00">*</span></label>
            <div class="controls">
            	<input type="text" placeholder="Education level of the village for Male" value="<?php if((isset($education_male)) && $education_male != '') { echo $education_male; } ?>" name="education_male" id="education_male" class="input-xxlarge" data-rule-maxlength="255">
            </div>
        </div>	<!-- // Education level of the village: Male -->

		<div class="control-group">
            <label for="tasktitel" class="control-label">Education level of the village for Female <span style="color:#F00">*</span></label>
            <div class="controls">
            	<input type="text" placeholder="Education level of the village for Female" value="<?php if((isset($education_female)) && $education_female != '') { echo $education_female; } ?>" name="education_female" id="education_female" class="input-xxlarge" data-rule-maxlength="255">
            </div>
        </div>	<!-- // Education level of the village: Female -->

		<div class="control-group">
            <label for="text" class="control-label" style="margin-top:10px">Road connectivity to the nearest market <span style="color:#F00">*</span></label>
            <div class="controls">
                <input type="checkbox" name="chk_road_connectivity" class="cls_batch_chk_road_connectivity" value="Bad" 
                <?php if((isset($chk_road_connectivity))) { for($i = 0; $i < sizeof($arr_road_connectivity); $i++) { if((isset($chk_road_connectivity)) && $arr_road_connectivity[$i] == 'Bad') { ?> checked <?php  }  } } ?> > &nbsp;Bad &nbsp;&nbsp;
				<input type="checkbox" name="chk_road_connectivity" class="cls_batch_chk_road_connectivity" value="Average" 
                <?php if((isset($chk_road_connectivity))) { for($i = 0; $i < sizeof($arr_road_connectivity); $i++) { if((isset($chk_road_connectivity)) && $arr_road_connectivity[$i] == 'Average') { ?> checked <?php  }  } } ?> > &nbsp;Average &nbsp;&nbsp;
				<input type="checkbox" name="chk_road_connectivity" class="cls_batch_chk_road_connectivity" value="Excellent" 
                <?php if((isset($chk_road_connectivity))) { for($i = 0; $i < sizeof($arr_road_connectivity); $i++) { if((isset($chk_road_connectivity)) && $arr_road_connectivity[$i] == 'Excellent') { ?> checked <?php  }  } } ?> > &nbsp;Excellent &nbsp;&nbsp;
            </div>
        </div>	<!-- // Road connectivity to the nearest market -->

		<div class="control-group">
            <label for="text" class="control-label" style="margin-top:10px">Road Type <span style="color:#F00">*</span></label>
            <div class="controls">
                <input type="checkbox" name="chk_road_type" class="cls_batch_chk_road_type" value="Paved Road" 
                <?php if((isset($chk_road_type))) { for($i = 0; $i < sizeof($arr_road_type); $i++) { if((isset($chk_road_type)) && $arr_road_type[$i] == 'Paved Road') { ?> checked <?php  }  } } ?> > &nbsp;Paved Road &nbsp;&nbsp;
				<input type="checkbox" name="chk_road_type" class="cls_batch_chk_road_type" value="Unpaved Road" 
                <?php if((isset($chk_road_type))) { for($i = 0; $i < sizeof($arr_road_type); $i++) { if((isset($chk_road_type)) && $arr_road_type[$i] == 'Unpaved Road') { ?> checked <?php  }  } } ?> > &nbsp;Unpaved Road &nbsp;&nbsp;
				<input type="checkbox" name="chk_road_type" class="cls_batch_chk_road_type" value="Seasonal Road" 
                <?php if((isset($chk_road_type))) { for($i = 0; $i < sizeof($arr_road_type); $i++) { if((isset($chk_road_type)) && $arr_road_type[$i] == 'Seasonal Road') { ?> checked <?php  }  } } ?> > &nbsp;Seasonal Road &nbsp;&nbsp;
            </div>
        </div>	<!-- // Road Type -->

		<div class="control-group">
            <label for="numberfield" class="control-label">Distance to the nearest market <span style="color:#F00">*</span></label>
        	<div class="controls">
                <input type="text" placeholder="Distance to the nearest market" value="<?php if((isset($distance_nearest_market)) && $distance_nearest_market != '') { echo $distance_nearest_market; } ?>" name="distance_nearest_market" id="distance_nearest_market" maxlength="10"  autocomplete="off"  data-rule-minlength="1"  data-rule-maxlength="10" class="input-xlarge v_number">  Km.    <!-- //data-rule-required="true" -->
                <label id="comp_2" style="color:#FF0000;width:200px;margin-left:100px;"></label>    
            </div>
        </div>	<!-- // Distance to the nearest market -->

		<div class="control-group">
            <label for="text" class="control-label" style="margin-top:10px">What other institutions are there in your area? <span style="color:#F00">*</span></label>
            <div class="controls">
                <input type="checkbox" name="chk_institutions" class="cls_batch_chk_institutions" value="FPC" 
                <?php if((isset($chk_institutions))) { for($i = 0; $i < sizeof($arr_institutions); $i++) { if((isset($chk_institutions)) && $arr_institutions[$i] == 'FPC') { ?> checked <?php  }  } } ?> > &nbsp;FPC &nbsp;&nbsp;
				<input type="checkbox" name="chk_institutions" class="cls_batch_chk_institutions" value="Co-Operative Society" 
                <?php if((isset($chk_institutions))) { for($i = 0; $i < sizeof($arr_institutions); $i++) { if((isset($chk_institutions)) && $arr_institutions[$i] == 'Co-Operative Society') { ?> checked <?php  }  } } ?> > &nbsp;Co-Operative Society &nbsp;&nbsp;
				<input type="checkbox" name="chk_institutions" class="cls_batch_chk_institutions" value="PACS" 
                <?php if((isset($chk_institutions))) { for($i = 0; $i < sizeof($arr_institutions); $i++) { if((isset($chk_institutions)) && $arr_institutions[$i] == 'PACS') { ?> checked <?php  }  } } ?> > &nbsp;PACS &nbsp;&nbsp;
				<input type="checkbox" name="chk_institutions" class="cls_batch_chk_institutions" value="Banks" 
                <?php if((isset($chk_institutions))) { for($i = 0; $i < sizeof($arr_institutions); $i++) { if((isset($chk_institutions)) && $arr_institutions[$i] == 'Banks') { ?> checked <?php  }  } } ?> > &nbsp;Banks &nbsp;&nbsp;
            </div>
        </div>	<!-- // What other institutions are there in your area? -->

		<div class="control-group">
		    <label for="tasktitel" class="control-label">Name them: <span style="color:#F00">*</span></label>
		    <div class="controls">
		    	<input type="text" placeholder="Name them:" value="<?php if((isset($name_of_institution)) && ($name_of_institution != '')) { echo $name_of_institution; } ?>" name="name_of_institution" id="name_of_institution" class="input-xxlarge" data-rule-maxlength="255">
		    </div>
		</div>	<!-- // Name them: -->

		<div class="control-group">
            <label for="text" class="control-label" style="margin-top:10px">Is the FPC Main Office equidistant from the villages covered? <span style="color:#F00">*</span></label>
            <div class="controls">
                <select id="main_office_equidistant" name="main_office_equidistant" class="select2-me input-xlarge" > <!-- data-rule-required="true" -->   
                	<option value="" disabled selected > Select here</option>
                	<option value="yes" <?php if((isset($main_office_equidistant)) && ($main_office_equidistant != '') && ($main_office_equidistant == 'yes')) { ?> selected <?php } ?>> YES</option>
                	<option value="no" <?php if((isset($main_office_equidistant)) && ($main_office_equidistant != '') && ($main_office_equidistant == 'no')) { ?> selected <?php } ?>> NO</option>
                </select>
            </div>
        </div>	<!-- // Is the FPC Main Office equidistant from the villages covered? (Y/N) -->

		<div class="control-group">
            <label for="text" class="control-label" style="margin-top:10px">Is the main office accessible to all the members? <span style="color:#F00">*</span></label>
            <div class="controls">
                <select id="main_office_has_access" name="main_office_has_access" class="select2-me input-xlarge" > <!-- data-rule-required="true" --> 
                	<option value="" disabled selected > Select here</option>
                	<option value="yes" <?php if((isset($main_office_has_access)) && ($main_office_has_access != '') && ($main_office_has_access == 'yes')) { ?> selected <?php } ?>> YES</option>
                	<option value="no" <?php if((isset($main_office_has_access)) && ($main_office_has_access != '') && ($main_office_has_access == 'no')) { ?> selected <?php } ?>> NO</option>
                </select>
            </div>
        </div>	<!-- // Is the main office accessible to all the members? (Y/N) -->

		<div class="control-group">
            <label for="tasktitel" class="control-label">Demographic Composition: Male <span style="color:#F00">*</span></label>
            <div class="controls">
            	<input type="text" placeholder="Demographic Composition: Male" value="<?php if((isset($demographic_composition_male)) && ($demographic_composition_male != '')) { echo $demographic_composition_male; } ?>" name="demographic_composition_male" id="demographic_composition_male" class="input-xxlarge" data-rule-maxlength="255">
            </div>
        </div>	<!-- // Demographic Composition: Male -->

		<div class="control-group">
            <label for="tasktitel" class="control-label">Demographic Composition: Female <span style="color:#F00">*</span></label>
            <div class="controls">
            	<input type="text" placeholder="Demographic Composition: Female" name="demographic_composition_female" id="demographic_composition_female" value="<?php if((isset($demographic_composition_female)) && ($demographic_composition_female != '')) { echo $demographic_composition_female; } ?>" class="input-xxlarge" data-rule-maxlength="255">
            </div>
        </div>	<!-- // Demographic Composition: Female -->

		<div class="control-group">
            <label for="text" class="control-label" style="margin-top:10px">Majority Age Range <span style="color:#F00">*</span></label>
            <div class="controls">
                <select id="majority_age_range" name="majority_age_range" class="select2-me input-xlarge" > <!-- data-rule-required="true" --> 
                	<option value="" disabled selected > Select here</option>
                	<option value="18 to 30" <?php if((isset($majority_age_range)) && ($majority_age_range != '') && ($majority_age_range == '18 to 30')) { ?> selected <?php } ?>> 18 to 30</option>
                	<option value="31 to 45" <?php if((isset($majority_age_range)) && ($majority_age_range != '') && ($majority_age_range == '31 to 45')) { ?> selected <?php } ?>> 31 to 45</option>
                	<option value="46 to 60" <?php if((isset($majority_age_range)) && ($majority_age_range != '') && ($majority_age_range == '46 to 60')) { ?> selected <?php } ?>> 46 to 60</option>
                	<option value="60 above" <?php if((isset($majority_age_range)) && ($majority_age_range != '') && ($majority_age_range == '60 above')) { ?> selected <?php } ?>> 60 above</option>
                </select>
            </div>
        </div>	<!-- // Majority Age Range -->

		<div class="control-group">
            <label for="text" class="control-label" style="margin-top:10px">Education level range <span style="color:#F00">*</span></label>
            <div class="controls">
                <select id="education_level_range" name="education_level_range" class="select2-me input-xlarge" > <!-- data-rule-required="true" -->   
                	<option value="" disabled selected > Select here</option>
                	<option value="Majorly uneducated" <?php if((isset($education_level_range)) && ($education_level_range != '') && ($education_level_range == 'Majorly uneducated')) { ?> selected <?php } ?>> Majorly uneducated</option>
                	<option value="Partially Educated" <?php if((isset($education_level_range)) && ($education_level_range != '') && ($education_level_range == 'Partially Educated')) { ?> selected <?php } ?>> Partially Educated</option>
                	<option value="Majorly Educated" <?php if((isset($education_level_range)) && ($education_level_range != '') && ($education_level_range == 'Majorly Educated')) { ?> selected <?php } ?>> Majorly Educated</option>
                	<option value="Fully Educated" <?php if((isset($education_level_range)) && ($education_level_range != '') && ($education_level_range == 'Fully Educated')) { ?> selected <?php } ?>> Fully Educated</option>
                </select>
            </div>
        </div>	<!-- // Education level range -->

		<div class="form-actions" style="clear:both;">
		    <button id="submit" name="Submit" type="submit" class="btn btn-primary" >Submit</button>&nbsp;&nbsp;
		    <button id="reset" type="button" class="btn" onclick="window.history.back()">Cancel</button>
		</div>	<!-- // Submit -->

	</div>	
</form>

<script type="text/javascript">
	
	// $(document).ready(function() 
	// {
		
	// });

	$('#frm_div_area_profile').on('submit', function(e) 
	{
		e.preventDefault();
		if ($('#frm_div_area_profile').valid())
		{
            // var avg_land_holding = $('#avg_land_holding').val();
            // alert(avg_land_holding);
            // return false;

            var arr_chk_major_castes          = [];
            var arr_chk_irrigation_facility   = [];
            var arr_chk_road_connectivity     = [];
            var arr_chk_road_type             = [];
            var arr_chk_institutions          = [];

            // ===========================================
            // START : major casts
            // ===========================================
            $(".cls_batch_chk_major_castes:checked").each(function ()
            {
                arr_chk_major_castes.push($(this).val());
            });
            // ===========================================
            // END : major casts
            // ===========================================

            // ===========================================
            // START : irrigation facility
            // ===========================================
            $(".cls_batch_chk_irrigation_facility:checked").each(function ()
            {
                arr_chk_irrigation_facility.push($(this).val());
            });
            // ===========================================
            // END : irrigation facility
            // ===========================================  

            // ===========================================
            // START : road connectivity
            // ===========================================
            $(".cls_batch_chk_road_connectivity:checked").each(function ()
            {
                arr_chk_road_connectivity.push($(this).val());
            });
            // ===========================================
            // END : road connectivity
            // ===========================================

            // ===========================================
            // START : road type
            // ===========================================
            $(".cls_batch_chk_road_type:checked").each(function ()
            {
                arr_chk_road_type.push($(this).val());
            });
            // ===========================================
            // END : road type
            // ===========================================  

            // ===========================================
            // START : institutions
            // ===========================================
            $(".cls_batch_chk_institutions:checked").each(function ()
            {
                arr_chk_institutions.push($(this).val());
            });
            // ===========================================
            // END : institutions
            // =========================================== 

            $('#batch_chk_major_castes').val(arr_chk_major_castes);
            $('#batch_chk_irrigation_facility').val(arr_chk_irrigation_facility);
            $('#batch_chk_road_connectivity').val(arr_chk_road_connectivity);
            $('#batch_chk_road_type').val(arr_chk_road_type);
            $('#batch_chk_institutions').val(arr_chk_institutions);         
            
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
					alert(data.Success);
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

    function getAcre(entredVal, parameter, displayID)
    {
        var acreVal     = 0;
        var land_size_hector = 0;
        var land_size_acre   = 0;
        var land_size_guntha = 0;
        
        //alert(parameter);

        if(parameter == 'hector')
        {
            land_size_hector = entredVal * (5/2);
            land_size_acre   = parseInt($('#land_size_acre').val()) || 0;
            land_size_guntha = parseInt($('#land_size_guntha').val()) || 0;
            land_size_guntha = land_size_guntha / 40;

            if(isNaN(land_size_acre) == true)
            {
                land_size_acre = 0;  
            }   

            if(isNaN(land_size_hector) == true)
            {
                land_size_hector = 0;    
            }

            if(isNaN(land_size_guntha) == true)
            {
                land_size_guntha = 0;    
            }

            //alert(acreVal +' = '+ parseInt(land_size_hector) +'<>'+ land_size_acre +'<>'+ land_size_guntha);
            acreVal = parseInt(land_size_hector) + land_size_acre + land_size_guntha;
            //alert(acreVal +' = '+ parseInt(land_size_hector) +'<>'+ land_size_acre +'<>'+ land_size_guntha);
        }
        
        if(parameter == 'acre')
        {
            land_size_hector = parseInt($('#land_size_hector').val()) || 0;
            land_size_hector = land_size_hector * (5/2);
            land_size_guntha = parseInt($('#land_size_guntha').val()) || 0;
            land_size_guntha = land_size_guntha / 40;
            land_size_acre   = parseInt(entredVal);

            if(isNaN(land_size_acre) == true)
            {
                land_size_acre = 0;  
            }   

            if(isNaN(land_size_hector) == true)
            {
                land_size_hector = 0;    
            }

            if(isNaN(land_size_guntha) == true)
            {
                land_size_guntha = 0;    
            }


            //alert(acreVal +' = '+ land_size_hector +'<>'+ parseInt(land_size_acre) +'<>'+ land_size_guntha);
            acreVal = land_size_hector + parseInt(land_size_acre) + land_size_guntha;
            //alert(acreVal +' = '+ land_size_hector +'<>'+ parseInt(land_size_acre) +'<>'+ land_size_guntha);
            //alert(land_size_hector +'<>'+ land_size_acre +'<>'+ land_size_guntha)

        }
        
        if(parameter == 'guntha')
        {
            land_size_hector = parseInt($('#land_size_hector').val()) || 0;
            land_size_hector = land_size_hector * (5/2);
            land_size_acre   = parseInt($('#land_size_acre').val()) || 0;
            land_size_guntha = entredVal / 40;

            if(isNaN(land_size_acre) == true)
            {
                land_size_acre = 0;  
            }   

            if(isNaN(land_size_hector) == true)
            {
                land_size_hector = 0;    
            }

            if(isNaN(land_size_guntha) == true)
            {
                land_size_guntha = 0;    
            }

            //alert(acreVal +' = '+ land_size_hector +'<>'+ land_size_acre +'<>'+ parseInt(land_size_guntha));
            acreVal = land_size_hector + land_size_acre + parseInt(land_size_guntha);
            //alert(acreVal +' = '+ land_size_hector +'<>'+ land_size_acre +'<>'+ parseInt(land_size_guntha));
        }
        
        $('#'+displayID).val(acreVal);
        calTotal_f9();
    }

</script>
<!-- CREATE TABLE tbl_fpo_area_profile
(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	fpo_id INT,
	chk_major_castes  VARCHAR(255),
	avg_land_holding VARCHAR(255),
	major_crops_in_kharif VARCHAR(255),
	major_crops_in_rabi VARCHAR(255),
	major_crops_in_summer VARCHAR(255),
	chk_irrigation_facility VARCHAR(255),
	major_economic_activity VARCHAR(255),
	education_male VARCHAR(255),
	education_female VARCHAR(255),
	chk_road_connectivity VARCHAR(255),
	chk_road_type VARCHAR(255),
	distance_nearest_market VARCHAR(255),
	chk_institutions VARCHAR(255),
	name_of_institution VARCHAR(255),
	main_office_equidistant VARCHAR(255),
	main_office_has_access VARCHAR(255),
	demographic_composition_male VARCHAR(255),
	demographic_composition_female VARCHAR(255),
	majority_age_range VARCHAR(255),
	education_level_range VARCHAR(255),
	status INT,
	created_date DATETIME,
	created_by INT,
	modified_date DATETIME,
	modified_by INT
) -->