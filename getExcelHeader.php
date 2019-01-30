<?php


class excelHeaders{

		public function farmerHeader()
		{
			$header = array(
			'sr_no'                   =>'Sr No.',	
			'fm_org_id'               =>'Org Id',
			'org_name'                =>'Organisation Name',
			'fm_caid'                 =>'CA ID',	
			'ca_name'                 =>'CA Name',	
			'fm_id'                   =>'Farmer Id',		
			'fm_name'                 =>'Farmer Name',
			'f1_father'               =>'Father\'s / Spouse\'s Name',
			'f1_mfname'               => 'Mother Name',
			'f1_dob'                  =>' Date of Birth',
			'f1_age'                  =>'Age',
			'fm_aadhar'               =>'Aadhar Number',
			'fm_mobileno'             =>'Mobile Number',
			'f1_expfarm'              => 'Experience In Farming',
			'f1_any_other_occupation' =>'Any Other Occupation',
			'f1_occupation_amt'       =>'Amount earned annually',
			'fm_loan'                 =>'Any loan required',		
			'fm_amount'               =>'Expected loan amount',
			'f1_loan_purpose'         =>'Loan Purpose ',	
			'f1_crop_cycle'           =>'Crop Cycle for loan required',
			'ddl_married_status'      =>'Is Married',
			'f7_resistatus'           =>'Residence Status',
			'f7_rent_amount'          =>'Rent',
			'fm_status'               =>'Status',
			'fm_createddt'            =>'Added date',						
			);

			return $header;
		}

		public function caddressHeader()
		{
			$header = array(
				'sr_no'        =>'Sr No.',	
				'fm_id'        =>'Farmer Id',	
				'a_type'       =>'Type',	
				'f7_chouse'    =>'House',
				'f7_cstreet'   =>'Street',
				'f7_carea'     =>'Area',
				'f7_cstate'    =>'State',
				'f7_cdistrict' =>'District',
				'f7_ctaluka'   =>'Taluka',
				'f7_cvillage'  =>'Village',
				'f7_cpin'      =>'Pincode',
				'f7_clatlon'   =>'Lat-Lon'
			);

			return $header;
		}

		public function paddressHeader()
		{
			$header = array(
				'sr_no'        =>'Sr No.',	
				'fm_id'        =>'Farmer Id',	
				'a_type'       =>'Type',	
				'f7_phouse'    =>'House',
				'f7_pstreet'   =>'Street',
				'f7_parea'     =>'Area',
				'f7_pstate'    =>'State',
				'f7_pdistrict' =>'District',
				'f7_ptaluka'   =>'Taluka',
				'f7_pvillage'  =>'Village',
				'f7_ppin'      =>'Pincode',
				'f7_platlon'   =>'Lat-Lon'
			);

			return $header;
		}

		public function spouseHeader()
		{
			
			$header = array(
				'sr_no'            =>'Sr No.',	
				'fm_id'            =>'Farmer Id',	
				'ca_name'          =>'CA Name',	
				'f3_spouse_fname'  =>'Spouse Name',
				'f3_spouse_dob'    =>'Date of Birth',
				'f3_spouse_age'    =>'Age',
				'f3_spouse_mobno'  =>'Mobile',
				'f3_spouse_adhno'  =>'Aadhar',
				'f3_spouse_occp'   =>'Occupation',
				'f3_is_fpo_member' =>'Is same Fpo',
				'f3_points'        =>'Points'
			);

			return $header;
			
		}

		function appliKnowHeader()
		{
			$header = array(
			'sr_no'          =>'Sr No.',	
			'fm_id'          =>'Farmer Id',	
			'ca_name'        =>'CA Name',	
			'f2_edudetail'   =>'Education Detail',
			'f2_proficiency' =>'Proficiency',
			'f2_points'      =>'Points'
			);

			return $header;
		}

		function appliPhoneHeader($flag=0)
		{
			$header = array(
				'sr_no'                       =>'Sr No.',	
				'fm_id'                       =>'Farmer Id',	
				'ca_name'                     =>'CA Name',	
				'f5_phonetype'                =>'Phone Type',
				'f5_any_one_have_smart_phone' =>'Any one have smmartphone',
				'f5_servpro'                  =>'Service Providers',
				'f5_network'                  =>'Network',
				'f5_points'                   =>'Points'
			);

			return $header;
		}

		function appliFamilyHeader()
		{
			$header = array(
					'sr_no'       =>'Sr NO.',
					'fm_id'       =>'Farmer Id',
					'f6_children' =>'Childrens',
					'f6_members'  =>'Family Members',
					'f6_points'   =>'Points'
				);

				return $header;
		}

		function applianceHeader($flag=0)
		{
			$header = array(
					'sr_no'           =>'Sr NO.',
					'fm_id'           =>'Farmer Id',
					'f7_television'   =>'Television',
					'f7_refrigerator' =>'Refrigerator',
					'f7_wmachine'     =>'Washing Machine',
					'f7_mixer'        =>'Mixer',
					'f7_stove'        =>'Stove',
					'f7_bicycle'      =>'Bicycle',
					'f7_ccylinder'    =>'Cylinder',
					'f7_fans'         =>'Fans',
					'f7_motorcycle'   =>'Motor Cycle',
					'f7_car'          =>'Car',
					'f7_points'       =>'Points',
					'f7_reg_points'   =>'Reg Points'
				);

				return $header;
		}

		function assetHeader()
		{
			
			$header = array(
				'sr_no'                       =>'Sr NO.',
				'fm_id'                       =>'Farmer Id',
				'f12_TRACTOR'                 =>'Tractor',
				'f12_Sprayer'                 =>'Sprayer',
				'f12_Pumps'                   =>'Pumps',
				'f12_Protavator'              =>'Protavator',
				'f12_Cultivators'             =>'Cultivators',
				'f12_machinery'               =>'Machinery',
				'f12_vehicle'                 =>'Vehicle',
				'f12_total_val_of_vehical'    =>'Total Value of Vehicle',
				'f12_total_val_of_machinery'  =>'Total Value of Machinery',
				'f12_any_other_assets'        =>'Any other assets',
				'f12_name_of_other_assets'    =>'Name of other assets',
				'f12_mention_value_of_assets' =>'Value of assets',
				'f12_points'                  =>'Points'
			);

			return $header;
			
		}

		function livestockHeader($flag=0)
		{
			$header = array(
				'sr_no'                     =>'Sr NO.',
				'fm_id'                     =>'Farmer Id',
				'f13_dairy_cattle'          =>'Dairy Cattle',
				'f13_draft_cattle'          =>'Draft Cattle',
				'f13_buffalo'               =>'Buffalo',
				'f13_ox'                    =>'Ox',
				'f13_sheep'                 =>'Sheep',
				'f13_goat'                  =>'Goat',
				'f13_pig'                   =>'Pig',
				'f13_poultry'               =>'Poultry',
				'f13_donkeys'               =>'Donkeys',
				'f13_livestock_count'       =>'Livestock Count',
				'f13_livestock_income'      =>'Livestock Income / Month',
				'f13_livestock_income_year' =>'Livestock Income / Year',
				'f13_points'                =>'Points'
			);

			return $header;
		}

		function landHeader($flag=0)
		{
			
			$header = array(
				'sr_no'               =>'Sr No.',
				'fm_id'               =>'Farmer Id',
				'f9_land_size'        =>'Land Size',
				'f9_land_size_hector' =>'Land Size in Hector',
				'f9_land_size_acre'   =>'Land Size in Acre',
				'f9_land_size_guntha' =>'Land size in Guntha',
				'f9_owner'            =>'Ownership',
				'f9_amount_on_rent'   =>'Rent Amount',
				'f9_lease_year'       =>'Lease Year',
				'f9_contract_year'    =>'Contract Year',
				'f9_survey_number'    =>'Survey Number',
				'f9_gat_number'       =>'GAT Number',
				'f9_vilage'           =>'Village',
				'f9_taluka'           =>'Taluka',
				'f9_district'         =>'District',
				'f9_state'            =>'State',
				'f9_pincode'          =>'Pincode',
				'f9_lat'              =>'Lat',
				'f9_long'             =>'Long',
				'f9_geo_tag'          =>'Geo Tag',
				'f9_soil_tested'      =>'Is Soil Tested',
				'f9_soil_type'        =>'Soil Type',
				'f9_soil_depth'       =>'Soil Depth',
				'f9_source_of_water'  =>'Sourse of Water',
				'f9_points'           =>'Points',
			);

			return $header;
		}


		function financeHeader()
		{
			$header = array(
				'sr_no'                       =>'Sr No.',
				'fm_id'                       =>'Farmer Id',
				'f8_crop_insurance'           =>'Any Crop Insurance',
				'f8_insurance_amount'         =>'Insurance Amout',
				'f8_insurer_name'             =>'Insurer Name',
				'f8_any_subsidies'            =>'Any Subsidies',
				'f8_subsidy_name'             =>'Subsidy Name',
				'f8_any_loan_waivers'         =>'Any Loan Waivers',
				'f8_waiver_name'              =>'Waiver Name',
				'f8_financial_history_points' =>'Financial History Points'
			);

			return $header;
		}

		function loanHeader()
		{
			$header = array(
				'sr_no'             =>'Sr. No',
				'fm_id'             =>'Farmer Id',
				'fx_monthly_income' =>'Fixed Monthly Income',
				'f8_loan_taken'     =>'Any Loan Taken',
				'f8_points'         =>'Points',
			);

			return $header;
		}

		function loanDetailHeader()
		{
			$header = array(
				'sr_no'            =>'Sr. No',
				'fm_id'            =>'Farmer Id',
				'f8_loan_type'     =>'Loan Type',
				'f8_loan_amount'   =>'Loan Amount',
				'f8_loan_provider' =>'Loan Provider',
				'f8_points'        =>'Points',
			);

			return $header;
		}

		function cropCultHeader()
		{
			$header = array(
				'sr_no'                            =>'Sr No.',
				'fm_id'                            =>'Farmer Id',
				'f10_crop_season'                  =>'Crop Season',
				'f10_crop_type'                    =>'Crop Type',
				'f10_cultivating'                  =>'Cultivating',
				'f10_other_crop_name'              =>'Crop Name',
				'f10_variety'                      =>'Variety',
				'f10_stage'                        =>'Stage',
				'f10_farming_type'                 =>'Farming Type',
				'f10_potential_market'             =>'Potential Market',
				'f10_crop_storage'                 =>'Crop Storage',
				'water_source_name'                =>'Water Source Name',
				'f10_total_hector'                 =>'Total Hector',
				'f10_total_acre'                   =>'Total Acre',
				'f10_total_guntha'                 =>'Total Guntha',
				'f10_total_acrage'                 =>'Total Acrage',
				'f10_harvest_date'                 =>'Harvest Date',
				'f10_expected'                     =>'Expected Yield',
				'f10_expectedprice'                =>'Expected Price',
				'f10_expectedincome'               =>'Expected Income',
				'f10_totalincome'                  =>'Total Income',
				'f10_is_homegrown_seeds'           =>'Is Homegrown Seeds',
				'f10_brand_of_seeds'               =>'Brand of Seeds',
				'f10_seed_type'                    =>'Seed Type',
				'f10_consumption_seeds'            =>'Consumtion Seeds',
				'f10_spend_money'                  =>'Spend Money',
				'f10_brand_of_fertiliser'          =>'Brand of Fertiliser',
				'f10_spend_money_fertiliser'       =>'Money Spend in buying Fertiliser',
				'f10_brand_of_pesticide'           =>'Brand of Pesticide',
				'f10_consumption_pesticides'       =>'Consumption Pesticides',
				'f10_spend_money_pesticide'        =>'Spend money on pesticide',
				'f10_other_inputs_used'            =>'Other inputs used',
				'f10_consumption_other_inputs'     =>'Consumption other inputs',
				'f10_spend_money_other_expenses'   =>'Spend money on other expenses',
				'f10_spend_money_labour'           =>'Spend money on labour',
				'f10_other_farming_expenses'       =>'Other farming expenses',
				'f10_spend_money_farming_expenses' =>'Spend money on  farming expenses',
				'f10_spend_money_total'            =>'Spend money total',
				'f10_total_profit_gained'          =>'Total profit gained',
				'f10_total_profit'                 =>'Total profit',
				'f10_percentage_of_damaged'        =>'Percentage ofdamaged',
				'f10_points'                       => 'Points'
			);

			return $header;
		}

		function yieldHeader()
		{
			$header = array(
				'sr_no'                            =>'Sr No.',
				'fm_id'                            =>'Farmer Id',
				'f11_crop_season'                  =>'Crop Season',
				'f11_crop_type'                    =>'Crop Type',
				'f11_cultivating'                  =>'Cultivating',
				'f11_other_crop_name'              =>'Crop Name',
				'f11_variety'                      =>'Variety',
				'f11_farming_type'                 =>'Farming Type',
				'f11_potential_market'             =>'Potential Market',
				'f11_crop_storage'                 =>'Crop Storage',
				'water_source_name'                =>'Water Source Name',
				'f11_total_hector'                 =>'Total Hector',
				'f11_total_acre'                   =>'Total Acre',
				'f11_total_guntha'                 =>'Total Guntha',
				'f11_total_acrage'                 =>'Total Acrage',
				'f11_harvest_date'                 =>'Harvest Date',
				'f11_expected'                     =>'Expected Yield',
				'f11_expectedprice'                =>'Expected Price',
				'f11_income'                       =>'Expected Income',
				'f11_totalincome'                  =>'Total Income',
				'f11_is_homegrown_seeds'           =>'Is Homegrown Seeds',
				'f11_brand_of_seeds'               =>'Brand of Seeds',
				'f11_seed_type'                    =>'Seed Type',
				'f11_consumption_seeds'            =>'Consumtion Seeds',
				'f11_spend_money'                  =>'Spend Money',
				'f11_brand_of_fertiliser'          =>'Brand of Fertiliser',
				'f11_consumption_fertilizer'       =>'Consumtion Fertiliser',
				'f11_spend_money_fertiliser'       =>'Money Spend in buying Fertiliser',
				'f11_brand_of_pesticide'           =>'Brand of Pesticide',
				'f11_consumption_pesticides'       =>'Consumption Pesticides',
				'f11_spend_money_pesticide'        =>'Spend money on pesticide',
				'f11_brand_of_input_used'          =>'Brand input used',
				'f11_other_inputs_used'            =>'Other inputs used',
				'f11_consumption_other_inputs'     =>'Consumption other inputs',
				'f11_spend_money_other_expenses'   =>'Spend money on other expenses',
				'f11_spend_money_labour'           =>'Spend money on labour',
				'f11_other_farming_expenses'       =>'Other farming expenses',
				'f11_type_other_farming_expenses'  =>'Other Type farming expenses',
				'f11_spend_money_farming_expenses' =>'Spend money on  farming expenses',
				'f11_spend_money_total'            =>'Spend money total',
				'f11_total_profit_gained'          =>'Total profit gained',
				'f11_points'					   => 'Points'
			);

			return $header;
		}

		function forecastHeader()
		{
			$header = array(
				'sr_no'                            =>'Sr No.',
				'fm_id'                            =>'Farmer Id',
				'f14_crop_season'                  =>'Crop Season',
				'f14_crop_type'                    =>'Crop Type',
				'f14_cultivating'                  =>'Cultivating',
				'f14_other_crop_name'              =>'Crop Name',
				'f14_variety'                      =>'Variety',
				'f14_farming_type'                 =>'Farming Type',
				'f14_potential_market'             =>'Potential Market',
				'f14_crop_storage'                 =>'Crop Storage',
				'water_source_name'                =>'Water Source Name',
				'f14_total_hector'                 =>'Total Hector',
				'f14_total_acre'                   =>'Total Acre',
				'f14_total_guntha'                 =>'Total Guntha',
				'f14_total_acrage'                 =>'Total Acrage',
				'f14_harvest_date'                 =>'Harvest Date',
				'f14_expected'                     =>'Expected Yield',
				'f14_expectedprice'                =>'Expected Price',
				'f14_expectedincome'               =>'Expected Income',
				'f14_totalincome'                  =>'Total Income',
				'f14_is_homegrown_seeds'           =>'Is Homegrown Seeds',
				'f14_brand_of_seeds'               =>'Brand of Seeds',
				'f14_seed_type'                    =>'Seed Type',
				'f14_consumption_seeds'            =>'Consumtion Seeds',
				'f14_spend_money'                  =>'Spend Money',
				'f14_brand_of_fertiliser'          =>'Brand of Fertiliser',
				'f14_consumption_fertilizer'       =>'Consumtion Fertiliser',
				'f14_spend_money_fertiliser'       =>'Money Spend in buying Fertiliser',
				'f14_brand_of_pesticide'           =>'Brand of Pesticide',
				'f14_consumption_pesticides'       =>'Consumption Pesticides',
				'f14_spend_money_pesticide'        =>'Spend money on pesticide',
				'f14_brand_of_input_used'          =>'Brand input used',
				'f14_other_inputs_used'            =>'Other inputs used',
				'f14_consumption_other_inputs'     =>'Consumption other inputs',
				'f14_spend_money_other_expenses'   =>'Spend money on other expenses',
				'f14_spend_money_labour'           =>'Spend money on labour',
				'f14_other_farming_expenses'       =>'Other farming expenses',
				'f14_type_other_farming_expenses'  =>'Other Type farming expenses',
				'f14_spend_money_farming_expenses' =>'Spend money on  farming expenses',
				'f14_spend_money_total'            =>'Spend money total',
				'f14_total_profit_gained'          =>'Total profit gained',
				'f14_total_profit'                 =>'Total Profit',
				'f14_points'					   => 'Points'
			);

			return $header;
		}
}


/**
* 
*/
class Filter extends excelHeaders
{
	function filterData($func,$data)
	{
		$columns = $this->$func(1);
		$d       = array();
		foreach($columns as $col)
		{
			$val = $data[$col];
			if($val=='')
			{
				$val = '-';
			}

			array_push($d,ucwords($val));
		}
		return $d;
	}


	function filterExtraHeader($func,$data)
	{
		$columns = $this->$func();
		$header      = array();
		$new_header   = array();

		foreach ($data as $key => $value) {
			
			if(array_key_exists($key,$columns))
			{
				$header[]   = $key;
			}
		}
		
		foreach ($columns as $k=>$v) {
			if(in_array($k,$header))
			{
				$new_header[$columns[$k]]   = 'string';
			}
		}
		
		return $new_header;
	}

	function filterExtraData($func,$data)
	{
		$columns = $this->$func();
		$keys    = array();
		$new_data = array();

		foreach ($data as $key => $value) {
			
			if(array_key_exists($key,$columns))
			{
				array_push($keys,$key);
			}
		}

		foreach ($columns as $k => $v) {
			
			if(in_array($k,$keys))
			{
				array_push($new_data,ucwords($data[$k]));
			}
		}

		return $new_data;
	}
}



?>