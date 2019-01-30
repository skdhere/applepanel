<?php
    //include('access1.php'); 
    include('../../include/connection.php');

    date_default_timezone_set("Asia/Calcutta");
    $dt=date('Y-m-d H:i:s');
    $temp_dt=date('d F Y');
    //$reforgid=$_REQUEST['reforgid'];


    $sql_farmer = " select a.* from tbl_farmers a, tbl_points b  where a.fm_id=b.fm_id and (b.pt_frm1 !='' AND b.pt_frm2 !='' ";
    $sql_farmer .= "  AND b.pt_frm3 !='' AND b.pt_frm7 !='' AND b.pt_frm8 !='' AND b.pt_frm9 !='' AND b.pt_frm10 !='' AND b.pt_frm5 !='' ";
    $sql_farmer .= "  AND b.pt_frm12 !='' AND b.pt_frm13 !='' AND b.pt_frm11 !='' AND b.pt_frm14 !='') LIMIT 0,2";
    $res_farmer = mysqli_query($db_con, $sql_farmer) or die(mysqli_error($db_con));
    $tot_farmer = mysqli_num_rows($res_farmer);

    if($tot_farmer != 0)
    {
        while($row_farmer = mysqli_fetch_array($res_farmer))
        {
            echo $reforgid = $row_farmer['fm_id'];
            
            $sql_q1   = " SELECT *  
                FROM tbl_farmers AS tf INNER JOIN tbl_personal_detail AS tpd    
                    ON tf.fm_id = tpd.fm_id INNER JOIN tbl_spouse_details AS tsd
                    ON tf.fm_id = tsd.fm_id INNER JOIN tbl_residence_details AS trd
                    ON tf.fm_id = trd.fm_id INNER JOIN tbl_applicant_knowledge AS tak
                    ON tf.fm_id = tak.fm_id INNER JOIN tbl_applicant_phone AS tap
                    ON tf.fm_id = tap.fm_id INNER JOIN tbl_family_details AS tfd
                    ON tf.fm_id = tfd.fm_id INNER JOIN tbl_asset_details AS tad
                    ON tf.fm_id = tad.fm_id INNER JOIN tbl_livestock_details AS tld 
                    ON tf.fm_id = tld.fm_id
                WHERE tf.fm_id = '".$reforgid."' ";
            $res_q1   = mysqli_query($db_con, $sql_q1) or die(mysqli_error($db_con));
            $row_q1   = mysqli_fetch_array($res_q1);
        }
            // // $healthy = array("pat_pis", "pat_sdt", "pat_ccd" ,"pat_scp" , "pat_hc" , "pat_rpt", "pat_ptc", "pat_afd" ,"pat_other");
            // // $yummy   = array("Patient information and safety", "Service delivery time", "Clinical care by doctors", "Staff Courtesy & politeness", "Hygiene & Cleanliness", "Report delivery time", "Post treatment care" ,"Assistance in financial aid","Other");

            // // $newphrase = str_replace($healthy, $yummy, $row_q1['cust_aspect_studied']);

            // // Include the main TCPDF library (search for installation path).
            // require_once('tcpdf_include.php');

            // // create new PDF document
            // $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

            // // set document information
            // $pdf->SetCreator(PDF_CREATOR);
            // $pdf->SetAuthor('Punit Panchal');
            // $pdf->SetTitle($ref_no);
            // $pdf->SetSubject('incomplete Entry');
            // $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

            // $pdf->SetHeaderData('', '', 'Sqoreyard Form','');

            // // set header and footer fonts
            // $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            // $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

            // // set default monospaced font
            // $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            // // set margins
            // $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            // $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            // $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

            // // set auto page breaks
            // $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            // // set image scale factor
            // $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

            // // set some language-dependent strings (optional)
            // if (@file_exists(dirname(__FILE__).'/lang/eng.php')) 
            // {
            //     require_once(dirname(__FILE__).'/lang/eng.php');
            //     $pdf->setLanguageArray($l);
            // }

            // if ($dom[$key]['tag'] AND isset($dom[$key]['attribute']['pagebreak'])) 
            // {
            //     // check for pagebreak
            //     if (($dom[$key]['attribute']['pagebreak'] == 'true') OR ($dom[$key]['attribute']['pagebreak'] == 'left') OR ($dom[$key]['attribute']['pagebreak'] == 'right')) 
            //     {
            //         // add a page (or trig AcceptPageBreak() for multicolumn mode)
            //         $this->checkPageBreak($this->PageBreakTrigger + 1);
            //     }
            //     if ((($dom[$key]['attribute']['pagebreak'] == 'left') AND (((!$this->rtl) AND (($this->page % 2) == 0)) OR (($this->rtl) AND (($this->page % 2) != 0)))) OR (($dom[$key]['attribute']['pagebreak'] == 'right') AND (((!$this->rtl) AND (($this->page % 2) != 0)) OR (($this->rtl) AND (($this->page % 2) == 0))))) 
            //     {
            //         // add a page (or trig AcceptPageBreak() for multicolumn mode)
            //         $this->checkPageBreak($this->PageBreakTrigger + 1);
            //     }
            // }

            // // =====================================================
            // // START : Farmer Info
            // // =====================================================
            // // add a page
            // $pdf->AddPage();
            // // set default header data
            // $html1 = '<p><strong>Section  I - FARMER INFORMATION </strong></p>
            //     <table border="1" cellspacing="2" cellpadding="2" width="662">
            //         <tr>
            //             <td width="255"><br />Name </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['fm_name'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Father\'s / Spouse\'s Name </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f1_father'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Mother\'s Name </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f1_mfname'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Date Of Birth </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f1_dob'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Age [In Year] </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f1_age'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Mobile No </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f1_mobno'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Alternative Mobile No.   </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f1_altno'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Aadhaar No.   </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['fm_aadhar'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Experience In Farming </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f1_expfarm'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Do you have any other occupation? </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f1_any_other_occupation'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />mention the amount earned annually </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f1_occupation_amt'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Do you required a loan?  </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f1_required_loan'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />How much amount of loan you required? </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f1_required_loan_amt'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Loan Purpose </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f1_loan_purpose'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Crop Cycle for loan required </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f1_crop_cycle'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Are You Married? </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f3_married'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Residence Status </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f7_resistatus'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Rent </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f7_rent_amount'].'</p></td>
            //         </tr>
            //     </table>';
            // $pdf->SetFont('helvetica', '', 10);
            // $pdf->writeHTML($html1, true, 0, true, true);
            // // set auto page breaks
            // // =====================================================
            // // END : Farmer Info
            // // =====================================================

            
            // // =====================================================
            // // START : Address Details [Permanent Address]
            // // =====================================================
            // $sql_get_p_address = " SELECT * 
            //     FROM tbl_farmers AS tf INNER JOIN tbl_residence_details AS trd
            //         ON tf.fm_id = trd.fm_id INNER JOIN tbl_state AS state
            //         ON trd.f7_pstate = state.id INNER JOIN tbl_district AS district
            //         ON trd.f7_pdistrict = district.id INNER JOIN tbl_taluka AS taluka
            //         ON trd.f7_ptaluka = taluka.id INNER JOIN tbl_village AS village
            //         ON trd.f7_pvillage = village.id
            //     WHERE tf.fm_id = '".$reforgid."' ";
            // $res_get_p_address = mysqli_query($db_con, $sql_get_p_address) or die(mysqli_error($db_con));
            // $row_get_p_address = mysqli_fetch_array($res_get_p_address);
            // $pdf->AddPage();
            // $html2 = '<p><strong>Section  II - Address Details [Permanent Address] </strong></p>
            //     <table border="1" cellspacing="2" cellpadding="2" width="662">
            //         <tr>
            //             <td width="255"><br />House No. / Address </td>
            //             <td width="406" colspan="4"><p>'.$row_get_p_address['f7_phouse'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Street Name </td>
            //             <td width="406" colspan="4"><p>'.$row_get_p_address['f7_pstreet'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Area Name </td>
            //             <td width="406" colspan="4"><p>'.$row_get_p_address['f7_parea'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />State  </td>
            //             <td width="406" colspan="4"><p>'.$row_get_p_address['st_name'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />District  </td>
            //             <td width="406" colspan="4"><p>'.$row_get_p_address['dt_name'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Taluka  </td>
            //             <td width="406" colspan="4"><p>'.$row_get_p_address['tk_name'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Village Name   </td>
            //             <td width="406" colspan="4"><p>'.$row_get_p_address['vl_name'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Pin-Code  </td>
            //             <td width="406" colspan="4"><p>'.$row_get_p_address['f7_ppin'].'</p></td>
            //         </tr>
            //     </table>';
            // $pdf->SetFont('helvetica', '', 10);
            // $pdf->writeHTML($html2, true, 0, true, true);
            // // =====================================================
            // // END : Address Details [Permanent Address]
            // // =====================================================

            // // =====================================================
            // // START : Address Details [Current Address]
            // // =====================================================
            // $sql_get_c_address = " SELECT * 
            //     FROM tbl_farmers AS tf INNER JOIN tbl_residence_details AS trd
            //         ON tf.fm_id = trd.fm_id INNER JOIN tbl_state AS state
            //         ON trd.f7_cstate = state.id INNER JOIN tbl_district AS district
            //         ON trd.f7_cdistrict = district.id INNER JOIN tbl_taluka AS taluka
            //         ON trd.f7_ctaluka = taluka.id INNER JOIN tbl_village AS village
            //         ON trd.f7_cvillage = village.id
            //     WHERE tf.fm_id = '".$reforgid."' ";
            // $res_get_c_address = mysqli_query($db_con, $sql_get_c_address) or die(mysqli_error($db_con));
            // $row_get_c_address = mysqli_fetch_array($res_get_c_address);
            // $pdf->AddPage();
            // $html3 = '<p><strong>Section  III - Address Details [Current Address] </strong></p>
            //     <table border="1" cellspacing="2" cellpadding="2" width="662">
            //         <tr>
            //             <td width="255"><br />House No. / Address </td>
            //             <td width="406" colspan="4"><p>'.$row_get_c_address['f7_chouse'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Street Name </td>
            //             <td width="406" colspan="4"><p>'.$row_get_c_address['f7_cstreet'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Area Name </td>
            //             <td width="406" colspan="4"><p>'.$row_get_c_address['f7_carea'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />State  </td>
            //             <td width="406" colspan="4"><p>'.$row_get_c_address['st_name'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />District  </td>
            //             <td width="406" colspan="4"><p>'.$row_get_c_address['dt_name'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Taluka  </td>
            //             <td width="406" colspan="4"><p>'.$row_get_c_address['tk_name'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Village Name   </td>
            //             <td width="406" colspan="4"><p>'.$row_get_c_address['vl_name'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Pin-Code  </td>
            //             <td width="406" colspan="4"><p>'.$row_get_c_address['f7_cpin'].'</p></td>
            //         </tr>
            //     </table>';
            // $pdf->SetFont('helvetica', '', 10);
            // $pdf->writeHTML($html3, true, 0, true, true);
            // // =====================================================
            // // END : Address Details [Current Address]
            // // =====================================================

            // // =================================================================
            // // START : Spouse Details [Display Only if Married Status is Yes]
            // // =================================================================
            // if($row_q1['f3_married'] == 'yes')
            // {
            //     // add a page
            //     $pdf->AddPage();
            //     // set default header data
            //     $html4 = '<p><strong>Section  IV - Spouse Details </strong></p>
            //         <table border="1" cellspacing="2" cellpadding="2" width="662">
            //             <tr>
            //                 <td width="255"><br />Spouse Name </td>
            //                 <td width="406" colspan="4"><p>'.$row_q1['f3_spouse_fname'].'</p></td>
            //             </tr>
            //             <tr>
            //                 <td width="255"><br />Spouse Date Of Birth </td>
            //                 <td width="406" colspan="4"><p>'.$row_q1['f3_spouse_dob'].'</p></td>
            //             </tr>
            //             <tr>
            //                 <td width="255"><br />Age </td>
            //                 <td width="406" colspan="4"><p>'.$row_q1['f3_spouse_age'].'</p></td>
            //             </tr>
            //             <tr>
            //                 <td width="255"><br />Mobile no. </td>
            //                 <td width="406" colspan="4"><p>'.$row_q1['f3_spouse_mobno'].'</p></td>
            //             </tr>
            //             <tr>
            //                 <td width="255"><br />Aadhaar no. </td>
            //                 <td width="406" colspan="4"><p>'.$row_q1['f3_spouse_adhno'].'</p></td>
            //             </tr>
            //             <tr>
            //                 <td width="255"><br />Occupation </td>
            //                 <td width="406" colspan="4"><p>'.$row_q1['f3_spouse_occp'].'</p></td>
            //             </tr>
            //             <tr>
            //                 <td width="255"><br />Is the Spouse also member of the same FPO?   </td>
            //                 <td width="406" colspan="4"><p>'.$row_q1['f3_is_fpo_member'].'</p></td>
            //             </tr>
            //         </table>';
            //     $pdf->SetFont('helvetica', '', 10);
            //     $pdf->writeHTML($html4, true, 0, true, true);
            //     // set auto page breaks
            // }
            // // =================================================================
            // // END : Spouse Details [Display Only if Married Status is Yes]
            // // =================================================================

            // // =================================================================
            // // START : Applicant's Knowledge
            // // =================================================================
            // $pdf->AddPage();
            // $html5 = '<p><strong>Section  V - Applicant\'s Knowledge </strong></p>
            //     <table border="1" cellspacing="2" cellpadding="2" width="662">
            //         <tr>
            //             <td width="255"><br />Educational Qualification Details </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f2_edudetail'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Regional Language Knowledge </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f2_proficiency'].'</p></td>
            //         </tr>
            //     </table>';
            // $pdf->SetFont('helvetica', '', 10);
            // $pdf->writeHTML($html5, true, 0, true, true);
            // // =================================================================
            // // END : Applicant's Knowledge
            // // =================================================================

            // // =================================================================
            // // START : Phone Details
            // // =================================================================
            // // Query For getting the List of Multiple Service Provider
            // $sql_get_list_of_serv_provider = " SELECT * FROM `tbl_farmer_servpro` WHERE `fm_id`='".$reforgid."' ";
            // $res_get_list_of_serv_provider = mysqli_query($db_con, $sql_get_list_of_serv_provider) or die(mysqli_error($db_con));
            // $num_get_list_of_serv_provider = mysqli_num_rows($res_get_list_of_serv_provider);

            // $pdf->AddPage();
            // $html5 = '<p><strong>Section  VI - Phone Details </strong></p>
            //     <table border="1" cellspacing="2" cellpadding="2" width="662">
            //         <tr>
            //             <td width="255"><br />Type of phone ownership </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f5_phonetype'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Does any of your family member own a Smart Phone? </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f5_any_one_have_smart_phone'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Who is the service Provider? </td>
            //             <td width="406" colspan="4">';
            //             if($num_get_list_of_serv_provider != 0)
            //             {
            //                 $html5 .= '<ul>';
            //                     while ($row_get_list_of_serv_provider = mysqli_fetch_array($res_get_list_of_serv_provider))
            //                     {
            //                         $html5 .= '<li>'.$row_get_list_of_serv_provider['serv_pro_name'].'</li>';
            //                     }
            //                 $html5 .= '</ul>';
            //             }
            //             $html5 .= '</td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Is the Network Good? </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f5_network'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Do you have Data Pack on your Phone ? </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f5_datapack'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Specify Data pack </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f5_datapackname'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Do you use apps regularly </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f5_appuse'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Specify name of the App </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f5_app_name'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Subscriptions to Farming Advisory Apps? </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f5_farmapp'].'</p></td>
            //         </tr>
            //     </table>';
            // $pdf->SetFont('helvetica', '', 10);
            // $pdf->writeHTML($html5, true, 0, true, true);
            // // =================================================================
            // // END : Phone Details
            // // =================================================================

            // // =================================================================
            // // START : Famity Details
            // // =================================================================
            // $pdf->AddPage();
            // $html6 = '<p><strong>Section  VII - Famity Details </strong></p>
            //     <table border="1" cellspacing="2" cellpadding="2" width="662">
            //         <tr>
            //             <td width="255"><br />How many members are there in your family? </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f6_members'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Number of Children </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f6_children'].'</p></td>
            //         </tr>
            //     </table>';
            // $pdf->SetFont('helvetica', '', 10);
            // $pdf->writeHTML($html6, true, 0, true, true);
            // // =================================================================
            // // END : Famity Details
            // // =================================================================

            // // =================================================================
            // // START : Appliances / Motors
            // // =================================================================
            // $pdf->AddPage();
            // $html7 = '<p><strong>Section  VIII - Appliances / Motors </strong></p>
            //     <table border="1" cellspacing="2" cellpadding="2" width="662">
            //         <tr>
            //             <td width="255"><br />Television  </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f7_television'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Refrigerator </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f7_refrigerator'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Washing Machine </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f7_wmachine'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Mixer </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f7_mixer'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Gas Stove </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f7_stove'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Bicycle </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f7_bicycle'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Cooking Cylinder </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f7_ccylinder'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Lights & Fans </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f7_fans'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Motorcycle </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f7_motorcycle'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Car </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f7_car'].'</p></td>
            //         </tr>
            //     </table>';
            // $pdf->SetFont('helvetica', '', 10);
            // $pdf->writeHTML($html7, true, 0, true, true);
            // // =================================================================
            // // END : Appliances / Motors
            // // =================================================================

            // // =================================================================
            // // START : Farm Land Details
            // // =================================================================
            // $land_details_arr = array();

            // $sql_get_land_details = " SELECT *  FROM `tbl_land_details` WHERE `fm_id` = '".$reforgid."' ";
            // $res_get_land_details = mysqli_query($db_con, $sql_get_land_details) or die(mysqli_error($db_con));
            // $num_get_land_details = mysqli_num_rows($res_get_land_details);

            // if($num_get_land_details != 0)
            // {
            //     while($row_get_land_details = mysqli_fetch_array($res_get_land_details))
            //     {
            //         array_push($land_details_arr, $row_get_land_details);
            //     }
            // }

            // $pdf->AddPage();
            // $html8 = '<p><strong>Section  IX - Farm Land Details </strong></p>';
            //     if($num_get_land_details != 0)
            //     {
            //         $html8 .= '<table border="1" cellspacing="2" cellpadding="2" width="662">
            //                 <tr>
            //                     <th>Fields</th>';
            //                     for($i = 0; $i < sizeof($land_details_arr);$i++ )
            //                     {
            //                         $html8 .= '<th width="406" colspan="4"><p>Farm '.($i+1).'</p></th>';
            //                     }
            //                 $html8 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />Size in Acres  </td>';
            //                     for($i = 0; $i < sizeof($land_details_arr);$i++ )
            //                     {
            //                         $html8 .= '<td width="406" colspan="4"><p>'.$land_details_arr[$i]['f9_land_size'].'</p></td>';
            //                     }
            //                 $html8 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />Ownership </td>';
            //                     for($i = 0; $i < sizeof($land_details_arr);$i++ )
            //                     {
            //                         $html8 .= '<td width="406" colspan="4"><p>'.$land_details_arr[$i]['f9_owner'].'</p></td>';
            //                     }
            //                 $html8 .= '</tr>

            //                 <tr>
            //                     <td width="255"><br />Ownership Value  </td>';
            //                     for($i = 0; $i < sizeof($land_details_arr);$i++ )
            //                     {
            //                         if($land_details_arr[$i]['f9_owner'] == 'Owned')
            //                         {
            //                             $html8 .= '<td width="406" colspan="4"><p></p></td>';
            //                         }
            //                         elseif($land_details_arr[$i]['f9_owner'] == 'Ancestral')
            //                         {
            //                             $html8 .= '<td width="406" colspan="4"><p></p></td>';
            //                         }
            //                         elseif($land_details_arr[$i]['f9_owner'] == 'Rented')
            //                         {
            //                             $html8 .= '<td width="406" colspan="4"><p>'.$land_details_arr[$i]['f9_amount_on_rent'].'  amount per month on rent</p></td>';
            //                         }
            //                         elseif($land_details_arr[$i]['f9_owner'] == 'Contracted') 
            //                         {
            //                             $html8 .= '<td width="406" colspan="4"><p>'.$land_details_arr[$i]['f9_contract_year'].' Contract year</p></td>';
            //                         }
            //                         elseif($land_details_arr[$i]['f9_owner'] == 'Leased')
            //                         {
            //                             $html8 .= '<td width="406" colspan="4"><p>'.$land_details_arr[$i]['f9_lease_year'].' Lease year</p></td>';
            //                         }
            //                     }
            //                 $html8 .= '</tr>

            //                 <tr>
            //                     <td width="255"><br />State  </td>';
            //                     for($i = 0; $i < sizeof($land_details_arr);$i++ )
            //                     {
            //                         // Query For getting the state name
            //                         $sql_get_state = " SELECT * FROM `tbl_state` WHERE `id`='".$land_details_arr[$i]['f9_state']."' ";
            //                         $res_get_state = mysqli_query($db_con, $sql_get_state) or die(mysqli_error($db_con));
            //                         $num_get_state = mysqli_num_rows($res_get_state);

            //                         if($num_get_state != 0)
            //                         {
            //                             $row_get_state = mysqli_fetch_Array($res_get_state);
            //                             $html8 .= '<td width="406" colspan="4"><p>'.$row_get_state['st_name'].'</p></td>';
            //                         }
            //                     }
            //                 $html8 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />District  </td>';
            //                     for($i = 0; $i < sizeof($land_details_arr);$i++ )
            //                     {
            //                         // Query For getting the dist name
            //                         $sql_get_dist = " SELECT * FROM `tbl_district` WHERE `id`='".$land_details_arr[$i]['f9_district']."' ";
            //                         $res_get_dist = mysqli_query($db_con, $sql_get_dist) or die(mysqli_error($db_con));
            //                         $num_get_dist = mysqli_num_rows($res_get_dist);

            //                         if($num_get_dist != 0)
            //                         {
            //                             $row_get_dist = mysqli_fetch_Array($res_get_dist);
            //                             $html8 .= '<td width="406" colspan="4"><p>'.$row_get_dist['dt_name'].'</p></td>';
            //                         }
            //                     }
            //                 $html8 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />Taluka  </td>';
            //                     for($i = 0; $i < sizeof($land_details_arr);$i++ )
            //                     {
            //                         // Query For getting the Taluka name
            //                         $sql_get_tal = " SELECT * FROM `tbl_taluka` WHERE `id`='".$land_details_arr[$i]['f9_taluka']."' ";
            //                         $res_get_tal = mysqli_query($db_con, $sql_get_tal) or die(mysqli_error($db_con));
            //                         $num_get_tal = mysqli_num_rows($res_get_tal);

            //                         if($num_get_tal != 0)
            //                         {
            //                             $row_get_tal = mysqli_fetch_Array($res_get_tal);
            //                             $html8 .= '<td width="406" colspan="4"><p>'.$row_get_tal['tk_name'].'</p></td>';
            //                         }
            //                     }
            //                 $html8 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />Village Name </td>';
            //                     for($i = 0; $i < sizeof($land_details_arr);$i++ )
            //                     {
            //                         // Query For getting the Taluka name
            //                         $sql_get_val = " SELECT * FROM `tbl_village` WHERE `id`='".$land_details_arr[$i]['f9_vilage']."' ";
            //                         $res_get_val = mysqli_query($db_con, $sql_get_val) or die(mysqli_error($db_con));
            //                         $num_get_val = mysqli_num_rows($res_get_val);

            //                         if($num_get_val != 0)
            //                         {
            //                             $row_get_val = mysqli_fetch_Array($res_get_val);
            //                             $html8 .= '<td width="406" colspan="4"><p>'.$row_get_val['vl_name'].'</p></td>';
            //                         }
            //                     }
            //                 $html8 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />Survey Number </td>';
            //                     for($i = 0; $i < sizeof($land_details_arr);$i++ )
            //                     {
            //                         $html8 .= '<td width="406" colspan="4"><p>'.$land_details_arr[$i]['f9_survey_number'].'</p></td>';
            //                     }
            //                 $html8 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />Gat Number </td>';
            //                     for($i = 0; $i < sizeof($land_details_arr);$i++ )
            //                     {
            //                         $html8 .= '<td width="406" colspan="4"><p>'.$land_details_arr[$i]['f9_gat_number'].'</p></td>';
            //                     }
            //                 $html8 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />Pin-Code </td>';
            //                     for($i = 0; $i < sizeof($land_details_arr);$i++ )
            //                     {
            //                         $html8 .= '<td width="406" colspan="4"><p>'.$land_details_arr[$i]['f9_pincode'].'</p></td>';
            //                     }
            //                 $html8 .= '</tr>
                            
            //                 <tr>
            //                     <td width="255"><br />Latitude  </td>';
            //                     for($i = 0; $i < sizeof($land_details_arr);$i++ )
            //                     {
            //                         $html8 .= '<td width="406" colspan="4"><p>'.$land_details_arr[$i]['f9_lat'].'</p></td>';
            //                     }
            //                 $html8 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />longitude </td>';
            //                     for($i = 0; $i < sizeof($land_details_arr);$i++ )
            //                     {
            //                         $html8 .= '<td width="406" colspan="4"><p>'.$land_details_arr[$i]['f9_long'].'</p></td>';
            //                     }
            //                 $html8 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />Type of Soil </td>';
            //                     for($i = 0; $i < sizeof($land_details_arr);$i++ )
            //                     {
            //                         $html8 .= '<td width="406" colspan="4"><p>'.$land_details_arr[$i]['f9_soil_type'].'</p></td>';
            //                     }
            //                 $html8 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />Have you had the soil tested in your land? </td>';
            //                     for($i = 0; $i < sizeof($land_details_arr);$i++ )
            //                     {
            //                         $html8 .= '<td width="406" colspan="4"><p>'.$land_details_arr[$i]['f9_soil_tested'].'</p></td>';
            //                     }
            //                 $html8 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />Soil Depth </td>';
            //                     for($i = 0; $i < sizeof($land_details_arr);$i++ )
            //                     {
            //                         $html8 .= '<td width="406" colspan="4"><p>'.$land_details_arr[$i]['f9_soil_depth'].'</p></td>';
            //                     }
            //                 $html8 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />Source Of Water </td>';
            //                     for($i = 0; $i < sizeof($land_details_arr);$i++ )
            //                     {
            //                         // Query For Getting the Water Source for the respective farmer
            //                         $sql_get_water_source = " SELECT * FROM `tbl_f9_farmer_water_source` WHERE `fm_id`='".$reforgid."' AND `count`='".($i+1)."' ";
            //                         $res_get_water_source = mysqli_query($db_con, $sql_get_water_source) or die(mysqli_error($db_con));
            //                         $num_get_water_source = mysqli_num_rows($res_get_water_source);

            //                         if($num_get_water_source != 0)
            //                         {
            //                             $html8 .= '<td width="406" colspan="4">';
            //                                 $html8 .= '<ul>';
            //                                 while ($row_get_water_source = mysqli_fetch_array($res_get_water_source))
            //                                 {
            //                                     $html8 .= '<li>'.$row_get_water_source['water_source_name'].'</li>';
            //                                 }
            //                                 $html8 .= '</ul>';
            //                             $html8 .= '</td>';
            //                         }

            //                     }
            //                 $html8 .= '</tr>
            //             </table>';
            //     }
            // $pdf->SetFont('helvetica', '', 10);
            // $pdf->writeHTML($html8, true, 0, true, true);
            // // =================================================================
            // // END : Farm Land Details
            // // =================================================================

            // // =================================================================
            // // START : Current Crop Details
            // // =================================================================
            // $current_crop_details_arr = array();

            // $sql_get_current_crop_details = " SELECT tcd.*, tc.crop_name
            //     FROM `tbl_cultivation_data` AS tcd INNER JOIN tbl_crops AS tc
            //         ON tcd.f10_cultivating = tc.crop_id
            //     WHERE tcd.`fm_id` = '".$reforgid."' ";
            // $res_get_current_crop_details = mysqli_query($db_con, $sql_get_current_crop_details) or die(mysqli_error($db_con));
            // $num_get_current_crop_details = mysqli_num_rows($res_get_current_crop_details);

            // if($num_get_current_crop_details != 0)
            // {
            //     while($row_get_current_crop_details = mysqli_fetch_array($res_get_current_crop_details))
            //     {
            //         array_push($current_crop_details_arr, $row_get_current_crop_details);
            //     }
            // }

            // $pdf->AddPage();
            // $html9 = '<p><strong>Section  X - Current Crop Details </strong></p>';
            //     if($num_get_current_crop_details != 0)
            //     {
            //         $html9 .= '<table border="1" cellspacing="2" cellpadding="2" width="662">
            //                 <tr>
            //                     <th>Fields</th>';
            //                     for($i = 0; $i < sizeof($current_crop_details_arr);$i++ )
            //                     {
            //                         $html9 .= '<th width="406" colspan="4"><p>Current Crop '.($i+1).'</p></th>';
            //                     }
            //                 $html9 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />Current Crop Season  </td>';
            //                     for($i = 0; $i < sizeof($current_crop_details_arr);$i++ )
            //                     {
            //                         $html9 .= '<td width="406" colspan="4"><p>'.$current_crop_details_arr[$i]['f10_crop_season'].'</p></td>';
            //                     }
            //                 $html9 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />Type of crop cultivating this year </td>';
            //                     for($i = 0; $i < sizeof($current_crop_details_arr);$i++ )
            //                     {

            //                         $html9 .= '<td width="406" colspan="4"><p>'.$current_crop_details_arr[$i]['crop_name'].'</p></td>';
            //                     }
            //                 $html9 .= '</tr>

            //                 <tr>
            //                     <td width="255"><br />Current Stage Of Crop </td>';
            //                     for($i = 0; $i < sizeof($current_crop_details_arr);$i++ )
            //                     {
            //                         $html9 .= '<td width="406" colspan="4"><p>'.$current_crop_details_arr[$i]['f10_stage'].'</p></td>';
            //                     }
            //                 $html9 .= '</tr>

            //                 <tr>
            //                     <td width="255"><br />Total Yield Expected [Per Acre Per Crop] </td>';
            //                     for($i = 0; $i < sizeof($current_crop_details_arr);$i++ )
            //                     {
            //                         $html9 .= '<td width="406" colspan="4"><p>'.$current_crop_details_arr[$i]['f10_expected'].'</p></td>';
            //                     }
            //                 $html9 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />Potential market </td>';
            //                     for($i = 0; $i < sizeof($current_crop_details_arr);$i++ )
            //                     {
            //                         $html9 .= '<td width="406" colspan="4"><p>'.$current_crop_details_arr[$i]['f10_potential_market'].'</p></td>';
            //                     }
            //                 $html9 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />Crop Storage </td>';
            //                     for($i = 0; $i < sizeof($current_crop_details_arr);$i++ )
            //                     {
            //                         $html9 .= '<td width="406" colspan="4"><p>'.$current_crop_details_arr[$i]['f10_crop_storage'].'</p></td>';
            //                     }
            //                 $html9 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />Expected Price This Year [Per Quintal Per Acre] </td>';
            //                     for($i = 0; $i < sizeof($current_crop_details_arr);$i++ )
            //                     {
            //                         $html9 .= '<td width="406" colspan="4"><p>'.$current_crop_details_arr[$i]['f10_expectedprice'].'</p></td>';
            //                     }
            //                 $html9 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />Total Income Expected This Year [ Per Acre Per Crop ] </td>';
            //                     for($i = 0; $i < sizeof($current_crop_details_arr);$i++ )
            //                     {
            //                         $html9 .= '<td width="406" colspan="4"><p>'.$current_crop_details_arr[$i]['f10_expectedincome'].'</p></td>';
            //                     }
            //                 $html9 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />Potential Crop Damage </td>';
            //                     for($i = 0; $i < sizeof($current_crop_details_arr);$i++ )
            //                     {
            //                         $html9 .= '<td width="406" colspan="4"><p>'.$current_crop_details_arr[$i]['f10_diseases'].'</p></td>';
            //                     }
            //                 $html9 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />Percentage of damaged </td>';
            //                     for($i = 0; $i < sizeof($current_crop_details_arr);$i++ )
            //                     {
            //                         $html9 .= '<td width="406" colspan="4"><p>'.$current_crop_details_arr[$i]['f10_percentage_of_damaged'].'</p></td>';
            //                     }
            //                 $html9 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />How much was the total consumption of Fertilizer in KGs </td>';
            //                     for($i = 0; $i < sizeof($current_crop_details_arr);$i++ )
            //                     {
            //                         $html9 .= '<td width="406" colspan="4"><p>'.$current_crop_details_arr[$i]['f10_consumption_fertilizer'].'</p></td>';
            //                     }
            //                 $html9 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />How much money you spend in buying Fertiliser? </td>';
            //                     for($i = 0; $i < sizeof($current_crop_details_arr);$i++ )
            //                     {
            //                         $html9 .= '<td width="406" colspan="4"><p>'.$current_crop_details_arr[$i]['f10_spend_money_fertiliser'].'</p></td>';
            //                     }
            //                 $html9 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />Brand Of Fertiliser </td>';
            //                     for($i = 0; $i < sizeof($current_crop_details_arr);$i++ )
            //                     {
            //                         $html9 .= '<td width="406" colspan="4"><p>'.$current_crop_details_arr[$i]['f10_brand_of_fertiliser'].'</p></td>';
            //                     }
            //                 $html9 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />How much was the total consumption of Seeds in KGs </td>';
            //                     for($i = 0; $i < sizeof($current_crop_details_arr);$i++ )
            //                     {
            //                         $html9 .= '<td width="406" colspan="4"><p>'.$current_crop_details_arr[$i]['f10_consumption_seeds'].'</p></td>';
            //                     }
            //                 $html9 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />How much money you spend in buying seeds? </td>';
            //                     for($i = 0; $i < sizeof($current_crop_details_arr);$i++ )
            //                     {
            //                         $html9 .= '<td width="406" colspan="4"><p>'.$current_crop_details_arr[$i]['f10_spend_money'].'</p></td>';
            //                     }
            //                 $html9 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />Brand Of Seeds </td>';
            //                     for($i = 0; $i < sizeof($current_crop_details_arr);$i++ )
            //                     {
            //                         $html9 .= '<td width="406" colspan="4"><p>'.$current_crop_details_arr[$i]['f10_brand_of_seeds'].'</p></td>';
            //                     }
            //                 $html9 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />How much was the total consumption of Pesticides in KGs </td>';
            //                     for($i = 0; $i < sizeof($current_crop_details_arr);$i++ )
            //                     {
            //                         $html9 .= '<td width="406" colspan="4"><p>'.$current_crop_details_arr[$i]['f10_consumption_pesticides'].'</p></td>';
            //                     }
            //                 $html9 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />How much money you spend in buying Pesticide? </td>';
            //                     for($i = 0; $i < sizeof($current_crop_details_arr);$i++ )
            //                     {
            //                         $html9 .= '<td width="406" colspan="4"><p>'.$current_crop_details_arr[$i]['f10_spend_money_pesticide'].'</p></td>';
            //                     }
            //                 $html9 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />Brand Of Pesticide </td>';
            //                     for($i = 0; $i < sizeof($current_crop_details_arr);$i++ )
            //                     {
            //                         $html9 .= '<td width="406" colspan="4"><p>'.$current_crop_details_arr[$i]['f10_brand_of_pesticide'].'</p></td>';
            //                     }
            //                 $html9 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />How much was the total consumption of Other Inputs in KGs </td>';
            //                     for($i = 0; $i < sizeof($current_crop_details_arr);$i++ )
            //                     {
            //                         $html9 .= '<td width="406" colspan="4"><p>'.$current_crop_details_arr[$i]['f10_consumption_other_inputs'].'</p></td>';
            //                     }
            //                 $html9 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />How much money you spend in buying Other Expenses? </td>';
            //                     for($i = 0; $i < sizeof($current_crop_details_arr);$i++ )
            //                     {
            //                         $html9 .= '<td width="406" colspan="4"><p>'.$current_crop_details_arr[$i]['f10_spend_money_other_expenses'].'</p></td>';
            //                     }
            //                 $html9 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />How much money you spend in buying Labour? </td>';
            //                     for($i = 0; $i < sizeof($current_crop_details_arr);$i++ )
            //                     {
            //                         $html9 .= '<td width="406" colspan="4"><p>'.$current_crop_details_arr[$i]['f10_spend_money_labour'].'</p></td>';
            //                     }
            //                 $html9 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />Total spend money for this Crop </td>';
            //                     for($i = 0; $i < sizeof($current_crop_details_arr);$i++ )
            //                     {
            //                         $html9 .= '<td width="406" colspan="4"><p>'.$current_crop_details_arr[$i]['f10_spend_money_total'].'</p></td>';
            //                     }
            //                 $html9 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />Total Profit Gained for this crop? </td>';
            //                     for($i = 0; $i < sizeof($current_crop_details_arr);$i++ )
            //                     {
            //                         $html9 .= '<td width="406" colspan="4"><p>'.$current_crop_details_arr[$i]['f10_total_profit_gained'].'</p></td>';
            //                     }
            //                 $html9 .= '</tr>
            //             </table>';
            //     }
            // $pdf->SetFont('helvetica', '', 10);
            // $pdf->writeHTML($html9, true, 0, true, true);
            // // =================================================================
            // // END : Current Crop Details
            // // =================================================================

            // // =================================================================
            // // START : Previous Crop Cycle Details
            // // =================================================================
            // $previous_crop_details_arr = array();

            // $sql_get_previous_crop_details = " SELECT tcd.*, tc.crop_name
            //     FROM `tbl_yield_details` AS tcd INNER JOIN tbl_crops AS tc
            //         ON tcd.f11_cultivating = tc.crop_id
            //     WHERE tcd.`fm_id` = '".$reforgid."' ";
            // $res_get_previous_crop_details = mysqli_query($db_con, $sql_get_previous_crop_details) or die(mysqli_error($db_con));
            // $num_get_previous_crop_details = mysqli_num_rows($res_get_previous_crop_details);

            // if($num_get_previous_crop_details != 0)
            // {
            //     while($row_get_previous_crop_details = mysqli_fetch_array($res_get_previous_crop_details))
            //     {
            //         array_push($previous_crop_details_arr, $row_get_previous_crop_details);
            //     }
            // }

            // $pdf->AddPage();
            // $html10 = '<p><strong>Section  XI - Previous Crop Cycle Details </strong></p>';
            //     if($num_get_previous_crop_details != 0)
            //     {
            //         $html10 .= '<table border="1" cellspacing="2" cellpadding="2" width="662">
            //                 <tr>
            //                     <th>Fields</th>';
            //                     for($i = 0; $i < sizeof($previous_crop_details_arr);$i++ )
            //                     {
            //                         $html10 .= '<th width="406" colspan="4"><p>Previous Crop '.($i+1).'</p></th>';
            //                     }
            //                 $html10 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />Type of crop cultivating previous year </td>';
            //                     for($i = 0; $i < sizeof($previous_crop_details_arr);$i++ )
            //                     {
            //                         $html10 .= '<td width="406" colspan="4"><p>'.$previous_crop_details_arr[$i]['crop_name'].'</p></td>';
            //                     }
            //                 $html10 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />Yield Achieved Last Year In quintals </td>';
            //                     for($i = 0; $i < sizeof($previous_crop_details_arr);$i++ )
            //                     {
                                    
            //                         $html10 .= '<td width="406" colspan="4"><p>'.$previous_crop_details_arr[$i]['f11_achieved'].'</p></td>';
            //                     }
            //                 $html10 .= '</tr>

            //                 <tr>
            //                     <td width="255"><br />Income Achieved Last Year in Rs. </td>';
            //                     for($i = 0; $i < sizeof($previous_crop_details_arr);$i++ )
            //                     {
            //                         $html10 .= '<td width="406" colspan="4"><p>'.$previous_crop_details_arr[$i]['f11_income'].'</p></td>';
            //                     }
            //                 $html10 .= '</tr>

            //                 <tr>
            //                     <td width="255"><br />How much was the total consumption of Fertilizer in KGs </td>';
            //                     for($i = 0; $i < sizeof($previous_crop_details_arr);$i++ )
            //                     {
            //                         $html10 .= '<td width="406" colspan="4"><p>'.$previous_crop_details_arr[$i]['f11_consumption_fertilizer'].'</p></td>';
            //                     }
            //                 $html10 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />How much money you spend in buying Fertiliser? </td>';
            //                     for($i = 0; $i < sizeof($previous_crop_details_arr);$i++ )
            //                     {
            //                         $html10 .= '<td width="406" colspan="4"><p>'.$previous_crop_details_arr[$i]['f11_spend_money_fertiliser'].'</p></td>';
            //                     }
            //                 $html10 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />Brand Of Fertiliser </td>';
            //                     for($i = 0; $i < sizeof($previous_crop_details_arr);$i++ )
            //                     {
            //                         $html10 .= '<td width="406" colspan="4"><p>'.$previous_crop_details_arr[$i]['f11_brand_of_fertiliser'].'</p></td>';
            //                     }
            //                 $html10 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />How much was the total consumption of Seeds in KGs </td>';
            //                     for($i = 0; $i < sizeof($previous_crop_details_arr);$i++ )
            //                     {
            //                         $html10 .= '<td width="406" colspan="4"><p>'.$previous_crop_details_arr[$i]['f11_consumption_seeds'].'</p></td>';
            //                     }
            //                 $html10 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />How much money you spend in buying seeds? </td>';
            //                     for($i = 0; $i < sizeof($previous_crop_details_arr);$i++ )
            //                     {
            //                         $html10 .= '<td width="406" colspan="4"><p>'.$previous_crop_details_arr[$i]['f11_spend_money'].'</p></td>';
            //                     }
            //                 $html10 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />Brand Of Seeds </td>';
            //                     for($i = 0; $i < sizeof($previous_crop_details_arr);$i++ )
            //                     {
            //                         $html10 .= '<td width="406" colspan="4"><p>'.$previous_crop_details_arr[$i]['f11_brand_of_seeds'].'</p></td>';
            //                     }
            //                 $html10 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />How much was the total consumption of Pesticides in KGs </td>';
            //                     for($i = 0; $i < sizeof($previous_crop_details_arr);$i++ )
            //                     {
            //                         $html10 .= '<td width="406" colspan="4"><p>'.$previous_crop_details_arr[$i]['f11_consumption_pesticides'].'</p></td>';
            //                     }
            //                 $html10 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />How much money you spend in buying Pesticide? </td>';
            //                     for($i = 0; $i < sizeof($previous_crop_details_arr);$i++ )
            //                     {
            //                         $html10 .= '<td width="406" colspan="4"><p>'.$previous_crop_details_arr[$i]['f11_spend_money_pesticide'].'</p></td>';
            //                     }
            //                 $html10 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />Brand Of Pesticide </td>';
            //                     for($i = 0; $i < sizeof($previous_crop_details_arr);$i++ )
            //                     {
            //                         $html10 .= '<td width="406" colspan="4"><p>'.$previous_crop_details_arr[$i]['f11_brand_of_pesticide'].'</p></td>';
            //                     }
            //                 $html10 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />How much was the total consumption of Other Inputs in KGs </td>';
            //                     for($i = 0; $i < sizeof($previous_crop_details_arr);$i++ )
            //                     {
            //                         $html10 .= '<td width="406" colspan="4"><p>'.$previous_crop_details_arr[$i]['f11_consumption_other_inputs'].'</p></td>';
            //                     }
            //                 $html10 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />How much money you spend in buying Other Expenses? </td>';
            //                     for($i = 0; $i < sizeof($previous_crop_details_arr);$i++ )
            //                     {
            //                         $html10 .= '<td width="406" colspan="4"><p>'.$previous_crop_details_arr[$i]['f11_spend_money_other_expenses'].'</p></td>';
            //                     }
            //                 $html10 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />How much money you spend in buying Labour? </td>';
            //                     for($i = 0; $i < sizeof($previous_crop_details_arr);$i++ )
            //                     {
            //                         $html10 .= '<td width="406" colspan="4"><p>'.$previous_crop_details_arr[$i]['f11_spend_money_labour'].'</p></td>';
            //                     }
            //                 $html10 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />Total spend money for this Crop </td>';
            //                     for($i = 0; $i < sizeof($previous_crop_details_arr);$i++ )
            //                     {
            //                         $html10 .= '<td width="406" colspan="4"><p>'.$previous_crop_details_arr[$i]['f11_spend_money_total'].'</p></td>';
            //                     }
            //                 $html10 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />Total Profit Gained for this crop? </td>';
            //                     for($i = 0; $i < sizeof($previous_crop_details_arr);$i++ )
            //                     {
            //                         $html10 .= '<td width="406" colspan="4"><p>'.$previous_crop_details_arr[$i]['f11_total_profit_gained'].'</p></td>';
            //                     }
            //                 $html10 .= '</tr>
            //             </table>';
            //     }
            // $pdf->SetFont('helvetica', '', 10);
            // $pdf->writeHTML($html10, true, 0, true, true);
            // // =================================================================
            // // END : Previous Crop Cycle Details
            // // =================================================================

            // // =================================================================
            // // START : Future Crop Cycle Forecast 
            // // =================================================================
            // $future_crop_details_arr = array();

            // $sql_get_future_crop_details = " SELECT tcd.*, tc.crop_name, tcv.variety_name
            //     FROM `tbl_current_crop_forecast` AS tcd INNER JOIN tbl_crops AS tc
            //         ON tcd.f14_cultivating = tc.crop_id INNER JOIN tbl_crop_varieties As tcv
            //         ON tcd.f14_variety = tcv.variety_id
            //     WHERE tcd.`fm_id` = '".$reforgid."' ";
            // $res_get_future_crop_details = mysqli_query($db_con, $sql_get_future_crop_details) or die(mysqli_error($db_con));
            // $num_get_future_crop_details = mysqli_num_rows($res_get_future_crop_details);

            // if($num_get_future_crop_details != 0)
            // {
            //     while($row_get_future_crop_details = mysqli_fetch_array($res_get_future_crop_details))
            //     {
            //         array_push($future_crop_details_arr, $row_get_future_crop_details);
            //     }
            // }

            // $pdf->AddPage();
            // $html11 = '<p><strong>Section  XII - Future Crop Cycle Forecast </strong></p>';
            //     if($num_get_future_crop_details != 0)
            //     {
            //         $html11 .= '<table border="1" cellspacing="2" cellpadding="2" width="662">
            //                 <tr>
            //                     <th>Fields</th>';
            //                     for($i = 0; $i < sizeof($future_crop_details_arr);$i++ )
            //                     {
            //                         $html11 .= '<th width="406" colspan="4"><p>Future Crop '.($i+1).'</p></th>';
            //                     }
            //                 $html11 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />What type of crop planned? </td>';
            //                     for($i = 0; $i < sizeof($future_crop_details_arr);$i++ )
            //                     {
            //                         $html11 .= '<td width="406" colspan="4"><p>'.$future_crop_details_arr[$i]['f14_crop_type'].'</p></td>';
            //                     }
            //                 $html11 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />Type Of Crop Cultivating This Year </td>';
            //                     for($i = 0; $i < sizeof($future_crop_details_arr);$i++ )
            //                     {
                                    
            //                         $html11 .= '<td width="406" colspan="4"><p>'.$future_crop_details_arr[$i]['crop_name'].'</p></td>';
            //                     }
            //                 $html11 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />Variety </td>';
            //                     for($i = 0; $i < sizeof($future_crop_details_arr);$i++ )
            //                     {
            //                         $html11 .= '<td width="406" colspan="4"><p>'.$future_crop_details_arr[$i]['variety_name'].'</p></td>';
            //                     }
            //                 $html11 .= '</tr>

            //                 <tr>
            //                     <td width="255"><br />In How many acres did you sow the crops 1? </td>';
            //                     for($i = 0; $i < sizeof($future_crop_details_arr);$i++ )
            //                     {
            //                         $html11 .= '<td width="406" colspan="4"><p>'.$future_crop_details_arr[$i]['f14_total_acrage'].'</p></td>';
            //                     }
            //                 $html11 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />Expected Yield </td>';
            //                     for($i = 0; $i < sizeof($future_crop_details_arr);$i++ )
            //                     {
            //                         $html11 .= '<td width="406" colspan="4"><p>'.$future_crop_details_arr[$i]['f14_expected_yeild'].'</p></td>';
            //                     }
            //                 $html11 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />What type of seeds you plan to buy? </td>';
            //                     for($i = 0; $i < sizeof($future_crop_details_arr);$i++ )
            //                     {
            //                         $html11 .= '<td width="406" colspan="4"><p>'.$future_crop_details_arr[$i]['f14_seed_type'].'</p></td>';
            //                     }
            //                 $html11 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />How much was the total consumption of Fertilizer in KGs </td>';
            //                     for($i = 0; $i < sizeof($future_crop_details_arr);$i++ )
            //                     {
            //                         $html11 .= '<td width="406" colspan="4"><p>'.$future_crop_details_arr[$i]['f14_consumption_fertilizer'].'</p></td>';
            //                     }
            //                 $html11 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />How much money you spend in buying Fertiliser? </td>';
            //                     for($i = 0; $i < sizeof($future_crop_details_arr);$i++ )
            //                     {
            //                         $html11 .= '<td width="406" colspan="4"><p>'.$future_crop_details_arr[$i]['f14_spend_money_fertiliser'].'</p></td>';
            //                     }
            //                 $html11 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />Brand Of Fertiliser </td>';
            //                     for($i = 0; $i < sizeof($future_crop_details_arr);$i++ )
            //                     {
            //                         $html11 .= '<td width="406" colspan="4"><p>'.$future_crop_details_arr[$i]['f14_brand_of_fertiliser'].'</p></td>';
            //                     }
            //                 $html11 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />How much was the total consumption of Seeds in KGs </td>';
            //                     for($i = 0; $i < sizeof($future_crop_details_arr);$i++ )
            //                     {
            //                         $html11 .= '<td width="406" colspan="4"><p>'.$future_crop_details_arr[$i]['f14_consumption_seeds'].'</p></td>';
            //                     }
            //                 $html11 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />How much money you spend in buying seeds? </td>';
            //                     for($i = 0; $i < sizeof($future_crop_details_arr);$i++ )
            //                     {
            //                         $html11 .= '<td width="406" colspan="4"><p>'.$future_crop_details_arr[$i]['f14_spend_money'].'</p></td>';
            //                     }
            //                 $html11 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />Brand Of Seeds </td>';
            //                     for($i = 0; $i < sizeof($future_crop_details_arr);$i++ )
            //                     {
            //                         $html11 .= '<td width="406" colspan="4"><p>'.$future_crop_details_arr[$i]['f14_brand_of_seeds'].'</p></td>';
            //                     }
            //                 $html11 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />How much was the total consumption of Pesticides in KGs </td>';
            //                     for($i = 0; $i < sizeof($future_crop_details_arr);$i++ )
            //                     {
            //                         $html11 .= '<td width="406" colspan="4"><p>'.$future_crop_details_arr[$i]['f14_consumption_pesticides'].'</p></td>';
            //                     }
            //                 $html11 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />How much money you spend in buying Pesticide? </td>';
            //                     for($i = 0; $i < sizeof($future_crop_details_arr);$i++ )
            //                     {
            //                         $html11 .= '<td width="406" colspan="4"><p>'.$future_crop_details_arr[$i]['f14_spend_money_pesticide'].'</p></td>';
            //                     }
            //                 $html11 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />Brand Of Pesticide </td>';
            //                     for($i = 0; $i < sizeof($future_crop_details_arr);$i++ )
            //                     {
            //                         $html11 .= '<td width="406" colspan="4"><p>'.$future_crop_details_arr[$i]['f14_brand_of_pesticide'].'</p></td>';
            //                     }
            //                 $html11 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />How much was the total consumption of Other Inputs in KGs </td>';
            //                     for($i = 0; $i < sizeof($future_crop_details_arr);$i++ )
            //                     {
            //                         $html11 .= '<td width="406" colspan="4"><p>'.$future_crop_details_arr[$i]['f14_consumption_other_inputs'].'</p></td>';
            //                     }
            //                 $html11 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />How much money you spend in buying Other Expenses? </td>';
            //                     for($i = 0; $i < sizeof($future_crop_details_arr);$i++ )
            //                     {
            //                         $html11 .= '<td width="406" colspan="4"><p>'.$future_crop_details_arr[$i]['f14_spend_money_other_expenses'].'</p></td>';
            //                     }
            //                 $html11 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />How much money you spend in buying Labour? </td>';
            //                     for($i = 0; $i < sizeof($future_crop_details_arr);$i++ )
            //                     {
            //                         $html11 .= '<td width="406" colspan="4"><p>'.$future_crop_details_arr[$i]['f14_spend_money_labour'].'</p></td>';
            //                     }
            //                 $html11 .= '</tr>

            //                 <tr>
            //                     <td width="255"><br />Total spend money for this Crop </td>';
            //                     for($i = 0; $i < sizeof($future_crop_details_arr);$i++ )
            //                     {
            //                         $html11 .= '<td width="406" colspan="4"><p>'.$future_crop_details_arr[$i]['f14_spend_money_total'].'</p></td>';
            //                     }
            //                 $html11 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />Total Profit Gained for this crop? </td>';
            //                     for($i = 0; $i < sizeof($future_crop_details_arr);$i++ )
            //                     {
            //                         $html11 .= '<td width="406" colspan="4"><p>'.$future_crop_details_arr[$i]['f14_total_profit_gained'].'</p></td>';
            //                     }
            //                 $html11 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />Do you use self grown seeds from previous crop? </td>';
            //                     for($i = 0; $i < sizeof($future_crop_details_arr);$i++ )
            //                     {
            //                         $html11 .= '<td width="406" colspan="4"><p>'.$future_crop_details_arr[$i]['f14_use_self_grown_seeds'].'</p></td>';
            //                     }
            //                 $html11 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />Potential Crop Damage </td>';
            //                     for($i = 0; $i < sizeof($future_crop_details_arr);$i++ )
            //                     {
            //                         $html11 .= '<td width="406" colspan="4"><p>'.$future_crop_details_arr[$i]['f14_diseases'].'</p></td>';
            //                     }
            //                 $html11 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />What type of water sources you are depending on? </td>';
            //                     for($i = 0; $i < sizeof($future_crop_details_arr);$i++ )
            //                     {
            //                         // Query For Getting the Water Source for the respective farmer
            //                         $sql_get_water_source = " SELECT * FROM `tbl_f14_farmer_water_source` WHERE `fm_id`='".$reforgid."' AND `count`='".($i+1)."' ";
            //                         $res_get_water_source = mysqli_query($db_con, $sql_get_water_source) or die(mysqli_error($db_con));
            //                         $num_get_water_source = mysqli_num_rows($res_get_water_source);

            //                         if($num_get_water_source != 0)
            //                         {
            //                             $html11 .= '<td width="406" colspan="4">';
            //                                 $html11 .= '<ul>';
            //                                 while ($row_get_water_source = mysqli_fetch_array($res_get_water_source))
            //                                 {
            //                                     $html11 .= '<li>'.$row_get_water_source['water_source_name'].'</li>';
            //                                 }
            //                                 $html11 .= '</ul>';
            //                             $html11 .= '</td>';
            //                         }
            //                     }
            //                 $html11 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />When is the harvest date? </td>';
            //                     for($i = 0; $i < sizeof($future_crop_details_arr);$i++ )
            //                     {
            //                         $html11 .= '<td width="406" colspan="4"><p>'.$future_crop_details_arr[$i]['f14_harvest_date'].'</p></td>';
            //                     }
            //                 $html11 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />What is the net total income you are expecting in this crop cycle? </td>';
            //                     for($i = 0; $i < sizeof($future_crop_details_arr);$i++ )
            //                     {
            //                         $html11 .= '<td width="406" colspan="4"><p>'.$future_crop_details_arr[$i]['f14_income'].'</p></td>';
            //                     }
            //                 $html11 .= '</tr>
            //             </table>';
            //     }
            // $pdf->SetFont('helvetica', '', 10);
            // $pdf->writeHTML($html11, true, 0, true, true);
            // // =================================================================
            // // END : Future Crop Cycle Forecast 
            // // =================================================================

            // // =================================================================
            // // START : Assets Details
            // // =================================================================
            // $pdf->AddPage();
            // $html12 = '<p><strong>Section  XIII - Assets Details </strong></p>
            //     <table border="1" cellspacing="2" cellpadding="2" width="662">
            //         <tr>
            //             <td width="255"><br />TRACTOR  </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f12_TRACTOR'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Vehical Owned </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f12_vehicle'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Total Value of the Vehical </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f12_total_val_of_vehical'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Protavator </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f12_Protavator'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Sprayer </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f12_Sprayer'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Pumps </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f12_Pumps'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Cultivators </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f12_Cultivators'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Machinery Owned </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f12_machinery'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Total Value of the Machinery </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f12_total_val_of_machinery'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Any Other Assets </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f12_any_other_assets'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Which Assets you owned </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f12_name_of_other_assets'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Mention the value of the assets </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f12_mention_value_of_assets'].'</p></td>
            //         </tr>
            //     </table>';
            // $pdf->SetFont('helvetica', '', 10);
            // $pdf->writeHTML($html12, true, 0, true, true);
            // // =================================================================
            // // END : Assets Details
            // // =================================================================

            // // =================================================================
            // // START : Live Stock 
            // // =================================================================
            // $pdf->AddPage();
            // $html13 = '<p><strong>Section  XIII - Assets Details </strong></p>
            //     <table border="1" cellspacing="2" cellpadding="2" width="662">
            //         <tr>
            //             <td width="255"><br />Dairy Cattle  </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f13_dairy_cattle'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Draft Cattle </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f13_draft_cattle'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Buffalo  </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f13_buffalo'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Ox  </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f13_ox'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Sheep  </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f13_sheep'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Goat  </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f13_goat'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Pig  </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f13_pig'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Poultry [ chicken, geese, turkey, duck] </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f13_poultry'].'</p></td>
            //         </tr>
            //         <tr>
            //             <td width="255"><br />Donkeys  </td>
            //             <td width="406" colspan="4"><p>'.$row_q1['f13_donkeys'].'</p></td>
            //         </tr>
            //     </table>';
            // $pdf->SetFont('helvetica', '', 10);
            // $pdf->writeHTML($html13, true, 0, true, true);
            // // =================================================================
            // // END : Live Stock 
            // // =================================================================

            // // =================================================================
            // // START : Financial Details
            // // =================================================================
            // $sql_get_financial_details = " SELECT * FROM `tbl_loan_details` WHERE `fm_id`='".$reforgid."' ";
            // $res_get_financial_details = mysqli_query($db_con, $sql_get_financial_details) or die(mysqli_error($db_con));
            // $num_get_financial_details = mysqli_num_rows($res_get_financial_details);

            // if($num_get_financial_details != 0)
            // {
            //     $row_get_financial_details = mysqli_fetch_array($res_get_financial_details);

            //     $arr_financial_details = array();

            //     $sql_get_tbl_bank_loan_detail = " SELECT tbld.*
            //         FROM tbl_loan_details AS tld INNER JOIN tbl_bank_loan_detail AS tbld
            //             ON tld.fm_id = tbld.fm_id
            //         WHERE tld.fm_id = '".$reforgid."' ";
            //     $res_get_tbl_bank_loan_detail = mysqli_query($db_con, $sql_get_tbl_bank_loan_detail) or die(mysqli_error($db_con));
            //     $num_get_tbl_bank_loan_detail = mysqli_num_rows($res_get_tbl_bank_loan_detail);

            //     if($num_get_tbl_bank_loan_detail != 0)
            //     {
            //         while($row_get_tbl_bank_loan_detail = mysqli_fetch_array($res_get_tbl_bank_loan_detail))
            //         {
            //             array_push($arr_financial_details, $row_get_tbl_bank_loan_detail);
            //         }

            //         $pdf->AddPage();
            //         $html14 = '<p><strong>Section  XIV - Financial History </strong></p>
            //             <table border="1" cellspacing="2" cellpadding="2" width="662">
            //                 <tr>
            //                     <td width="255"><br />How Much is your Avg or Fixed Monthly Income? </td>
            //                     <td width="406" colspan="4"><p>'.$row_get_financial_details['fx_monthly_income'].'</p></td>
            //                 </tr>
            //                 <tr>
            //                     <td width="255"><br />Any Loan taken? </td>
            //                     <td width="406" colspan="4"><p>'.$row_get_financial_details['f8_loan_taken'].'</p></td>
            //                 </tr>
            //                 <tr>
            //                     <td width="255"><br />Mention the Loan Type </td>';
            //                     for($i = 0; $i < sizeof($arr_financial_details);$i++ )
            //                     {
            //                         $html14 .= '<td width="406" ><p>'.$arr_financial_details[$i]['f8_loan_type'].'</p></td>';
            //                     }
            //                 $html14 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />Total Loan Amount </td>';
            //                     for($i = 0; $i < sizeof($arr_financial_details);$i++ )
            //                     {
            //                         $html14 .= '<td width="406" ><p>'.$arr_financial_details[$i]['f8_loan_amount'].'</p></td>';
            //                     }
            //                 $html14 .= '</tr>
            //                 <tr>
            //                     <td width="255"><br />Provider </td>';
            //                     for($i = 0; $i < sizeof($arr_financial_details);$i++ )
            //                     {
            //                         $html14 .= '<td width="406" ><p>'.$arr_financial_details[$i]['f8_loan_provider'].'</p></td>';
            //                     }
            //                 $html14 .= '</tr>
            //             </table>';
            //         $pdf->SetFont('helvetica', '', 10);
            //         $pdf->writeHTML($html14, true, 0, true, true);
            //     }
            // }
            // // =================================================================
            // // END : Financial Details
            // // =================================================================

            // // =================================================================
            // // START : Financial History 
            // // =================================================================
            // // Query For getting the Financial History
            // $sql_get_financial_history = " SELECT * FROM `tbl_loan_details` WHERE `fm_id`='".$reforgid."' ";
            // $res_get_financial_history = mysqli_query($db_con, $sql_get_financial_history) or die(mysqli_error($db_con));
            // $num_get_financial_history = mysqli_num_rows($res_get_financial_history);

            // if($num_get_financial_history != 0)
            // {
            //     $row_get_financial_history = mysqli_fetch_array($res_get_financial_history);

            //     $pdf->AddPage();
            //     $html15 = '<p><strong>Section  XIV - Financial History </strong></p>
            //         <table border="1" cellspacing="2" cellpadding="2" width="662">
            //             <tr>
            //                 <td width="255"><br />Do you have a crop insurance? </td>
            //                 <td width="406" colspan="4"><p>'.$row_get_financial_history['f8_crop_insurance'].'</p></td>
            //             </tr>
            //             <tr>
            //                 <td width="255"><br />What was the amount of the Insurance? </td>
            //                 <td width="406" colspan="4"><p>'.$row_get_financial_history['f8_insurance_amount'].'</p></td>
            //             </tr>
            //             <tr>
            //                 <td width="255"><br />What was the Name of the insurer?  </td>
            //                 <td width="406" colspan="4"><p>'.$row_get_financial_history['f8_insurer_name'].'</p></td>
            //             </tr>
            //             <tr>
            //                 <td width="255"><br />Any subsidies received from the Government?  </td>
            //                 <td width="406" colspan="4"><p>'.$row_get_financial_history['f8_any_subsidies'].'</p></td>
            //             </tr>
            //             <tr>
            //                 <td width="255"><br />Name of the Subsidy?  </td>
            //                 <td width="406" colspan="4"><p>'.$row_get_financial_history['f8_subsidy_name'].'</p></td>
            //             </tr>
            //             <tr>
            //                 <td width="255"><br />Any Waivers received from the Government?  </td>
            //                 <td width="406" colspan="4"><p>'.$row_get_financial_history['f8_any_loan_waivers'].'</p></td>
            //             </tr>
            //             <tr>
            //                 <td width="255"><br />Name of the Waivers  </td>
            //                 <td width="406" colspan="4"><p>'.$row_get_financial_history['f8_waiver_name'].'</p></td>
            //             </tr>
            //         </table>';
            //     $pdf->SetFont('helvetica', '', 10);
            //     $pdf->writeHTML($html15, true, 0, true, true);
            // }
            // // =================================================================
            // // END : Financial History 
            // // =================================================================

            // // reset pointer to the last page
            // $pdf->lastPage();

            // // ---------------------------------------------------------
            // ob_end_clean();
            // //Close and output PDF document
            // //$pdf->Output($row_farmer['fm_name']."_customer".'.pdf', 'D');
            // $pdf->Output('../../data/complete/'.$row_farmer['fm_caid'].'/'.$row_farmer['fm_id'].'_'.$row_farmer['fm_name']."_complete".'.pdf', 'F');
        //}
        //============================================================
        // END OF FILE
        //============================================================
        ?>
        <script type="text/javascript">
            alert("Job Done Successfully");
        </script>
        <?php
    }
    else
    {
        echo "error";	
    }
    ?>
