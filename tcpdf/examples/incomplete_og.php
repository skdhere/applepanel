<?php
//include('access1.php'); 
include('../../include/connection.php');

date_default_timezone_set("Asia/Calcutta");
$dt=date('Y-m-d H:i:s');
$temp_dt=date('d F Y');
//$reforgid=$_REQUEST['reforgid'];


$sql_org="select * from tbl_farmers a, tbl_points b  where a.fm_id=b.fm_id and (b.pt_frm1 ='' or b.pt_frm2 ='' ";
              $sql_org    .= "  or b.pt_frm3 =''  ";
              $sql_org    .= "  or b.pt_frm7 ='' ";
              $sql_org    .= "  or b.pt_frm8 ='' or b.pt_frm9 ='' ";
              $sql_org    .= "  or b.pt_frm10 ='' or b.pt_frm5 ='' ";
              $sql_org    .= "  or b.pt_frm12 ='' or b.pt_frm13 ='' ";
              $sql_org    .= "  or b.pt_frm11 ='' or b.pt_frm14 ='')";
$res_org=mysqli_query($db_con,$sql_org);
$tot_org=mysqli_num_rows($res_org);
if($tot_org > 1)
{
  while($row_org=mysqli_fetch_array($res_org));
  {

    $reforgid=$row_org['fm_id'];

    $sql_q1="select * from tbl_farmers a,hospital_oi b,hospital_sustain c,hospital_acc d,hospital_cs e,organisation f where a.cust_id=b.cust_oi_refid and a.cust_id=c.cust_sus_refid and a.cust_id=d.cust_acc_refid and a.cust_id=e.cust_cs_refid and a.cust_orgid=f.org_id and a.fm_id='$reforgid'";
    $res_q1=mysqli_query($db_con,$sql_q1);
    $row_q1=mysqli_fetch_array($res_q1);

   

    // Include the main TCPDF library (search for installation path).
    require_once('tcpdf_include.php');

    // create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Punit Panchal');
    $pdf->SetTitle($ref_no);
    $pdf->SetSubject('Complete Entry');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

    $pdf->SetHeaderData('', '', 'Sqoreyard Form','');

    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    	require_once(dirname(__FILE__).'/lang/eng.php');
    	$pdf->setLanguageArray($l);
    }

    if ($dom[$key]['tag'] AND isset($dom[$key]['attribute']['pagebreak'])) {
        // check for pagebreak
        if (($dom[$key]['attribute']['pagebreak'] == 'true') OR ($dom[$key]['attribute']['pagebreak'] == 'left') OR ($dom[$key]['attribute']['pagebreak'] == 'right')) {
            // add a page (or trig AcceptPageBreak() for multicolumn mode)
            $this->checkPageBreak($this->PageBreakTrigger + 1);
        }
        if ((($dom[$key]['attribute']['pagebreak'] == 'left') AND (((!$this->rtl) AND (($this->page % 2) == 0)) OR (($this->rtl) AND (($this->page % 2) != 0))))
                OR (($dom[$key]['attribute']['pagebreak'] == 'right') AND (((!$this->rtl) AND (($this->page % 2) != 0)) OR (($this->rtl) AND (($this->page % 2) == 0))))) {
            // add a page (or trig AcceptPageBreak() for multicolumn mode)
            $this->checkPageBreak($this->PageBreakTrigger + 1);
        }
    }

    // ---------------------------------------------------------

      // add a page
      $pdf->AddPage();
      // set default header data
      // set default header data


      $html1 = '<p><strongFarmer Information</strong></p>
      <table border="1" cellspacing="2" cellpadding="2" width="662">
      <tr>
      <td width="255"><br />
        Farmer Name </td>
      <td width="406" colspan="4"><p>'.$row_q1['fm_name'].'</p></td>
      </tr>
      <tr>
      <td width="255"><br />
        Aadhar No </td>
      <td width="406" colspan="4"><p>'.$row_q1['fm_aadhar'].'</p></td>
      </tr>
      <tr>
      <td width="255"><br />
        Mobile No </td>
      <td width="406" colspan="4"><p>'.$row_q1['fm_mobileno'].'</p></td>
      </tr>
      <tr>
      <td width="255"><br />
        Loan Required? </td>
      <td width="406" colspan="4"><p>'.$row_q1['fm_loan'].'</p></td>
      </tr>
      <tr>
      <td width="255"><br />
        Registered Entity Type </td>
      <td width="406" colspan="4"><p>'.$row_q1['fm_amount'].'</p></td>
      </tr>
      <tr>
      <td width="255"><br />
        Registered Date </td>
      <td width="406" colspan="4"><p>'.$row_q1['fm_createddt'].'</p></td>
      </tr>
      <tr>
      </table>';
      $pdf->SetFont('helvetica', '', 10);
      $pdf->writeHTML($html1, true, 0, true, true);
      // set auto page breaks

      $pdf->AddPage();
      $html2 = '<p><strong>Section  II – CASE STUDY<br>I. Initiative / service / project / innovation * for the speciality selected </strong></p>
      <table border="1" cellspacing="2" cellpadding="2">
      <tr>
      <td width="662" colspan="5" valign="top"><p>A)  Summarise the initiative / service /project / innovation which you are entering for the Awards for the category and speciality selected. <strong>Please select and mention your top 3 initiative / service / project / innovation for the speciality selected</strong></p><p> This should clearly explain the jury members what the case study is about and should summarise remaining part of the application form<br> Innovation is defined as a new solution or an older solution implemented in a new way to achieve the goal.
      </p></td>
      </tr>
      <tr>
      <td width="212"><p>Name of the initiative / service / project / innovation for the speciality selected(max 50 word)</p></td>
      <td width="450" colspan="4"><p>&nbsp;</p>
        <p>'.$row_q1['host_initiative'].'</p>
        <p>&nbsp;</p></td>
      </tr>
      <tr>
      <td width="212"><p>Description / objective of initiative / service / project / innovation for the speciality selected (max 250 word)</p></td>
      <td width="450" colspan="4"><p>&nbsp;</p>
        <p>'.$row_q1['host_description'].'</p>
        <p>&nbsp;</p></td>
      </tr>
      <tr>
      <td width="212"><p>Launch date of initiative / service / project / innovation* dd/mm/yyyy</p></td>
      <td width="450" colspan="4" valign="top"><p><strong>&nbsp;</strong></p>
        <p>'.$row_q1['host_launchdt'].'</p>
        <p><strong>&nbsp;</strong></p></td>
      </tr>
      <tr>
      <td width="212"><p>Cost involved to launch the initiative / service / project / innovation </p></td>
      <td width="450" colspan="4" valign="top"><p><strong>&nbsp;</strong></p>
        <p><strong>'.$row_q1['host_cost'].'</strong></p>
        <p><strong>&nbsp;</strong></p></td>
      </tr>
      <tr>
      <td width="212"><p>Describe 3 unique aspects of the initiative / service / project / innovation for the speciality selected (max 100 word) </p></td>
      <td width="450" colspan="4" valign="top"><p><strong>&nbsp;</strong></p>
        <p><strong>'.$row_q1['host_uniqueaspects'].'</strong></p>
        <p><strong>&nbsp;</strong></p></td>
      </tr>
      <tr>
      <td width="212"><p>B) What differentiates your organization/work from others in the industry in Mumbai?</p><p>List up to 5 key aspects along with illustrations and examples, which you may want Jury members to evaluate</p></td>
      <td width="450" colspan="4" valign="top"><p><strong>&nbsp;</strong></p>
        <p><strong>'.$row_q1['host_differentiates'].'</strong></p>
        <p><strong>&nbsp;</strong></p></td>
      </tr>
      </table>';
      // set font
      $pdf->SetFont('helvetica', '', 10);
      $pdf->writeHTML($html2, true, 0, true, true);

      $pdf->AddPage();
      $html3 = '<p><strong>II. IMPACT of the initiative / service / project / innovation </strong></p>
      <table border="1" cellspacing="2" cellpadding="2">
      <tr>
      <td width="662"  valign="top">1. BUSINESS</td>
      </tr>
      <tr>
      <td width="209" valign="top"><br />
        <strong>Parameters</strong></td>
      <td width="151" valign="top"><p><strong>2014 - 2015</strong></p></td>
      <td width="151" valign="top"><p><strong>2015 - 2016</strong></p></td>
      <td width="151" valign="top"><p><strong>2016 - 2017</strong></p></td>
      </tr>
      <tr>
      <td width="209"><p>Total number of bed in the hospital</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_noofbeds_1415'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_noofbeds_1516'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_noofbeds_1617'].'</p></td>
      </tr>
      <tr>
      <td width="209"><p>Numbers of beds dedicated to the speciality selected (if applicable)</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_noofbeds_s_1415'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_noofbeds_s_1516'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_noofbeds_s_1617'].'</p></td>
      </tr>
      <tr>
      <td width="209"><p>Total Business turnover (In Rs.) for your organization</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_turnover_1415'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_turnover_1516'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_turnover_1617'].'</p></td>
      </tr>
      <tr>
      <td width="209"><p>% of Turnover wrt total turnover for the organization, for the speciality selected (if applicable)</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_per_turnover_1415'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_per_turnover_1516'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_per_turnover_1617'].'</p></td>
      </tr>
      <tr>
      <td width="209"><p>Others (please specify)</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_bus_other_1415'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_bus_other_1516'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_bus_other_1617'].'</p></td>
      </tr>
      <tr>
      <td width="662" colspan="4" valign="top">2. OPERATIONS</td>
      </tr>
      <tr>
      <td width="209"><p>Average number of surgical procedures per day at your organization (if applicable)</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_surgical_1415'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_surgical_1516'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_surgical_1617'].'</p></td>
      </tr>
      <tr>
      <td width="209"><p>Average number of surgical procedures per day for the speciality selected (if applicable)</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_surgical_s_1415'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_surgical_s_1516'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_surgical_s_1617'].'</p></td>
      </tr>
      <tr>
      <td width="209"><p>Average number of diagnostic/lab tests conducted per day (if applicable) </p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_diagnostic_1415'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_diagnostic_1516'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_diagnostic_1617'].'</p></td>
      </tr>
      <tr>
      <td width="209"><p>Average number of diagnostic/lab tests conducted per day for the speciality selected (if applicable)</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_diagnostic_s_1415'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_diagnostic_s_1516'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_diagnostic_s_1617'].'</p></td>
      </tr>
      <tr>
      <td width="209"><p>Amount of reduction in maintenance cost for the speciality selected (if applicable)</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_maintcost_1415'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_maintcost_1516'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_maintcost_1617'].'</p></td>
      </tr>
      <tr>
      <td width="209"><p>Turnaround time of patient treatment for speciality selected (if applicable)</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_ttime_1415'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_ttime_1516'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_ttime_1617'].'</p></td>
      </tr>
      <tr>
      <td width="209"><p>Others (please specify)</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_opera_other_1415'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_opera_other_1516'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_opera_other_1617'].'</p></td>
      </tr>
      <tr>
      <td width="662" colspan="4" valign="top">3. EMPLOYEES</td>
      </tr>
      <tr>
      <td width="209"><p>No of full time physicians / technicians / consultants / others in your organization</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_employee_1415'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_employee_1516'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_employee_1617'].'</p></td>
      </tr>
      <tr>
      <td width="209"><p>No of full time physicians / technicians / consultants / others for the speciality selected (if applicable)</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_employee_s_1415'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_employee_s_1516'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_employee_s_1617'].'</p></td>
      </tr>
      <tr>
      <td width="209"><p>Attrition rate (%)</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_attrition_1415'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_attrition_1516'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_attrition_1617'].'</p></td>
      </tr>
      <tr>
      <td width="209"><p>Hours of training provided to staff for specialty selected (if applicable)</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_training_1415'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_training_1516'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_training_1617'].'</p></td>
      </tr>
      <tr>
      <td width="209"><p>Others (please specify)</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_emp_other_1415'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_emp_other_1516'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_emp_other_1617'].'</p></td>
      </tr>
      <tr>
      <td width="662" colspan="4" valign="top">4. PATIENTS</td>
      </tr>
      <tr>
      <td width="209"><p>Average number of in patients per day at your organization</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_patient_1415'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_patient_1516'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_patient_1617'].'</p></td>
      </tr>
      <tr>
      <td width="209"><p>Average number of in patients per day for the speciality selected (if applicable)</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_patient_s_1415'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_patient_s_1516'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_patient_s_1617'].'</p></td>
      </tr>
      <tr>
      <td width="209"><p>Average number of OP per day at your organization</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_patient_op_1415'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_patient_op_1516'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_patient_op_1617'].'</p></td>
      </tr>
      <tr>
      <td width="209"><p>Average number of OP per day for the speciality selected (if applicable)</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_patient_op_s_1415'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_patient_op_s_1516'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_patient_op_s_1617'].'</p></td>
      </tr>
      <tr>
      <td width="209"><p>Standard Mortality Rate (%) for the speciality selected (it is a weighted average of the age-specific mortality rates per 100,000 persons, where the weights are the proportions of persons in the corresponding age groups of the WHO standard population (if applicable)</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_stdmortalityrate_1415'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_stdmortalityrate_1516'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_stdmortalityrate_1617'].'</p></td>
      </tr>
      <tr>
      <td width="209"><p>Others (please specify)</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_patient_other_1415'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_patient_other_1516'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_patient_other_1617'].'</p></td>
      </tr>
      <tr>
      <td width="662" colspan="4" valign="top">5. Research</td>
      </tr>
      <tr>
      <td width="209"><p>Number of citation for the selected category (if applicable)</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_citation_1415'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_citation_1516'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_citation_1617'].'</p></td>
      </tr>
      <tr>
      <td width="209"><p>Number of research papers published for the selected speciality (if applicable)</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_researchpaper_1415'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_researchpaper_1516'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_researchpaper_1617'].'</p></td>
      </tr>
      <tr>
      <td width="209"><p>Others (please specify)</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_research_other_1415'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_research_other_1516'].'</p></td>
      <td width="151" valign="top"><p>'.$row_q1['host_research_other_1617'].'</p></td>
      </tr>
      <tr>
      <td width="662" colspan="4" valign="top">6. Additional Information</td>
      </tr>
      <tr>
      <td width="208"><p>Please explain how your initiative / service / project / innovation for the speciality selected has impacted any other success criteria for the speciality selected.(max 250 words)</p></td>
      <td width="454" colspan="3" valign="top"><p>'.$row_q1['host_additionalinfo'].'</p></td>

      </tr>
      </table>';
      // set font
      $pdf->SetFont('helvetica', '', 10);
      $pdf->writeHTML($html3, true, 0, true, true);


      $pdf->AddPage();
      $html4 = '<p><strong>III. Sustainability for the initiative / service / project / innovation</strong></p>
      <table border="1" cellspacing="2" cellpadding="2">
      <tr>
      <td width="662" valign="top">A) Please describe the key developments from your end to ensure the sustainability of the initiative / service / project / innovation in the next 2 years (max 200 words) </td>
      </tr>
      <tr>
      <td width="662"><p>'.$row_q1['host_sustainability'].'</p></td>
      </tr>
      <tr>
      <td width="662" valign="top">B) Why should your organization win this award (max 75 word)</td>
      </tr>
      <tr>
      <td width="662"><p>'.$row_q1['host_org_win'].'</p></td>
      </tr>
      </table>';
      // set font
      $pdf->SetFont('helvetica', '', 10);
      $pdf->writeHTML($html4, true, 0, true, true);



      $pdf->AddPage();
      $html5 = '<p><strong>Section IV  - Accreditations</strong></p>
      <table border="1" cellspacing="2" cellpadding="2">
      <tr>
      <td width="142" valign="top"><br />
        Accreditation </td>
      <td width="133" valign="top"><p>Year of Accreditation</p></td>
      <td width="387" valign="top"><p>Number of  non-compliances review by the accreditation committees in the last one year</p></td>
      </tr>
      <tr>
      <td width="142"><p>JCI</p></td>
      <td width="133" valign="top"><p>'.$row_q1['cust_jci_year'].'</p></td>
      <td width="387" valign="top"><p>'.$row_q1['cust_jci_noncomp'].'</p></td>
      </tr>
      <tr>
      <td width="142"><p>NABH</p></td>
      <td width="133" valign="top"><p>'.$row_q1['cust_nabh_year'].'</p></td>
      <td width="387" valign="top"><p>'.$row_q1['cust_nabh_noncomp'].'</p></td>
      </tr>
      <tr>
      <td width="142"><p>ISO</p></td>
      <td width="133" valign="top"><p>'.$row_q1['cust_iso_year'].'</p></td>
      <td width="387" valign="top"><p>'.$row_q1['cust_iso_noncomp'].'</p></td>
      </tr>
      <tr>
      <td width="142"><p>Any other (Specify )</p></td>
      <td width="133" valign="top"><p>'.$row_q1['cust_other_year'].'</p></td>
      <td width="387" valign="top"><p>'.$row_q1['cust_other_noncomp'].'</p></td>
      </tr>
      </table>';
      // set font
      $pdf->SetFont('helvetica', '', 10);
      $pdf->writeHTML($html5, true, 0, true, true);





      // reset pointer to the last page
      $pdf->lastPage();

      // ---------------------------------------------------------
      ob_end_clean();
      //Close and output PDF document
      //$pdf->Output($row_org['org_name']."_customer".'.pdf', 'D');
      $pdf->Output('../../data/complete/'.$row_org['fm_caid'].'/'.$row_org['fm_name']."_complete".'.pdf', 'F');
  }
    //============================================================+
    // END OF FILE
    //============================================================+
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
