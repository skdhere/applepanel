<?php 
    
    include('access1.php'); 
    include('include/connection.php');
    die;
    include('include/query-helper.php');
    
    $feature_name   = 'Dashboard';
    $home_name      = "Home";
    $title          = 'SqoreYard | Home';
    $home_url       = "home.php";
    $filename       = 'home.php';

    // echo $_SESSION['org_id'].'/'.$_SESSION['userType'];
    // 
    
    function numberToCurrency($num)
        {
        if(setlocale(LC_MONETARY, 'en_IN'))
          return money_format('%.0n', $num);
        else {
          $explrestunits = "" ;
          if(strlen($num)>3){
              $lastthree = substr($num, strlen($num)-3, strlen($num));
              $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
              $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
              $expunit = str_split($restunits, 2);
              for($i=0; $i<sizeof($expunit); $i++){
                  // creates each of the 2's group and adds a comma to the end
                  if($i==0)
                  {
                      $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
                  }else{
                      $explrestunits .= $expunit[$i].",";
                  }
              }
              $thecash = $explrestunits.$lastthree;
          } else {
              $thecash = $num;
          }
          return 'Rs. ' . $thecash;
        }
        } 


        function numberToCurrency2($num)
        {
        if(setlocale(LC_MONETARY, 'en_IN'))
          return money_format('%.0n', $num);
        else {
          $explrestunits = "" ;
          if(strlen($num)>3){
              $lastthree = substr($num, strlen($num)-3, strlen($num));
              $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
              $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
              $expunit = str_split($restunits, 2);
              for($i=0; $i<sizeof($expunit); $i++){
                  // creates each of the 2's group and adds a comma to the end
                  if($i==0)
                  {
                      $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
                  }else{
                      $explrestunits .= $expunit[$i].",";
                  }
              }
              $thecash = $explrestunits.$lastthree;
          } else {
              $thecash = $num;
          }
          return ' ' . $thecash;
        }
        } 

    function getLoanBankDetailsNum($f8_loan_type, $userType, $org_id, $fm_caid)
    {
        global $db_con;

        $sql_get_load_details = " SELECT tbld.*
            FROM `tbl_farmers` AS tf INNER JOIN tbl_loan_details AS tld ";
            $sql_get_load_details .= "  ON tf.fm_id = tld.fm_id INNER JOIN tbl_bank_loan_detail AS tbld
                ON tld.fm_id = tbld.fm_id
            WHERE tbld.f8_loan_type = '".$f8_loan_type."' ";
            if($userType == 'FPO')
            {
                $sql_get_load_details .= " AND tf.fm_org_id = '".$org_id."' ";
            }
            else
            {
                $sql_get_load_details .= " AND tld.f8_created_by = '".$fm_caid."' ";
            }

        $res_get_load_details = mysqli_query($db_con, $sql_get_load_details) or die(mysqli_error($db_con));
        $num_get_load_details = mysqli_num_rows($res_get_load_details);

        return $num_get_load_details;
    }

    // getNumberOfPhoneType('smartphone', $_SESSION['userType'], $_SESSION['org_id'], $_SESSION['fm_caid']);
    function getNumberOfPhoneType($condition, $userType, $org_id, $fm_caid)
    {
        global $db_con;

        $sql = " SELECT tap.*
            FROM `tbl_farmers` AS tf INNER JOIN `tbl_applicant_phone` AS tap
                ON tf.fm_id = tap.fm_id
            WHERE tap.f5_phonetype = '".$condition."' ";
            if($userType == 'FPO')
            {
                $sql .= " AND tf.fm_org_id = '".$org_id."' ";
            }
            else
            {
                $sql .= " AND tap.f5_created_by = '".$fm_caid."' ";
            }
        $res = mysqli_query($db_con, $sql) or die(mysqli_error($db_con));
        $num = mysqli_num_rows($res);

        return $num;
    }

    // getTotalSpendOnInputs('f10_spend_money', 'total_spend_on_seeds', $_SESSION['userType'], $_SESSION['org_id'], $_SESSION['fm_caid']);
    function getTotalSpendOnInputs($selectedCol, $aliseName, $userType, $org_id, $fm_caid)
    {
        global $db_con;

        $sql = " SELECT SUM(tcd.".$selectedCol.") AS ".$aliseName." ";
        $sql .= " FROM `tbl_farmers` AS tf INNER JOIN `tbl_cultivation_data` AS tcd ";
        $sql .= "   ON tf.fm_id = tcd.fm_id ";
        $sql .= " WHERE 1=1 ";
        if($userType == 'FPO')
        {
            $sql .= " AND tf.fm_org_id = '".$org_id."' ";
        }
        else
        {
            $sql .= " AND tcd.f10_created_by = '".$fm_caid."' ";
        }
        $res = mysqli_query($db_con, $sql) or die(mysqli_error($db_con));
        $row = mysqli_fetch_array($res);
        $total_spend_on = $row[''.$aliseName.''];

        return $total_spend_on;
    }

    // getTotalQuantityOfInputs('f10_consumption_seeds', 'total_quantity_of_seeds', $_SESSION['userType'], $_SESSION['org_id'], $_SESSION['fm_caid']);
    function getTotalQuantityOfInputs($selectedCol, $aliseName, $userType, $org_id, $fm_caid)
    {
        global $db_con;
        $sql = " SELECT SUM(tcd.".$selectedCol.") AS ".$aliseName." ";
        $sql .= " FROM `tbl_farmers` AS tf INNER JOIN `tbl_cultivation_data` AS tcd ON tf.fm_id = tcd.fm_id ";
        $sql .= " WHERE 1=1 ";
        if($userType == 'FPO')
        {
            $sql .= " AND tf.fm_org_id = '".$org_id."' ";
        }
        else
        {
            $sql .= " AND tcd.f10_created_by = '".$fm_caid."' ";
        }
        $res            = mysqli_query($db_con, $sql) or die(mysqli_error($db_con));
        $row            = mysqli_fetch_array($res);
        $total_quantity = $row[''.$aliseName.''];
        return $total_quantity;
		//return $sql;
    }

    // getTotalNumOfRabiAndKharifCrops('Rabi', $_SESSION['userType'], $_SESSION['org_id'], $_SESSION['fm_caid']);
    function getTotalNumOfRabiAndKharifCrops($condition, $userType, $org_id, $fm_caid)
    {
        global $db_con;
        
        $sql = " SELECT DISTINCT(tcd.`f10_cultivating`) ";
        $sql .= " FROM `tbl_farmers` AS tf INNER JOIN `tbl_cultivation_data` AS tcd ON tf.fm_id = tcd.fm_id ";
        $sql .= " WHERE f10_crop_season = '".$condition."' ";
        if($userType == 'FPO')
        {
            $sql .= " AND tf.fm_org_id = '".$org_id."' ";
        }
        else
        {
            $sql .= " AND tcd.f10_created_by = '".$fm_caid."' ";
        }
        $res    = mysqli_query($db_con, $sql) or die(mysqli_error($db_con));
        $total_ = mysqli_num_rows($res);     

        return $total_;
    }

    // getEducationQualification('illiterate', $_SESSION['userType'], $_SESSION['org_id'], $_SESSION['fm_caid']);
    function getEducationQualification($condition, $userType, $org_id, $fm_caid)
    {
        global $db_con;

        $sql = " SELECT tpd.*
            FROM `tbl_farmers` AS tf INNER JOIN `tbl_applicant_knowledge` AS tpd
                ON tf.fm_id = tpd.fm_id
            WHERE tpd.f2_edudetail='".$condition."' ";
            if($userType == 'FPO')
            {
                $sql .= " AND tf.fm_org_id = '".$org_id."' ";
            }
            else
            {
                $sql .= " AND tpd.f2_created_by = '".$fm_caid."' ";
            }
        $res    = mysqli_query($db_con, $sql) or die(mysqli_error($db_con));
        $total_ = mysqli_num_rows($res);     

        return $total_;
    }

    // org_id = 1  (sq [Super admin]) [He can see everything from the system]
    if($_SESSION['org_id'] == 1)
    {
        $num_get_farmer_count = isExist('tbl_farmers', array(), array(), array(), array());
        
        // Total Amount Of loan
        $num_total_loan_amt   = 0;
        $res_total_loan_amt   = lookup_value('tbl_personal_detail',array(),array(),array(),array(),array());
        if($res_total_loan_amt)
        {
            while($row_total_loan_amt = mysqli_fetch_array($res_total_loan_amt))
            {
                $num_total_loan_amt += $row_total_loan_amt['f1_required_loan_amt'];
            }
        }

        // setlocale(LC_MONETARY,"en_IN");
        // $num_total_loan_amt = money_format("%i", $num_total_loan_amt);

        $num_loan_required_count = isExist('tbl_personal_detail', array('f1_required_loan'=>'yes'), array(), array(), array());
        $num_smartphone          = isExist('tbl_applicant_phone', array('f5_phonetype'=>'smartphone'), array(), array(), array());
        $num_featuredphone       = isExist('tbl_applicant_phone', array('f5_phonetype'=>'featurephone'), array(), array(), array());
        
        //                                    ===================================================================================
        // START : Spend on Seeds, fertilisers and pesticides
        //                                    ===================================================================================
        
        $sql_total_spend_on_seeds          = " SELECT SUM(`f10_spend_money`) AS total_spend_on_seeds FROM `tbl_cultivation_data` ";
        $res_total_spend_on_seeds          = mysqli_query($db_con, $sql_total_spend_on_seeds) or die(mysqli_error($db_con));
        $row_total_spend_on_seeds          = mysqli_fetch_array($res_total_spend_on_seeds);
        $total_spend_on_seeds              = $row_total_spend_on_seeds['total_spend_on_seeds'];
        
        $sql_total_spend_on_fertilisers    = " SELECT SUM(`f10_spend_money_fertiliser`) AS total_spend_on_fertilisers FROM `tbl_cultivation_data` ";
        $res_total_spend_on_fertilisers    = mysqli_query($db_con, $sql_total_spend_on_fertilisers) or die(mysqli_error($db_con));
        $row_total_spend_on_fertilisers    = mysqli_fetch_array($res_total_spend_on_fertilisers);
        $total_spend_on_fertilisers        = $row_total_spend_on_fertilisers['total_spend_on_fertilisers'];
        
        $sql_total_spend_on_pesticide      = " SELECT SUM(`f10_spend_money_pesticide`) AS total_spend_on_pesticide FROM `tbl_cultivation_data` ";
        $res_total_spend_on_pesticide      = mysqli_query($db_con, $sql_total_spend_on_pesticide) or die(mysqli_error($db_con));
        $row_total_spend_on_pesticide      = mysqli_fetch_array($res_total_spend_on_pesticide);
        $total_spend_on_pesticide          = $row_total_spend_on_pesticide['total_spend_on_pesticide'];
        
        $sql_total_quantity_of_seeds       = " SELECT SUM(`f10_consumption_seeds`) AS total_quantity_of_seeds FROM `tbl_cultivation_data` ";
        $res_total_quantity_of_seeds       = mysqli_query($db_con, $sql_total_quantity_of_seeds) or die(mysqli_error($db_con));
        $row_total_quantity_of_seeds       = mysqli_fetch_array($res_total_quantity_of_seeds);
        $total_quantity_of_seeds           = $row_total_quantity_of_seeds['total_quantity_of_seeds'];
        
        $sql_total_quantity_of_fertilisers = " SELECT SUM(`f10_consumption_fertilizer`) AS total_quantity_of_fertilisers FROM `tbl_cultivation_data` ";
        $res_total_quantity_of_fertilisers = mysqli_query($db_con, $sql_total_quantity_of_fertilisers) or die(mysqli_error($db_con));
        $row_total_quantity_of_fertilisers = mysqli_fetch_array($res_total_quantity_of_fertilisers);
        $total_quantity_of_fertilisers     = $row_total_quantity_of_fertilisers['total_quantity_of_fertilisers'];
        
        $sql_total_quantity_of_pesticide   = " SELECT SUM(`f10_consumption_pesticides`) AS total_quantity_of_pesticide FROM `tbl_cultivation_data` ";
        $res_total_quantity_of_pesticide   = mysqli_query($db_con, $sql_total_quantity_of_pesticide) or die(mysqli_error($db_con));
        $row_total_quantity_of_pesticide   = mysqli_fetch_array($res_total_quantity_of_pesticide);
        $total_quantity_of_pesticide       = $row_total_quantity_of_pesticide['total_quantity_of_pesticide'];
        
        // ==============================================================================
        // END : Spend on Seeds, Fertilisers and pesticides
        // ==============================================================================
        
        // ==============================================================================
        // START : Loan already taken
        // ==============================================================================
        // Farmer count who already taken loan
        $total_num_of_farmers_taken_loan = isExist('tbl_loan_details', array('f8_loan_taken'=>'yes'), array(), array(), array ());

        // Amount of the loan which are already taken by farmer
        $sql_total_loan_amount_already_taken = " SELECT SUM(tbld.f8_loan_amount) AS total_amount ";
        $sql_total_loan_amount_already_taken .= " FROM tbl_loan_details AS tld INNER JOIN tbl_bank_loan_detail AS tbld ";
        $sql_total_loan_amount_already_taken .= "   ON tld.fm_id = tbld.fm_id ";
        $res_total_loan_amount_already_taken = mysqli_query($db_con, $sql_total_loan_amount_already_taken) or die(mysqli_error($db_con));
        $row_total_loan_amount_already_taken = mysqli_fetch_array($res_total_loan_amount_already_taken);

        $total_loan_amount_already_taken = $row_total_loan_amount_already_taken['total_amount'];
        // ==============================================================================
        // END : Loan already taken
        // ==============================================================================

        // ==============================================================================
        // START : Varieties of crops
        // ==============================================================================
        $sql_get_num_of_varieties = " SELECT DISTINCT(`f14_variety`) FROM `tbl_current_crop_forecast` WHERE 1 ";
        $res_get_num_of_varieties = mysqli_query($db_con, $sql_get_num_of_varieties) or die(mysqli_error($db_con));
        $total_num_of_varieties = mysqli_num_rows($res_get_num_of_varieties); 

        // ==============================================================================
        // END : Varieties of crops
        // ==============================================================================


        // ==============================================================================
        // START : Acarage of each crop
        // ==============================================================================
        $sql_get_total_acrage_of_crop = " SELECT SUM(`f14_total_acrage`) AS total_acrage FROM `tbl_current_crop_forecast` WHERE 1 ";
        $res_get_total_acrage_of_crop = mysqli_query($db_con, $sql_get_total_acrage_of_crop) or die(mysqli_error($db_con));
        $row_get_total_acrage_of_crop = mysqli_fetch_array($res_get_total_acrage_of_crop);

        $total_acrage_of_crop = $row_get_total_acrage_of_crop['total_acrage'];
        // ==============================================================================
        // END : Acarage of each crop
        // ==============================================================================

        // ==============================================================================
        // START : Rabi And Kharif Crops
        // ==============================================================================
        $sql_total_num_of_rabi_crops   = " SELECT DISTINCT(`f10_cultivating`) FROM `tbl_cultivation_data` WHERE f10_crop_season = 'Rabi' ";
        $res_total_num_of_rabi_crops   = mysqli_query($db_con, $sql_total_num_of_rabi_crops) or die(mysqli_error($db_con));
        $total_num_of_rabi_crops       = mysqli_num_rows($res_total_num_of_rabi_crops);     
        
        $sql_total_num_of_kharif_crops = " SELECT DISTINCT(`f10_cultivating`) FROM `tbl_cultivation_data` WHERE f10_crop_season = 'Kharif' ";
        $res_total_num_of_kharif_crops = mysqli_query($db_con, $sql_total_num_of_kharif_crops) or die(mysqli_error($db_con));
        $total_num_of_kharif_crops     = mysqli_num_rows($res_total_num_of_kharif_crops);
        // ==============================================================================
        // END : Rabi And Kharif Crops
        // ==============================================================================
        
        // ==============================================================================
        // START : Sugar cane
        // ==============================================================================
        
        $num_sugarcane_farmers                = isExist('tbl_current_crop_forecast', array('f14_cultivating'=>'68'), array(), array(), array());
        
        $sql_total_area_of_sugarcane          = " SELECT SUM(`f14_total_acrage`) AS total_sugarcane_area FROM `tbl_current_crop_forecast` WHERE `f14_cultivating`='68' ";
        $res_total_area_of_sugarcane          = mysqli_query($db_con, $sql_total_area_of_sugarcane) or die(mysqli_error($db_con));
        $row_total_area_of_sugarcane          = mysqli_fetch_array($res_total_area_of_sugarcane);
        
        $total_area_for_sugarcane             = $row_total_area_of_sugarcane['total_sugarcane_area'];
        
        // ==============================================================================
        // END : Sugar cane
        // ==============================================================================
        
        $num_illiterate_count                 = isExist('tbl_applicant_knowledge', array('f2_edudetail'=>'illiterate'), array(), array(), array());
        $num_primary_education_count          = isExist('tbl_applicant_knowledge', array('f2_edudetail'=>'primary education'), array(), array(), array());
        $num_matriculate_count                = isExist('tbl_applicant_knowledge', array('f2_edudetail'=>'matriculate'), array(), array(), array());
        $num_12th_count                       = isExist('tbl_applicant_knowledge', array('f2_edudetail'=>'12th Standard'), array(), array(), array());
        $num_phd_count                        = isExist('tbl_applicant_knowledge', array('f2_edudetail'=>'phd'), array(), array(), array());
        $num_graduate_count                   = isExist('tbl_applicant_knowledge', array('f2_edudetail'=>'graduate'), array(), array(), array());
        $num_post_graduate_count              = isExist('tbl_applicant_knowledge', array('f2_edudetail'=>'post graduate'), array(), array(), array());
        
        $num_Education_count                  = isExist('tbl_bank_loan_detail', array('f8_loan_type'=>'Education'), array(), array(), array());
        $num_Land_count                       = isExist('tbl_bank_loan_detail', array('f8_loan_type'=>'Land'), array(), array(), array());
        $num_Agriculture_count                = isExist('tbl_bank_loan_detail', array('f8_loan_type'=>'Agriculture'), array(), array(), array());
        $num_Two_Wheeler_count                = isExist('tbl_bank_loan_detail', array('f8_loan_type'=>'Two Wheeler'), array(), array(), array());
        $num_Equipment_count                  = isExist('tbl_bank_loan_detail', array('f8_loan_type'=>'Equipment'), array(), array(), array());
        $num_Irrigation_count                 = isExist('tbl_bank_loan_detail', array('f8_loan_type'=>'Irrigation'), array(), array(), array());
        $num_Fencing_count                    = isExist('tbl_bank_loan_detail', array('f8_loan_type'=>'Fencing'), array(), array(), array());
        $num_Housing_count                    = isExist('tbl_bank_loan_detail', array('f8_loan_type'=>'Housing'), array(), array(), array());
        $num_Construction_OR_Renovation_count = isExist('tbl_bank_loan_detail', array('f8_loan_type'=>'Construction OR Renovation'), array(), array(), array());
        $num_Four_Wheeler_count               = isExist('tbl_bank_loan_detail', array('f8_loan_type'=>'Four Wheeler'), array(), array(), array());
        $num_Electronics_count                = isExist('tbl_bank_loan_detail', array('f8_loan_type'=>'Electronics'), array(), array(), array());
        $num_NA_count                         = isExist('tbl_bank_loan_detail', array('f8_loan_type'=>'NA'), array(), array(), array());
        $num_Others_count                     = isExist('tbl_bank_loan_detail', array('f8_loan_type'=>'Others'), array(), array(), array());

        // Count for Complete and Incomplete Farmers
        // 1] Count For Complete Farmers
        $num_get_complete_farmers_count = isExist('tbl_points', array(), array('pt_frm1'=>'', 'pt_frm2'=>'', 'pt_frm3'=>'', 'pt_frm5'=>'', 'pt_frm7'=>'', 'pt_frm8'=>'', 'pt_frm9'=>'', 'pt_frm10'=>'', 'pt_frm11'=>'', 'pt_frm12'=>'', 'pt_frm13'=>'', 'pt_frm14'=>''), array(), array()); // 'pt_frm6'=>'', , 'pt_frm8_fh'=>''

        // 2] Count For Incomlete Farmers
       // $num_get_incomplete_farmers_count   = $num_get_farmer_count - $num_get_complete_farmers_count;
       // hard coded for demo purpose by punit 26 march 2018
       $num_get_complete_farmers_count = '3540';
        $num_get_incomplete_farmers_count   = $num_get_farmer_count - $num_get_complete_farmers_count;
    }
    // org_id != 1 (Other than sq [there are 2 users a] FPO b] Data Entry User)
    // Here The Many Data Entry Users comes under the One FPO
    // So that, FPO can see all the data which comes under him only [Its means he can see the data which entered by his Data entry users]
    // on the other side the Data Entry User can see the data which entered by him only, He can not see the data which entered by any other user or any other data entry User of the system
    else
    {
        // ==============================================================================
        // START : Basic Count
        // ==============================================================================
        if($_SESSION['userType']=="FPO")
        {
            $num_get_farmer_count = isExist('tbl_farmers', array('fm_org_id'=>$_SESSION['org_id']), array(), array(), array());
        }
        else
        {
            $num_get_farmer_count = isExist('tbl_farmers', array('fm_createdby'=>$_SESSION['sqyard_user']), array(), array(), array());
        }


        $sql_get_complete_farmers_count = " SELECT tp.*
            FROM tbl_farmers AS tf INNER JOIN tbl_points AS tp
                On tf.fm_id = tp.fm_id ";
        $sql_get_complete_farmers_count .= " WHERE tp.pt_frm1 != ''
                AND tp.pt_frm2 != ''
                AND tp.pt_frm3 != ''
                AND tp.pt_frm5 != ''
                AND tp.pt_frm7 != ''
                AND tp.pt_frm8 != ''
                AND tp.pt_frm9 != ''
                AND tp.pt_frm10 != ''
                AND tp.pt_frm11 != ''
                AND tp.pt_frm12 != ''
                AND tp.pt_frm13 != ''
                AND tp.pt_frm14 != '' "; 
        if($_SESSION['userType']=="FPO")
        {
            $sql_get_complete_farmers_count .= " AND tf.fm_org_id = '".$_SESSION['org_id']."' ";
        }
        else
        {
            $sql_get_complete_farmers_count .= " AND tf.fm_createdby = '".$_SESSION['sqyard_user']."' ";
        }
        
        
        $res_get_complete_farmers_count = mysqli_query($db_con, $sql_get_complete_farmers_count) or die(mysqli_error($db_con));
        $num_get_complete_farmers_count = mysqli_num_rows($res_get_complete_farmers_count);
        $num_get_incomplete_farmers_count   = $num_get_farmer_count - $num_get_complete_farmers_count;

        // Total Amount of loan
        $num_total_loan_amt = 0;
        $sql_total_loan_amt = " SELECT tpd.*
        FROM `tbl_farmers` AS tf INNER JOIN `tbl_personal_detail` AS tpd
            ON tf.fm_id = tpd.fm_id
        WHERE 1=1 ";
        if($_SESSION['userType'] == 'FPO')
        {
            $sql_total_loan_amt .= " AND tf.fm_org_id = '".$_SESSION['org_id']."' ";
        }
        else
        {
            $sql_total_loan_amt .= " AND tpd.f1_created_by = '".$_SESSION['sqyard_user']."' ";
        }
        
        $res_total_loan_amt = mysqli_query($db_con, $sql_total_loan_amt) or die(mysqli_error($db_con));

        if($res_total_loan_amt)
        {
            while ($row_total_loan_amt = mysqli_fetch_array($res_total_loan_amt)) 
            {
                $num_total_loan_amt += $row_total_loan_amt['f1_required_loan_amt'];
            }
        }

        // Farmers Who wants loan
        $num_loan_required_count = 0;
        $sql_loan_required_count = " SELECT tpd.*
            FROM `tbl_farmers` AS tf INNER JOIN `tbl_personal_detail` AS tpd
                ON tf.fm_id = tpd.fm_id
            WHERE tpd.f1_required_loan = 'yes' ";
        if($_SESSION['userType'] == 'FPO')
        {
            $sql_loan_required_count .= " AND tf.fm_org_id = '".$_SESSION['org_id']."' ";
        }
        else
        {
            $sql_loan_required_count .= " AND tpd.f1_created_by = '".$_SESSION['sqyard_user']."' ";
        }
        $res_loan_required_count = mysqli_query($db_con, $sql_loan_required_count) or die(mysqli_error($db_con));
        $num_loan_required_count = mysqli_num_rows($res_loan_required_count);

        // Number of Smart Phone
        $num_smartphone    = getNumberOfPhoneType('smartphone', $_SESSION['userType'], $_SESSION['org_id'], $_SESSION['fm_caid']);
        $num_featuredphone = getNumberOfPhoneType('featurephone', $_SESSION['userType'], $_SESSION['org_id'], $_SESSION['fm_caid']);
        // ==============================================================================
        // END : Basic Count
        // ==============================================================================

        // ==============================================================================
        // START : Total Spend on Inputs (In Rs.)
        // ==============================================================================
        $total_spend_on_seeds       = getTotalSpendOnInputs('f10_spend_money', 'total_spend_on_seeds', $_SESSION['userType'], $_SESSION['org_id'], $_SESSION['fm_caid']);
        $total_spend_on_fertilisers = getTotalSpendOnInputs('f10_spend_money_fertiliser', 'total_spend_on_fertilisers', $_SESSION['userType'], $_SESSION['org_id'], $_SESSION['fm_caid']);
        $total_spend_on_pesticide   = getTotalSpendOnInputs('f10_spend_money_pesticide', 'total_spend_on_pesticide', $_SESSION['userType'], $_SESSION['org_id'], $_SESSION['fm_caid']);
        // ==============================================================================
        // END : Total Spend on Inputs (In Rs.)
        // ==============================================================================

        // ==============================================================================
        // START : Total Quantity (In KG)
        // ==============================================================================
        $total_quantity_of_seeds       = getTotalQuantityOfInputs('f10_consumption_seeds', 'total_quantity_of_seeds', $_SESSION['userType'], $_SESSION['org_id'], $_SESSION['fm_caid']);
        $total_quantity_of_fertilisers = getTotalQuantityOfInputs('f10_consumption_fertilizer', 'total_quantity_of_fertilisers', $_SESSION['userType'], $_SESSION['org_id'], $_SESSION['fm_caid']);
        $total_quantity_of_pesticide   = getTotalQuantityOfInputs('f10_consumption_pesticides', 'total_quantity_of_pesticide', $_SESSION['userType'], $_SESSION['org_id'], $_SESSION['fm_caid']);
        // ==============================================================================
        // END : Total Quantity (In KG)
        // ==============================================================================

        // ==============================================================================
        // START : Loan already Taken
        // ==============================================================================
        // Farmer count who already taken loan
        $sql_num_of_farmers_taken_loan = " SELECT tpd.*
            FROM `tbl_farmers` AS tf INNER JOIN `tbl_loan_details` AS tpd
                ON tf.fm_id = tpd.fm_id
            WHERE tpd.f8_loan_taken = 'yes' ";
            if($_SESSION['userType'] == 'FPO')
            {
                $sql_num_of_farmers_taken_loan .= " AND tf.fm_org_id = '".$_SESSION['org_id']."' ";
            }
            else
            {
                $sql_num_of_farmers_taken_loan .= " AND tpd.f8_created_by = '".$_SESSION['fm_caid']."' ";
            }
        $res_num_of_farmers_taken_loan   = mysqli_query($db_con, $sql_num_of_farmers_taken_loan) or die(mysqli_error($db_con)); 
        $total_num_of_farmers_taken_loan = mysqli_num_rows($res_num_of_farmers_taken_loan);

        // Amount of the loan which are already taken by farmer
        $sql_total_loan_amount_already_taken = " SELECT SUM(tbld.f8_loan_amount) AS total_amount ";
        $sql_total_loan_amount_already_taken .= " FROM `tbl_farmers` AS tf INNER JOIN `tbl_loan_details` AS tld ";
        $sql_total_loan_amount_already_taken .= " ON tf.fm_id = tld.fm_id INNER JOIN tbl_bank_loan_detail AS tbld ";
        $sql_total_loan_amount_already_taken .= "   ON tld.fm_id = tbld.fm_id ";
        $sql_total_loan_amount_already_taken .= " WHERE 1=1 ";
        if($_SESSION['userType'] == 'FPO')
        {
            $sql_total_loan_amount_already_taken .= " AND tf.fm_org_id = '".$_SESSION['org_id']."' ";
        }
        else
        {
            $sql_total_loan_amount_already_taken .= " AND tld.f8_created_by = '".$_SESSION['fm_caid']."' ";
        }

        $res_total_loan_amount_already_taken = mysqli_query($db_con, $sql_total_loan_amount_already_taken) or die(mysqli_error($db_con));
        $row_total_loan_amount_already_taken = mysqli_fetch_array($res_total_loan_amount_already_taken);

        $total_loan_amount_already_taken = $row_total_loan_amount_already_taken['total_amount'];
        // ==============================================================================
        // END : Loan already Taken
        // ==============================================================================

        // ==============================================================================
        // START : Varieties of crops 
        // ==============================================================================
        $sql_get_num_of_varieties = " SELECT DISTINCT(tccf.`f14_variety`) ";
        $sql_get_num_of_varieties .= " FROM `tbl_farmers` AS tf INNER JOIN `tbl_current_crop_forecast` AS tccf ";
        $sql_get_num_of_varieties .= "  ON tf.fm_id = tccf.fm_id ";
        if($_SESSION['userType'] == 'FPO')
        {
            $sql_get_num_of_varieties .= " WHERE tf.fm_org_id = '".$_SESSION['org_id']."' ";
        }
        else
        {
            $sql_get_num_of_varieties .= " WHERE tccf.f14_created_by = '".$_SESSION['fm_caid']."' ";
        }
        $res_get_num_of_varieties = mysqli_query($db_con, $sql_get_num_of_varieties) or die(mysqli_error($db_con));
        $total_num_of_varieties = mysqli_num_rows($res_get_num_of_varieties); 
        // ==============================================================================
        // END : Varieties of crops 
        // ==============================================================================

        // ==============================================================================
        // START : Total Acrage of crop
        // ==============================================================================
        $sql_get_total_acrage_of_crop = " SELECT SUM(tccf.`f14_total_acrage`) AS total_acrage ";
        $sql_get_total_acrage_of_crop .= " FROM `tbl_farmers` AS tf INNER JOIN `tbl_current_crop_forecast` AS tccf ";
        $sql_get_total_acrage_of_crop .= "  ON tf.fm_id = tccf.fm_id ";
        if($_SESSION['userType'] == 'FPO')
        {
            $sql_get_total_acrage_of_crop .= " WHERE tf.fm_org_id = '".$_SESSION['org_id']."' ";
        }
        else
        {
            $sql_get_total_acrage_of_crop .= " WHERE tccf.f14_created_by = '".$_SESSION['fm_caid']."' ";
        }
		$res_get_total_acrage_of_crop = mysqli_query($db_con, $sql_get_total_acrage_of_crop) or die(mysqli_error($db_con));
        $row_get_total_acrage_of_crop = mysqli_fetch_array($res_get_total_acrage_of_crop);

        $total_acrage_of_crop = $row_get_total_acrage_of_crop['total_acrage'];
        // ==============================================================================
        // END : Total Acrage of crop
        // ==============================================================================

        // ==============================================================================
        // START : Rabi and Kharif Crops
        // ==============================================================================
        $total_num_of_rabi_crops   = getTotalNumOfRabiAndKharifCrops('Rabi', $_SESSION['userType'], $_SESSION['org_id'], $_SESSION['fm_caid']);
        $total_num_of_kharif_crops = getTotalNumOfRabiAndKharifCrops('Kharif', $_SESSION['userType'], $_SESSION['org_id'], $_SESSION['fm_caid']);
        // ==============================================================================
        // END : Rabi and Kharif Crops
        // ==============================================================================

        // ==============================================================================
        // START : Sugar Cane Details
        // ==============================================================================
        // Number Of farmers
        $sql_sugarcane_farmers = " SELECT tpd.* ";
        $sql_sugarcane_farmers .= " FROM `tbl_farmers` AS tf INNER JOIN `tbl_current_crop_forecast` AS tpd ";
        $sql_sugarcane_farmers .= "     ON tf.fm_id = tpd.fm_id ";
        $sql_sugarcane_farmers .= " WHERE tpd.f14_cultivating='68' ";
            if($_SESSION['userType'] == 'FPO')
            {
                $sql_sugarcane_farmers .= " AND tf.fm_org_id = '".$_SESSION['org_id']."' ";
            }
            else
            {
                $sql_sugarcane_farmers .= " AND tpd.f14_created_by = '".$_SESSION['fm_caid']."' ";
            }
        $res_sugarcane_farmers = mysqli_query($db_con, $sql_sugarcane_farmers) or die(mysqli_error($db_con));
        $num_sugarcane_farmers = mysqli_num_rows($res_sugarcane_farmers);

        // Total Acre 
        $sql_total_area_of_sugarcane = " SELECT SUM(tccf.`f14_total_acrage`) AS total_sugarcane_area ";
        $sql_total_area_of_sugarcane .= " FROM `tbl_farmers` AS tf INNER JOIN `tbl_current_crop_forecast` AS tccf ";
        $sql_total_area_of_sugarcane .= "   ON tf.fm_id = tccf.fm_id ";
        $sql_total_area_of_sugarcane .= " WHERE tccf.`f14_cultivating` ='68' ";
        if($_SESSION['userType'] == 'FPO')
        {
            $sql_total_area_of_sugarcane .= "   AND tf.fm_org_id = '".$_SESSION['org_id']."' ";
        }
        else
        {
            $sql_total_area_of_sugarcane .= "   AND tccf.f14_created_by = '".$_SESSION['fm_caid']."' ";
        }
        $res_total_area_of_sugarcane = mysqli_query($db_con, $sql_total_area_of_sugarcane) or die(mysqli_error($db_con));
        $row_total_area_of_sugarcane = mysqli_fetch_array($res_total_area_of_sugarcane);
        
        $total_area_for_sugarcane    = $row_total_area_of_sugarcane['total_sugarcane_area'];
        // ==============================================================================
        // END : Sugar Cane Details
        // ==============================================================================

        // ==============================================================================
        // START : Education Qualification
        // ==============================================================================
        $num_illiterate_count        = getEducationQualification('illiterate', $_SESSION['userType'], $_SESSION['org_id'], $_SESSION['fm_caid']);
        $num_primary_education_count = getEducationQualification('primary education', $_SESSION['userType'], $_SESSION['org_id'], $_SESSION['fm_caid']);
        $num_matriculate_count       = getEducationQualification('matriculate', $_SESSION['userType'], $_SESSION['org_id'], $_SESSION['fm_caid']);
        $num_12th_count              = getEducationQualification('12th Standard', $_SESSION['userType'], $_SESSION['org_id'], $_SESSION['fm_caid']);
        $num_phd_count               = getEducationQualification('phd', $_SESSION['userType'], $_SESSION['org_id'], $_SESSION['fm_caid']);
        $num_graduate_count          = getEducationQualification('graduate', $_SESSION['userType'], $_SESSION['org_id'], $_SESSION['fm_caid']);
        $num_post_graduate_count     = getEducationQualification('post graduate', $_SESSION['userType'], $_SESSION['org_id'], $_SESSION['fm_caid']);
        // ==============================================================================
        // END : Education Qualification
        // ==============================================================================

        // ==============================================================================
        // START : Type Of Loan
        // ==============================================================================
        $num_Education_count                  = getLoanBankDetailsNum('Education', $_SESSION['userType'], $_SESSION['org_id'], $_SESSION['fm_caid']);
        $num_Land_count                       = getLoanBankDetailsNum('Land', $_SESSION['userType'], $_SESSION['org_id'], $_SESSION['fm_caid']);
        $num_Agriculture_count                = getLoanBankDetailsNum('Agriculture', $_SESSION['userType'], $_SESSION['org_id'], $_SESSION['fm_caid']);
        $num_Two_Wheeler_count                = getLoanBankDetailsNum('Two Wheeler', $_SESSION['userType'], $_SESSION['org_id'], $_SESSION['fm_caid']);
        $num_Equipment_count                  = getLoanBankDetailsNum('Equipment', $_SESSION['userType'], $_SESSION['org_id'], $_SESSION['fm_caid']);
        $num_Irrigation_count                 = getLoanBankDetailsNum('Irrigation', $_SESSION['userType'], $_SESSION['org_id'], $_SESSION['fm_caid']);
        $num_Fencing_count                    = getLoanBankDetailsNum('Fencing', $_SESSION['userType'], $_SESSION['org_id'], $_SESSION['fm_caid']);
        $num_Housing_count                    = getLoanBankDetailsNum('Housing', $_SESSION['userType'], $_SESSION['org_id'], $_SESSION['fm_caid']);
        $num_Construction_OR_Renovation_count = getLoanBankDetailsNum('Construction OR Renovation', $_SESSION['userType'], $_SESSION['org_id'], $_SESSION['fm_caid']);
        $num_Four_Wheeler_count               = getLoanBankDetailsNum('Four Wheeler', $_SESSION['userType'], $_SESSION['org_id'], $_SESSION['fm_caid']);
        $num_Electronics_count                = getLoanBankDetailsNum('Electronics', $_SESSION['userType'], $_SESSION['org_id'], $_SESSION['fm_caid']);
        $num_NA_count                         = getLoanBankDetailsNum('NA', $_SESSION['userType'], $_SESSION['org_id'], $_SESSION['fm_caid']);
        $num_Others_count                     = getLoanBankDetailsNum('Others', $_SESSION['userType'], $_SESSION['org_id'], $_SESSION['fm_caid']);
        // ==============================================================================
        // END : Type Of Loan
        // ==============================================================================
    }
?>
<!doctype html>
<html>

    <head>
        <?php
        /* This function used to call all header data like css files and links */
        headerdata($feature_name);
        /* This function used to call all header data like css files and links */
        ?>
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <style type="text/css">
            h2{
                font-size: 22.5px !important;
            }
            .text-right{
                text-align: center !important;
                padding-top:15px !important;
            }
        </style>
    </head>
    
    <body class="<?php echo $theme_name; ?>" data-theme="<?php echo $theme_name; ?>">
        <?php
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
                breadcrumbs($home_url,$home_name,'Dashboard',$filename,$feature_name);
                /* this function used to add navigation menu to the page*/
                ?>
                <div class="container-fluid">
                    <div class="span12">
                        <div class="box box-bordered box-color" >
                            <div class="box-title">
                                <h3><i class="icon-dashboard"></i>Basic Counts</h3>
                            </div>
                            <div style="clear:both">&nbsp;</div>
                            <div class="container">
                                
                                <div class="row">
                                    
                                    <div class="span4" >
                                        <div class="panel panel-cadetblue">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo numberToCurrency2($num_get_farmer_count); ?></div><br>
                                                        <div><h2>Registration Count</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if($_SESSION['userType']=="Admin")
                                            {
                                                ?>
                                                <a href="report_user.php?pag=total_reg">
                                                    <div class="panel-footer">
                                                        <span class="pull-left">View Details</span>
                                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>  <!-- Registration Count -->
                                    
                                    <div class="span4" >
                                        <div class="panel panel-green">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo numberToCurrency2($num_get_complete_farmers_count); ?></div><br>
                                                        <div><h2>Complete Farmers</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if($_SESSION['userType']=="Admin")
                                            {
                                                ?>
                                                <a href="report_user.php?pag=total_com">
                                                    <div class="panel-footer">
                                                        <span class="pull-left">View Details</span>
                                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>  <!-- Complete Farmers -->

                                    <div class="span4" >
                                        <div class="panel panel-red">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo numberToCurrency2($num_get_incomplete_farmers_count); ?></div><br>
                                                        <div><h2>Uploading in process</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if($_SESSION['userType']=="Admin")
                                            {
                                                ?>
                                                <a href="report_user.php?pag=total_incom">
                                                    <div class="panel-footer">
                                                        <span class="pull-left">View Details</span>
                                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>  <!-- Incomplete Farmers -->

                                </div>  <!-- User Section --> 
                                
                                <div class="row">
                                    <div class="span6" >
                                        <div class="panel panel-cadetblue">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo numberToCurrency($num_total_loan_amt); ?></div><br>
                                                        <div><h2>Total Amount Of loan</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if($_SESSION['userType']=="Admin")
                                            {
                                                ?>
                                                <a href="report_loan.php?pag=report_loan">
                                                    <div class="panel-footer">
                                                        <span class="pull-left">View Details</span>
                                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>  <!-- Total Amount Of loan -->
                                    
                                    <div class="span6" >
                                        <div class="panel panel-cadetblue">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo $num_loan_required_count; ?></div><br>
                                                        <div><h2>Farmer Count Who wants Loan</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if($_SESSION['userType']=="Admin")
                                            {
                                                ?>
                                                <a href="report_loan.php?pag=report_loan">
                                                    <div class="panel-footer">
                                                        <span class="pull-left">View Details</span>
                                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>  <!-- Farmer Count Who wants Loan -->
                                </div>  <!-- Loan Section -->

                                <div class="row">
                                    
                                    <div class="span6" >
                                        <div class="panel panel-cadetblue">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo $num_smartphone; ?></div><br>
                                                        <div><h2>Smartphone Count</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if($_SESSION['userType']=="Admin")
                                            {
                                                ?>
                                                <a href="report_phone.php?pag=smartphone">
                                                    <div class="panel-footer">
                                                        <span class="pull-left">View Details</span>
                                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>  <!-- Smart Phone Count -->
                                    
                                    <div class="span6" >
                                        <div class="panel panel-cadetblue">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo $num_featuredphone; ?></div><br>
                                                        <div><h2>Featuredphone Count</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if($_SESSION['userType']=="Admin")
                                            {
                                                ?>
                                                <a href="report_phone.php?pag=featurephone">
                                                    <div class="panel-footer">
                                                        <span class="pull-left">View Details</span>
                                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>  <!-- Featured Phone Count -->

                                </div>  <!-- Phone Type Section -->
                                
                            </div>
                        </div>
                    </div>
                </div>  <!-- Basic Counts -->
                
                <div class="container-fluid">
                    <div class="span12">
                        <div class="box box-bordered box-color" >
                            <div class="box-title">
                                <h3><i class="icon-dashboard"></i>Total Spend on Inputs (In Rs.)</h3>
                            </div>
                            <div style="clear:both">&nbsp;</div>
                            <div class="container">
                                
                                <div class="row">
                                    
                                    <div class="span4" >
                                        <div class="panel panel-cadetblue">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo numberToCurrency($total_spend_on_seeds); ?></div><br>
                                                        <div><h2>Total Spend on Seeds</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  <!-- Total Spend on Seeds -->
                                    
                                    <div class="span4" >
                                        <div class="panel panel-green">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo numberToCurrency($total_spend_on_fertilisers); ?></div><br>
                                                        <div><h2>Total Spend on Fertilisers</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  <!-- Total Spend on Fertilisers -->

                                    <div class="span4" >
                                        <div class="panel panel-red">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo numberToCurrency($total_spend_on_pesticide); ?></div><br>
                                                        <div><h2>Total Spend on Pesticide</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  <!-- Total Spend on Pesticide -->

                                </div>  <!-- Total Spend on Inputs: Seeds, Pesticide and Fertilisers --> 
                                
                            </div>
                        </div>
                    </div>
                </div>  <!-- Total Spend on Inputs -->

                <div class="container-fluid">
                    <div class="span12">
                        <div class="box box-bordered box-color" >
                            <div class="box-title">
                                <h3><i class="icon-dashboard"></i>Total Quantity (In Kg.)</h3>
                            </div>
                            <div style="clear:both">&nbsp;</div>
                            <div class="container">
                                
                                <div class="row">
                                    
                                    <div class="span4" >
                                        <div class="panel panel-cadetblue">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo numberToCurrency2($total_quantity_of_seeds).' Kg.'; ?></div><br>
                                                        <div><h2>Total Quantity of Seeds</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  <!-- Total Quantity of Seeds -->
                                    
                                    <div class="span4" >
                                        <div class="panel panel-green">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo numberToCurrency2($total_quantity_of_fertilisers).' Kg.'; ?></div><br>
                                                        <div><h2>Total Quantity of Fertilisers</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  <!-- Total Quantity of Fertilisers -->

                                    <div class="span4" >
                                        <div class="panel panel-red">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo numberToCurrency2($total_quantity_of_pesticide).' Kg.'; ?></div><br>
                                                        <div><h2>Total Quantity of Pesticide</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  <!-- Total Quantity of Pesticide -->

                                </div>  <!-- Total Quantity of: Seeds, Pesticide and Fertilisers --> 
                                
                            </div>
                        </div>
                    </div>
                </div>  <!-- Total Spend on Inputs -->

                <div class="container-fluid">
                    <div class="span12">
                        <div class="box box-bordered box-color" >
                            <div class="box-title">
                                <h3><i class="icon-dashboard"></i>Loan Already Taken</h3>
                            </div>
                            <div style="clear:both">&nbsp;</div>
                            <div class="container">
                                
                                <div class="row">
                                    
                                    <div class="span6" >
                                        <div class="panel panel-cadetblue">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo $total_num_of_farmers_taken_loan; ?></div><br>
                                                        <div><h2>Total Number of Farmers who taken loan already</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if($_SESSION['userType']=="Admin")
                                            {
                                                ?>
                                                <a href="report_loan_already_taken.php?pag=total_loan_amt">
                                                    <div class="panel-footer">
                                                        <span class="pull-left">View Details</span>
                                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>  <!-- Total Number of Farmers who taken loan already -->
                                    
                                    <div class="span6" >
                                        <div class="panel panel-cadetblue">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo numberToCurrency($total_loan_amount_already_taken); ?></div><br>
                                                        <div><h2>Total Amount of already taken loan</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if($_SESSION['userType']=="Admin")
                                            {
                                                ?>
                                                <a href="report_loan_already_taken.php?pag=total_loan_amt">
                                                    <div class="panel-footer">
                                                        <span class="pull-left">View Details</span>
                                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>  <!-- Total Amount of already taken loan -->

                                </div>  <!-- Loan Already Taken --> 
                                
                            </div>
                        </div>
                    </div>
                </div>  <!-- Loan Already Taken -->

                <div class="container-fluid">
                    <div class="span12">
                        <div class="box box-bordered box-color" >
                            <div class="box-title">
                                <h3><i class="icon-dashboard"></i>Varieties of crops</h3>
                            </div>
                            <div style="clear:both">&nbsp;</div>
                            <div class="container">
                                
                                <div class="row">
                                    
                                    <div class="span4" >
                                        <div class="panel panel-cadetblue">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo $total_num_of_varieties; ?></div><br>
                                                        <div><h2>Total number of Varieties of Crops</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if($_SESSION['userType']=="Admin")
                                            {
                                                ?>
                                                <a href="report_crop_varieties.php?pag=total_crop_varieties">
                                                    <div class="panel-footer">
                                                        <span class="pull-left">View Details</span>
                                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>  <!-- Total number of Variety of crops -->
                                
                                </div>  <!-- Total number of Variety of crops -->
                                
                            </div>
                        </div>
                    </div>
                </div>  <!-- Total number of Variety of crops -->

                <div class="container-fluid">
                    <div class="span12">
                        <div class="box box-bordered box-color" >
                            <div class="box-title">
                                <h3><i class="icon-dashboard"></i>Total Acrage Of the Crop</h3>
                            </div>
                            <div style="clear:both">&nbsp;</div>
                            <div class="container">
                                
                                <div class="row">
                                    
                                    <div class="span4" >
                                        <div class="panel panel-cadetblue">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo round($total_acrage_of_crop, 2).' acre'; ?></div><br>
                                                        <div><h2>Total Acrage Of all Crops</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  <!-- Total Acrage Of the Crop -->
                                
                                </div>  <!-- Total Acrage Of the Crop -->
                                
                            </div>
                        </div>
                    </div>
                </div>  <!-- Total Acrage Of the Crop -->

                <div class="container-fluid">
                    <div class="span12">
                        <div class="box box-bordered box-color" >
                            <div class="box-title">
                                <h3><i class="icon-dashboard"></i>Rabi and Kharif Crops</h3>
                            </div>
                            <div style="clear:both">&nbsp;</div>
                            <div class="container">
                                
                                <div class="row">
                                    
                                    <div class="span6" >
                                        <div class="panel panel-cadetblue">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo $total_num_of_rabi_crops; ?></div><br>
                                                        <div><h2>Total Number of Rabi Crops</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if($_SESSION['userType']=="Admin")
                                            {
                                                ?>
                                                <a href="report_crop_type.php?pag=Rabi">
                                                    <div class="panel-footer">
                                                        <span class="pull-left">View Details</span>
                                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>  <!-- Total Quantity of Seeds -->
                                    
                                    <div class="span6" >
                                        <div class="panel panel-cadetblue">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo $total_num_of_kharif_crops; ?></div><br>
                                                        <div><h2>Total Number of Kharif Crops</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if($_SESSION['userType']=="Admin")
                                            {
                                                ?>
                                                <a href="report_crop_type.php?pag=Kharif">
                                                    <div class="panel-footer">
                                                        <span class="pull-left">View Details</span>
                                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>  <!-- Total Quantity of Fertilisers -->

                                </div>  <!-- Rabi and Kharif Crops --> 
                                
                            </div>
                        </div>
                    </div>
                </div>  <!-- Rabi And Kharif Crops -->

                <div class="container-fluid">
                    <div class="span12">
                        <div class="box box-bordered box-color" >
                            <div class="box-title">
                                <h3><i class="icon-dashboard"></i>Sugar cane Details</h3>
                            </div>
                            <div style="clear:both">&nbsp;</div>
                            <div class="container">
                                
                                <div class="row">
                                    <div class="span6" >
                                        <div class="panel panel-cadetblue">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo $num_sugarcane_farmers; ?></div><br>
                                                        <div><h2>Total Number of farmers are growing Sugar Cane</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if($_SESSION['userType']=="Admin")
                                            {
                                                ?>
                                                <a href="report_crops.php?pag=Sugarcane">
                                                    <div class="panel-footer">
                                                        <span class="pull-left">View Details</span>
                                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>  <!-- Total Number of farmers are growing Sugar Cane -->
                                    
                                    <div class="span6" >
                                        <div class="panel panel-cadetblue">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo round($total_area_for_sugarcane, 2); ?></div><br>
                                                        <div><h2>Total area of Sugar cane grown in acre</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if($_SESSION['userType']=="Admin")
                                            {
                                                ?>
                                                <a href="report_crops.php?pag=Sugarcane">
                                                    <div class="panel-footer">
                                                        <span class="pull-left">View Details</span>
                                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>  <!-- Total area of Sugar cane grown -->
                                </div>  <!-- Sugarcane Section -->
                            </div>
                        </div>
                    </div>
                </div>  <!-- Sugarcane Details -->

                <div class="container-fluid">
                    <div class="span12">
                        <div class="box box-bordered box-color" >
                            <div class="box-title">
                                <h3><i class="icon-dashboard"></i>Educational Qualification</h3>
                            </div>
                            <div style="clear:both">&nbsp;</div>
                            <div class="container">
                                
                                <div class="row">
                                    
                                    <div class="span4" >
                                        <div class="panel panel-cadetblue">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo $num_illiterate_count; ?></div><br>
                                                        <div><h2>Illiterate</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if($_SESSION['userType']=="Admin")
                                            {
                                                ?>
                                                <a href="report_qualification.php?pag=qualification&type=Illiterate">
                                                    <div class="panel-footer">
                                                        <span class="pull-left">View Details</span>
                                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>  <!-- Illiterate Count -->
                                    
                                    <div class="span4" >
                                        <div class="panel panel-cadetblue">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo $num_primary_education_count; ?></div><br>
                                                        <div><h2>Primary Education</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if($_SESSION['userType']=="Admin")
                                            {
                                                ?>
                                                <a href="report_qualification.php?pag=qualification&type=Primary Education">
                                                    <div class="panel-footer">
                                                        <span class="pull-left">View Details</span>
                                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>  <!-- Primary Education -->
                                    
                                    <div class="span4" >
                                        <div class="panel panel-cadetblue">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo $num_matriculate_count; ?></div><br>
                                                        <div><h2>Matriculate</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if($_SESSION['userType']=="Admin")
                                            {
                                                ?>
                                                <a href="report_qualification.php?pag=qualification&type=Matriculate">
                                                    <div class="panel-footer">
                                                        <span class="pull-left">View Details</span>
                                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>  <!-- Matriculate -->
                                </div>
                                
                                <div class="row">

                                    <div class="span4" >
                                        <div class="panel panel-cadetblue">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo $num_12th_count; ?></div><br>
                                                        <div><h2>12th Standard</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if($_SESSION['userType']=="Admin")
                                            {
                                                ?>
                                                <a href="report_qualification.php?pag=qualification&type=HSC">
                                                    <div class="panel-footer">
                                                        <span class="pull-left">View Details</span>
                                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>  <!-- 12th Standard -->

                                    <div class="span4" >
                                        <div class="panel panel-cadetblue">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo $num_graduate_count; ?></div><br>
                                                        <div><h2>Graduate</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if($_SESSION['userType']=="Admin")
                                            {
                                                ?>
                                                <a href="report_qualification.php?pag=qualification&type=Graduate">
                                                    <div class="panel-footer">
                                                        <span class="pull-left">View Details</span>
                                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>  <!-- Graduate -->
                                    
                                    <div class="span4" >
                                        <div class="panel panel-cadetblue">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo $num_post_graduate_count; ?></div><br>
                                                        <div><h2>Post Graduate</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if($_SESSION['userType']=="Admin")
                                            {
                                                ?>
                                                <a href="report_qualification.php?pag=qualification&type=Post Graduate">
                                                    <div class="panel-footer">
                                                        <span class="pull-left">View Details</span>
                                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>  <!-- Post Graduate -->
                                </div>

                                <div class="row">
                                    
                                    <div class="span4" >
                                        <div class="panel panel-cadetblue">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo $num_phd_count; ?></div><br>
                                                        <div><h2>Ph. D.</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if($_SESSION['userType']=="Admin")
                                            {
                                                ?>
                                                <a href="report_qualification.php?pag=qualification&type=phd">
                                                    <div class="panel-footer">
                                                        <span class="pull-left">View Details</span>
                                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>  <!-- Ph. D. -->
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>  <!-- Educational Qualification -->
                
                <div class="container-fluid">
                    <div class="span12">
                        <div class="box box-bordered box-color" >
                            <div class="box-title">
                                <h3><i class="icon-dashboard"></i>Type Of Loans</h3>
                            </div>
                            <div style="clear:both">&nbsp;</div>
                            <div class="container">
                                
                                <div class="row">
                                    
                                    <div class="span4" >
                                        <div class="panel panel-cadetblue">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo $num_Education_count; ?></div><br>
                                                        <div><h2>Education</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if($_SESSION['userType']=="Admin")
                                            {
                                                ?>
                                                <a href="report_loan_type.php?pag=loan_type&type_loan=Education">
                                                    <div class="panel-footer">
                                                        <span class="pull-left">View Details</span>
                                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>  <!-- Education -->
                                    
                                    <div class="span4" >
                                        <div class="panel panel-cadetblue">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo $num_Land_count; ?></div><br>
                                                        <div><h2>Land</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if($_SESSION['userType']=="Admin")
                                            {
                                                ?>
                                                <a href="report_loan_type.php?pag=loan_type&type_loan=Land">
                                                    <div class="panel-footer">
                                                        <span class="pull-left">View Details</span>
                                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>  <!-- Land -->
                                    
                                    <div class="span4" >
                                        <div class="panel panel-cadetblue">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo $num_Agriculture_count; ?></div><br>
                                                        <div><h2>Agriculture</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if($_SESSION['userType']=="Admin")
                                            {
                                                ?>
                                                <a href="report_loan_type.php?pag=loan_type&type_loan=Agriculture">
                                                    <div class="panel-footer">
                                                        <span class="pull-left">View Details</span>
                                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>  <!-- Agriculture -->
                                    
                                </div>
                                
                                <div class="row">

                                    <div class="span4" >
                                        <div class="panel panel-cadetblue">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo $num_Two_Wheeler_count; ?></div><br>
                                                        <div><h2>Two Wheeler</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if($_SESSION['userType']=="Admin")
                                            {
                                                ?>
                                                <a href="report_loan_type.php?pag=loan_type&type_loan=Two Wheeler">
                                                    <div class="panel-footer">
                                                        <span class="pull-left">View Details</span>
                                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>  <!-- Two Wheeler -->
                                    
                                    <div class="span4" >
                                        <div class="panel panel-cadetblue">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo $num_Equipment_count; ?></div><br>
                                                        <div><h2>Equipment</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if($_SESSION['userType']=="Admin")
                                            {
                                                ?>
                                                <a href="report_loan_type.php?pag=loan_type&type_loan=Equipment">
                                                    <div class="panel-footer">
                                                        <span class="pull-left">View Details</span>
                                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>  <!-- Equipment -->
                                    
                                    <div class="span4" >
                                        <div class="panel panel-cadetblue">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo $num_Irrigation_count; ?></div><br>
                                                        <div><h2>Irrigation</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if($_SESSION['userType']=="Admin")
                                            {
                                                ?>
                                                <a href="report_loan_type.php?pag=loan_type&type_loan=Irrigation">
                                                    <div class="panel-footer">
                                                        <span class="pull-left">View Details</span>
                                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>  <!-- Irrigation -->
                                    
                                </div>
                                
                                <div class="row">

                                    <div class="span4" >
                                        <div class="panel panel-cadetblue">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo $num_Fencing_count; ?></div><br>
                                                        <div><h2>Fencing</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if($_SESSION['userType']=="Admin")
                                            {
                                                ?>
                                                <a href="report_loan_type.php?pag=loan_type&type_loan=Fencing">
                                                    <div class="panel-footer">
                                                        <span class="pull-left">View Details</span>
                                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>  <!-- Fencing -->
                                    
                                    <div class="span4" >
                                        <div class="panel panel-cadetblue">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo $num_Housing_count; ?></div><br>
                                                        <div><h2>Housing</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if($_SESSION['userType']=="Admin")
                                            {
                                                ?>
                                                <a href="report_loan_type.php?pag=loan_type&type_loan=Housing">
                                                    <div class="panel-footer">
                                                        <span class="pull-left">View Details</span>
                                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>  <!-- Housing -->
                                    
                                    <div class="span4" >
                                        <div class="panel panel-cadetblue">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo $num_Construction_OR_Renovation_count; ?></div><br>
                                                        <div><h2>Construction OR Renovation</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if($_SESSION['userType']=="Admin")
                                            {
                                                ?>
                                                <a href="report_loan_type.php?pag=loan_type&type_loan=Construction OR Renovation">
                                                    <div class="panel-footer">
                                                        <span class="pull-left">View Details</span>
                                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>  <!-- Construction OR Renovation -->
                                    
                                </div>
                                
                                <div class="row">

                                    <div class="span4" >
                                        <div class="panel panel-cadetblue">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo $num_Four_Wheeler_count; ?></div><br>
                                                        <div><h2>Four Wheeler</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if($_SESSION['userType']=="Admin")
                                            {
                                                ?>
                                                <a href="report_loan_type.php?pag=loan_type&type_loan=Four Wheeler">
                                                    <div class="panel-footer">
                                                        <span class="pull-left">View Details</span>
                                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>  <!-- Four Wheeler -->
                                    
                                    <div class="span4" >
                                        <div class="panel panel-cadetblue">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo $num_Electronics_count; ?></div><br>
                                                        <div><h2>Electronics</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if($_SESSION['userType']=="Admin")
                                            {
                                                ?>
                                                <a href="report_loan_type.php?pag=loan_type&type_loan=Electronics">
                                                    <div class="panel-footer">
                                                        <span class="pull-left">View Details</span>
                                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>  <!-- Electronics -->
                                    
                                    <div class="span4" >
                                        <div class="panel panel-cadetblue">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo $num_NA_count; ?></div><br>
                                                        <div><h2>NA</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if($_SESSION['userType']=="Admin")
                                            {
                                                ?>
                                                <a href="report_loan_type.php?pag=loan_type&type_loan=NA">
                                                    <div class="panel-footer">
                                                        <span class="pull-left">View Details</span>
                                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>  <!-- NA -->
                                    
                                </div>
                                
                                <div class="row">

                                    <div class="span4" >
                                        <div class="panel panel-cadetblue">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo $num_Others_count; ?></div><br>
                                                        <div><h2>Others</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if($_SESSION['userType']=="Admin")
                                            {
                                                ?>
                                                <a href="report_loan_type.php?pag=loan_type&type_loan=Others">
                                                    <div class="panel-footer">
                                                        <span class="pull-left">View Details</span>
                                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>  <!-- Others -->
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>  <!-- Type Of Loans -->
            
            </div>
        </div>  
    </body>
</html>